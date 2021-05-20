<?php

namespace App\Http\Controllers;

use App\Models\Common\Slip;
use App\Models\PeerReview\PeerReviewReviewer;
use App\Models\StrategicManagement\Scope;
use App\ProfileSheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class ProfileSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        if($validation->fails()){
            return response()->json($validation->messages()->all(), 422);

        }
        try {

            $delete_all = ProfileSheet::where(['campus_id'=> $request->campus_id, 'department_id' => $request->department_id])->delete();

            foreach($request->all() as $key=>$item)
            {
                if($key !='campus_id' && $key !='department_id')
                {
                $data= [
                    'column_name' => $key,
                    'value' => $item,
                    'campus_id'=> $request->campus_id,
                    'department_id'=> $request->department_id
                ];

                    $insert_new = ProfileSheet::create($data);
                }
            }
            return response()->json(['success' => 'Action Completed Successfully.']);
//            dd($request->campus_id);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);

        }
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProfileSheet  $profileSheet
     * @return \Illuminate\Http\Response
     */
    public function show(ProfileSheet $profileSheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProfileSheet  $profileSheet
     * @return \Illuminate\Http\Response
     */
    public function edit($cid=null, $did=null)
    {
        $where = ['department_id'=> $did, 'business_school_id'=> $cid];
        $where_scop = ['department_id'=> $did, 'campus_id'=> $cid];
        $registrations = Slip::where($where)->with('campus', 'department')->first();

        $peerReviewers = PeerReviewReviewer::where(['slip_id'=>$registrations->id])->with('user')->get();
//        dd($peerReviewers);
        $scopes = Scope::where($where_scop)->get();

        $getProfileSheet = ProfileSheet::where(['campus_id' => $cid, 'department_id'=>$did])->get();
//        dd($getProfileSheet[0]);



        //
//        dd($registrations);

        return view('profile_sheet.profile_sheet', compact('registrations','scopes', 'getProfileSheet', 'peerReviewers'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProfileSheet  $profileSheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfileSheet $profileSheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProfileSheet  $profileSheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfileSheet $profileSheet)
    {
        try {
            ProfileSheet::destroy($profileSheet->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'department_id' => 'required',
            'campus_id' => 'required',

        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.',
        ];
    }
}
