@section('pageTitle', 'Scope Accreditation')
@php
$isActiveSAR = getFirst('App\Models\MentoringInvoice' ,['regStatus'=>'SAR','campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id]);
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
                Scope of Accreditation
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active">Provide scope of accreditation </li>
            </ol>
        </section>
        <!--<section class="content-header">-->
        <!--    <div class="col-md-12 new-button">-->
        <!--        <div class="pull-right">-->
        <!--            <button class="btn gradient-bg-color"-->
        <!--                   data-toggle="modal" data-target="#add-modal"-->
        <!--                   style="color: white;"-->
        <!--                   value="Add New">PDF <i class="fa fa-file-pdf-o"></i></button>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->

        {{--Dean section --}}
        <section class="content">
            <div class=" form row">
                <div class="col-md-12">
                @if(!$isActiveSAR)
                <form>
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">1.2. Provide scope of accreditation in Table 1.2.</h3>
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
                                    <label for="name">Degree program</label>
                                    <select id="program_id" class="form-control select2" style="width: 100%;">
                                        <option disabled selected >Select Program</option>
                                        @foreach($programs as $program)
{{--                                        @if($isSAR)--}}
{{--                                                <option value="{{$program->program->id}}" {{$program->program->id==old('program_id')?'selected':''}}>{{$program->program->name}}</option>--}}
{{--                                            @else--}}
                                            <option value="{{$program->id}}" {{$program->id==old('program_id')?'selected':''}}>{{$program->name}}</option>
{{--                                        @endif--}}
                                                @endforeach
                                        <option value="other">Other</option>
                                        </select>
                                </div>
                            </div>
                            <div class="hide other-field">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="other">Enter Degree Name</label>
                                        <input type="text" name="other_name" id="other_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="discipline">Select Discipline</label>
                                        <select name="discipline_id" id="discipline_id" class="form-control select2">
                                            <option disabled selected>Select One</option>
                                            @foreach($disciplines as $discipline)
                                                <option value="{{$discipline->id}}">{{$discipline->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Level</label>
                                    <select id="level_id" class="form-control select2" style="width: 100%;">
                                        <option value="">Select Level</option>
                                        @foreach($levels as $level)
                                            <option value="{{$level->id}}">{{$level->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Date of program commencement</label>
                                    <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text" id="date_program" value="<?php echo date('m/d/Y'); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>

{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="type">{{ __('Status') }} : </label>--}}
{{--                                    <p><input type="radio" name="status" class="flat-red" value="active" {{old('status')=='active'?'checked':''}}> Active--}}
{{--                                        <input type="radio" name="status" class="flat-red" value="inactive" {{old('status')=='inactive'?'checked':''}}>InActive</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="button" name="add" id="add" value="Add" class="btn btn-info add">
                                </div>
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="button" value="Add & Next" class="btn btn-success add">
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                    </div>
                </form>
                @endif
                    <!-- /.box -->
                </div>
                <!-- Main content -->
            </div>

            <div class="form row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Table 1.2 Scope of Accreditations.</h3>
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

                    {{--  Content here --}}
                    <!-- /.box -->

                        <!-- /.box-header -->
                        <div class="box-body">

                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Degree Program</th>
                                    <th>Level</th>
                                    <th>Date of program commencement </th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="showRecord">
                                @foreach($scopes as $scope)
                                <tr>
                                    <td>{{$scope->program->name}}</td>
                                    <td>{{$scope->level->name}}</td>
                                    <td>{{$scope->date_program}}</td>
                                    <td><i data-id="{{@$scope->id}}" data-program-id="{{@$scope->program->id}}" data-level-id="{{@$scope->level->id}}" data-date-program="{{@$scope->date_program}}" class="badge status {{$scope->status =='active'?'bg-green':'bg-red'}}">{{$scope->status =='active'?'Active':'Inactive'}}</i></td>
                                    <td><i class="fa fa-trash text-info delete" data-id="{{$scope->id}}" ></i> | <i class="fa fa-pencil text-blue edit" data-id="{{$scope->id}}" data-row='{"id":{{$scope->id}},"program_id":{{$scope->program->id}},"level_id":{{$scope->level->id}},"date_program":"{{$scope->date_program}}", "status":"{{$scope->status}}"}' data-toggle="modal" data-target="#edit-modal"></i> </td>
                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Degree Program</th>
                                    <th>Level</th>
                                    <th>Date of program commencement </th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <!-- /.box -->
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Scope of accreditation. </h4>
                </div>
                <form role="form" action="" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Degree Program</label>
                                <select id="edit_program_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Program</option>
                                    @foreach($programs as $program)
                                        <option value="{{$program->id}}" {{$program->id==old('program_id')?'selected':''}}>{{$program->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Level</label>
                                <select id="edit_level_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Level</option>
                                    @foreach($levels as $level)
                                        <option value="{{$level->id}}">{{$level->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Date of Program commencement</label>
                                <input type="text" id="edit_date_program" class="form-control">
                                <input type="hidden" id="id">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">{{ __('Status') }} : </label>
                                <p><input type="radio" name="edit_status" class="flat-red" value="active" {{old('status')=='active'?'checked':''}}> Active
                                    <input type="radio" name="edit_status" class="flat-red" value="inactive" {{old('status')=='inactive'?'checked':''}}>InActive</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="button" name="update" id="update" value="update" class="btn btn-info">
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
    </script>
    <script type="text/javascript">
        $('.status').on('click', function (e) {
            var id = $(this).data('id');
            var program_id = $(this).data('program-id');
            var level_id = $(this).data('level-id');
            var date_program = $(this).data('date-program');
            // console.log(level_id)
            Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to activate?', 'Yes', 'No',
                function(){
                    // Yes button callback
                    $.ajax({
                        url:'{{url("strategic/scope")}}/'+id,
                        type:'PATCH',
                        data: { program_id:program_id,
                            level_id:level_id,
                            date_program:date_program,
                            status:'active'},
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

                            console.log('response here', response);
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
        $("#program_id").on('change', function (e) {
            if(this.options[this.selectedIndex].text == "Other"){
                $(".other-field").removeClass('hide');
            }else{
                $(".other-field").addClass('hide');
            }
        })
        //Initialize Select2 Elements
        $('.select2').select2();
        $('#date_program').datepicker({
      autoclose: true,
      orientation: 'bottom'
    });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        /*Add Scope*/
        $('.add').on('click', function (e) {
            let clickButton = $(this).val();
            let program_id = $('#program_id').val();
            let level_id = $('#level_id').val();
            let date_program = $('#date_program').val();
            let other_name = $("#other_name").val();
            let discipline_id = $("#discipline_id").val();

            !program_id?addClass('program_id'):removeClass('program_id');
            !level_id?addClass('level_id'):removeClass('level_id');
            !date_program?addClass('date_program'):removeClass('date_program');
            if(!date_program || !level_id || !program_id)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
                // Yes button callback
                $.ajax({
                    url:'{{url("strategic/scope")}}',
                    type:'POST',
                    data: {program_id:program_id,level_id:level_id, date_program:date_program, other_name:other_name, discipline_id: discipline_id},
                    beforeSend: function(){
                        Notiflix.Loading.Pulse('Processing...');
                    },
                    // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
                    success: function (response) {
                        Notiflix.Loading.Remove();
                        if(response.success){
                            Notiflix.Notify.Success(response.success);
                        }
                        if(clickButton == 'Add') {
                            setTimeout(() => location.reload(), 1000);
                        }
                        else {
                            window.location = '/strategic/contact-info';
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
        ///// edit record
        $('.edit').on('click', function () {
            let data = JSON.parse(JSON.stringify($(this).data('row')));
            console.log('type ', typeof data);
            // Initialize Select2
            $('#edit_program_id').select2().val(data.program_id).trigger('change');
            $('#edit_level_id').select2().val(data.level_id).trigger('change');
            document.getElementById('edit_date_program').value = data.date_program;
            $('#edit_date_program').datepicker({
                autoclose:true
            });
            // $( "#edit_date_program" ).datepicker().val(data.date_program);
            // $('#edit_date_program').datepicker("setDate", data.date_program );

            $('#id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#update').on('click', function () {
            let program_id = $('#edit_program_id').val();
            let level_id = $('#edit_level_id').val();
            let date_program = $('#edit_date_program').val();
            let id = $('#id').val();
            let status = $('input[name=edit_status]:checked').val();

            !program_id?addClass('edit_program_id'):removeClass('edit_program_id');
            !level_id?addClass('edit_level_id'):removeClass('edit_level_id');
            !date_program?addClass('edit_date_program'):removeClass('edit_date_program');
            if(!date_program || !level_id || !program_id)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }

            $.ajax({
                url:'{{url("strategic/scope")}}/'+id,
                type:'PUT',
                data: {program_id:program_id,level_id:level_id,date_program:date_program,status:status},
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
                        url:'{{url("strategic/scope")}}/'+id,
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
