@section('pageTitle', 'Alumni Participation')


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
                Alumni Participation
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Alumni Participation </li>
            </ol>
        </section>


        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">3.13. Provide information on alumni participation in various activities in the Table 3.10.</h3>

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
                                    <label for="name">Activity Engagements</label>
                                    <select name="activity_engagements_id" id="activity_engagements_id" class="form-control select2" style="width: 100%;">
                                        <option selected  disabled >Select Activity Engagements</option>
                                        @foreach($engagements as $fund)
                                            <option value="{{$fund->id}}">{{$fund->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Number of Alumni Participated</label>
                                    <input type="number" name="alumni_participated" id="alumni_participated" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Major Input</label>
                                    <input type="text" name="major_input" id="major_input" class="form-control">
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
                            <h3 class="box-title">Table 3.10 Alumni Participation</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Activity Engagement</th>
                                    <th>Number of Alumni Participated</th>
                                    <th>Major Input</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($participations as $plan)
                                <tr>
                                    <td>{{$plan->activity_engagements->name}}</td>
                                    <td>{{$plan->alumni_participated}}</td>
                                    <td>{{$plan->major_input}}</td>
                                    <td><i class="badge {{$plan->status == 'active'?'bg-green':'bg-red'}}">{{$plan->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$plan->id}}"></i> | <i class="fa fa-pencil text-blue edit" data-row='{"id":"{{$plan->id}}", "activity_engagements_id":"{{$plan->activity_engagements_id}}", "alumni_participated":"{{$plan->alumni_participated}}", "major_input":"{{$plan->major_input}}", "status":"{{$plan->status}}"}' data-toggle="modal" data-target="#edit-modal"></i></td>

                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Activity Engagement</th>
                                    <th>Number of Alumni Participated</th>
                                    <th>Major Input</th>
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
                    <h4 class="modal-title">Edit Alumni Participation. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Activity Engagement</label>
                                    <select name="activity_engagements_id" id="edit_activity_engagements_id" class="form-control select2" style="width: 100%;">
                                        <option selected  disabled >Select Activity Engagement</option>
                                        @foreach($engagements as $fund)
                                            <option value="{{$fund->id}}">{{$fund->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" id="edit_id">
                            </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Number of Alumni Participated</label>
                                    <input type="number" name="alumni_participated" id="edit_alumni_participated" value="{{old('edit_alumni_participated')}}" class="form-control">
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Major Input</label>
                                    <input type="text" name="major_input" id="edit_major_input" value="{{old('edit_percent_share')}}" class="form-control">
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
            let next = false;
            if(e.originalEvent.submitter.id === 'add-and-next'){
                next = true;
            }
            let activity_engagements_id = $('#activity_engagements_id').val();
            let alumni_participated = $('#alumni_participated').val();
            let major_input = $('#major_input').val();

            !activity_engagements_id?addClass('activity_engagements_id'):removeClass('activity_engagements_id');
            !alumni_participated?addClass('alumni_participated'):removeClass('alumni_participated');
            !major_input?addClass('major_input'):removeClass('major_input');

            if(!activity_engagements_id || !alumni_participated || !major_input)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("alumni-participation")}}',
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
                            window.location = '/faculty-summary';
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
            $('#edit_activity_engagements_id').select2().val(data.activity_engagements_id).trigger('change');
            $('#edit_alumni_participated').val(data.alumni_participated);
            $('#edit_major_input').val(data.major_input);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let activity_engagements_id = $('#edit_activity_engagements_id').val();
            let alumni_participated = $('#edit_alumni_participated').val();
            let major_input = $('#edit_major_input').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !activity_engagements_id?addClass('edit_activity_engagements_id'):removeClass('edit_activity_engagements_id');
            !alumni_participated?addClass('edit_alumni_participated'):removeClass('edit_alumni_participated');
            !major_input?addClass('edit_major_input'):removeClass('edit_major_input');

            if(!activity_engagements_id || !alumni_participated || !major_input)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("alumni-participation")}}/'+id,
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
                        url:'{{url("alumni-participation")}}/'+id,
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
