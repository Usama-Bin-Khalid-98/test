@php
use \Illuminate\Support\Facades\Auth;
$invoices = checkIsCompleted('App\Models\Common\Slip', ['business_school_id' => Auth::user()->campus_id, 'status'=>'paid' ]);
$basic_info = checkIsCompleted('App\BusinessSchool', ['id' => Auth::user()->business_school_id, 'status'=>'active','isCompleted'=>'yes' ]);
$scope = checkIsCompleted('App\Models\StrategicManagement\Scope', ['campus_id' => Auth::user()->campus_id, 'status'=>'active','isComplete'=>'yes' ]);
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
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
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
{{--            <li  class="{{ (request()->is('permissions')) ? 'active' : '' }}"><a href="{{url('permissions')}}"><i class="fa fa-circle-o text-blue"></i>Permissions</a></li>--}}

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
          <a href="#">
            <i class="fa fa-users " style="color: #D81B60"></i> <span>Strategic Management</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li class="{{ (request()->is('strategic/basicinfo')) ? 'active' : '' }} ">
                <a href="{{url('strategic/basicinfo')}}">
                    <i class="fa fa-circle-o" style="color: #D81B60"></i>Basic Information
                    <span class="pull-right-container">
                        <span class="text text-{{$basic_info==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$basic_info==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span>
                </a>
            </li>
            <li  class="{{ (request()->is('strategic/scope')) ? 'active' : '' }}">
                <a href="{{url('strategic/scope')}}">
                    <i class="fa fa-circle-o" style="color: #D81B60"></i>Scope Of Accreditation
                    <span class="pull-right-container">
                        <span class="text text-{{$scope==='C'?'green':'red'}} pull-right">
                            <i class="fa {{$scope==='C'?'fa-check-square':'fa-minus-square'}}" ></i>
                        </span>
                    </span>
                </a>
            </li>
            <li  class="{{ (request()->is('strategic/contact-info')) ? 'active' : '' }}"><a href="{{url('strategic/contact-info')}}"><i class="fa fa-circle-o" style="color: #D81B60"></i>Contact Information</a></li>
            <li  class="{{ (request()->is('strategic/statutory-committees')) ? 'active' : '' }}"><a href="{{url('/strategic/statutory-committees')}}"><i class="fa fa-circle-o" style="color: #D81B60"></i>BS Statutory committees</a></li>
            <li  class="{{ (request()->is('strategic/affiliations')) ? 'active' : '' }}"><a href="{{url('strategic/affiliations')}}"><i class="fa fa-circle-o" style="color: #D81B60"></i>Affiliations of AC</a></li>
            <li  class="{{ (request()->is('strategic/budgetary-info')) ? 'active' : '' }}"><a href="{{url('strategic/budgetary-info')}}"><i class="fa fa-circle-o" style="color: #D81B60"></i>Budgetary Information</a></li>
            <li  class="{{ (request()->is('strategic/mission-vision')) ? 'active' : '' }}"><a href="{{url('strategic/mission-vision')}}"><i class="fa fa-circle-o" style="color: #D81B60"></i>Mission Vision</a></li>
            <li  class="{{ (request()->is('strategic/strategic-plan')) ? 'active' : '' }}"><a href="{{url('strategic/strategic-plan')}}"><i class="fa fa-circle-o" style="color: #D81B60" ></i>Approval of Strategic Plan</a></li>
            <li  class="{{ (request()->is('strategic/sources-funding')) ? 'active' : '' }}"><a href="{{url('strategic/sources-funding')}}"><i class="fa fa-circle-o" style="color: #D81B60" ></i>Sources of Funding</a></li>
            <li  class="{{ (request()->is('strategic/audit-report')) ? 'active' : '' }}"><a href="{{url('strategic/audit-report')}}"><i class="fa fa-circle-o" style="color: #D81B60" ></i>Audit Report</a></li>
            <li  class="{{ (request()->is('strategic/parent-institution')) ? 'active' : '' }}"><a href="{{url('strategic/parent-institution')}}"><i class="fa fa-circle-o" style="color: #D81B60" ></i>Parent Institution</a></li>
          </ul>
        </li>
        @endhasrole
        @hasrole('BusinessSchool')
        <li class=" treeview {{(request()->is('program-portfolio'))?'active':''}}{{(request()->is('entry-requirements'))?'active':''}}{{(request()->is('application-received'))?'active':''}}" >
          <a href="#">
            <i class="fa fa-file text-orange"></i> <span>Curriculum</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (request()->is('program-portfolio')) ? 'active' : '' }}"><a href="{{url('program-portfolio')}}"><i class="fa fa-circle-o text-orange"></i>Programs Portfolio</a></li>

            <li  class="{{ (request()->is('entry-requirements')) ? 'active' : '' }}"><a href="{{url('entry-requirements')}}"><i class="fa fa-circle-o text-orange"></i>Entry Requirements</a></li>
            <li  class="{{ (request()->is('application-received')) ? 'active' : '' }}"><a href="{{url('application-received')}}"><i class="fa fa-circle-o text-orange"></i>Applications Received</a></li>


          </ul>
        </li>
          @endhasrole
          @hasrole('BusinessSchool')
        <li class=" treeview {{(request()->is('student-enrolment'))?'active':''}}{{(request()->is('students-graduated'))?'active':''}}{{(request()->is('student-gender'))?'active':''}}{{(request()->is('student-intake'))?'active':''}}{{(request()->is('alumni-participation'))?'active':''}}{{(request()->is('class-size'))?'active':''}}{{(request()->is('alumni-membership'))?'active':''}}">
              <a href="#">
                  <i class="fa fa-user text-blue"></i> <span>Students</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
          <ul class="treeview-menu">
            <li  class="{{ (request()->is('student-enrolment')) ? 'active' : '' }}"><a href="{{url('student-enrolment')}}"><i class="fa fa-circle-o text-blue"></i>Students Enrollment</a></li>
            <li  class="{{ (request()->is('students-graduated')) ? 'active' : '' }}"><a href="{{url('students-graduated')}}"><i class="fa fa-circle-o text-blue"></i>Students Graduated</a></li>
            <li  class="{{ (request()->is('student-gender')) ? 'active' : '' }}"><a href="{{url('student-gender')}}"><i class="fa fa-circle-o text-blue"></i>Students Gender mix</a></li>
            <li  class="{{ (request()->is('student-intake')) ? 'active' : '' }}"><a href="{{url('student-intake')}}"><i class="fa fa-circle-o text-blue"></i>Students Intakes</a></li>
            <li  class="{{ (request()->is('class-size')) ? 'active' : '' }}"><a href="{{url('class-size')}}"><i class="fa fa-circle-o text-blue"></i>Class Size</a></li>
            <li  class="{{ (request()->is('alumni-membership')) ? 'active' : '' }}"><a href="{{url('alumni-membership')}}"><i class="fa fa-circle-o text-blue"></i>Alumni Membership</a></li>
            <li  class="{{ (request()->is('alumni-participation')) ? 'active' : '' }}"><a href="{{url('alumni-participation')}}"><i class="fa fa-circle-o text-blue"></i>Alumni Participation</a></li>

          </ul>
        </li>
          @endhasrole
          @hasrole('BusinessSchool')
        <li class=" treeview {{(request()->is('work-load'))?'active':''}}{{(request()->is('faculty-summary'))?'active':''}}{{(request()->is('faculty-stability'))?'active':''}}{{(request()->is('faculty-gender'))?'active':''}}{{(request()->is('faculty-teaching'))?'active':''}}{{(request()->is('faculty-student-ratio'))?'active':''}}">
              <a href="#">
                  <i class="fa fa-user-plus text-green"></i> <span>Faculty</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
          <ul class="treeview-menu">
            <li class="{{ (request()->is('faculty-summary')) ? 'active' : '' }}"><a href="{{url('faculty-summary')}}"><i class="fa fa-circle-o text-green"></i>Summary BSF</a></li>
            <li  class="{{ (request()->is('work-load')) ? 'active' : '' }}"><a href="{{url('work-load')}}"><i class="fa fa-circle-o text-green"></i>Faculty Work Load T</a></li>
            <li  class="{{ (request()->is('faculty-teaching')) ? 'active' : '' }}"><a href="{{url('faculty-teaching')}}"><i class="fa fa-circle-o text-green"></i>Visiting Faculty</a></li>
             <li  class="{{ (request()->is('faculty-student-ratio')) ? 'active' : '' }}"><a href="{{url('faculty-student-ratio')}}"><i class="fa fa-circle-o text-green"></i>Faculty Student Ratio</a></li>
             <li  class="{{ (request()->is('faculty-stability')) ? 'active' : '' }}"><a href="{{url('faculty-stability')}}"><i class="fa fa-circle-o text-green"></i>Faculty Stability</a></li>
            <li  class="{{ (request()->is('faculty-gender')) ? 'active' : '' }}"><a href="{{url('faculty-gender')}}"><i class="fa fa-circle-o text-green"></i>Faculty Gender Mix</a></li>
          </ul>
        </li>
          @endhasrole
          @hasrole('BusinessSchool')
           <li class=" treeview {{(request()->is('research-summary'))?'active':''}} ">
          <a href="#">
            <i class="fa fa-users " style="color: #D81B60"></i> <span>Research Development</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li  class="{{ (request()->is('research-summary')) ? 'active' : '' }}"><a href="{{url('research-summary')}}"><i class="fa fa-circle-o" style="color: #D81B60"></i>Research Summary</a></li>

          </ul>
        </li>
          @endhasrole
          @hasrole('BusinessSchool')
          <li class=" treeview {{(request()->is('financial-info'))?'active':''}}{{(request()->is('financial-risk'))?'active':''}}{{(request()->is('qec-info'))?'active':''}}{{(request()->is('business-school-facility'))?'active':''}}{{(request()->is('support-staff'))?'active':''}} ">
          <a href="#">
            <i class="fa fa-users text-orange" ></i><span>Facilities Information</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li  class="{{ (request()->is('financial-info')) ? 'active' : '' }}"><a href="{{url('financial-info')}}"><i class="fa fa-circle-o text-orange"></i>Financial Info</a></li>
            <li  class="{{ (request()->is('financial-risk')) ? 'active' : '' }}"><a href="{{url('financial-risk')}}"><i class="fa fa-circle-o text-orange"></i>Financial Risk</a></li>
            <li  class="{{ (request()->is('support-staff')) ? 'active' : '' }}"><a href="{{url('support-staff')}}"><i class="fa fa-circle-o text-orange"></i>Support Staff</a></li>
            <li  class="{{ (request()->is('qec-info')) ? 'active' : '' }}"><a href="{{url('qec-info')}}"><i class="fa fa-circle-o text-orange"></i>Qec Info</a></li>
             <li  class="{{ (request()->is('business-school-facility')) ? 'active' : '' }}"><a href="{{url('business-school-facility')}}"><i class="fa fa-circle-o text-orange"></i>Business School Facility</a></li>

          </ul>
        </li>
          @endhasrole
          @hasrole('BusinessSchool')
        <li class=" treeview {{(request()->is('student-club'))?'active':''}}{{(request()->is('project-detail'))?'active':''}}{{(request()->is('env-protection'))?'active':''}}{{(request()->is('formal-relationship'))?'active':''}}{{(request()->is('complaint-resolution'))?'active':''}}{{(request()->is('internal-community'))?'active':''}}">
          <a href="#">
            <i class="fa fa-globe text-blue " ></i><span>Social Responsibility</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li  class="{{ (request()->is('student-club')) ? 'active' : '' }}"><a href="{{url('student-club')}}"><i class="fa fa-circle-o text-blue"></i>Student clubs/societies</a></li>
            <li  class="{{ (request()->is('project-detail')) ? 'active' : '' }}"><a href="{{url('project-detail')}}"><i class="fa fa-circle-o text-blue"></i>Project Details</a></li>
            <li  class="{{ (request()->is('env-protection')) ? 'active' : '' }}"><a href="{{url('env-protection')}}"><i class="fa fa-circle-o text-blue"></i>Env Protection Activities</a></li>
            <li  class="{{ (request()->is('formal-relationship')) ? 'active' : '' }}"><a href="{{url('formal-relationship')}}"><i class="fa fa-circle-o text-blue"></i>Formal Relationships</a></li>
            <li  class="{{ (request()->is('complaint-resolution')) ? 'active' : '' }}"><a href="{{url('complaint-resolution')}}"><i class="fa fa-circle-o text-blue"></i>Complaint Resolution</a></li>
            <li  class="{{ (request()->is('internal-community')) ? 'active' : '' }}"><a href="{{url('internal-community')}}"><i class="fa fa-circle-o text-blue"></i>Internal Community WP</a></li>
          </ul>
        </li>
          @endhasrole
          @hasrole('BusinessSchool')
            <li  class="{{ (request()->is('faculty-degree')) ? 'active' : '' }}"><a href="{{url('faculty-degree')}}"><i class="fa fa-circle-o text-green"></i>Faculty Degree</a></li>
          @endhasrole
          @hasrole('BusinessSchool')
            <li  class="{{ (request()->is('registrationPrint')) ? 'active' : '' }}"><a href="{{url('registrationPrint')}}"><i class="fa fa-circle-o text-yellow"></i>Print Registration</a></li>
          @endhasrole
           @hasrole('BusinessSchool')
            <li  class="{{ (request()->is('print')) ? 'active' : '' }}"><a href="{{url('print')}}"><i class="fa fa-circle-o" style="color: #D81B60" ></i>Print SAR</a></li>
          @endhasrole
          @hasrole('NBEACAdmin')
            <li  class="{{ (request()->is('registrationPrint')) ? 'active' : '' }}"><a href="{{url('registrationPrint')}}"><i class="fa fa-circle-o text-green"></i>Print Registration</a></li>
          @endhasrole
           @hasrole('NBEACAdmin')
            <li  class="{{ (request()->is('print')) ? 'active' : '' }}"><a href="{{url('print')}}"><i class="fa fa-circle-o" style="color: #D81B60" ></i>Print SAR</a></li>
          @endhasrole
          @hasrole('NBEACAdmin')
            <li  class="{{ (request()->is('department-fee')) ? 'active' : '' }}"><a href="{{url('department-fee')}}"><i class="fa fa-circle-o text-yellow"></i>Department Fee</a></li>
          @endhasrole
          @hasrole('NBEACAdmin')
          <li  class="{{ (request()->is('desk-review')) ? 'active' : '' }}"><a href="{{url('desk-review')}}"><i class="fa fa-circle-o text-blue " ></i>Desk Review</a></li>
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
