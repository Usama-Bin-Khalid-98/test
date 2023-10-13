<?php

namespace App\Http\Controllers;

use App\ClassSize;
use App\Models\Common\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\StrategicManagement\BusinessSchoolTyear;
use App\Models\StrategicManagement\Scope;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class ClassSizeController extends Controller
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
        $semesters = Semester::get();
        $sizes  = ClassSize::with('campus','program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        $years = BusinessSchoolTyear::where(['campus_id'=> $campus_id, 'department_id'=> $department_id])->first();
        $scopes = Scope::with('program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        return view('registration.student_enrolment.class_size', compact('semesters','sizes', 'years', 'scopes'));
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
            $sizeExists = ClassSize::where([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'semester' => $request->semester,
                'year' => $request->year,
            ])->exists();
            if($sizeExists){
                return response()->json(['error' => 'Class Size for given semester already exists.'], 422);
            }
            for($i = 0; $i < count($request->program); $i++){
                ClassSize::create([
                    'campus_id' => Auth::user()->campus_id,
                    'department_id' => Auth::user()->department_id,
                    'semester' => $request->semester,
                    'year' => $request->year,
                    'program_id' => $request->program[$i],
                    'size' => $request->size[$i],
                    'isComplete' => 'yes',
                ]);
            }

            return response()->json(['success' => 'Class Size added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClassSize  $classSize
     * @return \Illuminate\Http\Response
     */
    public function show(ClassSize $classSize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClassSize  $classSize
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassSize $classSize)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClassSize  $classSize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassSize $classSize)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            ClassSize::where('id', $classSize->id)->update([
                'semester' => $request->semester,
                'size' => $request->size,
                'year' => $request->year,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Class Size updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClassSize  $classSize
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassSize $classSize)
    {
        try {
        ClassSize::where('id', $classSize->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
        ClassSize::destroy($classSize->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'year' => 'required',
            'semester' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
