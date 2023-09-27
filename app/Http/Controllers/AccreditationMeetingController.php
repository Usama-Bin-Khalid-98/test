<?php

namespace App\Http\Controllers;

use App\Models\AccreditationAC\AccreditationMeeting;
use App\Models\Common\Slip;
use App\Models\PeerReview\PeerReviewReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class AccreditationMeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccreditationAC\AccreditationMeeting  $accreditationMeeting
     * @return \Illuminate\Http\Response
     */
    public function show($accreditationMeeting)
    {

        $registration = DB::table('slips as s')
            ->join('campuses as c', 'c.id', '=', 's.business_school_id')
            ->join('departments as d', 'd.id', '=', 's.department_id')
            ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
            ->join('accreditation_reviewers as mm', 's.id', '=', 'mm.slip_id')
            ->join('users as u', 'u.id', '=', 'mm.user_id')
            ->select('s.*', 'c.location as campus','c.id as campus_id', 'd.name as department',
                'u.name as user', 'u.email', 'u.contact_no', 'bs.name as school', 'bs.id as business_school_id')
            ->where('s.regStatus', 'AwardCommittee')
            ->orWhere('s.regStatus', 'ScheduledAwardCommittee')
            ->orWhere('s.regStatus', 'AACReview')
            ->orWhere('s.regStatus', 'AACSharedBSFocalPerson')
            ->orWhere('s.regStatus', 'NeedChangesAAC')
            ->orWhere('s.regStatus', 'AACFinal')
            ->orWhere('s.regStatus', 'CouncilMeeting')
            ->orWhere('s.regStatus', 'ScheduledCouncilMeeting')
            ->where('s.status', 'approved')
            ->where('s.id', $accreditationMeeting)
            ->get();

        $peerReview = PeerReviewReport::where(['slip_id'=> $accreditationMeeting, 'status' => 'active'])->get()->first();

//        dd($registration);

//        dd($registration);
        return view('accreditation_award_committee.details', compact('registration','peerReview'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccreditationAC\AccreditationMeeting  $accreditationMeeting
     * @return \Illuminate\Http\Response
     */
    public function edit(AccreditationMeeting $accreditationMeeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccreditationAC\AccreditationMeeting  $accreditationMeeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccreditationMeeting $accreditationMeeting)
    {
        //
//        dd($request->all());
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if ($validation->fails()) {
            return response()->json($validation->messages()->all(), 422);
        }
        else {
            try {
                $request->status === 'EndorseRecommendation'?$AACstatus = 'AACFinal':'';
                $request->status === 'MinorReview'?$AACstatus = 'NeedChangesAAC':'';
                $request->status === 'MajorReview'?$AACstatus = 'NeedMajorChangesAAC':'';

                    $update = Slip::find($request->slip_id)->update(
                        [
                            'regStatus' => $AACstatus,
                            'AACcomments' => $request->comments
                        ]
                    );

                    if($update)
                    {

                        //////////////// Generate Email ////////////////////////////

                        $registration = DB::table('slips as s')
                            ->join('campuses as c', 'c.id', '=', 's.business_school_id')
                            ->join('departments as d', 'd.id', '=', 's.department_id')
                            ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
                            ->join('accreditation_reviewers as mm', 's.id', '=', 'mm.slip_id')
                            ->join('users as u', 'u.id', '=', 'mm.user_id')
                            ->select('s.*', 'c.location as campus','c.id as campus_id',
                                'd.id as department_id', 'd.name as department',
                                'u.name as user', 'u.email', 'u.contact_no',
                                'bs.name as school', 'bs.id as business_school_id')
                            ->where('s.id', $request->slip_id)
                            ->get()->first();

                        $user = Auth::user();
                        $data = array('name'=>$user->name);
                        $data['user'] =$user;
                        $data['registration'] = $registration;
                        $campus_id = $registration->campus_id;
                        $department_id = $registration->department_id;
                        $message['school'] = "test school";

                        $mailInfo = [
                            'to' => $registration->email,
                            'to_name' => $registration->user,
                            'school' => $registration->school,
                            'from' => $user->email,
                            'from_name' => $user->name,
                        ];

                        Mail::send('email_templates.accreditation_report', $data, function($message) use ($mailInfo) {
                            //dd($user);
                            $message->to($mailInfo['to'],$mailInfo['to_name'] )
                                ->subject('AAC Decision & Recommendations - '. $mailInfo['school']);
                        });
                        //////////////// End Email ////////////////////////////////
                        ///
                        return response()->json(['success' => 'comments added successfully'], 200);

                    }

            } catch (Exception $e) {
                return response()->json(['message' => $e->getMessage()], 422);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccreditationAC\AccreditationMeeting  $accreditationMeeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccreditationMeeting $accreditationMeeting)
    {
        //
    }

    protected function rules() {
        return [
            'comments'=> 'required',
            'slip_id'=> 'required',
            'status'=> 'required',
        ];
    }

    protected function messages() {
        return [
            'required'=> 'The :attribute can not be blanked. '
        ];
    }
}
