<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Faculty\FacultyStability;
use App\Models\Common\Slip;
use App\BusinessSchool;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Models\StrategicManagement\Designation;
use Auth;

class FacultyStabilityController extends Controller
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
        $campus_id = Auth::user()->campus_id;
        $department_id = Auth::user()->department_id;

        /*$slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id])->where('regStatus','SAR')->first();
        if($slip){
            $stabilities = FacultyStability::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->where('type','SAR')->get();
        }else {
            $stabilities = FacultyStability::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->where('type','REG')->get();
        }*/

        $slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id, 'regStatus' => 'SAR'])->first();
        $where = ['campus_id'=> $campus_id,'department_id'=> $department_id];
        ($slip)?$where['type'] = 'SAR':$where['type'] = 'REG';
        $stabilities = FacultyStability::with('campus')->where($where)->get();


         return view('registration.faculty.faculty_stability', compact('stabilities'));
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

            $department_id = Auth::user()->department_id;
            $slip = Slip::where(['department_id'=> $department_id])->where('regStatus','SAR')->first();
            if($slip){
                $type='SAR';
            }else {
                $type = 'REG';
            }

            FacultyStability::create([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'total_faculty' => $request->total_faculty,
                'year' => $request->year,
                'resigned' => $request->resigned,
                'retired' => $request->retired,
                'terminated' => $request->terminated,
                'new_induction' => $request->new_induction,
                'isCompleted' => 'yes',
                'type' => $type,
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Faculty Stability added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacultyStability $facultyStability)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            FacultyStability::where('id', $facultyStability->id)->update([
                'total_faculty' => $request->total_faculty,
                'year' => $request->year,
                'resigned' => $request->resigned,
                'retired' => $request->retired,
                'terminated' => $request->terminated,
                'new_induction' => $request->new_induction,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Faculty Stability updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacultyStability $facultyStability)
    {
        try {
            FacultyStability::where('id', $facultyStability->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
            FacultyStability::destroy($facultyStability->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'total_faculty' => 'required',
            'year' => 'required',
            'resigned' => 'required',
            'retired' => 'required',
            'terminated' => 'required',
            'new_induction' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
