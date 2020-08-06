@section('pageTitle', 'Users')


@if(Auth::user())

    @include("../includes.head")
    <!-- Select2 -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />

    @include("../includes.header")
    @include("../includes.nav")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               Business School Faculty Summary
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Faculty Summary </li>
            </ol>
        </section>
        <section class="content-header">
            <div class="col-md-12 new-button">
                <div class="pull-right">
                    <button class="btn gradient-bg-color"
{{--                           data-toggle="modal" data-target="#add-modal"--}}
                           style="color: white;"
                           value="Add New">PDF <i class="fa fa-file-pdf-o"></i></button>
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
                            <h3 class="box-title">Provide information about core business school faculty : present aggregate numbers in Table 4.1</h3>
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
                        <form name="add" method="post">
                        <!-- /.box-header -->
                        <div class="box-body">


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Faculty Qualification</label>
                                    <select name="faculty_qualification_id" id="faculty_qualification_id" class="form-control select2">
                                        <option value="">Select Qualification</option>
                                        @foreach($qualification as $degree)
                                        <option value="{{$degree->id}}">{{$degree->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Discipline</label>
                                    <select name="discipline_id" id="discipline_id" class="form-control">
                                        <option value="">Select Discipline</option>
                                        @foreach($discipline as $program)
                                            <option value="{{$program->id}}">{{$program->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                   <label for="name">Number of Faculty</label>
                                    <input type="text" name="number_faculty" id="number_faculty" value="" class="form-control">
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="form-group pull-right">
                                    <label for="type">&nbsp;</label>
                                    <input type="button" name="submit" value="Add" id="add" class="btn btn-info">
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        </form>
                        <!-- /.box -->
                    </div>
                    <!-- .box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Information of faculty  over the last two semesters</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
{{--                            <table id="example1" class="table table-bordered table-striped">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}

{{--                                    <th>Qualification</th>--}}
{{--                                    <th>Public Administration</th>--}}
{{--                                    <th>Business Administration</th>--}}
{{--                                    <th>Managment Sciences</th>--}}
{{--                                    <th>Comerece</th>--}}
{{--                                    <th>Others</th>--}}
{{--                                    <th>Total Faculty</th>--}}





{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                <tr>--}}

{{--                                    <td>PHD</td>--}}
{{--                                    <td>12</td>--}}
{{--                                    <td>14</td>--}}
{{--                                    <td>21</td>--}}
{{--                                    <td>13</td>--}}
{{--                                    <td>16</td>--}}
{{--                                    <td>76</td>--}}




{{--                                    <td><div class="badge bg-green">Active</div></td>--}}
{{--                                    <td><i class="fa fa-trash text-info"></i> | <i class="fa fa-pencil text-blue"></i> </td>--}}
{{--                                </tr>--}}

{{--                                </tbody>--}}
{{--                                <tfoot>--}}
{{--                                <tr>--}}
{{--                                       <th>Qualification</th>--}}
{{--                                    <th>Public Administration</th>--}}
{{--                                    <th>Business Administration</th>--}}
{{--                                    <th>Managment Sciences</th>--}}
{{--                                    <th>Comerece</th>--}}
{{--                                    <th>Others</th>--}}
{{--                                    <th>total faculty</th>--}}

{{--                                </tr>--}}
{{--                                </tfoot>--}}
{{--                            </table>--}}
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
    <script src="{{URL::asset('notiflix/notiflix-2.3.2.min.js')}}"></script>

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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#add').on('click', function (e) {
            let faculty_qualification_id = $('#faculty_qualification_id').val();
            let discipline_id = $('#discipline_id').val();
            let number_faculty = $('#number_faculty').val();

            !number_faculty?addClass('number_faculty'):removeClass('number_faculty');
            !discipline_id?addClass('discipline_id'):removeClass('discipline_id');
            !faculty_qualification_id?addClass('faculty_qualification_id'):removeClass('faculty_qualification_id');

            if(!number_faculty || !discipline_id || !faculty_qualification_id)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            $.ajax({
                url:'{{url("strategic/faculty_summary")}}',
                type:'POST',
                data: {number_faculty:number_faculty,discipline_id:discipline_id, faculty_qualification_id:faculty_qualification_id},
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
                    console.log('response', response);
                   // location.reload();
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
            $('#edit_plan_period').val(data.plan_period);
            $('#edit_aproval_date').val(data.aproval_date);
            $('#edit_aproving_authority').val(data.aproving_authority);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#updateForm').submit(function (e) {
            let plan_period = $('#edit_plan_period').val();
            let aproval_date = $('#edit_aproval_date').val();
            let aproving_authority = $('#edit_aproving_authority').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !plan_period?addClass('edit_plan_period'):removeClass('edit_plan_period');
            !aproval_date?addClass('edit_aproval_date'):removeClass('edit_aproval_date');
            !aproving_authority?addClass('edit_aproving_authority'):removeClass('edit_aproving_authority');

            if(!plan_period || !aproval_date || !aproving_authority)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
            var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("strategic/strategic-plan")}}/'+id,
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
                        url:'{{url("strategic/strategic-plan")}}/'+id,
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
