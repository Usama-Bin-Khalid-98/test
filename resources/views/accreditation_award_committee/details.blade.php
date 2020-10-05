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
               Accreditation Details Report
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
                <li>Accreditation Details Report</li>
            </ol>
        </section><!-- Main content -->


        @hasrole('AccreditationAwardCommittee')
        <section class="content">

            <div class="row" >
                <section class="col-lg-6 connectedSortable">
                    <!-- TO DO List -->
                    <div class="box box-primary ">
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
                                    <li>Check peer review report</li>
                                    <li>analyse the whole case put comments on this case with status.
                                        <ul>
                                            <li>Endorse recommendation</li>
                                            <li>Minor review</li>
                                            <li>Major review</li>
                                        </ul>
                                    </li>
                                    <li>If AAC reviewer gives go-ahead, share PRR with Business School focal person</li>
                                    <li>Business School submits feedback on wordcopy of PRR with track changes.</li>
                                    <li>Changes would be shared with AAC reviewer, AAC Chair and PRT.</li>
                                    <li>If agrees to , they accept the changes and finalize the report.</li>

                                </ol>
                            </div>
                        </div>

                    </div>
                    <!-- /.box -->

                </section>

                <!--Registrations list-->
                <section class="col-lg-6 connectedSortable">
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sample">Download File</label>
                                        <a href="{{@$peerReview->file}}" download="{{@$peerReview->file}}" class="badge bg-green">Download</a>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sample">Report Date</label>
                                        <p class="badge bg-green">{{@$peerReview->report_date}}</p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="comments">Peer Reviewer Comments</label>
                                        {!! @$peerReview->comments !!}
                                    </div>
                                </div>
                            <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                        </div>

                    </div>
                    <!-- /.box -->

                </section>
                <section class="col-lg-12 connectedSortable">
                    <!-- TO DO List -->
                    <form method="post" id="submitAACReport" enctype="multipart/form-data">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Accreditation Award Committee Comments. </h3>
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="comments">Peer Reviewer Comments</label>
                                    <textarea name="comments" id="comments"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control select2">
                                        <option value="EndorseRecommendation">Endorse Recommendation</option>
                                        <option value="MinorReview">Minor Review</option>
                                        <option value="MajorReview">Major Review</option>
                                    </select>
                                    <input type="hidden" name="slip_id" id="slip_id" value="{{@Request()->route('id')}}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <input type="submit" name="submitAACReport" class="btn btn-info pull-right" value="Submit Accreditation Award Report">
                            </div>

                            <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                        </div>
                    </div>
                    </form>
                    <!-- /.box -->

                </section>
                <!-- right col -->
                <!--Registrations list-->
                <section class="col-lg-12 connectedSortable">
                    <!-- TO DO List -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Accreditation Details Reports </h3>
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
                                    <th>Comments</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach(@$registration as $slip)
                                    <tr>
                                        <td>{{@$slip->school}}</td>
                                        <td>{{@$slip->campus??'Main Campus'}}</td>
                                        <td>{{@$slip->department}}</td>
                                        <td>{!! @$slip->AACcomments !!}</a></td>
                                        <td><i class="badge" data-id="{{@$slip->id}}"  style="background: {{$slip->regStatus == 'Initiated'?'red':''}}{{$slip->regStatus == 'Review'?'brown':''}}{{$slip->regStatus == 'Approved'?'green':''}}" >{{@$slip->regStatus != ''?ucwords($slip->regStatus):'Initiated'}}</i></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Business School Name</th>
                                    <th>Campus</th>
                                    <th>Department</th>
                                    <th>Comments</th>
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
    <!-- Select2 -->
    <script src="{{URL::asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{URL::asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif

@hasrole('AccreditationAwardCommittee')
<script>
    $('.select2').select2();

    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        CKEDITOR.replace('comments');
    });
    $('#submitAACReport').submit(function (e) {
        e.preventDefault();
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        var comments = CKEDITOR.instances.comments.getData();
        var status = $('#status').val();
        // var file = $('#file').val();

        // !file?addClass('file'):removeClass('file');
        !comments?addClass('comments'):removeClass('comments');
        !status?addClass('status'):removeClass('status');

        if( !comments || !status)
        {
            Notiflix.Notify.Warning("Fill all the required Fields.");
            return;
        }
        let formData = new FormData(this)
        formData.append('_method', 'PUT');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            // Yes button callback
            $.ajax({
                url:'{{url("submitAACReport")}}',
                type:'post',
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


    $('.forward_sar').on('click', function (e) {
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
                    url:'{{url("updateInvoiceStatus")}}/'+id,
                    type:'put',
                    data: { id:id, 'regStatus':'SAR'},
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
            },
            function(){ // No button callback
                // alert('If you say so...');
            } );
    });


</script>

@endhasrole
