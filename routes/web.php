<?php
use App\Models\Personaldatastudent;
use Illuminate\Support\Facades\Route;


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

