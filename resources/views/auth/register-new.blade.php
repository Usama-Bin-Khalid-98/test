@include("../includes.head")

<link rel="stylesheet" href="{{URL::asset('plugins/iCheck/all.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />




</head>
<body>

<div class="jumbotron jumbotron-fluid" style="padding-bottom: 0;">
    <div class="container">
        <img src="{{URL::asset('dist/img/logo.png')}}" style="width: 100px">
        <span class="lead" style="font-size: 20px;"><strong>NBEAC</strong> (National Business Education Accreditation Council).</span>
    </div>
</div>
<div class="container" >

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-left: 0px;">
        <!-- Content Header (Page header) -->
        <section class="content-header text-center">
            <h1>Registration Form</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <!-- The time line -->
                    <ul class="timeline">
                        <!-- timeline time label -->
{{--                        <li class="time-label">--}}
{{--                          <span class="bg-red">--}}
{{--                            Fill All the required Fields.--}}
{{--                          </span>--}}
{{--                        </li>--}}
                        <!-- /.timeline-label -->
                        <!-- timeline item -->

                        <li>
                            <i class="fa fa-user bg-green"></i>

                            <div class="timeline-item">
                                <div class="box box-primary"></div>
                                <span class="time"><i class="fa fa-user"></i></span>

                                <h3 class="timeline-header"><a href="#" class="text-blue">Personal Info</a></h3>

                                <div class="timeline-body">
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Contact Person Name</label>
                                                    <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control">
                                                    @error('name')
                                                        <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Designation</label>
                                                    <select name="designation_id" id="designation_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Designation</option>
                                                        @foreach($designations as $designation)
                                                            <option value="{{$designation->id}}" {{old('designation_id')==$designation->id?'selected':''}}>{{$designation->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('designation_id')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">CNIC</label>
                                                    <input type="text" data-inputmask="'mask': '99999-9999999-9'" name="cnic" id="cnic" value="{{old('cnic')}}" class="form-control">
                                                    @error('cnic')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Contact No</label>
                                                    <input type="text" data-inputmask="'mask': '0399-99999999'" name="contact_no" id="contact_no" value="{{old('contact_no')}}" class="form-control" maxlength="12">
                                                    @error('contact_no')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control">
                                                    @error('email')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Password</label>
                                                    <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control">
                                                    @error('password')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" style="margin-bottom: 0px;">
                                                    <label for="email">Confirm Password</label>
                                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                                    @error('password_confirmation')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Country</label>
                                                    <select name="country" id="country"  class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Country</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{$country->admin??$country->name->common}}" {{old('country')===$country->name->common?'selected':'' }}>{{$country->admin??$country->name->common}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('country')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" style="margin-bottom: 21px;">
                                                    <label for="name">City</label>
                                                    <select name="city" id="city" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select City</option>
                                                    </select>
                                                    @error('city')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Address</label>
                                                    <textarea name="address" id="address" class="form-control">{{old('address')}}</textarea>
                                                    @error('address')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name">Account Type</label>
                                                    <p><input type="radio" name="account_type" id="business_school" class="flat-red" value="business_school" {{ old('account_type') == 'business_school' ? 'checked' : '' }}><span class="status">Business School</span></p>
                                                    <p><input type="radio" name="account_type" id="peer_review" class="flat-red" value="peer_review" {{ old('account_type') == 'peer_review' ? 'checked' : '' }}><span class="status">Peer Reviewer</span></p>
                                                    @error('account_type')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li id="business-school-tab" style="display: {{old('account_type')==='business_school'?'block':'none'}};">
                            <i class="fa fa-university bg-aqua"></i>

                            <div class="timeline-item">
                                <div class="box box-primary"></div>
                                <span class="time"><i class="fa fa-institution"></i> </span>
                                <h3 class="timeline-header no-border"><a href="#">Business School</a></h3>
                                <div class="timeline-body">
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="name" class="@error('business_school_id')text-red @enderror">Business/Institute</label>
                                                    <div class="input-group">
                                                        <select name="business_school_id" id="business_school_id" class="form-control select2" style="width: 100%;">
                                                            <option value="">Select Business/Institute</option>
                                                            @foreach($business_school as $school)
                                                                <option value="{{$school->id}}" {{old('business_school_id')==$school->id?'selected':''}}>{{$school->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="input-group-btn">
                                                          <button type="button" data-toggle="modal" data-target="#add-modal"  class="btn btn-info btn-flat"><i class="fa fa-plus"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="name">Discipline</label>
                                                    <select name="discipline_id" id="discipline_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Discipline</option>
                                                        @foreach($disciplines as $discipline)
                                                            <option value="{{$discipline->id}}" {{old('discipline_id')==$discipline->id?'selected':''}}>{{$discipline->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('discipline_id')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="name">Department Name</label>
                                                    <select name="department_id" id="department_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Department</option>
                                                        @foreach($departments as $program)
                                                            <option value="{{$program->id}}" {{old('department_id')==$program->id?'selected':''}}>{{$program->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('department_id')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="email">Bank Deposit Slip</label>
                                                    <input type="file" name="slip" id="slip" value="{{old('slip')}}" class="form">
                                                    <span class="text-blue">Max 2mb file size allowed. </span>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li id="peer-review-tab" style="display: {{old('account_type')==='peer_review'?'block':'none'}};"  >
                            <i class="fa fa-search bg-yellow"></i>

                            <div class="timeline-item">
                                <div class="box box-primary"></div>
                                <span class="time"><i class="fa fa-search"></i></span>
                                <h3 class="timeline-header"><a href="#">Peer Reviewer</a></h3>
                                <div class="timeline-body">
                                        <!-- /.box-header -->
                                        <div class="box-body">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Role</label>
                                                    <select name="reviewer_role_id" id="reviewer_role_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Role</option>
                                                        @foreach($reviewerRoles as $role)
                                                            <option value="{{$role->id}}" {{old('reviewer_role_id')==$role->id?'selected':''}}>{{$role->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('reviewer_role_id')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Region</label>
                                                    <select name="region_id" id="region_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Region</option>
                                                        @foreach($regions as $region)
                                                            <option value="{{$region->id}}" {{old('region_id')==$region->id?'selected':''}}>{{$region->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('region_id')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Sector</label>
                                                    <select name="sector_id" id="sector_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Sector</option>
                                                        @foreach($sectors as $sector)
                                                            <option value="{{$sector->id}}" {{old('sector_id')==$sector->id?'selected':''}}>{{$sector->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('sector_id')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Highest Qualification</label>
                                                    <input type="text" name="qualification" id="qualification" value="{{old('qualification')}}" class="form-control">
                                                    @error('qualification')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Degree</label>
                                                    <select name="degree_id" id="degree_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Degree</option>
                                                        @foreach($degrees as $degree)
                                                            <option value="{{$degree->id}}" {{old('degree_id')==$degree->id?'selected':''}}>{{$degree->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('degree_id')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Specialization</label>
                                                    <input type="text" name="specialization" id="specialization" value="{{old('specialization')}}" class="form-control">
                                                    @error('specialization')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Year of degree completion</label>
                                                    <input type="date" name="year_completion" class="form-control" value="{{old('year_completion')}}">
                                                    @error('year_completion')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Institution from where the degree completed</label>
{{--                                                    <input type="text" name="institute" id="institute" class="form-control" value="{{old('institute')}}">--}}
                                                    <select name="institute" id="institute" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Business/Institute</option>
                                                        @foreach($business_school as $school)
                                                            <option value="{{$school->id}}" {{old('institute')==$school->id?'selected':''}}>{{$school->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('institute')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Employed at (institution)</label>
                                                    <input type="text" name="employed" id="employed" class="form-control" value="{{old('employed')}}">
                                                    @error('employed')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Length of Service</label>
                                                    <input type="text" name="service" id="service" class="form-control" value="{{old('service')}}">
                                                    @error('service')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Industry Experience</label>
                                                    <input type="text" name="industry_exp" id="industry_exp" class="form-control" value="{{old('industry_exp')}}">
                                                    @error('industry_exp')
                                                     <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Academic experience</label>
                                                    <input type="text" name="academic_exp" id="academic_exp" class="form-control" value="{{old('academic_exp')}}">
                                                    @error('academic_exp')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Research Publications (if any)</label>
                                                    <input type="text" name="research" id="research" class="form-control" value="{{old('research')}}">
                                                    @error('research')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Name of NBEAC accreditation Seminar (if attended)</label>
                                                    <input type="text" name="nbeac_seminar" id="nbeac_seminar" class="form-control" value="{{old('nbeac_seminar')}}">
                                                    @error('nbeac_seminar')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Date of Seminar (if attended)</label>
                                                    <input type="date" name="date_seminar" id="date_seminar" class="form-control" value="{{old('date_seminar')}}">
                                                    @error('date_seminar')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Rationale to recommend</label>
                                                    <input type="text" name="rational_recommend" id="rational_recommend" class="form-control" value="{{old('ratoinal_recommend')}}">
                                                    @error('rational_recommend')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Recommended by</label>
                                                   <select name="recommended" class="form-control select2" >
                                                       <option value="">Select Recommended by</option>
                                                       @foreach($users as $user)
                                                        <option value="{{$user->id}}" {{old('recommended')==$user->id?'selected':''}}>{{$user->name}}</option>
                                                       @endforeach
                                                   </select>
                                                    @error('recommended')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline time label -->

                        <li>
                            <i class="fa fa-save bg-green"></i>

                            <div class="timeline-item">
                                <h3 class="timeline-header"><a href="#">Sign Up</a></h3>

                                <div class="timeline-body">
                                   <button type="submit" class="btn btn-info" name="submit" {{old('account_type')?'':'disabled'}} > {{ __('Register') }}</button>
                                    <a href="{{url('login')}}" class="pull-right">already have account</a>
                                </div>
                                <div class="">

                                </div>

                            </div>
                        </li>


                        <!-- /.row -->
                    </ul>
                    </form>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- /.modal -->
            <div class="modal fade" id="add-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Apply for Business School Name Registration.</h4>
                        </div>
                        <form role="form" method="post">
                            <div class="modal-body">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">Business School Name</label>
                                        <input type="text" class="form-control" id="school_name" placeholder=" Business School Name" name="school_name">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="contact_no">Contact Number</label>
                                        <input type="text" class="form-control" id="school_contact_no" placeholder="Contact Number" name="school_contact_no">
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <input type="button" class="btn btn-info" value="Submit" id="add">
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
    <script src="{{URL::asset('notiflix/notiflix-2.3.2.min.js')}}"></script>
    @include("../includes.footer")
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    <script src="{{URL::asset('plugins/iCheck/icheck.min.js')}}"></script>
    <!-- Select2 -->
    <script>
        $(":input").inputmask();

    </script>
    <script src="{{URL::asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2').select2()
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        });

        $('input[name=account_type]').on('ifChecked', function(e){
            $('button[name=submit]').removeAttr('disabled');
            console.log('change school type', $(this).val());
            let toggle = $(this).val();
            (toggle==='business_school')?$('#business-school-tab').toggle('slow'):$('#business-school-tab').fadeOut('slow');
            (toggle==='peer_review')?$('#peer-review-tab').toggle('slow'):$('#peer-review-tab').fadeOut('slow');

        });

        $('#country').on('change', function () {
            let country= $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: "{{url('get-cities')}}",
                data: {
                    country: country
                },
                // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
                success: function (response) {
                    console.log('response here', response);
                    var data =[];
                    //$('#city').val(null);
                    $("#city").empty();
                    Object.keys(response).forEach(function (index) {
                        data.push({id:response[index].name, text:response[index].name});
                    })
                    $('#city').select2({
                        data
                    });
                },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })

                }
            });
        })
    </script>

    <script>
        $('#add').on('click', function () {
            let name = $('#name').val();
            let contact_no = $('#contact_no').val();

            !name?addClass('name'):removeClass('name');
            !contact_no?addClass('contact_no'):removeClass('contact_no');
            if(!name || !contact_no){
                return;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{route('business-school')}}',
                type: 'POST',
                data: {
                    name:name,
                    contact_no:contact_no
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
                    $('#add-modal').modal('hide');
                    console.log('response here', response);
                },
                error:function(response, exception) {
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })
                }
            })


        });
    </script>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <script>Notiflix.Notify.Failure('{{$error}}')</script>
        @endforeach
        <script>
            Notiflix.Notify.Info("Do not forget to refill the password.");
        </script>
    @endif
