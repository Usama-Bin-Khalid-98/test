<?php

use Illuminate\Database\Seeder;

class FypRequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('fyp_requirements')->insert([
            ['name' => 'viva'],
            ['name' => 'thesis'],
            ['name' => 'comprehensive'],
        ]);
    }
}
