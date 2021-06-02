<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SendController;
use App\Http\Controllers\ExcuseController;
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


Route::post('addexcuse',[ExcuseController::class, 'addexcuse']);
Route::put('updateexcuse',[ExcuseController::class, 'updateexcuse']);
Route::delete('deleteexcuse/{id}',[ExcuseController::class, 'deleteexcuse']);


