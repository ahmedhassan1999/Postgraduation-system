<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SendController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//to enter the student name, email, and study-type & send an email for him with the form according to his study-type.
Route::post('addStudentData', [\App\Http\Controllers\StudentController::class, 'addStudentData']);

//to get the student by his id
Route::get('/student/{id}', [\App\Http\Controllers\StudentController::class, 'getStudent']);

//update the student by his id
Route::put('/student/{id}', [\App\Http\Controllers\StudentController::class, 'updateStudent']);

//test
Route::get('try', [\App\Http\Controllers\StudentController::class, 'tryy']);
Route::delete('deletestudent/{id}',[\App\Http\Controllers\StudentController::class,'delete']);
Route::get('getallstudent',[\App\Http\Controllers\StudentController::class,'getallstudent']);
Route::get('searchstudent',[\App\Http\Controllers\StudentController::class,'search']);
