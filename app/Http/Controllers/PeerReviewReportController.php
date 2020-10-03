<?php

namespace App\Http\Controllers;

use App\Models\PeerReview\PeerReviewReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeerReviewReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registrations = PeerReviewReport::with('slip')->get();
        //dd($registrations);
        return view('peer_review_visit.review_report', compact('registrations'));

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
     * @param  \App\Models\PeerReview\PeerReviewReport  $peerReviewReport
     * @return \Illuminate\Http\Response
     */
    public function show(PeerReviewReport $peerReviewReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PeerReview\PeerReviewReport  $peerReviewReport
     * @return \Illuminate\Http\Response
     */
    public function edit(PeerReviewReport $peerReviewReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PeerReview\PeerReviewReport  $peerReviewReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PeerReviewReport $peerReviewReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PeerReview\PeerReviewReport  $peerReviewReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeerReviewReport $peerReviewReport)
    {
        //
    }
}
