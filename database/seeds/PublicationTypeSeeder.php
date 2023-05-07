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

                ['name' => 'Impact factor journals', 'status' => 'active','publication_category_id'=>1],
                ['name' => 'HEC category W', 'status' => 'active','publication_category_id'=>1],
                ['name' => 'HEC category X', 'status' => 'active','publication_category_id'=>1],
                ['name' => 'HEC category Y', 'status' => 'active','publication_category_id'=>1],
                ['name' => 'ABS or ABDC listing', 'status' => 'active','publication_category_id'=>1],
                ['name' => 'National conference papers', 'status' => 'active','publication_category_id'=>1],
                ['name' => 'International conference papers', 'status' => 'active','publication_category_id'=>1],
                ['name' => 'Books or research monographs', 'status' => 'active','publication_category_id'=>2],
                ['name' => 'Text books', 'status' => 'active','publication_category_id'=>2],
                ['name' => 'Case studies', 'status' => 'active','publication_category_id'=>3],
                ['name' => 'Consultancy project reports', 'status' => 'active','publication_category_id'=>3],
                ['name' => 'Practice oriented research articles', 'status' => 'active','publication_category_id'=>3],
                ['name' => 'MS/MPhil thesis', 'status' => 'active','publication_category_id'=>3],
                ['name' => 'Doctoral thesis', 'status' => 'active','publication_category_id'=>3],
                ['name' => 'Books Chapter', 'status' => 'active','publication_category_id'=>2],
                ['name' => 'Other Listings', 'status' => 'active','publication_category_id'=>1]
            ]
        );
    }
}
