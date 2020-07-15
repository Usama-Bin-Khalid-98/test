@section('pageTitle', 'Student Enrolment')


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
                Students Enrolment
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Students Enrolment </li>
            </ol>
        </section>
        <section class="content-header">
            <div class="col-md-12 new-button">
                <div class="pull-right">
                    <button class="btn gradient-bg-color"
{{--                           data-toggle="modal" data-target="#add-modal"--}}
                           style="color: white;"
                           value="Add New"
                            name="add" id="add">PDF <i class="fa fa-file-pdf-o"></i></button>
                </div>
            </div>
        </section>
        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">.Provide data on the applications received and student intake in the past three years for each program.<br>.State the number of students who have graduated over the past three years for each program under review.<br>.State the current gender wise break down of students in each program under review.</h3>
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

                        <!-- /.box-header -->
                        <div class="box-body">
                           <form action="javascript:void(0)" id="form" method="POST">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">University</label>
                                    <select name="uni_id" id="uni_id" class="form-control select2" style="width: 100%;">
                                        <option value="">Select University</option>
                                        @foreach($uniinfo as $uni)
                                         <option value="{{$uni->id}}">{{$uni->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                            <div class="form-group">
                                    <label for="name">Year</label>
                                    <select name="year" id="year"  class="form-control select2">
                                        <option value="">Select Year</option>
                                        <option value="2000">2000</option>
                                        <option value="2001">2001</option>
                                        <option value="2002">2002</option>
                                        <option value="2003">2003</option>
                                        <option value="2004">2004</option>
                                        <option value="2005">2005</option>
                                        <option value="2006">2006</option>
                                        <option value="2007">2007</option>
                                        <option value="2008">2008</option>
                                        <option value="2009">2009</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                    </select>

                            </div>
                        </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">16 Year Programs</label>
                                    <input type="text" name="bs_level" id="bs_level" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">18 Year Programs</label>
                                    <input type="text" name="ms_level" id="ms_level" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Doctoral Programs</label>
                                    <input type="text" name="phd_level" id="phd_level" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Total Students</label>
                                    <input type="text" name="total_students" id="total_students" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Program Name</label>
                                   <select name="program_id" id="program_id" class="form-control select2" style="width: 100%;">
                                        <option value="">Select Program</option>
                                        @foreach($programs as $program)
                                         <option value="{{$program->id}}">{{$program->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Year t</label>
                                    <input type="text" name="grad_std_t" id="grad_std_t"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Year t-2</label>
                                    <input type="text" name="grad_std_tt" id="grad_std_tt" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Year t-3</label>
                                    <input type="text" name="grad_std_ttt" id="grad_std_ttt" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Male</label>
                                    <input type="text" name="male" id="male" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Female</label>
                                    <input type="text" name="female" id="female" class="form-control">
                                </div>
                            </div>


                             <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" id="add" value="Add" class="btn btn-info">
                                </div>
                            </div>
 </form>
                        </div>
                        <!-- /.box-body -->
                        <!-- /.box -->
                    </div>
                    <!-- .box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">.Applications received and student intake in the past three years for each program.<br>.State the number of students who have graduated over the past three years for each program under review.<br>.Current gender wise break down of students in each program under review.</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>University</th>
                                    <th>Year</th>
                                    <th>16 Year</th>
                                    <th>18 Year</th>
                                    <th>Doctoral</th>
                                    <th>Total Enrolment</th>
                                    <th>Program</th>
                                    <th>Year t</th>
                                    <th>Year t-2</th>
                                    <th>Year t-3</th>
                                    <th>Male</th>
                                    <th>Female</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($enrolments as $enrolement)
                                <tr>
                                    <td>{{$enrolement->business_school->name?? ""}}</td>
                                    <td>{{$enrolement->year}}</td>
                                    <td>{{$enrolement->bs_level}}</td>
                                    <td>{{$enrolement->ms_level}}</td>
                                    <td>{{$enrolement->phd_level}}</td>
                                    <td>{{$enrolement->total_students}}</td>
                                    <td>{{$enrolement->program->name?? ""}}</td>
                                    <td>{{$enrolement->grad_std_t}}</td>
                                    <td>{{$enrolement->grad_std_t_2}}</td>
                                    <td>{{$enrolement->grad_std_t_3}}</td>
                                    <td>{{$enrolement->male}}</td>
                                    <td>{{$enrolement->female}}</td>
                                    <td><i class="badge {{$enrolement->status == 'active'?'bg-green':'bg-red'}}">{{$enrolement->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$enrolement->id}}"></i> | <i data-row='{"id":{{$enrolement->id}},"uni_id":{{$enrolement->business_school_id}},"year":{{$enrolement->year}},"bs_level":{{$enrolement->bs_level}},"ms_level":{{$enrolement->ms_level}},"phd_level":{{$enrolement->phd_level}},"total_students":{{$enrolement->total_students}},"program_id":{{$enrolement->program_id}},"grad_std_t":{{$enrolement->grad_std_t}},"grad_std_t_2":{{$enrolement->grad_std_t_2}},"grad_std_t_3":{{$enrolement->grad_std_t_3}},"male":{{$enrolement->male}},"female":{{$enrolement->female}},"status":"{{$enrolement->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>
                                    
                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>University</th>
                                    <th>Year</th>
                                    <th>16 Year</th>
                                    <th>18 Year</th>
                                    <th>Doctoral</th>
                                    <th>Total Enrolment</th>
                                    <th>Program</th>
                                    <th>Year t</th>
                                    <th>Year t-2</th>
                                    <th>Year t-3</th>
                                    <th>Male</th>
                                    <th>Female</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- Main content -->
            </div>
        </section>

<!--         <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">State the number of students who have graduated over the past three years for each program under review.</h3>
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

                         /.box-header 
                        <div class="box-body">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Program Name</label>
                                    <select name="program" class="form-control">
                                        <option value="">Select Program</option>
                                        <option value="">BSSE</option>
                                        <option value="">BCS</option>
                                        <option value="">BBA</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Year t-2</label>
                                    <input type="text" name="courses" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Year t-1</label>
                                    <input type="text" name="courses" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Year t</label>
                                    <input type="text" name="courses" value="" class="form-control">
                                </div>
                            </div>

{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="type">{{ __('Status') }} : </label>--}}
{{--                                    <p><input type="radio" name="status" class="flat-red" value="None Profit" > Active--}}
{{--                                        <input type="radio" name="status" class="flat-red" value="For Profit" >InActive</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                             <div class="col-md-12">
                                <div class="form-group pull-right">
                                    <label for="type">&nbsp;</label>
                                    <input type="button" name="submit" value="Add" class="btn btn-info">
                                </div>
                            </div>

                        </div>
                       
                    </div>
                   
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Number of students who have graduated over the past three years for each program under review.</h3>
                        </div>
                        /.box-header
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Program</th>
                                    <th>Year t-2</th>
                                    <th>Year t-1</th>
                                    <th>Year t</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>BSSE</td>
                                    <td>2020</td>
                                    <td></td>
                                    <td>2020</td>
                                    <td><i class="fa fa-trash text-info"></i> | <i class="fa fa-pencil text-blue"></i> </td>
                                </tr>
                                <tr>
                                    <td>BSSE</td>
                                    <td>2020</td>
                                    <td></td>
                                    <td>2020</td>
                                    <td><i class="fa fa-trash text-info"></i> | <i class="fa fa-pencil text-blue"></i> </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Program</th>
                                    <th>Year t-2</th>
                                    <th>Year t-1</th>
                                    <th>Year t</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        /.box-body 
                    </div>
                  
                </div>
               
            </div>
        </section> -->

       <!--  <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">State the current gender wise break down of students in each program under review.</h3>
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

                      
                        <div class="box-body">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Program Name</label>
                                    <select name="program" class="form-control">
                                        <option value="">Select Program</option>
                                        <option value="">BSSE</option>
                                        <option value="">BCS</option>
                                        <option value="">BBA</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Male</label>
                                    <input type="text" name="courses" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Female</label>
                                    <input type="text" name="courses" value="" class="form-control">
                                </div>
                            </div>

{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="type">{{ __('Status') }} : </label>--}}
{{--                                    <p><input type="radio" name="status" class="flat-red" value="None Profit" > Active--}}
{{--                                        <input type="radio" name="status" class="flat-red" value="For Profit" >InActive</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                             <div class="col-md-12">
                                <div class="form-group pull-right">
                                    <label for="type">&nbsp;</label>
                                    <input type="button" name="submit" value="Add" class="btn btn-info">
                                </div>
                            </div>

                        </div>
                       
                    </div>
                 
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Current gender wise break down of students in each program under review.</h3>
                        </div>
                     
                        <div class="box-body">
                            <table id="program" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Program</th>
                                    <th>Male</th>
                                    <th>Female</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>BSSE</td>
                                    <td>200</td>
                                    <td>130</td>
                                    <td><i class="fa fa-trash text-info"></i> | <i class="fa fa-pencil text-blue"></i> </td>
                                </tr>
                                <tr>
                                    <td>BSSE</td>
                                    <td>200</td>
                                    <td>130</td>
                                    <td><i class="fa fa-trash text-info"></i> | <i class="fa fa-pencil text-blue"></i> </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Program</th>
                                    <th>Male</th>
                                    <th>Female</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                      
                    </div>
                 
                </div>
             
            </div>
        </section> -->
    </div>

    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Student Enrolment. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">University</label>
                                <select name="uni_id" id="edit_uni_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select University</option>
                                    @foreach($uniinfo as $uni)
                                        <option value="{{$uni->id}}">{{$uni->name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="edit_id">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                    <label for="name">Year</label>
                                    <select name="year" id="edit_year"  class="form-control select2">
                                        <option value="">Select Year</option>
                                        <option value="2000">2000</option>
                                        <option value="2001">2001</option>
                                        <option value="2002">2002</option>
                                        <option value="2003">2003</option>
                                        <option value="2004">2004</option>
                                        <option value="2005">2005</option>
                                        <option value="2006">2006</option>
                                        <option value="2007">2007</option>
                                        <option value="2008">2008</option>
                                        <option value="2009">2009</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                    </select>
                                
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                    <label for="name">16 year Program</label>
                                    <input type="text" name="bs_level" id="edit_bs_level" value="{{old('bs_level')}}" class="form-control">
                                
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                    <label for="name">18 year Program</label>
                                    <input type="text" name="ms_level" id="edit_ms_level" value="{{old('ms_level')}}" class="form-control">
                                
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                    <label for="name">Doctoral Program</label>
                                    <input type="text" name="phd_level" id="edit_phd_level" value="{{old('phd_level')}}" class="form-control">
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Total Students</label>
                                    <input type="text" name="total_students" 
                                    id="edit_total_students" value="{{old('total_students')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Program</label>
                                <select name="program_id" id="edit_program_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Program</option>
                                    @foreach($programs as $program)
                                        <option value="{{$program->id}}">{{$program->name}}</option>
                                    @endforeach
                                </select>
                               
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Year t</label>
                                    <input type="text" name="grad_std_t" 
                                    id="edit_grad_std_t" value="{{old('edit_grad_std_t')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Year t-2</label>
                                    <input type="text" name="grad_std_t_2" 
                                    id="edit_grad_std_t_2" value="{{old('edit_grad_std_t_2')}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Year t-3</label>
                                    <input type="text" name="grad_std_t_3" 
                                    id="edit_grad_std_t_3" value="{{old('edit_grad_std_t_3')}}" class="form-control">
                            </div>
                        </div>
                       

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Male</label>
                                    <input type="text" name="male" 
                                    id="edit_male" value="{{old('edit_male')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Female</label>
                                    <input type="text" name="female" 
                                    id="edit_female" value="{{old('female')}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">{{ __('Status') }} : </label>
                                <p><input type="radio" name="status" class="flat-red" value="active" > Active
                                    <input type="radio" name="status" class="flat-red" value="inactive">InActive</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" name="update" value="update" class="btn btn-info">
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

        $('.select2').select2()

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#form').submit(function (e) {
            let uni_id = $('#uni_id').val();
            let year = $('#year').val();
            let bs_level = $('#bs_level').val();
            let ms_level = $('#ms_level').val();
            let phd_level = $('#phd_level').val();
            let total_students = $('#total_students').val();
            let program_id = $('#program_id').val();
            let grad_std_t = $('#grad_std_t').val();
            let grad_std_tt = $('#grad_std_tt').val();
            let grad_std_ttt = $('#grad_std_ttt').val();
            let male = $('#male').val();
            let female = $('#female').val();

            !uni_id?addClass('uni_id'):removeClass('uni_id');
            !year?addClass('year'):removeClass('year');
            !bs_level?addClass('bs_level'):removeClass('bs_level');
            !ms_level?addClass('ms_level'):removeClass('ms_level');
            !phd_level?addClass('phd_level'):removeClass('phd_level');
            !total_students?addClass('total_students'):removeClass('total_students');
            !program_id?addClass('program_id'):removeClass('program_id');
            !grad_std_t?addClass('grad_std_t'):removeClass('grad_std_t');
            !grad_std_tt?addClass('grad_std_tt'):removeClass('grad_std_tt');
            !grad_std_ttt?addClass('grad_std_ttt'):removeClass('grad_std_ttt');
            !male?addClass('male'):removeClass('male');
            !female?addClass('female'):removeClass('female');

            if(!uni_id || !year || !bs_level || !ms_level || !phd_level || !total_students || !program_id || !grad_std_t || !grad_std_tt || !grad_std_ttt || !male || !female)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("student-enrolment")}}',
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


        $('.edit').on('click', function () {
            let data = JSON.parse(JSON.stringify($(this).data('row')));
            // Initialize Select2
            $('#edit_uni_id').select2().val(data.uni_id).trigger('change');
            $('#edit_year').select2().val(data.year).trigger('change');
            $('#edit_bs_level').val(data.bs_level);
            $('#edit_ms_level').val(data.ms_level);
            $('#edit_phd_level').val(data.phd_level);
            $('#edit_total_students').val(data.total_students);
            $('#edit_program_id').select2().val(data.program_id).trigger('change');
            $('#edit_grad_std_t').val(data.grad_std_t);
            $('#edit_grad_std_t_2').val(data.grad_std_t_2);
            $('#edit_grad_std_t_3').val(data.grad_std_t_3);
            $('#edit_male').val(data.male);
            $('#edit_female').val(data.female);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#updateForm').submit(function (e) {
            let uni_id = $('#edit_uni_id').val();
            let year = $('#edit_year').val();
            let bs_level = $('#edit_bs_level').val();
            let ms_level = $('#edit_ms_level').val();
            let phd_level = $('#edit_phd_level').val();
            let total_students = $('#edit_total_students').val();
            let program_id = $('#edit_program_id').val();
            let grad_std_t = $('#edit_grad_std_t').val();
            let grad_std_t_2 = $('#edit_grad_std_t_2').val();
            let grad_std_t_3 = $('#edit_grad_std_t_3').val();
            let male = $('#edit_male').val();
            let female = $('#edit_female').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !uni_id?addClass('edit_uni_id'):removeClass('edit_uni_id');
            !year?addClass('edit_year'):removeClass('edit_year');
            !bs_level?addClass('edit_bs_level'):removeClass('edit_bs_level');
            !ms_level?addClass('edit_ms_level'):removeClass('edit_ms_level');
            !phd_level?addClass('edit_phd_level'):removeClass('edit_phd_level');
            !total_students?addClass('edit_total_students'):removeClass('edit_total_students');
            !program_id?addClass('program_id'):removeClass('program_id');
            !grad_std_t?addClass('grad_std_t'):removeClass('grad_std_t');
            !grad_std_t_2?addClass('grad_std_t_2'):removeClass('grad_std_t_2');
            !grad_std_t_3?addClass('grad_std_t_3'):removeClass('grad_std_t_3');
            !male?addClass('male'):removeClass('male');
            !female?addClass('female'):removeClass('female');

            if(!uni_id || !year || !bs_level || !ms_level || !phd_level || !total_students || !program_id || !grad_std_t || !grad_std_t_2 || !grad_std_t_3 || !male|| !female)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("student-enrolment")}}/'+id,
                type:'POST',
                // dataType:"JSON",
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
        });

        $('.delete').on('click', function (e) {
            let id =  $(this).data('id');
            Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to delete?', 'Yes', 'No',
                function(){
                    // Yes button callback
                    $.ajax({
                        url:'{{url("student-enrolment")}}/'+id,
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
                            // console.log('response here', response);
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
