<?php

namespace App\Http\Controllers;

use App\Models\StrategicManagement\ProgramPortfolio;
use App\Models\StrategicManagement\Scope;
use App\Models\Common\Slip;
use App\Models\Common\CourseType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class ProgramPortfolioController extends Controller
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

        $scopes = Scope::with('program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
       // dd($scopes);
        $courses = CourseType::where('status', 'active')->get();
        $slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id])->where('regStatus','SAR')->first();
       $isSAR = false;
        if($slip){
            $isSAR = true;
           $portfolios  = ProgramPortfolio::with('campus','program','course_type')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->where('type','SAR')->get();
        }else {
           $portfolios  = ProgramPortfolio::with('campus','program','course_type')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->where('type','REG')->get();
        }
        //dd($portfolios[0]->program);
         return view('registration.curriculum.portfolio', compact('scopes','courses','portfolios', 'isSAR'));
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
            $slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id])->where('regStatus','SAR')->first();
            if($slip){
                $type='SAR';
            }else {
                $type = 'REG';
            }

            ProgramPortfolio::create([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'program_id' => $request->program_id,
                'total_semesters' => $request->total_semesters,
                'course_type_id' => $request->course_type_id,
                'no_of_course' => $request->no_of_course,
                'credit_hours' => $request->credit_hours,
                'internship_req' => $request->internship_req??'',
                'fyp_req' => $request->fyp_req??'',
                'isComplete' => 'yes',
                'type' => $type,
                'created_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Program Portfolio added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\ProgramPortfolio  $programPortfolio
     * @return \Illuminate\Http\Response
     */
    public function show(ProgramPortfolio $programPortfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\ProgramPortfolio  $programPortfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgramPortfolio $programPortfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\ProgramPortfolio  $programPortfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgramPortfolio $programPortfolio)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            ProgramPortfolio::where('id', $programPortfolio->id)->update([
                'program_id' => $request->program_id,
                'total_semesters' => $request->total_semesters,
                'course_type_id' => $request->course_type_id,
                'no_of_course' => $request->no_of_course,
                'credit_hours' => $request->credit_hours,
                'internship_req' => $request->internship_req,
                'fyp_req' => $request->fyp_req,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Program Portfolio updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\ProgramPortfolio  $programPortfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgramPortfolio $programPortfolio)
    {
        try {
            ProgramPortfolio::where('id', $programPortfolio->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            ProgramPortfolio::destroy($programPortfolio->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'program_id' => 'required',
            'total_semesters' => 'required',
            'course_type_id' => 'required',
            'no_of_course' => 'required',
            'credit_hours' => 'required',
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
