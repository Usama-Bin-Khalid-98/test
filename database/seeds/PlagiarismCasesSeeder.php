<?php

use Illuminate\Database\Seeder;

class PlagiarismCasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('plagiarism_cases')->insert([
            ['campus_id' => '209',
            'date' => '1-1-2020',
            'students_initial' => 'Aasdsad', 
            'degree' => 'BBA',
            'nature' => 'Plagiarism', 
            'penalty' => '10000',          
            'status' => 'active',
            ],
 			 ['campus_id' => '209',
            'date' => '10-10-2019',
            'students_initial' => 'hfgh', 
            'degree' => 'sdasA',
            'nature' => 'Plagiarism', 
            'penalty' => '5000',          
            'status' => 'active',
            ],
            


        ]);
    }
}
