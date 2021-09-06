@section('pageTitle', 'Statutory Body Meetings')


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
                Statutory Body Meetings
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Statutory Body Meetings </li>
            </ol>
        </section>

        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                     <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">8.3.  Provide data of international representatives who have participated in formal meetings of any statutorybodies either as permanent members or through special invitation over the last three years in Table8.3. </h3>
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
                                    <label for="name">Participant name</label>
                                    <input type="text"  name="participant_name" id="participant_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Designation</label>
                                   <select name="designation_id" id="designation_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Designation</option>
                                        @foreach($designation as $scope)
                                         <option value="{{$scope->id}}">{{$scope->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Affiliation</label>
                                    <input type="text"  name="affiliation" id="affiliation" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Statutory body</label>
                                   <select name="statutory_bodies_id" id="statutory_bodies_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Statutory body</option>
                                        @foreach($body as $bod)
                                         <option value="{{$bod->id}}">{{$bod->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Meeting date</label>
                                    <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text"  name="meeting_date" id="meeting_date" value="<?php echo date('m/d/Y'); ?>" class="form-control">
                                </div>
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
                            <h3 class="box-title">Table 8.3. List of international participants of statutory body meetings</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>

                                    <th>Participant name</th>
                                    <th>Designation</th>
                                    <th>Affiliation</th>
                                    <th>Statutory body</th>
                                    <th>Meeting date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($genders as $enrolement)
                                <tr>
                                    <td>{{$enrolement->participant_name}}</td>
                                    <td>{{$enrolement->designation->name}}</td>
                                    <td>{{$enrolement->affiliation}}</td>
                                    <td>{{@$enrolement->statutory_bodies->name}}</td>
                                    <td>{{$enrolement->meeting_date}}</td>
                                    <td><i class="badge {{$enrolement->status == 'active'?'bg-green':'bg-red'}}">{{$enrolement->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$enrolement->id}}"></i> | <i data-row='{"id":"{{$enrolement->id}}","participant_name":"{{$enrolement->participant_name}}","designation_id":"{{$enrolement->designation_id}}","affiliation":"{{$enrolement->affiliation}}","statutory_bodies_id":"{{$enrolement->statutory_bodies_id}}","meeting_date":"{{$enrolement->meeting_date}}","status":"{{$enrolement->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>

                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Participant name</th>
                                    <th>Designation</th>
                                    <th>Affiliation</th>
                                    <th>Statutory body</th>
                                    <th>Meeting date</th>
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
                    <h4 class="modal-title">Edit Placement Activities </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Participant name</label>
                                    <input type="text" name="participant_name"
                                    id="edit_participant_name" value="{{old('edit_participant_name')}}" class="form-control">
                            </div>
                             <input type="hidden" name="id" id="edit_id">
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Designation</label>
                                   <select name="designation_id" id="edit_designation_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Designation</option>
                                        @foreach($designation as $scope)
                                         <option value="{{$scope->id}}">{{$scope->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Affiliation</label>
                                    <input type="text" name="affiliation"
                                    id="edit_affiliation" value="{{old('edit_affiliation')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Statutory body</label>
                                   <select name="statutory_bodies_id" id="edit_statutory_bodies_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Statutory body</option>
                                        @foreach($body as $bod)
                                         <option value="{{$bod->id}}">{{$bod->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Meeting date</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text" name="meeting_date"
                                    id="edit_meeting_date" value="{{old('edit_meeting_date')}}" class="form-control">
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


     <script src="{{URL::asset('notiflix/notiflix-2.3.2.min.js')}}"></script>
    @include("../includes.footer")
    <script src="{{URL::asset('plugins/iCheck/icheck.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{URL::asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{URL::asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
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
    $("#datatable").DataTable({
      dom : "lBfrtip",
    })
  })
    </script>
    <script type="text/javascript">

        $('.select2').select2();
         $('#meeting_date').datepicker({
      autoclose:true
    });
          $('#edit_meeting_date').datepicker({
      autoclose:true
    });

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#form').submit(function (e) {
            // let uni_id = $('#uni_id').val();
            let participant_name = $('#participant_name').val();
            let designation_id = $('#designation_id').val();
            let affiliation = $('#affiliation').val();
            let statutory_bodies_id = $('#statutory_bodies_id').val();
            let meeting_date = $('#meeting_date').val();

            !participant_name?addClass('participant_name'):removeClass('participant_name');
            !designation_id?addClass('designation_id'):removeClass('designation_id');
            !affiliation?addClass('affiliation'):removeClass('affiliation');
            !statutory_bodies_id?addClass('statutory_bodies_id'):removeClass('statutory_bodies_id');
            !meeting_date?addClass('meeting_date'):removeClass('meeting_date');

            if(!participant_name || !designation_id || !affiliation || !statutory_bodies_id || !meeting_date )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("body-meeting")}}',
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

            $('#edit_participant_name').val(data.participant_name);
            $('#edit_designation_id').select2().val(data.designation_id).trigger('change');
            $('#edit_affiliation').val(data.affiliation);
            $('#edit_statutory_bodies_id').select2().val(data.statutory_bodies_id).trigger('change');
            $('#edit_meeting_date').val(data.meeting_date);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#updateForm').submit(function (e) {
            let participant_name = $('#edit_participant_name').val();
            let designation_id = $('#edit_designation_id').val();
            let affiliation = $('#edit_affiliation').val();
            let statutory_bodies_id = $('#edit_statutory_bodies_id').val();
            let meeting_date = $('#edit_meeting_date').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !participant_name?addClass('participant_name'):removeClass('participant_name');
            !designation_id?addClass('designation_id'):removeClass('designation_id');
            !affiliation?addClass('affiliation'):removeClass('affiliation');
            !statutory_bodies_id?addClass('statutory_bodies_id'):removeClass('statutory_bodies_id');
            !meeting_date?addClass('meeting_date'):removeClass('meeting_date');

            if(!participant_name || !designation_id || !affiliation || !statutory_bodies_id || !meeting_date )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("body-meeting")}}/'+id,
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
                        url:'{{url("body-meeting")}}/'+id,
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
