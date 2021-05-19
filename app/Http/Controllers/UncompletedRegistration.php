<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UncompletedRegMail;
use Carbon\Carbon;
use App\Models\Personaldatastudent;
use App\Models\Registration;
use App\Models\Previousstudie;
use App\Models\StudyType;

//for sms message
use Exception;
use Twilio\Rest\Client;


class UncompletedRegistration extends Controller
{
    public function getAllStudents(){
        $st = Personaldatastudent::whereNull('englishName')->whereDate('created_at', '<=', Carbon::now()->subDays(7))->get()->all();
        // return Carbon::now()->subDays(7);
        return response()->json($st, 201);
    }

    public function sendEmail(Request $request){
        $id = $request->idS;
        $name = $request->arabicName;
        $email = $request->email;

        Mail::to($email)->send(new UncompletedRegMail($id, $name));

        return response()->json([
            "message" => "email sent successfully!"
        ], 201);
    }

    public function deleteStudent($id){
        $student = Personaldatastudent::find($id);
        $student->delete();

        return response()->json([
            "message" => "record deleted successfully!"
        ], 202);
    }

    public function register(Request $request, $id){
        //updating the student
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

        //creating the registrtiaon for him
        $regist = new Registration;
        //the student registration study type
        $registStudy = StudyType::where('arabicName', $request->study_type)->first();
        $regist->idSF = $id;
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

        //creating the previous studies for him
        $prev = new Previousstudie();
        $prev->idSF = $id;
        $prev->degree = $request->degree;
        $prev->faculty = $request->faculty;
        $prev->university = $request->university;
        $prev->dateObtained = $request->dateObtained;
        $prev->specialization = $request->specialization;
        $prev->save();

        return response()->json([
            "message" => "the student is registered successfully!"
        ], 201);
    }

    
    public function sendSMS(Request $request){
        $phone_number = "+2".$request->mobileNumber;
        $receiverNumber = $phone_number;
        $message = "Please, check out your mail inbox to complete your registeration!";
  
        try {
  
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
  
            return response()->json([
                "message" => "SMS sent successfully!"
            ], 201);
  
        } catch (Exception $e) {
            return response()->json([
                "message" => "Error: " . $e->getMessage()
            ], 405);
        }
        
    }
    
}
