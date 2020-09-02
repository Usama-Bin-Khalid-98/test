<?php

namespace App\Http\Controllers;

use App\FinancialAssistance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Auth;

class FinancialAssistanceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    public function index()
    {
        $campus_id = Auth::user()->campus_id;
        $department_id = Auth::user()->department_id;

        $reports = FinancialAssistance::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        return view('registration.student_enrolment.financial_assistance', compact('reports'));
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
         $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {
//            dd($fileName);
                $path = ''; $imageName = '';
                if($request->file('file')) {
                    $imageName ="-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                    $path = 'uploads/financial_assistance';
                    $diskName = env('DISK');
                    $disk = Storage::disk($diskName);
                    $request->file('file')->move($path, $imageName);

                    //dd($request->all());
                    // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));

                    FinancialAssistance::create([
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'summary' => $request->summary,
                        'file' => $path.'/'.$imageName, 
                        'isComplete' => 'yes', 
                        'created_by' => Auth::user()->id 
                ]);

                    return response()->json(['success' => 'Record added successfully.']);
                }

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FinancialAssistance  $financialAssistance
     * @return \Illuminate\Http\Response
     */
    public function show(FinancialAssistance $financialAssistance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FinancialAssistance  $financialAssistance
     * @return \Illuminate\Http\Response
     */
    public function edit(FinancialAssistance $financialAssistance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FinancialAssistance  $financialAssistance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FinancialAssistance $financialAssistance)
    {
         $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            $path = ''; $imageName = '';
            if($request->file('file')) {
                $imageName ="-file-" . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/financial_assistance';
                $diskName = env('DISK');
                Storage::disk($diskName);
                $request->file('file')->move($path, $imageName);
                // $data = $request->replace(array_merge($request->all(), ['cv' => $path.'/'.$imageName]));
                FinancialAssistance::where('id', $financialAssistance->id)->update(
                    [
                    'summary' => $request->summary,
                    'file' => $path.'/'.$imageName,
                    'status' => $request->status,
                    'updated_by' => Auth::user()->id 
                    ]
                );

                return response()->json(['success' => 'Student Transfer updated successfully.']);
            }
           FinancialAssistance::where('id', $financialAssistance->id)->update([
               'summary' => $request->summary,
               'status' => $request->status,
               'updated_by' => Auth::user()->id 
           ]);
            return response()->json(['success' => 'Record updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FinancialAssistance  $financialAssistance
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinancialAssistance $financialAssistance)
    {
        try {
             FinancialAssistance::where('id', $financialAssistance->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
             FinancialAssistance::destroy($financialAssistance->id);
                return response()->json(['success' => 'Record deleted successfully.']);
         }catch (Exception $e)
             {
                return response()->json(['error' => 'Failed to delete record.']);
             }
    }

    protected function rules() {
        return [
            'summary'=> 'required',
            'file' => 'mimes:pdf,docx'
        ];
    }

    protected function update_rules() {
        return [
            'summary'=>'required',
            'file' => 'mimes:pdf,docx'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.',
            'file.mimes' => 'Document must be of the following file type: pdf or docx.'
        ];
    }
}
