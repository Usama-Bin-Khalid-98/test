<?php

namespace App\Http\Controllers;

use App\StudentsGraduated;
use App\Models\Common\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class StudentsGraduatedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::where('status', 'active')->get();

        $students = StudentsGraduated::with('program')->get();

        return view('registration.student_enrolment.students_graduated', compact('programs','students'));
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
            StudentsGraduated::create([
                'campus_id' => $uni_id,
                'program_id' => $request->program_id,
                'grad_std_t' => $request->grad_std_t,
                'grad_std_t_2' => $request->grad_std_tt,
                'grad_std_t_3' => $request->grad_std_ttt
            ]);

            return response()->json(['success' => 'Student Graduated Inserted successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentsGraduated  $studentsGraduated
     * @return \Illuminate\Http\Response
     */
    public function show(StudentsGraduated $studentsGraduated)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentsGraduated  $studentsGraduated
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentsGraduated $studentsGraduated)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentsGraduated  $studentsGraduated
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentsGraduated $studentsGraduated)
    {
        $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            StudentsGraduated::where('id', $studentsGraduated->id)->update([
                'program_id' => $request->program_id,
                'grad_std_t' => $request->grad_std_t,
                'grad_std_t_2' => $request->grad_std_t_2,
                'grad_std_t_3' => $request->grad_std_t_3,
                'status' => $request->status,
            ]);
            return response()->json(['success' => 'Student Graduated updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentsGraduated  $studentsGraduated
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentsGraduated $studentsGraduated)
    {
        try {
            StudentsGraduated::destroy($studentsGraduated->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'program_id' => 'required',
            'grad_std_t' => 'required',
            'grad_std_tt' => 'required',
            'grad_std_ttt' => 'required'
        ];
    }

    protected function update_rules() {
        return [
            'program_id' => 'required',
            'grad_std_t' => 'required',
            'grad_std_t_2' => 'required',
            'grad_std_t_3' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
