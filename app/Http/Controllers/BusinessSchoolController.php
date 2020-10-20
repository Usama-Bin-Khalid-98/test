<?php

namespace App\Http\Controllers;

use App\BusinessSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessSchoolController extends Controller
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
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //add School
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails()) {
            return response()->json($validation->messages()->all(), 422);
        }
        //$request->status = 'disabled';
        $request->merge(['status' => 'inactive']);
        $addSchool = BusinessSchool::create($request->all());
        return response()->json(['success' => 'Your business school name sent for registration.It will coming in the list when the admin approve it.'], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BusinessSchool  $businessSchool
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessSchool $businessSchool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BusinessSchool  $businessSchool
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessSchool $businessSchool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusinessSchool  $businessSchool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessSchool $businessSchool)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessSchool  $businessSchool
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessSchool $businessSchool)
    {
        //
    }

    protected function rules(){
        return
        [
            'name' => 'required',
            'contact_no' => 'required'
        ];
    }

    protected function messages(){
        return
        [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
