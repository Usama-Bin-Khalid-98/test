@section('pageTitle', 'Dashboard')

@if(Auth::user())


@include("includes.head")
<!-- Morris chart -->
<link rel="stylesheet" href="bower_components/morris.js/morris.css">
<!-- jvectormap -->
<link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
<!--===============================================================================================-->
<link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />
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
                    <h3 class="box-title">Business school registration Requests. </h3>
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


                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Business School Name</th>
                            <th>Contact Person Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Invoice Slip</th>
                            <th>Account Type</th>
                            <th>Status</th>
{{--                            <th>Action</th>--}}
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($registrations as $user)
                        <tr>
                            <td>{{$user->business_school->name}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->contact_no}}</td>
                            <td>{{$user->email}}</td>
                            <td><a href="{{$user->business_school->slip[0]->slip}}">Invoice Slip</a></td>
                            <td>{{$user->user_type}}</td>
                            <td><i class="badge {{$user->status=='disabled'?'bg-red':''}} status" data-id="{{$user->id}}" style="background: red" >Disabled</i></td>
{{--                            <td><i class="fa fa-trash text-info"></i> | <i class="fa fa-pencil text-blue" id="edit"></i> </td>--}}
                        </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Business School Name</th>
                            <th>Contact Person Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Invoice Slip</th>
                            <th>Account Type</th>
                            <th>Status</th>
{{--                            <th>Action</th>--}}
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
<<<<<<< HEAD

          <!--Invoices list-->
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


                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Business School Name</th>
                            <th>Campus</th>
                            <th>Contact Person Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Invoice Slip</th>
{{--                            <th>Account Type</th>--}}
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($invoices as $invoice)
                        <tr>
<<<<<<< HEAD
                            <td>{{$invoice->business_school->name}}</td>
                            <td>{{$invoice->campus->location??'Main Campus'}}</td>
                            <td>{{$invoice->business_school->user->name}}</td>
                            <td>{{$invoice->business_school->user->contact_no}}</td>
                            <td>{{$invoice->business_school->user->email}}</td>
=======
                            <td>{{@$invoice->business_school->name}}</td>
                            <td>{{@$invoice->campus->location??'Main Campus'}}</td>
                            <td>{{@$invoice->business_school->user->name}}</td>
                            <td>{{@$invoice->business_school->user->contact_no}}</td>
                            <td>{{@$invoice->business_school->user->email}}</td>
>>>>>>> fb5ba0be3d2c2c24a2617060c6f106a0c26b7269
                            <td><a href="{{@$invoice->slip}}">Invoice Slip</a></td>
{{--                            <td>{{$invoice->user_type === 'peer_review'?'Peer Review':"Business School"}}</td>--}}
                            <td><i class="badge {{$invoice->status == 'inactive'?'bg-red':''}} status" data-id="{{$invoice->id}}" style="background: red" >{{$invoice->status != ''?ucwords($invoice->status):'inactive'}}</i></td>
                            <td><i class="fa fa-trash text-info"></i> | <i class="fa fa-pencil text-blue" id="edit"></i> </td>
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
                            <th>Invoice Slip</th>
{{--                            <th>Account Type</th>--}}
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
=======
>>>>>>> parent of 02f0a6b... Merge branch 'master' of https://gitlab.com/walayatkhan/nbeac into ubaid
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>


<script src="{{URL::asset('notiflix/notiflix-2.3.2.min.js')}}"></script>
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

<script>
    $('.status').on('click', function (e) {
        var id = $(this).data('id');

        Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to activate?', 'Yes', 'No',
            function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
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
    })
</script>
