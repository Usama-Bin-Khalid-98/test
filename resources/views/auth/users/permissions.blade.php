@section('pageTitle', 'Permissions')


@if(Auth::user())

    @include("includes.head")
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />
    @include("includes.header")
    @include("includes.nav")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Permissions
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Permissions </li>
            </ol>
        </section>
        <section class="content-header">
            <div class="col-md-12 new-button">
                <div class="pull-right">
                    <input type="submit" class="btn gradient-bg-color"
                    data-toggle="modal" data-target="#add-modal"
                    style="color: white;"
                    value="Add New">
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12" style="display:none;">
                    <!-- general form elements -->
                    <div class="box box-primary collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Permissions</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-wrench"></i></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                            <div class="box-body" style="display:none;">

                            </div>
                         </div>
                    <!-- /.box -->
                     </div>
                <!-- /.row -->
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Permissions Record</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-wrench"></i></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-stripped">
                                <thead>
                                <tr>
                                    <th style="font-weight: bold;">S#</th>
                                    <th style="font-weight: bold;">Name</th>
{{--                                    <th style="font-weight: bold;">Status</th>--}}
                                    <th style="font-weight: bold;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$permission->name}}</td>
{{--                                        <td>@if($permission->status=='active')<span class="label gradient-bg-color">Active</span>@else--}}
{{--                                                <span class="label label-danger">Inactive</span>@endif</td>--}}
                                        <td>
                                            <i data-row='{"id":{{$permission->id}},"name":"{{$permission->name}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i>
                                            | <i class="fa fa-trash text-info delete" data-id="{{@$permission->id}}"></i></td>
                                    </tr>

                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>S#</th>
                                    <th>Name</th>
{{--                                    <th>Status</th>--}}
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>


                <!-- Main content -->
                </div>


            <!-- /.row -->

            <!-- /.content -->


        </section>

    </div>

    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Permission. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                        

                        <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" id="edit_name" value="{{old('edit_name')}}" class="form-control">
                                </div>
                                <input type="hidden" id="edit_id">
                              </div>
                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" name="update" value="update" class="btn btn-info">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
      <!-- /.modal -->
      <!-- /.modal -->
    <script src="{{URL::asset('notiflix/notiflix-2.3.2.min.js')}}"></script>
    @include("includes.footer")
    <!-- DataTables -->
    <script src="{{URL::asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="plugins/iCheck/icheck.min.js"></script>

    <script type="text/javascript">

        // //iCheck for checkbox and radio inputs
        // $('input[type="checkbox"].minimal').iCheck({
        //     checkboxClass: 'icheckbox_minimal-blue'
        // });

        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-pink'
        })
        $(function () {
            $('#datatable').DataTable()
        })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        /*Add Scope*/
        $('#add').on('click', function (e) {
            let name = $('#name').val();
            !name?addClass('name'):removeClass('name');

            if(!name)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            $.ajax({
                url:'{{url("permissions")}}',
                type:'POST',
                data: {name:name},
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
        ///// edit record
        $('.edit').on('click', function () {
            let data = JSON.parse(JSON.stringify($(this).data('row')));
            $('#edit_name').val(data.name);
            $('#edit_id').val(data.id);
        });

        $('#updateForm').submit(function (e) {
            let name = $('#edit_name').val();
            let id = $('#edit_id').val();
            
            !name?addClass('edit_name'):removeClass('edit_name');

            if(!name )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
            var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("permissions")}}/'+id,
                type:'POST',
                // dataType:"JSON",
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
                    if(response.success){
                        Notiflix.Notify.Success(response.success);
                    }
                    //console.log('response', response);
                    //location.reload();
                },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })
                }
            })
        })

        /// Delete Row
        $('.delete').on('click', function (e) {
            let id =  $(this).data('id');
            Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to delete?', 'Yes', 'No',
                function(){
                    // Yes button callback
                    $.ajax({
                        url:'{{url("permissions")}}/'+id,
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
