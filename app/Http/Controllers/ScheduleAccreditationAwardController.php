<?php

namespace App\Http\Controllers;

use App\Mentoring\ScheduleMentorMeeting;
use App\Models\AccreditationAC\AccreditationMeeting;
use App\Models\AccreditationAC\AccreditationReviewer;
use App\Models\AccreditationAC\ScheduleAccreditationAward;
use App\Models\Common\Slip;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class ScheduleAccreditationAwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->user_type == 'NbeacFocalPerson' || Auth::user()->user_type == 'AccreditationAwardCommittee') {
//            dd('mentors ');
            $registrations = DB::table('slips as s')
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
                ->orWhere('s.regStatus', 'CouncilMeeting')
                ->orWhere('s.regStatus', 'ScheduledCouncilMeeting')
                ->orWhere('s.regStatus', 'AACFinal')
                ->where('s.status', 'approved')
//                ->where('mm.user_id', Auth::id())
                ->get();
//            dd($PeerReviewVisit);
        }elseif(Auth::user()->user_type=='BusinessSchool') {
            $registrations = DB::table('slips as s')
                ->join('campuses as c', 'c.id', '=', 's.business_school_id')
                ->join('departments as d', 'd.id', '=', 's.department_id')
                ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
                ->join('users as u', 'u.id', '=', 's.created_by')
//                ->join('mentoring_mentors as mm', 'u.id', '=', 'mm.user_id')
                ->select('s.*', 'c.location as campus','c.id as campus_id', 'd.name as department', 'u.name as user', 'u.email', 'u.contact_no', 'bs.name as school', 'bs.id as business_school_id')
                ->where('s.regStatus', 'AwardCommittee')
                ->orWhere('s.regStatus', 'ScheduledAwardCommittee')
                ->orWhere('s.regStatus', 'AACReview')
                ->orWhere('s.regStatus', 'AACSharedBSFocalPerson')
                ->orWhere('s.regStatus', 'NeedChangesAAC')
                ->orWhere('s.regStatus', 'AACFinal')
                ->get();
        }
        elseif(Auth::user()->user_type=='ESScheduler') {
            $registrations = DB::table('slips as s')
                ->join('campuses as c', 'c.id', '=', 's.business_school_id')
                ->join('departments as d', 'd.id', '=', 's.department_id')
                ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
//                ->join('accreditation_reviewers as mm', 's.id', '=', 'mm.slip_id')
//                ->join('users as u', 'u.id', '=', 'mm.user_id')
                ->select('s.*', 'c.location as campus','c.id as campus_id', 'd.name as department',
                     'bs.name as school', 'bs.id as business_school_id')
                ->where('s.regStatus', 'AwardCommittee')
                ->orWhere('s.regStatus', 'ScheduledAwardCommittee')
                ->orWhere('s.regStatus', 'AACReview')
                ->orWhere('s.regStatus', 'AACSharedBSFocalPerson')
                ->orWhere('s.regStatus', 'NeedChangesAAC')
                ->orWhere('s.regStatus', 'CouncilMeeting')
                ->orWhere('s.regStatus', 'ScheduledCouncilMeeting')
                ->orWhere('s.regStatus', 'AACFinal')
                ->where('s.status', 'approved')
//                ->where('mm.user_id', Auth::id())
                ->get();
        }

        return view('accreditation_award_committee.index', compact('registrations'));
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

    public function changeConfirmStatus(Request $request)
    {
//        dd($request->all());
        $validation = Validator::make($request->all(), ['slip_id'=>'required', 'dateVal' => 'required'], $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }else {
            try {
                $update = ScheduleAccreditationAward::where(['slip_id' => $request->slip_id, 'availability_dates' =>$request->dateVal])->update(['is_confirm' => $request->confirm??'no']);
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

                $getSchoolInfoCheck = AccreditationMeeting::where('slip_id', $request->registrations)->exists();
                if(!$getSchoolInfoCheck) {
                    $getSchoolInfo = Slip::where('id', $request->registrations)->get()->first();
                    $esScheduleDateTime = $request->esScheduleDateTime;
                    $dateArray = explode('-', $esScheduleDateTime);
                    $start = Carbon::parse(trim($dateArray[0]));
                    $end = Carbon::parse(trim($dateArray[1]));
                    //
                    $insert = AccreditationMeeting::create([
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
                            $ESReviewers = AccreditationReviewer::create(['slip_id' => $request->registrations, 'user_id'=>$mentor, 'created_by'=>Auth::id()]);
                            //echo $reviewer;
                        }
                        $updateSlip = Slip::find($request->registrations)->update(['regStatus'=>'ScheduledAwardCommittee']);

                        //////////////// Send and email to NBEAC for Reviewers Approval/////
                        /// ////////////////  email here          /// //////////
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccreditationAC\ScheduleAccreditationAward  $scheduleAccreditationAward
     * @return \Illuminate\Http\Response
     */
    public function show($scheduleAccreditationAward)
    {
        //
        try {
            if($scheduleAccreditationAward)
            {
                $meeting = AccreditationMeeting::where('slip_id', $scheduleAccreditationAward)->get();
            }else{
                $meeting = AccreditationMeeting::all();
            }
            return response()->json($meeting, 200);
        }catch (Exception $e) {
            return response(['message' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccreditationAC\ScheduleAccreditationAward  $scheduleAccreditationAward
     * @return \Illuminate\Http\Response
     */
    public function edit(ScheduleAccreditationAward $scheduleAccreditationAward)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccreditationAC\ScheduleAccreditationAward  $scheduleAccreditationAward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleAccreditationAward $scheduleAccreditationAward)
    {
        //
    }

    public function ACAvailability(Request $request)
    {
//        dd($request->all());
        $validation = Validator::make($request->all(), $this->Availability_rules(), $this->messages());
        if ($validation->fails()) {
            return response()->json($validation->messages()->all(), 422);
        } else {
            try {
                $dates = explode(',', $request->dates);
                $getEvent = AccreditationMeeting::where('id', $request->meeting_id)->get()->first();
//                 dd($getEvent);
                foreach ($dates as $date_val)
                {
                    $check= ScheduleAccreditationAward::where([
//                        'campus_id' =>$getEvent->campus_id,
//                        'department_id' =>$getEvent->department_id,
                        'slip_id' =>$getEvent->slip_id,
                        'user_id' =>Auth::id(),
                        'availability_dates' => date('Y-m-d', strtotime($date_val))])->exists();
                    // dd($check);
                    if(!$check) {
                        ScheduleAccreditationAward::create([
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccreditationAC\ScheduleAccreditationAward  $scheduleAccreditationAward
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScheduleAccreditationAward $scheduleAccreditationAward)
    {
        //
    }

    public function accreditation_award_committee($id = null)
    {
        //
        $query = "
        SELECT slips.*, campuses.location as campus, departments.name as department, users.name as user, users.email, users.contact_no,
        business_schools.name as school
        FROM slips, campuses, departments, business_schools, users
        WHERE slips.business_school_id=campuses.id
        AND departments.id=slips.department_id
        AND campuses.business_school_id=business_schools.id
        AND users.id = slips.created_by
        AND slips.status = 'approved' AND slips.regStatus = 'AwardCommittee'";
//        $id ? $query .= ' AND slips.id = ' . $id : '';
        $registrations = DB::select($query, array());

        $NbeacFocalPerson = User::where(['user_type'=>'NbeacFocalPerson', 'status'=>'active'])->get();
//        dd($registrations);

        $MeetingMentors = AccreditationReviewer::with('slip', 'user')->where('slip_id', $id)->get();
//        dd($MeetingMentors);
        $MentorsDates = ScheduleAccreditationAward::with('slip', 'user')
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
        $availability = ScheduleAccreditationAward::where(['slip_id'=> $id, 'user_id'=>Auth::id()])->get();
        $availability_percent = ScheduleAccreditationAward::where(['slip_id'=> $id])->get();
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
        return view('accreditation_award_committee.scheduler', compact('registrations', 'NbeacFocalPerson','MentorsDates', 'userDates', 'MeetingMentors', 'maxSelectedDate'));

    }

    public function doublemax($mylist){
        @$maxvalue=max($mylist);
        foreach ($mylist as $key=>$value) {
            if($value==$maxvalue)$maxindex=$key;
        }
        return @$maxindex;
        //return array("m"=>$maxvalue,"i"=>$maxindex);
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
            'meeting_id'=> 'required',
        ];
    }

    protected function messages() {
        return [
            'required'=> 'The :attribute can not be blanked. '
        ];
    }

}
