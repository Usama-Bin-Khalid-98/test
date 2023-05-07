<?php

namespace App\Http\Controllers;

use App\StudentGender;
use App\Models\StrategicManagement\Scope;
use App\Models\Common\Slip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class StudentGenderController extends Controller
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
        $slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id])->where('regStatus','SAR')->first();
        if($slip){
            $genders = StudentGender::with('campus','program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->where('type','SAR')->get();
        }else {
            $genders = StudentGender::with('campus','program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->where('type','REG')->get();
        }
        $programs = Scope::with('program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id, 'type'=>$slip?'SAR':'REG'])->get();

        return view('registration.student_enrolment.student_gender', compact('programs','genders'));
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
            $slip = Slip::where(['business_school_id'=>$uni_id,'department_id'=> $dept_id])->where('regStatus','SAR')->first();
            if($slip){
                $type='SAR';
            }else {
                $type = 'REG';
            }
            $check_data = [
                'campus_id' => $uni_id,
                'department_id' => $dept_id,
                'program_id' => $request->program_id,
                'type' => $type,
            ];
            $check = StudentGender::where($check_data)->exists();
            if(!$check){
                StudentGender::create([
                    'campus_id' => $uni_id,
                    'department_id' => $dept_id,
                    'program_id' => $request->program_id,
                    'male' => $request->male,
                    'female' => $request->female,
                    'isComplete' => 'yes',
                    'type' => $type,
                    'created_by' => Auth::user()->id
                ]);
    
                return response()->json(['success' => 'Student Gender Inserted successfully.']);
            }

            return response()->json(['error' => 'Student Gender already exists.'], 422);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentGender  $studentGender
     * @return \Illuminate\Http\Response
     */
    public function show(StudentGender $studentGender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentGender  $studentGender
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentGender $studentGender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentGender  $studentGender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentGender $studentGender)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            $total = $request->male + $request->female;
            // return response()->json($total);
            if($total > 100){
                return response()->json(['error' => 'Male & Female should not exceed 100']);
            }
            StudentGender::where('id', $studentGender->id)->update([
                'program_id' => $request->program_id,
                'male' => $request->male,
                'female' => $request->female,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Student Gender mix updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentGender  $studentGender
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentGender $studentGender)
    {
       try {
        StudentGender::where('id', $studentGender->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            studentGender::destroy($studentGender->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'program_id' => 'required',
            'male' => 'required',
            'female' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
