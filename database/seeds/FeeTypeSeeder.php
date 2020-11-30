<?php

use Illuminate\Database\Seeder;

class FeeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('fee_types')->insert([
            ['name' => 'Registration Fee', 'amount' =>50000],
            ['name' => 'Accreditation/Reaccreditation Fee Per Program', 'amount' =>200000],
            ['name' => 'Revisit Fee per program', 'amount' =>200000],
            ['name' => 'Mentoring Fee', 'amount' =>15000],
            ['name' => 'Appeal Costs', 'amount' =>100000],
            ['name' => 'Accreditation Fee', 'amount' =>100000],
        ]);
    }
}
