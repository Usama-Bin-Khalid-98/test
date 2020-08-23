<?php

use Illuminate\Database\Seeder;

class ManagerialSkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('managerial_skills')->insert([
            ['campus_id' => '209',
            'skill' => 'dwq',
            'course_title' => 'Aasdsad',            
            'status' => 'active',
            ],
 			 ['campus_id' => '209',
            'skill' => 'xyz',
            'course_title' => 'erer',            
            'status' => 'active',
            ],
            


        ]);
    }
}
