<?php

use Illuminate\Database\Seeder;

class IncomeSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('income_sources')->insert([
                ['id'=>'1','particular' => 'Undergraduate programs fee','type' => 'income', 'status' => 'active'],
                ['id'=>'2','particular' => 'Graduate programs fee','type' => 'income', 'status' => 'active'],
                ['id'=>'3','particular' => 'Postgraduate programs fee','type' => 'income', 'status' => 'active'],
                ['id'=>'4','particular' => 'Executive education fee','type' => 'income', 'status' => 'active'],
                ['id'=>'5','particular' => 'R&D income ','type' => 'income', 'status' => 'active'],
                ['id'=>'6','particular' => 'Endowment/investment income','type' => 'income', 'status' => 'active'],
                ['id'=>'7','particular' => 'Grants by government','type' => 'income', 'status' => 'active'],
                ['id'=>'8','particular' => 'Grants by parentor ganization','type' => 'income', 'status' => 'active'],
                ['id'=>'9','particular' => 'Corporate sponsorships','type' => 'income', 'status' => 'active'],
                ['id'=>'10','particular' => 'Any other income','type' => 'income', 'status' => 'active'],
                ['id'=>'11','particular' => 'Faculty salaries','type' => 'expense', 'status' => 'active'],
                ['id'=>'12','particular' => 'Faculty development','type' => 'expense', 'status' => 'active'],
                ['id'=>'13','particular' => 'Staff salaries','type' => 'expense', 'status' => 'active'],
                ['id'=>'14','particular' => 'Marketing and promotion','type' => 'expense', 'status' => 'active'],
                ['id'=>'15','particular' => 'IT facilities','type' => 'expense', 'status' => 'active'],
                ['id'=>'16','particular' => 'Library','type' => 'expense', 'status' => 'active'],
                ['id'=>'17','particular' => 'R&D','type' => 'expense', 'status' => 'active'],
                ['id'=>'18','particular' => 'Scholarships/financial','type' => 'expense', 'status' => 'active'],
                ['id'=>'19','particular' => 'Co-Extracurricular activities','type' => 'expense', 'status' => 'active'],
                ['id'=>'20','particular' => 'Educational visits/seminars','type' => 'expense', 'status' => 'active'],
                ['id'=>'21','particular' => 'Repair and maintenance','type' => 'expense', 'status' => 'active'],
                ['id'=>'22','particular' => 'Interest payments','type' => 'expense', 'status' => 'active'],
                ['id'=>'23','particular' => 'Utilities','type' => 'expense', 'status' => 'active'],
                ['id'=>'24','particular' => 'Other expenses','type' => 'expense', 'status' => 'active'],
          ]      
        );
    }
}
