<?php

use Illuminate\Database\Seeder;

class StudentGenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('student_genders')->insert(['campus_id'=>'1','program_id'=>'1','male'=>'212','female'=>'121','status'=>'active','isComplete'=>'yes','created_by'=>'1']);
    }
}
