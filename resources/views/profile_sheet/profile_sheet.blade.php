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
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>2</td>
                                        <td>Financial Support</td>
                                        <td><textarea class="form-control" name="comments2" id="comments2"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w2" id="w2"></td>
                                        <td><input type="text" maxlength="1" name="x2" id="x2"></td>
                                        <td><input type="text" maxlength="1" name="y2" id="y2"></td>
                                        <td><input type="text" maxlength="1" name="z2" id="z2"></td>
                                        <td></td>
                                        <td></td>
                                     </tr>

                                    <tr>
                                        <td>3</td>
                                        <td>External Participation in Academic Governance</td>
                                        <td><textarea class="form-control" name="comments3" id="comments3"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w3" id="w3"></td>
                                        <td><input type="text" maxlength="1" name="x3" id="x3"></td>
                                        <td><input type="text" maxlength="1" name="y3" id="y3"></td>
                                        <td><input type="text" maxlength="1" name="z3" id="z3"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>4</td>
                                        <td>Internal Governance</td>
                                        <td><textarea class="form-control" name="comments4" id="comments4"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w4" id="w4"></td>
                                        <td><input type="text" maxlength="1" name="x4" id="x4"></td>
                                        <td><input type="text" maxlength="1" name="y4" id="y4"></td>
                                        <td><input type="text" maxlength="1" name="z4" id="z4"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>5</td>
                                        <td>Sense of Vision and Mission</td>
                                        <td><textarea class="form-control" name="comments5" id="comments5"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w5" id="w5"></td>
                                        <td><input type="text" maxlength="1" name="x5" id="x5"></td>
                                        <td><input type="text" maxlength="1" name="y5" id="y5"></td>
                                        <td><input type="text" maxlength="1" name="z5" id="z5"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>6</td>
                                        <td>Credibility of Strategic Planning and Positioning</td>
                                        <td><textarea class="form-control" name="comments6" id="comments6"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w6" id="w6"></td>
                                        <td><input type="text" maxlength="1" name="x6" id="x6"></td>
                                        <td><input type="text" maxlength="1" name="y6" id="y6"></td>
                                        <td><input type="text" maxlength="1" name="z6" id="z6"></td>
                                        <td></td>
                                        <td></td>
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
                                        <th><span id="total_score01"></span></th>
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
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>8</td>
                                        <td>Program Design</td>
                                        <td><textarea class="form-control" name="comments8" id="comments8"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w8" id="w8"></td>
                                        <td><input type="text" maxlength="1" name="x8" id="x8"></td>
                                        <td><input type="text" maxlength="1" name="y8" id="y8"></td>
                                        <td><input type="text" maxlength="1" name="z8" id="z8"></td>
                                        <td></td>
                                        <td></td>
                                     </tr>

                                    <tr>
                                        <td>9</td>
                                        <td>Program Content and Coverage</td>
                                        <td><textarea class="form-control" name="comments9" id="comments9"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w9" id="w9"></td>
                                        <td><input type="text" maxlength="1" name="x9" id="x9"></td>
                                        <td><input type="text" maxlength="1" name="y9" id="y9"></td>
                                        <td><input type="text" maxlength="1" name="z9" id="z9"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>10</td>
                                        <td>Responsiveness to Corporate Needs</td>
                                        <td><textarea class="form-control" name="comments10" id="comments10"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w10" id="w10"></td>
                                        <td><input type="text" maxlength="1" name="x10" id="x10"></td>
                                        <td><input type="text" maxlength="1" name="y10" id="y10"></td>
                                        <td><input type="text" maxlength="1" name="z10" id="z10"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>11</td>
                                        <td>Indigenous and Comparative Material in Course Content</td>
                                        <td><textarea class="form-control" name="comments11" id="comments11"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w11" id="w11"></td>
                                        <td><input type="text" maxlength="1" name="x11" id="x11"></td>
                                        <td><input type="text" maxlength="1" name="y11" id="y11"></td>
                                        <td><input type="text" maxlength="1" name="z11" id="z11"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>12</td>
                                        <td>Soft Skills Provision</td>
                                        <td><textarea class="form-control" name="comments12" id="comments12"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w12" id="w12"></td>
                                        <td><input type="text" maxlength="1" name="x12" id="x12"></td>
                                        <td><input type="text" maxlength="1" name="y12" id="y12"></td>
                                        <td><input type="text" maxlength="1" name="z12" id="z12"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>13</td>
                                        <td>Program Delivery</td>
                                        <td><textarea class="form-control" name="comments13" id="comments13"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w13" id="w13"></td>
                                        <td><input type="text" maxlength="1" name="x13" id="x13"></td>
                                        <td><input type="text" maxlength="1" name="y13" id="y13"></td>
                                        <td><input type="text" maxlength="1" name="z13" id="z13"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>14</td>
                                        <td>Examination and Assessment</td>
                                        <td><textarea class="form-control" name="comments14" id="comments14"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w14" id="w14"></td>
                                        <td><input type="text" maxlength="1" name="x14" id="x14"></td>
                                        <td><input type="text" maxlength="1" name="y14" id="y14"></td>
                                        <td><input type="text" maxlength="1" name="z14" id="z14"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>15</td>
                                        <td>Academic Honesty</td>
                                        <td><textarea class="form-control" name="comments15" id="comments15"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w15" id="w15"></td>
                                        <td><input type="text" maxlength="1" name="x15" id="x15"></td>
                                        <td><input type="text" maxlength="1" name="y15" id="y15"></td>
                                        <td><input type="text" maxlength="1" name="z15" id="z15"></td>
                                        <td></td>
                                        <td></td>
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
                                        <th><span id="total_score02"></span></th>
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
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>17</td>
                                        <td>Average Success Percentage</td>
                                        <td><textarea class="form-control" name="comments17" id="comments17"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w17" id="w17"></td>
                                        <td><input type="text" maxlength="1" name="x17" id="x17"></td>
                                        <td><input type="text" maxlength="1" name="y17" id="y17"></td>
                                        <td><input type="text" maxlength="1" name="z17" id="z17"></td>
                                        <td></td>
                                        <td></td>
                                     </tr>

                                    <tr>
                                        <td>18</td>
                                        <td>Scholarships and Financial aid</td>
                                        <td><textarea class="form-control" name="comments18" id="comments18"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w18" id="w18"></td>
                                        <td><input type="text" maxlength="1" name="x18" id="x18"></td>
                                        <td><input type="text" maxlength="1" name="y18" id="y18"></td>
                                        <td><input type="text" maxlength="1" name="z18" id="z18"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>19</td>
                                        <td>Student Progression and Individual Learning</td>
                                        <td><textarea class="form-control" name="comments19" id="comments19"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w19" id="w19"></td>
                                        <td><input type="text" maxlength="1" name="x19" id="x19"></td>
                                        <td><input type="text" maxlength="1" name="y19" id="y19"></td>
                                        <td><input type="text" maxlength="1" name="z19" id="z19"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>20</td>
                                        <td>Personal Grooming and Interpersonal Skills</td>
                                        <td><textarea class="form-control" name="comments20" id="comments20"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w20" id="w20"></td>
                                        <td><input type="text" maxlength="1" name="x20" id="x20"></td>
                                        <td><input type="text" maxlength="1" name="y20" id="y20"></td>
                                        <td><input type="text" maxlength="1" name="z20" id="z20"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>21</td>
                                        <td>Student Counselling and Guidance</td>
                                        <td><textarea class="form-control" name="comments21" id="comments21"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w21" id="w21"></td>
                                        <td><input type="text" maxlength="1" name="x21" id="x21"></td>
                                        <td><input type="text" maxlength="1" name="y21" id="y21"></td>
                                        <td><input type="text" maxlength="1" name="z21" id="z21"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>22</td>
                                        <td>Extracurricular & Co-curricular Activities</td>
                                        <td><textarea class="form-control" name="comments22" id="comments22"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w22" id="w22"></td>
                                        <td><input type="text" maxlength="1" name="x22" id="x22"></td>
                                        <td><input type="text" maxlength="1" name="y22" id="y22"></td>
                                        <td><input type="text" maxlength="1" name="z22" id="z22"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>23</td>
                                        <td>Alumni Network</td>
                                        <td><textarea class="form-control" name="comments23" id="comments23"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w23" id="w23"></td>
                                        <td><input type="text" maxlength="1" name="x23" id="x23"></td>
                                        <td><input type="text" maxlength="1" name="y23" id="y23"></td>
                                        <td><input type="text" maxlength="1" name="z23" id="z23"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tfoot>
                                    <tr>
                                        <th colspan="3">Count</th>
                                        <th><span id="count-w03"></span></th>
                                        <th><span id="count-x03"></span></th>
                                        <th><span id="count-y03"></span></th>
                                        <th><span id="count-z03"></span></th>
                                    </tr>

                                    <tr>
                                        <th colspan="3">Score</th>
                                        <th ><span id="total-w03"></span></th>
                                        <th><span id="total-x03"></span></th>
                                        <th><span id="total-y03"></span></th>
                                        <th><span id="total-z03"></span></th>
                                        <th><span id="total_score03"></span></th>
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
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>25</td>
                                        <td>Faculty Qualifications</td>
                                        <td><textarea class="form-control" name="comments25" id="comments25"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w25" id="w25"></td>
                                        <td><input type="text" maxlength="1" name="x25" id="x25"></td>
                                        <td><input type="text" maxlength="1" name="y25" id="y25"></td>
                                        <td><input type="text" maxlength="1" name="z25" id="z25"></td>
                                        <td></td>
                                        <td></td>
                                     </tr>

                                    <tr>
                                        <td>26</td>
                                        <td>Faculty Planning</td>
                                        <td><textarea class="form-control" name="comments26" id="comments26"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w26" id="w26"></td>
                                        <td><input type="text" maxlength="1" name="x26" id="x26"></td>
                                        <td><input type="text" maxlength="1" name="y26" id="y26"></td>
                                        <td><input type="text" maxlength="1" name="z26" id="z26"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>27</td>
                                        <td>Faculty’s Stability and Turnover</td>
                                        <td><textarea class="form-control" name="comments27" id="comments27"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w27" id="w27"></td>
                                        <td><input type="text" maxlength="1" name="x27" id="x27"></td>
                                        <td><input type="text" maxlength="1" name="y27" id="y27"></td>
                                        <td><input type="text" maxlength="1" name="z27" id="z27"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>28</td>
                                        <td>Faculty to Student Ratios</td>
                                        <td><textarea class="form-control" name="comments28" id="comments28"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w28" id="w28"></td>
                                        <td><input type="text" maxlength="1" name="x28" id="x28"></td>
                                        <td><input type="text" maxlength="1" name="y28" id="y28"></td>
                                        <td><input type="text" maxlength="1" name="z28" id="z28"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>29</td>
                                        <td>Faculty Policies: Recruitment and Selection</td>
                                        <td><textarea class="form-control" name="comments29" id="comments29"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w29" id="w29"></td>
                                        <td><input type="text" maxlength="1" name="x29" id="x29"></td>
                                        <td><input type="text" maxlength="1" name="y29" id="y29"></td>
                                        <td><input type="text" maxlength="1" name="z29" id="z29"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>30</td>
                                        <td>Faculty Promotion, Retention and Development</td>
                                        <td><textarea class="form-control" name="comments30" id="comments30"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w30" id="w30"></td>
                                        <td><input type="text" maxlength="1" name="x30" id="x30"></td>
                                        <td><input type="text" maxlength="1" name="y30" id="y30"></td>
                                        <td><input type="text" maxlength="1" name="z30" id="z30"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>31</td>
                                        <td>Faculty Evaluation and Assessment</td>
                                        <td><textarea class="form-control" name="comments31" id="comments31"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w31" id="w31"></td>
                                        <td><input type="text" maxlength="1" name="x31" id="x31"></td>
                                        <td><input type="text" maxlength="1" name="y31" id="y31"></td>
                                        <td><input type="text" maxlength="1" name="z31" id="z31"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>32</td>
                                        <td>Role of Faculty in Decision Making</td>
                                        <td><textarea class="form-control" name="comments32" id="comments32"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w32" id="w32"></td>
                                        <td><input type="text" maxlength="1" name="x32" id="x32"></td>
                                        <td><input type="text" maxlength="1" name="y32" id="y32"></td>
                                        <td><input type="text" maxlength="1" name="z32" id="z32"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>33</td>
                                        <td>Faculty Consulting and Training Engagements</td>
                                        <td><textarea class="form-control" name="comments33" id="comments33"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w33" id="w33"></td>
                                        <td><input type="text" maxlength="1" name="x33" id="x33"></td>
                                        <td><input type="text" maxlength="1" name="y33" id="y33"></td>
                                        <td><input type="text" maxlength="1" name="z33" id="z33"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>34</td>
                                        <td>Faculty Engagements in the Social and Professional Organizations, and Businesses</td>
                                        <td><textarea class="form-control" name="comments34" id="comments34"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w34" id="w34"></td>
                                        <td><input type="text" maxlength="1" name="x34" id="x34"></td>
                                        <td><input type="text" maxlength="1" name="y34" id="y34"></td>
                                        <td><input type="text" maxlength="1" name="z34" id="z34"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>35</td>
                                        <td>International exposure of the faculty</td>
                                        <td><textarea class="form-control" name="comments35" id="comments35"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w35" id="w35"></td>
                                        <td><input type="text" maxlength="1" name="x35" id="x35"></td>
                                        <td><input type="text" maxlength="1" name="y35" id="y35"></td>
                                        <td><input type="text" maxlength="1" name="z35" id="z35"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tfoot>
                                    <tr>
                                        <th colspan="3">Count</th>
                                        <th><span id="count-w04"></span></th>
                                        <th><span id="count-x04"></span></th>
                                        <th><span id="count-y04"></span></th>
                                        <th><span id="count-z04"></span></th>
                                    </tr>

                                    <tr>
                                        <th colspan="3">Score</th>
                                        <th ><span id="total-w04"></span></th>
                                        <th><span id="total-x04"></span></th>
                                        <th><span id="total-y04"></span></th>
                                        <th><span id="total-z04"></span></th>
                                        <th><span id="total_score04"></span></th>
                                        <th>20</th>
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
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>37</td>
                                        <td>Sufficiency of time Devoted to Research</td>
                                        <td><textarea class="form-control" name="comments37" id="comments37"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w37" id="w37"></td>
                                        <td><input type="text" maxlength="1" name="x37" id="x37"></td>
                                        <td><input type="text" maxlength="1" name="y37" id="y37"></td>
                                        <td><input type="text" maxlength="1" name="z37" id="z37"></td>
                                        <td></td>
                                        <td></td>
                                     </tr>

                                    <tr>
                                        <td>38</td>
                                        <td>Adequacy of Funding for Research</td>
                                        <td><textarea class="form-control" name="comments38" id="comments38"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w38" id="w38"></td>
                                        <td><input type="text" maxlength="1" name="x38" id="x38"></td>
                                        <td><input type="text" maxlength="1" name="y38" id="y38"></td>
                                        <td><input type="text" maxlength="1" name="z38" id="z38"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>39</td>
                                        <td>Quality of Research Output</td>
                                        <td><textarea class="form-control" name="comments39" id="comments39"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w39" id="w39"></td>
                                        <td><input type="text" maxlength="1" name="x39" id="x39"></td>
                                        <td><input type="text" maxlength="1" name="y39" id="y39"></td>
                                        <td><input type="text" maxlength="1" name="z39" id="z39"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>40</td>
                                        <td>Distinctive Expertise</td>
                                        <td><textarea class="form-control" name="comments40" id="comments40"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w40" id="w40"></td>
                                        <td><input type="text" maxlength="1" name="x40" id="x40"></td>
                                        <td><input type="text" maxlength="1" name="y40" id="y40"></td>
                                        <td><input type="text" maxlength="1" name="z40" id="z40"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>41</td>
                                        <td>Innovative Development</td>
                                        <td><textarea class="form-control" name="comments41" id="comments41"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w41" id="w41"></td>
                                        <td><input type="text" maxlength="1" name="x41" id="x41"></td>
                                        <td><input type="text" maxlength="1" name="y41" id="y41"></td>
                                        <td><input type="text" maxlength="1" name="z41" id="z41"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>42</td>
                                        <td>Contribution of R & D to Courses & Programs</td>
                                        <td><textarea class="form-control" name="comments42" id="comments42"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w42" id="w42"></td>
                                        <td><input type="text" maxlength="1" name="x42" id="x42"></td>
                                        <td><input type="text" maxlength="1" name="y42" id="y42"></td>
                                        <td><input type="text" maxlength="1" name="z42" id="z42"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>43</td>
                                        <td>Contribution of R & D to Faculty Development </td>
                                        <td><textarea class="form-control" name="comments43" id="comments43"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w43" id="w43"></td>
                                        <td><input type="text" maxlength="1" name="x43" id="x43"></td>
                                        <td><input type="text" maxlength="1" name="y43" id="y43"></td>
                                        <td><input type="text" maxlength="1" name="z43" id="z43"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>


                                    <tfoot>
                                    <tr>
                                        <th colspan="3">Count</th>
                                        <th><span id="count-w05"></span></th>
                                        <th><span id="count-x05"></span></th>
                                        <th><span id="count-y05"></span></th>
                                        <th><span id="count-z05"></span></th>
                                    </tr>

                                    <tr>
                                        <th colspan="3">Score</th>
                                        <th ><span id="total-w05"></span></th>
                                        <th><span id="total-x05"></span></th>
                                        <th><span id="total-y05"></span></th>
                                        <th><span id="total-z05"></span></th>
                                        <th><span id="total_score05"></span></th>
                                        <th>10</th>
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
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>45</td>
                                        <td>Formal Relationship with Social Sector Organizations </td>
                                        <td><textarea class="form-control" name="comments45" id="comments45"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w45" id="w45"></td>
                                        <td><input type="text" maxlength="1" name="x45" id="x45"></td>
                                        <td><input type="text" maxlength="1" name="y45" id="y45"></td>
                                        <td><input type="text" maxlength="1" name="z45" id="z45"></td>
                                        <td></td>
                                        <td></td>
                                     </tr>

                                    <tr>
                                        <td>46</td>
                                        <td>Code of Moral Principles, Ethics, Behaviors and Conducts</td>
                                        <td><textarea class="form-control" name="comments46" id="comments46"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w46" id="w46"></td>
                                        <td><input type="text" maxlength="1" name="x46" id="x46"></td>
                                        <td><input type="text" maxlength="1" name="y46" id="y46"></td>
                                        <td><input type="text" maxlength="1" name="z46" id="z46"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>47</td>
                                        <td>Development and Protection of Internal Community</td>
                                        <td><textarea class="form-control" name="comments47" id="comments47"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w47" id="w47"></td>
                                        <td><input type="text" maxlength="1" name="x47" id="x47"></td>
                                        <td><input type="text" maxlength="1" name="y47" id="y47"></td>
                                        <td><input type="text" maxlength="1" name="z47" id="z47"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>48</td>
                                        <td>Impact on the Society</td>
                                        <td><textarea class="form-control" name="comments48" id="comments48"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w48" id="w48"></td>
                                        <td><input type="text" maxlength="1" name="x48" id="x48"></td>
                                        <td><input type="text" maxlength="1" name="y48" id="y48"></td>
                                        <td><input type="text" maxlength="1" name="z48" id="z48"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>



                                    <tfoot>
                                    <tr>
                                        <th colspan="3">Count</th>
                                        <th><span id="count-w06"></span></th>
                                        <th><span id="count-x06"></span></th>
                                        <th><span id="count-y06"></span></th>
                                        <th><span id="count-z06"></span></th>
                                    </tr>

                                    <tr>
                                        <th colspan="3">Score</th>
                                        <th ><span id="total-w06"></span></th>
                                        <th><span id="total-x06"></span></th>
                                        <th><span id="total-y06"></span></th>
                                        <th><span id="total-z06"></span></th>
                                        <th><span id="total_score06"></span></th>
                                        <th>5</th>
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
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>50</td>
                                        <td>Learning Environment</td>
                                        <td><textarea class="form-control" name="comments45" id="comments45"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w50" id="w50"></td>
                                        <td><input type="text" maxlength="1" name="x50" id="x50"></td>
                                        <td><input type="text" maxlength="1" name="y50" id="y50"></td>
                                        <td><input type="text" maxlength="1" name="z50" id="z50"></td>
                                        <td></td>
                                        <td></td>
                                     </tr>

                                    <tr>
                                        <td>51</td>
                                        <td>Library</td>
                                        <td><textarea class="form-control" name="comments46" id="comments46"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w51" id="w51"></td>
                                        <td><input type="text" maxlength="1" name="x51" id="x51"></td>
                                        <td><input type="text" maxlength="1" name="y51" id="y51"></td>
                                        <td><input type="text" maxlength="1" name="z51" id="z51"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>52</td>
                                        <td>Computing facilities</td>
                                        <td><textarea class="form-control" name="comments47" id="comments47"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w52" id="w52"></td>
                                        <td><input type="text" maxlength="1" name="x52" id="x52"></td>
                                        <td><input type="text" maxlength="1" name="y52" id="y52"></td>
                                        <td><input type="text" maxlength="1" name="z52" id="z52"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>53</td>
                                        <td>Other facilities</td>
                                        <td><textarea class="form-control" name="comments48" id="comments48"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w53" id="w53"></td>
                                        <td><input type="text" maxlength="1" name="x53" id="x53"></td>
                                        <td><input type="text" maxlength="1" name="y53" id="y53"></td>
                                        <td><input type="text" maxlength="1" name="z53" id="z53"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>54</td>
                                        <td>Administrative Support Function</td>
                                        <td><textarea class="form-control" name="comments48" id="comments48"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w54" id="w54"></td>
                                        <td><input type="text" maxlength="1" name="x54" id="x54"></td>
                                        <td><input type="text" maxlength="1" name="y54" id="y54"></td>
                                        <td><input type="text" maxlength="1" name="z54" id="z54"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>55</td>
                                        <td>Quality Enhancement Cell</td>
                                        <td><textarea class="form-control" name="comments48" id="comments48"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w55" id="w55"></td>
                                        <td><input type="text" maxlength="1" name="x55" id="x55"></td>
                                        <td><input type="text" maxlength="1" name="y55" id="y55"></td>
                                        <td><input type="text" maxlength="1" name="z55" id="z55"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>



                                    <tfoot>
                                    <tr>
                                        <th colspan="3">Count</th>
                                        <th><span id="count-w07"></span></th>
                                        <th><span id="count-x07"></span></th>
                                        <th><span id="count-y07"></span></th>
                                        <th><span id="count-z07"></span></th>
                                    </tr>

                                    <tr>
                                        <th colspan="3">Score</th>
                                        <th ><span id="total-w07"></span></th>
                                        <th><span id="total-x07"></span></th>
                                        <th><span id="total-y07"></span></th>
                                        <th><span id="total-z07"></span></th>
                                        <th><span id="total_score07"></span></th>
                                        <th>10</th>
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
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>57</td>
                                        <td>National Academic Linkages</td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w57" id="w57"></td>
                                        <td><input type="text" maxlength="1" name="x57" id="x57"></td>
                                        <td><input type="text" maxlength="1" name="y57" id="y57"></td>
                                        <td><input type="text" maxlength="1" name="z57" id="z57"></td>
                                        <td></td>
                                        <td></td>
                                     </tr>

                                    <tr>
                                        <td>58</td>
                                        <td>Corporate Linkages </td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w58" id="w58"></td>
                                        <td><input type="text" maxlength="1" name="x58" id="x58"></td>
                                        <td><input type="text" maxlength="1" name="y58" id="y58"></td>
                                        <td><input type="text" maxlength="1" name="z58" id="z58"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>59</td>
                                        <td>Corporate Linkages </td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w59" id="w59"></td>
                                        <td><input type="text" maxlength="1" name="x59" id="x59"></td>
                                        <td><input type="text" maxlength="1" name="y59" id="y59"></td>
                                        <td><input type="text" maxlength="1" name="z59" id="z59"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>60</td>
                                        <td>Placement Office: Internships and Placements</td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w60" id="w60"></td>
                                        <td><input type="text" maxlength="1" name="x60" id="x60"></td>
                                        <td><input type="text" maxlength="1" name="y60" id="y60"></td>
                                        <td><input type="text" maxlength="1" name="z60" id="z60"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>61</td>
                                        <td>Placement Office: Corporate Involvement</td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w61" id="w61"></td>
                                        <td><input type="text" maxlength="1" name="x61" id="x61"></td>
                                        <td><input type="text" maxlength="1" name="y61" id="y61"></td>
                                        <td><input type="text" maxlength="1" name="z61" id="z61"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tfoot>
                                    <tr>
                                        <th colspan="3">Count</th>
                                        <th><span id="count-w08"></span></th>
                                        <th><span id="count-x08"></span></th>
                                        <th><span id="count-y08"></span></th>
                                        <th><span id="count-z08"></span></th>
                                    </tr>

                                    <tr>
                                        <th colspan="3">Score</th>
                                        <th ><span id="total-w08"></span></th>
                                        <th><span id="total-x08"></span></th>
                                        <th><span id="total-y08"></span></th>
                                        <th><span id="total-z08"></span></th>
                                        <th><span id="total_score08"></span></th>
                                        <th>5</th>
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
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>63</td>
                                        <td>Student Selection Processes</td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w63" id="w63"></td>
                                        <td><input type="text" maxlength="1" name="x63" id="x63"></td>
                                        <td><input type="text" maxlength="1" name="y63" id="y63"></td>
                                        <td><input type="text" maxlength="1" name="z63" id="z63"></td>
                                        <td></td>
                                        <td></td>
                                     </tr>

                                    <tr>
                                        <td>64</td>
                                        <td>Examination Monitoring</td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w64" id="w64"></td>
                                        <td><input type="text" maxlength="1" name="x64" id="x64"></td>
                                        <td><input type="text" maxlength="1" name="y64" id="y64"></td>
                                        <td><input type="text" maxlength="1" name="z64" id="z64"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>65</td>
                                        <td>Examination cell</td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="text" maxlength="1" name="w65" id="w65" ></td>
                                        <td><input type="text" maxlength="1" name="x65" id="x65" ></td>
                                        <td><input type="text" maxlength="1" name="y65" id="y65" ></td>
                                        <td><input type="text" maxlength="1" name="z65" id="z65" ></td>
                                        <td></td>
                                        <td></td>
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
                                        <th><span id="total_score09"></span></th>
                                        <th>5</th>
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

        function calculate01() {
            let val1 = $('#w1').val();
            let val2 = $('#w2').val();
            let val3 = $('#w3').val();
            let val4 = $('#w4').val();
            let val5 = $('#w5').val();
            let val6 = $('#w6').val();

            let valx1 = $('#x1').val();
            let valx2 = $('#x2').val();
            let valx3 = $('#x3').val();
            let valx4 = $('#x4').val();
            let valx5 = $('#x5').val();
            let valx6 = $('#x6').val();

            let valy1 = $('#y1').val();
            let valy2 = $('#y2').val();
            let valy3 = $('#y3').val();
            let valy4 = $('#y4').val();
            let valy5 = $('#y5').val();
            let valy6 = $('#y6').val();

            let valz1 = $('#z1').val();
            let valz2 = $('#z2').val();
            let valz3 = $('#z3').val();
            let valz4 = $('#z4').val();
            let valz5 = $('#z5').val();
            let valz6 = $('#z6').val();

            let wcount=0;
            let xcount=0;
            let ycount=0;
            let zcount=0;

            (val1 == 'w')?wcount++:'';
            (val2 == 'w')?wcount++:'';
            (val3 == 'w')?wcount++:'';
            (val4 == 'w')?wcount++:'';
            (val5 == 'w')?wcount++:'';
            (val6 == 'w')?wcount++:'';

             let wtotal = wcount * 4;
            $('#count-w01').text(wcount);
            $('#total-w01').text(wtotal);


            (valx1 == 'x')?xcount++:'';
            (valx2 == 'x')?xcount++:'';
            (valx3 == 'x')?xcount++:'';
            (valx4 == 'x')?xcount++:'';
            (valx5 == 'x')?xcount++:'';
            (valx6 == 'x')?xcount++:'';

            $('#count-x01').text(xcount);
            let xtotal = xcount * 3;
            $('#total-x01').text(xtotal);


            (valy1 == 'y')?ycount++:'';
            (valy2 == 'y')?ycount++:'';
            (valy3 == 'y')?ycount++:'';
            (valy4 == 'y')?ycount++:'';
            (valy5 == 'y')?ycount++:'';
            (valy6 == 'y')?ycount++:'';
            $('#count-y01').text(ycount);
            let ytotal = ycount * 2;
            $('#total-y01').text(ytotal);

            (valz1 == 'z')?zcount++:'';
            (valz2 == 'z')?zcount++:'';
            (valz3 == 'z')?zcount++:'';
            (valz4 == 'z')?zcount++:'';
            (valz5 == 'z')?zcount++:'';
            (valz6 == 'z')?zcount++:'';
            $('#count-z01').text(zcount);
            let ztotal = zcount * 0;
            $('#total-z01').text(ztotal);

            let score_gained =(((wtotal+xtotal+ytotal+ztotal)/24)*15).toFixed(2);

            $('#total_score01').text(score_gained);

        }

        function calculate02(){
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

            let xcount = 0;
            let valx7 = $('#x7').val();
            let valx8 = $('#x8').val();
            let valx9 = $('#x9').val();
            let valx10 = $('#x10').val();
            let valx11 = $('#x11').val();
            let valx12 = $('#x12').val();
            let valx13 = $('#x13').val();
            let valx14 = $('#x14').val();
            let valx15 = $('#x15').val();
            (valx7 == 'x')?xcount++:'';
            (valx8 == 'x')?xcount++:'';
            (valx9 == 'x')?xcount++:'';
            (valx10 == 'x')?xcount++:'';
            (valx11 == 'x')?xcount++:'';
            (valx12 == 'x')?xcount++:'';
            (valx13 == 'x')?xcount++:'';
            (valx14 == 'x')?xcount++:'';
            (valx15 == 'x')?xcount++:'';
            $('#count-x02').text(xcount);
            let xtotal = xcount * 3;
            $('#total-x02').text(xtotal);

            let ycount = 0;
            let valy7 = $('#y7').val();
            let valy8 = $('#y8').val();
            let valy9 = $('#y9').val();
            let valy10 = $('#y10').val();
            let valy11 = $('#y11').val();
            let valy12 = $('#y12').val();
            let valy13 = $('#y13').val();
            let valy14 = $('#y14').val();
            let valy15 = $('#y15').val();
            (valy7 == 'y')?ycount++:'';
            (valy8 == 'y')?ycount++:'';
            (valy9 == 'y')?ycount++:'';
            (valy10 == 'y')?ycount++:'';
            (valy11 == 'y')?ycount++:'';
            (valy12 == 'y')?ycount++:'';
            (valy13 == 'y')?ycount++:'';
            (valy14 == 'y')?ycount++:'';
            (valy15 == 'y')?ycount++:'';
            $('#count-y02').text(ycount);
            let ytotal = ycount * 2;
            $('#total-y02').text(ytotal);

            let zcount = 0;
            let valz7 = $('#z7').val();
            let valz8 = $('#z8').val();
            let valz9 = $('#z9').val();
            let valz10 = $('#z10').val();
            let valz11 = $('#z11').val();
            let valz12 = $('#z12').val();
            let valz13 = $('#z13').val();
            let valz14 = $('#z14').val();
            let valz15 = $('#z15').val();
            (valz7 == 'z')?zcount++:'';
            (valz8 == 'z')?zcount++:'';
            (valz9 == 'z')?zcount++:'';
            (valz10 == 'z')?zcount++:'';
            (valz11 == 'z')?zcount++:'';
            (valz12 == 'z')?zcount++:'';
            (valz13 == 'z')?zcount++:'';
            (valz14 == 'z')?zcount++:'';
            (valz15 == 'z')?zcount++:'';
            $('#count-z02').text(zcount);
            let ztotal = zcount * 0;
            $('#total-z02').text(ztotal);

            let score_gained =(((wtotal+xtotal+ytotal+ztotal)/36)*15).toFixed(2);

            $('#total_score02').text(score_gained);
        }

        function calculate03(){

            let wcount = 0;
            let val16 = $('#w16').val();
            let val17 = $('#w17').val();
            let val18 = $('#w18').val();
            let val19 = $('#w19').val();
            let val20 = $('#w20').val();
            let val21 = $('#w21').val();
            let val22 = $('#w22').val();
            let val23 = $('#w23').val();
            (val16 == 'w')?wcount++:'';
            (val17 == 'w')?wcount++:'';
            (val18 == 'w')?wcount++:'';
            (val19 == 'w')?wcount++:'';
            (val20 == 'w')?wcount++:'';
            (val21 == 'w')?wcount++:'';
            (val22 == 'w')?wcount++:'';
            (val23 == 'w')?wcount++:'';
            $('#count-w03').text(wcount);
            let wtotal = wcount * 4;
            $('#total-w03').text(wtotal);

            let xcount = 0;
            let valx16 = $('#x16').val();
            let valx17 = $('#x17').val();
            let valx18 = $('#x18').val();
            let valx19 = $('#x19').val();
            let valx20 = $('#x20').val();
            let valx21 = $('#x21').val();
            let valx22 = $('#x22').val();
            let valx23 = $('#x23').val();
            let valx24 = $('#x24').val();
            (valx16 == 'x')?xcount++:'';
            (valx17 == 'x')?xcount++:'';
            (valx18 == 'x')?xcount++:'';
            (valx19 == 'x')?xcount++:'';
            (valx20 == 'x')?xcount++:'';
            (valx21 == 'x')?xcount++:'';
            (valx22 == 'x')?xcount++:'';
            (valx23 == 'x')?xcount++:'';
            (valx24 == 'x')?xcount++:'';
            $('#count-x03').text(xcount);
            let xtotal = xcount * 3;
            $('#total-x03').text(xtotal);

            let ycount = 0;
            let valy16 = $('#y16').val();
            let valy17 = $('#y17').val();
            let valy18 = $('#y18').val();
            let valy19 = $('#y19').val();
            let valy20 = $('#y20').val();
            let valy21 = $('#y21').val();
            let valy22 = $('#y22').val();
            let valy23 = $('#y23').val();
            let valy24 = $('#y24').val();
            (valy16 == 'y')?ycount++:'';
            (valy17 == 'y')?ycount++:'';
            (valy18 == 'y')?ycount++:'';
            (valy19 == 'y')?ycount++:'';
            (valy20 == 'y')?ycount++:'';
            (valy21 == 'y')?ycount++:'';
            (valy22 == 'y')?ycount++:'';
            (valy23 == 'y')?ycount++:'';
            (valy24 == 'y')?ycount++:'';
            $('#count-y03').text(ycount);
            let ytotal = ycount * 2;
            $('#total-y03').text(ytotal);

            let zcount = 0;
            let valz16 = $('#z16').val();
            let valz17 = $('#z17').val();
            let valz18 = $('#z18').val();
            let valz19 = $('#z19').val();
            let valz20 = $('#z20').val();
            let valz21 = $('#z21').val();
            let valz22 = $('#z22').val();
            let valz23 = $('#z23').val();
            let valz24 = $('#z24').val();
            (valz16 == 'z')?zcount++:'';
            (valz17 == 'z')?zcount++:'';
            (valz18 == 'z')?zcount++:'';
            (valz19 == 'z')?zcount++:'';
            (valz20 == 'z')?zcount++:'';
            (valz21 == 'z')?zcount++:'';
            (valz22 == 'z')?zcount++:'';
            (valz23 == 'z')?zcount++:'';
            (valz24 == 'z')?zcount++:'';
            $('#count-z03').text(zcount);
            let ztotal = zcount * 0;
            $('#total-z03').text(ztotal);

            let score_gained =(((wtotal+xtotal+ytotal+ztotal)/32)*15).toFixed(2);

            $('#total_score03').text(score_gained);
        }

        ////// 09 starts here/////

        function calculate09() {
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


            let xcount = 0;
            let valx62 = $('#x62').val();
            let valx63 = $('#x63').val();
            let valx64 = $('#x64').val();
            let valx65 = $('#x65').val();
            (valx62 == 'x')?xcount++:'';
            (valx63 == 'x')?xcount++:'';
            (valx64 == 'x')?xcount++:'';
            (valx65 == 'x')?xcount++:'';
            $('#count-x09').text(xcount);
            let xtotal = xcount * 3;
            $('#total-x09').text(xtotal);

            let ycount = 0;
            let valy62 = $('#y62').val();
            let valy63 = $('#y63').val();
            let valy64 = $('#y64').val();
            let valy65 = $('#y65').val();
            (valy62 == 'y')?ycount++:'';
            (valy63 == 'y')?ycount++:'';
            (valy64 == 'y')?ycount++:'';
            (valy65 == 'y')?ycount++:'';
            $('#count-y09').text(ycount);
            let ytotal = ycount * 2;
            $('#total-y09').text(ytotal);

            let zcount = 0;
            let valz62 = $('#z62').val();
            let valz63 = $('#z63').val();
            let valz64 = $('#z64').val();
            let valz65 = $('#z65').val();
            (valz62 == 'z')?zcount++:'';
            (valz63 == 'z')?zcount++:'';
            (valz64 == 'z')?zcount++:'';
            (valz65 == 'z')?zcount++:'';
            $('#count-z09').text(zcount);
            let ztotal = zcount * 0;
            $('#total-z09').text(ztotal);

            let score_gained =(((wtotal+xtotal+ytotal+ztotal)/16)*5).toFixed(2);

            $('#total_score09').text(score_gained);


        }
        $( "#w62, #w63, #w64, #w65,#x62, #x63, #x64, #x65,#y62, #y63, #y64, #y65,#z62, #z63, #z64, #z65" ).keyup(function() {
            calculate09();
        });

        ////// 09 Ends here/////

        $( "#w1, #w2, #w3, #w4, #w5, #w6,#x1, #x2, #x3, #x4, #x5, #x6,y1, #y2, #y3, #y4, #y5, #y6,z1, #z2, #z3, #z4, #z5, #z6" ).keyup(function() {
            calculate01();
        });


        ////// 02 Starts here/////

        $( "#w7, #w8, #w9, #w10, #w11, #w12, #w13, #w14, #w15,#x7, #x8, #x9, #x10, #x11, #x13, #x14, #x15,y7, #y8, #y9, #y10, #y11, #y13, #y14, #y15,z7, #z8, #z9, #z10, #z11, #z13, #z14, #z15" ).keyup(function() {
           calculate02();
        });



        $( "#w16, #w17, #w18, #w19, #w20, #w21, #w22, #w23,#x16, #x17, #x18, #x19, #x20, #x21, #x22, #x23,#y16, #y17, #y18, #y19, #y20, #y21, #y22, #y23,#z16, #z17, #z18, #z19, #z20, #z21, #z22, #z23" ).keyup(function() {
            calculate03();
        });

        function calculate04(){
            let wcount = 0;
            let val24 = $('#w24').val();
            let val25 = $('#w25').val();
            let val26 = $('#w26').val();
            let val27 = $('#w27').val();
            let val28 = $('#w28').val();
            let val29 = $('#w29').val();
            let val30 = $('#w30').val();
            let val31 = $('#w31').val();
            let val32 = $('#w32').val();
            let val33 = $('#w33').val();
            let val34 = $('#w34').val();
            let val35 = $('#w35').val();

            (val24 == 'w')?wcount++:'';
            (val25 == 'w')?wcount++:'';
            (val26 == 'w')?wcount++:'';
            (val27 == 'w')?wcount++:'';
            (val28 == 'w')?wcount++:'';
            (val29 == 'w')?wcount++:'';
            (val30 == 'w')?wcount++:'';
            (val31 == 'w')?wcount++:'';
            (val32 == 'w')?wcount++:'';
            (val33 == 'w')?wcount++:'';
            (val34 == 'w')?wcount++:'';
            (val35 == 'w')?wcount++:'';

            $('#count-w04').text(wcount);
            let wtotal = wcount * 4;
            $('#total-w04').text(wtotal);

            let xcount = 0;
            let valx24 = $('#x24').val();
            let valx25 = $('#x25').val();
            let valx26 = $('#x26').val();
            let valx27 = $('#x27').val();
            let valx28 = $('#x28').val();
            let valx29 = $('#x29').val();
            let valx30 = $('#x30').val();
            let valx31 = $('#x31').val();
            let valx32 = $('#x32').val();
            let valx33 = $('#x33').val();
            let valx34 = $('#x34').val();
            let valx35 = $('#x35').val();
            (valx24 == 'x')?xcount++:'';
            (valx25 == 'x')?xcount++:'';
            (valx26 == 'x')?xcount++:'';
            (valx27 == 'x')?xcount++:'';
            (valx28 == 'x')?xcount++:'';
            (valx29 == 'x')?xcount++:'';
            (valx30 == 'x')?xcount++:'';
            (valx31 == 'x')?xcount++:'';
            (valx32 == 'x')?xcount++:'';
            (valx33 == 'x')?xcount++:'';
            (valx34 == 'x')?xcount++:'';
            (valx35 == 'x')?xcount++:'';
            $('#count-x04').text(xcount);
            let xtotal = xcount * 3;
            $('#total-x04').text(xtotal);

            let ycount = 0;
            let valy24 = $('#y24').val();
            let valy25 = $('#y25').val();
            let valy26 = $('#y26').val();
            let valy27 = $('#y27').val();
            let valy28 = $('#y28').val();
            let valy29 = $('#y29').val();
            let valy30 = $('#y30').val();
            let valy31 = $('#y31').val();
            let valy32 = $('#y32').val();
            let valy33 = $('#y33').val();
            let valy34 = $('#y34').val();
            let valy35 = $('#y35').val();
            (valy24 == 'y')?ycount++:'';
            (valy25 == 'y')?ycount++:'';
            (valy26 == 'y')?ycount++:'';
            (valy27 == 'y')?ycount++:'';
            (valy28 == 'y')?ycount++:'';
            (valy29 == 'y')?ycount++:'';
            (valy30 == 'y')?ycount++:'';
            (valy31 == 'y')?ycount++:'';
            (valy32 == 'y')?ycount++:'';
            (valy33 == 'y')?ycount++:'';
            (valy34 == 'y')?ycount++:'';
            (valy35 == 'y')?ycount++:'';
            $('#count-y04').text(ycount);
            let ytotal = ycount * 2;
            $('#total-y04').text(ytotal);
            let zcount = 0;
            let valz24 = $('#z24').val();
            let valz25 = $('#z25').val();
            let valz26 = $('#z26').val();
            let valz27 = $('#z27').val();
            let valz28 = $('#z28').val();
            let valz29 = $('#z29').val();
            let valz30 = $('#z30').val();
            let valz31 = $('#z31').val();
            let valz32 = $('#z32').val();
            let valz33 = $('#z33').val();
            let valz34 = $('#z34').val();
            let valz35 = $('#z35').val();
            (valz24 == 'z')?zcount++:'';
            (valz25 == 'z')?zcount++:'';
            (valz26 == 'z')?zcount++:'';
            (valz27 == 'z')?zcount++:'';
            (valz28 == 'z')?zcount++:'';
            (valz29 == 'z')?zcount++:'';
            (valz30 == 'z')?zcount++:'';
            (valz31 == 'z')?zcount++:'';
            (valz32 == 'z')?zcount++:'';
            (valz33 == 'z')?zcount++:'';
            (valz34 == 'z')?zcount++:'';
            (valz35 == 'z')?zcount++:'';
            $('#count-z04').text(zcount);
            let ztotal = zcount * 0;
            $('#total-z04').text(ztotal);
            let score_gained =(((wtotal+xtotal+ytotal+ztotal)/48)*20).toFixed(2);

            $('#total_score04').text(score_gained);


        }

        $( "#w24, #w24, #w25, #w26, #w27, #w28, #w29, #w31, #w32, #w33, #w34, #w35,#x24, #x24, #x25, #x26, #x27, #x28, #x29, #x30, #x31, #x32, #x33, #x34, #x35,#y24, #y24, #y25, #y26, #y27, #y28, #y29, #y30, #y31, #y32, #y33, #y34, #y35,#z24, #z24, #z25, #z26, #z27, #z28, #z29, #z30,#z31, #z32, #z33, #z34, #z35" ).keyup(function() {
            calculate04();
        });


        //calcualte 05
        function calculate05() {
            let wcount = 0;
            let val36 = $('#w36').val();
            let val37 = $('#w37').val();
            let val38 = $('#w38').val();
            let val39 = $('#w39').val();
            let val40 = $('#w40').val();
            let val41 = $('#w41').val();
            let val42 = $('#w42').val();
            let val43 = $('#w43').val();

            (val36 == 'w')?wcount++:'';
            (val37 == 'w')?wcount++:'';
            (val38 == 'w')?wcount++:'';
            (val39 == 'w')?wcount++:'';
            (val40 == 'w')?wcount++:'';
            (val41 == 'w')?wcount++:'';
            (val42 == 'w')?wcount++:'';
            (val43 == 'w')?wcount++:'';

            $('#count-w05').text(wcount);
            let wtotal = wcount * 4;
            $('#total-w05').text(wtotal);

            let xcount = 0;
            let valx36 = $('#x36').val();
            let valx37 = $('#x37').val();
            let valx38 = $('#x38').val();
            let valx39 = $('#x39').val();
            let valx40 = $('#x40').val();
            let valx41 = $('#x41').val();
            let valx42 = $('#x42').val();
            let valx43 = $('#x43').val();
            (valx36 == 'x')?xcount++:'';
            (valx37 == 'x')?xcount++:'';
            (valx38 == 'x')?xcount++:'';
            (valx39 == 'x')?xcount++:'';
            (valx40 == 'x')?xcount++:'';
            (valx41 == 'x')?xcount++:'';
            (valx42 == 'x')?xcount++:'';
            (valx43 == 'x')?xcount++:'';
            $('#count-x05').text(xcount);
            let xtotal = xcount * 3;
            $('#total-x05').text(xtotal);

            let ycount = 0;
            let valy36 = $('#y36').val();
            let valy37 = $('#y37').val();
            let valy38 = $('#y38').val();
            let valy39 = $('#y39').val();
            let valy40 = $('#y40').val();
            let valy41 = $('#y41').val();
            let valy42 = $('#y42').val();
            let valy43 = $('#y43').val();
            (valy36 == 'y')?ycount++:'';
            (valy37 == 'y')?ycount++:'';
            (valy38 == 'y')?ycount++:'';
            (valy39 == 'y')?ycount++:'';
            (valy40 == 'y')?ycount++:'';
            (valy41 == 'y')?ycount++:'';
            (valy42 == 'y')?ycount++:'';
            (valy43 == 'y')?ycount++:'';
            $('#count-y05').text(ycount);
            let ytotal = ycount * 2;
            $('#total-y05').text(ytotal);

            let zcount = 0;
            let valz36 = $('#z36').val();
            let valz37 = $('#z37').val();
            let valz38 = $('#z38').val();
            let valz39 = $('#z39').val();
            let valz40 = $('#z40').val();
            let valz41 = $('#z41').val();
            let valz42 = $('#z42').val();
            let valz43 = $('#z43').val();
            (valz36 == 'z')?zcount++:'';
            (valz37 == 'z')?zcount++:'';
            (valz38 == 'z')?zcount++:'';
            (valz39 == 'z')?zcount++:'';
            (valz40 == 'z')?zcount++:'';
            (valz41 == 'z')?zcount++:'';
            (valz42 == 'z')?zcount++:'';
            (valz43 == 'z')?zcount++:'';
            $('#count-z05').text(zcount);
            let ztotal = zcount * 0;
            $('#total-z05').text(ztotal);

            let score_gained =(((wtotal+xtotal+ytotal+ztotal)/36)*10).toFixed(2);

            $('#total_score05').text(score_gained);

        }

        $( "#w43, #w42, #w41, #w40, #w39,#w38, #w37, #w36,#x43, #x42, #x41, #x40, #x39,#x38, #x37, #x36,#y43, #y42, #y41, #y40, #y39,#y38, #y37, #y36,#z43, #z42, #z41, #z40, #z39,#z38, #z37, #z36" ).keyup(function() {
           calculate05()
        });

        function calculate06() {
            let wcount = 0;
            let val44 = $('#w44').val();
            let val45 = $('#w45').val();
            let val46 = $('#w46').val();
            let val47 = $('#w47').val();
            let val48 = $('#w48').val();

            (val44 == 'w')?wcount++:'';
            (val45 == 'w')?wcount++:'';
            (val46 == 'w')?wcount++:'';
            (val47 == 'w')?wcount++:'';
            (val48 == 'w')?wcount++:'';

            $('#count-w06').text(wcount);
            let wtotal = wcount * 4;
            $('#total-w06').text(wtotal);

            let xcount = 0;
            let valx44 = $('#x44').val();
            let valx45 = $('#x45').val();
            let valx46 = $('#x46').val();
            let valx47 = $('#x47').val();
            let valx48 = $('#x48').val();
            (valx44 == 'x')?xcount++:'';
            (valx45 == 'x')?xcount++:'';
            (valx46 == 'x')?xcount++:'';
            (valx47 == 'x')?xcount++:'';
            (valx48 == 'x')?xcount++:'';
            $('#count-x06').text(xcount);
            let xtotal = xcount * 3;
            $('#total-x06').text(xtotal);
            let ycount = 0;
            let valy44 = $('#y44').val();
            let valy45 = $('#y45').val();
            let valy46 = $('#y46').val();
            let valy47 = $('#y47').val();
            let valy48 = $('#y48').val();
            (valy44 == 'y')?ycount++:'';
            (valy45 == 'y')?ycount++:'';
            (valy46 == 'y')?ycount++:'';
            (valy47 == 'y')?ycount++:'';
            (valy48 == 'y')?ycount++:'';
            $('#count-y06').text(ycount);
            let ytotal = ycount * 2;
            $('#total-y06').text(ytotal);
            let zcount = 0;
            let valz44 = $('#z44').val();
            let valz45 = $('#z45').val();
            let valz46 = $('#z46').val();
            let valz47 = $('#z47').val();
            let valz48 = $('#z48').val();
            (valz44 == 'z')?zcount++:'';
            (valz45 == 'z')?zcount++:'';
            (valz46 == 'z')?zcount++:'';
            (valz47 == 'z')?zcount++:'';
            (valz48 == 'z')?zcount++:'';
            $('#count-z06').text(zcount);
            let ztotal = zcount * 0;
            $('#total-z06').text(ztotal);

            let score_gained =(((wtotal+xtotal+ytotal+ztotal)/20)*5).toFixed(2);

            $('#total_score06').text(score_gained);

        }


        $( "#w44, #w45, #w46, #w47, #w48,#x44, #x45, #x46, #x47, #x48,#y44, #y45, #y46, #y47, #y48,#z44, #z45, #z46, #z47, #z48" ).keyup(function() {
            calculate06()
        });

        //calculate 07

        function calculate07() {
            let wcount = 0;
            let val49 = $('#w49').val();
            let val50 = $('#w50').val();
            let val51 = $('#w51').val();
            let val52 = $('#w52').val();
            let val53 = $('#w53').val();
            let val54 = $('#w54').val();
            let val55 = $('#w55').val();

            (val49 == 'w')?wcount++:'';
            (val50 == 'w')?wcount++:'';
            (val51 == 'w')?wcount++:'';
            (val52 == 'w')?wcount++:'';
            (val53 == 'w')?wcount++:'';
            (val54 == 'w')?wcount++:'';
            (val55 == 'w')?wcount++:'';

            $('#count-w07').text(wcount);
            let wtotal = wcount * 0;
            $('#total-w07').text(wtotal);

            let zcount = 0;
            let valz49 = $('#z49').val();
            let valz50 = $('#z50').val();
            let valz51 = $('#z51').val();
            let valz52 = $('#z52').val();
            let valz53 = $('#z53').val();
            let valz54 = $('#z54').val();
            let valz55 = $('#z55').val();
            (valz49 == 'z')?zcount++:'';
            (valz50 == 'z')?zcount++:'';
            (valz51 == 'z')?zcount++:'';
            (valz52 == 'z')?zcount++:'';
            (valz53 == 'z')?zcount++:'';
            (valz54 == 'z')?zcount++:'';
            (valz55 == 'z')?zcount++:'';
            $('#count-z07').text(zcount);
            let ztotal = zcount * 0;
            $('#total-z07').text(ztotal);

            let xcount = 0;
            let valx49 = $('#x49').val();
            let valx50 = $('#x50').val();
            let valx51 = $('#x51').val();
            let valx52 = $('#x52').val();
            let valx53 = $('#x53').val();
            let valx54 = $('#x54').val();
            let valx55 = $('#x55').val();
            (valx49 == 'x')?xcount++:'';
            (valx50 == 'x')?xcount++:'';
            (valx51 == 'x')?xcount++:'';
            (valx52 == 'x')?xcount++:'';
            (valx53 == 'x')?xcount++:'';
            (valx54 == 'x')?xcount++:'';
            (valx55 == 'x')?xcount++:'';
            $('#count-x07').text(xcount);
            let xtotal = xcount * 3;
            $('#total-x07').text(xtotal);
            let ycount = 0;

            let valy49 = $('#y49').val();
            let valy50 = $('#y50').val();
            let valy51 = $('#y51').val();
            let valy52 = $('#y52').val();
            let valy53 = $('#y53').val();
            let valy54 = $('#y54').val();
            let valy55 = $('#y55').val();
            (valy49 == 'y')?ycount++:'';
            (valy50 == 'y')?ycount++:'';
            (valy51 == 'y')?ycount++:'';
            (valy52 == 'y')?ycount++:'';
            (valy53 == 'y')?ycount++:'';
            (valy54 == 'y')?ycount++:'';
            (valy55 == 'y')?ycount++:'';
            $('#count-y07').text(ycount);
            let ytotal = ycount * 2;
            $('#total-y07').text(ytotal);
            let score_gained =(((wtotal+xtotal+ytotal+ztotal)/24)*10).toFixed(2);

            $('#total_score07').text(score_gained);


        }
        $( "#w49, #w50, #w51, #w52, #w53, #w54, #w55,#z49,#x49, #x50, #x51, #x52, #x53, #x54, #x55,#y49, #y50, #y51, #y52, #y53, #y54, #y55, #z50, #z51, #z52, #z53, #z54, #z55" ).keyup(function() {
           calculate07();
        });


        // calculate 08
        function calculate08() {
            let wcount = 0;
            let val56 = $('#w56').val();
            let val57 = $('#w57').val();
            let val58 = $('#w58').val();
            let val59 = $('#w59').val();
            let val60 = $('#w60').val();
            let val61 = $('#w61').val();

            (val56 == 'w')?wcount++:'';
            (val57 == 'w')?wcount++:'';
            (val58 == 'w')?wcount++:'';
            (val59 == 'w')?wcount++:'';
            (val60 == 'w')?wcount++:'';
            (val61 == 'w')?wcount++:'';

            $('#count-w08').text(wcount);
            let wtotal = wcount * 4;
            $('#total-w08').text(wtotal);

            let ycount = 0;
            let valy56 = $('#y56').val();
            let valy57 = $('#y57').val();
            let valy58 = $('#y58').val();
            let valy59 = $('#y59').val();
            let valy60 = $('#y60').val();
            let valy61 = $('#y61').val();
            (valy56 == 'y')?ycount++:'';
            (valy57 == 'y')?ycount++:'';
            (valy58 == 'y')?ycount++:'';
            (valy59 == 'y')?ycount++:'';
            (valy60 == 'y')?ycount++:'';
            (valy61 == 'y')?ycount++:'';
            $('#count-y08').text(ycount);
            let ytotal = ycount * 2;
            $('#total-y08').text(ytotal);
            let xcount = 0;
            let valx56 = $('#x56').val();
            let valx57 = $('#x57').val();
            let valx58 = $('#x58').val();
            let valx59 = $('#x59').val();
            let valx60 = $('#x60').val();
            let valx61 = $('#x61').val();
            (valx56 == 'x')?xcount++:'';
            (valx57 == 'x')?xcount++:'';
            (valx58 == 'x')?xcount++:'';
            (valx59 == 'x')?xcount++:'';
            (valx60 == 'x')?xcount++:'';
            (valx61 == 'x')?xcount++:'';
            $('#count-x08').text(xcount);
            let xtotal = xcount * 3;
            $('#total-x08').text(xtotal);

            let zcount = 0;
            let valz56 = $('#z56').val();
            let valz57 = $('#z57').val();
            let valz58 = $('#z58').val();
            let valz59 = $('#z59').val();
            let valz60 = $('#z60').val();
            let valz61 = $('#z61').val();
            (valz56 == 'z')?zcount++:'';
            (valz57 == 'z')?zcount++:'';
            (valz58 == 'z')?zcount++:'';
            (valz59 == 'z')?zcount++:'';
            (valz60 == 'z')?zcount++:'';
            (valz61 == 'z')?zcount++:'';
            $('#count-z08').text(zcount);
            let ztotal = zcount * 0;
            $('#total-z08').text(ztotal);
            let score_gained =(((wtotal+xtotal+ytotal+ztotal)/28)*5).toFixed(2);

            $('#total_score08').text(score_gained);

        }

        $( "#w56, #w57, #w58, #w59, #w60, #w61,#x56, #x57, #x58, #x59, #x60, #x61,#y56, #y57, #y58, #y59, #y60, #y61,#z56, #z57, #z58, #z59, #z60, #z61" ).keyup(function() {
           calculate08()
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
