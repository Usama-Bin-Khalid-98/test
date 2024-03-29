@section('pageTitle', 'Program Portfolio')


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
                Program Courses
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Program Courses </li>
            </ol>
        </section>
{{--        <section class="content-header">--}}
{{--            <div class="col-md-12 new-button">--}}
{{--                <div class="pull-right">--}}
{{--                    <button class="btn gradient-bg-color"--}}
{{--                           data-toggle="modal" data-target="#add-modal"--}}
{{--                           style="color: white;"--}}
{{--                           value="Add New"--}}
{{--                            name="add" id="add">PDF <i class="fa fa-file-pdf-o"></i></button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
    <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-sticky-note"></i>Note</h4>
                        <ol type="1">
                            <li>
                                <h5>Entry required for All programs.</h5>
                                <p>You can't submit your registration application, if data not entered for all the programs separately.</p>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->

            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"> 2.2.	Provide information on individual courses of each program under review in Table 2.2.</h3>
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
                                    <label for="name">Program</label>
                                    <select name="program_id" id="program_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Program(s) under review</option>
                                        @foreach($scopes as $scope)
                                            <option value="{{$scope->program->id}}">{{$scope->program->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Course Title</label>
                                    <input type="text" name="title" id="title" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Course Code</label>
                                    <input type="text" name="code" id="code" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group" style="margin-bottom: 16px;">
                                    <label for="name">Course category</label>
                                   <select name="course_type_id" id="course_type_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Course category</option>
                                        @foreach($courses as $course)
                                         <option value="{{$course->id}}">{{$course->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Credit hours</label>
                                    <input type="text" name="credit_hours" id="credit_hours" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Prerequisite if any </label>
                                    <textarea name="prerequisite" id="prerequisite" class="form-control"></textarea>
                                </div>
                            </div>

                             <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <input type="submit" name="add-and-next" id="add" value="Add & Next" class="btn btn-success">
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
                            <h3 class="box-title">2.2.	Provide information on individual courses of each program under review in Table 2.2.</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Program</th>
                                    <th>Course Title</th>
                                    <th>Course Code</th>
                                    <th>Course Type</th>
                                    <th>Credit Hours</th>
                                    <th>Prerequisite if any</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                 @foreach($portfolios as $portfolio)
                                <tr>
                                    <td>{{@$portfolio->program->name}}</td>
                                    <td>{{@$portfolio->title}}</td>
                                    <td>{{@$portfolio->code}}</td>
                                    <td>{{$portfolio->course_type->name}}</td>
                                    <td>{{$portfolio->credit_hours}}</td>
                                    <td>{{$portfolio->prerequisite}}</td>
                                    <td><i class="badge {{$portfolio->status == 'active'?'bg-green':'bg-red'}}">{{$portfolio->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$portfolio->id}}"></i> | <i data-row='{"id":"{{$portfolio->id}}","program_id":{{@$portfolio->program->id}},"title":{{$portfolio->title}},"code":{{$portfolio->code}},"course_type_id":{{$portfolio->course_type_id}},"credit_hours":{{$portfolio->credit_hours}},"prerequisite":"{{$portfolio->prerequisite}}","status":"{{$portfolio->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i></td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Program</th>
                                    <th>Course Title</th>
                                    <th>Course Code</th>
                                    <th>Course Type</th>
                                    <th>Credit Hours</th>
                                    <th>Prerequisite if any</th>
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
                    <h4 class="modal-title">Edit Program Course. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
{{--                         <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="name">Program</label>--}}
{{--                                   <select name="program" id="edit_program" class="form-control select2" style="width: 100%;">--}}
{{--                                        <option selected disabled>Select</option>--}}
{{--                                         <option value="program1">Program 1</option>--}}
{{--                                         <option value="program2">Program 2</option>--}}
{{--                                        </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        <div class="col-md-6">
                            <div class="form-group">
                                    <label for="name">Program</label>
                                   <select name="program_id" id="edit_program_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Program</option>
                                        @foreach($scopes as $scope)
                                         <option value="{{$scope->program->id}}">{{$scope->program->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                                <input type="hidden" id="edit_id">
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Course Title</label>
                                <input type="text" required name="title" id="edit_title" value="{{old('edit_title')}}" class="form-control">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Course Type</label>
                                <select name="course_type_id" id="edit_course_type_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Course</option>
                                    @foreach($courses as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                    <label for="name">Course Code</label>
                                    <input type="text" required name="code" id="edit_code" value="{{old('edit_code')}}" class="form-control">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Credit Hours</label>
                                    <input type="text" required name="credit_hours"
                                    id="edit_credit_hours" value="{{old('edit_credit_hours')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Prerequisite (if any)</label>
                                    <textarea type="text" required name="prerequisite"
                                    id="edit_prerequisite" value="{{old('edit_prerequisite')}}" class="form-control"></textarea>
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
            let next = false;
            if(e.originalEvent.submitter.id === 'add-and-next'){
                next = true
            }
            // let program = $('#program').val();
            let title = $('#title').val();
            let code = $('#code').val();
            let course_type_id = $('#course_type_id').val();
            let credit_hours = $('#credit_hours').val();

            // !program?addClass('program'):removeClass('program');
            !title?addClass('program_id'):removeClass('program_id');
            !course_type_id?addClass('course_type_id'):removeClass('course_type_id');
            !credit_hours?addClass('credit_hours'):removeClass('credit_hours');

            if(!title || !code || !course_type_id || !credit_hours )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("program-courses")}}',
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
                    if (next){
                        setTimeout(() => {
                            window.location = '/curriculum-review';
                        }, 1000);
                    }else{
                        location.reload();
                    }
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
            $('#edit_code').val(data.code);
            $('#edit_course_type_id').select2().val(data.course_type_id).trigger('change');
            $('#edit_title').val(data.title);
            $('#edit_credit_hours').val(data.credit_hours);
            $('#edit_prerequisite').val(data.prerequisite);
            $('#edit_fyp_req').val(data.fyp_req);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let id = $('#edit_id').val()
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("program-courses")}}/'+id,
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
                        url:'{{url("program-portfolio")}}/'+id,
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
