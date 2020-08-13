<?php

namespace App\Http\Controllers;

use App\DepartmentFee;
use App\Models\Common\Department;
use App\Models\Common\FeeType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class DepartmentFeeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    
    public function index()
    {
        $departments = Department::all();
        $fees = FeeType::all();

        $depts = DepartmentFee::with('campus','department','fee_type')->get();

        return view('department_fee.department_fee',compact('departments','fees','depts'));
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

           DepartmentFee::create([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => $request->department_id,
                'fee_type_id' => $request->fee_type_id,
                'created_by' => Auth::user()->id

            ]);

            return response()->json(['success' => ' Department Fee added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DepartmentFee  $departmentFee
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentFee $departmentFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DepartmentFee  $departmentFee
     * @return \Illuminate\Http\Response
     */
    public function edit(DepartmentFee $departmentFee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DepartmentFee  $departmentFee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DepartmentFee $departmentFee)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            DepartmentFee::where('id', $departmentFee->id)->update([
                'department_id' => $request->department_id,
                'fee_type_id' => $request->fee_type_id,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Department Fee updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DepartmentFee  $departmentFee
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepartmentFee $departmentFee)
    {
        try {
            DepartmentFee::where('id', $departmentFee->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
            DepartmentFee::destroy($departmentFee->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [

            'department_id' => 'required',
            'fee_type_id' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
