<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       // $this->call(PermissionSeeder::class);
        $this->call(CharterTypeSeeder::class);
        $this->call(BusinessSchoolSeeder::class);
        $this->call(InstituteTypeSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(DesignationSeeder::class);


    }
}
