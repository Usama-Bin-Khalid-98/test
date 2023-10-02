<?php

namespace App\Http\Controllers;

use App\Models\StrategicManagement\StrategicPlan;
use App\Models\Common\Slip;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class StrategicPlanController extends Controller
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
        $plans  = StrategicPlan::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        return view('strategic_management.plan', compact('plans'));
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
        @$period = $this->dateDifference($request->plan_period, $request->plan_period_to, '%y Year %m Month');
        @$period_date = $this->dateDifference($request->plan_period, $request->plan_period_to, '%y.%m');
            //dd($period);
            if($period_date<3)
            {
                return response()->json(['message'=> 'Strategic Plan should be greater then 3 years.'], 422);
            }

                /// upload file here
            ///
            $imageName = '';
            $path = '';
            if($request->file('file')){
                $imageName= 'plan-'.time().'doc.'. $request->file->getClientOriginalExtension();
                $path= 'uploads/strategic_plan/';
                $diskName = env('DESK');
                $disk = Storage::disk($diskName);
                $request->file('file')->move($path, $imageName);
                // file upload end

            }
            StrategicPlan::create([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'plan_period_from' => $request->plan_period,
                'plan_period_to' => $request->plan_period_to,
                'plan_period' => $period,
                'aproval_date' => $request->aproval_date,
                'aproving_authority' => $request->aproving_authority,
                'isComplete' => 'yes',
                'file'=> $path.$imageName,
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Strategic Plan added successfully.'], 200);
        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        $interval = date_diff($datetime1, $datetime2);
        return $interval->format($differenceFormat);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\StrategicPlan  $strategicPlan
     * @return \Illuminate\Http\Response
     */
    public function show(StrategicPlan $strategicPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\StrategicPlan  $strategicPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(StrategicPlan $strategicPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\StrategicPlan  $strategicPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StrategicPlan $strategicPlan)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            $existing = StrategicPlan::find($strategicPlan->id);
            @$period = $this->dateDifference($request->plan_period, $request->plan_period_to, '%y Year %m Month');
            $update = [
                'plan_period' => $period,
                'plan_period_from' => $request->plan_period,
                'plan_period_to' => $request->plan_period_to,
                'aproval_date' => $request->aproval_date,
                'aproving_authority' => $request->aproving_authority,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ];

            if($request->file('file')) {
                $imageName = 'plan-' . time() . 'doc.' . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/strategic_plan';
                if(StrategicPlan::exists($existing->file)){
                    unlink($existing->file);
               }
                $request->file('file')->move($path, $imageName);
                $update['file'] = $path . '/' . $imageName;
            }
            StrategicPlan::where('id', $strategicPlan->id)->update($update);
            return response()->json(['success' => 'Strategic Plan updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\StrategicPlan  $strategicPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(StrategicPlan $strategicPlan)
    {
//        dd($strategicPlan);
        try {
            StrategicPlan::where('id', $strategicPlan->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            StrategicPlan::destroy($strategicPlan->id);
            StrategicPlan::where([
                "campus_id" => $strategicPlan->campus_id,
                "department_id" => $strategicPlan->department_id,
                "plan_period_from" => $strategicPlan->plan_period_from,
                "plan_period_to" => $strategicPlan->plan_period_to,
                "plan_period" => $strategicPlan->plan_period,
                "aproval_date" => $strategicPlan->aproval_date,
                "aproving_authority" => $strategicPlan->aproving_authority,
            ])->delete();
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'plan_period' => 'required',
            'aproval_date' => 'required',
            'aproving_authority' => 'required',
            'file.*' => 'file|mimes:ppt,pptx,doc,docx,pdf'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
