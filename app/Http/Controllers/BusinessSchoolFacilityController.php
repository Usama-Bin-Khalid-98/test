<?php

namespace App\Http\Controllers;

use App\Models\Facility\BusinessSchoolFacility;
use Illuminate\Http\Request;
use App\BusinessSchool;
use App\Models\Facility\FacilityType;
use App\Models\Facility\Facility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use DB;

class BusinessSchoolFacilityController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    
    public function index()
    {
        $campus_id = Auth::user()->campus_id;
        $department_id = Auth::user()->department_id;
        $facility_types = Facility::with('facility_type')->get();

        $facilitiess = BusinessSchoolFacility::with('facility_types','facility')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();


        return view('registration.facilities_information.business_school_facility', compact('facility_types','facilitiess'));
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
       // dd($request->all());

        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {

            foreach ($request->all() as $key => $facility){
                //dd();ount]['id']);
                foreach ($facility as $value){
                    //dd($value['id']);
                BusinessSchoolFacility::create([
                    'campus_id' => Auth::user()->campus_id,
                    'department_id' => Auth::user()->department_id,
                    'facility_id' => $value['id'],
                    'remark' => $value['remark'],
                    'isComplete' => 'yes',
                    'created_by' => Auth::user()->id
                ]);

                }


            }

            return response()->json(['success' => 'Business School Facility added successfully.'], 200);


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
                'remark' => $request->remark,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
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
            BusinessSchoolFacility::where('id', $businessSchoolFacility->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
            BusinessSchoolFacility::destroy($businessSchoolFacility->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
//                'id' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }




}
