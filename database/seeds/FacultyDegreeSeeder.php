<?php

use Illuminate\Database\Seeder;

class FacultyDegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculty_degrees')->insert([
            ['faculty_foreign' => '0',
             'faculty_domestic' => '0',
             'faculty_international' => '0'
        ],
        ]);
    }
}
