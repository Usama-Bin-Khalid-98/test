@section('pageTitle', 'Nbeac Criteria')
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
                Nbeac Criteria
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active">Nbeac Criteria</li>
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

        <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Nbeac Criteria
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <form>
            <div class="box-body pad">
                     <label>Program Started</label>
                    <textarea id="program_started" name="program_started" rows="10" cols="80">
                        {{@$nbeac_criteria->program_started}}
                    </textarea>


                    <input type="hidden" id="id" value="{{@$nbeac_criteria->id}}">
              
            </div>
            <div class="box-body pad">
              <label>Mission Vision Statement</label>
                    <textarea id="mission_vision_statement" name="mission_vision_statement" rows="10" cols="80">
                                {{@$nbeac_criteria->mission_vision_statement}}
                    </textarea>
             
            </div>
            <div class="box-body pad">
              <label>Strategic Plan</label>
                    <textarea id="strategic_plan" name="strategic_plan" rows="10" cols="80">
                        {{@$nbeac_criteria->strategic_plan}}

                    </textarea>
             
            </div>
            <div class="box-body pad">
             <label>Student Intake</label>
                    <textarea id="student_intake" name="student_intake" rows="10" cols="80">                
                           {{@$nbeac_criteria->student_intake}}
                    </textarea>
              
            </div>
            <div class="box-body pad">
              <label>Student Enrollment</label>
                    <textarea id="student_enrollment" name="student_enrollment" rows="10" cols="80">
                        {{@$nbeac_criteria->student_enrollment}}
                    </textarea>
             
            </div>
            <div class="box-body pad">
              <label>Course Load</label>
                    <textarea id="course_load" name="course_load" rows="10" cols="80">
                        {{@$nbeac_criteria->course_load}}
                    </textarea>
              
            </div>
            <div class="box-body pad">
              <label>Research Output</label>
                    <textarea id="research_output" name="research_output" rows="10" cols="80">
                                {{@$nbeac_criteria->research_output}}           
                    </textarea>
                    
             
            </div>
            <div class="box-body pad">
             <label>Bandwidth</label>
                    <textarea id="bandwidth" name="bandwidth" rows="10" cols="80">
                                          {{@$nbeac_criteria->bandwidth}}
                    </textarea>
                    
              
            </div>
            <div class="box-body pad">
            <label>Student to Comp Ratio</label>
                    <textarea id="std_comp_ratio" name="std_comp_ratio" rows="10" cols="80">
                                           {{@$nbeac_criteria->std_comp_ratio}}
                    </textarea>
                    
              
              <div class="col-md-12">
                                    <div class="form-group pull-right" style="margin-top: 40px">
                                        <label for="sector">&nbsp;&nbsp;</label>
                                        <input type="button" name="update" id="update" value="Update" class="btn btn-info">
                                    </div>
                                </div>
            </div>
          </div>
          <!-- /.box -->

          
        </div>
    </form>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
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
    <script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('program_started');
    CKEDITOR.replace('mission_vision_statement');
    CKEDITOR.replace('strategic_plan');
    CKEDITOR.replace('student_intake');
    CKEDITOR.replace('student_enrollment');
    CKEDITOR.replace('course_load');
    CKEDITOR.replace('research_output');
    CKEDITOR.replace('bandwidth');
    CKEDITOR.replace('std_comp_ratio');
  })
</script>
    <script type="text/javascript">

        $('.select2').select2()

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
$('#update').on('click', function (e) {
            let id = $('#id').val();
            let program_started = CKEDITOR.instances.program_started.getData();
            let mission_vision_statement = CKEDITOR.instances.mission_vision_statement.getData();
            let strategic_plan = CKEDITOR.instances.strategic_plan.getData();
            let student_intake = CKEDITOR.instances.student_intake.getData();
            let student_enrollment = CKEDITOR.instances.student_enrollment.getData();
            let course_load = CKEDITOR.instances.course_load.getData();
            let research_output = CKEDITOR.instances.research_output.getData();
            let bandwidth = CKEDITOR.instances.bandwidth.getData();
            let std_comp_ratio = CKEDITOR.instances.std_comp_ratio.getData();

            
             !program_started?addClass('program_started'):removeClass('program_started');
             !mission_vision_statement?addClass('mission_vision_statement'):removeClass('mission_vision_statement');
             !strategic_plan?addClass('strategic_plan'):removeClass('strategic_plan');
             !student_intake?addClass('student_intake'):removeClass('student_intake');
             !student_enrollment?addClass('student_enrollment'):removeClass('student_enrollment');
             !course_load?addClass('course_load'):removeClass('course_load');
             !research_output?addClass('research_output'):removeClass('research_output');
             !bandwidth?addClass('bandwidth'):removeClass('bandwidth');
             !std_comp_ratio?addClass('std_comp_ratio'):removeClass('std_comp_ratio');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'PUT',
                url: "{{url('nbeac-criteria')}}/"+id,
                data: {
                    id: id,
                    program_started: program_started,
                    mission_vision_statement: mission_vision_statement,
                    strategic_plan: strategic_plan,
                    student_intake: student_intake,
                    student_enrollment: student_enrollment,
                    course_load: course_load,
                    research_output: research_output,
                    bandwidth: bandwidth,
                    std_comp_ratio: std_comp_ratio,
                },
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
                    console.log('response here', response);
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

    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
