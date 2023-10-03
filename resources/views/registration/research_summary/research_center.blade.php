@section('pageTitle', 'Research Center')


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
               Basic information of research centers
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> research center</li>
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
                            <h3 class="box-title">5.2   Provide basic information about research centers in the Table 5.2.</h3>
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
                                    <td>a) Name of research center</td>
                                    <td>
                                        <input type="textval" id="research_center" name="research_center" value="{{@$research_center->research_center}}"  class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>b) Hierarchical Position</td>
                                     <td>
                                        <input type="radio" value="Under the central ORIC office"  name="hierarchical_position" class="flat-red"  {{@$research_center->hierarchical_position == 'Under the central ORIC office' ? 'checked' : '' }} > <span>Under the central ORIC office</span>
                                             <input type="radio" value="Dedicated to business school"  name="hierarchical_position" class="flat-red"  {{@$research_center->hierarchical_position == 'Dedicated to business school' ? 'checked' : '' }} > <span>Dedicated to business school</span>
                                      </td>
                                    <input type="hidden" id="id" value="{{@$research_center->id}}">
                                </tr>
                                    <tr>
                                    <td>c) Year of establishment</td>
                                    <td>
                                        <input type="number" id="year_establishment" name="year_establishment" value="{{@$research_center->year_establishment}}"  class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>d) Head/supervisor of the research center</td>
                                     <td>
                                        <input type="radio" value="Director of ORIC"  name="head" class="flat-red"  {{ @$research_center->head == 'Director of ORIC' ? 'checked' : '' }} > <span>Director of ORIC</span>
                                             <input type="radio" value="Director Research"  name="head" class="flat-red"  {{ @$research_center->head == 'Director Research' ? 'checked' : '' }} > <span>Director Research</span>
                                             <input type="radio" value="Dean"  name="head" class="flat-red"  {{ @$research_center->head == 'Dean' ? 'checked' : '' }} > <span>Dean</span>
                                      </td>
                                </tr>
                                <tr>
                                    <td>e) Qualification of the main  head/supervisor of research center</td>
                                    <td>
                                        <input type="textval" id="qualification" name="qualification" value="{{@$research_center->qualification}}"  class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>f) Head/Supervisor reports to</td>
                                    <td>
                                        <input type="textval" id="reports_to" name="reports_to" value="{{@$research_center->reports_to}}"  class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>g) Research committee composition</td>
                                    <td>
                                        <input type="textval" id="composition" name="composition" value="{{@$research_center->composition}}"  class="form-control">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                                <div class="col-md-12">
                                    <div class="form-group pull-right" style="margin-top: 40px">
                                        <label for="sector">&nbsp;&nbsp;</label>
                                        <input type="button" name="update" id="update-and-next" value="Update & Next" class="btn btn-success">
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

        <?php if(@$research_center->id==null){ ?>

        $('#update, #update-and-next').on('click', function (e) {
            let next = false;
            if(e.target.id === 'update-and-next'){
                next = true;
            }
            let research_center = $('#research_center').val();
            let hierarchical_position = $('input[name=hierarchical_position]:checked').val();
            let year_establishment = $('#year_establishment').val();
            let head = $('input[name=head]:checked').val();
            let qualification = $('#qualification').val();
            let reports_to = $('#reports_to').val();
            let composition = $('#composition').val();

             !research_center?addClass('research_center'):removeClass('research_center');
             !hierarchical_position?addClass('hierarchical_position'):removeClass('hierarchical_position');
             !year_establishment?addClass('year_establishment'):removeClass('year_establishment');
             !head?addClass('head'):removeClass('head');
             !qualification?addClass('qualification'):removeClass('qualification');
             !reports_to?addClass('reports_to'):removeClass('reports_to');
             !composition?addClass('composition'):removeClass('composition');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{url('research-center')}}",
                data: {
                    research_center: research_center,
                    hierarchical_position: hierarchical_position,
                    year_establishment: year_establishment,
                    head: head,
                    qualification: qualification,
                    reports_to: reports_to,
                    composition: composition,
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
                    if(next){
                        setTimeout(() => {
                            window.location = '/research-agenda';
                        }, 1000);
                    }
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

    $('#update, #update-and-next').on('click', function (e) {
            let next = false;
            if(e.target.id === 'update-and-next'){
                next = true;
            }
            let research_center = $('#research_center').val();
            let hierarchical_position = $('input[name=hierarchical_position]:checked').val();
            let year_establishment = $('#year_establishment').val();
            let head = $('input[name=head]:checked').val();
            let qualification = $('#qualification').val();
            let reports_to = $('#reports_to').val();
            let composition = $('#composition').val();
            let id = $('#id').val();


             !research_center?addClass('research_center'):removeClass('research_center');
             !hierarchical_position?addClass('hierarchical_position'):removeClass('hierarchical_position');
             !year_establishment?addClass('year_establishment'):removeClass('year_establishment');
             !head?addClass('head'):removeClass('head');
             !qualification?addClass('qualification'):removeClass('qualification');
             !reports_to?addClass('reports_to'):removeClass('reports_to');
             !composition?addClass('composition'):removeClass('composition');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'PUT',
                url: "{{url('research-center')}}/"+id,
                data: {
                    id: id,
                    research_center: research_center,
                    hierarchical_position: hierarchical_position,
                    year_establishment: year_establishment,
                    head: head,
                    qualification: qualification,
                    reports_to: reports_to,
                    composition: composition,
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
                    if(next){
                        setTimeout(() => {
                            window.location = '/research-agenda';
                        }, 1000);
                    }
                },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);

                    })

                }
            });
        });
        $('#year_establishment').datepicker({
            autocomplete:false,
            autoclose:true,
            format:'yyyy',
            viewMode: "years",
            minViewMode: "years"
        })

   <?php  } ?>

    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
