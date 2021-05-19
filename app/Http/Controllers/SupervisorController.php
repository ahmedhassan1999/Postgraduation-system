<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supervisor;
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
        $form = " form link";

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
}