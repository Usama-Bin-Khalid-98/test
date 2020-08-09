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
                Roles
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Roles </li>
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
                <!-- /.row -->
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Roles</h3>
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
                                    <th style="font-weight: bold;">Name</th>
                                    <th style="font-weight: bold;">Permissions</th>
                                    <th style="font-weight: bold;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->name}}</td>
                                        <td>@foreach($role->permissions as $permission) <span class="label label-success">{{$permission->name}}</span> @endforeach</td>
                                        {{--<td>@if($permission->status=='active')<span class="label gradient-bg-color">Active</span>@else--}}
                                        {{--<span class="label label-danger">Inactive</span>@endif</td>--}}
                                        <td>
                                            <i class="fa fa-fw fa-edit text-purple edit"
                                               data-toggle="modal" data-target="#edit-model"
                                               data-placement="left"
                                               title="Edit"
                                               data-row='{"id":"{{$role->id}}","name":"{{$role->name}}","permissions":{{$role->permissions}} }'
                                               >
                                            </i>
                                            |<a href='permission/{{ $role->id }}'><i
                                                    class="fa fa-fw fa-trash-o text-red" data-toggle="tooltip" data-placement="right" title="Delete"  ></i></a></td>
                                    </tr>

                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th style="font-weight: bold;">Permissions</th>
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

    <div class="modal fade" id="edit-model">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Default Modal</h4>
                </div>
                <form action="" method="PUT">
                <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="col-lg-12 form-group">
                                <input type="text" class="form-control" id="edit_name" placeholder=" Role Name" name="edit_name">
                                <input type="hidden" id="id" />
                            </div>
                        </div>
                    @foreach($permissions as $permission)
                        <div class="col-lg-1">
                            <input type="checkbox" id="{{@$permission->id}}" value="{{@$permission->id}}" class="flat-red" />
                        </div>
                        <div class="col-lg-5"><label>{{@$permission->name}}</label></div>
                    @endforeach


                </div>

                <div class="modal-footer" style="margin-top: 50% !important;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="button" class="btn btn-primary" id="update" value="Update">
                </div>
                </form>
            </div>

            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="add-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Role</h4>
                </div>
                <form role="form" action="" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="col-lg-12">
                            <div class="col-lg-12 form-group">
                                <input type="text" class="form-control" id="name" placeholder=" Role Name" name="name">
                            </div>
                        </div>

                        @foreach($permissions as $permission)
                            <div class="col-lg-1">
                                <input type="checkbox" value="{{@$permission->id}}" class="flat-red" />
                            </div>
                            <div class="col-lg-5"><label>{{@$permission->name}}</label></div>
                        @endforeach

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="button" class="btn gradient-bg-color" style="color: white;" value="Submit"
                               name="add" id="add">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
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
            let ids = [];
            let permissions = $('input[type="checkbox"]:checked');
            permissions.map((index, val) => {
             console.log('map values ', $(val).val());
             ids[index]=$(val).val();
            })
            console.log('permission checked ', ids);
            //return;
            !name?addClass('name'):removeClass('name');

            if(!name)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            $.ajax({
                url:'{{url("roles")}}',
                type:'POST',
                data: {name:name, ids:ids},
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
            $('#id').val(data.id);
            console.log('e values',typeof data);
            let checks ="";
           for(const [key, val] of Object.entries(data.permissions)) {
               $('input[id='+val.id+']').iCheck('check');
               console.log(' object key', key, ' value', val);
                // checks += '<div class="col-lg-1">\n' +
                //    '<input type="checkbox" value="'+val.id+'" checked class="flat-red" />\n' +
                //    '</div>\n' +
                //    '<div class="col-lg-5"><label>'+val.name+'</label></div>';
             }
        });

        $('#update').on('click', function (e) {
            let name = $('#edit_name').val();
            let id = $('#id').val();
            let permission = [];
            let permissions = $('input[type="checkbox"]:checked');
            permissions.map((index, val) => {
                console.log('map values ', $(val).val());
                permission[index]=$(val).val();
            })
            console.log('permission checked ', permission);
            //return;
            !name?addClass('name'):removeClass('name');


            if(!name)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            // e.preventDefault();
            // var formData = new FormData(this);
            // formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("roles")}}/'+id,
                type:'PUT',
                // dataType:"JSON",
                data: {name:name, permission:permission},
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
        })

        /// Delete Row
        $('.delete').on('click', function (e) {
            let id =  $(this).data('id');
            Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to delete?', 'Yes', 'No',
                function(){
                    // Yes button callback
                    $.ajax({
                        url:'{{url("strategic/contact-info")}}/'+id,
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
