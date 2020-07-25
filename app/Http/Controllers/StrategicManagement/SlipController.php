<?php

namespace App\Http\Controllers\StrategicManagement;

use App\BusinessSchool;
use App\Http\Controllers\Controller;
use App\Models\Common\Department;
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
        @$school_id = Auth::user()->business_school_id;

        @$invoices = Slip::with('department')->where('business_school_id', $school_id)->get();
        //dd($invoices);
        @$departments = Department::where('status', 'active')->get();
        return view('strategic_management.invoices_slip', compact('invoices','departments'));
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

            $school = BusinessSchool::where('id', Auth::user()->business_school_id)->first();
            //dd($school->name);
            $filename = $school->name . "-slip-" . time() . '.' . $request->slip->getClientOriginalExtension();
            $path = 'uploads/schools/slips';
            $diskName = env('DISK');
            $disk = Storage::disk($diskName);
            $request->file('slip')->move($path, $filename);

            Slip::create([
                'business_school_id' => Auth::user()->business_school_id,
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
        //dd($request);
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

                Slip::where('id', $request->id)->update([
                    'program_id' => $request->program_id,
                    'slip' => $path.'/'.$filename,
                    'comments' => $request->comments,
                    'transaction_date' => $request->transaction_date,
                    'status' =>  $request->status,
                ]);
                return response()->json(['success' => 'Invoice Slip Updated successfully.'], 200);
            }catch (Exception $e)
            {
                return response()->json($e->getMessage(), 422);
            }
        }

        try {
            //dd($request->all());
            Slip::where('id', $request->id)->update([
                'program_id' => $request->program_id,
                'comments' => $request->comments,
                'transaction_date' => $request->transaction_date,
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
