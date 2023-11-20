<?php

namespace App\Http\Controllers;

use App\Models\Common\CourseType;
use App\Models\Common\Slip;
use App\Models\StrategicManagement\ProgramPortfolio;
use App\Models\StrategicManagement\Scope;
use Illuminate\Http\Request;
use App\ProgramCourse;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Auth;
use Illuminate\Support\Facades\Log;

class ProgramCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $campus_id = Auth::user()->campus_id;
        $department_id = Auth::user()->department_id;

        $scopes = Scope::with('program')
            ->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        // dd($scopes);
        $courses = CourseType::where('status', 'active')->get();
//        $slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id])->where('regStatus','SAR')->first();
        $portfolios  = ProgramCourse::with('campus','program','course_type')
            ->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        //dd($portfolios[0]->program);
        return view('registration.curriculum.program_course', compact('scopes','courses','portfolios'));

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
            $campus_id = Auth::user()->campus_id;
            $department_id = Auth::user()->department_id;
            $slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id])->first();
            if($slip){
                ProgramCourse::create([
                    'campus_id' => Auth::user()->campus_id,
                    'department_id' => Auth::user()->department_id,
                    'program_id' => $request->program_id,
                    'title' => $request->title,
                    'code' => $request->code,
                    'course_type_id' => $request->course_type_id,
                    'credit_hours' => $request->credit_hours,
                    'prerequisite' => $request->prerequisite??'',
                    'isComplete' => 'yes',
                    'created_by' => Auth::user()->id
                ]);
            }
            return response()->json(['success' => 'Program Portfolio added successfully.']);


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

            ProgramCourse::where('id', $id)->update([
                'program_id' => $request->program_id,
                'course_type_id' => $request->course_type_id,
                'credit_hours' => $request->credit_hours,
                'status' => $request->status,
                'title' => $request->title,
                'code' => $request->code,
                'prerequisite' => $request->prerequisite??'',
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Program Course updated successfully.']);

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
        //
    }

    protected function rules() {
        return [
            'title' => 'required',
            'code' => 'required',
            'course_type_id' => 'required',
//            'no_of_course' => 'required',
            'credit_hours' => 'required',
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
