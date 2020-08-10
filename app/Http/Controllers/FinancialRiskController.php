<?php

namespace App\Http\Controllers;

use App\Models\facility\FinancialRisk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Auth;

class FinancialRiskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $risks = FinancialRisk::with('campus')->get();
        ///dd($contacts);
        return view('registration.facilities_information.financial_risk', compact('risks'));
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
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {

            FinancialRisk::create([
                'campus_id' => Auth::user()->campus_id,
                'risk_identified' => $request->risk_identified,
                'stakeholder_involved' => $request->stakeholder_involved,
                'remedial_measure' => $request->remedial_measure,
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Financial Risk added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\facility\FinancialRisk  $financialRisk
     * @return \Illuminate\Http\Response
     */
    public function show(FinancialRisk $financialRisk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\facility\FinancialRisk  $financialRisk
     * @return \Illuminate\Http\Response
     */
    public function edit(FinancialRisk $financialRisk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\facility\FinancialRisk  $financialRisk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FinancialRisk $financialRisk)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            FinancialRisk::where('id', $financialRisk->id)->update([
                'risk_identified' => $request->risk_identified,
                'stakeholder_involved' => $request->stakeholder_involved,
                'remedial_measure' => $request->remedial_measure,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Financial Risk updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\facility\FinancialRisk  $financialRisk
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinancialRisk $financialRisk)
    {
         try {
            FinancialRisk::where('id', $financialRisk->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
            FinancialRisk::destroy($financialRisk->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'risk_identified' => 'required',
            'stakeholder_involved' => 'required',
            'remedial_measure' => 'required'
        ];
    }




    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
