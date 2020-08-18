<?php

use Illuminate\Database\Seeder;

class FacultyTeachingCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('faculty_teaching_cources')->insert([
            ['name' => 'Ali',
            'campus_id' => '209',
            'lookup_faculty_type_id' => '1',
            'designation_id' => '10',
            'max_cources_allowed' => '19',
            'tc_program1' => '12',
            'tc_program2' => '7'
            'status' => 'active',
            ],
            ['name' => 'Ahmad',
            'campus_id' => '209',
            'lookup_faculty_type_id' => '2',
            'designation_id' => '8',
            'max_cources_allowed' => '17',
            'tc_program1' => '10',
            'tc_program2' => '7'
            'status' => 'active',
            ],
           


        ]);

    
    }

}
