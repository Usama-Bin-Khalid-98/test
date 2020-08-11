<?php

use Illuminate\Database\Seeder;

class ResearchSummarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('research_summaries')->insert([ 'publication_type_id'=>'2','campus_id'=>'1','year'=>'2019','total_items'=>'21','contributing_core_faculty'=>'21','jointly_produced_other'=>'21','jointly_produced_same'=>'21', 'jointly_produced_multiple'=>'21','status'=>'active','isComplete'=>'yes','created_by'=>'3'  ]);
    }
}
