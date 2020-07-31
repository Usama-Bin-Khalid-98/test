@section('pageTitle', 'Configuration')

@if(Auth::user())


@include("includes.head")
<!-- Morris chart -->
<link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />
@include("includes.header")
@include("includes.nav")
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        NBEAC System Settings
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">System Settings</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Configuration</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <a href="{{url('config/charter_types')}}" class="text-green"><b>Charter Types</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['CharterType']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/institute_types')}}" class="text-green"><b>Institute Types</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['InstituteType']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/departments')}}" class="text-green"><b>Departments</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['Department']}}</span>
                    </span>
                    </li>

                    <li class="list-group-item">
                        <a href="" class="text-green"><b>Programs</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">100</span>
                    </span>
                    </li>

                    <li class="list-group-item">
                        <a href="" class="text-green"><b>Semesters</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">100</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="" class="text-green"><b>Business Schools</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">100</span>
                    </span>
                    </li>

                    <li class="list-group-item">
                        <a href="" class="text-green"><b>Campuses</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">100</span>
                    </span>
                    </li>

                    <li class="list-group-item">
                        <a href="" class="text-green"><b>Qualifications</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">100</span>
                    </span>
                    </li>
                </ul>

              <hr>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">

            <div class="tab-content">
              <div class="active tab-pane" id="course_type">

                  <div class="user-block">
                    <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 20px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input  data-toggle="modal" data-target="#course-modal" value="Add New" class="btn btn-info">
                                </div>
                            </div>
                  </div>

                <div class="box box-primary">
                        <div class="box-header ">
                            <h3 class="box-title">{{$TableName}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable1" class="table table-bordered table-striped">
                                 <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($TableRows as $row)
                                <tr>
                                    <td>{{$row->name}}</td>
                                    <td><i class="badge {{$row->status == 'active'?'bg-green':'bg-red'}}">{{$row->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$row->id}}"></i> | <i class="fa fa-pencil text-blue edit" data-row='{"id":"{{$row->id}}","name":"{{$row->name}}","status":"{{$row->status}}"}' data-toggle="modal" data-target="#edit-modal"></i></td>

                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="modal fade" id="course-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{$TableName}} </h4>
                </div>
                <form action="javascript:void(0)" id="form" method="POST">
                    <div class="modal-body">

                        <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" placeholder="Enter {{$TableName}}"  class="form-control">
                                </div>
                              </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" name="add" id="add" value="Add" class="btn btn-info">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

     <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit {{$TableName}} </h4>
                </div>
                <form role="form" method="post" >
                    <div class="modal-body">


                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="edit_name" value="{{old('edit_name')}}" class="form-control">
                                </div>
                                <input type="hidden" id="edit_id">
                              </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">{{ __('Status') }} : </label>
                                <p><input type="radio" name="status" class="flat-red" value="active" > Active
                                    <input type="radio" name="status" class="flat-red" value="inactive">InActive</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="button" name="update" id="update" value="update" class="btn btn-info">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
              </div>

              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{URL::asset('notiflix/notiflix-2.3.2.min.js')}}"></script>
    @include("../includes.footer")
    <script src="{{URL::asset('plugins/iCheck/icheck.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{URL::asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{URL::asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script>
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        });
        $(function () {
            $('#datatable1').DataTable()
        })
        $(function () {
            $('#datatable2').DataTable()
        })
    </script>
    <script type="text/javascript">

        $('.select2').select2()

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

         $('#add').on('click',function (e) {
            let name = $('#name').val();

            !name?addClass('name'):removeClass('name');

            if(!name )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }

            $.ajax({
                url:'{{request()->route()->parameters['table']}}',
                type:'POST',
                data:{name:name},
                beforeSend: function(){
                    Notiflix.Loading.Pulse('Processing...');
                },
                // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
                success: function (response) {
                    Notiflix.Loading.Remove();
                    if(response.success){
                        Notiflix.Notify.Success(response.success);
                    }
                    console.log('response', response);
                    location.reload();
                },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })
                }
            })
        });


         $('.edit').on('click', function () {
            // let data = JSON.parse(JSON.stringify($(this).data('row')));
             let data = JSON.parse(JSON.stringify($(this).data('row')));
            $('#edit_name').val(data.name);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#update').on('click',function (e) {
            let name = $('#edit_name').val();
            let id = $('#edit_id').val();

            let status = $('input[name=status]:checked').val();

            !name?addClass('edit_name'):removeClass('edit_name');

            if(!name )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            $.ajax({
                url:'{{request()->route()->parameters['table']}}/'+id,
                type:'PUT',
                data: {name:name, status:status},
                beforeSend: function(){
                    Notiflix.Loading.Pulse('Processing...');
                },
                // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
                success: function (response) {
                    Notiflix.Loading.Remove();
                    if(response.success){
                        Notiflix.Notify.Success(response.success);
                    }
                    //console.log('response', response);
                    location.reload();
                },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })
                }
            })
        });


         $('.delete').on('click', function (e) {
            let id =  $(this).data('id');
            Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to delete?', 'Yes', 'No',
                function(){
                    // Yes button callback
                    $.ajax({
                        url:'{{request()->route()->parameters['table']}}/'+id,
                        type:'DELETE',
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
                            // console.log('response here', response);
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
 @else
{{"Login to Access this page"}}
<script type="text/javascript">window.location.replace('login');</script>

 @endif
