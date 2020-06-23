<?php

use Illuminate\Database\Seeder;

class CharterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add Default Charter Types

       $charter_types = [
           'Azad Jammu Kashmir',
           'Balochistan',
           'Federal',
           'Gilgit Baltistan',
           'International',
           'Khyber Pakhthunkhwa',
           'Panjab',
           'Sindh'
       ];

       foreach ($charter_types as $type) {
           \App\CharterType::create(['name' => $type]);
       }
    }
}
