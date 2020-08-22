<?php

namespace App\Http\Controllers;

use App\Models\Research\CurriculumRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class CurriculumRoleController extends Controller
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
        $conferences  = CurriculumRole::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

         return view('registration.research_summary.curriculum_role', compact('conferences'));
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

            CurriculumRole::create([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'research_publication' => $request->research_publication,
                'course_title' => $request->course_title,
                'isComplete' => 'yes',
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Curriculum Role added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Research\CurriculumRole  $curriculumRole
     * @return \Illuminate\Http\Response
     */
    public function show(CurriculumRole $curriculumRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Research\CurriculumRole  $curriculumRole
     * @return \Illuminate\Http\Response
     */
    public function edit(CurriculumRole $curriculumRole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Research\CurriculumRole  $curriculumRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CurriculumRole $curriculumRole)
    {
         $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            CurriculumRole::where('id', $curriculumRole->id)->update([
                'research_publication' => $request->research_publication,
                'course_title' => $request->course_title,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Curriculum Role updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Research\CurriculumRole  $curriculumRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(CurriculumRole $curriculumRole)
    {
        try {
        CurriculumRole::where('id', $curriculumRole->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
        CurriculumRole::destroy($curriculumRole->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

     protected function rules() {
        return [
            'research_publication' => 'required',
            'course_title' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
