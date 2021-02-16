<?php

use Illuminate\Support\Facades\Route;

use App\Models\Registration;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//testing the Registrations & courses relationship (many to many)!
//get the courses of a specific registration!
Route::get('/courses', function(){
    $reg = Registration::findOrFail(1);

    foreach($reg->courses as $course){
        echo $course->englishName . "<br>";
    }
});
