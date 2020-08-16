<?php

use Illuminate\Database\Seeder;

class FundingSourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('funding_sources')->insert([
                ['name' => 'Tution Fee', 'status' => 'active'],
                ['name' => 'Sponsorship(s)', 'status' => 'active'],
                ['name' => 'Endowment fund(s)', 'status' => 'active'],
                ['name' => 'Consultancy', 'status' => 'active'],
                ['name' => 'Research projects', 'status' => 'active'],
                ['name' => 'Executive education', 'status' => 'active'],
                ['name' => 'Any other (specify)', 'status' => 'active'],
            ]
        );
    }
}
