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


        @hasrole('BusinessSchool')
        <section class="content">

            <div class="row" >
                <!--Registrations list-->
                <section class="col-lg-6 connectedSortable">
                    <!-- TO DO List -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Read Me! </h3>
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
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Notes! </h4>
                                <ol>
                                    <li>check the Peer Reviewer Report.  </li>
                                    <li>Peer Reviewer Report Doc File <a href="{{url('samples/Feedback form-Shadow-Participant-at-PRT.docx')}}"> Download</a> </li>
                                    <li>upload the feedback on word copy of PRR with track changes. </li>
                                    <li>The AAC Chair and PRT will check the report if no changes required then will forward the case to Council Meeting. </li>
                                </ol>
                            </div>
                        </div>

                    </div>
                    <!-- /.box -->

                </section>
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
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Feedback on Peer Review Report. </h3>
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

{{--                                <div class="col-md-4">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="name">Upload PRR Doc</label>--}}
{{--                                        <input type="file" name="file" id="file" accept=".doc,.docx,application/msword,.pdf">--}}
{{--                                        <span class="text-red">Max upload file size 2mb.</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="sample">Download Sample</label><br>--}}
{{--                                        <a href="" class="file"><span href="" class="badge bg-green">Download</span></a>--}}
{{--                                        <input type="hidden" id="prr_id" name="prr_id">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="comments">Comments</label>
                                        <textarea name="comments" id="comments" >{{ @$registrations[0]->bs_feedback_prr }} </textarea>
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

@hasrole('BusinessSchool')
<script>

    // $('.edit').on('click', function () {
    //     let row = JSON.parse(JSON.stringify($(this).data('row')));
    //     console.log('darta here....', row);
    //     $('#report_date').val(row.date);
    //     CKEDITOR.instances.comments.setData(row.comments);
    //     $('.file').attr('href', row.file);
    //     $('#prr_id').val(row.prr_id);
    //
    //
    // })
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
        // var file = $('#file').val();

        // !file?addClass('file'):removeClass('file');
        !comments?addClass('comments'):removeClass('comments');

        if(!comments)
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
                url:'{{url("bs_feedback_PRR")}}',
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
