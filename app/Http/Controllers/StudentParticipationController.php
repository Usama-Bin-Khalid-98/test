<?php

namespace App\Http\Controllers;

use App\StudentParticipation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Auth;

class StudentParticipationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    public function index()
    {
         try {
            $campus_id = Auth::user()->campus_id;
            $department_id = Auth::user()->department_id;
            $student_participation = StudentParticipation::where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get()->first();

        return view('registration.student_enrolment.student_participation',compact('student_participation'));
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
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {
            $uni_id = Auth::user()->campus_id;
            $dept_id = Auth::user()->department_id;
            StudentParticipation::updateOrCreate([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'summary' => $request->summary,
                'isComplete' => 'yes',
                'updated_by' => Auth::user()->id
            ]);

            return response()->json(['success' => ' Student Participation Inserted successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentParticipation  $studentParticipation
     * @return \Illuminate\Http\Response
     */
    public function show(StudentParticipation $studentParticipation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentParticipation  $studentParticipation
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentParticipation $studentParticipation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentParticipation  $studentParticipation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
           StudentParticipation::where('id', $id)->update([
                'summary' => $request->summary,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Student Participation updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentParticipation  $studentParticipation
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentParticipation $studentParticipation)
    {
        //
    }


    protected function rules() {
        return [
            'summary' => 'required'
        ];
    }
    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
