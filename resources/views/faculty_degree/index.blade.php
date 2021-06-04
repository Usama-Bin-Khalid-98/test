@section('pageTitle', 'Faculty Degree')


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
               Number of Faculty Degree
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Faculty Degree </li>
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
                            <h3 class="box-title">Number of Faculty Degree</h3>
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Number of faculty with terminal degree from foreign institutions</label>
                                        <input type="number" id="faculty_foreign" name="faculty_foreign" value="{{@$faculty_degree->faculty_foreign}}" class="form-control">
                                    </div>
                                    <input type="hidden" id="id" value="{{@$faculty_degree->id}}">
                                </div>



                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Number of faculty with terminal degree from domestic institutions</label>
                                        <input type="number" id="faculty_domestic" name="faculty_domestic" value="{{@$faculty_degree->faculty_domestic}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Number of faculty with international work experience</label>
                                        <input type="number" id="faculty_international" name="faculty_international" value="{{@$faculty_degree->faculty_international}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
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

        $('#update').on('click', function (e) {

            let id = $('#id').val();
            let faculty_foreign = $('#faculty_foreign').val();
            let faculty_domestic = $('#faculty_domestic').val();
            let faculty_international = $('#faculty_international').val();
             !faculty_foreign?addClass('faculty_foreign'):removeClass('faculty_foreign');
             !faculty_domestic?addClass('faculty_domestic'):removeClass('faculty_domestic');
             !faculty_international?addClass('faculty_international'):removeClass('faculty_international');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{url("faculty-degree")}}',
                data: {
                    id: id,
                    faculty_foreign: faculty_foreign,
                    faculty_domestic: faculty_domestic,
                    faculty_international: faculty_international,
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
                    // location.reload();
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


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
