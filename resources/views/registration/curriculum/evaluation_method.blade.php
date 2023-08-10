@section('pageTitle', 'Evaluation Method')


@if(Auth::user())

    @include("../includes.head")
    <link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/iCheck/all.css')}}">
    <style>
        .fontsize{
            font-size: 12px !important;
        }
    </style>
    @include("../includes.header")
    @include("../includes.nav")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               Evaluation Method
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Evaluation Method </li>
            </ol>
        </section>
        <section class="content-header">
            <div class="col-md-12 new-button">
                <div class="pull-right">
                    <button class="btn gradient-bg-color"
                           data-toggle="modal" data-target="#add-modal"
                           style="color: white;">PDF <i class="fa fa-file-pdf-o"></i></button>
                </div>
            </div>
        </section>

        {{--Dean section --}}
        <section class="content">
            <div class=" form row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">2.14. List evaluation methods by frequency of use in Table 2.10. Attach grading policy as Appendix-2B.</h3>
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
                        <div class="box-body" style="padding: 0px;">
                             <form action="javascript:void(0)" method="post" id="add" enctype="multipart/form-data">
                                 <table class="table table-bordered " style="font-size: 5px;" >
                                     <thead>
                                     <th class="fontsize">Items</th>
                                     <th class="fontsize">Frequency</th>
                                      <th class="fontsize">Range of marks</th>
                                     <th class="fontsize">File</th>
                                     </thead>
                                     <tbody>

                                         @foreach($items as $body)
                                     <tr>
                                            <td class="fontsize">
                                                {{@$body->name}}
                                                <input type="hidden" name="evaluation_items_id[]" id="evaluation_items_id_{{@$body->id}}" value="{{@$body->id}}">
                                            </td>
                                         <td><input type="textval" name="frequency[]"  class="form-control"></td>
                                         <td><input type="textval" name="range[]"  class="form-control"></td>
                                         <td style="font-size: 10px"><input type="file" name="file{{$loop->iteration}}" value=""></td>
                                     </tr>
                                         @endforeach
                                     </tbody>
                                 </table>
                            <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 20px;">
                                    <label for="name"></label>
                                    <input type="submit" name="add" id="add-and-next" value="Submit & Next" class="btn btn-success">
                                    <input type="submit" name="add" value="Submit" class="btn btn-info">
                                </div>
                            </div>
                        <!-- /.box-body -->
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- Main content -->
            </div>

            <div class="form row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Table 2.10. Evaluation methods</h3>
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

                    {{--  Content here --}}
                    <!-- /.box -->

                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="statutoryTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Items</th>
                                    <th>Frequency</th>
                                    <th>Range of marks</th>
                                    <th>File</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($methods as $committee)
                                <tr>
                                    <td>{{$committee->evaluation_items->name}}</td>
                                    <td>{{$committee->frequency}} </td>
                                    <td>{{$committee->range}}</td>
                                    <td><a href="{{url($committee->file)}}">file</a></td>
                                    <td><div class="badge {{$committee->status=='active'?'bg-green':'bg-red'}}">{{$committee->status=='active'?'Active':'Inactive'}}</div></td>
                                    <td><i class="fa fa-trash text-info delete" data-id="{{$committee->id}}"></i> |
                                        <i class="fa fa-pencil text-blue edit" data-toggle="modal" data-target="#edit-modal"
                                           data-row='{"id":"{{$committee->id}}",
                                         "evaluation_items_id":"{{$committee->evaluation_items_id}}",
                                         "frequency":"{{$committee->frequency}}",
                                         "range":"{{$committee->range}}",
                                         "file":"{{$committee->file}}",
                                         "status":"{{$committee->status}}"
                                         }'></i> </td>
                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Items</th>
                                    <th>Frequency</th>
                                    <th>Range of marks</th>
                                    <th>File</th>
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
                    <h4 class="modal-title">Edit Evaluation Method</h4>
                </div>
                <form method="post" id="update" enctype="multipart/form-data">

                <div class="modal-body">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Items</label>
                                                <select name="evaluation_items_id" id="edit_evaluation_items_id" class="form-control select2" style="width: 100%;">
                                                    <option value="">Select items</option>
                                                    @foreach($items as $body)
                                                        <option value="{{$body->id}}">{{$body->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Frequency</label>
                                                <input type="text" name="frequency" id="edit_frequency" value="{{old('edit_frequency')}}" class="form-control">
                                                <input type="hidden" name="edit_id" id="edit_id">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Range of marks</label>
                                                <input type="text" name="range" id="edit_range" value="{{old('edit_range')}}" class="form-control">
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
                                                <p><input type="radio" name="status" class="flat-red" value="active" > <span>Active</span></p>
                                                <p><input type="radio" name="status" class="flat-red" value="inactive" ><span>InActive</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- Main content -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="update" class="btn btn-info" value="Update">
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
        $(function () {
            $('#statutoryTable').DataTable()
        })
    </script>
    <script type="text/javascript">

        //Initialize Select2 Elements
        $('.select2').select2()

        //Flat red color scheme for iCheck
        $('input[type="radio"].flat-red').iCheck({
            radioClass   : 'iradio_flat-green'
        });

        //// add Statutory record

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        /*Add Scope*/
        $('#add').submit(function (e) {
            let next = false;
            if(e.originalEvent.submitter.id === 'add-and-next'){
                next = true;
            }
            // let statutory_body_id = $('#statutory_body_id').val();
            // let name = $('#name').val();
            // let designation_id = $('#designation_id').val();
            // let date_first_meeting = $('#date_first_meeting').val();
            // let date_second_meeting = $('#date_second_meeting').val();
            // let date_third_meeting = $('#date_third_meeting').val();
            // let date_fourth_meeting = $('#date_fourth_meeting').val();
            // let file = $('#file').val();
            //
            // !name?addClass('name'):removeClass('name');
            // !statutory_body_id?addClass('statutory_body_id'):removeClass('statutory_body_id');
            // !designation_id?addClass('designation_id'):removeClass('designation_id');
            // !date_first_meeting?addClass('date_first_meeting'):removeClass('date_first_meeting');
            // !date_second_meeting?addClass('date_second_meeting'):removeClass('date_second_meeting');
            // !date_third_meeting?addClass('date_third_meeting'):removeClass('date_third_meeting');
            // !date_fourth_meeting?addClass('date_fourth_meeting'):removeClass('date_fourth_meeting');
            // !file?addClass('file'):removeClass('file');
            //
            // if(!name || !statutory_body_id || !designation_id|| !date_first_meeting || !date_second_meeting || !date_third_meeting || !date_fourth_meeting || !file)
            // {
            //     Notiflix.Notify.Warning("Fill all the required Fields.");
            //     return;
            // }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("evaluation-method")}}',
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
                            window.location = '/program-delivery';
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
        ///// edit record
        $('.edit').on('click', function () {
            let data = JSON.parse(JSON.stringify($(this).data('row')));
           // console.log(data);
            // Initialize Select2
            $('#edit_evaluation_items_id').select2().val(data.evaluation_items_id).trigger('change');
            $('#edit_frequency').val(data.frequency);
            $('#edit_range').val(data.range);
            $('#edit_id').val(data.id);
            $('#file-name').text(data.file);
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#update').submit(function (e) {
            let evaluation_items_id = $('#edit_evaluation_items_id').val();
            let frequency = $('#edit_frequency').val();
            let range = $('#edit_range').val();
            let id = $('#edit_id').val();
            let status = $('input[name=status]:checked').val();

            !evaluation_items_id?addClass('edit_evaluation_items_id'):removeClass('edit_evaluation_items_id');
            !frequency?addClass('edit_frequency'):removeClass('edit_frequency');
            !range?addClass('edit_range'):removeClass('edit_range');

            if(!evaluation_items_id || !frequency || !range)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
            var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("evaluation-method")}}/'+id,
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
        })

        /// Delete Row
        $('.delete').on('click', function (e) {
            let id =  $(this).data('id');
            Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to delete?', 'Yes', 'No',
                function(){
                    // Yes button callback
                    $.ajax({
                        url:'{{url("evaluation-method")}}/'+id,
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
