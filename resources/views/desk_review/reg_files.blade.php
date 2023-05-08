@section('pageTitle', 'Dashboard')

@if(Auth::user())


    @include("includes.head")
    <!-- Morris chart -->
    <link rel="stylesheet" href="bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />

    @include("includes.header")
    @include("includes.nav")


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section><!-- Main content -->


        @hasrole('NBEACAdmin|Mentor|PeerReviewer')
        <section class="content">

            <div class="row" >
                <!-- Left col -->
                <section class="col-lg-7  connectedSortable" style="display: none;">
                    <!-- Custom tabs (Charts with tabs)-->
                    <!-- quick email widget -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <i class="fa fa-envelope"></i>

                            <h3 class="box-title">Quick Email</h3>
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                                        title="Remove">
                                    <i class="fa fa-times"></i></button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <div class="box-body">
                            <form action="#" method="post">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject">
                                </div>
                                <div>
                  <textarea class="" placeholder="Message"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="box-footer clearfix">
                            <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
                                <i class="fa fa-arrow-circle-right"></i></button>
                        </div>
                    </div>

                </section>
                <!-- /.Left col -->

                <!--Registrations list-->
                <section class="col-lg-12 connectedSortable">
                    <!-- TO DO List -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Business school Department Registrations. </h3>
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

                    <div class="box-group" style="margin: 20px; ">
                        <div class="col-md-4 m-lg-5" >
                            <div class="h6 text-bold"> Business School Name</div>
                            <div class="text-body"> {{$schoolInfo->campus->business_school->name}}</div>
                        </div>

                        <div class="col-md-4 m-lg-5">
                            <div class="h6 text-bold"> Campus</div>
                            <div class="text-body"> {{$schoolInfo->campus->location}}</div>
                        </div>
                        <div class="col-md-4 m-lg-5">
                            <div class="h6 text-bold"> Department</div>
                            <div class="text-body"> {{$schoolInfo->department->name}}</div>
                        </div>
                        </div>
                        <div class="col-md-12" style="margin: 30px">
                            <div> <strong> Note: </strong> The Red <span class="label label-danger"><i class="glyphicon glyphicon-file"></i> </span>  &nbsp; icon shows the file is not uploaded yet, The purple <span class="label label-success"><i class="glyphicon glyphicon-file"></i></span> shows the file is uploaded. </div>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">


                            <table id="example1" class="table table-bordered table-striped" style="margin-top: 20px !important;">
                                <thead>
                                <tr>
                                    <th>Forms</th>
                                    <th>Appendix</th>
                                    <th>Files</th>
{{--                                    <th>Action</th>--}}
                                </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Contact Info</td>
                                        <td>Appendix-1A</td>
                                        <td>@foreach($ContactInfo as $key=>$contacts) @if(!$loop->first)  @if($ContactInfo[$key-1]->name != $contacts->name) <a href="{{url($contacts->cv??'#')}}"><span data-toggle="tooltip" title="{{$contacts->cv??''}}" class="label label-{{$contacts->cv?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> @endif @else <a href="{{url($contacts->cv??'#')}}"><span class="label label-success"><i class="glyphicon glyphicon-file"></i></span></a> @endif @endforeach</td>
                                    </tr>
                                    <tr>
                                        <td>Statutory Committee</td>
                                        <td>Appendix-1B</td>
                                        <td> @foreach($StateryCommittee as $committee) @if($committee->file !='' && $committee->file !='/') <a href="{{url($committee->file??'#')}}"><span data-toggle="tooltip" title="{{$committee->file??''}}" class="label label-{{$committee->file?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> @endif @endforeach</td>
                                    </tr>

                                    <tr>
                                        <td>Mission/Vision</td>
                                        <td>Appendix-1C</td>
                                        <td>  <a href="{{url($MissionVision??'#')}}"><span data-toggle="tooltip" title="{{$MissionVision??''}}" class="label label-{{$MissionVision?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a></td>
                                    </tr>

                                    <tr>
                                        <td>Strategic Plan</td>
                                        <td>Appendix-1D</td>
                                        <td> <a href="{{url($StrategicPlan??'#')}}"><span data-toggle="tooltip" title="{{$StrategicPlan??''}}" class="label label-{{$StrategicPlan?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a></td>
                                    </tr>

                                    <tr>
                                        <td>Organograms/Parent Institution</td>
                                        <td>Appendix-1F</td>
                                        <td> <a href="{{url($ParentInstitution??'#')}}"><span data-toggle="tooltip" title="{{$ParentInstitution??''}}" class="label label-{{$ParentInstitution?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>
                                    <tr>
                                        <td>Workload Policy</td>
                                        <td>Appendix-4A</td>
                                        @if($appendixFiles->workload_policy)
                                        <td><a href="{{url($appendixFiles->workload_policy)}}"><span data-toggle="tooltip" title="{{$appendixFiles->workload_policy??''}}" class="label label-{{$appendixFiles->workload_policy?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Research Summary</td>
                                        <td>Appendix-5A</td>
                                        @if($appendixFiles->research_summary)
                                        <td><a href="{{url($appendixFiles->research_summary)}}"><span data-toggle="tooltip" title="{{$appendixFiles->research_summary??''}}" class="label label-{{$appendixFiles->research_summary?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a></td>
                                        @endif
                                    </tr>
                                </tbody>
                                <tfoot>
                                <tr>

                                    <th>Forms</th>
                                    <th>Appendix</th>
                                    <th>File</th>
{{--                                    <th>Action</th>--}}
                                </tr>
                                </tfoot>
                            </table>

                            <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                        </div>

                    </div>
                    <!-- /.box -->

                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </section>
        @endhasrole

<div class="container">




  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Desk Review Status</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <form class="form-group">
            @csrf
          <div class="row">
              <div class="col col-sm-12 col-md-3 col-lg-3">
                  <label> Review</label>
              </div>
              <div class="col col-sm-12 col-md-9 col-lg-9">
                  <select class="form-control" name="review" id="review">
                      <option value="">Select Review</option>
                      <option value="SAR">Further Improvements</option>
                      <option value="SARDeskReview">Go-ahead for final SAR submission</option>
                  </select>
              </div>
          </div><br>
          <div class="row">
              <div class="col col-sm-12 col-md-3 col-lg-3">
                  <label> Comments</label>
              </div>
              <div class="col col-sm-12 col-md-9 col-lg-9">
                  <textarea name="comments" id="comments" class="form-control" style="height: 200px"></textarea>
              </div>
          </div>
          <input type="text" name="slipId" id="slipId" hidden="hidden">
        </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="submitReview(event)">Submit</button>
        </div>

      </div>
    </div>
  </div>

</div>

        <!-- /.content -->
    </div>



    <script src="{{URL::asset('notiflix/notiflix-2.3.2.min.js')}}"></script>

    @include("includes.footer")
@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
<!-- /.modal -->
 <script src="{{URL::asset('notiflix/notiflix-2.3.2.min.js')}}"></script>
 <script src="{{URL::asset('plugins/iCheck/icheck.min.js')}}"></script>
