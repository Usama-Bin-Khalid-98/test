@section('pageTitle', 'Student Graduated')


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
                Students Graduated
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Students Graduated </li>
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
                            <h3 class="box-title">3.2.State the number of students who have graduated over the past three years for each program under review in Table 3.2</h3>
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
                                    <label for="name">Program(s) under review</label>
                                   <select name="program_id" id="program_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Program(s) under review</option>
                                        @foreach($programs as $program)
                                         <option value="{{$program->program->id}}">{{$program->program->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Year {{$programs->tyear??''}}</label>
                                    <input type="text" name="grad_std_t" id="grad_std_t"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Year {{$programs->year_t_1??''}}</label>
                                    <input type="text" name="grad_std_tt" id="grad_std_tt" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Year {{$programs->year_t_2??''}}</label>
                                    <input type="text" name="grad_std_ttt" id="grad_std_ttt" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" id="add" value="Add & Next" class="btn btn-success next">
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
                            <h3 class="box-title">Table 3.2.Graduated students</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Program(s) under review</th>
                                    <th>Year {{$programs->tyear??''}}</th>
                                    <th>Year {{$programs->year_t_1??''}}</th>
                                    <th>Year {{$programs->year_t_2??''}}</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($students as $enrolement)
                                <tr>
                                    <td>{{$enrolement->campus->business_school->name}}</td>
                                    <td>{{$enrolement->campus->location}}</td>
                                    <td>{{$enrolement->program->name}}</td>
                                    <td>{{$enrolement->grad_std_t}}</td>
                                    <td>{{$enrolement->grad_std_t_1}}</td>
                                    <td>{{$enrolement->grad_std_t_2}}</td>
                                    <td><i class="badge {{$enrolement->status == 'active'?'bg-green':'bg-red'}}">{{$enrolement->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$enrolement->id}}"></i> | <i data-row='{"id":"{{$enrolement->id}}","program_id":"{{$enrolement->program_id}}","grad_std_t":"{{$enrolement->grad_std_t}}","grad_std_t_2":"{{$enrolement->grad_std_t_1}}","grad_std_t_3":"{{$enrolement->grad_std_t_2}}","status":"{{$enrolement->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>

                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Program(s) under review</th>
                                    <th>Year {{$programs->tyear??''}}</th>
                                    <th>Year {{$programs->year_t_1??''}}</th>
                                    <th>Year {{$programs->year_t_2??''}}</th>
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
                    <h4 class="modal-title">Edit Graduated Students. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Program</label>
                                <select name="program_id" id="edit_program_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Program</option>
                                    @foreach($programs as $program)
                                        <option value="{{$program->program->id}}">{{$program->program->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <input type="hidden" name="id" id="edit_id">
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Year t</label>
                                    <input type="text" name="grad_std_t"
                                    id="edit_grad_std_t" value="{{old('edit_grad_std_t')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Year t-1</label>
                                    <input type="text" name="grad_std_t_2"
                                    id="edit_grad_std_t_2" value="{{old('edit_grad_std_t_2')}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Year t-2</label>
                                    <input type="text" name="grad_std_t_3"
                                    id="edit_grad_std_t_3" value="{{old('edit_grad_std_t_3')}}" class="form-control">
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
        let  check = false;

        $('#form').submit(function (e) {
            // let uni_id = $('#uni_id').val();
            let program_id = $('#program_id').val();
            let grad_std_t = $('#grad_std_t').val();
            let grad_std_tt = $('#grad_std_tt').val();
            let grad_std_ttt = $('#grad_std_ttt').val();

            !program_id?addClass('program_id'):removeClass('program_id');
            !grad_std_t?addClass('grad_std_t'):removeClass('grad_std_t');
            !grad_std_tt?addClass('grad_std_tt'):removeClass('grad_std_tt');
            !grad_std_ttt?addClass('grad_std_ttt'):removeClass('grad_std_ttt');

            if(!program_id || !grad_std_t || !grad_std_tt || !grad_std_ttt)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("students-graduated")}}',
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
            // Initialize Select2

            $('#edit_program_id').select2().val(data.program_id).trigger('change');
            $('#edit_grad_std_t').val(data.grad_std_t);
            $('#edit_grad_std_t_2').val(data.grad_std_t_2);
            $('#edit_grad_std_t_3').val(data.grad_std_t_3);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#updateForm').submit(function (e) {
            let program_id = $('#edit_program_id').val();
            let grad_std_t = $('#edit_grad_std_t').val();
            let grad_std_t_2 = $('#edit_grad_std_t_2').val();
            let grad_std_t_3 = $('#edit_grad_std_t_3').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !program_id?addClass('program_id'):removeClass('program_id');
            !grad_std_t?addClass('grad_std_t'):removeClass('grad_std_t');
            !grad_std_t_2?addClass('grad_std_t_2'):removeClass('grad_std_t_2');
            !grad_std_t_3?addClass('grad_std_t_3'):removeClass('grad_std_t_3');

            if(!program_id || !grad_std_t || !grad_std_t_2 || !grad_std_t_3)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("students-graduated")}}/'+id,
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
                        url:'{{url("students-graduated")}}/'+id,
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
                    window.location = '/student-gender';
                }
            }, 1000)
        });




    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
