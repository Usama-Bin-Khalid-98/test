@section('pageTitle', 'Desk Review')
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
                Peer Review Profile Sheet
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active">Profile Sheet</li>
            </ol>
        </section>
        <section class="content-header">
{{--            <div class="col-md-12 new-button">--}}
{{--                <div class="pull-right">--}}
{{--                    <button class="btn gradient-bg-color"--}}
{{--                            --}}{{--                           data-toggle="modal" data-target="#add-modal"--}}
{{--                            style="color: white;"--}}
{{--                            value="Add New">PDF <i class="fa fa-file-pdf-o"></i></button>--}}
{{--                </div>--}}
{{--            </div>--}}
        </section>
        {{--Dean section --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-title" style="padding: 30px;" align="center">National Business Education Accreditation Council (NBEAC), Higher Education Commission, Islamabad</div>
                        <div class="box-header">
                            <h5><strong>University Name :</strong> {{$registrations->campus->business_school->name}}</h5>
                            <h5><strong>Campus :</strong> {{$registrations->campus->location}}</h5>
                            <h5><strong>Business School:</strong> {{$registrations->department->name}}</h5>
                            <h5><strong>Applied for:</strong>@foreach(@$scopes as $scope) {{@$scope->program->name}}  @if(!$loop->last) , @endif @endforeach</h5>

                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                                <h4>Peer Review Panel Members</h4>
                                <table class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <th style="width: 45%">Name And Designation</th>
                                            <th style="width: 45%">Organization</th>
                                            <th style="width: 45%">Role in AIC</th>
                                            <th style="width: 45%">Signature</th>
                                        </tr>
                                    </thead>
                                </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>



                <!-- Main content -->
            </div>
        <section>
            <form name="profile_sheet" id="profileSheet" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-title" style="padding: 30px;" align="center">Overall Quality Evaluation</div>

                        <!-- /.box-header -->
                        <div class="box-body">
                                <table class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">F01</th>
                                            <th style="width: 15%">Strategic Management</th>
                                            <th style="width: 40%">Comments</th>
                                            <th style="width: 5%">(W=4)</th>
                                            <th style="width: 5%">(X=3)</th>
                                            <th style="width: 5%">(Y=2)</th>
                                            <th style="width: 5%">(Z=0)</th>
                                            <th style="width: 10%">Scores Gained</th>
                                            <th style="width: 10%">Scores Assigned</th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <td>1</td>
                                        <td>Autonomy of the Business School</td>
                                        <td><textarea class="form-control" name="comments1" id="comments1"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w1" id="w1"></td>
                                        <td><input type="text" maxlength="1" name="x1" id="x1"></td>
                                        <td><input type="text" maxlength="1" name="y1" id="y1"></td>
                                        <td><input type="text" maxlength="1" name="z1" id="z1"></td>
                                        <td><input type="text" maxlength="1" name="score_gained1" id="score_gained1"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned1" id="score_assigned1"></td>
                                    </tr>

                                    <tr>
                                        <td>2</td>
                                        <td>Financial Support</td>
                                        <td><textarea class="form-control" name="comments2" id="comments2"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w2" id="w2"></td>
                                        <td><input type="text" maxlength="1" name="x2" id="x2"></td>
                                        <td><input type="text" maxlength="1" name="y2" id="y2"></td>
                                        <td><input type="text" maxlength="1" name="z2" id="z2"></td>
                                        <td><input type="text" maxlength="1" name="score_gained2" id="score_gained2"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned2" id="score_assigned2"></td>
                                     </tr>

                                    <tr>
                                        <td>3</td>
                                        <td>External Participation in Academic Governance</td>
                                        <td><textarea class="form-control" name="comments3" id="comments3"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w3" id="w3"></td>
                                        <td><input type="text" maxlength="1" name="x3" id="x3"></td>
                                        <td><input type="text" maxlength="1" name="y3" id="y3"></td>
                                        <td><input type="text" maxlength="1" name="z3" id="z3"></td>
                                        <td><input type="text" maxlength="1" name="score_gained3" id="score_gained3"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned3" id="score_assigned3"></td>
                                    </tr>

                                    <tr>
                                        <td>4</td>
                                        <td>Internal Governance</td>
                                        <td><textarea class="form-control" name="comments4" id="comments4"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w4" id="w4"></td>
                                        <td><input type="text" maxlength="1" name="x4" id="x4"></td>
                                        <td><input type="text" maxlength="1" name="y4" id="y4"></td>
                                        <td><input type="text" maxlength="1" name="z4" id="z4"></td>
                                        <td><input type="text" maxlength="1" name="score_gained4" id="score_gained4"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned4" id="score_assigned4"></td>
                                    </tr>

                                    <tr>
                                        <td>5</td>
                                        <td>Sense of Vision and Mission</td>
                                        <td><textarea class="form-control" name="comments5" id="comments5"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w5" id="w5"></td>
                                        <td><input type="text" maxlength="1" name="x5" id="x5"></td>
                                        <td><input type="text" maxlength="1" name="y5" id="y5"></td>
                                        <td><input type="text" maxlength="1" name="z5" id="z5"></td>
                                        <td><input type="text" maxlength="1" name="score_gained5" id="score_gained5"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned5" id="score_assigned5"></td>
                                    </tr>

                                    <tr>
                                        <td>6</td>
                                        <td>Credibility of Strategic Planning and Positioning</td>
                                        <td><textarea class="form-control" name="comments6" id="comments6"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w6" id="w6"></td>
                                        <td><input type="text" maxlength="1" name="x6" id="x6"></td>
                                        <td><input type="text" maxlength="1" name="y6" id="y6"></td>
                                        <td><input type="text" maxlength="1" name="z6" id="z6"></td>
                                        <td><input type="text" maxlength="1" name="score_gained6" id="score_gained6"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned6" id="score_assigned6"></td>
                                    </tr>
                                    <tfoot>
                                    <tr>
                                        <th colspan="3">Count</th>
                                        <th><span id="count-w01"></span></th>
                                        <th><span id="count-x01"></span></th>
                                        <th><span id="count-y01"></span></th>
                                        <th><span id="count-z01"></span></th>
                                    </tr>

                                    <tr>
                                        <th colspan="3">Score</th>
                                        <th ><span id="total-w01"></span></th>
                                        <th><span id="total-x01"></span></th>
                                        <th><span id="total-y01"></span></th>
                                        <th><span id="total-z01"></span></th>
                                        <th>11.88</th>
                                        <th>15</th>
                                    </tr>

                                    </tfoot>

                                </table>
                            <div class="col-md-12 " style="padding: 20px"><button class="btn btn-primary update" style="float: right;">  update</button></div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- Main content -->
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-title" style="padding: 30px;" align="center">Overall Quality Evaluation</div>

                        <!-- /.box-header -->
                        <div class="box-body">
                                <table class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%">F02</th>
                                        <th style="width: 15%">Curriculum</th>
                                        <th style="width: 40%">Comments</th>
                                        <th style="width: 5%">(W=4)</th>
                                        <th style="width: 5%">(X=3)</th>
                                        <th style="width: 5%">(Y=2)</th>
                                        <th style="width: 5%">(Z=0)</th>
                                        <th style="width: 10%">Scores Gained</th>
                                        <th style="width: 10%">Scores Assigned</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td>7</td>
                                        <td>Curriculum and Portfolio Alignment</td>
                                        <td><textarea class="form-control" name="comments7" id="comments7"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w7" id="w7"></td>
                                        <td><input type="text" maxlength="1" name="x7" id="x7"></td>
                                        <td><input type="text" maxlength="1" name="y7" id="y7"></td>
                                        <td><input type="text" maxlength="1" name="z7" id="z7"></td>
                                        <td><input type="text" maxlength="1" name="score_gained7" id="score_gained7"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned7" id="score_assigned7"></td>
                                    </tr>

                                    <tr>
                                        <td>8</td>
                                        <td>Program Design</td>
                                        <td><textarea class="form-control" name="comments8" id="comments8"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w8" id="w8"></td>
                                        <td><input type="text" maxlength="1" name="x8" id="x8"></td>
                                        <td><input type="text" maxlength="1" name="y8" id="y8"></td>
                                        <td><input type="text" maxlength="1" name="z8" id="z8"></td>
                                        <td><input type="text" maxlength="1" name="score_gained8" id="score_gained8"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned8" id="score_assigned8"></td>
                                     </tr>

                                    <tr>
                                        <td>9</td>
                                        <td>Program Content and Coverage</td>
                                        <td><textarea class="form-control" name="comments9" id="comments9"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w9" id="w9"></td>
                                        <td><input type="text" maxlength="1" name="x9" id="x9"></td>
                                        <td><input type="text" maxlength="1" name="y9" id="y9"></td>
                                        <td><input type="text" maxlength="1" name="z9" id="z9"></td>
                                        <td><input type="text" maxlength="1" name="score_gained9" id="score_gained9"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned9" id="score_assigned9"></td>
                                    </tr>

                                    <tr>
                                        <td>10</td>
                                        <td>Responsiveness to Corporate Needs</td>
                                        <td><textarea class="form-control" name="comments10" id="comments10"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w10" id="w10"></td>
                                        <td><input type="text" maxlength="1" name="x10" id="x10"></td>
                                        <td><input type="text" maxlength="1" name="y10" id="y10"></td>
                                        <td><input type="text" maxlength="1" name="z10" id="z10"></td>
                                        <td><input type="text" maxlength="1" name="score_gained10" id="score_gained10"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned10" id="score_assigned10"></td>
                                    </tr>

                                    <tr>
                                        <td>11</td>
                                        <td>Indigenous and Comparative Material in Course Content</td>
                                        <td><textarea class="form-control" name="comments11" id="comments11"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w11" id="w11"></td>
                                        <td><input type="text" maxlength="1" name="x11" id="x11"></td>
                                        <td><input type="text" maxlength="1" name="y11" id="y11"></td>
                                        <td><input type="text" maxlength="1" name="z11" id="z11"></td>
                                        <td><input type="text" maxlength="1" name="score_gained11" id="score_gained11"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned11" id="score_assigned11"></td>
                                    </tr>

                                    <tr>
                                        <td>12</td>
                                        <td>Soft Skills Provision</td>
                                        <td><textarea class="form-control" name="comments12" id="comments12"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w12" id="w12"></td>
                                        <td><input type="text" maxlength="1" name="x12" id="x12"></td>
                                        <td><input type="text" maxlength="1" name="y12" id="y12"></td>
                                        <td><input type="text" maxlength="1" name="z12" id="z12"></td>
                                        <td><input type="text" maxlength="1" name="score_gained12" id="score_gained12"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned12" id="score_assigned12"></td>
                                    </tr>

                                    <tr>
                                        <td>13</td>
                                        <td>Program Delivery</td>
                                        <td><textarea class="form-control" name="comments13" id="comments13"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w13" id="w13"></td>
                                        <td><input type="text" maxlength="1" name="x13" id="x13"></td>
                                        <td><input type="text" maxlength="1" name="y13" id="y13"></td>
                                        <td><input type="text" maxlength="1" name="z13" id="z13"></td>
                                        <td><input type="text" maxlength="1" name="score_gained13" id="score_gained13"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned13" id="score_assigned13"></td>
                                    </tr>

                                    <tr>
                                        <td>14</td>
                                        <td>Examination and Assessment</td>
                                        <td><textarea class="form-control" name="comments14" id="comments14"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w14" id="w14"></td>
                                        <td><input type="text" maxlength="1" name="x14" id="x14"></td>
                                        <td><input type="text" maxlength="1" name="y14" id="y14"></td>
                                        <td><input type="text" maxlength="1" name="z14" id="z14"></td>
                                        <td><input type="text" maxlength="1" name="score_gained14" id="score_gained14"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned14" id="score_assigned14"></td>
                                    </tr>

                                    <tr>
                                        <td>15</td>
                                        <td>Academic Honesty</td>
                                        <td><textarea class="form-control" name="comments15" id="comments15"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w15" id="w15"></td>
                                        <td><input type="text" maxlength="1" name="x15" id="x15"></td>
                                        <td><input type="text" maxlength="1" name="y15" id="y15"></td>
                                        <td><input type="text" maxlength="1" name="z15" id="z15"></td>
                                        <td><input type="text" maxlength="1" name="score_gained15" id="score_gained15"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned15" id="score_assigned15"></td>
                                    </tr>
                                    <tfoot>
                                    <tr>
                                        <th colspan="3">Count</th>
                                        <th><span id="count-w02"></span></th>
                                        <th><span id="count-x02"></span></th>
                                        <th><span id="count-y02"></span></th>
                                        <th><span id="count-z02"></span></th>
                                    </tr>

                                    <tr>
                                        <th colspan="3">Score</th>
                                        <th ><span id="total-w02"></span></th>
                                        <th><span id="total-x02"></span></th>
                                        <th><span id="total-y02"></span></th>
                                        <th><span id="total-z02"></span></th>
                                        <th>11.88</th>
                                        <th>15</th>
                                    </tr>

                                    </tfoot>

                                </table>
                            <div class="col-md-12 " style="padding: 20px"><button class="btn btn-primary update" style="float: right;">  update</button></div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>



                <!-- Main content -->
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-title" style="padding: 30px;" align="center">Overall Quality Evaluation</div>

                        <!-- /.box-header -->
                        <div class="box-body">
                                <table class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%">F03</th>
                                        <th style="width: 15%">Students </th>
                                        <th style="width: 40%">Comments</th>
                                        <th style="width: 5%">(W=4)</th>
                                        <th style="width: 5%">(X=3)</th>
                                        <th style="width: 5%">(Y=2)</th>
                                        <th style="width: 5%">(Z=0)</th>
                                        <th style="width: 10%">Scores Gained</th>
                                        <th style="width: 10%">Scores Assigned</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td>16</td>
                                        <td>Student Enrollment</td>
                                        <td><textarea class="form-control" name="comments16" id="comments16"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w16" id="w16"></td>
                                        <td><input type="text" maxlength="1" name="x16" id="x16"></td>
                                        <td><input type="text" maxlength="1" name="y16" id="y16"></td>
                                        <td><input type="text" maxlength="1" name="z16" id="z16"></td>
                                        <td><input type="text" maxlength="1" name="score_gained16" id="score_gained16"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned16" id="score_assigned16"></td>
                                    </tr>

                                    <tr>
                                        <td>17</td>
                                        <td>Average Success Percentage</td>
                                        <td><textarea class="form-control" name="comments17" id="comments17"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w17" id="w17"></td>
                                        <td><input type="text" maxlength="1" name="x17" id="x17"></td>
                                        <td><input type="text" maxlength="1" name="y17" id="y17"></td>
                                        <td><input type="text" maxlength="1" name="z17" id="z17"></td>
                                        <td><input type="text" maxlength="1" name="score_gained17" id="score_gained17"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned17" id="score_assigned17"></td>
                                     </tr>

                                    <tr>
                                        <td>18</td>
                                        <td>Scholarships and Financial aid</td>
                                        <td><textarea class="form-control" name="comments18" id="comments18"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w18" id="w18"></td>
                                        <td><input type="text" maxlength="1" name="x18" id="x18"></td>
                                        <td><input type="text" maxlength="1" name="y18" id="y18"></td>
                                        <td><input type="text" maxlength="1" name="z18" id="z18"></td>
                                        <td><input type="text" maxlength="1" name="score_gained18" id="score_gained18"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned18" id="score_assigned18"></td>
                                    </tr>

                                    <tr>
                                        <td>19</td>
                                        <td>Student Progression and Individual Learning</td>
                                        <td><textarea class="form-control" name="comments19" id="comments19"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w19" id="w19"></td>
                                        <td><input type="text" maxlength="1" name="x19" id="x19"></td>
                                        <td><input type="text" maxlength="1" name="y19" id="y19"></td>
                                        <td><input type="text" maxlength="1" name="z19" id="z19"></td>
                                        <td><input type="text" maxlength="1" name="score_gained19" id="score_gained19"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned19" id="score_assigned19"></td>
                                    </tr>

                                    <tr>
                                        <td>20</td>
                                        <td>Personal Grooming and Interpersonal Skills</td>
                                        <td><textarea class="form-control" name="comments20" id="comments20"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w20" id="w20"></td>
                                        <td><input type="text" maxlength="1" name="x20" id="x20"></td>
                                        <td><input type="text" maxlength="1" name="y20" id="y20"></td>
                                        <td><input type="text" maxlength="1" name="z20" id="z20"></td>
                                        <td><input type="text" maxlength="1" name="score_gained20" id="score_gained20"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned20" id="score_assigned20"></td>
                                    </tr>

                                    <tr>
                                        <td>21</td>
                                        <td>Student Counselling and Guidance</td>
                                        <td><textarea class="form-control" name="comments21" id="comments21"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w21" id="w21"></td>
                                        <td><input type="text" maxlength="1" name="x21" id="x21"></td>
                                        <td><input type="text" maxlength="1" name="y21" id="y21"></td>
                                        <td><input type="text" maxlength="1" name="z21" id="z21"></td>
                                        <td><input type="text" maxlength="1" name="score_gained21" id="score_gained21"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned21" id="score_assigned21"></td>
                                    </tr>

                                    <tr>
                                        <td>22</td>
                                        <td>Extracurricular & Co-curricular Activities</td>
                                        <td><textarea class="form-control" name="comments22" id="comments22"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w22" id="w22"></td>
                                        <td><input type="text" maxlength="1" name="x22" id="x22"></td>
                                        <td><input type="text" maxlength="1" name="y22" id="y22"></td>
                                        <td><input type="text" maxlength="1" name="z22" id="z22"></td>
                                        <td><input type="text" maxlength="1" name="score_gained22" id="score_gained22"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned22" id="score_assigned22"></td>
                                    </tr>

                                    <tr>
                                        <td>23</td>
                                        <td>Alumni Network</td>
                                        <td><textarea class="form-control" name="comments23" id="comments23"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w23" id="w23"></td>
                                        <td><input type="text" maxlength="1" name="x23" id="x23"></td>
                                        <td><input type="text" maxlength="1" name="y23" id="y23"></td>
                                        <td><input type="text" maxlength="1" name="z23" id="z23"></td>
                                        <td><input type="text" maxlength="1" name="score_gained23" id="score_gained23"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned23" id="score_assigned23"></td>
                                    </tr>

                                    <tfoot>
                                    <tr>
                                        <th colspan="3">Count</th>
                                        <th>3</th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>0</th>
                                    </tr>

                                    <tr>
                                        <th colspan="3">Score</th>
                                        <th >12</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>0</th>
                                        <th>11.88</th>
                                        <th>15</th>
                                    </tr>

                                    </tfoot>

                                </table>
                            <div class="col-md-12 " style="padding: 20px"><button class="btn btn-primary update" style="float: right;">  update</button></div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-title" style="padding: 30px;" align="center">Overall Quality Evaluation</div>

                        <!-- /.box-header -->
                        <div class="box-body">
                                <table class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%">F04</th>
                                        <th style="width: 15%">Faculty </th>
                                        <th style="width: 40%">Comments</th>
                                        <th style="width: 5%">(W=4)</th>
                                        <th style="width: 5%">(X=3)</th>
                                        <th style="width: 5%">(Y=2)</th>
                                        <th style="width: 5%">(Z=0)</th>
                                        <th style="width: 10%">Scores Gained</th>
                                        <th style="width: 10%">Scores Assigned</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td>24</td>
                                        <td>Faculty Size and Portfolio</td>
                                        <td><textarea class="form-control" name="comments24" id="comments24"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w24" id="w24"></td>
                                        <td><input type="text" maxlength="1" name="x24" id="x24"></td>
                                        <td><input type="text" maxlength="1" name="y24" id="y24"></td>
                                        <td><input type="text" maxlength="1" name="z24" id="z24"></td>
                                        <td><input type="text" maxlength="1" name="score_gained24" id="score_gained24"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned24" id="score_assigned24"></td>
                                    </tr>

                                    <tr>
                                        <td>25</td>
                                        <td>Faculty Qualifications</td>
                                        <td><textarea class="form-control" name="comments25" id="comments25"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w25" id="w25"></td>
                                        <td><input type="text" maxlength="1" name="x25" id="x25"></td>
                                        <td><input type="text" maxlength="1" name="y25" id="y25"></td>
                                        <td><input type="text" maxlength="1" name="z25" id="z25"></td>
                                        <td><input type="text" maxlength="1" name="score_gained25" id="score_gained25"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned25" id="score_assigned25"></td>
                                     </tr>

                                    <tr>
                                        <td>26</td>
                                        <td>Faculty Planning</td>
                                        <td><textarea class="form-control" name="comments26" id="comments26"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w26" id="w26"></td>
                                        <td><input type="text" maxlength="1" name="x26" id="x26"></td>
                                        <td><input type="text" maxlength="1" name="y26" id="y26"></td>
                                        <td><input type="text" maxlength="1" name="z26" id="z26"></td>
                                        <td><input type="text" maxlength="1" name="score_gained26" id="score_gained26"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned26" id="score_assigned26"></td>
                                    </tr>

                                    <tr>
                                        <td>27</td>
                                        <td>Faculty’s Stability and Turnover</td>
                                        <td><textarea class="form-control" name="comments27" id="comments27"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w27" id="w27"></td>
                                        <td><input type="text" maxlength="1" name="x27" id="w27"></td>
                                        <td><input type="text" maxlength="1" name="y27" id="w27"></td>
                                        <td><input type="text" maxlength="1" name="z27" id="w27"></td>
                                        <td><input type="text" maxlength="1" name="score_gained27" id="score_gained27"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned27" id="score_assigned27"></td>
                                    </tr>

                                    <tr>
                                        <td>28</td>
                                        <td>Faculty to Student Ratios</td>
                                        <td><textarea class="form-control" name="comments28" id="comments28"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w28" id="w28"></td>
                                        <td><input type="text" maxlength="1" name="x28" id="x28"></td>
                                        <td><input type="text" maxlength="1" name="y28" id="y28"></td>
                                        <td><input type="text" maxlength="1" name="z28" id="z28"></td>
                                        <td><input type="text" maxlength="1" name="score_gained28" id="score_gained28"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned28" id="score_assigned28"></td>
                                    </tr>

                                    <tr>
                                        <td>29</td>
                                        <td>Faculty Policies: Recruitment and Selection</td>
                                        <td><textarea class="form-control" name="comments29" id="comments29"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w29" id="w29"></td>
                                        <td><input type="text" maxlength="1" name="x29" id="x29"></td>
                                        <td><input type="text" maxlength="1" name="y29" id="y29"></td>
                                        <td><input type="text" maxlength="1" name="z29" id="z29"></td>
                                        <td><input type="text" maxlength="1" name="score_gained29" id="score_gained29"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned29" id="score_assigned29"></td>
                                    </tr>

                                    <tr>
                                        <td>30</td>
                                        <td>Faculty Promotion, Retention and Development</td>
                                        <td><textarea class="form-control" name="comments30" id="comments30"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w30" id="w30"></td>
                                        <td><input type="text" maxlength="1" name="x30" id="x30"></td>
                                        <td><input type="text" maxlength="1" name="y30" id="y30"></td>
                                        <td><input type="text" maxlength="1" name="z30" id="z30"></td>
                                        <td><input type="text" maxlength="1" name="score_gained30" id="score_gained30"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned30" id="score_assigned30"></td>
                                    </tr>

                                    <tr>
                                        <td>31</td>
                                        <td>Faculty Evaluation and Assessment</td>
                                        <td><textarea class="form-control" name="comments31" id="comments31"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w31" id="w31"></td>
                                        <td><input type="text" maxlength="1" name="x31" id="x31"></td>
                                        <td><input type="text" maxlength="1" name="y31" id="y31"></td>
                                        <td><input type="text" maxlength="1" name="z31" id="z31"></td>
                                        <td><input type="text" maxlength="1" name="score_gained31" id="score_gained31"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned31" id="score_assigned31"></td>
                                    </tr>

                                    <tr>
                                        <td>32</td>
                                        <td>Role of Faculty in Decision Making</td>
                                        <td><textarea class="form-control" name="comments32" id="comments32"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w32" id="w32"></td>
                                        <td><input type="text" maxlength="1" name="x32" id="x32"></td>
                                        <td><input type="text" maxlength="1" name="y32" id="y32"></td>
                                        <td><input type="text" maxlength="1" name="z32" id="z32"></td>
                                        <td><input type="text" maxlength="1" name="score_gained32" id="score_gained32"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned32" id="score_assigned32"></td>
                                    </tr>

                                    <tr>
                                        <td>33</td>
                                        <td>Faculty Consulting and Training Engagements</td>
                                        <td><textarea class="form-control" name="comments33" id="comments33"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w33" id="w33"></td>
                                        <td><input type="text" maxlength="1" name="x33" id="x33"></td>
                                        <td><input type="text" maxlength="1" name="y33" id="y33"></td>
                                        <td><input type="text" maxlength="1" name="z33" id="z33"></td>
                                        <td><input type="text" maxlength="1" name="score_gained33" id="score_gained33"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned33" id="score_assigned33"></td>
                                    </tr>

                                    <tr>
                                        <td>34</td>
                                        <td>Faculty Engagements in the Social and Professional Organizations, and Businesses</td>
                                        <td><textarea class="form-control" name="comments34" id="comments34"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w34" id="w34"></td>
                                        <td><input type="text" maxlength="1" name="x34" id="x34"></td>
                                        <td><input type="text" maxlength="1" name="y34" id="y34"></td>
                                        <td><input type="text" maxlength="1" name="z34" id="z34"></td>
                                        <td><input type="text" maxlength="1" name="score_gained34" id="score_gained34"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned34" id="score_assigned34"></td>
                                    </tr>

                                    <tr>
                                        <td>35</td>
                                        <td>International exposure of the faculty</td>
                                        <td><textarea class="form-control" name="comments35" id="comments35"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w35" id="w35"></td>
                                        <td><input type="text" maxlength="1" name="x35" id="x35"></td>
                                        <td><input type="text" maxlength="1" name="y35" id="y35"></td>
                                        <td><input type="text" maxlength="1" name="z35" id="z35"></td>
                                        <td><input type="text" maxlength="1" name="score_gained35" id="score_gained35"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned35" id="score_assigned35"></td>
                                    </tr>

                                    <tfoot>
                                    <tr>
                                        <th colspan="3">Count</th>
                                        <th>3</th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>0</th>
                                    </tr>

                                    <tr>
                                        <th colspan="3">Score</th>
                                        <th >12</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>0</th>
                                        <th>11.88</th>
                                        <th>15</th>
                                    </tr>

                                    </tfoot>

                                </table>
                            <div class="col-md-12 " style="padding: 20px"><button class="btn btn-primary update" style="float: right;">  update</button></div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-title" style="padding: 30px;" align="center">Overall Quality Evaluation</div>

                        <!-- /.box-header -->
                        <div class="box-body">
                                <table class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%">F05</th>
                                        <th style="width: 15%">Research and Development  </th>
                                        <th style="width: 40%">Comments</th>
                                        <th style="width: 5%">(W=4)</th>
                                        <th style="width: 5%">(X=3)</th>
                                        <th style="width: 5%">(Y=2)</th>
                                        <th style="width: 5%">(Z=0)</th>
                                        <th style="width: 10%">Scores Gained</th>
                                        <th style="width: 10%">Scores Assigned</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td>36</td>
                                        <td>R & D Policy</td>
                                        <td><textarea class="form-control" name="comments36" id="comments36"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w36" id="w36"></td>
                                        <td><input type="text" maxlength="1" name="x36" id="x36"></td>
                                        <td><input type="text" maxlength="1" name="y36" id="y36"></td>
                                        <td><input type="text" maxlength="1" name="z36" id="z36"></td>
                                        <td><input type="text" maxlength="1" name="score_gained36" id="score_gained36"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned36" id="score_assigned36"></td>
                                    </tr>

                                    <tr>
                                        <td>37</td>
                                        <td>Sufficiency of time Devoted to Research</td>
                                        <td><textarea class="form-control" name="comments37" id="comments37"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w37" id="w37"></td>
                                        <td><input type="text" maxlength="1" name="x37" id="x37"></td>
                                        <td><input type="text" maxlength="1" name="y37" id="y37"></td>
                                        <td><input type="text" maxlength="1" name="z37" id="z37"></td>
                                        <td><input type="text" maxlength="1" name="score_gained37" id="score_gained37"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned37" id="score_assigned37"></td>
                                     </tr>

                                    <tr>
                                        <td>38</td>
                                        <td>Adequacy of Funding for Research</td>
                                        <td><textarea class="form-control" name="comments38" id="comments38"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w38" id="w38"></td>
                                        <td><input type="text" maxlength="1" name="x38" id="x38"></td>
                                        <td><input type="text" maxlength="1" name="y38" id="y38"></td>
                                        <td><input type="text" maxlength="1" name="z38" id="z38"></td>
                                        <td><input type="text" maxlength="1" name="score_gained38" id="score_gained38"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned38" id="score_assigned38"></td>
                                    </tr>

                                    <tr>
                                        <td>39</td>
                                        <td>Quality of Research Output</td>
                                        <td><textarea class="form-control" name="comments39" id="comments39"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w39" id="w39"></td>
                                        <td><input type="text" maxlength="1" name="x39" id="w39"></td>
                                        <td><input type="text" maxlength="1" name="y39" id="w39"></td>
                                        <td><input type="text" maxlength="1" name="z39" id="w39"></td>
                                        <td><input type="text" maxlength="1" name="score_gained39" id="score_gained39"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned39" id="score_assigned39"></td>
                                    </tr>

                                    <tr>
                                        <td>40</td>
                                        <td>Distinctive Expertise</td>
                                        <td><textarea class="form-control" name="comments40" id="comments40"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w40" id="w40"></td>
                                        <td><input type="text" maxlength="1" name="x40" id="x40"></td>
                                        <td><input type="text" maxlength="1" name="y40" id="y40"></td>
                                        <td><input type="text" maxlength="1" name="z40" id="z40"></td>
                                        <td><input type="text" maxlength="1" name="score_gained40" id="score_gained40"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned40" id="score_assigned40"></td>
                                    </tr>

                                    <tr>
                                        <td>41</td>
                                        <td>Innovative Development</td>
                                        <td><textarea class="form-control" name="comments41" id="comments41"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w41" id="w41"></td>
                                        <td><input type="text" maxlength="1" name="x41" id="x41"></td>
                                        <td><input type="text" maxlength="1" name="y41" id="y41"></td>
                                        <td><input type="text" maxlength="1" name="z41" id="z41"></td>
                                        <td><input type="text" maxlength="1" name="score_gained41" id="score_gained41"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned41" id="score_assigned41"></td>
                                    </tr>

                                    <tr>
                                        <td>42</td>
                                        <td>Contribution of R & D to Courses & Programs</td>
                                        <td><textarea class="form-control" name="comments42" id="comments42"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w42" id="w42"></td>
                                        <td><input type="text" maxlength="1" name="x42" id="x42"></td>
                                        <td><input type="text" maxlength="1" name="y42" id="y42"></td>
                                        <td><input type="text" maxlength="1" name="z42" id="z42"></td>
                                        <td><input type="text" maxlength="1" name="score_gained42" id="score_gained42"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned42" id="score_assigned42"></td>
                                    </tr>

                                    <tr>
                                        <td>43</td>
                                        <td>Contribution of R & D to Faculty Development </td>
                                        <td><textarea class="form-control" name="comments43" id="comments43"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w43" id="w43"></td>
                                        <td><input type="text" maxlength="1" name="x43" id="x43"></td>
                                        <td><input type="text" maxlength="1" name="y43" id="y43"></td>
                                        <td><input type="text" maxlength="1" name="z43" id="z43"></td>
                                        <td><input type="text" maxlength="1" name="score_gained43" id="score_gained43"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned43" id="score_assigned43"></td>
                                    </tr>


                                    <tfoot>
                                    <tr>
                                        <th colspan="3">Count</th>
                                        <th>3</th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>0</th>
                                    </tr>

                                    <tr>
                                        <th colspan="3">Score</th>
                                        <th >12</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>0</th>
                                        <th>11.88</th>
                                        <th>15</th>
                                    </tr>

                                    </tfoot>

                                </table>
                            <div class="col-md-12 " style="padding: 20px"><button class="btn btn-primary update" style="float: right;">  update</button></div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-title" style="padding: 30px;" align="center">Overall Quality Evaluation</div>

                        <!-- /.box-header -->
                        <div class="box-body">
                                <table class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%">F06</th>
                                        <th style="width: 15%">Social Responsibility </th>
                                        <th style="width: 40%">Comments</th>
                                        <th style="width: 5%">(W=4)</th>
                                        <th style="width: 5%">(X=3)</th>
                                        <th style="width: 5%">(Y=2)</th>
                                        <th style="width: 5%">(Z=0)</th>
                                        <th style="width: 10%">Scores Gained</th>
                                        <th style="width: 10%">Scores Assigned</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td>44</td>
                                        <td>Policy of Community Services and Social Activities</td>
                                        <td><textarea class="form-control" name="comments44" id="comments44"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w44" id="w44"></td>
                                        <td><input type="text" maxlength="1" name="x44" id="x44"></td>
                                        <td><input type="text" maxlength="1" name="y44" id="y44"></td>
                                        <td><input type="text" maxlength="1" name="z44" id="z44"></td>
                                        <td><input type="text" maxlength="1" name="score_gained44" id="score_gained44"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned44" id="score_assigned44"></td>
                                    </tr>

                                    <tr>
                                        <td>45</td>
                                        <td>Formal Relationship with Social Sector Organizations </td>
                                        <td><textarea class="form-control" name="comments45" id="comments45"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w45" id="w45"></td>
                                        <td><input type="text" maxlength="1" name="x45" id="x45"></td>
                                        <td><input type="text" maxlength="1" name="y45" id="y45"></td>
                                        <td><input type="text" maxlength="1" name="z45" id="z45"></td>
                                        <td><input type="text" maxlength="1" name="score_gained45" id="score_gained45"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned45" id="score_assigned45"></td>
                                     </tr>

                                    <tr>
                                        <td>46</td>
                                        <td>Code of Moral Principles, Ethics, Behaviors and Conducts</td>
                                        <td><textarea class="form-control" name="comments46" id="comments46"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w46" id="w46"></td>
                                        <td><input type="text" maxlength="1" name="x46" id="x46"></td>
                                        <td><input type="text" maxlength="1" name="y46" id="y46"></td>
                                        <td><input type="text" maxlength="1" name="z46" id="z46"></td>
                                        <td><input type="text" maxlength="1" name="score_gained46" id="score_gained46"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned46" id="score_assigned46"></td>
                                    </tr>

                                    <tr>
                                        <td>47</td>
                                        <td>Development and Protection of Internal Community</td>
                                        <td><textarea class="form-control" name="comments47" id="comments47"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w47" id="w47"></td>
                                        <td><input type="text" maxlength="1" name="x47" id="w47"></td>
                                        <td><input type="text" maxlength="1" name="y47" id="w47"></td>
                                        <td><input type="text" maxlength="1" name="z47" id="w47"></td>
                                        <td><input type="text" maxlength="1" name="score_gained47" id="score_gained47"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned47" id="score_assigned47"></td>
                                    </tr>

                                    <tr>
                                        <td>48</td>
                                        <td>Impact on the Society</td>
                                        <td><textarea class="form-control" name="comments48" id="comments48"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w48" id="w48"></td>
                                        <td><input type="text" maxlength="1" name="x48" id="x48"></td>
                                        <td><input type="text" maxlength="1" name="y48" id="y48"></td>
                                        <td><input type="text" maxlength="1" name="z48" id="z48"></td>
                                        <td><input type="text" maxlength="1" name="score_gained48" id="score_gained48"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned48" id="score_assigned48"></td>
                                    </tr>



                                    <tfoot>
                                    <tr>
                                        <th colspan="3">Count</th>
                                        <th>3</th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>0</th>
                                    </tr>

                                    <tr>
                                        <th colspan="3">Score</th>
                                        <th >12</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>0</th>
                                        <th>11.88</th>
                                        <th>15</th>
                                    </tr>

                                    </tfoot>

                                </table>
                            <div class="col-md-12 " style="padding: 20px"><button class="btn btn-primary update" style="float: right;">  update</button></div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-title" style="padding: 30px;" align="center">Overall Quality Evaluation</div>

                        <!-- /.box-header -->
                        <div class="box-body">
                                <table class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%">F07</th>
                                        <th style="width: 15%">Resources </th>
                                        <th style="width: 40%">Comments</th>
                                        <th style="width: 5%">(W=4)</th>
                                        <th style="width: 5%">(X=3)</th>
                                        <th style="width: 5%">(Y=2)</th>
                                        <th style="width: 5%">(Z=0)</th>
                                        <th style="width: 10%">Scores Gained</th>
                                        <th style="width: 10%">Scores Assigned</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td>49</td>
                                        <td>Financial Management </td>
                                        <td><textarea class="form-control" name="comments44" id="comments44"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w49" id="w49"></td>
                                        <td><input type="text" maxlength="1" name="x49" id="x49"></td>
                                        <td><input type="text" maxlength="1" name="y49" id="y49"></td>
                                        <td><input type="text" maxlength="1" name="z49" id="z49"></td>
                                        <td><input type="text" maxlength="1" name="score_gained49" id="score_gained49"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned49" id="score_assigned49"></td>
                                    </tr>

                                    <tr>
                                        <td>50</td>
                                        <td>Learning Environment</td>
                                        <td><textarea class="form-control" name="comments45" id="comments45"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w50" id="w50"></td>
                                        <td><input type="text" maxlength="1" name="x50" id="x50"></td>
                                        <td><input type="text" maxlength="1" name="y50" id="y50"></td>
                                        <td><input type="text" maxlength="1" name="z50" id="z50"></td>
                                        <td><input type="text" maxlength="1" name="score_gained50" id="score_gained50"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned50" id="score_assigned50"></td>
                                     </tr>

                                    <tr>
                                        <td>51</td>
                                        <td>Library</td>
                                        <td><textarea class="form-control" name="comments46" id="comments46"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w51" id="w51"></td>
                                        <td><input type="text" maxlength="1" name="x51" id="x51"></td>
                                        <td><input type="text" maxlength="1" name="y51" id="y51"></td>
                                        <td><input type="text" maxlength="1" name="z51" id="z51"></td>
                                        <td><input type="text" maxlength="1" name="score_gained51" id="score_gained51"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned51" id="score_assigned51"></td>
                                    </tr>

                                    <tr>
                                        <td>52</td>
                                        <td>Computing facilities</td>
                                        <td><textarea class="form-control" name="comments47" id="comments47"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w52" id="w52"></td>
                                        <td><input type="text" maxlength="1" name="x52" id="x52"></td>
                                        <td><input type="text" maxlength="1" name="y52" id="y52"></td>
                                        <td><input type="text" maxlength="1" name="z52" id="z52"></td>
                                        <td><input type="text" maxlength="1" name="score_gained52" id="score_gained52"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned52" id="score_assigned52"></td>
                                    </tr>

                                    <tr>
                                        <td>53</td>
                                        <td>Other facilities</td>
                                        <td><textarea class="form-control" name="comments48" id="comments48"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w53" id="w53"></td>
                                        <td><input type="text" maxlength="1" name="x53" id="x53"></td>
                                        <td><input type="text" maxlength="1" name="y53" id="y53"></td>
                                        <td><input type="text" maxlength="1" name="z53" id="z53"></td>
                                        <td><input type="text" maxlength="1" name="score_gained53" id="score_gained53"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned53" id="score_assigned53"></td>
                                    </tr>

                                    <tr>
                                        <td>54</td>
                                        <td>Administrative Support Function</td>
                                        <td><textarea class="form-control" name="comments48" id="comments48"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w54" id="w54"></td>
                                        <td><input type="text" maxlength="1" name="x54" id="x54"></td>
                                        <td><input type="text" maxlength="1" name="y54" id="y54"></td>
                                        <td><input type="text" maxlength="1" name="z54" id="z54"></td>
                                        <td><input type="text" maxlength="1" name="score_gained54" id="score_gained54"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned54" id="score_assigned54"></td>
                                    </tr>

                                    <tr>
                                        <td>55</td>
                                        <td>Quality Enhancement Cell</td>
                                        <td><textarea class="form-control" name="comments48" id="comments48"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w55" id="w55"></td>
                                        <td><input type="text" maxlength="1" name="x55" id="x55"></td>
                                        <td><input type="text" maxlength="1" name="y55" id="y55"></td>
                                        <td><input type="text" maxlength="1" name="z55" id="z55"></td>
                                        <td><input type="text" maxlength="1" name="score_gained55" id="score_gained55"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned55" id="score_assigned55"></td>
                                    </tr>



                                    <tfoot>
{{--                                    <tr>--}}
{{--                                        <th colspan="3">Count</th>--}}
{{--                                        <th><span id="count-w09"></span></th>--}}
{{--                                        <th><span id="count-x09"></span></th>--}}
{{--                                        <th><span id="count-y09"></span></th>--}}
{{--                                        <th><span id="count-z09"></span></th>--}}
{{--                                    </tr>--}}

{{--                                    <tr>--}}
{{--                                        <th colspan="3">Score</th>--}}
{{--                                        <th ><span id="total-w09"></span></th>--}}
{{--                                        <th><span id="total-x09"></span></th>--}}
{{--                                        <th><span id="total-y09"></span></th>--}}
{{--                                        <th><span id="total-z09"></span></th>--}}
{{--                                        <th>11.88</th>--}}
{{--                                        <th>15</th>--}}
{{--                                    </tr>--}}

                                    </tfoot>

                                </table>
                            <div class="col-md-12 " style="padding: 20px"><button class="btn btn-primary update" style="float: right;">  update</button></div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-title" style="padding: 30px;" align="center">Overall Quality Evaluation</div>

                        <!-- /.box-header -->
                        <div class="box-body">
                                <table class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%">F08</th>
                                        <th style="width: 15%">External Linkages and Student Placement  </th>
                                        <th style="width: 40%">Comments</th>
                                        <th style="width: 5%">(W=4)</th>
                                        <th style="width: 5%">(X=3)</th>
                                        <th style="width: 5%">(Y=2)</th>
                                        <th style="width: 5%">(Z=0)</th>
                                        <th style="width: 10%">Scores Gained</th>
                                        <th style="width: 10%">Scores Assigned</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td>56</td>
                                        <td>International Linkages </td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w56" id="w56"></td>
                                        <td><input type="text" maxlength="1" name="x56" id="x56"></td>
                                        <td><input type="text" maxlength="1" name="y56" id="y56"></td>
                                        <td><input type="text" maxlength="1" name="z56" id="z56"></td>
                                        <td><input type="text" maxlength="1" name="score_gained56" id="score_gained56"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned56" id="score_assigned56"></td>
                                    </tr>

                                    <tr>
                                        <td>57</td>
                                        <td>National Academic Linkages</td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w57" id="w57"></td>
                                        <td><input type="text" maxlength="1" name="x57" id="x57"></td>
                                        <td><input type="text" maxlength="1" name="y57" id="y57"></td>
                                        <td><input type="text" maxlength="1" name="z57" id="z57"></td>
                                        <td><input type="text" maxlength="1" name="score_gained57" id="score_gained57"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned57" id="score_assigned57"></td>
                                     </tr>

                                    <tr>
                                        <td>58</td>
                                        <td>Corporate Linkages </td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w58" id="w58"></td>
                                        <td><input type="text" maxlength="1" name="x58" id="x58"></td>
                                        <td><input type="text" maxlength="1" name="y58" id="y58"></td>
                                        <td><input type="text" maxlength="1" name="z58" id="z58"></td>
                                        <td><input type="text" maxlength="1" name="score_gained58" id="score_gained58"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned58" id="score_assigned58"></td>
                                    </tr>

                                    <tr>
                                        <td>59</td>
                                        <td>Corporate Linkages </td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w59" id="w59"></td>
                                        <td><input type="text" maxlength="1" name="x59" id="x59"></td>
                                        <td><input type="text" maxlength="1" name="y59" id="y59"></td>
                                        <td><input type="text" maxlength="1" name="z59" id="z59"></td>
                                        <td><input type="text" maxlength="1" name="score_gained59" id="score_gained59"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned59" id="score_assigned59"></td>
                                    </tr>

                                    <tr>
                                        <td>60</td>
                                        <td>Placement Office: Internships and Placements</td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w60" id="w60"></td>
                                        <td><input type="text" maxlength="1" name="x60" id="x60"></td>
                                        <td><input type="text" maxlength="1" name="y60" id="y60"></td>
                                        <td><input type="text" maxlength="1" name="z60" id="z60"></td>
                                        <td><input type="text" maxlength="1" name="score_gained60" id="score_gained60"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned60" id="score_assigned60"></td>
                                    </tr>

                                    <tr>
                                        <td>61</td>
                                        <td>Placement Office: Corporate Involvement</td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w61" id="w61"></td>
                                        <td><input type="text" maxlength="1" name="x61" id="x61"></td>
                                        <td><input type="text" maxlength="1" name="y61" id="y61"></td>
                                        <td><input type="text" maxlength="1" name="z61" id="z61"></td>
                                        <td><input type="text" maxlength="1" name="score_gained61" id="score_gained61"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned61" id="score_assigned61"></td>
                                    </tr>

                                    <tfoot>
                                    <tr>
                                        <th colspan="3">Count</th>
                                        <th>3</th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>0</th>
                                    </tr>

                                    <tr>
                                        <th colspan="3">Score</th>
                                        <th >12</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>0</th>
                                        <th>11.88</th>
                                        <th>15</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            <div class="col-md-12 " style="padding: 20px"><button class="btn btn-primary update" style="float: right;">  update</button></div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-title" style="padding: 30px;" align="center">Overall Quality Evaluation</div>
                        <!-- /.box-header -->
                        <div class="box-body">
                                <table class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%">F09</th>
                                        <th style="width: 15%">Admissions and Examination Policy </th>
                                        <th style="width: 40%">Comments</th>
                                        <th style="width: 5%">(W=4)</th>
                                        <th style="width: 5%">(X=3)</th>
                                        <th style="width: 5%">(Y=2)</th>
                                        <th style="width: 5%">(Z=0)</th>
                                        <th style="width: 10%">Scores Gained</th>
                                        <th style="width: 10%">Scores Assigned</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td>62</td>
                                        <td>Admissions Office </td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w62" id="w62"></td>
                                        <td><input type="text" maxlength="1" name="x62" id="x62"></td>
                                        <td><input type="text" maxlength="1" name="y62" id="y62"></td>
                                        <td><input type="text" maxlength="1" name="z62" id="z62"></td>
                                        <td><input type="text" maxlength="1" name="score_gained62" id="score_gained62"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned62" id="score_assigned62"></td>
                                    </tr>

                                    <tr>
                                        <td>63</td>
                                        <td>Student Selection Processes</td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w63" id="w63"></td>
                                        <td><input type="text" maxlength="1" name="x63" id="x63"></td>
                                        <td><input type="text" maxlength="1" name="y63" id="y63"></td>
                                        <td><input type="text" maxlength="1" name="z63" id="z63"></td>
                                        <td><input type="text" maxlength="1" name="score_gained63" id="score_gained63"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned63" id="score_assigned63"></td>
                                     </tr>

                                    <tr>
                                        <td>64</td>
                                        <td>Examination Monitoring</td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w64" id="w64"></td>
                                        <td><input type="text" maxlength="1" name="x64" id="x64"></td>
                                        <td><input type="text" maxlength="1" name="y64" id="y64"></td>
                                        <td><input type="text" maxlength="1" name="z64" id="z64"></td>
                                        <td><input type="text" maxlength="1" name="score_gained64" id="score_gained64"></td>
                                        <td><input type="text" maxlength="1" name="score_assigned64" id="score_assigned64"></td>
                                    </tr>

                                    <tr>
                                        <td>65</td>
                                        <td>Examination cell</td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w65" id="w65" ></td>
                                        <td><input type="text" maxlength="1" name="x65" id="x65" ></td>
                                        <td><input type="text" maxlength="1" name="y65" id="y65" ></td>
                                        <td><input type="text" maxlength="1" name="z65" id="z65" ></td>
                                        <td><input type="text" maxlength="1" name="score_gained65" id="score_gained65" ></td>
                                        <td><input type="text" maxlength="1" name="score_assigned65" id="score_assigned65" ></td>
                                    </tr>
                                    <tfoot>
                                    <tr>
                                        <th colspan="3">Count</th>
                                        <th><span id="count-w09"></span></th>
                                        <th><span id="count-x09"></span></th>
                                        <th><span id="count-y09"></span></th>
                                        <th><span id="count-z09"></span></th>
                                    </tr>

                                    <tr>
                                        <th colspan="3">Score</th>
                                        <th ><span id="total-w09"></span></th>
                                        <th><span id="total-x09"></span></th>
                                        <th><span id="total-y09"></span></th>
                                        <th><span id="total-z09"></span></th>
                                        <th>11.88</th>
                                        <th>15</th>
                                    </tr>
                                    </tfoot>

                                </table>
                            <div class="col-md-12 " style="padding: 20px"><input type="submit" class="btn btn-primary update" value="Update" style="float: right;"></div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

            </div>


            </form>
        </section>


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

        ////// 09 starts here/////
        $( "#w62, #w63, #w64, #w65" ).keyup(function() {
            let wcount = 0;
           let val62 = $('#w62').val();
           let val63 = $('#w63').val();
           let val64 = $('#w64').val();
           let val65 = $('#w65').val();

            (val62 == 'w')?wcount++:'';
            (val63 == 'w')?wcount++:'';
            (val64 == 'w')?wcount++:'';
            (val65 == 'w')?wcount++:'';

            $('#count-w09').text(wcount);
            let wtotal = wcount * 4;
            $('#total-w09').text(wtotal);
        });

        $( "#x62, #x63, #x64, #x65" ).keyup(function() {
            let wcount = 0;
           let val62 = $('#x62').val();
           let val63 = $('#x63').val();
           let val64 = $('#x64').val();
           let val65 = $('#x65').val();

            (val62 == 'x')?wcount++:'';
            (val63 == 'x')?wcount++:'';
            (val64 == 'x')?wcount++:'';
            (val65 == 'x')?wcount++:'';

            $('#count-x09').text(wcount);
            let wtotal = wcount * 3;
            $('#total-x09').text(wtotal);
        });

        $( "#y62, #y63, #y64, #y65" ).keyup(function() {
            let wcount = 0;
           let val62 = $('#y62').val();
           let val63 = $('#y63').val();
           let val64 = $('#y64').val();
           let val65 = $('#y65').val();

            (val62 == 'y')?wcount++:'';
            (val63 == 'y')?wcount++:'';
            (val64 == 'y')?wcount++:'';
            (val65 == 'y')?wcount++:'';

            $('#count-y09').text(wcount);
            let wtotal = wcount * 2;
            $('#total-y09').text(wtotal);
        });

        $( "#z62, #z63, #z64, #z65" ).keyup(function() {
            let wcount = 0;
           let val62 = $('#z62').val();
           let val63 = $('#z63').val();
           let val64 = $('#z64').val();
           let val65 = $('#z65').val();

            (val62 == 'z')?wcount++:'';
            (val63 == 'z')?wcount++:'';
            (val64 == 'z')?wcount++:'';
            (val65 == 'z')?wcount++:'';

            $('#count-z09').text(wcount);
            let wtotal = wcount * 0;
            $('#total-z09').text(wtotal);
        });

        ////// 09 Ends here/////

        $( "#w1, #w2, #w3, #w4, #w5, #w6" ).keyup(function() {
            let wcount = 0;
           let val1 = $('#w1').val();
           let val2 = $('#w2').val();
           let val3 = $('#w3').val();
           let val4 = $('#w4').val();
           let val5 = $('#w5').val();
           let val6 = $('#w6').val();

            (val1 == 'w')?wcount++:'';
            (val2 == 'w')?wcount++:'';
            (val3 == 'w')?wcount++:'';
            (val4 == 'w')?wcount++:'';
            (val5 == 'w')?wcount++:'';
            (val6 == 'w')?wcount++:'';

            $('#count-w01').text(wcount);
            let wtotal = wcount * 4;
            $('#total-w01').text(wtotal);
        });

        $( "#x1, #x2, #x3, #x4, #x5, #x6" ).keyup(function() {
            let wcount = 0;
           let val1 = $('#x1').val();
           let val2 = $('#x2').val();
           let val3 = $('#x3').val();
           let val4 = $('#x4').val();
           let val5 = $('#x5').val();
           let val6 = $('#x6').val();

            (val1 == 'x')?wcount++:'';
            (val2 == 'x')?wcount++:'';
            (val3 == 'x')?wcount++:'';
            (val4 == 'x')?wcount++:'';
            (val5 == 'x')?wcount++:'';
            (val6 == 'x')?wcount++:'';

            $('#count-x01').text(wcount);
            let wtotal = wcount * 3;
            $('#total-x01').text(wtotal);
        });

        $( "#y1, #y2, #y3, #y4, #y5, #y6" ).keyup(function() {
            let wcount = 0;
           let val1 = $('#y1').val();
           let val2 = $('#y2').val();
           let val3 = $('#y3').val();
           let val4 = $('#y4').val();
           let val5 = $('#y5').val();
           let val6 = $('#y6').val();

            (val1 == 'y')?wcount++:'';
            (val2 == 'y')?wcount++:'';
            (val3 == 'y')?wcount++:'';
            (val4 == 'y')?wcount++:'';
            (val5 == 'y')?wcount++:'';
            (val6 == 'y')?wcount++:'';

            $('#count-y01').text(wcount);
            let wtotal = wcount * 2;
            $('#total-y01').text(wtotal);
        });

        $( "#z1, #z2, #z3, #z4, #z5, #z6" ).keyup(function() {
            let wcount = 0;
           let val1 = $('#z1').val();
           let val2 = $('#z2').val();
           let val3 = $('#z3').val();
           let val4 = $('#z4').val();
           let val5 = $('#z5').val();
           let val6 = $('#z6').val();

            (val1 == 'z')?wcount++:'';
            (val2 == 'z')?wcount++:'';
            (val3 == 'z')?wcount++:'';
            (val4 == 'z')?wcount++:'';
            (val5 == 'z')?wcount++:'';
            (val6 == 'z')?wcount++:'';

            $('#count-z01').text(wcount);
            let wtotal = wcount * 0;
            $('#total-z01').text(wtotal);
        });
        ///// 01 ends here

        ////// 02 Starts here/////

        $( "#w7, #w8, #w9, #w10, #w11, #w12, #w13, #w14, #w15" ).keyup(function() {
            let wcount = 0;
            let val7 = $('#w7').val();
            let val8 = $('#w8').val();
            let val9 = $('#w9').val();
            let val10 = $('#w10').val();
            let val11 = $('#w11').val();
            let val12 = $('#w12').val();
            let val13 = $('#w13').val();
            let val14 = $('#w14').val();
            let val15 = $('#w15').val();

            (val7 == 'w')?wcount++:'';
            (val8 == 'w')?wcount++:'';
            (val9 == 'w')?wcount++:'';
            (val10 == 'w')?wcount++:'';
            (val11 == 'w')?wcount++:'';
            (val12 == 'w')?wcount++:'';
            (val13 == 'w')?wcount++:'';
            (val14 == 'w')?wcount++:'';
            (val15 == 'w')?wcount++:'';

            $('#count-w02').text(wcount);
            let wtotal = wcount * 4;
            $('#total-w02').text(wtotal);
        });

        $( "#x7, #x8, #x9, #x10, #x11, #x13, #x14, #x15" ).keyup(function() {
            let wcount = 0;
            let val7 = $('#x7').val();
            let val8 = $('#x8').val();
            let val9 = $('#x9').val();
            let val10 = $('#x10').val();
            let val11 = $('#x11').val();
            let val12 = $('#x12').val();
            let val13 = $('#x13').val();
            let val14 = $('#x14').val();
            let val15 = $('#x15').val();

            (val7 == 'x')?wcount++:'';
            (val8 == 'x')?wcount++:'';
            (val9 == 'x')?wcount++:'';
            (val10 == 'x')?wcount++:'';
            (val11 == 'x')?wcount++:'';
            (val12 == 'x')?wcount++:'';
            (val13 == 'x')?wcount++:'';
            (val14 == 'x')?wcount++:'';
            (val15 == 'x')?wcount++:'';

            $('#count-x02').text(wcount);
            let wtotal = wcount * 3;
            $('#total-x02').text(wtotal);
        });

        $( "#y7, #y8, #y9, #y10, #y11, #y13, #y14, #y15" ).keyup(function() {
            let wcount = 0;
            let val7 = $('#y7').val();
            let val8 = $('#y8').val();
            let val9 = $('#y9').val();
            let val10 = $('#y10').val();
            let val11 = $('#y11').val();
            let val12 = $('#y12').val();
            let val13 = $('#y13').val();
            let val14 = $('#y14').val();
            let val15 = $('#y15').val();

            (val7 == 'y')?wcount++:'';
            (val8 == 'y')?wcount++:'';
            (val9 == 'y')?wcount++:'';
            (val10 == 'y')?wcount++:'';
            (val11 == 'y')?wcount++:'';
            (val12 == 'y')?wcount++:'';
            (val13 == 'y')?wcount++:'';
            (val14 == 'y')?wcount++:'';
            (val15 == 'y')?wcount++:'';

            $('#count-y02').text(wcount);
            let wtotal = wcount * 2;
            $('#total-y02').text(wtotal);
        });

        $( "#z7, #z8, #z9, #z10, #z11, #z13, #z14, #z15" ).keyup(function() {
            let wcount = 0;
            let val7 = $('#z7').val();
            let val8 = $('#z8').val();
            let val9 = $('#z9').val();
            let val10 = $('#z10').val();
            let val11 = $('#z11').val();
            let val12 = $('#z12').val();
            let val13 = $('#z13').val();
            let val14 = $('#z14').val();
            let val15 = $('#z15').val();

            (val7 == 'z')?wcount++:'';
            (val8 == 'z')?wcount++:'';
            (val9 == 'z')?wcount++:'';
            (val10 == 'z')?wcount++:'';
            (val11 == 'z')?wcount++:'';
            (val12 == 'z')?wcount++:'';
            (val13 == 'z')?wcount++:'';
            (val14 == 'z')?wcount++:'';
            (val15 == 'z')?wcount++:'';

            $('#count-z02').text(wcount);
            let wtotal = wcount * 0;
            $('#total-z02').text(wtotal);
        });

        $('#profileSheet').submit( function (e){
            e.preventDefault();
            let formData = new FormData(this)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //var formData = $("#updateForm").serialize()
            // formData.append('_method', 'PUT')
                 $.ajax({
                     url:'{{url("add_profile_sheet")}}',
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
                         console.log('response', response);
                         // location.reload();
                     },
                     error:function(response, exception){
                         Notiflix.Loading.Remove();
                         $.each(response.responseJSON, function (index, val) {
                             Notiflix.Notify.Failure(val);
                         })
                     }
                 });
             });


    </script>

@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
