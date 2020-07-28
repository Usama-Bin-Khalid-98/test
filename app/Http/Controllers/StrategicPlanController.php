<?php

namespace App\Http\Controllers;

use App\Models\StrategicManagement\StrategicPlan;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class StrategicPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $plans  = StrategicPlan::with('campus')->get();;

         return view('strategic_management.plan', compact('plans'));
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

            StrategicPlan::create([
                'campus_id' => Auth::user()->campus_id,
                'plan_period' => $request->plan_period,
                'aproval_date' => $request->aproval_date,
                'aproving_authority' => $request->aproving_authority
            ]);

            return response()->json(['success' => 'Strategic Plan added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\StrategicPlan  $strategicPlan
     * @return \Illuminate\Http\Response
     */
    public function show(StrategicPlan $strategicPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\StrategicPlan  $strategicPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(StrategicPlan $strategicPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\StrategicPlan  $strategicPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StrategicPlan $strategicPlan)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            StrategicPlan::where('id', $strategicPlan->id)->update([
                'plan_period' => $request->plan_period,
                'aproval_date' => $request->aproval_date,
                'aproving_authority' => $request->aproving_authority,
                'status' => $request->status
            ]);
            return response()->json(['success' => 'Strategic Plan updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\StrategicPlan  $strategicPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(StrategicPlan $strategicPlan)
    {
        try {
            StrategicPlan::destroy($strategicPlan->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'plan_period' => 'required',
            'aproval_date' => 'required',
            'aproving_authority' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
