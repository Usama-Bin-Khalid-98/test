<?php

namespace App\Http\Controllers;

use App\Models\StrategicManagement\EntryRequirement;
use App\Models\Common\Program;
use App\Models\Common\EligibilityCriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class EntryRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::where('status', 'active')->get();
        $criterias = EligibilityCriteria::where('status', 'active')->get();

        $entryRequirements  = EntryRequirement::with('program','eligibility_criteria')->get();

         return view('registration.curriculum.entry_req', compact('programs','criterias','entryRequirements'));
        
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

            EntryRequirement::create([
                'program_id' => $request->program_id,
                'eligibility_criteria_id' => $request->eligibility_criteria_id,
                'min_req' => $request->min_req
            ]);

            return response()->json(['success' => 'Entry Requirement added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\EntryRequirement  $entryRequirement
     * @return \Illuminate\Http\Response
     */
    public function show(EntryRequirement $entryRequirement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\EntryRequirement  $entryRequirement
     * @return \Illuminate\Http\Response
     */
    public function edit(EntryRequirement $entryRequirement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\EntryRequirement  $entryRequirement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntryRequirement $entryRequirement)
    {
        $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            EntryRequirement::where('id', $entryRequirement->id)->update([
                'program_id' => $request->program_id,
                'eligibility_criteria_id' => $request->eligibility_criteria_id,
                'status' => $request->status
            ]);
            return response()->json(['success' => 'Entry Requirements updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\EntryRequirement  $entryRequirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntryRequirement $entryRequirement)
    {
        try {
            EntryRequirement::destroy($entryRequirement->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }


    protected function rules() {
        return [
            'program_id' => 'required',
            'eligibility_criteria_id' => 'required',
            'min_req' => 'required'
        ];
    }

     protected function update_rules() {
        return [
            'program_id' => 'required',
            'eligibility_criteria_id' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
