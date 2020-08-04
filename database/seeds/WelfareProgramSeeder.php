<?php

use Illuminate\Database\Seeder;

class WelfareProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('welfare_programs')->insert([

                ['name' => 'Health insurance', 'status' => 'active'],
                ['name' => 'Housing', 'status' => 'active'],
                ['name' => 'Loan schemes', 'status' => 'active'],
                ['name' => 'Welfare fund', 'status' => 'active'],
                ['name' => 'Others', 'status' => 'active']
            ]
        );
    }
}
