<?php

use Illuminate\Database\Seeder;

class NbeacCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nbeac_criterias')->insert([
            ['program_started' => 'At least 3 batches of the degree should have passed to consider the program for accreditation',
             'mission_vision_statement' => 'Vision and mission should exist, realistic and shared among the all stake holders. Mission statement of business school is clear, current and aligned with its vision statement.',
             'strategic_plan' => 'Strategic Plan should exist for 03-05 years',
             'student_intake' => '',
             'student_enrollment' => 'Class Size',
             'course_load' => 'Following is the recommended Course load',
             'research_output' => '',
             'bandwidth' => 'Bandwidth Internet service (desirable) = 1 MB access rate',
             'std_comp_ratio' => 'Student to Computer ratio: 1:20',
        ],
        ]);
    }
}
