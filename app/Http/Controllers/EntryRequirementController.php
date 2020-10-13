<?php

namespace App\Http\Controllers;

use App\Models\StrategicManagement\EntryRequirement;
use App\Models\StrategicManagement\Scope;
use App\Models\Common\Slip;
use App\Models\Common\EligibilityCriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class EntryRequirementController extends Controller
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
        $scopes = Scope::with('program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        $criterias = EligibilityCriteria::where('status', 'active')->get();

        $entryRequirements  = EntryRequirement::with('campus','program','eligibility_criteria')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

         return view('registration.curriculum.entry_req', compact('scopes','criterias','entryRequirements'));

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
            $department_id = Auth::user()->department_id;
            $slip = Slip::where(['department_id'=> $department_id])->where('regStatus','SAR')->first();
            if($slip) {
                $type = 'SAR';
            }else {
                $type = 'REG';
            }
            $program_id = $request->program_id;
           // dd($program_id);
            for ($i = 0; $i<= count($request->all()); $i++) {
                //dd('value.....', $request->min_req[$i]);
                EntryRequirement::create([
                    'campus_id' => Auth::user()->campus_id,
                    'department_id' => Auth::user()->department_id,
                    'program_id' => $program_id,
                    'eligibility_criteria_id' => $request->eligibility_criteria_id[$i],
                    'min_req' => $request->min_req[$i],
                    'isComplete' => 'yes',
                    'type' => $type,
                    'created_by' => Auth::user()->id
                ]);
            }
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
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            EntryRequirement::where('id', $entryRequirement->id)->update([
                'program_id' => $request->program_id,
                'eligibility_criteria_id' => $request->eligibility_criteria_id,
                'min_req' => $request->min_req,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
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
            EntryRequirement::where('id', $entryRequirement->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
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



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
