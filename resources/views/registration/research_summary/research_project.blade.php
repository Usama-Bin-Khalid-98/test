@section('pageTitle', 'Research Project')


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
                Research Project
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Research Project </li>
            </ol>
        </section>

        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">5.5   List details of research projects of last three years in Table 5.4.</h3>
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Project title</label>
                                    <input type="text" name="title" id="title" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Start date</label>
                                     <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text" name="start_date" id="start_date" value="<?php echo date('m/d/Y'); ?>" class="form-control">
                                </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">End date</label>
                                     <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text" name="end_date" id="end_date" value="<?php echo date('m/d/Y'); ?>" class="form-control">
                                </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Principal investigator</label>
                                    <input type="text" name="investigator" id="investigator" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Funding agency</label>
                                    <input type="text" name="funding_agency" id="funding_agency" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Funding amount (PKR)</label>
                                    <input type="text" name="amount" id="amount" class="form-control">
                                </div>
                            </div>


                             <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
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
                            <h3 class="box-title">Table 5.4. Details of research projects</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Project title</th>
                                    <th>Start & end dates</th>
                                    <th>Principal investigator</th>
                                    <th>Funding agency</th>
                                    <th>Funding amount  (PKR)</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($enrolments as $enrolement)
                                <tr>
                                    <td>{{$enrolement->title}}</td>
                                    <td>{{$enrolement->start_date}} | {{$enrolement->end_date}}</td>
                                    <td>{{$enrolement->investigator}}</td>
                                    <td>{{$enrolement->funding_agency}}</td>
                                    <td>{{$enrolement->amount}}</td>
                                    <td><i class="badge {{$enrolement->status == 'active'?'bg-green':'bg-red'}}">{{$enrolement->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$enrolement->id}}"></i> | <i data-row='{"id":"{{$enrolement->id}}","title":"{{$enrolement->title}}","start_date":"{{$enrolement->start_date}}","end_date":"{{$enrolement->end_date}}","investigator":"{{$enrolement->investigator}}","funding_agency":"{{$enrolement->funding_agency}}","amount":"{{$enrolement->amount}}","status":"{{$enrolement->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>

                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Project title</th>
                                    <th>Start & end dates</th>
                                    <th>Principal investigator</th>
                                    <th>Funding agency</th>
                                    <th>Funding amount  (PKR)</th>
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
                    <h4 class="modal-title">Edit Research Project. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">

                        <div class="col-md-6">
                            <div class="form-group">
                                    <label for="name">Project title</label>
                                    <input type="text" name="title" id="edit_title" value="{{old('title')}}" class="form-control">
                            </div>
                            <input type="hidden" name="id" id="edit_id">
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                    <label for="name">Start date</label>
                                     <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text" name="start_date" id="edit_start_date" value="{{old('start_date')}}" class="form-control">
                                </div>

                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                    <label for="name">End date</label>
                                     <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text" name="end_date" id="edit_end_date" value="{{old('end_date')}}" class="form-control">
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Pricipal investigator</label>
                                    <input type="text"  name="investigator"
                                    id="edit_investigator" value="{{old('investigator')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Funding agency</label>
                                    <input type="text" name="funding_agency"
                                    id="edit_funding_agency" value="{{old('funding_agency')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Funding amount (PKR)</label>
                                    <input type="number" name="amount"
                                    id="edit_amount" value="{{old('amount')}}" class="form-control">
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
         $('#start_date').datepicker({
      autoclose:true
    });
          $('#end_date').datepicker({
      autoclose:true
    });
           $('#edit_start_date').datepicker({
      autoclose:true
    });
            $('#edit_end_date').datepicker({
      autoclose:true
    });

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#form').submit(function (e) {
            // let uni_id = $('#uni_id').val();
            let title = $('#title').val();
            let start_date = $('#start_date').val();
            let end_date = $('#end_date').val();
            let investigator = $('#investigator').val();
            let funding_agency = $('#funding_agency').val();
            let amount = $('#amount').val();

            !title?addClass('title'):removeClass('title');
            !start_date?addClass('start_date'):removeClass('start_date');
            !end_date?addClass('end_date'):removeClass('end_date');
            !investigator?addClass('investigator'):removeClass('investigator');
            !funding_agency?addClass('funding_agency'):removeClass('funding_agency');
            !amount?addClass('amount'):removeClass('amount');

            if(!title || !start_date || !end_date || !investigator || !funding_agency || !amount)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("research-project")}}',
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
            $('#edit_title').val(data.title);
            $('#edit_start_date').val(data.start_date);
            $('#edit_end_date').val(data.end_date);
            $('#edit_investigator').val(data.investigator);
            $('#edit_funding_agency').val(data.funding_agency);
            $('#edit_amount').val(data.amount);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#updateForm').submit(function (e) {
            let title = $('#edit_title').val();
            let start_date = $('#edit_start_date').val();
            let end_date = $('#edit_end_date').val();
            let investigator = $('#edit_investigator').val();
            let funding_agency = $('#edit_funding_agency').val();
            let amount = $('#edit_amount').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !title?addClass('edit_title'):removeClass('edit_title');
            !start_date?addClass('edit_start_date'):removeClass('edit_start_date');
            !end_date?addClass('edit_end_date'):removeClass('edit_end_date');
            !investigator?addClass('edit_investigator'):removeClass('edit_investigator');
            !funding_agency?addClass('edit_funding_agency'):removeClass('edit_funding_agency');
            !amount?addClass('edit_amount'):removeClass('edit_amount');

            if(!title || !start_date || !end_date || !investigator || !funding_agency || !amount)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("research-project")}}/'+id,
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
                        url:'{{url("research-project")}}/'+id,
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
