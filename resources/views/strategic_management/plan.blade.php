@section('pageTitle', 'Strategic Plan')
@php
$isActiveSAR = getFirst('App\Models\Sar\SarInvoice' ,['regStatus'=>'SAR','campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id]);
@endphp

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
                 Approval of strategic plan
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Approval of Strategic Plan </li>
            </ol>
        </section>


        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">@if($isActiveSAR) 1.11 @else 1.8 @endif Provide the approved strategic plan including critical success factors and key performance indicators of the business school as @if($isActiveSAR) Appendix-1E @else Appendix-1D @endif. Fill in the required information on approval of the strategic plan in the Table @if($isActiveSAR) 1.8 @else 1.7 @endif.</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                                </button>
                                <!--<div class="btn-group">-->
                                <!--    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">-->
                                <!--        <i class="fa fa-file-pdf-o"></i></button>-->
                                <!--</div>-->
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                          <form action="javascript:void(0)" id="form" method="POST">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Period of the strategic plan (From)</label>
                                    <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text" name="plan_period" id="plan_period" autocomplete="off" class="form-control">
                                    </div>
                                </div>
                            </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Period of the strategic plan (To)</label>
                                    <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text" name="plan_period_to" id="plan_period_to" autocomplete="off" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Date of approval</label>
                                    <div class="input-group">
                                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                    <input type="text" name="aproval_date" id="aproval_date" autocomplete="off" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Approving Authority</label>
                                    <input type="text" name="aproving_authority" id="aproving_authority" class="form-control">
                                </div>
                            </div>

                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label for="upload file">Upload file (@if($isActiveSAR) Appendix-1E @else Appendix-1D @endif)</label>
                                      <input type="file" name="file" id="file">
                                  </div>
                              </div>
                             <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" id="add" value="Add" class="btn btn-info">
                                </div>

                                 <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" id="add-and-next" value="Add & Next" class="btn btn-success">
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
                            <h3 class="box-title">Table @if($isActiveSAR) 1.8  @else 1.7 @endif Approval of Strategic Plan List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Business School Name</th>
                                    <th>Campus</th>
                                    <th>Period of the strategic plan</th>
                                    <th>Date of Approval</th>
                                    <th>Approving Authority</th>
                                    <th>file</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($plans as $plan)
                                <tr>
                                    <td>{{$plan->campus->business_school->name}}</td>
                                    <td>{{$plan->campus->location}}</td>
                                    <td>{{$plan->plan_period}} <br/>{{$plan->plan_period_from}} To {{$plan->plan_period_to}}</td>
                                    <td>{{$plan->aproval_date}}</td>
                                    <td>{{$plan->aproving_authority}}</td>
                                    <td>@if($plan->file && $plan->file !='/') <a href="../{{$plan->file}}" download="{{$plan->file}}"><i class="fa fa-file-word-o"></i> </a>@endif</td>
                                    <td><i class="badge {{$plan->status == 'active'?'bg-green':'bg-red'}}">{{$plan->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$plan->id}}"></i> | <i class="fa fa-pencil text-blue edit" data-row='{"id":"{{$plan->id}}", "plan_period":"{{$plan->plan_period}}","plan_period_from" : "{{$plan->plan_period_from}}","plan_period_to" : "{{$plan->plan_period_to}}", "aproval_date":"{{$plan->aproval_date}}", "aproving_authority":"{{$plan->aproving_authority}}", "status":"{{$plan->status}}", "file":"/{{$plan->file}}"}' data-toggle="modal" data-target="#edit-modal"></i></td>

                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Business School Name</th>
                                    <th>Campus</th>
                                    <th>Period of the strategic plan</th>
                                    <th>Date of Approval</th>
                                    <th>Approving Authority</th>
                                    <th>file</th>
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
                    <h4 class="modal-title">Edit Strategic Plan. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Period of Strategic Plan (from)</label>
                                    <input type="text" name="plan_period" id="edit_plan_period" value="{{old('edit_plan_period')}}" class="form-control">
                                </div>
                                <input type="hidden" id="edit_id">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Period of Strategic Plan(to)</label>
                                    <input type="text" name="plan_period_to" id="edit_plan_period_to" value="{{old('edit_plan_period')}}" class="form-control">
                                </div>
                            </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Date of approval</label>
                                    <input type="text" name="aproval_date" id="edit_aproval_date" value="{{old('edit_aproval_date')}}" class="form-control">
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Aproving Authority</label>
                                    <input type="text" name="aproving_authority" id="edit_aproving_authority" value="{{old('edit_aproving_authority')}}" class="form-control">
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
                                <label for="name">Attach Doc</label>
                                <input type="file" name="file" id="edit_file" >
                                <input type="hidden" name="old_file" id="old_file" >
                                <a class="text-blue" id="file-name"></a>
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
            $('#datatable').DataTable({
                dom : "lBfrtip",
            })
        })
    </script>
    <script type="text/javascript">
        let check= false;
        $('.select2').select2();
        $('#plan_period').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
    });

        $('#plan_period_to').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
    });

        $('#aproval_date').datepicker({
            format: 'yyyy-mm-dd',
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
            let plan_period = $('#plan_period').val();
            let plan_period_to = $('#plan_period_to').val();
            let aproval_date = $('#aproval_date').val();
            let aproving_authority = $('#aproving_authority').val();
            let file = document.getElementById('file');
            !plan_period?addClass('plan_period'):removeClass('plan_period');
            !plan_period_to?addClass('plan_period_to'):removeClass('plan_period_to');
            !aproval_date?addClass('aproval_date'):removeClass('aproval_date');
            !aproving_authority?addClass('aproving_authority'):removeClass('aproving_authority');

            if(!plan_period || !aproval_date || !aproving_authority || !plan_period_to || file.files.length < 1)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("strategic/strategic-plan")}}',
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
                            window.location = '/strategic/parent-institution';
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
        function parseDate(input, format) {
            format = format || 'mm/dd/yyyy'; // default format
            var parts = input.match(/(\d+)/g), 
                i = 0, fmt = {};
            // extract date-part indexes from the format
            format.replace(/(mm|dd|yyyy)/g, function(part) { fmt[part] = i++; });

            return new Date(parts[fmt['mm']], parts[fmt['dd']]-1, parts[fmt['yyyy']]);
        }


         $('.edit').on('click', function () {
            // let data = JSON.parse(JSON.stringify($(this).data('row')));
             let data = JSON.parse(JSON.stringify($(this).data('row')));
             document.getElementById('edit_plan_period').value = data.plan_period_from;
             document.getElementById('edit_plan_period_to').value = data.plan_period_to;
            $('#edit_plan_period').datepicker({
                format: 'yyyy-mm-dd',
                autoclose:true
            });
            $('#edit_plan_period_to').datepicker({
                format: 'yyyy-mm-dd',
                autoclose:true
            });
            $('#edit_aproval_date').val(data.aproval_date);
            $('#edit_aproval_date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose:true
            });
            $('#edit_aproving_authority').val(data.aproving_authority);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
            $('#file-name').text(data.file);
            $('#file-name').attr('href', data.file)
        });

$('#updateForm').submit(function (e) {
            let plan_period = $('#edit_plan_period').val();
            let plan_period_to = $('#edit_plan_period_to').val();
            let aproval_date = $('#edit_aproval_date').val();
            let aproving_authority = $('#edit_aproving_authority').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !plan_period?addClass('edit_plan_period'):removeClass('edit_plan_period');
            !aproval_date?addClass('edit_aproval_date'):removeClass('edit_aproval_date');
            !aproving_authority?addClass('edit_aproving_authority'):removeClass('edit_aproving_authority');

            if(!plan_period || !aproval_date || !aproving_authority)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("strategic/strategic-plan")}}/'+id,
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
                        url:'{{url("strategic/strategic-plan")}}/'+id,
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
