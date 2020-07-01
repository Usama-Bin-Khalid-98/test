<?php

namespace App\Http\Controllers;

use App\Models\Faculty\VisitingFaculty;
use Illuminate\Http\Request;

class VisitingFacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('registration.faculty.visiting_faculty');
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
     * @param  \App\Models\Faculty\VisitingFaculty  $visitingFaculty
     * @return \Illuminate\Http\Response
     */
    public function show(VisitingFaculty $visitingFaculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faculty\VisitingFaculty  $visitingFaculty
     * @return \Illuminate\Http\Response
     */
    public function edit(VisitingFaculty $visitingFaculty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faculty\VisitingFaculty  $visitingFaculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisitingFaculty $visitingFaculty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faculty\VisitingFaculty  $visitingFaculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisitingFaculty $visitingFaculty)
    {
        //
    }
}
