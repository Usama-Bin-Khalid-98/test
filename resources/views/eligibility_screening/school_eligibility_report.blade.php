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


        @hasrole('BusinessSchool')
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
                                    <th>Letter Doc</th>
                                    <th>Peer Reviewer Comments</th>
                                    <th>Status</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($registrations_reports as $screening)
                                    <tr>
                                        <td>{{@$screening->school}}</td>
                                        <td>{{@$screening->campus??'Main Campus'}}</td>
                                        <td>{{@$screening->department}}</td>
                                         <td><a href="{{asset(@$screening->file)}}" >Doc File</a></td>
                                         <td>{!!substr($screening->comments, 0, 100) !!}...</td>
                                        <td><i class="badge" data-id="{{@$screening->id}}"  style="background: {{$screening->regStatus == 'Initiated'?'red':''}}{{$screening->regStatus == 'Review'?'brown':''}}{{$screening->regStatus == 'Approved'?'green':''}}" >{{@$screening->regStatus != ''?ucwords($screening->regStatus):'Initiated'}}</i></td>
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
                                    <th>Status</th>
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
        CKEDITOR.replace('comments');
    });
    $('#form').submit(function (e) {
        var slip_id = $('#slip_id').val();
        var comments = CKEDITOR.instances.comments.getData();
        var file = $('#file').val();

        !file?addClass('file'):removeClass('file');
        !comments?addClass('comments'):removeClass('comments');
        !slip_id?addClass('slip_id'):removeClass('slip_id');

        if(!file || !slip_id || !comments)
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


</script>

@endhasrole
