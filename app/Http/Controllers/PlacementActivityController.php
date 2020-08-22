<?php

namespace App\Http\Controllers;

use App\Models\External_Linkages\PlacementActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class PlacementActivityController extends Controller
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
        $genders = PlacementActivity::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        return view('external_linkages.placement_activities', compact('genders'));
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
            $uni_id = Auth::user()->campus_id;
            $dept_id = Auth::user()->department_id;
            PlacementActivity::create([
                'campus_id' => $uni_id,
                'department_id' => $dept_id,
                'date' => $request->date,
                'activity_title' => $request->activity_title,
                'org_participate' => $request->org_participate,
                'isComplete' => 'yes',
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => ' Placement Activity Inserted successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\External_Linkages\PlacementActivity  $placementActivity
     * @return \Illuminate\Http\Response
     */
    public function show(PlacementActivity $placementActivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\External_Linkages\PlacementActivity  $placementActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(PlacementActivity $placementActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\External_Linkages\PlacementActivity  $placementActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlacementActivity $placementActivity)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            PlacementActivity::where('id', $placementActivity->id)->update([
                'date' => $request->date,
                'activity_title' => $request->activity_title,
                'org_participate' => $request->org_participate,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Placement Activity updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\External_Linkages\PlacementActivity  $placementActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlacementActivity $placementActivity)
    {
        try {
        PlacementActivity::where('id', $placementActivity->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
            PlacementActivity::destroy($placementActivity->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'date' => 'required',
            'activity_title' => 'required',
            'org_participate' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
