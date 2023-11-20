<?php

namespace App\Http\Controllers;

use App\Mentoring\ScheduleMentorMeeting;
use App\Models\Common\Slip;
use App\Models\Config\NbeacBasicInfo;
use App\Models\Mentoring\MentoringReport;
use App\Models\MentoringInvoice;
use App\Models\MentoringMentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class MentoringReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mentor_reports = MentoringReport::with('mentoring_invoice')->where('created_by', Auth::id())->get();
//        dd($mentor_reports);
        $getMentor = MentoringMentor::where('user_id', Auth::id())->get();

        $slips = [];
        $registrations = [];
        foreach ($getMentor as $key => $mentor){
            @$invoices = Slip::find(@$mentor->slip_id);
            @$slips[$key] = ['campus_id'=>@$invoices->campus->id, 'department_id'=> @$invoices->department_id];
        }

        foreach ($slips as $key => $slip)
        {
            $registrations_mentors = MentoringInvoice::with('department', 'campus')->where($slip)->first();
            $registrations[$key] = $registrations_mentors;
        }
//        dd($registrations);
        return  view('mentoring.mentor_report', compact('mentor_reports', 'registrations'));
    }

    public function getReports()
    {
        $userInfo = Auth::user();
        if ($userInfo->hasRole('BusinessSchool')) {
            $where = ['campus_id' => $userInfo->campus_id, 'department_id' => $userInfo->department_id];
            $mentor_reports = MentoringInvoice::with('mentoring_report', 'campus', 'department')
                ->where($where)->get();
        }elseif($userInfo->hasRole('NBEACAdmin')){
            $mentor_reports = MentoringInvoice::with('mentoring_report', 'campus', 'department')->get();
        }else{
            $where = [];
            return;
        }
        return view('mentoring.school_mentor_report', compact('mentor_reports'));

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
        $validation = Validator::make($request->all(), $this->report_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {
            $check = MentoringReport::where(['mentoring_invoice_id' => $request->mentoring_invoice_id, 'created_by' => Auth::id()])->exists();
            $getInvoice =MentoringInvoice::where(['id'=> $request->mentoring_invoice_id])->first();
            $getSlip = Slip::where(['department_id'=>$getInvoice->department_id, 'business_school_id'=> $getInvoice->campus_id])->first();
            $checkConfirmDate = ScheduleMentorMeeting::where(['slip_id' => $getSlip->id])->first();
            if($checkConfirmDate->is_confirm === 'no')
            {
                return response()->json(['message'=> 'You can\'t submit report before confirmation of meeting date. '], 422);
            }

            if(!$check) {
                $imageName = '';
                if ($request->file('file')) {
                    $imageName = 'mentoring-report' . "-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/mentoring_reports/';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);
                }
                $insert = MentoringReport::create(
                    [
                        'mentoring_invoice_id' => $request->mentoring_invoice_id,
                        'comments' => $request->comments,
                        'status' => $request->status,
                        'file' => $path.$imageName,
                        'created_by' => Auth::id(),
                        'report_date' => $request->report_date,
                        'registration_date' => $request->registration_date,
                        'sar_date' => $request->sar_date,
                    ]
                );
                if ($insert->id)
                {
                    $getMentorInvoice = MentoringReport::with('mentoring_invoice')->where('id', $insert->id)->first();

                    $docInfo = Slip::with('campus', 'department')->where(
                            [
                                'business_school_id'=> $getMentorInvoice->mentoring_invoice->campus_id,
                                'department_id'=> $getMentorInvoice->mentoring_invoice->department_id
                            ])->first();
                    $getnbeacInfo = NbeacBasicInfo::first();
//                    dd($docInfo);
                    ///////////////////// Email to Business School / NBEAC Admin //////////////////////
                    /////////////////// Email to Business School //////////////////////
                    $header = '<table cellspacing="0" style="border-collapse:collapse; width:100%">' .
                        '<tbody>' .
                        '<tr>' .
                        '<td style="background-color:white; height:16px; vertical-align:top; width:100%">' .
                        '<p><strong>Mr/Ms.  ' . @$docInfo->campus->user->name . '</strong><br />' .
                        '<strong>'.'&nbsp;' . @$docInfo->department->name . '</strong><br />' .
                        '<strong>' . @$docInfo->campus->business_school->name . '</strong></p>' .
                        '</td>' .
//                        '<td style="background-color:white; height:16px; vertical-align:top; width:50%">' .
//            '    <p><strong>Ref. No: </strong><strong>KASBIT /NBEAC-ESC/15/3</strong><br />'.
//                        '<strong>Dated: </strong><strong>' . date('Y-m-d') . '</strong></p>' .
//                        '</td>' .
                        '</tr>' .
                        '</tbody>' .
                        '</table>';

                    $footer = '<p>Yours Sincerely,</p>' .
                        '<p>&nbsp;</p>' .
                        '<p>' . $getnbeacInfo->director . '</p>' .
                        '<p>National Business Education Accreditation Council (NBEAC)</p>';
///
                    $data = ['letter' => $header.$request->comments.$footer];
                    $slipInfo = $docInfo;
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
                            ->subject('Mentoring Report of - ' . $mailInfo['school']);
                    });

                    ///////////////////// End Email to Business School //////////////////////


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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mentoring\MentoringReport  $mentoringReport
     * @return \Illuminate\Http\Response
     */
    public function show(MentoringReport $mentoringReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mentoring\MentoringReport  $mentoringReport
     * @return \Illuminate\Http\Response
     */
    public function edit(MentoringReport $mentoringReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mentoring\MentoringReport  $mentoringReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MentoringReport $mentoringReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mentoring\MentoringReport  $mentoringReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(MentoringReport $mentoringReport)
    {
        //
    }

    protected function report_rules() {
        return [
            'mentoring_invoice_id'=> 'required',
            'comments'=> 'required',
//            'status'=> 'required',
        ];
    }
    protected function messages() {
        return [
            'required'=> 'The :attribute can not be blanked. '
        ];
    }
}
