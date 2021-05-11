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
}
