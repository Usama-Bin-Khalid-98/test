<?php

namespace App\Http\Controllers;

use App\AppendixFile;
use App\Models\Facility\FinancialInfo;
use App\Models\Facility\IncomeSource;
use App\Models\Common\Slip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Common\StrategicManagement\BusinessSchoolTyear;
use Auth;
use Illuminate\Support\Facades\Log;

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
            ->get();
        $income_type ='expense';
        $infos_expense = FinancialInfo::with('income_source')
            ->whereHas('income_source', function($q) use($income_type) {
            $q->where('type', $income_type);
            })
            ->where(['campus_id'=> $campus_id,'department_id'=> $department_id])
            ->get();
        
        $years = BusinessSchoolTyear::where(['campus_id'=> $campus_id, 'department_id'=> $department_id])->get()->first();
        $appendix_file = AppendixFile::where(['campus_id'=> $campus_id,'department_id'=> $department_id])->first();

        return view('registration.facilities_information.financial_info', compact('income','infos', 'infos_expense', 'years', 'appendix_file'));
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
            $check_data = [
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'income_source_id' => $request->income_source_id,
                'year_three' => $request->year_three,
                'year_two' => $request->year_two,
                'year_one' => $request->year_one,
                'year_t' => $request->year_t,
                'isComplete' => 'yes',
            ];
            $check = FinancialInfo::where($check_data)->exists();
            if(!$check) {
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
                    'created_by' => Auth::user()->id
                ]);
            }else{
            return response()->json(['error' => 'Financial Info already exists.'], 422);

            }
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

    public function uploadAppendixFile(Request $request){
        if(!$request->file('appendix_7A')){
            return response()->json(['error' => 'Please upload a valid file']);
        }
        $appendix_file = AppendixFile::where([
            'campus_id'=> Auth::user()->campus_id,
            'business_school_id'=>Auth::user()->business_school_id,
            'department_id' => Auth::user()->department_id,
            ])->first();

        $path = 'uploads/financial_policy';
        $imageName = "-file-" . time() . '.' . $request->appendix_7A->getClientOriginalExtension();
        $request->file('appendix_7A')->move($path, $imageName);
        if($appendix_file){
            if($appendix_file->financial_policy && $appendix_file->financial_policy !== ''){
                try{
                    unlink($appendix_file->financial_policy);
                }catch (Exception $e){
                    Log::error($e);
                }
            }
            AppendixFile::where(['id' => $appendix_file->id])->update(['financial_policy' => $path . '/' . $imageName]);        
        }else{
            
            AppendixFile::create([
                'campus_id' => Auth::user()->campus_id,
                'business_school_id' => Auth::user()->business_school_id,
                'department_id' => Auth::user()->department_id,
                'financial_policy' => $path . '/' . $imageName
            ]);
        }
        return response()->json(['success' => 'Appendix 7A uploaded successfully.']);
    }
}
