<?php

namespace App\Http\Controllers;

use App\BusinessSchool;
use App\CharterType;
use App\InstituteType;
use Illuminate\Http\Request;

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
            $institute_type = InstituteType::where('status', 'enabled')->get();
            $chart_types=CharterType::where('status', 'enabled')->get();

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
     * @param  \App\Models\StrategicManagement\BasicInfo  $basicInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BasicInfo $basicInfo)
    {
        //
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
}
