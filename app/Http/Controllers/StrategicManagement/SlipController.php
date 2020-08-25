<?php

namespace App\Http\Controllers\StrategicManagement;

use App\BusinessSchool;
use App\Http\Controllers\Controller;
use App\Models\Common\Department;
use App\Models\Common\FeeType;
use App\Models\Common\PaymentMethod;
use App\Models\Common\Program;
use App\Models\Common\Slip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;


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
        //// generate invoice ///////////
        $latest = Slip::latest()->first();
        $invoice_no ='';
        if (! $latest) {
            $invoice_no =  'NBEAC-HEC/ GU, Karachi:0001';
        }else {
            $string = preg_replace("/[^0-9\.]/", '', $latest->invoice_no);
            $invoice_no = 'NBEAC-HEC/ GU, Karachi:'. sprintf('%05d', $string + 1);
        }
        //dd($invoice_no);
        return view('strategic_management.invoices_slip', compact('invoices','departments','invoice_no', 'payment_methods'));
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
        //dd($request->all());
        //get fee type

        try {
            Slip::create([
                'business_school_id' => Auth::user()->campus_id,
                'invoice_no' => $request->invoice_no,
                'department_id' => Auth::user()->department_id,
                'status' => 'pending',
                'created_by' => Auth::id(),
            ]);
            return response()->json(['success' => 'Invoice Slip added successfully.'], 200);
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
        $getInvoice = Slip::with('business_school', 'department')->where(['id' => $id])->get()->first();
        //dd($getInvoice);
        return view('strategic_management.invoice', compact('getInvoice'));
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
    public function edit(Slip $slip)
    {
        //
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
        //dd($request->all());
        $path = ''; $imageName = '';
        if(@$request->file('slip')) {
            try {
                $school = BusinessSchool::where('id', Auth::user()->business_school_id)->first();
                //dd($school->name);
                $filename = $school->name . "-slip-" . time() . '.' . $request->slip->getClientOriginalExtension();
                $path = 'uploads/schools/slips';
                $diskName = env('DISK');
                $disk = Storage::disk($diskName);
                $request->file('slip')->move($path, $filename);

//                $data = ['business_school_id' => Auth::user()->campus_id];
//                @$request->invoice_no? $data['invoice_no'] = $request->invoice_no:'';
//                @$request->department_id? $data['department_id'] = $request->department_id:'';
                @$request->file('slip')? $data['slip'] = $path.'/'.$filename:'';
                @$request->comments? $data['comments'] = $request->comments:'';
                @$request->transaction_date? $data['transaction_date'] = $request->transaction_date:'';
                @$request->payment_method? $data['payment_method_id'] = $request->payment_method:'';
                @$request->cheque_no? $data['cheque_no'] = $request->cheque_no:'';
                @$request->status? $data['status'] = $request->status:'';
                //dd($data);
                Slip::where('id', $request->id)->update($data);
                return response()->json(['success' => 'Invoice Slip Updated successfully.'], 200);
            }catch (Exception $e)
            {
                return response()->json($e->getMessage(), 422);
            }
        }

        try {
            //dd($request->all());
            Slip::where('id', $request->id)->update([
//                'department_id' => $request->department_id,
                'comments' => $request->comments,
                'transaction_date' => $request->transaction_date,
                'payment_method_id' => $request->payment_method,
                'status' => $request->status,
            ]);
            return response()->json(['success' => 'Invoice Slip Updated successfully.'], 200);

        }catch (Exception $e)
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
