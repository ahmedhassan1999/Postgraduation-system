<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UncompletedRegistration;
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

Route::get('/uncompletedRegistration', [UncompletedRegistration::class, "getAllStudents"]);
Route::get('/sendEmailForUncompletedReg', [UncompletedRegistration::class, "sendEmail"]);
Route::get('/sendMessageForUncompletedReg', [UncompletedRegistration::class, "sendSMS"]);
// Route::put('/sendMessageForUncompletedReg2/{id}', [UncompletedRegistration::class, "sendSMS2"]);
Route::put('registerStudentManually/{id}', [UncompletedRegistration::class, "register"]);
Route::delete('/deleteStudent/{id}', [UncompletedRegistration::class, "deleteStudent"]);