<?php

namespace App\Http\Controllers;

use App\Models\External_Linkages\BodyMeeting;
use App\Models\Common\Designation;
use App\Models\StrategicManagement\StatutoryBody;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class BodyMeetingController extends Controller
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
        $designation = Designation::where(['status' => 'active', 'is_default' => true])->get();
        $body = StatutoryBody::get();
        $genders = BodyMeeting::with('campus','designation','statutory_bodies')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        return view('external_linkages.statutory_body_meetings', compact('designation','body','genders'));
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
            BodyMeeting::create([
                'campus_id' => $uni_id,
                'department_id' => $dept_id,
                'participant_name' => $request->participant_name,
                'designation_id' => $request->designation_id,
                'affiliation' => $request->affiliation,
                'statutory_bodies_id' => $request->statutory_bodies_id,
                'meeting_date' => $request->meeting_date,
                'isComplete' => 'yes',
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => ' Body Meeting Inserted successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\External_Linkages\BodyMeeting  $bodyMeeting
     * @return \Illuminate\Http\Response
     */
    public function show(BodyMeeting $bodyMeeting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\External_Linkages\BodyMeeting  $bodyMeeting
     * @return \Illuminate\Http\Response
     */
    public function edit(BodyMeeting $bodyMeeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\External_Linkages\BodyMeeting  $bodyMeeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BodyMeeting $bodyMeeting)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            BodyMeeting::where('id', $bodyMeeting->id)->update([
                'participant_name' => $request->participant_name,
                'designation_id' => $request->designation_id,
                'affiliation' => $request->affiliation,
                'statutory_bodies_id' => $request->statutory_bodies_id,
                'meeting_date' => $request->meeting_date,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Body Meeting updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\External_Linkages\BodyMeeting  $bodyMeeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(BodyMeeting $bodyMeeting)
    {
        try {
        BodyMeeting::where('id', $bodyMeeting->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
            BodyMeeting::destroy($bodyMeeting->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'participant_name' => 'required',
            'designation_id' => 'required',
            'affiliation' => 'required',
            'statutory_bodies_id' => 'required',
            'meeting_date' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
