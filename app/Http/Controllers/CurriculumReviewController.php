<?php

namespace App\Http\Controllers;

use App\Models\Carriculum\CurriculumReview;
use App\Models\Common\Designation;
use App\Models\StrategicManagement\Affiliation;
use App\Models\StrategicManagement\StatutoryBody;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Auth;

class CurriculumReviewController extends Controller
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
        $affiliation = Affiliation::where(['status'=> 'active', 'campus_id'=> $campus_id, 'department_id'=> $department_id])->get();
        $designations = Designation::where(['status' => 'active', 'is_default' => true])->get();
        $users = User::where('user_type', 'PeerReviewer')->get();
        $bodies = StatutoryBody::all();
        $summaries = CurriculumReview::with('campus','affiliations','designation')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        return view('registration.curriculum.curriculum_review', compact('bodies','users','affiliation','designations','summaries'));
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
           $add_record=  CurriculumReview::create([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'review_meeting' => $request->review_meeting,
                'date' => $request->date,
                'composition' => $request->composition,
                'reviewer_names' => $request->reviewer_names,
                'designations_affiliations' => $request->designations_affiliations,
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

            CurriculumReview::where('id', $id)->update([
                'review_meeting' => $request->review_meeting,
                'date' => $request->date,
                'composition' => $request->composition,
                'reviewer_names' => $request->reviewer_names,
                'designations_affiliations' => $request->designations_affiliations,
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
            CurriculumReview::where('id', $id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            CurriculumReview::destroy($id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }


     protected function rules() {
        return [
            'review_meeting' => 'required',
            'date' => 'required',
            'composition' => 'required',
            'reviewer_names' => 'required',
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
