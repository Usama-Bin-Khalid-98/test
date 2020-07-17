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
            'name' => 'admin',
            'cnic' => '17101-1234324-1',
            'contact_no' => '+92-51-90800206',
            'name' => 'admin',
            'email' => 'nbeac@hec.gov.pk',
            'password' => Hash::make('admin!@#$'),
            'user_type' => 'admin',
            'status' => 'active',
        ]);
    }
}
