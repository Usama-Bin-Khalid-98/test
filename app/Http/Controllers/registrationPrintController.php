<?php

namespace App\Http\Controllers;
use App\BusinessSchool;
use App\Models\Common\Campus;
use App\Models\Common\Slip;
use App\Models\Common\StrategicManagement\BusinessSchoolTyear;
use App\Models\Faculty\FacultyTeachingCources;
use App\Models\StrategicManagement\ContactInfo;
use App\Models\StrategicManagement\Scope;
use Illuminate\Http\Request;
use DB;
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
        /////////////////header data ////////
        $docHeaderData = Slip::with('campus', 'department')
            ->where(
                [
                    'business_school_id'=>Auth::user()->campus_id,
                    'department_id'=>Auth::user()->department_id
                ]
            )->get()->first();
            //dd($docHeaderData);
        $programsUnderReview = Scope::with('program')->where(
            ['campus_id'=>Auth::user()->campus_id, 'department_id' => Auth::user()->department_id])
            ->get();
//        dd($programsUnderReview);
        ///////////////////////////// end header data ///////////
        if(isset($req->cid) && isset($req->bid)){

             $bussinessSchool  = DB::select('SELECT * from business_schools where id=? AND type="REG"', array($req->bid));


            $userCampus = DB::select('SELECT * from users where id=?', array(auth()->user()->id));
            //dd($userCampus[0]->campus_id);
            $campuses = Campus::where('business_school_id', $req->bid)->get();



            $scopeOfAcredation = DB::select('SELECT scopes.*, programs.name as programName, levels.name as levelName FROM scopes, programs, levels, campuses WHERE scopes.campus_id=campuses.id AND scopes.type="REG" AND scopes.program_id=programs.id AND scopes.level_id=levels.id AND scopes.campus_id=?', array($req->cid));


            $contactInformation = DB::select('SELECT contact_infos.*, designations.name as designationName, designations.id as designationId FROM designations, contact_infos, campuses WHERE designations.id=contact_infos.designation_id AND contact_infos.type="REG" AND contact_infos.campus_id=? AND contact_infos.campus_id=campuses.id', array($req->cid));



            $statutoryCommitties = DB::select('SELECT statutory_committees.*,statutory_bodies.name as statutoryName, designations.name as designationName from statutory_committees, statutory_bodies, business_schools, designations WHERE statutory_committees.statutory_body_id=statutory_bodies.id AND statutory_committees.type="REG" AND statutory_committees.designation_id=designations.id AND business_schools.id=? AND statutory_committees.campus_id=?', array($req->bid, $req->cid));


             $affiliations = DB::select('SELECT affiliations.*, statutory_bodies.name as statutoryBody, designations.name as designationName
            FROM affiliations, statutory_bodies, business_schools, designations
            WHERE  affiliations.statutory_bodies_id=statutory_bodies.id AND affiliations.type="REG" AND affiliations.designation_id=designations.id AND business_schools.id=? AND affiliations.campus_id=?', array($req->bid,$req->cid));


             $budgetoryInfo = DB::select(' SELECT budgetary_infos.* from budgetary_infos, business_schools, campuses WHERE business_schools.id=? AND budgetary_infos.type="REG" AND budgetary_infos.campus_id=campuses.id AND budgetary_infos.campus_id=?', array($req->bid, $req->cid));





             $strategicPlans = DB::select(' SELECT strategic_plans.* from strategic_plans, business_schools, campuses WHERE business_schools.id=? AND strategic_plans.type="REG" AND strategic_plans.campus_id=campuses.id AND strategic_plans.campus_id=?', array($req->bid, $req->cid));


             $programsPortfolio = DB::select('SELECT program_portfolios.*, programs.name as programName, course_types.name as courseType
                FROM program_portfolios, programs, course_types, business_schools, campuses
                WHERE program_portfolios.program_id=programs.id AND program_portfolios.type="REG" AND program_portfolios.course_type_id=course_types.id AND business_schools.id=? AND program_portfolios.campus_id=campuses.id AND program_portfolios.campus_id=?', array($req->bid, $req->cid));

             $entryRequirements = DB::select('SELECT entry_requirements.*, eligibility_criterias.name as eligibilityCriteria, programs.name as programName FROM entry_requirements, eligibility_criterias, programs, campuses WHERE entry_requirements.program_id=programs.id AND entry_requirements.type="REG" AND entry_requirements.eligibility_criteria_id=eligibility_criterias.id AND entry_requirements.campus_id=campuses.id AND entry_requirements.campus_id=?', array($req->cid));
             //dd($userCampus[0]->campus_id);
             //dd($entryRequirements);
             $applicationsReceived = DB::select('SELECT application_receiveds.*, programs.name as programName, semesters.name as semesterName FROM application_receiveds, programs, semesters, campuses WHERE application_receiveds.program_id=programs.id AND application_receiveds.type="REG" AND application_receiveds.semester_id=semesters.id  AND campuses.id=?', array($req->cid));


             $studentsEnrolment = DB::select('SELECT student_enrolments.* FROM student_enrolments, campuses WHERE student_enrolments.campus_id=campuses.id AND student_enrolments.type="REG" AND campuses.id=? AND student_enrolments.year>YEAR(CURDATE())-3', array($req->cid));


             $graduatedStudents = DB::select('SELECT students_graduateds.*, programs.name as programName FROM students_graduateds, programs, campuses WHERE students_graduateds.campus_id=campuses.id AND students_graduateds.type="REG" AND students_graduateds.program_id=programs.id AND students_graduateds.campus_id=?', array($req->cid));


             $studentsGenders = DB::select('SELECT student_genders.*, programs.name as programName from student_genders, programs, campuses WHERE student_genders.campus_id=campuses.id AND student_genders.type="REG" AND student_genders.program_id=programs.id AND student_genders.campus_id=?', array($req->cid));


             $facultySummary[0] = DB::select('SELECT * FROM faculty_qualifications', array());
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

            $facultyWorkLoad = DB::select('SELECT work_loads.*, designations.name as designationName FROM work_loads, designations, campuses WHERE work_loads.type="REG" AND work_loads.designation_id=designations.id AND work_loads.campus_id=? AND campuses.id=work_loads.campus_id  ', array($req->cid, $getYear->tyear));

             $facultyWorkLoadb = DB::select('SELECT work_loads.*, designations.name as designationName FROM work_loads, designations, campuses WHERE work_loads.type="REG" AND work_loads.designation_id=designations.id AND work_loads.campus_id=? AND campuses.id=work_loads.campus_id ', array($req->cid, $getYear->year_t_1));

//             $facultyTeachingCourses = DB::select('
//                SELECT faculty_teaching_cources.*, lookup_faculty_types.faculty_type as lookupFacultyType,
//                designations.name as desName FROM faculty_teaching_cources, lookup_faculty_types, designations, campuses, users
//                WHERE faculty_teaching_cources.campus_id=campuses.id
//                AND faculty_teaching_cources.type="REG"
//                AND faculty_teaching_cources.lookup_faculty_type_id=lookup_faculty_types.id
//                AND faculty_teaching_cources.designation_id=designations.id
//                AND faculty_teaching_cources.campus_id=? AND users.id=?',
//                 array($req->cid, auth()->user()->id));
            $where = ['campus_id'=> $req->cid, 'type' => 'REG'];

            $facultyTeachingCourses = FacultyTeachingCources::
                with('campus','lookup_faculty_type','designation', 'faculty_program')
                ->where($where)->get();
//            dd($facultyTeachingCourses);
             $studentTeachersRatio = DB::select('SELECT faculty_student_ratio.*, programs.name as programName FROM faculty_student_ratio, programs, campuses WHERE faculty_student_ratio.campus_id=campuses.id AND faculty_student_ratio.type="REG" AND faculty_student_ratio.program_id=programs.id AND  faculty_student_ratio.campus_id=?', array( $req->cid));

              $facultyStability = DB::select('SELECT faculty_stability.* FROM faculty_stability, campuses, users WHERE faculty_stability.campus_id=campuses.id AND faculty_stability.type="REG" AND faculty_stability.campus_id=? AND users.id=?', array( $req->cid,auth()->user()->id));

              $facultyGenders = DB::select('SELECT faculty_genders.*, lookup_faculty_types.faculty_type as facultyTypeName FROM faculty_genders, lookup_faculty_types, campuses, users WHERE faculty_genders.campus_id=campuses.id AND faculty_genders.type="REG" AND faculty_genders.lookup_faculty_type_id=lookup_faculty_types.id AND users.id=? AND faculty_genders.campus_id=? ', array(auth()->user()->id, $req->cid));

               $researchOutput = DB::select('SELECT research_summaries.*, publication_types.name as publicationName, publication_categories.name as publicationType FROM publication_categories,research_summaries, publication_types, campuses, users WHERE research_summaries.campus_id=campuses.id AND research_summaries.type="REG" AND publication_categories.id=publication_types.publication_category_id AND research_summaries.publication_type_id=publication_types.id AND users.id=? AND research_summaries.campus_id=? ORDER BY publication_categories.name', array(auth()->user()->id, $req->cid ));

               $financialInfos = DB::select('SELECT financial_infos.*, income_sources.particular as particularName, income_sources.type as particularType FROM financial_infos, income_sources, campuses, users WHERE financial_infos.campus_id=campuses.id AND financial_infos.type="REG" AND financial_infos.income_source_id=income_sources.id AND financial_infos.campus_id=? AND users.id=? ORDER BY income_sources.type', array($req->cid, auth()->user()->id));

               $BIResources = DB::select('SELECT business_school_facilities.*, facilities.name as facilityName, facility_types.name as facilityType FROM business_school_facilities, facilities, facility_types, users, campuses WHERE business_school_facilities.campus_id=campuses.id AND business_school_facilities.type="REG" AND business_school_facilities.facility_id=facilities.id AND users.id=? AND business_school_facilities.campus_id=? AND facilities.facility_type_id=facility_types.id ORDER BY facility_types.name', array(auth()->user()->id,$req->cid));
        }
        else{

            $bussinessSchool  = DB::table('users')
                ->leftJoin('business_schools', 'users.business_school_id', '=', 'business_schools.id')
                ->leftJoin('institute_types','business_schools.institute_type_id','=','institute_types.id')
                ->leftJoin('charter_types','business_schools.charter_type_id','=','charter_types.id')
                ->leftJoin('designations','business_schools.cao_id','=','designations.id')
                ->where('users.id',auth()->user()->id)
                ->select('business_schools.*','institute_types.name as typeName', 'charter_types.name as charterName', 'designations.name as designationName' )
                ->get();

//            dd($bussinessSchool);

            $userCampus = DB::select('SELECT * from users where id=?', array(Auth::id()));
            //dd($userCampus[0]->campus_id);
            $campuses = Campus::where('business_school_id', $bussinessSchool[0]->id)->get();

            $scopeOfAcredation = DB::select('SELECT scopes.*, programs.name as programName, levels.name as levelName FROM scopes, programs, levels, campuses WHERE scopes.campus_id=campuses.id AND scopes.type="REG" AND scopes.program_id=programs.id AND scopes.level_id=levels.id AND scopes.campus_id=?', array(auth()->user()->campus_id));


            $contactInformation = DB::select('SELECT contact_infos.*
                FROM contact_infos
                WHERE contact_infos.type="REG"
                AND contact_infos.campus_id=?',
                array(auth()->user()->campus_id));
            $statutoryCommitties = DB::select('SELECT statutory_committees.*,statutory_bodies.name as statutoryName, designations.name as designationName from statutory_committees, statutory_bodies, business_schools, designations WHERE statutory_committees.statutory_body_id=statutory_bodies.id AND statutory_committees.type="REG" AND statutory_committees.designation_id=designations.id AND business_schools.id=? AND statutory_committees.campus_id=?', array($bussinessSchool[0]->id, auth()->user()->campus_id));


             $affiliations = DB::select('SELECT affiliations.*, statutory_bodies.name as statutoryBody, designations.name as designationName
            FROM affiliations, statutory_bodies, business_schools, designations
            WHERE  affiliations.statutory_bodies_id=statutory_bodies.id AND affiliations.type="REG" AND affiliations.designation_id=designations.id AND business_schools.id=? AND affiliations.campus_id=?', array($bussinessSchool[0]->id,auth()->user()->campus_id));


             $budgetoryInfo = DB::select(' SELECT budgetary_infos.* from budgetary_infos, business_schools, campuses WHERE business_schools.id=? AND budgetary_infos.type="REG" AND  budgetary_infos.campus_id=campuses.id AND budgetary_infos.campus_id=?', array($bussinessSchool[0]->id, auth()->user()->campus_id));





             $strategicPlans = DB::select(' SELECT strategic_plans.* from strategic_plans, business_schools, campuses WHERE business_schools.id=? AND strategic_plans.type="REG" AND strategic_plans.campus_id=campuses.id AND strategic_plans.campus_id=?', array($bussinessSchool[0]->id, auth()->user()->campus_id));
             $mission    = DB::select(' SELECT mission_visions.* from mission_visions, business_schools, campuses WHERE business_schools.id=?  AND mission_visions.campus_id=campuses.id AND mission_visions.campus_id=?', array($bussinessSchool[0]->id, auth()->user()->campus_id));


             $programsPortfolio = DB::select('SELECT program_portfolios.*, programs.name as programName, course_types.name as courseType
                FROM program_portfolios, programs, course_types, business_schools, campuses
                WHERE program_portfolios.program_id=programs.id AND program_portfolios.type="REG" AND program_portfolios.course_type_id=course_types.id AND business_schools.id=? AND program_portfolios.campus_id=campuses.id AND program_portfolios.campus_id=?', array($bussinessSchool[0]->id, auth()->user()->campus_id));

             $entryRequirements = DB::select('SELECT entry_requirements.*, eligibility_criterias.name as eligibilityCriteria, programs.name as programName FROM entry_requirements, eligibility_criterias, programs, campuses WHERE entry_requirements.program_id=programs.id AND entry_requirements.type="REG" AND entry_requirements.eligibility_criteria_id=eligibility_criterias.id AND entry_requirements.campus_id=campuses.id AND entry_requirements.campus_id=?', array($userCampus[0]->campus_id));
             //dd($userCampus[0]->campus_id);
             //dd($entryRequirements);
             $applicationsReceived = DB::select('SELECT application_receiveds.*, programs.name as programName, semesters.name as semesterName FROM application_receiveds, programs, semesters, campuses WHERE application_receiveds.program_id=programs.id AND application_receiveds.type="REG" AND application_receiveds.semester_id=semesters.id  AND campuses.id=?', array($userCampus[0]->campus_id));

             $app_Received = DB::select('SELECT app_receiveds.*, programs.name as programName
            FROM app_receiveds, programs
            WHERE app_receiveds.program_id=programs.id AND app_receiveds.type="REG"
            AND campus_id=?', array($userCampus[0]->campus_id));


             $studentsEnrolment = DB::select('SELECT student_enrolments.* FROM student_enrolments, campuses WHERE student_enrolments.campus_id=campuses.id AND campuses.id=? AND student_enrolments.type="REG" AND student_enrolments.year>YEAR(CURDATE())-3', array($userCampus[0]->campus_id));


             $graduatedStudents = DB::select('SELECT students_graduateds.*, programs.name as programName
FROM students_graduateds, programs, campuses
WHERE students_graduateds.campus_id=campuses.id
AND students_graduateds.type="REG"
AND students_graduateds.program_id=programs.id AND students_graduateds.campus_id=?', array($userCampus[0]->campus_id));


             $studentsGenders = DB::select('SELECT student_genders.*, programs.name as programName from student_genders, programs, campuses WHERE student_genders.campus_id=campuses.id AND student_genders.type="REG" AND student_genders.program_id=programs.id AND student_genders.campus_id=?', array($userCampus[0]->campus_id));


             $facultySummary[0] = DB::select('SELECT * FROM faculty_qualifications', array());
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
             $facultyWorkLoad = DB::select('SELECT work_loads.*, designations.name as designationName FROM work_loads, designations, campuses WHERE work_loads.type="REG" AND work_loads.designation_id=designations.id AND work_loads.campus_id=? AND campuses.id=work_loads.campus_id  ', array($userCampus[0]->campus_id, @$getYear->tyear));

             $facultyWorkLoadb = DB::select('SELECT work_loads.*, designations.name as designationName FROM work_loads, designations, campuses WHERE work_loads.type="REG" AND work_loads.designation_id=designations.id AND work_loads.campus_id=? AND campuses.id=work_loads.campus_id  ', array($userCampus[0]->campus_id, @$getYear->year_t_1));

            // $facultyTeachingCourses = DB::select('SELECT faculty_teaching_cources.*,
            // lookup_faculty_types.faculty_type as lookupFacultyType, designations.name as desName FROM faculty_teaching_cources,
            // lookup_faculty_types, designations, campuses, users WHERE faculty_teaching_cources.campus_id=campuses.id
            // AND faculty_teaching_cources.type="REG" AND faculty_teaching_cources.lookup_faculty_type_id=lookup_faculty_types.id
            // AND faculty_teaching_cources.designation_id=designations.id AND faculty_teaching_cources.campus_id=?
            // AND users.department_id=? AND users.id=?', array($userCampus[0]->campus_id, $userCampus[0]->department_id,
            // auth()->user()->id));

             $where = ['campus_id'=> $userInfo->campus_id, 'type' => 'REG'];
             $facultyTeachingCourses = FacultyTeachingCources::
             with('campus','lookup_faculty_type','designation', 'faculty_program')
                 ->where($where)
                 ->where('lookup_faculty_type_id', '!=', 2)->get();

//             dd($facultyTeachingCourses);
             $whereb = ['campus_id'=> $userInfo->campus_id, 'type' => 'REG', 'lookup_faculty_type_id' => '2'];
             $facultyTeachingCourses4b = FacultyTeachingCources::
             with('campus','lookup_faculty_type','designation', 'faculty_program')
                ->where($whereb)->get();

//             dd($facultyTeachingCourses4b);

             $studentTeachersRatio = DB::select('SELECT faculty_student_ratio.*, programs.name as programName FROM faculty_student_ratio, programs, campuses, users WHERE faculty_student_ratio.campus_id=campuses.id AND faculty_student_ratio.type="REG" AND faculty_student_ratio.program_id=programs.id AND users.department_id=? AND faculty_student_ratio.campus_id=?', array($userCampus[0]->department_id, $userCampus[0]->campus_id));

              $facultyStability = DB::select('SELECT faculty_stability.* FROM faculty_stability, campuses, users WHERE faculty_stability.campus_id=campuses.id AND faculty_stability.type="REG" AND users.department_id=? AND faculty_stability.campus_id=? AND users.id=?', array($userCampus[0]->department_id, $userCampus[0]->campus_id,auth()->user()->id));

              $facultyGenders = DB::select('SELECT faculty_genders.*, lookup_faculty_types.faculty_type as facultyTypeName FROM faculty_genders, lookup_faculty_types, campuses, users WHERE faculty_genders.campus_id=campuses.id AND faculty_genders.type="REG" AND faculty_genders.lookup_faculty_type_id=lookup_faculty_types.id AND users.id=? AND faculty_genders.campus_id=? AND users.department_id=?', array(auth()->user()->id, $userCampus[0]->campus_id, $userCampus[0]->department_id));

               $researchOutput = DB::select('SELECT research_summaries.*, publication_types.name as publicationName, publication_categories.name as publicationType FROM publication_categories,research_summaries, publication_types, campuses, users WHERE research_summaries.campus_id=campuses.id AND research_summaries.type="REG" AND publication_categories.id=publication_types.publication_category_id AND research_summaries.publication_type_id=publication_types.id AND users.id=? AND users.department_id=? AND research_summaries.campus_id=? ORDER BY publication_categories.name', array(auth()->user()->id, $userCampus[0]->department_id, $userCampus[0]->campus_id ));

               $financialInfos = DB::select('SELECT financial_infos.*, income_sources.particular as particularName, income_sources.type as particularType FROM financial_infos, income_sources, campuses, users WHERE financial_infos.campus_id=campuses.id AND financial_infos.type="REG" AND financial_infos.income_source_id=income_sources.id AND financial_infos.campus_id=? AND users.id=? ORDER BY income_sources.type', array( $userCampus[0]->campus_id, auth()->user()->id));

               $BIResources = DB::select('SELECT business_school_facilities.*, facilities.name as facilityName, facility_types.name as facilityType FROM business_school_facilities, facilities, facility_types, users, campuses WHERE business_school_facilities.campus_id=campuses.id AND business_school_facilities.type="REG" AND business_school_facilities.facility_id=facilities.id AND users.id=? AND business_school_facilities.campus_id=? AND facilities.facility_type_id=facility_types.id ORDER BY facility_types.name', array(auth()->user()->id, $userCampus[0]->campus_id));

            }

        return view('strategic_management.registration_application', compact('app_Received','facultyTeachingCourses4b','bussinessSchool','campuses','scopeOfAcredation', 'contactInformation','statutoryCommitties','affiliations','budgetoryInfo', 'strategicPlans', 'programsPortfolio','entryRequirements','applicationsReceived','studentsEnrolment','graduatedStudents','studentsGenders','facultySummary','facultyWorkLoad','facultyWorkLoadb','facultyTeachingCourses','studentTeachersRatio','facultyStability','facultyGenders','financialInfos','researchOutput','BIResources','docHeaderData', 'programsUnderReview','mission'));
    }

     public static function getfacultySummary($i, $facultySummary, $userCampus){
//        dd($i,$facultySummary,$userCampus);

            $facultySummary12 = DB::select('
            SELECT faculty_summaries.*, disciplines.name as disciplineName
            FROM faculty_summaries, disciplines,users
            WHERE faculty_summaries.discipline_id=disciplines.id
            AND faculty_summaries.faculty_qualification_id=?
            AND faculty_summaries.campus_id=?
            AND users.id=?',
                array($facultySummary[$i]->id,$userCampus,auth()->user()->id));
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
            ->get();



        $userCampus = DB::select('SELECT * from users where id=?', array(Auth::id()));
        //dd($userCampus[0]->campus_id);
        $campuses = Campus::where('business_school_id', $bussinessSchool[0]->id)->get();

         $scopeOfAcredation = DB::select('SELECT scopes.*, programs.name as programName, levels.name as levelName FROM scopes, programs, levels, campuses WHERE scopes.campus_id=campuses.id AND scopes.program_id=programs.id AND scopes.level_id=levels.id AND scopes.campus_id=?', array(Auth::user()->campus_id));


        $contactInformation = DB::select('SELECT contact_infos.*, designations.name as designationName, designations.id as designationId FROM designations, contact_infos, business_schools WHERE designations.id=contact_infos.designation_id AND business_schools.id=?', array($bussinessSchool[0]->id));


        $statutoryCommitties = DB::select('SELECT statutory_committees.*,statutory_bodies.name as statutoryName, designations.name as designationName from statutory_committees, statutory_bodies, business_schools, designations WHERE statutory_committees.statutory_body_id=statutory_bodies.id AND statutory_committees.designation_id=designations.id AND business_schools.id=? AND statutory_committees.campus_id=?', array($bussinessSchool[0]->id, auth()->user()->campus_id));

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
