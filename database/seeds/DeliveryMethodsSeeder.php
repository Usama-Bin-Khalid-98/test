<?php

use Illuminate\Database\Seeder;

class DeliveryMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('program_delivery_methods')->insert([
            ['campus_id' => '209',
            'teaching_methods_id' => '1',
            'course_code' => 'Aasdsad', 
            'course_title' => 'dhasjdsa',           
            'status' => 'active',
            ],
 			 ['campus_id' => '209',
            'teaching_methods_id' => '3',
            'course_code' => 'xyz', 
            'course_title' => 'ret',           
            'status' => 'active',
            ],
            


        ]);
    }
}
