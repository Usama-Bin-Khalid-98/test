<?php

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('questions')->insert([
                ['id'=>'1','question' => 'Do you confirm that at least three batches of the students have graduated for the program you are applying for?', 'status' => 'active'],
                ['id'=>'2','question' => 'Does the business school follow a specific vision and mission?', 'status' => 'active'],
                ['id'=>'3','question' => 'Do you have a documentary evidence for the approval of the vision and mission statement by a relevant statutory body?', 'status' => 'active'],
                ['id'=>'4','question' => 'Are the vision and mission statement displayed on the department webpage?', 'status' => 'active'],
                ['id'=>'5','question' => 'Does the business school follow a strategic plan of 03-05 years?', 'status' => 'active'],
                ['id'=>'6','question' => 'Do you have a documentary evidence for the approval of the strategic plan by a relevant statutory body?', 'status' => 'active'],
                ['id'=>'7','question' => 'Do you confirm that there are at least 15 full time faculty members with education and teaching experience in the relevant field?', 'status' => 'active'],
                ['id'=>'8','question' => 'Do you confirm that the faculty of the business school includes at least 2 Professors/Associate Professors, and at least 03 Assistant Professors?', 'status' => 'active'],
                ['id'=>'9','question' => 'Do you meet the minimum enrollment requirement for accreditation which is at least 20 students for undergraduate program and at least 15 students for graduate program?', 'status' => 'active'],

            ]
        );
    }
}
