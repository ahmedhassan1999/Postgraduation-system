<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Universityposition;

class UniversityDegree extends Controller
{
    public function getAllPositions(){
        $pos = Universityposition::get()->toJson(JSON_PRETTY_PRINT);
        return response($pos, 200);
    }

    public function getPosition($id){
        if(Universityposition::where('idUniversityPosition', $id)->exists()){
            $pos = Universityposition::where('idUniversityPosition', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($pos, 200);
        }else{
            return response()->json([
                "message" => "university position not found!"
            ], 404);
        }
    }

    public function createPosition(Request $request){
        $pos = new Universityposition;
        $pos->arabicDegreeName = $request->arabicDegreeName;
        $pos->englishDegreeName = $request->englishDegreeName;
        $pos->save();

        return response()->json([
            "message" => "university position created successfully!"
        ], 201);
    }

    public function updatePosition(Request $request, $id){
        if(Universityposition::where('idUniversityPosition', $id)->exists()){
            $pos = Universityposition::find($id);
            $pos->arabicDegreeName = is_null($request->arabicDegreeName)? $pos->arabicDegreeName : $request->arabicDegreeName;
            $pos->englishDegreeName = is_null($request->englishDegreeName)? $pos->englishDegreeName : $request->englishDegreeName;
            $pos->save();

            return response()->json([
                "message" => "university position updated successfully!"
            ], 200);
        }else{
            return response()->json([
                "message" => "university position not found!"
            ], 404);
        }
    }

    public function deletePosition($id){
        if(Universityposition::where('idUniversityPosition', $id)->exists()){
            $pos = Universityposition::find($id);
            $pos->delete();

            return response()->json([
                "message" => "university position deleted successfully!"
            ], 202);
        }else{
            return response()->json([
                "message" => "university position not found!"
            ], 404);
        }
    }
}
