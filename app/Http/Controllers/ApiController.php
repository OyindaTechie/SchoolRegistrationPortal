<?php

namespace App\Http\Controllers;

use App\Http\Resources\teacherResource;
use App\Http\Resources\userResource;
use Illuminate\Http\Request;

use App\Student;
use App\Teacher;

class ApiController extends Controller
{

  public function __construct()
    {
        /* $this->middleware('authadminverified')->except(['getAllStudents', 'getStudent', 'deleteStudent', 'createStudent']);
        $this->middleware('authadminverified')->only(['updateStudent']);  */
      
        // $this->middleware('auth:api')->only(['createStudent']);
       
       $this->middleware('authteacherverified')->only(['getStudentsBelongingToTeacher']);
    }

 

    public function getAllStudents() {
      // logic to get all students goes here
	  
    //$students = Student::get()->toJson(JSON_PRETTY_PRINT);
    

    $students = Student::all();
    $allreqr = userResource::collection( $students);
    return response($allreqr, 200);
  
	  
    }

    public function getStudentsBelongingToTeacher($teacherid){
      $teacher = Teacher::find($teacherid);
      $students = $teacher->student;
      
      $formattedstudent = teacherResource::collection($students);
      return response($formattedstudent, 200);
    }

    public function createStudentsBelongingToTeacher(Request $request, $id){
      $teacher = Teacher::find($id);
      $student = new Student;
      $student->name = $request->name;
      $student->course = $request->course;

      $teacher = $teacher->student()->save($student);
      return response()->json([
        "message" => "student record created with the teacher id"
    ], 201); 

  
    }

    public function getTeacherBelongingToStudent(){
      $student = Student::find(2);
      $teacher = $student->teacher;
      return response($teacher, 200);
    }

  public function createStudent(Request $request) {

    $student = new Student;
    $student->name = $request->name;
    $student->course = $request->course;
    $student->save();

    return response()->json([
        "message" => "student record created"
    ], 201);
  }

    public function getStudent($id) {
      // logic to get a student record goes here
	    if (Student::where('id', $id)->exists()) {
        $student = Student::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($student, 200);
      } else {
        return response()->json([
          "message" => "Student not found",
		  "description" => "try again"
        ], 404);
      }
	  
    }

    public function updateStudent(Request $request, $id) {
      // logic to update a student record goes here
	    if (Student::where('id', $id)->exists()) {
        $student = Student::find($id);
        $student->name = is_null($request->name) ? $student->name : $request->name;
        $student->course = is_null($request->course) ? $student->course : $request->course;
        $student->save();

        return response()->json([
            "message" => "records updated successfully"
        ], 200);
        } else {
        return response()->json([
            "message" => "Student not found"
        ], 404);
        
    }
	  
    }

    public function deleteStudent ($id) {
      // logic to delete a student record goes here
	  
	      if(Student::where('id', $id)->exists()) {
        $student = Student::find($id);
        $student->delete();

        return response()->json([
          "message" => "records deleted"
        ], 202);
      } else {
        return response()->json([
          "message" => "Student not found"
        ], 404);
      }
    }
}
