<?php

namespace App\Http\Controllers;
use App\Models\Studytype;
use App\Models\Course;
use App\Models\Department;
use App\Models\Personaldatastudent;
use Database\Factories\StudyTypeFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class StudyTypeController extends Controller
{

    public function updatestadytype(Request $request,$id)
    {
        if (Studytype::where('idStudyType', $id)->exists()) {
            $studytype = Studytype::find($id);
            $studytype->arabicName = is_null($request->arabicName) ? $studytype->arabicName : $request->arabicName;
            $studytype->englishName = is_null($request->englishName) ? $studytype->englishName : $request->englishName;
            $studytype->universityCode = is_null($request->universityCode) ? $studytype->universityCode : $request->universityCode;
            $studytype->type = is_null($request->type) ? $studytype->type : $request->type;
            if($request->depart)
            {
                $depart_id=Department::select('idDept')->where('arabicName',$request->depart)->first();
                $studytype->IdDeptF =$depart_id->idDept;
            }
            $studytype->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);

        }

    }
    public function getallstudytype()
    {
        return StudyType::all();
    }
    public function delete(Studytype $studytype)
    {

        $courses = Course::where('idStudyTypeF', '=', $studytype->idStudyType)->get();
        return $courses;

        if(count($courses)!=0)
        {
            foreach($courses as $course)
             $course->delete();
        }

        $studytype->delete();



    }

    public function addstudytype(Request $request)
    {
        if($request->isMethod('post'))
        {
          /*  $this->validate($request,
                                [ 'arabicName'=>'required|unique:Studytypes',
                                  'englishName'=>'required|unique:Studytypes',
                                  'universityCode'=>'unique:Studytypes',
                                ]);*/

            $studyType =  new Studytype();

             $studyType->arabicName = $request->arabicName;
             $studyType->englishName = $request->englishName;
            $studyType->universityCode = $request->universityCode;
            $studyType->type = $request->type;
         $depart_id=Department::select('idDept')->where('arabicName',$request->depart)->first();
             $studyType->IdDeptF =$depart_id->idDept;
             $studyType->save();
          /*   return response()->json([
                $studyType
            ], 201);*/

            if( $request->has('hascourses') ){
                $studytype= DB::table('studytypes')->orderBy('idStudyType', 'desc')->first();
               $studytype_id= $studytype->idStudyType;
               for($i=1;$i<8;$i++){
                if( empty($request->input('arabicNameSubj'.$i)))
                break;
               /* $this->validate($request,
                [ 'arabicNameSubj'.$i=>'required',
                'englishNameSubj'.$i=>'required',
                'codeSubj'.$i=>'required',
                'maxDegSubj'.$i=>'required',
                'creditHours'.$i=>'required',

                ]);*/
                $course =  new Course();
                $course->arabicName  = $request->input('arabicNameSubj'.$i);
                $course->englishName = $request->input('englishNameSubj'.$i);
                $course->courseCode = $request->input('codeSubj'.$i);
                $course->idStudyTypeF =$studytype_id;
                $course->maxGrade = $request->input('maxDegSubj'.$i);
                $course->creditHours=$request->input('creditHours'.$i);
                $course->save();


               }

            }


        }

    }
}
