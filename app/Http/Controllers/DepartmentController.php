<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function getAllDepartments(){
        $departments = Department::get()->toJson(JSON_PRETTY_PRINT);
        return response($departments, 201);
    }

    public function createDepartment(Request $request){
        $dept = new Department;
        $dept->arabicName = $request->arabicName;
        $dept->englishName = $request->englishName;
        $dept->save();

        return response()->json([
            "message" => "department record created successfully!"
        ], 201);
    }

    public function getDepartment($id){
        if(Department::where('idDept', $id)->exists()){
            $dept = Department::where('idDept', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($dept, 201);
        }else{
            return response()->json([
                "message" => "Department not found!"
            ], 404);
        }
    }

    public function updateDepartment(Request $request, $id){
        if(Department::where('idDept', $id)->exists()){
            $dept = Department::find($id);
            
            $dept->arabicName = is_null($request->arabicName) ? $dept->arabicName : $request->arabicName;
            $dept->englishName = is_null($request->englishName) ? $dept->englishName : $request->englishName;
            $dept->save();

            return response()->json([
                "message" => "record updated successfully"
            ], 200);
        }else{
            return response()->json([
                "message" => "department not found!"
            ], 404);
        }
    }

    public function deleteDepartment($id){
        if(Department::where('idDept', $id)->exists()){
            $dept = Department::find($id);
            $dept->delete();

            return response()->json([
                "message" => "record deleted successfully!"
            ], 202);
        }else{
            return response()->json([
                "message" => "department not found!"
            ], 404);
        }
    }
}
