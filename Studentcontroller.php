<?php

namespace App\Http\Controllers;

use App\Models\Studentmodel;
use Illuminate\Http\Request;

class Studentcontroller extends Controller
{
    public function index(){
     return view('index');
    }

    
public function create(){
    return view('create');
}
//come from action method post
public function store(Request $request){
    // dd($request->all());
     //upload image
    $imageName=time().'.'.$request->image->extension();
    $request->image->move(public_path('uploadf'),$imageName);
    // dd($imageName);
    //for insert in database
    $student=new Studentmodel();
    $student->student_image=$imageName;
    $student->student_name = $request->name;
    $student->student_gender = $request->gender;               
    $student->student_age = $request->age;
    $student->student_class = $request->class;
    $student->student_subject = $request->subject;
    $student->student_description = $request->description;
    $student->student_message = $request->message;
    $student->save();
    return back();

}

}
