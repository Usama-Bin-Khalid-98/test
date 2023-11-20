@section('pageTitle', 'Application Received')
@php
$isActiveSAR = getFirst('App\Models\Sar\SarInvoice' ,['regStatus'=>'SAR','campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id]);
@endphp
@if(Auth::user())

    @include("../includes.head")
     <!-- Select2 -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />
    @include("../includes.header")
    @include("../includes.nav")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Applications Received
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Application Received </li>
            </ol>
        </section>


        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
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
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            @if($isActiveSAR)
                                <h3 class="box-title">9.3.	Provide data on the applications received and student intake in the past three years for each program in Table 9.3 </h3>
                            @else
                                <h3 class="box-title">2.3.	Provide data on the applications received and student intake in the past three years for each program in Table 2.3 </h3>
                            @endif
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                                </button>
                                <div class="btn-group">
                                    <!--<button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">-->
                                    <!--    <i class="fa fa-file-pdf-o"></i></button>-->
                                </div>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                        	 <form action="javascript:void(0)" id="form" method="POST">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Program(s) under review</label>
                                   <select name="program_id" id="program_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Program</option>
                                        @foreach($scopes as $scope)
                                         <option value="{{$scope->program->id}}">{{$scope->program->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                                 <div class="form-group col-md-3">
                                     <label for="name">Year</label>
                                     <select name="year" id="year" class="form-control select2" style="width: 100%;">
                                         <option selected disabled>Select Year</option>
                                         <option value="{{$years['yeart']}}">{{ $years['yeart']}}</option>
                                         <option value="{{$years['year_t_1']}}">{{ $years['year_t_1']}}</option>
                                         <option value="{{$years['year_t_2']}}">{{ $years['year_t_2']}}</option>
                                     </select>
                                 </div>
                                 <div class="form-group col-md-3">
                                     <label for="semester">Select Semester</label>
                                     <select name="semester" id="semester" class="form-control select2">
                                         <option selected disabled>Select Semester</option>
                                         <option value="Fall">Fall</option>
                                         <option value="Spring">Spring</option>
                                     </select>
                                 </div>
                               <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Applications received</label>
                                    <input type="number" min=0 name="app_received" id="app_received" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Admission offered</label>
                                    <input type="number" min=0 name="admission_offered" id="admission_offered" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Student Intake</label>
                                    <input type="number" min=0 name="student_intake" id="student_intake" class="form-control" >
                                </div>
                            </div>
                             {{--<div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Degree awarding critarea/requirments</label>
                                    <input type="text" name="degree_req" id="degree_req" class="form-control">
                                </div>
                            </div>--}}

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Semester commencement date</label>
                                    <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text" name="semester_comm_date" id="semester_comm_date" value="<?php echo date('m/d/Y'); ?>" class="form-control">
                                </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" id="add" value="Add" class="btn btn-info">
                                </div>

                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" value="Add & Next" class="btn btn-success next">
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
                            @if($isActiveSAR)
                                <h3 class="box-title">Table 9.3. Applications received.</h3>
                            @else
                                <h3 class="box-title">Table 2.3. Applications received.</h3>
                            @endif
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                 <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Program(s) under review</th>
                                    <th>Year</th>
                                    <th>Semester</th>
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
                                    <td>{{$portfolio->campus->business_school->name}}</td>
                                    <td>{{$portfolio->campus->location}}</td>
                                    <td>{{$portfolio->program->name}}</td>
                                    <td>{{$portfolio->year}}</td>
                                    <td>{{$portfolio->semester}}</td>
                                    <td>{{$portfolio->app_received}}</td>
                                    <td>{{$portfolio->admission_offered}}</td>
                                    <td>{{$portfolio->student_intake}}</td>
                                    <td>{{$portfolio->semester_comm_date}}</td>
                                    <td><i class="badge {{$portfolio->status == 'active'?'bg-green':'bg-red'}}">{{$portfolio->status == 'active'?'Active':'Inactive'}}</i></td>
                                <td><i class="fa fa-trash text-info delete" data-id="{{$portfolio->id}}"></i> | <i data-row='{"semester":"{{$portfolio->semester}}","id":"{{$portfolio->id}}","program_id":"{{$portfolio->program_id}}","year":"{{$portfolio->year}}","app_received":"{{$portfolio->app_received}}","admission_offered":"{{$portfolio->admission_offered}}","student_intake":"{{$portfolio->student_intake}}","degree_req":"{{$portfolio->degree_awarding_criteria}}","semester_comm_date":"{{$portfolio->semester_comm_date}}","status":"{{$portfolio->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>

                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                 <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Program(s) under review</th>
                                    <th>Year</th>
                                    <th>Semester</th>
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
                                    <label for="name">Program Name</label>
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
                                <label for="name">Year</label>

                                <select name="year" id="edit_year" class="form-control select2" style="width: 100%;">
                                    <option selected disabled>Select Year</option>
                                    <option value="{{$years['yeart']}}">{{ $years['yeart']}}</option>
                                    <option value="{{$years['year_t_1']}}">{{ $years['year_t_1']}}</option>
                                    <option value="{{$years['year_t_2']}}">{{ $years['year_t_2']}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Year</label>

                                <select name="semester" id="edit_semester" class="form-control select2" style="width: 100%;">
                                    <option selected disabled>Select Semester</option>
                                    <option value="Fall">Fall</option>
                                    <option value="Spring">Spring</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Applications Received</label>
                                    <input type="text" name="app_received" id="edit_app_received" value="{{old('edit_app_received')}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Admission Offered</label>
                                    <input type="text" name="admission_offered" id="edit_admission_offered" value="{{old('edit_admission_offered')}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Student Intake</label>
                                    <input type="number" name="student_intake" id="edit_student_intake" value="{{old('edit_student_intake')}}" class="form-control">
                                </div>
                            </div>

                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Semester Commencement Date</label>
                                    <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text" name="semester_comm_date" id="edit_semester_comm_date" value="{{old('edit_semester_comm_date')}}" class="form-control">
                                </div>
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
    <script src="{{URL::asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
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
        $("#admission_offered").on('change', function (e) {
            if(parseFloat(document.getElementById('app_received').value) < this.value){
                Notiflix.Notify.Warning('Application Received Should be greater or equal admission offered');
            }
        })
        $("#student_intake").on('change', function (e) {
            if(parseFloat(document.getElementById('admission_offered').value) < this.value){
                Notiflix.Notify.Warning('Student Intake Should be less or equal admission offered');
            }
        })
        $("#edit_admission_offered").on('change', function (e) {
            if(parseFloat(document.getElementById('edit_app_received').value) < this.value){
                Notiflix.Notify.Warning('Application Received Should be greater or equal admission offered');
            }
        })
        $("#edit_student_intake").on('change', function (e) {
            if(parseFloat(document.getElementById('edit_admission_offered').value) < this.value){
                Notiflix.Notify.Warning('Student Intake Should be less or equal admission offered');
            }
        })
    </script>
    <script type="text/javascript">

        $('.select2').select2();
        $('#semester_comm_date').datepicker({
      autoclose:true
    });

        $('#edit_semester_comm_date').datepicker({
      autoclose:true
    });

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
let check = false;


         $('#form').submit(function (e) {
            let program_id = $('#program_id').val();
            let year = $('#year').val();
            let app_received = $('#app_received').val();
            let admission_offered = $('#admission_offered').val();
            let student_intake = $('#student_intake').val();
            let semester_comm_date = $('#semester_comm_date').val();
            let semester= $('#semester').val();

            !program_id?addClass('program_id'):removeClass('program_id');
            !year?addClass('year'):removeClass('year');
            !app_received?addClass('app_received'):removeClass('app_received');
            !admission_offered?addClass('admission_offered'):removeClass('admission_offered');
            !student_intake?addClass('student_intake'):removeClass('student_intake');
            !semester_comm_date?addClass('semester_comm_date'):removeClass('semester_comm_date');

            if(!program_id || !year || !app_received || !admission_offered || !student_intake || !semester_comm_date || !semester)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            if(parseFloat(document.getElementById('app_received').value) < document.getElementById('admission_offered').value){
                Notiflix.Notify.Warning('Application Received Should be greater or equal admission offered');
                return;
            }
            if(parseFloat(document.getElementById('admission_offered').value) < document.getElementById('student_intake').value){
                Notiflix.Notify.Warning('Student Intake Should be less or equal admission offered');
                return;
            }
             console.log(app_received);
             console.log('adminssion offerd', admission_offered);
            // if( parseInt(app_received) < parseInt(admission_offered))
            // {
            //     Notiflix.Notify.Failure("Applications received can't be less then Admission offered.");
            //     return;
            // }
            // if(parseInt(admission_offered) < parseInt(student_intake))
            // {
            //     Notiflix.Notify.Failure("Admission offered can't be less then Student Intake.");
            //     return;
            // }
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
                    Notiflix.Loading.Pulse('Processing... ');
                },
                // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
                success: function (response) {
                    Notiflix.Loading.Remove();
                    if(response.success){
                        Notiflix.Notify.Success(response.success);
                    }
                    check = true;
                    console.log('response', response);
                    setTimeout(()=> {
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
            $('#edit_year').select2().val(data.year).trigger('change');
            $('#edit_semester').select2().val(data.semester).trigger('change');
            $('#edit_app_received').val(data.app_received);
            $('#edit_admission_offered').val(data.admission_offered);
            $('#edit_student_intake').val(data.student_intake);
            $('#edit_semester_comm_date').val(data.semester_comm_date);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            e.preventDefault();
            let program_id = $('#edit_program_id').val();
            let year = $('#edit_year').val();
            let app_received = $('#edit_app_received').val();
            let admission_offered = $('#edit_admission_offered').val();
            let student_intake = $('#edit_student_intake').val();
            let semester_comm_date = $('#edit_semester_comm_date').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !program_id?addClass('edit_program_id'):removeClass('edit_program_id');
            !year?addClass('edit_year'):removeClass('edit_year');
            !app_received?addClass('edit_app_received'):removeClass('edit_app_received');
            !admission_offered?addClass('edit_admission_offered'):removeClass('edit_admission_offered');
            !student_intake?addClass('edit_student_intake'):removeClass('edit_student_intake');
            !semester_comm_date?addClass('edit_semester_comm_date'):removeClass('edit_semester_comm_date');
            
            if(parseFloat(document.getElementById('edit_app_received').value) < document.getElementById('edit_admission_offered').value){
                Notiflix.Notify.Warning('Application Received Should be greater or equal admission offered');
                return;
            }
            if(parseFloat(document.getElementById('edit_admission_offered').value) < document.getElementById('edit_student_intake').value){
                Notiflix.Notify.Warning('Student Intake Should be less or equal admission offered');
                return;
            }
            if(!program_id || !year || !app_received || !admission_offered || !student_intake || !semester_comm_date)
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


        $('.next').on('click', function (){
            setTimeout(()=>{
                if(check){
                    @if($isActiveSAR)
                        window.location = '/credit-transfer';
                    @else
                        window.location = '/app-recvd';
                    @endif
                }
            }, 1000)
        });




    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
