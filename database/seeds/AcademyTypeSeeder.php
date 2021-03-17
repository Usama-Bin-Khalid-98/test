<?php

use Illuminate\Database\Seeder;

class AcademyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('academy_types')->insert([
            ['name' => 'National Academic Institution'],
            ['name'=>'International Academic Institution'],
            ['name'=>'corporate/business Organization'],
            ['name'=>'Social Organization']
        ]);
    }
}
