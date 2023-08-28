<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Faculty\FacultyGender;
use App\BusinessSchool;
use App\Models\Common\Slip;
use App\LookupFacultyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;


class FacultyGenderController extends Controller
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
        $dept_id = Auth::user()->department_id;

        $faculty_type = LookupFacultyType::get();

        /*$slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $dept_id])->where('regStatus','SAR')->first();
        if($slip){
            $genders = FacultyGender::with('campus','lookup_faculty_type')->where(['campus_id'=> $campus_id,'department_id'=> $dept_id])->where('type','SAR')->get();
        }else {
            $genders = FacultyGender::with('campus','lookup_faculty_type')->where(['campus_id'=> $campus_id,'department_id'=> $dept_id])->where('type','REG')->get();
        }*/

        $slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $dept_id, 'regStatus' => 'SAR'])->first();
        $where = ['campus_id'=> $campus_id,'department_id'=> $dept_id];
        ($slip)?$where['type'] = 'SAR':$where['type'] = 'REG';
        $genders = FacultyGender::with('campus','lookup_faculty_type')->where($where)->get();


         return view('registration.faculty.faculty_gender', compact('faculty_type','genders'));
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
            $type = 'REG';  //hotfix to be removed in future
            $check_data = [
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'lookup_faculty_type_id' => $request->lookup_faculty_type_id,
                'isCompleted' => 'yes',
                'type' => $type];
            $check = FacultyGender::where($check_data)->exists();

            if(!$check) {
                FacultyGender::create([
                    'campus_id' => Auth::user()->campus_id,
                    'department_id' => Auth::user()->department_id,
                    'lookup_faculty_type_id' => $request->lookup_faculty_type_id,
                    'male' => $request->male,
                    'female' => $request->female,
                    'isCompleted' => 'yes',
                    'type' => $type,
                    'created_by' => Auth::user()->id
                ]);
                FacultyGender::create([
                    'campus_id' => Auth::user()->campus_id,
                    'department_id' => Auth::user()->department_id,
                    'lookup_faculty_type_id' => $request->lookup_faculty_type_id,
                    'male' => $request->male,
                    'female' => $request->female,
                    'isCompleted' => 'yes',
                    'type' => 'SAR',
                    'created_by' => Auth::user()->id
                ]);
            }
            else{
                return response()->json(['error' => 'Faculty Gender already exists.'], 422);
            }
                return response()->json(['success' => 'Faculty Gender added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faculty\FacultyGender  $facultyGender
     * @return \Illuminate\Http\Response
     */
    public function show(FacultyGender $facultyGender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faculty\FacultyGender  $facultyGender
     * @return \Illuminate\Http\Response
     */
    public function edit(FacultyGender $facultyGender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faculty\FacultyGender  $facultyGender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacultyGender $facultyGender)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            FacultyGender::where('id', $facultyGender->id)->update([
                'lookup_faculty_type_id' => $request->lookup_faculty_type_id,
                'male' => $request->male,
                'female' => $request->female,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Faculty Gender updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faculty\FacultyGender  $facultyGender
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacultyGender $facultyGender)
    {
//        dd($facultyGender);
        try {
            FacultyGender::where('id', $facultyGender->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            FacultyGender::destroy($facultyGender->id);
            FacultyGender::where(
                [
                    "campus_id" =>$facultyGender->campus_id,
                    "department_id" =>$facultyGender->department_id,
                    "lookup_faculty_type_id" =>$facultyGender->lookup_faculty_type_id,
                    "male" =>$facultyGender->male,
                    "female" =>$facultyGender->female,
                    "isCompleted" => "yes",
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
