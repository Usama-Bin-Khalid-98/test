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
        DB::table('research_summaries')->insert([ 
            ['publication_type_id'=>'2','campus_id'=>'1','year'=>'2019','total_items'=>'21','contributing_core_faculty'=>'21','jointly_produced_other'=>'21','jointly_produced_same'=>'21', 'jointly_produced_multiple'=>'21','status'=>'active','isComplete'=>'yes','created_by'=>'3'],
            ['publication_type_id'=>'12','campus_id'=>'209','year'=>'2019','total_items'=>'21','contributing_core_faculty'=>'21','jointly_produced_other'=>'21','jointly_produced_same'=>'21', 'jointly_produced_multiple'=>'21','status'=>'active','isComplete'=>'yes','created_by'=>'3'],
            ['publication_type_id'=>'9','campus_id'=>'209','year'=>'2019','total_items'=>'21','contributing_core_faculty'=>'21','jointly_produced_other'=>'21','jointly_produced_same'=>'21', 'jointly_produced_multiple'=>'21','status'=>'active','isComplete'=>'yes','created_by'=>'3'],
            ['publication_type_id'=>'3','campus_id'=>'209','year'=>'2019','total_items'=>'27','contributing_core_faculty'=>'71','jointly_produced_other'=>'21','jointly_produced_same'=>'2', 'jointly_produced_multiple'=>'1','status'=>'active','isComplete'=>'yes','created_by'=>'3'],
            ['publication_type_id'=>'4','campus_id'=>'209','year'=>'2019','total_items'=>'8','contributing_core_faculty'=>'7','jointly_produced_other'=>'6','jointly_produced_same'=>'5', 'jointly_produced_multiple'=>'4','status'=>'active','isComplete'=>'yes','created_by'=>'3'],
            ['publication_type_id'=>'8','campus_id'=>'209','year'=>'2019','total_items'=>'31','contributing_core_faculty'=>'3','jointly_produced_other'=>'3','jointly_produced_same'=>'2', 'jointly_produced_multiple'=>'1','status'=>'active','isComplete'=>'yes','created_by'=>'3'],
            ['publication_type_id'=>'13','campus_id'=>'209','year'=>'2019','total_items'=>'21','contributing_core_faculty'=>'3','jointly_produced_other'=>'81','jointly_produced_same'=>'2', 'jointly_produced_multiple'=>'1','status'=>'active','isComplete'=>'yes','created_by'=>'3'],
            ['publication_type_id'=>'14','campus_id'=>'209','year'=>'2019','total_items'=>'2','contributing_core_faculty'=>'1','jointly_produced_other'=>'27','jointly_produced_same'=>'31', 'jointly_produced_multiple'=>'51','status'=>'active','isComplete'=>'yes','created_by'=>'3'],
            ]);
    }
}
