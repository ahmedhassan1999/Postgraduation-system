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
Route::post('previousstudy/{id}', [\App\Http\Controllers\PreviousstudieController::class, 'previousstudy']);
Route::put('updatepreviousstudy/{id}',[\App\Http\Controllers\PreviousstudieController::class, 'updatepreviousstudy']);
Route::delete('deletepreviousstudy/{id}',[\App\Http\Controllers\PreviousstudieController::class, 'deletepreviousstudy']);
