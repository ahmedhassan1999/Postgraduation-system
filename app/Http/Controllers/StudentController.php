<?php

namespace App\Http\Controllers;


use App\Models\Personaldatastudent;

use App\Mail\StudentMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /*public function try($id)
    {


       $student=
    }*/

    public function addStudentData(Request $request)
    {

        $student = new Personaldatastudent();
        $student->arabicName = $request->arabicName;
        $student->email = $request->email;
        $study_type = $request->study_type;
        $student->save();
        $user = DB::table('personaldatastudents')->orderBy('idS', 'desc')->first();
        $user_id = $user->idS;

        $user_name = $user->arabicName;
        $name = " ";
        if ($study_type == "دكتوراه الفلسفة في العلوم")
            $name = "https://forms.office.com/Pages/ResponsePage.aspx?id=ZVH5axNBiEGbe8tsDBmKW-kPX0-Y8GNGh3ca7Z_4igRUMURFUTNSTk5UVlJPOEg5MDNIMEhVU0o1Wi4u";
        else if ($study_type == "دبلومة الدراسات العليا")
            $name = "https://forms.office.com/Pages/ResponsePage.aspx?id=ZVH5axNBiEGbe8tsDBmKW-kPX0-Y8GNGh3ca7Z_4igRUMDhCQ0ZOWk5CNjNEMEFQNDg2WEo0WjZEQi4u";
        else if ($study_type == "الماجستير في العلوم")
            $name = "https://forms.office.com/Pages/ResponsePage.aspx?id=ZVH5axNBiEGbe8tsDBmKW-kPX0-Y8GNGh3ca7Z_4igRUNDNQT0tHNUVFNlJLVDJHMVU4NFo5SjFERi4u";
        else if ($study_type == "تمهيدي الماجستير")
            $name = "https://forms.office.com/Pages/ResponsePage.aspx?id=ZVH5axNBiEGbe8tsDBmKW-kPX0-Y8GNGh3ca7Z_4igRUMDhCQ0ZOWk5CNjNEMEFQNDg2WEo0WjZEQi4u";

        // $name = "https://forms.gle/xQgRdk2Ra89d6foPA";

        Mail::to($user->email)->send(new StudentMail($user_id, $user_name, $name));
        echo "send to " . $user->arabicName . " " . "Done!";


        return response()->json([
            $student
        ], 201);
    }

    public function getStudent($id)
    {
        if (Personaldatastudent::where('idS', $id)->exists()) {
            $student = Personaldatastudent::where('idS', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($student, 200);
        } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);
        }
    }


    public function updateStudent(Request $request, $id)
    {
        if (Personaldatastudent::where('idS', $id)->exists()) {
            $student = Personaldatastudent::find($id);
            $student->englishName = is_null($request->englishName) ? $student->englishName : $request->englishName;
            $student->arabicName = is_null($request->arabicName) ? $student->arabicName : $request->arabicName;
            $student->birthdateSource = is_null($request->birthdateSource) ? $student->birthdateSource : $request->birthdateSource;
            $student->birthdate = is_null($request->birthdate) ? $student->birthdate : $request->birthdate;
            $student->jobArabic = is_null($request->jobArabic) ? $student->jobArabic : $request->jobArabic;
            $student->jobEnglish = is_null($request->jobEnglish) ? $student->jobEnglish : $request->jobEnglish;
            $student->jobAdd = is_null($request->jobAdd) ? $student->jobAdd : $request->jobAdd;
            $student->Add = is_null($request->Add) ? $student->Add : $request->Add;
            $student->religion = is_null($request->religion) ? $student->religion : $request->religion;
            $student->nationality = is_null($request->nationality) ? $student->nationality : $request->nationality;
            $student->email = is_null($request->email) ? $student->email : $request->email;
            $student->mobile = is_null($request->mobile) ? $student->mobile : $request->mobile;
            $student->nationalityId = is_null($request->nationalityId) ? $student->nationalityId : $request->nationalityId;
            $student->gender = is_null($request->gender) ? $student->gender : $request->gender;
            $student->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 201);
        } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);
        }
    }
}
