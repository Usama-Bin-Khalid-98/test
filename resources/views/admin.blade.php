@section('pageTitle', 'Dashboard')

@if(Auth::user())


@include("includes.head")
<!-- Morris chart -->
<link rel="stylesheet" href="bower_components/morris.js/morris.css">
<!-- jvectormap -->
<link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
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
                    <i class="ion ion-clipboard"></i>

                    <h3 class="box-title">New Registrations</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">


                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Business School Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Job Title</th>
                            <th>Office Contact</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>Allama Iqbal Open University</td>
                            <td>zaid@gmail.com</td>
                            <td>+923185278733</td>
                            <td>Dean</td>
                            <td>+51878973</td>
                            <td><div class="badge bg-red">Inactive</div></td>
                            <td><i class="fa fa-trash text-info"></i> | <i class="fa fa-pencil text-blue"></i> </td>
                        </tr>
                        <tr>
                            <td>Abasyn University Peshawar</td>
                            <td>zaid@gmail.com</td>
                            <td>+923185278733</td>
                            <td>Dean</td>
                            <td>+51878973</td>
                            <td><div class="badge bg-red">Inactive</div></td>
                            <td><i class="fa fa-trash text-info"></i> | <i class="fa fa-pencil text-blue"></i> </td>
                        </tr>
                        <tr>
                            <td>City University of Science and information Technology</td>
                            <td>zaid@gmail.com</td>
                            <td>+923185278733</td>
                            <td>Dean</td>
                            <td>+51878973</td>
                            <td><div class="badge bg-red">Inactive</div></td>
                            <td><i class="fa fa-trash text-info"></i> | <i class="fa fa-pencil text-blue"></i> </td>
                        </tr>


                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Business School Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Job Title</th>
                            <th>Office Contact</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>

                    <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                    <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
                </div>
            </div>
            <!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>



@include("includes.footer")
 @else
{{"Login to Access this page"}}
<script type="text/javascript">window.location.replace('login');</script>

 @endif
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
