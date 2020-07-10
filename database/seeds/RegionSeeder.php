<?php

use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Punjab, Sindh, Balochistan, KPK, Federal, Gilgit Baltistan
        DB::table('regions')->insert([
            ['name' => 'Punjab'],
            ['name' => 'Balochistan'],
            ['name' => 'KPK'],
            ['name' => 'Federal'],
            ['name' => 'Gilgit Baltistan']
        ]);
    }
}
