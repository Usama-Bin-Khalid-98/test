@section('pageTitle', 'Admission Office')


@if(Auth::user())

    @include("../includes.head")
    <!-- Select2 -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{URL::asset('plugins/iCheck/all.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />
    @include("../includes.header")
    @include("../includes.nav")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               Admission Office
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Admission Office </li>
            </ol>
        </section>
        <section class="content-header">
            <div class="col-md-12 new-button">
                <div class="pull-right">
                    <button class="btn gradient-bg-color"
                           data-toggle="modal" data-target="#add-modal"
                           style="color: white;"
                           value="Add New"
                            name="add" id="add">PDF <i class="fa fa-file-pdf-o"></i></button>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">9.1   Provide basic information about the admission and examination offices in Table 9.1. Attach the organizational structure of examination and admission offices as Appendix- 9A.</h3>
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
                        <form action="javascript:void(0)" id="form" method="POST">
                        <div class="box-body">
                                <table class="table table-bordered ">
                                    <thead>
                                        <th>Particulars</th>
                                        <th>Admission office</th>
                                        <th>Examination office</th>
                                    </thead>
                                <tbody>
                                <tr>
                                    <td>h) Hierarchical Position</td>
                                     <td>
                                        <input type="radio" value="Centralized"  name="hierarchical_position" class="flat-red" {{ @$admission_office->hierarchical_position == 'Centralized' ? 'checked' : '' }} > <span>Centralized</span>
                                             <input type="radio" value="dedicated to business school"  name="hierarchical_position" class="flat-red" {{ @$admission_office->hierarchical_position == 'dedicated to business school' ? 'checked' : '' }} > <span>Dedicated to business school</span>
                                      </td>
                                      <td>
                                        <input type="radio" value="Centralized"  name="hierarchical_positionb"  {{ @$admission_office->hierarchical_position == 'Centralized' ? 'checked' : '' }} class="flat-red" > <span>Centralized</span>
                                             <input type="radio" value="dedicated to business school"  name="hierarchical_positionb" class="flat-red" {{ @$admission_office->hierarchical_position == 'dedicated to business school' ? 'checked' : '' }}> <span>Dedicated to business school</span>
                                      </td>

                                    <input type="hidden" id="id" value="{{@$admission_office->id}}">
                                </tr>
                                <tr>
                                    <td>i) System handling</td>
                                    <td>
                                        <input type="radio" value="Manual"  name="system_handling"  class="flat-red" {{ @$admission_office->system_handling == 'Manual' ? 'checked' : '' }} > <span>Manual</span>
                                             <input type="radio" value="Automated"  name="system_handling"  class="flat-red" {{ @$admission_office->system_handling == 'Automated' ? 'checked' : '' }} > <span>Automated</span>
                                      </td>
                                      <td>
                                        <input type="radio" value="Manual"  name="system_handlingb"  class="flat-red" {{ @$admission_office->system_handling == 'Manual' ? 'checked' : '' }} > <span>Manual</span>
                                             <input type="radio" value="Automated"  name="system_handlingb"  class="flat-red" {{ @$admission_office->system_handling == 'Automated' ? 'checked' : '' }} > <span>Automated</span>
                                      </td>
                                </tr>
                                <tr>
                                    <td>j) Name and designation of head/supervisor</td>
                                    <td>
                                        <input type="textval" id="head" name="head" value="{{@$admission_office->head}}"  class="form-control">
                                    </td>
                                    <td>
                                        <input type="textval" id="headb" name="headb" value="{{@$admission_office->headb}}"  class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>k) Qualification of Head/Supervisor</td>
                                    <td>
                                        <input type="textval" id="qualification" name="qualification" value="{{@$admission_office->qualification}}"  class="form-control">
                                    </td>
                                    <td>
                                        <input type="textval" id="qualificationb" name="qualificationb" value="{{@$admission_office->qualificationb}}"  class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>l) Total number of staff members</td>
                                    <td>
                                        <input type="textval" id="total_staff" name="total_staff" value="{{@$admission_office->total_staff}}"  class="form-control">
                                    </td>
                                    <td>
                                        <input type="textval" id="total_staffb" name="total_staffb" value="{{@$admission_office->total_staffb}}"  class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>m) Resources available

                                       <tr>
                                           <td>Number of printers</td>
                                           <td><input type="textval" id="printers" name="printers" value="{{@$admission_office->printers}}"  class="form-control"></td>
                                           <td><input type="textval" id="printersb" name="printersb" value="{{@$admission_office->printersb}}"  class="form-control"></td>
                                       </tr>
                                       <tr>
                                           <td>Number of photocopiers</td>
                                           <td><input type="textval" id="photocopiers" name="photocopiers" value="{{@$admission_office->photocopiers}}"  class="form-control"></td>
                                           <td><input type="textval" id="photocopiersb" name="photocopiersb" value="{{@$admission_office->photocopiersb}}"  class="form-control"></td>
                                       </tr>
                                       <tr>
                                           <td>Number of secure caninets</td>
                                           <td><input type="textval" id="secure_cabinets" name="secure_cabinets" value="{{@$admission_office->secure_cabinets}}"  class="form-control"></td>
                                           <td><input type="textval" id="secure_cabinetsb" name="secure_cabinetsb" value="{{@$admission_office->secure_cabinetsb}}"  class="form-control"></td>
                                       </tr>

                                    </td>
                                </tr>


                                </tbody>
                            </table><br><br>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Attach Doc</label>
                                    <input type="file" name="file" id="file" >
                                    <span class="text-red">Max upload file size 2mb.</span>
                                    <span><a href="{{url($admission_office->file)}}"><i class="fa fa-file-word-o"></i></a></span>
                                </div>
                            </div>
                                <div class="col-md-12">
                                    <div class="form-group pull-right" style="margin-top: 40px">
                                        <label for="sector">&nbsp;&nbsp;</label>
                                        <input type="submit" name="update" id="update" value="Update" class="btn btn-info">
                                    </div>
                                </div>
                        </div>
                        <!-- /.box-body -->
                        </form>
                    </div>
                    <!-- /.box -->
                </div>

                <!-- Main content -->
            </div>
        </section>
    </div>
    <!-- /.modal -->
    <script src="{{URL::asset('notiflix/notiflix-2.3.2.min.js')}}"></script>
    @include("../includes.footer")
    <!-- /.modal -->
    <script src="{{URL::asset('plugins/iCheck/icheck.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{URL::asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>

    <script type="text/javascript">

        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })
        $('.select2').select2()

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        <?php if(@$admission_office->id==null){ ?>

         $('#form').submit(function (e)  {

            let hierarchical_position = $('input[name=hierarchical_position]:checked').val();
            let system_handling = $('input[name=system_handling]:checked').val();
            let head = $('#head').val();
            let qualification = $('#qualification').val();
            let total_staff = $('#total_staff').val();
            let printers = $('#printers').val();
            let photocopiers = $('#photocopiers').val();
            let secure_cabinets = $('#secure_cabinets').val();
            let hierarchical_positionb = $('input[name=hierarchical_positionb]:checked').val();
            let system_handlingb = $('input[name=system_handlingb]:checked').val();
            let headb = $('#headb').val();
            let qualificationb = $('#qualificationb').val();
            let total_staffb = $('#total_staffb').val();
            let printersb = $('#printersb').val();
            let photocopiersb = $('#photocopiersb').val();
            let secure_cabinetsb = $('#secure_cabinetsb').val();
            let file = $('#file').val();

             !hierarchical_position?addClass('hierarchical_position'):removeClass('hierarchical_position');
             !system_handling?addClass('system_handling'):removeClass('system_handling');
             !head?addClass('head'):removeClass('head');
             !qualification?addClass('qualification'):removeClass('qualification');
             !total_staff?addClass('total_staff'):removeClass('total_staff');
             !printers?addClass('printers'):removeClass('printers');
             !photocopiers?addClass('photocopiers'):removeClass('photocopiers');
             !secure_cabinets?addClass('secure_cabinets'):removeClass('secure_cabinets');
             !hierarchical_positionb?addClass('hierarchical_positionb'):removeClass('hierarchical_positionb');
             !system_handlingb?addClass('system_handlingb'):removeClass('system_handlingb');
             !headb?addClass('headb'):removeClass('headb');
             !qualificationb?addClass('qualificationb'):removeClass('qualificationb');
             !total_staffb?addClass('total_staffb'):removeClass('total_staffb');
             !printersb?addClass('printersb'):removeClass('printersb');
             !photocopiersb?addClass('photocopiersb'):removeClass('photocopiersb');
             !secure_cabinetsb?addClass('secure_cabinetsb'):removeClass('secure_cabinetsb');
             !file?addClass('file'):removeClass('file');

            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("admission-office")}}',
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

   <?php  }else{ ?>

    $('#update').on('click', function (e) {

            let hierarchical_position = $('input[name=hierarchical_position]:checked').val();
            let system_handling = $('input[name=system_handling]:checked').val();
            let head = $('#head').val();
            let qualification = $('#qualification').val();
            let total_staff = $('#total_staff').val();
            let printers = $('#printers').val();
            let photocopiers = $('#photocopiers').val();
            let secure_cabinets = $('#secure_cabinets').val();
            let hierarchical_positionb = $('input[name=hierarchical_positionb]:checked').val();
            let system_handlingb = $('input[name=system_handlingb]:checked').val();
            let headb = $('#headb').val();
            let qualificationb = $('#qualificationb').val();
            let total_staffb = $('#total_staffb').val();
            let printersb = $('#printersb').val();
            let photocopiersb = $('#photocopiersb').val();
            let secure_cabinetsb = $('#secure_cabinetsb').val();
            let id = $('#id').val();

             !hierarchical_position?addClass('hierarchical_position'):removeClass('hierarchical_position');
             !system_handling?addClass('system_handling'):removeClass('system_handling');
             !head?addClass('head'):removeClass('head');
             !qualification?addClass('qualification'):removeClass('qualification');
             !total_staff?addClass('total_staff'):removeClass('total_staff');
             !printers?addClass('printers'):removeClass('printers');
             !photocopiers?addClass('photocopiers'):removeClass('photocopiers');
             !secure_cabinets?addClass('secure_cabinets'):removeClass('secure_cabinets');
             !hierarchical_positionb?addClass('hierarchical_positionb'):removeClass('hierarchical_positionb');
             !system_handlingb?addClass('system_handlingb'):removeClass('system_handlingb');
             !headb?addClass('headb'):removeClass('headb');
             !qualificationb?addClass('qualificationb'):removeClass('qualificationb');
             !total_staffb?addClass('total_staffb'):removeClass('total_staffb');
             !printersb?addClass('printersb'):removeClass('printersb');
             !photocopiersb?addClass('photocopiersb'):removeClass('photocopiersb');
             !secure_cabinetsb?addClass('secure_cabinetsb'):removeClass('secure_cabinetsb');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'PUT',
                url: "{{url('admission-office')}}/"+id,
                data: {
                    id: id,
                    hierarchical_position: hierarchical_position,
                    system_handling: system_handling,
                    head: head,
                    qualification: qualification,
                    total_staff: total_staff,
                    printers: printers,
                    photocopiers: photocopiers,
                    secure_cabinets: secure_cabinets,
                    hierarchical_positionb: hierarchical_positionb,
                    system_handlingb: system_handlingb,
                    headb: headb,
                    qualificationb: qualificationb,
                    total_staffb: total_staffb,
                    printersb: printersb,
                    photocopiersb: photocopiersb,
                    secure_cabinetsb: secure_cabinetsb,
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

   <?php  } ?>

    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
