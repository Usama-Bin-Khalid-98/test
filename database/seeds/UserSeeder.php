<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            ['name' => 'admin',
            'cnic' => '17101-1234324-1',
            'contact_no' => '+92-51-90800206',
            'email' => 'nbeac@hec.pk',
            'password' => Hash::make('admin!@#$'),
            'user_type' => 'admin',
            'status' => 'active',
            ],
            ['name' => 'Sania Tufail',
            'cnic' => '17101-1234324-1',
            'contact_no' => '+92-51-90800206',
            'email' => 'stufail@hec.pk',
            'password' => Hash::make('admin!@#$'),
            'user_type' => 'admin',
            'status' => 'active',
            ],


        ]);

    DB::table('users')->insert([
        [
            'name' => 'Muhammad Saboor Sethi',
            'designation_id' => 1,
            'cnic' => '17101-1234324-1',
            'contact_no' => '+92-51-90800206',
            'email' => 'city@gmail.com',
            'password' => Hash::make('admin!@#$'),
            'business_school_id' => 1,
            'campus_id' => 1,
            'country' => 'pakistan',
            'city' => 'peshawar',
            'user_type' => 'business_school',
            'status' => 'active',
        ]
    ]);
    }

}
