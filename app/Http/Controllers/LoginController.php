<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
	public function login(Request $request){
		
		$request -> validate([
		'email' => ['required', 'email'],
		'password' => ['required']
		]);
		
		$user = User::where('email',$request->email)->first();
		
	if(!$user){
		/*throw ValidationException::withMessages([
		'email' => ['The provided credentials are incorrect']
		]);*/
		return "user not found";
		
	}

	if( !Hash::check($request->password,$user->password )){
		/*throw ValidationException::withMessages([
		'email' => ['The provided credentials are incorrect']
		]);*/
		return "password does not match";
		
	}

	$tokenResult = $user->createToken('Personal Access Token');
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
		'user' => $user,
		'tokenResult' => $tokenResult
    ]);
    }

	public function fakelogin() {

		return "this is login page";
	}
	
	//return $user->createToken('Auth Token')->accessToken;
	
}
