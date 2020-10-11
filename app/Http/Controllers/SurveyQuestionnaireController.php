<?php

namespace App\Http\Controllers;

use App\Models\StrategicManagement\SurveyQuestionnaire;
use Illuminate\Http\Request;

class SurveyQuestionnaireController extends Controller
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
        //
        if(!empty($request->all()['business_school_id']))
        {
            try {

                $business_school_id = $request->all()['business_school_id'];
                $department_id = $request->all()['department_id'];
                $campus_id = $request->all()['campus_id'];
                $check = SurveyQuestionnaire::where(
                    [
                        'business_school_id' =>$business_school_id,
                        'campus_id' =>$campus_id,
                        'department_id' => $department_id
                    ])->exists();
                if($check === false) {
                    foreach ($request->all() as $questions) {
                        //dd($questions['id']);
                        $insert = SurveyQuestionnaire::create([
                            'question_id' => $questions['id'],
                            'business_school_id' => $business_school_id,
                            'campus_id' => $campus_id,
                            'department_id' => $department_id,
                            'isChecked' => $questions['value']
                        ]);

                        if ($insert) {
                            return response()->json(['success' => 'survey added successfully'], 200);
                        }
                    }
                }else{
                    return response()->json(['success' => 'survey already added'], 200);
                }
            }
            catch (\Exception $e)
            {
                return response()->json($e->getMessage(), 400);
            }
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\SurveyQuestionnaire  $surveyQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function show(SurveyQuestionnaire $surveyQuestionnaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\SurveyQuestionnaire  $surveyQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(SurveyQuestionnaire $surveyQuestionnaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\SurveyQuestionnaire  $surveyQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SurveyQuestionnaire $surveyQuestionnaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\SurveyQuestionnaire  $surveyQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(SurveyQuestionnaire $surveyQuestionnaire)
    {
        //
    }
}
