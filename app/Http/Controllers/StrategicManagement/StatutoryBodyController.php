<?php

namespace App\Http\Controllers\StrategicManagement;

use App\Models\StrategicManagement\StatutoryBody;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StatutoryBodyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
//        dd($request->all());
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validator->fails()){
            return response()->json(['message ' => $validator->messages()->all()], 422);
        }

        $insert = StatutoryBody::create(['name' => $request->name]);
        if($insert)
        {
            return response()->json(['success' => 'Statutory body added successfully.', 'last_insert_id'=> $insert->id], 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\StatutoryBody  $statutoryBody
     * @return \Illuminate\Http\Response
     */
    public function show(StatutoryBody $statutoryBody)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\StatutoryBody  $statutoryBody
     * @return \Illuminate\Http\Response
     */
    public function edit(StatutoryBody $statutoryBody)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\StatutoryBody  $statutoryBody
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatutoryBody $statutoryBody)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\StatutoryBody  $statutoryBody
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatutoryBody $statutoryBody)
    {
        //
    }

    protected function rules() {
        return [
            'name' => 'required',
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.',
        ];
    }
}
