<?php

namespace App\Http\Controllers\Auth;

use App\BusinessSchool;
use App\CharterType;
use App\Http\Controllers\Controller;
use App\InstituteType;
use App\Models\StrategicManagement\Designation;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use PragmaRX\Countries\Package\Countries;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'business_school_id' => ['required', 'string', 'max:255'],
            'year_estb' => ['required', 'date'],
            'address' => ['required'],
            'web_url' => ['required'],
            'date_charter_granted' => ['required'],
            'charter_number' => ['required'],
            'charter_type_id' => ['required', 'numeric'],
            'institute_type_id' => ['required', 'numeric'],
            'sector' => ['required'],
            'profit_status' => ['required'],
            'hierarchical_context' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $businessSchool = BusinessSchool::where('id', $data['business_school_id']);

        try {
            $update = BusinessSchool::find($data['business_school_id']);
            $update->update([
                'contact_person' => $data['contact_person'],
                'year_estb' => $data['year_estb'],
                'address' => $data['address'],
                'web_url' => $data['web_url'],
                'date_charter_granted' => $data['date_charter_granted'],
                'charter_number' => $data['charter_number'],
                'charter_type_id' => $data['charter_type_id'],
                'institute_type_id' => $data['institute_type_id'],
                'sector' => $data['sector'],
                'profit_status' => $data['profit_status'],
                'status' => 'inactive',
                'hierarchical_context' => $data['hierarchical_context']
            ]);

        } catch (Exception $e) {
            return $e->getMessage();
        }

        try {
            return User::create([
                'name' => $data['contact_person'],
                'business_school_id' => $data['business_school_id'],
                'email' => $data['email'],
                'status' => 'pending',
                'user_type' => 'school',
                'password' => Hash::make($data['password']),
            ]);

        } catch (Exception $e) {
            return $e->getMessage();
        }


    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $countries = Countries::all();
        $cities = Countries::where('name.common', 'Pakistan')->first()
            ->hydrate('cities')
            ->cities
            ->sortBy('name');

        $institute_types=InstituteType::where('status', 'active')->get();
        $chart_types=CharterType::where('status', 'active')->get();
        $business_school=BusinessSchool::where('status', 'active')->get();
        $designations=Designation::where('status', 'active')->get();
        return view('auth.register', compact('institute_types', 'chart_types','business_school','designations'));
    }
}
