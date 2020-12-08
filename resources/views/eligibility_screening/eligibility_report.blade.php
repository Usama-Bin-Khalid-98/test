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


        @hasrole('PeerReviewer')
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
                            <h3 class="box-title">Eligibility Screening Report submission. </h3>
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
                            <form action="javascript:void(0)"  @if(@$registrations_reports[0]->comments) id="update" @else id="form" @endif method="POST">

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="registration_id">Registrations</label>
                                        <select name="slip_id" id="slip_id" class="form-control select2">
                                            @foreach($registrations as $register)
                                            <option value="{{@$register->id}}" > {{@$register->school}} {{@$register->campus}} - {{@$register->department}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="report_id" name="report_id" value="{{@$registrations_reports[0]->report_id}}">
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-bottom: 10px;">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control select2">
                                            <option value="Deferred" @if(@$registrations_reports[0]->eligibility_status==='Deferred') selected @endif>Deferred</option>
                                            <option value="Approved" @if(@$registrations_reports[0]->eligibility_status==='Approved') selected @endif>Approved</option>
                                            <option value="ConditionalApproval" @if(@$registrations_reports[0]->eligibility_status==='ConditionalApproval') selected @endif>Conditional Approval</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Date</label>
                                        <input type="date" name="es_meeting_date" id="es_meeting_date" class="form-control" value="@if(@$registrations_reports[0]->es_meeting_date){{@$registrations_reports[0]->es_meeting_date}}@else{{date('Y-m-d')}} @endif" >
                                    </div>
                                </div>

{{--                                <div class="col-md-4">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="name">Attach Doc</label>--}}
{{--                                        <input type="file" name="file" id="file" accept=".doc,.docx,application/msword,.pdf">--}}
{{--                                        @if(@$registrations_reports[0]->file)<span class="text-red"><a href="{{@$registrations_reports[0]->file}}">Click on link to download the file.</a></span> @else <span class="text-red">Max upload file size 2mb.</span> @endif--}}

{{--                                    </div>--}}
{{--                                </div>--}}


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="comments">Comments</label>
                                        <textarea name="comments" id="comments" > {!! @$registrations_reports[0]->comments !!} </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group pull-right" style="margin-top: 40px">
                                        <label for="sector">&nbsp;&nbsp;</label>
                                        @if(@$registrations_reports[0]->comments)
                                            <input type="submit" name="update" id="update" value="Update" class="btn btn-info">
                                        @else
                                            <input type="submit" name="add" id="add" value="Submit" class="btn btn-info">
                                        @endif
                                    </div>
                                </div>
                            </form>

                            <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                        </div>

                    </div>
                    <!-- /.box -->

                </section>
                <!-- right col -->

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
{{--                                    <th>Peer Reviewer Comments</th>--}}
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
{{--                                         <td>{!!substr($screening->comments, 0, 100) !!}...</td>--}}
                                        <td><i class="badge" data-id="{{@$screening->id}}"  style="background: {{$screening->regStatus == 'Initiated'?'red':''}}{{$screening->regStatus == 'Review'?'brown':''}}{{$screening->regStatus == 'Approved'?'green':''}}" >{{@$screening->eligibility_status != ''?ucwords($screening->eligibility_status):''}}</i></td>
                                        <td>@if($screening->regStatus =='Eligibility' || $screening->regStatus =='ScheduledES' )
{{--                                                <a href="{{url('esScheduler')}}/{{$screening->id}}" class="btn-xs btn-info apply" name="Schedule" id="schedule" data-id="{{@$screening->id}}" data-row="{{@$screening->department_id}}"> Eligibility Screening Calendar</a>--}}
                                            @elseif($screening->regStatus =='Review')Desk Review In-progress @endif
                                            <a href="{{url('esReport')}}/{{$screening->id}}" class="btn-xs btn-success report" name="report" id="report" ><i data-toggle="tooltip" data-content="left" title="Edit Peer Reviewer Eligibility Report" class="fa fa-pencil-square-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Business School Name</th>
                                    <th>Campus</th>
                                    <th>Department</th>
{{--                                    <th>Peer Reviewer Comments</th>--}}
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

@hasrole('PeerReviewer')
<script>
    $('.select2').select2();

    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        CKEDITOR.replace('comments',
            {
                height: '500px'
            });
        CKEDITOR.instances.comments.setData('{!! $deferred_letter !!}');
        // CKEDITOR.instances.comments.setData(row.comments);
    });

    $('#status').on('change', function () {
        let status = $(this).val();
        if(status === 'Approved')
        {
            CKEDITOR.instances.comments.setData('{!! $approval_letter !!}');
        }else if(status === 'Deferred'){
            CKEDITOR.instances.comments.setData('{!! $deferred_letter !!}');
        }else if(status === 'ConditionalApproval' )
        {
            CKEDITOR.instances.comments.setData('{!! $conditional_approved !!}');
        }else{
            CKEDITOR.instances.comments.setData('{!! $deferred_letter !!}');
        }
    })



    $('#form').submit(function (e) {
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        var slip_id = $('#slip_id').val();
        var comments = CKEDITOR.instances.comments.getData();
        // var file = $('#file').val();

        // !file?addClass('file'):removeClass('file');
        !comments?addClass('comments'):removeClass('comments');
        !slip_id?addClass('slip_id'):removeClass('slip_id');

        if(!slip_id || !comments)
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
                url:'{{url("PeerReviewerReport")}}',
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

    $('#update').submit(function (e) {
        var slip_id = $('#slip_id').val();
        var report_id = $('#report_id').val();
        var comments = CKEDITOR.instances.comments.getData();
        var file = $('#file').val();

        // !file?addClass('file'):removeClass('file');
        !comments?addClass('comments'):removeClass('comments');
        !slip_id?addClass('slip_id'):removeClass('slip_id');

        if(!slip_id || !comments || !report_id)
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
            formData.append('_method', 'PATCH')
            $.ajax({
                url:'{{url("PeerReviewerReport")}}/'+report_id,
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

                    //location.reload();

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

@endhasrole
