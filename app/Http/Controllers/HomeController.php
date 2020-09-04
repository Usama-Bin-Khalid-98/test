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
        $invoices = Slip::with('business_school', 'department')->where(['business_school_id' => $campus_id, 'department_id' => $department_id])->get();
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

        $eligibility_registrations = Slip::where(['status' => 'paid', 'regStatus' =>'Eligibility'])->get();

        $businessSchools = DB::select('SELECT business_schools.*, campuses.location as campus, campuses.id as campusID FROM business_schools, campuses WHERE campuses.business_school_id=business_schools.id AND business_schools.status="active"', array());
        return view('home' , compact( 'registrations', 'invoices', 'memberShips',
            'registration_apply','businessSchools', 'eligibility_registrations'));
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
