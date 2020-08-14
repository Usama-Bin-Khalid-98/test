<?php

namespace App\Http\Controllers;

use App\CounsellingActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class CounsellingActivityController extends Controller
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
        $counsellings  = CounsellingActivity::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

         return view('registration.student_enrolment.counselling_activity', compact('counsellings'));
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

            CounsellingActivity::create([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'counsellor_name' => $request->counsellor_name,
                'counselling_hours' => $request->counselling_hours,
                'counselling_activity' => $request->counselling_activity,
                'students_covered' => $request->students_covered,
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Counselling Activity added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CounsellingActivity  $counsellingActivity
     * @return \Illuminate\Http\Response
     */
    public function show(CounsellingActivity $counsellingActivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CounsellingActivity  $counsellingActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(CounsellingActivity $counsellingActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CounsellingActivity  $counsellingActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CounsellingActivity $counsellingActivity)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            CounsellingActivity::where('id', $counsellingActivity->id)->update([
                'counsellor_name' => $request->counsellor_name,
                'counselling_hours' => $request->counselling_hours,
                'counselling_activity' => $request->counselling_activity,
                'students_covered' => $request->students_covered,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Counselling Activity updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CounsellingActivity  $counsellingActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(CounsellingActivity $counsellingActivity)
    {
         try {
        CounsellingActivity::where('id', $counsellingActivity->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
        CounsellingActivity::destroy($counsellingActivity->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'counsellor_name' => 'required',
            'counselling_hours' => 'required',
            'counselling_activity' => 'required',
            'students_covered' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
