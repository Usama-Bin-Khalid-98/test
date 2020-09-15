<?php

namespace App\Http\Controllers;

use App\Models\Common\EligibilityStatus;
use App\Models\Common\Slip;
use App\Models\DeskReview;
use App\Models\Faculty\FacultyGender;
use App\Models\Faculty\FacultySummary;
use App\Models\Faculty\FacultyTeachingCources;
use App\Models\Faculty\VisitingFaculty;
use App\Models\Faculty\FacultyStability;
use App\Models\Faculty\WorkLoad;
use App\Models\Facility\BusinessSchoolFacility;
use App\Models\Research\ResearchSummary;
use App\Models\StrategicManagement\ApplicationReceived;
use App\Models\StrategicManagement\MissionVision;
use App\Models\StrategicManagement\Scope;
use App\Models\StrategicManagement\StrategicPlan;
use App\Models\StrategicManagement\StudentEnrolment;
use App\NbeacCriteria;
use App\StudentsGraduated;
use App\FacultyDegree;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use DB;

class DeskReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$registrations = User::with('business_school')->where(['status' => 'active', 'request'=>'pending'])->get();

        $registrations = DB::table('slips as s')
            ->join('campuses as c', 'c.id', '=', 's.business_school_id')
            ->join('departments as d', 'd.id', '=', 's.department_id')
            ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
            ->join('users as u', 'u.id', '=', 's.created_by')
            ->select('s.*', 'c.location as campus', 'd.name as department', 'u.name as user', 'u.email', 'u.contact_no', 'bs.name as school')
//            ->where('s.reg')
            ->get();
        //dd($desk_reviews);

        return view('desk_review.index', compact('registrations'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function deskreview($id=null)
    {

        $nbeac_criteria = NbeacCriteria::all()->first();
        @$business_school_user = Slip::where(['id' => $id])->get()->first();
       // dd($business_school_user);
        $campus_id = $business_school_user->campus_id;
        $department_id = $business_school_user->department_id;

        $accreditation=  Scope::with('program')->where(['status'=> 'active', 'campus_id' => $campus_id, 'department_id' => $department_id])->get();
//      $accreditation=  Scope::where(['status'=> 'active', 'campus_id' => $campus_id, 'department_id' => $department_id])->get();
        //dd($accreditation);
        $program_dates = [];
        foreach ($accreditation as $accred)
        {
            @$program_dates[$accred->id]['date_diff'] = $this->dateDifference($accred->date_program, date('Y-m-d'), '%y Year %m Month');
            @$program_dates[$accred->id]['program'] = $accred->program->name;
            @$program_dates[$accred->id]['date'] = $accred->date_program;
        }

        $mission_vision = MissionVision::all()->where(['campus_id' => $campus_id, 'department_id' => $department_id])->first();
        @$strategic_plan = StrategicPlan::all()->where(['campus_id' => $campus_id, 'department_id' => $department_id])->first();
        @$application_received = ApplicationReceived::all()->where(['campus_id' => $campus_id, 'department_id' => $department_id])->first();
        $student_enrolment = StudentEnrolment::all()->where(['campus_id' => $campus_id, 'department_id' => $department_id]);
        $graduated_students = StudentsGraduated::with('program')->where(['campus_id' => $campus_id, 'department_id' => $department_id])->get();

        $faculty_summary= FacultySummary::where(['campus_id'=> $campus_id, 'department_id' => $department_id, 'status' => 'active'])->get()->sum('number_faculty');
        $faculty_summary_doc= FacultySummary::where(['campus_id'=> $campus_id, 'department_id' => $department_id, 'status' => 'active', 'faculty_qualification_id' =>1])->get()->count();

        $getFullProfessors = FacultyTeachingCources::where(['status' => 'active', 'campus_id' => $campus_id, 'department_id' => $department_id, 'designation_id'=>8])->get()->count();
        $AssociateProfessors = FacultyTeachingCources::where(['status' => 'active', 'campus_id' => $campus_id, 'department_id' => $department_id, 'designation_id'=>9])->get()->count();
        $AssistantProfessors = FacultyTeachingCources::where(['status' => 'active', 'campus_id' => $campus_id, 'department_id' => $department_id, 'designation_id'=>10])->get()->count();
        $lecturers = FacultyTeachingCources::where(['status' => 'active', 'campus_id' => $campus_id, 'department_id' => $department_id, 'designation_id'=>11])->get()->count();
        $permanent_faculty = FacultyTeachingCources::where(['status' => 'active', 'campus_id' => $campus_id, 'department_id' => $department_id, 'lookup_faculty_type_id'=>1])->get()->count();
        $adjunct_faculty = FacultyTeachingCources::where(['status' => 'active', 'campus_id' => $campus_id, 'department_id' => $department_id, 'lookup_faculty_type_id'=>3])->get()->count();
        $other = FacultyTeachingCources::where(['status' => 'active', 'campus_id' => $campus_id, 'department_id' => $department_id, 'designation_id'=>13])->get()->count();
        $female_faculty = FacultyGender::where(['status' => 'active', 'campus_id' => $campus_id, 'department_id' => $department_id, 'lookup_faculty_type_id'=>1])->get()->count();
        $faculty_degree = FacultyDegree::get()->first();
        $total_induction = FacultyStability::where(['campus_id' => $campus_id, 'department_id' => $department_id, 'status' => 'active'])->get()->sum('new_induction');
        $faculty_terminated = FacultyStability::where(['campus_id' => $campus_id, 'department_id' => $department_id, 'status' => 'active'])->get()->sum('terminated');
        $faculty_resigned = FacultyStability::where(['campus_id' => $campus_id, 'department_id' => $department_id, 'status' => 'active'])->get()->sum('resigned');
        $faculty_retired = FacultyStability::where(['campus_id' => $campus_id, 'department_id' => $department_id, 'status' => 'active'])->get()->sum('retired');

        $total_courses = WorkLoad::where(['campus_id' => $campus_id, 'department_id' => $department_id, 'status' => 'active'])->get()->sum('total_courses');

        $bandwidth = BusinessSchoolFacility::where(['facility_id'=> 26])->get()->first();
        $comp_ratio = BusinessSchoolFacility::where(['facility_id'=> 28])->get()->first();

        $summaries = ResearchSummary::get();

        //dd($female_faculty);

        //dd($graduated_students);
        $strategic_date_diff = $this->dateDifference(@$strategic_plan->aproval_date, date('Y-m-d'), '%y Year %m Month');
        //dd($program_dates);
        //// get scope
        //$scope = Scope::where('')

        //@$desk_reviews = Slip::with('department', 'business_school')->where(['id'=> $id])->get();

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
        AND users.id = slips.created_by
        AND slips.id = '.$id;
        @$desk_reviews = DB::select($query);
        //dd($desk_reviews);
        return view('desk_review.desk_review', compact(
            'program_dates',
            'mission_vision',
            'strategic_plan',
            'strategic_date_diff',
            'application_received',
            'student_enrolment',
            'graduated_students',
            'faculty_summary',
            'getFullProfessors',
            'AssistantProfessors',
            'AssociateProfessors',
            'lecturers',
            'other',
            'faculty_summary_doc',
            'permanent_faculty',
            'adjunct_faculty',
            'female_faculty',
            'faculty_degree',
            'total_induction',
            'faculty_terminated',
            'faculty_resigned',
            'faculty_retired',
            'total_courses',
            'bandwidth',
            'comp_ratio',
            'summaries',
            'nbeac_criteria',
            'desk_reviews'

        ));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        $interval = date_diff($datetime1, $datetime2);
        return $interval->format($differenceFormat);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
         $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {
            $getUserData = Slip::where(['id' => $request->id])->get()->first();
            foreach ($request->all() as $key=>$isEligible){
                if($key !=='comments' && $key !=='id') {
                    DeskReview::create([
                        'campus_id' =>$getUserData->business_school_id,
                        'department_id' => $getUserData->department_id,
                        'nbeac_criteria' => $key,
                        'isEligible' => $isEligible,
                        'created_by' => Auth::user()->id
                    ]);
                }
            }
            $isEligible = 'no';
            if($request->eligibility_program == 'yes' &&
                $request->eligibility_mission == 'yes' &&
                $request->eligibility_plan == 'yes' &&
                $request->eligibility_student == 'yes' &&
                $request->eligibility_enrollment == 'yes' &&
                $request->eligibility_load == 'yes' &&
                $request->eligibility_output == 'yes' &&
                $request->eligibility_bandwidth == 'yes' &&
                $request->eligibility_ratio == 'yes'
            )
            {
                $isEligible = 'yes';
            }
            Slip::where(['business_school_id' => $getUserData->business_school_id,
                'department_id' => $getUserData->department_id])
                ->update([
                'isEligible' => $isEligible,
//                'regStatus' => 'Eligibility'
                ]
            );

            return response()->json(['success' => 'Desk Review added successfully.'], 200);
        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function show(DeskReview $deskReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function edit(DeskReview $deskReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeskReview $deskReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function deskreviewStatus(Request $request, DeskReview $deskReview)
    {
        //
       // dd($request->all());
        try {
            $update = Slip::find($request->id)->update(['regStatus' => 'Eligibility']);
            if($update)
            {
                return response()->json(['success' => 'Case forwarded to eligibility screening']);
            }
        }catch (\Exception $e)
        {
            return response()->json(['message' => 'Forwarding case to eligibility screening Failed.']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeskReview $deskReview)
    {
        //
    }

    protected function rules() {
        return [
//                'id' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
