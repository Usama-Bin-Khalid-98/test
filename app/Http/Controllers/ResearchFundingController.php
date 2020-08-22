<?php

namespace App\Http\Controllers;

use App\Models\Research\ResearchFunding;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class ResearchFundingController extends Controller
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
        $enrolments = ResearchFunding::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

         return view('registration.research_summary.research_funding', compact('enrolments'));
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
            ResearchFunding::create([
                'campus_id' => $uni_id,
                'department_id' => $dept_id,
                'year' => $request->year,
                'uni_budget' => $request->uni_budget,
                'bs_budget' => $request->bs_budget,
                'gov_grant' => $request->gov_grant,
                'corp_grant' => $request->corp_grant,
                'int_grant' => $request->int_grant,
                'total' => $request->bs_budget+ $request->gov_grant+$request->corp_grant+$request->int_grant,
                'isComplete' => 'yes',
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Research funding added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Research\ResearchFunding  $researchFunding
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchFunding $researchFunding)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Research\ResearchFunding  $researchFunding
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchFunding $researchFunding)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Research\ResearchFunding  $researchFunding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResearchFunding $researchFunding)
    {
        $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            ResearchFunding::where('id', $researchFunding->id)->update([
                'year' => $request->year,
                'uni_budget' => $request->uni_budget,
                'bs_budget' => $request->bs_budget,
                'gov_grant' => $request->gov_grant,
                'corp_grant' => $request->corp_grant,
                'int_grant' => $request->int_grant,
                'total' => $request->bs_budget+ $request->gov_grant+$request->corp_grant+$request->int_grant,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'ResearchFunding updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Research\ResearchFunding  $researchFunding
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchFunding $researchFunding)
    {
         try {
            ResearchFunding::where('id', $researchFunding->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
            ResearchFunding::destroy($researchFunding->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }


     protected function rules() {
        return [
            'year' => 'required',
            'uni_budget' => 'required',
            'bs_budget' => 'required',
            'gov_grant' => 'required',
            'corp_grant' => 'required',
            'int_grant' => 'required'
        ];
    }

    protected function update_rules() {
        return [
            'year' => 'required',
            'uni_budget' => 'required',
            'bs_budget' => 'required',
            'gov_grant' => 'required',
            'corp_grant' => 'required',
            'int_grant' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
