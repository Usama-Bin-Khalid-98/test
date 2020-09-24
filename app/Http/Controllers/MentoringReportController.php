<?php

namespace App\Http\Controllers;

use App\Models\Mentoring\MentoringReport;
use App\Models\MentoringInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentoringReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mentor_reports = MentoringReport::where('created_by', Auth::id())->get();
        $registrations = MentoringInvoice::with('department', 'campus')->get();
//        dd($registrations);
        return  view('mentoring.mentor_report', compact('mentor_reports', 'registrations'));
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
     * @param  \App\Models\Mentoring\MentoringReport  $mentoringReport
     * @return \Illuminate\Http\Response
     */
    public function show(MentoringReport $mentoringReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mentoring\MentoringReport  $mentoringReport
     * @return \Illuminate\Http\Response
     */
    public function edit(MentoringReport $mentoringReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mentoring\MentoringReport  $mentoringReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MentoringReport $mentoringReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mentoring\MentoringReport  $mentoringReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(MentoringReport $mentoringReport)
    {
        //
    }
}
