<?php

namespace App\Http\Controllers;

use App\Models\Faculty\FacultyGender;
use Illuminate\Http\Request;

class FacultyGenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('registration.faculty.faculty_gender');
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
     * @param  \App\Models\Faculty\FacultyGender  $facultyGender
     * @return \Illuminate\Http\Response
     */
    public function show(FacultyGender $facultyGender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faculty\FacultyGender  $facultyGender
     * @return \Illuminate\Http\Response
     */
    public function edit(FacultyGender $facultyGender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faculty\FacultyGender  $facultyGender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacultyGender $facultyGender)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faculty\FacultyGender  $facultyGender
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacultyGender $facultyGender)
    {
        //
    }
}
