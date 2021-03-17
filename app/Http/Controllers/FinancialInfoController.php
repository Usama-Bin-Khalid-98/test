<?php

namespace App\Http\Controllers;

use App\Models\Facility\FinancialInfo;
use App\Models\Facility\IncomeSource;
use App\Models\Common\Slip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Auth;


class FinancialInfoController extends Controller
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
        $income = IncomeSource::all();
        $income_type ='income';
        $infos = FinancialInfo::with('income_source')
            ->whereHas('income_source', function($q) use ($income_type) {
            $q->where('type', $income_type);
            })
            ->where(['campus_id'=> $campus_id,'department_id'=> $department_id])
            ->where('type','REG')
            ->get();
        $income_type ='expense';
        $infos_expense = FinancialInfo::with('income_source')
            ->whereHas('income_source', function($q) use($income_type) {
            $q->where('type', $income_type);
            })
            ->where(['campus_id'=> $campus_id,'department_id'=> $department_id])
            ->get();


        //dd($infos_expense);
        return view('registration.facilities_information.financial_info', compact('income','infos', 'infos_expense'));
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
        //dd($request->all());
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {

            $department_id = Auth::user()->department_id;
            $campus_id = Auth::user()->campus_id;
            $slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id])->where('regStatus','SAR')->first()->regStatus;
//            dd($slip);
            if($slip){
                $type='SAR';
            }else {
                $type = 'REG';
            }

            FinancialInfo::create([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'income_source_id' => $request->income_source_id,
                'year_three' => $request->year_three,
                'year_two' => $request->year_two,
                'year_one' => $request->year_one,
                'year_t' => $request->year_t,
                'year_t_plus_one' => $request->year_t_plus_one,
                'year_t_plus_two' => $request->year_t_plus_two,
                'isComplete' => 'yes',
                'type' => $type,
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Financial Info added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facility\FinancialInfo  $financialInfo
     * @return \Illuminate\Http\Response
     */
    public function show(FinancialInfo $financialInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facility\FinancialInfo  $financialInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(FinancialInfo $financialInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facility\FinancialInfo  $financialInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FinancialInfo $financialInfo)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            FinancialInfo::where('id', $financialInfo->id)->update([
                'income_source_id' => $request->income_source_id,
                'year_three' => $request->year_three,
                'year_two' => $request->year_two,
                'year_one' => $request->year_one,
                'year_t' => $request->year_t,
                'year_t_plus_one' => $request->year_t_plus_one,
                'year_t_plus_two' => $request->year_t_plus_two,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Financial Info updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facility\FinancialInfo  $financialInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinancialInfo $financialInfo)
    {
        try {
            FinancialInfo::where('id', $financialInfo->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            FinancialInfo::destroy($financialInfo->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'income_source_id' => 'required',
            'year_three' => 'required',
            'year_two' => 'required',
            'year_one' => 'required',
            'year_t' => 'required',
            'year_t_plus_one' => 'required',
            'year_t_plus_two' => 'required'
        ];
    }




    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
