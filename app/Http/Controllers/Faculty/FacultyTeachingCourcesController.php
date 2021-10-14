<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Common\Program;
use App\Models\Faculty\FacultyProgram;
use App\Models\Faculty\FacultyTeachingCources;
use App\Models\Common\Slip;
use App\BusinessSchool;
use App\Models\Common\Designation;
use App\LookupFacultyType;
use App\Models\StrategicManagement\Scope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;


class FacultyTeachingCourcesController extends Controller
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
        $designations = Designation::whereIn('id', [1,2,6,10])->get();
        $visitings;
        $faculty_types;
        $getUrl =\Illuminate\Support\Facades\Request::segment(1);
         if($getUrl =='faculty-teaching')
         {
             $faculty_types = LookupFacultyType::where('id', 2)
                 ->orWhere('id', 1)->get();

         }else{
             $faculty_types = LookupFacultyType::where('id', 3)->get();
         }


        //dd($faculty_types);
        /*$slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id])->where('regStatus','SAR')->first();
        if($slip){
            $visitings = FacultyTeachingCources::with('campus','lookup_faculty_type','designation')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->where('type','SAR')->get();
        }else {
            $visitings = FacultyTeachingCources::with('campus','lookup_faculty_type','designation')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->where('type','REG')->get();
        }*/

        $slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id, 'regStatus' => 'SAR'])->first();
        $where = ['campus_id'=> $campus_id,'department_id'=> $department_id];
        $slip?$where['type'] = 'SAR':$where['type'] = 'REG';
        $getScope = Scope::with('program')->where($where)->get();

        if($getUrl =='faculty-teaching') {

            $visitings = FacultyTeachingCources::with(['campus','department',
                'lookup_faculty_type'=> function($query) {
                $query->where('id', 1);
                $query->orWhere('id', 2);
            }, 'designation', 'faculty_program'])
//                ->where('lookup_faculty_type_id', 1)
//                ->orWhere('lookup_faculty_type_id', 2)
                ->where($where)
                ->where('deleted_at', null)
                ->get();
//            dd($visitings);

        }else{
            $visitings = FacultyTeachingCources::with('campus', 'lookup_faculty_type', 'designation', 'faculty_program')
                ->where($where)
                ->where('deleted_at', null)
                ->where('lookup_faculty_type_id', 3)
                ->get();
        }
//        dd($visitings[0]->faculty_program);
//       foreach ($visitings as $visit)
//       {
//           //dd($visit);
//           foreach ($visit->faculty_program as $program)
//           {
//               dd($program->tc_program, 'program',$program->program->name);
//           }
//       }
// dd('working here');

         return view('registration.faculty.faculty_teaching_courses', compact('designations','faculty_types','visitings', 'getScope'));
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


        try {

            $department_id = Auth::user()->department_id;
            $slip = Slip::where(['department_id'=> $department_id])->where('regStatus','SAR')->first();
            if($slip){
                $type='SAR';
            }else {
                $type = 'REG';
            }

            $path = '';
            if(@$request->file('file')) {
                $path = @$request->file('file')->getRealPath();
            }
            if($path) {
                $data = array_map('str_getcsv', file(@$path));
                $csv_data = array_slice($data, 1);
                foreach($csv_data as $index=>$addData) {
                    $getDesignation = Designation::where(['name' => @$addData[1]])->first();
                    if (!$getDesignation) {
                        return response()->json(['error' => ' Incorrect Designation in line ', 'line' => $index + 2], 422);

                    }

                    ////// faculty type
                    $getFacultyType = LookupFacultyType::where(['faculty_type'=> @$addData[2]])->first();
                    if(!$getFacultyType)
                    {
                        return response()->json(['error' => ' Incorrect Faculty Type in line ', 'line' => $index + 2], 422);

                    }

                    $check_data = [
                        'name' => @$addData[0],
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'lookup_faculty_type_id' => $getFacultyType->id,
                        'designation_id' => $getDesignation->id,
                        'isCompleted' => 'yes',
                        'type' => $type];
                    $check = FacultyTeachingCources::where($check_data)->exists();

                    if (!$check) {

                    $program = Program::where(['name'=> @$addData[4]])->first();
                    if(!$program)
                    {
                        return response()->json(['error' => ' Incorrect Program in line ', 'line'=> $index + 2], 422);

                    }

                            $insert = FacultyTeachingCources::create([
                                'name' => @$addData[0],
                                'campus_id' => Auth::user()->campus_id,
                                'department_id' => Auth::user()->department_id,
                                'lookup_faculty_type_id' => $getFacultyType->id,
                                'designation_id' => $getDesignation->id,
                                'max_cources_allowed' => @$addData[3],
                                'isCompleted' => 'yes',
                                'type' => $type,
                                'created_by' => Auth::user()->id
                            ]);

                    if(@$addData[4]) {

                        $program = Program::where(['name'=> @$addData[4]])->first();
                        if(!$program)
                        {
                            return response()->json(['error' => ' Incorrect Program in line ', 'line' => $index + 2], 422);

                        }

                        $insertTcProgram = FacultyProgram::create(
                            [
                                'faculty_teaching_cource_id' => $insert->id,
                                'program_id' => $program->id,
                                'tc_program' => @$addData[5],
                                'created_by' => Auth::id()
                            ]
                        );
                    }

                    if(@$addData[6]) {
                        $program = Program::where(['name'=> @$addData[6]])->first();
                        if(!$program)
                        {
                            return response()->json(['error' => ' Incorrect Program in line ', 'line' => $index + 2], 422);

                        }
                        $insertTcProgram = FacultyProgram::create(
                            [
                                'faculty_teaching_cource_id' => $insert->id,
                                'program_id' => $program->id,
                                'tc_program' => @$addData[7],
                                'created_by' => Auth::id()
                            ]
                        );
                    }

                    if(@$addData[8]) {
                        $program = Program::where(['name'=> @$addData[8]])->first();
                        if(!$program)
                        {
                            return response()->json(['error' => ' Incorrect Program in line ', 'line'=> $index + 2], 422);

                        }
                        $insertTcProgram = FacultyProgram::create(
                            [
                                'faculty_teaching_cource_id' => $insert->id,
                                'program_id' => $program->id,
                                'tc_program' => @$addData[9],
                                'created_by' => Auth::id()
                            ]
                        );
                    }

                    if(@$addData[10]) {
                        $program = Program::where(['name'=> @$addData[10]])->first();
                        if(!$program)
                        {
                            return response()->json(['error' => ' Incorrect Program in line ' , 'line'=> $index + 2], 422);

                        }
                        $insertTcProgram = FacultyProgram::create(
                            [
                                'faculty_teaching_cource_id' => $insert->id,
                                'program_id' => $program->id,
                                'tc_program' => @$addData[11],
                                'created_by' => Auth::id()
                            ]
                        );
                    }
                    if(@$addData[12]) {
                        $program = Program::where(['name'=> @$addData[12]])->first();
                        if(!$program)
                        {
                            return response()->json(['error' => ' Incorrect Program in line ' , 'line'=> $index + 2], 422);

                        }
                        $insertTcProgram = FacultyProgram::create(
                            [
                                'faculty_teaching_cource_id' => $insert->id,
                                'program_id' => $program->id,
                                'tc_program' => @$addData[13],
                                'created_by' => Auth::id()
                            ]
                        );
                    }
                    if(@$addData[14]) {
                        $program = Program::where(['name'=> @$addData[14]])->first();
                        if(!$program)
                        {
                            return response()->json(['error' => ' Incorrect Program in line ' , 'line'=> $index + 2], 422);

                        }
                        $insertTcProgram = FacultyProgram::create(
                            [
                                'faculty_teaching_cource_id' => $insert->id,
                                'program_id' => $program->id,
                                'tc_program' => @$addData[15],
                                'created_by' => Auth::id()
                            ]
                        );
                    }
                    if(@$addData[16]) {
                        $program = Program::where(['name'=> @$addData[16]])->first();
                        if(!$program)
                        {
                            return response()->json(['error' => ' Incorrect Program in line ' , 'line'=> $index + 2], 422);

                        }
                        $insertTcProgram = FacultyProgram::create(
                            [
                                'faculty_teaching_cource_id' => $insert->id,
                                'program_id' => $program->id,
                                'tc_program' => @$addData[17],
                                'created_by' => Auth::id()
                            ]
                        );
                    }
                    if(@$addData[18]) {
                        $program = Program::where(['name'=> @$addData[18]])->first();
                        if(!$program)
                        {
                            return response()->json(['error' => ' Incorrect Program in line ' , 'line'=> $index + 2], 422);

                        }
                        $insertTcProgram = FacultyProgram::create(
                            [
                                'faculty_teaching_cource_id' => $insert->id,
                                'program_id' => $program->id,
                                'tc_program' => @$addData[19],
                                'created_by' => Auth::id()
                            ]
                        );
                    }
                    if(@$addData[20]) {
                        $program = Program::where(['name'=> @$addData[20]])->first();
                        if(!$program)
                        {
                            return response()->json(['error' => ' Incorrect Program in line ' , 'line'=> $index + 2], 422);

                        }
                        $insertTcProgram = FacultyProgram::create(
                            [
                                'faculty_teaching_cource_id' => $insert->id,
                                'program_id' => $program->id,
                                'tc_program' => @$addData[21],
                                'created_by' => Auth::id()
                            ]
                        );
                    }


                    }
                }

                }
            else {
                $validation = Validator::make($request->all(), $this->rules(), $this->messages());
                if ($validation->fails()) {
                    return response()->json($validation->messages()->all(), 422);
                }

                $check_data = [
                    'name' => $request->name,
                    'campus_id' => Auth::user()->campus_id,
                    'department_id' => Auth::user()->department_id,
                    'lookup_faculty_type_id' => $request->lookup_faculty_type_id,
                    'designation_id' => $request->designation_id,
                    'isCompleted' => 'yes',
                    'type' => $type];
                $check = FacultyTeachingCources::where($check_data)->exists();
                if (!$check) {

                    $insert = FacultyTeachingCources::create([
                        'name' => $request->name,
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'lookup_faculty_type_id' => $request->lookup_faculty_type_id,
                        'designation_id' => $request->designation_id,
                        'max_cources_allowed' => $request->max_cources_allowed,
                        'isCompleted' => 'yes',
                        'type' => $type,
                        'created_by' => Auth::user()->id
                    ]);

                    foreach ($request->tc_program as $key => $program) {
                        $insertTcProgram = FacultyProgram::create(
                            [
                                'faculty_teaching_cource_id' => $insert->id,
                                'program_id' => $key,
                                'tc_program' => $program,
                                'created_by' => Auth::id()
                            ]
                        );
                    }

                    $insert = FacultyTeachingCources::create([
                        'name' => $request->name,
                        'campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'lookup_faculty_type_id' => $request->lookup_faculty_type_id,
                        'designation_id' => $request->designation_id,
                        'max_cources_allowed' => $request->max_cources_allowed,
                        'isCompleted' => 'yes',
                        'type' => 'SAR',
                        'created_by' => Auth::user()->id
                    ]);

                    foreach ($request->tc_program as $key => $program) {
                        $insertTcProgram = FacultyProgram::create(
                            [
                                'faculty_teaching_cource_id' => $insert->id,
                                'program_id' => $key,
                                'tc_program' => $program,
                                'created_by' => Auth::id()
                            ]
                        );
                    }
                } else {
                    return response()->json(['error' => 'Visiting Faculty already exists.'], 422);
                }
            }

                return response()->json(['success' => 'Visiting Faculty added successfully.']);


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
    public function update(Request $request, FacultyTeachingCources $facultyTeaching)
    {
//        dd($facultyTeaching);
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

//            dd($request->all());
            FacultyTeachingCources::where('id', $facultyTeaching->id)->update([
                'name' => $request->name,
                'lookup_faculty_type_id' => $request->lookup_faculty_type_id,
                'designation_id' => $request->designation_id,
                'max_cources_allowed' => $request->max_cources_allowed,
//                'tc_program1' => $request->tc_program1,
//                'tc_program2' => $request->tc_program2,
//                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Visiting Faculty updated successfully.']);

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
    public function destroy(FacultyTeachingCources $facultyTeaching)
    {
//        dd($facultyTeaching);
         try {
              FacultyTeachingCources::where('id', $facultyTeaching->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            FacultyTeachingCources::destroy($facultyTeaching->id);
            FacultyTeachingCources::where([
                "campus_id" => $facultyTeaching->campus_id,
                "department_id" => $facultyTeaching->department_id,
                "lookup_faculty_type_id" => $facultyTeaching->lookup_faculty_type_id,
                "designation_id" => $facultyTeaching->designation_id,
                "max_cources_allowed" => $facultyTeaching->max_cources_allowed,
                "isCompleted" => "yes",
                "created_by" => $facultyTeaching->created_by
            ])->delete();

            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'lookup_faculty_type_id' => 'required',
            'designation_id' => 'required',
            'max_cources_allowed' => 'required',
            'tc_program' => 'required',
//            'tc_program2' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
