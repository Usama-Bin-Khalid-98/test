@section('pageTitle', 'Users')


@if(Auth::user())

    @include("../includes.head")
    <!-- Select2 -->
    @include("../includes.header")
    @include("../includes.nav")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>{{@$getInvoice->invoice_no}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Department</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>

    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Note:</h4>
        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
      </div>
    </div>

    <!-- Main content -->
    <section class="invoice">
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
{{--                National Business Education Accreditation Council (NBEAC), N-Block, HEC, H-8/1, Islamabad--}}
            <strong>NBEAC .</strong><br>
                National Business Education Accreditation Council (NBEAC),<br>
                N-Block, HEC, H-8/1,<br>
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
          <a href="{{url('strategic/print/')}}/{{@$getInvoice->id}}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
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
  <!-- /.content-wrapper -->
    @include("../includes.footer")
@endif
