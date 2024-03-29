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
               Strategic Basic Information of Business School
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
                                    <!--<button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">-->
                                    <!--    <i class="fa fa-file-pdf-o"></i></button>-->
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

                                        <li><h5>Generate Invoice</h5>
                                            <p>Generate invoice in invoices tab, before starting entries in registration forms.</p>
                                            <p>Registration application will be activated once registration Fee invoice will be approved by NBEAC admin</p>
                                        </li>
                                        <li><h5>Upload Payment slip</h5>
                                            <p>When pay the registration fee, upload the payment slip.</p>
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
                            <h3 class="box-title">1.1 Provide basic information about the business school in Table 1.1</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                                </button>
                                <div class="btn-group">
                                    <!--<button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">-->
                                    <!--    <i class="fa fa-file-pdf-o"></i></button>-->
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name of the university/parent institution</label>
                                        <input type="text" id="name" disabled value="{{@$basic_info->name}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Year of  establishment (university/parent institution)</label>
                                        <div class="input-group">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="number" id="year_estb" value="{{@$basic_info->year_estb}}" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="designation">Chief administrative officer</label>
                                        <select id="designation_id" name="designation_id" class="form-control select2" style="width: 100%;">
                                            <option value="">Select Designation</option>
                                            @foreach(@$designations as $designation)
                                                <option value="{{@$designation->id}}" {{@$designation->id==@$user_info->designation_id?'selected':''}} >{{@$designation->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="contactPerson">Name of Chief Administrative Officer</label>
                                        <input type="text" id="contact_person" value="{{@$user_info->cao_name}}" class="form-control">
                                        <input type="hidden" id="id" value="{{@$basic_info->id}}">
                                    </div>
                                </div>
{{--                                <div class="col-md-3">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="name">Contact No</label>--}}
{{--                                        <input type="text" id="contact_no" value="{{@$user_info->contact_no}}" class="form-control" >--}}
{{--                                    </div>--}}
{{--                                </div>--}}


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name of the business school and campus (if relevant)</label>
                                        <input type="text" disabled id="campus_id" value="{{@$department->name}}, Campuses ( @foreach ($campuses as $campus ){{$campus->location}} @endforeach )" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Year of establishment of the business school</label>
                                        <div class="input-group">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="number" id="campus_year_estb" value="{{@$basic_info->campus_year_estb}}" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Website URL</label>
                                        <input type="text" id="web_url" value="{{@$basic_info->web_url}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Date of charter granted</label>
                                        <div class="input-group">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" id="date_charter_granted" value="{{@$basic_info->date_charter_granted}}" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Reference number of charter</label>
                                        <input type="text" id="charter_number" value="{{@$basic_info->charter_number}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Charter Type</label>
                                        <select id="charter_type_id" class="form-control select2" style="width: 100%;">
                                            <option value="">Select Charter Type</option>
                                            @foreach(@$chart_types as $type)
                                                <option value="{{@$type->id}}" {{@$basic_info->charter_type_id==$type->id?'selected':''}}>{{@$type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Institute Type</label>
                                        <select id="institute_type_id" class="form-control select2" style="width: 100%;">
                                            <option value="">Select Institute Type</option>
                                            @foreach($institute_type as $school)
                                                <option value="{{@$school->id}}" {{@$basic_info->institute_type_id==@$school->id?'selected':''}}>{{@$school->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="type">{{ __('Profit/Not for profit Status') }} : </label>
                                        <p><input type="radio" name="profit_status" class="flat-red" value="None Profit" {{ @$basic_info->profit_status == 'None Profit' ? 'checked' : '' }}> Not for Profit</p>
                                        <p><input type="radio" name="profit_status" class="flat-red" value="For Profit" {{ @$basic_info->profit_status == 'For Profit' ? 'checked' : '' }}> For Profit</p>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="type">{{ __('Hierarchical context') }} : </label>
                                        <p><input type="radio" name="hierarchical_context" class="flat-red" value="Affiliated" {{ @$basic_info->hierarchical_context == 'Affiliated' ? 'checked' : '' }}> Affiliated</p>
                                        <p><input type="radio" name="hierarchical_context" class="flat-red" value="Constituent Part" {{ @$basic_info->hierarchical_context  == 'Constituent Part' ? 'checked' : '' }}> Constituent part</p>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group" style="margin-bottom: 0px">
                                            <label for="name">Address</label>
                                            <textarea id="address" class="form-control">{{@$basic_info->address}}</textarea>
                                        </div>
                                    </div >
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sector">{{ __('Sector') }} : </label>
                                        <p><input type="radio" name="sector" class="flat-red" value="Public" {{ @$basic_info->sector == 'public' ? 'checked' : '' }}> Public</p>
                                        <p><input type="radio" name="sector" class="flat-red" value="Private" {{ @$basic_info->sector == 'private' ? 'checked' : '' }}> Private</p>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="page-header"></div>
                                    <div class="form-group">
                                        <h3 class="box-title">{{ __('Set year "t", it will remain fixed throughout the application.') }} : </h3>
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="sector">{{ __('Year T') }} : </label>
                                        <p><input type="text" name="year_t" id="year_t" value="{{@$tyear->tyear}}" autocomplete="off" class="form-control" ></p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="sector">{{ __('Year T-1') }} : </label>
                                        <p><input type="text" name="year_t_1" id="year_t_1" value="{{@$tyear->tyear?@$tyear->tyear-1:''}}" readonly class="form-control" ></p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="sector">{{ __('Year T-2') }} : </label>
                                        <p><input type="text" name="year_t_2" id="year_t_2" value="{{@$tyear->tyear?@$tyear->tyear-2:''}}" readonly class="form-control" ></p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group pull-right" style="margin-top: 40px">
                                        <label for="sector">&nbsp;&nbsp;</label>
                                        <input type="button" name="update" id="update" value="Update" class="btn btn-info update">
                                    </div>

                                    <div class="form-group pull-right" style="margin-top: 40px">
                                        <label for="sector">&nbsp;&nbsp;</label>
                                        <input type="button"  value="Update & Next" class="btn btn-success update">
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
            autoclose: true,
            autocomplete: false,
            format:'yyyy',
            viewMode: "years",
            minViewMode: "years"
    });
        $('#year_estb').datepicker({
            autoclose:true,
            autocomplete: false,
            format:'yyyy',
            viewMode: "years",
            minViewMode: "years"
        });
        $('#year_t').datepicker({
            autocomplete:false,
            autoclose:true,
            format:'yyyy',
            viewMode: "years",
            minViewMode: "years"
        })

        $('#year_t').on('change', function () {
            let date_year = $(this).val();
            console.log('year', date_year)
            $('#year_t_1').val(date_year-1);
            $('#year_t_2').val(date_year-2);
        })

        $('#date_charter_granted').datepicker({
            autoclose:true,
            autocomplete: false,

        });

        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })

        $('.update').on('click', function (e) {
            let buttonClick =  $(this).val();

            let id = $('#id').val();
            let contact_person = $('#contact_person').val();
            // let contact_no = $('#contact_no').val();
            let year_estb = $('#year_estb').val();
            let campus_year_estb = $('#campus_year_estb').val();
            let web_url = $('#web_url').val();
            let date_charter_granted = $('#date_charter_granted').val();
            let charter_number = $('#charter_number').val();
            let institute_type_id = $('#institute_type_id').val();
            let charter_type_id = $('#charter_type_id').val();
            let hierarchical_context = $('input[name=hierarchical_context]:checked').val();
            let profit_status = $('input[name=profit_status]:checked').val();
            let sector = $('input[name=sector]:checked').val();
            let address = $('#address').val();
            let designation_id = $('#designation_id').val();
            let year_t = $('#year_t').val();

            //console.log(contact_no);
            //validation
             !contact_person?addClass('contact_person'):removeClass('contact_person');
             // !contact_no?addClass('contact_no'):removeClass('contact_no');
             !year_estb?addClass('year_estb'):removeClass('year_estb');
             !year_t?addClass('year_t'):removeClass('year_t');
             !campus_year_estb?addClass('campus_year_estb'):removeClass('campus_year_estb');
             !web_url?addClass('web_url'):removeClass('web_url');
             !date_charter_granted?addClass('date_charter_granted'):removeClass('date_charter_granted');
             !charter_number?addClass('charter_number'):removeClass('charter_number');
             !institute_type_id?addClass('institute_type_id'):removeClass('institute_type_id');
             !charter_type_id?addClass('charter_type_id'):removeClass('charter_type_id');
             !hierarchical_context?addClass('hierarchical_context'):removeClass('hierarchical_context');
             !profit_status?addClass('profit_status'):removeClass('profit_status');
             !sector?addClass('sector'):removeClass('sector');
             !address?addClass('address'):removeClass('address');
             !designation_id?addClass('designation_id'):removeClass('designation_id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'PUT',
                url: "{{url('strategic/basicinfo')}}/"+id,
                data: {
                    id: id,
                    contact_person: contact_person,
                    // contact_no: contact_no,
                    year_estb: year_estb,
                    campus_year_estb: campus_year_estb,
                    web_url: web_url,
                    date_charter_granted: date_charter_granted,
                    charter_number: charter_number,
                    institute_type_id: institute_type_id,
                    charter_type_id: charter_type_id,
                    hierarchical_context: hierarchical_context,
                    profit_status: profit_status,
                    sector: sector,
                    address: address,
                    designation_id:designation_id,
                    year_t:year_t
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
                    if(buttonClick == 'Update') {
                        location.reload();
                    }else{
                        window.location = '/strategic/scope';
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

@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
