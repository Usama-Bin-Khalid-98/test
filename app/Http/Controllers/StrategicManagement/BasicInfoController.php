<?php

namespace App\Http\Controllers\StrategicManagement;

use App\BusinessSchool;
use App\CharterType;
use App\InstituteType;
use App\Models\Common\Campus;
use App\Models\Common\Department;
use App\Models\Common\Designation;
use App\Models\Common\Slip;
use App\Models\Common\StrategicManagement\BusinessSchoolTyear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use Illuminate\Support\Facades\Validator;
use  App\User;


class BasicInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
//     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user_info = Auth::user();
            // Basic Info
            $school_id = Auth::user()->business_school_id;
            //dd($school_id);
            $basic_info = BusinessSchool::where('id', $school_id)->get()->first();
            $institute_type = InstituteType::where('status', 'active')->get();
            $chart_types=CharterType::where('status', 'active')->get();
            $designations = Designation::where('status', 'active')->get();
            $tyear = BusinessSchoolTyear::where(
                [
                    'campus_id'=>$user_info->campus_id,
                    'department_id'=>$user_info->department_id
                ])->get()->first();
//dd($tyear);
            $campuses = Campus::where(['business_school_id'=> $school_id, 'id'=>$user_info->campus_id])->get();
//            dd($campuses);
            if ($campuses->count() <= 0)
            {
                $campuses = '';
            }
            $department = Department::where(['id' => $user_info->department_id])->first();
            //$campuses->first();
            //dd($campuses);

        return view('strategic_management.basic_info',compact('basic_info', 'institute_type','chart_types','user_info','designations', 'campuses', 'tyear', 'department'));
        }catch (\Exception $e) {
            return $e->getMessage();
        }

        //dd($basic_info);
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
        //

        echo 'coming here';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\BasicInfo  $basicInfo
     * @return \Illuminate\Http\Response
     */
    public function show(BasicInfo $basicInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\BasicInfo  $basicInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(BasicInfo $basicInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        try {
            $campus_id = Auth::user()->campus_id;
            $department_id = Auth::user()->department_id;
            $slip = Slip::where(['business_school_id'=> $campus_id,'department_id'=> $department_id])->where('regStatus','SAR')->first();
            if($slip){
                $type='SAR';
            }else {
                $type = 'REG';
            }
            $validation= Validator::make($request->all(), $this->rules(), $this->messages());
            if($validation->fails())
            {
                return response()->json($validation->messages()->all(), 422);
            }else {

                    $update = BusinessSchool::where('id', $id)
                        ->update(
                            [
                                'contact_person' => $request->contact_person,
                                'year_estb' => $request->year_estb,
                                'address' => $request->address,
                                'web_url' => $request->web_url,
                                'campus_year_estb' => $request->campus_year_estb,
                                'date_charter_granted' => $request->date_charter_granted,
                                'charter_number' => $request->charter_number,
                                'charter_type_id' => $request->charter_type_id,
                                'institute_type_id' => $request->institute_type_id,
                                'sector' => $request->sector,
                                'profit_status' => $request->profit_status,
                                'isCompleted' => 'yes',
                                'type' => $type,
                                'hierarchical_context' => $request->hierarchical_context,

                            ]
                        );
                    $userinfo = Auth::user();
                    $where = ['campus_id' =>$userinfo->campus_id, 'department_id'=>$userinfo->department_id];
                    $checkif = BusinessSchoolTyear::where($where)->exists();
//                    dd($checkif);
                    if($checkif) {
                        $updateYear = BusinessSchoolTyear::where($where)->update(
                            [
                                'tyear'=>$request->year_t,
                                'year_t_1' => $request->year_t-1,
                                'year_t_2' => $request->year_t-2,
                                'updated_by' => $userinfo->id
                            ]
                        );
                    }else{
                        $insert = BusinessSchoolTyear::create(
                            [
                                'campus_id'=>$userinfo->campus_id,
                                'department_id'=>$userinfo->department_id,
                                'created_by' => $userinfo->id,
                                'tyear' => $request->year_t,
                                'year_t_1' => $request->year_t-1,
                                'year_t_2' => $request->year_t-2
                            ]);
                    }
                //dd('coning else', $update);
                $updateUser = User::find(Auth::id())
                          ->update(['designation_id'=> $request->designation_id, 'cao_name' => $request->contact_person]);

                return response()->json(['success' => 'Updated successfully.']);
            }
        }catch (Exception $e)
        {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\BasicInfo  $basicInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(BasicInfo $basicInfo)
    {
        //
    }

    protected function rules() {
        return [
            'contact_person' => 'required',
//            'contact_no' => 'required',
            'year_estb' => 'required',
            'web_url' => 'required',
            'date_charter_granted' => 'required',
            'charter_number' => 'required',
            'institute_type_id' => 'required',
            'charter_type_id' => 'required',
            'hierarchical_context' => 'required',
            'profit_status' => 'required',
            'sector' => 'required',
            'address' => 'required',
            'year_t' => 'required',
            'designation_id' => 'required',
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
