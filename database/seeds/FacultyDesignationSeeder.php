<?php

use Illuminate\Database\Seeder;

class facultyDesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lookup_faculty_desination')->insert([
            ['faculty_designation' => 'Professor'],
            ['faculty_designation' => 'Dean'],
            ['faculty_designation' => 'HOD'],
            ['faculty_designation' => 'Assistant Professor']
        ]);
    }
}
