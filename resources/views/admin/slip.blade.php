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
{{--        <section class="content-header">--}}
{{--            <div class="col-md-12 new-button">--}}
{{--                <div class="pull-right">--}}
{{--                    <button class="btn gradient-bg-color" id="print" style="color: white;"--}}
{{--                            value="Print">Print <i class="fa fa-print"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

        {{--Dean section --}}
        <section class="content">
            <div class="form row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Registration Invoices.</h3>
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
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Department</th>
                                    <th>Invoice No</th>
                                    <th>Invoice</th>
                                    <th>Slip</th>
                                    <th>Transaction Date </th>
                                    <th>Details</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="showRecord">
                                @php $total_amount = 0;@endphp
                                @foreach($invoices as $invoice)
                                    @php $total_amount += $invoice->amount@endphp
                                    <tr>
                                        <td>{{@$invoice->school}}</td>
                                        <td>{{@$invoice->campus??'main campus'}}</td>
                                        <td>{{@$invoice->department}}</td>
                                        <td>{{$invoice->invoice_no}}</td>
                                        <td><a href="{{url('strategic/invoice/'.$invoice->id)}}">Invoice</a></td>
                                        <td><a href="{{$invoice->slip}}">Pay Slip</a></td>
                                        <td>{{$invoice->transaction_date}}</td>
                                        <td>{{$invoice->comments}}</td>
                                        <td>{{number_format($invoice->amount)}}</td>
                                        <td><i style="cursor: default;" class="badge {{$invoice->status ==='paid'?'bg-yellow':''}} {{$invoice->status ==='approved'?'bg-green':''}} {{$invoice->status ==='inactive'?'bg-red':''}}">{{$invoice->status =='active'?'Active':ucwords($invoice->status)}}</i></td>
                                        <td>
                                            <span data-toggle="tooltip" title="Invoice Slip Details" >
                                                <i class="fa fa-money text-info my-invoice" data-toggle="modal"  data-target="#invoice_modal" data-id="{{$invoice->id}}"
                                                data-row='{"id":"{{$invoice->id}}","user":"{{$invoice->user}}","designation":"{{$invoice->designation}}","school":"{{$invoice->school}}","campus":"{{$invoice->campus}}","department_id":"{{$invoice->department}}","slip":"{{$invoice->slip}}","payment_method_id":"{{$invoice->payment_method_id}}","status":"{{$invoice->status}}","cheque_no":"{{$invoice->cheque_no}}","comments":"{{str_replace(array("\r\n", "\r", "\n"), "", $invoice->comments)}}","transaction_date":"{{$invoice->transaction_date}}","invoice_no":"{{$invoice->invoice_no}}","email":"{{$invoice->email}}"}' ></i> </span></td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Department</th>
                                    <th>Invoice No</th>
                                    <th>Invoice</th>
                                    <th>Slip</th>
                                    <th>Transaction Date </th>
                                    <th>Details</th>
                                    <th style="color: mediumpurple">Total: {{@number_format($total_amount)}}</th>
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
    <div class="modal fade" id="invoice_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Department Registration invoice details.  </h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" method="POST" id="Invoice">
                        <div class="box box-primary">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Department</label>
                                        <p id="edit_department_id" ></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Invoice No</label>
                                        <p id="invoice_no"> </p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Date of transaction</label>
                                        <p id="transaction_date"> </p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Cheque No</label>
                                        <p id="cheque_no" ></p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="comments">Payment Details</label>
                                        <p id="comments" > </p>
                                        <input type="hidden" name="id" id="id">
                                        <input type="hidden" name="user" id="user">
                                        <input type="hidden" name="designation" id="designation">
                                        <input type="hidden" name="school" id="school">
                                        <input type="hidden" name="campus" id="campus">
                                        <input type="hidden" name="cheque_no" id="cheque_no">
                                        <input type="hidden" name="transaction_date" id="transaction_date">
                                        <input type="hidden" name="email" id="email">
                                    </div>
                                </div>

                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="type">{{ __('Check status to approve the payment.') }} : </label>
                                        <p><input type="checkbox" name="status" id="approvementStatus" class="flat-red" > Approve
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" style="margin-bottom: 18px;">
                                        <label for="type">{{ __('Status') }} : </label>
                                        <p> <span class="badge badge-success" id="status"></span></p>
                                    </div>
                                </div>

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

        $('#print').on('click', function (){
            var mywindow = window.open('', 'PRINT', 'height=400,width=600');

            mywindow.document.write('<html><head><title>' + document.title  + '</title>');
            mywindow.document.write('</head><body >');
            mywindow.document.write('<h1>' + document.title  + '</h1>');
            mywindow.document.write(document.getElementById('content').innerHTML);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            mywindow.print();
            mywindow.close();

            return true;
        });

        //let data = JSON.parse(JSON.stringify($(this).data('row')));
        //$('#edit_program_id').select2().val(data.program_id).trigger('change');

        $(".my-invoice").on('click', function () {
            // console.log('this value', $(this));
            //console.log('modal showed', $(this).data('id'));
            let data = JSON.parse(JSON.stringify($(this).data('row')));
            $('#id').val($(this).data('id'));
            $('#user').val(data.user);
            $('#designation').val(data.designation);
            $('#school').val(data.school);
            $('#campus').val(data.campus);
            $('#transaction_date').val(data.transaction_date);
            $('#cheque_no').val(data.cheque_no);
            $('#email').val(data.email);
            console.log('invoice id ', data);
            $('#edit_department_id').text(data.department_id);
            $('#transaction_date').text(data.transaction_date);
            $('#invoice_no').text(data.invoice_no);

            // $('#payment_method').select2().val(data.payment_method_id).trigger('change');
            $('#status').text(data.status)
            console.log(data.status);
            $('input[name=status]').iCheck('uncheck');
            if(data.status == 'approved') {
                $('input[name=status]').iCheck('check');
            }
            $('#cheque_no').text(data.cheque_no);
            $('#comments').val(data.comments);
        })

        $('#update-button').on('click', function () {
            let status = $('#approvementStatus:checked').val();
            let id = $('#id').val();
            let user = $('#user').val();
            let designation = $('#designation').val();
            let school = $('#school').val();
            let campus = $('#campus').val();
            let transaction_date = $('#transaction_date').val();
            let cheque_no = $('#cheque_no').val();
            let email = $('#email').val();

            status? status = 'approved':status = 'paid';
            if(status == 'paid')
            {
                Notiflix.Notify.Failure("Status Can't  be changed to paid, once approved.");
                return;
            }

            $.ajax({
                url:'{{url("approvementStatus")}}',
                type:'POST',
                data: {status:status, id:id ,user:user,designation:designation,school:school,campus:campus,transaction_date:transaction_date,cheque_no:cheque_no,email:email},
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
                    // location.reload();
                },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })
                }
            })
        })

    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
