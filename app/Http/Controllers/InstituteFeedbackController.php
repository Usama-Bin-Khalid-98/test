<?php

namespace App\Http\Controllers;

use App\Models\PeerReview\InstituteFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class InstituteFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        if($user->user_type === 'NBEACAdmin' || $user->user_type === 'NbeacFocalPerson' ) {

            $feedbacks = DB::table('slips as s')
            ->join('institute_feedback as if', 'if.slip_id', 's.id')
            ->join('campuses as c', 'c.id', 's.business_school_id')
            ->join('business_schools as bs', 'bs.id', 'c.business_school_id')
            ->join('departments as d', 'd.id', 's.department_id')
            ->select('s.*', 'c.location as campus',
                'bs.name',
                'bs.id as business_school_id',
                'd.name as department',
                'c.id as campus_id',
                'if.file as feedback_file'
                )
                ->get();
//            dd($feedbacks);
        }elseif($user->user_type === 'BusinessSchool'){
            $feedbacks = DB::table('slips as s')
                ->join('institute_feedback as if', 'if.slip_id', 's.id')
                ->join('campuses as c', 'c.id', 's.business_school_id')
                ->join('business_schools as bs', 'bs.id', 'c.business_school_id')
                ->join('departments as d', 'd.id', 's.department_id')
                ->select('s.*', 'c.location as campus', 'bs.name as name','bs.id as business_school_id', 'd.name as department', 'c.id as campus_id')
                ->where('s.created_by', Auth::id())
                ->get();
        }

        return view('peer_review_visit.institute_feedback', compact('feedbacks'));

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
//        dd($request->all());
        //
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {

            $imageName = ''; $path = '';
            if ($request->file('file')) {
                $imageName = 'feedback'  . time() . '.' . $request->file->getClientOriginalExtension();
                $path = 'uploads/institute_feedback/';
                $diskName = env('DISK');
                $disk = Storage::disk($diskName);
                $request->file('file')->move($path, $imageName);
            }

            $imageName ? $updateData['file'] = $path.$imageName:'';
            $request->slip_id ? $updateData['slip_id'] = $request->slip_id:'';
            $request->slip_id ? $updateData['created_by'] = Auth::id():'';

            $check = InstituteFeedback::where(['slip_id' => $request->slip_id])->exists();
//            dd($check);
            if($check)
            {
                $update = InstituteFeedback::where('slip_id', $request->slip_id)->update($updateData);
            }else {
//                dd($updateData);
                $update = InstituteFeedback::create($updateData);
            }

            if($update)
            {
                ////////////////////////////////// email here //////////////

                ////////////////////////////////// end email //////////////
                return response()->json(['success' => 'Institutional Feedback added successfully.'], 200);
            }
            else{
                return response()->json(['message' => 'updating Institutional feedback failed.'], 422);

            }
        }
        catch (Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 422);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PeerReview\InstituteFeedback  $instituteFeedback
     * @return \Illuminate\Http\Response
     */
    public function show(InstituteFeedback $instituteFeedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PeerReview\InstituteFeedback  $instituteFeedback
     * @return \Illuminate\Http\Response
     */
    public function edit($instituteFeedback)
    {
        //
        $user = Auth::user();
        $feedbacks = InstituteFeedback::where(['created_by' => $user->id, 'slip_id' => $instituteFeedback])->get();
//        dd($feedbacks);
        if(!empty($feedbacks)) {
            return response()->json($feedbacks, 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PeerReview\InstituteFeedback  $instituteFeedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InstituteFeedback $instituteFeedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PeerReview\InstituteFeedback  $instituteFeedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstituteFeedback $instituteFeedback)
    {
        //
    }

    public function rules(){
        return [
            'slip_id' => 'required',
            'file' => 'mimes:pdf,docx,xlsx,xls,doc'
        ];
    }
    protected function messages() {
        return [
            'required'=> 'The :attribute can not be blanked. '
        ];
    }
}
