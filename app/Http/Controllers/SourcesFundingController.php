<?php

namespace App\Http\Controllers;

use App\Models\Common\Slip;
use App\Models\StrategicManagement\SourcesFunding;
use App\Models\StrategicManagement\FundingSources;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class SourcesFundingController extends Controller
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
        @$amount = SourcesFunding::where(['campus_id'=> $campus_id,'department_id' => $department_id,'status' => 'active'])->get()->sum('amount');
        @$percent_share = SourcesFunding::where(['campus_id'=> $campus_id,'department_id' => $department_id,'status' => 'active'])->get()->sum('percent_share')??0;
        $fundings = FundingSources::get();
        $slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id, 'regStatus'=>'SAR'])->first();
        if($slip){
            $type='SAR';
        }else {
            $type = 'REG';
        }
        $sources  = SourcesFunding::with('campus','funding_sources')
            ->where(['campus_id'=> $campus_id,'department_id'=> $department_id, 'type' => $type])
            ->get();

         return view('strategic_management.sources_funding', compact('fundings','sources','amount','percent_share'));
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
            $userInfo = Auth::user();
            $slip = Slip::where(['business_school_id'=>$userInfo->campus_id,'department_id'=> $userInfo->department_id, 'regStatus'=>'SAR'])->first();
            if($slip){
                $type='SAR';
            }else {
                $type = 'REG';
            }

            SourcesFunding::create([
                'campus_id' => $userInfo->campus_id,
                'department_id' => $userInfo->department_id,
                'funding_sources_id' => $request->funding_sources_id,
                'amount' => $request->amount,
                'percent_share' => $request->percent_share,
                'type' => $type,
                'isComplete' => 'yes',
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Sources of Funding added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\SourcesFunding  $sourcesFunding
     * @return \Illuminate\Http\Response
     */
    public function show(SourcesFunding $sourcesFunding)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\SourcesFunding  $sourcesFunding
     * @return \Illuminate\Http\Response
     */
    public function edit(SourcesFunding $sourcesFunding)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\SourcesFunding  $sourcesFunding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SourcesFunding $sourcesFunding)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            SourcesFunding::where('id', $sourcesFunding->id)->update([
                'funding_sources_id' => $request->funding_sources_id,
                'amount' => $request->amount,
                'percent_share' => $request->percent_share,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Sources of Funding updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\SourcesFunding  $sourcesFunding
     * @return \Illuminate\Http\Response
     */
    public function destroy(SourcesFunding $sourcesFunding)
    {
        try {
            SourcesFunding::where('id', $sourcesFunding->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            SourcesFunding::destroy($sourcesFunding->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'funding_sources_id' => 'required',
            'amount' => 'required',
            'percent_share' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
