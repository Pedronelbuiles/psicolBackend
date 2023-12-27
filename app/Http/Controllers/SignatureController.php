<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use App\Models\Professor;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $signature = Signature::all();
        return response()->json($signature);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|',
            'description' => 'required|string|min:1|max:400',
            'credits' => 'required|numeric',
            'knowledge_area' => 'required|string|min:1|max:30',
            'is_required' => 'required|boolean'
        ];
        $validator = \Validator::make($request->input(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }
        $signature = new Signature($request->input());
        $signature->save();
        return response()->json([
            'status' => true,
            'message' => 'Signature created succesfully'
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Signature $signature)
    {
        return response()->json(['status' => true, 'data' => $signature]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Signature $signature)
    {
        $rules = [
            'name' => 'required|string|',
            'description' => 'required|string|min:1|max:400',
            'credits' => 'required|numeric',
            'knowledge_area' => 'required|string|min:1|max:30',
            'is_required' => 'required|boolean'
        ];
        $validator = \Validator::make($request->input(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }
        $signature->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Signature updated succesfully'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Signature $signature)
    {
        $signature->delete();
        return response()->json([
            'status' => true,
            'message' => 'Professor deleted succesfully'
        ],200);
    }

    public function SignatureStudentsAndProfessors()
    {
        $signatures = Signature::with(['students', 'professors'])
        ->get();
        return response()->json($signatures);
    }
}
