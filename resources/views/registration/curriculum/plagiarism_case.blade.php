@section('pageTitle', 'Plagiarism Case')


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
                Plagiarism Case
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active">Plagiarism Case</li>
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
                            <p class="box-title">2.17.  Provide a list of all academic dishonesty/plagiarism cases in the business school in the last three years in Table 2.11.    Attach the policy of business school on academic honesty and plagiarism as Appendix-2E.</p>

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
                            

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Date of incident</label>
                                    <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text" name="date" id="date" value="<?php echo date('m/d/Y'); ?>" class="form-control">
                                </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Initial of students</label>
                                    <input type="text" name="students_initial" id="students_initial"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Degree program</label>
                                    <input type="text" name="degree" id="degree"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Nature of dishonesty</label>
                                    <input type="text" name="nature" id="nature"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Penalty/consequences</label>
                                    <input type="text" name="penalty" id="penalty"  class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Attach Doc</label>
                                    <input type="file" name="file" id="file" >
                                    <span class="text-red">Max upload file size 2mb.</span>
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
                            <h3 class="box-title">Table 2.11. List of academic dishonesty and plagiarism cases</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Date of incident</th>
                                    <th>Initial of students</th>
                                    <th>Degree program</th>
                                    <th>Nature of dishonesty</th>
                                    <th>Penalty/consequences</th>
                                    <th>Document</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($memberships as $contact)
                                 <tr>
                                    <td>{{$contact->date}}</td>
                                    <td>{{$contact->students_initial}}</td>
                                    <td>{{$contact->degree}}</td>
                                    <td>{{$contact->nature}}</td>
                                    <td>{{$contact->penalty}}</td>
                                    <td><a href="{{url($contact->file)}}"><i class="fa fa-file-word-o"></i></a> </td>
                                    <td><i class="badge {{$contact->status == 'active'?'bg-green':'bg-red'}}">{{$contact->status == 'active'?'Active':'Inactive'}}</i></td>
                                    <td><i class="fa fa-trash text-info delete" data-id="{{$contact->id}}"></i> | <i data-row='{"id":"{{$contact->id}}","date":"{{$contact->date}}","students_initial":"{{$contact->students_initial}}","degree":"{{$contact->degree}}","nature":"{{$contact->nature}}","penalty":"{{$contact->penalty}}","file":"{{$contact->file}}","status":"{{$contact->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>
                                </tr> 
                                @endforeach 
                                 
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Date of incident</th>
                                    <th>Initial of students</th>
                                    <th>Degree program</th>
                                    <th>Nature of dishonesty</th>
                                    <th>Penalty/consequences</th>
                                    <th>Document</th>
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
            <!-- /.row -->

            <!-- /.row -->

            <!-- /.content -->


        </section>

    </div>

    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Plagiarism Case</h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Date of incident</label>\
                                    <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text" name="date" id="edit_date" value="{{old('edit_date')}}" class="form-control">
                                </div>
                                </div>
                                 <input type="hidden" id="edit_id">
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Initial of students</label>
                                    <input type="text" name="students_initial" id="edit_students_initial" value="{{old('edit_students_initial')}}" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Degree program</label>
                                    <input type="text" name="degree" id="edit_degree" value="{{old('edit_degree')}}" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nature of dishonesty</label>
                                    <input type="text" name="nature" id="edit_nature" value="{{old('edit_nature')}}" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Penalty/consequences</label>
                                    <input type="text" name="penalty" id="edit_penalty" value="{{old('edit_penalty')}}" class="form-control">
                                </div>
                              </div>

                              <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Attach Doc</label>
                                <input type="file" name="file" id="edit_file" >
                                <input type="hidden" name="old_file" id="old_file" >
                                <span class="text-blue" id="file-name"></span>
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

        $('.select2').select2();
        $('#date').datepicker({
      autoclose:true
    });
        $('#edit_date').datepicker({
      autoclose:true
    });

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

         $('#form').submit(function (e) {
            let date = $('#date').val();
            let students_initial = $('#students_initial').val();
            let degree = $('#degree').val();
            let nature = $('#nature').val();
            let penalty = $('#penalty').val();
            let file = $('#file').val();

            !date?addClass('date'):removeClass('date');
            !students_initial?addClass('students_initial'):removeClass('students_initial');
            !degree?addClass('degree'):removeClass('degree');
            !nature?addClass('nature'):removeClass('nature');
            !penalty?addClass('penalty'):removeClass('penalty');
            !file?addClass('file'):removeClass('file');

            if(!date || !students_initial || !degree || !nature || !penalty || !file)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("plagiarism-case")}}',
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
            $('#edit_date').val(data.date);
            $('#edit_students_initial').val(data.students_initial);
            $('#edit_degree').val(data.degree);
            $('#edit_nature').val(data.nature);
            $('#edit_penalty').val(data.penalty);
            $('#file-name').text(data.file);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let date = $('#edit_date').val();
            let students_initial = $('#edit_students_initial').val();
            let degree = $('#edit_degree').val();
            let nature = $('#edit_nature').val();
            let penalty = $('#edit_penalty').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !date?addClass('edit_date'):removeClass('edit_date');
            !students_initial?addClass('students_initial'):removeClass('edit_students_initial');
            !degree?addClass('edit_degree'):removeClass('edit_degree');
            !nature?addClass('nature'):removeClass('edit_nature');
            !penalty?addClass('edit_penalty'):removeClass('edit_penalty');

            if(!date || !students_initial || !degree || !nature || !penalty || !file )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("plagiarism-case")}}/'+id,
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
                        url:'{{url("plagiarism-case")}}/'+id,
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
