<?php

use Illuminate\Database\Seeder;

class EligibilityCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('eligibility_criterias')->insert([

                ['name' => 'Matric/O-levels or equivalent', 'status' => 'active'],
                ['name' => 'SAT/NAT/GAT', 'status' => 'active'],
                ['name' => 'Grades in Specific Subjects', 'status' => 'active'],
                ['name' => 'Entry test', 'status' => 'active'],
                ['name' => 'Candidacy Interview', 'status' => 'active'],
                ['name' => 'Work Experience', 'status' => 'active']
            ]
        );
    }
}
