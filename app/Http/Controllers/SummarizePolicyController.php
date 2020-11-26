<?php

namespace App\Http\Controllers;

use App\Models\StrategicManagement\SummarizePolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class SummarizePolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department_id = Auth::user()->department_id;
        $campus_id = Auth::user()->campus_id;
        $summary = SummarizePolicy::where(['campus_id'=> $campus_id,'department_id'=> $department_id])->first();
        return view('strategic_management.summarize_policy', compact('summary'));
        //
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
                SummarizePolicy::create([
                    'campus_id' => Auth::user()->campus_id,
                    'department_id' => Auth::user()->department_id,
                    'summary' => $request->summary,
                    'isComplete' => 'yes',
                    'created_by' => Auth::user()->id
                ]);

                return response()->json(['success' => 'Summarize policy added successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\SummarizePolicy  $summarizePolicy
     * @return \Illuminate\Http\Response
     */
    public function show(SummarizePolicy $summarizePolicy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\SummarizePolicy  $summarizePolicy
     * @return \Illuminate\Http\Response
     */
    public function edit(SummarizePolicy $summarizePolicy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\SummarizePolicy  $summarizePolicy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SummarizePolicy $summarizePolicy)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {
                SummarizePolicy::find($request->id)->update([
                    'campus_id' => Auth::user()->campus_id,
                    'department_id' => Auth::user()->department_id,
                    'summary' => $request->summary,
                    'isComplete' => 'yes',
                    'created_by' => Auth::user()->id
                ]);

                return response()->json(['success' => 'Summarize policy updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\SummarizePolicy  $summarizePolicy
     * @return \Illuminate\Http\Response
     */
    public function destroy(SummarizePolicy $summarizePolicy)
    {
        try {
            SummarizePolicy::destroy($summarizePolicy->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'summary' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.',
        ];
    }
}
