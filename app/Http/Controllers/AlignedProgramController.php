<?php

namespace App\Http\Controllers;

use App\Models\Carriculum\AlignedProgram;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Auth;

class AlignedProgramController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    public function index()
    {
         try {
            $campus_id = Auth::user()->campus_id;
            $department_id = Auth::user()->department_id;
            $aligned_program = AlignedProgram::where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get()->first();

        return view('registration.curriculum.aligned_program',compact('aligned_program'));
        }catch (\Exception $e) {
            return $e->getMessage();
        }
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
            AlignedProgram::updateOrCreate([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'summary' => $request->summary,
                'isComplete' => 'yes',
                'updated_by' => Auth::user()->id
            ]);

            return response()->json(['success' => ' Record Inserted successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carriculum\AlignedProgram  $alignedProgram
     * @return \Illuminate\Http\Response
     */
    public function show(AlignedProgram $alignedProgram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carriculum\AlignedProgram  $alignedProgram
     * @return \Illuminate\Http\Response
     */
    public function edit(AlignedProgram $alignedProgram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carriculum\AlignedProgram  $alignedProgram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
           AlignedProgram::where('id', $id)->update([
                'summary' => $request->summary,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Record updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carriculum\AlignedProgram  $alignedProgram
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlignedProgram $alignedProgram)
    {
        //
    }

     protected function rules() {
        return [
            'summary' => 'required'
        ];
    }
    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
