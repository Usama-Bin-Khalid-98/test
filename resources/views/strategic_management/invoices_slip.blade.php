@section('pageTitle', 'Users')

@php
$is_processing_a_slip = isProcessingASlip();
@endphp

@if(Auth::user())

    @include("../includes.head")
    <!-- Select2 -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{URL::asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
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
                    <button class="btn gradient-bg-color" @if($is_processing_a_slip) disabled @endif
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
                        <div class="pad margin no-print">
                          <div class="callout callout-info" style="margin-bottom: 0!important;">
                            <h4><i class="fa fa-info"></i> Note:</h4>
                                If you have paid the registration amount, please fill all the required fields, otherwise generate the invoice.
                          </div>
                        </div>
                    <form role="form" method="post">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Department</label>
                                    <input type="text" readonly id="department" name="department" readonly class="form-control" value="{{@$departments->name}}">
                                    <input type="hidden" readonly id="department_id" name="department_id" readonly class="form-control" value="{{@$departments->id}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Department Fee amount</label>
                                    <input type="text" readonly id="fee_amount" readonly name="fee_amount" value="Rs. {{@$fee_amount->amount}} /Program" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Invoice No</label>
                                    <input type="text" readonly id="invoice_no" readonly name="invoice_no" value="{{@$invoice_no??old('invoice_no')}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="number_of_programs">Number of Programs to be accreditated</label>
                                    <input type="number" required id="number_of_programs" name="number_of_programs" min=1 class="form-control">
                                </div>
                            </div>

{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="date">Date of transaction</label>--}}
{{--                                    <div class="input-group">--}}
{{--                                    <div class="input-group-addon">--}}
{{--                    <i class="fa fa-calendar"></i>--}}
{{--                  </div>--}}
{{--                                    <input type="text" id="add_transaction_date" name="transaction_date" value="<?php echo date('m/d/Y'); ?>" class="form-control">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group" style="margin-bottom: 22px;">--}}
{{--                                    <label for="type">Payment Method </label>--}}
{{--                                    <select name="payment_method" id="add_payment_method" class="form-control select2">--}}
{{--                                        <option value="">Select Payment Method</option>--}}
{{--                                        @foreach($payment_methods as $method)--}}
{{--                                            <option value="{{$method->id}}">{{$method->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="name">Cheque No</label>--}}
{{--                                    <input type="text" id="add_cheque_no" name="cheque_no" value="{{old('cheque_no')}}" class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group" style="margin-bottom: 18px;">--}}
{{--                                    <label for="type">{{ __('Status') }} : </label>--}}
{{--                                    <select name="status" id="add_status" class="form-control select2">--}}
{{--                                        <option value="active">Active</option>--}}
{{--                                        <option value="inactive">Inactive</option>--}}
{{--                                        <option value="pending">Pending</option>--}}
{{--                                        <option value="paid">Paid</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="slip">Bank Deposit Slip</label>--}}
{{--                                    <input type="file" name="slip" id="add_slip" accept=".pdf,.docx" value="{{old('slip')}}" class="form">--}}
{{--                                    <span class="text-blue">Max 2mb file size allowed. </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="comments">Payment Details</label>--}}
{{--                                    <textarea name="comments" id="add_comments" class="form-control">{{old('comments')}}</textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="button" class="btn btn-info" value="Generate" id="add">
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
            <div class="form row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Department registration invoices.</h3>
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

                    {{--  Content here --}}
                    <!-- /.box -->
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Generator</th>
                                    <th>Fee amount</th>
                                    <th>Invoice No</th>
                                    <th>Invoice</th>
                                    <th>Slip</th>
                                    <th>Transaction Date </th>
                                    <th>Details</th>
                                    <th>Invoice Status</th>
                                    <th>Reg Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="showRecord">
                                @php $totalAmount = 0; @endphp
                                @foreach($invoices as $invoice)
                                    <?php $url = $invoice->slip; ?>
                                    @php
                                        $totalAmount+= $invoice->amount;
                                    @endphp
                                <tr>
                                    <td>{{@$invoice->department->name}}</td>
                                    <td>Name : {{@$invoice->creator->name}}<br>
                                        Email : {{@$invoice->creator->email}}<br>
                                        Phone No : {{@$invoice->creator->contact_no}}
                                    </td>
                                    <td>{{@$invoice->amount}}</td>
                                    <td>{{$invoice->invoice_no}}</td>
                                    <td><a href="{{url('strategic/invoice/'.$invoice->id)}}">Invoice</a></td>
                                    <td><a href="<?php echo empty($url) ? '#' : url($url); ?>">Pay Slip</a></td>
                                    <td>{{$invoice->transaction_date}}</td>
                                    <td>{{$invoice->comments}}</td>
                                    <td><i style="cursor: default;" class="badge {{$invoice->status ==='approved'?'bg-green':'bg-red'}}">{{$invoice->status =='active'?'Active':ucwords($invoice->status)}}</i></td>
                                    <td><i style="cursor: default;" class="badge bg-maroon">{{ucwords($invoice->regStatus)}}</i></td>
                                    <td><span data-toggle="tooltip" title="Submit Payment Details" >
                                            <i style="font-size:32px" class="fa fa-money text-info invoice-add my-invoice" data-toggle="modal"  data-target="#invoice_modal" data-id="{{$invoice->id}}"
                                               data-row='{"id":"{{$invoice->id}}","department_id":"{{$invoice->department->name}}","slip":"{{$invoice->slip}}","payment_method_id":"{{$invoice->payment_method_id}}","status":"{{$invoice->status}}","cheque_no":"{{$invoice->cheque_no}}","comments":"{{str_replace(array("\r\n", "\r", "\n"), "", $invoice->comments)}}","transaction_date":"{{$invoice->transaction_date}}","invoice_no":"{{$invoice->invoice_no}}"}'></i> </span>@if($invoice->status != 'approved') <i style="font-size:32px" class="fa fa-trash text-info delete" data-id="{{$invoice->id}}"  ></i> @endif </td>
                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Department</th>
                                    <th style="color: rebeccapurple">Total: {{@$totalAmount}}</th>
                                    <th>Invoice No</th>
                                    <th>Invoice</th>
                                    <th>Slip</th>
                                    <th>Transaction Date </th>
                                    <th>Details</th>
                                    <th>Invoice Status</th>
                                    <th>Reg Status</th>
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

{{--                        <div class="col-md-6">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="type">{{ __('Status') }} : </label>--}}
{{--                                <select name="status" class="form-control select2">--}}
{{--                                    <option value="">Select Status</option>--}}
{{--                                    <option value="active">Active</option>--}}
{{--                                    <option value="inactive">Inactive</option>--}}
{{--                                    <option value="pending">Pending</option>--}}
{{--                                    <option value="paid">Paid</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Degree Department</label>
                                            <input type="text" readonly id="edit_department_id" name="department_id" readonly class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Invoice No</label>
                                            <input type="text" readonly id="update_invoice_no" readonly name="invoice_no" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date">Date of transaction</label>
                                            <div class="input-group">
                                            <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                                            <input type="text" id="transaction_date" name="transaction_date" autocomplete="off" value="{{old('transaction_date')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-bottom: 20px;">
                                            <label for="type">Payment Method </label>
                                            <select name="payment_method" id="payment_method" class="form-control select2">
                                                <option disabled selected>Select Payment Method</option>
                                                @foreach($payment_methods as $method)
                                                    <option value="{{$method->id}}">{{$method->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 ChequeNumber">
                                        <div class="form-group">
                                            <label for="name">Cheque No</label>
                                            <input type="text" id="cheque_no" name="cheque_no" value="{{old('cheque_no')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="slip">Bank Deposit Slip *</label>
                                            <input type="file" name="slip" id="slip" accept=".jpg,.jpeg,.png,.gif,.pdf,.docx" value="{{old('slip')}}" class="form">
                                            <span class="text-blue">Max 2mb file size allowed. </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="comments">Payment Details</label>
                                            <textarea name="comments" id="comments" required class="form-control">{{old('comments')}}</textarea>
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
                        @if(@$invoices[0]->status !=='approved')
                        <input type="submit" value="Paid" name="submit" id="update-button" class="btn btn-info">
                        @endif
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        </div>
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

        //Initialize Select2 Elements
        $('.select2').select2();
        $('#add_transaction_date').datepicker({
      autoclose:true
    });

        $('#transaction_date').datepicker({
      autoclose:true
    });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('change',"#payment_method",function(e){

        var payment_method = $(this).val();

        if(payment_method == 2) {

            $('.ChequeNumber').show();
            $('#cheque_no').attr('required',true);

        }else {

            $('.ChequeNumber').hide();
            $('#cheque_no').val(' ').trigger('change');
            $('#cheque_no').removeAttr('required',false);
        }

    });

        //let data = JSON.parse(JSON.stringify($(this).data('row')));
        //$('#edit_program_id').select2().val(data.program_id).trigger('change');

        $(".my-invoice").on('click', function () {
           // console.log('this value', $(this));
            //console.log('modal showed', $(this).data('id'));
            $('#id').val($(this).data('id'));
            // const data = $(this).data('row');
            const data = JSON.parse(JSON.stringify($(this).data('row')));
            console.log('invoice id ', data);
            $('#edit_department_id').val(data.department_id);
            $('#transaction_date').val(data.transaction_date);
            $('#update_invoice_no').val(data.invoice_no);

            $('#payment_method').select2().val(data.payment_method_id).trigger('change');
            $('#status').select2().val(data.status).trigger('change');
            $('#cheque_no').val(data.cheque_no);
            $('#comments').val(data.comments);
        })
        /*Add Scope*/
        $('#Invoice').on('submit', function (e) {

            let invoice_no = $('#update_invoice_no').val();
            let cheque_no = $('#cheque_no').val();
            let transaction_date = $('#transaction_date').val();
            let slip = $('#slip').val();
            let id = $('#id').val();
            let payment_method = $('#payment_method').val();
            let file = document.getElementById('slip');

            !invoice_no?addClass('invoice_no'):removeClass('invoice_no');
            !payment_method?addClass('payment_method'):removeClass('payment_method');
            !transaction_date?addClass('transaction_date'):removeClass('transaction_date');
            !slip?addClass('slip'):removeClass('slip');
            if(!transaction_date || !invoice_no || !payment_method || file.files.length < 1)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            
            let file_size_in_mbs = file.files[0].size / 1024 / 1024;
            if (file_size_in_mbs > 2){
                Notiflix.Notify.Warning("File size greater than 2 mb");
                return;
            }
                // Yes button callback
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
                        console.log('invoices', response);
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

        $('#add').on('click', function (e) {

            let department_id = $('#department_id').val();
            let invoice_no = $('#invoice_no').val();
            let transaction_date =  $('#add_transaction_date').val();
            let payment_method =  $('#add_payment_method').val();
            let status = $('#add_status').val();
            let cheque_no = $('#add_cheque_no').val();
            let comments = $('#add_comments').val();
            let number_of_programs = $('#number_of_programs').val();

            !department_id?addClass('department_id'):removeClass('department_id');
            !invoice_no?addClass('invoice_no'):removeClass('invoice_no');
            !number_of_programs?addClass('number_of_programs'):removeClass('number_of_programs');
            if(!invoice_no || !department_id || !number_of_programs)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
                // Yes button callback
                $.ajax({
                    url:'{{url("strategic/generateInvoice")}}',
                    type:'POST',
                    data: {
                        invoice_no:invoice_no,
                        department_id:department_id,
                        transaction_date:transaction_date,
                        payment_method:payment_method,
                        status:status,
                        cheque_no:cheque_no,
                        comments:comments,
                        number_of_programs:number_of_programs
                    },
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
        $('#number_of_programs').on('input', function(e){
            $('#fee_amount').val("Rs. " + ($('#number_of_programs').val() * {{@$fee_amount->amount}}));
        })
    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
