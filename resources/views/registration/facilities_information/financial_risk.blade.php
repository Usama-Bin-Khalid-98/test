@section('pageTitle', 'Financial Risk')


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
                Financial Risk
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active">Financial Risk</li>
            </ol>
        </section>


        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">7.2 Provide data on Financial Risks along with remedial measures in Table 7.2.</h3>
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
                                    <label for="name">Risk identified</label>
                                    <input type="text" name="risk_identified" id="risk_identified" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Stakeholders involved</label>
                                    <input type="text" name="stakeholder_involved" id="stakeholder_involved" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Remedial measures</label>
                                    <input type="text" name="remedial_measure" id="remedial_measure" class="form-control">
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
                            <h3 class="box-title">Table 7.2 Financial Risk Table.</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Risk identified</th>
                                    <th>Stakeholders involved</th>
                                    <th>Remedial measures</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach($risks as $summary)
                                <tr>
                                    <td>{{$summary->campus->business_school->name}}</td>
                                    <td>{{$summary->campus->location}}</td>
                                    <td>{{$summary->risk_identified}}</td>
                                    <td>{{$summary->stakeholder_involved}}</td>
                                    <td>{{$summary->remedial_measure}}</td>
                                    <td><i class="badge {{$summary->status == 'active'?'bg-green':'bg-red'}}">{{$summary->status == 'active'?'Active':'Inactive'}}</i></td>
                                    <td><i class="fa fa-trash text-info delete" data-id="{{$summary->id}}"></i> | <i data-row='{"id":{{$summary->id}},"risk_identified":"{{$summary->risk_identified}}","stakeholder_involved":"{{$summary->stakeholder_involved}}","remedial_measure":"{{$summary->remedial_measure}}","status":"{{$summary->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>
                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Risk identified</th>
                                    <th>Stakeholders involved</th>
                                    <th>Remedial measures</th>
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
                    <h4 class="modal-title">Edit Financial Risk. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Risk Identified</label>
                                    <input type="text" name="risk_identified" id="edit_risk_identified" value="{{old('edit_risk_identified')}}" class="form-control">
                                </div>
                                <input type="hidden" id="edit_id">
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Stakeholder Involved</label>
                                    <input type="text" name="stakeholder_involved" id="edit_stakeholder_involved" value="{{old('edit_stakeholder_involved')}}" class="form-control">
                                </div>
                              </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Remedial Measure</label>
                                    <input type="text" name="remedial_measure" id="edit_remedial_measure" value="{{old('edit_remedial_measure')}}" class="form-control">
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
            let risk_identified = $('#risk_identified').val();
            let stakeholder_involved = $('#stakeholder_involved').val();
            let remedial_measure = $('#remedial_measure').val();

            !risk_identified?addClass('risk_identified'):removeClass('risk_identified');
            !stakeholder_involved?addClass('stakeholder_involved'):removeClass('stakeholder_involved');
            !remedial_measure?addClass('remedial_measure'):removeClass('remedial_measure');

            if(!risk_identified || !stakeholder_involved || !remedial_measure )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("financial-risk")}}',
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
                            window.location = '/support-staff';
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
            $('#edit_risk_identified').val(data.risk_identified);
            $('#edit_stakeholder_involved').val(data.stakeholder_involved);
            $('#edit_remedial_measure').val(data.remedial_measure);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let risk_identified = $('#edit_risk_identified').val();
            let stakeholder_involved = $('#edit_stakeholder_involved').val();
            let remedial_measure = $('#edit_remedial_measure').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !risk_identified?addClass('edit_risk_identified'):removeClass('edit_risk_identified');
            !stakeholder_involved?addClass('edit_stakeholder_involved'):removeClass('edit_stakeholder_involved');
            !remedial_measure?addClass('edit_remedial_measure'):removeClass('edit_remedial_measure');

            if(!risk_identified || !stakeholder_involved || !remedial_measure )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("financial-risk")}}/'+id,
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
                        url:'{{url("financial-risk")}}/'+id,
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
