<?php

use Illuminate\Database\Seeder;

class BusinessSchoolFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business_schools')->insert([

                [ 'campus_id' => auth()->user()->campus_id, 'facility_id' => '1','remark' => '50'],
                [ 'campus_id' => auth()->user()->campus_id, 'facility_id' => '2','remark' => '43'],
                [ 'campus_id' => auth()->user()->campus_id, 'facility_id' => '3','remark' => '51'],
                [ 'campus_id' => auth()->user()->campus_id, 'facility_id' => '7','remark' => '32'],
                [ 'campus_id' => auth()->user()->campus_id, 'facility_id' => '8','remark' => '11'],
                [ 'campus_id' => auth()->user()->campus_id, 'facility_id' => '9','remark' => '71'],
                [ 'campus_id' => auth()->user()->campus_id, 'facility_id' => '15','remark' => '34'],
                [ 'campus_id' => auth()->user()->campus_id, 'facility_id' => '17','remark' => '51'],
                [ 'campus_id' => auth()->user()->campus_id, 'facility_id' => '10','remark' => '11'],
                [ 'campus_id' => auth()->user()->campus_id, 'facility_id' => '12','remark' => '80'],
                [ 'campus_id' => auth()->user()->campus_id, 'facility_id' => '13','remark' => '1'],
                [ 'campus_id' => auth()->user()->campus_id, 'facility_id' => '25','remark' => '31'],
                [ 'campus_id' => auth()->user()->campus_id, 'facility_id' => '27','remark' => '52'],
                [ 'campus_id' => auth()->user()->campus_id, 'facility_id' => '30','remark' => '1'],
                [ 'campus_id' => auth()->user()->campus_id, 'facility_id' => '31','remark' => 'Yes'],
                [ 'campus_id' => auth()->user()->campus_id, 'facility_id' => '32','remark' => 'Yes'],
                [ 'campus_id' => auth()->user()->campus_id, 'facility_id' => '36','remark' => 'Yes'],
                

            ]
        );
    }
}
