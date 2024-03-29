@section('pageTitle', 'Program Courses')
@php
$isActiveSAR = getFirst('App\Models\Sar\SarInvoice' ,['regStatus'=>'SAR','campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id]);
@endphp

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
                @if($isActiveSAR) Program Courses @else Program Portfolio @endif
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> @if($isActiveSAR)Program Courses @else Program Portfolio @endif</li>
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
                            <h3 class="box-title">@if($isActiveSAR) 2.2. Provide information on individual courses of each program under review in Table 2.2. @else 2.1.Provide the portfolio of the program(s) under review in Table 2.1. @endif</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                                </button>
                                <!--<div class="btn-group">-->
                                <!--    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">-->
                                <!--        <i class="fa fa-file-pdf-o"></i></button>-->
                                <!--</div>-->
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="javascript:void(0)" id="form" method="POST">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Program(s) under review</label>
                                   <select name="program_id" id="program_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Program(s) under review</option>
                                        @foreach($scopes as $scope)
                                         <option value="{{$scope->program->id}}">{{$scope->program->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Number of semesters</label>
                                    <input type="number" name="total_semesters" id="total_semesters" min=1 class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
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

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">No of courses of program under review</label>
                                    <input type="number" name="no_of_course" id="no_of_course" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Credit hours</label>
                                    <input type="number" name="credit_hours" id="credit_hours" class="form-control">
                                </div>
                            </div>
                                @if(!$isActiveSAR)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Internship requirements</label>
                                    <textarea name="internship_req" id="internship_req" class="form-control"></textarea>
                                </div>
                            </div>
                                @endif
                                @if(!$isActiveSAR)
                            <div class="col-md-4">
                                <div class="form-group">

                                    <label for="name">Final year project/ viva/ thesis/ comprehensive</label>
                                    <select name="fyp_req" id="fyp_req" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select</option>
                                         <option value="final year project ">Final year project </option>
                                          <option value="viva">Viva</option>
                                           <option value="thesis">Thesis</option>
                                            <option value="comprehensive">Comprehensive</option>
                                        </select>

                                </div>
                            </div>
                                @endif

                             <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <input type="submit" name="add" value="Add & Next" class="btn btn-success next">
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
                            <h3 class="box-title">@if($isActiveSAR)2.2.	Provide information on individual courses of each program under review in Table 2.2. @else 2.1.Programs Portfolio @endif</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
{{--                                    <th>Program</th>--}}
                                    <th>Program(s) under review</th>
                                   <th>Total Semesters</th>
                                    <th>Course Type</th>
                                    <th>No of Courses</th>
                                    <th>Credit Hours</th>
                                    @if(!$isActiveSAR)<th>Internship Requirement</th>
                                    <th>FYP Requirement</th>@endif
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $total_credit_hours = 0;
                                    $total_courses = 0;
                                @endphp
                                 @foreach($portfolios as $portfolio)
                                 @php
                                 $total_credit_hours += floatval($portfolio->credit_hours);
                                 $total_courses += floatval($portfolio->no_of_course);
                                 @endphp
                                <tr>
{{--                                    <td>{{$portfolio->program}}</td>--}}
                                    <td>{{@$portfolio->program->name}}</td>
                                  <td>{{$portfolio->total_semesters}}</td>
                                    <td>{{$portfolio->course_type->name}}</td>
                                   <td>{{$portfolio->no_of_course}}</td>
                                    <td>{{$portfolio->credit_hours}}</td>
                                    @if(!$isActiveSAR)<td>{{$portfolio->internship_req}}</td>
                                    <td>{{$portfolio->fyp_req}}</td>@endif
                                    <td><i class="badge {{$portfolio->status == 'active'?'bg-green':'bg-red'}}">{{$portfolio->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$portfolio->id}}"></i> | <i data-row='{"id":"{{$portfolio->id}}","program_id":{{$portfolio->program_id}},"total_semesters":{{$portfolio->total_semesters}},"course_type_id":{{$portfolio->course_type_id}},"no_of_course":{{$portfolio->no_of_course}},"credit_hours":{{$portfolio->credit_hours}},"internship_req":"{{$portfolio->internship_req}}","fyp_req":"{{$portfolio->fyp_req}}","status":"{{$portfolio->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i></td>
                                </tr>
                                @if ($loop->last || $portfolio->program_id !== $portfolios[$loop->index + 1]->program_id)
                                 <tr>
                                    <td><span>{{@$portfolio->program->name}} </span></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total : {{$total_courses}}</strong></td>
                                    <td><strong>Total : {{$total_credit_hours}}</strong></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    </tr>
                                @php
                                    $total_credit_hours = 0;
                                    $total_courses = 0;
                                @endphp
                                @endif
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
{{--                                    <th>Program</th>--}}
                                    <th>Program(s) under review</th>
                                    <th>Total Semesters</th>
                                    <th>Course Type</th>
                                    <th>No of Courses</th>
                                    <th>Credit Hours</th>
                                    @if(!$isActiveSAR)<th>Internship Requirement</th>
                                    <th>FYP Requirement</th>@endif
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
                    <h4 class="modal-title">Edit Program Portfolio. </h4>
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
                                    <label for="name">Program under review</label>
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
                                <label for="name">Total Semesters</label>
                                <input type="text" name="total_semesters" id="edit_total_semesters" value="{{old('edit_total_semesters')}}" class="form-control">

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
                                    <label for="name">Number of Course</label>
                                    <input type="text" name="no_of_course" id="edit_no_of_course" value="{{old('edit_no_of_course')}}" class="form-control">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Credit Hours</label>
                                    <input type="text" name="credit_hours"
                                    id="edit_credit_hours" value="{{old('edit_credit_hours')}}" class="form-control">
                            </div>
                        </div>
                        @if(!$isActiveSAR)
                         <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Internship Requirements</label>
                                    <textarea name="internship_req" id="edit_internship_req" value="{{old('edit_internship_req')}}" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">FYP Requirements</label>
                                    <textarea name="fyp_req" id="edit_fyp_req" value="{{old('edit_fyp_req')}}" class="form-control"></textarea>
                                </div>
                            </div>
                        @endif
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
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script>
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        });
        $(function () {
            $('#datatable').DataTable({
                dom : "lBfrtip",
            })
        })
    </script>
    <script type="text/javascript">

        $('.select2').select2()

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let check = false;

             $('#form').submit(function (e) {
            // let program = $('#program').val();
            let program_id = $('#program_id').val();
            @if(!$isActiveSAR) let total_semesters = $('#total_semesters').val(); @endif
            let course_type_id = $('#course_type_id').val();
            @if(!$isActiveSAR) let no_of_course = $('#no_of_course').val(); @endif
            let credit_hours = $('#credit_hours').val();

            // !program?addClass('program'):removeClass('program');
            !program_id?addClass('program_id'):removeClass('program_id');
                 @if(!$isActiveSAR)!total_semesters?addClass('total_semesters'):removeClass('total_semesters');@endif
            !course_type_id?addClass('course_type_id'):removeClass('course_type_id');
                 @if(!$isActiveSAR)!no_of_course?addClass('no_of_course'):removeClass('no_of_course');@endif
            !credit_hours?addClass('credit_hours'):removeClass('credit_hours');

            if(!program_id || !course_type_id || !credit_hours)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("program-portfolio")}}',
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
                    check = true;
                    setTimeout(()=>{
                    location.reload();}, 2000);

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
            $('#edit_total_semesters').val(data.total_semesters);
            $('#edit_course_type_id').select2().val(data.course_type_id).trigger('change');
            $('#edit_no_of_course').val(data.no_of_course);
            $('#edit_credit_hours').val(data.credit_hours);
            $('#edit_internship_req').val(data.internship_req);
            $('#edit_fyp_req').val(data.fyp_req);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let program_id = $('#edit_program_id').val();
            let total_semesters = $('#edit_total_semesters').val();
            let course_type_id = $('#edit_course_type_id').val();
            let no_of_course = $('#edit_no_of_course').val();
            let credit_hours = $('#edit_credit_hours').val();
            let internship_req = $('#edit_internship_req').val();
            let fyp_req = $('#edit_fyp_req').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !program_id?addClass('edit_program_id'):removeClass('edit_program_id');
            !total_semesters?addClass('edit_total_semesters'):removeClass('edit_total_semesters');
            !course_type_id?addClass('edit_course_type_id'):removeClass('edit_course_type_id');
            !no_of_course?addClass('edit_no_of_course'):removeClass('edit_no_of_course');
            !credit_hours?addClass('edit_credit_hours'):removeClass('edit_credit_hours');
            !internship_req?addClass('edit_internship_req'):removeClass('edit_internship_req');
            !fyp_req?addClass('edit_fyp_req'):removeClass('edit_fyp_req');

            if(!program_id || !total_semesters || !course_type_id || !no_of_course || !credit_hours)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("program-portfolio")}}/'+id,
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

        $('.next').on('click', function (){
            setTimeout(()=>{
                if(check){
                    @if($isActiveSAR)
                        window.location = '/entry-requirements';
                    @else
                        window.location = '/program-courses';
                    @endif
                }
            }, 1000)
        });


    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
