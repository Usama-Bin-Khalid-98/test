<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Permission;

class UserController extends Controller
{
    //
    public function index() {
        $users = User::all();
        return view('auth.users.users', compact('users'));
    }
   
    public function permissions() {
        $permissions = Permission::all();
        return view('auth.users.permissions', compact('permissions'));
    }
}
