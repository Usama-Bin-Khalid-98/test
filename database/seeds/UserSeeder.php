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

        DB::table('users')->insert([
            ['name' => 'admin',
            'cnic' => '17101-1234324-1',
            'contact_no' => '+92-51-90800206',
            'email' => 'nbeac@hec.pk',
            'email_verified_at' => '2020-07-29 17:32:04',
            'password' => Hash::make('admin!@#$'),
            'user_type' => 'NBEACAdmin',
            'status' => 'active',
            ],
            ['name' => 'Sania Tufail',
            'cnic' => '17101-1234324-1',
            'contact_no' => '+92-51-90800206',
            'email' => 'stufail@hec.pk',

            'email_verified_at' => '2020-07-29 17:32:04',
            'password' => Hash::make('admin!@#$'),
            'user_type' => 'NBEACAdmin',
            'status' => 'active',
            ],
        ]);

    }

}
