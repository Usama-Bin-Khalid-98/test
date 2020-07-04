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

        ////////////////////World////////////////////////

        $this->call(WorldContinentsTableSeeder::class);
        $this->call(WorldContinentsLocaleTableSeeder::class);
        $this->call(WorldCountriesTableSeeder::class);
        $this->call(WorldCountriesLocaleTableSeeder::class);
        $this->call(WorldDivisionsTableSeeder::class);
        $this->call(WorldDivisionsLocaleTableSeeder::class);
        $this->call(WorldCitiesTableSeeder::class);
        $this->call(WorldCitiesLocaleTableSeeder::class);
        $this->call(WorldLanguagesTableSeeder::class);


    }
}
