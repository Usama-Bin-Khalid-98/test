<?php

namespace App\Http\Controllers;
use App\BusinessSchool;
use App\Models\Common\Campus;
use App\Models\StrategicManagement\Scope;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class PrintController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    public function index()
    {
        
        $bussinessSchool  = DB::table('users')
            ->leftJoin('business_schools', 'users.business_school_id', '=', 'business_schools.id')
            ->leftJoin('institute_types','business_schools.institute_type_id','=','institute_types.id')
            ->leftJoin('charter_types','business_schools.charter_type_id','=','charter_types.id')
            ->leftJoin('designations','business_schools.cao_id','=','designations.id')
            ->where('users.id',auth()->user()->id)
            ->select('business_schools.*','institute_types.name as typeName', 'charter_types.name as charterName', 'designations.name as designationName' )
            ->get();

        $campuses = Campus::where('business_school_id', $bussinessSchool[0]->id)->get();
        $userCampus = DB::select('SELECT * from users where id=?', array(auth()->user()->id));


        $scopeOfAcredation = DB::table('scopes')
        ->leftJoin('programs','scopes.program_id','=','programs.id')
        ->leftJoin('levels','scopes.level_id','=','levels.id')
        ->select('scopes.*','levels.name as levelName', 'programs.name as programName')
        ->where('scopes.campus_id',$bussinessSchool[0]->id)
        ->get();


        $contactInformation = DB::select('SELECT contact_infos.*, designations.name as designationName FROM contact_infos, designations, campuses, users WHERE contact_infos.designation_id=designations.id AND campuses.id=? AND users.id=?', array(auth()->user()->campus_id, auth()->user()->id));


        $statutoryCommitties = DB::select('SELECT statutory_committees.*,statutory_bodies.name as statutoryName, designations.name as designationName from statutory_committees, statutory_bodies, business_schools, designations WHERE statutory_committees.statutory_body_id=statutory_bodies.id AND statutory_committees.designation_id=designations.id AND business_schools.id=? AND statutory_committees.campus_id=?', array($bussinessSchool[0]->id, auth()->user()->campus_id));


         $affiliations = DB::select('SELECT affiliations.*, statutory_bodies.name as statutoryBody, designations.name as designationName
            FROM affiliations, statutory_bodies, business_schools, designations
            WHERE  affiliations.statutory_bodies_id=statutory_bodies.id AND affiliations.designation_id=designations.id AND business_schools.id=?', array($bussinessSchool[0]->id));


         $budgetoryInfo = DB::select(' SELECT budgetary_infos.* from budgetary_infos, business_schools WHERE business_schools.id=?', array($bussinessSchool[0]->id));


          $sourceOfFunding = DB::select('SELECT financial_infos.*, income_sources.particular as incomeSource FROM financial_infos, income_sources, business_schools WHERE financial_infos.income_source_id=income_sources.id AND business_schools.id=financial_infos.campus_id AND business_schools.id=?', array($bussinessSchool[0]->id));


         $strategicPlans = DB::select(' SELECT strategic_plans.* from strategic_plans, business_schools WHERE business_schools.id=?', array($bussinessSchool[0]->id));

         $programsPortfolio = DB::select('SELECT program_portfolios.*, programs.name as programName, course_types.name as courseType
            FROM program_portfolios, programs, course_types, business_schools
            WHERE program_portfolios.program_id=programs.id AND program_portfolios.course_type_id=course_types.id AND business_schools.id=?', array($bussinessSchool[0]->id));

         $studentEnrolment = DB::select('SELECT student_enrolments.*
            FROM student_enrolments , business_schools
            WHERE business_schools.id=?', array($bussinessSchool[0]->id));

         $studentsEnrolment = DB::select('SELECT student_enrolments.* FROM student_enrolments, campuses WHERE student_enrolments.campus_id=campuses.id AND campuses.id=? AND student_enrolments.year>YEAR(CURDATE())-3', array($userCampus[0]->campus_id));


         /*$facultyWorkLoad = DB::select('SELECT work_loads.*, designations.name as designationName FROM work_loads, designations, campuses, users WHERE work_loads.campus_id=campuses.id AND work_loads.designation_id=designations.id AND users.id=? AND work_loads.campus_id=?', array(auth()->user()->id,auth()->user()->campus_id));*/

         $now = Carbon::now();
        
        $currMonth = $now->month;
        $currSemester = "";
        $prevSemester = "";
        if($currMonth>8 && $currMonth<2){
            $currSemester = "Fall t";
            $prevSemester = "Spring t";
        }else if($currMonth>2 && $currMonth<9){
            $currSemester = "Spring t";
            $prevSemester = "Fall t-1";
        }
         $facultyWorkLoad = DB::select('SELECT work_loads.*, designations.name as designationName FROM work_loads, designations, campuses,users, semesters WHERE work_loads.semester_id=semesters.id AND work_loads.designation_id=designations.id AND work_loads.campus_id=? AND campuses.id=work_loads.campus_id AND users.department_id=? AND semesters.name=?', array($userCampus[0]->campus_id, $userCampus[0]->department_id, $currSemester));

         $facultyWorkLoadb = DB::select('SELECT work_loads.*, designations.name as designationName FROM work_loads, designations, campuses,semesters WHERE work_loads.semester_id=semesters.id AND work_loads.designation_id=designations.id AND work_loads.campus_id=? AND campuses.id=work_loads.campus_id  AND semesters.name=?', array($userCampus[0]->campus_id, $prevSemester));

         $facultyGenders = DB::select('SELECT faculty_genders.*, lookup_faculty_types.faculty_type as facultyTypeName FROM faculty_genders, lookup_faculty_types, campuses, users WHERE faculty_genders.campus_id=campuses.id AND faculty_genders.lookup_faculty_type_id=lookup_faculty_types.id AND users.id=? AND faculty_genders.campus_id=? AND users.department_id=?', array(auth()->user()->id, $userCampus[0]->campus_id, $userCampus[0]->department_id));

          $placementOffices = DB::select('SELECT placement_offices.* FROM placement_offices, campuses, users WHERE placement_offices.campus_id=campuses.id AND placement_offices.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id, auth()->user()->id));

           $linkages = DB::select('SELECT linkages.* FROM linkages, campuses, users WHERE linkages.campus_id=campuses.id AND linkages.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id, auth()->user()->id));

            $statutoryBodyMeetings = DB::select('SELECT body_meetings.*, designations.name as designation, statutory_bodies.name as statutoryBody FROM body_meetings, designations, statutory_bodies, campuses, users WHERE body_meetings.campus_id=campuses.id AND body_meetings.designation_id=designations.id AND body_meetings.statutory_bodies_id=statutory_bodies.id AND body_meetings.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id, auth()->user()->id));

            $studentsExchangePrograms = DB::select('SELECT student_exchanges.* FROM student_exchanges, campuses, users WHERE student_exchanges.campus_id=campuses.id AND student_exchanges.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id, auth()->user()->id));

            $facultyExchangePrograms = DB::select('SELECT faculty_exchanges.* FROM faculty_exchanges, campuses, users WHERE faculty_exchanges.campus_id=campuses.id AND faculty_exchanges.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id, auth()->user()->id));

            $placementActivities = DB::select('SELECT placement_activities.* FROM placement_activities, campuses, users WHERE placement_activities.campus_id=campuses.id AND placement_activities.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id, auth()->user()->id));

            $entryRequirements = DB::select('SELECT entry_requirements.*, programs.name as program, eligibility_criterias.name as eligibilityCriteria FROM entry_requirements, programs, eligibility_criterias, campuses, users WHERE entry_requirements.campus_id=campuses.id AND entry_requirements.program_id=programs.id AND entry_requirements.eligibility_criteria_id=eligibility_criterias.id AND entry_requirements.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id, auth()->user()->id));


            $applicationsReceived = DB::select('SELECT application_receiveds.*, programs.name as program, semesters.name as semester FROM application_receiveds, programs, semesters, campuses, users WHERE application_receiveds.campus_id=campuses.id AND application_receiveds.program_id=programs.id AND application_receiveds.semester_id=semesters.id AND application_receiveds.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id, auth()->user()->id));

            $orics = DB::select('SELECT orics.* FROM orics, campuses, users WHERE orics.campus_id=campuses.id AND campuses.id=? AND users.id=?', array( $userCampus[0]->campus_id, auth()->user()->id));

            $admissionOffices = DB::select('SELECT admission_offices.* FROM admission_offices, campuses, users WHERE admission_offices.campus_id=campuses.id AND admission_offices.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id, auth()->user()->id));

            $researchCenters = DB::select('SELECT research_centers.* FROM research_centers, campuses, users WHERE research_centers.campus_id=campuses.id AND research_centers.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id, auth()->user()->id));

            $researchAgendas = DB::select('SELECT research_agendas.* FROM research_agendas, campuses, users WHERE research_agendas.campus_id=campuses.id AND research_agendas.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id, auth()->user()->id));


             $researchFundings = DB::select('SELECT research_fundings.* FROM research_fundings, campuses, users WHERE research_fundings.campus_id=campuses.id AND research_fundings.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id, auth()->user()->id));

             $researchProjects = DB::select('SELECT research_projects.* FROM research_projects, campuses, users WHERE research_projects.campus_id=campuses.id AND research_projects.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id, auth()->user()->id));

             $researchOutput = DB::select('SELECT research_summaries.*, publication_types.name as publicationName, publication_categories.name as publicationType FROM publication_categories,research_summaries, publication_types, campuses, users WHERE research_summaries.campus_id=campuses.id AND publication_categories.id=publication_types.publication_category_id AND research_summaries.publication_type_id=publication_types.id AND users.id=? AND users.department_id=? AND research_summaries.campus_id=? ORDER BY publication_categories.name', array(auth()->user()->id, $userCampus[0]->department_id, $userCampus[0]->campus_id ));


             $topTenResearchOutput = DB::select('SELECT research_outputs.* FROM research_outputs, campuses, users WHERE research_outputs.campus_id=campuses.id AND research_outputs.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));


             $curriculumRoles = DB::select('SELECT curriculum_roles.* FROM curriculum_roles, campuses, users WHERE curriculum_roles.campus_id=campuses.id AND curriculum_roles.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $facultyDevelopments = DB::select('SELECT faculty_developments.* FROM faculty_developments, campuses, users WHERE faculty_developments.campus_id=campuses.id AND faculty_developments.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $conferences = DB::select('SELECT conferences.* FROM conferences, campuses, users WHERE conferences.campus_id=campuses.id AND conferences.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $financialInfos = DB::select('SELECT financial_infos.*, income_sources.particular as particularName, income_sources.type as particularType FROM financial_infos, income_sources, campuses, users WHERE financial_infos.campus_id=campuses.id AND financial_infos.income_source_id=income_sources.id AND financial_infos.campus_id=? AND users.id=? ORDER BY income_sources.type', array( $userCampus[0]->campus_id, auth()->user()->id));

             $financialRisks = DB::select('SELECT financial_risks.* FROM financial_risks, campuses, users WHERE financial_risks.campus_id=campuses.id AND financial_risks.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $supportStaff = DB::select('SELECT support_staff.*, staff_categories.name as staffCategory FROM support_staff, staff_categories, campuses, users WHERE support_staff.campus_id=campuses.id AND support_staff.staff_category_id=staff_categories.id AND support_staff.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));


             $qecInformation = DB::select('SELECT qec_infos.*, qec_types.name as qecName FROM qec_infos, qec_types, campuses, users WHERE qec_infos.campus_id=campuses.id AND qec_infos.qec_type_id=qec_types.id AND qec_infos.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $BIResources = DB::select('SELECT business_school_facilities.*, facilities.name as facilityName, facility_types.name as facilityType FROM business_school_facilities, facilities, facility_types, users, campuses WHERE business_school_facilities.campus_id=campuses.id AND business_school_facilities.facility_id=facilities.id AND users.id=? AND business_school_facilities.campus_id=? AND facilities.facility_type_id=facility_types.id ORDER BY facility_types.name', array(auth()->user()->id, $userCampus[0]->campus_id));

             $studentsClubs = DB::select('SELECT student_clubs.* FROM student_clubs, campuses, users WHERE student_clubs.campus_id=campuses.id AND student_clubs.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $projectDetails = DB::select('SELECT project_details.* FROM project_details, campuses, users WHERE project_details.campus_id=campuses.id AND project_details.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $environmentalProtectionActivities = DB::select('SELECT env_protections.* FROM env_protections, campuses, users WHERE env_protections.campus_id=campuses.id AND env_protections.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $formalRelationships = DB::select('SELECT formal_relationships.* FROM formal_relationships, campuses, users WHERE formal_relationships.campus_id=campuses.id AND formal_relationships.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $complaintResolution = DB::select('SELECT complaint_resolutions.* FROM complaint_resolutions, campuses, users WHERE complaint_resolutions.campus_id=campuses.id AND complaint_resolutions.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));


              $internalCommunityWelfareProgram = DB::select('SELECT internal_communities.*, welfare_programs.name as welfareProgram FROM internal_communities, welfare_programs, campuses, users WHERE internal_communities.campus_id=campuses.id AND internal_communities.welfare_program_id=welfare_programs.id AND internal_communities.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));

              $studentsIntake = DB::select('SELECT student_intakes.* FROM student_intakes, campuses, users WHERE student_intakes.campus_id=campuses.id AND campuses.id=? AND users.id=? AND student_intakes.year>YEAR(CURDATE())-3', array( $userCampus[0]->campus_id,auth()->user()->id ));

              $classSize = DB::select("SELECT SUM( CASE
            WHEN class_sizes.semesters_id='1' || class_sizes.semesters_id='3' || class_sizes.semesters_id='5' || class_sizes.semesters_id='7' || class_sizes.semesters_id='9' || class_sizes.semesters_id='11' THEN class_sizes.program_a
            ELSE 0
        END) AS fallA,
        SUM( CASE
            WHEN class_sizes.semesters_id='2' || class_sizes.semesters_id='4' || class_sizes.semesters_id='6' || class_sizes.semesters_id='8' || class_sizes.semesters_id='10' || class_sizes.semesters_id='12' THEN class_sizes.program_a
            ELSE 0
        END) AS springA,
        SUM( CASE
            WHEN class_sizes.semesters_id='1' || class_sizes.semesters_id='3' || class_sizes.semesters_id='5' || class_sizes.semesters_id='7' || class_sizes.semesters_id='9' || class_sizes.semesters_id='11' THEN class_sizes.program_b
            ELSE 0
        END) AS fallB,
        SUM( CASE
            WHEN class_sizes.semesters_id='2' || class_sizes.semesters_id='4' || class_sizes.semesters_id='6' || class_sizes.semesters_id='8' || class_sizes.semesters_id='10' || class_sizes.semesters_id='12' THEN class_sizes.program_b
            ELSE 0
        END) AS springB
        FROM class_sizes, campuses, users WHERE class_sizes.campus_id=campuses.id AND class_sizes.campus_id=? AND users.id=?", array( $userCampus[0]->campus_id,auth()->user()->id ));


              $dropoutPercentage = DB::select('SELECT dropout_percentages.*, programs.name as program FROM dropout_percentages, programs, campuses, users WHERE dropout_percentages.campus_id=campuses.id AND dropout_percentages.program_id=programs.id AND dropout_percentages.campus_id=? AND users.id=? ORDER BY dropout_percentages.program_id ', array( $userCampus[0]->campus_id,auth()->user()->id ));


              $studentsFinancial = DB::select('SELECT student_financials.*, programs.name as program FROM student_financials, programs, users, campuses WHERE student_financials.campus_id=campuses.id AND student_financials.program_id=programs.id AND student_financials.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));


              $personalGroomings = DB::select('SELECT personal_groomings.* FROM personal_groomings, campuses, users WHERE personal_groomings.campus_id=campuses.id AND personal_groomings.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));


               $counselingActivities = DB::select('SELECT counselling_activities.* FROM counselling_activities, users, campuses WHERE counselling_activities.campus_id=campuses.id AND counselling_activities.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $extraActivities = DB::select('SELECT extra_activities.* FROM extra_activities, users, campuses WHERE extra_activities.campus_id=campuses.id AND extra_activities.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $alumniMembership = DB::select('SELECT alumni_memberships.* FROM alumni_memberships, users, campuses WHERE alumni_memberships.campus_id=campuses.id AND alumni_memberships.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));


               $alumniParticipation = DB::select('SELECT alumni_participations.*, activity_engagements.name as activity FROM alumni_participations, activity_engagements, campuses, users WHERE alumni_participations.campus_id=campuses.id AND alumni_participations.activity_engagements_id=activity_engagements.id AND alumni_participations.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));


               $programCourses = DB::select('SELECT program_courses.*, programs.name as program, course_types.name as courseTypeName FROM program_courses, programs, course_types, campuses, users WHERE program_courses.program_id=programs.id AND program_courses.course_type_id=course_types.id AND program_courses.campus_id=campuses.id AND program_courses.campus_id=? AND users.id=? ORDER BY course_types.name', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $curriculumReviews = DB::select('SELECT curriculum_reviews.*, designations.name as designation, affiliations.name as affiliation FROM curriculum_reviews, campuses, users, designations, affiliations WHERE curriculum_reviews.campus_id=campuses.id AND curriculum_reviews.designation_id=designations.id AND curriculum_reviews.affiliations_id=affiliations.id AND curriculum_reviews.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));


               $programObjectives = DB::select('SELECT program_objectives.*, programs.name as program FROM program_objectives, programs, campuses, users WHERE program_objectives.program_id=programs.id AND program_objectives.campus_id=campuses.id AND program_objectives.campus_id=? AND users.id=? ', array( $userCampus[0]->campus_id,auth()->user()->id ));


               $programLearningOutcomes = DB::select('SELECT learning_outcomes.*, programs.name as program FROM learning_outcomes, programs, campuses, users WHERE learning_outcomes.program_id=programs.id AND learning_outcomes.campus_id=campuses.id AND learning_outcomes.campus_id=? AND users.id=? ', array( $userCampus[0]->campus_id,auth()->user()->id ));


               $cultralMaterial = DB::select('SELECT cultural_materials.* FROM cultural_materials, campuses, users WHERE cultural_materials.campus_id=campuses.id AND cultural_materials.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));


               $managerialSkills = DB::select('SELECT managerial_skills.* FROM managerial_skills, campuses, users WHERE managerial_skills.campus_id=campuses.id AND managerial_skills.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $programDeliveryMethods = DB::select('SELECT program_delivery_methods.*, teaching_methods.name as teachingMethod FROM program_delivery_methods, teaching_methods, users , campuses WHERE program_delivery_methods.teaching_methods_id=teaching_methods.id AND program_delivery_methods.campus_id=campuses.id AND program_delivery_methods.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $evaluationMethods = DB::select('SELECT evaluation_methods.*, evaluation_items.name as evaluationItem FROM evaluation_methods, evaluation_items, users , campuses WHERE evaluation_methods.evaluation_items_id=evaluation_items.id AND evaluation_methods.campus_id=campuses.id AND evaluation_methods.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $plagiarismCases = DB::select('SELECT plagiarism_cases.* FROM plagiarism_cases, campuses, users WHERE plagiarism_cases.campus_id=campuses.id AND plagiarism_cases.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));

           
            return view('strategic_management.printAll', compact('classSize','studentsFinancial','programCourses','extraActivities','plagiarismCases','cultralMaterial','programLearningOutcomes','programObjectives','evaluationMethods','programDeliveryMethods','managerialSkills','curriculumReviews','counselingActivities','personalGroomings','alumniMembership','alumniParticipation','dropoutPercentage','bussinessSchool','campuses','scopeOfAcredation', 'contactInformation','statutoryCommitties','affiliations','budgetoryInfo', 'sourceOfFunding', 'strategicPlans', 'programsPortfolio','studentEnrolment','studentsEnrolment','facultyWorkLoad','facultyWorkLoadb','facultyGenders','placementOffices','linkages','statutoryBodyMeetings','studentsExchangePrograms','facultyExchangePrograms','placementActivities','entryRequirements','applicationsReceived','orics','admissionOffices','researchCenters','researchAgendas','researchFundings','researchProjects','researchOutput','topTenResearchOutput','curriculumRoles','facultyDevelopments','conferences','financialInfos','financialRisks','supportStaff','qecInformation','BIResources','studentsClubs','projectDetails','environmentalProtectionActivities','formalRelationships','complaintResolution','internalCommunityWelfareProgram','studentsIntake'));
    }

     public static function getfacultySummary($i, $facultySummary, $userCampus){
        //dd($facultySummary[$i]->id);
        
            $facultySummary12 = DB::select('SELECT faculty_summaries.*, disciplines.name as disciplineName FROM faculty_summaries, disciplines,users WHERE faculty_summaries.discipline_id=disciplines.id AND faculty_summaries.faculty_qualification_id=? AND faculty_summaries.campus_id=?', array($facultySummary[$i]->id,auth()->user()->campus_id));
            return $facultySummary12;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
