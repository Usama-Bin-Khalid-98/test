<?php

namespace App\Http\Controllers;

use App\Models\Reasearch\FacultyDevelopment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class FacultyDevelopmentController extends Controller
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
        $t_fund = FacultyDevelopment::where(['campus_id'=> $campus_id,'department_id'=> $department_id,'status' => 'active'])->get()->sum('fund_spent');
        $conferences  = FacultyDevelopment::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

         return view('registration.research_summary.faculty_development', compact('t_fund','conferences'));
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

            FacultyDevelopment::create([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'name' => $request->name,
                'description' => $request->description,
                'fund_spent' => $request->fund_spent,
                'isComplete' => 'yes',
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Faculty Development added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reasearch\FacultyDevelopment  $facultyDevelopment
     * @return \Illuminate\Http\Response
     */
    public function show(FacultyDevelopment $facultyDevelopment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reasearch\FacultyDevelopment  $facultyDevelopment
     * @return \Illuminate\Http\Response
     */
    public function edit(FacultyDevelopment $facultyDevelopment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reasearch\FacultyDevelopment  $facultyDevelopment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacultyDevelopment $facultyDevelopment)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            FacultyDevelopment::where('id', $facultyDevelopment->id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'fund_spent' => $request->fund_spent,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Faculty Development updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reasearch\FacultyDevelopment  $facultyDevelopment
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacultyDevelopment $facultyDevelopment)
    {
        try {
    FacultyDevelopment::where('id', $facultyDevelopment->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
    FacultyDevelopment::destroy($facultyDevelopment->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

     protected function rules() {
        return [
            'name' => 'required',
            'description' => 'required',
            'fund_spent' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
