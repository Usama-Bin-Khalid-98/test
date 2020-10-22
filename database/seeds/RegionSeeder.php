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
            ['name' => 'Balochistan'],
            ['name' => 'Federal'],
            ['name' => 'Gilgit Baltistan'],
            ['name' => 'KPK'],
            ['name' => 'Punjab']
        ]);
    }
}
