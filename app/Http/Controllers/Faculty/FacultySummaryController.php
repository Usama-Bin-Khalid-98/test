<?php

namespace App\Http\Controllers\Faculty;
use App\Models\Faculty\FacultySummary;
use App\Models\Common\Discipline;
use App\Models\Common\FacultyQualification;
use App\Models\Common\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class FacultySummaryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    public function index()
    {
        $campus_id = Auth::user()->campus_id;
        $user_id = Auth::user()->id;
        $qualification = FacultyQualification::where('status', 'active')->get();
        $discipline = Discipline::where('status', 'active')->get();

        $summaries = FacultySummary::with('campus','faculty_qualification','discipline')->where(['campus_id'=> $campus_id,'created_by'=> $user_id])->get();

        return view('registration.faculty.summary_faculty', compact('qualification','discipline','summaries'));
        //
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

            FacultySummary::create([
                'campus_id' => Auth::user()->campus_id,
                'faculty_qualification_id' => $request->faculty_qualification_id,
                'discipline_id' => $request->discipline_id,
                'number_faculty' => $request->number_faculty,
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Faculty Summary added successfully.']);


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
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            FacultySummary::where('id', $id)->update([
                'faculty_qualification_id' => $request->faculty_qualification_id,
                'discipline_id' => $request->discipline_id,
                'number_faculty' => $request->number_faculty,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Faculty Summary updated successfully.']);

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
    public function destroy($id)
    {
        try {
            FacultySummary::where('id', $id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
            FacultySummary::destroy($id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'faculty_qualification_id' => 'required',
            'discipline_id' => 'required',
            'number_faculty' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
