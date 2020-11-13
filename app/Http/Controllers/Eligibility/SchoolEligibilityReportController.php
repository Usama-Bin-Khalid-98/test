<?php

namespace App\Http\Controllers\Eligibility;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SchoolEligibilityReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userInfo = Auth::user();
        $registrations_reports = DB::table('slips as s')
            ->join('campuses as c', 'c.id', '=', 's.business_school_id')
            ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
            ->join('departments as d', 'd.id', '=', 's.department_id')
            ->join('eligibility_reports as er', 'er.slip_id', '=', 's.id')
            ->select('s.*', 'c.location as campus', 'bs.name as school', 'd.name as department',
                'er.status as eligibility_status', 'er.comments', 'er.file', 'er.id as report_id')
//                ->where('s.regStatus', 'Mentoring')
            ->where('s.business_school_id', $userInfo->campus_id)
            ->where('s.department_id', $userInfo->department_id)
            ->get();

        return view('eligibility_screening.school_eligibility_report', compact('registrations_reports'));
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
        //
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
}
