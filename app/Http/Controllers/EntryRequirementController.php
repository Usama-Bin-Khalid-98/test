<?php

namespace App\Http\Controllers;

use App\Models\StrategicManagement\EntryRequirement;
use Illuminate\Http\Request;

class EntryRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('registration.curriculum.entry_req');
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
     * @param  \App\Models\StrategicManagement\EntryRequirement  $entryRequirement
     * @return \Illuminate\Http\Response
     */
    public function show(EntryRequirement $entryRequirement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\EntryRequirement  $entryRequirement
     * @return \Illuminate\Http\Response
     */
    public function edit(EntryRequirement $entryRequirement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\EntryRequirement  $entryRequirement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntryRequirement $entryRequirement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\EntryRequirement  $entryRequirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntryRequirement $entryRequirement)
    {
        //
    }
}
