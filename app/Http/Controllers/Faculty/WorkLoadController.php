<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Common\Slip;
use App\Models\Faculty\WorkLoad;
use App\Models\Common\Designation;
use App\Models\Common\StrategicManagement\BusinessSchoolTyear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Auth;

class WorkLoadController extends Controller
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
         $designations = Designation::all();
        /*$slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id])->where('regStatus','SAR')->first();
        if($slip){
            $workloads = WorkLoad::with('campus','designation', 'semester')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->where('type','SAR')->get();
        }else {
            $workloads = WorkLoad::with('campus','designation', 'semester')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->where('type','REG')->get();
        }*/


        $slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id, 'regStatus' => 'SAR'])->first();
        $where = ['campus_id'=> $campus_id,'department_id'=> $department_id];
        $getTyear = BusinessSchoolTyear::where($where)->get()->first();
        ($slip)?$where['type'] = 'SAR':$where['type'] = 'REG';
        $workloads = Workload::with('campus','designation')->where($where)->get();


         return view('registration.faculty.workload', compact('designations','workloads', 'getTyear'));
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

            $department_id = Auth::user()->department_id;
            $slip = Slip::where(['department_id'=> $department_id])->where('regStatus','SAR')->first();
            if($slip){
                $type='SAR';
            }else {
                $type = 'REG';
            }
            if($request->faculty_name) {
                WorkLoad::create([
                    'campus_id' => Auth::user()->campus_id,
                    'department_id' => Auth::user()->department_id,
                    'faculty_name' => $request->faculty_name,
                    'designation_id' => $request->designation_id,
                    'total_courses' => $request->total_courses,
                    'phd' => $request->phd,
                    'masters' => $request->masters,
                    'bachleors' => $request->bachleors,
                    'admin_responsibilities' => $request->admin_responsibilities,
                    'year_t' => $request->year_t,
                    'isCompleted' => 'yes',
                    'type' => $type,
                    'created_by' => Auth::user()->id
                ]);
            }
            if($request->faculty_name_1) {
                WorkLoad::create(
                    [
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'faculty_name' => $request->faculty_name_1,
                        'designation_id' => $request->designation_id_1,
                        'total_courses' => $request->total_courses_1,
                        'phd' => $request->phd_1,
                        'masters' => $request->masters_1,
                        'bachleors' => $request->bachleors_1,
                        'admin_responsibilities' => $request->admin_responsibilities_1,
                        'year_t' => $request->year_t_1,
                        'isCompleted' => 'yes',
                        'type' => $type,
                        'created_by' => Auth::user()->id
                    ]
                );
            }
//
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
//        dd($request->all());
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            if($request->faculty_name) {
                WorkLoad::where('id', $workLoad->id)->update([
                    'faculty_name' => $request->faculty_name,
                    'designation_id' => $request->designation_id,
                    'total_courses' => $request->total_courses,
                    'phd' => $request->phd,
                    'masters' => $request->masters,
                    'bachleors' => $request->bachleors,
                    'admin_responsibilities' => $request->admin_responsibilities,
                    'year_t' => $request->edit_year_t,
                    'status' => $request->status,
                    'updated_by' => Auth::user()->id
                ]);
            }
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
            Workload::where('id', $workLoad->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            WorkLoad::destroy($workLoad->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
//            'faculty_name' => 'required',
//            'designation_id' => 'required',
//            'total_courses' => 'required',
//            'phd' => 'required',
//            'masters' => 'required',
//            'bachleors' => 'required',
//            'admin_responsibilities' => 'required',
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
