<?php

namespace App\Http\Controllers;

use App\AppendixFile;
use App\Models\Common\PublicationCategory;
use App\Models\Common\StrategicManagement\BusinessSchoolTyear;
use App\Models\Research\ResearchSummary;
use App\Models\Common\Slip;
use App\PublicationType;
use App\BusinessSchool;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;
use Illuminate\Support\Facades\Log;

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
        $publication_categories = PublicationCategory::all();
        $slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id])->where('regStatus','SAR')->first();
        if($slip){
            $summaries = ResearchSummary::with('publication_type', 'campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->where('type','SAR')->get();
        }else {
            $summaries = ResearchSummary::with('publication_type', 'campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->where('type','REG')->get();
        }
        $getYears = BusinessSchoolTyear::where(['campus_id'=> $campus_id, 'department_id'=> $department_id])->get()->first();
        $years['yeart'] = @$getYears->tyear;
        $years['year_t_1'] = @$getYears->year_t_1;
        $years['year_t_2'] = @$getYears->year_t_2;
        $appendix_file = AppendixFile::where(['campus_id' => $campus_id, 'department_id' => $department_id])->first();
//        dd($years);
        return view('registration.research_summary.index', compact('publications', 'summaries', 'publication_categories', 'years', 'appendix_file'));
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

            $department_id = Auth::user()->department_id;
            $campus_id = Auth::user()->campus_id;
            $slip = Slip::where(['business_school_id'=> $campus_id,'department_id'=> $department_id])->where('regStatus','SAR')->first();
            if($slip){
                $type='SAR';
            }else {
                $type = 'REG';
            }

            //dd($request->all());
            for($i = 0; $i <= count($request->total_items); $i++)
            {
            $check_data = [
                'publication_type_id' => @$request->publication_type_id[$i],
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'year' => @$request->year,
                'isComplete' => 'yes',
                'type' => $type];
                $check = ResearchSummary::where($check_data)->exists();
               // dd($request->total_items[$i]);
//                for($j = 0; $j<=count($request->publication_type_id); $j++)
//                {
//                dd($request->total_items[$i]);
                if(!$check) {
                    if (!empty($request->total_items[$i])) {
                        ResearchSummary::create([
                            'publication_type_id' => $request->publication_type_id[$i],
                            'campus_id' => Auth::user()->campus_id,
                            'department_id' => Auth::user()->department_id,
                            'total_items' => @$request->total_items[$i],
                            'year' => $request->year,
                            'contributing_core_faculty' => $request->contributing_core_faculty[$i],
                            'jointly_produced_other' => $request->jointly_produced_other[$i],
                            'jointly_produced_same' => $request->jointly_produced_same[$i],
                            'jointly_produced_multiple' => $request->jointly_produced_multiple[$i],
                            'isComplete' => 'yes',
                            'type' => $type,
                            'created_by' => Auth::user()->id
                        ]);
                    }
                }else{
                    return response()->json(['error' => 'Research Summary Information already exists.'], 422);

                }

                //}
            }

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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Research\ResearchSummary  $researchSummary
     * @return \Illuminate\Http\Response
     */
    public function get_publication_category($researchSummary)
    {
        //dd($researchSummary);
        return PublicationType::where(['publication_category_id' => $researchSummary])->get();
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
                'year' => $request->year,
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
    
    public function uploadAppendixFile(Request $request){
        if(!$request->file('appendix_5A')){
            return response()->json(['error' => 'Please upload a valid file']);
        }
        $appendix_file = AppendixFile::where([
            'campus_id' => Auth::user()->campus_id,
            'business_school_id' => Auth::user()->business_school_id,
            'department_id' => Auth::user()->department_id,
            ])->first();
            
        $path = 'uploads/research_summary';
        $imageName = "-file-" . time() . '.' . $request->appendix_5A->getClientOriginalExtension();
        $request->file('appendix_5A')->move($path, $imageName);
        if($appendix_file){
            if($appendix_file->research_summary && $appendix_file->research_summary !== ''){
                try{
                    unlink($appendix_file->research_summary);
                }catch (Exception $e){
                    Log::error($e);
                }
            }
            AppendixFile::where(['id' => $appendix_file->id])->update(['research_summary' => $path . '/' . $imageName]);        
        }else{
            AppendixFile::create([
                'campus_id' => Auth::user()->campus_id,
                'business_school_id' => Auth::user()->business_school_id,
                'department_id' => Auth::user()->department_id,
                'research_summary' => $path . '/' . $imageName
            ]);
        }
        return response()->json(['success' => 'Appendix 5A uploaded successfully.']);
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
