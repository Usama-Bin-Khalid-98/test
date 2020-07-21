<?php

namespace App\Http\Controllers\StrategicManagement;

use App\Models\StrategicManagement\StatutoryCommittee;
use App\Models\StrategicManagement\Designation;
use App\Models\StrategicManagement\StatutoryBody;
use App\Models\StrategicManagement\Affiliation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class AffiliationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $statutory_committee = StatutoryCommittee::all();
        $designations = Designation::all();
        $bodies = StatutoryBody::all();

        $affiliations = Affiliation::with('statutory_committees','designation','statutory_bodies')->get();
        //dd($affiliations);
        return view('strategic_management.affiliations', compact('statutory_committee','designations','bodies','affiliations'));
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

            Affiliation::create([
                'statutory_committees_id' => $request->statutory_committees_id,
                'designation_id' => $request->designation_id,
                'affiliation' => $request->affiliation,
                'statutory_bodies_id' => $request->statutory_bodies_id
            ]);

            return response()->json(['success' => ' Affiliations added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\Affiliation  $affiliation
     * @return \Illuminate\Http\Response
     */
    public function show(Affiliation $affiliation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\Affiliation  $affiliation
     * @return \Illuminate\Http\Response
     */
    public function edit(Affiliation $affiliation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\Affiliation  $affiliation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Affiliation $affiliation)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            Affiliation::where('id', $affiliation->id)->update([
                'statutory_committees_id' => $request->statutory_committees_id,
                'designation_id' => $request->designation_id,
                'affiliation' => $request->affiliation,
                'statutory_bodies_id' => $request->statutory_bodies_id,
                'status' => $request->status
            ]);
            return response()->json(['success' => 'Affiliations updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\Affiliation  $affiliation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Affiliation $affiliation)
    {
        try {
            Affiliation::destroy($affiliation->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [

            'statutory_committees_id' => 'required',
            'designation_id' => 'required',
            'affiliation' => 'required',
            'statutory_bodies_id' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
