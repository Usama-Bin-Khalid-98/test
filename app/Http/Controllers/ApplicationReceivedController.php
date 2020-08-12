<?php

namespace App\Http\Controllers;

use App\Models\StrategicManagement\ApplicationReceived;
use App\Models\StrategicManagement\Scope;
use App\Models\Common\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class ApplicationReceivedController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campus_id = Auth::user()->campus_id;
        $user_id = Auth::user()->id;
        $scopes = Scope::with('program')->get();
        $semesters = Semester::where('status', 'active')->get();

        $apps  = ApplicationReceived::with('campus','program','semester')->where(['campus_id'=> $campus_id,'created_by'=> $user_id])->get();

        return view('registration.curriculum.app_received', compact('scopes','semesters','apps'));
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

            ApplicationReceived::create([
                'campus_id' => Auth::user()->campus_id,
                'program_id' => $request->program_id,
                'semester_id' => $request->semester_id,
                'app_received' => $request->app_received,
                'admission_offered' => $request->admission_offered,
                'student_intake' => $request->student_intake,
                'semester_comm_date' => $request->semester_comm_date,
                'created_by' => Auth::user()->id
            ]);

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
                'semester_id' => $request->semester_id,
                'app_received' => $request->app_received,
                'admission_offered' => $request->admission_offered,
                'student_intake' => $request->student_intake,
                'semester_comm_date' => $request->semester_comm_date,
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
            'semester_id' => 'required',
            'app_received' => 'required',
            'admission_offered' => 'required',
            'student_intake' => 'required',
            'semester_comm_date' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
