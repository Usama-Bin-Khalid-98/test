@section('pageTitle', 'Dashboard')

@if(Auth::user())


    @include("includes.head")
    <link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

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
                <li>Mentoring Report</li>
            </ol>
        </section><!-- Main content -->


        @hasrole('BusinessSchool|NBEACAdmin')
        <section class="content">

            <div class="row" >
                <!--Registrations list-->
                <section class="col-lg-12 connectedSortable">
                    <!-- TO DO List -->
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-sticky-note"></i>Note</h4>
                            <ol type="1">
                                <li><h5>Peer Reviewer can't submit Report until the Business school admin pay mentoring fee.</h5></li>
                            </ol>


                        </div>
                </section>
                <!-- right col -->

                <!--Registrations list-->
                <section class="col-lg-12 connectedSortable">
                    <!-- TO DO List -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Mentors Reports </h3>
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
                                    <th>Letter Doc</th>
                                    <th>Peer Reviewer Comments</th>
{{--                                    <th>Status</th>--}}
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($mentor_reports as $report)
                                    <tr>
                                        <td>{{@$report->campus->business_school->name}}</td>
                                        <td>{{@$report->mentoring_report->campus->location??'Main Campus'}}</td>
                                        <td>{{@$report->department->name}}</td>
                                         <td><a href="{{asset(@$report->file)}}" >Doc File</a></td>
                                         <td>{!!substr($report->mentoring_report->comments, 0, 100) !!}...</td>
{{--                                        <td><i class="badge" data-id="{{@$report->id}}"  style="background: {{$report->regStatus == 'Initiated'?'red':''}}{{$screening->regStatus == 'Review'?'brown':''}}{{$screening->regStatus == 'Approved'?'green':''}}" >{{@$report->regStatus != ''?ucwords($report->regStatus):'Initiated'}}</i></td>--}}
                                        <td>
                                            <i class="fa fa-list" data-toggle="modal" data-target="#detail-modal"></i>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Business School Name</th>
                                    <th>Campus</th>
                                    <th>Department</th>
                                    <th>Letter Doc</th>
                                    <th>Peer Reviewer Comments</th>
{{--                                    <th>Status</th>--}}
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

        <div class="modal fade" id="detail-modal">
            <div class="modal-dialog" style="width: 90%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Mentoring Report Details. </h4>
                    </div>
                    <form role="form" id="updateForm" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="modal-header">
                                <p>University Name: <span id="uni-name">{{@$mentor_reports[0]->campus->business_school->name}}</span></p>
                                <input type="hidden" id="report">
                                <p>Campus: <span id="campus-name">{{@$mentor_reports[0]->campus->location}}</span></p>
                                <p>Department: <span id="department-name">{{@$mentor_reports[0]->department->name}}</span></p>
                            </div>
                            <h4>Peer Reviewer Report</h4>
                            <p id="comments">{!!@$report->mentoring_report->comments !!}</p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        @endhasrole

        <!-- /.content -->
    </div>




    <script src="{{URL::asset('notiflix/notiflix-2.3.2.min.js')}}"></script>
    @include("includes.footer")
    <!-- Select2 -->
    <script src="{{URL::asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{URL::asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif

@hasrole('BusinessSchool|NBEACAdmin')
<script>
    $('.select2').select2();

</script>

@endhasrole
