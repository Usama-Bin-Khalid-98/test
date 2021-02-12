<?php

namespace App\Http\Controllers;

use App\Models\Common\Slip;
use App\Models\Config\NbeacBasicInfo;
use App\Models\EligibilityScreening\EligibilityReport;
use App\Models\EligibilityScreening\EligibilityScreening;
use App\Models\EligibilityScreening\ESReviewer;
use App\Models\EligibilityScreening\ReviewerAvailability;
use App\Models\StrategicManagement\Scope;
use App\User;
//use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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

    }

    public function changeConfirmStatus(Request $request)
    {
        $validation = Validator::make($request->all(), ['slip_id'=>'required', 'dateVal' => 'required'], $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }else {
            try {
                $update = ReviewerAvailability::where(['slip_id' => $request->slip_id])->update(['is_confirm' => $request->confirm]);
                if($update){
                    return response()->json($validation->messages()->all(), 200);
                }

            } catch (Exception $e) {
                return response()->json(['message' =>$e->getMessage()], 422);
            }
        }
//        dd($request->all());

    }

    public function esReport($id=null)
    {
        $reviewer_availabilities = '';
        if($id) {
            $registrations = DB::table('slips as s')
                ->join('campuses as c', 'c.id', '=', 's.business_school_id')
                ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
                ->join('departments as d', 'd.id', '=', 's.department_id')
                ->select('s.*', 'c.location as campus', 'bs.name as school', 'd.name as department')
//                ->where('s.regStatus', 'ScheduledES')
                ->where('s.id', $id)
                ->get();

            $docInfo = Slip::with('campus', 'department')->where('id',$id)->first();
//            dd($docInfo);

            $registrations_reports = DB::table('slips as s')
                ->join('campuses as c', 'c.id', '=', 's.business_school_id')
                ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
                ->join('departments as d', 'd.id', '=', 's.department_id')
                ->join('eligibility_reports as er', 'er.slip_id', '=', 's.id')
                ->select('s.*', 'c.location as campus', 'bs.name as school', 'd.name as department',
                    'er.status as eligibility_status', 'er.comments', 'er.file', 'er.es_meeting_date', 'er.id as report_id')
//                ->where('s.regStatus', 'Mentoring')
                ->where('s.id', $id)
                ->get();

            $reviewer_availabilities = ReviewerAvailability::where(['slip_id'=>$id])->first();

        }else {
            $registrations = DB::table('slips as s')
                ->join('campuses as c', 'c.id', '=', 's.business_school_id')
                ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
                ->join('departments as d', 'd.id', '=', 's.department_id')
                ->select('s.*', 'c.location as campus', 'bs.name as school', 'd.name as department')
                ->where('s.regStatus', 'ScheduledES')
                ->orWhere('s.regStatus', 'ScheduledPR')
                ->orWhere('s.regStatus', 'Mentoring')
                ->get();

            $registrations_reports = DB::table('slips as s')
                ->join('campuses as c', 'c.id', '=', 's.business_school_id')
                ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
                ->join('departments as d', 'd.id', '=', 's.department_id')
                ->join('eligibility_reports as er', 'er.slip_id', '=', 's.id')
                ->select('s.*', 'c.location as campus', 'bs.name as school', 'd.name as department',
                    'er.status as eligibility_status','er.id as report_id', 'er.comments', 'er.file')
                ->where('s.regStatus', 'ScheduledES')
                ->orWhere('s.regStatus', 'ScheduledPR')
                ->orWhere('s.regStatus', 'Mentoring')
                ->get();
            $docInfo = Slip::with('campus', 'department')->where(
                [
                'business_school_id' => @$registrations[0]->business_school_id,
                'department_id' => @$registrations[0]->department_id
            ])->first();

        }

        $getnbeacInfo = NbeacBasicInfo::first();
        $getPrograms = Scope::with('program')->where(
            [
                'campus_id' => @$registrations[0]->business_school_id,
                'department_id' => @$registrations[0]->department_id
            ])->get();

        $count = $getPrograms->count();
        $programs = '';
        foreach ($getPrograms as $key => $scope) {
            $programs .= $scope->program->name;
            if($key !== $count-1)
            $programs.=', ';
        }
//        dd($programs);


        $header = '<table cellspacing="0" style="border-collapse:collapse; width:80%">'.
            '<tbody>'.
            '<tr>'.
            '<td style="background-color:white; height:16px; vertical-align:top; width:80%">'.
            '<p><strong>Mr/Ms.  '.@$docInfo->campus->user->name.'</strong><br />'.
            '<strong>'.@$docInfo->campus->user->designation->name.',&nbsp; '.@$docInfo->department->name.'</strong><br />'.
            '<strong>'.@$docInfo->campus->business_school->name.'</strong></p>'.
            '</td>'.
            '<td style="background-color:white; height:16px; vertical-align:top; width:50%">'.
//            '    <p><strong>Ref. No: </strong><strong>KASBIT /NBEAC-ESC/15/3</strong><br />'.
            '<strong>Dated: </strong><strong>'.date('Y-m-d').'</strong></p>'.
            '</td>'.
            '</tr>'.
            '</tbody>'.
            '</table>';

        $footer = '<p>Yours Sincerely,</p>'.
            '<p>&nbsp;</p>'.
            '<p>'.$getnbeacInfo->director.'</p>'.
            '<p>Senior Program Manager (NBEAC)</p>';

        $deferred_letter =
//            '<p><strong>Subject: '.@$docInfo->campus->business_school->name.'- Accreditation of '.$programs.'. </strong></p>'.
//            '<p>Dear '.@$docInfo->campus->user->name.',</p>'.
//            '<p>Reference to the registration application received for accreditation on August 9, 2019, this is to inform you that the Initial Eligibility Screening (IES) is completed by the Eligibility Screening Committee (ESC).</p>'.
            '<ol>'.
            '<li><strong>The case of KASBIT, Karachi has been deferred till the 09th ESC meeting to be held in Jan 2020.&nbsp;&nbsp; </strong></li>'.
            '<li>The University must avail mentorship to accomplish the following areas of improvement/recommendations:</li>'.
            '<li>Strategic plan is weak as there are no precise timelines, no KPIs (just intent) and no resource allocation provided in it. There are grammatical errors in the mission and vision statement and they are not aligned with the values. Some of the values are simple statements and could not be considered as values. The university needs mentorship to improve the strategic plan.</li>'.
            '<li>Documentary evidences of approval of strategic plan is required &ndash; the strategic plan should be approved by a relevant statutory body including the representation of Vice Chancellor and Dean.</li>'.
            '<li>Several deficiencies have been observed in the profile of dean including the publication criteria, experience etc.</li>'.
            '<li>Following documents should be provided with the registration application in 9th ESC Meeting:'.
            '<ol>'.
//            '<li>CV of HoD and associate professor</li>'.
//            '<li>R&amp; D data for period of 2017 to 2019.</li>'.
            '</ol>'.
            '</li>'.
            '</ol>'.
            '<ol>'.
            '<li>Based on the above recommendations, it is decided that University should reapply after availing mentorship and fulfilling the major deficiencies, preferably for the 9th Eligibility Screening Committee Meeting. Deadline to submit the registration application is December 30th, 2019.</li>'.
            '<li>It is mandatory that the University seeks guidance through the process of pre- eligibility mentor visit (Section III of NBEAC Accreditation Process Manual). We can provide you expert opinion/ assistance through our mentors, who will facilitate you during the accreditation process. Therefore, kindly contact Ms. Sania Tufail at (92) 51 90800206, email: stufail@hec.gov.pk for further information and assistance.</li>'.
            '</ol>';

        $approval_letter =
//            '<p><strong>Subject: '.@$docInfo->campus->business_school->name.' &ndash; Accreditation of '.$programs.' </strong></p>'.

//            '<p>&nbsp;</p>'.
//
//            '<p>Dear '.@$docInfo->campus->user->name.'</p>'.
//
//            '<p>Reference to the registration application received for accreditation dated August 23, 2019, this is to inform you that the Initial Eligibility Screening (IES) is completed by the Eligibility Screening Committee (ESC) in the 8th ESC Meeting held on Nov 28, 2019.</p>'.

            '<ol>'.
                '<li><strong>The case of '.@$docInfo->campus->business_school->name.' has qualified to enter the next stage of NBEAC accreditation process i.e. Self- Assessment Process.</strong></li>'.
                '<li>Please note, that Dean is not from the management sciences field however, there are some resource limitations in public sector institutions. Therefore, ESC considers the process to continue as the University is having HoD with relevant qualification.</li>'.
                '<li>It is requested to send us the completed Self-Assessment Proformae for BBA Hons. Program within 12 weeks. The due date for SAR submission is March 02, 2020. The Self-Assessment Proformae can be downloaded from: <a href="http://www.nbeac.org.pk/index.php/accreditation-2/policies-and-procedures">http://www.nbeac.org.pk/index.php/accreditation-2/policies-and-procedures</a>. It is recommended that the university refers to the NBEAC Accreditation Process Manual <a href="http://www.nbeac.org.pk/images/Accreditation/accreditation-process-manual-2019.pdf">http://www.nbeac.org.pk/images/Accreditation/accreditation-process-manual-2019.pdf</a> for details regarding the important aspects and requirements for NBEAC accreditation.</li>'.
                '<li>It is mandatory that the business school must seek the guidance through a process of pre-review mentorship (Section III of NBEAC Accreditation Process Manual). We can provide you expert opinion/ assistance through our mentors, who will facilitate you during the accreditation process. Therefore, kindly contact Ms. Sania Tufail at (92) 51 90800206, email: stufail@hec.gov.pk for further information and assistance.</li>'.
            '</ol>';

        $conditional_approved =
//'<p><strong>Subject: '.@$docInfo->campus->business_school->name.'- Accreditation of '.$programs.'.</strong></p>'.

//'<p>&nbsp;Dear '.@$docInfo->campus->user->name.',</p>'.

//'<p>Reference to the registration application received for accreditation dated May 16, 2019, this is to inform you that the Initial Eligibility Screening (IES) is completed by the Eligibility Screening Committee (ESC) in the 8th ESC Meeting held on Nov 28, 2019.</p>'.

'<ol>'.
	'<li><strong>The case of '.@$docInfo->campus->business_school->name.' shall be reconsidered once the business school updates the current situation of the department w.r.t the mentor&rsquo;s recommendations along with the accomplishment of following recommendations:</strong></li>'.
	'<li>'.
	'<ol>'.
		'<li>The business school needs to promote or hire 02-03 Professors/Associate Professors to meet the NBEAC faculty criteria.</li>'.
		'<li>Efforts are required to strengthen the research portfolio.</li>'.
	'</ol>'.
	'</li>'.
	'<li>Based on the above observations, it is decided that the mentor shall review the progress report and provide the go-ahead to proceed further.</li>'.
//	'<li>It is recommended that the university refers to the NBEAC Accreditation Process Manual <a href="http://www.nbeac.org.pk/images/Accreditation/accreditation-process-manual-2019.pdf">http://www.nbeac.org.pk/images/Accreditation/accreditation-process-manual-2019.pdf</a> for details regarding the important aspects and requirements for NBEAC accreditation.</li>'.
'</ol>';

//        dd($reviewer_availabilities);
        return view('eligibility_screening.eligibility_report', compact('reviewer_availabilities','registrations','deferred_letter','approval_letter','conditional_approved', 'registrations_reports'));
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
        AND slips.status ='approved' AND slips.regStatus = 'Eligibility'";
        $id ? $query .= ' AND slips.id = ' . $id : '';
        $registrations = DB::select($query, array());
//        dd($registrations);

        $reviewers_all = User::role('PeerReviewer')->get();
//        dd($reviewers_all);
        $reviewers = ReviewerAvailability::with('slip', 'user')->where('slip_id', $id)->get();
//        dd($reviewers);
        $reviewersDates = ReviewerAvailability::with('slip', 'user')->where('slip_id', $id)->get()->groupBy('user_id');
        $userDates = [];
        $maxSelectedDate='';
//         dd($reviewersDates);
        $count = 0;
        if ($reviewersDates){
            foreach ($reviewersDates as $key => $review) {
                $userDates[$count]['user_name'] = $review[0]->user->name;
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
            $count++;
        }
        $count_val = array_count_values($dates);
        if($count_val)  $maxSelectedDate = $this->doublemax($count_val);
        return view('eligibility_screening.scheduler', compact('registrations', 'reviewers','userDates', 'availability','maxSelectedDate', 'reviewers_all'));
    }

    public function doublemax($mylist){
        @$maxvalue=max(@$mylist);
        foreach ($mylist as $key=>$value) {
            if($value==$maxvalue)$maxindex=$key;
        }
        return @$maxindex;
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
        // store reports
        //dd($request->all());
        $validation = Validator::make($request->all(), $this->report_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {
            $check = EligibilityReport::where(['slip_id' => $request->slip_id])->exists();
            $slipInfo = Slip::with('campus', 'department')->where(['id' => $request->slip_id])->get()->first();
            if(!$check) {
                $imageName = '';
                $path = '';
//                if ($request->file('file')) {
//                    $imageName = $request->status . "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
//                    $path = 'uploads/eligibility_reports/';
//                    $diskName = env('DISK');
//                    $disk = Storage::disk($diskName);
//                    $request->file('file')->move($path, $imageName);
//                }
                $insert = EligibilityReport::create(
                    [
                        'slip_id' => $request->slip_id,
                        'comments' => $request->comments,
                        'status' => $request->status,
//                        'file' => $path.$imageName,
                        'created_by' => Auth::id(),
                        'es_meeting_date' => $request->es_meeting_date
                    ]
                );
                if ($insert) {
                    if ($request->status === 'Approved'){
                        $update_slip = Slip::find($request->slip_id)->update(['regStatus' => 'Mentoring']);
///////// Email to Business School //////////////////////
                        $header = '<table cellspacing="0" style="border-collapse:collapse; width:80%">' .
                            '<tbody>' .
                            '<tr>' .
                            '<td style="background-color:white; height:16px; vertical-align:top; width:80%">' .
                            '<p><strong>Mr/Ms.  ' . @$slipInfo->campus->user->name . '</strong><br />' .
                            '<strong>' . @$slipInfo->campus->user->designation->name . ',&nbsp; ' . @$slipInfo->department->name . '</strong><br />' .
                            '<strong>' . @$slipInfo->campus->business_school->name . '</strong></p>' .
                            '</td>' .
                            '<td style="background-color:white; height:16px; vertical-align:top; width:50%">' .
                            '<p> Ref. No: '.@$slipInfo->invoice_no.'<br />'.
                            '<strong>Dated: </strong><strong>' . date('Y-m-d') . '</strong></p>' .
                            '</td>' .
                            '</tr>' .
                            '</tbody>' .
                            '</table>';
                        $getnbeacInfo = NbeacBasicInfo::first();
                        $footer = '<p>Yours Sincerely,</p>' .
                            '<p>&nbsp;</p>' .
                            '<p>' . $getnbeacInfo->director . '</p>' .
                            '<p>Senior Program Manager (NBEAC)</p>';
///
                        $data = ['letter' => $header.$request->comments.$footer];
                        $slipInfo = $slipInfo;
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
                                ->subject('Eligibility Screening Committee comments - ' . $mailInfo['school']);
                            $message->from($mailInfo['from'], $mailInfo['from_name']);
                        });
                    }

                    return response()->json(['success' => 'report added successfully.'], 200);
                }
            }else{
                return response()->json(['message' => 'Record already exists.'], 422);
            }

        }catch (Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 422);
        }


    }

    public function esReportToSchool(Request $request)
    {

        $getnbeacInfo = NbeacBasicInfo::first();
        @$slip_id = EligibilityReport::find($request->id)->slip_id;

//        dd($request->all());

            if($slip_id) {



                $docInfo = Slip::with('campus', 'department')->find($slip_id);
//                dd($slipInfo->business_school_id);

                $getPrograms = Scope::with('program')->where(
                    [
                        'campus_id' => $docInfo->business_school_id,
                        'department_id' => $docInfo->department_id
                    ])->get();

                $count = $getPrograms->count();
                $programs = '';
                foreach ($getPrograms as $key => $scope) {
                    $programs .= $scope->program->name;
                    if ($key !== $count - 1)
                        $programs .= ', ';
                }

/////////////////// Email to Business School //////////////////////
                $header = '<table cellspacing="0" border="0" style="border-collapse:collapse; width:100%">' .
                    '<tbody>' .
                    '<tr>' .
                    '<td style="background-color:white; height:16px; vertical-align:top; width:60%">' .
                    '<p><strong>Mr/Ms.  ' . @$docInfo->campus->user->name . '</strong><br />' .
                    '<strong>' . @$docInfo->campus->user->designation->name . ',&nbsp; ' . @$docInfo->department->name . '</strong><br />' .
                    '<strong>' . @$docInfo->campus->business_school->name . '</strong></p>' .
                    '</td>' .
                    '<td style="background-color:white; height:16px; vertical-align:top; width:40%">' .
                    '<p> Ref. No: '.@$docInfo->invoice_no.'<br />'.
                    '<strong>Dated: </strong><strong>' . date('Y-m-d') . '</strong></p>' .
                    '</td>' .
                    '</tr>' .
                    '</tbody>' .
                    '</table>'.
                    '<p><strong>Subject:</strong>  '.$docInfo->campus->business_school->name.' - Accreditation of '.$programs.' </p>'.
                    '<p>Dear Professor '.@$docInfo->campus->user->name.'</p>';

                $footer = '<p>Yours Sincerely,</p>' .
                    '<p>&nbsp;</p>' .
                    '<p>' . $getnbeacInfo->director . '</p>' .
                    '<p>Senior Program Manager (NBEAC)</p>';
///

                $slipInfo = $docInfo;
                $data = ['letter' => $header.$request->comments.$footer];

                if($request->type == 'pdf')
                {
                    /////////// Generate PDF ////////////////
                    $pdf = PDF::loadView('eligibility_screening.pdf.index', $data)->setPaper('a4', 'portrait');;
                    $pdf->setOptions(['isPhpEnabled' => true, 'isRemoteEnabled' =>true]);
                    $filename = str_replace(' ' ,'-','pdf-'.$slipInfo->campus->business_school->name.'-report');
                    $file_path = str_replace(' ' ,'-','pdf/'.$slipInfo->campus->business_school->name.'/'.$docInfo->campus->location.'/'.$docInfo->department->name.'/');

                    $createDirectory = createDirecrtory(['file_name' =>$filename, 'path'=>$file_path] );
                    $updateEligibilitReport = EligibilityReport::find($request->id)->update(['file'=>$file_path.$filename.'.pdf']);
                    $pdf->save($file_path.$filename.'.pdf');
                    return $pdf->download($file_path.'.pdf');
                }
                else {
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
                            ->subject('Eligibility Screening Committee comments - ' . $mailInfo['school']);
                        $message->from($mailInfo['from'], $mailInfo['from_name']);
                    });

                    /////////// Generate PDF ////////////////
                    ///
                    $pdf = PDF::loadView('eligibility_screening.pdf.index', $data)->setPaper('a4', 'portrait');;
                    $pdf->setOptions(['isPhpEnabled' => true, 'isRemoteEnabled' => true]);
                    $filename = str_replace(' ', '-', 'pdf-' . $slipInfo->campus->business_school->name . '-report');
                    $file_path = str_replace(' ', '-', 'pdf/' . $slipInfo->campus->business_school->name . '/' . $docInfo->campus->location . '/' . $docInfo->department->name . '/');

                    $createDirectory = createDirecrtory(['file_name' => $filename, 'path' => $file_path]);
                    $updateEligibilitReport = EligibilityReport::find($request->id)->update(['file' => $file_path . $filename . '.pdf']);
                    $pdf->save($file_path . $filename . '.pdf');
                }
            }

        return response()->json(['success' => 'Acknowledgment email sent successfully.'], 200);
        /////////////////// End Email to Business School //////////////////////
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
        return response()->json($eligibilityScreening);
    }
    public function getReport()
    {

        $userInfo = Auth::user();
        $registrations_reports = DB::table('slips as s')
            ->join('campuses as c', 'c.id', '=', 's.business_school_id')
            ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
            ->join('departments as d', 'd.id', '=', 's.department_id')
            ->join('eligibility_reports as er', 'er.slip_id', '=', 's.id')
            ->select('s.*', 'c.location as campus', 'bs.name as school', 'd.name as department',
                'er.status as eligibility_status', 'er.id as report_id', 'er.comments', 'er.file')
//                ->where('s.regStatus', 'Mentoring')
//            ->where('s.business_school_id', $userInfo->campus_id)
//            ->where('s.department_id', $userInfo->department_id)
            ->get();

        return view('eligibility_screening.scheduler_eligibility_report', compact('registrations_reports'));
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
                'status'=>'approved'
                ]
            )->get();
//        dd($eligibilityScreening);
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
        $validation = Validator::make($request->all(), $this->report_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {
//dd($request->all());
                $imageName = '';
                $path = '';
//                if ($request->file('file')) {
//                    $imageName = $request->status . "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
//                    $path = 'uploads/eligibility_reports/';
//                    $diskName = env('DISK');
//                    $disk = Storage::disk($diskName);
//                    $request->file('file')->move($path, $imageName);
//                }
                $insert = EligibilityReport::find($request->report_id)->update(
                    [
                        'comments' => $request->comments,
                        'status' => $request->status,
                        'file' => $path.$imageName,
                        'updated_by' => Auth::id(),
                        'es_meeting_date' => $request->es_meeting_date
                    ]
                );
                if ($insert) {
                    if ($request->status === 'Approved'){
                        $update_slip = Slip::find($request->slip_id)->update(['regStatus' => 'Mentoring']);
                    }


                    ///////////////////// Email to Business School //////////////////////
                    $data= [];
                    $getnbeacInfo = NbeacBasicInfo::first();
                    $docInfo = Slip::with('campus', 'department')->find($request->slip_id);
                    $mailInfo = [
                        'to' => $docInfo->campus->user->email,
                        'to_name' => $docInfo->campus->user->name,
                        'school' => $docInfo->campus->business_school->name,
                        'from' => $getnbeacInfo->email,
                        'from_name' => $getnbeacInfo->director,
                    ];

                    $header = '<table cellspacing="0" style="border-collapse:collapse; width:80%">' .
                        '<tbody>' .
                        '<tr>' .
                        '<td style="background-color:white; height:16px; vertical-align:top; width:80%">' .
                        '<p><strong>Mr/Ms.  ' . @$docInfo->campus->user->name . '</strong><br />' .
                        '<strong>' . @$docInfo->campus->user->designation->name . ',&nbsp; ' . @$docInfo->department->name . '</strong><br />' .
                        '<strong>' . @$docInfo->campus->business_school->name . '</strong></p>' .
                        '</td>' .
                        '<td style="background-color:white; height:16px; vertical-align:top; width:50%">' .
                        '<p> Ref. No: '.@$docInfo->invoice_no.'<br />'.
                        '<strong>Dated: </strong><strong>' . date('Y-m-d') . '</strong></p>' .
                        '</td>' .
                        '</tr>' .
                        '</tbody>' .
                        '</table>';

                    $footer = '<p>Yours Sincerely,</p>' .
                        '<p>&nbsp;</p>' .
                        '<p>' . $getnbeacInfo->director . '</p>' .
                        '<p>(NBEAC)</p>';
///
                    $data = ['letter' => $header.$request->comments.$footer];

//                    Mail::send('eligibility_screening.email.eligibility_report', $data, function($message) use ($mailInfo) {
//                        //dd($user);
//                        $message->to($mailInfo['to'],$mailInfo['to_name'] )
//                            ->subject('Eligibility Screening Committee comments - '. $mailInfo['school']);
//                        $message->from($mailInfo['from'],$mailInfo['from_name']);
//                    });
                    ///////////////////// End Email to Business School //////////////////////


                    return response()->json(['success' => 'report added successfully.'], 200);
                }


        }catch (Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 422);
        }

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
