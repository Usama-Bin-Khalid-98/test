<?php

use Illuminate\Database\Seeder;

class StudentClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student_clubs')->insert(['campus_id'=>'1','name'=>'imram','total_members'=>'321','no_of_members'=>'2','purpose'=>'rivals','status'=>'active',
        	'isComplete'=>'yes','created_by'=>'1'
    ]);
    }
}
