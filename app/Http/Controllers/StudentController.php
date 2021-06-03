<?php

namespace App\Http\Controllers;


use App\Models\Personaldatastudent;
use App\Models\StudyType;
use App\Models\Previousstudie;
use App\Models\Department;

use App\Mail\StudentMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Registration;
use App\Models\Excuse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function search(Request $request)
        {

            $result=Personaldatastudent::where('arabicName','like', '%'. $request->arabicName .'%')->get();
            return $result;
        }
        public function delete($id)
    {
        if(Personaldatastudent::where("idS", $id)->exists()){
              $student = Personaldatastudent::find($id);
              $student->delete();

              return response()->json([
                  "message" => "record deleted!"
              ], 202);
          }else{
              return response()->json([
                  "message" => "student not found!"
              ], 404);
          }
    }

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
            $name = "https://forms.office.com/r/wiLnB63MuX";
        else if ($study_type == "دبلومة الدراسات العليا")
            $name = "https://forms.office.com/r/Vgt3zxRqAp";
        else if ($study_type == "الماجستير في العلوم")
            $name = "https://forms.office.com/r/5Ntw5TX1FK";
        else if ($study_type == "تمهيدي الماجستير")
            $name = "https://forms.office.com/r/ZxrrNeak0p";

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
            $student->image = is_null($request->image) ? $student->image : $request->image;
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

    public function sendEmail(Request $request){
        $study_type = $request->study_type;
        $user_name = $request->arabicName;
        $email = $request->email;
        $user_id = $request->idS;

        $name = "";
        if ($study_type == "دكتوراه الفلسفة في العلوم")
            $name = "https://forms.office.com/r/wiLnB63MuX";
        else if ($study_type == "دبلومة الدراسات العليا")
            $name = "https://forms.office.com/r/Vgt3zxRqAp";
        else if ($study_type == "الماجستير في العلوم")
            $name = "https://forms.office.com/r/5Ntw5TX1FK";
        else if ($study_type == "تمهيدي الماجستير")
            $name = "https://forms.office.com/r/ZxrrNeak0p";

        Mail::to($email)->send(new StudentMail($user_id, $user_name, $name));

        return response()->json([
            "message" => "mail sent successfully!"
        ], 200);
    }


    public function stat(){
        $students = DB::table('personaldatastudents')->count();
        $supervisors = DB::table('supervisors')->count();
        $referees = DB::table('referees')->count();
        $departments = DB::table('departments')->count();
        $studies = DB::table('studytypes')->count();

        //initializing the counters
        $diploma_students = 0;
        $master_students = 0;
        $PhD_students = 0;
        $premaster_students = 0;


        //getting all registrations
        $registrations = DB::table('registrations')->get();

        //looping through all the registrations to check its type
        foreach($registrations as $regist){
            $study = StudyType::find($regist->idStudyTypeF);
            if($study->type == "دبلومة الدراسات العليا"){
                $diploma_students += 1;
            }else if($study->type == "الماجستير في العلوم"){
                $master_students += 1;
            }else if($study->type == "دكتوراه الفلسفة في العلوم"){
                $PhD_students += 1;
            }else if($study->type == "تمهيدي الماجستير"){
                $premaster_students += 1;
            }
        }


        return response()->json([
            "students" => $students,
            "supervisors" => $supervisors,
            "referees" => $referees,
            "departments" => $departments,
            "studies" => $studies,
            "diploma registrations" => $diploma_students,
            "MSc registrations" => $master_students,
            "PhD registrations" => $PhD_students,
            "DSc registrations" => $premaster_students
        ], 200);
    }

    public function insertStudentManually(Request $request){
        $personal = new Personaldatastudent();
        $personal->image =  $request->personalInfo['image'];
        $personal->englishName =  $request->personalInfo['englishName'];
        $personal->arabicName = $request->personalInfo['arabicName'];
        $personal->birthdateSource =  $request->personalInfo['birthdateSource'];
        $personal->birthdate =  $request->personalInfo['birthdate'];
        $personal->jobArabic =  $request->personalInfo['jobArabic'];
        $personal->jobEnglish =  $request->personalInfo['jobEnglish'];
        $personal->jobAdd = $request->personalInfo['jobAdd'];
        $personal->Add =  $request->personalInfo['Add'];
        $personal->religion = $request->personalInfo['religion'];
        $personal->nationality =  $request->personalInfo['nationality'];
        $personal->email =  $request->personalInfo['email'];
        $personal->mobile =  $request->personalInfo['mobile'];
        $personal->nationalityId =  $request->personalInfo['nationalityId'];
        $personal->gender =  $request->personalInfo['gender'];
        $personal->save();

        $regist = new Registration();
        if($request->thesisData['type'] == "دبلومة الدراسات العليا" || $request->thesisData['type'] == "تمهيدي الماجستير"){
            $registStudy = StudyType::where('arabicName', $request->thesisData['arabicTitle'])
            ->where('type', $request->thesisData['type'])
            ->first();
        }else if($request->thesisData['type'] == "الماجستير في العلوم" || $request->thesisData['type'] == "دكتوراه الفلسفة في العلوم"){
            $registStudy = StudyType::where('arabicName', $request->thesisData['spec'])
            ->where('type', $request->thesisData['type'])
            ->first();
        }
        $user = DB::table('personaldatastudents')->orderBy('idS', 'desc')->first();
        $user_id = $user->idS;
        $regist->idSF = $user_id;
        $regist->idStudyTypeF = $registStudy['idStudyType'];
        $regist->arabicTitle = $request->thesisData['arabicTitle'];
        $regist->englishTitle = $request->thesisData['englishTitle'];
        $regist->requiredCourses = $request->thesisData['requiredCourses'];
        $regist->toeflGrade = $request->thesisData['toeflGrade'];
        $regist->save();


        $number_of_prev_studies = sizeof($request->uniDegrees);
        for($i = 0; $i<$number_of_prev_studies; $i++){
            $prevs = new Previousstudie();
            $prevs->idSF = $user_id;
            $prevs->degree = $request->uniDegrees[$i]['degree'];
            $prevs->faculty = $request->uniDegrees[$i]['faculty'];
            $prevs->university = $request->uniDegrees[$i]['university'];
            $prevs->dateObtained = $request->uniDegrees[$i]['dateObtained'];
            $prevs->specialization = $request->uniDegrees[$i]['specialization'];
            $prevs->save();
        }

        return response()->json([
            "message" => "record created successfully!"
        ], 200);
    }

    public function valid(){
        $st = Personaldatastudent::whereNull('englishName')->whereDate('created_at', '>', Carbon::now()->subDays(7))->get()->all();
        $Personal=array();
        for ($i=0; $i < sizeof($st); $i++) {
            $Personal[$i]['personal']= $st[$i];
        }
        return response()->json($Personal, 200);
    }

    public function getInfo(){
        $nationalities = Personaldatastudent::select('nationality')->distinct()->get()->whereNotNull('nationality')->pluck('nationality');
        $departments = Department::select('arabicName')->distinct()->get()->whereNotNull('arabicName')->pluck('arabicName');
        $studies = StudyType::select('arabicName')->distinct()->get()->whereNotNull('arabicName')->pluck('arabicName');

        return response()->json([
            "nationalities" => $nationalities,
            "departments" => $departments,
            "studies" => $studies
        ], 201);
    }

    public function viewFilter(Request $request){

    }

}
