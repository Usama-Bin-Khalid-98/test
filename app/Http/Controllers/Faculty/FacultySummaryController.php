<?php

namespace App\Http\Controllers\Faculty;
use App\Models\Faculty\FacultySummary;
use App\Models\Common\Discipline;
use App\Models\Common\FacultyQualification;
use App\Models\Common\Slip;
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
        $department_id = Auth::user()->department_id;
        $qualification = FacultyQualification::where('status', 'active')->get();
        $discipline = Discipline::where('status', 'active')->get();

        $number = FacultySummary::where(['campus_id'=> $campus_id,'department_id'=> $department_id,'status' => 'active'])->get()->sum('number_faculty');
        $where = ['campus_id'=> $campus_id,'department_id'=> $department_id];
        $summaries = FacultySummary::with('campus','faculty_qualification','discipline')->where($where)->get();


        return view('registration.faculty.summary_faculty', compact('qualification','discipline','summaries','number'));
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

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {
            for($i = 0; $i < count($request->faculty_qualification_id); $i++) {
                foreach ($request->discipline_id as $discipline_id) {
                    $check_data = ['campus_id' => Auth::user()->campus_id,
                        'department_id' => Auth::user()->department_id,
                        'faculty_qualification_id' => @$request->faculty_qualification_id[$i],
                        'discipline_id' => @$request->discipline_id[$j],
                        'isComplete' => 'yes',
                    ];
                    $check = FacultySummary::where($check_data)->exists();
                    if(!$check) {
                        FacultySummary::create([
                            'campus_id' => Auth::user()->campus_id,
                            'department_id' => Auth::user()->department_id,
                            'faculty_qualification_id' => @$request->faculty_qualification_id[$i],
                            'discipline_id' => $discipline_id,
                            'number_faculty' => @$request->number_faculty[$discipline_id][$i],
                            'isComplete' => 'yes',
                            'created_by' => Auth::user()->id
                        ]);
                    }else{
                        return response()->json(['error' => 'Faculty Summary already exists.'], 422);
                    }
                }
            }
            

            return response()->json(['success' => 'Faculty Summary added successfully.'], 200);
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
            $faculty_summary = FacultySummary::where('id',$id)->first();
            FacultySummary::where([
                'campus_id' => $faculty_summary->campus_id,
                'department_id' => $faculty_summary->department_id,
                'faculty_qualification_id' => $faculty_summary->faculty_qualification_id,
                'discipline_id' => $faculty_summary->discipline_id,
                'number_faculty' => $faculty_summary->number_faculty,
                'status' => $faculty_summary->status,
            ])->update([
                'faculty_qualification_id' => $request->faculty_qualification_id,
                'discipline_id' => $request->discipline_id,
                'number_faculty' => $request->number_faculty,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
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
     * @param App\Models\Faculty\FacultySummary $FacultySummary
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacultySummary $FacultySummary)
    {
//        dd($FacultySummary);
        try {
            FacultySummary::where('id', $FacultySummary->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            FacultySummary::destroy($FacultySummary->id);
            FacultySummary::where([
                "campus_id" => $FacultySummary->campus_id,
                "department_id" => $FacultySummary->department_id,
                "faculty_qualification_id" => $FacultySummary->faculty_qualification_id,
                "discipline_id" => $FacultySummary->discipline_id,
                "number_faculty" => $FacultySummary->number_faculty,
                "isComplete" => "yes",
                "created_by" => $FacultySummary->created_by
            ])->delete();
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
