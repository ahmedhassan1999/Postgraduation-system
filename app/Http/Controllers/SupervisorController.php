<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supervisor;
use App\Models\Registration;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\SupervisorMail;

class SupervisorController extends Controller
{
    public function createSupervisor(Request $request){
        $superv = new Supervisor;
        $superv->arabicName = $request->arabicName;
        $superv->email = $request->email;
        $superv->idDegreeF = $request->idDegreeF;
        $superv->save();

        $sv = DB::table('supervisors')->orderBy('idSupervisor', 'desc')->first();
        $supervisor_id = $sv->idSupervisor;
        $supervisor_arabic_name = $sv->arabicName;
        $supervisor_email = $sv->email;
        $form = "https://forms.office.com/r/GNT0Dbba9N";

        Mail::to($supervisor_email)->send(new SupervisorMail($supervisor_id,  $supervisor_arabic_name, $form));

        return response()->json([
            $superv
        ], 201);

    }




    public function getAllSupervisors() {
        $supervisors = Supervisor::get()->toJson(JSON_PRETTY_PRINT);
        return response($supervisors, 201);
      }

      public function createSupervisorManually(Request $request) {
          $supervisor = new Supervisor;
          $supervisor->arabicName = $request->arabicName;
          $supervisor->englishName = $request->englishName;
          $supervisor->university = $request->university;
          $supervisor->faculty = $request->faculty;
          $supervisor->department = $request->department;
          $supervisor->specialization = $request->specialization;
          $supervisor->nationalityId = $request->nationalityId;
          $supervisor->nationality = $request->nationality;
          $supervisor->idDegreeF = $request->idDegreeF;
          $supervisor->gender = $request->gender;
          $supervisor->email = $request->email;
          $supervisor->mobile = $request->mobile;
          $supervisor->save();

          return response()->json([
              "message" => "supervisor created successfully!"
          ], 201);
      }

      public function getSupervisor($id) {
          if(Supervisor::where("idSupervisor", $id)->exists()){
              $supervisor = Supervisor::where("idSupervisor", $id)->get()->toJson(JSON_PRETTY_PRINT);
              return response()->json($supervisor, 200);
          }else{
              return response()->json([
                  "message" => "Supervisor not found!"
              ], 404);
          }
      }

      public function updateSupervisor(Request $request, $id) {
          if(Supervisor::where("idSupervisor", $id)->exists()){
              $supervisor = Supervisor::find($id);
              $supervisor->arabicName = is_null($request->arabicName)? $supervisor->arabicName : $request->arabicName;
              $supervisor->englishName = is_null($request->englishName)? $supervisor->englishName : $request->englishName;
              $supervisor->university = is_null($request->university)? $supervisor->university : $request->university;
              $supervisor->faculty = is_null($request->faculty)? $supervisor->faculty : $request->faculty;
              $supervisor->department = is_null($request->department)? $supervisor->department : $request->department;
              $supervisor->specialization = is_null($request->specialization)? $supervisor->specialization : $request->specialization;
              $supervisor->nationalityId = is_null($request->nationalityId)? $supervisor->nationalityId : $request->nationalityId;
              $supervisor->nationality = is_null($request->nationality)? $supervisor->nationality : $request->nationality;
              $supervisor->idDegreeF = is_null($request->idDegreeF)? $supervisor->idDegreeF : $request->idDegreeF;
              $supervisor->gender = is_null($request->gender)? $supervisor->gender : $request->gender;
              $supervisor->email = is_null($request->email)? $supervisor->email : $request->email;
              $supervisor->mobile = is_null($request->mobile)? $supervisor-> mobile : $request->mobile;
              $supervisor->save();

              return response()->json([
                  "message" => "record updated successfully!"
              ], 200);
          }else{
              return response()->json([
                  "message" => "Supervisor not found!"
              ], 404);
          }
      }

      public function deleteSupervisor ($id) {
          if(Supervisor::where("idSupervisor", $id)->exists()){
              $supervisor = Supervisor::find($id);
              $supervisor->delete();

              return response()->json([
                  "message" => "record deleted!"
              ], 202);
          }else{
              return response()->json([
                  "message" => "Supervisor not found!"
              ], 404);
          }
      }

      public function getInfo(){
        $nationalities =  Supervisor::select('nationality')->distinct()->get()->whereNotNull('nationality')->pluck('nationality');
        $universities =  Supervisor::select('university')->distinct()->get()->whereNotNull('university')->pluck('university');
        $faculties =  Supervisor::select('faculty')->distinct()->get()->whereNotNull('faculty')->pluck('faculty');
        $specializations =  Supervisor::select('specialization')->distinct()->get()->whereNotNull('specialization')->pluck('specialization');

        return response()->json([
            "nationalities" => $nationalities,
            "universities" => $universities,
            "faculties" => $faculties,
            "specializations" => $specializations,
        ], 201);
      }

      public function filter(Request $request){
          $sup = Supervisor::query();

          if($request->filled('idDegreeF')){$sup->where('idDegreeF', $request->idDegreeF);}

          if($request->filled('specialization')){$sup->where('specialization', $request->specialization);}

          if($request->filled('department')){$sup->where('department', $request->department);}

          if($request->filled('faculty')){$sup->where('faculty', $request->faculty);}

          if($request->filled('university')){$sup->where('university', $request->university);}

          if($request->filled('nationality')){$sup->where('nationality', $request->nationality);}

          if($request->filled('gender')){$sup->where('gender', $request->gender);}

          return response()->json([
              "supervisors" => $sup->get()
          ], 201);
      }
      public function addsupervisour(Request $request)
      {

          for($i=0;$i<sizeof($request->supervisours);$i++)
          {

              $check=DB::table('registerationsupervisors')
              ->where('idRegistrationF','=', $request->idRegistration)
              ->where('idSupervisorF','=',$request->supervisours[$i]['idSupervisor'])->get();
              $register=Registration::find($request->idRegistration)->get()->last();
              if(empty($request->supervisours[$i]['cancelationDate']))
              {

                   $register->supervisors()->attach($request->supervisours[$i]['idSupervisor']);
                   $register->supervisors()->updateExistingPivot($request->supervisours[$i]['idSupervisor'],['registrationDate' => $request->supervisours[$i]['registrationDate'],'currentState' => $request->supervisours[$i]['currentState']]);

               }
               else
               {
                  $register->supervisors()->updateExistingPivot($request->supervisours[$i]['idSupervisor'],['cancelationDate' => $request->supervisours[$i]['cancelationDate']]);
               }


          }

      }
      public function deletesupervisorfromregister(Request $request,  $id)
      {

        $register=Registration::where('idRegistration',$request->idRegistration)->first();
        $register->supervisors()->detach($id);
      }

}
