<?php

use Illuminate\Database\Seeder;

class StatutoryCommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('statutory_committees')->insert([
            'campus_id'=>'1',
            'statutory_body_id'=>'1',
            'name'=>'khan',
            'designation_id'=>'1',
            'date_first_meeting'=>'2020-08-01',
            'date_second_meeting'=>'2020-08-01',
            'date_third_meeting'=>'2020-08-01',
            'date_fourth_meeting'=>'2020-08-01',
            'file'=>'m.docx','status'=>'active',
            'isComplete'=>'yes','created_by'=>'1'
        ]);
    }
}

