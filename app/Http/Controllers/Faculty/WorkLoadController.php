<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Faculty\WorkLoad;
use App\BusinessSchool;
use App\LookupFacultyDesignation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class WorkLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $businesses = BusinessSchool::where('status', 'active')->get();
         $designations = LookupFacultyDesignation::get();

         $workloads = WorkLoad::with('business_school','lookup_faculty_designation')->get();

         return view('registration.faculty.workload', compact('businesses','designations','workloads'));
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

            WorkLoad::create([
                'business_school_id' => $request->business_school_id,
                'faculty_name' => $request->faculty_name,
                'lookup_faculty_designation_id' => $request->lookup_faculty_designation_id,
                'total_courses' => $request->total_courses,
                'phd' => $request->phd,
                'masters' => $request->masters,
                'bachelors' => $request->bachelors,
                'admin_responsibilities' => $request->admin_responsibilities,
                'year' => $request->year
            ]);

            return response()->json(['success' => 'Faculty WorkLoad added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faculty\WorkLoad  $workLoad
     * @return \Illuminate\Http\Response
     */
    public function show(WorkLoad $workLoad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faculty\WorkLoad  $workLoad
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkLoad $workLoad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faculty\WorkLoad  $workLoad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkLoad $workLoad)
    {
        $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            WorkLoad::where('id', $workLoad->id)->update([
                'business_school_id' => $request->business_school_id,
                'faculty_name' => $request->faculty_name,
                'lookup_faculty_designation_id' => $request->lookup_faculty_designation_id,
                'total_courses' => $request->total_courses,
                'phd' => $request->phd,
                'masters' => $request->masters,
                'bachelors' => $request->bachelors,
                'admin_responsibilities' => $request->admin_responsibilities,
                'year' => $request->year,
                'status' => $request->status,
                'isComplete' => $request->isComplete
            ]);
            return response()->json(['success' => 'Faculty Workload updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faculty\WorkLoad  $workLoad
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkLoad $workLoad)
    {
        try {
            WorkLoad::destroy($workLoad->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'business_school_id' => 'required',
            'faculty_name' => 'required',
            'lookup_faculty_designation_id' => 'required',
            'total_courses' => 'required',
            'phd' => 'required',
            'masters' => 'required',
            'bachelors' => 'required',
            'admin_responsibilities' => 'required',
            'year' => 'required'
        ];
    }

     protected function update_rules() {
        return [
             'business_school_id' => 'required',
            'faculty_name' => 'required',
            'lookup_faculty_designation_id' => 'required',
            'total_courses' => 'required',
            'phd' => 'required',
            'masters' => 'required',
            'bachelors' => 'required',
            'admin_responsibilities' => 'required',
            'year' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
