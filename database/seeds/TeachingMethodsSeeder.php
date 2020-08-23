<?php

use Illuminate\Database\Seeder;

class TeachingMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teaching_methods')->insert([
            ['name' => 'Case studies',     
            'status' => 'active',
            ],
            ['name' => 'Business games & role play',     
            'status' => 'active',
            ],
            ['name' => 'Film and video clips',     
            'status' => 'active',
            ],
            ['name' => 'Journal article reviews',     
            'status' => 'active',
            ],
            ['name' => 'Project based learning',     
            'status' => 'active',
            ],
            ['name' => 'Others (specify)',     
            'status' => 'active',
            ],
           
 			 
            


        ]);
    }
}
