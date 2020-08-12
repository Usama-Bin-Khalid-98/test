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
         //if($facultySummary[0]){
             /*for($i=0;$i<count($facultySummary[0]);$i++) {
               
                $facultySummary[1][$i] = $this->getfacultySummary($i,$facultySummary[0],$userCampus[0]);

             }*/
         //}
         // dd($facultySummary[1]);
        return view('strategic_management.registration_application', compact('bussinessSchool','campuses','scopeOfAcredation', 'contactInformation','statutoryCommitties','affiliations','budgetoryInfo', 'strategicPlans', 'programsPortfolio','entryRequirements','applicationsReceived','studentsEnrolment','graduatedStudents','studentsGenders','facultySummary'));
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
