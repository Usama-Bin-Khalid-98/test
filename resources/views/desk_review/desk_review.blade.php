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
                Basic Eligibility Criteria (1-6): Fulfilled/Not Fulfilled with Criteria Number
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active">Desk Review</li>
            </ol>
        </section>
        <section class="content-header">
            <div class="col-md-12 new-button">
                <div class="pull-right">
                    <button class="btn gradient-bg-color"
                            {{--                           data-toggle="modal" data-target="#add-modal"--}}
                            style="color: white;"
                            value="Add New">PDF <i class="fa fa-file-pdf-o"></i></button>
                </div>
            </div>
        </section>

        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 >Applied for:</h3>
                            <h3 >Application Received:</h3>
                            <h3 >Basic Eligibility Criteria (1-6): Fulfilled/Not Fulfilled with Criteria Number</h3>
                            {{--                            <div class="box-tools pull-right">--}}
                            {{--                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>--}}
                            {{--                                </button>--}}
                            {{--                                <div class="btn-group">--}}
                            {{--                                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">--}}
                            {{--                                        <i class="fa fa-file-pdf-o"></i></button>--}}
                            {{--                                </div>--}}
                            {{--                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>--}}
                            {{--                            </div>--}}
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="javascript:void(0)" id="form" method="POST">

                                <table class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <th style="width: 45%">Data provided by University</th>
                                            <th style="width: 45%">NBEAC Criteria</th>
                                            @hasrole('NBEACAdmin')<th style="width: 10%">Is Eligible</th>@endhasrole
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                1. Programs started (Table-1.2 date of program commencement)
                                                <ol type="i">
                                                    @foreach($program_dates as $dates)
                                                        <li>{{$dates['program']}} Started in  {{$dates['date']}} (Difference {{$dates['date_diff']}})</li>
                                                    @endforeach
                                                </ol>
                                            </td>

                                            <td>
                                                {{--                                    <strong>At least 3 batches of the degree should have passed to consider the program for accreditation.</strong>--}}
                                                {!! $nbeac_criteria->program_started !!}

                                            </td>
                                            @hasrole('NBEACAdmin')
                                            <td>
                                                <input type="radio" name="eligibility_program" value="yes"> yes
                                                <input type="radio" name="eligibility_program" value="no"> no
                                            </td>
                                            @endhasrole
                                        </tr>

                                        <tr>
                                            <td>
                                                2. Vision and Mission statements ( Question 1.7)
                                                <p><strong>Mission : </strong> {!! @$mission_vision->mission !!}</p>

                                                <p><strong>Vision : </strong> {!! @$mission_vision->vision !!}</p>

                                            </td>
                                            <td>
                                                {!! $nbeac_criteria->mission_vision_statement !!}
                                                {{--                                            Vision and mission should exist, realistic and shared among the all stake holders. Mission statement of business school is clear, current and aligned with its vision statement.--}}
                                                {{--                                            There should be documentary evidence that vision and mission are approved by any statutory body.--}}
                                                {{--                                            The vision and mission should be displayed on the Department's webpage. There should be synchronization between both versions i.e.  Presented to NBEAC and displayed on website.--}}

                                            </td>
                                            @hasrole('NBEACAdmin')
                                            <td>
                                                <input type="radio" name="eligibility_mission" value="yes"> yes
                                                <input type="radio" name="eligibility_mission" value="no"> no
                                            </td>
                                            @endhasrole
                                        </tr>

                                        <tr>
                                            <td>
                                                <p>3. Strategic Plan (Question 1.8)</p>
                                                <p>Approval Date {{@$strategic_plan->aproval_date}}  Difference( {{@$strategic_date_diff}} )</p>
                                            </td>
                                            <td>
                                                {!! @$nbeac_criteria->strategic_plan !!}
                                            </td>
                                            @hasrole('NBEACAdmin')
                                            <td>
                                                <input type="radio" name="eligibility_plan" value="yes"> yes
                                                <input type="radio" name="eligibility_plan" value="no"> no
                                            </td>
                                            @endhasrole
                                        </tr>

                                        <tr>
                                            <td>
                                                <p>4. Student Intake(Table 2.3)</p>
                                                <p>Student Intake {{@$application_received->student_intake}}</p>
                                            </td>
                                            <td> {!! @$nbeac_criteria->student_intake !!} </td>
                                            @hasrole('NBEACAdmin')
                                            <td>
                                                <input type="radio" name="eligibility_student" value="yes"> yes
                                                <input type="radio" name="eligibility_student" value="no"> no
                                            </td>
                                            @endhasrole
                                        </tr>

                                        <tr>
                                            <td>
                                                <strong> 5.	Student enrollment</strong>
                                                <p>
                                                    <strong> a)	Total Annual Enrollment Table (3.1)</strong></p>
                                                @foreach(@$student_enrolment as $enrollment)
                                                    <p> Year {{$enrollment->year}}	16 years programs {{$enrollment->bs_level}}</p>
                                                    <p> Year {{$enrollment->year}}	18 years programs {{$enrollment->ms_level}}</p>
                                                    <p> Year {{$enrollment->year}}   Doctoral programs {{$enrollment->ms_level}}</p>
                                                @endforeach

                                                <p><strong> )	Graduated Students</strong></p>

                                                @foreach($graduated_students as $graduated)
                                                    <p> Program {{$graduated->program->name}} </p>
                                                    <p> Year t {{$graduated->grad_std_t}} </p>
                                                    <p> Year t-1 {{$graduated->grad_std_t_2}} </p>
                                                    <p> Year t-2 {{$graduated->grad_std_t_3}} </p>

                                                @endforeach

                                                <strong> b)	Faculty Portfolio (Section 4)</strong>

                                                <p> <strong>c)</strong>	Total Fulltime Faculty = {{@$faculty_summary}}</p>
                                                <p> <strong>d)</strong>	Full professors {{@$getFullProfessors}}</p>
                                                <p> <strong>e)</strong>	Associate professors {{@$AssociateProfessors}}</p>
                                                <p> <strong>f)</strong>	Assistant professors {{@$AssistantProfessors}}</p>
                                                <p> <strong>g)</strong>	Lecturers {{@$lecturers}}</p>
                                                <p> <strong>h)</strong>	Other {{@$other}}</p>
                                                <p> <strong>i)</strong>	% of female permanent / regular faculty {{@$female_faculty}}</p>
                                                <p> <strong>j)</strong>	% holding a doctoral degree {{@$faculty_summary_doc}}</p>
                                                <p> <strong>k)</strong>	Total number of permanent faculty {{@$permanent_faculty}}</p>
                                                <p> <strong>l)</strong>	Total number of adjunct faculty {{@$adjunct_faculty}}</p>
                                                <p> <strong>m)</strong>	Full-time equivalent (Table 4.3a FTE for the permanent, regular and adjunct faculty in program(s))</p>
                                                <p> <strong>n)</strong>	Visiting Faculty Equivalent (Table 4.3b Visiting Faculty Equivalent (VFE) in program(s))</p>
                                                <p> <strong>o)</strong>	Student to teacher ratio: (Total enrollment (B)/(Total FTE (C)+Total VFE(D)) (Table 4.4)</p>
                                                <p> BBA (program1) =</p>
                                                <p> MBA (program2) =</p>
                                                <p> <strong>p)</strong>	Permanent / regular faculty hired in last 3 years (FTE) (Table 4.5: Induction) = {{@$total_induction}}</p>
                                                <p> <strong>q)</strong>	Permanent/ regular faculty departed in last 3 years (FTE) (table 4.5: resigned + terminated+ retired) = {{@$faculty_resigned + @$faculty_terminated + @$faculty_retired}}</p>
                                                <p> <strong>r)</strong>	FT:PT (as per table 4.3 a 4.3 b)=</p>
                                                <p> <strong>s)</strong>	No. of faculty with terminal degree from foreign institutions = {{@$faculty_degree->faculty_foreign}}</p>
                                                <p> <strong>t)</strong>	No. of faculty with terminal degree from domestic institutions = {{@$faculty_degree->faculty_domestic}}</p>
                                                <p> <strong>u)</strong>	No. of faculty with international work experience = {{@$faculty_degree->faculty_international}}</p>
                                                <p> <strong>v)</strong>	Teaching and research assistants  - on short-term contracts- (Others in Table 4.1)</p>

                                            </td>
                                            <td>
                                                {!! @$nbeac_criteria->student_enrollment !!}

                                            </td>

                                            @hasrole('NBEACAdmin')
                                            <td>
                                                <input type="radio" name="eligibility_enrollment" value="yes"> yes
                                                <input type="radio" name="eligibility_enrollment" value="no"> no
                                            </td>
                                            @endhasrole
                                        </tr>
                                        <tr>
                                            <td>
                                                6. Faculty Course load (table 4.2 a 4.2 b: No. of courses taught) = {{@$total_courses}}
                                            </td>
                                            <td>
                                                {!! @$nbeac_criteria->course_load !!}
                                            </td>
                                            @hasrole('NBEACAdmin')

                                            <td>
                                                <input type="radio" name="eligibility_load" value="yes"> yes
                                                <input type="radio" name="eligibility_load" value="no"> no
                                            </td>
                                            @endhasrole
                                        </tr>

                                        <tr>
                                            <td>
                                                7. Research Output last three years (Table 5.1 summary of research output)<br><br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table  class="table table-bordered table-stripped">
                                                            <thead>
                                                            <tr>
                                                                <th>Year</th>
                                                                <th>Total Items</th>
                                                                <th>Contributing Core Faculty</th>
                                                                <th>Jointly Produced Other</th>
                                                                <th>Jointly Produced Same</th>
                                                                <th>Jointly Produced Multiple</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($summaries as $summary)
                                                                <tr>
                                                                    <td>{{$summary->year}}</td>
                                                                    <td>{{$summary->total_items}}</td>
                                                                    <td>{{$summary->contributing_core_faculty}}</td>
                                                                    <td>{{$summary->jointly_produced_other}}</td>
                                                                    <td>{{$summary->jointly_produced_same}}</td>
                                                                    <td>{{$summary->jointly_produced_multiple}}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>

                                                    </div>

                                                </div>
                                            </td>
                                            <td>
                                                {!! @$nbeac_criteria->research_output !!}
                                            </td>
                                            @hasrole('NBEACAdmin')
                                            <td>
                                                <input type="radio" name="eligibility_output" value="yes"> yes
                                                <input type="radio" name="eligibility_output" value="no"> no
                                            </td>
                                            @endhasrole
                                        </tr>

                                        <tr>
                                            <td>
                                                8. Bandwidth =  GB (table 6.2 Laboratories)= {{@$bandwidth->remark}}
                                            </td>
                                            <td>
                                                {!! @$nbeac_criteria->bandwidth !!}
                                            </td>
                                            @hasrole('NBEACAdmin')
                                            <td>
                                                <input type="radio" name="eligibility_bandwidth" value="yes"> yes
                                                <input type="radio" name="eligibility_bandwidth" value="no"> no
                                            </td>
                                            @endhasrole
                                        </tr>

                                        <tr>
                                            <td>
                                                9. Student to Computer ratio is 	 (table 6.2 Laboratories)
                                            </td>

                                            <td>{!! $nbeac_criteria->std_comp_ratio !!}</td>
                                            @hasrole('NBEACAdmin')
                                            <td>
                                                <input type="radio" name="eligibility_ratio" value="yes"> yes
                                                <input type="radio" name="eligibility_ratio" value="no"> no
                                            </td>
                                            @endhasrole
                                        </tr>
                                    </tbody>
                                </table>


                                @hasrole('NBEACAdmin')
                                <div class="col-md-12">
                                    <div class="col-md-12 form-group pull-right" style="margin-top: 40px">
                                        <label for="sector">Comments</label>
                                        <textarea rows="5" name="comments" id="comments" class="form-control">{{old('comments')}}</textarea>
                                    </div>
                                </div>
                                @endhasrole
                                @hasrole('NBEACAdmin')
                                <div class="col-md-12">
                                    <div class="form-group pull-right" style="margin-top: 40px">
                                        <label for="sector">&nbsp;&nbsp;</label>
                                        <input type="submit" name="add" id="add" value="Add" class="btn btn-info">
                                    </div>
                                </div>
@endhasrole

                            </form>

                        </div>
                        <!-- /.box-body -->
                        <!-- /.box -->
                    </div>
                    <!-- .box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Business School Facilities Table.</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>

                                    <th>Business School</th>
                                    <th>Department</th>
                                    <th>Comments</th>
                                    <th>isEligible</th>
                                    @hasrole('NBEACAdmin')<th>Status</th>@endhasrole
                                    @hasrole('NBEACAdmin')<th>Action</th>@endhasrole
                                </tr>
                                </thead>
                                <tbody>
                                @if(@$desk_reviews)
                                   @foreach(@$desk_reviews as $review)
                                <tr>
                                    <td>{{$review->school}}</td>
                                    <td>{{$review->department}}</td>
                                    <td>{{$review->comments}}</td>
                                    <td><i class="badge {{$review->isEligible == 'yes'?'bg-green':'bg-red'}}">{{$review->isEligible == 'yes'?'Yes':'No'}}</i></td>
                                    @hasrole('NBEACAdmin')<td><i class="badge {{$review->status == 'active'?'bg-green':'bg-red'}}">{{$review->status == 'active'?'Active':'Inactive'}}</i></td>@endhasrole
                                    @hasrole('NBEACAdmin')<td>
                                        @if($review->isEligible === 'yes')<span data-toggle="tooltip" title="" class="badge bg-yellow ForwardToES" data-original-title="Forward to Eligibility Screening" data-id="{{$review->id}}"><i class="fa fa-check-square-o text-white"></i></span>|@endif
                                        <i class="fa fa-trash text-info delete" data-id="{{$review->id}}"></i> |
                                        <i data-row='{"id":{{$review->id}},"facility_id":"{{$review->department}}","isChecked":"{{$review->isEligible}}","status":"{{$review->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i></td>@endhasrole
                                </tr>
                                @endforeach
                                @endif

                                </tbody>
                                <tfoot>
                                <tr>

                                    <th>Business School</th>
                                    <th>Department</th>
                                    <th>Comments</th>
                                    <th>isEligible</th>
                                    @hasrole('NBEACAdmin')<th>Status</th>@endhasrole
                                    @hasrole('NBEACAdmin')<th>Action</th>@endhasrole
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


    </div>

    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Business School Facility. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Facility</label>
                                <input type="text" readonly name="facility_id" id="edit_facility_id" value="{{old('edit_facility_id')}}" class="form-control">
                            </div>
                            <input type="hidden" id="edit_id">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">{{ __('isChecked') }} : </label>
                                <p><input type="radio" name="isChecked" class="flat-red" value="yes" > Yes
                                    <input type="radio" name="isChecked" class="flat-red" value="no">No</p>
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

        $('#add').on('click', function (e) {
            // let radioVal = $('input:radio:checked').map(function(i, el){return {"id":$(el).data('id'),"value":$(el).val()};}).get();
            //console.log('submit button clicked', $('input:radio:checked'));
            //return;
            var values = [];
            // $('input:radio:checked').map(function(index, val) {
            //   console.log('submit button clicked values', val['name']);
            //  // let indexName = val['name'];
            //   val['name'] ==='eligibility_program'? values['eligibility_program']=$(val).val():'';
            //   val['name'] ==='eligibility_mission'? values['eligibility_mission']=$(val).val():'';
            //   val['name'] ==='eligibility_plan'? values['eligibility_plan']=$(val).val():'';
            //   val['name'] ==='eligibility_student'? values['eligibility_student']=$(val).val():'';
            //   val['name'] ==='eligibility_enrollment'? values['eligibility_enrollment']=$(val).val():'';
            //   val['name'] ==='eligibility_load'? values['eligibility_load']=$(val).val():'';
            //   val['name'] ==='eligibility_output'? values['eligibility_output']=$(val).val():'';
            //   val['name'] ==='eligibility_bandwidth'? values['eligibility_bandwidth']=$(val).val():'';
            //   val['name'] ==='eligibility_ratio'? values['eligibility_ratio']=$(val).val():'';
            //          // return { indexName :$(val).val() };
            //         });

            let eligibility_program = $('input[name="eligibility_program"]:checked').val();
            let eligibility_mission = $('input[name="eligibility_mission"]:checked').val();
            let eligibility_plan = $('input[name="eligibility_plan"]:checked').val();
            let eligibility_student = $('input[name="eligibility_student"]:checked').val();
            let eligibility_enrollment = $('input[name="eligibility_enrollment"]:checked').val();
            let eligibility_load = $('input[name="eligibility_load"]:checked').val();
            let eligibility_output = $('input[name="eligibility_output"]:checked').val();
            let eligibility_bandwidth = $('input[name="eligibility_bandwidth"]:checked').val();
            let eligibility_ratio = $('input[name="eligibility_ratio"]:checked').val();
            let comments = $('#comments').val();
            console.log('eligibility_program values.........', eligibility_program);
            // let check = $('input[type="radio"]:checked');
            // console.log('check here',  check);
            //  if(!check)
            //  {
            //      Notiflix.Notify.Warning("Fill all the required Fields.");
            //      return;
            //  }
            //return;
            $.ajax({
                url:'{{url("desk-review")}}',
                type:'POST',
                data: {eligibility_program:eligibility_program,
                    eligibility_mission:eligibility_mission,
                    eligibility_plan:eligibility_plan,
                    eligibility_student:eligibility_student,
                    eligibility_enrollment:eligibility_enrollment,
                    eligibility_load:eligibility_load,
                    eligibility_output:eligibility_output,
                    eligibility_bandwidth:eligibility_bandwidth,
                    eligibility_ratio:eligibility_ratio,
                    comments:comments,
                    id: {{Request::segment(2)}}
                },
                // cache:false,
                // contentType:false,
                // processData:false,
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
                    //location.reload();
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
            // let data = JSON.parse(JSON.stringify($(this).data('row')));
            let data = JSON.parse(JSON.stringify($(this).data('row')));
            $('#edit_facility_id').val(data.facility_id);
            $('#edit_id').val(data.id);
            $('input[value='+data.isChecked+']').iCheck('check');
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#updateForm').submit(function (e) {
            let id = $('#edit_id').val();
            let isChecked = $('input[name=edit_isChecked]:checked').val();
            let status = $('input[name=edit_status]:checked').val();


            e.preventDefault();
            var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("business-school-facility")}}/'+id,
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
                        url:'{{url("business-school-facility")}}/'+id,
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

        $('.ForwardToES').on('click', function (e) {
            var id = $(this).data('id');

            Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to forward the case to Eligibility Screening?', 'Yes', 'No',
                function(){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    // Yes button callback
                    $.ajax({
                        url:'{{url("deskreviewStatus")}}',
                        type:'post',
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

                            //location.reload();

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

    </script>

@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
