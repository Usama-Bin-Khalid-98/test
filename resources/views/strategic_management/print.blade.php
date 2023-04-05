
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
    <section class="invoice" style="border-left: 4px solid #a7a168;border-top: 4px solid #a7a168;border-radius: 41px 0px;">
        <div class="jumbotron jumbotron-fluid" style="padding-bottom: 0;">
            <div class="container">
                <img src="{{URL::asset('dist/img/logo.png')}}" style="width: 100px">
                <span class="lead" style="font-size: 20px;"><strong>National Business Education Accreditation Council</strong>.</span>
                <img src="{{URL::asset('images/HECLogo.jpg')}}" style="width: 100px">
            </div>
        </div>
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 style="text-align: center;"><strong><u style="letter-spacing: 24px;">&nbsp;INVOICE</u></strong></h2>
                <h2 style="text-align:center"><small>Date: {{date("M d,Y",strtotime(@$getInvoice->created_at))}}</small></h2>
                <h4 style="margin-left: 10px;margin-right: 10px;">Invoice Number: {{@$getInvoice->invoice_no}}</h4>
                <h4 style="margin-left: 10px;margin-right: 10px;"><u>Member Code: {{@$getInvoice->campus->business_school->name}} Campus {{@$getInvoice->campus->location}}</u></h4>
                <h4 style="margin-left: 10px;margin-right: 10px;border-bottom:1px solid black"> {{@$getInvoice->campus->business_school->name}} Campus {{@$getInvoice->campus->location}} Accreditation registration fee.</h4>
            </div>
            <div class="col-xs-12">
                <h4 style="margin: 0px 10px 0px 10px;"><strong class="pull-left">Particular</strong><strong class="pull-right">Amount Rs.</strong></h4><br>
                <h4 style="margin: 0px 10px 0px 10px;"><span class="pull-left">Registration Fee</span><span class="pull-right">{{number_format(@$getInvoice->amount)}}/-</span></h4>
            </div>
            <div class="col-xs-7"></div>
            <div class="col-xs-5">
                <h4 style="border-bottom:1px solid black"></h4>
                <h4 style="border-bottom: 2px solid black;margin-top:20px;margin-left: 10px;margin-right:10px;"><strong style="text-align:left">Total: Rupees. </strong><strong class="pull-right">{{number_format(@$getInvoice->amount)}}/-</strong></h4><br>
                <h4 class="pull-right" style="margin-top:70px;margin-left:10px;margin-right:10px;">Asad Khan</h4><br>
                <h4 class="pull-right" style="margin: 0px 10px 0px 10px;">Accounts-Officer-NBEAC</h4>
            </div>
            <div class="col-xs-12">
                <p style="font-size: 16px;color:red;margin: 0px 10px 0px 10px;">HEC is Tax Exempted and FTN Number is 9011007-2.:</p><br>
            </div>
            <div class="col-xs-12">
                <p style="margin: 0px 10px 0px 10px;font-size:16px">Mail us the Cheque bearing the above stated amount in favor of NBEAC-HEC at National Business Education Accreditation Council, Room # 201, HRD Building, Gate # 2, Higher Education Commission, H-8, and Islamabad, Pakistan.</p><br>
                <p style="margin: 0px 10px 0px 10px;font-size:16px">CC: Mr. Ahtesham Ali Raja (Program Director-NBEAC)</p>
                <p style="margin: 0px 10px 0px 10px;font-size:16px">CC: Dr. Farrukh Iqbal (Chairman –NBEAC)</p>
            </div>
            <div class="col-xs-6"></div>
            <div class="col-xs-6">
                <div class="col-xs-6">
                    <div style="border-right:1px solid black;">
                        <p style="font-size: 12px;"><small>201,2nd floor,HRD Building<br>
                        Higher Education Commission<br>
                        Sector H-8,<br>
                        Islamabad– Pakistan 44000</small></p>
                    </div>
                </div>
                <div class="col-xs-6">
                    <p style="font-size: 12px;"><small>
                        Tel: +92-51-90800206-9<br>
                        Email: nbeac@hec.gov.pk<br>
                        Web: www.nbeac.org.pk<br>
                    </small></p>
                </div>
            </div>
            <!-- /.col -->
        </div>
        

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
