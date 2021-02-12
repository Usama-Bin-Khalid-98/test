<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Common\Semester;
use App\Models\Common\Degree;
use App\Models\Common\CourseType;
use App\Models\Faculty\FacultyDetailedInfo;
use App\LookupFacultyType;
use App\Models\Common\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Auth;
use PragmaRX\Countries\Package\Countries;

class FacultyDetailedInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    public function index()
    {
        $countries = Countries::all();
        $campus_id = Auth::user()->campus_id;
        $department_id = Auth::user()->department_id;
         $designations = Designation::all();
         $faculty_types = LookupFacultyType::all();
         $degrees = Degree::all();
         $courses = CourseType::all();

         $workloads = FacultyDetailedInfo::with('campus','designation','degree','lookup_faculty_type','course_type')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

         return view('registration.faculty.faculty_detailed_info', compact('countries','designations','faculty_types','degrees','courses','workloads'));
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

            FacultyDetailedInfo::create([
                'designation_id' => $request->designation_id,
                'lookup_faculty_type_id' => $request->lookup_faculty_type_id,
                'course_type_id' => $request->course_type_id,
                'degree_id' => $request->degree_id,
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'awarding_institute' => $request->awarding_institute,
                'country' => $request->country,
                'name' => $request->name,
                'cnic' => $request->cnic,
                'hec_experience' => $request->hec_experience,
                'current_job_duration' => $request->current_job_duration,
                'specialization' => $request->current_job_duration,
                'industry' => $request->current_job_duration,
                'isComplete' => 'yes',
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Record added successfully.']);


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
    public function update(Request $request, $id)
    {
         $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            FacultyDetailedInfo::where('id', $id)->update([
                'designation_id' => $request->designation_id,
                'lookup_faculty_type_id' => $request->lookup_faculty_type_id,
                'course_type_id' => $request->course_type_id,
                'degree_id' => $request->degree_id,
                'awarding_institute' => $request->awarding_institute,
                'country' => $request->country,
                'name' => $request->name,
                'cnic' => $request->cnic,
                'hec_experience' => $request->hec_experience,
                'current_job_duration' => $request->current_job_duration,
                'specialization' => $request->current_job_duration,
                'industry' => $request->current_job_duration,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         try {
        FacultyDetailedInfo::where('id', $id)->update([
               'deleted_by' => Auth::user()->id
           ]);
        FacultyDetailedInfo::destroy($id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'name' => 'required',
            'cnic' => 'required',
            'designation_id' => 'required',
            'lookup_faculty_type_id' => 'required',
            'degree_id' => 'required',
            'awarding_institute' => 'required',
            'course_type_id' => 'required',
            'hec_experience' => 'required',
            'current_job_duration' => 'required',
            'country' => 'required',
            'specialization' => 'required',
            'industry' => 'required',
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
