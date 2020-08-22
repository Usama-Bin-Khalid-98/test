<?php

use Illuminate\Database\Seeder;

class StatutoryBodySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('statutory_bodies')->insert([
            ['name' => 'Board of Trustees'],
            ['name' => 'Syndicate/Board of Governors/Exec Board'],
            ['name' => 'Academic Council'],
            ['name' => 'Board of Faculty'],
            ['name' => 'Board of Studies'],
            ['name' => 'Selection Board '],
            ['name' => 'Any Other ']
        ]);
    }
}
