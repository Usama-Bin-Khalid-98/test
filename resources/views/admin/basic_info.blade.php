@section('pageTitle', 'Basic Info')


@if(Auth::user())

    @include("../includes.head")
    <!-- Select2 -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{URL::asset('plugins/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{URL::asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />
    @include("../includes.header")
    @include("../includes.nav")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               NBEAC Basic Information.
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Basic Info </li>
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
                    <div class="box collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title text-red">Read Me</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-file-pdf-o"></i></button>
{{--                                    <ul class="dropdown-menu" role="menu">--}}
{{--                                        <li><a href="#">Action</a></li>--}}
{{--                                        <li><a href="#">Another action</a></li>--}}
{{--                                        <li><a href="#">Something else here</a></li>--}}
{{--                                        <li class="divider"></li>--}}
{{--                                        <li><a href="#">Separated link</a></li>--}}
{{--                                    </ul>--}}
                                </div>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-sticky-note"></i>Note</h4>
                                    <ol type="1">

                                        <li><h5>Uses</h5>
                                            <p>This info will be used through out the app in prints/emails etc.</p>
                                        </li>
                                    </ol>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"> Basic information of NBEAC</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-file-pdf-o"></i></button>
{{--                                    <ul class="dropdown-menu" role="menu">--}}
{{--                                        <li><a href="#">Action</a></li>--}}
{{--                                        <li><a href="#">Another action</a></li>--}}
{{--                                        <li><a href="#">Something else here</a></li>--}}
{{--                                        <li class="divider"></li>--}}
{{--                                        <li><a href="#">Separated link</a></li>--}}
{{--                                    </ul>--}}
                                </div>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                            </div>
                        </div>
                        <form>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Organization Name</label>
                                        <input type="text" id="name" value="{{@$basic_info->name}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Short Name</label>
                                        <input type="text" id="short_name" value="{{@$basic_info->short_name}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="designation">Email</label>
                                        <input type="email" id="email" name="email" value="{{@$basic_info->email}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone1">Phone1</label>
                                        <input type="text" id="phone1" value="{{@$basic_info->phone1}}" class="form-control">
                                        <input type="hidden" id="id" value="{{@$basic_info->id}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contactPerson">Phone2</label>
                                        <input type="text" id="phone2" value="{{@$basic_info->phone2}}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contactPerson">Fax</label>
                                        <input type="text" id="fax" value="{{@$basic_info->fax}}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Website URL</label>
                                        <input type="text" id="website" value="{{@$basic_info->website}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Director</label>
                                        <input type="text" id="director" value="{{@$basic_info->director}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Chairman</label>
                                        <input type="text" id="chairman" value="{{@$basic_info->chairman}}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Address</label>
                                        <textarea id="address" class="form-control">{{@$basic_info->address}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group pull-right" style="margin-top: 40px">
                                        <label for="sector">&nbsp;&nbsp;</label>
                                        <input type="button" name="update" id="update" value="Update" class="btn btn-info">
                                    </div>
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
    <script src="{{URL::asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

    <script type="text/javascript">

        // add required to input fields
        // $('input').prop('required', true);
        //Initialize Select2 Elements
        $('#designation_id').select2();
        $('#charter_type_id').select2();
        $('#institute_type_id').select2();
        $('#campus_year_estb').datepicker({
      autoclose: true
    });
        $('#year_estb').datepicker({
            autoclose:true
        });

        $('#date_charter_granted').datepicker({
            autoclose:true
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })

        $('#update').on('click', function (e) {
            let id = $('#id').val();
            let name = $('#name').val();
            let fax = $('#fax').val();
            let short_name = $('#short_name').val();
            let phone1 = $('#phone1').val();
            let phone2 = $('#phone2').val();
            let email = $('#email').val();
            let website = $('#website').val();
            let director = $('#director').val();
            let chairman = $('#chairman').val();
            let address = $('#address').val();

            //console.log(contact_no);
            //validation
             !name?addClass('name'):removeClass('name');
             !short_name?addClass('short_name'):removeClass('short_name');
             !phone1?addClass('phone1'):removeClass('phone1');
             !phone2?addClass('phone2'):removeClass('phone2');
             !email?addClass('email'):removeClass('email');
             !website?addClass('website'):removeClass('website');
             !director?addClass('director'):removeClass('director');
             !chairman?addClass('chairman'):removeClass('chairman');
             !address?addClass('address'):removeClass('address');

             if(!name || !short_name || !phone1 || !email || !website)
             {
                 Notiflix.Notify.Failure('Fill all the required fields.');
                 return;
             }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{url('basic-info')}}",
                data: {
                    id: id,
                    name: name,
                    short_name: short_name,
                    email: email,
                    phone1: phone1,
                    phone2: phone2,
                    fax: fax,
                    website: website,
                    director: director,
                    chairman: chairman,
                    address: address
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
