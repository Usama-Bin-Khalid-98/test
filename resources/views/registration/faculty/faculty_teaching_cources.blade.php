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
                Visiting Faculty 
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active">Visiting Faculty</li>
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
                            <h3 class="box-title">Provide data for Full Time Equivalent (FTE) for the permanent, regular and adjunct faculty of last year and Visiting Faculty Equivalent (VFE) of last year.</h3>
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
                                    <label for="name">Business School</label>
                                   <select name="business_school_id" id="business_school_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Business School</option>
                                        @foreach($businesses as $business)
                                         <option value="{{$business->id}}">{{$business->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Faculty Type</label>
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
                                    <label for="name">Designation</label>
                                   <select name="lookup_faculty_designation_id" id="lookup_faculty_designation_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Designation</option>
                                        @foreach($designations as $business)
                                         <option value="{{$business->id}}">{{$business->faculty_designation}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">MAX Courses Allowed</label>
                                    <input type="number" name="max_cources_allowed" id="max_cources_allowed" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Program 1</label>
                                    <input type="number" name="tc_program1" id="tc_program1" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Program 2</label>
                                    <input type="number" name="tc_program2" id="tc_program2" class="form-control">
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
                            <h3 class="box-title">Data for Full Time Equivalent (FTE) for the permanent, regular and adjunct faculty of last year.</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Business School</th>
                                    <th>Faculty Type</th>
                                    <th>Designation</th>
                                    <th>Max Cources Allowed</th>
                                    <th>Program 1</th>
                                    <th>Program 2</th>
                                    <th>Status</th>
                                    <th>isComplete</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($visitings as $req)
                                <tr>
                                    <td>{{$req->business_school->name}}</td>
                                    <td>{{$req->lookup_faculty_type->faculty_type}}</td>
                                    <td>{{$req->lookup_faculty_designation->faculty_designation}}</td>
                                    <td>{{$req->max_cources_allowed}}</td>
                                    <td>{{$req->tc_program1}}</td>
                                    <td>{{$req->tc_program2}}</td>
                                    <td><i class="badge {{$req->status == 'active'?'bg-green':'bg-red'}}">{{$req->status == 'active'?'Active':'Inactive'}}</i></td>
                                    <td><i class="badge {{$req->isComplete == 'yes'?'bg-green':'bg-red'}}">{{$req->isComplete == 'yes'?'Yes':'No'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$req->id}}"></i> | <i class="fa fa-pencil text-blue edit" data-row='{"id":"{{$req->id}}","business_school_id":"{{$req->business_school_id}}","lookup_faculty_type_id":"{{$req->lookup_faculty_type_id}}","lookup_faculty_designation_id":"{{$req->lookup_faculty_designation_id}}","max_cources_allowed":"{{$req->max_cources_allowed}}","tc_program1":"{{$req->tc_program1}}","tc_program2":"{{$req->tc_program2}}","status":"{{$req->status}}","isComplete":"{{$req->isComplete}}"}' data-toggle="modal" data-target="#edit-modal"></i></td>

                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Business School</th>
                                    <th>Faculty Type</th>
                                    <th>Designation</th>
                                    <th>Max Cources Allowed</th>
                                    <th>Program 1</th>
                                    <th>Program 2</th>
                                    <th>Status</th>
                                    <th>isComplete</th>
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
                    <h4 class="modal-title">Edit Faculty Student Ratio. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Business School</label>
                                   <select name="business_school_id" id="edit_business_school_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Business School</option>
                                        @foreach($businesses as $business)
                                         <option value="{{$business->id}}">{{$business->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                                <input type="hidden" id="edit_id">
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Faculty Type</label>
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
                                    <label for="name">Designation</label>
                                   <select name="lookup_faculty_designation_id" id="edit_lookup_faculty_designation_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Designation</option>
                                        @foreach($designations as $business)
                                         <option value="{{$business->id}}">{{$business->faculty_designation}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Max Cources allowed</label>
                                    <input type="number" name="max_cources_allowed" id="edit_max_cources_allowed" value="{{old('edit_max_cources_allowed')}}" class="form-control">
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Program1</label>
                                    <input type="number" name="tc_program1" id="edit_tc_program1" value="{{old('edit_tc_program1')}}" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">program2</label>
                                    <input type="number" name="tc_program2" id="edit_tc_program2" value="{{old('edit_tc_program2')}}" class="form-control">
                                </div>
                              </div>
                            

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">{{ __('Status') }} : </label>
                                <p><input type="radio" name="status" class="flat-red" value="active" > Active
                                    <input type="radio" name="status" class="flat-red" value="inactive">InActive</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">{{ __('isComplete') }} : </label>
                                <p><input type="radio" name="isComplete" class="flat-red" value="yes" >Yes
                                    <input type="radio" name="isComplete" class="flat-red" value="no">No</p>
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
            let business_school_id = $('#business_school_id').val();
            let lookup_faculty_type_id = $('#lookup_faculty_type_id').val();
            let lookup_faculty_designation_id = $('#lookup_faculty_designation_id').val();
            let max_cources_allowed = $('#max_cources_allowed').val();
            let tc_program1 = $('#tc_program1').val();
            let tc_program2 = $('#tc_program2').val();

            !business_school_id?addClass('business_school_id'):removeClass('business_school_id');
            !lookup_faculty_type_id?addClass('lookup_faculty_type_id'):removeClass('lookup_faculty_type_id');
            !lookup_faculty_designation_id?addClass('lookup_faculty_designation_id'):removeClass('lookup_faculty_designation_id');
            !max_cources_allowed?addClass('max_cources_allowed'):removeClass('max_cources_allowed');
            !tc_program1?addClass('tc_program1'):removeClass('tc_program1');
            !tc_program2?addClass('tc_program2'):removeClass('tc_program2');

            if(!business_school_id || !lookup_faculty_type_id || !lookup_faculty_designation_id || !max_cources_allowed || !tc_program1 || !tc_program2)
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
            $('#edit_business_school_id').select2().val(data.business_school_id).trigger('change');
            $('#edit_lookup_faculty_type_id').select2().val(data.lookup_faculty_type_id).trigger('change');
            $('#edit_lookup_faculty_designation_id').select2().val(data.lookup_faculty_designation_id).trigger('change');
            $('#edit_max_cources_allowed').val(data.max_cources_allowed);
            $('#edit_tc_program1').val(data.tc_program1);
            $('#edit_tc_program2').val(data.tc_program2);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
            $('input[value='+data.isComplete+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let business_school_id = $('#edit_business_school_id').val();
            let lookup_faculty_type_id = $('#edit_lookup_faculty_type_id').val();
            let lookup_faculty_designation_id = $('#edit_lookup_faculty_designation_id').val();
            let max_cources_allowed = $('#edit_max_cources_allowed').val();
            let tc_program1 = $('#edit_tc_program1').val();
            let tc_program2 = $('#edit_tc_program2').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            let isComplete = $('input[name=edit_isComplete]:checked').val();
            !business_school_id?addClass('edit_business_school_id'):removeClass('edit_business_school_id');
            !lookup_faculty_type_id?addClass('edit_lookup_faculty_type_id'):removeClass('edit_lookup_faculty_type_id');
            !lookup_faculty_designation_id?addClass('edit_lookup_faculty_designation_id'):removeClass('edit_lookup_faculty_designation_id');
            !max_cources_allowed?addClass('edit_max_cources_allowed'):removeClass('edit_max_cources_allowed');
            !tc_program1?addClass('edit_tc_program1'):removeClass('edit_tc_program1');
            !tc_program2?addClass('edit_tc_program2'):removeClass('edit_tc_program2');

            if(!business_school_id || !lookup_faculty_type_id || !lookup_faculty_designation_id || !max_cources_allowed || !tc_program1 || !tc_program2 )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("faculty-teaching")}}/'+id,
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
