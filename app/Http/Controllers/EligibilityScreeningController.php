<?php

namespace App\Http\Controllers;

use App\Models\Common\Slip;
use App\Models\EligibilityScreening\EligibilityScreening;
use App\Models\EligibilityScreening\ESReviewer;
use App\Models\EligibilityScreening\ReviewerAvailability;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use function GuzzleHttp\Promise\queue;


class EligibilityScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $registrations = Slip::where(['status' => 'paid'])->get();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function schedule($id=null)
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
        AND slips.status ='paid' AND slips.regStatus = 'Eligibility'";
        $id ? $query .= ' AND slips.id = ' . $id : '';
        $registrations = DB::select($query, array());
        //dd($registrations);
        //$reviewers = User::role('PeerReviewer')->get();

        $reviewers = ReviewerAvailability::with('slip', 'user')->where('slip_id', $id)->get();
        $reviewersDates = ReviewerAvailability::with('slip', 'user')->where('slip_id', $id)->get()->groupBy('user_id');
        $userDates = [];
        // dd($reviewersDates);
        $count = 0;
        if ($reviewersDates){
            foreach ($reviewersDates as $key => $review) {
                $userDates[$count]['user_name'] = $review[$count]->user->name;
                $userDates[$count]['dates'] = [];
                $i = 0;
                foreach ($review as $val) {
                    $userDates[$count]['dates'][$i] = $val->availability_dates;
                    $i++;
                }
                $count++;
            }
        }
        //dd($userDates);
        $availability = ReviewerAvailability::where(['slip_id'=> $id, 'user_id'=>Auth::id()])->get();
        $availability_percent = ReviewerAvailability::where(['slip_id'=> $id])->get();
        $dates = [];

        $count=0;

        foreach ($availability_percent as $availability_date)
        {
            $dates[$count] = $availability_date->availability_dates;
//
//            $userDates[$count]['user_id'] = $availability_date->user_id;
//            $userDates[$count]['dates'] = $availability_date->availability_dates;
            $count++;
        }

//        foreach ($userDates as $datessss)
//        {
//            dd($datessss['user_name']);
//        }
//        dd($userDates);
        $count_val = array_count_values($dates);
        $maxSelectedDate = $this->doublemax($count_val);
        //$count_val_max = max($count_val);

//        dd($maxIndex);
        return view('eligibility_screening.scheduler', compact('registrations', 'reviewers','userDates', 'availability','maxSelectedDate'));

    }

    public function doublemax($mylist){
        $maxvalue=max($mylist);
        foreach ($mylist as $key=>$value) {
            if($value==$maxvalue)$maxindex=$key;
        }
        return $maxindex;
        //return array("m"=>$maxvalue,"i"=>$maxindex);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function esNotifyAll(Request $request)
    {
        //
        //dd($request->reviewers);
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }else{
            try {

                $getSchoolInfoCheck = EligibilityScreening::where('slip_id', $request->registrations)->exists();
                if(!$getSchoolInfoCheck) {
                    $getSchoolInfo = Slip::where('id', $request->registrations)->get()->first();
                    $esScheduleDateTime = $request->esScheduleDateTime;
                    $dateArray = explode('-', $esScheduleDateTime);
                    $start = Carbon::parse(trim($dateArray[0]));
                    $end = Carbon::parse(trim($dateArray[1]));
                    //
                    $insert = EligibilityScreening::create([
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

                        foreach ($request->reviewers as $reviewer)
                        {
                            $ESReviewers = ESReviewer::create(['slip_id' => $request->registrations, 'user_id'=>$reviewer, 'created_by'=>Auth::id()]);
                            //echo $reviewer;
                        }
                        $updateSlip = Slip::find($request->registrations)->update(['regStatus'=>'ScheduledES']);
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
     * @param  \App\Models\EligibilityScreening\EligibilityScreening  $eligibilityScreening
     * @return \Illuminate\Http\Response
     */
    public function show(EligibilityScreening $eligibilityScreening)
    {
        //
        $eligibilityScreening = EligibilityScreening::all();
//        $events = [];
//        $index = 0;
//        foreach ($eligibilityScreening as $event){
//            //Sat Aug 29 2020 00:00:00 GMT-0400 (Eastern Daylight Time)
//            $events[$index]['title'] = $event->title;
//            //dd(Carbon::parse($event->start)->format('D M d Y H:i:s').' GMT-0400 (Eastern Daylight Time');
//
//            $events[$index]['start'] = Carbon::parse($event->start)->format('D M d Y H:i:s').' GMT-0400 (Eastern Daylight Time)';
//            $events[$index]['end'] = Carbon::parse($event->end)->format('D M d Y H:i:s').' GMT-0400 (Eastern Daylight Time)';
//            $events[$index]['backgroundColor'] = $event->backgroundColor;
//            $events[$index]['borderColor'] = $event->borderColor;
//            $index++;
//        }
        return response()->json($eligibilityScreening);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EligibilityScreening\EligibilityScreening  $eligibilityScreening
     * @return \Illuminate\Http\Response
     */
    public function getReviewerAllEvents(EligibilityScreening $eligibilityScreening)
    {
        //
        $userInfo = Auth::user();
        $eligibilityScreening = Slip::with('eligibility_screening', 'e_s_reviewer')
            ->whereHas('e_s_reviewer', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->where([
                'regStatus' =>'ScheduledES',
                'status'=>'paid'
                ]
            )->get();
       // dd($eligibilityScreening);
//        $events = [];
//        $index = 0;
//        foreach ($eligibilityScreening as $event){
//            //Sat Aug 29 2020 00:00:00 GMT-0400 (Eastern Daylight Time)
//            $events[$index]['title'] = $event->title;
//            //dd(Carbon::parse($event->start)->format('D M d Y H:i:s').' GMT-0400 (Eastern Daylight Time');
//
//            $events[$index]['start'] = Carbon::parse($event->start)->format('D M d Y H:i:s').' GMT-0400 (Eastern Daylight Time)';
//            $events[$index]['end'] = Carbon::parse($event->end)->format('D M d Y H:i:s').' GMT-0400 (Eastern Daylight Time)';
//            $events[$index]['backgroundColor'] = $event->backgroundColor;
//            $events[$index]['borderColor'] = $event->borderColor;
//            $index++;
//        }
        return response()->json($eligibilityScreening);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EligibilityScreening\EligibilityScreening  $eligibilityScreening
     * @return \Illuminate\Http\Response
     */
    public function edit(EligibilityScreening $eligibilityScreening)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EligibilityScreening\EligibilityScreening  $eligibilityScreening
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EligibilityScreening $eligibilityScreening)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EligibilityScreening\EligibilityScreening  $eligibilityScreening
     * @return \Illuminate\Http\Response
     */
    public function destroy(EligibilityScreening $eligibilityScreening)
    {
        //
    }

    protected function rules() {
        return [
            'registrations'=> 'required',
            'esScheduleDateTime'=> 'required',
            'reviewers'=> 'required',
        ];
    }
    protected function messages() {
        return [
            'required'=> 'The :attribute can not be blanked. '
        ];
    }
}
