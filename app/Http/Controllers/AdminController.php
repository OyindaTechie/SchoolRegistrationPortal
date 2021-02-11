<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Admin;
use App\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
	//

	public function __construct()
    {

        // $this->middleware('auth')->except(['index', 'show']);
    $this->middleware('authadminverified')->only(['updateStudent']);
    }

	public function createAdmin(){

		return "admin created";
	}


	public function login(Request $request){
		
		$request -> validate([
		'email' => ['required', 'email'],
		'password' => ['required']
		]);
		
		$admin = Admin::where('email',$request->email)->first();
		
	if(!$admin){
		/*throw ValidationException::withMessages([
		'email' => ['The provided credentials are incorrect']
		]);*/
		return "admin not found";
		
	}

	if( !Hash::check($request->password,$admin->password )){
		/*throw ValidationException::withMessages([
		'email' => ['The provided credentials are incorrect']
		]);*/
		return "password does not match";
		
	}

	$tokenResult = $admin->createToken('Personal Access Token');
    $token = $tokenResult->token;
  
        $token->expires_at = Carbon::now()->addDays(1);
        //    Passport::personalAccessTokensExpireIn(Carbon::now()->addMinute(1));
        // Passport::refreshTokensExpireIn(Carbon::now()->addMinutes(1));
    $token->save();
    return response()->json([
        'access_token' => $tokenResult->accessToken,
        'token_type' => 'Bearer',
        'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
        // 'admin' => Auth::guard('adminapi')->user()
		'user' => $admin,
		'tokenResult' => $tokenResult
    ]);
    }


    public function updateStudent(Request $request, $id) {
		// logic to update a student record goes here

		return Auth::guard('adapi')->User();
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

}
