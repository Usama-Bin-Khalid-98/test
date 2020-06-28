<?php

namespace App\Http\Controllers;

use App\Models\StrategicManagement\ProgramPortfolio;
use Illuminate\Http\Request;

class ProgramPortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('registration.curriculum.portfolio');
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
     * @param  \App\Models\StrategicManagement\ProgramPortfolio  $programPortfolio
     * @return \Illuminate\Http\Response
     */
    public function show(ProgramPortfolio $programPortfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\ProgramPortfolio  $programPortfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgramPortfolio $programPortfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\ProgramPortfolio  $programPortfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgramPortfolio $programPortfolio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\ProgramPortfolio  $programPortfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgramPortfolio $programPortfolio)
    {
        //
    }
}
