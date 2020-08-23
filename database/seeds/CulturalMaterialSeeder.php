<?php

use Illuminate\Database\Seeder;

class CulturalMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cultural_material')->insert([
            ['campus_id' => '209',
            'cultural_material' => 'dasdasd',
            'course_title' => 'English',            
            'status' => 'active',
            ],
 			 ['campus_id' => '209',
            'cultural_material' => 'FUNKADA',
            'course_title' => 'xyz',            
            'status' => 'active',
            ],
            


        ]);
    }
}
