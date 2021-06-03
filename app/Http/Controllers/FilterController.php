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
        $ids=array();
        if($study == "تمهيدي الماجستير"){

            $studies= StudyType::select('idStudyType')->where('type', "تمهيدي الماجستير")->get()->pluck('idStudyType');
            $regist = Registration::whereIn('idStudyTypeF',  $studies)->where('currentState','finished')->get();
            
        }else if($study == "الماجستير في العلوم"){

        }else if($study == "دبلومة الدراسات العليا"){

        }else if($study == "دكتوراه الفلسفة في العلوم"){

        }
    }

}
