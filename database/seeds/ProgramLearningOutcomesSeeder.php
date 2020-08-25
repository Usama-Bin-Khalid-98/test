<?php

use Illuminate\Database\Seeder;

class ProgramLearningOutcomesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('learning_outcomes')->insert([
            ['campus_id' => '209',
            'program_id' => '1',
            'plo' => 'jkhjk',            
            'status' => 'active',
            ],
 			 ['campus_id' => '209',
            'program_id' => '5',
            'plo' => 'ewdasd',            
            'status' => 'active',
            ],
            


        ]);
    }
}
