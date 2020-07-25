<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Faculty\FacultyStability;
use App\BusinessSchool;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Models\StrategicManagement\Designation;
use Auth;

class FacultyStabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $stabilities = FacultyStability::with('business_school')->get();

         return view('registration.faculty.faculty_stability', compact('stabilities'));
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

            FacultyStability::create([
                'business_school_id' => Auth::user()->business_school_id,
                'total_faculty' => $request->total_faculty,
                'year' => $request->year,
                'resigned' => $request->resigned,
                'retired' => $request->retired,
                'terminated' => $request->terminated,
                'new_induction' => $request->new_induction
            ]);

            return response()->json(['success' => 'Faculty Stability added successfully.']);


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
    public function update(Request $request, FacultyStability $facultyStability)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            FacultyStability::where('id', $facultyStability->id)->update([
                'total_faculty' => $request->total_faculty,
                'year' => $request->year,
                'resigned' => $request->resigned,
                'retired' => $request->retired,
                'terminated' => $request->terminated,
                'new_induction' => $request->new_induction,
                'status' => $request->status,
                'isCompleted' => $request->isCompleted
            ]);
            return response()->json(['success' => 'Faculty Stability updated successfully.']);

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
    public function destroy(FacultyStability $facultyStability)
    {
        try {
            FacultyStability::destroy($facultyStability->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'total_faculty' => 'required',
            'year' => 'required',
            'resigned' => 'required',
            'retired' => 'required',
            'terminated' => 'required',
            'new_induction' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
