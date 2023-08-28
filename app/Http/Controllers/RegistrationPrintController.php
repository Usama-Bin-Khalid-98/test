<?php

namespace App\Http\Controllers;
use App\BusinessSchool;
use App\FacultyDegree;
use App\Models\Common\Campus;
use App\Models\Common\Slip;
use App\Models\Common\StrategicManagement\BusinessSchoolTyear;
use App\Models\Faculty\FacultyStudentRatio;
use App\Models\Faculty\FacultyTeachingCources;
use App\Models\StrategicManagement\ContactInfo;
use App\Models\StrategicManagement\Scope;
use App\Models\Facility\BusinessSchoolFacility;
use App\Models\Faculty\FacultySummary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF;

class RegistrationPrintController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }

    public function index(Request $req)
    {

            //dd($docHeaderData);
        $programsUnderReview = Scope::with('program')->where(
            ['campus_id'=>Auth::user()->campus_id, 'department_id' => Auth::user()->department_id])
            ->where('deleted_at', NULL)->get();
//        dd($programsUnderReview);
        ///////////////////////////// end header data ///////////
        if(isset($req->cid) && isset($req->bid)){

            /////////////////header data ////////
            $docHeaderData = Slip::with('campus', 'department')
                ->where(
                    [
                        'business_school_id'=>$req->cid,
                        'department_id'=>$req->did
                    ]
                )->get()->first();
//dd($req->did);
            $bussinessSchool  = DB::table('users')
                ->leftJoin('business_schools', 'users.business_school_id', '=', 'business_schools.id')
                ->leftJoin('institute_types','business_schools.institute_type_id','=','institute_types.id')
                ->leftJoin('charter_types','business_schools.charter_type_id','=','charter_types.id')
                ->leftJoin('designations','users.designation_id','=','designations.id')
                ->where('users.business_school_id',$req->bid)
                ->where('business_schools.deleted_at', NULL)
                ->select('business_schools.*','institute_types.name as typeName', 'charter_types.name as charterName', 'designations.name as designationName' )
                ->get();
            


            $userCampus = DB::select('SELECT * from users where id=?', array(auth()->user()->id));
            //dd($userCampus[0]->campus_id);
            $campuses = Campus::where('business_school_id', $req->bid)->get();



           $scopeOfAcredation = DB::select('SELECT scopes.*, programs.name as programName, levels.name as levelName
               FROM scopes, programs, levels, campuses
               WHERE scopes.campus_id=campuses.id
                 AND scopes.type="REG"
                 AND scopes.program_id=programs.id
                 AND scopes.level_id=levels.id
                 AND scopes.campus_id=?
                 AND scopes.deleted_at is null
                 AND scopes.department_id=?', array($req->cid, $req->did));

//

//            dd($scopeOfAcredation);


            $contactInformation = DB::select('SELECT contact_infos.*, designations.name as designationName, designations.id as designationId
FROM designations, contact_infos, campuses
WHERE designations.id=contact_infos.designation_id
  AND contact_infos.type="REG"
  AND contact_infos.campus_id=?
  AND contact_infos.department_id=?
  AND contact_infos.deleted_at is null
  AND contact_infos.campus_id=campuses.id', array($req->cid, $req->did));



            $statutoryCommitties = DB::table('statutory_committees')
                ->join('designations', 'statutory_committees.designation_id', '=', 'designations.id')
                ->join('statutory_bodies', 'statutory_committees.statutory_body_id', '=', 'statutory_bodies.id')
                ->where('statutory_committees.type', 'REG')
                ->whereNull('statutory_committees.deleted_at')
                ->where('statutory_committees.campus_id', $req->cid)
                ->where('statutory_committees.department_id', $req->did)
                ->select(
                    'statutory_committees.*',
                    'statutory_bodies.name as statutoryName',
                    'designations.name as designationName'
                )
                ->get();

            $affiliations = DB::table('affiliations')
                ->join('statutory_bodies', 'affiliations.statutory_bodies_id', '=', 'statutory_bodies.id')
                ->join('designations', 'affiliations.designation_id', '=', 'designations.id')
                ->where('affiliations.type', '=', 'REG')
                ->whereNull('affiliations.deleted_at')
                ->where('affiliations.campus_id', $req->cid)
                ->where('affiliations.department_id', $req->did)
                ->select(
                    'affiliations.*',
                    'statutory_bodies.name as statutoryBody',
                    'designations.name as designationName'
                )
                ->get();
             $budgetoryInfo = DB::select(' SELECT budgetary_infos.* from budgetary_infos, business_schools, campuses
                WHERE business_schools.id=? AND budgetary_infos.type="REG"
                AND budgetary_infos.campus_id=campuses.id AND budgetary_infos.campus_id=? AND budgetary_infos.deleted_at is null', array($req->bid, $req->cid));


            $app_Received = DB::select('SELECT app_receiveds.*, programs.name as programName
            FROM app_receiveds, programs
            WHERE app_receiveds.program_id=programs.id AND app_receiveds.type="REG" AND app_receiveds.deleted_at is null

            AND campus_id=?', array($req->cid));

            $whereb = ['campus_id'=> $req->cid, 'type' => 'REG', 'lookup_faculty_type_id' => 3];

            $facultyTeachingCourses4b = FacultyTeachingCources::
            with('campus','lookup_faculty_type','designation', 'faculty_program')
                ->where($whereb)->get();

            $mission = DB::select(' SELECT mission_visions.* from mission_visions, business_schools, campuses
            WHERE business_schools.id=?  AND mission_visions.campus_id=campuses.id AND mission_visions.campus_id=? AND mission_visions.deleted_at is null AND mission_visions.type = "REG"',
                array($req->bid, $req->cid));
                

            $strategicPlans = DB::select(' SELECT strategic_plans.* from strategic_plans, business_schools, campuses WHERE business_schools.id=? AND strategic_plans.type="REG" AND strategic_plans.campus_id=campuses.id AND strategic_plans.campus_id=? AND strategic_plans.deleted_at is null', array($req->bid, $req->cid));


             $programsPortfolio = DB::select('SELECT program_portfolios.*, programs.name as programName, course_types.name as courseType
                FROM program_portfolios, programs, course_types, business_schools, campuses
                WHERE program_portfolios.program_id=programs.id AND program_portfolios.type="REG" AND program_portfolios.course_type_id=course_types.id AND business_schools.id=? AND program_portfolios.campus_id=campuses.id AND program_portfolios.campus_id=? AND program_portfolios.deleted_at is null', array($req->bid, $req->cid));

             $entryRequirements = DB::select('SELECT entry_requirements.*, eligibility_criterias.name as eligibilityCriteria, programs.name as programName FROM entry_requirements, eligibility_criterias, programs, campuses WHERE entry_requirements.program_id=programs.id AND entry_requirements.type="REG" AND entry_requirements.eligibility_criteria_id=eligibility_criterias.id AND entry_requirements.campus_id=campuses.id AND entry_requirements.campus_id=?   AND entry_requirements.deleted_at is null AND entry_requirements.department_id=?
             ', array($req->cid, $req->did));
             //dd($userCampus[0]->campus_id);
             //dd($entryRequirements);
             $applicationsReceived = DB::select('SELECT application_receiveds.*, programs.name as programName
                FROM application_receiveds, programs
                WHERE application_receiveds.program_id=programs.id
                  AND application_receiveds.type="REG"
                  AND application_receiveds.deleted_at is null
                  AND campus_id=?', array($req->cid));


             $studentsEnrolment = DB::select('SELECT student_enrolments.* FROM student_enrolments, campuses WHERE student_enrolments.campus_id=campuses.id AND student_enrolments.type="REG" AND campuses.id=? AND student_enrolments.year>YEAR(CURDATE())-4 AND student_enrolments.deleted_at is null', array($req->cid));

             $graduatedStudents = DB::select('SELECT students_graduateds.*, programs.name as programName FROM students_graduateds, programs, campuses WHERE students_graduateds.campus_id=campuses.id AND students_graduateds.type="REG" AND students_graduateds.program_id=programs.id AND students_graduateds.campus_id=? AND students_graduateds.deleted_at is null', array($req->cid));


             $studentsGenders = DB::select('SELECT student_genders.*, programs.name as programName from student_genders, programs, campuses WHERE student_genders.campus_id=campuses.id AND student_genders.type="REG" AND student_genders.program_id=programs.id AND student_genders.campus_id=? AND student_genders.deleted_at is null', array($req->cid));


             $faculty_summaries = FacultySummary::with('campus','faculty_qualification','discipline')
                ->where(['campus_id' => $req->cid, 'department_id' => $req->did, 'type' => 'REG'])
                ->whereNull('deleted_at')
                ->orderBy('faculty_qualification_id')
                ->orderBy('discipline_id')
                ->get();

             $faculty_qualifications = [];
             $faculty_disciplines= [];
             foreach($faculty_summaries as $summary){
                if(!in_array($summary->discipline->name, $faculty_disciplines)){
                    $faculty_disciplines[] = $summary->discipline->name;
                }
                if(array_key_exists($summary->faculty_qualification->name, $faculty_qualifications)){
                    $faculty_qualifications[$summary->faculty_qualification->name][] = $summary->number_faculty;
                }else{
                    $faculty_qualifications[$summary->faculty_qualification->name] = [$summary->number_faculty];
                }
             }

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

            //dd($currSemester);
            //dd($prevSemester);
            $getYear = BusinessSchoolTyear::where(['campus_id'=>$req->cid])->get()->first();
            if($getYear){
            $facultyWorkLoad = DB::table('work_loads')
                ->join('campuses', 'work_loads.campus_id', '=', 'campuses.id')
                ->join('designations', 'work_loads.designation_id', '=', 'designations.id')
                ->where(['work_loads.type' => 'REG', 'work_loads.campus_id' => $req->cid, 'work_loads.year_t' => $getYear->tyear])
                ->whereNull('work_loads.deleted_at')
                ->select(
                    'work_loads.*',
                    'designations.name as designationName'
                )
                ->get();

            $facultyWorkLoadb = DB::table('work_loads')
                ->join('campuses', 'work_loads.campus_id', '=', 'campuses.id')
                ->join('designations', 'work_loads.designation_id', '=', 'designations.id')
                ->where(['work_loads.type' => 'REG', 'work_loads.campus_id' => $req->cid, 'work_loads.year_t' => $getYear->year_t_1])
                ->whereNull('work_loads.deleted_at')
                ->select(
                    'work_loads.*',
                    'designations.name as designationName'
                )
                ->get();
            }else{
                $facultyWorkLoad = [];
                $facultyWorkLoadb = [];
            }
            $facultyTeachingCourses = DB::select('
               SELECT faculty_teaching_cources.*, lookup_faculty_types.faculty_type as lookupFacultyType,
               designations.name as desName FROM faculty_teaching_cources, lookup_faculty_types, designations, campuses, users
               WHERE faculty_teaching_cources.campus_id=campuses.id
               AND faculty_teaching_cources.type="REG"
               AND faculty_teaching_cources.lookup_faculty_type_id=lookup_faculty_types.id
               AND faculty_teaching_cources.designation_id=designations.id
               AND faculty_teaching_cources.campus_id=? AND users.id=?',
                array($req->cid, auth()->user()->id));
            $where = ['campus_id'=> $req->cid, 'department_id'=> $req->did, 'type' => 'REG'];


            $facultyTeachingCourses = FacultyTeachingCources::
                with('campus','lookup_faculty_type','designation', 'faculty_program')
                ->where($where)
                ->where(function($query){
                    $query->where('lookup_faculty_type_id', 1)->orwhere('lookup_faculty_type_id', 2);
                })
                ->get();
            // dd($facultyTeachingCourses);
             $studentTeachersRatio = DB::select('SELECT faculty_student_ratio.*, programs.name as programName
FROM faculty_student_ratio, programs, campuses WHERE faculty_student_ratio.campus_id=campuses.id
AND faculty_student_ratio.type="REG" AND faculty_student_ratio.program_id=programs.id
AND faculty_student_ratio.deleted_at is null
AND  faculty_student_ratio.campus_id=?', array( $req->cid));

              $facultyStability = DB::select('SELECT faculty_stability.* FROM faculty_stability, campuses, users WHERE faculty_stability.campus_id=campuses.id AND faculty_stability.type="REG" AND faculty_stability.campus_id=? AND users.id=? AND faculty_stability.deleted_at is null', array( $req->cid,auth()->user()->id));
              $facultyGenders = DB::select('SELECT faculty_genders.*, lookup_faculty_types.faculty_type as facultyTypeName
                FROM faculty_genders, lookup_faculty_types, campuses, users
                WHERE faculty_genders.campus_id=campuses.id
                AND faculty_genders.type="REG" AND faculty_genders.lookup_faculty_type_id=lookup_faculty_types.id
                AND faculty_genders.deleted_at is null
                AND faculty_genders.campus_id=? ', array($req->cid));
                $facultyDegree = FacultyDegree::where(['campus_id' => $req->cid])->get()->first();
               $researchOutput = DB::select('SELECT research_summaries.*, publication_types.name as publicationName,
publication_categories.name as publicationType FROM publication_categories,research_summaries, publication_types,
campuses, users WHERE research_summaries.campus_id=campuses.id AND research_summaries.type="REG" AND publication_categories.id=publication_types.publication_category_id AND research_summaries.publication_type_id=publication_types.id AND users.id=? AND research_summaries.campus_id=? AND research_summaries.deleted_at is null ORDER BY publication_categories.name', array(auth()->user()->id, $req->cid ));

               $financialInfos = DB::select('SELECT financial_infos.*, income_sources.particular as particularName, income_sources.type as particularType FROM financial_infos, income_sources, campuses, users WHERE financial_infos.campus_id=campuses.id AND financial_infos.type="REG" AND financial_infos.income_source_id=income_sources.id AND financial_infos.campus_id=? AND users.id=? AND financial_infos.deleted_at is null ORDER BY income_sources.type', array($req->cid, auth()->user()->id));
               
               $ratios = FacultyStudentRatio::with('campus','program')
                ->where(['campus_id'=> $req->cid,'department_id'=> $req->did])
                ->where('type','REG')
                ->where('deleted_at',null)
                ->get();
                $getFTE = FacultyTeachingCources::with('faculty_program')
                    ->where('campus_id', $req->cid)
                    ->where('department_id', $req->did)
                    ->where('type', 'REG')
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
                    ->where('type', 'REG')
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
               $BIResources = DB::select('SELECT business_school_facilities.*, facilities.name as facilityName, facility_types.name as facilityType
FROM business_school_facilities, facilities, facility_types, users, campuses
WHERE business_school_facilities.campus_id=campuses.id
AND business_school_facilities.type="REG"
AND business_school_facilities.facility_id=facilities.id
ANd business_school_facilities.deleted_at is null
AND users.id=? AND business_school_facilities.campus_id=? AND facilities.facility_type_id=facility_types.id ORDER BY facility_types.name', array(auth()->user()->id,$req->cid));
        }
        else{
            $department_id = Auth::user()->department_id;
            $campus_id = Auth::user()->campus_id;
            /////////////////header data ////////
            $docHeaderData = Slip::with('campus', 'department')
                ->where(
                    [
                        'business_school_id'=>$campus_id,
                        'department_id'=>$department_id
                    ]
                )->get()->first();

            $bussinessSchool  = DB::table('users')
                ->leftJoin('business_schools', 'users.business_school_id', '=', 'business_schools.id')
                ->leftJoin('institute_types','business_schools.institute_type_id','=','institute_types.id')
                ->leftJoin('charter_types','business_schools.charter_type_id','=','charter_types.id')
                ->leftJoin('designations','users.designation_id','=','designations.id')
                ->where('users.id',auth()->user()->id)
                ->where('business_schools.deleted_at', NULL)
                ->select('business_schools.*','institute_types.name as typeName', 'charter_types.name as charterName', 'designations.name as designationName' )
                ->get();

            // dd($bussinessSchool);

            $userCampus = DB::select('SELECT * from users where id=?', array(Auth::id()));
            //dd($userCampus[0]->campus_id);
            $campuses = Campus::where('business_school_id', $bussinessSchool[0]->id)
                ->where('deleted_at', null)
                ->get();

           $scopeOfAcredation = DB::select('SELECT scopes.*, programs.name as programName, levels.name as levelName
FROM scopes, programs, levels, campuses WHERE scopes.campus_id=campuses.id
AND scopes.type="REG"
AND scopes.program_id=programs.id
AND scopes.level_id=levels.id
AND scopes.campus_id=?
AND scopes.deleted_at is null
AND scopes.department_id=?', array($campus_id, $department_id));


//
//dd($scopeOfAcredation);
//            $contactInformation = DB::select('SELECT contact_infos.*
//                FROM contact_infos
//                WHERE contact_infos.type="REG"
//                AND contact_infos.campus_id=?
//                AND contact_infos.department_id=?',
//                array($campus_id, $department_id));

            $contactInformation = ContactInfo::where(['type'=> 'REG', 'department_id'=>$department_id, 'campus_id'=>$campus_id, 'deleted_at'=> null])->get();
//            dd($contactInformation);


            $statutoryCommitties = DB::table('statutory_committees')
                ->join('statutory_bodies', 'statutory_committees.statutory_body_id', '=', 'statutory_bodies.id')
                ->join('designations', 'statutory_committees.designation_id', '=', 'designations.id')
                ->where('statutory_committees.type', '=', 'REG')
                ->whereNull('statutory_committees.deleted_at')
                ->where('statutory_committees.campus_id', $campus_id)
                ->where('statutory_committees.department_id', $department_id)
                ->select(
                    'statutory_committees.*',
                    'statutory_bodies.name as statutoryName',
                    'designations.name as designationName'
                )
                ->get();



            $affiliations = DB::table('affiliations')
                ->join('statutory_bodies', 'affiliations.statutory_bodies_id', '=', 'statutory_bodies.id')
                ->join('designations', 'affiliations.designation_id', '=', 'designations.id')
                ->where('affiliations.type', '=', 'REG')
                ->whereNull('affiliations.deleted_at')
                ->where('affiliations.campus_id', $campus_id)
                ->where('affiliations.department_id', $department_id)
                ->select(
                    'affiliations.*',
                    'statutory_bodies.name as statutoryBody',
                    'designations.name as designationName'
                )
                ->get();

             $budgetoryInfo = DB::select(' SELECT budgetary_infos.* FROM budgetary_infos, business_schools, campuses
 WHERE business_schools.id=? AND budgetary_infos.type="REG"
   AND  budgetary_infos.campus_id=campuses.id
   AND budgetary_infos.deleted_at is null
   AND budgetary_infos.campus_id=?
   AND budgetary_infos.department_id=?', array($bussinessSchool[0]->id, $campus_id, $department_id));





             $strategicPlans = DB::select(' SELECT strategic_plans.* from strategic_plans, business_schools, campuses
 WHERE business_schools.id=? AND strategic_plans.type="REG"
   AND strategic_plans.campus_id=campuses.id
   AND strategic_plans.campus_id=?
   AND strategic_plans.department_id=?
   AND strategic_plans.deleted_at is null',
   array($bussinessSchool[0]->id, $campus_id, $department_id));

             $mission    = DB::select(' SELECT mission_visions.* from mission_visions, business_schools, campuses
 WHERE business_schools.id=?
   AND mission_visions.campus_id=campuses.id
   AND mission_visions.deleted_at is null
   AND mission_visions.campus_id=?
   AND mission_visions.type =?
   AND mission_visions.department_id=?', array($bussinessSchool[0]->id, $campus_id,"REG", $department_id));


             $programsPortfolio = DB::select('SELECT program_portfolios.*, programs.name as programName, course_types.name as courseType
                FROM program_portfolios, programs, course_types, business_schools, campuses
                WHERE program_portfolios.program_id=programs.id
                  AND program_portfolios.type="REG"
                  AND program_portfolios.course_type_id=course_types.id
                  AND program_portfolios.deleted_at is null
                  AND business_schools.id=?
                  AND program_portfolios.campus_id=campuses.id
                  AND program_portfolios.campus_id=?', array($bussinessSchool[0]->id, auth()->user()->campus_id));

             $entryRequirements = DB::select('SELECT entry_requirements.*, eligibility_criterias.name as eligibilityCriteria, programs.name as programName
FROM entry_requirements, eligibility_criterias, programs, campuses
WHERE entry_requirements.program_id=programs.id
  AND entry_requirements.type="REG"
  AND entry_requirements.deleted_at is null
  AND entry_requirements.eligibility_criteria_id=eligibility_criterias.id
  AND entry_requirements.campus_id=campuses.id
  AND entry_requirements.campus_id=?
  AND entry_requirements.department_id=?', array($userCampus[0]->campus_id, $department_id));
             //dd($userCampus[0]->campus_id);
             //dd($entryRequirements);
             $applicationsReceived = DB::select('SELECT application_receiveds.*, programs.name as programName
FROM application_receiveds, programs
WHERE application_receiveds.program_id=programs.id
  AND application_receiveds.type="REG"
  AND application_receiveds.deleted_at is null
  AND campus_id=?
  AND application_receiveds.department_id=?', array($campus_id, $department_id));

             $app_Received = DB::select('SELECT app_receiveds.*, programs.name as programName
            FROM app_receiveds, programs
            WHERE app_receiveds.program_id=programs.id AND app_receiveds.type="REG"
              AND app_receiveds.deleted_at is null
            AND campus_id=?
           AND app_receiveds.department_id=?', array($campus_id, $department_id));


             $studentsEnrolment = DB::select('SELECT student_enrolments.* FROM student_enrolments, campuses
WHERE student_enrolments.campus_id=campuses.id
AND campuses.id=?
AND student_enrolments.department_id=?
AND student_enrolments.type="REG"
AND student_enrolments.deleted_at is null
AND student_enrolments.year>YEAR(CURDATE())-4', array($campus_id, $department_id));

            // dd($studentsEnrolment);
             $graduatedStudents = DB::select('SELECT students_graduateds.*, programs.name as programName
                FROM students_graduateds, programs, campuses
                WHERE students_graduateds.campus_id=campuses.id
                AND students_graduateds.type="REG"
                  AND students_graduateds.deleted_at is null
                AND students_graduateds.program_id=programs.id
                AND students_graduateds.campus_id=?
                AND students_graduateds.department_id=?', array($campus_id, $department_id));


             $studentsGenders = DB::select('SELECT student_genders.*, programs.name as programName
from student_genders, programs, campuses
WHERE student_genders.campus_id=campuses.id AND student_genders.type="REG"
  AND student_genders.program_id=programs.id
  AND student_genders.deleted_at is null
  AND student_genders.campus_id=?
  AND student_genders.department_id=?', array($campus_id, $department_id));


             $faculty_summaries = FacultySummary::with('campus','faculty_qualification','discipline')
                ->where(['campus_id' => $campus_id, 'department_id' => $department_id, 'type' => 'REG'])
                ->whereNull('deleted_at')
                ->orderBy('faculty_qualification_id')
                ->orderBy('discipline_id')
                ->get();

             $faculty_qualifications = [];
             $faculty_disciplines= [];
             foreach($faculty_summaries as $summary){
                if(!in_array($summary->discipline->name, $faculty_disciplines)){
                    $faculty_disciplines[] = $summary->discipline->name;
                }
                if(array_key_exists($summary->faculty_qualification->name, $faculty_qualifications)){
                    $faculty_qualifications[$summary->faculty_qualification->name][] = $summary->number_faculty;
                }else{
                    $faculty_qualifications[$summary->faculty_qualification->name] = [$summary->number_faculty];
                }
             }
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

            //dd($currSemester);
            //dd($prevSemester);

            $userInfo = Auth::user();
            $getYear = BusinessSchoolTyear::where(['campus_id'=> $userInfo->campus_id, 'department_id' => $userInfo->department_id])->get()->first();
            if($getYear){
                $facultyWorkLoad = DB::table('work_loads')
                    ->join('campuses', 'work_loads.campus_id', '=', 'campuses.id')
                    ->join('designations', 'work_loads.designation_id', '=', 'designations.id')
                    ->where(['work_loads.type' => 'REG', 'work_loads.campus_id' => $userCampus[0]->campus_id, 'work_loads.year_t' => $getYear->tyear, 'work_loads.department_id' =>$department_id])
                    ->whereNull('work_loads.deleted_at')
                    ->select(
                        'work_loads.*',
                        'designations.name as designationName'
                    )
                    ->get();
            
                $facultyWorkLoadb = DB::table('work_loads')
                    ->join('campuses', 'work_loads.campus_id', '=', 'campuses.id')
                    ->join('designations', 'work_loads.designation_id', '=', 'designations.id')
                    ->where(['work_loads.type' => 'REG', 'work_loads.campus_id' => $userCampus[0]->campus_id, 'work_loads.year_t' => $getYear->year_t_1, 'work_loads.department_id' =>$department_id])
                    ->whereNull('work_loads.deleted_at')
                    ->select(
                        'work_loads.*',
                        'designations.name as designationName'
                    )
                    ->get();
            
            }else{
                $facultyWorkLoad = [];
                $facultyWorkLoadb =[];
            }

            // $facultyTeachingCourses = DB::select('SELECT faculty_teaching_cources.*,
            // lookup_faculty_types.faculty_type as lookupFacultyType, designations.name as desName FROM faculty_teaching_cources,
            // lookup_faculty_types, designations, campuses, users WHERE faculty_teaching_cources.campus_id=campuses.id
            // AND faculty_teaching_cources.type="REG" AND faculty_teaching_cources.lookup_faculty_type_id=lookup_faculty_types.id
            // AND faculty_teaching_cources.designation_id=designations.id AND faculty_teaching_cources.campus_id=?
            // AND users.department_id=? AND users.id=?', array($userCampus[0]->campus_id, $userCampus[0]->department_id,
            // auth()->user()->id));

             $where = ['campus_id'=> Auth::user()->campus_id,'department_id'=>Auth::user()->department_id, 'type' => 'REG', 'deleted_at'=> null];
//            $where = ['campus_id'=> $req->cid, 'department_id'=> Auth::user()->department_id, 'type' => 'REG'];
             $facultyTeachingCourses = FacultyTeachingCources::
             with('campus','lookup_faculty_type','designation', 'faculty_program')
                //  ->where('lookup_faculty_type_id',  1)
                //  ->Where('lookup_faculty_type_id',  2)
                 ->where($where)
                 ->where(function($query){
                    $query->where('lookup_faculty_type_id', 1)->orwhere('lookup_faculty_type_id', 2);
                })
                 ->get();

            // dd($facultyTeachingCourses);
             $whereb = ['campus_id'=> $userInfo->campus_id,'department_id'=>$userInfo->department_id, 'deleted_at'=> null,  'type' => 'REG', 'lookup_faculty_type_id' => 3];
             $facultyTeachingCourses4b = FacultyTeachingCources::
             with('campus','lookup_faculty_type','designation', 'faculty_program')
                ->where($whereb)->get();

//             dd($facultyTeachingCourses4b);

             $studentTeachersRatio = DB::select('SELECT faculty_student_ratio.*, programs.name as programName
FROM faculty_student_ratio, programs, campuses, users
WHERE faculty_student_ratio.campus_id=campuses.id
AND faculty_student_ratio.type="REG"
  AND faculty_student_ratio.program_id=programs.id
  AND faculty_student_ratio.deleted_at = null
AND users.department_id=?
  AND faculty_student_ratio.campus_id=?', array($userCampus[0]->department_id, $userCampus[0]->campus_id));

              $facultyStability = DB::select('SELECT faculty_stability.*
                FROM faculty_stability, campuses, users
                WHERE faculty_stability.campus_id=campuses.id
                  AND faculty_stability.type="REG"
                  AND users.department_id=?
                  AND faculty_stability.campus_id=?
                  AND faculty_stability.deleted_at is null
                  AND users.id=?', array($department_id, $campus_id,auth()->user()->id));


              $facultyGenders = DB::select('SELECT faculty_genders.*, lookup_faculty_types.faculty_type as facultyTypeName
                FROM faculty_genders, lookup_faculty_types, campuses, users
                WHERE faculty_genders.campus_id=campuses.id
                AND faculty_genders.type="REG"
                AND faculty_genders.lookup_faculty_type_id=lookup_faculty_types.id
                AND users.id=?
                AND faculty_genders.campus_id=?
                AND faculty_genders.deleted_at is null
                AND users.department_id=?',
                  array(auth()->user()->id, $userCampus[0]->campus_id, $userCampus[0]->department_id));
                $facultyDegree = FacultyDegree::where(['campus_id' => Auth::user()->campus_id])->get()->first();
               $researchOutput = DB::select('SELECT research_summaries.*, publication_types.name as publicationName,
                publication_categories.name as publicationType
                FROM publication_categories,research_summaries, publication_types, campuses, users
                WHERE research_summaries.campus_id=campuses.id
                    AND research_summaries.type="REG"
                    AND publication_categories.id=publication_types.publication_category_id
                    AND research_summaries.publication_type_id=publication_types.id
                    AND users.id=? AND users.department_id=?
                    AND research_summaries.deleted_at is null
                    AND research_summaries.campus_id=? ORDER BY publication_categories.name', array(auth()->user()->id, $userCampus[0]->department_id, $userCampus[0]->campus_id ));

               $financialInfos = DB::select('SELECT financial_infos.*, income_sources.particular as particularName, income_sources.type as particularType
                FROM financial_infos, income_sources, campuses, users
                WHERE financial_infos.campus_id=campuses.id
                  AND financial_infos.type="REG"
                  AND financial_infos.income_source_id=income_sources.id
                  AND financial_infos.deleted_at is null
                  AND financial_infos.campus_id=? AND users.id=? ORDER BY income_sources.type', array( $userCampus[0]->campus_id, auth()->user()->id));

                // $BIResources = BusinessSchoolFacility::with('facility_types','facility')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->where('type','REG')->get();
              $BIResources = DB::select('SELECT business_school_facilities.*, facilities.name as facilityName,
facility_types.name as facilityType FROM business_school_facilities, facilities, facility_types, users, campuses
WHERE business_school_facilities.campus_id=campuses.id AND business_school_facilities.type="REG"
AND business_school_facilities.facility_id=facilities.id AND users.id=?
  AND business_school_facilities.campus_id=?
  AND business_school_facilities.department_id=?
  AND business_school_facilities.deleted_at is null
  AND facilities.facility_type_id=facility_types.id
ORDER BY facility_types.name', array(auth()->user()->id, $userCampus[0]->campus_id, $department_id));
// dd($BIResources);
            $ratios = FacultyStudentRatio::with('campus','program')
                ->where(['campus_id'=> $userCampus[0]->campus_id,'department_id'=> $userCampus[0]->department_id])
                ->where('type','REG')
                ->where('deleted_at',null)
                ->get();
            $getFTE = FacultyTeachingCources::with('faculty_program')
                ->where('campus_id', $userCampus[0]->campus_id)
                ->where('department_id', $userCampus[0]->department_id)
                ->where('type', 'REG')
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
                ->where('type', 'REG')
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
        }
        
        // dd($facultyTeachingCourses);
        return view('strategic_management.registration_application', compact(
            'app_Received','facultyTeachingCourses4b','bussinessSchool','campuses','scopeOfAcredation',
            'contactInformation','statutoryCommitties','affiliations','budgetoryInfo', 'strategicPlans',
            'programsPortfolio','entryRequirements','applicationsReceived','studentsEnrolment','graduatedStudents',
            'studentsGenders','facultyWorkLoad','facultyWorkLoadb','facultyTeachingCourses',
            'studentTeachersRatio','facultyStability',
            'facultyGenders','financialInfos','researchOutput','BIResources','docHeaderData',
            'programsUnderReview','mission','ratios', 'byProgramFTE', 'byProgramVFE','facultyDegree','faculty_qualifications','faculty_disciplines'));

        // return view('strategic_management.registration_application', compact(
        //     'app_Received','facultyTeachingCourses4b','bussinessSchool','campuses','scopeOfAcredation',
        //     'contactInformation','statutoryCommitties','affiliations','budgetoryInfo', 'strategicPlans',
        //     'programsPortfolio','entryRequirements','applicationsReceived','studentsEnrolment','graduatedStudents',
        //     'studentsGenders','facultySummary','facultyWorkLoad','facultyWorkLoadb','facultyTeachingCourses',
        //     'studentTeachersRatio','facultyStability',
        //     'facultyGenders','financialInfos','researchOutput','BIResources','docHeaderData',
        //     'programsUnderReview','mission','ratios', 'totalFTE', 'totalVFE'));
    }

     public static function getfacultySummary($i, $facultySummary, $userCampus, $type){
//        dd($i,$facultySummary,$userCampus);


            $facultySummary12 = DB::select('
            SELECT faculty_summaries.*, disciplines.name as disciplineName
            FROM faculty_summaries, disciplines,users
            WHERE faculty_summaries.deleted_at IS NULL 
            AND faculty_summaries.discipline_id=disciplines.id
            AND faculty_summaries.faculty_qualification_id=?
            AND faculty_summaries.campus_id=?
            AND users.id=?
            AND faculty_summaries.type =?
            ', array($facultySummary[$i]->id,$userCampus,auth()->user()->id,$type));
            return $facultySummary12;
    }




    public function createPDF() {
      $bussinessSchool  = DB::table('users')
            ->leftJoin('business_schools', 'users.business_school_id', '=', 'business_schools.id')
            ->leftJoin('institute_types','business_schools.institute_type_id','=','institute_types.id')
            ->leftJoin('charter_types','business_schools.charter_type_id','=','charter_types.id')
            ->leftJoin('designations','business_schools.cao_id','=','designations.id')
            ->where('users.id',Auth::id())
            ->select('business_schools.*','institute_types.name as typeName', 'charter_types.name as charterName', 'designations.name as designationName' )
            ->all();



        $userCampus = DB::select('SELECT * from users where id=?', array(Auth::id()));
        //dd($userCampus[0]->campus_id);
        $campuses = Campus::where('business_school_id', $bussinessSchool[0]->id)->all();

         $scopeOfAcredation = DB::select('SELECT scopes.*, programs.name as programName, levels.name as levelName FROM scopes, programs, levels, campuses WHERE scopes.campus_id=campuses.id AND scopes.program_id=programs.id AND scopes.level_id=levels.id AND scopes.campus_id=?', array(Auth::user()->campus_id));


        $contactInformation = DB::select('SELECT contact_infos.*, designations.name as designationName, designations.id as designationId FROM designations, contact_infos, business_schools WHERE designations.id=contact_infos.designation_id AND business_schools.id=?', array($bussinessSchool[0]->id));


        $statutoryCommitties = DB::select('SELECT statutory_committees.*,statutory_bodies.name as statutoryName from statutory_committees, statutory_bodies, business_schools WHERE statutory_committees.statutory_body_id=statutory_bodies.id AND business_schools.id=? AND statutory_committees.campus_id=?', array($bussinessSchool[0]->id, auth()->user()->campus_id));

      // share data to view
      view()->share('campuses',$campuses);
      $pdf = PDF::loadView('pdf_view', $campuses);

      // download PDF file with download method
      return $pdf->download('pdf_file.pdf');
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
