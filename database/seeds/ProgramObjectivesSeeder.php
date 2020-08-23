<?php

use Illuminate\Database\Seeder;

class ProgramObjectivesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('program_objectives')->insert([
            ['campus_id' => '209',
            'program_id' => '1',
            'po' => 'Aasdsad',            
            'status' => 'active',
            ],
 			 ['campus_id' => '209',
            'program_id' => '5',
            'po' => 'xyz',            
            'status' => 'active',
            ],
            


        ]);
    }
}
