<?php

use Illuminate\Database\Seeder;

class ProgramPortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('program_portfolios')->insert([
            ['campus_id' => '209',
            'program_id' => '3',
            'total_semesters' => '16',
            'course_type_id' => '1',
            'no_of_course' => '15',
            'credit_hours' => '32',
            'internship_req' => 'yes',
            'fyp_req' => 'no',
            'status' => 'active',
            ],
            ['campus_id' => '209',
            'program_id' => '18',
            'total_semesters' => '20',
            'course_type_id' => '2',
            'no_of_course' => '18',
            'credit_hours' => '30',
            'internship_req' => 'no',
            'fyp_req' => 'yes',
            'status' => 'active',
            ],


        ]);
    }
}
