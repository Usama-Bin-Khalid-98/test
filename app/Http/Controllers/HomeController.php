<?php

namespace App\Http\Controllers;

use App\Models\Common\Slip;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

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
        //check is registration forms data completed:
        $check = $this->isRegCompleted(['user_id'=> $user_id, 'campus_id'=>$campus_id, 'department_id'=>$department_id]);
        $memberShips = User::with('business_school')->where('status', 'pending')->get();

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

        //dd($registrations);
        $registration_apply = User::with('business_school')->where(['status' => 'active', 'user_type'=>'business_school', 'id' => $user_id])->get();
        //$eligibility_registrations = Slip::where(['status' => 'paid', 'regStatus' =>'Eligibility'])->get();

        $eligibility_registrations = DB::table('slips as s')
            ->join('campuses as c', 'c.id', '=', 's.business_school_id')
            ->join('departments as d', 'd.id', '=', 's.department_id')
            ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
            ->join('users as u', 'u.id', '=', 's.created_by')
            ->select('s.*', 'c.location as campus', 'd.name as department', 'u.name as user', 'u.email', 'u.contact_no', 'bs.name as school')
            ->where('s.regStatus', 'Eligibility')
            ->orWhere('s.regStatus', 'ScheduledES')
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
//        AND slips.status ='paid'
//        AND slips.regStatus = 'Eligibility'
//        ");
        //OR is not working here
//        OR slips.regStatus = 'ScheduledES'

        $eligibility_screening = DB::select("
        SELECT slips.*, campuses.location as campus,
        departments.name as department,
        users.name as user, users.email, users.contact_no,
        business_schools.name as school
        FROM slips, campuses, departments, business_schools, users, e_s_reviewers
        WHERE slips.business_school_id=campuses.id
        AND departments.id=slips.department_id
        AND campuses.business_school_id=business_schools.id
        AND users.id = e_s_reviewers.user_id
        AND slips.id = e_s_reviewers.slip_id
        AND slips.status ='paid' AND slips.regStatus = 'ScheduledES'
        AND e_s_reviewers.user_id = ".Auth::id()
        );

        //dd($eligibility_screening);
        $businessSchools = DB::select('SELECT business_schools.*, campuses.location as campus, campuses.id as campusID FROM business_schools, campuses WHERE campuses.business_school_id=business_schools.id AND business_schools.status="active"', array());
        return view('home' , compact( 'registrations', 'invoices', 'memberShips',
            'registration_apply','businessSchools', 'eligibility_registrations', 'eligibility_screening'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \User  $user
     * @return \Illuminate\Http\Response
     */

    protected function isRegCompleted()
    {


    }
    public function apply(Request $user,  $id)
    {
        //dd($user);
        if($id)
        {
            DB::enableQueryLog();
            try {
            $user_id = Auth::id();
            $campus_id = Auth::user()->campus_id;
            $registration_apply = Slip::where(['id' => $id,'business_school_id'=> $campus_id, 'department_id' => $user->department_id])->update(['regStatus' =>'Review']);
           //dd(DB::getQueryLog());
            return response()->json(['success' => 'Successfully applied for department Registration']);

            }catch (Exception $e)
            {
                return response()->json(['message' => $e->getMessage()]);
            }

        }
    }
}
