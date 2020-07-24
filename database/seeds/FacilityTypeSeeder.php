<?php

use Illuminate\Database\Seeder;

class FacilityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('facility_types')->insert([
            ['id'=>'1','name' => 'Business School','status' => 'active'],
            ['id'=>'2','name' => 'Faculty Offices','status' => 'active'],
            ['id'=>'3','name' => 'Lecture Halls','status' => 'active'],
            ['id'=>'4','name' => 'Library','status' => 'active'],
            ['id'=>'5','name' => 'Laboratories','status' => 'active'],
            ['id'=>'6','name' => 'Multipurpose hall/auditorium','status' => 'active'],
            ['id'=>'7','name' => 'Hostels/accommodation','status' => 'active'],
            ['id'=>'8','name' => 'Transportation','status' => 'active'],
            ['id'=>'9','name' => 'Other Facilities','status' => 'active']
            
        ]);
    }
}
