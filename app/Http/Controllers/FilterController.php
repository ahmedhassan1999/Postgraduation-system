<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Personaldatastudent;
use App\Models\Registration;
use App\Models\StudyType;

class FilterController extends Controller
{
    //department filter//
    public function getDeptInf(){
        $dept_arabic = Department::select('arabicName')->distinct()->get()->whereNotNull('arabicName')->pluck('arabicName');
        $dept_english = Department::select('englishName')->distinct()->get()->whereNotNull('englishName')->pluck('englishName');

        return response()->json([
            "dept arabic" => $dept_arabic,
            "dept english" => $dept_english
        ], 201);
    }

    public function dept(Request $request){
        $dept = Department::query();
        if($request->filled('arabicName')){$dept->where('arabicName', $request->arabicName);}
        if($request->filled('englishName')){$dept->where('englishName', $request->englishName);}

        return response()->json([
            "departments" => $dept->get()
        ], 200);
    }

    //students filter//
    public function finishedStudents(Request $request){
        $study = $request->study_type;
        if($study == "تمهيدي الماجستير"){
            $studies= StudyType::select('idStudyType')->distinct()->where('type', "تمهيدي الماجستير")->get()->pluck('idStudyType');
        }else if($study == "الماجستير في العلوم"){
            $studies= StudyType::select('idStudyType')->distinct()->where('type', "الماجستير في العلوم")->get()->pluck('idStudyType');
        }else if($study == "دبلومة الدراسات العليا"){
            $studies= StudyType::select('idStudyType')->distinct()->where('type', "دبلومة الدراسات العليا")->get()->pluck('idStudyType');
        }else if($study == "دكتوراه الفلسفة في العلوم"){
            $studies= StudyType::select('idStudyType')->distinct()->where('type', "دكتوراه الفلسفة في العلوم")->get()->pluck('idStudyType');
        }
        $regist = Registration::select('idSF')->distinct()->whereIn('idStudyTypeF',  $studies)->where('currentState','finished')->get()->pluck('idSF');
        $students = Personaldatastudent::whereIn('idS', $regist)->get();

        if($request->filled('from') && $request->filled('to')){
            $from = date($request->from);
            $to = date($request->to);
            $students = $students->whereBetween('created_at', [$from, $to]);
        }elseif($request->filled('from')){
            $from = date($request->from);
            $students = $students->where('created_at', ">=", $from);
        }
        if($request->filled('gender')){
            $students = $students->where('gender', $request->gender);
        }
        return response()->json($students, 201);
    }

}
