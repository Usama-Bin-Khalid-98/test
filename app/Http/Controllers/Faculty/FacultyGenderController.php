<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Faculty\FacultyGender;
use App\BusinessSchool;
use App\LookupFacultyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
class FacultyGenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businesses = BusinessSchool::where('status', 'active')->get();
        $faculty_type = LookupFacultyType::get();

        $genders = FacultyGender::with('business_school','lookup_faculty_type')->get();

         return view('registration.faculty.faculty_gender', compact('businesses','faculty_type','genders'));
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

            FacultyGender::create([
                'business_school_id' => $request->business_school_id,
                'lookup_faculty_type_id' => $request->lookup_faculty_type_id,
                'year' => $request->year,
                'male' => $request->male,
                'female' => $request->female
            ]);

            return response()->json(['success' => 'Faculty Gender added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faculty\FacultyGender  $facultyGender
     * @return \Illuminate\Http\Response
     */
    public function show(FacultyGender $facultyGender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faculty\FacultyGender  $facultyGender
     * @return \Illuminate\Http\Response
     */
    public function edit(FacultyGender $facultyGender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faculty\FacultyGender  $facultyGender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacultyGender $facultyGender)
    {
        $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            FacultyGender::where('id', $facultyGender->id)->update([
                'business_school_id' => $request->business_school_id,
                'lookup_faculty_type_id' => $request->lookup_faculty_type_id,
                'year' => $request->year,
                'male' => $request->male,
                'female' => $request->female,
                'status' => $request->status,
                'isComplete' => $request->isComplete
            ]);
            return response()->json(['success' => 'Faculty Gender updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faculty\FacultyGender  $facultyGender
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacultyGender $facultyGender)
    {
        try {
            FacultyGender::destroy($facultyGender->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'business_school_id' => 'required',
            'lookup_faculty_type_id' => 'required',
            'year' => 'required',
            'male' => 'required',
            'female' => 'required'
        ];
    }

     protected function update_rules() {
        return [
            'business_school_id' => 'required',
            'lookup_faculty_type_id' => 'required',
            'year' => 'required',
            'male' => 'required',
            'female' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
