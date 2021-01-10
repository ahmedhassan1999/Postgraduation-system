<?php

namespace App\Http\Controllers;
use App\Models\Personaldatastudent;

use App\Mail\StudentMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function try()
    {

        echo "work";
    }

    public function addStudentData(Request $request)
    {

        $student=new Personaldatastudent();
        $student->englishName=$request->englishName;
        $student->arabicName=$request->arabicName;

        $student->email=$request->email;

        $student->save();
        $user = DB::table('personaldatastudents')->orderBy('idS', 'desc')->first();
        $user_id=$user->idS;
        $user_name=$user->englishName;
        //return dd($user_name);


       $name="https://forms.gle/xQgRdk2Ra89d6foPA";

        Mail::to($user->email)->send(new StudentMail( $user_id,$user_name,$name));
        echo "send to ".$user->englishName . " ". "Done!";


        return response()->json([
            $student
        ], 201);





    }
}
