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
use Illuminate\Support\Facades\Validator;
use App\Rules\MatchOldPassword;
use DB;

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
      $validation = Validator::make($request->all(), $this->update_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            User::where('id', $id)->update([
                'name' => $request->name,
                'cnic' => $request->cnic,
                'contact_no' => $request->contact_no,
                'address' => $request->address,
                'designation_id' => $request->designation_id,
                'email' => $request->email,
                'status' => $request->status
            ]);

           $user = User::find($id);
          //$user->update($request->role_id);
          DB::table('model_has_roles')->where('model_id',$id)->delete();
          $user->assignRole($request->input('role_id'));
            return response()->json(['success' => 'Record updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }  
    }


    public function updatePassword(Request $request )
    {
      $validation = Validator::make($request->all(), $this->password_rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
            User::where('id', $request->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            return response()->json(['success' => ' Password updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }  
    }


    /*public function updateUserRecord(Request $request, $id)
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
       
    }*/


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function user_roles(Request $request, $id)
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
    }*/


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
             User::destroy($id);
                return response()->json(['success' => 'Record deleted successfully.']);
         }catch (Exception $e)
             {
                return response()->json(['error' => 'Failed to delete record.']);
             }
    }



    protected function update_rules() {
        return [
            'name' => 'required',
            'designation_id' => 'required',
            'cnic' => 'required',
            'contact_no' => 'required',
            'email' => 'required',
            'address' => 'required',
            'role_id' => 'required'
        ];
    }


    protected function password_rules() {
        return [
            'current_password' =>['required', new MatchOldPassword],
            'new_password' => 'required',
            'confirm_new_password' => 'same:new_password'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
