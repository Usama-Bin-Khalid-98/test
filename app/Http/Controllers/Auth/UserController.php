<?php

namespace App\Http\Controllers\Auth;

use App\BusinessSchool;
use App\CharterType;
use App\Http\Controllers\Controller;
use App\InstituteType;
use App\Models\Common\Degree;
use App\Models\Common\Department;
use App\Models\Common\Designation;
use App\Models\Common\Discipline;
use App\Models\Common\Question;
use App\Models\Common\Region;
use App\Models\Common\ReviewerRole;
use App\Models\Common\Sector;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;
use PragmaRX\Countries\Package\Countries;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //
    public function index() {
        $users = User::with('business_school', 'roles', 'permissions')->get();
        //dd($users->roles[0]->name);
//        $designations = Designation::all();
        $permissions = Permission::all();
        $roles = Role::all();
        $designations=Designation::where('status', 'active')->get();

        //dd($users);

        return view('auth.users.index', compact(
                'designations','users','permissions', 'roles')
        );
        //return view('auth.users.index', compact('users', 'designations', 'permissions', 'roles'));
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'contact_no' => 'required',
            'designation_id' => 'required',
            'cnic' => 'required',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        try {

       // dd($request->all());
        $user =  User::create([
            'name' => $request->name,
            'designation_id' => $request->designation_id,
            'cnic' => $request->cnic,
            'contact_no' => $request->contact_no,
            'address' => $request->address,
            'email' => $request->email,
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make($request->password),
            'status' => 'active',
            'user_type' => 'EligibilitySc',
        ]);

        $user->assignRole('EligibilityScreening');

        if ($user)
        {
            return response()->json(['message'=> 'User created successfully'], 200);
        }
        }
        catch (Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 400);
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();


        return view('users.edit',compact('user','roles','userRole'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }


        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();


        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user_roles(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permissions'
        ]);


        $user = User::find($id);
        //$user->update($request->role_id);
        DB::table('model_has_roles')->where('model_id',$id)->delete();


        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
        User::find($id)->delete();
        return response()->json(['message' => 'user successfully deleted'], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
