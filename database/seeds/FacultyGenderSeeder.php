<?php

use Illuminate\Database\Seeder;

class FacultyGenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('faculty_genders')->insert([
            'campus_id'=>'1',
            'lookup_faculty_type_id'=>'1',
            'male'=>'10',
            'female'=>'20',
            'status'=>'active',
            'isCompleted'=>'yes',
            'created_by'=>'1'

        ]);

    }
}
