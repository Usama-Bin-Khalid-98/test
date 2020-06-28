<?php

namespace App\Http\Controllers;

use App\Models\StrategicManagement\BudgetaryInfo;
use Illuminate\Http\Request;

class BudgetaryInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('strategic_management.budgetary_info');
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
     * @param  \App\Models\StrategicManagement\BudgetaryInfo  $budgetaryInfo
     * @return \Illuminate\Http\Response
     */
    public function show(BudgetaryInfo $budgetaryInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\BudgetaryInfo  $budgetaryInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(BudgetaryInfo $budgetaryInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\BudgetaryInfo  $budgetaryInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BudgetaryInfo $budgetaryInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\BudgetaryInfo  $budgetaryInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(BudgetaryInfo $budgetaryInfo)
    {
        //
    }
}
