<?php

use Illuminate\Database\Seeder;

class SlipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('slips')->insert([
        ['invoice_no' => 'NBEAC-HEC/ GU, Karachi:0001', 'business_school_id' => 209, 'department_id' => 1, 'status' => 'pending']
    ]);
    }
}
