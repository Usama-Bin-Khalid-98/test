@section('pageTitle', 'Dashboard')

@if(Auth::user())


@include("includes.head")
<!-- Morris chart -->
{{--<link rel="stylesheet" href="bower_components/morris.js/morris.css">--}}
<!-- jvectormap -->
{{--<link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">--}}
<link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.1/css/fixedColumns.dataTables.min.css" />
<link rel="stylesheet" href="{{URL::asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">

@include("includes.header")
@include("includes.nav")


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registrations
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Registrations</li>
      </ol>
    </section><!-- Main content -->


    @hasrole('NBEACAdmin')
        <section class="content">
      <!-- Small boxes (Stat box)  //////////   Admin Dashboard //////-->

        <!-- Main row -->

        <div class="row" >

            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-12 connectedSortable">
                <!-- TO DO List -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Registrations. </h3>
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
                        <table id="datatable1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Business School Name</th>
                                <th>Campus</th>
                                <th>Department</th>
                                <th>Desk Review</th>
                                <th>Registration Print</th>
                                <th>SAR</th>
                                <th>Status</th>
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
                                    <td><a href="{{url('registrationPrint?cid=')}}{{@$slip->campus_id}}&bid={{@$slip->business_school_id}}&did={{@$slip->department_id}}">Registration Print </a></td>
                                    <td><a class="badge bg-maroon" href="print?cid={{$slip->campus_id}}&bid={{$slip->business_school_id}}">SAR</a></td>
                                    <td><i style="cursor: default;" class="badge" data-id="{{@$slip->id}}"  style="background: {{$slip->regStatus == 'Initiated'?'red':''}}{{$slip->regStatus == 'Review'?'brown':''}}{{$slip->regStatus == 'Approved'?'green':''}}" >{{@$slip->regStatus != ''?ucwords($slip->regStatus):'Initiated'}}</i></td>
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

{{--<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.js"></script>--}}
@include("includes.footer")
 @else
{{"Login to Access this page"}}
<script type="text/javascript">window.location.replace('login');</script>

 @endif

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="{{URL::asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script>
    $('#visit_date').datepicker({
        autoclose:true,
        format:'yyyy-mm-dd'
    });
</script>
<script>
    $(document).ready( function () {
    $('#datatable1').DataTable();

} );

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $('.TravelPlane').on('click', function () {
        let id = $(this).data('id');
        $('#slip_id').val(id);

        $.ajax({
            url:'{{url("getInvoice")}}/'+id,
            type:'get',
            // data: { get:'get'},
            beforeSend: function(){
                Notiflix.Loading.Pulse('Processing...');
            },
            // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
            success: function (response) {
                Notiflix.Loading.Remove();
                let data = JSON.parse(JSON.stringify(response));
                console.log("success resp ",data);
                console.log('pr date value',data.pr_visit_date);
                $('#confirm_date').text(data.confirm_date);
                $('#fileName').attr('href',data.pr_travel_plan);

                $("#visit_date").datepicker("setDate", data.pr_visit_date);

                // $('#visit_date').val(data.pr_visit_date);
                // if(response.success){
                //     Notiflix.Notify.Success(response.success);
                // }

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

        console.log('show modal .....');
    })

    $('.feedback').on('click', function () {
        let id = $(this).data('id');
        $('#feedback_slip_id').val(id);

        $.ajax({
            url:'{{url("instituteFeedback")}}/'+id,
            type:'get',
            // data: { get:'get'},
            beforeSend: function(){
                Notiflix.Loading.Pulse('Processing...');
            },
            // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
            success: function (response) {
                Notiflix.Loading.Remove();
                let data = JSON.parse(JSON.stringify(response));
                console.log("success resp ",data);
                console.log('pr date value',data.pr_visit_date);
                $('#confirm_date').text(data.confirm_date);
                $('#fileName').attr('href',data.pr_travel_plan);

                $("#visit_date").datepicker("setDate", data.pr_visit_date);

                // $('#visit_date').val(data.pr_visit_date);
                // if(response.success){
                //     Notiflix.Notify.Success(response.success);
                // }

                // location.reload();

                console.log('response here', response);
             },
            error:function(response, exception){
                Notiflix.Loading.Remove();
                // $.each(response.responseJSON, function (index, val) {
                //     Notiflix.Notify.Failure(val);
                // })

            }
        })

        console.log('show modal .....');
    })

    $('.profileSheet').on('click', function () {
        let id = $(this).data('id');
        $('#sheet_slip_id').val(id);

        $.ajax({
            url:'{{url("getInvoice")}}/'+id,
            type:'get',
            // data: { get:'get'},
            beforeSend: function(){
                Notiflix.Loading.Pulse('Processing...');
            },
            // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
            success: function (response) {
                Notiflix.Loading.Remove();
                let data = JSON.parse(JSON.stringify(response));
                console.log("success resp ",data);
                console.log('pr date value',data.pr_visit_date);
                $('#profile_sheet').attr('href',data.profile_sheet);

                // $('#visit_date').val(data.pr_visit_date);
                // if(response.success){
                //     Notiflix.Notify.Success(response.success);
                // }

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

        console.log('show modal .....');
    })

    $('#visit-form').on('submit', function (e) {
        var visit_date = $('#visit_date').val();
        let file = $('#file').val();
        let slip_id = $('#slip_id').val();
        e.preventDefault();
        !visit_date?addClass('visit_date'):removeClass('visit_date');
        !file?addClass('file'):removeClass('file');

        if(!visit_date || !slip_id )
        {
            Notiflix.Notify.Warning("Fill all the required Fields.");
            return;
        }
                // Yes button callback
                 var formData = new FormData(this);
                $.ajax({
                    url:'{{url("travelPlan")}}',
                    type:'POST',
                    cache:false,
                    contentType:false,
                    processData:false,
                    data: formData,
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

    $('#sheet-form').on('submit', function (e) {
        let file = $('#sheet').val();
        let slip_id = $('#sheet_slip_id').val();
        e.preventDefault();
        !file?addClass('sheet'):removeClass('sheet');

        if( !slip_id )
        {
            Notiflix.Notify.Warning("Fill all the required Fields.");
            return;
        }
                // Yes button callback
                 var formData = new FormData(this);
                $.ajax({
                    url:'{{url("profileSheet")}}',
                    type:'POST',
                    cache:false,
                    contentType:false,
                    processData:false,
                    data: formData,
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

    $('#feedback-form').on('submit', function (e) {
        let file = $('#feedback').val();
        let slip_id = $('#feedback_slip_id').val();
        e.preventDefault();
        !file?addClass('sheet'):removeClass('sheet');

        if( !slip_id )
        {
            Notiflix.Notify.Warning("Fill all the required Fields.");
            return;
        }
                // Yes button callback
                 var formData = new FormData(this);
                $.ajax({
                    url:'{{url("instituteFeedback")}}',
                    type:'POST',
                    cache:false,
                    contentType:false,
                    processData:false,
                    data: formData,
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
    @hasrole('NBEACAdmin')
    <script>
    $('.status').on('click', function (e) {
        var id = $(this).data('id');

        Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to activate?', 'Yes', 'No',
            function(){
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

@hasrole('BusinessSchool')
<script>
    $('.apply').on('click', function (e) {
        var id = $(this).data('id');
        var department_id = $(this).data('row');
        //
        // console.log('depaertid ', department_id);
        // return;
        Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to Apply?', 'Yes', 'No',
            function(){
                // Yes button callback
                $.ajax({
                    url:'{{url("registration-apply")}}/'+id,
                    type:'patch',
                    data: { id:id, department_id:department_id},
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
    })
</script>

@endhasrole

