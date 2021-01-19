@section('pageTitle', 'Curriculum Review')


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
                Curriculum Review
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Curriculum Review </li>
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
                            <h3 class="box-title">2.3.    Provide data on curriculum review meetings in Table 2.3.</h3>
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
                                    <label for="name">Curriculum review meeting</label>
                                    <select name="review_meeting" id="review_meeting" class="form-control select2">
                                        <option selected disabled>--Select--</option>
                                        <option value="Meeting 1">Meeting 1</option>
                                        <option value="Meeting 2">Meeting 2</option>
                                        <option value="Meeting 3">Meeting 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                   <label for="name">Date</label>
                                   <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text" name="date" id="date" value="<?php echo date('m/d/Y'); ?>" class="form-control">
                                </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                   <label for="name">Composition</label>
                                    <input type="text" name="composition" id="composition" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" style="margin-bottom: 17px">
                                   <label for="name">Reviewer names</label>
                            <select name="reviewer_names[]" id="reviewer_names" data-placeholder="Select a Reviewers" class="form-control select2" multiple="multiple" >
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
{{--                                    <input type="text" name="reviewer_names" id="reviewer_names" value="" class="form-control">--}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Designation</label>
                                    <select name="designation_id" id="designation_id" class="form-control select2" multiple="multiple" data-placeholder="Select Designation">
{{--                                        <option selected disabled>Select Designation</option>--}}
                                        @foreach($designations as $program)
                                            <option value="{{$program->id}}">{{$program->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 form-row">
                                <div class="form-group">
                                <div class="input-group">
                                    <label for="name">Affiliation</label>
                                    <select name="affiliations_id" id="affiliations_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Affiliation</option>
                                        @foreach($affiliation as $degree)
                                        <option value="{{$degree->id}}">{{$degree->affiliation}}</option>
                                        @endforeach

                                    </select>
                                    <span class="input-group-btn">
                                        <button type="button" data-toggle="modal" data-target="#add-modal"  class="btn btn-info btn-flat" style="margin-top: 21px;"><i class="fa fa-plus"></i></button>
                                    </span>
                                </div>
                                </div>
                            </div>

                             <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
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
                            <h3 class="box-title">Table 2.3. Curriculum review</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Curriculum review meeting</th>
                                    <th>Date</th>
                                    <th>Composition</th>
                                    <th>Reviewer names</th>
                                    <th>Designation & affiliation</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                 @foreach($summaries as $portfolio)
{{--                                     @php dd($portfolio) @endphp--}}
                                <tr>
                                    <td>{{$portfolio->review_meeting}}</td>
                                    <td>{{$portfolio->date}}</td>
                                    <td>{{$portfolio->composition}}</td>
                                    <td>@if($portfolio->curriculum_reviewer)
                                            @foreach($portfolio->curriculum_reviewer as $reviewers) {{$reviewers->user->name}},
                                            @endforeach @endif
                                    </td>
                                    <td>{{$portfolio->designation->name}}-{{$portfolio->affiliations->affiliation}} </td>
                                    <td><i class="badge {{$portfolio->status == 'active'?'bg-green':'bg-red'}}">{{$portfolio->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$portfolio->id}}"></i> | <i data-row='{"id":{{$portfolio->id}},"review_meeting":"{{$portfolio->review_meeting}}","date":"{{$portfolio->date}}","composition":"{{$portfolio->composition}}","reviewer_names":"{{$portfolio->reviewer_names}}","designation_id":"{{$portfolio->designation_id}}","affiliations_id":"{{$portfolio->affiliations_id}}","status":"{{$portfolio->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i></td>

                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Curriculum review meeting</th>
                                    <th>Date</th>
                                    <th>Composition</th>
                                    <th>Reviewer names</th>
                                    <th>Designation & affiliation</th>
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

    <div class="modal fade" id="add-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">The names, designations and affiliations of all external (academic and corporate), national or international members in each of the statutory bodies mentioned above in Table 1.4.</h4>
                </div>
                <form action="javascript:void(0)" id="add_affiliation" method="POST">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name of member</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 17px;">
                            <label for="name">Designation</label>
                            <select name="designation_id" id="designation_add_id" class="form-control select2" style="width: 100%;">
                                <option selected  disabled >Select Designation</option>
                                @foreach($designations as $designation)
                                    <option value="{{$designation->id}}">{{$designation->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Affiliation</label>
                            <input type="text" name="affiliation" id="affiliation" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name of statutory body </label>
                            <select name="statutory_bodies_id" id="statutory_bodies_id" class="form-control select2" style="width: 100%;">
                                <option selected disabled >Select Body Name</option>
                                @foreach($bodies as $body)
                                    <option value="{{$body->id}}">{{$body->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-info" value="Submit" id="add">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
     <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Curriculum Review. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Curriculum review meeting</label>
                                    <select name="review_meeting" id="edit_review_meeting" class="form-control select2">
                                        <option selected disabled>--Select--</option>
                                        <option value="Meeting 1">Meeting 1</option>
                                        <option value="Meeting 2">Meeting 2</option>
                                        <option value="Meeting 3">Meeting 3</option>
                                    </select>
                                </div>
                                 <input type="hidden" id="edit_id">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label for="name">Date</label>
                                   <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text" name="date" id="edit_date" value="{{old('edit_date')}}"class="form-control">
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label for="name">Composition</label>
                                    <input type="text" name="composition" id="edit_composition" value="{{old('edit_composition')}}"class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label for="name">Reviewer names</label>
                                    <select name="reviewer_names" id="edit_reviewer_names" data-placeholder="Select a Reviewers" class="form-control select2" multiple="multiple" >
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
{{--                                    <input type="text" name="reviewer_names" id="edit_reviewer_names" value="{{old('edit_reviewer_names')}}"class="form-control">--}}
                                </div>
                            </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Designation</label>
                                    <select name="designation_id" id="edit_designation_id" class="form-control select2">
                                        <option selected disabled>Select Designation</option>
                                        @foreach($designations as $program)
                                            <option value="{{$program->id}}">{{$program->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Affiliation</label>
                                    <select name="affiliations_id" id="edit_affiliations_id" class="form-control select2">
                                        <option selected disabled>Select Affiliation</option>
                                        @foreach($affiliation as $degree)
                                        <option value="{{$degree->id}}">{{$degree->affiliation}}</option>
                                        @endforeach

                                    </select>
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
            let review_meeting = $('#review_meeting').val();
            let date = $('#date').val();
            let composition = $('#composition').val();
            let reviewer_names = $('#reviewer_names').val();
            let designation_id = $('#designation_id').val();
            let affiliations_id = $('#affiliations_id').val();

            !review_meeting?addClass('review_meeting'):removeClass('review_meeting');
            !date?addClass('date'):removeClass('date');
            !composition?addClass('composition'):removeClass('composition');
            !reviewer_names?addClass('reviewer_names'):removeClass('reviewer_names');
            !designation_id?addClass('designation_id'):removeClass('designation_id');
            !affiliations_id?addClass('affiliations_id'):removeClass('affiliations_id');

            if(!review_meeting || !date || !composition || !reviewer_names || !designation_id || !affiliations_id )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("curriculum-review")}}',
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

        $('#add_affiliation').submit(function (e) {
            let designation_id = $('#designation_add_id').val();
            let affiliation = $('#affiliation').val();
            let name = $('#name').val();
            let statutory_bodies_id = $('#statutory_bodies_id').val();

            !name?addClass('name'):removeClass('name');
            !designation_id?addClass('designation_id'):removeClass('designation_id');
            !affiliation?addClass('affiliation'):removeClass('affiliation');
            // !statutory_bodies_id?addClass('statutory_bodies_id'):removeClass('statutory_bodies_id');

            if(!designation_id || !affiliation || !name)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("strategic/affiliations")}}',
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

            $('#edit_review_meeting').select2().val(data.review_meeting).trigger('change');
            $('#edit_date').val(data.date).datepicker('getDate');
            $('#edit_composition').val(data.composition);
            $('#edit_reviewer_names').val(data.reviewer_names);
            $('#edit_designation_id').select2().val(data.designation_id).trigger('change');
            $('#edit_affiliations_id').select2().val(data.affiliations_id).trigger('change');
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let review_meeting = $('#edit_review_meeting').val();
            let date = $('#edit_date').val();
            let composition = $('#edit_composition').val();
            let reviewer_names = $('#edit_reviewer_names').val();
            let designation_id = $('#edit_designation_id').val();
            let affiliations_id = $('#edit_affiliations_id').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !review_meeting?addClass('review_meeting'):removeClass('review_meeting');
            !date?addClass('date'):removeClass('date');
            !composition?addClass('composition'):removeClass('composition');
            !reviewer_names?addClass('reviewer_names'):removeClass('reviewer_names');
            !designation_id?addClass('designation_id'):removeClass('designation_id');
            !affiliations_id?addClass('affiliations_id'):removeClass('affiliations_id');

            if(!review_meeting || !date || !composition || !reviewer_names || !designation_id || !affiliations_id)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("curriculum-review")}}/'+id,
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
                        url:'{{url("curriculum-review")}}/'+id,
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
