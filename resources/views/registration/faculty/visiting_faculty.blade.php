@section('pageTitle', 'Users')


@if(Auth::user())

    @include("../includes.head")
    <!-- Select2 -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    @include("../includes.header")
    @include("../includes.nav")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Visiting Faculty
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Faculty Stability </li>
            </ol>
        </section>
        <section class="content-header">
            <div class="col-md-12 new-button">
                <div class="pull-right">
                    <button class="btn gradient-bg-color"
                            {{--                           data-toggle="modal" data-target="#add-modal"--}}
                            style="color: white;"
                            value="Add New"
                            name="add" id="add">PDF <i class="fa fa-file-pdf-o"></i></button>
                </div>
            </div>
        </section>

        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">4.3   Provide data for Full Time Equivalent (FTE) for the permanent, regular and adjunct faculty of last year in Table 4.3a and Visiting Faculty Equivalent (VFE) of last year in table 4.3.b for the program under review..</h3>
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

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Faculty Name</label>
                                    <select name="designation" class="form-control">
                                        <option value="">Select Faculty</option>
                                        <option value="">abc</option>
                                        <option value="">xyz</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Designation(B)</label>
                                    <select name="designation" class="form-control">
                                        <option value="">Select Designation</option>
                                        <option value="">Professor</option>
                                        <option value="">Assist Professor</option>
                                        <option value="">HOD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Faculty Type(C)</label>
                                    <select name="designation" class="form-control">
                                        <option value="">Select type</option>
                                        <option value="">Permanent</option>
                                        <option value="">Adjunct</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Maximum teaching courses allowed (E)</label>
                                    <input type="text" name="program" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Teaching courses in program 1 (F)</label>
                                    <input type="text" name="phd" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Teaching courses in program 2  (G)</label>
                                    <input type="text" name="master" value="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group pull-right">
                                    <label for="type">&nbsp;</label>
                                    <input type="button" name="submit" value="Add" class="btn btn-info">
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <!-- /.box -->
                    </div>
                    <!-- .box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Table 4.3a FTE for the permanent, regular and adjunct faculty in program(s) </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Faculty Name</th>
                                    <th>Designation</th>
                                    <th>Type</th>
                                    <th>Courses Allowed</th>
                                    <th>Program 1</th>
                                    <th>Program 2</th>
                                    <th>FTE Program 1</th>
                                    <th>FTE Program 2</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Faculty Name</td>
                                    <td>prof</td>
                                    <td>Permanent</td>
                                    <td>13</td>
                                    <td>5</td>
                                    <td>4</td>
                                    <td>0.33</td>
                                    <td>0.33</td>
                                    <td><i class="badge bg-green">Active</i></td>
                                    <td><i class="fa fa-trash text-info"></i> | <i class="fa fa-pencil text-blue"></i> </td>
                                </tr>
                                <tr>
                                    <td>Faculty Name</td>
                                    <td>prof</td>
                                    <td>Permanent</td>
                                    <td>13</td>
                                    <td>5</td>
                                    <td>4</td>
                                    <td>0</td>
                                    <td>0.5</td>
                                    <td><i class="badge bg-green">Active</i></td>
                                    <td><i class="fa fa-trash text-info"></i> | <i class="fa fa-pencil text-blue"></i> </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="3"><strong>Total VFE</strong></td>
                                    <td align="center" colspan="2"><strong>4.5</strong></td>
                                </tr>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Faculty Name</th>
                                    <th>Designation</th>
                                    <th>Type</th>
                                    <th>Courses Allowed</th>
                                    <th>Program 1</th>
                                    <th>Program 2</th>
                                    <th>FTE Program 1</th>
                                    <th>FTE Program 2</th>
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
                <form role="form" action="" method="post">
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
    @include("../includes.footer")
    <script src="{{URL::asset('plugins/iCheck/icheck.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{URL::asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{URL::asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    {{----}}
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#program').DataTable()
        })
    </script>
    <script type="text/javascript">

        //Initialize Select2 Elements
        $('.select2').select2()

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
