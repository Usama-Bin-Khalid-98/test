<?php

namespace App\Http\Controllers;

use App\Models\Carriculum\ChecklistDocument;
use App\Models\Common\Slip;
use App\Models\Config\NbeacBasicInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class ChecklistDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            $campus_id = Auth::user()->campus_id;
            $department_id = Auth::user()->department_id;
            $course_detail = ChecklistDocument::where(
                ['campus_id'=> $campus_id,'department_id'=> $department_id]
            )->get()->first();

            return view('registration.curriculum.checklist',compact('course_detail'));
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
            ChecklistDocument::updateOrCreate([
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
     * @param  \App\Models\Carriculum\ChecklistDocument  $checklistDocument
     * @return \Illuminate\Http\Response
     */
    public function show(ChecklistDocument $checklistDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carriculum\ChecklistDocument  $checklistDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(ChecklistDocument $checklistDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carriculum\ChecklistDocument  $checklistDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $checklistDocument)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            ChecklistDocument::where('id', $checklistDocument)->update([
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
     * @param  \App\Models\Carriculum\ChecklistDocument  $checklistDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChecklistDocument $checklistDocument)
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
