<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Referee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RefressMail;
use App\Models\Registration;

class RefereeController extends Controller
{
    public function show()
    {
        return  "refresssssssss";
    }
    public function createrefress(Request $request)
    {
        $refree=new Referee();
        $refree->arabicName=$request->arabicName;
        $refree->email=$request->email;
        $refree->idDegreeF=$request->idDegreeF;
        $refree->save();
        $last_refree = DB::table('referees')->orderBy('idRefereed', 'desc')->first();
        $form ="https://forms.office.com/r/fZrCTgEihd";
        Mail::to($last_refree->email)->send(new RefressMail($last_refree->arabicName,$form,$last_refree->idRefereed));
        return "done";
    }
    public function update(Request $request, $id)
    {
        if (Referee::where('idRefereed', $id)->exists()) {
            $refree = Referee::find($id);
            $refree->englishName = is_null($request->englishName) ? $refree->englishName : $request->englishName;
            $refree->position = is_null($request->position) ? $refree->position : $request->position;
            $refree->university = is_null($request->university) ? $refree->university : $request->university;
            $refree->faculty = is_null($request->faculty) ? $refree->faculty : $request->faculty;
            $refree->department = is_null($request->department) ? $refree->department : $request->department;
            $refree->nationality = is_null($request->nationality) ? $refree->nationality : $request->nationality;
            $refree->specialization = is_null($request->specialization) ? $refree->specialization : $request->specialization;
            $refree->nationalityId = is_null($request->nationalityId) ? $refree->nationalityId : $request->nationalityId;
            $refree->gender = is_null($request->gender) ? $refree->gender : $request->gender;
            $refree->email = is_null($request->email)? $refree->email : $request->email;
            $refree->mobile = is_null($request->mobile) ? $refree->mobile : $request->mobile;
            $refree->idDegreeF = is_null($request->idDegreeF) ? $refree->idDegreeF : $request->idDegreeF;

            $refree->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 201);
        } else {
            return response()->json([
                "message" => "record not found"
            ], 404);
        }
    }
    public function insert(Request $request)
    {
        $refree = new  Referee();
        $refree->arabicName=$request->arabicName;
        $refree->email=$request->email;
        $refree->englishName =  $request->englishName;
        $refree->position =  $request->position;
        $refree->university =  $request->university;
        $refree->faculty =  $request->faculty;
        $refree->department =  $request->department;
        $refree->nationality =  $request->nationality;
        $refree->specialization =  $request->specialization;
        $refree->nationalityId =$request->nationalityId;
        $refree->gender = $request->gender;
        $refree->mobile = $request->mobile;
        $refree->idDegreeF = $request->idDegreeF;
        $refree->save();

    }
    public function delete(Referee $referee)
    {
      //  return $referee->arabicName;
        $referee->delete();
    }

    public function get()
    {
      $nationalities =  Referee::select('nationality')->distinct()->get()->whereNotNull('nationality')->pluck('nationality');
        $universities =  Referee::select('university')->distinct()->get()->whereNotNull('university')->pluck('university');
        $faculties =  Referee::select('faculty')->distinct()->get()->whereNotNull('faculty')->pluck('faculty');
        $specializations =  Referee::select('specialization')->distinct()->get()->whereNotNull('specialization')->pluck('specialization');
        $positions =  Referee::select('position')->distinct()->get()->whereNotNull('position')->pluck('position');


        return response()->json([
            "nationalities" => $nationalities,
            "universities" => $universities,
            "faculties" => $faculties,
            "specializations" => $specializations,
            "positions" => $positions,
        ], 201);
    }

    public function getreferees()
    {
        $referees = Referee::get()->toJson(JSON_PRETTY_PRINT);
        return response($referees, 201);
    }

    public function filter(Request $request){
          $sup = Referee::query();

          if($request->filled('idDegreeF')){$sup->where('idDegreeF', $request->idDegreeF);}

          if($request->filled('specialization')){$sup->where('specialization', $request->specialization);}

          if($request->filled('department')){$sup->where('department', $request->department);}

          if($request->filled('faculty')){$sup->where('faculty', $request->faculty);}

          if($request->filled('university')){$sup->where('university', $request->university);}

          if($request->filled('nationality')){$sup->where('nationality', $request->nationality);}

          if($request->filled('gender')){$sup->where('gender', $request->gender);}

          if($request->filled('position')){$sup->where('position', $request->position);}

          return response()->json([
              "referees" => $sup->get()
          ], 201);
      }
      public function deleterefreefromregister($id)
      {
        session_start();
        $register=Registration::where('idRegistration',$_SESSION['id_registration'])->first();
        $register->refress()->detach($id);
      }
}
