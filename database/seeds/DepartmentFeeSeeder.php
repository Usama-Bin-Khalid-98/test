<?php

use Illuminate\Database\Seeder;

class DepartmentFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('department_fees')->insert([
            ['campus_id'=>'1'],
            ['department_id'=>'1'],
            ['fee_type_id'=>'1'],
            ['status'=>'active'],
            ['isComplete'=>'yes']

         ]);
    }
}
