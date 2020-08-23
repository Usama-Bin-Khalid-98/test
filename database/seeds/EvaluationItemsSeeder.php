<?php

use Illuminate\Database\Seeder;

class EvaluationItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('evaluation_items')->insert([
            ['name' => 'Mid-term exam',
            'status' => 'active',
            ],
            ['name' => 'Final exam',
            'status' => 'active',
            ],
            ['name' => 'Quiz',
            'status' => 'active',
            ],
            ['name' => 'Assignment',
            'status' => 'active',
            ],
            ['name' => 'Project based learning',
            'status' => 'active',
            ],
            ['name' => 'Case studies',
            'status' => 'active',
            ],
            ['name' => 'Internship',
            'status' => 'active',
            ],
            ['name' => 'Research thesis',
            'status' => 'active',
            ],
            ['name' => 'Others (please specify)',
            'status' => 'active',
            ],

 			 
            


        ]);
    }
}
