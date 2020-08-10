<?php

namespace App\Http\Controllers\StrategicManagement;

use App\BusinessSchool;
use App\Http\Controllers\Controller;
use App\Models\Common\Department;
<<<<<<< HEAD
=======
use App\Models\Common\FeeType;
>>>>>>> fb5ba0be3d2c2c24a2617060c6f106a0c26b7269
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
<<<<<<< HEAD
        @$school_id = Auth::user()->business_school_id;
=======
        @$school_id = Auth::user()->campus_id;
>>>>>>> fb5ba0be3d2c2c24a2617060c6f106a0c26b7269
        @$invoices = Slip::with('department')->where('business_school_id', $school_id)->get();
        //dd($invoices);
        @$departments = Department::where('status', 'active')->get();
        $payment_methods = PaymentMethod::where('status', 'active')->get();
        //// generate invoice ///////////
        $latest = Slip::latest()->first();
        $invoice_no ='';
        if (! $latest) {
            $invoice_no =  '0001';
        }else {
            $string = preg_replace("/[^0-9\.]/", '', $latest->invoice_no);
            $invoice_no = sprintf('%04d', $string + 1);
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
<<<<<<< HEAD
                'business_school_id' => Auth::user()->business_school_id,
=======
                'business_school_id' => Auth::user()->campus_id,
>>>>>>> fb5ba0be3d2c2c24a2617060c6f106a0c26b7269
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
<<<<<<< HEAD
        //
        try {
            Slip::create([
                'business_school_id' => Auth::user()->business_school_id,
=======
        //get fee type

        try {
            Slip::create([
                'business_school_id' => Auth::user()->campus_id,
>>>>>>> fb5ba0be3d2c2c24a2617060c6f106a0c26b7269
                'invoice_no' => $request->invoice_no,
                'department_id' => $request->department_id,
                'status' => 'pending',
            ]);
            return response()->json(['success' => 'Invoice Slip added successfully.'], 200);
        }
        catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

<<<<<<< HEAD


=======
>>>>>>> fb5ba0be3d2c2c24a2617060c6f106a0c26b7269
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
