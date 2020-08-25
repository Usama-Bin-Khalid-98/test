<?php

use Illuminate\Database\Seeder;

class ProgramCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('program_courses')->insert([
            ['campus_id' => '209',
            'program_id' => '3',
            'course_type_id' => '1',
            'credit_hours' => '22',
            'pre_req_id' => '1',
            'status' => 'active',
            ],

            ['campus_id' => '209',
            'program_id' => '5',
            'course_type_id' => '6',
            'credit_hours' => '28',
            'pre_req_id' => '4',
            'status' => 'active',
            ],
        ]);
    }
}
