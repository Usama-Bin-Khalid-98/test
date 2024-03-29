@section('pageTitle', 'Entry Requirements')
@php
$isActiveSAR = getFirst('App\Models\Sar\SarInvoice' ,['regStatus'=>'SAR','campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id]);
@endphp

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
                Entry Requirements
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Entry Requirements </li>
            </ol>
        </section>
        <section class="content-header">
            <div class="col-md-12 new-button">
                <div class="pull-right">
{{--                    <button class="btn gradient-bg-color"--}}
{{--                           data-toggle="modal" data-target="#add-modal"--}}
{{--                           style="color: white;"--}}
{{--                           value="Add New"--}}
{{--                            name="add" id="add">PDF <i class="fa fa-file-pdf-o"></i></button>--}}
                </div>
            </div>
        </section>

        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-sticky-note"></i>Note</h4>
                            <ol type="1">
                                <li>
                                    <h5>Entry required for All programs.</h5>
                                    <p>You can't submit your registration application, if data not entered for all the programs separately.</p>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            @if($isActiveSAR)
                            <h3 class="box-title">9.2.  Provide data on entryrequirements for each program under review in Table 9.2. .</h3>
                            @else
                                <h3 class="box-title">2.2.  Provide data on entryrequirements for each program under review in Table 2.2. .</h3>
                            @endif
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
                                 <table class="table table-bordered table-striped" >
                                     <thead>
                                     <th >Program(s) under review</th>
                                     <th class="fontsize">Eligibility criteria</th>
                                     <th class="fontsize">Minimum requirements/relative weightage</th>
                                     </thead>
                                     <tbody>
                                     @foreach($criterias as $criteria)
                                     <tr>
                                         @if($loop->iteration == 1)
                                         <td rowspan="{{count(@$criterias)}}">
                                             <div class="form-group">
                                                 <label for="program_id">Eligibility criteria</label>
                                             <select name="program_id" id="program_id" class="form-control select2" style="width: 100%;">
                                                 <option selected disabled>Select Program</option>
                                                 @foreach($scopes as $scope)
                                                     <option value="{{$scope->program->id}}">{{$scope->program->name}}</option>
                                                 @endforeach
                                             </select>
                                             </div>
                                         </td>
                                         @endif

                                         <td>
                                             {{$criteria->name}}
                                             <input type="hidden" name="eligibility_criteria_id[]" id="eligibility_criteria_id" value="{{@$criteria->id}}">
                                         </td>
                                         <td>
                                             <input type="number" name="min_req[]" min="0" class="form-control calculate">
                                         </td>
                                             @endforeach
                                     </tr>
                                         <tr>
                                             <td colspan="2"></td>
                                             <td><strong><span id="total"></span></strong></td>
                                         </tr>
                                     </tbody>
                                 </table>

{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="name">Eligibility criteria</label>--}}
{{--                                   <select name="eligibility_criteria_id" id="eligibility_criteria_id" class="form-control select2" style="width: 100%;">--}}
{{--                                        <option selected disabled>Select Eligibility Criteria</option>--}}
{{--                                        @foreach($criterias as $criteria)--}}
{{--                                         <option value="{{$criteria->id}}">{{$criteria->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                        </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                              <div class="col-md-4">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="name">Minimum requirements/relative weightage</label>--}}
{{--                                    <input type="text" name="min_req" id="min_req" class="form-control">--}}
{{--                                </div>--}}
{{--                              </div>--}}

                            <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" value="Add & Next" class="btn btn-success next">
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
                            @if($isActiveSAR)
                                <h3 class="box-title">Table 9.2. Entry requirements</h3>
                            @else
                                <h3 class="box-title">Table 2.2. Entry requirements</h3>
                            @endif
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
{{--                                    <th>Business School</th>--}}
{{--                                    <th>Campus</th>--}}
                                    <th>Program(s) under review</th>
                                    <th>Eligibility Criteria</th>
                                    <th>Minimum requirements/Relative Weightage</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($entryRequirements as $req)
                                <tr>
{{--                                    <td>{{$req->campus->business_school->name}}</td>--}}
{{--                                    <td>{{$req->campus->location}}</td>--}}
                                    <td>{{$req->program->name}}</td>
                                    <td>{{$req->eligibility_criteria->name}}</td>
                                    <td>{{$req->min_req}}</td>
                                    <td><i class="badge {{$req->status == 'active'?'bg-green':'bg-red'}}">{{$req->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$req->id}}"></i> | <i class="fa fa-pencil text-blue edit" data-row='{"id":"{{$req->id}}", "program_id":"{{$req->program_id}}", "eligibility_criteria_id":"{{$req->eligibility_criteria_id}}", "min_req":"{{$req->min_req}}", "status":"{{$req->status}}"}' data-toggle="modal" data-target="#edit-modal"></i></td>

                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
{{--                                    <th>Business School</th>--}}
{{--                                    <th>Campus</th>--}}
                                    <th>Program(s) under review</th>
                                    <th>Eligibility Criteria</th>
                                    <th>Minimum requirements/Relative Weightage</th>
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
                    <h4 class="modal-title">Edit Entry Requirement. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                    <label for="name">Program Name</label>
                                   <select name="program_id" id="edit_program_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Program</option>
                                        @foreach($scopes as $scope)
                                         <option value="{{$scope->program->id}}">{{$scope->program->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                                <input type="hidden" id="edit_id">
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Eligibility Croteria</label>
                                <select name="eligibility_criteria_id" id="edit_eligibility_criteria_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Eligibility Croteria</option>
                                    @foreach($criterias as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Minimum requirements/Relative Weightage</label>
                                    <input type="text" name="min_req" id="edit_min_req" value="{{old('edit_min_req')}}" class="form-control">
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
        $(".calculate").on('change', function (e) {
            var total = 0 
             $('.calculate').map(function (){
                total += this.value == '' ? 0 : parseFloat(this.value)
            })
            $('#total').html(total);
        })
        $('.select2').select2()

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let check = false;

         $('#form').submit(function (e) {
            let program_id = $('#program_id').val();
            let eligibility_criteria_id = $('input[name*="eligibility_criteria_id"]').val();
            let min_req = $('input[name*="min_req"]').val();

            !program_id?addClass('program_id'):removeClass('program_id');
            !eligibility_criteria_id?addClass('eligibility_criteria_id'):removeClass('eligibility_criteria_id');
            // !min_req?addClass('min_req'):removeClass('min_req');

            let percentage = 0.0;
            let total = 0;
            $('input[name*="min_req"]').each(function (i, val) {
                percentage += parseFloat($(val).val()) || 0;
            });

             if( percentage !== 100)
             {
                 Notiflix.Notify.Failure("The weightage values are not calculated correctly, The total value should be 100. ");
                 $('#total').text(percentage);
                 return;
             }
            // console.log('percentage....', percentage);
            // return;
            // if()

            if(!program_id || !eligibility_criteria_id || !min_req)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            //return;
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("entry-requirements")}}',
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
                    if(response.error){
                        Notiflix.Notify.Failure(response.error);

                    }
                    check = true;
                    console.log('response', response);
                    setTimeout(()=> {
                    location.reload();}, 2000);

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
            $('#edit_program_id').select2().val(data.program_id).trigger('change');
            $('#edit_eligibility_criteria_id').select2().val(data.eligibility_criteria_id).trigger('change');
            $('#edit_min_req').val(data.min_req);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let program_id = $('#edit_program_id').val();
            let eligibility_criteria_id = $('#edit_eligibility_criteria_id').val();
            let min_req = $('#edit_min_req').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !program_id?addClass('edit_program_id'):removeClass('edit_program_id');
            !eligibility_criteria_id?addClass('edit_eligibility_criteria_id'):removeClass('edit_eligibility_criteria_id');
            !min_req?addClass('edit_min_req'):removeClass('edit_min_req');

            if(!program_id || !eligibility_criteria_id || !min_req )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("entry-requirements")}}/'+id,
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
                        location.reload();
                    }
                    if(response.error){
                        Notiflix.Notify.Failure(response.error);
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


         $('.delete').on('click', function (e) {
            let id =  $(this).data('id');
            Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to delete?', 'Yes', 'No',
                function(){
                    // Yes button callback
                    $.ajax({
                        url:'{{url("entry-requirements")}}/'+id,
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
        $('.next').on('click', function (){
            setTimeout(()=>{
                if(check){
                    window.location = '/application-received';
                }
            }, 1000)
        });

    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
