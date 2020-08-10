@section('pageTitle', 'Student Enrolment')


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
                Students Enrolment
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Students Enrolment </li>
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
                            <h3 class="box-title">Provide the data on student enrolment  of the business school for the last three years in Table 3.1</h3>
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
                        <form action="javascript:void(0)" id="form" method="POST">

                        <div class="box-body">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Year</label>
                                    <select name="year" id="year" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Year</option>
                                        <option value="{{ now()->year}}">{{ now()->year}}</option>
                                        <option value="{{ now()->year-1}}">{{ now()->year - 1}}</option>
                                        <option value="{{ now()->year -2}}">{{ now()->year -2 }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">16 Year Programs</label>
                                    <input type="text" name="bs_level" id="bs_level" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">18 Year Programs</label>
                                    <input type="text" name="ms_level" id="ms_level" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Doctoral Programs</label>
                                    <input type="text" name="phd_level" id="phd_level" class="form-control">
                                </div>
                            </div>
                        

                             <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" id="add" value="Add" class="btn btn-info">
                                </div>
                            </div>
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
                            <h3 class="box-title">List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Year</th>
                                    <th>16 Year</th>
                                    <th>18 Year</th>
                                    <th>Doctoral</th>
                                    <th>Total Enrolment</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($enrolments as $enrolement)
                                <tr>
                                    <td>{{$enrolement->campus->business_school->name}}</td>
                                    <td>{{$enrolement->campus->location}}</td>
                                    <td>{{$enrolement->year}}</td>
                                    <td>{{$enrolement->bs_level}}</td>
                                    <td>{{$enrolement->ms_level}}</td>
                                    <td>{{$enrolement->phd_level}}</td>
                                    <td>{{$enrolement->total_students}}</td>
                                    <td><i class="badge {{$enrolement->status == 'active'?'bg-green':'bg-red'}}">{{$enrolement->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$enrolement->id}}"></i> | <i data-row='{"id":"{{$enrolement->id}}","year":{{$enrolement->year}},"bs_level":"{{$enrolement->bs_level}}","ms_level":"{{$enrolement->ms_level}}","phd_level":"{{$enrolement->phd_level}}","total_students":"{{$enrolement->total_students}}","status":"{{$enrolement->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>

                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Year</th>
                                    <th>16 Year</th>
                                    <th>18 Year</th>
                                    <th>Doctoral</th>
                                    <th>Total Enrolment</th>
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
                    <h4 class="modal-title">Edit Student Enrolment. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">

                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Year</label>
                                    <select name="year" id="edit_year" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Year</option>
                                        <option value="{{ now()->year}}">{{ now()->year}}</option>
                                        <option value="{{ now()->year-1}}">{{ now()->year - 1}}</option>
                                        <option value="{{ now()->year -2}}">{{ now()->year -2 }}</option>
                                    </select>
                                </div>
                                <input type="hidden" name="id" id="edit_id">
                            </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                    <label for="name">16 year Program</label>
                                    <input type="text" name="bs_level" id="edit_bs_level" value="{{old('bs_level')}}" class="form-control">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                    <label for="name">18 year Program</label>
                                    <input type="text" name="ms_level" id="edit_ms_level" value="{{old('ms_level')}}" class="form-control">

                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                    <label for="name">Doctoral Program</label>
                                    <input type="text" name="phd_level" id="edit_phd_level" value="{{old('phd_level')}}" class="form-control">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Total Students</label>
                                    <input type="text" readonly name="total_students"
                                    id="edit_total_students" value="{{old('total_students')}}" class="form-control">
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
            // let uni_id = $('#uni_id').val();
            let year = $('#year').val();
            let bs_level = $('#bs_level').val();
            let ms_level = $('#ms_level').val();
            let phd_level = $('#phd_level').val();

            !year?addClass('year'):removeClass('year');
            !bs_level?addClass('bs_level'):removeClass('bs_level');
            !ms_level?addClass('ms_level'):removeClass('ms_level');
            !phd_level?addClass('phd_level'):removeClass('phd_level');

            if(!year || !bs_level || !ms_level || !phd_level  )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("student-enrolment")}}',
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
            // Initialize Select2
            $('#edit_year').select2().val(data.year).trigger('change');
            $('#edit_bs_level').val(data.bs_level);
            $('#edit_ms_level').val(data.ms_level);
            $('#edit_phd_level').val(data.phd_level);
            $('#edit_total_students').val(data.total_students);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#updateForm').submit(function (e) {
            let year = $('#edit_year').val();
            let bs_level = $('#edit_bs_level').val();
            let ms_level = $('#edit_ms_level').val();
            let phd_level = $('#edit_phd_level').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !year?addClass('edit_year'):removeClass('edit_year');
            !bs_level?addClass('edit_bs_level'):removeClass('edit_bs_level');
            !ms_level?addClass('edit_ms_level'):removeClass('edit_ms_level');
            !phd_level?addClass('edit_phd_level'):removeClass('edit_phd_level');

            if(!year || !bs_level || !ms_level || !phd_level)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("student-enrolment")}}/'+id,
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
                        url:'{{url("student-enrolment")}}/'+id,
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
