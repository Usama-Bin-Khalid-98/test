<?php

use Illuminate\Database\Seeder;

class AcademyLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('academy_levels')->insert([
            ['name'=> ' Business School'],
            ['name'=> 'University']
        ]);
    }
}
