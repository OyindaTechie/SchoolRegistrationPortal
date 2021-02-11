<?php

namespace App\Http\Controllers;

use App\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    //
    
	public function __construct()
    {

        // $this->middleware('auth')->except(['index', 'show']);
    //$this->middleware('authadminverified')->only(['updateStudent']);
    }

	public function createTeacher(){

		return "teacher created";
	}

    public function login(Request $request){
		
		$request -> validate([
		'email' => ['required', 'email'],
		'password' => ['required']
		]);
		
		$admin = Teacher::where('email',$request->email)->first();
		
	if(!$admin){
		/*throw ValidationException::withMessages([
		'email' => ['The provided credentials are incorrect']
		]);*/
		return "teacher not found";
		
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
         'admin' => Auth::guard('teacherapi')->User(),
		//'user' => $admin,
		'tokenResult' => $tokenResult
    ]);
    }


}
