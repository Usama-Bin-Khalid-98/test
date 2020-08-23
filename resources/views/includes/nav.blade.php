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
$linkages = checkIsCompleted('App\Models\External_linkages\Linkages', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$bodymeeting = checkIsCompleted('App\Models\External_linkages\BodyMeeting', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$sexchange = checkIsCompleted('App\Models\External_linkages\StudentExchange', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$fexchange = checkIsCompleted('App\Models\External_linkages\FacultyExchange', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$obtained = checkIsCompleted('App\Models\External_linkages\ObtainedInternship', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$placement = checkIsCompleted('App\Models\External_linkages\PlacementActivity', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$admission_office = checkIsCompleted('App\AdmissionOffice', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$credit_transfer = checkIsCompleted('App\CreditTransfer', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$student_transfer = checkIsCompleted('App\StudentTransfer', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$documentary_evidence = checkIsCompleted('App\DocumentaryEvidence', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
$conference = checkIsCompleted('App\Model\research\Conference', ['campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id, 'status'=>'active','isComplete'=>'yes']);
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
             <li  class="{{ (request()->is('strategic/sources-funding')) ? 'active' : '' }}"><a href="{{url('strategic/sources-funding')}}"><i class="fa fa-circle-o" style="color: #D81B60" ></i>Sources of Funding</a></li>
            <li  class="{{ (request()->is('strategic/audit-report')) ? 'active' : '' }}"><a href="{{url('strategic/audit-report')}}"><i class="fa fa-circle-o" style="color: #D81B60" ></i>Audit Report</a></li>
          </ul>
{{--              @endif--}}
          </li>
        @endhasrole
        @hasrole('BusinessSchool')
        <li class=" treeview {{(request()->is('program-portfolio'))?'active':''}}{{(request()->is('entry-requirements'))?'active':''}}{{(request()->is('application-received'))?'active':''}}" >
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


          </ul>
        </li>
          @endhasrole
          @hasrole('BusinessSchool')
        <li class=" treeview {{(request()->is('work-load'))?'active':''}}{{(request()->is('faculty-summary'))?'active':''}}{{(request()->is('faculty-stability'))?'active':''}}{{(request()->is('faculty-gender'))?'active':''}}{{(request()->is('faculty-teaching'))?'active':''}}{{(request()->is('faculty-student-ratio'))?'active':''}}">
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
             <li  class="{{ (request()->is('business-school-facility')) ? 'active' : '' }}"><a href="{{url('business-school-facility')}}">6.2 BS Facility<span class="pull-right-container">
                        <span class="text text-{{$bsfacility==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$bsfacility==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a>
             </li>
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
                    </span></a></li>

          </ul>
        </li>
          @endhasrole

          <!-- Below is the module included in SAR -->
          @hasrole('BusinessSchool')
        <li class=" treeview {{(request()->is('student-club'))?'active':''}}{{(request()->is('project-detail'))?'active':''}}{{(request()->is('env-protection'))?'active':''}}{{(request()->is('formal-relationship'))?'active':''}}{{(request()->is('complaint-resolution'))?'active':''}}{{(request()->is('internal-community'))?'active':''}}{{(request()->is('social-activity'))?'active':''}}">
          <a href="#">
            <i class="fa fa-globe text-blue " ></i><span>7 Social Responsibility</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li  class="{{ (request()->is('student-club')) ? 'active' : '' }}"><a href="{{url('student-club')}}">1. Student clubs/societies<span class="pull-right-container">
                        <span class="text text-{{$club==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$club==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('project-detail')) ? 'active' : '' }}"><a href="{{url('project-detail')}}">2. Project Details<span class="pull-right-container">
                        <span class="text text-{{$detail==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$detail==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('env-protection')) ? 'active' : '' }}"><a href="{{url('env-protection')}}">3. Env Protection Activities<span class="pull-right-container">
                        <span class="text text-{{$env==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$env==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('formal-relationship')) ? 'active' : '' }}"><a href="{{url('formal-relationship')}}">4. Formal Relationships<span class="pull-right-container">
                        <span class="text text-{{$formal==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$formal==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('complaint-resolution')) ? 'active' : '' }}"><a href="{{url('complaint-resolution')}}">5. Complaint Resolution<span class="pull-right-container">
                        <span class="text text-{{$complaint==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$complaint==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('internal-community')) ? 'active' : '' }}"><a href="{{url('internal-community')}}">6. Internal Community WP<span class="pull-right-container">
                        <span class="text text-{{$internal==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$internal==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span></a></li>
            <li  class="{{ (request()->is('social-activity')) ? 'active' : '' }}"><a href="{{url('social-activity')}}">7. Social Activity<span class="pull-right-container">
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
            <li  class="{{ (request()->is('registration-apply')) ? 'active' : '' }}"><a href="{{url('registration-apply')}}"><i class="fa fa-circle-o" style="color: #D81B60" ></i>Apply</a></li>
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
          <li  class="{{ (request()->is('desk-review')) ? 'active' : '' }}"><a href="{{url('desk-review')}}"><i class="fa fa-circle-o text-blue " ></i>Desk Reviews</a></li>
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
@endif