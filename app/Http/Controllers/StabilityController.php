<?php

namespace App\Http\Controllers;

use App\Models\Faculty\Stability;
use Illuminate\Http\Request;

class StabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('registration.faculty.stability');
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
     * @param  \App\Models\Faculty\Stability  $stability
     * @return \Illuminate\Http\Response
     */
    public function show(Stability $stability)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faculty\Stability  $stability
     * @return \Illuminate\Http\Response
     */
    public function edit(Stability $stability)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faculty\Stability  $stability
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stability $stability)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faculty\Stability  $stability
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stability $stability)
    {
        //
    }
}
