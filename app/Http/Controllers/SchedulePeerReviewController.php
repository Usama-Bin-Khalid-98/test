<?php

namespace App\Http\Controllers;
use App\Models\Common\Slip;
use App\Models\Config\NbeacBasicInfo;
use App\Models\PeerReview\PeerReviewReviewer;
use App\Models\PeerReview\PeerReviewVisit;
use App\Models\PeerReview\SchedulePeerReview;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class SchedulePeerReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        //
//        dd("working here");
        $query = "
        SELECT slips.*, campuses.location as campus, departments.name as department, users.name as user, users.email, users.contact_no,
        business_schools.name as school
        FROM slips, campuses, departments, business_schools, users
        WHERE slips.business_school_id=campuses.id
        AND departments.id=slips.department_id
        AND campuses.business_school_id=business_schools.id
        AND users.id = slips.created_by
        AND slips.status = 'approved' AND slips.regStatus = 'PeerReviewVisit'";
        Auth::user()->user_type==='BusinessSchool' ? $query .= ' AND slips.department_id = ' . Auth::user()->department_id. ' AND slips.business_school_id = '. Auth::user()->campus_id : '';
        $registrations = DB::select($query, array());

        $NbeacFocalPerson = User::where(['user_type'=>'Mentor'])
            ->orWhere(['user_type'=> 'PeerReviewer'])
            ->where(['status'=>'active'])->get();
//        dd($registrations);

        $MeetingMentors = PeerReviewReviewer::with('slip', 'user')->where('slip_id', $id)->get();
//        dd($MeetingMentors);
        $MentorsDates = SchedulePeerReview::with('slip', 'user')
            ->where(['slip_id'=> $id])
            ->get()
            ->groupBy('user_id');

        $userDates = [];
//         dd($MentorsDates);
        $count = 0;
        if ($MentorsDates){
            foreach ($MentorsDates as $key => $ment) {
                $userDates[$count]['user_name'] = $ment[0]->user->name;
                $userDates[$count]['user_type'] = $ment[0]->user->user_type;
                $userDates[$count]['dates'] = [];
                $i = 0;
                foreach ($ment as $val) {
                    $userDates[$count]['dates'][$i] = $val->availability_dates;
                    $i++;
                }
                $count++;
            }
        }
//        dd($userDates);
        $availability = SchedulePeerReview::where(['slip_id'=> $id, 'user_id'=>Auth::id()])->get();
        $availability_percent = SchedulePeerReview::where(['slip_id'=> $id])->get();
//        foreach ($MentorsDates as $dates)
//        {
//            foreach ($dates as $date) {
//                dd($date->availability_dates);
//            }
//        }
//        dd($MentorsDates);

        $dates = [];
        $count=0;

        foreach ($availability_percent as $availability_date)
        {
            $dates[$count] = $availability_date->availability_dates;
            $count++;
        }
        $count_val = array_count_values($dates);
        $maxSelectedDate = $this->doublemax($count_val);
        return view('peer_review_visit.scheduler', compact('registrations', 'NbeacFocalPerson','MentorsDates', 'userDates', 'MeetingMentors', 'maxSelectedDate'));
    }

    public function doublemax($mylist){
        @$maxvalue=max($mylist);
        foreach ($mylist as $key=>$value) {
            if($value==$maxvalue)$maxindex=$key;
        }
        return @$maxindex;
        //return array("m"=>$maxvalue,"i"=>$maxindex);
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
//        dd($request->all());
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }else{
            try {

                $getSchoolInfoCheck = PeerReviewVisit::where('slip_id', $request->registrations)->exists();
                if(!$getSchoolInfoCheck) {
                    $getSchoolInfo = Slip::with('campus', 'department')
                        ->where('id', $request->registrations)
                        ->get()->first();
                    $esScheduleDateTime = $request->esScheduleDateTime;
                    $dateArray = explode('-', $esScheduleDateTime);
                    $start = Carbon::parse(trim($dateArray[0]));
                    $end = Carbon::parse(trim($dateArray[1]));
                    //
                    $insert = PeerReviewVisit::create([
                        'campus_id' => $getSchoolInfo->business_school_id,
                        'department_id' => $getSchoolInfo->department_id,
                        'slip_id' => $request->registrations,
                        'title' => $request->title,
                        'start' => $start->format('Y-m-d H:i:s'),
                        'end' => $end->format('Y-m-d H:i:s'),
                        'allDay' => false,
                        'backgroundColor' => $request->color ?? '#706ade',
                        'borderColor' => $request->color ?? '#706ade',
                        'status' => 'active',
                        'created_by' => Auth::id()
                    ]);
                    if ($insert) {

                        foreach ($request->user_id as $mentor)
                        {
                            $ESReviewers = PeerReviewReviewer::create(
                                [
                                    'slip_id' => $request->registrations,
                                    'user_id'=>$mentor, 'created_by'=>Auth::id(),
                                    'status' => 'no'
                                ]);
                            //echo $reviewer;


                            $mentorInfo = User::find($mentor)->first();
                            $slipInfoSchool = Slip::with('campus')->where(['id'=>$request->registrations])->first();

                            $getNbeacInfo = NbeacBasicInfo::all()->first();

                            $mailData['nbeac']= $getNbeacInfo;

                           //////// email
//                            $header = 'AOA <br/>'. $mentorInfo->name;
//                                            $comments = 'The business school ( '. $slipInfoSchool->campus->business_school->name. ' '. $slipInfoSchool->campus->location. ' department '.$slipInfoSchool->department->name.' ) '
//                                                . ' has been submitted SAR for review.';
//                                            $footer = '<p>Yours Sincerely,</p>' .
//                                                '<p>&nbsp;</p>' .
//                                                '<p>' . $slipInfoSchool->campus->user->name . '</p>';
//                            ///
//                            $data = ['letter' => $header. '<br/>'.$comments.$footer];
//
//                            $mailInfo = [
//                                'to' => $mentorInfo->email??'',
//                                'to_name' => $mentorInfo->name??'',
//                                'school' => $getSchoolInfo->business_school->name??'',
//                                'from' => $getNbeacInfo->email??'info@nbeac.org.pk',
//                                'from_name' => $getNbeacInfo->director??'',
//                            ];

//                            Mail::send('peer_review_visit.email.email', ['letter' => $mailData], function($message) use ($mailInfo) {
//                                //dd($user);
//                                $message->to($mailInfo['to'],$mailInfo['to_name'] )
//                                    ->subject($mailInfo['school'].' Peer Review Visit Scheduled');
//                                $message->from($mailInfo['from'],$mailInfo['from_name']);
//                            });
                        }
                        $updateSlip = Slip::find($request->registrations)->update(['regStatus'=>'ScheduledPRVisit']);

                        //////////////// Send and email to NBEAC for Reviewers Approval/////
                        /// ////////////////  email here          /// //////////
                        ///
                        //////// email
                        $header_nbeac_email = 'AOA <br/>'. $mentorInfo->name;
                        $comments_nbeac_email = 'The business school ( '. $slipInfoSchool->campus->business_school->name. ' '. $slipInfoSchool->campus->location. ' department '.$slipInfoSchool->department->name.' ) '
                            . ' Schedule Peer Review Visit. please review and select the Peer Reviewers.';
                        $footer_nbeac_email = '<p>Yours Sincerely,</p>' .
                            '<p>&nbsp;</p>' .
                            '<p>' . $slipInfoSchool->campus->user->name . '</p>';
                        ///
                        $data_nbeac_email = ['letter' => $header_nbeac_email. '<br/>'.$comments_nbeac_email.'<br/>'.$footer_nbeac_email];

                        $mailSchoolInfo = [
                            'to' => $getNbeacInfo->email,
                            'to_name' => $getNbeacInfo->director,
                            'school' => $getNbeacInfo->name??'',
                            'from' => Auth::user()->email??'',
                            'from_name' => Auth::user()->name??'',
                        ];

                        Mail::send('peer_review_visit.email.email',  $data_nbeac_email, function($message) use ($mailSchoolInfo) {
                            //dd($user);
                            $message->to($mailSchoolInfo['to'],$mailSchoolInfo['to_name'] )
                                ->subject('Schedule Peer Review Visit of '. $mailSchoolInfo['school']);
                            $message->from($mailSchoolInfo['from'],$mailSchoolInfo['from_name']);
                        });

                        //////////////// Send and email to NBEAC for Reviewers Approval/////
                        return response()->json(['success' => 'Notification sent Successfully'], 200);
                    }
                }
                return response()->json(['message' => 'Record already Exists'], 422);
            }catch (Exception $e)
            {
                return response()->json(['message' =>$e->getMessage()], 422);
            }
        }

    }

    public function approvedConsultative(Request $request) {

            try {

                    if ($request->id) {
                        $slipInfoSchool = Slip::with('campus')->where(['id'=>$request->id])->first();
                        $getNbeacInfo = NbeacBasicInfo::all()->first();

                        foreach ($request->user_id as $mentor)
                        {
                            $check = PeerReviewReviewer::where(
                                ['slip_id' => $request->id,
                                'user_id'=>$mentor])->exists();
                            if($check)
                            {
                            $ESReviewers = PeerReviewReviewer::where(['slip_id'=>$request->id, 'user_id'=> $mentor])->update(
                                [
                                    'status' => 'yes'
                                ]);
                            }else{
                                $createPeer = PeerReviewReviewer::create(
                                    [
                                        'slip_id'=>$request->id, 'user_id'=> $mentor, 'status'=>'yes','created_by'=> Auth::id()
                                    ]);
                            }

                            $mentorInfo = User::find($mentor)->first();


                            $mailData['nbeac']= $getNbeacInfo;

                            //////// email
                            $header = 'AOA <br/>'. $mentorInfo->name;
                                $comments = 'The Consultative Committee selected you for the peer review visit of business school ( '. $slipInfoSchool->campus->business_school->name. ' '. $slipInfoSchool->campus->location. ' department '.$slipInfoSchool->department->name.' ) ';
                                $footer = '<p>Yours Sincerely,</p>' .
                                    '<p>&nbsp;</p>' .
                                    '<p>' . $slipInfoSchool->campus->user->name . '</p>';
                            ///
                            $data = ['letter' => $header. '<br/>'.$comments.$footer];

                            $mailInfo = [
                                'to' => $mentorInfo->email??'',
                                'to_name' => $mentorInfo->name??'',
                                'school' => $slipInfoSchool->business_school->name??'',
                                'from' => $getNbeacInfo->email??'info@nbeac.org.pk',
                                'from_name' => $getNbeacInfo->director??'',
                            ];

                            Mail::send('peer_review_visit.email.email', $data, function($message) use ($mailInfo) {
                                //dd($user);
                                $message->to($mailInfo['to'],$mailInfo['to_name'] )
                                    ->subject($mailInfo['school'].' Peer Review Visit Scheduled');
                                $message->from($mailInfo['from'],$mailInfo['from_name']);
                            });
                        }
//                        $updateSlip = Slip::find($request->id)->update(['regStatus'=>'ScheduledPRVisit']);
                        //////////////// Send and email to NBEAC for Reviewers Approval/////
                        /// ////////////////  email here          /// //////////
                        ///
                        //////// email
                        $header_nbeac_email = 'AOA <br/>'. $slipInfoSchool->campus->user->name;
                        $comments_nbeac_email = 'The business school ( '. $slipInfoSchool->campus->business_school->name. ' '. $slipInfoSchool->campus->location. ' department '.$slipInfoSchool->department->name.' ) '
                            . ' Scheduled a Peer Review Visit. please review and select your availability date.';
                        $footer_nbeac_email = '<p>Yours Sincerely,</p>' .
                            '<p>&nbsp;</p>' .
                            '<p>' . $getNbeacInfo->director . '</p>';
                        ///
                        $data_nbeac_email = ['letter' => $header_nbeac_email. '<br/>'.$comments_nbeac_email.'<br/>'.$footer_nbeac_email];

                        $mailSchoolInfo = [
                            'to' => $slipInfoSchool->campus->user->email,
                            'to_name' => $slipInfoSchool->campus->user->name,
                            'school' => $slipInfoSchool->campus->business_school->name??'',
                            'from' => $getNbeacInfo->email??'',
                            'from_name' => $getNbeacInfo->director??'',
                        ];

                        Mail::send('peer_review_visit.email.email',  $data_nbeac_email, function($message) use ($mailSchoolInfo) {
                            //dd($user);
                            $message->to($mailSchoolInfo['to'],$mailSchoolInfo['to_name'] )
                                ->subject('Schedule Peer Review Visit of '. $mailSchoolInfo['school']);
                            $message->from($mailSchoolInfo['from'],$mailSchoolInfo['from_name']);
                        });

                        //////////////// Send and email to NBEAC for Reviewers Approval/////
                        return response()->json(['success' => 'Notification sent Successfully'], 200);
                    }

                return response()->json(['message' => 'Record already Exists'], 422);
            }catch (Exception $e)
            {
                return response()->json(['message' =>$e->getMessage()], 422);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PeerReview\SchedulePeerReview  $schedulePeerReview
     * @return \Illuminate\Http\Response
     */
    public function show($schedulePeerReview)
    {
        //
//        dd($schedulePeerReview);
        try {
            if($schedulePeerReview)
            {
                $mentoringMeetings = PeerReviewVisit::where('slip_id', $schedulePeerReview)->get();
            }else{
                $mentoringMeetings = PeerReviewVisit::all();
            }
            return response()->json($mentoringMeetings, 200);
        }catch (Exception $e) {
            return response(['message' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PeerReview\SchedulePeerReview  $schedulePeerReview
     * @return \Illuminate\Http\Response
     */
    public function edit(SchedulePeerReview $schedulePeerReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PeerReview\SchedulePeerReview  $schedulePeerReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchedulePeerReview $schedulePeerReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PeerReview\SchedulePeerReview  $schedulePeerReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchedulePeerReview $schedulePeerReview)
    {
        //
    }

    public function changeConfirmStatus(Request $request)
    {
//        dd($request->all());
        $validation = Validator::make($request->all(), ['slip_id'=>'required', 'dateVal' => 'required'], $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }else {
            try {
                $update = SchedulePeerReview::where(['slip_id' => $request->slip_id, 'availability_dates' =>$request->dateVal])->update(['is_confirm' => $request->confirm??'no']);
                if($update){
                    return response()->json(['success' => 'updated successfully'], 200);
                }

            } catch (Exception $e) {
                return response()->json(['message' =>$e->getMessage()], 422);
            }
        }
//        dd($request->all());

    }


    public function businessSchoolAvailability(Request $request)
    {
//        dd($request->all());
        $validation = Validator::make($request->all(), $this->Availability_rules(), $this->messages());
        if ($validation->fails()) {
            return response()->json($validation->messages()->all(), 422);
        } else {
            try {
                $dates = explode(',', $request->dates);
                $getEvent = PeerReviewVisit::where('id', $request->mentorsmeeting_id)->get()->first();
                // dd($getEvent);
                foreach ($dates as $date_val)
                {
                    $check= SchedulePeerReview::where([
//                        'campus_id' =>$getEvent->campus_id,
//                        'department_id' =>$getEvent->department_id,
                        'slip_id' =>$getEvent->slip_id,
                        'user_id' =>Auth::id(),
                        'availability_dates' => date('Y-m-d', strtotime($date_val))])->exists();
                    // dd($check);
                    if(!$check) {
                        SchedulePeerReview::create([
//                            'campus_id' => $getEvent->campus_id,
//                            'department_id' => $getEvent->department_id,
                            'slip_id' => $getEvent->slip_id,
                            'user_id' => Auth::id(),
                            'availability_dates' => date('Y-m-d', strtotime($date_val))
                        ]);
                    }
                }
                return response()->json(['success' => 'Your availability dates added Successfully'], 200);
//                dd($request->all());
            }catch (Exception $e)
            {
                return response()->json(['message' =>$e->getMessage()], 422);
            }
        }
    }

    public function peerAvailability(Request $request)
    {
        $validation = Validator::make($request->all(), $this->Availability_rules(), $this->messages());
        if ($validation->fails()) {
            return response()->json($validation->messages()->all(), 422);
        } else {
            try {
                $dates = explode(',', $request->dates);
                $getEvent = SchedulePeerReview::where('id', $request->mentorsmeeting_id)->get()->first();
                // dd($getEvent);
                foreach ($dates as $date_val)
                {
                    $check= SchedulePeerReview::where([
//                        'campus_id' =>$getEvent->campus_id,
//                        'department_id' =>$getEvent->department_id,
                        'slip_id' =>$getEvent->slip_id,
                        'user_id' =>Auth::id(),
                        'availability_dates' => date('Y-m-d', strtotime($date_val))])->exists();
                    // dd($check);
                    if(!$check) {
                        SchedulePeerReview::create([
//                            'campus_id' => $getEvent->campus_id,
//                            'department_id' => $getEvent->department_id,
                            'slip_id' => $getEvent->slip_id,
                            'user_id' => Auth::id(),
                            'availability_dates' => date('Y-m-d', strtotime($date_val))
                        ]);
                    }
                }
                return response()->json(['success' => 'Your availability dates added Successfully'], 200);
//                dd($request->all());
            }catch (Exception $e)
            {
                return response()->json(['message' =>$e->getMessage()], 422);
            }
        }
    }

    protected function rules() {
        return [
            'registrations'=> 'required',
            'esScheduleDateTime'=> 'required',
            'user_id'=> 'required',
        ];
    }

    protected function Availability_rules() {
        return [
            'dates'=> 'required',
            'mentorsmeeting_id'=> 'required',
        ];
    }

    protected function messages() {
        return [
            'required'=> 'The :attribute can not be blanked. '
        ];
    }
}
