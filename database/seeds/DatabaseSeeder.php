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
        $this->call(CourseTypeSeeder::class);
        $this->call(StatutoryBodySeeder::class);
        $this->call(SemesterSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(DisciplineSeeder::class);
        $this->call(ReviewerRoleSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(SectorSeeder::class);
        $this->call(DegreeSeeder::class);
        $this->call(PublicationTypeSeeder::class);
        $this->call(EligibilityCriteriaSeeder::class);

    }
}
