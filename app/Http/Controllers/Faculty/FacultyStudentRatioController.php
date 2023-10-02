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

        $ratios = FacultyStudentRatio::with('campus','program')
            ->where(['campus_id'=> $campus_id,'department_id'=> $department_id])
            ->where('deleted_at',null)
            ->get();

        $programs = Scope::with('program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        $getFTE = FacultyTeachingCources::with('faculty_program')
            ->where('campus_id', $campus_id)
            ->where('department_id', $department_id)
            ->where('deleted_at', null)
            ->where(function($query){
                $query->where('lookup_faculty_type_id', 1)->orwhere('lookup_faculty_type_id', 2);
            })
            ->get();
        // dd($ratios);
        $totalFTE = 0;
        $byProgramFTE = [];
        if($getFTE){
            foreach ($getFTE as $val)
            {
                foreach ($val->faculty_program as $key => $progs)
                {
                    if(count($byProgramFTE) == 0){
                        $byProgramFTE[$progs->program_id] = round($progs->tc_program/$val->max_cources_allowed, 2);
                    }else{
                        if(array_key_exists($progs->program_id, $byProgramFTE)){
                            $byProgramFTE[$progs->program_id] = $byProgramFTE[$progs->program_id] + round($progs->tc_program/$val->max_cources_allowed, 2);
                        }else{
                            $byProgramFTE[$progs->program_id] = round($progs->tc_program/$val->max_cources_allowed, 2);
                        }
                    }
                }
            }
        }
        

        $getVFE = FacultyTeachingCources::with('faculty_program')
            ->where('lookup_faculty_type_id' , 3)
            ->where('campus_id', $campus_id)
            ->where('department_id', $department_id)
            ->where('deleted_at', null)
            ->get();
        $totalVFE = 0;
        $byProgramVFE = [];
        if($getVFE){
            foreach ($getVFE as $vfe)
            {
                foreach ($vfe->faculty_program as $key => $prog)
                {
                    if(count($byProgramVFE) == 0){
                        if(intval($vfe->max_cources_allowed) > 0){
                            $byProgramVFE[$prog->program_id] = round($prog->tc_program/$vfe->max_cources_allowed, 2);
                        }else{
                            $byProgramVFE[$prog->program_id] = round($prog->tc_program, 2);
                        }
                    }else{
                        if(array_key_exists($prog->program_id, $byProgramVFE)){
                            if(intval($vfe->max_cources_allowed) > 0){
                                $byProgramVFE[$prog->program_id] = round($byProgramVFE[$prog->program_id], 2) + round($prog->tc_program/$vfe->max_cources_allowed, 2);
                            }else{
                                $byProgramVFE[$prog->program_id] = round($byProgramVFE[$prog->program_id], 2) + round($prog->tc_program, 2);
                            }
                        }else{
                            if(intval($vfe->max_cources_allowed) > 0){
                                $byProgramVFE[$prog->program_id] = round($prog->tc_program/$vfe->max_cources_allowed, 2);
                            }else{
                                $byProgramVFE[$prog->program_id] = round($prog->tc_program, 2);
                            }
                        }
                    }
                }
            }
        }
        // dd($byProgramFTE);
         return view('registration.faculty.faculty_student_ratio', compact('programs','ratios', 'byProgramFTE', 'byProgramVFE'));
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
            $check_data = [
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'program_id' => $request->program_id,
                'isCompleted' => 'yes',
            ];
            $check = FacultyStudentRatio::where($check_data)->exists();
            if(!$check) {

                FacultyStudentRatio::create([
                    'campus_id' => Auth::user()->campus_id,
                    'department_id' => Auth::user()->department_id,
                    'program_id' => $request->program_id,
                    'total_enrollments' => $request->total_enrollments,
                    'isCompleted' => 'yes',
                    'created_by' => Auth::user()->id
                ]);
            }else{
            return response()->json(['error' => 'Faculty Student Ratio already exists.'], 422);

            }
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
//        dd($facultyStudentRatio);
        try {
            FacultyStudentRatio::where('id', $facultyStudentRatio->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            FacultyStudentRatio::destroy($facultyStudentRatio->id);
            FacultyStudentRatio::where([
                "campus_id" => $facultyStudentRatio->campus_id,
                "department_id" => $facultyStudentRatio->department_id,
                "program_id" => $facultyStudentRatio->program_id,
                "total_enrollments" => $facultyStudentRatio->total_enrollments,
                "isCompleted" => "yes"
            ])->delete();
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
