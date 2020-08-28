@php
use \Illuminate\Support\Facades\Auth;
$invoices = checkIsCompleted('App\Models\Common\Slip', ['business_school_id' => Auth::user()->campus_id, 'status'=>'paid' ]);
$basic_info = checkIsCompleted('App\BusinessSchool', ['id' => Auth::user()->business_school_id, 'status'=>'active','isCompleted'=>'yes' ]);
$scope = checkIsCompleted('App\Models\StrategicManagement\Scope', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes' ]);
$contact = checkIsCompleted('App\Models\StrategicManagement\ContactInfo', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$committee = checkIsCompleted('App\Models\StrategicManagement\StatutoryCommittee', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$affiliation = checkIsCompleted('App\Models\StrategicManagement\Affiliation', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$budget = checkIsCompleted('App\Models\StrategicManagement\BudgetaryInfo', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$mission = checkIsCompleted('App\Models\StrategicManagement\MissionVision', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$plan = checkIsCompleted('App\Models\StrategicManagement\StrategicPlan', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$parent = checkIsCompleted('App\Models\StrategicManagement\ParentInstitution', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$portfolio = checkIsCompleted('App\Models\StrategicManagement\ProgramPortfolio', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$entry = checkIsCompleted('App\Models\StrategicManagement\EntryRequirement', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$application = checkIsCompleted('App\Models\StrategicManagement\ApplicationReceived', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$enrolment = checkIsCompleted('App\Models\StrategicManagement\StudentEnrolment', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$graduated = checkIsCompleted('App\StudentsGraduated', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$gender = checkIsCompleted('App\StudentGender', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$bsf = checkIsCompleted('App\Models\Faculty\FacultySummary', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$workload = checkIsCompleted('App\Models\Faculty\WorkLoad', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isCompleted'=>'yes']);
$visiting = checkIsCompleted('App\Models\Faculty\FacultyTeachingCources', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active' , 'isCompleted'=>'yes']);
$ratio = checkIsCompleted('App\Models\Faculty\FacultyStudentRatio', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active' , 'isCompleted'=>'yes']);
$stability = checkIsCompleted('App\Models\Faculty\FacultyStability', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active', 'isCompleted'=>'yes']);
$facultygender = checkIsCompleted('App\Models\Faculty\FacultyGender', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isCompleted'=>'yes']);
$research = checkIsCompleted('App\Models\Research\ResearchSummary', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$financialinfo = checkIsCompleted('App\Models\Facility\FinancialInfo', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$bsfacility = checkIsCompleted('App\Models\Facility\BusinessSchoolFacility', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$linkages = checkIsCompleted('App\Models\External_Linkages\Linkages', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$bodymeeting = checkIsCompleted('App\Models\External_Linkages\BodyMeeting', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$sexchange = checkIsCompleted('App\Models\External_Linkages\StudentExchange', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$fexchange = checkIsCompleted('App\Models\External_Linkages\FacultyExchange', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$obtained = checkIsCompleted('App\Models\External_Linkages\ObtainedInternship', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$placement = checkIsCompleted('App\Models\External_Linkages\PlacementActivity', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$admission_office = checkIsCompleted('App\AdmissionOffice', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$credit_transfer = checkIsCompleted('App\CreditTransfer', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$student_transfer = checkIsCompleted('App\StudentTransfer', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$documentary_evidence = checkIsCompleted('App\DocumentaryEvidence', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$conference = checkIsCompleted('App\Model\Research\Conference', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$faculty_development = checkIsCompleted('App\Models\Reasearch\FacultyDevelopment', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$curriculum_role= checkIsCompleted('App\Models\Research\CurriculumRole', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$output = checkIsCompleted('App\Models\Research\ResearchOutput', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$oric = checkIsCompleted('App\Models\Research\Oric', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$research_center = checkIsCompleted('App\Models\Research\ResearchCenter', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$research_agenda = checkIsCompleted('App\Models\Research\ResearchAgenda', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$research_funding = checkIsCompleted('App\Models\Research\ResearchFunding', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$research_project = checkIsCompleted('App\Models\Research\ResearchProject', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$intake = checkIsCompleted('App\StudentIntake', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$size = checkIsCompleted('App\ClassSize', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$dropout = checkIsCompleted('App\DropoutPercentage', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$financial_assistance = checkIsCompleted('App\FinancialAssistance', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$student_financial = checkIsCompleted('App\StudentFinancial', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$weak = checkIsCompleted('App\WeakStudent', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$grooming = checkIsCompleted('App\PersonalGrooming', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$counselling = checkIsCompleted('App\CounsellingActivity', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$student_participation = checkIsCompleted('App\StudentParticipation', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$extra = checkIsCompleted('App\ExtraActivities', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$membership = checkIsCompleted('App\AlumniMembership', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$alumni = checkIsCompleted('App\AlumniParticipation', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$financialrisk = checkIsCompleted('App\Models\Facility\FinancialRisk', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$support_staff = checkIsCompleted('App\Models\Facility\SupportStaff', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$qecinfo = checkIsCompleted('App\Models\Facility\QecInfo', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$club = checkIsCompleted('App\Models\social_responsibility\StudentClub', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$detail = checkIsCompleted('App\Models\social_responsibility\ProjectDetail', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$env = checkIsCompleted('App\Models\social_responsibility\EnvProtection', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$formal = checkIsCompleted('App\Models\social_responsibility\FormalRelationship', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$complaint = checkIsCompleted('App\Models\social_responsibility\ComplaintResolution', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$internal = checkIsCompleted('App\Models\social_responsibility\InternalCommunity', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$social = checkIsCompleted('App\Models\social_responsibility\SocialActivity', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$program_delivery = checkIsCompleted('App\Models\Carriculum\ProgramDelivery', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$question_paper = checkIsCompleted('App\Models\Carriculum\QuestionPaper', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$aligned_program = checkIsCompleted('App\Models\Carriculum\AlignedProgram', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$course_detail = checkIsCompleted('App\Models\Carriculum\CourseDetail', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$course_outline = checkIsCompleted('App\Models\Carriculum\CourseOutline', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$plagiarism_case = checkIsCompleted('App\Models\Carriculum\PlagiarismCase', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$cultural_material = checkIsCompleted('App\Models\Carriculum\CulturalMaterial', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$managerial_skill = checkIsCompleted('App\Models\Carriculum\ManagerialSkill', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$program_delivery_method = checkIsCompleted('App\Models\Carriculum\ProgramDeliveryMethod', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$evaluation_method = checkIsCompleted('App\Models\Carriculum\EvaluationMethod', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$curriculum_review = checkIsCompleted('App\Models\Carriculum\CurriculumReview', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$program_objective = checkIsCompleted('App\Models\Carriculum\ProgramObjective', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$learning_outcome = checkIsCompleted('App\Models\Carriculum\LearningOutcome', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$faculty_membership = checkIsCompleted('App\Models\Faculty\FacultyMembership', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$faculty_exposure = checkIsCompleted('App\Models\Faculty\FacultyExposure', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$international_faculty = checkIsCompleted('App\Models\Faculty\InternationalFaculty', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$faculty_participation = checkIsCompleted('App\Models\Faculty\FacultyParticipation', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$consultancy_project = checkIsCompleted('App\Models\Faculty\FacultyConsultancyProject', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$faculty_promotion = checkIsCompleted('App\Models\Faculty\FacultyPromotion', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$faculty_develop = checkIsCompleted('App\Models\Faculty\FacultyDevelop', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$faculty_workshop = checkIsCompleted('App\Models\Faculty\FacultyWorkshop', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$faculty_detail= checkIsCompleted('App\Models\Faculty\FacultyDetailedInfo', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$isActiveSAR = getFirst('App\Models\Common\Slip' ,['regStatus'=>'SAR','business_school_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id]);

@endphp

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('dist/img/user8-128x128.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <ul class="sidebar-menu" data-widget="tree">
        <li class=" treeview">
          <a href="#">
               <li class="{{ (request()->is('home')) ? 'active' : '' }}"><a href="/home"><i class="fa fa-dashboard text-green"></i>Dashboard</a></li>
          </a>
        <!--   <ul class="treeview-menu">
            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul> -->
        </li>

      </ul>
      <ul class="sidebar-menu" data-widget="tree">
          @hasrole('NBEACAdmin')
          <li class=" treeview
          {{ (request()->is('users')) ? 'active' : '' }}
          {{ (request()->is('rolesPermission')) ? 'active' : '' }}
          {{ (request()->is('roles')) ? 'active' : '' }}
          {{ (request()->is('permission')) ? 'active' : '' }}

          ">
          <a href="#">
            <i class="fa fa-user text-blue" ></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (request()->is('users')) ? 'active' : '' }}"><a href="{{url('users')}}"><i class="fa fa-circle-o text-blue"></i>Users</a></li>
            <li  class="{{ (request()->is('roles')) ? 'active' : '' }}"><a href="{{url('roles')}}"><i class="fa fa-circle-o text-blue"></i>Roles</a></li>
{{--            <li  class="{{ (request()->is('')) ? 'active' : '' }}"><a href="#"><i class="fa fa-circle-o text-blue"></i>Roles</a></li>--}}
            <li  class="{{ (request()->is('permissions')) ? 'active' : '' }}"><a href="{{url('permissions')}}"><i class="fa fa-circle-o text-blue"></i>Permissions</a></li>

          </ul>
            </li>
          @endhasrole

          @hasrole('BusinessSchool')
          <li class="{{ (request()->is('strategic/invoices')) ? 'active' : '' }} ">
              <a href="{{url('strategic/invoices')}}">
                  <i class="fa fa-file-text-o" style="color: #D81B60"></i>Invoices
                  <span class="pull-right-container">
                        <span class="text text-{{$invoices==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$invoices==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                  </span>
              </a>
          </li>
          @endhasrole
{{--          <li class="treeview {{(request()->is('strategic/invoices'))?'active':''}}{{(request()->is('strategic/generate-invoices'))?'active':''}} ">--}}
{{--              <a href="#">--}}
{{--                  <i class="fa fa-money " style="color: #D81B60"></i> <span>Invoices</span>--}}
{{--                  <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>--}}
{{--              </a>--}}

{{--              --}}
{{--              <ul class="treeview-menu">--}}
{{--                  <li class="{{ (request()->is('strategic/invoices')) ? 'active' : '' }} ">--}}
{{--                      <a href="{{url('strategic/generate-invoices')}}">--}}
{{--                          <i class="fa fa-circle-o" style="color: #D81B60"></i> Generate Invoices--}}
{{--                          <span class="pull-right-container">--}}
{{--                        <span class="label label-danger pull-right">In</span>--}}
{{--                        </span>--}}
{{--                      </a>--}}
{{--                  </li>--}}


{{--              </ul>--}}

          @hasrole('BusinessSchool')
          <li class=" treeview {{(request()->is('strategic/basicinfo'))?'active':''}} {{(request()->is('strategic/statutory-committees'))?'active':''}} {{(request()->is('strategic/scope'))?'active':''}}{{(request()->is('strategic/contact-info'))?'active':''}}{{(request()->is('strategic/affiliations'))?'active':''}}{{(request()->is('strategic/mission-vision'))?'active':''}}{{(request()->is('strategic/budgetary-info'))?'active':''}}{{(request()->is('strategic/strategic-plan'))?'active':''}}{{(request()->is('strategic/sources-funding'))?'active':''}}{{(request()->is('strategic/audit-report'))?'active':''}}{{(request()->is('strategic/parent-institution'))?'active':''}}">
          <a href="#" >
            <i class="fa fa-users " style="color: #D81B60"></i><span>1: Strategic Management</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
{{--             @if($invoices)--}}
                <ul class="treeview-menu">
            <li class="{{ (request()->is('strategic/basicinfo')) ? 'active' : '' }} ">
                <a href="{{url('strategic/basicinfo')}}">
                   1.1 Basic information of </br> <span style="margin-left: 20px;">business school</span>
                    <span class="pull-right-container">
                        <span class="text text-{{$basic_info==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$basic_info==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span>
                </a>
            </li>
            <li  class="{{ (request()->is('strategic/scope')) ? 'active' : '' }}">
                <a href="{{url('strategic/scope')}}">
                    1.2 Scope Of Accreditation
                    <span class="pull-right-container">
                        <span class="text text-{{$scope==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$scope==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span>
                </a>
            </li>
            <li  class="{{ (request()->is('strategic/contact-info')) ? 'active' : '' }}"><a href="{{url('strategic/contact-info')}}">1.3 Contact Information<span class="pull-right-container">
                        <span class="text text-{{$contact==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$contact==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('strategic/statutory-committees')) ? 'active' : '' }}"><a href="{{url('/strategic/statutory-committees')}}">1.4 Statutory committees<span class="pull-right-container">
                        <span class="text text-{{$committee==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$committee==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('strategic/affiliations')) ? 'active' : '' }}"><a href="{{url('strategic/affiliations')}}">1.5 Affiliations of AC<span class="pull-right-container">
                        <span class="text text-{{$affiliation==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$affiliation==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('strategic/budgetary-info')) ? 'active' : '' }}"><a href="{{url('strategic/budgetary-info')}}">1.6 Budgetary Information<span class="pull-right-container">
                        <span class="text text-{{$budget==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$budget==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('strategic/mission-vision')) ? 'active' : '' }}"><a href="{{url('strategic/mission-vision')}}">1.7 Mission Vision<span class="pull-right-container">
                        <span class="text text-{{$mission==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$mission==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('strategic/strategic-plan')) ? 'active' : '' }}"><a href="{{url('strategic/strategic-plan')}}">1.8 Approv of Strategic Plan<span class="pull-right-container">
                        <span class="text text-{{$plan==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$plan==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
             <li  class="{{ (request()->is('strategic/parent-institution')) ? 'active' : '' }}"><a href="{{url('strategic/parent-institution')}}">1.9 Organograms<span class="pull-right-container">
                        <span class="text text-{{$parent==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$parent==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>

            <!-- Below are the Tables For SAR  -->
                    @if($isActiveSAR)
             <li  class="{{ (request()->is('strategic/sources-funding')) ? 'active' : '' }}"><a href="{{url('strategic/sources-funding')}}"><i class="fa fa-circle-o" style="color: #D81B60" ></i>Sources of Funding</a></li>
            <li  class="{{ (request()->is('strategic/audit-report')) ? 'active' : '' }}"><a href="{{url('strategic/audit-report')}}"><i class="fa fa-circle-o" style="color: #D81B60" ></i>Audit Report</a></li>
                    @endif
                </ul>
{{--              @endif--}}
          </li>
        @endhasrole
        @hasrole('BusinessSchool')
        <li class=" treeview {{(request()->is('program-portfolio'))?'active':''}}{{(request()->is('entry-requirements'))?'active':''}}{{(request()->is('application-received'))?'active':''}}{{(request()->is('program-delivery'))?'active':''}}{{(request()->is('question-paper'))?'active':''}}{{(request()->is('aligned-program'))?'active':''}}{{(request()->is('course-detail'))?'active':''}}{{(request()->is('course-outline'))?'active':''}}{{(request()->is('plagiarism-case'))?'active':''}}{{(request()->is('cultural-material'))?'active':''}}{{(request()->is('program-delivery-method'))?'active':''}}{{(request()->is('evaluation-method'))?'active':''}}{{(request()->is('curriculum-review'))?'active':''}}{{(request()->is('program-objective'))?'active':''}}{{(request()->is('learning-outcome'))?'active':''}}" >
          <a href="#">
            <i class="fa fa-file text-orange"></i><span>2: Curriculum</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (request()->is('program-portfolio')) ? 'active' : '' }}"><a href="{{url('program-portfolio')}}">2.1 Programs Portfolio<span class="pull-right-container">
                        <span class="text text-{{$portfolio==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$portfolio==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>

            <li  class="{{ (request()->is('entry-requirements')) ? 'active' : '' }}"><a href="{{url('entry-requirements')}}">2.2 Entry Requirements<span class="pull-right-container">
                        <span class="text text-{{$entry==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$entry==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('application-received')) ? 'active' : '' }}"><a href="{{url('application-received')}}">2.3 Applications Received<span class="pull-right-container">
                        <span class="text text-{{$application==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$application==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
              @if($isActiveSAR)
                    <li  class="{{ (request()->is('curriculum-review')) ? 'active' : '' }}"><a href="{{url('curriculum-review')}}">2.3 Curriculum Review<span class="pull-right-container">
                        <span class="text text-{{$curriculum_review==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$curriculum_review==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('program-objective')) ? 'active' : '' }}"><a href="{{url('program-objective')}}">2.4 Program Objective<span class="pull-right-container">
                        <span class="text text-{{$program_objective==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$program_objective==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('learning-outcome')) ? 'active' : '' }}"><a href="{{url('learning-outcome')}}">2.5 Learning Outcome<span class="pull-right-container">
                        <span class="text text-{{$learning_outcome==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$learning_outcome==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('aligned-program')) ? 'active' : '' }}"><a href="{{url('aligned-program')}}">2.7 Aligned Programs<span class="pull-right-container">
                        <span class="text text-{{$aligned_program==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$aligned_program==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('course-outline')) ? 'active' : '' }}"><a href="{{url('course-outline')}}">2.8 Course Outline<span class="pull-right-container">
                        <span class="text text-{{$course_outline==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$course_outline==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('course-detail')) ? 'active' : '' }}"><a href="{{url('course-detail')}}">2.9 Course Detail<span class="pull-right-container">
                        <span class="text text-{{$course_detail==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$course_detail==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('cultural-material')) ? 'active' : '' }}"><a href="{{url('cultural-material')}}">2.10 Cultural Material<span class="pull-right-container">
                        <span class="text text-{{$cultural_material==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$cultural_material==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('managerial-skill')) ? 'active' : '' }}"><a href="{{url('managerial-skill')}}">2.12 Managerial Skill<span class="pull-right-container">
                        <span class="text text-{{$managerial_skill==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$managerial_skill==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('program-delivery-method')) ? 'active' : '' }}"><a href="{{url('program-delivery-method')}}">2.13 Program Delivery Method<span class="pull-right-container">
                        <span class="text text-{{$program_delivery_method==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$program_delivery_method==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('evaluation-method')) ? 'active' : '' }}"><a href="{{url('evaluation-method')}}">2.14 Evaluation Method<span class="pull-right-container">
                        <span class="text text-{{$evaluation_method==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$evaluation_method==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('program-delivery')) ? 'active' : '' }}"><a href="{{url('program-delivery')}}">2.15 Program Delivery<span class="pull-right-container">
                        <span class="text text-{{$program_delivery==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$program_delivery==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('question-paper')) ? 'active' : '' }}"><a href="{{url('question-paper')}}">2.16 Question Paper<span class="pull-right-container">
                        <span class="text text-{{$question_paper==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$question_paper==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('plagiarism-case')) ? 'active' : '' }}"><a href="{{url('plagiarism-case')}}">2.17 Plagiarism Cases<span class="pull-right-container">
                        <span class="text text-{{$plagiarism_case==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$plagiarism_case==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
              @endif

          </ul>
        </li>
          @endhasrole
          @hasrole('BusinessSchool')
        <li class=" treeview {{(request()->is('student-enrolment'))?'active':''}}{{(request()->is('students-graduated'))?'active':''}}{{(request()->is('student-gender'))?'active':''}}{{(request()->is('student-intake'))?'active':''}}{{(request()->is('alumni-participation'))?'active':''}}{{(request()->is('class-size'))?'active':''}}{{(request()->is('alumni-membership'))?'active':''}}{{(request()->is('personal-grooming'))?'active':''}}{{(request()->is('counselling-activity'))?'active':''}}{{(request()->is('extra-activity'))?'active':''}}{{(request()->is('dropout-percentage'))?'active':''}}{{(request()->is('weak-student'))?'active':''}}{{(request()->is('student-participation'))?'active':''}}{{(request()->is('financial-assistance'))?'active':''}}{{(request()->is('student-financial'))?'active':''}}">
              <a href="#">
                  <i class="fa fa-user text-blue"></i><span>3: Students</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
          <ul class="treeview-menu">
            <li  class="{{ (request()->is('student-enrolment')) ? 'active' : '' }}"><a href="{{url('student-enrolment')}}">3.1 Students Enrollment<span class="pull-right-container">
                        <span class="text text-{{$enrolment==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$enrolment==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('students-graduated')) ? 'active' : '' }}"><a href="{{url('students-graduated')}}">3.2 Students Graduated<span class="pull-right-container">
                        <span class="text text-{{$graduated==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$graduated==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('student-gender')) ? 'active' : '' }}"><a href="{{url('student-gender')}}">3.3 Students Gender mix<span class="pull-right-container">
                        <span class="text text-{{$gender==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$gender==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>

            <!-- Below are the Tables For SAR  -->
              @if($isActiveSAR)
            <li  class="{{ (request()->is('student-intake')) ? 'active' : '' }}"><a href="{{url('student-intake')}}">3.2 Students Intakes<span class="pull-right-container">
                        <span class="text text-{{$intake==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$intake==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
           <li  class="{{ (request()->is('class-size')) ? 'active' : '' }}"><a href="{{url('class-size')}}">3.3 Class Size<span class="pull-right-container">
                        <span class="text text-{{$size==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$size==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
           <li  class="{{ (request()->is('dropout-percentage')) ? 'active' : '' }}"><a href="{{url('dropout-percentage')}}">3.4 Dropout Percentage<span class="pull-right-container">
                        <span class="text text-{{$dropout==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$dropout==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
           <li  class="{{ (request()->is('financial-assistance')) ? 'active' : '' }}"><a href="{{url('financial-assistance')}}">3.5 Financial Assistance<span class="pull-right-container">
                        <span class="text text-{{$financial_assistance==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$financial_assistance==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
           <li  class="{{ (request()->is('student-financial')) ? 'active' : '' }}"><a href="{{url('student-financial')}}">3.6 Student Financial<span class="pull-right-container">
                        <span class="text text-{{$student_financial==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$student_financial==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
           <li  class="{{ (request()->is('weak-student')) ? 'active' : '' }}"><a href="{{url('weak-student')}}">3.7 Weak Students<span class="pull-right-container">
                        <span class="text text-{{$weak==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$weak==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
           <li  class="{{ (request()->is('personal-grooming')) ? 'active' : '' }}"><a href="{{url('personal-grooming')}}">3.8 Personal Grooming<span class="pull-right-container">
                        <span class="text text-{{$grooming==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$grooming==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('counselling-activity')) ? 'active' : '' }}"><a href="{{url('counselling-activity')}}">3.9 Counselling Activities<span class="pull-right-container">
                        <span class="text text-{{$counselling==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$counselling==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('student-participation')) ? 'active' : '' }}"><a href="{{url('student-participation')}}">3.10 Student Participation<span class="pull-right-container">
                        <span class="text text-{{$student_participation==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$student_participation==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('extra-activity')) ? 'active' : '' }}"><a href="{{url('extra-activity')}}">3.11 Extra Activities<span class="pull-right-container">
                        <span class="text text-{{$extra==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$extra==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
           <li  class="{{ (request()->is('alumni-membership')) ? 'active' : '' }}"><a href="{{url('alumni-membership')}}">3.12 Alumni Membership<span class="pull-right-container">
                        <span class="text text-{{$membership==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$membership==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('alumni-participation')) ? 'active' : '' }}"><a href="{{url('alumni-participation')}}">3.13 Alumni Participation<span class="pull-right-container">
                        <span class="text text-{{$alumni==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$alumni==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
              @endif

          </ul>
        </li>
          @endhasrole
          @hasrole('BusinessSchool')
        <li class=" treeview {{(request()->is('work-load'))?'active':''}}{{(request()->is('faculty-summary'))?'active':''}}{{(request()->is('faculty-stability'))?'active':''}}{{(request()->is('faculty-gender'))?'active':''}}{{(request()->is('faculty-teaching'))?'active':''}}{{(request()->is('faculty-student-ratio'))?'active':''}}{{(request()->is('faculty-membership'))?'active':''}}{{(request()->is('faculty-exposure'))?'active':''}}{{(request()->is('international-faculty'))?'active':''}}{{(request()->is('faculty-participation'))?'active':''}}{{(request()->is('consultancy-project'))?'active':''}}{{(request()->is('faculty-promotion'))?'active':''}}{{(request()->is('faculty-develop'))?'active':''}}{{(request()->is('faculty-workshop'))?'active':''}}{{(request()->is('faculty-detailed-info'))?'active':''}}">
              <a href="#">
                  <i class="fa fa-user-plus text-green"></i><span>4: Faculty</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
          <ul class="treeview-menu">
            <li class="{{ (request()->is('faculty-summary')) ? 'active' : '' }}"><a href="{{url('faculty-summary')}}">4.1 Summary BSF<span class="pull-right-container">
                        <span class="text text-{{$bsf==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$bsf==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                     <li class="{{ (request()->is('faculty-detailed-info')) ? 'active' : '' }}"><a href="{{url('faculty-detailed-info')}}">4.1b Faculty Detailed Info<span class="pull-right-container">
                        <span class="text text-{{$faculty_detail==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$faculty_detail==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('work-load')) ? 'active' : '' }}"><a href="{{url('work-load')}}">4.2 Faculty Work Load T<span class="pull-right-container">
                        <span class="text text-{{$workload==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$workload==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('faculty-teaching')) ? 'active' : '' }}"><a href="{{url('faculty-teaching')}}">4.3 Visiting Faculty<span class="pull-right-container">
                        <span class="text text-{{$visiting==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$visiting==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
             <li  class="{{ (request()->is('faculty-student-ratio')) ? 'active' : '' }}"><a href="{{url('faculty-student-ratio')}}">4.4 Student Teacher Ratio<span class="pull-right-container">
                        <span class="text text-{{$ratio==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$ratio==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
             <li  class="{{ (request()->is('faculty-stability')) ? 'active' : '' }}"><a href="{{url('faculty-stability')}}">4.5 Faculty Stability<span class="pull-right-container">
                        <span class="text text-{{$stability==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$stability==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('faculty-gender')) ? 'active' : '' }}"><a href="{{url('faculty-gender')}}">4.6 Faculty Gender Mix<span class="pull-right-container">
                        <span class="text text-{{$facultygender==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$facultygender==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>

{{--              SAR Menu--}}
              @if($isActiveSAR)
                    <li  class="{{ (request()->is('faculty-promotion')) ? 'active' : '' }}"><a href="{{url('faculty-promotion')}}">4.7 Faculty Promotion<span class="pull-right-container">
                        <span class="text text-{{$faculty_promotion==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$faculty_promotion==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('faculty-workshop')) ? 'active' : '' }}"><a href="{{url('faculty-workshop')}}">4.8 Faculty Workshop<span class="pull-right-container">
                        <span class="text text-{{$faculty_workshop==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$faculty_workshop==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('faculty-develop')) ? 'active' : '' }}"><a href="{{url('faculty-develop')}}">4.9 Faculty Develop<span class="pull-right-container">
                        <span class="text text-{{$faculty_develop==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$faculty_develop==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('consultancy-project')) ? 'active' : '' }}"><a href="{{url('consultancy-project')}}">4.10 Consultancy Project<span class="pull-right-container">
                        <span class="text text-{{$consultancy_project==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$consultancy_project==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('faculty-participation')) ? 'active' : '' }}"><a href="{{url('faculty-participation')}}">4.11 Faculty Participation<span class="pull-right-container">
                        <span class="text text-{{$faculty_participation==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$faculty_participation==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('faculty-membership')) ? 'active' : '' }}"><a href="{{url('faculty-membership')}}">4.12 Faculty Membership<span class="pull-right-container">
                        <span class="text text-{{$faculty_membership==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$faculty_membership==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                     <li  class="{{ (request()->is('international-faculty')) ? 'active' : '' }}"><a href="{{url('international-faculty')}}">4.13 International Faculty<span class="pull-right-container">
                        <span class="text text-{{$international_faculty==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$international_faculty==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('faculty-exposure')) ? 'active' : '' }}"><a href="{{url('faculty-exposure')}}">4.14 Faculty Exposure<span class="pull-right-container">
                        <span class="text text-{{$faculty_exposure==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$faculty_exposure==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
              @endif
          </ul>
        </li>
          @endhasrole
          @hasrole('BusinessSchool')
           <li class=" treeview {{(request()->is('research-summary'))?'active':''}}{{(request()->is('conference'))?'active':''}}{{(request()->is('curriculum-role'))?'active':''}}{{(request()->is('faculty-development'))?'active':''}}{{(request()->is('research-output'))?'active':''}}{{(request()->is('oric'))?'active':''}}{{(request()->is('research-center'))?'active':''}}{{(request()->is('research-agenda'))?'active':''}}{{(request()->is('research-funding'))?'active':''}}{{(request()->is('research-project'))?'active':''}} ">
          <a href="#">
            <i class="fa fa-users " style="color: #D81B60"></i><span>5: Research Development</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li  class="{{ (request()->is('research-summary')) ? 'active' : '' }}"><a href="{{url('research-summary')}}">5.1 Research Summary<span class="pull-right-container">
                        <span class="text text-{{$research==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$research==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>

                    <li  class="{{ (request()->is('oric')) ? 'active' : '' }}"><a href="{{url('oric')}}">5.1 Oric<span class="pull-right-container">
                        <span class="text text-{{$oric==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$oric==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
              {{--SAR Menu--}}
              @if($isActiveSAR)
                    <li  class="{{ (request()->is('research-center')) ? 'active' : '' }}"><a href="{{url('research-center')}}">5.2 Research Center<span class="pull-right-container">
                        <span class="text text-{{$research_center==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$research_center==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('research-agenda')) ? 'active' : '' }}"><a href="{{url('research-agenda')}}">5.3 Research Agenda<span class="pull-right-container">
                        <span class="text text-{{$research_agenda==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$research_agenda==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('research-funding')) ? 'active' : '' }}"><a href="{{url('research-funding')}}">5.4 Research Funding<span class="pull-right-container">
                        <span class="text text-{{$research_funding==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$research_funding==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('research-project')) ? 'active' : '' }}"><a href="{{url('research-project')}}">5.5 Research Projects<span class="pull-right-container">
                        <span class="text text-{{$research_project==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$research_project==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('research-summary')) ? 'active' : '' }}"><a href="{{url('research-summary')}}">5.6 Research Summary<span class="pull-right-container">
                        <span class="text text-{{$research==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$research==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('research-output')) ? 'active' : '' }}"><a href="{{url('research-output')}}">5.7 Research output<span class="pull-right-container">
                        <span class="text text-{{$output==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$output==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('curriculum-role')) ? 'active' : '' }}"><a href="{{url('curriculum-role')}}">5.8 Curriculum Role<span class="pull-right-container">
                        <span class="text text-{{$curriculum_role==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$curriculum_role==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('faculty-development')) ? 'active' : '' }}"><a href="{{url('faculty-development')}}">5.9 Faculty Development<span class="pull-right-container">
                        <span class="text text-{{$faculty_development==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$faculty_development==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                    <li  class="{{ (request()->is('conference')) ? 'active' : '' }}"><a href="{{url('conference')}}">5.10 Conferences<span class="pull-right-container">
                        <span class="text text-{{$conference==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$conference==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
              @endif

          </ul>
        </li>
          @endhasrole
          @hasrole('BusinessSchool')
          <li class=" treeview {{(request()->is('financial-info'))?'active':''}}{{(request()->is('financial-risk'))?'active':''}}{{(request()->is('qec-info'))?'active':''}}{{(request()->is('business-school-facility'))?'active':''}}{{(request()->is('support-staff'))?'active':''}} ">
          <a href="#">
            <i class="fa fa-users text-orange" ></i><span>6: Facilities Information</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li  class="{{ (request()->is('financial-info')) ? 'active' : '' }}"><a href="{{url('financial-info')}}">6.1 Financial Info<span class="pull-right-container">
                        <span class="text text-{{$financialinfo==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$financialinfo==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
             <li  class="{{ (request()->is('business-school-facility')) ? 'active' : '' }}"><a href="{{url('business-school-facility')}}">6.2 Business School Facility<span class="pull-right-container">
                        <span class="text text-{{$bsfacility==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$bsfacility==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a>
             </li>
              @if($isActiveSAR)
            <li  class="{{ (request()->is('financial-risk')) ? 'active' : '' }}"><a href="{{url('financial-risk')}}">7.2 Financial Risk<span class="pull-right-container">
                        <span class="text text-{{$financialrisk==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$financialrisk==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('support-staff')) ? 'active' : '' }}"><a href="{{url('support-staff')}}">7.3 Support Staff<span class="pull-right-container">
                        <span class="text text-{{$support_staff==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$support_staff==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('qec-info')) ? 'active' : '' }}"><a href="{{url('qec-info')}}">7.4 Qec Info<span class="pull-right-container">
                        <span class="text text-{{$qecinfo==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$qecinfo==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a>
            </li>
              @endif

          </ul>
        </li>
          @endhasrole

          <!-- Below is the module included in SAR -->
          @if($isActiveSAR)
          @hasrole('BusinessSchool')
        <li class=" treeview {{(request()->is('student-club'))?'active':''}}{{(request()->is('project-detail'))?'active':''}}{{(request()->is('env-protection'))?'active':''}}{{(request()->is('formal-relationship'))?'active':''}}{{(request()->is('complaint-resolution'))?'active':''}}{{(request()->is('internal-community'))?'active':''}}{{(request()->is('social-activity'))?'active':''}}">
          <a href="#">
            <i class="fa fa-globe text-blue " ></i><span>6. Social Responsibility</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li  class="{{ (request()->is('student-club')) ? 'active' : '' }}"><a href="{{url('student-club')}}">6.1. Student clubs/societies<span class="pull-right-container">
                        <span class="text text-{{$club==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$club==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('project-detail')) ? 'active' : '' }}"><a href="{{url('project-detail')}}">6.2. Project Details<span class="pull-right-container">
                        <span class="text text-{{$detail==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$detail==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('env-protection')) ? 'active' : '' }}"><a href="{{url('env-protection')}}">6.3. Env Protection Activities<span class="pull-right-container">
                        <span class="text text-{{$env==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$env==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('formal-relationship')) ? 'active' : '' }}"><a href="{{url('formal-relationship')}}">6.4. Formal Relationships<span class="pull-right-container">
                        <span class="text text-{{$formal==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$formal==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('complaint-resolution')) ? 'active' : '' }}"><a href="{{url('complaint-resolution')}}">6.5. Complaint Resolution<span class="pull-right-container">
                        <span class="text text-{{$complaint==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$complaint==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('internal-community')) ? 'active' : '' }}"><a href="{{url('internal-community')}}">6.6. Internal Community WP<span class="pull-right-container">
                        <span class="text text-{{$internal==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$internal==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('social-activity')) ? 'active' : '' }}"><a href="{{url('social-activity')}}">6.7. Social Activity<span class="pull-right-container">
                        <span class="text text-{{$social==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$social==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
          </ul>
        </li>
          @endhasrole
          @hasrole('BusinessSchool')
        <li class=" treeview {{(request()->is('placement-office'))?'active':''}}{{(request()->is('linkages'))?'active':''}}{{(request()->is('body-meeting'))?'active':''}}{{(request()->is('student-exchange'))?'active':''}}{{(request()->is('faculty-exchange'))?'active':''}}{{(request()->is('obtained-internship'))?'active':''}}{{(request()->is('placement-activity'))?'active':''}}">
          <a href="#">
            <i class="fa fa-globe text-green " ></i><span>8: External Linkages</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li  class="{{ (request()->is('placement-office')) ? 'active' : '' }}">
                <a href="{{url('placement-office')}}">8.1 Placement Office<span class="pull-right-container">
                        <span class="text text-{{$portfolio==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$portfolio==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span>
                </a>
            </li>
            <li  class="{{ (request()->is('linkages')) ? 'active' : '' }}"><a href="{{url('linkages')}}">8.2 Linkages<span class="pull-right-container">
                        <span class="text text-{{$linkages==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$linkages==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('body-meeting')) ? 'active' : '' }}"><a href="{{url('body-meeting')}}">8.3 Statutory Body Meeting<span class="pull-right-container">
                        <span class="text text-{{$bodymeeting==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$bodymeeting==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span>
                </a>
            </li>

             <li  class="{{ (request()->is('student-exchange')) ? 'active' : '' }}"><a href="{{url('student-exchange')}}">8.4a Student Exchange<span class="pull-right-container">
                        <span class="text text-{{$sexchange==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$sexchange==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
              <li  class="{{ (request()->is('faculty-exchange')) ? 'active' : '' }}"><a href="{{url('faculty-exchange')}}">8.4b Faculty Exchange<span class="pull-right-container">
                        <span class="text text-{{$fexchange==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$fexchange==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
               <li  class="{{ (request()->is('obtained-internship')) ? 'active' : '' }}"><a href="{{url('obtained-internship')}}">8.5 Obtained Internships<span class="pull-right-container">
                        <span class="text text-{{$obtained==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$obtained==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
                <li  class="{{ (request()->is('placement-activity')) ? 'active' : '' }}"><a href="{{url('placement-activity')}}">8.6 Placement Activities<span class="pull-right-container">
                        <span class="text text-{{$placement==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$placement==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
          </ul>
        </li>
          @endhasrole
           @hasrole('BusinessSchool')
        <li class=" treeview {{(request()->is('credit-transfer'))?'active':''}}{{(request()->is('student-transfer'))?'active':''}}{{(request()->is('documentary-evidence'))?'active':''}}{{(request()->is('admission-office'))?'active':''}}">
          <a href="#">
            <i class="fa fa-globe text-black " ></i><span>9: Admission Examination</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          	<li  class="{{ (request()->is('admission-office')) ? 'active' : '' }}"><a href="{{url('admission-office')}}">9.1 Admission Office<span class="pull-right-container">
                        <span class="text text-{{$admission_office==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$admission_office==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
          	<li  class="{{ (request()->is('entry-requirements')) ? 'active' : '' }}"><a href="{{url('entry-requirements')}}">9.2 Entry Requirements<span class="pull-right-container">
                        <span class="text text-{{$entry==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$entry==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('application-received')) ? 'active' : '' }}"><a href="{{url('application-received')}}">9.3 Students Enrollment<span class="pull-right-container">
                        <span class="text text-{{$application==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$application==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('credit-transfer')) ? 'active' : '' }}"><a href="{{url('credit-transfer')}}">9.4 Credit Transfer<span class="pull-right-container">
                        <span class="text text-{{$credit_transfer==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$credit_transfer==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('student-transfer')) ? 'active' : '' }}"><a href="{{url('student-transfer')}}">9.5 Student Transfer<span class="pull-right-container">
                        <span class="text text-{{$student_transfer==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$student_transfer==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('documentary-evidence')) ? 'active' : '' }}"><a href="{{url('documentary-evidence')}}">9.6 Documentary Evidence<span class="pull-right-container">
                        <span class="text text-{{$documentary_evidence==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$documentary_evidence==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
          </ul>
        </li>
          @endhasrole
          <!-- ///////////////////////////////////////////////////////////////////////////// -->
          @endif
          @hasrole('BusinessSchool')
            <li  class="{{ (request()->is('faculty-degree')) ? 'active' : '' }}"><a href="{{url('faculty-degree')}}"><i class="fa fa-circle-o text-green"></i>Faculty Degree</a></li>
          @endhasrole
          @hasrole('BusinessSchool')
            <li  class="{{ (request()->is('registrationPrint')) ? 'active' : '' }}"><a href="{{url('registrationPrint')}}"><i class="fa fa-circle-o text-yellow"></i>Print Registration</a></li>
          @endhasrole
           @hasrole('BusinessSchool')
            <li  class="{{ (request()->is('print')) ? 'active' : '' }}"><a href="{{url('print')}}"><i class="fa fa-circle-o" style="color: #D81B60" ></i>Print SAR</a></li>
          @endhasrole
          @hasrole('BusinessSchool')
            <li  class="{{ (request()->is('registration-apply')) ? 'active' : '' }}"><a href="{{url('registration-apply')}}"><i class="fa fa-circle-o" style="color: #D81B60" ></i>Apply for Registration</a></li>
          @endhasrole
          @hasrole('NBEACAdmin')
          <li class=" treeview {{request()->is('registrations')?'active':''}}">
              <a href="#">
                  <i class="fa fa-globe text-blue " ></i><span>Registrations</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                  <li  class="{{ (request()->is('registrationPrint')) ? 'active' : '' }}"><a href="{{url('registrationPrint')}}"><i class="fa fa-circle-o text-yellow"></i>Print Registration</a></li>
                  <li  class="{{ (request()->is('registrations')) ? 'active' : '' }}"><a href="{{url('registrations')}}"><i class="fa fa-circle-o text-green"></i>Registrations</a></li>
              </ul>
          </li>

          @endhasrole
           @hasrole('NBEACAdmin')
            <li  class="{{ (request()->is('print')) ? 'active' : '' }}"><a href="{{url('print')}}"><i class="fa fa-circle-o" style="color: #D81B60" ></i>Print SAR</a></li>
          @endhasrole
          @hasrole('NBEACAdmin')
            <li  class="{{ (request()->is('department-fee')) ? 'active' : '' }}"><a href="{{url('department-fee')}}"><i class="fa fa-circle-o text-yellow"></i>Department Fee</a></li>
          @endhasrole
          @hasrole('NBEACAdmin')
          <li  class="{{ (request()->is('desk-review')) ? 'active' : '' }}"><a href="{{url('desk-review')}}"><i class="fa fa-circle-o text-blue " ></i>Registrations Desk Review</a></li>
          @endhasrole
          @hasrole('NBEACAdmin')
          <li  class="{{ (request()->is('nbeac-criteria')) ? 'active' : '' }}"><a href="{{url('nbeac-criteria')}}"><i class="fa fa-circle-o text-green"></i>Nbeac Criteria</a></li>
          @endhasrole
          @hasrole('NBEACAdmin')
          <li  class="{{ (request()->is('admin')) ? 'active' : '' }}"><a href="{{url('admin')}}"><i class="fa fa-laptop text-red"></i>Eligibility Screening</a></li>
          @endhasrole

          @hasrole('NBEACAdmin')
          <li  class="{{ (request()->is('charter_types')) ? 'active' : '' }}"><a href="{{url('config/charter_types')}}"><i class="fa fa-gears text-yelow"></i>NBEAC System Settings</a></li>
          @endhasrole
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
