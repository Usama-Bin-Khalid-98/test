@section('pageTitle', 'Linkages')


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
                Linkages
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Linkages </li>
            </ol>
        </section>

        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                     <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">8.2.  Provide data of MoUscoveringnational,international, corporate or social linkagesinTable8.2. Attach the relevant policy as Appendix-8A. </h3>
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
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Type</label>
                                    <select name="type" id="type" class="form-control select2">
                                        @foreach($academyTypes as $type)
                                        <option value="{{$type->name}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
{{--                                    <input type="text"  name="type" id="type" class="form-control">--}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Location</label>
                                    <input type="text"  name="location" id="location" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Level</label>
                                    <select name="level" id="level" class="form-control select2">
                                        @foreach($academyLevels as $level)
                                            <option value="{{$level->name}}">{{$level->name}}</option>
                                        @endforeach
                                    </select>
{{--                                    <input type="text"  name="level" id="level" class="form-control">--}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Signing date</label>
                                    <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text"  name="signing_date" id="signing_date" value="<?php echo date('m/d/Y'); ?>" class="form-control">
                                </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Last activity date</label>
                                    <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text"  name="last_activity_date" id="last_activity_date" value="<?php echo date('m/d/Y'); ?>" class="form-control">
                                </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Last activity title</label>
                                    <input type="text"  name="last_activity_title" id="last_activity_title" class="form-control">
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
                            <h3 class="box-title">Table 8.2. List of MoUs of national and international linkages</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Location</th>
                                    <th>Level</th>
                                    <th>Signing date</th>
                                    <th>Last activity date</th>
                                    <th>Last activity title</th>
                                    <th>document</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3" style="background-color: grey; color: white; text-align: center;">Partner institution details</td>
                                        <td colspan="4" style="background-color: grey; color: white; text-align: center;">Mou detail</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                               @foreach($genders as $enrolement)
                                <tr>
                                    <td>{{$enrolement->name}}</td>
                                    <td>{{$enrolement->type}}</td>
                                    <td>{{$enrolement->location}}</td>
                                    <td>{{$enrolement->level}}</td>
                                    <td>{{$enrolement->signing_date}}</td>
                                    <td>{{$enrolement->last_activity_date}}</td>
                                    <td>{{$enrolement->last_activity_title}}</td>
                                    <td><a href="{{url($enrolement->file)}}"><i class="fa fa-file-word-o"></i></a> </td>
                                    <td><i class="badge {{$enrolement->status == 'active'?'bg-green':'bg-red'}}">{{$enrolement->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$enrolement->id}}"></i> | <i data-row='{"id":"{{$enrolement->id}}","name":"{{$enrolement->name}}","type":"{{$enrolement->type}}","location":"{{$enrolement->location}}","level":"{{$enrolement->level}}","signing_date":"{{$enrolement->signing_date}}","last_activity_date":"{{$enrolement->last_activity_date}}","last_activity_title":"{{$enrolement->last_activity_title}}","file":"{{$enrolement->file}}","status":"{{$enrolement->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>

                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Location</th>
                                    <th>Level</th>
                                    <th>Signing date</th>
                                    <th>Last activity date</th>
                                    <th>Last activity title</th>
                                    <th>document</th>
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
                    <h4 class="modal-title">Edit Linkages </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                       <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                    <input type="text" name="name"
                                    id="edit_name" value="{{old('edit_name')}}" class="form-control">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Type</label>
{{--                                    <input type="text" name="type"--}}
{{--                                    id="edit_type" value="{{old('edit_type')}}" class="form-control">--}}
                                <select name="type" id="edit_type" class="form-control select2">
                                    @foreach($academyTypes as $type)
                                        <option value="{{$type->name}}" {{old('edit_type') == $type->name? 'selected':''}}>{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                             <input type="hidden" name="id" id="edit_id">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Location</label>
                                    <input type="text" name="location"
                                    id="edit_location" value="{{old('edit_location')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Level</label>
{{--                                    <input type="text" name="level"--}}
{{--                                    id="edit_level" value="{{old('edit_level')}}" class="form-control">--}}
                                <select name="level" id="edit_level" class="form-control select2">
                                    @foreach($academyLevels as $level)
                                        <option value="{{$level->name}}" {{old('edit_level') == $level->name? 'selected':''}}>{{$level->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Signing date</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text" name="signing_date"
                                    id="edit_signing_date" value="{{old('edit_signing_date')}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Last activity date</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text" name="last_activity_date"
                                    id="edit_last_activity_date" value="{{old('edit_last_activity_date')}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Last activity title</label>
                                    <input type="text" name="last_activity_title"
                                    id="edit_last_activity_title" value="{{old('edit_last_activity_title')}}" class="form-control">
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
         $('#signing_date').datepicker({
      autoclose:true
    });
          $('#last_activity_date').datepicker({
      autoclose:true
    });
           $('#edit_signing_date').datepicker({
      autoclose:true
    });
            $('#edit_last_activity_date').datepicker({
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
            // let uni_id = $('#uni_id').val();
            let name = $('#name').val();
            let type = $('#type').val();
            let location = $('#location').val();
            let level = $('#level').val();
            let signing_date = $('#signing_date').val();
            let last_activity_date = $('#last_activity_date').val();
            let last_activity_title = $('#last_activity_title').val();
            let file = $('#file').val();

            !name?addClass('name'):removeClass('name');
            !type?addClass('type'):removeClass('type');
            !location?addClass('location'):removeClass('location');
            !level?addClass('level'):removeClass('level');
            !signing_date?addClass('signing_date'):removeClass('signing_date');
            !last_activity_date?addClass('last_activity_date'):removeClass('last_activity_date');
            !last_activity_title?addClass('last_activity_title'):removeClass('last_activity_title');
            !file?addClass('file'):removeClass('file');

            if(!name || !type || !location || !level || !signing_date || !last_activity_date || !last_activity_title || !file )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            // e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("linkages")}}',
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
                            window.location = '/body-meeting';
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
            let data = JSON.parse(JSON.stringify($(this).data('row')));
            // Initialize Select2

            $('#edit_name').val(data.name);
            $('#edit_type').val(data.type);
            $('#edit_location').val(data.location);
            $('#edit_level').val(data.level);
            $('#edit_signing_date').val(data.signing_date);
            $('#edit_last_activity_date').val(data.last_activity_date);
            $('#edit_last_activity_title').val(data.last_activity_title);
            $('#file-name').text(data.file);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#updateForm').submit(function (e) {
            let name = $('#edit_name').val();
            let type = $('#edit_type').val();
            let location = $('#edit_location').val();
            let level = $('#edit_level').val();
            let signing_date = $('#edit_signing_date').val();
            let last_activity_date = $('#edit_last_activity_date').val();
            let last_activity_title = $('#edit_last_activity_title').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !name?addClass('name'):removeClass('name');
            !type?addClass('type'):removeClass('type');
            !location?addClass('location'):removeClass('location');
            !level?addClass('level'):removeClass('level');
            !signing_date?addClass('signing_date'):removeClass('signing_date');
            !last_activity_date?addClass('last_activity_date'):removeClass('last_activity_date');
            !last_activity_title?addClass('last_activity_title'):removeClass('last_activity_title');

            if(!name || !type || !location || !level || !signing_date || !last_activity_date || !last_activity_title )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("linkages")}}/'+id,
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
                        url:'{{url("linkages")}}/'+id,
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
