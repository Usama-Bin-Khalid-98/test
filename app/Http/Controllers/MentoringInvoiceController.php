<?php

namespace App\Http\Controllers;

use App\BusinessSchool;
use App\Models\Common\Department;
use App\Models\Common\FeeType;
use App\Models\Common\PaymentMethod;
use App\Models\Common\Slip;
use App\Models\MentoringInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class MentoringInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        @$campus_id = Auth::user()->campus_id;
        @$invoices = MentoringInvoice::with('department')->where('campus_id', $campus_id)->get();
        @$departments = Department::where(['status'=> 'active', 'id'=>Auth::user()->department_id])->get();
//        dd($departments);
        $payment_methods = PaymentMethod::where('status', 'active')->get();
        //// generate invoice ///////////
        $latest = MentoringInvoice::latest()->first();
        $invoice_no ='';
        if (! $latest) {
            $invoice_no =  'NBEAC-HEC/ MI:0001';
        }else {
            $string = preg_replace("/[^0-9\.]/", '', $latest->invoice_no);
            $invoice_no = 'NBEAC-HEC/ MI:'. sprintf('%05d', $string + 1);
        }
        $fee_amount = FeeType::where('id', 4)->get()->first();
        //dd($invoice_no);
        return view('mentoring.invoices_slip', compact('invoices','departments','invoice_no', 'payment_methods', 'fee_amount'));
    }

    public function invoicesList()
    {
        //
        $invoices = DB::table('mentoring_invoices as s')
            ->join('campuses as c', 'c.id', '=', 's.campus_id')
            ->join('departments as d', 'd.id', '=', 's.department_id')
            ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
            ->join('users as u', 'u.id', '=', 's.created_by')
            ->select('s.*', 'c.location as campus', 'd.name as department', 'u.name as user', 'u.email', 'u.contact_no', 'bs.name as school')
            ->get();
        //dd($invoices);
        return view('mentoring.slip', compact('invoices'));
    }

    public function generateInvoice(Request $request)
    {
        //dd($request->all());
        //get fee type

        try {
            $fee_amount = FeeType::where(['id' => 4])->get()->first()->amount;
            MentoringInvoice::create([
                'campus_id' => Auth::user()->campus_id,
                'invoice_no' => $request->invoice_no,
                'department_id' => Auth::user()->department_id,
                'fee_type_id' => 4,
                'amount' => $fee_amount,
                'status' => 'unpaid',
                'created_by' => Auth::id(),
            ]);
            return response()->json(['success' => 'Invoice Slip added successfully.'], 200);
        }
        catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }
    public function approvementStatus(Request $request)
    {
//        dd($request->all());
        try {
            MentoringInvoice::find($request->id)->update([
                'status' => $request->status,
                'updated_by' => Auth::id(),
            ]);
            return response()->json(['success' => 'Invoice Slip status updated successfully.'], 200);
        }
        catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    public function updateInvoiceStatus(Request $request)
    {
//        dd($request->all());
        try {
            $updateMentoringStatus = MentoringInvoice::find($request->id)
                ->update(['regStatus' => $request->regStatus]);

            if($updateMentoringStatus)
            {
                $getBusinessSchool = MentoringInvoice::where('id', $request->id)->get()->first();
                Slip::where(['business_school_id' => $getBusinessSchool->campus_id, 'department_id' => $getBusinessSchool->department_id])
                    ->update(['regStatus' => $request->regStatus]);
            }
            return response()->json(['success' => 'Invoice Slip status updated successfully.'], 200);
        }
        catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    public function invoice($id=null)
    {
//        dd('invoice here ', $id);
//        $user_data = Auth::user();
        $getInvoice = MentoringInvoice::with('campus', 'department', 'user')->where(['id' => $id])->get()->first();
//        dd($getInvoice);
//        $getFee =
        //dd($getInvoice);
        return view('mentoring.invoice', compact('getInvoice'));
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
     * @param  \App\Models\MentoringInvoice  $mentoringInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(MentoringInvoice $mentoringInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MentoringInvoice  $mentoringInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(MentoringInvoice $mentoringInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MentoringInvoice  $mentoringInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MentoringInvoice $mentoringInvoice)
    {
        try {
            $user = Auth::user();

            $path = '';
            $imageName = '';
            if (@$request->file('slip')) {
                $filename = "slip-" . time() . '.' . $request->slip->getClientOriginalExtension();
                $path = 'uploads/schools/mentoring/slips';
                $diskName = env('DISK');
                $disk = Storage::disk($diskName);
                $request->file('slip')->move($path, $filename);
            }

            @$request->file('slip') ? $data['slip'] = $path . '/' . $filename : '';
            @$request->payment_method ? $data['payment_method_id'] = $request->payment_method : '';
            @$request->cheque_no ? $data['cheque_no'] = $request->cheque_no : '';
            $data['status'] = 'paid';
            @$request->comments ? $data['comments'] = $request->comments : '';
            @$request->transaction_date ? $data['transaction_date'] = $request->transaction_date : '';
            $update = MentoringInvoice::find($request->id)->update($data);
            if ($update){
                return response()->json(['success' => 'Invoice Slip added successfully.'], 200);
            }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    public function mentoringInvoices()
    {
//        @$campus_id = Auth::user()->campus_id;
        @$invoices = MentoringInvoice::with('campus','department')
            ->where('status', 'paid')
            ->orWhere('status', 'approved')
            ->get();
//        dd($invoices);
        return view('mentoring.mentoring_invoices', compact('invoices'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MentoringInvoice  $mentoringInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($mentoringInvoice)
    {
//        dd($mentoringInvoice);
        return response()->json(MentoringInvoice::destroy($mentoringInvoice), 200);
    }
}
