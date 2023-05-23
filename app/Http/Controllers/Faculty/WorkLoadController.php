<?php

namespace App\Http\Controllers\Faculty;

use App\AppendixFile;
use App\Http\Controllers\Controller;
use App\Models\Common\Slip;
use App\Models\Faculty\WorkLoad;
use App\Models\Common\Designation;
use App\Models\Common\StrategicManagement\BusinessSchoolTyear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Auth;
use Illuminate\Support\Facades\Storage;

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
        $designations = Designation::whereIn('name', [
            'Associate Professor', 
            'Assistant Professor', 
            'Lecturer', 
            'Professor', 
            'Other'])->get();
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
        $workloads = Workload::with('campus')->where($where)->get();


         return view('registration.faculty.workload', compact('workloads', 'getTyear', 'designations'));
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
            $slip = Slip::where(['department_id' => $department_id])->where('regStatus', 'SAR')->first();
            if ($slip) {
                $type = 'SAR';
            } else {
                $type = 'REG';
            }
            $path = '';
            if (@$request->file('file')) {
                $path = @$request->file('file')->getRealPath();
            }
            if ($path) {
                $data = array_map('str_getcsv', file(@$path));
                $csv_data = array_slice($data, 1);
                foreach ($csv_data as $index => $addData) {


                    if (!@$addData[7]) {
                        return response()->json(['error' => 'Year field is required.'], 422);
                    }

                    if (!@$addData[0]) {
                        return response()->json(['error' => 'Name field is required.'], 422);
                    }
                    $designation = Designation::byName(@$addData[1])->first();
                    if(!$designation){
                        $designation = Designation::create([
                            'name' => @$addData[1],
                            'is_default' => false
                        ]);
                    }
                    $check_data = ['campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'faculty_name' => @$addData[0],
                        'designation_id' => $designation->id,
                        'admin_responsibilities' => @$addData[2],
                        'year_t' => @$addData[7],
                        'total_courses' => @$addData[3]];
                    $check = WorkLoad::where($check_data)->exists();

                    if(!$check) {
                        WorkLoad::create([
                            'campus_id' => Auth::user()->campus_id,
                            'department_id' => Auth::user()->department_id,
                            'faculty_name' => @$addData[0],
                            'designation_id' => $designation->id,
                            'admin_responsibilities' => @$addData[2],
                            'total_courses' => @$addData[3],
                            'phd' => @$addData[4],
                            'masters' => @$addData[5],
                            'bachleors' => @$addData[6],
                            'year_t' => @$addData[7],
                            'isCompleted' => 'yes',
                            'type' => $type,
                            'created_by' => Auth::user()->id
                        ]);
                    }

                }
                return response()->json(['success' => 'Faculty WorkLoad CSV imported successfully.']);

            }else {
                list($designation_id, $error) = Designation::getOrCreate($request->designation, $request->other_designation);
                if($error){
                    return $error;
                }
                $check_data = ['campus_id' => Auth::user()->campus_id,
                    'department_id' => Auth::user()->department_id,
                    'faculty_name' => $request->faculty_name,
                    'designation_id' => $designation_id,
                    'total_courses' => $request->total_courses];
                $check = WorkLoad::where($check_data)->exists();

                if (!$check) {
                    if ($request->faculty_name) {
                        WorkLoad::create([
                            'campus_id' => Auth::user()->campus_id,
                            'department_id' => Auth::user()->department_id,
                            'faculty_name' => $request->faculty_name,
                            'designation_id' => $designation_id,
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
                        WorkLoad::create([
                            'campus_id' => Auth::user()->campus_id,
                            'department_id' => Auth::user()->department_id,
                            'faculty_name' => $request->faculty_name,
                            'designation_id' => $designation_id,
                            'total_courses' => $request->total_courses,
                            'phd' => $request->phd,
                            'masters' => $request->masters,
                            'bachleors' => $request->bachleors,
                            'admin_responsibilities' => $request->admin_responsibilities,
                            'year_t' => $request->year_t,
                            'isCompleted' => 'yes',
                            'type' => 'SAR',
                            'created_by' => Auth::user()->id
                        ]);
                    }
                } else {
                    return response()->json(['error' => 'Faculty WorkLoad already exists.'], 422);

                }
                if ($request->faculty_name_1) {
                    list($designation_id, $response) = Designation::getOrCreate($request->designation_1, $request->other_designation_1);
                    if($response){
                        return $response;
                    }
                    WorkLoad::create(
                        [
                            'campus_id' => Auth::user()->campus_id,
                            'department_id' => Auth::user()->department_id,
                            'faculty_name' => $request->faculty_name_1,
                            'designation_id' => $designation_id,
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
            }
//}
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
            list($designation_id, $response) = Designation::getOrCreate($request->designation, $request->other_designation);
            if($response){
                return $response;
            }
            if($request->faculty_name) {
                WorkLoad::where('id', $workLoad->id)->update([
                    'faculty_name' => $request->faculty_name,
                    'designation_id' => $designation_id,
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
//        dd($workLoad);
        try {
            Workload::where('id', $workLoad->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            WorkLoad::destroy($workLoad->id);
            WorkLoad::where(
                [
                    "campus_id" => $workLoad->campus_id,
                    "department_id" => $workLoad->department_id,
                    "faculty_name" => $workLoad->faculty_name,
                    "designation" => $workLoad->designation,
                    "total_courses" => $workLoad->total_courses,
                    "phd" => $workLoad->phd,
                    "masters" => $workLoad->masters,
                    "bachleors" => $workLoad->bachleors,
                    "year_t" => $workLoad->year_t,
                    "isCompleted" => "yes",
                    "created_by" => $workLoad->created_by
                ]
            )->delete();
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

    public function uploadAppendixFile(Request $request){
        if(!$request->file('appendix_4A')){
            return response()->json(['error' => 'Please upload a valid file']);
        }
        $appendix_file = AppendixFile::where([
            'campus_id'=> Auth::user()->campus_id,
            'business_school_id'=>Auth::user()->business_school_id
            ])->first();

        $path = 'uploads/workload_policy';
        $imageName = "-file-" . time() . '.' . $request->appendix_4A->getClientOriginalExtension();
        $request->file('appendix_4A')->move($path, $imageName);
        if($appendix_file){
            if($appendix_file->workload_policy && $appendix_file->workload_policy !== ''){
                unlink($appendix_file->workload_policy);
            }
            AppendixFile::where(['id' => $appendix_file->id])->update(['workload_policy' => $path . '/' . $imageName]);        
        }else{
            AppendixFile::create([
                'campus_id' => Auth::user()->campus_id,
                'business_school_id' => Auth::user()->business_school_id,
                'workload_policy' => $path . '/' . $imageName
            ]);
        }
        return response()->json(['success' => 'Appendix 4A uploaded successfully.']);
    }
}
