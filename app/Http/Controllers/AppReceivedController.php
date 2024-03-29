<?php

namespace App\Http\Controllers;

use App\AppReceived;
use Illuminate\Http\Request;
use App\Models\StrategicManagement\Scope;
use App\Models\Common\Slip;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;


class AppReceivedController extends Controller
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
        $apps  = AppReceived::with('campus','program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        $scopes = Scope::with('program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        return view('registration.curriculum.App_Recvd',compact('scopes','apps'));
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
            $check_data = [
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'program_id' => $request->program_id,
                'isComplete'=>'yes',
            ];

            $check = AppReceived::where($check_data)->exists();
            if(!$check) {
                AppReceived::create([
                    'campus_id' => Auth::user()->campus_id,
                    'department_id' => Auth::user()->department_id,
                    'program_id' => $request->program_id,
                    'degree_awarding_criteria' => $request->degree_req,
                    'isComplete' => 'yes',
                    'created_by' => Auth::user()->id
                ]);
            }else{

            return response()->json(['error' => 'Criteria already exists.'], 422);

            }

            return response()->json(['success' => 'Criteria added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AppReceived  $appReceived
     * @return \Illuminate\Http\Response
     */
    public function show(AppReceived $appReceived)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AppReceived  $appReceived
     * @return \Illuminate\Http\Response
     */
    public function edit(AppReceived $appReceived)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AppReceived  $appReceived
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

            AppReceived::where('id', $id)->update([
                'program_id' => $request->program_id,
                'degree_awarding_criteria'=>$request->degree_req,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Criteria updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AppReceived  $appReceived
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        try {
            AppReceived::where('id', $id)->update([
                'deleted_by' => Auth::user()->id
            ]);
            AppReceived::destroy($id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'program_id' => 'required',
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
