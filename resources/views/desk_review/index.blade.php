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
                                        <th style="width: 10%">Is Eligible</th>
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
                                            <strong>At least 3 batches of the degree should have passed to consider the program for accreditation.</strong>
                                            <ol type="i">
                                                <li>BBA after 5.5 years of program started</li>
                                                <li>MBA 1.5 after 2.5 years of program started</li>
                                                <li>MBA 2.5 after 3.5 years of program started</li>
                                                <li>MBA 3.5 after 5 years of program started.</li>
                                            </ol>
                                        </td>
                                        <td>
                                            <input type="radio" name="eligibility_program" value="yes"> yes
                                            <input type="radio" name="eligibility_program" value="no"> no
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><strong>Mission : </strong> {{@$mission_vision->mission}}</p>

                                            <p><strong>Vision : </strong> {{@$mission_vision->vision}}</p>

                                        </td>
                                        <td>
                                            Vision and mission should exist, realistic and shared among the all stake holders. Mission statement of business school is clear, current and aligned with its vision statement.
                                            There should be documentary evidence that vision and mission are approved by any statutory body.
                                            The vision and mission should be displayed on the Department's webpage. There should be synchronization between both versions i.e.  Presented to NBEAC and displayed on website.

                                        </td>
                                        <td>
                                            <input type="radio" name="eligibility_mission" value="yes"> yes
                                            <input type="radio" name="eligibility_mission" value="no"> no
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <p>3. Strategic Plan (Question 1.8)</p>
                                            <p>Approval Date {{@$strategic_plan->aproval_date}}  Difference( {{@$strategic_date_diff}} )</p>
                                        </td>
                                        <td>
                                            Strategic Plan should exist for 03-05 years
                                        </td>
                                        <td>
                                            <input type="radio" name="eligibility_plan" value="yes"> yes
                                            <input type="radio" name="eligibility_plan" value="no"> no
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>4. Student Intake(Table 2.3)</p>
                                            <p>Student Intake {{@$application_received->student_intake}}</p>
                                        </td>
                                        <td> Student Intake(Table 2.3) </td>
                                        <td>
                                            <input type="radio" name="eligibility_student" value="yes"> yes
                                            <input type="radio" name="eligibility_student" value="no"> no
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong>1.	Student enrollment</strong>
                                           <strong> a)	Total Annual Enrollment Table (3.1)</strong>
                                            @foreach(@$student_enrolment as $enrollment)
                                           <p> Year {{$enrollment->year}}	16 years programs {{$enrollment->bs_level}}</p>
                                           <p> Year {{$enrollment->year}}	18 years programs {{$enrollment->ms_level}}</p>
                                           <p> Year {{$enrollment->year}}   Doctoral programs {{$enrollment->ms_level}}</p>
                                            @endforeach

                                           <strong> a)	Graduated Students</strong>

                                            @foreach($graduated_students as $graduated)
                                                <p> Program {{$graduated->program->name}} </p>
                                                <p> Year t {{$graduated->grad_std_t}} </p>
                                                <p> Year t-1 {{$graduated->grad_std_t_2}} </p>
                                                <p> Year t-2 {{$graduated->grad_std_t_3}} </p>

                                            @endforeach

                                           <strong> b)	Faculty Portfolio (Section 4)</strong>

                                           <p> c)	Total Fulltime Faculty = (Table 4.1)</p>
                                           <p> d)	Full professors (Table 4.3 a: designation)</p>
                                           <p> e)	Associate professors (Table 4.3 a: designation)</p>
                                           <p> f)	Assistant professors (Table 4.3 a: designation)</p>
                                           <p> g)	Lecturers(Table 4.3 a: designation)</p>
                                           <p> h)	Other (Table 4.3 a: designation)</p>
                                           <p> i)	% of female permanent / regular faculty (table 4.6)</p>
                                           <p> j)	% holding a doctoral degree (Table 4.1: No. of PhDs)</p>
                                           <p> k)	Total number of permanent faculty (Table 4.3 a Faculty type)</p>
                                           <p> l)	Total number of adjunct faculty (Table 4.3 a Faculty type)</p>
                                           <p> m)	Full-time equivalent (Table 4.3a FTE for the permanent, regular and adjunct faculty in program(s))</p>
                                           <p> n)	Visiting Faculty Equivalent (Table 4.3b Visiting Faculty Equivalent (VFE) in program(s))</p>
                                           <p> o)	Student to teacher ratio: (Total enrollment (B)/(Total FTE (C)+Total VFE(D)) (Table 4.4)</p>
                                           <p> BBA (program1) =</p>
                                           <p> MBA (program2) =</p>
                                           <p> p)	Permanent / regular faculty hired in last 3 years (FTE) (Table 4.5: Induction)</p>
                                           <p> q)	Permanent/ regular faculty departed in last 3 years (FTE) (table 4.5: resigned + terminated+ retired)</p>
                                           <p> r)	FT:PT (as per table 4.3 a 4.3 b)=</p>
                                           <p> s)	No. of faculty with terminal degree from foreign institutions</p>
                                           <p> t)	No. of faculty with terminal degree from domestic institutions</p>
                                           <p> u)	No. of faculty with international work experience</p>
                                           <p> v)	Teaching and research assistants  - on short-term contracts- (Others in Table 4.1)</p>

                                        </td>
                                        <td>
                                            <strong>Class Size:</strong>
                                            <ol type="i">
                                                <li>Undergraduate/ semester: 20-55 students</li>
                                                <li>Graduates/semester: 15-45 students</li>
                                            </ol>
                                            <p>There should be minimum of 15 full time faculty members related to Management Sciences/ Business Administration field. (condition for Table 4.1)
                                                Preferably, there should be 03 faculty members at Prof/Associate Prof level, however, minimum 02 Associate Professors and 03 at Assistant Professors are required to become eligible for accreditation process. (Condition for Table 4.3a)</p>

                                            <p>Faculty Diversity(In breeding)	Less Than 25%</p>
                                            <p>International Exposure of the faculty	20%</p>
                                            <p>FT:PT= 70:30 (Condition for table 4.4.)</p>
                                            <p>Student to Teacher Ratio=25:1 (undergraduate) 20:1 (graduate)
                                            (Condition for Table 4.4.)</p>

                                        </td>
                                        <td>
                                            <input type="radio" name="eligibility_enrollment" value="yes"> yes
                                            <input type="radio" name="eligibility_enrollment" value="no"> no
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            6. Faculty Course load (table 4.2 a 4.2 b: No. of courses taught)
                                        </td>
                                        <td>
                                            <strong>Following is the recommended Course load</strong>
                                            Lecturer= 3-4 per semester/ 6-8 per annum
                                            Assistant Professor= 3 per semester/6 per annum
                                            Associate Professor/ Professor=2-3 per semester/4-6 per annum
                                        </td>
                                        <td>
                                            <input type="radio" name="eligibility_load" value="yes"> yes
                                            <input type="radio" name="eligibility_load" value="no"> no
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            7. Research Output last three years (Table 5.1 summary of research output)
                                        </td>
                                        <td>
                                            Following is the recommended Course load
                                        </td>
                                        <td>
                                            <input type="radio" name="eligibility_output" value="yes"> yes
                                            <input type="radio" name="eligibility_output" value="no"> no
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            8. Bandwidth =  GB (table 6.2 Laboratories)
                                        </td>
                                        <td>
                                            Bandwidth Internet service (desirable) = 1 MB access rate
                                            Student to Computer ratio: 1:20
                                        </td>
                                        <td>
                                            <input type="radio" name="eligibility_bandwidth" value="yes"> yes
                                            <input type="radio" name="eligibility_bandwidth" value="no"> no
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            9. Student to Computer ratio is 	 (table 6.2 Laboratories)
                                        </td>
                                        <td>Student to Computer ratio: 1:20</td>
                                        <td>
                                            <input type="radio" name="eligibility_ratio" value="yes"> yes
                                            <input type="radio" name="eligibility_ratio" value="no"> no
                                        </td>
                                    </tr>
                                 </ol>
                                </tbody>
                            </table>

                             <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" id="add" value="Update" class="btn btn-info">
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
                            <h3 class="box-title">Business School Facilities Table.</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>

                                    <th>Business School Facilities</th>
                                    <th>isChecked</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

{{--                                   @foreach($facilitiess as $summary)--}}
{{--                                <tr>--}}
{{--                                    <td>{{$summary->facility->name}}</td>--}}
{{--                                    <td><i class="badge {{$summary->isChecked == 'yes'?'bg-green':'bg-red'}}">{{$summary->isChecked == 'yes'?'Yes':'No'}}</i></td>--}}
{{--                                    <td><i class="badge {{$summary->status == 'active'?'bg-green':'bg-red'}}">{{$summary->status == 'active'?'Active':'Inactive'}}</i></td>--}}
{{--                                    <td><i class="fa fa-trash text-info delete" data-id="{{$summary->id}}"></i> | <i data-row='{"id":{{$summary->id}},"facility_id":"{{$summary->facility->name}}","isChecked":"{{$summary->isChecked}}","status":"{{$summary->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i></td>--}}
{{--                                </tr>--}}
{{--                                @endforeach--}}

                                </tbody>
                                <tfoot>
                                <tr>

                                    <th>Business School Facilities</th>
                                    <th>isChecked</th>
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
                                    <input type="radio" name="isChecked" class="flat-red" value="no"> noNo</p>
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

         $('#form').submit(function (e) {
             // let radioVal = $('input:radio:checked').map(function(i, el){return {"id":$(el).data('id'),"value":$(el).val()};}).get();
             console.log('submit button clicked');
            let facility_id = $('input:radio:checked').map(function(index, val) {
                        return {"id":$(val).data('id'), "isChecked":$(val).val()};
                      }).get();

            // let data = [];
            // for( i =0; i < facility_id.length; i++)
            // {
            //    data[i].id = facility_id[i].id;
            // }
            //console.log('data facilities', data);
           // return;
             //console.log(data);
             //return ;
            // !facility_id?addClass('facility_id'):removeClass('facility_id');
            //  if(!facility_id )
            //  {
            //      Notiflix.Notify.Warning("Fill all the required Fields.");
            //      return false;
            //  }

            // let data = JSON.parse(JSON.stringify(facility_id));
            // Yes button callback
            $.ajax({
                url:'{{url("business-school-facility")}}',
                type:'POST',
                data: {"data":JSON.parse(JSON.stringify(facility_id))},
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

    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
