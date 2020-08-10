<?php

use Illuminate\Database\Seeder;

class SurveyQuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('survey_questionnaires')->insert(['question_id'=>'1','business_school_id'=>'1','isChecked'=>'yes','status'=>'active']);
    }
}
