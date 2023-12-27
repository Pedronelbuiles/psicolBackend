<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professors = Professor::all();
        return response()->json($professors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'document' => 'required|min:1|max:15',
            'name' => 'required|string|min:1|max:30',
            'last_name' => 'required|string|min:1|max:30',
            'phone' => 'required|min:1|max:20',
            'email' => 'required|email|min:1|max:30',
            'adress' => 'required|string|min:1|max:50',
            'city' => 'required|string|min:1|max:30'
        ];
        $validator = \Validator::make($request->input(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }
        $professor = new Professor($request->input());
        $professor->save();
        return response()->json([
            'status' => true,
            'message' => 'Professor created succesfully'
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Professor $professor)
    {
        return response()->json(['status' => true, 'data' => $professor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Professor $professor)
    {
        $rules = [
            'document' => 'required|string|min:1|max:15',
            'name' => 'required|string|min:1|max:30',
            'last_name' => 'required|string|min:1|max:30',
            'phone' => 'required|min:1|max:20',
            'email' => 'required|email|min:1|max:30',
            'adress' => 'required|string|min:1|max:50',
            'city' => 'required|string|min:1|max:30'
        ];
        $validator = \Validator::make($request->input(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }
        $professor->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Professor updated succesfully'
        ],200);        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professor $professor)
    {
        $professor->delete();
        return response()->json([
            'status' => true,
            'message' => 'Professor deleted succesfully'
        ],200);
    }

    public function ProfessorsSignatures()
    {
        $professors = Professor::with(['signatures'])
        ->get();
        return response()->json($professors);
    }
}
