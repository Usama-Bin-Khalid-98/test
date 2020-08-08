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
        $this->call(DepartmentSeeder::class);
       // $this->call(PermissionSeeder::class);
        $this->call(FacultyQualificationSeeder::class);
        $this->call(CharterTypeSeeder::class);
        $this->call(InstituteTypeSeeder::class);
        $this->call(BusinessSchoolSeeder::class);
        $this->call(CampusSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(DesignationSeeder::class);
        $this->call(CourseTypeSeeder::class);
        $this->call(StatutoryBodySeeder::class);
        $this->call(SemesterSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DisciplineSeeder::class);
        $this->call(ReviewerRoleSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(SectorSeeder::class);
        $this->call(DegreeSeeder::class);
        $this->call(PublicationTypeSeeder::class);
        $this->call(CourseTypeSeeder::class);
        $this->call(EligibilityCriteriaSeeder::class);
        $this->call(SemesterSeeder::class);
        $this->call(StatutoryBodySeeder::class);
        $this->call(FacultyTypeSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(IncomeSourceSeeder::class);
        $this->call(FacilityTypeSeeder::class);
        $this->call(FacilitySeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(FypRequirementSeeder::class);
        $this->call(FeeTypeSeeder::class);
        $this->call(WelfareProgramSeeder::class);
        $this->call(StaffCategorySeeder::class);
        $this->call(QecTypeSeeder::class);
        $this->call(NbeacCriteriaSeeder::class);
        $this->call(SlipSeeder::class);
    }
}
