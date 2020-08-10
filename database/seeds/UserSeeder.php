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
            'email_verified_at' => '2020-07-29 17:32:04',
            'password' => Hash::make('admin!@#$'),
            'business_school_id' => 1,
<<<<<<< HEAD
            'campus_id' => 1,
=======
            'campus_id' => 209,
>>>>>>> fb5ba0be3d2c2c24a2617060c6f106a0c26b7269
            'country' => 'pakistan',
            'city' => 'peshawar',
            'user_type' => 'business_school',
            'status' => 'active',
        ]
    ]);
    }

}
