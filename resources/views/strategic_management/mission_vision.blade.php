@section('pageTitle', 'Mission Vision')


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
                Mission Vision
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active">Mission Vision </li>
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
                            <h3 class="box-title">1.7  State the vision and mission of the university and that of the business school. Describe the process of formation and approval of the vision and mission statements. Attached the relevant pages of the official documents as Appendix-1C.</h3>

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
                            <div class="box-body pad">
                                <label>Mission</label>
                        <textarea id="mission" name="mission" rows="10" cols="80">
                            {{@$get->mission}}
                        </textarea>
                        <input type="hidden" id="id" value="{{@$get->id}}">
                </div>
                <div class="box-body pad">
                                <label>Vision</label>
                        <textarea id="vision" name="vision" rows="10" cols="80">
                            {{@$get->vision}}
                        </textarea>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Attach Doc (Appendix-1C)</label>
                        <input type="file" name="file" id="file" >
                        <span class="text-red">Max upload file size 2mb.</span>
                         @if(@$get->file!=null)
                    <p><a href="{{url(@$get->file)}}"><i class="fa fa-file-word-o"></i></a> </p>
                    @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Mission Approval Date</label>
                        <input type="date" name="mission_approval" id="mission_approval" >
                    @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Vision Approval Date</label>
                        <input type="date" name="vision_approval" id="vision_approval" >
                    @endif
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="form-group pull-right" style="margin-top: 40px">
                        <label for="sector">&nbsp;&nbsp;</label>
                        <input type="submit" name="add" id="add" value="Submit" class="btn btn-info">
                    </div>
                </div>
            </form>

        </div>
        <!-- /.box-body -->
        <!-- /.box -->
    </div>
    <!-- .box -->

                    <!-- /.box -->
                </div>
                <!-- Main content -->


            </div>
            <!-- /.row -->

            <!-- /.row -->

            <!-- /.content -->


        </section>

    </div>

    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Strategic Plan. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">


                        <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Mission</label>
                                    <textarea rows="10" name="mission" id="edit_mission" class="form-control">{{old('edit_mission')}}</textarea>
                                </div>
                                <input type="hidden" id="edit_id">
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Vision</label>
                                    <textarea rows="10" name="vision" id="edit_vision"  class="form-control">{{old('edit_vision')}}</textarea>
                                </div>
                              </div>

                              <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Attach Doc (Appendix-1C)</label>
                                <input type="file" name="file" id="edit_file" >
                                <input type="hidden" name="old_file" id="old_file" >
                                <span class="text-blue" id="file-name"></span>
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
    <script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('mission');
    CKEDITOR.replace('vision');
  })
</script>
    <script type="text/javascript">

        $('.select2').select2()

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

         <?php if(@$get->id==null){ ?>

         $('#form').submit(function (e) {
            let mission = CKEDITOR.instances.mission.getData();
            let vision = CKEDITOR.instances.vision.getData();
            let file = $('#file').val();

            !mission?addClass('mission'):removeClass('mission');
            !vision?addClass('vision'):removeClass('vision');
            !file?addClass('file'):removeClass('file');

            if(!mission || !vision || !file)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("strategic/mission-vision")}}',
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

       <?php }else { ?>

$('#form').submit(function (e) {
             let id = $('#id').val();
            let mission = CKEDITOR.instances.mission.getData();
            let vision = CKEDITOR.instances.vision.getData();
            let file = $('#file').val();

             !mission?addClass('mission'):removeClass('mission');
             !vision?addClass('vision'):removeClass('vision');
             !file?addClass('file'):removeClass('file');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'PUT',
                url: "{{url('strategic/mission-vision')}}/"+id,
                data: {
                    id:id,
                    mission:mission,
                    vision:vision,
                    file:file,
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

<?php } ?>


    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
