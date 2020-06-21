@section('pageTitle', 'Users')


@if(Auth::user())

    @include("includes.head")
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    @include("includes.header")
    @include("includes.nav")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Users </li>
            </ol>
        </section>
        <section class="content-header">
            <div class="col-md-12 new-button">
                <div class="pull-right">
                    <input type="submit" class="btn gradient-bg-color"
                    data-toggle="modal" data-target="#add-modal"
                    style="color: white;"
                    value="Add New"
                    name="add" id="add">
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
                            <h3 class="box-title">Add Users</h3>
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
                            <h3 class="box-title">Users Record</h3>
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
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="font-weight: bold;">S#</th>
                                    <th style="font-weight: bold;">Name</th>
                                    <th style="font-weight: bold;">Code</th>
                                    <th style="font-weight: bold;">Status</th>
                                    <th style="font-weight: bold;">Action</th>
                                </tr>
                                </thead>
                                <tbody>

{{--                                @foreach($users as $user)--}}


{{--                                    <tr>--}}
{{--                                        <td>{{$loop->iteration}}</td>--}}
{{--                                        <td>{{$user->name}}</td>--}}
{{--                                        <td>{{$user->code}}</td>--}}
{{--                                        <td>@if($user->status=='enabled')<span class="label gradient-bg-color">Enabled</span>@else--}}
{{--                                                <span class="label label-danger">Disabled</span>@endif</td>--}}
{{--                                        <td>--}}
{{--                                            <i class="fa fa-fw fa-edit text-purple" --}}
{{--                                            data-toggle="modal" data-target="#edit-model"--}}
{{--                                            data-placement="left" --}}
{{--                                            title="Edit" --}}
{{--                                            onclick="update('{{$user->id}}',--}}
{{--                                                    '{{$user->name}}',--}}
{{--                                                    '{{$user->code}}',--}}
{{--                                                    '{{$user->status}}')">--}}
{{--                                            </i>--}}
{{--                                            |<a href='user/{{ $user->id }}'><i--}}
{{--                                                        class="fa fa-fw fa-trash-o text-red" data-toggle="tooltip" data-placement="right" title="Delete"  ></i></a></td>--}}
{{--                                    </tr>--}}

{{--                                @endforeach--}}
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>S#</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Status</th>
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
              <h4 class="modal-title">Default Modal</h4>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
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
              <h4 class="modal-title">Add User</h4>
            </div>
            <form role="form" action="users" method="post">
            <div class="modal-body">

                            @csrf
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="user"
                                           placeholder=" User Name" name="name">
                                    <input type="hidden" class="form-control" id="id" name="id">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="code" placeholder="User Code"
                                           name="code">
                                </div>
                            </div>
                            {{-- <div class="col-lg-1">
                                <div class="form-group">

                                    <label> Status
                                     <input type="checkbox" name="status" class="flat-red" checked >
                                    </label>
                                    <select id="status" name="status" class="form-control">
                                        <option>Select Status</option>
                                        <option value="enabled">Enable</option>
                                        <option value="disabled">Disable</option>
                                    </select>
                                </div>
                            </div> --}}
                            {{-- <div class="col-lg-2">
                                <div class="form-group">

                            <input type="button" onclick="updateUser()" class="btn btn-danger pull-right" value="Update"
                                   name="Update" id="Update" style="display: none;">
                                </div>
                            </div> --}}
                            <!-- /.box-body -->
                            {{-- <div class="box-footer">

                        </div> --}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" class="btn gradient-bg-color" style="color: white;" value="Submit"
                name="add_user" id="add_user">
            </div>
        </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    @include("includes.footer")
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



        function addUser() {
            var user = $('#user').val();
            var code = $('#code').val();
            var status = $('#status').val();
            $.ajax({
                type: 'POST',
                url: "{{'users'}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    user: user,
                    code: code
                },
                success: function (response) {
                    //var data = JSON.parse(response);
                    alert(response);
                    //location.replace('users');
                }
            });
        }


        function update(id, name, code, status) {
            $('#id').val(id);
            $('#user').val(name);
            $('#code').val(code);
            $('#status').val(status);
            $('#add_user').hide();
            $('#Update').show();
        }

        function updateUser() {
            var id = $('#id').val();
            var user = $('#user').val();
            var code = $('#code').val();
            var status = $('#status').val();
            $.ajax({
                type: 'POST',
                url: "{{'updateusers'}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    id: id,
                    user: user,
                    code: code,
                    status: status
                },
                success: function (response) {
                    alert('Update successfully');
                    location.replace('users');
                }
            });
        }

    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
