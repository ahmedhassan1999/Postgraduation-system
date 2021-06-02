<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\StudyType;
use App\Models\Referee;
use App\Models\Personaldatastudent;
use App\Models\Previousstudie;
use App\Models\Excuse;
use App\Models\Payment;
use App\Models\State;
use App\Models\Supervisor;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use stdClass;

class RegistrationController extends Controller
{
    public function date(Request $request)
    {
        return  Payment::whereBetween('created_at', [$request->from, $request->to])->get();
    }



   public function searchrefree(Request $request)
   {
    $results=Referee::where('arabicName','like', '%'. $request->arabicName .'%')->get();
    return $results;

   }
   public function getall()
   {

      $personals= Personaldatastudent::whereNotNull('englishName')->get();
      $Personal_Registration=array();
      for($i=0;$i<sizeof($personals);$i++)
      {
          $register[$i]=Registration::where('idSF',$personals[$i]->idS)->get()->last();
          $Personal_Registration[$i]['personal']=$personals[$i];
          $Personal_Registration[$i]['register']=$register[$i];
          $studyType=StudyType::find($register[$i]->idStudyTypeF)->first();
          $Personal_Registration[$i]['register']['spec']=$studyType->arabicName;
          $Personal_Registration[$i]['register']['type']=$studyType->type;
          $depart=Department::find($studyType->idDeptF)->first();
          $Personal_Registration[$i]['register']['departName']=$depart->arabicName;
     }
     return $Personal_Registration;
   }

   public function updatedate(Request $request)
   {     session_start();

    $register=Registration::find( $_SESSION['id_registration']);

    $register->departmentApprovalDateRegistration = is_null($request->departmentApprovalDateRegistration) ? $register->departmentApprovalDateRegistration : $request->departmentApprovalDateRegistration;
    $register->facultyApprovalDateRegistration	 = is_null($request->facultyApprovalDateRegistration	) ? $register->facultyApprovalDateRegistration	 : $request->facultyApprovalDateRegistration;
    $register->universitydepartmentApprovalDateRegistration = is_null($request->universitydepartmentApprovalDateRegistration) ? $register->universitydepartmentApprovalDateRegistration : $request->universitydepartmentApprovalDateRegistration;
    $register->committeeytApprovalDateRegistration = is_null($request->committeeytApprovalDateRegistration) ? $register->committeeytApprovalDateRegistration : $request->committeeytApprovalDateRegistration;
    $register->formDate = is_null($request->formDate) ? $register->departmentApprovalDateRegistration : $request->formDate;
    $register->currentState = is_null($request->currentState) ? $register->currentState : $request->currentState;
    $register->arabicTitle = is_null($request->arabicTitle) ? $register->arabicTitle : $request->arabicTitle;
    $register->englishTitle = is_null($request->englishTitle) ? $register->englishTitle : $request->englishTitle;
    $register->requiredCourses = is_null($request->requiredCourses) ? $register->requiredCourses : $request->requiredCourses;
    $register->toeflGrade = is_null($request->toeflGrade) ? $register->toeflGrade : $request->toeflGrade;
    $register->save();
}

    public function GetALLDate(Request $request)
    {
       $Personal_Registration=Personaldatastudent::where('idS', $request->idS)
        ->join('registrations','personaldatastudents.idS','registrations.idSF')
        ->where('registrations.idStudyTypeF',$request->studyType_id)
        ->get()
        ->toArray();
        $previousstudie=Previousstudie::where('idSF',$Personal_Registration[0]['idS'])->get()->toArray();
        $referee=array();

        $pivot=DB::table('reports')
        ->where('idRegistrationF',$Personal_Registration[0]['idRegistration'])
        ->get();

      for($i=0;$i<sizeof($pivot);$i++)
      {

          $data1=Referee::select('arabicName','idRefereed','specialization')->where('idRefereed',$pivot[$i]->idRefereedF)->first();
         $data2 = DB::table('reports')
          ->where('idRegistrationF',$Personal_Registration[0]['idRegistration'])
          ->where('idRefereedf',$pivot[$i]->idRefereedF)
          ->get();
         $referee[$i]=$data1;
          $referee[$i]['URLReport']=$pivot[$i]->URLReport;
          $referee[$i]['reportState']=$pivot[$i]->reportState;
          $referee[$i]['dateReport']=$pivot[$i]->dateReport;



      }

      $supervisour=array();
        $pivot1=DB::table('registerationsupervisors')
        ->where('idRegistrationF',$Personal_Registration[0]['idRegistration'])
        ->get();

        for($i=0;$i<sizeof($pivot1);$i++)
      {

          $data1=Supervisor::select('arabicName','idSupervisor','specialization')->where('idSupervisor',$pivot1[$i]->idSupervisorF)->first();
         $data2 = DB::table('registerationsupervisors')
          ->where('idRegistrationF',$Personal_Registration[0]['idRegistration'])
          ->where('idSupervisorF',$pivot1[$i]->idSupervisorF)
          ->get();
         $supervisour[$i]=$data1;
          $supervisour[$i]['registrationDate']=$pivot1[$i]->registrationDate;
          $supervisour[$i]['cancelationDate']=$pivot1[$i]->cancelationDate;
          $supervisour[$i]['currentState']=$pivot1[$i]->currentState;
          $supervisour[$i]['stillExist']=$pivot1[$i]->stillExist;
      }


        $excuse=Excuse::where('idRegistrationF',$Personal_Registration[0]['idRegistration'])->get()->toArray();
        $payment=Payment::where('idRegistrationF',$Personal_Registration[0]['idRegistration'])->get()->toArray();
        $state=State::where('idRegistrationF',$Personal_Registration[0]['idRegistration'])->get()->toArray();
      session_start();
      $_SESSION['id_registration'] = $Personal_Registration[0]['idRegistration'];
        return response()->json(['previousstudie'=>$previousstudie,'excuse'=>$excuse,'referee'=>$referee,'supervisour'=>$supervisour,'payment'=>$payment,'state'=>$state]);

    }





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
