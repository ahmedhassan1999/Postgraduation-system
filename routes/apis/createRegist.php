<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SendController;
use App\Http\Controllers\RegistrationController;
use App\Models\Registration;

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

Route::post('/registrations', [RegistrationController::class, 'createRegistration']);
Route::post('getstudnt',[RegistrationController::class,'GetALLDate']);

Route::get('get',[RegistrationController::class,'GetALLDate']);
Route::get('getall',[RegistrationController::class,'getall']);
Route::get('getrefree',[RegistrationController::class,'searchrefree']);
Route::put('updatedate',[RegistrationController::class,'updatedate']);

Route::get('date',[RegistrationController::class,'date']);
