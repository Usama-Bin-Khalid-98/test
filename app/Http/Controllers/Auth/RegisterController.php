<?php

namespace App\Http\Controllers\Auth;

use App\BusinessSchool;
use App\CharterType;
use App\Http\Controllers\Controller;
use App\InstituteType;
use App\Mail\RegisterationMail;
use App\Models\Common\Degree;
use App\Models\Common\Discipline;
use App\Models\Common\Program;
use App\Models\Common\Region;
use App\Models\Common\ReviewerRole;
use App\Models\Common\Sector;
use App\Models\StrategicManagement\Designation;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        if ($data['account_type'] === 'business_school')
        {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'designation_id' => 'required',
                'cnic' => 'required',
                'contact_no' => 'required',
                'country' => 'required',
                'city' => 'required',
                'address' => 'required',
                'business_school_id' => 'required',
                'discipline_id' => 'required',
                'department_id' => 'required',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password_confirmation' => ['required', 'string', 'min:8'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
            );
        }

        if($data['account_type'] === 'peer_review')
        {
            return Validator::make($data, [
                'reviewer_role_id' => 'required',
                'region_id' => 'required',
                'sector_id' => 'required',
                'qualification' => 'required',
                'degree_id' => 'required',
                'specialization' => 'required',
                'year_completion' => 'required',
                'institute' => 'required',
                'employed' => 'required',
                'service' => 'required',
                'academic_exp' => 'required',
//                'research' => 'required',
//                'nbeac_seminar' => 'required',
//                'date_seminar' => 'required',
//                'rational_recommend' => 'required',
//                'user_id' => 'required',
//                'industry_exp' => 'required',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password_confirmation' => ['required', 'string', 'min:8'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }

    }

    protected function messages()
    {
        return [
            'required' => 'The :attribute can not be blanked'
        ];
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
       // dd($data->all());

        $businessSchool = BusinessSchool::where('id', $data['business_school_id']);

        if($data['account_type']== 'business_school') {
            try {
                $update = BusinessSchool::find($data['business_school_id']);
                $update->update([
                    'contact_person' => $data['name'],
                    'status' => 'inactive',
                ]);

            } catch (Exception $e) {
                return $e->getMessage();
            }

            try {
                return User::create([
                    'name' => $data['name'],
                    'designation_id' => $data['designation_id'],
                    'cnic' => $data['cnic'],
                    'contact_no' => $data['contact_no'],
                    'country' => $data['country'],
                    'city' => $data['city'],
                    'address' => $data['address'],
                    'business_school_id' => $data['business_school_id'],
                    'discipline_id' => $data['discipline_id'],
                    'department_id' => $data['department_id'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'user_type' => $data['account_type'],
                    'status' => 'pending',
                ]);

            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
        if($data['account_type']== 'peer_review') {
            try {
                return User::create([
                    'name' => $data['name'],
                    'designation_id' => $data['designation_id'],
                    'cnic' => $data['cnic'],
                    'contact_no' => $data['contact_no'],
                    'country' => $data['country'],
                    'city' => $data['city'],
                    'address' => $data['address'],

                    'business_school_id' => $data['institute'],
                    'reviewer_role_id' => $data['reviewer_role_id'],
                    'region_id' => $data['region_id'],
                    'sector_id' => $data['sector_id'],
                    'qualification' => $data['qualification'],
                    'degree_id' => $data['degree_id'],
                    'specialization' => $data['specialization'],
                    'year_completion' => $data['year_completion'],
                    'from_institute' => $data['institute'],
                    'employed_at' => $data['employed'],
                    'length_service' => $data['service'],
                    'industry_exp' => $data['industry_exp'],
                    'academic_exp' => $data['academic_exp'],
                    'research_publication' => $data['research'],
                    'nbeac_seminar' => $data['nbeac_seminar'],
                    'date_seminar' => $data['date_seminar'],
                    'recommend' => $data['rational_recommend'],
                    'user_id' => $data['recommended'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'user_type' => $data['account_type'],
                    'status' => 'pending',
                ]);

            } catch (Exception $e) {
                return $e->getMessage();
            }
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

        $institute_types=InstituteType::where('status', 'active')->get();
        $chart_types=CharterType::where('status', 'active')->get();
        $business_school=BusinessSchool::where('status', 'active')->get();
        $designations=Designation::where('status', 'active')->get();
        $programs = Program::where('status', 'active')->get();
        $disciplines = Discipline::where('status', 'active')->get();
        $regions = Region::where('status', 'active')->get();
        $reviewerRoles = ReviewerRole::where('status', 'active')->get();
        $sectors = Sector::where('status', 'active')->get();
        $degrees = Degree::where('status', 'active')->get();
        $users = \App\User::where('user_type', 'peer_reviewer');
        //dd($users);

        return view('auth.register-new', compact(
            'institute_types', 'chart_types',
            'business_school','designations','countries',
            'programs', 'disciplines','regions', 'reviewerRoles',
            'sectors', 'degrees','users')
        );
    }

    public function get_cities(Request $request)
    {

        $cities = Countries::where('name.common', $request->country)->first()
            ->hydrate('cities')
            ->cities
            ->sortBy('name');

        return $cities;
    }

    public function mailsend()
    {

        try {
            $messge = 'here is the message';
            Mail::to('awaisrazzaa@gmail.com')->send(new RegisterationMail($messge));

            // Mail::to('walayat.iplex@gmail.com')->send(new RegistrationMail());
            return 'done';
        }catch (Exception $e)
        {
            var_dump($e->getMessage());
        }

    }
}
