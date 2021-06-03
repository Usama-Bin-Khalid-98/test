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
                Peer Review Report
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
                <li>Peer Review Report</li>
            </ol>
        </section><!-- Main content -->


        @hasrole('NbeacFocalPerson|NBEACAdmin|PeerReviewer')
        <section class="content">

            <div class="row" >
                <!--Registrations list-->
                <section class="col-lg-12 connectedSortable">
                    <!-- TO DO List -->
                    <div class="box box-primary collapsed-box">
                        <div class="box-header">
                            <h3 class="box-title">Read Me! </h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
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
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Notes! </h4>
                                <ol>
                                    <li>Download the sample doc from  <a href="{{url('samples/Sample-Format-Peer-Review-Report.docx')}}">here</a>. </li>
                                    <li>Put all the required data and upload again.  </li>
                                    <li>Send <a href="{{url('samples/Feedback form-Shadow-Participant-at-PRT.docx')}}">shadow feedback</a> form to Chair PRT  </li>
                                    <li>Send PRR to Accreditation Award Committee. </li>
                                </ol>
                            </div>
                        </div>

                    </div>
                    <!-- /.box -->

                </section>

                <section class="col-lg-12 connectedSortable">
                    <!-- TO DO List -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Upload Peer Review Report. </h3>
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
                            <form action="javascript:void(0)" id="form" method="POST" enctype="multipart/form-data">

                                <input type="hidden" name="slip_id" value="{{Request()->route('id')}}">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Report Date</label>
                                        <input type="date" name="report_date" id="report_date" class="form-control" value="{{date('Y-m-d')}}" >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Upload PRR Doc</label>
                                        <input type="file" name="file" id="file" accept=".doc,.docx,application/msword,.pdf">
                                        <span class="text-red">Max upload file size 2mb.</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sample">Download Sample</label><br>
                                        <a href="" class="file"><span href="" class="badge bg-green">Download</span></a>
                                        <input type="hidden" id="prr_id" name="prr_id">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="comments">Comments</label>
                                        <textarea name="comments" id="comments" > </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group pull-right" style="margin-top: 10px">
                                        <label for="sector">&nbsp;&nbsp;</label>
                                        <input type="submit" name="add" id="add" value="Submit" class="btn btn-info">
                                    </div>
                                </div>

                            </form>

                            <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                        </div>

                    </div>
                    <!-- /.box -->

                </section>
                <!-- right col -->

                <section class="col-lg-12 connectedSortable">
                    <!-- TO DO List -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Peer Review Report. </h3>
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
                                    <th>Report Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($registrations as $registration)
                                    <tr>
                                        <td>{{@$registration->school}}</td>
                                        <td>{{@$registration->campus??'Main Campus'}}</td>
                                        <td>{{@$registration->department}}</td>
                                        <td><a href="{{url('deskreview')}}/{{@$registration->id}}">Desk Review</a></td>
                                        {{--<a href="?cid=print<?php echo $school->campusID; ?>&bid=<?php echo $school->id; ?>">Print</a>--}}
                                        <td><a href="{{url('registrationPrint?cid=')}}{{@$registration->campus_id}}&bid={{@$registration->business_school_id}}">Registration Print </a></td>
                                        <td><a class="badge bg-maroon" href="print?cid={{$registration->campus_id}}&bid={{$registration->business_school_id}}">SAR</a></td>
                                        <td><i class="badge" data-id="{{@$registration->id}}"  style="background: {{$registration->regStatus == 'Initiated'?'red':''}}{{$registration->regStatus == 'Review'?'brown':''}}{{$registration->regStatus == 'Approved'?'green':''}}" >{{@$registration->regStatus != ''?ucwords($registration->regStatus):'Initiated'}}</i></td>
                                        <td>{{@$registration->report_date}}</td>
                                        <td>
                                            @if($registration->regStatus =='PeerReviewReport')
                                                <i data-id ="{{$registration->id}}" class="btn-xs btn-info forwartToAAC" data-toggle="tooltip" data-placement="left" title="Forward to Accreditation Award Committee"> <i class="fa fa-forward"></i></i> |
                                            @elseif($registration->regStatus =='Review')
                                                Desk Review In-progress
                                            @endif
                                            <i class="fa fa-pencil-square-o text-blue edit" data-row='{"date":"{{$registration->report_date}}","file":"{{@$registration->file}}","comments":"{{@$registration->prr_comments}}","prr_id":{{@$registration->prr_id}},"update":"update"}'></i>
                                             | <i class="fa fa-list text-blue" ></i>
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
                                    <th>Report Date</th>
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

            </div>
            <!-- /.row (main row) -->
        </section>
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

@hasrole('NbeacFocalPerson|NBEACAdmin|PeerReviewer')
<script>

    $('.edit').on('click', function () {
        let row = JSON.parse(JSON.stringify($(this).data('row')));
        console.log('darta here....', row);
        $('#report_date').val(row.date);
        CKEDITOR.instances.comments.setData(row.comments);
        $('.file').attr('href', row.file);
        $('#prr_id').val(row.prr_id);


    })
    $('.select2').select2();

    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        CKEDITOR.replace('comments');
    });
    $('#form').submit(function (e) {
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        var comments = CKEDITOR.instances.comments.getData();
        var file = $('#file').val();

        !file?addClass('file'):removeClass('file');
        !comments?addClass('comments'):removeClass('comments');

        if(!file || !comments)
        {
            Notiflix.Notify.Warning("Fill all the required Fields.");
            return;
        }
        e.preventDefault();
        let formData = new FormData(this)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            // Yes button callback
            $.ajax({
                url:'{{url("peerReviewReport")}}',
                type:'POST',
                data: formData,
                cache:false,
                contentType:false,
                processData:false,
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


    $('.forwartToAAC').on('click', function (e) {
        var id = $(this).data('id');

        Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to forward the case to SAP?', 'Yes', 'No',
            function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                // Yes button callback
                $.ajax({
                    url:'{{url("updateSlipStatus")}}/'+id,
                    type:'put',
                    data: { id:id, 'regStatus':'AwardCommittee'},
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
