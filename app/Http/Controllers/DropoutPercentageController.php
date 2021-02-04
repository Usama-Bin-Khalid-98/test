<?php

namespace App\Http\Controllers;

use App\DropoutPercentage;
use App\Models\Common\StrategicManagement\BusinessSchoolTyear;
use Illuminate\Http\Request;
use App\Models\StrategicManagement\Scope;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class DropoutPercentageController extends Controller
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
        $tyear = BusinessSchoolTyear::where(
            [
                'campus_id'=>$campus_id,
                'department_id'=>$department_id
            ])->get()->first();
        $programs = Scope::with('program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        $students = DropoutPercentage::with('campus','program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        return view('registration.student_enrolment.dropout_percentage', compact('programs','students', 'tyear'));
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
            $uni_id = Auth::user()->campus_id;
            $dept_id = Auth::user()->department_id;
            DropoutPercentage::create([
                'campus_id' => $uni_id,
                'department_id' => $dept_id,
                'program_id' => $request->program_id,
                'year' => $request->year,
                'intake' => $request->intake,
                'academic_reason' => $request->academic_reason,
                'other_reason' => $request->other_reason,
                'pass' => $request->pass,
                'pending' => $request->pending,
                'isComplete' => 'yes',
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Dropout Percentage Inserted successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DropoutPercentage  $dropoutPercentage
     * @return \Illuminate\Http\Response
     */
    public function show(DropoutPercentage $dropoutPercentage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DropoutPercentage  $dropoutPercentage
     * @return \Illuminate\Http\Response
     */
    public function edit(DropoutPercentage $dropoutPercentage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DropoutPercentage  $dropoutPercentage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DropoutPercentage $dropoutPercentage)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            DropoutPercentage::where('id', $dropoutPercentage->id)->update([
                'program_id' => $request->program_id,
                'year' => $request->year,
                'intake' => $request->intake,
                'academic_reason' => $request->academic_reason,
                'other_reason' => $request->other_reason,
                'pass' => $request->pass,
                'pending' => $request->pending,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Dropout Percentage updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DropoutPercentage  $dropoutPercentage
     * @return \Illuminate\Http\Response
     */
    public function destroy(DropoutPercentage $dropoutPercentage)
    {
        try {
            DropoutPercentage::where('id', $dropoutPercentage->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            DropoutPercentage::destroy($dropoutPercentage->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'program_id' => 'required',
            'year' => 'required',
            'intake' => 'required',
            'academic_reason' => 'required',
            'other_reason' => 'required',
            'pass' => 'required',
            'pending' => 'required',
        ];
    }


    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
