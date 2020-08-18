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
    {
        //
        DB::table('financial_infos')->insert([
            ['campus_id'=>'1','income_source_id'=>'1','year_three'=>'2411','year_two'=>'2500','year_one'=>'23455','year_t'=>'23132','year_t_plus_one'=>'23111','year_t_plus_two'=>'90000','status'=>'active','created_by'=>'1','amount'=>'4234','percent_share'=>'23'],
            ['campus_id'=>'209','income_source_id'=>'2','year_three'=>'2411','year_two'=>'2500','year_one'=>'23455','year_t'=>'23132','year_t_plus_one'=>'23111','year_t_plus_two'=>'90000','status'=>'active','created_by'=>'1','amount'=>'34','percent_share'=>'3'],
            ['campus_id'=>'209','income_source_id'=>'1','year_three'=>'12','year_two'=>'2530','year_one'=>'225','year_t'=>'2122','year_t_plus_one'=>'23211','year_t_plus_two'=>'300','status'=>'active','created_by'=>'1','amount'=>'4','percent_share'=>'34'],
            ['campus_id'=>'209','income_source_id'=>'20','year_three'=>'2411','year_two'=>'2500','year_one'=>'23455','year_t'=>'23132','year_t_plus_one'=>'23111','year_t_plus_two'=>'90000','status'=>'active','created_by'=>'1','amount'=>'124','percent_share'=>'34'],
            ['campus_id'=>'209','income_source_id'=>'17','year_three'=>'211','year_two'=>'250','year_one'=>'2355','year_t'=>'23132','year_t_plus_one'=>'23111','year_t_plus_two'=>'7000','status'=>'active','created_by'=>'1','amount'=>'424','percent_share'=>'13'],

        ]);

    }
}
