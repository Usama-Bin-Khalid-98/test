<?php

use Illuminate\Database\Seeder;

class CourseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('course_types')->insert([

                ['name' => 'Core', 'status' => 'active'],
                ['name' => 'Elective', 'status' => 'active'],
                ['name' => 'Support', 'status' => 'active']
            ]
        );
    }
}
