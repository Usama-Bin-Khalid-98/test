@section('pageTitle', 'Users')


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
                Business School Submitted Registration Invoices.
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active">Invoices </li>
            </ol>
        </section>
        <section class="content-header">
            <div class="col-md-12 new-button">
                <div class="pull-right">
                    <button class="btn gradient-bg-color"
                           data-toggle="modal" data-target="#generate-modal" style="color: white;"
                           value="Add New">Generate Invoice <i class="fa fa-file-pdf-o"></i>
                    </button>
                </div>
            </div>
        </section>

        <!-- /.modal -->
        <div class="modal fade" id="generate-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Generate Invoice for department Registration</h4>
                    </div>
                    <form role="form" method="post">
                        <div class="modal-body">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="program">Invoice Number</label>
                                    <input type="text" name="invoice_no" id="invoice_no" value="{{$invoice_no??old('invoice_no')}}" readonly class="form-control">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="program">Apply for Department</label>
                                    <select id="department_id" name="department_id" class="form-control select2" style="width: 100%;">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}" {{$department->id==old('program_id')?'selected':''}}>{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="button" class="btn btn-info" value="Submit" id="add">
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        {{--Dean section --}}
        <section class="content">
{{--            <div class=" form row">--}}
{{--                <div class="col-md-12">--}}
{{--                <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="addForm">--}}
{{--                    <div class="box box-primary">--}}
{{--                        <div class="box-header">--}}
{{--                            <h3 class="box-title">Submit Registration Invoices.</h3>--}}
{{--                            <div class="box-tools pull-right">--}}
{{--                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>--}}
{{--                                </button>--}}
{{--                                <div class="btn-group">--}}
{{--                                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">--}}
{{--                                        <i class="fa fa-file-pdf-o"></i></button>--}}
{{--                                     </div>--}}
{{--                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!-- /.box-header -->--}}
{{--                        <div class="box-body">--}}

{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="program">Degree Department</label>--}}
{{--                                    <select id="department_id" name="department_id" class="form-control select2" style="width: 100%;">--}}
{{--                                        <option value="">Select Department</option>--}}
{{--                                        @foreach($departments as $department)--}}
{{--                                        <option value="{{$department->id}}" {{$department->id==old('program_id')?'selected':''}}>{{$department->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                        </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="name">Invoice No</label>--}}
{{--                                    <select id="update_invoice_no" name="invoice_no" class="form-control select2" style="width: 100%;">--}}
{{--                                        <option value="">Select Invoice No</option>--}}
{{--                                        @foreach($invoices as $invoice)--}}
{{--                                            <option value="{{$invoice->id}}">{{$invoice->invoice_no }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="date">Date of transaction</label>--}}
{{--                                    <input type="date" id="transaction_date" name="transaction_date" value="{{old('transaction_date')}}" class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="type">Payment Method </label>--}}
{{--                                    <select name="payment_method" id="payment_method" class="form-control select2">--}}
{{--                                        <option value="">Select Payment Method</option>--}}
{{--                                        @foreach($payment_methods as $method)--}}
{{--                                            <option value="{{$method->id}}">{{$method->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-row col-md-12">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="comments">Payment Details</label>--}}
{{--                                        <textarea name="comments" id="comments" class="form-control">{{old('comments')}}</textarea>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-3">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="slip">Bank Deposit Slip</label>--}}
{{--                                        <input type="file" name="slip" id="slip" value="{{old('slip')}}" class="form">--}}
{{--                                        <span class="text-blue">Max 2mb file size allowed. </span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}



{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group pull-right" style="margin-top: 40px">--}}
{{--                                    <label for="slip">&nbsp;&nbsp;</label>--}}
{{--                                    <input type="submit" value="Add" class="btn btn-info">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                        <!-- /.box-body -->--}}

{{--                    </div>--}}
{{--                </form>--}}
{{--                    <!-- /.box -->--}}
{{--                </div>--}}
{{--                <!-- Main content -->--}}
{{--            </div>--}}

            <div class="form row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Scope of Accreditation.</h3>
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
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Slip</th>
                                    <th>Transaction Date </th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="showRecord">
                                @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{@$invoice->department->name}}</td>
                                    <td><a href="{{$invoice->slip}}">Invoice</a></td>
                                    <td>{{$invoice->transaction_date}}</td>
                                    <td><i class="badge {{$invoice->status =='active'?'bg-green':'bg-red'}}">{{$invoice->status =='active'?'Active':'Inactive'}}</i></td>
                                    <td>@if($invoice->status!== 'paid')<span data-toggle="tooltip" title="Add Invoice Slip" data-id="{{$invoice->id}}"><i class="fa fa-money text-info invoice-add" data-toggle="modal"  data-target="#invoice_modal" ></i> </span>|@endif <i class="fa fa-trash text-info delete" data-id="{{$invoice->id}}" ></i> | <i class="fa fa-pencil text-blue edit" data-id="{{$invoice->id}}" data-row='{"id":"{{$invoice->id}}","program_id":"{{$invoice->department->id}}","slip":"{{$invoice->slip}}","date":"{{$invoice->transaction_date}}","status":"{{$invoice->status}}","comments":"{{$invoice->comments}}"}' data-toggle="modal" data-target="#edit-modal"></i> </td>
                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Department</th>
                                    <th>Slip</th>
                                    <th>Transaction Date </th>
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
                    <h4 class="modal-title">Edit Scope of accreditation. </h4>
                </div>
                <form action="javascript:void(0)" role="form" id="update" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
{{--                        <div class="col-md-6">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="name">Degree Program</label>--}}
{{--                                <select id="edit_department_id" name="department_id" class="form-control select2" style="width: 100%;">--}}
{{--                                    <option value="">Select Program</option>--}}
{{--                                    @foreach($departments as $department)--}}
{{--                                        <option value="{{$department->id}}" {{$department->id==old('program_id')?'selected':''}}>{{$department->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Transaction Date</label>
                                <input type="date" id="edit_transaction_date" name="transaction_date" value="{{old('transaction_date')}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Comments</label>
                                <textarea  id="edit_comments" name="comments" class="form-control">{{old('comments')}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">{{ __('Status') }} : </label>
                                <select name="status" id="status" class="form-control select2">
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="pending">Pending</option>
                                    <option value="paid">Paid</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Cheque No</label>
                                <input type="text" id="edit_cheque_no" name="cheque_no" value="{{old('cheque_no')}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Slip</label>
                                <input type="file" id="edit_slip" name="slip" value="{{old('slip')}}">
                                <span class="text-blue" id="old_name"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" value="update" class="btn btn-info">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="invoice_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Invoice Slip for Department Registration </h4>
                </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" method="POST" enctype="multipart/form-data" id="Invoice">
                            <div class="box box-primary">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Invoice No</label>
                                            <select id="update_invoice_no" name="invoice_no" class="form-control select2" style="width: 100%;">
                                                <option value="">Select Invoice No</option>
                                                @foreach($invoices as $invoice)
                                                    <option value="{{$invoice->id}}">{{$invoice->invoice_no }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date">Date of transaction</label>
                                            <input type="date" id="transaction_date" name="transaction_date" value="{{old('transaction_date')}}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Payment Method </label>
                                            <select name="payment_method" id="payment_method" class="form-control select2">
                                                <option value="">Select Payment Method</option>
                                                @foreach($payment_methods as $method)
                                                    <option value="{{$method->id}}">{{$method->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Cheque No</label>
                                            <input type="text" id="cheque_no" name="cheque_no" value="{{old('cheque_no')}}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="slip">Bank Deposit Slip</label>
                                            <input type="file" name="slip" id="slip" value="{{old('slip')}}" class="form">
                                            <span class="text-blue">Max 2mb file size allowed. </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="comments">Payment Details</label>
                                            <textarea name="comments" id="comments" class="form-control">{{old('comments')}}</textarea>
                                            <input type="hidden" name="id" id="id">
                                        </div>
                                    </div>

{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="type">{{ __('Status') }} : </label>--}}
{{--                                            <p><input type="radio" name="status" class="flat-red" value="active" > Active--}}
{{--                                                <input type="radio" name="status" class="flat-red" value="inactive">InActive</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                </div>
                                <!-- /.box-body -->
                            </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" value="update" name="submit" id="update-button" class="btn btn-info">
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

        //Initialize Select2 Elements
        $('.select2').select2()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $("#invoice_modal").on('shown.bs.modal', function (e) {
            console.log('this value', $(this));
            console.log('modal showed', $(this).data('id'));
        })
        /*Add Scope*/
        $('#Invoice').on('submit', function (e) {

            let invoice_no = $('#update_invoice_no').val();
            let cheque_no = $('#cheque_no').val();
            let transaction_date = $('#transaction_date').val();
            let slip = $('#slip').val();
            let payment_method = $('#payment_method').val();

            !invoice_no?addClass('invoice_no'):removeClass('invoice_no');
            !payment_method?addClass('payment_method'):removeClass('payment_method');
            !transaction_date?addClass('transaction_date'):removeClass('transaction_date');
            !slip?addClass('slip'):removeClass('slip');
            if(!transaction_date || !department_id || !slip || !payment_method)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
                // Yes button callback
                let formData = new FormData(this);
                $.ajax({
                    url:'{{url("strategic/invoices")}}/'+id,
                    type:'PUT',
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
                        console.log('invoices', response);
                       // setTimeout(() => location.reload(), 1000);
                    },
                    error:function(response, exception){
                        Notiflix.Loading.Remove();
                        $.each(response.responseJSON, function (index, val) {
                            Notiflix.Notify.Failure(val);
                        })
                    }
                })
        });

        $('#add').on('click', function (e) {

            let department_id = $('#department_id').val();
            let invoice_no = $('#invoice_no').val();

            !department_id?addClass('department_id'):removeClass('department_id');
            !invoice_no?addClass('invoice_no'):removeClass('invoice_no');
            if(!invoice_no || !department_id)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
                // Yes button callback
                $.ajax({
                    url:'{{url("strategic/generateInvoice")}}',
                    type:'POST',
                    data: {invoice_no:invoice_no, department_id:department_id},
                    beforeSend: function(){
                        Notiflix.Loading.Pulse('Processing...');
                    },
                    // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
                    success: function (response) {
                        Notiflix.Loading.Remove();
                        if(response.success){
                            Notiflix.Notify.Success(response.success);
                        }
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
        ///// edit record
        $('.edit').on('click', function () {
            let data = JSON.parse(JSON.stringify($(this).data('row')));
            console.log('type ', typeof data);
            // Initialize Select2
            $('#edit_invoice_id').select2().val(data.program_id).trigger('change');
            $('#status').select2().val(data.status).trigger('change');
            $('#edit_transaction_date').val(data.date);
            $('#id').val(data.id);
            $('#old_name').text(data.slip);
            $('#edit_comments').val(data.comments);
        });

        $('#update').on('submit', function () {
            let program_id = $('#edit_program_id').val();
            let edit_transaction_date = $('#edit_transaction_date').val();
            let slip = $('#edit_slip').val();
            let status = $('#status').val();
            let id = $('#id').val();

            !program_id?addClass('edit_program_id'):removeClass('edit_program_id');
            !edit_transaction_date?addClass('edit_transaction_date'):removeClass('edit_transaction_date');
            !slip?addClass('slip'):removeClass('slip');
            !status?addClass('status'):removeClass('status');
            if(!edit_transaction_date || !program_id || !status)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }

            let formData = new FormData(this);
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("strategic/invoices")}}/'+id,
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
                        url:'{{url("strategic/invoices")}}/'+id,
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
