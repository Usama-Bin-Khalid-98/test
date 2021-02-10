<?php

namespace App\Http\Controllers;

use App\ClassSize;
use App\Models\Common\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $sizes  = ClassSize::with('campus','semesters')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

         return view('registration.student_enrolment.class_size', compact('semesters','sizes'));
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

            ClassSize::create([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'semesters_id' => $request->semesters_id,
                'program_a' => $request->program_a,
                'program_b' => $request->program_b,
                'isComplete' => 'yes',
                'created_by' => Auth::user()->id
            ]);

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
                'semesters_id' => $request->semesters_id,
                'program_a' => $request->program_a,
                'program_b' => $request->program_b,
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
            'semesters_id' => 'required',
            'program_a' => 'required',
            'program_b' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
