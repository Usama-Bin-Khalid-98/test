<?php

use Illuminate\Database\Seeder;

class FinancialInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {DB::table('financial_infos')->insert([
		['campus_id'=>'1','income_source_id'=>'1','year_three'=>'2411','year_two'=>'2500','year_one'=>'23455','year_t'=>'23132','year_t_plus_one'=>'23111','year_t_plus_two'=>'90000','status'=>'active','created_by'=>'1'],
		['campus_id'=>'1','income_source_id'=>'2','year_three'=>'2411','year_two'=>'2500','year_one'=>'23455','year_t'=>'23132','year_t_plus_one'=>'23111','year_t_plus_two'=>'90000','status'=>'active','created_by'=>'1']
		
    ]);
        //
    
    }
}
