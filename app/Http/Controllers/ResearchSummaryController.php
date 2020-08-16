<?php

namespace App\Http\Controllers;

use App\Models\Research\ResearchSummary;
use App\PublicationType;
use App\BusinessSchool;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class ResearchSummaryController extends Controller
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
        $publications = PublicationType::where('status', 'active')->get();
        $summaries = ResearchSummary::with('publication_type', 'campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        ///dd($contacts);
        return view('registration.research_summary.index', compact('publications', 'summaries'));
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

            ResearchSummary::create([
                'publication_type_id' => $request->publication_type_id,
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'total_items' => $request->total_items,
                'contributing_core_faculty' => $request->contributing_core_faculty,
                'jointly_produced_other' => $request->jointly_produced_other,
                'jointly_produced_same' => $request->jointly_produced_same,
                'jointly_produced_multiple' => $request->jointly_produced_multiple,
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Research Summary Information added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Research\ResearchSummary  $researchSummary
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchSummary $researchSummary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Research\ResearchSummary  $researchSummary
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchSummary $researchSummary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Research\ResearchSummary  $researchSummary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResearchSummary $researchSummary)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            ResearchSummary::where('id', $researchSummary->id)->update([
                'publication_type_id' => $request->publication_type_id,
                'total_items' => $request->total_items,
                'contributing_core_faculty' => $request->contributing_core_faculty,
                'jointly_produced_other' => $request->jointly_produced_other,
                'jointly_produced_same' => $request->jointly_produced_same,
                'jointly_produced_multiple' => $request->jointly_produced_multiple,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Research Summary Information updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Research\ResearchSummary  $researchSummary
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchSummary $researchSummary)
    {
        try {
            ResearchSummary::where('id', $researchSummary->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
            ResearchSummary::destroy($researchSummary->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }


    protected function rules() {
        return [
            'publication_type_id' => 'required',
            'total_items' => 'required',
            'contributing_core_faculty' => 'required',
            'jointly_produced_other' => 'required',
            'jointly_produced_same' => 'required',
            'jointly_produced_multiple' => 'required'
        ];
    }




    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
