<?php

namespace App\Http\Controllers;

use App\StudentGender;
use App\Models\Common\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class StudentGenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::get();
        $genders = StudentGender::get();

        return view('registration.student_enrolment.student_gender', compact('programs','genders'));
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
            StudentGender::create([
                'campus_id' => $uni_id,
                'program_id' => $request->program_id,
                'male' => $request->male,
                'female' => $request->female
            ]);

            return response()->json(['success' => 'Student Gender Inserted successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentGender  $studentGender
     * @return \Illuminate\Http\Response
     */
    public function show(StudentGender $studentGender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentGender  $studentGender
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentGender $studentGender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentGender  $studentGender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentGender $studentGender)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            StudentGender::where('id', $studentGender->id)->update([
                'program_id' => $request->program_id,
                'male' => $request->male,
                'female' => $request->female,
                'status' => $request->status,
            ]);
            return response()->json(['success' => 'Student Gender mix updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentGender  $studentGender
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentGender $studentGender)
    {
       try {
            studentGender::destroy($studentGender->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'program_id' => 'required',
            'male' => 'required',
            'female' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
