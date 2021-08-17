@section('pageTitle', 'Placement Office')


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
               Placement Office
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Placement Office </li>
            </ol>
        </section>
        <section class="content-header">
            <div class="col-md-12 new-button">
                <div class="pull-right">
{{--                    <button class="btn gradient-bg-color"--}}
{{--                           data-toggle="modal" data-target="#add-modal"--}}
{{--                           style="color: white;"--}}
{{--                           value="Add New"--}}
{{--                            name="add" id="add">PDF <i class="fa fa-file-pdf-o"></i></button>--}}
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">8.1.  Provide basic information of Placement Office in Table 8.1.</h3>
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
                        <form>
                        <div class="box-body">
                                <table class="table table-bordered ">
                                <tbody>
                                <tr>
                                    <td>a) Hierarchical Position</td>
                                     <td>
                                        <input type="radio" value="At university level"  name="hierarchical_position" class="flat-red"  {{ @$placement_office->hierarchical_position == 'At university level' ? 'checked' : '' }} > <span>At university level</span>
                                             <input type="radio" value="dedicated to business school"  name="hierarchical_position" class="flat-red"  {{ @$placement_office->hierarchical_position == 'dedicated to business school' ? 'checked' : '' }} > <span>Dedicated to business school</span>
                                      </td>
                                    <input type="hidden" id="id" value="{{@$placement_office->id}}">
                                </tr>
                                <tr>
                                    <td>b) Year of establishment</td>
                                    <td>
                                        <input type="textval" id="year_establishment" name="year_establishment" value="{{@$placement_office->year_establishment}}"  class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>c) Head/supervisor of the placement office</td>
                                    <td>
                                        <input type="textval" id="head" name="head" value="{{@$placement_office->head}}"  class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>d) Head/Supervisor reports to</td>
                                    <td>
                                        <input type="textval" id="reports_to" name="reports_to" value="{{@$placement_office->reports_to}}"  class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>e) Composition of placement committee (if any)</td>
                                    <td>
                                        <input type="textval" id="composition" name="composition" value="{{@$placement_office->composition}}"  class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>f) Total number of staff members</td>
                                    <td>
                                        <input type="textval" id="total_staff" name="total_staff" value="{{@$placement_office->total_staff}}"  class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>g) Resources available

                                       <tr>
                                           <td>Number of printers</td>
                                           <td><input type="textval" id="printers" name="printers" value="{{@$placement_office->printers}}"  class="form-control"></td>
                                       </tr>
                                       <tr>
                                           <td>Number of photocopiers</td>
                                           <td><input type="textval" id="photocopiers" name="photocopiers" value="{{@$placement_office->photocopiers}}"  class="form-control"></td>
                                       </tr>

                                    </td>
                                </tr>


                                </tbody>
                            </table>
                                <div class="col-md-12">
                                    <div class="form-group pull-right" style="margin-top: 40px">
                                        <label for="sector">&nbsp;&nbsp;</label>
                                        <input type="button" name="update" id="update" value="Update" class="btn btn-info">
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

        // add required to input fields
        // $('input').prop('required', true);
        //Initialize Select2 Elements
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })

        <?php if(@$placement_office->id==null){ ?>

        $('#update').on('click', function (e) {
            let hierarchical_position = $('input[name=hierarchical_position]:checked').val();
            let year_establishment = $('#year_establishment').val();
            let head = $('#head').val();
            let reports_to = $('#reports_to').val();
            let composition = $('#composition').val();
            let total_staff = $('#total_staff').val();
            let printers = $('#printers').val();
            let photocopiers = $('#photocopiers').val();

             !hierarchical_position?addClass('hierarchical_position'):removeClass('hierarchical_position');
             !year_establishment?addClass('year_establishment'):removeClass('year_establishment');
             !head?addClass('head'):removeClass('head');
             !reports_to?addClass('reports_to'):removeClass('reports_to');
             !composition?addClass('composition'):removeClass('composition');
             !total_staff?addClass('total_staff'):removeClass('total_staff');
             !printers?addClass('printers'):removeClass('printers');
             !photocopiers?addClass('photocopiers'):removeClass('photocopiers');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{url('placement-office')}}",
                data: {
                    hierarchical_position: hierarchical_position,
                    year_establishment: year_establishment,
                    head: head,
                    reports_to: reports_to,
                    composition: composition,
                    total_staff: total_staff,
                    printers: printers,
                    photocopiers: photocopiers,
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

   <?php  }else{ ?>

    $('#update').on('click', function (e) {

            let hierarchical_position = $('input[name=hierarchical_position]:checked').val();
            let year_establishment = $('#year_establishment').val();
            let head = $('#head').val();
            let reports_to = $('#reports_to').val();
            let composition = $('#composition').val();
            let total_staff = $('#total_staff').val();
            let printers = $('#printers').val();
            let photocopiers = $('#photocopiers').val();
            let id = $('#id').val();

             !hierarchical_position?addClass('hierarchical_position'):removeClass('hierarchical_position');
             !year_establishment?addClass('year_establishment'):removeClass('year_establishment');
             !head?addClass('head'):removeClass('head');
             !reports_to?addClass('reports_to'):removeClass('reports_to');
             !composition?addClass('composition'):removeClass('composition');
             !total_staff?addClass('total_staff'):removeClass('total_staff');
             !printers?addClass('printers'):removeClass('printers');
             !photocopiers?addClass('photocopiers'):removeClass('photocopiers');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'PUT',
                url: "{{url('placement-office')}}/"+id,
                data: {
                    id: id,
                    hierarchical_position: hierarchical_position,
                    year_establishment: year_establishment,
                    head: head,
                    reports_to: reports_to,
                    composition: composition,
                    total_staff: total_staff,
                    printers: printers,
                    photocopiers: photocopiers,
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
