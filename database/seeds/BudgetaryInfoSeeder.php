<?php

use Illuminate\Database\Seeder;

class BudgetaryInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('budgetary_infos')->insert([
       	['campus_id'=>'209','year'=>'2020','uni_budget'=>'500000','uni_proposed_budget'=>'600000','budget_receive'=>'400000','budget_type'=>'ABC','status'=>'active','isComplete'=>'yes','created_by'=>'1'],
       	['campus_id'=>'209','year'=>'2019','uni_budget'=>'450000','uni_proposed_budget'=>'550000','budget_receive'=>'350000','budget_type'=>'ABC','status'=>'active','isComplete'=>'yes','created_by'=>'1'],
       ]);
    }
}
