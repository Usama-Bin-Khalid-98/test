<?php

use Illuminate\Database\Seeder;

class EvaluationMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('evaluation_method')->insert([
            ['campus_id' => '209',
            'evaluation_items_id' => '1',
            'frequency' => '234', 
            'range' => '12',           
            'status' => 'active',
            ],
 			 ['campus_id' => '209',
            'evaluation_items_id' => '2',
            'frequency' => '54', 
            'range' => '1',           
            'status' => 'active',
            ],
            


        ]);
    }
}
