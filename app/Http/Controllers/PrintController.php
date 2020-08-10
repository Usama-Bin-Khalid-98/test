<?php

namespace App\Http\Controllers;
use App\BusinessSchool;
use App\Models\Common\Campus;
use App\Models\StrategicManagement\Scope;
use Illuminate\Http\Request;
use DB;
use Auth;

class PrintController extends Controller
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

        $campuses = Campus::where('business_school_id', $bussinessSchool[0]->id)->get();



        $scopeOfAcredation = DB::table('scopes')
        ->leftJoin('programs','scopes.program_id','=','programs.id')
        ->leftJoin('levels','scopes.level_id','=','levels.id')
        ->select('scopes.*','levels.name as levelName', 'programs.name as programName')
        ->where('scopes.campus_id',$bussinessSchool[0]->id)
        ->get();


<<<<<<< HEAD
        $contactInformation = DB::select('SELECT contact_infos.*, designations.name as designationName, designations.id as designationId FROM designations, contact_infos, business_schools WHERE designations.id=contact_infos.designation_id AND business_schools.id=?', array($bussinessSchool[0]->id));
=======
        $contactInformation = DB::table('contact_infos')
        ->leftJoin('designations','contact_infos.designation_id','=','designations.id')        
        ->select('contact_infos.*','designations.name as designationName')
        ->where('contact_infos.campus_id',$bussinessSchool[0]->id)
        ->get();
>>>>>>> fb5ba0be3d2c2c24a2617060c6f106a0c26b7269


        $statutoryCommitties = DB::select('SELECT statutory_committees.*,statutory_bodies.name as statutoryName, designations.name as designationName from statutory_committees, statutory_bodies, business_schools, designations WHERE statutory_committees.statutory_body_id=statutory_bodies.id AND statutory_committees.designation_id=designations.id AND business_schools.id=?', array($bussinessSchool[0]->id));


         $affiliations = DB::select('SELECT affiliations.*,statutory_committees.name as statutoryName, statutory_bodies.name as statutoryBody, designations.name as designationName
            FROM affiliations, statutory_committees, statutory_bodies, business_schools, designations
<<<<<<< HEAD
            WHERE affiliations.statutory_bodies_id=statutory_committees.id AND affiliations.statutory_bodies_id=statutory_bodies.id AND affiliations.designation_id=designations.id AND business_schools.id=?', array($bussinessSchool[0]->id));
=======
            WHERE  affiliations.statutory_bodies_id=statutory_bodies.id AND affiliations.designation_id=designations.id AND business_schools.id=?', array($bussinessSchool[0]->id));
>>>>>>> fb5ba0be3d2c2c24a2617060c6f106a0c26b7269


         $budgetoryInfo = DB::select(' SELECT budgetary_infos.* from budgetary_infos, business_schools WHERE business_schools.id=?', array($bussinessSchool[0]->id));


          $sourceOfFunding = DB::select('SELECT financial_infos.*, income_sources.particular as incomeSource FROM financial_infos, income_sources, business_schools WHERE financial_infos.income_source_id=income_sources.id AND business_schools.id=financial_infos.campus_id AND business_schools.id=?', array($bussinessSchool[0]->id));


         $strategicPlans = DB::select(' SELECT strategic_plans.* from strategic_plans, business_schools WHERE business_schools.id=?', array($bussinessSchool[0]->id));

         $programsPortfolio = DB::select('SELECT program_portfolios.*, programs.name as programName, course_types.name as courseType
            FROM program_portfolios, programs, course_types, business_schools
            WHERE program_portfolios.program_id=programs.id AND program_portfolios.course_type_id=course_types.id AND business_schools.id=?', array($bussinessSchool[0]->id));

<<<<<<< HEAD
         $programsCourses[1] = DB::select('SELECT program_portfolios.*, programs.name as programName, programs.id as programId, course_types.name as courseName,pr.name as preReq FROM program_portfolios, programs, campuses, course_types, programs as pr WHERE program_portfolios.program_id=programs.id AND program_portfolios.campus_id=campuses.id AND program_portfolios.course_type_id=course_types.id AND program_portfolios.pre_req_id=pr.id AND program_portfolios.course_type_id=?', array(1));
         $programsCourses[2] = DB::select('SELECT program_portfolios.*, programs.name as programName, programs.id as programId, course_types.name as courseName,pr.name as preReq FROM program_portfolios, programs, campuses, course_types, programs as pr WHERE program_portfolios.program_id=programs.id AND program_portfolios.campus_id=campuses.id AND program_portfolios.course_type_id=course_types.id AND program_portfolios.pre_req_id=pr.id AND program_portfolios.course_type_id=?', array(2));
         $programsCourses[3] = DB::select('SELECT program_portfolios.*, programs.name as programName, programs.id as programId, course_types.name as courseName,pr.name as preReq FROM program_portfolios, programs, campuses, course_types, programs as pr WHERE program_portfolios.program_id=programs.id AND program_portfolios.campus_id=campuses.id AND program_portfolios.course_type_id=course_types.id AND program_portfolios.pre_req_id=pr.id AND program_portfolios.course_type_id=?', array(3));
           
        return view('strategic_management.printAll', compact('bussinessSchool','campuses','scopeOfAcredation', 'contactInformation','statutoryCommitties','affiliations','budgetoryInfo', 'sourceOfFunding', 'strategicPlans', 'programsPortfolio','programsCourses'));
=======
         $studentEnrolment = DB::select('SELECT student_enrolments.*
            FROM student_enrolments , business_schools
            WHERE business_schools.id=?', array($bussinessSchool[0]->id));
           
        return view('strategic_management.printAll', compact('bussinessSchool','campuses','scopeOfAcredation', 'contactInformation','statutoryCommitties','affiliations','budgetoryInfo', 'sourceOfFunding', 'strategicPlans', 'programsPortfolio','studentEnrolment'));
>>>>>>> fb5ba0be3d2c2c24a2617060c6f106a0c26b7269
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
