<?php

namespace App\Http\Controllers;
use App\Models\Common\Slip;
use App\Models\Config\NbeacBasicInfo;
use App\Models\EligibilityScreening\ReviewerAvailability;
use App\Models\MentoringInvoice;
use App\Models\MentoringMentor;
use App\Models\PeerReview\InstituteFeedback;
use App\Models\PeerReview\PeerReviewReviewer;
use App\Models\PeerReview\SchedulePeerReview;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Common\Campus;
use App\Models\Common\Department;
use App\BusinessSchool;
use App\Models\Faculty\FacultyGender;
use App\Models\Common\Program;
use Illuminate\Support\Facades\DB;
use App\Mail\ChangeResgistrationStatusMail;
use App\Models\StrategicManagement\Scope;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');

        $user = Auth::user();
        //dd($user);
        //$check = $user->hasRole(['editor', 'moderator']);


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::id();
        $campus_id = Auth::user()->campus_id;
        $department_id = Auth::user()->department_id;

        $invoicesCount = Slip::get()->count();

        //check is registration forms data completed:
        $check = $this->isRegCompleted(['user_id'=> $user_id, 'campus_id'=>$campus_id, 'department_id'=>$department_id]);
        $memberShips = User::with('business_school', 'department')->where('status', 'pending')->get();

        $query = '
        SELECT slips.*, campuses.location as campus,
        departments.name as department,
        users.name as user,
        users.email, users.contact_no,
        business_schools.name as school
        FROM slips, campuses, departments, business_schools, users
        WHERE slips.business_school_id=campuses.id
        AND departments.id=slips.department_id
        AND campuses.business_school_id=business_schools.id
        AND users.id = slips.created_by ';
        $campus_id? $query.='AND campuses.id = '.$campus_id:'';

        $department_id? $query.=' AND departments.id = '.$department_id:'';
        $invoices = DB::select($query);

        //dd($invoices);
//        $registrations = Slip::with('business_school')
//            ->where('regStatus','!=','Initiated')
//            ->get();

        $registrations = DB::select('
        SELECT slips.*, campuses.location as campus, departments.name as department, users.name as user, users.email, users.contact_no,
        business_schools.name as school
        FROM slips, campuses, departments, business_schools, users
        WHERE slips.business_school_id=campuses.id
        AND departments.id=slips.department_id
        AND campuses.business_school_id=business_schools.id
        AND users.id = slips.created_by
        ');
//        dd($registrations);
        @$count_slips = count(@$registrations);
//        dd($count_slips);
        $registration_apply = User::with('business_school')->where(['status' => 'active', 'user_type'=>'business_school', 'id' => $user_id])->get();
        //$eligibility_registrations = Slip::where(['status' => 'paid', 'regStatus' =>'Eligibility'])->get();

        $eligibility_registrations = DB::table('slips as s')
            ->join('campuses as c', 'c.id', '=', 's.business_school_id')
            ->join('departments as d', 'd.id', '=', 's.department_id')
            ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
            ->join('users as u', 'u.id', '=', 's.created_by')
            ->select('s.*', 'c.location as campus', 'd.name as department',
                'd.id as department_id', 'u.name as user', 'u.email', 'u.contact_no', 'bs.name as school', 'bs.id as school_id')
            ->whereIn('s.regStatus', ['Eligibility', 'ScheduledES'])
            ->get();
        //dd($eligibility_registrations);

//        $eligibility_registrations = DB::select("
//        SELECT slips.*, campuses.location as campus, departments.name as department, users.name as user, users.email, users.contact_no,
//        business_schools.name as school
//        FROM slips, campuses, departments, business_schools, users
//        WHERE slips.business_school_id=campuses.id
//        AND departments.id=slips.department_id
//        AND campuses.business_school_id=business_schools.id
//        AND users.id = slips.created_by
//        AND slips.status ='approved'
//        AND slips.regStatus = 'Eligibility'
//        ");
        //OR is not working here
//        OR slips.regStatus = 'ScheduledES'

//        $eligibility_screening = DB::select("
//        SELECT slips.*, campuses.location as campus,
//        departments.name as department,
//        users.name as user, users.email, users.contact_no,
//        business_schools.name as school
//        FROM slips, campuses, departments, business_schools, users, e_s_reviewers
//        WHERE slips.business_school_id=campuses.id
//        AND departments.id=slips.department_id
//        AND campuses.business_school_id=business_schools.id
//        AND users.id = e_s_reviewers.user_id
//        AND slips.id = e_s_reviewers.slip_id
//        AND slips.status ='approved' AND slips.regStatus = 'ScheduledES' AND slips.regStatus = 'Eligibility'
//        AND e_s_reviewers.user_id = ".Auth::id()
//        );
        $eligibility_screening = DB::table('slips as s')
            ->join('campuses as c', 'c.id', '=', 's.business_school_id')
            ->join('departments as d', 'd.id', '=', 's.department_id')
            ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
            ->join('e_s_reviewers as es', 'es.slip_id', '=', 's.id')
            ->join('users as u', 'u.id', '=', 'es.user_id')
            ->select('s.*', 'c.location as campus', 'd.name as department', 'u.name as user', 'u.email',
                'u.contact_no', 'bs.name as school', 'bs.id as school_id')
//            ->where('s.regStatus', 'ScheduledES')
            ->where('es.user_id', Auth::id())
            ->where('s.regStatus','!=', 'Initiated')
            ->where('s.regStatus','!=', 'Pending')
            ->where('s.regStatus','!=', 'Review')
            ->where('s.regStatus','!=', 'Eligibility')
            ->get();
//dd($eligibility_screening);
//        $mentoringQuery = "
//        SELECT slips.*, campuses.location as campus,
//        departments.name as department,
//        users.name as user, users.email, users.contact_no,
//        business_schools.name as school
//        FROM slips, campuses, departments, business_schools, users, mentoring_mentors
//        WHERE slips.business_school_id=campuses.id
//        AND departments.id=slips.department_id
//        AND campuses.business_school_id=business_schools.id
//        AND users.id = mentoring_mentors.user_id
//        AND slips.id = mentoring_mentors.slip_id
//        AND slips.status ='approved' AND slips.regStatus = 'ScheduledMentoring' OR slips.regStatus = 'Mentoring'";

         //Auth::user()->user_type=='Mentor'? $mentoringQuery .= "AND mentoring_mentors.user_id= ".Auth::id():'';

        //$MentoringMeetings = DB::select($mentoringQuery);
        $MentoringMeetings = [];
        if(Auth::user()->hasRole('Mentor')) {
//            dd('mentors ');
//            $MentoringMeetings = DB::table('slips as s')
//                ->join('campuses as c', 'c.id', '=', 's.business_school_id')
//                ->join('departments as d', 'd.id', '=', 's.department_id')
//                ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
//                ->leftJoin('mentoring_mentors as mm', 's.id', '=', 'mm.slip_id')
////                ->join('users as u', 'u.id', '=', 'mm.user_id')
//                ->select('s.*', 'c.location as campus','c.id as campus_id', 'd.name as department', 'bs.name as school', 'bs.id as business_school_id')
//                ->where('s.regStatus', 'ScheduledMentoring')
//                ->orWhere('s.regStatus', 'Mentoring')
////                ->where('s.status', 'approved')
////                ->where('u.id', Auth::id())
//                ->groupBy('s.id')
//                ->get();

                $MentoringMeetings = MentoringMentor::with(['slip',  ])
                  ->where(['user_id'=> Auth::id(), 'status'=> 'active'])
                    ->get();
            }
        else if(Auth::user()->hasRole('ESScheduler')){
            $MentoringMeetings = Slip::with('campus', 'department','mentoring_mentor')
//                    ->whereHas('mentoring_mentor', function ($q) {
//                        $q->where('user_id', Auth::id());
//                    })
                ->whereIn('regStatus', ['ScheduledMentoring', 'Mentoring'])
                ->get();

//            dd($MentoringMeetings);
        }
        else if(Auth::user()->hasRole('BusinessSchool')){
//            $MentoringMeetings = DB::table('slips as s')
//                ->join('campuses as c', 'c.id', '=', 's.business_school_id')
//                ->join('departments as d', 'd.id', '=', 's.department_id')
//                ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
//                ->join('users as u', 'u.id', '=', 's.created_by')
////                ->join('mentoring_mentors as mm', 'u.id', '=', 'mm.user_id')
//                ->select('s.*', 'c.location as campus','c.id as campus_id', 'd.name as department', 'u.name as user', 'u.email', 'u.contact_no', 'bs.name as school', 'bs.id as business_school_id')
//                ->where('s.regStatus', 'ScheduledMentoring')
//                ->orWhere('s.regStatus', 'Mentoring')
//                ->where('s.status', 'approved')
//                ->get();

            $MentoringMeetings = Slip::with('campus', 'department')
//                    ->whereHas('mentoring_mentor', function ($q) {
//                        $q->where('user_id', Auth::id());
//                    })
                ->whereIn('regStatus', ['ScheduledMentoring', 'Mentoring'])
                ->where(['created_by'=> Auth::id()])
                ->get();

        }

        $PeerReviewVisit=[];

        if(Auth::user()->hasRole(['NbeacFocalPerson', 'NBEACAdmin', 'ESScheduler'])) {
//            dd('mentors ');
            $PeerReviewVisit = Slip::with('campus', 'department')
                ->whereIn('regStatus', ['ScheduledPRVisit', 'PeerReviewVisit'])
                ->where('status', 'approved')
                ->get();

            }
            else if(Auth::user()->hasRole(['Mentor', 'PeerReviewer'])){
                $PeerReviewVisit = Slip::with(['campus', 'department','peer_review_reviewer' => function($q) {
                    $q->where(['user_id'=>Auth::id()]);
                }])
                    ->whereIn('regStatus', ['ScheduledPRVisit', 'PeerReviewVisit'])
                    ->where('status', 'approved')
                    ->get();

//                            dd($PeerReviewVisit);

            }else {
            $PeerReviewVisit = Slip::with('campus', 'department')
                ->where(['business_school_id'=>Auth::user()->campus_id,
                    'department_id'=>Auth::user()->department_id])
                ->whereIn('regStatus', ['ScheduledPRVisit', 'PeerReviewVisit'])
                ->where('status', 'approved')
                ->get();
        }


//        dd($PeerReviewVisit);

//        $businessSchools = DB::select('
//SELECT business_schools.*, campuses.location as campus, campuses.id as campusID,slips.id as slip_id, slips.status as slipStatus
//FROM business_schools, users, campuses, slips
//WHERE users.business_school_id=business_schools.id
//AND campuses.business_school_id=business_schools.id
//AND business_schools.status="active"
////AND slips.business_school_id=campuses.id
//AND slips.status="approved" AND slips.regStatus="SAR" ');

        $businessSchools = Slip::with('campus', 'department')
            ->where(['status' =>'approved', 'regStatus'=>'SAR'])->get();
        $profileSheet = Slip::with('campus', 'department')
            ->where(['business_school_id'=>Auth::user()->campus_id,
                'department_id'=>Auth::user()->department_id])->first();
        $travel_plan = Slip::where('id', @$PeerReviewVisit[0]->id)->get()->first();
//        dd($travel_plan);
        $feedbacks = InstituteFeedback::where(['created_by' => Auth::id(), 'slip_id' => @$PeerReviewVisit[0]->id])->get()->first();

//        dd($travel_plan->pr_travel_plan);
        if(Auth::user()->hasRole('NBEACAdmin')) {
            $campus_count = Campus::where(['status' => 'active'])->get()->count('location');
        }else{
            $campus_count = User::with('campus')->where(['status' => 'active', 'id' =>Auth::id()])->get()->count('location');
//            dd($campus_count);
        }
        $dept_count = Department::where(['status' => 'active'])->get()->count('name');
        $bs_count = BusinessSchool::where(['status' => 'active'])->get()->count('name');
        $programs = Program::where(['status' => 'active'])->get()->count('name');
        $fm_count = FacultyGender::where(['status' => 'active'])->get()->sum('male');
        $fem_count = FacultyGender::where(['status' => 'active'])->get()->sum('female');
        $mentoring_slip_count = MentoringInvoice::where(['status' => 'active'])->get()->count();
        $user_count = User::where(['status' => 'active'])->get()->count();
        $user_pending = User::where(['status' => 'pending'])->get()->count();
        $desk_count = Slip::where(['regStatus'=>'Review'])->get()->count();
        $sar_desk_count = Slip::where(['regStatus'=>'SARDeskReview'])->get()->count();
//        dd($mentoring_slip_count);
        $PeerReviewers = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['Mentor', 'PeerReviewer']);
        })->get();



        return view('home' , compact( 'registrations', 'invoices', 'memberShips',
            'registration_apply','businessSchools', 'eligibility_registrations', 'eligibility_screening',
            'MentoringMeetings', 'PeerReviewVisit', 'travel_plan', 'feedbacks',
            'campus_count' ,'dept_count' ,'bs_count','fm_count','fem_count','programs','count_slips',
            'mentoring_slip_count', 'PeerReviewers','profileSheet', 'user_count', 'desk_count', 'sar_desk_count', 'user_pending'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \User  $user
     * @return \Illuminate\Http\Response
     */


    public function getPeerReviewers(Request $request) {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
            if($validation->fails()){
                return response()->json($validation->messages()->all(), 422);
            }
    }

    public function getApplyForm(){

        $campus_id = Auth::user()->campus_id;
        $department_id = Auth::user()->department_id;

        $query = '
        SELECT slips.*, campuses.location as campus,
        departments.name as department,
        users.name as user,
        users.email, users.contact_no,
        business_schools.name as school
        FROM slips, campuses, departments, business_schools, users
        WHERE slips.business_school_id=campuses.id
        AND departments.id=slips.department_id
        AND campuses.business_school_id=business_schools.id
        AND users.id = slips.created_by ';
        $campus_id? $query.='AND campuses.id = '.$campus_id:'';

        $department_id? $query.=' AND departments.id = '.$department_id:'';
        $invoices = DB::select($query);
       return view('registration.home', compact('invoices'));
    }

    public function getConsultants($id) {
        $validation = Validator::make(['slip_id'=>$id], $this->rules(), $this->messages());
        if($validation->fails()){
            return response()->json($validation->messages()->all(), 422);
        }
        $getReviewers = PeerReviewReviewer::with('user')->where(['slip_id'=> $id])->get();
        $users = [];
        foreach ($getReviewers as $reviewer)
        {
            $users[$reviewer->user->id] = $reviewer->user->name;
        }

        return response()->json($users, 200);


    }

    public function getInvoice($id) {
        $getInvoice = Slip::with('campus', 'department')->where(['id' => $id])->first();
         return response()->json($getInvoice, 200);

    }
    protected function rules(){
        return ['slip_id'=> 'required'];
    }

    protected  function messages(){
        return [ 'required' => 'The :field can not be empty.'];
    }
    protected function isRegCompleted()
    {


    }
    public function apply(Request $user,  $id)
    {
        //dd($user);
        if($id)
        {
//            DB::enableQueryLog();
            try {
            $campus_id = Auth::user()->campus_id;
            $department_id = Auth::user()->department_id;
            $registration_apply = Slip::where(
                ['id' => $id,'business_school_id' => $campus_id, 'department_id' => $department_id])
                ->update(['regStatus' =>'Review', 'registration_date'=>date('Y-m-d')]);
           //dd(DB::getQueryLog());
            $getNbeacData = NbeacBasicInfo::all()->first();
            $businessSchool =Slip::with('campus', 'department')
                ->where(
                    [
                        'business_school_id'=>Auth::user()->campus_id,
                        'department_id'=>Auth::user()->department_id,
                    ]
                )->get()->first();

            if($registration_apply)
            {
                $data= [];
                $data['nbeac']= $getNbeacData;
                $data['school']= $businessSchool;
                $mailInfo = [
                    'to' => $getNbeacData->email??'info@nbeac.org.pk',
                    'to_name' => $getNbeacData->director,
                    'school' => $businessSchool->campus->business_school->name,
                    'campus' => $businessSchool->campus->location,
                    'from' => $businessSchool->campus->user->email,
                    'from_name' => $businessSchool->campus->user->name,
                ];
                Mail::send('registration.mail.reg_apply_temp', ['data'=>$data], function($message) use ($mailInfo) {
                    //dd($user);
                    $message->to($mailInfo['to'],$mailInfo['to_name'] )
                        ->subject('Registration Application Submitted');
                });
                
                $data['user'] = $businessSchool->campus->user->name;
                $data['department'] = $businessSchool->department->name;
                $data['campus'] = $businessSchool->campus->location;
                $data['scopes'] = Scope::where([
                    'campus_id' => $businessSchool->campus->id,
                    'department_id' => $businessSchool->department->id,
                ])->get();

                Mail::to($businessSchool->campus->user->email)->send(new ChangeResgistrationStatusMail($data));

                return response()->json(['success' => 'Application Submitted'], 200);
            }
            return redirect('/home');

            }catch (Exception $e)
            {
                return response()->json(['message' => $e->getMessage()]);
            }

        }
    }
}
