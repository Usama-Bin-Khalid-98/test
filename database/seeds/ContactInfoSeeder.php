<?php

use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_infos')->insert([
            [
                'name'=>'Muhammad Salman',
                'email'=>'salman@uni.edu.pk',
                'contact_no'=>'03185276733',
                'school_contact'=>'0922352345',
                'designation_id'=>'1',
                'cv'=>'',
                'campus_id'=>'1',
                'status'=>'active',
                'isComplete'=>'yes',
                'focal_person'=>'trevor'
            ],
            [
                'name'=>'Muhammad Usman',
                'email'=>'usman@uni.edu.pk',
                'contact_no'=>'03185276733',
                'school_contact'=>'0922352345',
                'designation_id'=>'1',
                'cv'=>'',
                'campus_id'=>'209',
                'status'=>'active',
                'isComplete'=>'yes',
                'focal_person'=>'trevor'
            ],
            [
                'name'=>'Muhammad Omer',
                'email'=>'omer@uni.edu.pk',
                'contact_no'=>'03185276733',
                'school_contact'=>'0922352345',
                'designation_id'=>'2',
                'cv'=>'',
                'campus_id'=>'209',
                'status'=>'active',
                'isComplete'=>'yes',
                'focal_person'=>''
            ]


        ]);

    }
}
