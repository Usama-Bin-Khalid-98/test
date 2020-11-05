<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Faculty\FacultyStudentRatio;
use App\Models\Common\Slip;
use App\BusinessSchool;
use App\Models\Faculty\FacultyTeachingCources;
use App\Models\StrategicManagement\Scope;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class FacultyStudentRatioController extends Controller
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
        $programs = Scope::with('program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        $slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id])->where('regStatus','SAR')->first();
        if($slip){
            $ratios = FacultyStudentRatio::with('campus','program')
                ->where(['campus_id'=> $campus_id,'department_id'=> $department_id])
                ->where('type','SAR')
                ->where('deleted_at',null)
                ->get();
        }else {
            $ratios = FacultyStudentRatio::with('campus','program')
                ->where(['campus_id'=> $campus_id,'department_id'=> $department_id])
                ->where('type','REG')
                ->where('deleted_at',null)
                ->get();
        }



        $getFTE = FacultyTeachingCources::with('faculty_program')
            ->where('lookup_faculty_type_id' , 1)
            ->where('deleted_at', null)
            ->orWhere('lookup_faculty_type_id', 2)
            ->get();

        $totalFTE = 0;
        if($getFTE){
            foreach ($getFTE as $val)
            {
                foreach ($val->faculty_program as $key => $progs)
                {
                    $totalFTE += $progs->tc_program/$val->max_cources_allowed;
                }
            }
            $totalFTE = round($totalFTE, 2);
        }

        $getVFE = FacultyTeachingCources::with('faculty_program')
            ->where('lookup_faculty_type_id' , 3)
            ->where('deleted_at', null)
            ->get();

        $totalVFE = 0;
        if($getVFE){
            foreach ($getVFE as $vfe)
            {
                foreach ($vfe->faculty_program as $key => $prog)
                {
                    $totalVFE += $prog->tc_program/$vfe->max_cources_allowed;
                }
            }
            $totalVFE = round($totalFTE/3, 2);
            //dd($totalVFE);
        }
         return view('registration.faculty.faculty_student_ratio', compact('programs','ratios', 'totalFTE', 'totalVFE'));
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
            $campus_id = Auth::user()->campus_id;
            $slip = Slip::where(['business_school_id'=> $campus_id,'department_id'=> $department_id])->where('regStatus','SAR')->first();
            if($slip){
                $type='SAR';
            }else {
                $type = 'REG';
            }

            FacultyStudentRatio::create([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'program_id' => $request->program_id,
                'total_enrollments' => $request->total_enrollments,
                'isCompleted' => 'yes',
                'type' => $type,
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Faculty Student Ratio added successfully.']);


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
    public function update(Request $request, FacultyStudentRatio $facultyStudentRatio)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            FacultyStudentRatio::where('id', $facultyStudentRatio->id)->update([
                'program_id' => $request->program_id,
                'total_enrollments' => $request->total_enrollments,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Faculty Student Ratio updated successfully.']);

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
    public function destroy(FacultyStudentRatio $facultyStudentRatio)
    {
        try {
            FacultyStudentRatio::where('id', $facultyStudentRatio->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            FacultyStudentRatio::destroy($facultyStudentRatio->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'program_id' => 'required',
            'total_enrollments' => 'required',
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
