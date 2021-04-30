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


        @hasrole('NBEACAdmin|Mentor')
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
                                        <td>Audit Report</td>
                                        <td>Appendix-1C</td>
                                        <td> <a href="{{url($AuditReport??'#')}}"><span data-toggle="tooltip" title="{{$AuditReport??''}}" class="label label-{{$AuditReport?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
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
                                        <td>Course Outline</td>
                                        <td>Appendix-2A</td>
                                        <td> <a href="{{url($CourseOutline??'#')}}"><span data-toggle="tooltip" title="{{$CourseOutline??''}}" class="label label-{{$CourseOutline?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>



                                    <tr>
                                        <td>Evaluation Method</td>
                                        <td>Appendix-2B</td>
                                        <td> @foreach($EvaluationMethod as $method) <a href="{{url($method->file??'#')}}"><span class="label label-{{$method->file?'success':'danger'}}" alt="{{$method->evaluation_items->name}}" data-toggle="tooltip" title="{{$method->evaluation_items->name}}"><i class="glyphicon glyphicon-file"></i></span></a> @endforeach</td>
                                    </tr>
                                    <tr>
                                        <td>Program Delivery</td>
                                        <td>Appendix-2C</td>
                                        <td> <a href="{{url($ProgramDelivery??'#')}}"><span data-toggle="tooltip" title="{{$ProgramDelivery??''}}" class="label label-{{$ProgramDelivery?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>
                                    <tr>
                                        <td>Question Paper</td>
                                        <td>Appendix-2D</td>
                                        <td> <a href="{{url($QuestionPaper??'#')}}"><span data-toggle="tooltip" title="{{$QuestionPaper??''}}" class="label label-{{$QuestionPaper?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>

                                    <tr>
                                        <td>Plagiarism Case</td>
                                        <td>Appendix-2E</td>
                                        <td> <a href="{{url($PlagiarismCase??'#')}}"><span data-toggle="tooltip" title="{{$PlagiarismCase??''}}" class="label label-{{$PlagiarismCase?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>
                                    <tr>
                                        <td>Financial Assistance</td>
                                        <td>Appendix-3A</td>
                                        <td> <a href="{{url($FinancialAssistance??'#')}}"><span data-toggle="tooltip" title="{{$FinancialAssistance??''}}" class="label label-{{$FinancialAssistance?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>

                                    <tr>
                                        <td>Alumni Membership</td>
                                        <td>Appendix-3B</td>
                                        <td> <a href="{{url($AlumniMembership??'#')}}"><span data-toggle="tooltip" title="{{$AlumniMembership??''}}" class="label label-{{$AlumniMembership?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>

                                    <tr>
                                        <td>Faculty Promotion</td>
                                        <td>Appendix-4A</td>
                                        <td> <a href="{{url($FacultyPromotion??'#')}}"><span data-toggle="tooltip" title="{{$FacultyPromotion??''}}" class="label label-{{$FacultyPromotion?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>
                                    <tr>
                                        <td>Faculty Develop</td>
                                        <td>Appendix-4B</td>
                                        <td> <a href="{{url($FacultyDevelop??'#')}}"><span data-toggle="tooltip" title="{{$FacultyDevelop??''}}" class="label label-{{$FacultyDevelop?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>
                                    <tr>
                                        <td>Faculty Consultancy</td>
                                        <td>Appendix-4C</td>
                                        <td> <a href="{{url($FacultyConsultancy??'#')}}"><span data-toggle="tooltip" title="{{$FacultyConsultancy??''}}" class="label label-{{$FacultyConsultancy?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>

                                    <tr>
                                        <td>Faculty Exposure</td>
                                        <td>Appendix-4D</td>
                                        <td> <a href="{{url($FacultyExposure??'#')}}"><span data-toggle="tooltip" title="{{$FacultyExposure??''}}" class="label label-{{$FacultyExposure?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>

                                    <tr>
                                        <td>Research Agenda</td>
                                        <td>Appendix-5A</td>
                                        <td> <a href="{{url($ResearchAgenda??'#')}}"><span data-toggle="tooltip" title="{{$ResearchAgenda??''}}" class="label label-{{$ResearchAgenda?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>

                                    <tr>
                                        <td>Project Detail</td>
                                        <td>Appendix-6A</td>
                                        <td> <a href="{{url($ProjectDetail??'#')}}"><span data-toggle="tooltip" title="{{$ProjectDetail??''}}" class="label label-{{$ProjectDetail?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>

                                    <tr>
                                        <td>Environmental Protection</td>
                                        <td>Appendix-6A</td>
                                        <td> <a href="{{url($EnvProtection??'#')}}"><span data-toggle="tooltip" title="{{$EnvProtection??''}}" class="label label-{{$EnvProtection?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>
                                    <tr>
                                        <td>Complaint Resolution</td>
                                        <td>Appendix-6C</td>
                                        <td> <a href="{{url($ComplaintResolution??'#')}}"><span data-toggle="tooltip" title="{{$ComplaintResolution??''}}" class="label label-{{$ComplaintResolution?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>
                                    <tr>
                                        <td>Internal Community</td>
                                        <td>Appendix-6D</td>
                                        <td> <a href="{{url($InternalCommunity??'#')}}"><span data-toggle="tooltip" title="{{$InternalCommunity??''}}" class="label label-{{$InternalCommunity?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>

                                    <tr>
                                        <td>Social Activity</td>
                                        <td>Appendix-6E</td>
                                        <td> <a href="{{url($SocialActivity??'#')}}"><span data-toggle="tooltip" title="{{$SocialActivity??''}}" class="label label-{{$SocialActivity?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>

                                    <tr>
                                        <td>Qec Info</td>
                                        <td>Appendix-7A</td>
                                        <td> <a href="{{url($QecInfo??'#')}}"><span data-toggle="tooltip" title="{{$QecInfo??''}}" class="label label-{{$QecInfo?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>

                                    <tr>
                                        <td>Linkages</td>
                                        <td>Appendix-8A</td>
                                        <td> <a href="{{url($Linkages??'#')}}"><span data-toggle="tooltip" title="{{$Linkages??''}}" class="label label-{{$Linkages?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>

                                    <tr>
                                        <td>Student Exchange</td>
                                        <td>Appendix-8B</td>
                                        <td> <a href="{{url($StudentExchange??'#')}}"><span data-toggle="tooltip" title="{{$StudentExchange??''}}" class="label label-{{$StudentExchange?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>

                                    <tr>
                                        <td>Faculty Exchange</td>
                                        <td>Appendix-8C</td>
                                        <td> <a href="{{url($FacultyExchange??'#')}}"><span data-toggle="tooltip" title="{{$FacultyExchange??''}}" class="label label-{{$FacultyExchange?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>


                                    <tr>
                                        <td>Obtained Internship</td>
                                        <td>Appendix-8D</td>
                                        <td> <a href="{{url($ObtainedInternship??'#')}}"><span data-toggle="tooltip" title="{{$ObtainedInternship??''}}" class="label label-{{$ObtainedInternship?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>


                                    <tr>
                                        <td>Admission Office</td>
                                        <td>Appendix-9A</td>
                                        <td> <a href="{{url($AdmissionOffice??'#')}}"><span data-toggle="tooltip" title="{{$AdmissionOffice??''}}" class="label label-{{$AdmissionOffice?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>

                                    <tr>
                                        <td>Credit Transfer</td>
                                        <td>Appendix-9C</td>
                                        <td> <a href="{{url($CreditTransfer??'#')}}"><span data-toggle="tooltip" title="{{$CreditTransfer??''}}" class="label label-{{$CreditTransfer?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>

                                    <tr>
                                        <td>Student Transfer</td>
                                        <td>Appendix-9D</td>
                                        <td> <a href="{{url($StudentTransfer??'#')}}"><span data-toggle="tooltip" title="{{$StudentTransfer??''}}" class="label label-{{$StudentTransfer?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
                                    </tr>

                                    <tr>
                                        <td>Documentary Evidence</td>
                                        <td>Appendix-9E</td>
                                        <td> <a href="{{url($DocumentaryEvidence??'#')}}"><span data-toggle="tooltip" title="{{$DocumentaryEvidence??''}}" class="label label-{{$DocumentaryEvidence?'success':'danger'}}"><i class="glyphicon glyphicon-file"></i></span></a> </td>
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
<!-- Morris.js charts -->
{{--<script src="bower_components/raphael/raphael.min.js"></script>--}}
{{--<script src="bower_components/morris.js/morris.min.js"></script>--}}
<!-- Sparkline -->
{{--<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>--}}
<!-- jvectormap -->
{{--<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>--}}
{{--<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>--}}
<!-- jQuery Knob Chart -->
{{--<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>--}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="dist/js/pages/dashboard.js"></script>--}}
@hasrole('NBEACAdmin|Mentor')
<script>
    $('.status').on('click', function (e) {
        var id = $(this).data('id');

        Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to activate?', 'Yes', 'No',
            function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                // Yes button callback
                $.ajax({
                    url:'{{url("admin")}}/'+id,
                    type:'PATCH',
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

                        console.log('response here', response);
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
    });

function deskReview(id){
    $('#myModal').modal("show");
    $("#slipId").val(id);
}

</script>

@endhasrole
