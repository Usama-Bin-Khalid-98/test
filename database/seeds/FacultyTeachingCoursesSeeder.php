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
            'campus_id' => 209,
            'campus_id' => 1,
            'lookup_faculty_type_id' => '1',
            'designation_id' => '10',
            'max_cources_allowed' => '19',
            'status' => 'active',
            ],
            ['name' => 'Ahmad',
            'campus_id' => 209,
            'campus_id' => 1,
            'lookup_faculty_type_id' => '2',
            'designation_id' => '8',
            'max_cources_allowed' => '17',
            'status' => 'active',
            ]
        ]);
    }

}
// faculty
