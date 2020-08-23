<?php

use Illuminate\Database\Seeder;

class MappingPO_PLOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('po_plo_mappings')->insert([
            ['campus_id' => '209',
            'program_id' => '1',
            'po_id' => '1', 
            'plo_id' => '1',            
            'status' => 'active',
            ],
 			 ['campus_id' => '209',
            'program_id' => '5',
            'po_id' => '2', 
            'plo_id' => '2',           
            'status' => 'active',
            ],
            


        ]);
    }
}
