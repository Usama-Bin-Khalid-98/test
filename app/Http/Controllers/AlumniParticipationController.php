<?php

namespace App\Http\Controllers;

use App\AlumniParticipation;
use App\ActivityEngagement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class AlumniParticipationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    public function index()
    {
        $campus_id = Auth::user()->campus_id;
        $user_id = Auth::user()->id;
        $engagements = ActivityEngagement::get();
        $participations  = AlumniParticipation::with('campus','activity_engagements')->where(['campus_id'=> $campus_id,'created_by'=> $user_id])->get();

         return view('registration.student_enrolment.alumni_participation', compact('engagements','participations'));
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

            AlumniParticipation::create([
                'campus_id' => Auth::user()->campus_id,
                'activity_engagements_id' => $request->activity_engagements_id,
                'alumni_participated' => $request->alumni_participated,
                'major_input' => $request->major_input,
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Alumni Participation added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AlumniParticipation  $alumniParticipation
     * @return \Illuminate\Http\Response
     */
    public function show(AlumniParticipation $alumniParticipation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AlumniParticipation  $alumniParticipation
     * @return \Illuminate\Http\Response
     */
    public function edit(AlumniParticipation $alumniParticipation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AlumniParticipation  $alumniParticipation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AlumniParticipation $alumniParticipation)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            AlumniParticipation::where('id', $alumniParticipation->id)->update([
                'activity_engagements_id' => $request->activity_engagements_id,
                'alumni_participated' => $request->alumni_participated,
                'major_input' => $request->major_input,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Alumni Participation updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AlumniParticipation  $alumniParticipation
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlumniParticipation $alumniParticipation)
    {
        try {
        AlumniParticipation::where('id', $alumniParticipation->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
        AlumniParticipation::destroy($alumniParticipation->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'activity_engagements_id' => 'required',
            'alumni_participated' => 'required',
            'major_input' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
