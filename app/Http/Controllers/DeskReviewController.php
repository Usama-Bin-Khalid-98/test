<?php

namespace App\Http\Controllers;

use App\Models\DeskReview;
use App\Models\StrategicManagement\Scope;
use Illuminate\Http\Request;

class DeskReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $accreditation=  Scope::where('status', 'active');
        return view('desk_review.index');
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
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function show(DeskReview $deskReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function edit(DeskReview $deskReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeskReview $deskReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeskReview $deskReview)
    {
        //
    }
}
