@section('pageTitle', 'Dashboard')

@if(Auth::user())


    @include("includes.head")
    <!-- Morris chart -->
    <link rel="stylesheet" href="bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
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


        @hasrole('NBEACAdmin')
        <section class="content">

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

                <!--Registrations list-->
                <section class="col-lg-12 connectedSortable">
                    <!-- TO DO List -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Business school Department Registrations. </h3>
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
                                    <th>Department</th>
                                    <th>Contact Person Name</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Files</th>
                                    <th>Desk Review</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($registrations as $regist)
                                    <tr>
                                        <td>{{@$regist->school}}</td>
                                        <td>{{@$regist->campus??'Main Campus'}}</td>
                                        <td>{{@$regist->department}}</td>
                                        <td>{{@$regist->user}}</td>
                                        <td>{{@$regist->contact_no}}</td>
                                        <td>{{@$regist->email}}</td>
                                        <td><a href="{{url('reg-files/?cid=')}}{{$regist->business_school_id}}/&did={{@$regist->department_id}}"><i class="fa fa-file text-green" ></i></a></td>
                                        <td><a href="{{url('deskreview')}}/{{@$regist->id}}">Click to Review</a></td>
                                        {{--<td>{{$regist->user_type === 'peer_review'?'Peer Review':"Business School"}}</td>--}}
                                        <td><i style="cursor: default" class="badge {{$regist->regStatus == 'Review'?'bg-red':''}}" >{{$regist->regStatus != ''?ucwords($regist->regStatus):'created'}}</i></td>
                                        <td><i class="fa fa-trash text-info"></i> | <i class="fa fa-pencil text-blue" id="edit"></i> </td>
                                    </tr>

                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Business School Name</th>
                                    <th>Campus</th>
                                    <th>Department</th>
                                    <th>Contact Person Name</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    {{--                                <th>Invoice Slip</th>--}}
                                    <th>Desk Review</th>
                                    <th>Status</th>
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

        <!-- /.content -->
    </div>



    <script src="{{URL::asset('notiflix/notiflix-2.3.2.min.js')}}"></script>

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
@hasrole('NBEACAdmin')
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
    });


</script>

@endhasrole
