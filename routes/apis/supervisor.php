<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SendController;
use App\Http\Controllers\RegistrationController;

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

Route::post('/createSupervisor', [App\Http\Controllers\SupervisorController::class, "createSupervisor"]);
Route::get('/supervisors', [App\Http\Controllers\SupervisorController::class, "getAllSupervisors"]);
Route::get('/supervisors/{id}', [App\Http\Controllers\SupervisorController::class, "getSupervisor"]);
Route::post('/supervisors', [App\Http\Controllers\SupervisorController::class, "createSupervisorManually"]);
Route::put('/supervisors/{id}', [App\Http\Controllers\SupervisorController::class, "updateSupervisor"]);
Route::delete('/supervisors/{id}', [App\Http\Controllers\SupervisorController::class, "deleteSupervisor"]);