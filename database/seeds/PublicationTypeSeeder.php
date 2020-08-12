<?php

use Illuminate\Database\Seeder;

class PublicationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('publication_types')->insert([

                ['name' => 'Impact factor journals', 'status' => 'active','type'=>'Academic research articles'],
                ['name' => 'HEC category W', 'status' => 'active','type'=>'Academic research articles'],
                ['name' => 'HEC category X', 'status' => 'active','type'=>'Academic research articles'],
                ['name' => 'HEC category Y', 'status' => 'active','type'=>'Academic research articles'],
                ['name' => 'ABS or ABDC listing', 'status' => 'active','type'=>'Academic research articles'],
                ['name' => 'National conference papers', 'status' => 'active','type'=>'Academic research articles'],
                ['name' => 'International conference papers', 'status' => 'active','type'=>'Academic research articles'],
                ['name' => 'Books or research monographs', 'status' => 'active','type'=>'Books'],
                ['name' => 'Text books', 'status' => 'active','type'=>'Books'],
                ['name' => 'Case studies', 'status' => 'active','type'=>'Other Publications'],
                ['name' => 'Consultancy project reports', 'status' => 'active','type'=>'Other Publications'],
                ['name' => 'Practice oriented research articles', 'status' => 'active','type'=>'Other Publications'],
                ['name' => 'MS/MPhil thesis', 'status' => 'active','type'=>'Other Publications'],
                ['name' => 'Doctoral thesis', 'status' => 'active','type'=>'Other Publications']
            ]
        );
    }
}
