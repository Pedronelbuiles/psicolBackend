<?php

namespace App\Http\Controllers;

use App\Models\Student;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'document' => 'required|string|min:1|max:15',
            'name' => 'required|string|min:1|max:30',
            'last_name' => 'required|string|min:1|max:30',
            'phone' => 'required|min:1|max:20',
            'email' => 'required|email|min:1|max:30',
            'adress' => 'required|string|min:1|max:50',
            'city' => 'required|string|min:1|max:30',
            'semester' => 'required|numeric'
        ];
        $validator = \Validator::make($request->input(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }
        $students = new Student($request->input());
        $students->save();
        return response()->json([
            'status' => true,
            'message' => 'Student created succesfully'
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return response()->json(['status' => true, 'data' => $student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $rules = [
            'document' => 'required|string|min:1|max:15',
            'name' => 'required|string|min:1|max:30',
            'last_name' => 'required|string|min:1|max:30',
            'phone' => 'required|min:1|max:20',
            'email' => 'required|email|min:1|max:30',
            'adress' => 'required|string|min:1|max:50',
            'city' => 'required|string|min:1|max:30',
            'semester' => 'required|numeric'
        ];
        $validator = \Validator::make($request->input(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }
        $student->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Student updated succesfully'
        ],200);        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json([
            'status' => true,
            'message' => 'Student deleted succesfully'
        ],200);
    }

    public function StudentsSignatures()
    {
        $students = Students::with(['signatures'])
        ->get();
        return response()->json($students);
    }
}
