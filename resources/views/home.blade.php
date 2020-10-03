@section('pageTitle', 'Dashboard')

@if(Auth::user())


@include("includes.head")
<!-- Morris chart -->
{{--<link rel="stylesheet" href="bower_components/morris.js/morris.css">--}}
<!-- jvectormap -->
{{--<link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">--}}
<link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.1/css/fixedColumns.dataTables.min.css" />
<link rel="stylesheet" href="{{URL::asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">

@include("includes.header")
@include("includes.nav")


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section><!-- Main content -->


    @hasrole('NBEACAdmin')
    <section class="content">
      <!-- Small boxes (Stat box)  //////////   Admin Dashboard //////-->
      <div class="row" style="display: none;">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="background-color: #00c0ef;color:#fff;">
            <div class="inner">
              <h3>150</h3>

              <p>Total School Registered</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Schedule Meeting</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple-gradient ">
            <div class="inner">
              <h3>44</h3>

              <p>Staff Members</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-light-blue-gradient">
            <div class="inner">
              <h3>65</h3>

              <p>Total Mentors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

        {{--Business School Dashboard--}}
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box" style="background-color: #00c0ef;color:#fff;">
                    <div class="inner">
                        <h3>1</h3>

                        <p>Chief Administrative Officer</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>5<sup style="font-size: 20px"></sup></h3>

                        <p>Degree Programs</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple-gradient ">
                    <div class="inner">
                        <h3>4</h3>

                        <p>Applications Received</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-light-blue-gradient">
                    <div class="inner">
                        <h3>65</h3>

                        <p>Total Students</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row" style="display: none;">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
            <!-- quick email widget -->
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-envelope"></i>

                    <h3 class="box-title">Quick Email</h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                                title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <div class="box-body">
                    <form action="#" method="post">
                        <div class="form-group">
                            <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" placeholder="Subject">
                        </div>
                        <div>
                  <textarea class="" placeholder="Message"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                    </form>
                </div>
                <div class="box-footer clearfix">
                    <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
                        <i class="fa fa-arrow-circle-right"></i></button>
                </div>
            </div>

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">
            <!-- TO DO List -->
            <div class="box box-primary">
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>

                    <h3 class="box-title">To Do List</h3>

                    <div class="box-tools pull-right">
                        <ul class="pagination pagination-sm inline">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                    <ul class="todo-list">
                        <li>
                            <!-- drag handle -->
                            <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                            <!-- checkbox -->
                            <input type="checkbox" value="">
                            <!-- todo text -->
                            <span class="text">Design a nice theme</span>
                            <!-- Emphasis label -->
                            <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                            <!-- General tools such as edit or delete-->
                            <div class="tools">
                                <i class="fa fa-edit"></i>
                                <i class="fa fa-trash-o"></i>
                            </div>
                        </li>
                        <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                            <input type="checkbox" value="">
                            <span class="text">Make the theme responsive</span>
                            <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                            <div class="tools">
                                <i class="fa fa-edit"></i>
                                <i class="fa fa-trash-o"></i>
                            </div>
                        </li>
                        <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                            <input type="checkbox" value="">
                            <span class="text">Let theme shine like a star</span>
                            <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                            <div class="tools">
                                <i class="fa fa-edit"></i>
                                <i class="fa fa-trash-o"></i>
                            </div>
                        </li>
                        <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                            <input type="checkbox" value="">
                            <span class="text">Let theme shine like a star</span>
                            <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                            <div class="tools">
                                <i class="fa fa-edit"></i>
                                <i class="fa fa-trash-o"></i>
                            </div>
                        </li>
                        <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                            <input type="checkbox" value="">
                            <span class="text">Check your messages and notifications</span>
                            <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                            <div class="tools">
                                <i class="fa fa-edit"></i>
                                <i class="fa fa-trash-o"></i>
                            </div>
                        </li>
                        <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                            <input type="checkbox" value="">
                            <span class="text">Let theme shine like a star</span>
                            <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                            <div class="tools">
                                <i class="fa fa-edit"></i>
                                <i class="fa fa-trash-o"></i>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
            <!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->



        <!-- Main row -->

        <div class="row" >
            <!-- Left col -->
            <section class="col-lg-7  connectedSortable" style="display: none;">
                <!-- Custom tabs (Charts with tabs)-->
                <!-- quick email widget -->
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="fa fa-envelope"></i>

                        <h3 class="box-title">Quick Email</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                                    title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <div class="box-body">
                        <form action="#" method="post">
                            <div class="form-group">
                                <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" placeholder="Subject">
                            </div>
                            <div>
                  <textarea class="" placeholder="Message"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="box-footer clearfix">
                        <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
                            <i class="fa fa-arrow-circle-right"></i></button>
                    </div>
                </div>

            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-12 connectedSortable">
                <!-- TO DO List -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Business school Membership Requests. </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-file-pdf-o"></i></button>
                            </div>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">


                        <table id="datatable1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Business School Name</th>
                                <th>Campus</th>
                                <th>Contact Person Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                                {{--                            <th>Invoice Slip</th>--}}
                                <th>Account Type</th>
                                <th>Status</th>
                                {{--                            <th>Action</th>--}}
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($memberShips as $user)
                                <tr>
                                    <td>{{$user->business_school->name}}</td>
                                    <td>{{$user->campus->location??'Main Campus'}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->contact_no}}</td>
                                    <td>{{$user->email}}</td>
                                    {{--                            <td><a href="{{@$user->business_school->slip[0]->slip}}">{{$user->user_type==='peer_review'?'no slip':'Invoice Slip'}}</a></td>--}}
                                    <td>{{$user->user_type === 'peer_review'?'Peer Review':"Business School"}}</td>
                                    <td><i class="badge {{$user->status=='disabled'?'bg-red':''}} status" data-id="{{$user->id}}" style="background: red" >Disabled</i></td>
                                    {{--                            <td><i class="fa fa-trash text-info"></i> | <i class="fa fa-pencil text-blue" id="edit"></i> </td>--}}
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Business School Name</th>
                                <th>Campus</th>
                                <th>Contact Person Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                                {{--                            <th>Invoice Slip</th>--}}
                                <th>Account Type</th>
                                <th>Status</th>
                                {{--                            <th>Action</th>--}}
                            </tr>
                            </tfoot>
                        </table>

                        <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->

            </section>

            <!--Invoices list-->
{{--            <section class="col-lg-12 connectedSortable">--}}
{{--                <!-- TO DO List -->--}}
{{--                <div class="box box-primary">--}}
{{--                    <div class="box-header">--}}
{{--                        <h3 class="box-title">Business school Invoices. </h3>--}}
{{--                        <div class="box-tools pull-right">--}}
{{--                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>--}}
{{--                            </button>--}}
{{--                            <div class="btn-group">--}}
{{--                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">--}}
{{--                                    <i class="fa fa-file-pdf-o"></i></button>--}}
{{--                            </div>--}}
{{--                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- /.box-header -->--}}
{{--                    <div class="box-body">--}}


{{--                        <table id="datatable2" class="table table-bordered table-striped">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>Business School Name</th>--}}
{{--                                <th>Campus</th>--}}
{{--                                <th>Department</th>--}}
{{--                                <th>Contact Person Name</th>--}}
{{--                                <th>Contact</th>--}}
{{--                                <th>Email</th>--}}
{{--                                <th>Invoice Slip</th>--}}
{{--                                --}}{{--                            <th>Account Type</th>--}}
{{--                                <th>Status</th>--}}
{{--                                <th>Action</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}

{{--                            <tbody>--}}

{{--                            @foreach($invoices as $invoice)--}}
{{--                                <tr>--}}
{{--                                    <td>{{@$invoice->school}}</td>--}}
{{--                                    <td>{{@$invoice->campus??'Main Campus'}}</td>--}}
{{--                                    <td>{{@$invoice->department}}</td>--}}
{{--                                    <td>{{@$invoice->user}}</td>--}}
{{--                                    <td>{{@$invoice->contact_no}}</td>--}}
{{--                                    <td>{{@$invoice->email}}</td>--}}
{{--                                    <td><a href="{{@$invoice->slip}}">Invoice Slip</a></td>--}}
{{--                                    --}}{{--                            <td>{{$invoice->user_type === 'peer_review'?'Peer Review':"Business School"}}</td>--}}
{{--                                    <td><i class="badge {{$invoice->regStatus == 'inactive'?'bg-red':''}}" data-id="{{$invoice->id}}" style="background: red" >{{$invoice->regStatus != ''?ucwords($invoice->regStatus):'inactive'}}</i></td>--}}
{{--                                    <td><i class="fa fa-trash text-info"></i> | <i class="fa fa-pencil text-blue" id="edit"></i> </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}

{{--                            </tbody>--}}
{{--                            <tfoot>--}}
{{--                            <tr>--}}
{{--                                <th>Business School Name</th>--}}
{{--                                <th>Campus</th>--}}
{{--                                <th>Department</th>--}}
{{--                                <th>Contact Person Name</th>--}}
{{--                                <th>Contact</th>--}}
{{--                                <th>Email</th>--}}
{{--                                <th>Invoice Slip</th>--}}
{{--                                --}}{{--                            <th>Account Type</th>--}}
{{--                                <th>Status</th>--}}
{{--                                <th>Action</th>--}}
{{--                            </tr>--}}
{{--                            </tfoot>--}}
{{--                        </table>--}}

{{--                        <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->--}}
{{--                    </div>--}}
{{--                    <!-- /.box-body -->--}}

{{--                </div>--}}
{{--                <!-- /.box -->--}}

{{--            </section>--}}
            <!-- right col -->

            <!--Registrations list-->
{{--            <section class="col-lg-12 connectedSortable">--}}
{{--                <!-- TO DO List -->--}}
{{--                <div class="box box-primary">--}}
{{--                    <div class="box-header">--}}
{{--                        <h3 class="box-title">Business school Department Registrations. </h3>--}}
{{--                        <div class="box-tools pull-right">--}}
{{--                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>--}}
{{--                            </button>--}}
{{--                            <div class="btn-group">--}}
{{--                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">--}}
{{--                                    <i class="fa fa-file-pdf-o"></i></button>--}}
{{--                            </div>--}}
{{--                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- /.box-header -->--}}
{{--                    <div class="box-body">--}}


{{--                        <table id="datatable3" class="table table-bordered table-striped">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>Business School Name</th>--}}
{{--                                <th>Campus</th>--}}
{{--                                <th>Department</th>--}}
{{--                                <th>Contact Person Name</th>--}}
{{--                                <th>Contact</th>--}}
{{--                                <th>Email</th>--}}
{{--                                <th>Invoice Slip</th>--}}
{{--                                <th>Desk Review</th>--}}
{{--                                <th>Status</th>--}}
{{--                                <th>Action</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}

{{--                            <tbody>--}}

{{--                            @foreach($registrations as $regist)--}}
{{--                                <tr>--}}
{{--                                    <td>{{@$regist->school}}</td>--}}
{{--                                    <td>{{@$regist->campus??'Main Campus'}}</td>--}}
{{--                                    <td>{{@$regist->department}}</td>--}}
{{--                                    <td>{{@$regist->user}}</td>--}}
{{--                                    <td>{{@$regist->contact_no}}</td>--}}
{{--                                    <td>{{@$regist->email}}</td>--}}
{{--                                    <td><a href="{{url('deskreview')}}/{{@$regist->id}}">Review</a></td>--}}
{{--                                    --}}{{--<td>{{$regist->user_type === 'peer_review'?'Peer Review':"Business School"}}</td>--}}
{{--                                    <td><i class="badge {{$regist->regStatus == 'pending'?'bg-red':''}}" >{{$regist->regStatus != ''?ucwords($regist->regStatus):'Initiated'}}</i></td>--}}
{{--                                    <td><i class="fa fa-trash text-info"></i> | <i class="fa fa-pencil text-blue" id="edit"></i> </td>--}}
{{--                                </tr>--}}

{{--                            @endforeach--}}

{{--                            </tbody>--}}
{{--                            <tfoot>--}}
{{--                            <tr>--}}
{{--                                <th>Business School Name</th>--}}
{{--                                <th>Campus</th>--}}
{{--                                <th>Department</th>--}}
{{--                                <th>Contact Person Name</th>--}}
{{--                                <th>Contact</th>--}}
{{--                                <th>Email</th>--}}
{{--                                <th>Invoice Slip</th>--}}
{{--                                <th>Desk Review</th>--}}
{{--                                <th>Status</th>--}}
{{--                                <th>Action</th>--}}
{{--                            </tr>--}}
{{--                            </tfoot>--}}
{{--                        </table>--}}

{{--                        <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--                <!-- /.box -->--}}

{{--            </section>--}}
            <!-- right col -->


             <!--Registrations list-->
            <section class="col-lg-12 connectedSortable">
                <!-- TO DO List -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Business school Campuses SAR/Registrations print list. </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-file-pdf-o"></i></button>
                            </div>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">


                        <table id="datatable4" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Business School Name</th>
                                <th>Campus</th>
                                <th>Contact Person Name</th>
                                <th>Contact</th>
                                <th>Website</th>
                                <th>Action</th>
                                <!-- <th>Action</th> -->
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($businessSchools as $school)
                                <tr>
                                    <td width="25%">{{$school->name}}</td>
                                    <td width="15%">{{$school->campus}} </td>
                                    <td>{{$school->contact_person}} </td>
                                    <td>{{$school->charter_number}} </td>
                                    <td>{{$school->web_url}} </td>

                                    <td><a class="btn btn-info" href="print?cid=<?php echo $school->campusID; ?>&bid=<?php echo $school->id; ?>">Print SAR</a><a class="btn btn-primary" href="registrationPrint?cid=<?php echo $school->campusID; ?>&bid=<?php echo $school->id; ?>">Print Registration</a></td>

                                   <!--  <td><i class="badge  " > </i></td>
                                    <td><i class="fa fa-trash text-info"></i> | <i class="fa fa-pencil text-blue" id="edit"></i> </td> -->
                                </tr>

                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Business School Name</th>
                                <th>Campus</th>
                                <th>Contact Person Name</th>
                                <th>Contact</th>
                                <th>Website</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>

                        <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                    </div>

                </div>
                <!-- /.box -->

            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </section>
      @endhasrole

      @hasrole('BusinessSchool')
      <!-- Info boxes -->
      <section class="content">
          <div class="row">
              <div class="col-md-2 col-sm-6 col-xs-12">
                  <div class="info-box">
                      <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

                      <div class="info-box-content">
                          <span class="info-box-text">Invoices</span>
                          <span class="info-box-number">2<small></small></span>
                      </div>
                      <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
              </div>

              <div class="col-md-2 col-sm-6 col-xs-12">
                  <div class="info-box">
                      <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

                      <div class="info-box-content">
                          <span class="info-box-text">Mentoring Invoices</span>
                          <span class="info-box-number">5<small></small></span>
                      </div>
                      <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-md-2 col-sm-6 col-xs-12">
                  <div class="info-box">
                      <span class="info-box-icon bg-maroon"><i class="fa fa-home"></i></span>

                      <div class="info-box-content">
                          <span class="info-box-text">Departments</span>
                          <span class="info-box-number">4</span>
                      </div>
                      <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
              </div>
              <!-- /.col -->

              <!-- fix for small devices only -->
              <div class="clearfix visible-sm-block"></div>

              <div class="col-md-2 col-sm-6 col-xs-12">
                  <div class="info-box">
                      <span class="info-box-icon bg-green"><i class="ion ion-ios-home-outline"></i></span>

                      <div class="info-box-content">
                          <span class="info-box-text">Campuses</span>
                          <span class="info-box-number">760</span>
                      </div>
                      <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-md-2 col-sm-6 col-xs-12">
                  <div class="info-box">
                      <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people"></i></span>

                      <div class="info-box-content">
                          <span class="info-box-text">Students</span>
                          <span class="info-box-number">2,000</span>
                      </div>
                      <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
              </div>

              <div class="col-md-2 col-sm-6 col-xs-12">
                  <div class="info-box">
                      <span class="info-box-icon bg-aqua-gradient"><i class="ion ion-ios-people"></i></span>

                      <div class="info-box-content">
                          <span class="info-box-text">Faculty</span>
                          <span class="info-box-number">200</span>
                      </div>
                      <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
              </div>
              <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
              <div class="col-md-12">
                  <div class="box">
                      <div class="box-header with-border">
                          <h3 class="box-title">Registration Progress</h3>
                          <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                              </button>
                              <div class="btn-group">
                                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                      <i class="fa fa-file-pdf-o"></i></button>
                              </div>
                              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                          </div>
                          <div class="box-tools pull-right">

                          </div>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                          <div class="row">
                              <div class="col-md-8">

                                  <div class="alert alert-danger alert-dismissible">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <h4><i class="icon fa fa-sticky-note"></i>Note</h4>
                                      <ol type="1">

                                          <li><h5>Generate Invoice</h5>
                                              <p>Generate invoice in invoices tab, to change the status of invoice click on the the dollor icon and make it paid. The approvement request will be sent to nbeac admin. </p>
                                          </li>
                                          <li><h5>Fill all the required forms</h5>
                                              <p>All the registration forms are required to submit before apply for registration. fill all the required form from strategic management to Faculty Information. </p>
                                          </li>

                                          <li><h5>Apply for registratoin</h5>
                                              <p>Apply for registration. when complete required forms from strategic management to Faculty Information. A registration requiest will be sent to NBEAC Admin. </p>
                                          </li>
                                      </ol>


                                  </div>
                              </div>
                              <!-- /.col -->
                              <div class="col-md-4">
                                  <p class="text-center">
                                      <strong>Registration Completion</strong>
                                  </p>

                                  <div class="progress-group">
                                      <span class="progress-text">Invoice</span>
                                      <span class="progress-number"><b>100</b>/100</span>

                                      <div class="progress sm">
                                          <div class="progress-bar progress-bar-green" style="width: 100%"></div>
                                      </div>
                                  </div>
                                  <!-- /.progress-group -->
                                  <div class="progress-group">
                                      <span class="progress-text">Registration Forms</span>
                                      <span class="progress-number"><b>80</b>/100</span>

                                      <div class="progress sm">
                                          <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                                      </div>
                                  </div>
                                  <!-- /.progress-group -->
                                  <div class="progress-group">
                                      <span class="progress-text">Eligibility Screening</span>
                                      <span class="progress-number"><b>50</b>/100</span>

                                      <div class="progress sm">
                                          <div class="progress-bar progress-bar-red" style="width: 50%"></div>
                                      </div>
                                  </div>
                                  <!-- /.progress-group -->
                                  <div class="progress-group">
                                      <span class="progress-text">Mentoring</span>
                                      <span class="progress-number"><b>0</b>/100</span>

                                      <div class="progress sm">
                                          <div class="progress-bar progress-bar-yellow" style="width: 0%"></div>
                                      </div>
                                  </div>
                                  <!-- /.progress-group -->
                              </div>
                              <!-- /.col -->
                          </div>
                          <!-- /.row -->
                      </div>
                  </div>
                  <!-- /.box -->
              </div>
              <!-- /.col -->
          </div>
          <!--Invoices list-->
      </section>
      <section class="col-lg-12 connectedSortable">

          <!-- TO DO List -->
          <div class="box box-primary">
              <div class="box-header">
                  <h3 class="box-title">Business school Invoices. </h3>
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                      </button>
                      <div class="btn-group">
                          <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-file-pdf-o"></i></button>
                      </div>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                  </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">


                  <table id="datatable5" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                          <th>Business School Name</th>
                          <th>Campus</th>
                          <th>Department</th>
{{--                          <th>Invoice Slip</th>--}}
{{--                          <th>Account Type</th>--}}
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      </thead>

                      <tbody>

                      @foreach($invoices as $invoice_re)
                          <tr>
                              <td>{{@$invoice_re->school}}</td>
                              <td>{{@$invoice_re->campus??'Main Campus'}}</td>
                              <td>{{@$invoice_re->department}}</td>
{{--                              <td><a href="{{@$invoice_re->slip}}">Invoice Slip</a></td>--}}
                              {{--                            <td>{{$invoice->user_type === 'peer_review'?'Peer Review':"Business School"}}</td>--}}
                              <td><i class="badge" data-id="{{@$invoice_re->id}}"  style="background: {{$invoice_re->regStatus == 'Initiated'?'red':''}}{{$invoice_re->regStatus == 'Review'?'brown':''}}{{$invoice_re->regStatus == 'Approved'?'green':''}}" >{{@$invoice_re->regStatus != ''?ucwords($invoice_re->regStatus):'Initiated'}}</i></td>
                              <td>@if($invoice_re->regStatus =='Initiated') <button class="btn-xs btn-info apply" name="apply" id="apply" data-id="{{@$invoice_re->id}}" data-row="{{@$invoice_re->department_id}}"> Apply Now </button>  @elseif($invoice_re->regStatus =='Review')Desk Review In-progress @endif</td>
                          </tr>
                      @endforeach

                      </tbody>
                      <tfoot>
                      <tr>
                          <th>Business School Name</th>
                          <th>Campus</th>
                          <th>Department</th>
{{--                          <th>Invoice Slip</th>--}}
                          {{-- <th>Account Type</th>--}}
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      </tfoot>
                  </table>

                  <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              </div>
              <!-- /.box-body -->

          </div>
          <!-- /.box -->

      </section>
      <!-- right col -->
        @endhasrole


  @hasrole('ESScheduler')
      <!--Invoices list-->
      <section class="col-lg-12 connectedSortable">
          <!-- TO DO List -->
          <div class="box box-primary">
              <div class="box-header">
                  <h3 class="box-title">Business school Registrations Eligibility Screening. </h3>
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                      </button>
                      <div class="btn-group">
                          <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-file-pdf-o"></i></button>
                      </div>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                  </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">


                  <table id="datatable6" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                          <th>Business School Name</th>
                          <th>Campus</th>
                          <th>Department</th>
                          <th>Desk Review</th>
                          <th>Registration Print</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      </thead>

                      <tbody>

                      @foreach($eligibility_registrations as $screening)
                          <tr>
                              <td>{{@$screening->school}}</td>
                              <td>{{@$screening->campus??'Main Campus'}}</td>
                              <td>{{@$screening->department}}</td>
                              <td><a href="{{url('deskreview')}}/{{@$screening->id}}">Desk Review</a></td>
{{--                              <a href="?cid=print<?php echo $school->campusID; ?>&bid=<?php echo $school->id; ?>">Print</a>--}}
                              <td><a href="{{url('registrationPrint?cid=')}}{{@$screening->business_school_id}}&bid={{$screening->id}}">Registration Print </a></td>

                              {{--<td>{{$invoice->user_type === 'peer_review'?'Peer Review':"Business School"}}</td>--}}
                              <td><i class="badge" data-id="{{@$screening->id}}"  style="background: {{$screening->regStatus == 'Initiated'?'red':''}}{{$screening->regStatus == 'Review'?'brown':''}}{{$screening->regStatus == 'Approved'?'green':''}}" >{{@$screening->regStatus != ''?ucwords($screening->regStatus):'Initiated'}}</i></td>
                              <td>@if($screening->regStatus =='Eligibility' || $screening->regStatus =='ScheduledES')
                                      <a href="{{url('esScheduler')}}/{{$screening->id}}" class="btn-xs btn-info apply" name="Schedule" id="schedule" data-id="{{@$screening->id}}" data-row="{{@$screening->department_id}}">Eligibility Screening Calendar</a>
                                  @elseif($screening->regStatus =='Review')Desk Review In-progress @endif

                              </td>
                          </tr>
                      @endforeach

                      </tbody>
                      <tfoot>
                      <tr>
                          <th>Business School Name</th>
                          <th>Campus</th>
                          <th>Department</th>
                          <th>Desk Review</th>
                          <th>Registration Print</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      </tfoot>
                  </table>
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </section>
      <!-- right col -->
        @endhasrole

  @hasrole('PeerReviewer')
      <!--Invoices list-->
      <section class="col-lg-12 connectedSortable">
          <!-- TO DO List -->
          <div class="box box-primary">
              <div class="box-header">
                  <h3 class="box-title">Business school Registrations Eligibility Screening. </h3>
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                      </button>
                      <div class="btn-group">
                          <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-file-pdf-o"></i></button>
                      </div>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                  </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <table id="datatable7" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                          <th>Business School Name</th>
                          <th>Campus</th>
                          <th>Department</th>
                          <th>Desk Review</th>
                          <th>Registration Print</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      </thead>

                      <tbody>
                      @foreach($eligibility_screening as $screening)
                          <tr>
                              <td>{{@$screening->school}}</td>
                              <td>{{@$screening->campus??'Main Campus'}}</td>
                              <td>{{@$screening->department}}</td>
                              <td><a href="{{url('deskreview')}}/{{@$screening->id}}">Desk Review</a></td>
{{--                              <a href="?cid=print<?php echo $school->campusID; ?>&bid=<?php echo $school->id; ?>">Print</a>--}}
                              <td><a href="{{url('print?cid=')}}{{@$screening->business_school_id}}&bid={{$screening->id}}">Registration Print </a></td>
                              {{--<td>{{$invoice->user_type === 'peer_review'?'Peer Review':"Business School"}}</td>--}}
                              <td><i class="badge" data-id="{{@$screening->id}}"  style="background: {{$screening->regStatus == 'Initiated'?'red':''}}{{$screening->regStatus == 'Review'?'brown':''}}{{$screening->regStatus == 'Approved'?'green':''}}" >{{@$screening->regStatus != ''?ucwords($screening->regStatus):'Initiated'}}</i></td>
                              <td>@if($screening->regStatus =='Eligibility' || $screening->regStatus =='ScheduledES' )
                                      <a href="{{url('esScheduler')}}/{{$screening->id}}" class="btn-xs btn-info apply" name="Schedule" id="schedule" data-id="{{@$screening->id}}" data-row="{{@$screening->department_id}}"> Eligibility Screening Calendar</a>
                                  @elseif($screening->regStatus =='Review')Desk Review In-progress @endif
                                  <a href="{{url('esReport')}}/{{$screening->id}}" class="btn-xs btn-success report" name="report" id="report" >Eligibility Report</a>
                              </td>
                          </tr>
                      @endforeach

                      </tbody>
                      <tfoot>
                      <tr>
                          <th>Business School Name</th>
                          <th>Campus</th>
                          <th>Department</th>
                          <th>Desk Review</th>
                          <th>Registration Print</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      </tfoot>
                  </table>

                  <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              </div>
              <!-- /.box-body -->

          </div>
          <!-- /.box -->

      </section>
      <!-- right col -->
        @endhasrole

      @hasrole('Mentor|ESScheduler|BusinessSchool')
      <!--Invoices list-->
      <section class="col-lg-12 connectedSortable">
          <!-- TO DO List -->
          <div class="box box-primary">
              <div class="box-header">
                  <h3 class="box-title">Business school Registrations Mentoring Meetings. </h3>
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                      </button>
                      <div class="btn-group">
                          <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-file-pdf-o"></i></button>
                      </div>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                  </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <table id="datatable8" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                          <th>Business School Name</th>
                          <th>Campus</th>
                          <th>Department</th>
                          <th>Desk Review</th>
                          <th>Registration Print</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      </thead>

                      <tbody>
                      @foreach($MentoringMeetings as $mentorMeeting)
                          <tr>
                              <td>{{@$mentorMeeting->school}}</td>
                              <td>{{@$mentorMeeting->campus??'Main Campus'}}</td>
                              <td>{{@$mentorMeeting->department}}</td>
                              <td><a href="{{url('deskreview')}}/{{@$mentorMeeting->id}}">Desk Review</a></td>
{{--                              <a href="?cid=print<?php echo $school->campusID; ?>&bid=<?php echo $school->id; ?>">Print</a>--}}
                              <td><a href="{{url('registrationPrint?cid=')}}{{@$mentorMeeting->campus_id}}&bid={{@$mentorMeeting->business_school_id}}">Registration Print </a></td>
                              {{--<td>{{$invoice->user_type === 'peer_review'?'Peer Review':"Business School"}}</td>--}}
                              <td><i class="badge" data-id="{{@$mentorMeeting->id}}"  style="background: {{$mentorMeeting->regStatus == 'Initiated'?'red':''}}{{$mentorMeeting->regStatus == 'Review'?'brown':''}}{{$mentorMeeting->regStatus == 'Approved'?'green':''}}" >{{@$mentorMeeting->regStatus != ''?ucwords($mentorMeeting->regStatus):'Initiated'}}</i></td>
                              <td>@if($mentorMeeting->regStatus =='ScheduledMentoring' || $mentorMeeting->regStatus =='ScheduledES' || $mentorMeeting->regStatus =='Mentoring' )
                                      <a href="{{url('meetingsList')}}/{{$mentorMeeting->id}}" class="btn-xs btn-info"> Mentoring Meeting Calendar</a>
                                  @elseif($mentorMeeting->regStatus =='Review')Desk Review In-progress @endif
                              </td>
                          </tr>
                      @endforeach

                      </tbody>
                      <tfoot>
                      <tr>
                          <th>Business School Name</th>
                          <th>Campus</th>
                          <th>Department</th>
                          <th>Desk Review</th>
                          <th>Registration Print</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      </tfoot>
                  </table>

                  <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              </div>
              <!-- /.box-body -->

          </div>
          <!-- /.box -->

      </section>
      <!-- right col -->
        @endhasrole

      @hasrole('NbeacFocalPerson|ESScheduler|BusinessSchool')
      <!--Invoices list-->
      <section class="col-lg-12 connectedSortable">
          <!-- TO DO List -->
          <div class="box box-primary">
              <div class="box-header">
                  <h3 class="box-title">Peer Review Visit. </h3>
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                      </button>
                      <div class="btn-group">
                          <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-file-pdf-o"></i></button>
                      </div>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                  </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <table id="datatable9" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                          <th>Business School Name</th>
                          <th>Campus</th>
                          <th>Department</th>
                          <th>Desk Review</th>
                          <th>Registration Print</th>
                          <th>SAR</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      </thead>

                      <tbody>
                      @foreach(@$PeerReviewVisit as $slip)
                          <tr>
                              <td>{{@$slip->school}}</td>
                              <td>{{@$slip->campus??'Main Campus'}}</td>
                              <td>{{@$slip->department}}</td>
                              <td><a href="{{url('deskreview')}}/{{@$slip->id}}">Desk Review</a></td>
                              {{--<a href="?cid=print<?php echo $school->campusID; ?>&bid=<?php echo $school->id; ?>">Print</a>--}}
                              <td><a href="{{url('registrationPrint?cid=')}}{{@$slip->campus_id}}&bid={{@$slip->business_school_id}}">Registration Print </a></td>
                              <td><a class="badge bg-maroon" href="print?cid={{$slip->campus_id}}&bid={{$slip->business_school_id}}">SAR</a></td>
                              <td><i class="badge" data-id="{{@$slip->id}}"  style="background: {{$slip->regStatus == 'Initiated'?'red':''}}{{$slip->regStatus == 'Review'?'brown':''}}{{$slip->regStatus == 'Approved'?'green':''}}" >{{@$slip->regStatus != ''?ucwords($slip->regStatus):'Initiated'}}</i></td>
                              <td>
                                  @if(@$slip->regStatus =='ScheduledPRVisit' || @$slip->regStatus =='PeerReviewVisit' )
                                      <a href="{{url('showOnCalendar')}}/{{@$slip->id}}" class="btn-xs btn-info"> Peer Reviewer Visit Calendar <i class="fa fa-calendar"></i></a><br>
                                  @elseif(@$slip->regStatus =='Review')Desk Review In-progress @endif
                                  @hasrole('NbeacFocalPerson|NBEACAdmin')
                                  <a data-id="{{@$slip->id}}" data-toggle="modal" data-target="#TravelPlane-modal" class="btn-xs bg-aqua TravelPlane" style="cursor: pointer">Generate Travel Plan <i class="fa fa-car"></i></a><br>
                                  <a data-id="{{@$slip->id}}" data-toggle="modal" data-target="#profileSheet-modal" class="btn-xs btn-primary profileSheet" style="cursor: pointer">Upload Profile Sheet <i class="fa fa-file-excel-o"></i></a> <br>
                                  <a data-id="{{@$slip->id}}" data-toggle="modal" data-target="#thankyou-modal" class="btn-xs bg-maroon thankyou" style="cursor: pointer">Thank You Email <i class="fa fa-envelope"></i></a>
                                  @endhasrole
                                  @hasrole('BusinessSchool')
                                      <a data-id="{{@$slip->id}}" data-toggle="modal" data-target="#feedback-modal" class="btn-xs btn-primary feedback" style="cursor: pointer">Institutional Feedback Form<i class="fa fa-backward"></i></a> <br>
                                  @endhasrole
                                  {{--'{"id":"{{$affiliation->id}}",--}}
                              </td>
                          </tr>
                      @endforeach

                      </tbody>
                      <tfoot>
                      <tr>
                          <th>Business School Name</th>
                          <th>Campus</th>
                          <th>Department</th>
                          <th>Desk Review</th>
                          <th>Registration Print</th>
                          <th>SAR</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      </tfoot>
                  </table>

                  <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              </div>
              <!-- /.box-body -->

          </div>
          <!-- /.box -->

      </section>
      <!-- right col -->
        @endhasrole


      <div class="modal fade" id="TravelPlane-modal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Generate Travel Plane to the focal person and peers. </h4>
                  </div>
                  <form role="form" id="visit-form" enctype="multipart/form-data" >
                      <div class="modal-body">
                          <div class="col-md-12">
                             <h4>Visit Confirm Data is : <span id="confirm_date"></span></h4>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="name">Select Visit Date</label>
                                  <div class="input-group">
                                      <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" id="visit_date" name="visit_date" value="{{@old('visit_date')}}" class="form-control">
                                      <input type="hidden" id="slip_id" name="slip_id">
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
                              <label>Travel Plan File </label>
                              <input type="file" name="file" id="file">
                              @if(!empty(@$travel_plan->pr_travel_plan))
                              <a href="#" class="badge bg-maroon" id="fileName">Download Travel Plan File</a>
                              @endif
                          </div>
                          </div>

                          @if(!empty(@$travel_plan->pr_travel_plan))
                          <div class="col-md-12">
                          <div class="form-group">
                              <label>Status </label>
                             <span class="badge bg-green" style="margin-top: 10px">Travel plan already sent</span>
                          </div>
                          </div>
                          @endif
                          <!-- /.form group -->

                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <input type="submit" name="submit" id="submit" class="btn btn-info" value="submit">
                      </div>
                  </form>
              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>

       <div class="modal fade" id="feedback-modal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Upload feedback form. </h4>
                  </div>
                  <form role="form" id="feedback-form" enctype="multipart/form-data" >
                      <div class="modal-body">
                          <div class="col-md-12">
                              <input type="hidden" id="feedback_slip_id" name="slip_id">
                          @if(!empty(@$travel_plan->feedback_last_date))<h4>Feedback Last Date: {{@$travel_plan->feedback_last_date}}</h4>@endif
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Feedback File </label>
                                  <input type="file" name="file" id="feedback">
                                  @if(!empty(@$feedbacks->file))
                                  <a href="{{@$feedbacks->file}}" class="badge bg-maroon" style="margin-top: 20px">Download Feedback File</a>
                                  @endif
                              </div>
                          </div>

                          @if(!empty(@$feedbacks->file))
                          <div class="col-md-6">
                              <div class="form-group" style="margin-bottom: 55px;">
                                  <label>Status </label>
                                 <span class="badge bg-green" style="margin-top: 10px">Feedback already uploaded.</span>
                              </div>
                          </div>
                          @endif
                          <!-- /.form group -->

                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <input type="submit" name="submit" id="submit" class="btn btn-info" value="submit">
                      </div>
                  </form>
              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="profileSheet-modal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Conduct peer review visit. Fill the profile Sheet and upload here. </h4>
                  </div>
                  <form role="form" id="sheet-form" enctype="multipart/form-data" >
                      <div class="modal-body">
                          <input type="hidden" id="sheet_slip_id" name="slip_id">

                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Profile Sheet </label>
                                  <input type="file" name="file" id="sheet">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group" style="margin-top: 24px">
                                  @if(!empty(@$travel_plan->profile_sheet))
                                      <a href="#" class="badge bg-maroon" id="profile_sheet">Download Profile sheet.</a>
                                  @endif
                              </div>
                          </div>

                          @if(!empty(@$travel_plan->profile_sheet))
                          <div class="col-md-12">
                          <div class="form-group">
                              <label>Status </label>
                             <span class="badge bg-green" style="margin-top: 10px">Profile sheet already uploaded</span>
                          </div>
                          </div>
                          @endif
                          <!-- /.form group -->

                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <input type="submit" name="submit" class="btn btn-info" value="submit">
                      </div>
                  </form>
              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>


      <!-- /.content -->
  </div>



<script src="{{URL::asset('notiflix/notiflix-2.3.2.min.js')}}"></script>

{{--<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.js"></script>--}}
@include("includes.footer")
 @else
{{"Login to Access this page"}}
<script type="text/javascript">window.location.replace('login');</script>

 @endif
<!-- Morris.js charts -->
{{--<script src="bower_components/raphael/raphael.min.js"></script>--}}
{{--<script src="bower_components/morris.js/morris.min.js"></script>--}}
<!-- Sparkline -->
{{--<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>--}}
<!-- jvectormap -->
{{--<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>--}}
{{--<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>--}}
<!-- jQuery Knob Chart -->
{{--<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>--}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="dist/js/pages/dashboard.js"></script>--}}

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="{{URL::asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script>
    $('#visit_date').datepicker({
        autoclose:true,
        format:'yyyy-mm-dd'
    });
</script>
<script>
    $(document).ready( function () {
    $('#datatable1').DataTable();
    $('#datatable2').DataTable();
    $('#datatable3').DataTable();
    $('#datatable4').DataTable();
    $('#datatable5').DataTable();
    $('#datatable6').DataTable();
    $('#datatable7').DataTable();
    $('#datatable8').DataTable();
    $('#datatable9').DataTable();
} );

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $('.TravelPlane').on('click', function () {
        let id = $(this).data('id');
        $('#slip_id').val(id);

        $.ajax({
            url:'{{url("getInvoice")}}/'+id,
            type:'get',
            // data: { get:'get'},
            beforeSend: function(){
                Notiflix.Loading.Pulse('Processing...');
            },
            // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
            success: function (response) {
                Notiflix.Loading.Remove();
                let data = JSON.parse(JSON.stringify(response));
                console.log("success resp ",data);
                console.log('pr date value',data.pr_visit_date);
                $('#confirm_date').text(data.confirm_date);
                $('#fileName').attr('href',data.pr_travel_plan);

                $("#visit_date").datepicker("setDate", data.pr_visit_date);

                // $('#visit_date').val(data.pr_visit_date);
                // if(response.success){
                //     Notiflix.Notify.Success(response.success);
                // }

                // location.reload();

                console.log('response here', response);
            },
            error:function(response, exception){
                Notiflix.Loading.Remove();
                $.each(response.responseJSON, function (index, val) {
                    Notiflix.Notify.Failure(val);
                })

            }
        })

        console.log('show modal .....');
    })

    $('.feedback').on('click', function () {
        let id = $(this).data('id');
        $('#feedback_slip_id').val(id);

        $.ajax({
            url:'{{url("instituteFeedback")}}/'+id,
            type:'get',
            // data: { get:'get'},
            beforeSend: function(){
                Notiflix.Loading.Pulse('Processing...');
            },
            // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
            success: function (response) {
                Notiflix.Loading.Remove();
                let data = JSON.parse(JSON.stringify(response));
                console.log("success resp ",data);
                console.log('pr date value',data.pr_visit_date);
                $('#confirm_date').text(data.confirm_date);
                $('#fileName').attr('href',data.pr_travel_plan);

                $("#visit_date").datepicker("setDate", data.pr_visit_date);

                // $('#visit_date').val(data.pr_visit_date);
                // if(response.success){
                //     Notiflix.Notify.Success(response.success);
                // }

                // location.reload();

                console.log('response here', response);
             },
            error:function(response, exception){
                Notiflix.Loading.Remove();
                // $.each(response.responseJSON, function (index, val) {
                //     Notiflix.Notify.Failure(val);
                // })

            }
        })

        console.log('show modal .....');
    })

    $('.profileSheet').on('click', function () {
        let id = $(this).data('id');
        $('#sheet_slip_id').val(id);

        $.ajax({
            url:'{{url("getInvoice")}}/'+id,
            type:'get',
            // data: { get:'get'},
            beforeSend: function(){
                Notiflix.Loading.Pulse('Processing...');
            },
            // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
            success: function (response) {
                Notiflix.Loading.Remove();
                let data = JSON.parse(JSON.stringify(response));
                console.log("success resp ",data);
                console.log('pr date value',data.pr_visit_date);
                $('#profile_sheet').attr('href',data.profile_sheet);

                // $('#visit_date').val(data.pr_visit_date);
                // if(response.success){
                //     Notiflix.Notify.Success(response.success);
                // }

                // location.reload();

                console.log('response here', response);
            },
            error:function(response, exception){
                Notiflix.Loading.Remove();
                $.each(response.responseJSON, function (index, val) {
                    Notiflix.Notify.Failure(val);
                })

            }
        })

        console.log('show modal .....');
    })

    $('#visit-form').on('submit', function (e) {
        var visit_date = $('#visit_date').val();
        let file = $('#file').val();
        let slip_id = $('#slip_id').val();
        e.preventDefault();
        !visit_date?addClass('visit_date'):removeClass('visit_date');
        !file?addClass('file'):removeClass('file');

        if(!visit_date || !slip_id )
        {
            Notiflix.Notify.Warning("Fill all the required Fields.");
            return;
        }
                // Yes button callback
                 var formData = new FormData(this);
                $.ajax({
                    url:'{{url("travelPlan")}}',
                    type:'POST',
                    cache:false,
                    contentType:false,
                    processData:false,
                    data: formData,
                    beforeSend: function(){
                        Notiflix.Loading.Pulse('Processing...');
                    },
                    // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
                    success: function (response) {
                        Notiflix.Loading.Remove();
                        console.log("success resp ",response.success);
                        if(response.success){
                            Notiflix.Notify.Success(response.success);
                        }

                        location.reload();

                        console.log('response here', response);
                    },
                    error:function(response, exception){
                        Notiflix.Loading.Remove();
                        $.each(response.responseJSON, function (index, val) {
                            Notiflix.Notify.Failure(val);
                        })

                    }
                })
    });

    $('#sheet-form').on('submit', function (e) {
        let file = $('#sheet').val();
        let slip_id = $('#sheet_slip_id').val();
        e.preventDefault();
        !file?addClass('sheet'):removeClass('sheet');

        if( !slip_id )
        {
            Notiflix.Notify.Warning("Fill all the required Fields.");
            return;
        }
                // Yes button callback
                 var formData = new FormData(this);
                $.ajax({
                    url:'{{url("profileSheet")}}',
                    type:'POST',
                    cache:false,
                    contentType:false,
                    processData:false,
                    data: formData,
                    beforeSend: function(){
                        Notiflix.Loading.Pulse('Processing...');
                    },
                    // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
                    success: function (response) {
                        Notiflix.Loading.Remove();
                        console.log("success resp ",response.success);
                        if(response.success){
                            Notiflix.Notify.Success(response.success);
                        }

                        location.reload();

                        console.log('response here', response);
                    },
                    error:function(response, exception){
                        Notiflix.Loading.Remove();
                        $.each(response.responseJSON, function (index, val) {
                            Notiflix.Notify.Failure(val);
                        })

                    }
                })
    });

    $('#feedback-form').on('submit', function (e) {
        let file = $('#feedback').val();
        let slip_id = $('#feedback_slip_id').val();
        e.preventDefault();
        !file?addClass('sheet'):removeClass('sheet');

        if( !slip_id )
        {
            Notiflix.Notify.Warning("Fill all the required Fields.");
            return;
        }
                // Yes button callback
                 var formData = new FormData(this);
                $.ajax({
                    url:'{{url("instituteFeedback")}}',
                    type:'POST',
                    cache:false,
                    contentType:false,
                    processData:false,
                    data: formData,
                    beforeSend: function(){
                        Notiflix.Loading.Pulse('Processing...');
                    },
                    // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
                    success: function (response) {
                        Notiflix.Loading.Remove();
                        console.log("success resp ",response.success);
                        if(response.success){
                            Notiflix.Notify.Success(response.success);
                        }

                        location.reload();

                        console.log('response here', response);
                    },
                    error:function(response, exception){
                        Notiflix.Loading.Remove();
                        $.each(response.responseJSON, function (index, val) {
                            Notiflix.Notify.Failure(val);
                        })

                    }
                })
    });



</script>
    @hasrole('NBEACAdmin')
    <script>
    $('.status').on('click', function (e) {
        var id = $(this).data('id');

        Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to activate?', 'Yes', 'No',
            function(){
                // Yes button callback
                $.ajax({
                    url:'{{url("admin")}}/'+id,
                    type:'PATCH',
                    data: { id:id},
                    beforeSend: function(){
                        Notiflix.Loading.Pulse('Processing...');
                    },
                    // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
                    success: function (response) {
                        Notiflix.Loading.Remove();
                        console.log("success resp ",response.success);
                        if(response.success){
                            Notiflix.Notify.Success(response.success);
                        }

                        location.reload();

                        console.log('response here', response);
                    },
                    error:function(response, exception){
                        Notiflix.Loading.Remove();
                        $.each(response.responseJSON, function (index, val) {
                            Notiflix.Notify.Failure(val);
                        })

                    }
                })
            },
            function(){ // No button callback
                // alert('If you say so...');
            } );
    });

</script>



@endhasrole

@hasrole('BusinessSchool')
<script>
    $('.apply').on('click', function (e) {
        var id = $(this).data('id');
        var department_id = $(this).data('row');
        //
        // console.log('depaertid ', department_id);
        // return;
        Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to Apply?', 'Yes', 'No',
            function(){
                // Yes button callback
                $.ajax({
                    url:'{{url("registration-apply")}}/'+id,
                    type:'patch',
                    data: { id:id, department_id:department_id},
                    beforeSend: function(){
                        Notiflix.Loading.Pulse('Processing...');
                    },
                    // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
                    success: function (response) {
                        Notiflix.Loading.Remove();
                        console.log("success resp ",response.success);
                        if(response.success){
                            Notiflix.Notify.Success(response.success);
                        }

                        location.reload();

                        console.log('response here', response);
                    },
                    error:function(response, exception){
                        Notiflix.Loading.Remove();
                        $.each(response.responseJSON, function (index, val) {
                            Notiflix.Notify.Failure(val);
                        })

                    }
                })
            },
            function(){ // No button callback
                // alert('If you say so...');
            } );
    })
</script>

@endhasrole

