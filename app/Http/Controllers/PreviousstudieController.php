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
    }
   
}
