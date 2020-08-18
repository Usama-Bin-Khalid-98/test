<?php

namespace App\Http\Controllers;

use App\ExtraActivities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class ExtraActivitiesController extends Controller
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
        $extras  = ExtraActivities::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

         return view('registration.student_enrolment.extra_activities', compact('extras'));
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

            ExtraActivities::create([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'date' => $request->date,
                'activity_title' => $request->activity_title,
                'budget_allocation' => $request->budget_allocation,
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Extra Activities added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExtraActivities  $extraActivities
     * @return \Illuminate\Http\Response
     */
    public function show(ExtraActivities $extraActivities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExtraActivities  $extraActivities
     * @return \Illuminate\Http\Response
     */
    public function edit(ExtraActivities $extraActivities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExtraActivities  $extraActivities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            ExtraActivities::where('id', $id)->update([
                'date' => $request->date,
                'activity_title' => $request->activity_title,
                'budget_allocation' => $request->budget_allocation,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Extra Activities updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExtraActivities  $extraActivities
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         try {
        ExtraActivities::where('id', $id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
        ExtraActivities::destroy($id);
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
            'budget_allocation' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
