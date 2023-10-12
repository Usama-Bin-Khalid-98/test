<?php

namespace App\Http\Controllers;

use App\CharterType;
use App\Models\StrategicManagement\InstituteType;
use App\TeachingMethod;
use App\EvaluationItem;
use App\Models\Common\CourseType;
use App\Models\Common\Department;
use App\Models\Common\Program;
use App\Models\Common\PublicationCategory;
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
use App\Models\Common\FacultyQualification;
use App\Models\Facility\FacilityType;
use App\Models\Facility\Facility;
use App\Models\Facility\StaffCategory;
use App\Models\Facility\QecType;
use App\Models\social_responsibility\WelfareProgram;
use App\Models\StrategicManagement\StatutoryBody;
use App\Models\StrategicManagement\FundingSources;
use App\BusinessSchool;
use App\PublicationType;
use App\ActivityEngagement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\AcademyLevel;
use App\Models\Common\AcademyType;
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
                $this->TableRows =PublicationType::with('publication_category')->get();
                break;
            }
            case 'publication_categories';
            {
                $this->TableRows =PublicationCategory::all();
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
            case 'staff_categories';
            {
                $this->TableRows =StaffCategory::all();
                break;
            }
            case 'qec_types';
            {
                $this->TableRows =QecType::all();
                break;
            }
            case 'faculty_qualifications';
            {
                $this->TableRows =FacultyQualification::all();
                break;
            }
            case 'funding_sources';
            {
                $this->TableRows =FundingSources::all();
                break;
            }
            case 'activity_engagements';
            {
                $this->TableRows =ActivityEngagement::all();
                break;
            }
            case 'teaching_methods';
            {
                $this->TableRows =TeachingMethod::all();
                break;
            }
            case 'evaluation_items';
            {
                $this->TableRows =EvaluationItem::all();
                break;
            }
            case 'academy_levels';
            {
                $this->TableRows =AcademyLevel::all();
                break;
            }
            case 'academy_types';
            {
                $this->TableRows =AcademyType::all();
                break;
            }
        }


        $TableRows = $this->TableRows;
        $counter = $this->counter();
        $departments = Department::all();
        $publication_categories = PublicationCategory::all();
        //dd($counter);
        $TableName = ucwords(str_replace('_',' ', $table));
//        dd();
        return view('config', compact('TableRows', 'TableName', 'counter', 'departments', 'publication_categories'));
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

        $PublicationType= PublicationCategory::all()->count();
        $counter['PublicationCategory'] = $PublicationType;

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

        $StaffCategory= StaffCategory::all()->count();
        $counter['StaffCategory'] = $StaffCategory;

        $QecType= QecType::all()->count();
        $counter['QecType'] = $QecType;

        $FacultyQualification= FacultyQualification::all()->count();
        $counter['FacultyQualification'] = $FacultyQualification;

        $FundingSources= FundingSources::all()->count();
        $counter['FundingSources'] = $FundingSources;

        $ActivityEngagement= ActivityEngagement::all()->count();
        $counter['ActivityEngagement'] = $ActivityEngagement;

        $TeachingMethod= TeachingMethod::all()->count();
        $counter['TeachingMethod'] = $TeachingMethod;

        $EvaluationItem= EvaluationItem::all()->count();
        $counter['EvaluationItem'] = $EvaluationItem;

        $counter['AcademyLevel'] = AcademyLevel::all()->count();
        $counter['AcademyType'] = AcademyType::all()->count();

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

            case 'publication_categories';
            {
                dd($request->all());
                $this->TableRows = PublicationCategory::create($request->all());
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
            case 'staff_categories':
            {
                $this->TableRows =StaffCategory::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'qec_types':
            {
                $this->TableRows =QecType::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'faculty_qualifications':
            {
                $this->TableRows =FacultyQualification::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'funding_sources':
            {
                $this->TableRows =FundingSources::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'activity_engagements':
            {
                $this->TableRows =ActivityEngagement::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'teaching_methods':
            {
                $this->TableRows =TeachingMethod::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'evaluation_items':
            {
                $this->TableRows =EvaluationItem::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'academy_levels':
            {
                $this->TableRows = AcademyLevel::create($request->all());
                return response()->json(['success' => 'Record inserted successfully.']);
                break;
            }
            case 'academy_types':
            {
                $this->TableRows = AcademyType::create($request->all());
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

            case 'publication_categories';
            {
                $this->TableRows = PublicationCategory::find($id)->update($request->all());
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
            case 'staff_categories':
            {
                $this->TableRows = StaffCategory::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'qec_types':
            {
                $this->TableRows = QecType::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'faculty_qualifications':
            {
                $this->TableRows = FacultyQualification::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'funding_sources':
            {
                $this->TableRows = FundingSources::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'activity_engagements':
            {
                $this->TableRows = ActivityEngagement::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'teaching_methods':
            {
                $this->TableRows =TeachingMethod::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'evaluation_items':
            {
                $this->TableRows = EvaluationItem::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'academy_levels':
            {
                $this->TableRows = AcademyLevel::find($id)->update($request->all());
                return response()->json(['success' => 'Record updated successfully.']);
                break;
            }
            case 'academy_types':
            {
                $this->TableRows = AcademyType::find($id)->update($request->all());
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
            case 'publication_categories';
            {
                $this->TableRows  = PublicationCategory::find($request->id)->delete();
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
            case 'staff_categories':
            {
                $this->TableRows  = StaffCategory::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'qec_types':
            {
                $this->TableRows  = QecType::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'faculty_qualifications':
            {
                $this->TableRows  = FacultyQualification::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'funding_sources':
            {
                $this->TableRows  = FundingSources::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'activity_engagements':
            {
                $this->TableRows  = ActivityEngagement::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
             case 'teaching_methods':
            {
                $this->TableRows  =TeachingMethod::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
             case 'evaluation_items':
            {
                $this->TableRows  = EvaluationItem::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'academy_levels':
            {
                $this->TableRows  = AcademyLevel::find($request->id)->delete();
                return response()->json(['success' => 'Record deleted successfully.']);
                break;
            }
            case 'academy_types':
            {
                $this->TableRows  = AcademyType::find($request->id)->delete();
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
