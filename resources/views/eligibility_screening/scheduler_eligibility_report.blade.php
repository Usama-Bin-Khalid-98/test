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
            </ol>
        </section><!-- Main content -->

        @hasrole('ESScheduler|NBEACAdmin|Mentor')
        <section class="content">

            <div class="row" >
                <!-- /.Left col -->
                <!--Registrations list-->
                <section class="col-lg-12 connectedSortable">
                    <!-- TO DO List -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Eligibility Screening Reports </h3>
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
                                    <th>PDF</th>
                                    <th>Status</th>
                                   <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($registrations_reports as $screening)
                                    <tr>
                                        <td>{{@$screening->school}}</td>
                                        <td>{{@$screening->campus??'Main Campus'}}</td>
                                        <td>{{@$screening->department}}</td>
                                         <td> @if($screening->file)<a href="{{url($screening->file)}}" download> <i class="fa fa-file-pdf-o"></i> Letter </a>@endif</td>
                                        <td><i class="badge" data-id="{{@$screening->id}}"  style="background: {{$screening->regStatus == 'Initiated'?'red':''}}{{$screening->regStatus == 'Review'?'brown':''}}{{$screening->regStatus == 'Approved'?'green':''}}" >{{@$screening->regStatus != ''?ucwords($screening->regStatus):'Initiated'}}</i></td>
                                        <td><span title="Eligibility Comments" data-toggle="tooltip"> <i class="fa fa-list details" data-id="{{str_replace(array("\r\n", "\r", "\n"), "", $screening->comments)}}" data-toggle="modal" data-row='{"id":"{{$screening->report_id}}","school":"{{$screening->school}}","campus":"{{$screening->campus}}","department":"{{$screening->department}}","file":"{{$screening->file}}"}' data-target="#detail-modal"></i> </span></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Business School Name</th>
                                    <th>Campus</th>
                                    <th>Department</th>
                                    <th>PDF</th>
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

    <div class="modal fade" id="detail-modal">
        <div class="modal-dialog" style="width: 900px">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Eligibility Report Details. </h4>
                </div>
                <form role="form" id="updateForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="modal-header">
                            <p>University Name: <span id="uni-name"></span></p>
                            <input type="hidden" id="report">
                            <p>Campus: <span id="campus-name"></span></p>
                            <p>Department: <span id="department-name"></span></p>
{{--                            <p>University Name: <span id="uni-name"></span></p>--}}
                        </div>
                        <h4>Peer Reviewer Report</h4>
                        @hasrole('ESScheduler|NBEACAdmin')<textarea id="comments"></textarea>@endhasrole
                        @hasrole('Mentor') <p id="show-comments"></p>@endhasrole

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        @hasrole('ESScheduler|NBEACAdmin')<button type="button" class="btn btn-success FRtoBusinessSchool" data-id='email'>Email To BS Admin & generate pdf</button>
                        <button type="button" class="btn btn-info FRtoBusinessSchool" data-id="pdf">Generate pdf</button>@endhasrole
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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

<script>
    $('.details').on('click', function () {
        let data = JSON.parse(JSON.stringify($(this).data('row')));
        let comment = JSON.parse(JSON.stringify($(this).data('id')));
        $('#uni-name').text(data.id);
        $('#uni-name').text(data.school);
        $('#campus-name').text(data.campus);
        $('#report').val(data.id);
        $('#department-name').text(data.department);
        console.log('data', comment);
        @hasrole('ESScheduler|NBEACAdmin')
        CKEDITOR.instances.comments.setData(comment);
        @endhasrole
        @hasrole('Mentor')
        $('#show-comments').html(comment);
        @endhasrole
    });
    $('.select2').select2();
    CKEDITOR.replace('comments',
        {
            height: '500px'
        });
</script>
@hasrole('ESScheduler|NBEACAdmin')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })


    $('.FRtoBusinessSchool').on('click', function () {
        let comments = CKEDITOR.instances.comments.getData();
        let id = $('#report').val();
        let type = $(this).data('id');
        // console.log('commemts here ',comments);
        // return
        $.ajax({
            url:'{{url('esReportToBusinessSchool')}}',
            type:'POST',
            data:{id:id, comments:comments,type:type},
            beforeSend:function() {
                // Notiflix.loading.Pulse('Processing...');
                Notiflix.Loading.Pulse('Processing...');
            },
            success: function (response) {
                Notiflix.Loading.Remove();
                $('#detail-modal').modal('hide');
                console.log('response here', response)
            },
            error: function () {
                Notiflix.Notify.Failure('Something went wrong.')
            }
        })
    })
</script>

@endhasrole
