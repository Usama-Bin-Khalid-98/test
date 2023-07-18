@section('pageTitle', 'Student to teacher Ratio')


@if(Auth::user())

    @include("../includes.head")
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
                Student to teacher Ratio
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active">Student to teacher Ratio</li>
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
                            <h3 class="box-title">4.4 Fill in data to calculate student to teacher ratio for last year of each program under review in Table 4.4.</h3>
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Program(s) under review</label>
                                   <select name="program_id" id="program_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Program</option>
                                        @foreach($programs as $program)
                                         <option value="{{$program->program->id}}">{{$program->program->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
{{--                           <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="name">Year</label>--}}
{{--                                    <select name="year" id="year" class="form-control select2" style="width: 100%;">--}}
{{--                                        <option selected disabled>Select Year</option>--}}
{{--                                        <option value="{{ now()->year}}">{{ now()->year}}</option>--}}
{{--                                        <option value="{{ now()->year-1}}">{{ now()->year - 1}}</option>--}}
{{--                                        <option value="{{ now()->year -2}}">{{ now()->year -2 }}</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Total enrollments(B) </label>
                                    <input type="number" name="total_enrollments" id="total_enrollments" class="form-control">
                                </div>
                            </div>
{{--                                <div class="col-md-3">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="name">Total FTE</label>--}}
{{--                                        <input type="number" name="total_fte" id="total_fte" class="form-control">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-3">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="name">Total VFE</label>--}}
{{--                                        <input type="number" name="total_vfe" id="total_vfe" class="form-control">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                             <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" id="add" value="Add" class="btn btn-info">
                                </div>

                                 <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" id="add" value="Add & Next" class="btn btn-success next">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- .box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">4.4 student to teacher ratio for last year of each program under review in Table 4.4.</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Program(s) under review</th>
{{--                                    <th>Year</th>--}}
                                    <th>Total Enrollments (B)</th>
                                    <th>Total FTE (C)</th>
                                    <th>Total VFE (D)</th>
                                    <th>Student to teacher ratio
                                        =B/(C+D)
                                    </th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ratios as $req)
                                <tr>
                                    <td>{{$req->campus->business_school->name}}</td>
                                    <td>{{$req->campus->location}}</td>
                                    <td>{{$req->program->name}}</td>
                                    <td>{{$req->total_enrollments}}</td>
                                    <td>@isset($byProgramVFE[$req->program_id]){{@$byProgramFTE[$req->program_id]}}@endisset</td>
                                    <td>@isset($byProgramVFE[$req->program_id]){{round($byProgramVFE[$req->program_id]/3, 2)}}@endisset</td>
                                    @php
                                        if(isset($byProgramVFE[$req->program_id],$byProgramFTE[$req->program_id])){
                                            $totalFTEVFE = $byProgramFTE[$req->program_id]+round($byProgramVFE[$req->program_id]/3, 2);
                                        }else if(isset($byProgramVFE[$req->program_id])){
                                            $totalFTEVFE = round($byProgramVFE[$req->program_id]/3, 2);
                                        }else if(isset($byProgramFTE[$req->program_id])){
                                            $totalFTEVFE = $byProgramFTE[$req->program_id];
                                        }
                                    @endphp
                                    <td>{{(isset($totalFTEVFE) && $totalFTEVFE) !=0 ?(round($req->total_enrollments/($totalFTEVFE), 2)):0}}%</td>
                                    <td><i class="badge {{$req->status == 'active'?'bg-green':'bg-red'}}">{{$req->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$req->id}}"></i> | <i class="fa fa-pencil text-blue edit" data-row='{"id":"{{$req->id}}","program_id":"{{$req->program_id}}","total_enrollments":"{{$req->total_enrollments}}","total_fte":"{{$req->total_fte}}","total_vfe":"{{$req->total_vfe}}","status":"{{$req->status}}","isCompleted":"{{$req->isCompleted}}"}' data-toggle="modal" data-target="#edit-modal"></i></td>

                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Program(s) under review</th>
{{--                                    <th>Year</th>--}}
                                    <th>Total Enrollments</th>
                                    <th>Total FTE</th>
                                    <th>Total VFE</th>
                                    <th>Student to teacher ratio
                                        =B/(C+D)
                                    </th>
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
            </div>
        </section>
    </div>


    <!-- /.modal -->

     <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Faculty Student Ratio. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Program(s) under review</label>
                                   <select name="program_id" id="edit_program_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Program</option>
                                        @foreach($programs as $program)
                                         <option value="{{$program->program->id}}">{{$program->program->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                                <input type="hidden" id="edit_id">
                            </div>

{{--                           <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="name">Year</label>--}}
{{--                                    <select name="year" id="edit_year" class="form-control select2" style="width: 100%;">--}}
{{--                                        <option selected disabled>Select Year</option>--}}
{{--                                        <option value="{{ now()->year}}">{{ now()->year}}</option>--}}
{{--                                        <option value="{{ now()->year-1}}">{{ now()->year - 1}}</option>--}}
{{--                                        <option value="{{ now()->year -2}}">{{ now()->year -2 }}</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}


                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Total Enrollments</label>
                                    <input type="number" name="total_enrollments" id="edit_total_enrollments" value="{{old('edit_total_enrollments')}}" class="form-control">
                                </div>
                              </div>
{{--                        <div class="col-md-6">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="name">Total FTE</label>--}}
{{--                                <input type="number" name="total_fte" id="edit_total_fte" value="{{old('edit_total_fte')}}" class="form-control">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="name">Total VFE</label>--}}
{{--                                <input type="number" name="total_vfe" id="edit_total_vfe" value="{{old('edit_total_vfe')}}" class="form-control">--}}
{{--                            </div>--}}
{{--                        </div>--}}


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
            let program_id = $('#program_id').val();
            let total_enrollments = $('#total_enrollments').val();


            !program_id?addClass('program_id'):removeClass('program_id');
            !total_enrollments?addClass('total_enrollments'):removeClass('total_enrollments');

            if(!program_id || !total_enrollments)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("faculty-student-ratio")}}',
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
            // let data = JSON.parse(JSON.stringify($(this).data('row')));
             let data = JSON.parse(JSON.stringify($(this).data('row')));
            $('#edit_program_id').select2().val(data.program_id).trigger('change');
            $('#edit_total_enrollments').val(data.total_enrollments);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
            $('input[value='+data.isCompleted+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let program_id = $('#edit_program_id').val();
            let total_enrollments = $('#edit_total_enrollments').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            let isCompleted = $('input[name=edit_isCompleted]:checked').val();
            !program_id?addClass('edit_program_id'):removeClass('edit_program_id');
            !total_enrollments?addClass('edit_total_enrollments'):removeClass('edit_total_enrollments');

            if(!program_id || !total_enrollments)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("faculty-student-ratio")}}/'+id,
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
                        url:'{{url("faculty-student-ratio")}}/'+id,
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
        });

        $('.next').on('click', function (){
            setTimeout(()=>{
                if(check){
                    window.location = '/faculty-stability';
                }
            }, 1000)
        });

    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
