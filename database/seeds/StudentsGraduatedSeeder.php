<?php

use Illuminate\Database\Seeder;

class StudentsGraduatedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('students_graduateds')->insert(['campus_id'=>'1','program_id'=>'1','grad_std_t'=>'211','grad_std_t_2'=>'21','grad_std_t_3'=>'32','status'=>'active','isComplete'=>'yes','created_by'=>'1',]);
        //
    }
}
