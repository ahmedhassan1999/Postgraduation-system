<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Referee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RefressMail;

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
        $refree->save();
        $last_refree = DB::table('referees')->orderBy('idRefereed', 'desc')->first();
        $form ="https://forms.office.com/Pages/ResponsePage.aspx?id=ZVH5axNBiEGbe8tsDBmKW-kPX0-Y8GNGh3ca7Z_4igRUOVJWUkJFNFhRQ0oxODRERFlJQVpZMDkzMC4u";
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
            $refree->mobile = is_null($request->mobile) ? $refree->mobile : $request->mobile;
            $refree->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 201);
        } else {
            return response()->json([
                "message" => "Student not found"
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
        $refree->save();

    }
    public function delete(Referee $referee)
    {
      //  return $referee->arabicName;
        $referee->delete();
    }
}
