<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupervisorController;

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

Route::post('/createSupervisor', [SupervisorController::class, "createSupervisor"]);
Route::get('/supervisors', [SupervisorController::class, "getAllSupervisors"]);
Route::get('/supervisors/{id}', [SupervisorController::class, "getSupervisor"]);
Route::post('/supervisors', [SupervisorController::class, "createSupervisorManually"]);
Route::put('/supervisors/{id}', [SupervisorController::class, "updateSupervisor"]);
Route::delete('/supervisors/{id}', [SupervisorController::class, "deleteSupervisor"]);
Route::get('/get-info', [SupervisorController::class, "getInfo"]);
Route::get('/search', [SupervisorController::class, "filter"]);