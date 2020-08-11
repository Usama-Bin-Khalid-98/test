<?php

use Illuminate\Database\Seeder;

class StrategicPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('strategic_plans')->insert([ 'campus_id'=>'1','plan_period'=>'1 year','aproval_date'=>'2000-2-21','aproving_authority'=>'dean','status'=>'active','isComplete'=>'yes','created_by'=>'1'  ]);
    }
}
