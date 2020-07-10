<?php

use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sectors')->insert([
            ['name' => 'Public'],
            ['name' => 'Private'],
            ['name' => 'Industry']
        ]);
    }
}
