@section('pageTitle', 'Faculty Membership')


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
               Faculty Membership
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Faculty Membership</li>
            </ol>
        </section>

        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">4.12 Provide a list of all professional memberships of core business faculty in Table 4.10.</h3>
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
                                    <label for="name">Name of faculty</label>
                                    <input type="text" name="faculty_name" id="faculty_name" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Membership organization</label>
                                    <input type="text" name="organization" id="organization" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Valid since(year)</label>
                                    <select name="from" id="from" class="form-control select2">
                                        <option value="">select year from</option>
                                        @for($year = date('Y'); $year > 1950; $year--)
                                        <option value="{{$year}}">{{$year}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Valid till(year)</label>
                                    <select name="to" id="to" class="form-control select2">
                                        <option value="">select year to</option>
                                        @for($year = date('Y'); $year > 1950; $year--)
                                            <option value="{{$year}}">{{$year}}</option>
                                            @endfor
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" id="add-and-next" value="Add & Next" class="btn btn-success">
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
                            <h3 class="box-title">Table 4.10.Professional memberships of core business faculty</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name of faculty</th>
                                    <th>Membership organization</th>
                                    <th>Valid since(year)</th>
                                    <th>Valid till(year)</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($enrolments as $enrolement)
                                <tr>
                                    <td>{{$enrolement->faculty_name}}</td>
                                    <td>{{$enrolement->organization}}</td>
                                    <td>{{$enrolement->from}}</td>
                                    <td>{{$enrolement->to}}</td>
                                    <td><i class="badge {{$enrolement->status == 'active'?'bg-green':'bg-red'}}">{{$enrolement->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$enrolement->id}}"></i> | <i data-row='{"id":"{{$enrolement->id}}","faculty_name":"{{$enrolement->faculty_name}}","organization":"{{$enrolement->organization}}","from":"{{$enrolement->from}}","to":"{{$enrolement->to}}","status":"{{$enrolement->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>

                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                     <th>Name of faculty</th>
                                    <th>Membership organization</th>
                                    <th>Valid since(year)</th>
                                    <th>Valid till(year)</th>
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
                    <h4 class="modal-title">Edit Faculty Membership. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name of faculty</label>
                                    <input type="text" name="faculty_name" id="edit_faculty_name" value="{{old('edit_faculty_name')}}" class="form-control">
                                </div>
                                 <input type="hidden" name="id" id="edit_id">
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Membership organization</label>
                                    <input type="text" name="organization" id="edit_organization" value="{{old('edit_organization')}}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Valid since(year)</label>
                                    <input type="text" name="from" id="edit_from" value="{{old('edit_from')}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Valid till(year)</label>
                                    <input type="text" name="to" id="edit_to" value="{{old('edit_to')}}" class="form-control">
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
            let next = false;
            if(e.originalEvent.submitter.id === 'add-and-next'){
                next = true;
            }
            // let uni_id = $('#uni_id').val();
            let faculty_name = $('#faculty_name').val();
            let organization = $('#organization').val();
            let from = $('#from').val();
            let to = $('#to').val();

            !faculty_name?addClass('faculty_name'):removeClass('faculty_name');
            !organization?addClass('organization'):removeClass('organization');
            !from?addClass('from'):removeClass('from');
            !to?addClass('to'):removeClass('to');

            if(!faculty_name || !organization || !from || !to)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("faculty-membership")}}',
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
                            window.location = '/international-faculty';
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
            $('#edit_faculty_name').val(data.faculty_name);
            $('#edit_organization').val(data.organization);
            $('#edit_from').val(data.from);
            $('#edit_to').val(data.to);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#updateForm').submit(function (e) {
            let faculty_name = $('#edit_faculty_name').val();
            let organization = $('#edit_organization').val();
            let from = $('#edit_from').val();
            let to = $('#edit_to').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !faculty_name?addClass('faculty_name'):removeClass('faculty_name');
            !organization?addClass('organization'):removeClass('organization');
            !from?addClass('from'):removeClass('from');
            !to?addClass('to'):removeClass('to');

            if(!faculty_name || !organization || !from || !to)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("faculty-membership")}}/'+id,
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
                        url:'{{url("faculty-membership")}}/'+id,
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

        });
    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
