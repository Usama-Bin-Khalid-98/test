<?php

namespace App\Http\Controllers;

use App\Models\Common\StrategicManagement\BusinessSchoolTyear;
use App\Models\StrategicManagement\ApplicationReceived;
use App\Models\StrategicManagement\Scope;
use App\Models\Common\Semester;
use App\Models\Common\Slip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class ApplicationReceivedController extends Controller
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
        $semesters = Semester::where('status', 'active')->get();

        $slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id])->where('regStatus','SAR')->first();
        if($slip){
            $apps  = ApplicationReceived::with('campus','program','semester')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->where('type','SAR')->get();
        }else {
            $apps  = ApplicationReceived::with('campus','program','semester')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->where('type','REG')->get();
        }

        $getYears = BusinessSchoolTyear::where(['campus_id'=> $campus_id, 'department_id'=> $department_id])->get()->first();
        $years['yeart'] = @$getYears->tyear;
        $years['year_t_1'] = @$getYears->year_t_1;
        $years['year_t_2'] = @$getYears->year_t_2;

        $scopes = Scope::with('program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id, 'type'=> $slip?'SAR':'REG'])->get();
        return view('registration.curriculum.app_received', compact('scopes','semesters','apps', 'years'));
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
        //dd($request->all());
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
            $check_data = [
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'program_id' => $request->program_id,
                'year' => $request->year,
                'semester' => $request->semester,
                'isComplete'=>'yes',
                'type'=>$type];
            $check = ApplicationReceived::where($check_data)->exists();

            if(!$check) {
                ApplicationReceived::create([
                    'campus_id' => Auth::user()->campus_id,
                    'department_id' => Auth::user()->department_id,
                    'program_id' => $request->program_id,
                    'year' => $request->year,
                    'semester' => $request->semester,
                    'app_received' => $request->app_received,
                    'admission_offered' => $request->admission_offered,
                    'student_intake' => $request->student_intake,
                    'semester_comm_date' => $request->semester_comm_date,
                    'isComplete' => 'yes',
                    'type' => $type,
                    'created_by' => Auth::user()->id
                ]);
            }else{
            return response()->json(['error' => 'Application Received already exists.'], 422);

            }

            return response()->json(['success' => 'Application Received added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\ApplicationReceived  $applicationReceived
     * @return \Illuminate\Http\Response
     */
    public function show(ApplicationReceived $applicationReceived)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\ApplicationReceived  $applicationReceived
     * @return \Illuminate\Http\Response
     */
    public function edit(ApplicationReceived $applicationReceived)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\ApplicationReceived  $applicationReceived
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApplicationReceived $applicationReceived)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            ApplicationReceived::where('id', $applicationReceived->id)->update([
                'program_id' => $request->program_id,
                'year' => $request->year,
                'app_received' => $request->app_received,
                'admission_offered' => $request->admission_offered,
                'student_intake' => $request->student_intake,
                'semester_comm_date' => $request->semester_comm_date,
                'semester' => $request->semester,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Application Received updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\ApplicationReceived  $applicationReceived
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApplicationReceived $applicationReceived)
    {
        try {
            ApplicationReceived::where('id', $applicationReceived->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            ApplicationReceived::destroy($applicationReceived->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'program_id' => 'required',
            'year' => 'required',
            'app_received' => 'required|numeric',
            'admission_offered' => 'required|numeric',
            'student_intake' => 'required|numeric',
            'semester_comm_date' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
