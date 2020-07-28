<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Faculty\FacultyTeachingCourses;
use App\BusinessSchool;
use App\Models\Common\Designation;
use App\LookupFacultyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;


class FacultyTeachingCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $designations = Designation::get();
         $faculty_types = LookupFacultyType::get();

         $visitings = FacultyTeachingCourses::with('business_school','lookup_faculty_type','designation')->get();

         return view('registration.faculty.faculty_teaching_courses', compact('designations','faculty_types','visitings'));
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

            FacultyTeachingCources::create([
                'business_school_id' => Auth::user()->business_school_id,
                'lookup_faculty_type_id' => $request->lookup_faculty_type_id,
                'designation_id' => $request->designation_id,
                'max_cources_allowed' => $request->max_cources_allowed,
                'tc_program1' => $request->tc_program1,
                'tc_program2' => $request->tc_program2
            ]);

            return response()->json(['success' => 'Visiting Faculty added successfully.']);


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
    public function update(Request $request, FacultyTeachingCources $facultyTeaching)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            FacultyTeachingCources::where('id', $facultyTeaching->id)->update([
                'lookup_faculty_type_id' => $request->lookup_faculty_type_id,
                'designation_id' => $request->designation_id,
                'max_cources_allowed' => $request->max_cources_allowed,
                'tc_program1' => $request->tc_program1,
                'tc_program2' => $request->tc_program2,
                'status' => $request->status,
                'isCompleted' => $request->isCompleted
            ]);
            return response()->json(['success' => 'Visiting Faculty updated successfully.']);

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
    public function destroy(FacultyTeachingCources $facultyTeaching)
    {
         try {
            FacultyTeachingCources::destroy($facultyTeaching->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'lookup_faculty_type_id' => 'required',
            'designation_id' => 'required',
            'max_cources_allowed' => 'required',
            'tc_program1' => 'required',
            'tc_program2' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}