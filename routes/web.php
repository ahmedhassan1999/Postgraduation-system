<?php
use App\Models\Personaldatastudent;
use Illuminate\Support\Facades\Route;


use App\Models\Registration;
use App\Models\StudyType;
use App\Models\Department;

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

//testing the inverse relation
/*
Route::get('/register', function(){
    $regist = Registration::findOrFail(1);
    return $regist->personal->arabicName;
});
*/


//testing the Registrations & Excuses relationship (one to many)!
//get the excuses of a specific registration!
Route::get('/excuses', function(){
    $register = Registration::findOrFail(1);

    foreach($register->excuses as $excuse){
        echo $excuse->content . "<br>";
    }
});


//testing the Registrations & Payments relationship (one to many)!
//get the payments of a specific registration!
Route::get('/payments', function(){
    $reg = Registration::findOrFail(1);

    foreach($reg->payments as $pay){
        echo $pay->amountPaid . "<br>";
    }
});


//testing the Registrations & States relationship (one to many)!
//get the states of a specific registration!
Route::get('/states', function(){
    $reg = Registration::findOrFail(1);

    foreach($reg->states as $stat){
        echo $stat->status . "<br>";
    }
});


//testing the StudyTypes & Registrations relationship (one to many)!
//get the registration of a specific studyType!
Route::get('/registrations', function(){
    $study = StudyType::findOrFail(1);

    foreach($study->registrations as $reg){
        echo $reg->arabicTitle . "<br>";
    }
});


//testing the Departments & StudyTypes relationship (one to many)!
//get the studyTypes of a specific department!
Route::get('/studies', function(){
    $dept = Department::findOrFail(1);

    foreach($dept->studies as $st){
        echo $st->arabicName . "<br>";
    }
});


//testing the StudyTypes & Courses relationship (one to many)!
//get the courses of a specific studyType!
Route::get('/coursess', function(){
    $study = StudyType::findOrFail(1);

    foreach($study->courses as $co){
        echo $co->courseCode . "<br>";
    }
});



//testing the Registrations & courses relationship (many to many)!
//get the courses of a specific registration!
Route::get('/courses', function(){
    $reg = Registration::findOrFail(1);

    foreach($reg->courses as $course){
        echo $course->courseCode . "<br>";
    }
});

