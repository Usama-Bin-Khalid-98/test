<?php

namespace App\Http\Controllers;

use App\Models\Facility\FinancialInfo;
use Illuminate\Http\Request;

class FinancialInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $income = IncomeSource::all();


        $infos = FinancialInfo::with('business_school','income_source')->get();
        ///dd($contacts);
        return view('registration.facilities_information.financial_info', compact('income','infos'));
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

            FinancialInfo::create([
                'business_school_id' => Auth::user()->business_school_id,
                'income_source_id' => $request->income_source_id,
                'year_three' => $request->year_three,
                'year_two' => $request->year_two,
                'year_one' => $request->year_one,
                'year_t' => $request->year_t,
                'year_t_plus_one' => $request->year_t_plus_one,
                'year_t_plus_two' => $request->year_t_plus_two
            ]);

            return response()->json(['success' => 'Financial Info added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facility\FinancialInfo  $financialInfo
     * @return \Illuminate\Http\Response
     */
    public function show(FinancialInfo $financialInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facility\FinancialInfo  $financialInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(FinancialInfo $financialInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facility\FinancialInfo  $financialInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FinancialInfo $financialInfo)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            FinancialInfo::where('id', $financialInfo->id)->update([
                'income_source_id' => $request->income_source_id,
                'year_three' => $request->year_three,
                'year_two' => $request->year_two,
                'year_one' => $request->year_one,
                'year_t' => $request->year_t,
                'year_t_plus_one' => $request->year_t_plus_one,
                'year_t_plus_two' => $request->year_t_plus_two,
                'status' => $request->status,
            ]);
            return response()->json(['success' => 'Financial Info updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facility\FinancialInfo  $financialInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinancialInfo $financialInfo)
    {
        try {
            FinancialInfo::destroy($financialInfo->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'income_source_id' => 'required',
            'year_three' => 'required',
            'year_two' => 'required',
            'year_one' => 'required',
            'year_t' => 'required',
            'year_t_plus_one' => 'required',
            'year_t_plus_two' => 'required'
        ];
    }




    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
