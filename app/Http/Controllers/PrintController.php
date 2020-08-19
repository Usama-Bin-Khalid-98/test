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


        $statutoryCommitties = DB::select('SELECT statutory_committees.*,statutory_bodies.name as statutoryName, designations.name as designationName from statutory_committees, statutory_bodies, business_schools, designations WHERE statutory_committees.statutory_body_id=statutory_bodies.id AND statutory_committees.designation_id=designations.id AND business_schools.id=?', array($bussinessSchool[0]->id));


         $affiliations = DB::select('SELECT affiliations.*,statutory_committees.name as statutoryName, statutory_bodies.name as statutoryBody, designations.name as designationName
            FROM affiliations, statutory_committees, statutory_bodies, business_schools, designations
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
           
        return view('strategic_management.printAll', compact('bussinessSchool','campuses','scopeOfAcredation', 'contactInformation','statutoryCommitties','affiliations','budgetoryInfo', 'sourceOfFunding', 'strategicPlans', 'programsPortfolio','studentEnrolment','facultyWorkLoad','facultyWorkLoadb','facultyGenders'));
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
