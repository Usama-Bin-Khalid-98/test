<?php

namespace App\Http\Controllers;

use App\Mentoring\ScheduleMentorMeeting;
use App\Models\Common\Slip;
use App\Models\Config\NbeacBasicInfo;
use App\Models\MentoringMeeting;
use App\Models\MentoringMentor;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class ScheduleMentorMeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
       // dd($id);
        $query = "
        SELECT slips.*, campuses.location as campus, departments.name as department, users.name as user, users.email, users.contact_no,
        business_schools.name as school
        FROM slips, campuses, departments, business_schools, users
        WHERE slips.business_school_id=campuses.id
        AND departments.id=slips.department_id
        AND campuses.business_school_id=business_schools.id
        AND users.id = slips.created_by
        AND slips.status ='approved' AND slips.regStatus = 'Mentoring'";
        $id ? $query .= ' AND slips.id = ' . $id : '';
        $registrations = DB::select($query, array());

        $mentors = User::where(['user_type'=>'Mentor', 'status'=>'active'])->get();
//        dd($registrations);

        $MeetingMentors = MentoringMentor::with('slip', 'user')->where('slip_id', $id)->get();
//        dd($MeetingMentors);
        $MentorsDates = ScheduleMentorMeeting::with('slip', 'user')
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
        $availability = ScheduleMentorMeeting::where(['slip_id'=> $id, 'user_id'=>Auth::id()])->get();
        $availability_percent = ScheduleMentorMeeting::where(['slip_id'=> $id])->get();
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
        return view('mentoring.scheduler', compact('registrations', 'mentors','MentorsDates', 'userDates', 'MeetingMentors', 'maxSelectedDate'));
    }

    public function doublemax($mylist){
        @$maxvalue=max($mylist);
        foreach ($mylist as $key=>$value) {
            if($value==$maxvalue)$maxindex=$key;
        }
        return @$maxindex;
        //return array("m"=>$maxvalue,"i"=>$maxindex);
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
                $update = ScheduleMentorMeeting::where(['slip_id' => $request->slip_id, 'availability_dates' =>$request->dateVal])->update(['is_confirm' => $request->confirm]);
                if($update){
                    return response()->json(['success' => 'updated successfully'], 200);
                }

            } catch (Exception $e) {
                return response()->json(['message' =>$e->getMessage()], 422);
            }
        }
//        dd($request->all());

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
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }else{
            try {

                $getSchoolInfoCheck = MentoringMeeting::where('slip_id', $request->registrations)->exists();
                if(!$getSchoolInfoCheck) {
                    $getSchoolInfo = Slip::where('id', $request->registrations)->get()->first();
                    $esScheduleDateTime = $request->esScheduleDateTime;
                    $dateArray = explode('-', $esScheduleDateTime);
                    $start = Carbon::parse(trim($dateArray[0]));
                    $end = Carbon::parse(trim($dateArray[1]));
                    //
                    $insert = MentoringMeeting::create([
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

                        $updateSlip = Slip::find($request->registrations)->update(['regStatus'=>'ScheduledMentoring']);

//                        dd($updateSlip);
                        $slipInfo = Slip::find($request->registrations);
                        $getnbeacInfo = NbeacBasicInfo::first();
                        $mailInfo = [
                            'to' => $slipInfo->campus->user->email,
                            'to_name' => $slipInfo->campus->user->name,
                            'school' => $slipInfo->campus->business_school->name,
                            'from' => $getnbeacInfo->email,
                            'from_name' => $getnbeacInfo->name,
                        ];

                        foreach ($request->user_id as $mentor)
                        {
                            $ESReviewers = MentoringMentor::create(['slip_id' => $request->registrations, 'user_id'=>$mentor, 'created_by'=>Auth::id()]);
                            //echo $reviewer;
                        }

                        $letter = '<p>AOA, </p>'.
                            '<p>Dear '. $slipInfo->campus->user->name.'</p>'.
                        '<p><strong>Mentoring for '.@$slipInfo->campus->business_school->name.' '.'.</strong> campus '.$slipInfo->campus->location.' department '.$slipInfo->department->name.' '.
                            ' has been scheduled. generate mentoring invoice and select your availability dates and mentors in mentoring calendar';

                        $data = ['letter' => $letter];
//                    dd($mailInfo);
                        Mail::send('eligibility_screening.email.eligibility_report', $data, function ($message) use ($mailInfo) {
                            //dd($user);
                            $message->to($mailInfo['to'], $mailInfo['to_name'])
                                ->subject('Mentoring Schedule of ' . $mailInfo['school']);
                            $message->from($mailInfo['from'], $mailInfo['from_name']);
                        });
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Mentoring\ScheduleMentorMeeting  $scheduleMentorMeeting
     * @return \Illuminate\Http\Response
     */
    public function show($scheduleMentorMeeting)
    {
        //dd($scheduleMentorMeeting->id);
        //

        try {
            if($scheduleMentorMeeting)
            {
                $mentoringMeetings = MentoringMeeting::where('slip_id', $scheduleMentorMeeting)->get();
            }else{
                $mentoringMeetings = MentoringMeeting::all();
            }
         return response()->json($mentoringMeetings, 200);
        }catch (Exception $e) {
            return response(['message' => $e->getMessage()]);
        }
    }

 public function MentorScheduler($scheduleMentorMeeting = null)
    {
        if(Auth::user()->user_type=='Mentor') {
//            dd('mentors ');
            $MentoringMeetings = DB::table('slips as s')
                ->join('campuses as c', 'c.id', '=', 's.business_school_id')
                ->join('departments as d', 'd.id', '=', 's.department_id')
                ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
                ->join('mentoring_mentors as mm', 's.id', '=', 'mm.slip_id')
                ->join('users as u', 'u.id', '=', 'mm.user_id')
                ->select('s.*', 'c.location as campus','c.id as campus_id', 'd.name as department', 'u.name as user', 'u.email', 'u.contact_no', 'bs.name as school', 'bs.id as business_school_id')
                ->where('s.regStatus', 'ScheduledMentoring')
                ->orWhere('s.regStatus', 'Mentoring')
                ->where('s.status', 'approved')
                ->where('mm.user_id', Auth::id())
                ->get();
            //dd($MentoringMeetings);
        }else {
            $MentoringMeetings = DB::table('slips as s')
                ->join('campuses as c', 'c.id', '=', 's.business_school_id')
                ->join('departments as d', 'd.id', '=', 's.department_id')
                ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
                ->join('users as u', 'u.id', '=', 's.created_by')
//                ->join('mentoring_mentors as mm', 'u.id', '=', 'mm.user_id')
                ->select('s.*', 'c.location as campus','c.id as campus_id', 'd.name as department', 'u.name as user', 'u.email', 'u.contact_no', 'bs.name as school', 'bs.id as business_school_id')
                ->where('s.regStatus', 'ScheduledMentoring')
                ->orWhere('s.regStatus', 'Mentoring')
                ->where('s.status', 'approved')
                ->get();
        }

        return view('mentoring.mentoring_meetings', compact('MentoringMeetings'));
    }


    public function getMentoringAllEvents($id =null)
    {
        $userInfo = Auth::user();
        $MentoringMeetings = Slip::with('mentoring_meeting', 'mentoring_mentor')
            ->whereHas('mentoring_mentor', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->where([
                    'regStatus' =>'ScheduledMentoring',
                    'status'=>'approved'
                ]
            )->get();

        return response()->json($MentoringMeetings);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * */
    public function mentorsAvailability(Request $request)
    {
//        dd($request->all());
        $validation = Validator::make($request->all(), $this->Availability_rules(), $this->messages());
        if ($validation->fails()) {
            return response()->json($validation->messages()->all(), 422);
        } else {
            try {
                $dates = explode(',', $request->dates);
                $getEvent = MentoringMeeting::where('id', $request->mentorsmeeting_id)->get()->first();
                // dd($getEvent);
                foreach ($dates as $date_val)
                {
                    $check= ScheduleMentorMeeting::where([
//                        'campus_id' =>$getEvent->campus_id,
//                        'department_id' =>$getEvent->department_id,
                        'slip_id' =>$getEvent->slip_id,
                        'user_id' =>Auth::id(),
                        'availability_dates' => date('Y-m-d', strtotime($date_val))])->exists();
                    // dd($check);
                    if(!$check) {
                        ScheduleMentorMeeting::create([
//                            'campus_id' => $getEvent->campus_id,
//                            'department_id' => $getEvent->department_id,
                            'slip_id' => $getEvent->slip_id,
                            'user_id' => Auth::id(),
                            'availability_dates' => date('Y-m-d', strtotime($date_val))
                        ]);
                    }
                }

                if($request->mentors) {
                    $slip_id = $getEvent->slip_id;
                    $delete_old_mentors = MentoringMentor::where('slip_id', $slip_id)->delete();
                    $slipInfo = Slip::with('campus', 'department')->find($slip_id)->first();
                    if($delete_old_mentors) {
                        foreach ($request->mentors as $mentor) {
                            $getMentor = User::find($mentor);
                            $letter = '<p>AOA, </p>'.
                                '<p>Dear '. $getMentor->name.' </p>'.
                                '<p><strong>The case of '.@$slipInfo->campus->business_school->name.' '.'.</strong> campus '.$slipInfo->campus->location.' department '.$slipInfo->department->name.' '.
                                'has been assigned to you. please check mentoring calender and add your availability dates.';

                            $data = ['letter' => $letter];
                            $getnbeacInfo = NbeacBasicInfo::first();
                            $mailInfo = [
                                'to' => $slipInfo->campus->user->email,
                                'to_name' => $slipInfo->campus->user->name,
                                'school' => $slipInfo->campus->business_school->name,
                                'from' => $getnbeacInfo->email,
                                'from_name' => $getnbeacInfo->name,
                            ];
//                    dd($mailInfo);
                            Mail::send('eligibility_screening.email.eligibility_report', $data, function ($message) use ($mailInfo) {
                                //dd($user);
                                $message->to($mailInfo['to'], $mailInfo['to_name'])
                                    ->subject('Mentoring Schedule of ' . $mailInfo['school']);
                                $message->from($mailInfo['from'], $mailInfo['from_name']);
                            });
                            $insert_new = MentoringMentor::create(['slip_id' => $slip_id, 'user_id' => $mentor, 'created_by' => Auth::id()]);

                        }
                    }
                }



                return response()->json(['success' => 'Your availability dates and mentors added Successfully'], 200);
//                dd($request->all());
            }catch (Exception $e)
            {
                return response()->json(['message' =>$e->getMessage()], 422);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mentoring\ScheduleMentorMeeting  $scheduleMentorMeeting
     * @return \Illuminate\Http\Response
     */
    public function edit($id=null)
    {
        $query = "
        SELECT slips.*, campuses.location as campus, departments.name as department, users.name as user, users.email, users.contact_no,
        business_schools.name as school
        FROM slips, campuses, departments, business_schools, users
        WHERE slips.business_school_id=campuses.id
        AND departments.id=slips.department_id
        AND campuses.business_school_id=business_schools.id
        AND users.id = slips.created_by
        AND slips.status ='approved' AND slips.regStatus = 'ScheduledMentoring'";
        $id ? $query .= ' AND slips.id = ' . $id : '';
        $registrations = DB::select($query, array());

        $mentors = User::where(['user_type'=>'Mentor', 'status'=>'active'])->get();
        dd($registrations);

//        $reviewers = ReviewerAvailability::with('slip', 'user')->where('slip_id', $id)->get();
////        dd($reviewers);
//        $reviewersDates = ReviewerAvailability::with('slip', 'user')->where('slip_id', $id)->get()->groupBy('user_id');
//        $userDates = [];
////         dd($reviewersDates);
//        $count = 0;
//        if ($reviewersDates){
//            foreach ($reviewersDates as $key => $review) {
//                $userDates[$count]['user_name'] = $review[0]->user->name;
//                $userDates[$count]['dates'] = [];
//                $i = 0;
//                foreach ($review as $val) {
//                    $userDates[$count]['dates'][$i] = $val->availability_dates;
//                    $i++;
//                }
//                $count++;
//            }
//        }
//        //dd($userDates);
//        $availability = ReviewerAvailability::where(['slip_id'=> $id, 'user_id'=>Auth::id()])->get();
//        $availability_percent = ReviewerAvailability::where(['slip_id'=> $id])->get();
//        $dates = [];
//        $count=0;
//
//        foreach ($availability_percent as $availability_date)
//        {
//            $dates[$count] = $availability_date->availability_dates;
//            $count++;
//        }
//        $count_val = array_count_values($dates);
//        $maxSelectedDate = $this->doublemax($count_val);
        return view('mentoring.scheduler', compact('registrations', 'mentors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mentoring\ScheduleMentorMeeting  $scheduleMentorMeeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleMentorMeeting $scheduleMentorMeeting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mentoring\ScheduleMentorMeeting  $scheduleMentorMeeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScheduleMentorMeeting $scheduleMentorMeeting)
    {
        //
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

    protected function report_rules() {
        return [
            'slip_id'=> 'required',
//            'comments'=> 'required',
            'status'=> 'required',
        ];
    }
    protected function messages() {
        return [
            'required'=> 'The :attribute can not be blanked. '
        ];
    }
}
