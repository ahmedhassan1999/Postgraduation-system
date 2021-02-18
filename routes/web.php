<?php
use App\Models\Personaldatastudent;
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

Route::get('/student', function(){
    $student = Personaldatastudent::findOrFail(1);
   // return $student->register()->englishTitle;
    // $res=$student->register()->englishTitle;

   /* $student=$student->register();
    return $student;*/

    foreach($student->register as $re){
        echo $re->arabicTitle . "<br>";
    }
});



//testing the Registrations & courses relationship (many to many)!
//get the courses of a specific registration!
Route::get('/courses', function(){
    $reg = Registration::findOrFail(1);

    foreach($reg->courses as $course){
        echo $course->englishName . "<br>";
    }
});

