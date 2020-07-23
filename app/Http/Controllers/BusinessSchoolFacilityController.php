<?php

namespace App\Http\Controllers;

use App\Models\Facility\BusinessSchoolFacility;
use Illuminate\Http\Request;
use App\Models\Facility\Facility;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Auth;

class BusinessSchoolFacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $facility = Facility::get();

        $facilities = BusinessSchoolFacility::with('business_school','facility')->get();


        return view('registration.facilities_information.business_school_facility', compact('facility','facilities'));
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

            BusinessSchoolFacility::create([
                'business_school_id' => Auth::user()->business_school_id,
                'facility_id' => $request->facility_id
            ]);

            return response()->json(['success' => 'Business School Facility added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facility\BusinessSchoolFacility  $businessSchoolFacility
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessSchoolFacility $businessSchoolFacility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facility\BusinessSchoolFacility  $businessSchoolFacility
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessSchoolFacility $businessSchoolFacility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facility\BusinessSchoolFacility  $businessSchoolFacility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessSchoolFacility $businessSchoolFacility)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            BusinessSchoolFacility::where('id', $businessSchoolFacility->id)->update([
                'facility_id' => $request->facility_id,
                'status' => $request->status,
            ]);
            return response()->json(['success' => 'Business School Facility updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facility\BusinessSchoolFacility  $businessSchoolFacility
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessSchoolFacility $businessSchoolFacility)
    {
         try {
            BusinessSchoolFacility::destroy($businessSchoolFacility->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'facility_id' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
