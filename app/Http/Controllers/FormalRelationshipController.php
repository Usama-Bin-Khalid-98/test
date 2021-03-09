<?php

namespace App\Http\Controllers;

use App\Models\social_responsibility\FormalRelationship;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class FormalRelationshipController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }


    public function index()
    {
        $campus_id = Auth::user()->campus_id;
        $department_id = Auth::user()->department_id;
        $relationships = FormalRelationship::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        ///dd($contacts);
        return view('social_responsibility.formal_relationship', compact('relationships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {

            FormalRelationship::create([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'org_name' => $request->org_name,
                'mou_title' => $request->mou_title,
                'signing_mou_date' => $request->signing_mou_date,
                'last_activity_date' => $request->last_activity_date,
                'last_activity_desc' => $request->last_activity_desc,
                'isComplete' => 'yes',
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Formal Relationship added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\social_responsibility\FormalRelationship  $formalRelationship
     * @return \Illuminate\Http\Response
     */
    public function show(FormalRelationship $formalRelationship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\social_responsibility\FormalRelationship  $formalRelationship
     * @return \Illuminate\Http\Response
     */
    public function edit(FormalRelationship $formalRelationship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\social_responsibility\FormalRelationship  $formalRelationship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormalRelationship $formalRelationship)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            FormalRelationship::where('id', $formalRelationship->id)->update([
                'org_name' => $request->org_name,
                'mou_title' => $request->mou_title,
                'signing_mou_date' => $request->signing_mou_date,
                'last_activity_date' => $request->last_activity_date,
                'last_activity_desc' => $request->last_activity_desc,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Formal Relationship updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\social_responsibility\FormalRelationship  $formalRelationship
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormalRelationship $formalRelationship)
    {
        try {
            FormalRelationship::where('id', $formalRelationship->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
           FormalRelationship::destroy($formalRelationship->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'org_name' => 'required',
            'mou_title' => 'required',
            'signing_mou_date' => 'required',
            'last_activity_date' => 'required',
            'last_activity_desc' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
