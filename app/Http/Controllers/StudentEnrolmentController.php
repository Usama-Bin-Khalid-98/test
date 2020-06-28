<?php

namespace App\Http\Controllers;

use App\Models\StrategicManagement\StudentEnrolment;
use Illuminate\Http\Request;

class StudentEnrolmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('registration.student_enrolment.enrolment');
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
     * @param  \App\Models\StrategicManagement\StudentEnrolment  $studentEnrolment
     * @return \Illuminate\Http\Response
     */
    public function show(StudentEnrolment $studentEnrolment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\StudentEnrolment  $studentEnrolment
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentEnrolment $studentEnrolment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\StudentEnrolment  $studentEnrolment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentEnrolment $studentEnrolment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\StudentEnrolment  $studentEnrolment
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentEnrolment $studentEnrolment)
    {
        //
    }
}
