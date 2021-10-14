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
<link rel="stylesheet" href="{{url('bower_components/select2/dist/css/select2.min.css')}}">

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
      <!-- Info boxes -->
      <section class="content">
          <div class="row">
              <div class="col-md-12">
                  <div class="box">
                      <div class="box-header with-border">
                          <h3 class="box-title">Registration Progress</h3>
                          <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                              </button>
                              <div class="btn-group">
                                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                      <i class="fa fa-file-pdf-o"></i></button>
                              </div>
                              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                          </div>
                          <div class="box-tools pull-right">

                          </div>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                          <div class="row">
                              <div class="col-md-12">

                                  <div class="alert alert-success alert-dismissible">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <h4><i class="icon fa fa-sticky-note"></i>Note</h4>
                                      <ol type="1">

                                          <li><h5>Generate Invoice</h5>
                                              <p>Generate invoice in invoices tab, to change the status of invoice click on the the dollor icon and make it paid. The approvement request will be sent to nbeac admin. </p>
                                              <p>Registration application will be activated once registration Fee invoice will be approved by NBEAC admin</p>
                                          </li>
                                          <li><h5>Fill all the required forms</h5>
                                              <p>All the registration forms are required to submit before apply for registration. fill all the required form from strategic management to Faculty Information. </p>
                                          </li>

                                          <li><h5>Apply for registration</h5>
                                              <p>Apply for registration. when complete required forms from strategic management to Facility Information. A registration request will be sent to NBEAC Admin. </p>
                                          </li>
                                      </ol>


                                  </div>
                              </div>
                              <!-- /.col -->
                              <div class="col-md-4" style="display: none">
                                  <p class="text-center">
                                      <strong>Registration Completion</strong>
                                  </p>

                                  <div class="progress-group">
                                      <span class="progress-text">Invoice</span>
                                      <span class="progress-number"><b>100</b>/100</span>

                                      <div class="progress sm">
                                          <div class="progress-bar progress-bar-green" style="width: 100%"></div>
                                      </div>
                                  </div>
                                  <!-- /.progress-group -->
                                  <div class="progress-group">
                                      <span class="progress-text">Registration Forms</span>
                                      <span class="progress-number"><b>80</b>/100</span>

                                      <div class="progress sm">
                                          <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                                      </div>
                                  </div>
                                  <!-- /.progress-group -->
                                  <div class="progress-group">
                                      <span class="progress-text">Eligibility Screening</span>
                                      <span class="progress-number"><b>50</b>/100</span>

                                      <div class="progress sm">
                                          <div class="progress-bar progress-bar-red" style="width: 50%"></div>
                                      </div>
                                  </div>
                                  <!-- /.progress-group -->
                                  <div class="progress-group">
                                      <span class="progress-text">Mentoring</span>
                                      <span class="progress-number"><b>0</b>/100</span>

                                      <div class="progress sm">
                                          <div class="progress-bar progress-bar-yellow" style="width: 0%"></div>
                                      </div>
                                  </div>
                                  <!-- /.progress-group -->
                              </div>
                              <!-- /.col -->
                          </div>
                          <!-- /.row -->
                      </div>
                  </div>
                  <!-- /.box -->
              </div>
              <!-- /.col -->
          </div>
          <!--Invoices list-->



      </section>
      @if($invoices)
          <div class="row">
      <section class="col-lg-12 connectedSortable">

          <!-- TO DO List -->
          <div class="box box-primary">
              <div class="box-header">
                  <h3 class="box-title">Business school Invoices. </h3>
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


                  <table id="datatable5" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                          <th>Business School Name</th>
                          <th>Campus</th>
                          <th>Department</th>
{{--                          <th>Invoice Slip</th>--}}
{{--                          <th>Account Type</th>--}}
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      </thead>

                      <tbody>

                      @foreach($invoices as $invoice_re)
                          <tr>
                              <td>{{@$invoice_re->school}}</td>
                              <td>{{@$invoice_re->campus??'Main Campus'}}</td>
                              <td>{{@$invoice_re->department}}</td>
{{--                              <td><a href="{{@$invoice_re->slip}}">Invoice Slip</a></td>--}}
                              {{--                            <td>{{$invoice->user_type === 'peer_review'?'Peer Review':"Business School"}}</td>--}}
                              <td><i class="badge" data-id="{{@$invoice_re->id}}"  style="background: {{$invoice_re->regStatus == 'Initiated'?'red':''}}{{$invoice_re->regStatus == 'Review'?'brown':''}}{{$invoice_re->regStatus == 'Approved'?'green':''}}; cursor: default;" >{{@$invoice_re->regStatus != ''?ucwords($invoice_re->regStatus):'Initiated'}} {{$invoice_re->regStatus=='Eligibility'?'Screening':''}}</i></td>
                              <td>@if($invoice_re->regStatus =='Initiated' || $invoice_re->regStatus =='Pending') <button class="btn-xs btn-info apply" name="apply" id="apply" data-id="{{@$invoice_re->id}}" data-row="{{@$invoice_re->department_id}}"> Apply Now </button>  @elseif($invoice_re->regStatus =='Review')Desk Review In-progress @endif</td>
                          </tr>
                      @endforeach

                      </tbody>
                      <tfoot>
                      <tr>
                          <th>Business School Name</th>
                          <th>Campus</th>
                          <th>Department</th>
{{--                          <th>Invoice Slip</th>--}}
                          {{-- <th>Account Type</th>--}}
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
      @endif
      <!-- right col -->
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

<script src="{{url('bower_components/select2/dist/js/select2.full.min.js')}}"></script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
{{--<script--}}
{{--  src="https://code.jquery.com/jquery-3.5.1.js"--}}
{{--  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="--}}
{{--  crossorigin="anonymous"></script>--}}
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="{{URL::asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script>
    $('#visit_date').datepicker({
        autoclose:true,
        format:'yyyy-mm-dd'
    });

    $(function () {
        CKEDITOR.replace('comments');
    })


</script>
<script>
    $(document).ready( function () {
    $('#datatable5').DataTable();

    } );

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

</script>

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

