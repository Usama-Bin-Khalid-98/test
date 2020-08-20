<?php

namespace App\Http\Controllers;

use App\Models\Research\ResearchCenter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Auth;

class ResearchCenterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    public function index()
    {
        try {
            $campus_id = Auth::user()->campus_id;
            $department_id = Auth::user()->department_id;
            $research_center = ResearchCenter::where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get()->first();

        return view('registration.research_summary.research_center',compact('research_center'));
        }catch (\Exception $e) {
            return $e->getMessage();
        }
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
            ResearchCenter::updateOrCreate([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'research_center' => $request->research_center,
                'hierarchical_position' => $request->hierarchical_position,
                'year_establishment' => $request->year_establishment,
                'head' => $request->head,
                'qualification' => $request->qualification,
                'reports_to' => $request->reports_to,
                'composition' => $request->composition,
                'isComplete' => 'yes',
                'updated_by' => Auth::user()->id
            ]);

            return response()->json(['success' => ' Research Center Inserted successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Research\ResearchCenter  $researchCenter
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchCenter $researchCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Research\ResearchCenter  $researchCenter
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchCenter $researchCenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Research\ResearchCenter  $researchCenter
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
            ResearchCenter::where('id', $id)->update([
                'research_center' => $request->research_center,
                'hierarchical_position' => $request->hierarchical_position,
                'year_establishment' => $request->year_establishment,
                'head' => $request->head,
                'qualification' => $request->qualification,
                'reports_to' => $request->reports_to,
                'composition' => $request->composition,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => ' Research Center updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Research\ResearchCenter  $researchCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchCenter $researchCenter)
    {
        //
    }


    protected function rules() {
        return [
            'year_establishment' => 'required',
            'head' => 'required',
            'qualification' => 'required',
            'reports_to' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
