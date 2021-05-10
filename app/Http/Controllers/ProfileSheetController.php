<?php

namespace App\Http\Controllers;

use App\Models\Common\Slip;
use App\Models\PeerReview\PeerReviewReviewer;
use App\Models\StrategicManagement\Scope;
use App\ProfileSheet;
use Illuminate\Http\Request;

class ProfileSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //
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
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProfileSheet  $profileSheet
     * @return \Illuminate\Http\Response
     */
    public function show(ProfileSheet $profileSheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProfileSheet  $profileSheet
     * @return \Illuminate\Http\Response
     */
    public function edit($cid=null, $did=null)
    {
        $where = ['department_id'=> $did, 'business_school_id'=> $cid];
        $where_scop = ['department_id'=> $did, 'campus_id'=> $cid];
        $registrations = Slip::where($where)->with('campus', 'department')->first();

        $peerReviewers = PeerReviewReviewer::where(['slip_id'=>$registrations->id])->with('user')->get();
//        dd($peerReviewers);
        $scopes = Scope::where($where_scop)->get();

        //
//        dd($registrations);

        return view('profile_sheet.profile_sheet', compact('registrations','scopes'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProfileSheet  $profileSheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfileSheet $profileSheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProfileSheet  $profileSheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfileSheet $profileSheet)
    {
        //
    }
}
