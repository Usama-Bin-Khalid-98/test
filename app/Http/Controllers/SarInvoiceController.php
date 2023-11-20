<?php

namespace App\Http\Controllers;

use App\BusinessSchool;
use App\DepartmentFee;
use App\Models\Common\Department;
use App\Models\Common\PaymentMethod;
use App\Models\Common\Slip;
use App\Models\Config\NbeacBasicInfo;
use App\Models\Sar\SarInvoice;
use App\Models\StrategicManagement\Scope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class SarInvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        @$school_id = Auth::user();
        @$invoices = SarInvoice::with('department')
            ->where(['campus_id'=> $school_id->campus_id, 'department_id'=> $school_id->department_id])->get();
        //dd($invoices);
        @$departments = Department::where(['status'=> 'active', 'id'=>Auth::user()->department_id])->get()->first();
        $payment_methods = PaymentMethod::where('status', 'active')->get();
//        dd($payment_methods);
        $program_fee = DepartmentFee::with('fee_type')->where(['fee_type_id'=>6,'status'=> 'active'])->get()->first();

        $getScopes =  Scope::where(['campus_id'=> $school_id->campus_id, 'department_id'=> $school_id->department_id])->with('program')->get();
        $countPrograms = $getScopes->count()??0;
        $amount = $program_fee->amount??0;
        $fee_amount = $amount * $countPrograms;
//        dd($fee_amount);
//        dd($getScope);
//        dd($fee_amount);
        //// generate invoice ///////////
        $latest = SarInvoice::latest()->first();
        $invoice_no ='';
        if (! $latest) {
            $invoice_no =  'NBEAC-HEC/ GU, SAR:0001';
        }else {
            $string = preg_replace("/[^0-9\.]/", '', $latest->invoice_no);
            $invoice_no = 'NBEAC-HEC/ GU, SAR:'. sprintf('%05d', $string + 1);
        }
        return view('sar.invoices', compact('invoices','getScopes','departments','invoice_no', 'payment_methods','fee_amount'));

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
        try {
            $isRegInvoiceCompleted = Slip::where(['business_school_id' => Auth::user()->campus_id,'department_id'=> Auth::user()->department_id, 'status'=>'approved' ])->exists();
            if(!$isRegInvoiceCompleted){
                return response()->json(['error' => 'Please complete Registration invoice first'], 422);
            }
            $getFee =DepartmentFee::where(['fee_type_id'=> 6])->first();
            $getScops= Scope::where(['campus_id'=>Auth::user()->campus_id,'department_id' => Auth::user()->department_id])->get()->count();
//            dd($getScops);
            $netAmount = $getFee->amount *$getScops;
            if($getFee) {
                SarInvoice::create([
                    'campus_id' => Auth::user()->campus_id,
                    'invoice_no' => $request->invoice_no,
                    'department_id' => Auth::user()->department_id,
                    'fee_type_id' => 6,
                    'amount' => $netAmount,
                    'status' => 'pending',
                    'created_by' => Auth::id(),
                ]);

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sar\SarInvoice  $sarInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(SarInvoice $sarInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sar\SarInvoice  $sarInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(SarInvoice $sarInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sar\SarInvoice  $sarInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SarInvoice $sarInvoice)
    {
        $path = ''; $imageName = '';
        $data = [];
        $school = BusinessSchool::with('user', 'campus')->where('id', Auth::user()->business_school_id)->first();

        try {
            if(@$request->file('slip')) {
                //dd($school->name);
                $filename = $school->name . "-slip-" . time() . '.' . $request->slip->getClientOriginalExtension();
                $path = 'uploads/accreditation/slips';
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
            //dd($data);
            $updateSlip = SarInvoice::where('id', $request->id)->update($data);


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
                $mailData['slip']= $data;

                $getNbeacInfo = NbeacBasicInfo::all()->first();

                $mailData['nbeac']= $getNbeacInfo;

//                dd($data['school']);
                $mailInfo = [
                    'to' => $getNbeacInfo->email??'info@nbeac.org.pk',
                    'to_name' => $getNbeacInfo->director??'',
                    'school' => $school->name??'',
                    'from' => $school->user->email??'',
                    'from_name' => $school->user->name??'',
                ];

                $mailSchoolInfo = [
                    'to' => $school->user->email,
                    'to_name' => $school->user->name,
                    'school' => $getNbeacInfo->name??'',
                    'from' => $getNbeacInfo->email??'',
                    'from_name' => $getNbeacInfo->director??''
                ];
//                dd($mailData);
                Mail::send('registration.mail.paid_fee_mail', ['data' => $mailData], function($message) use ($mailSchoolInfo) {
                    //dd($user);
                    $message->to($mailSchoolInfo['to'],$mailSchoolInfo['to_name'] )
                        ->subject($mailSchoolInfo['school'].' paid accreditation fee - '. $mailSchoolInfo['school']);
                });

                Mail::send('registration.mail.acknowledgement_fee_mail', ['data' => $mailData], function($message) use ($mailInfo) {
                    //dd($user);
                    $message->to($mailInfo['to'],$mailInfo['to_name'] )
                        ->subject($mailInfo['school'].' paid accreditation fee - '. $mailInfo['school']);
                });

                return response()->json(['success' => 'Acknowledgment email sent successfully.'], 200);
            }
            else{
                return response()->json(['message' => 'sending email Failed.'], 422);
            }
            return response()->json(['success' => 'Invoice Slip Updated successfully.'], 200);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }


    public function invoicesList()
    {
        $getInvoices = SarInvoice::with('campus', 'department')->get();
        return view('sar.slip', compact('getInvoices'));
    }

    public function update_status(Request $request){
//        dd($request->all());

        try {
            SarInvoice::find($request->id)->update([
                'status' => $request->status,
                'regStatus' => 'SAR',
                'updated_by' => Auth::id(),
            ]);


            $school = SarInvoice::with('campus', 'department')->first();
            $getNbeacInfo = NbeacBasicInfo::all()->first();

            $mailData['nbeac']= $getNbeacInfo;

            $mailSchoolInfo = [
                'to' => $school->campus->user->email,
                'to_name' => $school->campus->user->name,
                'school' => $getNbeacInfo->name??'',
                'from' => $getNbeacInfo->email??'',
                'from_name' => $getNbeacInfo->director??''
            ];

//            Mail::to($request->email)->send(new ChangeResgistrationStatusMail($data));
            Mail::send('sar.email.paid_fee_mail', ['data' => $mailData], function($message) use ($mailSchoolInfo) {
                //dd($user);
                $message->to($mailSchoolInfo['to'],$mailSchoolInfo['to_name'] )
                    ->subject($mailSchoolInfo['school'].'Approval of Accreditation Fee - '. $mailSchoolInfo['school']);
            });
            return response()->json(['success' => 'Invoice Slip approved successfully.'], 200);
        }
        catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sar\SarInvoice  $sarInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($sarInvoice)
    {
//        dd($sarInvoice);
        try {
        SarInvoice::destroy($sarInvoice);

        return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }
}
