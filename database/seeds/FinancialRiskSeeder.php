<?php

use Illuminate\Database\Seeder;

class FinancialRiskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('financial_risks')->insert(['campus_id'=>'1','risk_identified'=>'no','stakeholder_involved'=>'14','remedial_measure'=>'no','status'=>'active','isComplete'=>'yes']);
    }
}
