<?php

namespace App\Http\Controllers;

use App\Models\StrategicManagement\BudgetaryInfo;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgets  = BudgetaryInfo::with('campus')->get();

         return view('strategic_management.budgetary_info', compact('budgets'));
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

            BudgetaryInfo::create([
                'campus_id' => Auth::user()->campus_id,
                'year' => $request->year,
                'uni_budget' => $request->uni_budget,
                'uni_proposed_budget' => $request->uni_proposed_budget,
                'budget_receive' => $request->budget_receive,
                'budget_type' => $request->budget_type,
                'created_by' => Auth::user()->id
            ]);

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
        try {
            BudgetaryInfo::where('id', $budgetaryInfo->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
            BudgetaryInfo::destroy($budgetaryInfo->id);
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
