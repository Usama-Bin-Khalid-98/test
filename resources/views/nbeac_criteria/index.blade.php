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
              
                    <textarea id="editor1" name="editor1" rows="10" cols="80">
                        {{@$nbeac_criteria->program_started}}
                    </textarea>


                    <input type="hidden" id="id" value="{{@$nbeac_criteria->id}}">
              
            </div>
            <div class="box-body pad">
              
                    <textarea id="editor2" name="editor2" rows="10" cols="80">
                                {{@$nbeac_criteria->mission_vision_statement}}
                    </textarea>
             
            </div>
            <div class="box-body pad">
              
                    <textarea id="editor3" name="editor3" rows="10" cols="80">
                        {{@$nbeac_criteria->strategic_plan}}

                    </textarea>
             
            </div>
            <div class="box-body pad">
             
                    <textarea id="editor4" name="editor4" rows="10" cols="80">                
                           {{@$nbeac_criteria->student_intake}}
                    </textarea>
              
            </div>
            <div class="box-body pad">
              
                    <textarea id="editor5" name="editor5" rows="10" cols="80">
                        {{@$nbeac_criteria->student_enrollment}}
                    </textarea>
             
            </div>
            <div class="box-body pad">
              
                    <textarea id="editor6" name="editor6" rows="10" cols="80">
                        {{@$nbeac_criteria->course_load}}
                    </textarea>
              
            </div>
            <div class="box-body pad">
              
                    <textarea id="editor7" name="editor7" rows="10" cols="80">
                                {{@$nbeac_criteria->research_output}}           
                    </textarea>
                    
             
            </div>
            <div class="box-body pad">
             
                    <textarea id="editor8" name="editor8" rows="10" cols="80">
                                          {{@$nbeac_criteria->bandwidth}}
                    </textarea>
                    
              
            </div>
            <div class="box-body pad">
            
                    <textarea id="editor9" name="editor9" rows="10" cols="80">
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
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor2');
    CKEDITOR.replace('editor3');
    CKEDITOR.replace('editor4');
    CKEDITOR.replace('editor5');
    CKEDITOR.replace('editor6');
    CKEDITOR.replace('editor7');
    CKEDITOR.replace('editor8');
    CKEDITOR.replace('editor9');
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
            let editor1 = CKEDITOR.instances.editor1.getData();
            let editor2 = CKEDITOR.instances.editor2.getData();
            let editor3 = CKEDITOR.instances.editor3.getData();
            let editor4 = CKEDITOR.instances.editor4.getData();
            let editor5 = CKEDITOR.instances.editor5.getData();
            let editor6 = CKEDITOR.instances.editor6.getData();
            let editor7 = CKEDITOR.instances.editor7.getData();
            let editor8 = CKEDITOR.instances.editor8.getData();
            let editor9 = CKEDITOR.instances.editor9.getData();

            
             !editor1?addClass('editor1'):removeClass('editor1');
             !editor2?addClass('editor2'):removeClass('editor2');
             !editor3?addClass('editor3'):removeClass('editor3');
             !editor4?addClass('editor4'):removeClass('editor4');
             !editor5?addClass('editor5'):removeClass('editor5');
             !editor6?addClass('editor6'):removeClass('editor6');
             !editor7?addClass('editor7'):removeClass('editor7');
             !editor8?addClass('editor8'):removeClass('editor8');
             !editor9?addClass('editor9'):removeClass('editor9');

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
                    editor1: editor1,
                    editor2: editor2,
                    editor3: editor3,
                    editor4: editor4,
                    editor5: editor5,
                    editor6: editor6,
                    editor7: editor7,
                    editor8: editor8,
                    editor9: editor9,
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
