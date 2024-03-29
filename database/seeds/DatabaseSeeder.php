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
        $this->call(DisciplineSeeder::class);
        $this->call(DepartmentSeeder::class);
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
        $this->call(RolePermissionSeeder::class);
        $this->call(ReviewerRoleSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(SectorSeeder::class);
        $this->call(DegreeSeeder::class);
        $this->call(PublicationCategorySeeder::class);
        $this->call(PublicationTypeSeeder::class);
        // $this->call(CourseTypeSeeder::class);
        $this->call(EligibilityCriteriaSeeder::class);
        // $this->call(SemesterSeeder::class);
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
//        $this->call(SlipSeeder::class);
        $this->call(FacultyDegreeSeeder::class);

//        $this->call(ContactInfoSeeder::class);
        $this->call(DepartmentFeeSeeder::class);
        $this->call(DeskReviewSeeder::class);
//        $this->call(EntryRequirementSeeder::class);
//        $this->call(FacultyGenderSeeder::class);
//        $this->call(FinancialInfoSeeder::class);
//        $this->call(FinancialRiskSeeder::class);
//        $this->call(FormalRelationshipSeeder::class);
//        $this->call(InternalCommunitySeeder::class);
//        $this->call(MissionVisionSeeder::class);
//        $this->call(QecInfoSeeder::class);
//        $this->call(ResearchSummarySeeder::class);
//        $this->call(ScopeSeeder::class);
//        $this->call(StatutoryCommitteeSeeder::class);
//        $this->call(StrategicPlanSeeder::class);
//        $this->call(StudentClubSeeder::class);
//        $this->call(StudentEnrolmentSeeder::class);
//        $this->call(StudentGenderSeeder::class);
//        $this->call(StudentsGraduatedSeeder::class);
//        $this->call(SupportStaffSeeder::class);
//        $this->call(SurveyQuestionnaireSeeder::class);
//        $this->call(WorkLoadSeeder::class);
        $this->call(FundingSourcesSeeder::class);
        $this->call(ActivityEngagementSeeder::class);
//        $this->call(FacultyStudentsRatioSeeder::class);
//        $this->call(FacultyStabilitySeeder::class);
//        $this->call(BusinessSchoolFacilitySeeder::class);
//        $this->call(AffiliationSeeder::class);
//        $this->call(BudgetaryInfoSeeder::class);
//        $this->call(ProgramPortfolioSeeder::class);
//        $this->call(ProgramCoursesSeeder::class);
//        $this->call(CurriculumReviewSeeder::class);
//        $this->call(ProgramObjectivesSeeder::class);
//        $this->call(ProgramLearningOutcomesSeeder::class);
//        $this->call(MappingPO_PLOSeeder::class);
//        $this->call(CulturalMaterialSeeder::class);
//        $this->call(ManagerialSkillsSeeder::class);
        $this->call(TeachingMethodsSeeder::class);
//        $this->call(DeliveryMethodsSeeder::class);
        $this->call(EvaluationItemsSeeder::class);
        $this->call(EvaluationMethodsSeeder::class);
//        $this->call(PlagiarismCasesSeeder::class);
//        $this->call(FacultySummarySeeder::class);
//        $this->call(FacultyTeachingCoursesSeeder::class);
//        $this->call(FacultyWorkshopsSeeder::class);
//        $this->call(FacultyConsultancyProjectsSeeder::class);
//        $this->call(FacultyParticipationsSeeder::class);
//        $this->call(FacultyMembershipsSeeder::class);
//        $this->call(InternationalFacultiesSeeder::class);
//        $this->call(FacultyExposuresSeeder::class);
//        $this->call(FacultyDetailedInfosSeeder::class);
        $this->call(NbeacBasicInfoSeeder::class);
        $this->call(SpecializationSeeder::class);
        $this->call(AcademyLevelSeeder::class);
        $this->call(AcademyTypeSeeder::class);
    }
}
