
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NBEAC | Invoice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
    <!-- Main content -->
    <!-- Main content -->
    <section class="invoice">
        <div class="jumbotron jumbotron-fluid" style="padding-bottom: 0;">
            <div class="container">
                <img src="{{URL::asset('dist/img/logo.png')}}" style="width: 100px">
                <span class="lead" style="font-size: 20px;"><strong>NBEAC</strong> (National Business Education Accreditation Council).</span>
            </div>
        </div>
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> Department Registration Invoice.
                    <small class="pull-right">Date: {{@$getInvoice->created_at}}</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                {{--          <address>--}}
                {{--            <strong>NBEAC .</strong><br>--}}
                {{--              201,2nd floor,HRD Building<br>--}}
                {{--              Higher Education Commission<br>--}}
                {{--              Sector H-8<br>--}}
                {{--              Islamabad– Pakistan 44000--}}
                {{--          </address>--}}
                <address>
                    <strong>NBEAC .</strong><br>
                    201,2nd floor,HRD Building<br>
                    Higher Education Commission<br>
                    Sector H-8<br>
                    Islamabad– Pakistan 44000<br>
                    <strong>Phone:</strong> +92-51-90800206-9<br>
                    <strong>Email:</strong> nbeac@hec.gov.pk<br>
                    <strong>Web:</strong> www.nbeac.org.pk<br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                To
                <address>
                    <strong>Member Code: </strong> {{@$getInvoice->campus->business_school->name}} Campus {{@$getInvoice->campus->location}}<br>
                    <strong>Location:</strong>{{@$getInvoice->campus->location}}<br>
                    <strong>Phone:</strong> {{@$getInvoice->user->contact_no}}<br>
                    <strong>Email:</strong> {{@$getInvoice->user->email}}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Invoice #</b>{{@$getInvoice->invoice_no}}<br>
                <br>
                {{--          <b>Payment Due:</b> {{date('Y-m-d') }}<br>--}}
                {{--          <b>Account:</b> 968-34567--}}
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Serial No</th>
                        <th>Business School</th>
                        <th>Campus</th>
                        <th>Department</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>1</td>
                        <td>{{@$getInvoice->campus->business_school->name}}</td>
                        <td>{{@$getInvoice->campus->location}}</td>
                        <td>{{@$getInvoice->department->name}}</td>
                        <td>{{@$getInvoice->amount}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead" style="font-size: 16px">HEC is Tax Exempted and FTN Number is 9011007-2.:</p>
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Mail us the Cheque bearing the above stated amount in favor of NBEAC-HEC at National Business Education Accreditation Council, Room # 201, HRD Building, Gate # 2, Higher Education Commission, H-8, and Islamabad, Pakistan.
                    <br>CC: Mr. Ahtesham Ali Raja (Program Director-NBEAC) <br>CC: Dr. Farrukh Iqbal (Chairman –NBEAC)
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Details </p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>{{@$getInvoice->amount}}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td></td>
                        </tr>

                        <tr>
                            <th>Total:</th>
                            <td>{{@$getInvoice->amount}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                {{--          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment--}}
                {{--          </button>--}}
                {{--          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">--}}
                {{--            <i class="fa fa-download"></i> Generate PDF--}}
                {{--          </button>--}}
            </div>
        </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
</div>
    <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
