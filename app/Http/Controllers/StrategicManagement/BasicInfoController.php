<?php

namespace App\Http\Controllers\StrategicManagement;

use App\BusinessSchool;
use App\CharterType;
use App\InstituteType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Illuminate\Support\Facades\Validator;


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
            // Basic Info
            $school_id = auth()->user()->business_school_id;
            $basic_info = BusinessSchool::where('id', $school_id)->get()->first();
            $institute_type = InstituteType::where('status', 'active')->get();
            $chart_types=CharterType::where('status', 'active')->get();

        return view('strategic_management.basic_info',compact('basic_info', 'institute_type','chart_types'));
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
            //$update = BasicInfo::find($basicInfo->id);
            $validation= Validator::make($request->all(), $this->rules(), $this->messages());
            if($validation->fails())
            {
                return response()->json($validation->messages()->all(), 422);
            }else {
                $update = BusinessSchool::where('id', $id)
                          ->update($request->all());
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
            'contact_no' => 'required',
            'year_estb' => 'required|date',
            'web_url' => 'required',
            'date_charter_granted' => 'required',
            'charter_number' => 'required',
            'institute_type_id' => 'required',
            'charter_type_id' => 'required',
            'hierarchical_context' => 'required',
            'profit_status' => 'required',
            'sector' => 'required',
            'address' => 'required',
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
