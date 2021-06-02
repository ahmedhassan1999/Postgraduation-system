<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Previousstudie;

class PreviousstudieController extends Controller
{
    public function previousstudy(Request $request, $id)
    {
        $prev = new Previousstudie();
        $prev->idSF = $id;
        $prev->degree = $request->degree;
        $prev->faculty = $request->faculty;
        $prev->university = $request->university;
        $prev->dateObtained = $request->dateObtained;
        $prev->specialization = $request->specialization;
        $prev->save();
        return response()->json([
            $prev
        ], 201);
    }
   public function updatepreviousstudy(Request $request ,$id)
   {
    $prev = Previousstudie::where('id',$id)->first();
    $prev->degree=is_null($request->degree) ? $prev->degree : $request->degree;
    $prev->faculty=is_null($request->faculty) ? $prev->faculty : $request->faculty;
    $prev->university=is_null($request->university) ? $prev->university : $request->university;
    $prev->dateObtained=is_null($request->dateObtained) ? $prev->dateObtained : $request->dateObtained;
    $prev->specialization=is_null($request->specialization) ? $prev->specialization : $request->specialization;
    $prev->save();
    }
    public function deletepreviousstudy($id)
    {
        return Previousstudie::find($id)->delete();

    }
}
