<?php

namespace App\Http\Controllers;

use App\Models\Common\StrategicManagement\BusinessSchoolTyear;
use App\Models\StrategicManagement\BudgetaryInfo;
use App\Models\Common\Slip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class BudgetaryInfoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }

    public function index()
    {
        $campus_id = Auth::user()->campus_id;
        $department_id = Auth::user()->department_id;
        $budgets  = BudgetaryInfo::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        $t_years = BusinessSchoolTyear::where(['campus_id' =>$campus_id, 'department_id' => $department_id])->get()->first();

        @$tyears = ['tyear' => @$t_years->tyear, 'year_t_1' => @$t_years->year_t_1, 'year_t_2' => @$t_years->year_t_2];
         return view('strategic_management.budgetary_info', compact('budgets', 'tyears'));
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
//        dd($request);
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {
            if($request->year){
                foreach ($request->year as $key=>$year) {
                    if(!$request->uni_budget[$key]){
                        continue;
                    }
                    $where_data = [
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'year' => $request->year[$key],
                        ];
                    $check = BudgetaryInfo::where($where_data)->exists();
                    if(!$check) {
                        BudgetaryInfo::create([
                            'campus_id' => Auth::user()->campus_id,
                            'department_id' => Auth::user()->department_id,
                            'year' => $request->year[$key],
                            'uni_budget' => $request->uni_budget[$key],
                            'uni_proposed_budget' => $request->uni_proposed_budget[$key],
                            'budget_receive' => $request->budget_receive[$key],
                            'budget_type' => $request->budget_type[$key],
                            'isComplete' => 'yes',
                            'created_by' => Auth::user()->id
                        ]);
                    }else
                    {
                        return response()->json(['error' => 'Budgetary Information already exists.'], 422);
                    }
                }
            }

            return response()->json(['success' => 'Budgetary Information added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\BudgetaryInfo  $budgetaryInfo
     * @return \Illuminate\Http\Response
     */
    public function show(BudgetaryInfo $budgetaryInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\BudgetaryInfo  $budgetaryInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(BudgetaryInfo $budgetaryInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\BudgetaryInfo  $budgetaryInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BudgetaryInfo $budgetaryInfo)
    {
        $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            BudgetaryInfo::where('id', $budgetaryInfo->id)->update([
                'year' => $request->year,
                'uni_budget' => $request->uni_budget,
                'uni_proposed_budget' => $request->uni_proposed_budget,
                'budget_receive' => $request->budget_receive,
                'budget_type' => $request->budget_type,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Budgetary Information updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\BudgetaryInfo  $budgetaryInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(BudgetaryInfo $budgetaryInfo)
    {
//        dd($budgetaryInfo);
        try {
            BudgetaryInfo::where('id', $budgetaryInfo->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            BudgetaryInfo::destroy($budgetaryInfo->id);
            BudgetaryInfo::where([
                "campus_id" => $budgetaryInfo->campus_id,
                "department_id" => $budgetaryInfo->department_id,
                "year" => $budgetaryInfo->year,
                "uni_budget" => $budgetaryInfo->uni_budget,
                "uni_proposed_budget" => $budgetaryInfo->uni_proposed_budget,
                "budget_receive" => $budgetaryInfo->budget_receive,
                "budget_type" => $budgetaryInfo->budget_type
            ])->delete();
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'year' => 'required',
            'uni_budget' => 'required',
            'uni_proposed_budget' => 'required',
            'budget_receive' => 'required',
            'budget_type' => 'required'
        ];
    }

     protected function update_rules() {
        return [
            'year' => 'required',
            'uni_budget' => 'required',
            'uni_proposed_budget' => 'required',
            'budget_receive' => 'required',
            'budget_type' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
