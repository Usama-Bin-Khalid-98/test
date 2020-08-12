<?php

namespace App\Http\Controllers;
use App\BusinessSchool;
use App\Models\Common\Campus;
use App\Models\StrategicManagement\Scope;
use Illuminate\Http\Request;
use DB;
use Auth;

class RegistrationPrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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


        $userCampus = DB::select('SELECT * from users where id=?', array(auth()->user()->id));
        //dd($userCampus[0]->campus_id);
        $campuses = Campus::where('business_school_id', $bussinessSchool[0]->id)->get();



        $scopeOfAcredation = DB::table('scopes')
        ->leftJoin('programs','scopes.program_id','=','programs.id')
        ->leftJoin('levels','scopes.level_id','=','levels.id')
        ->select('scopes.*','levels.name as levelName', 'programs.name as programName')
        ->where('scopes.campus_id',$bussinessSchool[0]->id)
        ->get();


        $contactInformation = DB::select('SELECT contact_infos.*, designations.name as designationName, designations.id as designationId FROM designations, contact_infos, business_schools WHERE designations.id=contact_infos.designation_id AND business_schools.id=?', array($bussinessSchool[0]->id));


        $statutoryCommitties = DB::select('SELECT statutory_committees.*,statutory_bodies.name as statutoryName, designations.name as designationName from statutory_committees, statutory_bodies, business_schools, designations WHERE statutory_committees.statutory_body_id=statutory_bodies.id AND statutory_committees.designation_id=designations.id AND business_schools.id=?', array($bussinessSchool[0]->id));


         $affiliations = DB::select('SELECT affiliations.*,statutory_committees.name as statutoryName, statutory_bodies.name as statutoryBody, designations.name as designationName
            FROM affiliations, statutory_committees, statutory_bodies, business_schools, designations
            WHERE affiliations.statutory_bodies_id=statutory_committees.id AND affiliations.statutory_bodies_id=statutory_bodies.id AND affiliations.designation_id=designations.id AND business_schools.id=?', array($bussinessSchool[0]->id));


         $budgetoryInfo = DB::select(' SELECT budgetary_infos.* from budgetary_infos, business_schools WHERE business_schools.id=?', array($bussinessSchool[0]->id));


        


         $strategicPlans = DB::select(' SELECT strategic_plans.* from strategic_plans, business_schools WHERE business_schools.id=?', array($bussinessSchool[0]->id));

         
         $programsPortfolio = DB::select('SELECT program_portfolios.*, programs.name as programName, course_types.name as courseType
            FROM program_portfolios, programs, course_types, business_schools
            WHERE program_portfolios.program_id=programs.id AND program_portfolios.course_type_id=course_types.id AND business_schools.id=?', array($bussinessSchool[0]->id));

         $entryRequirements = DB::select('SELECT entry_requirements.*, eligibility_criterias.name as eligibilityCriteria, programs.name as programName FROM entry_requirements, eligibility_criterias, programs, campuses WHERE entry_requirements.program_id=programs.id AND entry_requirements.eligibility_criteria_id=eligibility_criterias.id AND entry_requirements.campus_id=campuses.id AND entry_requirements.campus_id=?', array($userCampus[0]->campus_id));
         //dd($userCampus[0]->campus_id);
         //dd($entryRequirements);
         $applicationsReceived = DB::select('SELECT application_receiveds.*, programs.name as programName, semesters.name as semesterName FROM application_receiveds, programs, semesters, campuses WHERE application_receiveds.program_id=programs.id AND application_receiveds.semester_id=semesters.id  AND campuses.id=?', array($userCampus[0]->campus_id));


         $studentsEnrolment = DB::select('SELECT student_enrolments.* FROM student_enrolments, campuses WHERE student_enrolments.campus_id=campuses.id AND campuses.id=?', array($userCampus[0]->campus_id));


         $graduatedStudents = DB::select('SELECT students_graduateds.*, programs.name as programName FROM students_graduateds, programs, campuses WHERE students_graduateds.campus_id=campuses.id AND students_graduateds.program_id=programs.id AND students_graduateds.campus_id=?', array($userCampus[0]->campus_id));


         $studentsGenders = DB::select('SELECT student_genders.*, programs.name as programName from student_genders, programs, campuses WHERE student_genders.campus_id=campuses.id AND student_genders.program_id=programs.id AND student_genders.campus_id=?', array($userCampus[0]->campus_id));


         $facultySummary[0] = DB::select('SELECT * FROM faculty_qualifications', array());


         $facultyWorkLoad = DB::select('SELECT work_loads.*, designations.name as designationName FROM work_loads, designations, campuses,users WHERE work_loads.designation_id=designations.id AND work_loads.campus_id=? AND campuses.id=work_loads.campus_id AND users.department_id=?', array($userCampus[0]->campus_id, $userCampus[0]->department_id));

         $facultyTeachingCourses = DB::select('SELECT faculty_teaching_cources.*, lookup_faculty_types.faculty_type as lookupFacultyType, designations.name as designationName FROM faculty_teaching_cources, lookup_faculty_types, designations, campuses, users WHERE faculty_teaching_cources.campus_id=campuses.id AND faculty_teaching_cources.lookup_faculty_type_id=lookup_faculty_types.id AND faculty_teaching_cources.designation_id=designations.id AND faculty_teaching_cources.campus_id=? AND users.department_id=?', array($userCampus[0]->campus_id, $userCampus[0]->department_id));

         $studentTeachersRatio = DB::select('SELECT faculty_student_ratio.*, programs.name as programName FROM faculty_student_ratio, programs, campuses, users WHERE faculty_student_ratio.campus_id=campuses.id AND faculty_student_ratio.program_id=programs.id AND users.department_id=? AND faculty_student_ratio.campus_id=?', array($userCampus[0]->department_id, $userCampus[0]->campus_id));

          $facultyStability = DB::select('SELECT faculty_stability.* FROM faculty_stability, campuses, users WHERE faculty_stability.campus_id=campuses.id AND users.department_id=? AND faculty_stability.campus_id=? AND users.id=?', array($userCampus[0]->department_id, $userCampus[0]->campus_id,auth()->user()->id));

          $facultyGenders = DB::select('SELECT faculty_genders.*, lookup_faculty_types.faculty_type as facultyTypeName FROM faculty_genders, lookup_faculty_types, campuses, users WHERE faculty_genders.campus_id=campuses.id AND faculty_genders.lookup_faculty_type_id=lookup_faculty_types.id AND users.id=? AND faculty_genders.campus_id=? AND users.department_id=?', array(auth()->user()->id, $userCampus[0]->campus_id, $userCampus[0]->department_id));

           $researchOutput = DB::select('SELECT research_summaries.*, publication_types.name as publicationName, publication_types.type as publicationType FROM research_summaries, publication_types, campuses, users WHERE research_summaries.campus_id=campuses.id AND research_summaries.publication_type_id=publication_types.id AND users.id=? AND users.department_id=? AND research_summaries.campus_id=?', array(auth()->user()->id, $userCampus[0]->department_id, $userCampus[0]->campus_id ));

           $financialInfos = DB::select('SELECT financial_infos.*, income_sources.particular as particularName, income_sources.type as particularType FROM financial_infos, income_sources, campuses, users WHERE financial_infos.campus_id=campuses.id AND financial_infos.income_source_id=income_sources.id AND financial_infos.campus_id=? AND users.id=? AND users.department_id=?', array( $userCampus[0]->campus_id, auth()->user()->id, $userCampus[0]->department_id));
         
        return view('strategic_management.registration_application', compact('bussinessSchool','campuses','scopeOfAcredation', 'contactInformation','statutoryCommitties','affiliations','budgetoryInfo', 'strategicPlans', 'programsPortfolio','entryRequirements','applicationsReceived','studentsEnrolment','graduatedStudents','studentsGenders','facultySummary','facultyWorkLoad','facultyTeachingCourses','studentTeachersRatio','facultyStability','facultyGenders','financialInfos','researchOutput'));
    }

     public static function getfacultySummary($i, $facultySummary, $userCampus){
        //dd($facultySummary[$i]->id);
        
            $facultySummary12 = DB::select('SELECT faculty_summaries.*, disciplines.name as disciplineName FROM faculty_summaries, disciplines,users WHERE faculty_summaries.discipline_id=disciplines.id AND faculty_summaries.faculty_qualification_id=? AND faculty_summaries.campus_id=? AND users.department_id=?', array($facultySummary[$i]->id,'209','5'));
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
