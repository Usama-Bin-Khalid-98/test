<?php

namespace App\Http\Controllers;

use App\Models\Mentoring\MentoringReport;
use App\Models\MentoringInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $registrations = MentoringInvoice::with('department', 'campus')->get();
//        dd($registrations);
        return  view('mentoring.mentor_report', compact('mentor_reports', 'registrations'));
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
                if ($insert) {
//                    if ($request->status === 'Approved'){
//                        $update_slip = MentoringInvoice::find($request->mentoring_invoice_id)->update(['regStatus' => 'Mentoring']);
//                    }


                    ///////////////////// Email to Business School / NBEAC Admin //////////////////////
                    ///
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
