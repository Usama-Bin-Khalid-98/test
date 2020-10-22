<?php

use Illuminate\Database\Seeder;

class ReviewerRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('reviewer_roles')->insert([
            ['name' => 'Industry Representative'],
            ['name' => 'Shadow Member'],
            ['name' => 'NBEAC Representative']
        ]);
    }
}
