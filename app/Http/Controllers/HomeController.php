<?php

namespace App\Http\Controllers;

use App\Models\Common\Slip;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        $registrations = User::with('business_school')->where('status', 'pending')->get();
        $invoices = Slip::with('business_school', 'department')->get();
        return view('home' , compact( 'registrations', 'invoices'));
    }
}
