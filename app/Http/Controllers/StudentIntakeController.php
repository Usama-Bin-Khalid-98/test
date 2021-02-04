<?php

namespace App\Http\Controllers;

use App\Models\Common\StrategicManagement\BusinessSchoolTyear;
use App\StudentIntake;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class StudentIntakeController extends Controller
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
        $tyear = BusinessSchoolTyear::where(
            [
                'campus_id'=>$campus_id,
                'department_id'=>$department_id
            ])->get()->first();

//        dd($tyear);
        $bs = StudentIntake::where(['campus_id'=> $campus_id,'department_id'=> $department_id,'status' => 'active'])->get()->sum('bs_level');
        $ms = StudentIntake::where(['campus_id'=> $campus_id,'department_id'=> $department_id,'status' => 'active'])->get()->sum('ms_level');
        $phd = StudentIntake::where(['campus_id'=> $campus_id,'department_id'=> $department_id,'status' => 'active'])->get()->sum('phd_level');
        $t_intake = StudentIntake::where(['campus_id'=> $campus_id,'department_id'=> $department_id,'status' => 'active'])->get()->sum('total_intake');
        $intakes = StudentIntake::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

         return view('registration.student_enrolment.intakes', compact('intakes','bs','ms','phd','t_intake','tyear'));
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
            $uni_id = Auth::user()->campus_id;
            $dept_id = Auth::user()->department_id;
            StudentIntake::create([
                'campus_id' => $uni_id,
                'department_id' => $dept_id,
                'year' => $request->year,
                'bs_level' => $request->bs_level,
                'ms_level' => $request->ms_level,
                'phd_level' => $request->phd_level,
                'total_intake' => $request->bs_level+ $request->ms_level+$request->phd_level,
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Student Intakes added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentIntake  $studentIntake
     * @return \Illuminate\Http\Response
     */
    public function show(StudentIntake $studentIntake)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentIntake  $studentIntake
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentIntake $studentIntake)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentIntake  $studentIntake
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentIntake $studentIntake)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            StudentIntake::where('id', $studentIntake->id)->update([
                'year' => $request->year,
                'bs_level' => $request->bs_level,
                'ms_level' => $request->ms_level,
                'phd_level' => $request->phd_level,
                'total_intake' =>  $request->bs_level+ $request->ms_level+$request->phd_level,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Student Intakes updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentIntake  $studentIntake
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentIntake $studentIntake)
    {
        try {
            StudentIntake::where('id', $studentIntake->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            StudentIntake::destroy($studentIntake->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'year' => 'required',
            'bs_level' => 'required',
            'ms_level' => 'required',
            'phd_level' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
