<?php

namespace App\Http\Controllers\StrategicManagement;

use App\BusinessSchool;
use App\Http\Controllers\Controller;
use App\Models\Common\Department;
use App\Models\Common\FeeType;
use App\Models\Common\PaymentMethod;
use App\DepartmentFee;
use App\Models\Common\Program;
use App\Models\Common\Slip;
use App\Models\Common\Campus;
use App\Models\Config\NbeacBasicInfo;
use App\Models\PeerReview\PeerReviewReviewer;
use App\Models\PeerReview\SchedulePeerReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChangeResgistrationStatusMail;
use App\Models\StrategicManagement\Scope;

use function Psy\debug;

class SlipController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    public function index()
    {
        //
        @$school_id = Auth::user()->campus_id;
        @$invoices = Slip::with('department')->where('business_school_id', $school_id)->get();
        //dd($invoices);
        @$departments = Department::where(['status'=> 'active', 'id'=>Auth::user()->department_id])->get()->first();
        $payment_methods = PaymentMethod::where('status', 'active')->get();
//        dd($payment_methods);
        $fee_amount = DepartmentFee::with('fee_type')->where(['fee_type_id'=>1,'status'=> 'active'])->get()->first();
//        dd($fee_amount);
        //// generate invoice ///////////
        $latest = Slip::latest()->first();
        $invoice_no ='';
        if (! $latest) {
            $invoice_no =  'NBEAC-HEC:0001';
        }else {
            $string = preg_replace("/[^0-9\.]/", '', $latest->invoice_no);
            $invoice_no = 'NBEAC-HEC:'. sprintf('%05d', $string + 1);
        }
        return view('strategic_management.invoices_slip', compact('invoices','departments','invoice_no', 'payment_methods','fee_amount'));
    }

    public function registrations()
    {
        //
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
            ->where('s.regStatus', '!=', 'Initiated')
            ->get();
        //dd($invoice_no);
        $programs = [];
        foreach($registrations as $slip){

            $scopes = Scope::with('program')->where(['campus_id' => $slip->campus_id, 'department_id' => $slip->department_id])->get();
            $programs[$slip->id] = [];
            foreach($scopes as $scope){
                array_push( $programs[$slip->id], @$scope->program->name);
            }
        }
        return view('registration.index', compact('registrations', 'programs'));
    }

    public function invoicesList()
    {
        //
        $invoices = DB::table('slips as s')
            ->join('campuses as c', 'c.id', '=', 's.business_school_id')
            ->join('departments as d', 'd.id', '=', 's.department_id')
            ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
            ->join('users as u', 'u.id', '=', 's.created_by')
            ->join('designations as dg', 'dg.id', '=', 'u.designation_id')
            ->select('s.*', 'c.location as campus','dg.name as designation',
                'd.name as department', 'u.name as user', 'u.email as email',
                'u.contact_no', 'bs.name as school')
            ->get();
        // dd($invoices);

        return view('admin.slip', compact('invoices'));
    }

    public function approvementStatus(Request $request)
    {
//        dd($request->all());
        try {
            $slip = Slip::with('department')->where('id', $request->id)->first();
            $campus = Campus::where('id', $slip->business_school_id)->first();
            $school = BusinessSchool::with('user', 'user.campus')->where('id', $campus->business_school_id)->first();
            $data = array(
                'id'      =>  $request->id,
                'user'      =>  $request->user,
                'designation'      =>  $request->designation,
                'school'      =>  $request->school,
                'campus'      =>  $request->campus,
                'cheque_no'      =>  $request->cheque_no,
                'transaction_date'      =>  $request->transaction_date,
                'school' => $school,
            );
            
            
            Slip::find($request->id)->update([
                'status' => $request->status,
                'updated_by' => Auth::id(),
            ]);
            
            $mailData['school'] = $school;
            $mailData['slip'] = $slip;
            
            $getNbeacInfo = NbeacBasicInfo::all()->first();

            $mailData['nbeac'] = $getNbeacInfo;
            $mailData['amount'] = $slip->amount;

            $mailInfo = [
                'to' => $school->user->email ?? '',
                'to_name' => $school->user->name ?? '',
                'school' => $school->name ?? '',
                'from' => $getNbeacInfo->email ?? 'info@nbeac.org.pk',
                'from_name' => $getNbeacInfo->director ?? '',
            ];

            Mail::send('registration.mail.acknowledgement_fee_mail', ['data' => $mailData], function ($message) use ($mailInfo) {
                //dd($user);
                $message->to($mailInfo['to'], $mailInfo['to_name'])
                    ->subject('Acknowledgement of Registration Fee');
            });


            // Mail::to($request->email)->send(new ChangeResgistrationStatusMail($data));
            return response()->json(['success' => 'Invoice Slip approved successfully.'], 200);
        }
        catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    public function travelPlan(Request $request)
    {
        //
//        dd($request->all());
        $validation = Validator::make($request->all(), $this->plan_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {
//            $check = Slip::where(['id' => $request->slip_id])->exists();
                $imageName = ''; $path = '';
                if ($request->file('file')) {
                    $imageName = 'travel' . "-plan-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/travel/';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);
                }

                $updateData['pr_visit_date'] = $request->visit_date;
                $imageName ? $updateData['pr_travel_plan'] = $path.$imageName:'';
//                dd($updateData);
                $update = Slip::where(['id'=>$request->slip_id])->update($updateData);

                if($update)
                {
                    ////////////////////////////////// email here //////////////
                    $getPeerMentors = PeerReviewReviewer::with('slip')->where(['slip_id'=>$request->slip_id])->get();
//                    dd($getPeerMentors);

                    $getNbeacData = NbeacBasicInfo::first();
                    foreach ($getPeerMentors as $docInfo)
                    {
                        $header = '<table cellspacing="0" style="border-collapse:collapse; width:80%">'.
                            '<tbody>'.
                            '<tr>'.
                            '<td style="background-color:white; height:16px; vertical-align:top; width:80%">'.
                            '<p><strong>Mr/Ms.  '.@$docInfo->slip->campus->user->name.'</strong><br />'.
                            '<strong>'.@$docInfo->slip->campus->user->designation->name.',&nbsp; '.@$docInfo->slip->department->name.'</strong><br />'.
                            '<strong>'.@$docInfo->slip->campus->business_school->name.'</strong></p>'.
                            '</td>'.
                            '<td style="background-color:white; height:16px; vertical-align:top; width:50%">'.
//            '    <p><strong>Ref. No: </strong><strong>KASBIT /NBEAC-ESC/15/3</strong><br />'.
                            '<strong>Dated: </strong><strong>'.date('Y-m-d').'</strong></p>'.
                            '</td>'.
                            '</tr>'.
                            '</tbody>'.
                            '</table>';

                        $content = '<p>NBEAC generated travel plan for '.$docInfo->slip->campus->business_school->name.' campus '.$docInfo->slip->campus->location.'</p>'.
                        ' on date '.$request->visit_date;

                        $footer = '<p>Yours Sincerely,</p>'.
                            '<p>&nbsp;</p>'.
                            '<p>'.$getNbeacData->director.'</p>'.
                            '<p>NBEAC</p>';

                        $emailData = ['letter'=> $header. $content. $footer];

                        $mailInfo = [
                            'to' => $docInfo->slip->campus->user->email,
                            'to_name' => $docInfo->slip->campus->user->name,
                            'school' => $docInfo->slip->campus->business_school->name,
                            'campus' => $docInfo->slip->campus->location,
                            'from' => $getNbeacData->email??'info@nbeac.org.pk',
                            'from_name' => $getNbeacData->director,
                        ];
                        Mail::send('eligibility_screening.email.eligibility_report', $emailData, function($message) use ($mailInfo) {
                            //dd($user);
                            $message->to($mailInfo['to'],$mailInfo['to_name'] )
                                ->subject('Travel Plan - '. $mailInfo['school']);
                        });

                    }

                    ////////////////////////////////// end email //////////////
                    return response()->json(['success' => 'Travel plan added successfully.'], 200);
                }
                else{
                    return response()->json(['message' => 'updating travel plan failed.'], 422);

                }
        }
        catch (Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 422);

        }
    }




    public function profileSheet(Request $request)
    {
        //
//        dd($request->all());
        $validation = Validator::make($request->all(), $this->sheet_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {
//            $check = Slip::where(['id' => $request->slip_id])->exists();
                $imageName = ''; $path = '';
                if ($request->file('file')) {
                    $imageName = 'profile' . "-sheet-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/profile_sheet/';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);
                }

                $imageName ? $updateData['profile_sheet'] = $path.$imageName:'';
//                dd($updateData);
                $update = Slip::where(['id'=>$request->slip_id])->update($updateData);

                if($update)
                {
                    ////////////////////////////////// email here //////////////

                    ////////////////////////////////// end email //////////////
                    return response()->json(['success' => 'Profile sheet added successfully.'], 200);
                }
                else{
                    return response()->json(['message' => 'updating profile sheet failed.'], 422);

                }
        }
        catch (Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 422);

        }
    }


    public function plan_rules(){
        return [
            'visit_date' => 'required',
            'slip_id' => 'required',
//            'file' => 'mimes:pdf,docx'
        ];
    }
    public function sheet_rules(){
        return [
            'slip_id' => 'required',
//            'file' => 'mimes:pdf,docx,xlsx,xls,doc'
        ];
    }
    protected function messages() {
        return [
            'required'=> 'The :attribute can not be blanked. '
        ];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        //
        try {
        $path = ''; $imageName = '';
        if(@$request->file('slip')) {

            $school = BusinessSchool::where('id', Auth::user()->campus_id)->first();
            //dd($school->name);
            $filename = $school->name . "-slip-" . time() . '.' . $request->slip->getClientOriginalExtension();
            $path = 'uploads/schools/slips';
            $diskName = env('DISK');
            $disk = Storage::disk($diskName);
            $request->file('slip')->move($path, $filename);

            Slip::create([
                'business_school_id' => Auth::user()->campus_id,
                'program_id' => $request->department_id,
                'slip' => $path.'/'.$filename,
                'status' => 'paid',
            ]);
            return response()->json(['success' => 'Invoice Slip added successfully.'], 200);
        }
        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateInvoice(Request $request)
    {
        $school = BusinessSchool::with('user', 'user.campus')->find(Auth::user()->business_school_id);
        try {
            $getFee = FeeType::where(['name' => 'Registration Fee'])->first();
            if($getFee) {
                
                $getNbeacInfo = NbeacBasicInfo::all()->first();

                $mailData['nbeac'] = $getNbeacInfo;

                $mailSchoolInfo = [
                    'to' => $school->user->email,
                    'to_name' => $school->user->name,
                    'school' => $getNbeacInfo->name??'',
                    'from' => $getNbeacInfo->email??'',
                    'from_name' => $getNbeacInfo->director??'',
                ];

                
                Slip::create([
                    'business_school_id' => Auth::user()->campus_id,
                    'invoice_no' => $request->invoice_no,
                    'department_id' => Auth::user()->department_id,
                    'amount' => $getFee->amount * $request->number_of_programs,
                    'status' => 'unpaid',
                    'created_by' => Auth::id(),
                ]);
                
                $mailData['school'] = $school;

                
                Mail::send('registration.mail.paid_fee_mail', ['data' => $mailData], function($message) use ($mailSchoolInfo) {
                    //dd($user);
                    $message->to($mailSchoolInfo['to'],$mailSchoolInfo['to_name'] )
                        ->subject('Invoice Generated');
                });

                 return response()->json(['success' => 'Invoice Slip added successfully.'], 200);
            }else{
                return response()->json(['message' => 'Invalid Fee.'], 422);

            }
        }
        catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    public function invoice($id=null)
    {
        //dd('invoice here ');
        $user_data = Auth::user();
        $getInvoice = Slip::with('campus', 'department')->where(['id' => $id])->get()->first();
        $nbeacInfo = NbeacBasicInfo::first();
        // dd($getInvoice);
        return view('strategic_management.invoice', compact('getInvoice', 'nbeacInfo'));
    }

    public function invoicePrint($id=null)
    {
        //dd('invoice here ');
        $user_data = Auth::user();
        $getInvoice = Slip::with('campus', 'department')->where(['id' => $id])->get()->first();
        $nbeacInfo = NbeacBasicInfo::first();
//        dd($getInvoice);
        return view('strategic_management.print', compact('getInvoice', 'nbeacInfo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Common\Slip  $slip
     * @return \Illuminate\Http\Response
     */
    public function show(Slip $slip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Common\Slip  $slip
     * @return \Illuminate\Http\Response
     */
    public function edit($slip)
    {
        //
        try {
            $slips = Slip::where('id', $slip)->get()->first();
            $confirm_date = SchedulePeerReview::where(['slip_id' => $slip, 'is_confirm' => 'yes'])->get()->first();
            $slips['confirm_date'] = $confirm_date->availability_dates;
//        dd($slips);
            return response()->json($slips, 200);
        }
        catch (Exception $e)
        {
            return response()->json('No data available', 422);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Common\Slip  $slip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slip $slip)
    {
        //
//        dd($request->all());
        $path = ''; $imageName = '';
        $data = [];
        $school = BusinessSchool::with('user', 'campus')->where('id', Auth::user()->business_school_id)->first();

            try {
                if(@$request->file('slip')) {
                    //dd($school->name);
                    $filename = $school->name . "-slip-" . time() . '.' . $request->slip->getClientOriginalExtension();
                    $path = 'uploads/schools/slips';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('slip')->move($path, $filename);
                }
//                $data = ['business_school_id' => Auth::user()->campus_id];
//                @$request->invoice_no? $data['invoice_no'] = $request->invoice_no:'';
//                @$request->department_id? $data['department_id'] = $request->department_id:'';
                @$request->file('slip')? $data['slip'] = $path.'/'.$filename:'';
                @$request->comments? $data['comments'] = $request->comments:'';
                @$request->transaction_date? $data['transaction_date'] = $request->transaction_date:'';
                @$request->payment_method? $data['payment_method_id'] = $request->payment_method:'';
                @$request->cheque_no? $data['cheque_no'] = $request->cheque_no:'';
                $data['status'] = 'paid';
                $data['regStatus'] = 'Pending';
                //dd($data);
                $updateSlip = Slip::where('id', $request->id)->update($data);


//            //dd($request->all());
//            $updateSlipStatus = Slip::where('id', $request->id)->update([
////                'department_id' => $request->department_id,
//                'comments' => $request->comments,
//                'transaction_date' => $request->transaction_date,
//                'payment_method_id' => $request->payment_method,
//                'status' => 'paid',
//            ]);
            if($updateSlip) {
                $mailData['school']= $school;
                $mailData['slip'] = Slip::where('id', $request->id)->first();

                $getNbeacInfo = NbeacBasicInfo::all()->first();

                $mailData['nbeac']= $getNbeacInfo;

//                dd($data['school']);
                $mailInfo = [
                    'from' => $school->user->email??'',
                    'from_name' => $school->user->name??'',
                    'school' => $school->name??'',
                    'to' => $getNbeacInfo->email??'info@nbeac.org.pk',
                    'to_name' => $getNbeacInfo->director??'',
                ];

                Mail::send('registration.mail.registration_invoice_admin_mail', ['data' => $mailData], function ($message) use ($mailInfo){
                    $message->to($mailInfo['to'], $mailInfo['to_name'])->subject('Registration Fee Paid');
                });
                // Mail::send('registration.mail.acknowledgement_fee_mail', ['data' => $mailData], function($message) use ($mailInfo) {
                //     //dd($user);
                //     $message->to($mailInfo['to'],$mailInfo['to_name'] )
                //         ->subject('Acknowledgement of Registration Fee');
                // });

            }
            return response()->json(['success' => 'Invoice Slip Updated successfully.'], 200);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }

    }

    public function bs_feedback_prr(Request $request)
    {
        //dd($request->all());
        try {
            $updateSlip = Slip::find($request->slip_id)->update(
                [
                    'bs_feedback_prr' => $request->comments
                ]
            );
            if ($updateSlip)
            {
                $data= [];
                $mailInfo = [
                    'to' => 'nbeac@gmail.com',
                    'to_name' => 'Bilal Ahmad',
                    'school' => "School Name Here",
                    'from' => "city@gmail.com",
                    'from_name' => 'Business School focal Person Name',
                ];
                Mail::send('email_templates.bs_feedback_prr', $data, function($message) use ($mailInfo) {
                    //dd($user);
                    $message->to($mailInfo['to'],$mailInfo['to_name'] )
                        ->subject('AAC Decision & Recommendations - '. $mailInfo['school']);
                });

                return response()->json(['success' => 'Feedback updated successfully.'], 200);
            }else{
                return response()->json(['message' => 'Failed to update the feedback report.', 422]);

            }
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => $e->getMessage(), 422]);

        }
    }


    public function updateInvoiceStatus(Request $request)
    {
//        dd($request->all());
        try {

            Slip::find($request->id)->update(['regStatus' => $request->regStatus]);
            return response()->json(['success' => 'Invoice Slip status updated successfully.'], 200);
        }
        catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Common\Slip  $slip
     * @return \Illuminate\Http\Response
     */
    public function destroy($slip)
    {
        //dd($slip);
        try {
            Slip::destroy($slip);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }
}
