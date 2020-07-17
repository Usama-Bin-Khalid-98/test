@section('pageTitle', 'Application Received')


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
                Application Received
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Application Received </li>
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
                            <h3 class="box-title">Application Received Form. </h3>
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
                                    <label for="name">Program Name</label>
                                   <select name="program_id" id="program_id" class="form-control select2" style="width: 100%;">
                                        <option value="">Select Program</option>
                                        @foreach($programs as $program)
                                         <option value="{{$program->id}}">{{$program->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Semesters</label>
                                   <select name="semester_id" id="semester_id" class="form-control select2" style="width: 100%;">
                                        <option value="">Select Semester</option>
                                        @foreach($semesters as $criteria)
                                         <option value="{{$criteria->id}}">{{$criteria->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                               <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Applications Received</label>
                                    <input type="text" name="app_received" id="app_received" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Admission Offered</label>
                                    <input type="text" name="admission_offered" id="admission_offered" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Student Intake</label>
                                    <textarea name="student_intake" id="student_intake" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Semester Commencement Date</label>
                                    <input type="date" name="semester_comm_date" id="semester_comm_date" class="form-control">
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
                            <h3 class="box-title">Application Received List.</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                 <tr>
                                    <th>Program</th>
                                    <th>Semesters</th>
                                    <th>Application Received</th>
                                    <th>Admission Offered</th>
                                    <th>Student Intake</th>
                                    <th>Semester Commencement Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                @foreach($apps as $portfolio)
                                <tr>
                                    <td>{{$portfolio->program->name}}</td>
                                    <td>{{$portfolio->semester->name}}</td>
                                    <td>{{$portfolio->app_received}}</td>
                                    <td>{{$portfolio->admission_offered}}</td>
                                    <td>{{$portfolio->student_intake}}</td>
                                    <td>{{$portfolio->semester_comm_date}}</td>
                                    <td><i class="badge {{$portfolio->status == 'active'?'bg-green':'bg-red'}}">{{$portfolio->status == 'active'?'Active':'Inactive'}}</i></td>
                                <td><i class="fa fa-trash text-info delete" data-id="{{$portfolio->id}}"></i> | <i data-row='{"id":{{$portfolio->id}},"program_id":{{$portfolio->program_id}},"semester_id":{{$portfolio->semester_id}},"status":"{{$portfolio->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>
                                    
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                 <tr>
                                    <th>Program</th>
                                    <th>Semesters</th>
                                    <th>Application Received</th>
                                    <th>Admission Offered</th>
                                    <th>Student Intake</th>
                                    <th>Semester Commencement Date</th>
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
                    <h4 class="modal-title">Edit Application Received. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Program</label>
                                <select name="program_id" id="edit_program_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Program</option>
                                    @foreach($programs as $program)
                                        <option value="{{$program->id}}">{{$program->name}}</option>
                                    @endforeach
                                </select>
                               <input type="hidden" id="edit_id">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Semester</label>
                                <select name="semester_id" id="edit_semester_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Semester</option>
                                    @foreach($semesters as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                    @endforeach
                                </select>
                               
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Applications Received</label>
                                    <input type="text" name="app_received" id="edit_app_received" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Admission Offered</label>
                                    <input type="text" name="admission_offered" id="edit_admission_offered" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Student Intake</label>
                                    <textarea name="student_intake" id="edit_student_intake" class="form-control"></textarea>
                                </div>
                            </div>

                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Semester Commencement Date</label>
                                    <input type="date" name="semester_comm_date" id="edit_semester_comm_date" value="{{old('edit_semester_comm_date')}}" class="form-control">
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
            let program_id = $('#program_id').val();
            let semester_id = $('#semester_id').val();
            let app_received = $('#app_received').val();
            let admission_offered = $('#admission_offered').val();
            let student_intake = $('#student_intake').val();
            let semester_comm_date = $('#semester_comm_date').val();

            !program_id?addClass('program_id'):removeClass('program_id');
            !semester_id?addClass('semester_id'):removeClass('semester_id');
            !app_received?addClass('app_received'):removeClass('app_received');
            !admission_offered?addClass('admission_offered'):removeClass('admission_offered');
            !student_intake?addClass('student_intake'):removeClass('student_intake');
            !semester_comm_date?addClass('semester_comm_date'):removeClass('semester_comm_date');

            if(!program_id || !semester_id || !app_received || !admission_offered || !student_intake || !semester_comm_date)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("application-received")}}',
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
            let data = JSON.parse(JSON.stringify($(this).data('row')));
            
            $('#edit_program_id').select2().val(data.program_id).trigger('change');
            $('#edit_semester_id').select2().val(data.semester_id).trigger('change');
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let program_id = $('#edit_program_id').val();
            let semester_id = $('#edit_semester_id').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !program_id?addClass('edit_program_id'):removeClass('edit_program_id');
            !semester_id?addClass('edit_semester_id'):removeClass('edit_semester_id');

            if(!program_id || !semester_id )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("application-received")}}/'+id,
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
                        url:'{{url("application-received")}}/'+id,
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
