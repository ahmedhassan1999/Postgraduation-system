<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DepartmentController;
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

//get all departments
Route::get('/departments', [\App\Http\Controllers\DepartmentController::class, 'getAllDepartments']);

//get a specific department by its id
Route::get('/departments/{id}', [\App\Http\Controllers\DepartmentController::class, 'getDepartment']);

//create a new department
Route::post('/departments', [\App\Http\Controllers\DepartmentController::class, 'createDepartment']);

//update a department 
Route::put('/departments/{id}', [\App\Http\Controllers\DepartmentController::class, 'updateDepartment']);

//delete a department
Route::delete('/departments/{id}', [\App\Http\Controllers\DepartmentController::class, 'deleteDepartment']);