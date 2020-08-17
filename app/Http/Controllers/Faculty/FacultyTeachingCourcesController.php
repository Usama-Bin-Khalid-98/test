<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Faculty\FacultyTeachingCources;
use App\BusinessSchool;
use App\Models\Common\Designation;
use App\LookupFacultyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;


class FacultyTeachingCourcesController extends Controller
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
         $designations = Designation::get();
         $faculty_types = LookupFacultyType::get();
         $visitings = FacultyTeachingCources::with('campus','lookup_faculty_type','designation')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

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
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'lookup_faculty_type_id' => $request->lookup_faculty_type_id,
                'designation_id' => $request->designation_id,
                'max_cources_allowed' => $request->max_cources_allowed,
                'tc_program1' => $request->tc_program1,
                'tc_program2' => $request->tc_program2,
                'isCompleted' => 'yes',
                'created_by' => Auth::user()->id
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
                'updated_by' => Auth::user()->id
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
              FacultyTeachingCources::where('id', $facultyTeaching->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
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
