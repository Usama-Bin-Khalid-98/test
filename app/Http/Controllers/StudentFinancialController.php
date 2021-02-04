<?php

namespace App\Http\Controllers;

use App\Models\Common\StrategicManagement\BusinessSchoolTyear;
use App\StudentFinancial;
use Illuminate\Http\Request;
use App\Models\StrategicManagement\Scope;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class StudentFinancialController extends Controller
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
        $programs = Scope::with('program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        $students = StudentFinancial::with('campus','program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        $tyear = BusinessSchoolTyear::where(
            [
                'campus_id'=>$campus_id,
                'department_id'=>$department_id
            ])->get()->first();
        return view('registration.student_enrolment.student_financial', compact('programs','students', 'tyear'));
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
            StudentFinancial::create([
                'campus_id' => $uni_id,
                'department_id' => $dept_id,
                'program_id' => $request->program_id,
                'year' => $request->year,
                'enrolment' => $request->enrolment,
                'tution' => $request->tution,
                'merit' => $request->merit,
                'need' => $request->need,
                'other' => $request->other,
                'total' => $request->total,
                'isComplete' => 'yes',
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => ' Record Inserted successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentFinancial  $studentFinancial
     * @return \Illuminate\Http\Response
     */
    public function show(StudentFinancial $studentFinancial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentFinancial  $studentFinancial
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentFinancial $studentFinancial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentFinancial  $studentFinancial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentFinancial $studentFinancial)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            StudentFinancial::where('id', $studentFinancial->id)->update([
                'program_id' => $request->program_id,
                'year' => $request->year,
                'enrolment' => $request->enrolment,
                'tution' => $request->tution,
                'merit' => $request->merit,
                'need' => $request->need,
                'other' => $request->other,
                'total' => $request->total,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Record updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentFinancial  $studentFinancial
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentFinancial $studentFinancial)
    {
        try {
            StudentFinancial::where('id', $studentFinancial->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            StudentFinancial::destroy($studentFinancial->id);
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
            'enrolment' => 'required',
            'tution' => 'required',
            'merit' => 'required',
            'need' => 'required',
            'other' => 'required',
            'total' => 'required',
        ];
    }


    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
