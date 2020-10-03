<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Common\EligibilityStatus;
use App\Models\Common\Slip;
use App\Models\SARDeskReview;
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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\EligibilityScreeningEmail;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use DB;
use App\Mail\ActivationMail;

class registrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registrations = DB::table('slips as s')
            ->join('campuses as c', 'c.id', '=', 's.business_school_id')
            ->join('departments as d', 'd.id', '=', 's.department_id')
            ->join('business_schools as bs', 'bs.id', '=', 'c.business_school_id')
            ->join('users as u', 'u.id', '=', 's.created_by')
            ->select('s.*', 'c.location as campus', 'd.name as department', 'u.name as user', 'u.email', 'u.contact_no', 'bs.name as school', 'bs.id as schoolId','c.id as campusId')
//            ->where('s.reg')
            ->get();
            return view('admin.registration', compact('registrations'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
