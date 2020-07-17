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

                ['name' => 'Impact factor journals', 'status' => 'active'],
                ['name' => 'HEC category W', 'status' => 'active'],
                ['name' => 'HEC category X', 'status' => 'active'],
                ['name' => 'HEC category Y', 'status' => 'active'],
                ['name' => 'ABS or ABDC listing', 'status' => 'active'],
                ['name' => 'National conference papers', 'status' => 'active'],
                ['name' => 'International conference papers', 'status' => 'active'],
                ['name' => 'Books or research monographs', 'status' => 'active'],
                ['name' => 'Text books', 'status' => 'active'],
                ['name' => 'Case studies', 'status' => 'active'],
                ['name' => 'Consultancy project reports', 'status' => 'active'],
                ['name' => 'Practice oriented research articles', 'status' => 'active'],
                ['name' => 'MS/MPhil thesis', 'status' => 'active'],
                ['name' => 'Doctoral thesis', 'status' => 'active']
            ]
        );
    }
}
