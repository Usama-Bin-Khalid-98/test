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
        //$userHas = Auth::user()->getPermissionsViaRoles();
        //$check = $userHas->has('name');
        //dd($check);
        $memberShips = User::with('business_school')->where('status', 'pending')->get();
        $invoices = Slip::with('business_school', 'department')->get();
        $registrations = User::with('business_school')->where(['status' => 'active', 'request'=>'pending'])->get();
        $registration_apply = User::with('business_school')->where(['status' => 'active', 'user_type'=>'business_school'])->get();
        //dd($registrations);
        return view('home' , compact( 'registrations', 'invoices', 'memberShips','registration_apply'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \User  $user
     * @return \Illuminate\Http\Response
     */
    public function apply(Request $user,  $id)
    {
        //dd($user);
        if($id)
        {
            DB::enableQueryLog();
            try {
            $user_id = Auth::id();
            $registration_apply = User::where(['id' => $user_id, 'department_id' => $user->department_id])->update(['request' =>'pending']);
           // dd(DB::getQueryLog());
            return response()->json(['success' => 'Successfully applied for department Registration']);

            }catch (Exception $e)
            {
                return response()->json(['message' => $e->getMessage()]);
            }

        }
    }
}
