<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Faculty\FacultyParticipation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class FacultyParticipationController extends Controller
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
        $enrolments = FacultyParticipation::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

         return view('registration.faculty.faculty_participation', compact('enrolments'));
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
            FacultyParticipation::create([
                'campus_id' => $uni_id,
                'department_id' => $dept_id,
                'date' => $request->date,
                'faculty_name' => $request->faculty_name,
                'organization' => $request->organization,
                'title' => $request->title,
                'isComplete' => 'yes',
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Record added successfully.']);


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

            FacultyParticipation::where('id', $id)->update([
                'date' => $request->date,
                'faculty_name' => $request->faculty_name,
                'organization' => $request->organization,
                'title' => $request->title,
                'status' => $request->status,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
        FacultyParticipation::where('id', $id)->update([
               'deleted_by' => Auth::user()->id
           ]);
        FacultyParticipation::destroy($id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'date' => 'required',
            'faculty_name' => 'required',
            'organization' => 'required',
            'title' => 'required'
        ];
    }


    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
