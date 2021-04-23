<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\StudyType;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    //
    public function createRegistration(Request $request){
        $regist = new Registration;

        //the student registration study type
        $registStudy = StudyType::where('arabicName', $request->study_type)->first();

        $regist->idSF = $request->idS;
        $regist->idStudyTypeF = $registStudy->idStudyType;
        $regist->arabicTitle = $request->arabicTitle;
        $regist->englishTitle = $request->englishTitle;
        $regist->requiredCourses = $request->requiredCourses;
        $regist->toeflGrade = $request->toeflGrade;
        $regist->departmentApprovalDateRegistration = $request->departmentApprovalDateRegistration;
        $regist->facultyApprovalDateRegistration = $request->facultyApprovalDateRegistration;
        $regist->universitydepartmentApprovalDateRegistration = $request->universitydepartmentApprovalDateRegistration;
        $regist->committeeytApprovalDateRegistration = $request->committeeytApprovalDateRegistration;
        $regist->formDate = $request->formDate;
        $regist->currentState = $request->currentState;
        $regist->save();

        return response()->json([
            "message" => "registration record created successfully!"
        ], 201);
    }
}
