<?php

namespace App\Http\Controllers;

use App\Models\facility\SupportStaff;
use Illuminate\Http\Request;
use App\Models\Facility\StaffCategory;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Auth;

class SupportStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = StaffCategory::all();


        $supports = SupportStaff::with('campus','staff_category')->get();
        ///dd($contacts);
        return view('registration.facilities_information.support_staff', compact('categories','supports'));
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

            SupportStaff::create([
                'campus_id' => Auth::user()->campus_id,
                'staff_category_id' => $request->staff_category_id,
                'total_staff' => $request->total_staff,
                'supervisor_qualification' => $request->supervisor_qualification,
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Support Staff added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\facility\SupportStaff  $supportStaff
     * @return \Illuminate\Http\Response
     */
    public function show(SupportStaff $supportStaff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\facility\SupportStaff  $supportStaff
     * @return \Illuminate\Http\Response
     */
    public function edit(SupportStaff $supportStaff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\facility\SupportStaff  $supportStaff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupportStaff $supportStaff)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            SupportStaff::where('id', $supportStaff->id)->update([
                'staff_category_id' => $request->staff_category_id,
                'total_staff' => $request->total_staff,
                'supervisor_qualification' => $request->supervisor_qualification,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Support Staff updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\facility\SupportStaff  $supportStaff
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupportStaff $supportStaff)
    {
         try {
            SupportStaff::where('id', $supportStaff->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
            SupportStaff::destroy($supportStaff->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'staff_category_id' => 'required',
            'total_staff' => 'required',
            'supervisor_qualification' => 'required'
        ];
    }




    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
