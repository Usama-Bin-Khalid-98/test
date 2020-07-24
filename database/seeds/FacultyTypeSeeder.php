<?php

use Illuminate\Database\Seeder;

class FacultyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('lookup_faculty_type')->insert([
            ['faculty_type' => 'Permanent'],
            ['faculty_type' => 'Visiting'],
            ['faculty_type' => 'Adjacent']
        ]);
    }
}
