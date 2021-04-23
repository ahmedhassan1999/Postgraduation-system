<?php

namespace App\Http\Controllers;
use App\Models\Studytype;
use Illuminate\Http\Request;

class AddStudyTypeController extends Controller
{
    public function addstudytype(Request $request)
    {
        if($request->isMethod('post'))
        {
          /*  $studyType =  new Studytype();

                                $studyType->arabicName = $request->arabicName;
                                $studyType->englishName = $request->input('englishName');
                                $studyType->universityCode = $request->input('universityCode');
                         //      $studyType->IdDeptF = $request->input('IdDeptF');
                                $studyType->save();
                                return response()->json([
                                    $studyType
                                ], 201);*/
                               /* if( $request->has('hascours') ){

                                }*/
        }

    }
}
