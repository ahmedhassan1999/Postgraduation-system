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

    public function addcourses($id,Request $request)
    {
        for($i=0;$i<sizeof($request->courses);$i++)
        {
            $course= new  Course();
            $course->arabicName =  $request->courses[$i]['arNameOfCourse'];
            $course->englishName =  $request->courses[$i]['enNameOfCourse'];
            $course->courseCode =  $request->courses[$i]['courseCode'];
            $course->maxGrade =  $request->courses[$i]['maxDegreeOfCourse'];
            $course->creditHours =  $request->courses[$i]['creditHours'];
            $course->idStudyTypeF=$id;
            $course->save();

        }


    }
    public function updatecourses(Request $request)
    {
       for($i=0;$i<sizeof($request->courses);$i++)
       {
        if(Course::where('idCourse',$request->courses[$i]['idCourse'])->exists())
        {
            $course=Course::find($request->courses[$i]['idCourse']);
            $course->arabicName = is_null($request->courses[$i]['arNameOfCourse']) ? $course->arabicName : $request->courses[$i]['arNameOfCourse'];
            $course->englishName = is_null($request->courses[$i]['enNameOfCourse']) ? $course->englishName : $request->courses[$i]['enNameOfCourse'];
            $course->courseCode = is_null($request->courses[$i]['courseCode']) ? $course->courseCode : $request->courses[$i]['courseCode'];
            $course->maxGrade = is_null($request->courses[$i]['maxDegreeOfCourse']) ? $course->maxGrade : $request->courses[$i]['maxDegreeOfCourse'];
            $course->creditHours = is_null($request->courses[$i]['creditHours']) ? $course->creditHours : $request->courses[$i]['creditHours'];
            $course->save();
        }


       }

    }

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
    public function getallcourses($id)
    {
        $courses = Course::where('idStudyTypeF', '=', $id)->get();
        if(count($courses)!=0)
        return $courses;
        else
        return "not have any course";

    }
    public function getallstudytype()
    {

        $all_study=StudyType::all();
        return $all_study;


    }
    public function deletestudytype($id)
    {

        $courses = Course::where('idStudyTypeF', '=', $id)->get();
       // return $courses;

        if(count($courses)!=0)
        {
            foreach($courses as $course)
             $course->delete();
        }
        StudyType::where('idStudyType',$id)->delete();





    }
    public function deletecourse($id)
    {
        Course::where('idCourse',$id)->delete();
    }

    public function addstudytype(Request $request)
    {
        if($request->isMethod('post'))
        {

          

            $studyType =  new Studytype();

             $studyType->arabicName = $request->arabicName;
             $studyType->englishName = $request->englishName;
            $studyType->universityCode = $request->academicCode;
            $studyType->type = $request->studyType;
         $depart_id=Department::select('idDept')->where('arabicName',$request->department)->first();
             $studyType->IdDeptF =$depart_id->idDept;

             $studyType->save();

               $studytype= DB::table('studytypes')->orderBy('idStudyType', 'desc')->first();
                for($i=0;$i<sizeof($request->courses);$i++)

                {


                    $course =  new Course();
                    $course->arabicName =$request->courses[$i]['arNameOfCourse'];
                   $course->englishName = $request->courses[$i]['enNameOfCourse'];
                   $course->courseCode = $request->courses[$i]['courseCode'];
                   $course->idStudyTypeF =$studytype->idStudyType;

                   $course->maxGrade = $request->courses[$i]['maxDegreeOfCourse'];
                   $course->creditHours =$request->courses[$i]['creditHours'];
                   $course->save();




                }






        }

    }
}
