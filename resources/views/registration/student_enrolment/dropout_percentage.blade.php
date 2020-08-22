@section('pageTitle', 'Dropout Percentage')


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
                Dropout Percentage
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Dropout Percentage </li>
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
                            <h3 class="box-title">3.4.  Provide the average success percentage and drop-out percentage of the last three batches which have graduated in the program(s) under accreditation in Table 3.4. The highlighted row at the bottom of the table provides an example on how to calculate the ratios.</h3>
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
                                    <label for="name">Batch</label>
                                    <select name="year" id="year" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select</option>
                                        <option value="{{ now()->year}}">{{ now()->year}}</option>
                                        <option value="{{ now()->year-1}}">{{ now()->year - 1}}</option>
                                        <option value="{{ now()->year -2}}">{{ now()->year -2 }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Intake of the passing out batch(A)</label>
                                    <input type="number" name="intake" id="intake" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Dropped out due to academic reasons(B)</label>
                                    <input type="number" name="academic_reason" id="academic_reason" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Dropped out due to any other  reasons(C)</label>
                                    <input type="number" name="other_reason" id="other_reason" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Passed out already(D)</label>
                                    <input type="number" name="pass" id="pass" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Pending to pass out(E)</label>
                                    <input type="number" name="pending" id="pending" class="form-control">
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
                            <h3 class="box-title">Table 3.4. Average success percentage and drop-out Percentage</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Program(s) under review</th>
                                    <th>Batch</th>
                                    <th>Intake of the passing out batch(A)</th>
                                    <th>Dropped out due to academic reasons(B)</th>
                                    <th>Dropped out due to any other  reasons(C)</th>
                                    <th>Passed out already(D)</th>
                                    <th>Pending to pass out(E)</th>
                                    <th style="background-color: #D3D3D3">Success percentage=(D+E)/A*100</th>
                                    <th style="background-color: #D3D3D3">Dropout percentage=B/A*100</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($students as $enrolement)
                                <tr>
                                    <td>{{$enrolement->program->name}}</td>
                                    <td>{{$enrolement->year}}</td>
                                    <td>{{$enrolement->intake}}</td>
                                    <td>{{$enrolement->academic_reason}}</td>
                                    <td>{{$enrolement->other_reason}}</td>
                                    <td>{{$enrolement->pass}}</td>
                                    <td>{{$enrolement->pending}}</td>
                                    <td style="background-color: #D3D3D3">{{ number_format($enrolement->pass + $enrolement->pending /$enrolement->intake*100, 2) }}%</td>
                                    <td style="background-color: #D3D3D3">{{ number_format($enrolement->academic_reason/$enrolement->intake*100, 2) }}%</td>
                                    <td><i class="badge {{$enrolement->status == 'active'?'bg-green':'bg-red'}}">{{$enrolement->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$enrolement->id}}"></i> | <i data-row='{"id":"{{$enrolement->id}}","program_id":"{{$enrolement->program_id}}","year":"{{$enrolement->year}}","intake":"{{$enrolement->intake}}","academic_reason":"{{$enrolement->academic_reason}}","other_reason":"{{$enrolement->other_reason}}","pass":"{{$enrolement->pass}}","pending":"{{$enrolement->pending}}","status":"{{$enrolement->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>

                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Program(s) under review</th>
                                    <th>Batch</th>
                                    <th>Intake of the passing out batch(A)</th>
                                    <th>Dropped out due to academic reasons(B)</th>
                                    <th>Dropped out due to any other  reasons(C)</th>
                                    <th>Passed out already(D)</th>
                                    <th>Pending to pass out(E)</th>
                                    <th style="background-color: #D3D3D3">Success percentage=(D+E)/A*100</th>
                                    <th style="background-color: #D3D3D3">Dropout percentage=B/A*100</th>
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
                    <h4 class="modal-title">Edit Dropout Percentage. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Program(s) under review</label>
                                   <select name="program_id" id="edit_program_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Program(s) under review</option>
                                        @foreach($programs as $program)
                                         <option value="{{$program->program->id}}">{{$program->program->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                                <input type="hidden" name="id" id="edit_id">
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Batch</label>
                                    <select name="year" id="edit_year" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select</option>
                                        <option value="{{ now()->year}}">{{ now()->year}}</option>
                                        <option value="{{ now()->year-1}}">{{ now()->year - 1}}</option>
                                        <option value="{{ now()->year -2}}">{{ now()->year -2 }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Intake of the passing out batch(A)</label>
                                    <input type="number" name="intake" id="edit_intake" value="{{old('edit_intake')}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Dropped out due to academic reasons(B)</label>
                                    <input type="number" name="academic_reason" id="edit_academic_reason" value="{{old('edit_academic_reason')}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Dropped out due to any other  reasons(C)</label>
                                    <input type="number" name="other_reason" id="edit_other_reason" value="{{old('edit_other_reason')}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Passed out already(D)</label>
                                    <input type="number" name="pass" id="edit_pass" value="{{old('edit_pass')}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Pending to pass out(E)</label>
                                    <input type="number" name="pending" id="edit_pending" value="{{old('edit_pending')}}" class="form-control">
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
            let program_id = $('#program_id').val();
            let year = $('#year').val();
            let intake = $('#intake').val();
            let academic_reason = $('#academic_reason').val();
            let other_reason = $('#other_reason').val();
            let pass = $('#pass').val();
            let pending = $('#pending').val();

            !program_id?addClass('program_id'):removeClass('program_id');
            !year?addClass('year'):removeClass('year');
            !intake?addClass('intake'):removeClass('intake');
            !academic_reason?addClass('academic_reason'):removeClass('academic_reason');
            !other_reason?addClass('other_reason'):removeClass('other_reason');
            !pass?addClass('pass'):removeClass('pass');
            !pass?addClass('pending'):removeClass('pending');

            if(!program_id || !year || !intake || !academic_reason || !other_reason || !pass || !pending)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("dropout-percentage")}}',
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

            $('#edit_program_id').select2().val(data.program_id).trigger('change');
            $('#edit_year').select2().val(data.year).trigger('change');
            $('#edit_intake').val(data.intake);
            $('#edit_academic_reason').val(data.academic_reason);
            $('#edit_other_reason').val(data.other_reason);
            $('#edit_pass').val(data.pass);
            $('#edit_pending').val(data.pending);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#updateForm').submit(function (e) {
            let program_id = $('#edit_program_id').val();
            let year = $('#edit_year').val();
            let intake = $('#edit_intake').val();
            let academic_reason = $('#edit_academic_reason').val();
            let other_reason = $('#edit_other_reason').val();
            let pass = $('#edit_pass').val();
            let pending = $('#edit_pending').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !program_id?addClass('program_id'):removeClass('program_id');
            !year?addClass('year'):removeClass('year');
            !intake?addClass('intake'):removeClass('intake');
            !academic_reason?addClass('academic_reason'):removeClass('academic_reason');
            !other_reason?addClass('other_reason'):removeClass('other_reason');
            !pass?addClass('pass'):removeClass('pass');
            !pass?addClass('pending'):removeClass('pending');

            if(!program_id || !year || !intake || !academic_reason || !other_reason || !pass || !pending)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("dropout-percentage")}}/'+id,
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
                        url:'{{url("dropout-percentage")}}/'+id,
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
