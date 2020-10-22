<?php

namespace App\Http\Controllers\Auth;

use App\BusinessSchool;
use App\CharterType;
use App\Http\Controllers\Controller;
use App\InstituteType;
use App\Models\Common\Degree;
use App\Models\Common\Department;
use App\Models\Common\Discipline;
use App\Models\Common\Question;
use App\Models\Common\Region;
use App\Models\Common\ReviewerRole;
use App\Models\Common\Sector;
use App\Models\Common\Designation;
use App\Specialization;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Support\Facades\Input;
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
        if ($data['account_type'] === 'BusinessSchool')
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
                'undertaking' => 'required',
                'cao_name'=>'required',
//                'slip.*' => 'file|mimetypes:application/msword,application/pdf|max:2048',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password_confirmation' => ['required', 'string', 'min:8'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
            );
        }

        if($data['account_type'] === 'PeerReviewer')
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
        $businessSchool = BusinessSchool::where('id', $data['business_school_id']);

        if($data['account_type']== 'BusinessSchool') {
//            try {
//                $update = BusinessSchool::find($data['business_school_id']);
////                $update->update([
////                    'contact_person' => $data['name'],
//////                    'status' => 'inactive',
////                ]);
//
//            } catch (Exception $e) {
//                return $e->getMessage();
//            }

            try {
                $path = ''; $imageName = '';
//                if(@$data['slip']) {
//                    $filename = $data['name']."-slip-".time().'.'.$data['slip']->extension();
//                    //dd(trim($imageName));
//                    $path = 'uploads/schools/slips';
//                    $diskName = env('DISK');
//                    $disk = Storage::disk($diskName);
//                    $data['slip']->move($path, $filename);
//
//                    Slip::create([
//                        'business_school_id' => $data['business_school_id'],
//                        'program_id' => $data['department_id'],
//                        'slip' => $path.'/'.$filename,
//                        'status' => 'paid',
//                    ]);
//
//                }
                $user =  User::create([
                    'name' => $data['name'],
                    'designation_id' => $data['designation_id'],
                    'cnic' => $data['cnic'],
                    'contact_no' => $data['contact_no'],
                    'country' => $data['country'],
                    'city' => $data['city'],
                    'address' => $data['address'],
                    'business_school_id' => $data['business_school_id'],
                    'campus_id' => $data['campus_id'],
                    'discipline_id' => $data['discipline_id'],
                    'cao_name'=>$data['cao_name'],
                    'department_id' => $data['department_id'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'user_type' => $data['account_type'],
                    'status' => 'pending',
                ]);

                $user->assignRole('BusinessSchool');
                return $user;

            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
        if($data['account_type']== 'PeerReviewer') {
            try {
                $user = User::create([
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
                    /*'recommend' => $data['rational_recommend'],*/
                    'user_id' => $data['recommended'],
                    'email' => $data['email'],
//                    'email_verified_at' => '',
                    'password' => Hash::make($data['password']),
                    'user_type' => $data['account_type'],
                    'status' => 'pending',
                ]);

                $user->assignRole('PeerReviewer');
                return $user;

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
        $departments = Department::where('status', 'active')->get();
        $disciplines = Discipline::where('status', 'active')->get();
        $regions = Region::where('status', 'active')->get();
        $reviewerRoles = ReviewerRole::where('status', 'active')->get();
        $specializations = Specialization::where('status', 'active')->get();
        $sectors = Sector::where('status', 'active')->get();
        $sectorsID = Sector::where(['id'=>3])->get()->first();
        $degrees = Degree::where('status', 'active')->get();
        $users = \App\User::where('user_type', 'PeerReviewer');
        $questions = Question::where('status', 'active')->get();
        //dd($users);

        return view('auth.register-new', compact(
            'institute_types', 'chart_types',
            'business_school','designations','countries',
            'departments', 'disciplines','regions', 'reviewerRoles',
            'sectors', 'degrees','users', 'questions','sectorsID','specializations')
        );
    }

    public function get_cities(Request $request)
    {
       // echo "working here";
       // exit;
       // dd($request->all());
        $cities = Countries::where('name.common', $request->country)->first()
            ->hydrate('cities')
            ->cities
            ->sortBy('name');
        return $cities;
    }

//    public function mailsend()
//    {
//
//        try {
//            $messge = 'here is the message';
//            Mail::to('awaisrazzaa@gmail.com')->send(new RegisterationMail($messge));
//
//            // Mail::to('walayat.iplex@gmail.com')->send(new RegistrationMail());
//            return 'done';
//        }catch (Exception $e)
//        {
//            var_dump($e->getMessage());
//        }
//
//    }
}
