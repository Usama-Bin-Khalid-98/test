<?php

use Illuminate\Database\Seeder;

class EntryRequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('Entry_requirements')->insert([
            ['campus_id'=>'1',
                'program_id'=>'1',
                'eligibility_criteria_id'=>'1',
                'min_req'=>'matric',
                'status'=>'active',
                'isComplete'=>'yes'],
            ['campus_id'=>'209',
                'program_id'=>'1',
                'eligibility_criteria_id'=>'1',
                'min_req'=>'matric',
                'status'=>'active',
                'isComplete'=>'yes'], 
            ['campus_id'=>'1',
                'program_id'=>'2',
                'eligibility_criteria_id'=>'3',
                'min_req'=>'matric',
                'status'=>'active',
                'isComplete'=>'yes'],   
        ]);

    }
}
