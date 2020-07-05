@include("../includes.head")

<link rel="stylesheet" href="{{URL::asset('plugins/iCheck/all.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">

</head>
<body>

<div class="jumbotron jumbotron-fluid" style="padding-bottom: 0;">
    <div class="container">
        <img src="{{URL::asset('dist/img/logo.png')}}" style="width: 100px">
        <span class="lead" style="font-size: 20px;"><strong>NBEAC</strong> (National Business Educaton Accreditatoin Council).</span>
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
                    <form action="{{ url('register') }}" method="POST" enctype="multipart/form-data">
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
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Designation</label>
                                                    <select name="designation_id" id="designation_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Designation</option>
                                                        @foreach($designations as $designation)
                                                            <option value="{{$designation->id}}">{{$designation->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">CNIC</label>
                                                    <input type="text" name="cnic" id="cnic" value="{{old('contact_no')}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Contact No</label>
                                                    <input type="text" name="contact_no" id="contact_no" value="{{old('contact_no')}}" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" id="email" value="{{old('contact_no')}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Password</label>
                                                    <input type="password" name="password" id="password" value="{{old('contact_no')}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" style="margin-bottom: 14px;">
                                                    <label for="email">Confirm Password</label>
                                                    <input type="password" name="confirm_password" id="confirm_password" value="{{old('contact_no')}}" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Country</label>
                                                    <select name="country_id" id="country_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Country</option>
{{--                                                        @foreach($countries as $country)--}}
{{--                                                            <option value="{{$country->id}}">{{$country->name}}</option>--}}
{{--                                                        @endforeach--}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">City</label>
                                                    <select name="city_id" id="city_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select City</option>

{{--                                                        @foreach($countries as $city)--}}
{{--                                                            <option value="{{$city->city->id}}">{{$city->city->name}}</option>--}}
{{--                                                        @endforeach--}}
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Address</label>
                                                    <textarea name="address" id="address" class="form-control">{{old('address')}}</textarea>
                                                </div>
                                            </div>
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name">Account Type</label>
                                                    <p><input type="radio" name="account_type" id="business_school" class="flat-red" value="business_school" {{ old('business_school') == 'Business School' ? 'checked' : '' }}><span class="status">Business School</span></p>
                                                    <p><input type="radio" name="account_type" id="peer_review" class="flat-red" value="peer_review" {{ old('peer_review') == 'Peer Reviewer' ? 'checked' : '' }}><span class="status">Peer Reviewer</span></p>
                                                    <p class="text-red" role="alert">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li id="business-school-tab" style="display: none;">
                            <i class="fa fa-university bg-aqua"></i>

                            <div class="timeline-item">
                                <div class="box box-primary"></div>
                                <span class="time"><i class="fa fa-institution"></i> </span>
                                <h3 class="timeline-header no-border"><a href="#">Business School</a></h3>
                                <div class="timeline-body">
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Business/Institute</label>
                                                    <select name="business_school_id" id="business_school_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Business/Institute</option>
                                                        @foreach($business_school as $school)
                                                            <option value="{{$school->id}}">{{$school->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Discipline</label>
                                                    <select name="discipline_id" id="discipline_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Discipline</option>
                                                        <option value="">Discipline 1 </option>
                                                        <option value="">Discipline 2 </option>
{{--                                                        @foreach($designations as $designation)--}}
{{--                                                            <option value="{{$designation->id}}">{{$designation->name}}</option>--}}
{{--                                                        @endforeach--}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Department Name</label>
                                                    <select name="department_id" id="department_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Department</option>
                                                        <option value="1">Computer Science </option>
                                                        <option value="2">Management Science</option>
{{--                                                        @foreach($designations as $designation)--}}
{{--                                                            <option value="{{$designation->id}}">{{$designation->name}}</option>--}}
{{--                                                        @endforeach--}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Bank Deposit Slip</label>
                                                    <input type="file" name="slip" id="slip" value="{{old('contact_no')}}" class="form">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li id="peer-review-tab" style="display: none;">
                            <i class="fa fa-search bg-yellow"></i>

                            <div class="timeline-item">
                                <div class="box box-primary"></div>
                                <span class="time"><i class="fa fa-search"></i></span>
                                <h3 class="timeline-header"><a href="#">Peer Reviewer</a></h3>
                                <div class="timeline-body">
                                        <!-- /.box-header -->
                                        <div class="box-body">

{{--                                            <div class="col-md-4">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="name">Role</label>--}}
{{--                                                    <select name="role" id="role" class="form-control select2" style="width: 100%;">--}}
{{--                                                        <option value="">Select Role</option>--}}
{{--                                                        @foreach($designations as $designation)--}}
{{--                                                            <option value="{{$designation->id}}">{{$designation->name}}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Current Position</label>
                                                    <select name="current_position" id="current_position" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Position</option>
                                                        <option value="1">HOD </option>
                                                        <option value="2">Professor</option>
                                                        {{--                                                        @foreach($designations as $designation)--}}
                                                        {{--                                                            <option value="{{$designation->id}}">{{$designation->name}}</option>--}}
                                                        {{--                                                        @endforeach--}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Region</label>
                                                    <select name="region" id="region" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Region</option>
                                                        <option value="1"> Region one</option>
                                                        <option value="2"> Region second</option>
                                                        {{--                                                        @foreach($designations as $designation)--}}
                                                        {{--                                                            <option value="{{$designation->id}}">{{$designation->name}}</option>--}}
                                                        {{--                                                        @endforeach--}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Sector</label>
                                                    <select name="sector" id="sector" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Sector</option>
                                                        <option value="1"> Sector 1</option>
                                                        <option value="2"> Sector 2</option>
                                                        {{--                                                        @foreach($designations as $designation)--}}
                                                        {{--                                                            <option value="{{$designation->id}}">{{$designation->name}}</option>--}}
                                                        {{--                                                        @endforeach--}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Highest Qualification</label>
                                                    <input type="text" name="qualification" id="qualification" value="{{old('contact_no')}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Degree title</label>
                                                    <input type="text" name="degree_title" id="degree_title" value="{{old('contact_no')}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Specialization</label>
                                                    <input type="email" name="specialization" id="specialization" value="{{old('contact_no')}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Year of degree completion</label>
                                                    <input type="date" name="completion" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Institution from where the degree completed</label>
                                                    <input type="text" name="institute" id="institute" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Employed at (institution)</label>
                                                    <input type="text" name="employed" id="employed" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Length of Service</label>
                                                    <input type="text" name="service" id="service" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Industry Experience</label>
                                                    <input type="text" name="industry_exp" id="industry_exp" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Academic experience</label>
                                                    <input type="text" name="academic_exp" id="academic_exp" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Research Publications (if any)</label>
                                                    <input type="text" name="research" id="research" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Name of NBEAC accreditation Seminar (if attended)</label>
                                                    <input type="text" name="nbeac_seminar" id="nbeac_seminar" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Date of Seminar (if attended)</label>
                                                    <input type="text" name="date_seminar" id="date_seminar" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Rationale to recommend</label>
                                                    <input type="text" name="rational_recommend" id="rational_recommend" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Recommended by</label>
                                                   <select name="recommended" class="form-control select2" >
                                                       <option value="">Select Recommended by</option>
                                                       <option value="1"> Recommended by</option>
                                                       <option value="2"> Recommended by</option>
                                                       <option value="3"> Recommended by</option>
                                                   </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Address</label>
                                                    <textarea name="school_contact" id="school_contact" class="form-control">{{old('address')}}</textarea>
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
                                   <button type="submit" class="btn btn-info"> {{ __('Register') }}</button>
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



        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
    <script src="{{URL::asset('notiflix/notiflix-2.3.2.min.js')}}"></script>
    @include("../includes.footer")
    <script src="{{URL::asset('plugins/iCheck/icheck.min.js')}}"></script>
    <!-- Select2 -->
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
    </script>

