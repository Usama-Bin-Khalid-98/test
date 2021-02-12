@section('pageTitle', 'Visiting Faculty ')
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
                Regular/Adjunct Faculty
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active">Regular/Adjunct Faculty</li>
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
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">4.3 Provide data for Full Time Equivalent (FTE) for the permanent, regular and adjunct faculty of last year in Table 4.3a.</h3>
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
                                    <label for="name">Faculty Name</label>
                                   <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Designation(B)</label>
                                   <select name="designation_id" id="designation_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Designation</option>
                                        @foreach($designations as $designation)
                                         <option value="{{$designation->id}}">{{$designation->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Faculty type(C)</label>
                                   <select name="lookup_faculty_type_id" id="lookup_faculty_type_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Faculty Type</option>
                                        @foreach($faculty_types as $faculty)
                                         <option value="{{$faculty->id}}">{{$faculty->faculty_type}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Maximum teaching courses Allowed(E)</label>
                                    <input type="number" name="max_cources_allowed" id="max_cources_allowed" class="form-control">
                                </div>
                            </div>

                            @foreach($getScope as $program)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Teaching courses in {{$program->program->name}}(F) </label>
                                        <input type="number" name="tc_program[{{$program->program->id}}]" id="tc_program{{$program->program->id}}" data-id="{{$program->program->id}}" class="form-control programs">
                                    </div>
                                </div>
                            @endforeach

{{--                               <div class="col-md-3">--}}
{{--                                   <div class="form-group">--}}
{{--                                       <label for="name">Teaching courses in program 2(G)</label>--}}
{{--                                       <input type="number" name="tc_program2" id="tc_program2" class="form-control">--}}
{{--                                   </div>--}}
{{--                               </div>--}}
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
                            <h3 class="box-title">4.3(a) FTE for the permanent, regular and adjunct faculty in program(s)</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
{{--                                    <th>Business School</th>--}}
                                    <th>Name</th>
                                    <th>Faculty Type</th>
                                    <th>Designation</th>
                                    <th>Maximum teaching Courses Allowed</th>

                                    @foreach(@$visitings as $req)
                                        @foreach(@$req->faculty_program as $program )
                                         <th> {{@$program->program->name}}:</th>
                                        @endforeach
                                        @break
                                    @endforeach
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @php
                                $totalFTE =0; @endphp

                                @foreach(@$visitings as $req)
                                <tr>
{{--                                    <td>{{$req->campus->business_school->name}}</td>--}}
                                    <td>{{@$req->name}}</td>
                                    <td>{{@$req->lookup_faculty_type->faculty_type}}</td>
                                    <td>{{@$req->designation->name}}</td>
                                    <td>{{@$req->max_cources_allowed}}</td>

                                        @foreach(@$req->faculty_program as $program )
                                        <td>
                                            Courses: {{@$program->tc_program}} <br>
                                            @if(@$req->lookup_faculty_type->faculty_type == 'Visiting')
                                            Program VFE: @else Program FTE:  @endif {{round($program->tc_program/$req->max_cources_allowed, 2)}}
                                            @php $totalFTE += $program->tc_program/$req->max_cources_allowed; @endphp
                                        </td>
                                        @endforeach
                                    <td><i class="badge {{$req->status == 'active'?'bg-green':'bg-red'}}">{{$req->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$req->id}}"></i> |
                                   <i class="fa fa-pencil text-blue edit" data-row='{"id":"{{$req->id}}","name":"{{$req->name}}","tc_program{{$req->id}}":"{{$req->faculty_program[0]->tc_program}}","lookup_faculty_type_id":"{{$req->lookup_faculty_type_id}}","designation_id":"{{$req->designation_id}}","max_cources_allowed":"{{$req->max_cources_allowed}}","status":"{{$req->status}}","isCompleted":"{{$req->isCompleted}}"}' data-toggle="modal" data-target="#edit-modal"></i></td>

                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    @if(@$visitings[0]->lookup_faculty_type->faculty_type == 'Visiting')
                                    <th colspan="4" align="center">Total VFE</th>
                                    <th>Total VFE: {{round($totalFTE/3, 2)}}</th>
                                    @else
                                        <th colspan="4" align="center">Total FTE</th>
                                        <th>Total FTE: {{(round($totalFTE, 2))}}</th>
                                    @endif
                                    @foreach(@$visitings as $req)
                                        @foreach(@$req->faculty_program as $program )
                                            <th> </th>
                                        @endforeach
                                        @break
                                    @endforeach
                                </tr>
                                <tr>
{{--                                    <th>Business School</th>--}}
                                    <th>Name</th>
                                    <th>Faculty Type</th>
                                    <th>Designation</th>
                                    <th>Maximum teaching Courses Allowed</th>
                                    @foreach(@$visitings as $req)
                                        @foreach(@$req->faculty_program as $program )
                                            <th> {{@$program->program->name}}</th>
                                        @endforeach
                                        @break
                                    @endforeach
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
        <div class="modal fade" id="edit-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Regular/Adjunct Faculty </h4>
                    </div>
                        <div class="modal-body">
                    <form role="form" id="updateForm" >
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Faculty Name</label>
                                    <input type="text" name="name" id="edit_name" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group" style="margin-bottom:25px;">
                                    <label for="name">Designation(B)</label>
                                    <select name="designation_id" id="edit_designation_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Designation</option>
                                        @foreach($designations as $designation)
                                            <option value="{{$designation->id}}">{{$designation->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Faculty type(C)</label>
                                    <select name="lookup_faculty_type_id" id="edit_lookup_faculty_type_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Faculty Type</option>
                                        @foreach($faculty_types as $faculty)
                                            <option value="{{$faculty->id}}">{{$faculty->faculty_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Maximum teaching courses Allowed(E)</label>
                                    <input type="number" name="max_cources_allowed" id="edit_max_cources_allowed" class="form-control">
                                    <input type="hidden" name="edit_id" id="edit_id">
                                </div>
                            </div>

                            @foreach($getScope as $program)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Teaching courses in {{$program->program->name}}(F) </label>
                                        <input type="number" name="tc_program[{{$program->program->id}}]" id="edit_tc_program" data-id="{{$program->program->id}}" class="form-control programs">
                                    </div>
                                </div>
                            @endforeach

                            {{--                               <div class="col-md-3">--}}
                            {{--                                   <div class="form-group">--}}
                            {{--                                       <label for="name">Teaching courses in program 2(G)</label>--}}
                            {{--                                       <input type="number" name="tc_program2" id="tc_program2" class="form-control">--}}
                            {{--                                   </div>--}}
                            {{--                               </div>--}}


                            <div class="form-group" >

                                <button type="button" class="btn btn-default float-right" data-dismiss="modal" style="margin-top: 100px">Close</button>
                                <input type="submit" name="update" value="update" class="btn btn-info float-right" style="margin-top: 100px">

                            </div>

                    </form>
                        </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


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
            let lookup_faculty_type_id = $('#lookup_faculty_type_id').val();
            let designation_id = $('#designation_id').val();
            let max_cources_allowed = $('#max_cources_allowed').val();


            let tc_program = $('#tc_program').val();
            // let tc_program2 = $('#tc_program2').val();

            !lookup_faculty_type_id?addClass('lookup_faculty_type_id'):removeClass('lookup_faculty_type_id');
            !designation_id?addClass('designation_id'):removeClass('designation_id');
            !max_cources_allowed?addClass('max_cources_allowed'):removeClass('max_cources_allowed');
            !tc_program?addClass('tc_program'):removeClass('tc_program');
            // !tc_program2?addClass('tc_program2'):removeClass('tc_program2');

            if(!lookup_faculty_type_id || !designation_id || !max_cources_allowed )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("faculty-teaching")}}',
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
             console.log(data);
            $('#edit_lookup_faculty_type_id').select2().val(data.lookup_faculty_type_id).trigger('change');
            $('#edit_designation_id').select2().val(data.designation_id).trigger('change');
            $('#edit_max_cources_allowed').val(data.max_cources_allowed);
            let tc_program_name = "tc_program"+""+data.id;
            console.log(('tc program name', data.tc_program1));
            $('#edit_tc_program').val(data.tc_program1);
            // $('#edit_tc_program2').val(data.tc_program2);
            $('#edit_name').val(data.name);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
            $('input[value='+data.isCompleted+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
    let lookup_faculty_type_id = $('#edit_lookup_faculty_type_id').val();
    let designation_id = $('#edit_designation_id').val();
    let max_cources_allowed = $('#edit_max_cources_allowed').val();


    let tc_program = $('#edit_tc_program').val();
    // let tc_program2 = $('#tc_program2').val();

    !lookup_faculty_type_id?addClass('lookup_faculty_type_id'):removeClass('lookup_faculty_type_id');
    !designation_id?addClass('designation_id'):removeClass('designation_id');
    !max_cources_allowed?addClass('max_cources_allowed'):removeClass('max_cources_allowed');
    !tc_program?addClass('tc_program'):removeClass('tc_program');
    // !tc_program2?addClass('tc_program2'):removeClass('tc_program2');

    if(!lookup_faculty_type_id || !designation_id || !max_cources_allowed )
    {
        Notiflix.Notify.Warning("Fill all the required Fields.");
        return;
    }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("faculty-teaching")}}/'+$('#edit_id').val(),
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
                        url:'{{url("faculty-teaching")}}/'+id,
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
