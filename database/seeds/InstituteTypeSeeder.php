<?php

use Illuminate\Database\Seeder;

class InstituteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('institute_types')->insert([
                ['name' => 'Degree Awarding Institute'],
                ['name' => 'University']
            ]
        );
    }
}
