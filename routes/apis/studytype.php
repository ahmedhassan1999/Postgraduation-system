<?php

use Facade\FlareClient\Api;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('addstudytypeandcourse',[\App\Http\Controllers\StudyTypeController::class,'addstudytype']);
Route::post('addcourses/{id}',[App\Http\Controllers\StudyTypeController::class,'addcourses']);
Route::get('getallstudytype',[App\Http\Controllers\StudyTypeController::class,'getallstudytype']);
Route::get('getallcourses/{id}',[App\Http\Controllers\StudyTypeController::class,'getallcourses']);
Route::put('updatestudytype/{id}',[\App\Http\Controllers\StudyTypeController::class,'updatestadytype']);
Route::put('updatecourses',[\App\Http\Controllers\StudyTypeController::class,'updatecourses']);
Route::delete('deletestudytype/{id}',[\App\Http\Controllers\StudyTypeController::class,'deletestudytype']);
Route::delete('deletecourse/{id}',[\App\Http\Controllers\StudyTypeController::class,'deletecourse']);

