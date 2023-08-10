@section('pageTitle', 'Complaint Resolution')


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
                Complaint Resolution
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active">Complaint Resolution</li>
            </ol>
        </section>


        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <p class="box-title">Attach the business school’s code of moral principles and ethics applicable to faculty, students and staff as Appendix-6C. Provide data on complaint resolution in Table 6.5</p>

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
                                    <label for="name">Date</label>
                                    <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text" name="date" id="date" value="<?php echo date('m/d/Y'); ?>"  class="form-control">
                                </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Complaint Description</label>
                                    <input type="text" name="complaint_desc" id="complaint_desc"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Arbitrating authority</label>
                                    <input type="text" name="arbitrating_authority" id="arbitrating_authority"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Solution</label>
                                    <input type="text" name="solution" id="solution"  class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Attach Doc</label>
                                    <input type="file" name="file" id="file" >
                                    <span class="text-red">Max upload file size 2mb.</span>
                                </div>
                            </div>

                             <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" id="add-and-next" value="Add & Next" class="btn btn-success">
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
                            <h3 class="box-title">Complaint Resolution List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Business School Name</th>
                                    <th>Campus</th>
                                    <th>Date</th>
                                    <th>Complaint Description</th>
                                    <th>Arbitrating authority</th>
                                    <th>Solution</th>
                                    <th>Document</th>
                                    <th>Status</th>
                                    <th>isCompleted</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($resolutions as $contact)
                                <tr>
                                    <td>{{$contact->campus->business_school->name}}</td>
                                    <td>{{$contact->campus->location}}</td>
                                    <td>{{$contact->date}}</td>
                                    <td>{{$contact->complaint_desc}}</td>
                                    <td>{{$contact->arbitrating_authority}}</td>
                                    <td>{{$contact->solution}}</td>
                                    <td><a href="{{url($contact->file)}}"><i class="fa fa-file-word-o"></i></a> </td>
                                    <td><i class="badge {{$contact->status == 'active'?'bg-green':'bg-red'}}">{{$contact->status == 'active'?'Active':'Inactive'}}</i></td>
                                    <td><i class="badge {{$contact->isComplete == 'yes'?'bg-green':'bg-red'}}">{{$contact->isComplete == 'yes'?'Yes':'No'}}</i></td>
                                    <td><i class="fa fa-trash text-info delete" data-id="{{$contact->id}}"></i> | <i data-row='{"id":"{{$contact->id}}","date":"{{$contact->date}}","complaint_desc":"{{$contact->complaint_desc}}","arbitrating_authority":"{{$contact->arbitrating_authority}}","solution":"{{$contact->solution}}","file":"{{$contact->file}}","isComplete":"{{$contact->isComplete}}","status":"{{$contact->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>
                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Business School Name</th>
                                    <th>Campus</th>
                                    <th>Date</th>
                                    <th>Complaint Description</th>
                                    <th>Arbitrating authority</th>
                                    <th>Solution</th>
                                    <th>Document</th>
                                    <th>Status</th>
                                    <th>isCompleted</th>
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
                    <h4 class="modal-title">Edit Complaint Resolution. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">


                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Date</label>
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
                                    <label for="name">Complaint description</label>
                                    <input type="text" name="complaint_desc" id="edit_complaint_desc" value="{{old('edit_complaint_desc')}}" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Arbitrating authority</label>
                                    <input type="text" name="arbitrating_authority" id="edit_arbitrating_authority" value="{{old('edit_arbitrating_authority')}}" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Solution</label>
                                    <input type="text" name="solution" id="edit_solution" value="{{old('edit_solution')}}" class="form-control">
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

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">{{ __('isCompleted') }} : </label>
                                <p><input type="radio" name="isComplete" class="flat-red" value="yes" > Yes
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
            let next = false;
            if(e.originalEvent.submitter.id === 'add-and-next'){
                next = true;
            }
            let date = $('#date').val();
            let complaint_desc = $('#complaint_desc').val();
            let arbitrating_authority = $('#arbitrating_authority').val();
            let solution = $('#solution').val();
            let file = $('#file').val();

            !date?addClass('date'):removeClass('date');
            !complaint_desc?addClass('complaint_desc'):removeClass('complaint_desc');
            !arbitrating_authority?addClass('arbitrating_authority'):removeClass('arbitrating_authority');
            !solution?addClass('solution'):removeClass('solution');
            !file?addClass('file'):removeClass('file');

            if(!date || !complaint_desc || !arbitrating_authority || !solution || !file)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("complaint-resolution")}}',
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
                    if(next){
                        setTimeout(() => {
                            window.location = '/internal-community';
                        }, 1000);
                    }else{
                        location.reload();
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


         $('.edit').on('click', function () {
            // let data = JSON.parse(JSON.stringify($(this).data('row')));
             let data = JSON.parse(JSON.stringify($(this).data('row')));
            $('#edit_date').val(data.date);
            $('#edit_complaint_desc').val(data.complaint_desc);
            $('#edit_arbitrating_authority').val(data.arbitrating_authority);
            $('#edit_solution').val(data.solution);
            $('#file-name').text(data.file);;
            $('#edit_id').val(data.id);
            $('input[value='+data.isComplete+']').iCheck('check');
            $('input[value='+data.status+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let date = $('#edit_date').val();
            let complaint_desc = $('#edit_complaint_desc').val();
            let arbitrating_authority = $('#edit_arbitrating_authority').val();
            let solution = $('#edit_solution').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            let isCompleted = $('input[name=edit_isComplete]:checked').val();
            !date?addClass('edit_date'):removeClass('edit_date');
            !complaint_desc?addClass('edit_complaint_desc'):removeClass('edit_complaint_desc');
            !arbitrating_authority?addClass('edit_arbitrating_authority'):removeClass('edit_arbitrating_authority');
            !solution?addClass('edit_solution'):removeClass('edit_solution');

            if(!date || !complaint_desc || !arbitrating_authority || !solution )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("complaint-resolution")}}/'+id,
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
                        url:'{{url("complaint-resolution")}}/'+id,
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
