<?php

namespace App\Http\Controllers;

use App\Models\Productm;
use Illuminate\Http\Request;
// use database from fetch another method  use DB
use DB;

class ProductController extends Controller
{
    
    public function index(){
        // $product= Productm::get();
        // return $recorddata =Productm::get();    // fetcjhing another route
        // return view('index',['disdata'=>Productm::get()]);
        return view('index',['disdata'=>Productm::latest()->paginate(2)]);
        // data fetch here
       }
       public function create(){
        return view('create');
    }
    //come from action method post
    public function store(Request $request){
        // dd($request->all());

        //validate
      $request->validate([
    'name'=>'required',
    'image'=>'required|mimes:png,jpg|max:1000'

  ]);

         //upload image
        $imageName=time().'.'.$request->image->extension();
        $request->image->move(public_path('uploadf'),$imageName);
        // dd($imageName);
        //for insert in database
        $student=new Productm();
        $student->student_name = $request->name;
        $student->student_gender = $request->gender;               
        $student->student_age = $request->age;
        $student->student_class = $request->class;
        $student->student_subject= $request->subject;
        $student->student_description = $request->description;
        $student->student_image=$imageName;
        $student->student_message = $request->message;
        $student->save();
        // return back();
        return back()->withSuccess('data inseted successfully') ;
        

    
    }
            
    public function edit($id){
        // id get  here from 
        // dd($id);
        //return view kro page edit ke lie  and pass this page id for fet
        $fetbyid= Productm::where('id',$id)->first();  //use first for single id 
        // dd($fetdata);
        //editdat  key for access
        // return view('edit',['editdata'=>$fetbyid]);
        return view('edit',['editdata'=>$fetbyid]);
        /* jsise index me pass kie the waise edit m 
        return view('index',['disdata'=>Productm::get()]); */

    }
 //update
 public function update(Request $request, $id){
    // dd($request->all()); 
    //   dd($id); 

   //validate
   $request->validate([
    'name'=>'required',
    'image'=>'nullable|mimes:jpeg,jpg,png,gif|max:30000'

  ]);
          // update sql
          $updsql= Productm::where('id',$id)->first();
        //   dd($updsql);
            // user agr image srlect krta h to ye code run ho 
              //update image
            if(isset($request->image)){
                $imageName=time().'.'.$request->image->extension();
                $request->image->move(public_path('uploadf'),$imageName);
                $updsql->student_image=$imageName;
                $updsql->image=$imageName;

            }
        // $student=new Productm();
        $updsql->student_name     = $request->name;
        $updsql->student_gender   = $request->gender;               
        $updsql->student_age      = $request->age;
        $updsql->student_class    = $request->class;
        $updsql->student_subject  = $request->subject;
        $updsql->student_description   =$request->description;
        // $updsql->student_image=$imageName;
        $updsql->student_message = $request->message;
        $updsql->save();
        // return back();
        return back()->withSuccess('data updated successfully') ;

    

 }
 public function destroy($id){
    $delsql = Productm::Where('id',$id)->first();
    $delsql->delete();
    return back()->withSuccess('delete  successfully!!!!! ') ;
 
   }

  //show
// public function show($id){
//    $Rupesh = Rupesh::Where('id',$id)->first();
//    return back('Rupeshfolder.show',['Rupesh'->$Rupesh]);

public function show($id){
    $showdata = Productm::where('id',$id)->first();
    // $Rupesh->show();
    return view('show',['fetshow'=>$showdata]);

  }











    
        //fetch data from database another mehtod route and class banakr model ke help se@@
        // ya use db krke table ke help se

   /*    function record()
    {
        // throgh model
         return $recorddata =Productm::all();  
        return $recorddata= DB::table('Productms')->get(); }   */
    



}