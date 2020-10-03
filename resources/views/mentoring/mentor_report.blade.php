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


        @hasrole('Mentor')
        <section class="content">

            <div class="row" >
                <!--Registrations list-->
                <section class="col-lg-12 connectedSortable">
                    <!-- TO DO List -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Mentoring Report. </h3>
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
                            <form action="javascript:void(0)" id="form" method="POST">

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="registration_id">Registrations</label>
                                        <select name="mentoring_invoice_id" id="mentoring_invoice_id" class="form-control select2">
                                            @foreach($registrations as $register)
                                            <option value="{{@$register->id}}"> {{@$register->campus->business_school->name}} {{@$register->campus->location}} - {{@$register->department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
{{--                                <div class="col-md-4" style="margin-bottom: 10px;">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="status">Status</label>--}}
{{--                                        <select name="status" id="status" class="form-control select2">--}}
{{--                                            <option value="Deferred">Deferred</option>--}}
{{--                                            <option value="Approved">Approved</option>--}}
{{--                                            <option value="ConditionalApproval">Conditional Approval</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Report Date</label>
                                        <input type="date" name="report_date" id="report_date" class="form-control" value="{{date('Y-m-d')}}" >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Registration application submission date</label>
                                        <input type="date" name="registration_date" id="registration_date" class="form-control" value="{{date('Y-m-d')}}" >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">SAR submission date</label>
                                        <input type="date" name="sar_date" id="sar_date" class="form-control" value="{{date('Y-m-d')}}" >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Attach Doc</label>
                                        <input type="file" name="file" id="file" accept=".doc,.docx,application/msword,.pdf">
                                        <span class="text-red">Max upload file size 2mb.</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sample">Download Sample</label>
                                        <a href=""><span href="" class="badge bg-green">Download</span></a>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="comments">Comments</label>
                                        <textarea name="comments" id="comments" > </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group pull-right" style="margin-top: 40px">
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
                                        <td>{{@$report->mentoring_invoice->campus->business_school->name}}</td>
                                        <td>{{@$report->mentoring_invoice->campus->location??'Main Campus'}}</td>
                                        <td>{{@$report->mentoring_invoice->department->name}}</td>
                                         <td><a href="{{asset(@$report->file)}}" >Doc File</a></td>
                                         <td>{!!substr($report->comments, 0, 100) !!}...</td>
{{--                                        <td><i class="badge" data-id="{{@$report->id}}"  style="background: {{$report->regStatus == 'Initiated'?'red':''}}{{$screening->regStatus == 'Review'?'brown':''}}{{$screening->regStatus == 'Approved'?'green':''}}" >{{@$report->regStatus != ''?ucwords($report->regStatus):'Initiated'}}</i></td>--}}
                                        <td>
                                            @if($report->mentoring_invoice->regStatus !=='SAR') <i class="badge bg-aqua" >Case Forwarded for Desk Review</i> @else <a data-id="{{$report->id}}" style="cursor: pointer;" class="btn-xs btn-success forward_sar" >Forward For Desk Review</a> @endif
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

@hasrole('Mentor')
<script>
    $('.select2').select2();

    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        CKEDITOR.replace('comments');
    });
    $('#form').submit(function (e) {
        var mentoring_invoice_id = $('#mentoring_invoice_id').val();
        var report_date = $('#report_date').val();
        var registration_date = $('#registration_date').val();
        var sar_date = $('#sar_date').val();
        var comments = CKEDITOR.instances.comments.getData();
        var file = $('#file').val();

        !file?addClass('file'):removeClass('file');
        !comments?addClass('comments'):removeClass('comments');
        !registration_date?addClass('registration_date'):removeClass('registration_date');
        !sar_date?addClass('sar_date'):removeClass('sar_date');
        !mentoring_invoice_id?addClass('mentoring_invoice_id'):removeClass('mentoring_invoice_id');

        if(!file || !mentoring_invoice_id || !report_date || !sar_date || !registration_date)
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
                url:'{{url("mentorReport")}}',
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
                    data: { id:id, 'regStatus':'SARDeskReview'},
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
