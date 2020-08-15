<?php

namespace App\Http\Controllers;

use App\Models\social_responsibility\StudentClub;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class StudentClubController extends Controller
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
        $clubs = StudentClub::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

        return view('social_responsibility.student_club',compact('clubs'));
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

            StudentClub::create([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'name' => $request->name,
                'total_members' => $request->total_members,
                'no_of_members' => $request->no_of_members,
                'purpose' => $request->purpose,
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Student club added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\social_responsibility\StudentClub  $studentClub
     * @return \Illuminate\Http\Response
     */
    public function show(StudentClub $studentClub)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\social_responsibility\StudentClub  $studentClub
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentClub $studentClub)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\social_responsibility\StudentClub  $studentClub
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentClub $studentClub)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            StudentClub::where('id', $studentClub->id)->update([
                'name' => $request->name,
                'total_members' => $request->total_members,
                'no_of_members' => $request->no_of_members,
                'purpose' => $request->purpose,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Student clubs updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\social_responsibility\StudentClub  $studentClub
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentClub $studentClub)
    {
        try {
            StudentClub::where('id', $studentClub->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
           StudentClub::destroy($studentClub->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'name' => 'required',
            'total_members' => 'required',
            'no_of_members' => 'required',
            'purpose' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
