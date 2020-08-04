<?php

namespace App\Http\Controllers;

use App\CharterType;
use App\InstituteType;
use App\Models\Common\CourseType;
use App\Models\Common\Department;
use App\Models\Common\Program;
use App\Models\Common\Semester;
use App\Models\Common\Degree;
use App\Models\Common\Designation;
use App\Models\Common\Discipline;
use App\Models\Common\EligibilityCriteria;
use App\Models\Common\FeeType;
use App\Models\Common\FypRequirement;
use App\Models\Common\Level;
use App\Models\Common\PaymentMethod;
use App\Models\Common\Region;
use App\Models\Common\ReviewerRole;
use App\Models\Common\Sector;
use App\Models\Facility\FacilityType;
use App\Models\Facility\Facility;
use App\Models\social_responsibility\WelfareProgram;
use App\Models\StrategicManagement\StatutoryBody;
use App\BusinessSchool;
use App\PublicationType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    protected $TableRows;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    public function index($table)
    {
        switch ($table){
            case 'charter_types' :
            {
                $this->TableRows  = CharterType::all();

                break;
            }
            case 'institute_types':
            {
                $this->TableRows = InstituteType::all();
                break;
            }
            case 'course_types':
            {
                $this->TableRows = CourseType::all();
                break;
            }
            case 'departments':
            {
                $this->TableRows = Department::all();
                break;
            }
            case 'programs':
            {
                $this->TableRows = Program::with('department')->get();
                break;
            }
            case 'semesters':
            {
                $this->TableRows = Semester::all();
                break;
            }
            case 'degrees':
            {
                $this->TableRows = Degree::all();
                break;
            }
            case 'business_school':
            {
                $this->TableRows = BusinessSchool::all();
                break;
            }
            case 'designations':
            {
                $this->TableRows = Designation::all();
                break;
            }
            case 'disciplines':
            {
                $this->TableRows = Discipline::all();
                break;
            }
            case 'eligibility_criterias':
            {
                $this->TableRows = EligibilityCriteria::all();
                break;
            }
            case 'facility_types':
            {
                $this->TableRows = FacilityType::all();
                break;
            }
            case 'facilities':
            {
                $this->TableRows =Facility::all();
                break;
            }
            case 'fee_types';
            {
                $this->TableRows =FeeType::all();
                break;
            }
            case 'fyp_requirements';
            {
                $this->TableRows =FypRequirement::all();
                break;
            }
            case 'levels';
            {
                $this->TableRows =Level::all();
                break;
            }
            case 'payment_methods';
            {
                $this->TableRows =PaymentMethod::all();
                break;
            }
            case 'publication_types';
            {
                $this->TableRows =PublicationType::all();
                break;
            }
            case 'regions';
            {
                $this->TableRows =Region::all();
                break;
            }
            case 'reviewer_roles';
            {
                $this->TableRows =ReviewerRole::all();
                break;
            }
            case 'sectors';
            {
                $this->TableRows =Sector::all();
                break;
            }
            case 'statutory_bodies';
            {
                $this->TableRows =StatutoryBody::all();
                break;
            }
            case 'welfare_programs';
            {
                $this->TableRows =WelfareProgram::all();
                break;
            }
        }


        $TableRows = $this->TableRows;
        $counter = $this->counter();
        $departments = Department::all();
        //dd($counter);
        $TableName = ucwords(str_replace('_',' ', $table));
//        dd();
        return view('config', compact('TableRows', 'TableName', 'counter', 'departments'));
    }

    public function counter()
    {
        $counter = [];

        $CharterType= CharterType::all()->count();
        $counter['CharterType'] = $CharterType;

        $InstituteType= InstituteType::all()->count();
        $counter['InstituteType'] = $InstituteType;

        $CourseType= CourseType::all()->count();
        $counter['CourseType'] = $CourseType;

        $Department= Department::all()->count();
        $counter['Department'] = $Department;

        $Program= Program::all()->count();
        $counter['Program'] = $Program;

        $Semester= Semester::all()->count();
        $counter['Semester'] = $Semester;

        $Degree= Degree::all()->count();
        $counter['Degree'] = $Degree;

        $business_school= BusinessSchool::all()->count();
        $counter['BusinessSchool'] = $business_school;

        $Designation= Designation::all()->count();
        $counter['Designation'] = $Designation;

        $Discipline= Discipline::all()->count();
        $counter['Discipline'] = $Discipline;

        $EligibilityCriteria= EligibilityCriteria::all()->count();
        $counter['EligibilityCriteria'] = $EligibilityCriteria;

        $FacilityType= FacilityType::all()->count();
        $counter['FacilityType'] = $FacilityType;

        $Facility= Facility::all()->count();
        $counter['Facility'] = $Facility;

        $FeeType= FeeType::all()->count();
        $counter['FeeType'] = $FeeType;

        $FypRequirement= FypRequirement::all()->count();
        $counter['FypRequirement'] = $FypRequirement;

        $Level= Level::all()->count();
        $counter['Level'] = $Level;

        $PaymentMethod= PaymentMethod::all()->count();
        $counter['PaymentMethod'] = $PaymentMethod;

        $PublicationType= PublicationType::all()->count();
        $counter['PublicationType'] = $PublicationType;

        $Region= Region::all()->count();
        $counter['Region'] = $Region;

        $ReviewerRole= ReviewerRole::all()->count();
        $counter['ReviewerRole'] = $ReviewerRole;

        $Sector= Sector::all()->count();
        $counter['Sector'] = $Sector;

        $StatutoryBody= StatutoryBody::all()->count();
        $counter['StatutoryBody'] = $StatutoryBody;

        $WelfareProgram= WelfareProgram::all()->count();
        $counter['WelfareProgram'] = $WelfareProgram;


        return $counter;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $table)
    {
        //dd($request);
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());

        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        switch ($table){
            case 'charter_types' :
            {
                $this->TableRows  = CharterType::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'institute_types':
            {
                $this->TableRows = InstituteType::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'course_types':
            {
                $this->TableRows = CourseType::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'departments':
            {
                $this->TableRows = Department::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'programs':
            {
                $this->TableRows = Program::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'semesters':
            {
                $this->TableRows = Semester::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'degrees':
            {
                $this->TableRows = Degree::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'business_school':
            {
                $this->TableRows = BusinessSchool::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'designations':
            {
                $this->TableRows = Designation::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'disciplines':
            {
                $this->TableRows = Discipline::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'eligibility_criterias':
            {
                $this->TableRows = EligibilityCriteria::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'facility_types':
            {
                $this->TableRows = FacilityType::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'facilities':
            {
                $this->TableRows = Facility::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'fee_types':
            {
                $this->TableRows = FeeType::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'fyp_requirements':
            {
                $this->TableRows = FypRequirement::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'levels':
            {
                $this->TableRows = Level::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'payment_methods':
            {
                $this->TableRows = PaymentMethod::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'publication_types':
            {
                $this->TableRows = PublicationType::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'regions':
            {
                $this->TableRows =Region::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'reviewer_roles':
            {
                $this->TableRows =ReviewerRole::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'sectors':
            {
                $this->TableRows =Sector::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'statutory_bodies':
            {
                $this->TableRows =StatutoryBody::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'welfare_programs':
            {
                $this->TableRows =WelfareProgram::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
        }



    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $table, $id)
    {
        //dd($request);

        $validation = Validator::make($request->all(), $this->rules(), $this->messages());

        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        switch ($table){
            case 'charter_types' :
            {
                $this->TableRows  = CharterType::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'institute_types':
            {
                $this->TableRows = InstituteType::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'course_types':
            {
                $this->TableRows = CourseType::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'departments':
            {
                $this->TableRows = Department::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'programs':
            {
                $this->TableRows = Program::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'semesters':
            {
                $this->TableRows = Semester::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'degrees':
            {
                $this->TableRows = Degree::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'business_school':
            {
                $this->TableRows = BusinessSchool::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'designations':
            {
                $this->TableRows = Designation::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'disciplines':
            {
                $this->TableRows = Discipline::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'eligibility_criterias':
            {
                $this->TableRows = EligibilityCriteria::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'facility_types':
            {
                $this->TableRows = FacilityType::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'facilities':
            {
                $this->TableRows = Facility::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'fee_types':
            {
                $this->TableRows = FeeType::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'fyp_requirements':
            {
                $this->TableRows = FypRequirement::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'levels':
            {
                $this->TableRows = Level::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'payment_methods':
            {
                $this->TableRows = PaymentMethod::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'publication_types':
            {
                $this->TableRows = PublicationType::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'regions':
            {
                $this->TableRows = Region::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'reviewer_roles':
            {
                $this->TableRows = ReviewerRole::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'sectors':
            {
                $this->TableRows = Sector::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'statutory_bodies':
            {
                $this->TableRows = StatutoryBody::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'welfare_programs':
            {
                $this->TableRows = WelfareProgram::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $table)
    {
        //dd($request);

        switch ($table){
            case 'charter_types' :
            {
                $this->TableRows  = CharterType::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'institute_types':
            {
                $this->TableRows  = InstituteType::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'course_types':
            {
                $this->TableRows  = CourseType::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'departments':
            {
                $this->TableRows  = Department::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'programs':
            {
                $this->TableRows  = Program::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'semesters':
            {
                $this->TableRows  = Semester::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'degrees':
            {
                $this->TableRows  = Degree::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'business_school':
            {
                $this->TableRows  = BusinessSchool::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'designations':
            {
                $this->TableRows  = Designation::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'disciplines':
            {
                $this->TableRows  = Discipline::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'eligibility_criterias':
            {
                $this->TableRows  = EligibilityCriteria::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'facility_types':
            {
                $this->TableRows  = FacilityType::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'facilities':
            {
                $this->TableRows  = Facility::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'fee_types':
            {
                $this->TableRows  = FeeType::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'fyp_requirements':
            {
                $this->TableRows  = FypRequirement::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'levels':
            {
                $this->TableRows  = Level::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'payment_methods':
            {
                $this->TableRows  = PaymentMethod::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'publication_types':
            {
                $this->TableRows  = PublicationType::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'regions':
            {
                $this->TableRows  = Region::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'reviewer_roles':
            {
                $this->TableRows  = ReviewerRole::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'sectors':
            {
                $this->TableRows  = Sector::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'statutory_bodies':
            {
                $this->TableRows  = StatutoryBody::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'welfare_programs':
            {
                $this->TableRows  = WelfareProgram::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
        }
        $request->destroy();
    }

    protected function rules() {
        return [ 'name' => 'required'];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }

}
