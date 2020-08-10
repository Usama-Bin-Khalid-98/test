<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Faculty\FacultyStudentRatio;
use App\BusinessSchool;
use App\Models\Common\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class FacultyStudentRatioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businesses = BusinessSchool::where('status', 'active')->get();
        $programs = Program::where('status', 'active')->get();

        $ratios = FacultyStudentRatio::with('business_school','program')->get();

         return view('registration.faculty.faculty_student_ratio', compact('businesses','programs','ratios'));
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

            FacultyStudentRatio::create([
                'business_school_id' => $request->business_school_id,
                'program_id' => $request->program_id,
                'year' => $request->year,
                'total_enrollments' => $request->total_enrollments
            ]);

            return response()->json(['success' => 'Faculty Student Ratio added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacultyStudentRatio $facultyStudentRatio)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            FacultyStudentRatio::where('id', $facultyStudentRatio->id)->update([
               'business_school_id' => $request->business_school_id,
                'program_id' => $request->program_id,
                'year' => $request->year,
                'total_enrollments' => $request->total_enrollments,
                'status' => $request->status,
                'isCompleted' => $request->isCompleted
            ]);
            return response()->json(['success' => 'Faculty Student Ratio updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacultyStudentRatio $facultyStudentRatio)
    {
        try {
            FacultyStudentRatio::destroy($facultyStudentRatio->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'business_school_id' => 'required',
            'program_id' => 'required',
            'year' => 'required',
            'total_enrollments' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
