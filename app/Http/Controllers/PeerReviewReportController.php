<?php

namespace App\Http\Controllers;

use App\Models\Common\Slip;
use App\Models\Config\NbeacBasicInfo;
use App\Models\PeerReview\PeerReviewReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class PeerReviewReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $registrations = DB::table('slips as s')
            ->join('campuses as c', 'c.id', '=', 's.business_school_id')
            ->join('departments as d', 'd.id', '=', 's.department_id')
            ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
            ->join('users as u', 'u.id', '=', 's.created_by')
            ->join('designations as dg', 'dg.id', '=', 'u.designation_id')
            ->select('s.*', 'c.location as campus','c.id as campus_id',
                'dg.name as designation', 'd.name as department','d.id as department_id',
                'u.name as user', 'u.email as email', 'u.contact_no',
                'bs.name as school', 'bs.id as business_school_id')
            ->get();
//        dd($peerReviewReport);
        return view('peer_review_report.index', compact('registrations'));

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
//        dd($request->all());
        //
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {
            $check = PeerReviewReport::where(['slip_id' => $request->slip_id])->exists();
            if(!$check) {
                $fileName = ''; $path = '';
                $path = '';
                if ($request->file('file')) {
                    $fileName = 'peer-review' . "-report-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/peer_review/';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $fileName);
                }

                $insert = PeerReviewReport::create([
                    'slip_id' => $request->slip_id,
                    'comments' => $request->comments,
                    'status' => 'active',
                    'report_date' => $request->report_date,
                    'file' => $path.$fileName,
                    'created_by' => Auth::id()
                ]);
                if($insert) {
                    return response()->json(['success' => 'Report uploaded successfully.'], 200);
                }
            }else{
//                if($request->prr_id) {
                    $fileName = '';
                    $path = '';
                    $path = '';
                    if ($request->file('file')) {
                        $fileName = 'peer-review' . "-report-" . time() . '.' . $request->file->getClientOriginalExtension();
                        $path = 'uploads/peer_review/';
                        $diskName = env('DISK');
                        $disk = Storage::disk($diskName);
                        $request->file('file')->move($path, $fileName);
                    }

                    $insert = PeerReviewReport::find($request->prr_id)->update([
//                        'slip_id' => $request->slip_id,
                        'comments' => $request->comments,
//                        'status' => 'active',
                        'report_date' => $request->report_date,
                        'file' => $path . $fileName,
                        'updated_by' => Auth::id()
                    ]);

                    /////////////////////////// Send Email To ///////////////////
                    $mailInfo = [
                        'to' => 'school@gmail.com',
                        'to_name' => 'Habib Ahmad',
                        'school' => "School Name Here",
                        'from' => "nbeac@gmail.com",
                        'from_name' => 'NBEAC focal Person Name',
                    ];

                    $data= [];

                    Mail::send('email_templates.accreditation_update_report', $data, function($message) use ($mailInfo) {
                        //dd($user);
                        $message->to($mailInfo['to'],$mailInfo['to_name'] )
                            ->subject('AAC Decision & Recommendations - '. $mailInfo['school']);
                        $message->from($mailInfo['from'],$mailInfo['from_name']);
                    });
                return response()->json(['success' => 'Report updated successfully.'], 200);
//                }else{
//                    return response()->json(['message' => 'Failed to update the Peer Review Report.'], 422);

//                }

            }


        }catch (Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function ThankyouMsg(Request $request)
    {
//        dd($request->all());

        try {
            /////////////////////////// Send Email To ///////////////////
            $getNbeacInfo = NbeacBasicInfo::first();

            /////////////////////// Email to Bs School ////////////////////
            $getBSInfo = Slip::with('campus', 'department')->find($request->slip_id)->first();

            $content = 'Dear Mr. '.$getBSInfo->campus->user->name.',' .
                $getBSInfo->campus->business_school->name.','. $getBSInfo->campus->location.
                'Let me take this opportunity on behalf of entire peer review team, I would like to express our deepest thanks and gratitude to you and your team members for the warm welcome, cooperation and hospitality which you extended to us during the accreditation visit. All the arrangements were very well coordinated and organized, which made the PRT visit and stay highly productive and comfortable. Pass our regards to Vice Chancellor, Executive Director, Associate Deans, all directors, registrar and whole team.' .
                'I believe that RSL, '.$getBSInfo->campus->business_school->name. ' campus '.$getBSInfo->campus->location.'will benefit from the constructive discussion with the peer review team. NBEAC is a platform to develop & promote liaison and collaborationamongst the business schools to learn from each other and facilitate the Business Schools. Business schools are requested to publicize the accreditation category only after receiving the approved notification/letter from NBEAC.' .
                'Please note that the interim peer review report will be shared with business school for feedbackon any factual errors. The detailed peer review report and accreditation decision will be shared soon with you. ' .
                'Thank you once again.';
            $mailInfo = [
                'to' => $getBSInfo->campus->user->email,
                'to_name' => $getBSInfo->campus->user->name,
                'school' =>$getBSInfo->campus->business_school->name. ' campus '.$getBSInfo->campus->location ,
                'from' => $getNbeacInfo->email,
                'from_name' => $getNbeacInfo->director,
            ];

            $data= ['letter'=>  $content];

            Mail::send('peer_review_report.thankyou_email', $data, function($message) use ($mailInfo) {
                //dd($user);
                $message->to($mailInfo['to'],$mailInfo['to_name'] )
                    ->subject('Thank you - '. $mailInfo['school']);
                $message->from($mailInfo['from'],$mailInfo['from_name']);
            });


        return response()->json(['success' => 'Report updated successfully.'], 200);
        }catch (Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function updateSlipStatus(Request $request)
    {
//        dd($request->all());
        try {
                Slip::where(['id' => $request->id])
                    ->update(['regStatus' => $request->regStatus]);

            return response()->json(['success' => 'Case forwarded to AAC successfully.'], 200);
        }
        catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PeerReview\PeerReviewReport  $peerReviewReport
     * @return \Illuminate\Http\Response
     */
    public function show(PeerReviewReport $peerReviewReport)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PeerReview\PeerReviewReport  $peerReviewReport
     * @return \Illuminate\Http\Response
     */
    public function edit(PeerReviewReport $peerReviewReport)
    {
        //

    }

    public function details($id = null)
    {
        //
        $peerReviewReport = [];
        if($id) {
            @$peerReviewReport = PeerReviewReport::where(['slip_id' => $id])->get();
        }
//        dd($peerReviewReport);
        $registrations = DB::table('slips as s')
            ->join('campuses as c', 'c.id', '=', 's.business_school_id')
            ->join('departments as d', 'd.id', '=', 's.department_id')
            ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
            ->join('users as u', 'u.id', '=', 's.created_by')
            ->join('designations as dg', 'dg.id', '=', 'u.designation_id')
            ->join('peer_review_reports as prr', 'prr.slip_id', '=', 's.id')
            ->select('s.*', 'c.location as campus','c.id as campus_id',
                'dg.name as designation', 'd.name as department',
                'u.name as user', 'u.email as email', 'u.contact_no',
                'bs.name as school', 'bs.id as business_school_id',
                'prr.report_date','prr.file', 'prr.id as prr_id', 'prr.comments as prr_comments')
            ->where('s.id', $id)
            ->get();
        return view('peer_review_report.review_report_details', compact('registrations', 'peerReviewReport'));
    }

    public function school_prr()
    {
        $user = Auth::user();
//        if($id) {
            $registrations = DB::table('slips as s')
                ->join('campuses as c', 'c.id', '=', 's.business_school_id')
                ->join('departments as d', 'd.id', '=', 's.department_id')
                ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
                ->join('users as u', 'u.id', '=', 's.created_by')
                ->join('designations as dg', 'dg.id', '=', 'u.designation_id')
                ->join('peer_review_reports as prr', 'prr.slip_id', '=', 's.id')
                ->select('s.*', 'c.location as campus', 'c.id as campus_id',
                    'dg.name as designation', 'd.name as department',
                    'u.name as user', 'u.email as email', 'u.contact_no',
                    'bs.name as school', 'bs.id as business_school_id',
                    'prr.report_date', 'prr.file', 'prr.id as prr_id', 'prr.comments as prr_comments')
//                ->where('s.id', $id)
                ->where(['s.business_school_id'=> $user->campus_id, 's.department_id'=> $user->department_id])
                ->get();
//            dd($registrations);
//        }
        return view('peer_review_report.bspr_report', compact('registrations'));
    }

    public function peer_review_details($id = null)
    {
        $user = Auth::user();
        $registrations = DB::table('slips as s')
            ->join('campuses as c', 'c.id', '=', 's.business_school_id')
            ->join('departments as d', 'd.id', '=', 's.department_id')
            ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
            ->join('users as u', 'u.id', '=', 's.created_by')
            ->join('designations as dg', 'dg.id', '=', 'u.designation_id')
            ->select('s.*', 'c.location as campus','c.id as campus_id',
                'dg.name as designation', 'd.name as department',
                'u.name as user', 'u.email as email', 'u.contact_no',
                'bs.name as school', 'bs.id as business_school_id')
            ->where('s.id', $id)
            ->orWhere('s.business_school_id', $user->campus_id)
            ->orWhere('s.department_id', $user->department_id)
            ->get();
//        dd($registrations);
        $peerReview = PeerReviewReport::where(['slip_id'=> $id, 'status' => 'active'])->get()->first();

        return view('peer_review_report.pr_report_details', compact('registrations', 'peerReview'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PeerReview\PeerReviewReport  $peerReviewReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PeerReviewReport $peerReviewReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PeerReview\PeerReviewReport  $peerReviewReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeerReviewReport $peerReviewReport)
    {
        //
    }
    public function rules(){
        return [
            'slip_id' => 'required',
            'file' => 'mimes:pdf,docx,xlsx,xls,doc'
        ];
    }
    protected function messages() {
        return [
            'required'=> 'The :attribute can not be blanked. '
        ];
    }
}
