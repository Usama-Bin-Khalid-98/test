<?php

namespace App\Http\Controllers;
use App\Models\Carriculum\CurriculumReview;
use App\Models\Common\Slip;
use App\Models\Config\NbeacBasicInfo;
use App\Models\MentoringMentor;
use App\Models\StrategicManagement\SummarizePolicy;
use App\User;
use App\BusinessSchool;
use App\ClassSize;
use App\FinancialAssistance;
use App\Models\Carriculum\AlignedProgram;
use App\Models\Carriculum\ChecklistDocument;
use App\Models\Carriculum\CourseDetail;
use App\Models\Carriculum\MappingPos;
use App\Models\Common\Campus;
use App\Models\Common\StrategicManagement\BusinessSchoolTyear;
use App\Models\External_Linkages\ObtainedInternship;
use App\Models\Facility\IncomeSource;
use App\Models\Faculty\FacultyStudentRatio;
use App\Models\Faculty\FacultyTeachingCources;
use App\Models\Faculty\WorkLoad;
use App\Models\StrategicManagement\MissionVision;
use App\Models\StrategicManagement\Scope;
use App\Models\StrategicManagement\SourcesFunding;
use App\StudentParticipation;
use App\WeakStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class PrintController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }

    protected function isRegCompleted()
    {


    }
    public function index(Request $req)
    {

        if(isset($req->cid) && isset($req->bid)){
            /////////////////header data ////////
            $docHeaderData = Slip::with('campus', 'department')
                ->where(
                    [
                        'business_school_id'=>$req->cid,
                        'department_id'=>@$req->did
                    ]
                )->get()->first();
            $programsUnderReview = Scope::with('program')->where(
                ['campus_id'=>$req->cid, 'department_id' => @$req->did])
                ->get();
            $user = User::with('designation')->where(['business_school_id' => $req->bid, 'campus_id' => $req->cid, 'department_id' => $req->did])->first();
            $bussinessSchool  = DB::table('users')
            ->leftJoin('business_schools', 'users.business_school_id', '=', 'business_schools.id')
            ->leftJoin('institute_types','business_schools.institute_type_id','=','institute_types.id')
            ->leftJoin('charter_types','business_schools.charter_type_id','=','charter_types.id')
            ->leftJoin('designations','business_schools.cao_id','=','designations.id')
            ->where('users.id',$user->id)
            ->select('business_schools.*','institute_types.name as typeName', 'charter_types.name as charterName', 'designations.name as designationName' )
            ->get();
        $campuses = Campus::where('business_school_id', $req->bid)->get();
        $userCampus = DB::select('SELECT * from users where id=?', array(auth()->user()->id));

        $scopeOfAcredation = DB::select('SELECT scopes.*, programs.name as programName, levels.name as levelName FROM scopes, programs, levels, campuses WHERE scopes.campus_id=campuses.id AND scopes.program_id=programs.id AND scopes.level_id=levels.id AND scopes.campus_id=? AND scopes.deleted_at IS NULL', array($req->cid));

        $contactInformation = DB::select('SELECT contact_infos.*, designations.name as designationName, designations.id as designationId FROM designations, contact_infos, campuses WHERE designations.id=contact_infos.designation_id AND contact_infos.campus_id=? AND contact_infos.campus_id=campuses.id AND contact_infos.deleted_at IS NULL', array($req->cid));

        $statutoryCommitties = DB::select('SELECT statutory_committees.*,statutory_bodies.name as statutoryName, designations.name as designationName from statutory_committees, statutory_bodies, business_schools, designations WHERE statutory_committees.statutory_body_id=statutory_bodies.id AND statutory_committees.designation_id=designations.id AND business_schools.id=? AND statutory_committees.campus_id=? AND statutory_committees.deleted_at IS NULL', array($req->bid, $req->cid));

         $affiliations = DB::select('SELECT affiliations.*, statutory_bodies.name as statutoryBody, designations.name as designationName
            FROM affiliations, statutory_bodies, business_schools, designations
            WHERE  affiliations.statutory_bodies_id=statutory_bodies.id AND business_schools.id=? AND affiliations.campus_id=? AND affiliations.deleted_at IS NULL AND affiliations.designation_id=designations.id', array($req->bid, $req->cid));

         $budgetoryInfo = DB::select(' SELECT budgetary_infos.* from budgetary_infos, business_schools, campuses WHERE business_schools.id=? AND budgetary_infos.campus_id=campuses.id AND budgetary_infos.campus_id=? AND budgetary_infos.deleted_at IS NULL', array($req->bid, $req->cid));

         $sourceOfFunding = SourcesFunding::with('funding_sources')->where(['campus_id' => $req->cid])->get();
         $summary_policy = SummarizePolicy::where(['campus_id' => $req->cid, 'status'=> 'active'])->first();

         $strategicPlans = DB::select(' SELECT strategic_plans.* from strategic_plans, campuses WHERE strategic_plans.campus_id=campuses.id AND strategic_plans.campus_id=? AND strategic_plans.deleted_at IS NULL', array($req->cid));

         $programsPortfolio = DB::select('SELECT program_portfolios.*, programs.name as programName, course_types.name as courseType
            FROM program_portfolios, programs, course_types, business_schools
            WHERE program_portfolios.program_id=programs.id AND program_portfolios.course_type_id=course_types.id AND business_schools.id=? AND program_portfolios.campus_id=? AND program_portfolios.deleted_at IS NULL', array($req->bid, $req->cid));

         $studentEnrolment = DB::select('SELECT student_enrolments.*
            FROM student_enrolments , business_schools
            WHERE business_schools.id=? AND student_enrolments.campus_id=? AND student_enrolments.deleted_at IS NULL', array($req->bid, $req->cid));

         $studentsEnrolment = DB::select('SELECT student_enrolments.* FROM student_enrolments, campuses WHERE student_enrolments.campus_id=campuses.id AND campuses.id=? AND student_enrolments.year>YEAR(CURDATE())-3 AND student_enrolments.deleted_at IS NULL', array($req->cid));

         /*$facultyWorkLoad = DB::select('SELECT work_loads.*, designations.name as designationName FROM work_loads, designations, campuses, users WHERE work_loads.campus_id=campuses.id AND work_loads.designation_id=designations.id AND users.id=? AND work_loads.campus_id=?', array(auth()->user()->id,auth()->user()->campus_id));*/

         $now = Carbon::now();

        $currMonth = $now->month;
        $currSemester = "";
        $prevSemester = "";
        if($currMonth>8 && $currMonth<=2){
            $currSemester = "Fall t";
            $prevSemester = "Spring t";
        }else if($currMonth>2 && $currMonth<=9){
            $currSemester = "Spring t";
            $prevSemester = "Fall t-1";
        }
        $getYear = BusinessSchoolTyear::where(['campus_id' => $req->cid, 'department_id' => $req->did])->first();
        $facultyWorkLoad = WorkLoad::with('designation')->where(['campus_id' => $req->cid, 'department_id' => $req->did, 'year_t' => $getYear->tyear])->get()->map(function ($workLoad) {
            $workLoad->designationName = $workLoad->designation->name;
            unset($workLoad->designation);
            return $workLoad;
        });
        $facultyWorkLoadb = WorkLoad::with('designation')->where(['campus_id' => $req->cid, 'department_id' => $req->did, 'year_t' => $getYear->year_t_1])->get()->map(function ($workLoad) {
            $workLoad->designationName = $workLoad->designation->name;
            unset($workLoad->designation);
            return $workLoad;
        });

         $facultyGenders = DB::select('SELECT faculty_genders.*, lookup_faculty_types.faculty_type as facultyTypeName FROM faculty_genders, lookup_faculty_types, campuses WHERE faculty_genders.campus_id=campuses.id AND faculty_genders.lookup_faculty_type_id=lookup_faculty_types.id  AND faculty_genders.campus_id=? AND faculty_genders.deleted_at IS NULL ', array($req->cid));

          $placementOffices = DB::select('SELECT placement_offices.* FROM placement_offices, campuses WHERE placement_offices.campus_id=campuses.id AND placement_offices.campus_id=? AND placement_offices.deleted_at IS NULL ', array( $req->cid));

           $linkages = DB::select('SELECT linkages.* FROM linkages, campuses WHERE linkages.campus_id=campuses.id AND linkages.campus_id=? AND linkages.deleted_at IS NULL ', array($req->cid));

            $statutoryBodyMeetings = DB::select('SELECT body_meetings.*, designations.name as designation, statutory_bodies.name as statutoryBody FROM body_meetings, designations, statutory_bodies, campuses WHERE body_meetings.campus_id=campuses.id AND body_meetings.designation_id=designations.id AND body_meetings.statutory_bodies_id=statutory_bodies.id AND body_meetings.campus_id=? AND body_meetings.deleted_at IS NULL', array($req->cid));

            $studentsExchangePrograms = DB::select('SELECT student_exchanges.* FROM student_exchanges, campuses WHERE student_exchanges.campus_id=campuses.id AND student_exchanges.campus_id=? AND student_exchanges.deleted_at IS NULL ', array($req->cid));

            $facultyExchangePrograms = DB::select('SELECT faculty_exchanges.* FROM faculty_exchanges, campuses WHERE faculty_exchanges.campus_id=campuses.id AND faculty_exchanges.campus_id=? AND faculty_exchanges.deleted_at IS NULL ', array( $req->cid));

            $placementActivities = DB::select('SELECT placement_activities.* FROM placement_activities, campuses WHERE placement_activities.campus_id=campuses.id AND placement_activities.campus_id=? AND placement_activities.deleted_at IS NULL', array($req->cid));

            $entryRequirements = DB::select('SELECT entry_requirements.*, programs.name as program, eligibility_criterias.name as eligibilityCriteria FROM entry_requirements, programs, eligibility_criterias, campuses WHERE entry_requirements.campus_id=campuses.id AND entry_requirements.program_id=programs.id AND entry_requirements.eligibility_criteria_id=eligibility_criterias.id AND entry_requirements.campus_id=? AND entry_requirements.deleted_at IS NULL', array($req->cid));

            $applicationsReceived = DB::select('SELECT application_receiveds.*, programs.name as program FROM application_receiveds, programs, semesters, campuses WHERE application_receiveds.campus_id=campuses.id AND application_receiveds.program_id=programs.id AND application_receiveds.campus_id=? AND application_receiveds.deleted_at IS NULL', array($req->cid));

            $orics = DB::select('SELECT orics.* FROM orics, campuses WHERE orics.campus_id=campuses.id AND campuses.id=? AND orics.deleted_at IS NULL', array( $req->cid));

            $admissionOffices = DB::select('SELECT admission_offices.* FROM admission_offices, campuses WHERE admission_offices.campus_id=campuses.id AND admission_offices.campus_id=? AND admission_offices.deleted_at IS NULL ', array($req->cid));

            $researchCenters = DB::select('SELECT research_centers.* FROM research_centers, campuses WHERE research_centers.campus_id=campuses.id AND research_centers.campus_id=? AND research_centers.deleted_at IS NULL ', array($req->cid));

            $researchAgendas = DB::select('SELECT research_agendas.* FROM research_agendas, campuses WHERE research_agendas.campus_id=campuses.id AND research_agendas.campus_id=? AND research_agendas.deleted_at IS NULL', array($req->cid));

             $researchFundings = DB::select('SELECT research_fundings.* FROM research_fundings, campuses WHERE research_fundings.campus_id=campuses.id AND research_fundings.campus_id=? AND research_fundings.deleted_at IS NULL', array($req->cid));

             $researchProjects = DB::select('SELECT research_projects.* FROM research_projects, campuses WHERE research_projects.campus_id=campuses.id AND research_projects.campus_id=? AND research_projects.deleted_at IS NULL', array($req->cid));

             $researchOutput = DB::select('SELECT research_summaries.*, publication_types.name as publicationName,
publication_categories.name as publicationType
FROM publication_categories,research_summaries, publication_types, campuses
WHERE research_summaries.campus_id=campuses.id
AND publication_categories.id=publication_types.publication_category_id
AND research_summaries.publication_type_id=publication_types.id
AND research_summaries.campus_id=? AND research_summaries.deleted_at IS NULL ORDER BY publication_categories.name', array($req->cid));

             $topTenResearchOutput = DB::select('SELECT research_outputs.* FROM research_outputs, campuses WHERE research_outputs.campus_id=campuses.id AND research_outputs.campus_id=? AND research_outputs.deleted_at IS NULL', array($req->cid));

             $curriculumRoles = DB::select('SELECT curriculum_roles.* FROM curriculum_roles, campuses WHERE curriculum_roles.campus_id=campuses.id AND curriculum_roles.campus_id=? AND curriculum_roles.deleted_at IS NULL', array($req->cid));

             $facultyDevelopments = DB::select('SELECT faculty_developments.* FROM faculty_developments, campuses WHERE faculty_developments.campus_id=campuses.id AND faculty_developments.campus_id=? AND faculty_developments.deleted_at IS NULL', array($req->cid));

             $conferences = DB::select('SELECT conferences.* FROM conferences, campuses WHERE conferences.campus_id=campuses.id AND conferences.campus_id=? AND conferences.deleted_at IS NULL', array($req->cid));

             $financialInfos = DB::select('SELECT financial_infos.*, income_sources.particular as particularName, income_sources.type as particularType FROM financial_infos, income_sources, campuses WHERE financial_infos.campus_id=campuses.id AND financial_infos.income_source_id=income_sources.id AND financial_infos.campus_id=? AND financial_infos.deleted_at IS NULL  ORDER BY income_sources.type', array($req->cid));

             $financialRisks = DB::select('SELECT financial_risks.* FROM financial_risks, campuses WHERE financial_risks.campus_id=campuses.id AND financial_risks.campus_id=? AND financial_risks.deleted_at IS NULL', array($req->cid));

             $supportStaff = DB::select('SELECT support_staff.*, staff_categories.name as staffCategory FROM support_staff, staff_categories, campuses WHERE support_staff.campus_id=campuses.id AND support_staff.staff_category_id=staff_categories.id AND support_staff.campus_id=? AND support_staff.deleted_at IS NULL ', array($req->cid));

             $qecInformation = DB::select('SELECT qec_infos.*, qec_types.name as qecName FROM qec_infos, qec_types, campuses WHERE qec_infos.campus_id=campuses.id AND qec_infos.qec_type_id=qec_types.id AND qec_infos.campus_id=? AND qec_infos.deleted_at IS NULL', array($req->cid));

             $BIResources = DB::select('SELECT business_school_facilities.*, facilities.name as facilityName,
facility_types.name as facilityType FROM business_school_facilities, facilities, facility_types, campuses
WHERE business_school_facilities.campus_id=campuses.id
AND business_school_facilities.facility_id=facilities.id  AND business_school_facilities.campus_id=?
AND facilities.facility_type_id=facility_types.id AND business_school_facilities.deleted_at IS NULL ORDER BY facility_types.name', array($req->cid));

             $studentsClubs = DB::select('SELECT student_clubs.* FROM student_clubs, campuses WHERE student_clubs.campus_id=campuses.id AND student_clubs.campus_id=? AND student_clubs.deleted_at IS NULL', array($req->cid));

             $projectDetails = DB::select('SELECT project_details.* FROM project_details, campuses WHERE project_details.campus_id=campuses.id AND project_details.campus_id=? AND project_details.deleted_at IS NULL', array($req->cid));

             $environmentalProtectionActivities = DB::select('SELECT env_protections.* FROM env_protections, campuses WHERE env_protections.campus_id=campuses.id AND env_protections.campus_id=? AND env_protections.deleted_at IS NULL', array($req->cid));

             $formalRelationships = DB::select('SELECT formal_relationships.* FROM formal_relationships, campuses WHERE formal_relationships.campus_id=campuses.id AND formal_relationships.campus_id=? AND formal_relationships.deleted_at IS NULL', array($req->cid));

             $complaintResolution = DB::select('SELECT complaint_resolutions.* FROM complaint_resolutions, campuses WHERE complaint_resolutions.campus_id=campuses.id AND complaint_resolutions.campus_id=? AND complaint_resolutions.deleted_at IS NULL', array($req->cid));

              $internalCommunityWelfareProgram = DB::select('SELECT internal_communities.*, welfare_programs.name as welfareProgram FROM internal_communities, welfare_programs, campuses WHERE internal_communities.campus_id=campuses.id AND internal_communities.welfare_program_id=welfare_programs.id AND internal_communities.campus_id=? AND internal_communities.deleted_at IS NULL', array($req->cid));

              $studentsIntake = DB::select('SELECT student_intakes.* FROM student_intakes, campuses WHERE student_intakes.campus_id=campuses.id AND campuses.id=?  AND student_intakes.year>YEAR(CURDATE())-3 AND student_intakes.deleted_at IS NULL', array($req->cid));

              $classSize = $this->getClassSizeMapping($req->cid, $req->did);

              $dropoutPercentage = DB::select('SELECT dropout_percentages.*, programs.name as program FROM dropout_percentages, programs, campuses WHERE dropout_percentages.campus_id=campuses.id AND dropout_percentages.program_id=programs.id AND dropout_percentages.campus_id=? ORDER BY dropout_percentages.program_id  AND dropout_percentages.deleted_at IS NULL', array($req->cid));

              $studentsFinancial = DB::select('SELECT student_financials.*, programs.name as program FROM student_financials, programs, campuses WHERE student_financials.campus_id=campuses.id AND student_financials.program_id=programs.id AND student_financials.campus_id=? AND student_financials.deleted_at IS NULL', array($req->cid));

              $personalGroomings = DB::select('SELECT personal_groomings.* FROM personal_groomings, campuses WHERE personal_groomings.campus_id=campuses.id AND personal_groomings.campus_id=? AND personal_groomings.deleted_at IS NULL', array($req->cid));

               $counselingActivities = DB::select('SELECT counselling_activities.* FROM counselling_activities, campuses WHERE counselling_activities.campus_id=campuses.id AND counselling_activities.campus_id=? AND counselling_activities.deleted_at IS NULL', array($req->cid));

               $extraActivities = DB::select('SELECT extra_activities.* FROM extra_activities, campuses WHERE extra_activities.campus_id=campuses.id AND extra_activities.campus_id=? AND extra_activities.deleted_at IS NULL', array($req->cid));

               $alumniMembership = DB::select('SELECT alumni_memberships.* FROM alumni_memberships, campuses WHERE alumni_memberships.campus_id=campuses.id AND alumni_memberships.campus_id=? AND alumni_memberships.deleted_at IS NULL', array($req->cid));

               $alumniParticipation = DB::select('SELECT alumni_participations.*, activity_engagements.name as activity FROM alumni_participations, activity_engagements, campuses WHERE alumni_participations.campus_id=campuses.id AND alumni_participations.activity_engagements_id=activity_engagements.id AND alumni_participations.campus_id=? AND alumni_participations.deleted_at IS NULL ', array($req->cid));

               $programCourses = DB::select('SELECT program_courses.*, course_types.name as courseTypeName
FROM program_courses, course_types, campuses, users
WHERE program_courses.course_type_id=course_types.id
AND program_courses.campus_id=campuses.id
AND program_courses.campus_id=?
AND users.id=? AND program_courses.deleted_at IS NULL
ORDER BY course_types.name', array( $req->cid,$user->id ));

//               $curriculumReviews = DB::select('
//                SELECT curriculum_reviews.*, designations.name as designation, affiliations.name as affiliation
//                FROM curriculum_reviews, campuses, designations, affiliations
//                WHERE curriculum_reviews.campus_id=campuses.id
//                AND curriculum_reviews.designation_id=designations.id
//                AND curriculum_reviews.affiliations_id=affiliations.id
//                AND curriculum_reviews.campus_id=?', array($req->cid));

                $curriculumReviews = DB::select('SELECT curriculum_reviews.* FROM curriculum_reviews, campuses WHERE curriculum_reviews.campus_id=campuses.id AND curriculum_reviews.campus_id=? AND curriculum_reviews.deleted_at IS NULL', array( $req->cid));


               $programObjectives = DB::select('SELECT po.*, p.name as program
FROM program_objectives po, programs p, campuses c, users u
WHERE po.program_id=p.id
  AND po.campus_id=c.id
  AND po.campus_id=?
  AND u.id=? AND po.deleted_at IS NULL ', array($req->cid, $user->id));

               $programLearningOutcomes = DB::select('SELECT learning_outcomes.*, programs.name as program FROM learning_outcomes, programs, campuses, users WHERE learning_outcomes.program_id=programs.id AND learning_outcomes.campus_id=campuses.id AND learning_outcomes.campus_id=? AND users.id=? AND learning_outcomes.deleted_at IS NULL ', array($req->cid, $user->id));

               $cultralMaterial = DB::select('SELECT cultural_materials.* FROM cultural_materials, campuses, users WHERE cultural_materials.campus_id=campuses.id AND cultural_materials.campus_id=? AND users.id=? AND cultural_materials.deleted_at IS NULL', array($req->cid, $user->id));

               $managerialSkills = DB::select('SELECT managerial_skills.* FROM managerial_skills, campuses, users WHERE managerial_skills.campus_id=campuses.id AND managerial_skills.campus_id=? AND users.id=? AND managerial_skills.deleted_at IS NULL', array($req->cid, $user->id));

               $programDeliveryMethods = DB::select('SELECT program_delivery_methods.*, teaching_methods.name as teachingMethod FROM program_delivery_methods, teaching_methods, users , campuses WHERE program_delivery_methods.teaching_methods_id=teaching_methods.id AND program_delivery_methods.campus_id=campuses.id AND program_delivery_methods.campus_id=? AND users.id=? AND program_delivery_methods.deleted_at IS NULL', array($req->cid, $user->id));

               $evaluationMethods = DB::select('SELECT evaluation_methods.*, evaluation_items.name as evaluationItem FROM evaluation_methods, evaluation_items, users , campuses WHERE evaluation_methods.evaluation_items_id=evaluation_items.id AND evaluation_methods.campus_id=campuses.id AND evaluation_methods.campus_id=? AND users.id=? AND evaluation_methods.deleted_at IS NULL', array($req->cid, $user->id));

               $plagiarismCases = DB::select('SELECT plagiarism_cases.* FROM plagiarism_cases, campuses, users WHERE plagiarism_cases.campus_id=campuses.id AND plagiarism_cases.campus_id=? AND users.id=? AND plagiarism_cases.deleted_at IS NULL', array($req->cid, $user->id));

               $facultySummary[0] = DB::select('SELECT * FROM faculty_qualifications WHERE faculty_qualifications.deleted_at IS NULL', array());

               $facultyStability = DB::select('SELECT faculty_stability.* FROM faculty_stability, campuses, users WHERE faculty_stability.campus_id=campuses.id AND faculty_stability.campus_id=? AND users.id=? AND faculty_stability.deleted_at IS NULL', array($req->cid, $user->id));

                $facultyTeachingCourses = FacultyTeachingCources::
                    with('campus','lookup_faculty_type','designation', 'faculty_program')
                    ->where(['campus_id'=> $req->cid, 'department_id'=> $req->did])
                    ->where(function($query){
                        $query->where('lookup_faculty_type_id', 1)->orwhere('lookup_faculty_type_id', 2);
                    })
                    ->get();

                $whereb = ['campus_id'=> $req->cid, 'lookup_faculty_type_id' => 3];
                $facultyTeachingCourses4b = FacultyTeachingCources::
                with('campus','lookup_faculty_type','designation', 'faculty_program')
                    ->where($whereb)->get();
                $ratios = FacultyStudentRatio::with('campus','program')
                    ->where(['campus_id'=> $req->cid,'department_id'=> $req->did])
                    ->where('deleted_at',null)
                    ->get();
                
                $getFTE = FacultyTeachingCources::with('faculty_program')
                    ->where('campus_id', $req->cid)
                    ->where('department_id', $req->did)
                    ->where('deleted_at', null)
                    ->where(function($query){
                        $query->where('lookup_faculty_type_id', 1)->orwhere('lookup_faculty_type_id', 2);
                    })
                    ->get();
                $byProgramFTE = [];
                if($getFTE){
                    foreach ($getFTE as $val)
                    {
                        foreach ($val->faculty_program as $key => $progs)
                        {
                            if(count($byProgramFTE) == 0){
                                $byProgramFTE[$progs->program_id] = round($progs->tc_program/$val->max_cources_allowed, 2);
                            }else{
                                if(array_key_exists($progs->program_id, $byProgramFTE)){
                                    $byProgramFTE[$progs->program_id] = $byProgramFTE[$progs->program_id] + round($progs->tc_program/$val->max_cources_allowed, 2);
                                }else{
                                    $byProgramFTE[$progs->program_id] = round($progs->tc_program/$val->max_cources_allowed, 2);
                                }
                            }
                        }
                    }
                }
        
                $getVFE = FacultyTeachingCources::with('faculty_program')
                    ->where('lookup_faculty_type_id' , 3)
                    ->where('campus_id', $req->cid)
                    ->where('department_id', $req->did)
                    ->where('deleted_at', null)
                    ->get();
                $byProgramVFE = [];
                if($getVFE){
                    foreach ($getVFE as $vfe)
                    {
                        foreach ($vfe->faculty_program as $key => $prog)
                        {
                            if(count($byProgramVFE) == 0){
                                $byProgramVFE[$prog->program_id] = round($prog->tc_program/$vfe->max_cources_allowed, 2);
                            }else{
                                if(array_key_exists($prog->program_id, $byProgramVFE)){
                                    $byProgramVFE[$prog->program_id] = round($byProgramVFE[$prog->program_id], 2) + round($prog->tc_program/$vfe->max_cources_allowed, 2);
                                }else{
                                    $byProgramVFE[$prog->program_id] = round($prog->tc_program/$vfe->max_cources_allowed, 2);
                                }
                            }
                        }
                    }
                }

               $studentTeachersRatio = DB::select('SELECT faculty_student_ratio.*, programs.name as programName
FROM faculty_student_ratio, programs,  campuses
WHERE faculty_student_ratio.campus_id=campuses.id
AND faculty_student_ratio.program_id=programs.id AND  faculty_student_ratio.campus_id=? AND faculty_student_ratio.deleted_at IS NULL', array( $req->cid));

               $facultyDetailedInfos = DB::select('SELECT faculty_detailed_infos.*, lookup_faculty_types.faculty_type as facultyType, course_types.name as courseType, degrees.name as degree, designations.name as designation FROM faculty_detailed_infos, lookup_faculty_types, course_types, campuses, degrees, designations , users WHERE faculty_detailed_infos.designation_id=designations.id AND faculty_detailed_infos.lookup_faculty_type_id=lookup_faculty_types.id AND faculty_detailed_infos.course_type_id=course_types.id AND faculty_detailed_infos.degree_id=degrees.id AND faculty_detailed_infos.campus_id=campuses.id AND faculty_detailed_infos.campus_id=? AND users.id=? AND faculty_detailed_infos.deleted_at IS NULL', array($req->cid, $user->id));

               $facultyWorkshops = DB::select('SELECT faculty_workshops.* FROM faculty_workshops, campuses, users WHERE faculty_workshops.campus_id=campuses.id AND faculty_workshops.campus_id=? AND users.id=? AND faculty_workshops.deleted_at IS NULL', array($req->cid, $user->id));

                $facultyConsultancyProjects = DB::select('SELECT faculty_consultancy_projects.* FROM faculty_consultancy_projects, campuses, users WHERE faculty_consultancy_projects.campus_id=campuses.id AND faculty_consultancy_projects.campus_id=? AND users.id=? AND faculty_consultancy_projects.deleted_at IS NULL', array($req->cid, $user->id));

                $facultyParticipations = DB::select('SELECT faculty_participations.* FROM faculty_participations, campuses, users WHERE faculty_participations.campus_id=campuses.id AND faculty_participations.campus_id=? AND users.id=? AND faculty_participations.deleted_at IS NULL', array($req->cid, $user->id));

                $facultyMemberships = DB::select('SELECT faculty_memberships.* FROM faculty_memberships, campuses, users WHERE faculty_memberships.campus_id=campuses.id AND faculty_memberships.campus_id=? AND users.id=? AND faculty_memberships.deleted_at IS NULL', array($req->cid, $user->id));

                $internationalFaculties = DB::select('SELECT international_faculties.* FROM international_faculties, campuses, users WHERE international_faculties.campus_id=campuses.id AND international_faculties.campus_id=? AND users.id=? AND international_faculties.deleted_at IS NULL', array($req->cid, $user->id));

                $facultyExposures = DB::select('SELECT faculty_exposures.* FROM faculty_exposures, campuses, users WHERE faculty_exposures.campus_id=campuses.id AND faculty_exposures.campus_id=? AND users.id=? AND faculty_exposures.deleted_at IS NULL', array($req->cid, $user->id));

                $ploMappings = $this->getPloMapping($req->cid, $req->did);
                $missionVision = MissionVision::where(['campus_id' => $req->cid, 'department_id' => $req->did])->first();
                $alignedProgram = AlignedProgram::where(['campus_id'=> $req->cid,'department_id'=> $req->did])->first();
                $courseDetail = CourseDetail::where(['campus_id'=> $req->cid,'department_id'=> $req->did])->first();
                $checklistDocument = ChecklistDocument::where( ['campus_id'=> $req->cid,'department_id'=> $req->did])->first();
                $financialAssistance = FinancialAssistance::where(['campus_id'=> $req->cid,'department_id'=> $req->did])->first();
                $weakStudent = WeakStudent::where(['campus_id'=> $req->cid,'department_id'=> $req->did])->first();
                $studentParticipation = StudentParticipation::where(['campus_id'=> $req->cid,'department_id'=> $req->did])->first();
                $obtainedInternships = ObtainedInternship::where(['campus_id'=> $req->cid,'department_id'=> $req->did])->first();



        }else{

        $bussinessSchool  = DB::table('users')
            ->leftJoin('business_schools', 'users.business_school_id', '=', 'business_schools.id')
            ->leftJoin('institute_types','business_schools.institute_type_id','=','institute_types.id')
            ->leftJoin('charter_types','business_schools.charter_type_id','=','charter_types.id')
            ->leftJoin('designations','business_schools.cao_id','=','designations.id')
            ->where('users.id',auth()->user()->id)
            ->select('business_schools.*','institute_types.name as typeName', 'charter_types.name as charterName', 'designations.name as designationName' )
            ->get();
        $user = User::with('designation')->find(Auth::user()->id);
            $programsUnderReview = Scope::with('program')->where(
                ['campus_id'=>auth()->user()->campus_id, 'department_id' => auth()->user()->department_id])
                ->get();
            $docHeaderData = Slip::with('campus', 'department')
                ->where(
                    [
                        'business_school_id'=>auth()->user()->campus_id,
                        'department_id'=>auth()->user()->department_id
                    ]
                )->get()->first();

        $campuses = Campus::where('business_school_id', $bussinessSchool[0]->id)->get();
        $userCampus = DB::select('SELECT * from users where id=?', array(auth()->user()->id));

        $scopeOfAcredation = DB::select('SELECT scopes.*, programs.name as programName, levels.name as levelName FROM scopes, programs, levels, campuses WHERE scopes.campus_id=campuses.id AND scopes.program_id=programs.id AND scopes.level_id=levels.id AND scopes.campus_id=? AND scopes.deleted_at IS NULL', array(auth()->user()->campus_id));

        $contactInformation = DB::select('SELECT contact_infos.*, designations.name as designationName FROM contact_infos, designations, campuses, users WHERE contact_infos.designation_id=designations.id AND contact_infos.campus_id=? AND users.id=? AND contact_infos.deleted_at IS NULL', array(auth()->user()->campus_id, auth()->user()->id));

        $statutoryCommitties = DB::select('SELECT statutory_committees.*,statutory_bodies.name as statutoryName, designations.name as designationName from statutory_committees, statutory_bodies, business_schools, designations WHERE statutory_committees.statutory_body_id=statutory_bodies.id AND statutory_committees.designation_id=designations.id AND business_schools.id=? AND statutory_committees.campus_id=? AND statutory_committees.deleted_at IS NULL', array($bussinessSchool[0]->id, auth()->user()->campus_id));

         $affiliations = DB::select('SELECT affiliations.*, statutory_bodies.name as statutoryBody, designations.name as designationName
            FROM affiliations, statutory_bodies, business_schools, designations
            WHERE  affiliations.statutory_bodies_id=statutory_bodies.id AND business_schools.id=? AND affiliations.campus_id=? AND affiliations.deleted_at IS NULL AND designations.id=affiliations.designation_id', array($bussinessSchool[0]->id,auth()->user()->campus_id));

         $budgetoryInfo = DB::select(' SELECT budgetary_infos.* from budgetary_infos, business_schools, campuses WHERE business_schools.id=? AND budgetary_infos.campus_id=campuses.id AND budgetary_infos.campus_id=? AND budgetary_infos.deleted_at IS NULL', array($bussinessSchool[0]->id, auth()->user()->campus_id));

          $sourceOfFunding = SourcesFunding::with('funding_sources')->where(['campus_id' => auth()->user()->campus_id])->get();
          $summary_policy = SummarizePolicy::where(['campus_id' => auth()->user()->campus_id, 'status'=> 'active', 'department_id'=> auth()->user()->department_id])->first();

         $strategicPlans = DB::select(' SELECT strategic_plans.* from strategic_plans, campuses WHERE strategic_plans.campus_id=campuses.id AND strategic_plans.campus_id=? AND strategic_plans.deleted_at IS NULL', array(auth()->user()->campus_id));

         $programsPortfolio = DB::select('SELECT program_portfolios.*, programs.name as programName, course_types.name as courseType
            FROM program_portfolios, programs, course_types, business_schools
            WHERE program_portfolios.program_id=programs.id AND program_portfolios.course_type_id=course_types.id AND business_schools.id=? AND program_portfolios.campus_id=? AND program_portfolios.deleted_at IS NULL', array($bussinessSchool[0]->id, auth()->user()->campus_id));

         $studentEnrolment = DB::select('SELECT student_enrolments.*
            FROM student_enrolments , business_schools
            WHERE business_schools.id=? AND student_enrolments.campus_id=? AND student_enrolments.deleted_at IS NULL', array($bussinessSchool[0]->id, auth()->user()->campus_id));

         $studentsEnrolment = DB::select('SELECT student_enrolments.* FROM student_enrolments, campuses WHERE student_enrolments.campus_id=campuses.id AND campuses.id=? AND student_enrolments.year>YEAR(CURDATE())-3  AND student_enrolments.deleted_at IS NULL', array($userCampus[0]->campus_id));

         /*$facultyWorkLoad = DB::select('SELECT work_loads.*, designations.name as designationName FROM work_loads, designations, campuses, users WHERE work_loads.campus_id=campuses.id AND work_loads.designation_id=designations.id AND users.id=? AND work_loads.campus_id=?', array(auth()->user()->id,auth()->user()->campus_id));*/

         $now = Carbon::now();

        $currMonth = $now->month;
        $currSemester = "";
        $prevSemester = "";
        if($currMonth>8 && $currMonth<=2){
            $currSemester = "Fall t";
            $prevSemester = "Spring t";
        }else if($currMonth>2 && $currMonth<=9){
            $currSemester = "Spring t";
            $prevSemester = "Fall t-1";
        }
        $getYear = BusinessSchoolTyear::where(['campus_id' => auth()->user()->campus_id, 'department_id' => auth()->user()->department_id])->first();
        $facultyWorkLoad = WorkLoad::with('designation')->where(['campus_id' => auth()->user()->campus_id, 'department_id' => auth()->user()->department_id, 'year_t' => $getYear->tyear])->get()->map(function ($workLoad) {
            $workLoad->designationName = $workLoad->designation->name;
            unset($workLoad->designation);
            return $workLoad;
        });
        $facultyWorkLoadb = WorkLoad::with('designation')->where(['campus_id' => auth()->user()->campus_id, 'department_id' => auth()->user()->department_id, 'year_t' => $getYear->year_t_1])->get()->map(function ($workLoad) {
            $workLoad->designationName = $workLoad->designation->name;
            unset($workLoad->designation);
            return $workLoad;
        });
         $facultyGenders = DB::select('SELECT faculty_genders.*, lookup_faculty_types.faculty_type as facultyTypeName FROM faculty_genders, lookup_faculty_types, campuses, users WHERE faculty_genders.campus_id=campuses.id AND faculty_genders.lookup_faculty_type_id=lookup_faculty_types.id AND users.id=? AND faculty_genders.campus_id=? AND users.department_id=? AND faculty_genders.deleted_at IS NULL', array(auth()->user()->id, $userCampus[0]->campus_id, $userCampus[0]->department_id));

          $placementOffices = DB::select('SELECT placement_offices.* FROM placement_offices, campuses, users WHERE placement_offices.campus_id=campuses.id AND placement_offices.campus_id=? AND users.id=? AND placement_offices.deleted_at IS NULL', array( $userCampus[0]->campus_id, auth()->user()->id));

           $linkages = DB::select('SELECT linkages.* FROM linkages, campuses, users WHERE linkages.campus_id=campuses.id AND linkages.campus_id=? AND users.id=? AND linkages.deleted_at IS NULL', array( $userCampus[0]->campus_id, auth()->user()->id));

            $statutoryBodyMeetings = DB::select('SELECT body_meetings.*, designations.name as designation, statutory_bodies.name as statutoryBody FROM body_meetings, designations, statutory_bodies, campuses, users WHERE body_meetings.campus_id=campuses.id AND body_meetings.designation_id=designations.id AND body_meetings.statutory_bodies_id=statutory_bodies.id AND body_meetings.campus_id=? AND users.id=? AND body_meetings.deleted_at IS NULL', array( $userCampus[0]->campus_id, auth()->user()->id));

            $studentsExchangePrograms = DB::select('SELECT student_exchanges.* FROM student_exchanges, campuses, users WHERE student_exchanges.campus_id=campuses.id AND student_exchanges.campus_id=? AND users.id=? AND student_exchanges.deleted_at IS NULL', array( $userCampus[0]->campus_id, auth()->user()->id));

            $facultyExchangePrograms = DB::select('SELECT faculty_exchanges.* FROM faculty_exchanges, campuses, users WHERE faculty_exchanges.campus_id=campuses.id AND faculty_exchanges.campus_id=? AND users.id=? AND faculty_exchanges.deleted_at IS NULL', array( $userCampus[0]->campus_id, auth()->user()->id));

            $placementActivities = DB::select('SELECT placement_activities.* FROM placement_activities, campuses, users WHERE placement_activities.campus_id=campuses.id AND placement_activities.campus_id=? AND users.id=? AND placement_activities.deleted_at IS NULL', array( $userCampus[0]->campus_id, auth()->user()->id));

            $entryRequirements = DB::select('SELECT entry_requirements.*, programs.name as program, eligibility_criterias.name as eligibilityCriteria FROM entry_requirements, programs, eligibility_criterias, campuses, users WHERE entry_requirements.campus_id=campuses.id AND entry_requirements.program_id=programs.id AND entry_requirements.eligibility_criteria_id=eligibility_criterias.id AND entry_requirements.campus_id=? AND users.id=? AND entry_requirements.deleted_at IS NULL', array( $userCampus[0]->campus_id, auth()->user()->id));

            $applicationsReceived = DB::select('SELECT application_receiveds.*, programs.name as program, semester FROM application_receiveds, programs, campuses, users WHERE application_receiveds.campus_id=campuses.id AND application_receiveds.program_id=programs.id AND application_receiveds.campus_id=? AND users.id=? AND application_receiveds.deleted_at IS NULL', array( $userCampus[0]->campus_id, auth()->user()->id));

            $orics = DB::select('SELECT orics.* FROM orics, campuses, users WHERE orics.campus_id=campuses.id AND campuses.id=? AND users.id=? AND orics.deleted_at IS NULL', array( $userCampus[0]->campus_id, auth()->user()->id));

            $admissionOffices = DB::select('SELECT admission_offices.* FROM admission_offices, campuses, users WHERE admission_offices.campus_id=campuses.id AND admission_offices.campus_id=? AND users.id=? AND admission_offices.deleted_at IS NULL', array( $userCampus[0]->campus_id, auth()->user()->id));

            $researchCenters = DB::select('SELECT research_centers.* FROM research_centers, campuses, users WHERE research_centers.campus_id=campuses.id AND research_centers.campus_id=? AND users.id=? AND research_centers.deleted_at IS NULL', array( $userCampus[0]->campus_id, auth()->user()->id));

            $researchAgendas = DB::select('SELECT research_agendas.* FROM research_agendas, campuses, users WHERE research_agendas.campus_id=campuses.id AND research_agendas.campus_id=? AND users.id=? AND research_agendas.deleted_at IS NULL', array( $userCampus[0]->campus_id, auth()->user()->id));

             $researchFundings = DB::select('SELECT research_fundings.* FROM research_fundings, campuses, users WHERE research_fundings.campus_id=campuses.id AND research_fundings.campus_id=? AND users.id=? AND research_fundings.deleted_at IS NULL', array( $userCampus[0]->campus_id, auth()->user()->id));

             $researchProjects = DB::select('SELECT research_projects.* FROM research_projects, campuses, users WHERE research_projects.campus_id=campuses.id AND research_projects.campus_id=? AND users.id=? AND research_projects.deleted_at IS NULL', array( $userCampus[0]->campus_id, auth()->user()->id));

             $researchOutput = DB::select('SELECT research_summaries.*, publication_types.name as publicationName,
publication_categories.name as publicationType FROM publication_categories,
research_summaries, publication_types, campuses, users
WHERE research_summaries.campus_id=campuses.id
AND publication_categories.id=publication_types.publication_category_id
AND research_summaries.publication_type_id=publication_types.id AND users.id=? AND users.department_id=? AND research_summaries.campus_id=? AND research_summaries.deleted_at IS NULL ORDER BY publication_categories.name', array(auth()->user()->id, $userCampus[0]->department_id, $userCampus[0]->campus_id ));

             $topTenResearchOutput = DB::select('SELECT research_outputs.* FROM research_outputs, campuses, users
WHERE research_outputs.campus_id=campuses.id
AND research_outputs.campus_id=?
AND users.id=? AND research_outputs.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $curriculumRoles = DB::select('SELECT curriculum_roles.* FROM curriculum_roles, campuses, users WHERE curriculum_roles.campus_id=campuses.id AND curriculum_roles.campus_id=? AND users.id=? AND curriculum_roles.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $facultyDevelopments = DB::select('SELECT faculty_developments.* FROM faculty_developments, campuses, users WHERE faculty_developments.campus_id=campuses.id AND faculty_developments.campus_id=? AND users.id=? AND faculty_developments.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $conferences = DB::select('SELECT conferences.* FROM conferences, campuses, users WHERE conferences.campus_id=campuses.id AND conferences.campus_id=? AND users.id=?', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $financialInfos = DB::select('SELECT financial_infos.*, income_sources.particular as particularName, income_sources.type as particularType FROM financial_infos, income_sources, campuses, users WHERE financial_infos.campus_id=campuses.id AND financial_infos.income_source_id=income_sources.id AND financial_infos.campus_id=? AND users.id=? AND financial_infos.deleted_at IS NULL ORDER BY income_sources.type', array( $userCampus[0]->campus_id, auth()->user()->id));

             $financialRisks = DB::select('SELECT financial_risks.* FROM financial_risks, campuses, users WHERE financial_risks.campus_id=campuses.id AND financial_risks.campus_id=? AND users.id=? AND financial_risks.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $supportStaff = DB::select('SELECT support_staff.*, staff_categories.name as staffCategory FROM support_staff, staff_categories, campuses, users WHERE support_staff.campus_id=campuses.id AND support_staff.staff_category_id=staff_categories.id AND support_staff.campus_id=? AND users.id=? AND support_staff.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $qecInformation = DB::select('SELECT qec_infos.*, qec_types.name as qecName FROM qec_infos, qec_types, campuses, users WHERE qec_infos.campus_id=campuses.id AND qec_infos.qec_type_id=qec_types.id AND qec_infos.campus_id=? AND users.id=? AND qec_infos.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $BIResources = DB::select('SELECT business_school_facilities.*, facilities.name as facilityName,
facility_types.name as facilityType FROM business_school_facilities, facilities, facility_types, users, campuses
WHERE business_school_facilities.campus_id=campuses.id
AND business_school_facilities.facility_id=facilities.id
AND users.id=? AND business_school_facilities.campus_id=?
AND facilities.facility_type_id=facility_types.id AND business_school_facilities.deleted_at IS NULL ORDER BY facility_types.name', array(auth()->user()->id, $userCampus[0]->campus_id));

             $studentsClubs = DB::select('SELECT student_clubs.* FROM student_clubs, campuses, users WHERE student_clubs.campus_id=campuses.id AND student_clubs.campus_id=? AND users.id=? AND student_clubs.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $projectDetails = DB::select('SELECT project_details.* FROM project_details, campuses, users WHERE project_details.campus_id=campuses.id AND project_details.campus_id=? AND users.id=? AND project_details.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $environmentalProtectionActivities = DB::select('SELECT env_protections.* FROM env_protections, campuses, users WHERE env_protections.campus_id=campuses.id AND env_protections.campus_id=? AND users.id=? AND env_protections.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $formalRelationships = DB::select('SELECT formal_relationships.* FROM formal_relationships, campuses, users WHERE formal_relationships.campus_id=campuses.id AND formal_relationships.campus_id=? AND users.id=? AND formal_relationships.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

             $complaintResolution = DB::select('SELECT complaint_resolutions.* FROM complaint_resolutions, campuses, users WHERE complaint_resolutions.campus_id=campuses.id AND complaint_resolutions.campus_id=? AND users.id=? AND complaint_resolutions.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

              $internalCommunityWelfareProgram = DB::select('SELECT internal_communities.*, welfare_programs.name as welfareProgram FROM internal_communities, welfare_programs, campuses, users WHERE internal_communities.campus_id=campuses.id AND internal_communities.welfare_program_id=welfare_programs.id AND internal_communities.campus_id=? AND users.id=? AND internal_communities.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

              $studentsIntake = DB::select('SELECT student_intakes.* FROM student_intakes, campuses, users WHERE student_intakes.campus_id=campuses.id AND campuses.id=? AND users.id=? AND student_intakes.year>YEAR(CURDATE())-3  AND student_intakes.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

              $classSize = $this->getClassSizeMapping(auth()->user()->campus_id, auth()->user()->department_id);

              $dropoutPercentage = DB::select('SELECT dropout_percentages.*, programs.name as program FROM dropout_percentages, programs, campuses, users WHERE dropout_percentages.campus_id=campuses.id AND dropout_percentages.program_id=programs.id AND dropout_percentages.campus_id=? AND users.id=? AND dropout_percentages.deleted_at IS NULL ORDER BY dropout_percentages.program_id ', array( $userCampus[0]->campus_id,auth()->user()->id ));

              $studentsFinancial = DB::select('SELECT student_financials.*, programs.name as program FROM student_financials, programs, users, campuses WHERE student_financials.campus_id=campuses.id AND student_financials.program_id=programs.id AND student_financials.campus_id=? AND users.id=? AND student_financials.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

              $personalGroomings = DB::select('SELECT personal_groomings.* FROM personal_groomings, campuses, users WHERE personal_groomings.campus_id=campuses.id AND personal_groomings.campus_id=? AND users.id=? AND personal_groomings.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $counselingActivities = DB::select('SELECT counselling_activities.* FROM counselling_activities, users, campuses WHERE counselling_activities.campus_id=campuses.id AND counselling_activities.campus_id=? AND users.id=? AND counselling_activities.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $extraActivities = DB::select('SELECT extra_activities.* FROM extra_activities, users, campuses WHERE extra_activities.campus_id=campuses.id AND extra_activities.campus_id=? AND users.id=? AND extra_activities.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $alumniMembership = DB::select('SELECT alumni_memberships.* FROM alumni_memberships, users, campuses WHERE alumni_memberships.campus_id=campuses.id AND alumni_memberships.campus_id=? AND users.id=? AND alumni_memberships.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $alumniParticipation = DB::select('SELECT alumni_participations.*, activity_engagements.name as activity FROM alumni_participations, activity_engagements, campuses, users WHERE alumni_participations.campus_id=campuses.id AND alumni_participations.activity_engagements_id=activity_engagements.id AND alumni_participations.campus_id=? AND users.id=? AND alumni_participations.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $programCourses = DB::select('SELECT program_courses.*, course_types.name as courseTypeName
FROM program_courses, course_types, campuses, users
WHERE program_courses.course_type_id=course_types.id
AND program_courses.campus_id=campuses.id
AND program_courses.campus_id=?
AND users.id=? AND program_courses.deleted_at IS NULL
ORDER BY course_types.name', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $curriculumReviews = DB::select('SELECT curriculum_reviews.* FROM curriculum_reviews, campuses WHERE curriculum_reviews.campus_id=campuses.id AND curriculum_reviews.campus_id=? AND curriculum_reviews.deleted_at IS NULL', array( $userCampus[0]->campus_id));

               $programObjectives = DB::select('SELECT program_objectives.*, programs.name as program FROM program_objectives, programs, campuses, users WHERE program_objectives.program_id=programs.id AND program_objectives.campus_id=campuses.id AND program_objectives.campus_id=? AND users.id=? AND program_objectives.deleted_at IS NULL ', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $programLearningOutcomes = DB::select('SELECT learning_outcomes.*, programs.name as program FROM learning_outcomes, programs, campuses, users WHERE learning_outcomes.program_id=programs.id AND learning_outcomes.campus_id=campuses.id AND learning_outcomes.campus_id=? AND users.id=? AND learning_outcomes.deleted_at IS NULL ', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $cultralMaterial = DB::select('SELECT cultural_materials.* FROM cultural_materials, campuses, users WHERE cultural_materials.campus_id=campuses.id AND cultural_materials.campus_id=? AND users.id=? AND cultural_materials.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $managerialSkills = DB::select('SELECT managerial_skills.* FROM managerial_skills, campuses, users WHERE managerial_skills.campus_id=campuses.id AND managerial_skills.campus_id=? AND users.id=? AND managerial_skills.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $programDeliveryMethods = DB::select('SELECT program_delivery_methods.*, teaching_methods.name as teachingMethod FROM program_delivery_methods, teaching_methods, users , campuses WHERE program_delivery_methods.teaching_methods_id=teaching_methods.id AND program_delivery_methods.campus_id=campuses.id AND program_delivery_methods.campus_id=? AND users.id=? AND program_delivery_methods.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $evaluationMethods = DB::select('SELECT evaluation_methods.*, evaluation_items.name as evaluationItem FROM evaluation_methods, evaluation_items, users , campuses WHERE evaluation_methods.evaluation_items_id=evaluation_items.id AND evaluation_methods.campus_id=campuses.id AND evaluation_methods.campus_id=? AND users.id=? AND evaluation_methods.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $plagiarismCases = DB::select('SELECT plagiarism_cases.* FROM plagiarism_cases, campuses, users WHERE plagiarism_cases.campus_id=campuses.id AND plagiarism_cases.campus_id=? AND users.id=? AND plagiarism_cases.deleted_at IS NULL', array( $userCampus[0]->campus_id,auth()->user()->id ));

               $facultySummary[0] = DB::select('SELECT * FROM faculty_qualifications WHERE faculty_qualifications.deleted_at IS NULL', array());

               $facultyStability = DB::select('SELECT faculty_stability.* FROM faculty_stability, campuses, users WHERE faculty_stability.campus_id=campuses.id AND users.department_id=? AND faculty_stability.campus_id=? AND users.id=? AND faculty_stability.deleted_at IS NULL', array($userCampus[0]->department_id, $userCampus[0]->campus_id,auth()->user()->id));

                $where = ['campus_id'=> Auth::user()->campus_id,'department_id'=>Auth::user()->department_id, 'deleted_at'=> null];
                $facultyTeachingCourses = FacultyTeachingCources::
                    with('campus','lookup_faculty_type','designation', 'faculty_program')
                    ->where($where)
                    ->where(function($query){
                        $query->where('lookup_faculty_type_id', 1)->orwhere('lookup_faculty_type_id', 2);
                    })
                    ->get();
                $whereb = ['campus_id'=> Auth::user()->campus_id,'department_id'=>Auth::user()->department_id, 'deleted_at'=> null, 'lookup_faculty_type_id' => 3];
                $facultyTeachingCourses4b = FacultyTeachingCources::
                with('campus','lookup_faculty_type','designation', 'faculty_program')
                    ->where($whereb)->get();
                $ratios = FacultyStudentRatio::with('campus','program')
                    ->where(['campus_id'=> Auth::user()->campus_id,'department_id'=> Auth::user()->department_id])
                    ->where('deleted_at',null)
                    ->get();

                $getFTE = FacultyTeachingCources::with('faculty_program')
                    ->where('campus_id', $userCampus[0]->campus_id)
                    ->where('department_id', $userCampus[0]->department_id)
                    ->where('deleted_at', null)
                    ->where(function($query){
                        $query->where('lookup_faculty_type_id', 1)->orwhere('lookup_faculty_type_id', 2);
                    })
                    ->get();
                $byProgramFTE = [];
                if($getFTE){
                    foreach ($getFTE as $val)
                    {
                        foreach ($val->faculty_program as $key => $progs)
                        {
                            if(count($byProgramFTE) == 0){
                                $byProgramFTE[$progs->program_id] = round($progs->tc_program/$val->max_cources_allowed, 2);
                            }else{
                                if(array_key_exists($progs->program_id, $byProgramFTE)){
                                    $byProgramFTE[$progs->program_id] = $byProgramFTE[$progs->program_id] + round($progs->tc_program/$val->max_cources_allowed, 2);
                                }else{
                                    $byProgramFTE[$progs->program_id] = round($progs->tc_program/$val->max_cources_allowed, 2);
                                }
                            }
                        }
                    }
                }
        
                $getVFE = FacultyTeachingCources::with('faculty_program')
                    ->where('lookup_faculty_type_id' , 3)
                    ->where('campus_id', $userCampus[0]->campus_id)
                    ->where('department_id', $userCampus[0]->department_id)
                    ->where('deleted_at', null)
                    ->get();
                $byProgramVFE = [];
                if($getVFE){
                    foreach ($getVFE as $vfe)
                    {
                        foreach ($vfe->faculty_program as $key => $prog)
                        {
                            if(count($byProgramVFE) == 0){
                                $byProgramVFE[$prog->program_id] = round($prog->tc_program/$vfe->max_cources_allowed, 2);
                            }else{
                                if(array_key_exists($prog->program_id, $byProgramVFE)){
                                    $byProgramVFE[$prog->program_id] = round($byProgramVFE[$prog->program_id], 2) + round($prog->tc_program/$vfe->max_cources_allowed, 2);
                                }else{
                                    $byProgramVFE[$prog->program_id] = round($prog->tc_program/$vfe->max_cources_allowed, 2);
                                }
                            }
                        }
                    }
                }

               $studentTeachersRatio = DB::select('SELECT faculty_student_ratio.*, programs.name as programName
FROM faculty_student_ratio, programs, campuses, users WHERE faculty_student_ratio.campus_id=campuses.id
 AND faculty_student_ratio.program_id=programs.id AND users.department_id=?
 AND faculty_student_ratio.campus_id=? AND faculty_student_ratio.deleted_at IS NULL', array($userCampus[0]->department_id, $userCampus[0]->campus_id));

               $facultyDetailedInfos = DB::select('SELECT faculty_detailed_infos.*, lookup_faculty_types.faculty_type as facultyType, course_types.name as courseType, degrees.name as degree, designations.name as designation FROM faculty_detailed_infos, lookup_faculty_types, course_types, campuses, degrees, designations , users WHERE faculty_detailed_infos.designation_id=designations.id AND faculty_detailed_infos.lookup_faculty_type_id=lookup_faculty_types.id AND faculty_detailed_infos.course_type_id=course_types.id AND faculty_detailed_infos.degree_id=degrees.id AND faculty_detailed_infos.campus_id=campuses.id AND faculty_detailed_infos.campus_id=? AND users.id=? AND faculty_detailed_infos.deleted_at IS NULL', array($userCampus[0]->campus_id, auth()->user()->id));

               $facultyWorkshops = DB::select('SELECT faculty_workshops.* FROM faculty_workshops, campuses, users WHERE faculty_workshops.campus_id=campuses.id AND faculty_workshops.campus_id=? AND users.id=? AND faculty_workshops.deleted_at IS NULL', array($userCampus[0]->campus_id, auth()->user()->id));

                $facultyConsultancyProjects = DB::select('SELECT faculty_consultancy_projects.* FROM faculty_consultancy_projects, campuses, users WHERE faculty_consultancy_projects.campus_id=campuses.id AND faculty_consultancy_projects.campus_id=? AND users.id=? AND faculty_consultancy_projects.deleted_at IS NULL', array($userCampus[0]->campus_id, auth()->user()->id));

                $facultyParticipations = DB::select('SELECT faculty_participations.* FROM faculty_participations, campuses, users WHERE faculty_participations.campus_id=campuses.id AND faculty_participations.campus_id=? AND users.id=? AND faculty_participations.deleted_at IS NULL', array($userCampus[0]->campus_id, auth()->user()->id));

                $facultyMemberships = DB::select('SELECT faculty_memberships.* FROM faculty_memberships, campuses, users WHERE faculty_memberships.campus_id=campuses.id AND faculty_memberships.campus_id=? AND users.id=? AND faculty_memberships.deleted_at IS NULL', array($userCampus[0]->campus_id, auth()->user()->id));

                $internationalFaculties = DB::select('SELECT international_faculties.* FROM international_faculties, campuses, users WHERE international_faculties.campus_id=campuses.id AND international_faculties.campus_id=? AND users.id=? AND international_faculties.deleted_at IS NULL', array($userCampus[0]->campus_id, auth()->user()->id));

                $facultyExposures = DB::select('SELECT faculty_exposures.* FROM faculty_exposures, campuses, users WHERE faculty_exposures.campus_id=campuses.id AND faculty_exposures.campus_id=? AND users.id=? AND faculty_exposures.deleted_at IS NULL', array($userCampus[0]->campus_id, auth()->user()->id));
                $ploMappings = $this->getPloMapping(auth()->user()->campus_id, auth()->user()->department_id);
               $missionVision = MissionVision::where(['campus_id' => auth()->user()->campus_id, 'department_id' => auth()->user()->department_id])->first();
               $alignedProgram = AlignedProgram::where(['campus_id'=> auth()->user()->campus_id, 'department_id'=> auth()->user()->department_id])->first();
               $courseDetail = CourseDetail::where(['campus_id'=> auth()->user()->campus_id, 'department_id'=> auth()->user()->department_id])->first();
               $checklistDocument = ChecklistDocument::where( ['campus_id'=> auth()->user()->campus_id, 'department_id'=> auth()->user()->department_id])->first();
               $financialAssistance = FinancialAssistance::where(['campus_id'=> auth()->user()->campus_id, 'department_id'=> auth()->user()->department_id])->first();
               $weakStudent = WeakStudent::where(['campus_id'=> auth()->user()->campus_id,'department_id'=> auth()->user()->department_id])->first();
               $studentParticipation = StudentParticipation::where(['campus_id'=> auth()->user()->campus_id,'department_id'=> auth()->user()->department_id])->first();
               $obtainedInternships = ObtainedInternship::where(['campus_id'=> auth()->user()->campus_id,'department_id'=> auth()->user()->department_id])->first();
        }

        return view('strategic_management.printAll', compact('programsUnderReview','docHeaderData','classSize','summary_policy','studentsFinancial','internationalFaculties','facultyDetailedInfos','facultyWorkshops','facultyExposures','facultyConsultancyProjects','facultyParticipations','studentTeachersRatio','facultyMemberships','facultyTeachingCourses','facultyTeachingCourses4b','ratios','byProgramFTE','byProgramVFE','programCourses','facultySummary','extraActivities','plagiarismCases','facultyStability','cultralMaterial','programLearningOutcomes','programObjectives','evaluationMethods','programDeliveryMethods','managerialSkills','curriculumReviews','counselingActivities','personalGroomings','alumniMembership','alumniParticipation','dropoutPercentage','bussinessSchool','campuses','scopeOfAcredation', 'contactInformation','statutoryCommitties','affiliations','budgetoryInfo', 'sourceOfFunding', 'strategicPlans', 'programsPortfolio','studentEnrolment','studentsEnrolment','facultyWorkLoad','facultyWorkLoadb','facultyGenders','placementOffices','linkages','statutoryBodyMeetings','studentsExchangePrograms','facultyExchangePrograms','placementActivities','entryRequirements','applicationsReceived','orics','admissionOffices','researchCenters','researchAgendas','researchFundings','researchProjects','researchOutput','topTenResearchOutput','curriculumRoles','facultyDevelopments','conferences','financialInfos','financialRisks','supportStaff','qecInformation','BIResources','studentsClubs','projectDetails','environmentalProtectionActivities','formalRelationships','complaintResolution','internalCommunityWelfareProgram','studentsIntake','user','missionVision','alignedProgram','courseDetail','checklistDocument','financialAssistance','weakStudent','studentParticipation', 'ploMappings', 'getYear', 'obtainedInternships'));
    }


        public static function getPLOsByPOId($id){
            $PLOs = DB::select('SELECT po_plo_mappings.*, program_objectives.po as po, learning_outcomes.plo as plo FROM po_plo_mappings, program_objectives, learning_outcomes, campuses, users WHERE po_plo_mappings.po_id=program_objectives.id AND po_plo_mappings.plo_id=learning_outcomes.id AND po_plo_mappings.campus_id=campuses.id AND po_plo_mappings.campus_id=? AND users.id=? AND po_plo_mappings.po_id=?', array(auth()->user()->campus_id,auth()->user()->id,$id));
            return $PLOs;
        }

    public function submitSAR($value='')
    {
        $user_id = Auth::id();
        $campus_id = Auth::user()->campus_id;
        $department_id = Auth::user()->department_id;
        //check is registration forms data completed:
        $check = $this->isRegCompleted(['user_id'=> $user_id, 'campus_id'=>$campus_id, 'department_id'=>$department_id]);
        $memberShips = User::with('business_school')->where('status', 'pending')->get();
        $invoices = Slip::with('campus', 'department')->where(['business_school_id' => $campus_id, 'department_id' => $department_id])->get();
        //dd($invoices);
        $registrations = Slip::with('campus')
            ->where('regStatus','!=','ScheduledMentoring')
            ->get();
        $registration_apply = User::with('business_school')->where(['status' => 'active', 'user_type'=>'business_school', 'id' => $user_id])->get();
        $businessSchools = DB::select('SELECT business_schools.*, campuses.location as campus, campuses.id as campusID,
            slips.status as slipStatus, departments.name as department FROM business_schools, users, campuses, slips, departments WHERE
            users.business_school_id=business_schools.id AND
            campuses.business_school_id=business_schools.id AND
            business_schools.status="active" AND
            slips.business_school_id=campuses.id AND
            slips.department_id=departments.id AND
            slips.status="approved" AND
            users.id=?', array(auth()->user()->id));
//        dd(auth()->user()->id);
         return view('submitSAR' ,compact( 'registrations', 'invoices', 'memberShips','registration_apply','businessSchools'));
    }

     public static function getfacultySummary($i, $facultySummary, $userCampus){
        //dd($facultySummary[$i]->id);
         $facultySummary12 = DB::select('SELECT faculty_summaries.*, disciplines.name as disciplineName FROM faculty_summaries, disciplines,users WHERE faculty_summaries.discipline_id=disciplines.id AND faculty_summaries.faculty_qualification_id=? AND faculty_summaries.campus_id=?', array($facultySummary[$i]->id,auth()->user()->campus_id));
         return $facultySummary12;
     }

    private function getPloMapping($campus_id, $department_id){
        $plos = MappingPos::with('outcome', 'objective')->where(['campus_id' => $campus_id, 'department_id' => $department_id])->get();
        $mapping = [];
        foreach($plos as $plo){
            $mapping[$plo->program->name][$plo->objective->po_name][$plo->col] = true;
        }
        return $mapping;
    }

    private function getClassSizeMapping($campus_id, $department_id){
        $classSizes = ClassSize::with('program')->where(['campus_id' => $campus_id, 'department_id' => $department_id])->orderBy('program_id')->get();
        $mapping = ['programs' => [], 'sizes' =>[]];
        foreach($classSizes as $classSize){
            if(!in_array($classSize->program->name, $mapping['programs'])){
                array_push($mapping['programs'], $classSize->program->name);
            }
            $mapping['sizes'][$classSize->year . '-' . $classSize->semester][$classSize->program->name] = $classSize->size;
        }
        return $mapping;
    }

    public function applyNBEAC(Request $user,  $id)
    {
        if($id)
        {
            DB::enableQueryLog();
            try {
            $user_id = Auth::id();
            $campus_id = Auth::user()->campus_id;
            //$registration_apply = Slip::where(['created_by' => $user_id,'business_school_id'=> $campus_id, 'department_id' => $user->department_id])->update(['isEligibleNBEAC' =>'yes']);
            //dd(DB::getQueryLog());
            //dd($registration_apply);
            $result = DB::update('update slips set isEligibleNBEAC=?, created_by=?, regStatus=? where id=?', array('yes',$user_id,'SAP',$id));
            //dd($result);

                $slipInfo = Slip::with('campus', 'department')
                    ->where(['business_school_id' => $campus_id, 'department_id' => Auth::user()->department_id])
                    ->first();
                $slipInfo->update(['registration_date' => date('Y-m-d')]);
                /////////////////// send email to NBEAC Admin //////////////////////
                $getnbeacInfo = NbeacBasicInfo::first();

//                dd($slipInfo);
                $comments = 'The business school ( '. $slipInfo->campus->business_school->name. ' '. $slipInfo->campus->location. ' department '.$slipInfo->department->name.' ) '
                    . ' has been submitted SAR for review.';
                $footer = '<p>Yours Sincerely,</p>' .
                    '<p>&nbsp;</p>' .
                    '<p>' . $slipInfo->campus->user->name . '</p>';
///
                $data = ['letter' => $comments.$footer];
                $slipInfo = $slipInfo;
                $mailInfo = [
                    'to' => $getnbeacInfo->email,
                    'to_name' =>$getnbeacInfo->name ,
                    'school' => $slipInfo->campus->business_school->name,
                    'from' => $slipInfo->campus->user->email,
                    'from_name' => $slipInfo->campus->user->name,
                ];
//                    dd($mailInfo);
                Mail::send('eligibility_screening.email.eligibility_report', $data, function ($message) use ($mailInfo) {
                    //dd($user);
                    $message->to($mailInfo['to'], $mailInfo['to_name'])
                        ->subject('SAR submitted by business school - ' . $mailInfo['school']);
                });

            return response()->json(['success' => 'Successfully Shared with NBEAC']);

            }catch (Exception $e)
            {
                return response()->json(['message' => $e->getMessage()]);
            }
        }
    }


    public function applyMentor(Request $user,  $id)
    {
        if($id)
        {
            DB::enableQueryLog();
            try {
            $user_id = Auth::id();
            $campus_id = Auth::user()->campus_id;
            $result = DB::update('update slips set isEligibleMentor=?, created_by=? where id=?', array('yes',$user_id,$id));
            //dd($result);

                $slipInfoSchool = Slip::with('campus', 'department')
                    ->where(['business_school_id' => $campus_id, 'department_id' => Auth::user()->department_id])
                    ->first();
//dd($slipInfoSchool);
                $slipInfo = MentoringMentor::with('user')->where(['slip_id' => $slipInfoSchool->id])->first();
                /////////////////// send email to NBEAC Admin //////////////////////
                $getnbeacInfo = NbeacBasicInfo::first();

                $header = 'AOA <br/>'. $slipInfo->user->name;
                $comments = 'The business school ( '. $slipInfoSchool->campus->business_school->name. ' '. $slipInfoSchool->campus->location. ' department '.$slipInfoSchool->department->name.' ) '
                    . ' has been submitted SAR for review.';
                $footer = '<p>Yours Sincerely,</p>' .
                    '<p>&nbsp;</p>' .
                    '<p>' . $slipInfoSchool->campus->user->name . '</p>';
///
                $data = ['letter' => $header. '<br/>'.$comments.$footer];
                $slipInfo = $slipInfo;
                $mailInfo = [
                    'to' => $slipInfo->user->email,
                    'to_name' =>$slipInfo->user->name ,
                    'school' => $slipInfoSchool->campus->business_school->name,
                    'from' => $slipInfoSchool->campus->user->email,
                    'from_name' => $slipInfoSchool->campus->user->name,
                ];
//                    dd($mailInfo);
                Mail::send('eligibility_screening.email.eligibility_report', $data, function ($message) use ($mailInfo) {
                    //dd($user);
                    $message->to($mailInfo['to'], $mailInfo['to_name'])
                        ->subject('SAR submitted by business school - ' . $mailInfo['school']);
                });
            return response()->json(['success' => 'Successfully Shared with Mentor']);

            }catch (Exception $e)
            {
                return response()->json(['message' => $e->getMessage()]);
            }

        }
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
