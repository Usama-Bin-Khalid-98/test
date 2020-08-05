<?php

namespace App\Http\Controllers;

use App\NbeacCriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Auth;

class NbeacCriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          try {
            $nbeac_criteria = NbeacCriteria::get()->first();

         return view('nbeac_criteria.index',compact('nbeac_criteria'));
        }catch (\Exception $e) {
            return $e->getMessage();
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NbeacCriteria  $nbeacCriteria
     * @return \Illuminate\Http\Response
     */
    public function show(NbeacCriteria $nbeacCriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NbeacCriteria  $nbeacCriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(NbeacCriteria $nbeacCriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NbeacCriteria  $nbeacCriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        try {
            //$update = BasicInfo::find($basicInfo->id);
            $validation= Validator::make($request->all(), $this->rules(), $this->messages());
            if($validation->fails())
            {
                return response()->json($validation->messages()->all(), 422);
            }else {

                $update = NbeacCriteria::where('id', $id)
                          ->update(
                              [
                                  'campus_id' => Auth::user()->campus_id,
                                  'program_started' => $request->program_started,
                                  'mission_vision_statement' => $request->mission_vision_statement,
                                  'strategic_plan' => $request->strategic_plan,
                                  'student_intake' => $request->student_intake,
                                  'student_enrollment' => $request->student_enrollment,
                                  'course_load' => $request->course_load,
                                  'research_output' => $request->research_output,
                                  'bandwidth' => $request->bandwidth,
                                  'std_comp_ratio' => $request->std_comp_ratio,
                                  'updated_by' => Auth::user()->id

                                  ]
                          );
                

                return response()->json(['success' => 'Nbeac Criteria Updated successfully.']);
            }
        }catch (Exception $e)
        {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NbeacCriteria  $nbeacCriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(NbeacCriteria $nbeacCriteria)
    {
        //
    }

    protected function rules() {
        return [
            'program_started' => 'required',
            'mission_vision_statement' => 'required',
            'strategic_plan' => 'required',
            'student_intake' => 'required',
            'student_enrollment' => 'required',
            'course_load' => 'required',
            'research_output' => 'required',
            'bandwidth' => 'required',
            'std_comp_ratio' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
