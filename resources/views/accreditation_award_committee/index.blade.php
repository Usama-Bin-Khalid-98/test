@section('pageTitle', 'Dashboard')

@if(Auth::user())


    @include("includes.head")
    <!-- Morris chart -->
    {{--<link rel="stylesheet" href="bower_components/morris.js/morris.css">--}}
    <!-- jvectormap -->
    {{--<link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">--}}
    <link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.1/css/fixedColumns.dataTables.min.css" />


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

        @hasrole('NbeacFocalPerson|ESScheduler|AccreditationAwardCommittee|NBEACAdmin')
        <!--Invoices list-->
        <section class="col-lg-12 connectedSortable">
            <!-- TO DO List -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Accreditation Award Committee . </h3>
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
                    <table id="datatable" class="table table-bordered table-striped">
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
                        @foreach(@$registrations as $slip)
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
                                    @if(@$slip->regStatus =='AwardCommittee' || @$slip->regStatus =='ScheduledAwardCommittee' )
                                        <a href="{{url('aac-showOnCalendar')}}/{{@$slip->id}}" class="btn-xs btn-info" data-toggle="tooltip" data-content="left" title="Accreditation Award Committee meeting calendar"> <i class="fa fa-calendar"></i></a><br>
                                    @elseif(@$slip->regStatus =='CouncilMeeting')Case Forwarded For CouncilMeeting @endif
                                    <a href="{{url('AAwardCommitteeDetails')}}/{{$slip->id}}" data-toggle="tooltip" data-content="left" title="Case complete details of AAC" class="btn-xs bg-aqua" style="cursor: pointer"><i class="fa fa-list"></i></a><br>
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

        <!-- /.content -->
    </div>



    <script src="{{URL::asset('notiflix/notiflix-2.3.2.min.js')}}"></script>

    <!-- <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.js"></script> -->
    @include("includes.footer")
@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        CKEDITOR.replace('comments');
        $('#datatable').DataTable();
    })
</script>
@hasrole('NBEACAdmin|NbeacFocalPerson')
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );

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
