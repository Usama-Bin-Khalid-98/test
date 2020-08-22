<?php

namespace App\Http\Controllers;

use App\Models\Research\ResearchOutput;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class ResearchOutputController extends Controller
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
        $conferences  = ResearchOutput::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

         return view('registration.research_summary.research_output', compact('conferences'));
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

            ResearchOutput::create([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'research' => $request->research,
                'description' => $request->description,
                'isComplete' => 'yes',
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => ' Research Output added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Research\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchOutput $researchOutput)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Research\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchOutput $researchOutput)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Research\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResearchOutput $researchOutput)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            ResearchOutput::where('id', $researchOutput->id)->update([
                'research' => $request->research,
                'description' => $request->description,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => ' Research Output updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Research\ResearchOutput  $researchOutput
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchOutput $researchOutput)
    {
        try {
        ResearchOutput::where('id', $researchOutput->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
        ResearchOutput::destroy($researchOutput->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }


    protected function rules() {
        return [
            'research' => 'required',
            'description' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
