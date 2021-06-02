<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RefereeController;
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


/////////////
Route::post('createrefress',[\App\Http\Controllers\RefereeController::class,'createrefress']);
Route::get('getreferees',[\App\Http\Controllers\RefereeController::class,'getreferees']);
Route::put('updaterefress/{id}',[\App\Http\Controllers\RefereeController::class,'update']);
Route::post('insertnewrefree',[\App\Http\Controllers\RefereeController::class,'insert']);
Route::delete('delete/{referee}',[\App\Http\Controllers\RefereeController::class,'delete']);
Route::get('getdistinct', [\App\Http\Controllers\RefereeController::class, 'get']);
Route::post('/filterRef', [\App\Http\Controllers\RefereeController::class, "filter"]);
Route::delete('deleterefreefromregister/{id}',[\App\Http\Controllers\RefereeController::class, 'deleterefreefromregister']);
