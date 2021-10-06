<?php

namespace App\Http\Controllers;

use App\AdmissionOffice;
use App\AlumniMembership;
use App\CreditTransfer;
use App\DocumentaryEvidence;
use App\FinancialAssistance;
use App\Models\Carriculum\CourseOutline;
use App\Models\Carriculum\EvaluationMethod;
use App\Models\Carriculum\PlagiarismCase;
use App\Models\Carriculum\ProgramDelivery;
use App\Models\Carriculum\QuestionPaper;
use App\Models\Common\EligibilityStatus;
use App\Models\Common\Slip;
use App\Models\Common\StrategicManagement\BusinessSchoolTyear;
use App\Models\Config\NbeacBasicInfo;
use App\Models\DeskReview;
use App\Models\External_Linkages\FacultyExchange;
use App\Models\External_Linkages\Linkages;
use App\Models\External_Linkages\ObtainedInternship;
use App\Models\External_Linkages\StudentExchange;
use App\Models\facility\QecInfo;
use App\Models\Faculty\FacultyConsultancyProject;
use App\Models\Faculty\FacultyDevelop;
use App\Models\Faculty\FacultyExposure;
use App\Models\Faculty\FacultyGender;
use App\Models\Faculty\FacultyPromotion;
use App\Models\Faculty\FacultySummary;
use App\Models\Faculty\FacultyTeachingCources;
use App\Models\Faculty\VisitingFaculty;
use App\Models\Faculty\FacultyStability;
use App\Models\Faculty\WorkLoad;
use App\Models\Facility\BusinessSchoolFacility;
use App\Models\Research\ResearchAgenda;
use App\Models\Research\ResearchSummary;
use App\Models\social_responsibility\ComplaintResolution;
use App\Models\social_responsibility\EnvProtection;
use App\Models\social_responsibility\InternalCommunity;
use App\Models\social_responsibility\ProjectDetail;
use App\Models\social_responsibility\SocialActivity;
use App\Models\StrategicManagement\ApplicationReceived;
use App\Models\StrategicManagement\AuditReport;
use App\Models\StrategicManagement\ContactInfo;
use App\Models\StrategicManagement\MissionVision;
use App\Models\StrategicManagement\ParentInstitution;
use App\Models\StrategicManagement\Scope;
use App\Models\StrategicManagement\StatutoryCommittee;
use App\Models\StrategicManagement\StrategicPlan;
use App\Models\StrategicManagement\StudentEnrolment;
use App\NbeacCriteria;
use App\StudentsGraduated;
use App\FacultyDegree;
use App\StudentTransfer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\EligibilityScreeningEmail;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Mail\ActivationMail;

class DeskReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$registrations = User::with('business_school')->where(['status' => 'active', 'request'=>'pending'])->get();

        $registrations = DB::table('slips as s')
            ->join('campuses as c', 'c.id', '=', 's.business_school_id')
            ->join('departments as d', 'd.id', '=', 's.department_id')
            ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
            ->join('users as u', 'u.id', '=', 's.created_by')
            ->select('s.*', 'c.location as campus', 'd.name as department', 'u.name as user', 'u.email', 'u.contact_no', 'bs.name as school', 'bs.id as schoolId')
//            ->where('s.reg')
            ->where('s.regStatus', '!=', 'initiated')
            ->get();
//        dd($registrations);

        return view('desk_review.index', compact('registrations'));
    }


    public function submitDeskReport(Request $request, $id)
    {
        try {
            $validation = Validator::make($request->all(), ['id'=> 'required'], ['required'=> 'The :attribute can not be blank.']);
            if($validation->fails()){
                return response()->json($validation->messages()->all(), 422);
            }
            $slips = DB::update('update slips set desk_review_comments=?, regStatus=? where id=?', array($request->comments, $request->review, $request->id));
            dd($slips);
            //dd($content->email);
            Mail::to($content->email)->queue(new ActivationMail($content));
            return response()->json(['success' => 'Status updated Successfully'], 200);
        }catch (Exception $e)
        {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function deskreview($id=null)
    {

        @$business_school_user = Slip::where(['id' => $id])->get()->first();
        $campus_id = $business_school_user->business_school_id;
        $department_id = $business_school_user->department_id;
        $nbeac_criteria = NbeacCriteria::all()->first();
        $scopes = Scope::with('program')->where(
            [
                'status'=> 'active',
                'campus_id' => $campus_id,
                'department_id' => $department_id,
                'type'=>'REG'
            ])->get();


//        dd($campus_id, ' dep', $department_id);

        $accreditation=  Scope::with('program')
            ->where(['status'=> 'active', 'campus_id' => $campus_id, 'department_id' => $department_id, 'type'=>'REG'])
            ->get();

//        dd($accreditation);
//      $accreditation=  Scope::where(['status'=> 'active', 'campus_id' => $campus_id, 'department_id' => $department_id])->get();
//        dd($accreditation);
        $program_dates = [];
        foreach ($accreditation as $accred)
        {
            @$program_dates[$accred->id]['date_diff'] = $this->dateDifference($accred->date_program, date('Y-m-d'), '%y Year %m Month');
            @$program_dates[$accred->id]['date_difference'] = $this->dateDifference($accred->date_program, date('Y-m-d'), '%y.%m');
            @$program_dates[$accred->id]['program'] = $accred->program->name;
            @$program_dates[$accred->id]['program_id'] = $accred->program_id;
            @$program_dates[$accred->id]['level_id'] = $accred->level_id;
            @$program_dates[$accred->id]['date'] = $accred->date_program;
        }

//        dd($program_dates);

        $mission_vision = MissionVision::where(['campus_id' => $campus_id, 'department_id' => $department_id , 'type'=>'REG'])->get()->first();
        @$strategic_plan = StrategicPlan::where(['campus_id' => $campus_id, 'department_id' => $department_id , 'type'=>'REG', 'deleted_at' => Null])->get()->first();

        @$strategic_plan['date_diff'] = $this->dateDifference($strategic_plan->plan_period_from, $strategic_plan->plan_period_to, '%y.%m');

        @$application_received = ApplicationReceived::with('program', 'semester')
            ->where(['campus_id' => $campus_id, 'department_id' => $department_id, 'type'=>'REG'])
            ->get();
//dd($application_received);
        $student_enrolment = StudentEnrolment::where(['campus_id' => $campus_id, 'department_id' => $department_id, 'type'=>'REG', 'deleted_at' => Null ])->get();
        $graduated_students = StudentsGraduated::with('program')->where(['campus_id' => $campus_id, 'department_id' => $department_id, 'type'=>'REG'])->get();

        $getYears = BusinessSchoolTyear::where(['campus_id' => $campus_id, 'department_id' => $department_id])->first();
        $graduated_students->tyear =@$getYears->tyear??'';
        $graduated_students->year_t_1 =@$getYears->year_t_1??'';
        $graduated_students->year_t_2 =@$getYears->year_t_2??'';
//        dd($graduated_students);


        $faculty_summary= FacultySummary::where(['campus_id'=> $campus_id, 'department_id' => $department_id, 'status' => 'active', 'type'=>'REG'])->get()->sum('number_faculty');
        $faculty_summary_full= FacultyTeachingCources::where(['campus_id'=> $campus_id, 'department_id' => $department_id, 'status' => 'active', 'type'=>'REG', 'lookup_faculty_type_id'=>2, 'deleted_at'=>Null])->count();
//        dd($faculty_summary_full);
        @$faculty_summary==0?$faculty_summary = 1:$faculty_summary;

//        dd($faculty_summary);
//        dd($faculty_summary);
        $faculty_summary_doc= FacultySummary::where(['campus_id'=> $campus_id, 'department_id' => $department_id, 'status' => 'active', 'faculty_qualification_id' =>1, 'type'=>'REG'])->get()->count();

        $getFullProfessors = FacultyTeachingCources::where(
            ['status' => 'active',
                'campus_id' => $campus_id,
                'department_id' => $department_id,
                'designation_id'=>10, 'type'=>'REG'])
            ->count();
        $AssociateProfessors = FacultyTeachingCources::
            where(
                [
                    'status' => 'active',
                    'campus_id' => $campus_id,
                    'department_id' => $department_id,
                    'designation_id'=>1, 'type'=>'REG'])
            ->count();
        $AssistantProfessors = FacultyTeachingCources::
            where(
                [
                    'status' => 'active',
                    'campus_id' => $campus_id,
                    'department_id' => $department_id,
                    'designation_id'=>2, 'type'=>'REG'])
            ->count();
        $lecturers = FacultyTeachingCources::
            where(
                [
                    'status' => 'active',
                    'campus_id' => $campus_id,
                    'department_id' => $department_id,
                    'designation_id'=>6, 'type'=>'REG'])
            ->count();
        $permanent_faculty = FacultyTeachingCources::
            where(
                [
                    'status' => 'active',
                    'campus_id' => $campus_id,
                    'department_id' => $department_id,
                    'lookup_faculty_type_id'=>2, 'type'=>'REG'])
            ->count();
        $adjunct_faculty = FacultyTeachingCources::
            where(
                [
                    'status' => 'active',
                    'campus_id' => $campus_id,
                    'department_id' => $department_id,
                    'lookup_faculty_type_id'=>1, 'type'=>'REG'])
            ->count();
        $other = FacultyTeachingCources::
            where(
                [
                    'status' => 'active',
                    'campus_id' => $campus_id,
                    'department_id' => $department_id,
                    'designation_id'=>8, 'type'=>'REG'])
            ->count();
        $female_faculty = FacultyGender::
            where(
                [
                    'status' => 'active',
                    'campus_id' => $campus_id,
                    'department_id' => $department_id,
                    'lookup_faculty_type_id'=>2, 'type'=>'REG'])
            ->count();
        $faculty_degree = FacultyDegree::get()->first();
        $total_induction = FacultyStability::where(['campus_id' => $campus_id, 'department_id' => $department_id, 'status' => 'active', 'type'=>'REG'])->get()->sum('new_induction');
        $faculty_terminated = FacultyStability::where(['campus_id' => $campus_id, 'department_id' => $department_id, 'status' => 'active', 'type'=>'REG'])->get()->sum('terminated');
        $faculty_resigned = FacultyStability::where(['campus_id' => $campus_id, 'department_id' => $department_id, 'status' => 'active', 'type'=>'REG'])->get()->sum('resigned');
        $faculty_retired = FacultyStability::where(['campus_id' => $campus_id, 'department_id' => $department_id, 'status' => 'active', 'type'=>'REG'])->get()->sum('retired');

        $total_courses = WorkLoad::where(
            [
                'campus_id' => $campus_id, 'department_id' => $department_id, 'status' => 'active', 'type'=>'REG'
            ]
        )->get()->sum('total_courses');

        $total_courses_prof = WorkLoad::where(
            [
                'campus_id' => $campus_id,
                'department_id' => $department_id,
                'status' => 'active',
                'designation_id'=> 10, 'type'=>'REG'
            ]
        )->get()->sum('total_courses');

        $total_courses_assoc = WorkLoad::where(
            [
                'campus_id' => $campus_id,
                'department_id' => $department_id,
                'status' => 'active',
                'designation_id'=> 1, 'type'=>'REG'
            ]
        )->get()->sum('total_courses');

        $total_courses_assis = WorkLoad::where(
            [
                'campus_id' => $campus_id,
                'department_id' => $department_id,
                'status' => 'active',
                'designation_id'=> 2, 'type'=>'REG'
            ]
        )->get()->sum('total_courses');

         $total_courses_lec = WorkLoad::where(
            [
                'campus_id' => $campus_id,
                'department_id' => $department_id,
                'status' => 'active',
                'designation_id'=> 6, 'type'=>'REG'
            ]
        )->get()->sum('total_courses');

//        dd($total_courses_lec);
        $bandwidth = BusinessSchoolFacility::where(['facility_id'=> 35, 'type'=>'REG', 'campus_id' => $campus_id, 'department_id' => $department_id])->get()->first();
        $comp_ratio = BusinessSchoolFacility::where(['facility_id'=> 32, 'type'=>'REG', 'campus_id' => $campus_id, 'department_id' => $department_id])->get()->first();

        $summaries =[];
        $summaries['impact_factor'] = ResearchSummary::where(
            [
                'campus_id' => $campus_id,
                'department_id' => $department_id,
                'status' => 'active',
                'publication_type_id'=> 1, 'type'=>'REG'
            ]
        )->first()->total_items??'';

        $summaries['category_w'] = ResearchSummary::where(
            [
                'campus_id' => $campus_id,
                'department_id' => $department_id,
                'status' => 'active',
                'publication_type_id'=> 2, 'type'=>'REG'
            ]
        )->first()->total_items??'';

        $summaries['category_x'] = ResearchSummary::where(
            [
                'campus_id' => $campus_id,
                'department_id' => $department_id,
                'status' => 'active',
                'publication_type_id'=> 3, 'type'=>'REG'
            ]
        )->first()->total_items??'';
        $summaries['category_y'] = ResearchSummary::where(
            [
                'campus_id' => $campus_id,
                'department_id' => $department_id,
                'status' => 'active',
                'publication_type_id'=> 4, 'type'=>'REG'
            ]
        )->first()->total_items??'';

        $summaries['abs'] = ResearchSummary::where(
            [
                'campus_id' => $campus_id,
                'department_id' => $department_id,
                'status' => 'active',
                'publication_type_id'=> 5, 'type'=>'REG'
            ]
        )->first()->total_items??'';
        $summaries['other_list'] = ResearchSummary::where(
            [
                'campus_id' => $campus_id,
                'department_id' => $department_id,
                'status' => 'active',
                'publication_type_id'=> 5, 'type'=>'REG'
            ]
        )->first()->total_items??'';
        $summaries['conf_paper'] = ResearchSummary::where(
            [
                'campus_id' => $campus_id,
                'department_id' => $department_id,
                'status' => 'active',
                'publication_type_id'=> 6, 'type'=>'REG'
            ]
        )->first()->total_items??'';

        $conf_paper_inter = ResearchSummary::where(
            [
                'campus_id' => $campus_id,
                'department_id' => $department_id,
                'status' => 'active',
                'publication_type_id'=> 7, 'type'=>'REG'
            ]
        )->first();
        $conf_paper_inter!==null?$summaries['conf_paper_inter'] = $conf_paper_inter->total_items:$summaries['conf_paper_inter']='';
        $case_studies = ResearchSummary::where(
            [
                'campus_id' => $campus_id,
                'department_id' => $department_id,
                'status' => 'active',
                'publication_type_id'=> 10, 'type'=>'REG'
            ]
        )->first();
        $case_studies!==null?$summaries['case_studies'] = $case_studies->total_items:$summaries['case_studies']='';

//        dd($summaries);

        //dd($graduated_students);
        $strategic_date_diff = $this->dateDifference(@$strategic_plan->aproval_date, date('Y-m-d'), '%y Year %m Month');
        //dd($program_dates);
        //// get scope
        //$scope = Scope::where('')

        //@$desk_reviews = Slip::with('department', 'business_school')->where(['id'=> $id])->get();

        $query = '
        SELECT slips.*, campuses.location as campus,
        departments.name as department,
        users.name as user,
        users.email, users.contact_no,
        business_schools.name as school, business_schools.id as school_id
        FROM slips, campuses, departments, business_schools, users
        WHERE slips.business_school_id=campuses.id
        AND departments.id=slips.department_id
        AND campuses.business_school_id=business_schools.id
        AND users.id = slips.created_by
        AND slips.id = '.$id;
        @$desk_reviews = DB::select($query);
//        dd($desk_reviews);

        $getStudentComRatio = BusinessSchoolFacility::where(
            ['campus_id' => $campus_id,
                'department_id' => $department_id,
                'status' => 'active','facility_id' => 37])
            ->first();
//        dd($getStudentComRatio);

        $desk_rev= Slip::
        with('campus','department')
            ->where(['business_school_id' => $campus_id, 'department_id' => $department_id ])
            ->whereNotNull('isEligible')
            ->get();
//        dd($desk_reviews);
        $desk_reviews_report = DeskReview::where(['campus_id' => $campus_id, 'department_id' => $department_id])->get();

        return view('desk_review.desk_review', compact(
            'program_dates','faculty_summary_full',
            'mission_vision',
            'strategic_plan',
            'strategic_date_diff',
            'application_received',
            'student_enrolment',
            'graduated_students',
            'faculty_summary',
            'getFullProfessors',
            'AssistantProfessors',
            'AssociateProfessors',
            'lecturers',
            'other',
            'faculty_summary_doc',
            'permanent_faculty',
            'adjunct_faculty',
            'female_faculty',
            'faculty_degree',
            'total_induction',
            'faculty_terminated',
            'faculty_resigned',
            'faculty_retired',
            'total_courses',
            'bandwidth',
            'comp_ratio',
            'summaries',
            'nbeac_criteria',
            'desk_reviews',
            'desk_reviews_report',
            'desk_rev',
            'getStudentComRatio',
            'scopes',
            'total_courses_prof',
            'total_courses_assis',
            'total_courses_assoc',
            'total_courses_lec'
        ));
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

    function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        $interval = date_diff($datetime1, $datetime2);
        return $interval->format($differenceFormat);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
         $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {
            $getUserData = Slip::with('campus', 'department')->where(['id' => $request->id])->get()->first();
            foreach ($request->all() as $key=>$isEligible){
                if($key !=='comments' && $key !=='id') {
                    DeskReview::create([
                        'campus_id' =>$getUserData->business_school_id,
                        'department_id' => $getUserData->department_id,
                        'nbeac_criteria' => $key,
                        'isEligible' => $isEligible,
                        'created_by' => Auth::user()->id
                    ]);
                }
            }
            $isEligible = 'no';
            if($request->eligibility_program == 'yes' &&
                $request->eligibility_mission == 'yes' &&
                $request->eligibility_plan == 'yes' &&
                $request->eligibility_student == 'yes' &&
                $request->eligibility_enrollment == 'yes' &&
                $request->eligibility_load == 'yes' &&
                $request->eligibility_output == 'yes' &&
                $request->eligibility_bandwidth == 'yes' &&
                $request->eligibility_ratio == 'yes'
            )
            {
                $isEligible = 'yes';
            }
            $slip = Slip::where(['business_school_id' => $getUserData->business_school_id,
                'department_id' => $getUserData->department_id])
                ->update([
                'isEligible' => $isEligible,
                'desk_review_comments' => $request->comments
//                'regStatus' => 'Eligibility'
                ]
            );

            /////////////////// Email to Business School //////////////////////
            $header = '<table style="border-collapse:collapse; width:100%">' .
                '<tbody>' .
                '<tr>' .
                '<td style="background-color:white; height:16px; vertical-align:top; width:65%">' .
                '<p>AOA, Mr/Ms.  ' . @$getUserData->campus->user->name . '<br />' .
                '' . @$getUserData->campus->user->designation->name . ',&nbsp; ' . @$getUserData->department->name . '<br />' .
                '' . @$getUserData->campus->business_school->name . '</p>' .
                '</td>' .
                '<td style="background-color:white; height:16px; vertical-align:top; width:35%">' .
            '    <p> Ref. No:  '.@$getUserData->invoice_no.'<br />'.
                'Dated:' . date('Y-m-d') . '</p>' .
                '</td>' .
                '</tr>' .
                '</tbody>' .
                '</table>';
            $getnbeacInfo = NbeacBasicInfo::first();

            $footer = '<p>Yours Sincerely,</p>' .
                '<p>&nbsp;</p>' .
                '<p>' . $getnbeacInfo->director . '</p>' .
                '<p>Senior Program Manager (NBEAC)</p>';
///
            $data = ['letter' => $header.$request->comments.$footer];
            $slipInfo = $getUserData;
            $mailInfo = [
                'to' => $slipInfo->campus->user->email,
                'to_name' => $slipInfo->campus->user->name,
                'school' => $slipInfo->campus->business_school->name,
                'from' => $getnbeacInfo->email,
                'from_name' => $getnbeacInfo->name,
            ];
//                    dd($mailInfo);
            Mail::send('eligibility_screening.email.eligibility_report', $data, function ($message) use ($mailInfo) {
                //dd($user);
                $message->to($mailInfo['to'], $mailInfo['to_name'])
                    ->subject('Registration Desk Review Comments - ' . $mailInfo['school']);
                $message->from($mailInfo['from'], $mailInfo['from_name']);
            });

            return response()->json(['success' => 'Desk Review added successfully.'], 200);
        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }


    public function not_eligible(Request $request){
        $getUserData = Slip::with('campus', 'department')->where(['id' => $request->id])->first();

        /////////////////// Email to Business School //////////////////////
        $header = '<table style="border-collapse:collapse; width:100%">' .
            '<tbody>' .
            '<tr>' .
            '<td style="background-color:white; height:16px; vertical-align:top; width:65%">' .
            '<p>Mr/Ms.  ' . @$getUserData->campus->user->name . '<br />' .
//            '' . @$getUserData->campus->user->designation->name . ',&nbsp; ' . @$getUserData->department->name . '<br />' .
//            '' . @$getUserData->campus->business_school->name . '</p>' .
            '</td>' .
            '<td style="background-color:white; height:16px; vertical-align:top; width:35%">' .
            '    <p> Ref. No:  '.@$getUserData->invoice_no.'<br />'.
            'Dated:' . date('Y-m-d') . '</p>' .
            '</td>' .
            '</tr>' .
            '</tbody>' .
            '</table></br>';
        $getnbeacInfo = NbeacBasicInfo::first();

        $footer = '<p>Yours Sincerely,</p>' .
            '<p>&nbsp;</p>' .
            '<p>' . $getnbeacInfo->director . '</p>';
///
        $data = ['letter' => $header.$request->comments.'</br>'.$footer];
        $slipInfo = $getUserData;
        $mailInfo = [
            'to' => $slipInfo->campus->user->email,
            'to_name' => $slipInfo->campus->user->name,
            'school' => $slipInfo->campus->business_school->name,
            'from' => $getnbeacInfo->email,
            'from_name' => $getnbeacInfo->name,
        ];
//                    dd($mailInfo);
        Mail::send('eligibility_screening.email.eligibility_report', $data, function ($message) use ($mailInfo) {
            //dd($user);
            $message->to($mailInfo['to'], $mailInfo['to_name'])
                ->subject('Registration Desk Review Comments - ' . $mailInfo['school']);
            $message->from($mailInfo['from'], $mailInfo['from_name']);
        });
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function show(DeskReview $deskReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function edit(DeskReview $deskReview)
    {
//        dd($deskReview->all());
        return response()->json($deskReview->all(), 200);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeskReview $deskReview)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            DeskReview::where('id', $deskReview->id)->update([
                'isEligible' => $request->isEligible,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => ' Record updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function deskreviewStatus(Request $request, DeskReview $deskReview)
    {

       // dd($request->all());
        try {
            $update = Slip::find($request->id)->update(['regStatus' => 'Eligibility']);
            $getNbeacInfo = NbeacBasicInfo::first();
            $slipInfo = Slip::with('campus', 'department')->where( 'id', $request->id)->first();
            if($update!=null)
            {
                $data = array(
                    'name'      => $slipInfo->campus->user->name,
                    'from_name'=> $getNbeacInfo->director,
                    'from_email'=> $getNbeacInfo->email,
                    'department' => $slipInfo->department->name,
                    'campus'=> $slipInfo->campus->location,
                    'invoice' => $slipInfo->invoice_no,
                    'business_school'=> $slipInfo->campus->business_school->name
                );
                Mail::to($slipInfo->campus->user->email)->send(new EligibilityScreeningEmail($data));
                return response()->json(['success' => 'Case forwarded to eligibility screening']);
            }
        }catch (\Exception $e)
        {
            return response()->json(['message' => 'Forwarding case to eligibility screening Failed.']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeskReview $deskReview)
    {
        try {
            DeskReview::where('id', $deskReview->id)->update([
                'deleted_by' => Auth::user()->id
            ]);
            DeskReview::destroy($deskReview->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
//                'id' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }

    public  function reg_files(Request $request){
        try {
            $where = ['campus_id'=> $request->cid, 'department_id' => $request->did, 'type'=>'REG'];
            $whereReg = ['campus_id'=> $request->cid, 'department_id' => $request->did];
//            dd($where);
            $schoolInfo = Slip::where(['business_school_id'=> $request->cid, 'department_id' => $request->did])->with('campus', 'department')->first();
//            dd($schoolInfo);/
            $ContactInfo = ContactInfo::where($where)->get() ?? [] ;
//            dd($ContactInfo);
            //Appendix 1A
            $StateryCommittee = StatutoryCommittee::where($where)->get() ??[];
            $MissionVision = MissionVision::where($where)->first()->file ?? '' ;
            $StrategicPlan = StrategicPlan::where($where)->first()->file ?? '' ;
//            dd($StrategicPlan);
            $ParentInstitution = ParentInstitution::where($whereReg)->first()->file ?? '';
//            dd($CourseOutline);
            return  view('desk_review.reg_files', compact('schoolInfo','ContactInfo', 'StateryCommittee',
                    'MissionVision',
                    'StrategicPlan',
                    'ParentInstitution')
            );
        }catch (Exception $e) {
            return response()->json(['message'=>'something went wrong']);
        }
    }

}



