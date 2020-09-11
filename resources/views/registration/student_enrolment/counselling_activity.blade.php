@section('pageTitle', 'Counselling Activity')


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
                Counselling Activity
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Counselling Activity </li>
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
                            <h3 class="box-title">3.9.  What counselling policies and processes are available to provide guidance to students in studies or in personal issues? Provide data on these activities conducted during last year in the Table 3.7.</h3>

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
                            

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Counsellor's Name</label>
                                    <input type="text" name="counsellor_name" id="counsellor_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Counselling hours</label>
                                    <input type="text" name="counselling_hours" id="counselling_hours" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Counselling activity</label>
                                    <input type="text" name="counselling_activity" id="counselling_activity" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Number of students covered</label>
                                    <input type="text" name="students_covered" id="students_covered" class="form-control">
                                </div>
                            </div>

                             <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" id="add" value="Add" class="btn btn-info">
                                </div>
                            </div>
                        </form>

                        </div>
                        <!-- /.box-body -->
                        <!-- /.box -->
                    </div>
                    <!-- .box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Table 3.7 Counselling Activity</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Counsellor’s name</th>
                                    <th>Counselling hours</th>
                                    <th>Counselling activity</th>
                                    <th>Number of students covered</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($counsellings as $plan)
                                <tr>
                                    <td>{{$plan->counsellor_name}}</td>
                                    <td>{{$plan->counselling_hours}}</td>
                                    <td>{{$plan->counselling_activity}}</td>
                                    <td>{{$plan->students_covered}}</td>
                                    <td><i class="badge {{$plan->status == 'active'?'bg-green':'bg-red'}}">{{$plan->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$plan->id}}"></i> | <i class="fa fa-pencil text-blue edit" data-row='{"id":"{{$plan->id}}", "counsellor_name":"{{$plan->counsellor_name}}", "counselling_hours":"{{$plan->counselling_hours}}", "counselling_activity":"{{$plan->counselling_activity}}","students_covered":"{{$plan->students_covered}}","status":"{{$plan->status}}"}' data-toggle="modal" data-target="#edit-modal"></i></td>

                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Counsellor’s name</th>
                                    <th>Counselling hours</th>
                                    <th>Counselling activity</th>
                                    <th>Number of students covered</th>
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
                    <h4 class="modal-title">Edit Counselling Activity. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                              
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Counsellor's Name</label>
                                    <input type="text" name="counsellor_name" id="edit_counsellor_name" value="{{old('edit_counsellor_name')}}" class="form-control">
                                </div>
                                  <input type="hidden" id="edit_id">
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Counselling Hours</label>
                                    <input type="text" name="counselling_hours" id="edit_counselling_hours" value="{{old('edit_counselling_hours')}}" class="form-control">
                                </div>
                              </div>
                               <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Counseling Activity</label>
                                    <input type="text" name="counselling_activity" id="edit_counselling_activity" value="{{old('edit_counselling_activity')}}" class="form-control">
                                </div>
                              </div>
                               <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Number of Students Covered</label>
                                    <input type="text" name="students_covered" id="edit_students_covered" value="{{old('edit_students_covered')}}" class="form-control">
                                </div>
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
            $('#datatable').DataTable()
        })
    </script>
    <script type="text/javascript">

        $('.select2').select2()

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

         $('#form').submit(function (e) {
            let counsellor_name = $('#counsellor_name').val();
            let counselling_hours = $('#counselling_hours').val();
            let counselling_activity = $('#counselling_activity').val();
            let students_covered = $('#students_covered').val();

            !counsellor_name?addClass('counsellor_name'):removeClass('counsellor_name');
            !counselling_hours?addClass('counselling_hours'):removeClass('counselling_hours');
            !counselling_activity?addClass('counselling_activity'):removeClass('counselling_activity');
            !students_covered?addClass('students_covered'):removeClass('students_covered');

            if(!counsellor_name || !counselling_hours || !counselling_activity || !students_covered)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("counselling-activity")}}',
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
            $('#edit_counsellor_name').val(data.counsellor_name);
            $('#edit_counselling_hours').val(data.counselling_hours);
            $('#edit_counselling_activity').val(data.counselling_activity);
            $('#edit_students_covered').val(data.students_covered);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            
            let counsellor_name = $('#edit_counsellor_name').val();
            let counselling_hours = $('#edit_counselling_hours').val();
            let counselling_activity = $('#edit_counselling_activity').val();
            let students_covered = $('#edit_students_covered').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !counsellor_name?addClass('edit_counsellor_name'):removeClass('edit_counsellor_name');
            !counselling_hours?addClass('edit_counselling_hours'):removeClass('edit_counselling_hours');
            !counselling_activity?addClass('edit_counselling_activity'):removeClass('edit_counselling_activity');
            !students_covered?addClass('edit_students_covered'):removeClass('edit_students_covered');

            if(!counsellor_name || !counselling_hours || !counselling_activity || !students_covered)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("counselling-activity")}}/'+id,
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
                        url:'{{url("counselling-activity")}}/'+id,
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