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
          <li class=" treeview
          {{ (request()->is('user')) ? 'active' : '' }}
          {{ (request()->is('rolesPermission')) ? 'active' : '' }}
          {{ (request()->is('roles')) ? 'active' : '' }}
          {{ (request()->is('permission')) ? 'active' : '' }}

          " style="display: none;">
          <a href="#">
            <i class="fa fa-user text-blue" ></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (request()->is('user')) ? 'active' : '' }}"><a href="user"><i class="fa fa-circle-o text-blue"></i>Users</a></li>

            <li  class="{{ (request()->is('roles')) ? 'active' : '' }}"><a href="#"><i class="fa fa-circle-o text-blue"></i>User Types</a></li>

            <li  class="{{ (request()->is('')) ? 'active' : '' }}"><a href="#"><i class="fa fa-circle-o text-blue"></i>Roles</a></li>

            <li  class="{{ (request()->is('permission')) ? 'active' : '' }}"><a href="/permission"><i class="fa fa-circle-o text-blue"></i>Permissions</a></li>

          </ul>
            </li>
          <li class=" treeview {{(request()->is('strategic/basicinfo'))?'active':''}} {{(request()->is('strategic/scope'))?'active':''}}{{(request()->is('strategic/contact-info'))?'active':''}}{{(request()->is('strategic/affiliations'))?'active':''}}{{(request()->is('strategic/plan'))?'active':''}}">
          <a href="#">
            <i class="fa fa-users " style="color: #D81B60"></i> <span>Strategic Management</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (request()->is('strategic/basicinfo')) ? 'active' : '' }} "><a href="{{url('strategic/basicinfo')}}"><i class="fa fa-circle-o" style="color: #D81B60"></i>Basic Information</a></li>
            <li  class="{{ (request()->is('strategic/scope')) ? 'active' : '' }}"><a href="{{url('strategic/scope')}}"><i class="fa fa-circle-o" style="color: #D81B60"></i>Scope Of Accreditation</a></li>
            <li  class="{{ (request()->is('strategic/contact-info')) ? 'active' : '' }}"><a href="{{url('strategic/contact-info')}}"><i class="fa fa-circle-o" style="color: #D81B60"></i>Contact Information</a></li>
            <li  class="{{ (request()->is('strategic/statutory-committees')) ? 'active' : '' }}"><a href="{{url('/strategic/statutory-committees')}}"><i class="fa fa-circle-o" style="color: #D81B60"></i>BS Statutory committees</a></li>
            <li  class="{{ (request()->is('strategic/affiliations')) ? 'active' : '' }}"><a href="{{url('affiliations')}}"><i class="fa fa-circle-o" style="color: #D81B60"></i>Affiliations of AC</a></li>
            <li  class="{{ (request()->is('strategic/budgetary-information')) ? 'active' : '' }} isDisabled"><a href="{{url('budgetaryInfo')}}"><i class="fa fa-circle-o"></i>Budgetary Information</a></li>
            <li  class="{{ (request()->is('strategic/plan')) ? 'active' : '' }} isDisabled"><a href="{{url('plan')}}"><i class="fa fa-circle-o" ></i>Approval of Strategic Plan</a></li>

          </ul>
        </li>


        <li class=" treeview {{(request()->is('portfolio'))?'active':''}}{{(request()->is('entry-requirements'))?'active':''}}" >
          <a href="#">
            <i class="fa fa-file text-orange"></i> <span>Curriculum</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (request()->is('portfolio')) ? 'active' : '' }}"><a href="{{route('portfolio')}}"><i class="fa fa-circle-o text-orange"></i>Programs Portfolio</a></li>

            <li  class="{{ (request()->is('entry-requirements')) ? 'active' : '' }}"><a href="{{route('entry-requirements')}}"><i class="fa fa-circle-o text-orange"></i>Entry Requirements</a></li>
            <li  class="{{ (request()->is('entry-requirements')) ? 'active' : '' }}"><a href="{{route('entry-requirements')}}"><i class="fa fa-circle-o text-orange"></i>Applications Received</a></li>


          </ul>
        </li>
        <li class=" treeview {{(request()->is('student-enrolment'))?'active':''}}">
              <a href="#">
                  <i class="fa fa-user text-blue"></i> <span>Students</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
          <ul class="treeview-menu">
            <li  class="{{ (request()->is('student-enrolment')) ? 'active' : '' }}"><a href="{{route('student-enrolment')}}"><i class="fa fa-circle-o text-orange"></i>Student Enrolment</a></li>
            <li  class="{{ (request()->is('student-enrolment')) ? 'active' : '' }}"><a href="{{route('student-enrolment')}}"><i class="fa fa-circle-o text-orange"></i> Graduated Students</a></li>
            <li  class="{{ (request()->is('student-enrolment')) ? 'active' : '' }}"><a href="{{route('student-enrolment')}}"><i class="fa fa-circle-o text-orange"></i>Students Gender Mix</a></li>

          </ul>
        </li>
        <li class=" treeview {{(request()->is('faculty/work-load'))?'active':''}}{{(request()->is('faculty_stability'))?'active':''}}{{(request()->is('faculty-gender'))?'active':''}}">
              <a href="#">
                  <i class="fa fa-user-plus text-orange"></i> <span>Faculty</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
          <ul class="treeview-menu">
            <li class="{{ (request()->is('')) ? 'active' : '' }}"><a href="#"><i class="fa fa-circle-o text-orange"></i>Summary BSF</a></li>
            <li  class="{{ (request()->is('faculty/workload')) ? 'active' : '' }}"><a href="{{route('workload')}}"><i class="fa fa-circle-o text-orange"></i>Faculty Work Load T</a></li>
{{--            <li  class="{{ (request()->is('')) ? 'active' : '' }}"><a href="#"><i class="fa fa-circle-o text-orange"></i>Faculty Work Load T-1</a></li>--}}
            <li  class="{{ (request()->is('faculty_stability')) ? 'active' : '' }}"><a href="{{route('faculty_stability')}}"><i class="fa fa-circle-o text-orange"></i>Faculty Stability</a></li>
            <li  class="{{ (request()->is('visiting_faculty')) ? 'active' : '' }}"><a href="{{route('visiting_faculty')}}"><i class="fa fa-circle-o text-orange"></i>Visiting Faculty</a></li>
            <li  class="{{ (request()->is('faculty-gender')) ? 'active' : '' }}"><a href="{{route('faculty-gender')}}"><i class="fa fa-circle-o text-orange"></i>Faculty Gender Mix</a></li>
          </ul>
        </li>

          <li class=" treeview {{(request()->is('research-summary'))?'active':''}}">
              <a href="#">
                  <i class="fa fa-search text-purple"></i> <span>Research and Development</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
          <ul class="treeview-menu">
            <li class="{{ (request()->is('research-summary')) ? 'active' : '' }}"><a href="{{route('research-summary')}}"><i class="fa fa-circle-o text-orange"></i>Summary of Research</a></li>
          </ul>
        </li>

          <li class=" treeview {{(request()->is(''))?'active':''}}">
              <a href="#">
                  <i class="fa fa-chrome text-green"></i> <span>Facilities Information</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
          <ul class="treeview-menu">
            <li class="{{ (request()->is('')) ? 'active' : '' }}"><a href="{{route('research-summary')}}"><i class="fa fa-circle-o text-orange"></i>Summary of Research</a></li>
          </ul>
        </li>
            <li  class="{{ (request()->is('')) ? 'active' : '' }}"><a href="#"><i class="fa fa-gears text-black"></i>Business School Info</a></li>
            <li  class="{{ (request()->is('admin')) ? 'active' : '' }}"><a href="/admin"><i class="fa fa-gears text-black"></i>Admin</a></li>

          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
