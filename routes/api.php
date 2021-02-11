<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::prefix('allstudent')->group(function(){

    Route::get('students', 'ApiController@getAllStudents');
    Route::get('students/{id}', 'ApiController@getStudent');

}); 

//Route::get('students', 'ApiController@getAllStudents');
//Route::get('students/{id}', 'ApiController@getStudent');
Route::post('students', 'ApiController@createStudent');
Route::put('students/{id}', 'AdminController@updateStudent');
Route::delete('students/{id}','ApiController@deleteStudent');
Route::post('login', 'loginController@login');
Route::post('fakelogin', 'loginController@fakelogin')->name('register');
Route::post('adminregister', 'AdminController@createAdmin');
Route::post('adminlogin', 'AdminController@login');
Route::get('ss/{id}', 'ApiController@getStudentsBelongingToTeacher');
Route::get('st', 'ApiController@getTeacherBelongingToStudent');
Route::post('st/{id}', 'ApiController@createStudentsBelongingToTeacher');
Route::post('teacherlogin', 'TeacherController@login');

