<?php

use Illuminate\Database\Seeder;

class StudentEnrolmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('student_enrolments')->insert([
            ['campus_id'=>'1','year'=>'2011','bs_level'=>'123','ms_level'=>'123','phd_level'=>'123','total_students'=>'3211','status'=>'active','isComplete'=>'yes','created_by'=>'1'
            ],
             ['campus_id'=>'209','year'=>'2011','bs_level'=>'123','ms_level'=>'123','phd_level'=>'123','total_students'=>'3211','status'=>'active','isComplete'=>'yes','created_by'=>'1'
            ],
             ['campus_id'=>'209','year'=>'2020','bs_level'=>'400','ms_level'=>'200','phd_level'=>'50','total_students'=>'650','status'=>'active','isComplete'=>'yes','created_by'=>'1'
            ],



        ]);
    }
}
