<?php

namespace App\Http\Controllers;

use App\Models\StrategicManagement\StudentEnrolment;
use App\BusinessSchool;
use App\Models\Common\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class StudentEnrolmentController extends Controller
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
        $programs = Program::where('status', 'active')->get();
        $bs = StudentEnrolment::where(['campus_id'=> $campus_id,'department_id'=> $department_id,'status' => 'active'])->get()->sum('bs_level');
        $ms = StudentEnrolment::where(['campus_id'=> $campus_id,'department_id'=> $department_id,'status' => 'active'])->get()->sum('ms_level');
        $phd = StudentEnrolment::where(['campus_id'=> $campus_id,'department_id'=> $department_id,'status' => 'active'])->get()->sum('phd_level');
        $t_students = StudentEnrolment::where(['campus_id'=> $campus_id,'department_id'=> $department_id,'status' => 'active'])->get()->sum('total_students');
        $enrolments = StudentEnrolment::with('campus','program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

         return view('registration.student_enrolment.enrolment', compact('programs','enrolments','bs','ms','phd','t_students'));
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
            StudentEnrolment::create([
                'campus_id' => $uni_id,
                'department_id' => $dept_id,
                'year' => $request->year,
                'bs_level' => $request->bs_level,
                'ms_level' => $request->ms_level,
                'phd_level' => $request->phd_level,
                'total_students' => $request->bs_level+ $request->ms_level+$request->phd_level,
                'isComplete' => 'yes',
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Student enrolment added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\StudentEnrolment  $studentEnrolment
     * @return \Illuminate\Http\Response
     */
    public function show(StudentEnrolment $studentEnrolment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\StudentEnrolment  $studentEnrolment
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentEnrolment $studentEnrolment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\StudentEnrolment  $studentEnrolment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentEnrolment $studentEnrolment)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            StudentEnrolment::where('id', $studentEnrolment->id)->update([
                'year' => $request->year,
                'bs_level' => $request->bs_level,
                'ms_level' => $request->ms_level,
                'phd_level' => $request->phd_level,
                'total_students' =>  $request->bs_level+ $request->ms_level+$request->phd_level,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Student Enrolement updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\StudentEnrolment  $studentEnrolment
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentEnrolment $studentEnrolment)
    {
        try {
            StudentEnrolment::where('id', $studentEnrolment->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            StudentEnrolment::destroy($studentEnrolment->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'year' => 'required',
            'bs_level' => 'required',
            'ms_level' => 'required',
            'phd_level' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
