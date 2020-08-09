@section('pageTitle', 'Contact Info')


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
                Users
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Users</li>
            </ol>
        </section>

    <!-- Main content -->
        <section class="content">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
{{--                        <div class="box-header">--}}
{{--                            <h3 class="box-title">Users</h3>--}}
{{--                            <div class="box-tools pull-right">--}}
{{--                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>--}}
{{--                                </button>--}}

{{--                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- The time line -->
                        <ul class="timeline">
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
                                            <div class="form-row col-md-12">
                                                <div class="form-group col-md-4" style="margin-bottom: 10px">
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
                                            </div>


                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="campus">Campus</label>
                                                    <select name="campus_id" id="campus_id" class="form-control select2">
                                                        <option value="">Select Campus</option>
                                                    </select>
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
                                                        <label for="Desk Review">Desk Review Questionnaire</label>
                                                        <input type="hidden" id="questionnaire" name="questionnaire">
                                                        <span class="input-group-btn">
                                                          <button type="button" data-toggle="modal" data-target="#question-modal"  class="btn btn-info btn-flat">
                                                              click to fill the questionnaire
                                                          </button>
                                                        </span>
                                                        <span class="text-red">Fill the questionnaire before submission.</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        {{--                                                        <label for="Desk Review">Undertaking : </label>--}}
                                                        <input type="checkbox" id="undertaking" name="undertaking" class="flat-red" {{old('undertaking') === 'on'?'checked':''}}>
                                                        <span class="text-black">
                                                             I, the undersigned, fully understand and agree with the
                                                          <a data-toggle="modal" data-target="#undertaking-modal">
                                                             terms and conditions
                                                          </a>
                                                            of the NBEAC given.
                                                        </span>

                                                    </div>
                                                </div>

                                                {{--                                            <div class="col-md-4">--}}
                                                {{--                                                    <div class="form-group">--}}
                                                {{--                                                        <label for="email">Bank Deposit Slip</label>--}}
                                                {{--                                                        <input type="file" name="slip" id="slip" value="{{old('slip')}}" class="form">--}}
                                                {{--                                                        <span class="text-blue">Max 2mb file size allowed. </span>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}
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
                                                        @foreach($peer_reviewer as $user)
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
            <div class="modal fade" id="question-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Questionnaire.</h4>
                        </div>
                        <form role="form" method="post">
                            <div class="modal-body">
                                <table id="questions">
                                    @foreach($questions as $question)
                                        <tr class="questions-row">
                                            <td>
                                                <p>{{$loop->iteration}}: {{$question->question}}</p>
                                                <p class="questions-row" row-id="{{$question->id}}">
                                                    <input type="radio" data-id="{{$question->id}}" name="question{{$question->id}}" id="yes" value="yes" class="flat-red" {{ old('status') == 'status' ? 'checked' : '' }}> <span> yes</span>
                                                    <input type="radio" data-id="{{$question->id}}" name="question{{$question->id}}" id="no"  value="no" checked class="flat-red" {{ old('status') == 'status' ? 'checked' : '' }}> <span> no</span>
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <input type="button" class="btn btn-info" value="Submit" id="submit">
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <div class="modal fade" id="undertaking-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Undertaking</h4>
                        </div>
                        <div class="modal-body">
                            <ul>
                                <li>I, the undersigned, fully understand and agree with the terms and conditions of the NBEAC given below.</li>
                                <li>I confirm the accuracy of the information provided in the registration application, and as the authorized representative commit the business school to go through the NBEAC accreditation process.</li>
                                <li>I agree that the business school under review will pay the NBEAC accreditation fee as defined in the NBEAC Fee Schedule https://www.nbeac.org.pk/index.php/accreditation-2/accreditation-fee-2, which is effective at the date of the submission of this application form.</li>
                                <li>I confirm that we shall provide any relevant documents to the NBEAC committee in case they ask for during the screening process, and will accept the decisions of NBEAC with respect to the registration process. The NBEAC, its directors, employees and consultants shall not be liable for any direct or indirect, foreseeable or unforeseeable damages resulting from the conception and implementation of the standards, the accreditation process, or the final decision of the NBEAC about registration.</li>
                                <li>In case the business school unilaterally decides to stop the process, a cancellation request must be submitted to the NBEAC Secretariat.</li>
                            </ul>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            {{--                                <input type="button" class="btn btn-info" value="Submit" id="submit">--}}
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </section>
        <!-- /.content -->

        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- .box -->
                    <div class="box box-primary" >
                        <div class="box-header">
                            <h3 class="box-title">Users</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                                </button>

                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-stripped">
                                <thead >
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Business School</th>
{{--                                    <th>Office Contact</th>--}}
{{--                                    <th>CV</th>--}}
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($users as $user)
                                    <tr>
                                        <td>{{@$user->name}}</td>
                                        <td>{{@$user->email}}</td>
                                        <td>{{@$user->contact_no}}</td>
                                        <td>{{@$user->business_school->name}}</td>
{{--                                        <td>{{$contact->school_contact}}</td>--}}
{{--                                        <td><a href="{{url($contact->cv)}}"><i class="fa fa-file-word-o"></i></a> </td>--}}
                                        <td>
                                            <i class="badge {{$user->status == 'active'?'bg-green':'bg-red'}}">{{$user->status == 'active'?'Active':'Inactive'}}</i>
                                        </td>
                                        <td>
                                            <i class="fa fa-check-square permissions" data-toggle="modal" data-target="#permissions-modal" data-row='{"id":{{@$user->id}},"role_id":"{{@$user->roles}}","permissions":"{{@$user->permissions}}"}' /> |
                                            <i class="fa fa-trash text-info delete" data-id="{{@$user->id}}"></i> |
                                            <i data-row='{"id":{{$user->id}},"name":"{{$user->name}}","email":"{{$user->email}}","contact_no":"{{$user->contact_no}}","business_school":"{{@$user->business_school->name}}","status":"{{$user->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot >
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
{{--                                    <th>Job Title</th>--}}
{{--                                    <th>Office Contact</th>--}}
                                    <th>Business School</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- Main content -->
            </div>
            <!-- /.row -->
            <!-- /.row -->
            <!-- /.content -->
        </section>

    </div>

    <!-- /.modal -->
    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit User. </h4>
                </div>
                <form role="form" id="updateForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Contact Person Name</label>
                                <input type="text" name="name" id="edit_name" value="{{old('name')}}" class="form-control">
                                <input type="hidden" id="edit_id">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="edit_email" value="{{old('contact_no')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Contact No</label>
                                <input type="text" name="contact_no" id="edit_contact_no" value="{{old('contact_no')}}" class="form-control" data-inputmask="'mask': '+92-55-99999999'" maxlength="15">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Business School Contact</label>
                                <input type="text" name="school_contact" id="edit_school_contact" value="{{old('school_contact')}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Designation</label>
                                <select name="designation_id" id="edit_designation_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Designation</option>
                                    @foreach($designations as $designation)
                                        <option value="{{$designation->id}}">{{$designation->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">NBEAC focal person (if different) </label>
                                <input type="text" name="focal_person" id="edit_focal_person" value="{{old('edit_focal_person')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Attach CV</label>
                                <input type="file" name="cv" id="edit_cv" >
                                <input type="hidden" name="old_cv" id="old_cv" >
                                <span class="text-blue" id="cv-name"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
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

    <div class="modal fade" id="permissions-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Change user role.</h4>
                </div>
                <form action="" method="PUT">
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="col-lg-12 form-group">
                                <select name="role_id" class="form-control select2" id="role_id">
                                    <option value="">Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->role_id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @foreach($permissions as $permission)
                            <div class="col-lg-1">
                                <input type="checkbox" id="{{@$permission->id}}" value="{{@$permission->id}}" class="flat-red" />
                            </div>
                            <div class="col-lg-5"><label>{{@$permission->name}}</label></div>
                        @endforeach


                    </div>

                    <div class="modal-footer" style="margin-top: 50% !important;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="button" class="btn btn-primary" id="update" value="Update">
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
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    <script>
        $(":input").inputmask();
    </script>
    <script>
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        });
        $(function () {
            $('#datatable').DataTable()
        })
    </script>
    <script type="text/javascript">
        //Initialize Select2 Elements
        $('.select2').select2()

        $('.permissions').on('click', function () {
            let data = JSON.parse(JSON.stringify($(this).data('row')));
            $('#role_id').select2().val(data.role_id).trigger('change');
            $('#id').val(data.id);
            console.log('e values',typeof data);
            let checks ="";
            for(const [key, val] of Object.entries(data.permissions)) {
                $('input[id='+val.id+']').iCheck('check');
                console.log(' object key', key, ' value', val);
                // checks += '<div class="col-lg-1">\n' +
                //    '<input type="checkbox" value="'+val.id+'" checked class="flat-red" />\n' +
                //    '</div>\n' +
                //    '<div class="col-lg-5"><label>'+val.name+'</label></div>';
            }
        });
        $('#updatePermission').submit(function (e) {
            let name = $('#edit_name').val();

            let status = $('input[name=edit_status]:checked').val();
            !name?addClass('edit_name'):removeClass('edit_name');
            if(!name)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
            var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("users-roles")}}/'+id,
                type:'POST',
                // dataType:"JSON",
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
                    //console.log('response', response);
                    //location.reload();
                },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })
                }
            })
        });

        //User Registration
        $('input[name=account_type]').on('ifChecked', function(e){
            console.log(' account type ', $(this).val());
            if($(this).val() !== 'business_school') {
                $('button[name=submit]').removeAttr('disabled');
            }

            console.log('change school type', $(this).val());
            let toggle = $(this).val();

            (toggle==='business_school')?$('#business-school-tab').toggle('slow'):$('#business-school-tab').fadeOut('slow');
            (toggle==='peer_review')?$('#peer-review-tab').toggle('slow'):$('#peer-review-tab').fadeOut('slow');

        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#submit").on('click', function () {

            let business_school_id = $('#business_school_id').val();
            !business_school_id?addClass('business_school_id'):removeClass('business_school_id');
            if(!business_school_id){
                Notiflix.Notify.Failure("Please select business school.");
                return false;
            }
            let radioVal = $('input:radio:checked').map(function(i, el){return {"id":$(el).data('id'),"value":$(el).val()};}).get();

            let data = {business_school_id:business_school_id};
            radioVal.forEach(function (index) {
                if(index.value === 'no')
                {
                    console.log('index here', index.valu);
                    Notiflix.Notify.Failure("Sorry, Your business school is not eligible for the accreditation.");
                    throw new Error('This is not an error. This is just to abort javascript execution');
                }
                else if(index.value === 'yes'){
                    data[index.id] = index;
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{url('survey')}}",
                data: data,
                // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
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
                    $('button[name=submit]').removeAttr('disabled');
                    $('#question-modal').modal('hide');
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

        $('#country').on('change', function () {
            let country= $(this).val();
            console.log('country', country);
           // return;
            $.ajax({
                url: "{{url('get-cities')}}",
                type: 'GET',
                data: {country: country},
                // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
                success: function (response) {
                    console.log('response here', response);
                    //return false;
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

        $('#business_school_id').on('change', function () {
            let id= $(this).val();
            console.log('school id', id);
            $.ajax({
                type: 'GET',
                url: "{{url('get-campuses')}}",
                data: {
                    id: id
                },
                // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
                success: function (response) {
                    console.log('response here', response);
                    var data =[];
                    $('#campus_id').val(null);
                    $("#campus_id").empty();
                    Object.keys(response).forEach(function (index) {
                        data.push({id:response[index].id, text:response[index].location});
                    })
                    $('#campus_id').select2({
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
            let name = $('#school_name').val();
            let contact_no = $('#school_contact_no').val();

            !name?addClass('name'):removeClass('name');
            !contact_no?addClass('contact_no'):removeClass('contact_no');
            if(!name || !contact_no){
                Notiflix.Notify.Failure("fill all the required fields.");
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

        /// Delete Row
        $('.delete').on('click', function (e) {
            let id =  $(this).data('id');
            Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to delete?', 'Yes', 'No',
                function(){
                    // Yes button callback
                    $.ajax({
                        url:'{{url("strategic/contact-info")}}/'+id,
                        type:'DELETE',
                        data: { id:id},
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
                            location.reload();
                            // console.log('response here', response);
                        },
                        error:function(response, exception){
                            Notiflix.Loading.Remove();
                            $.each(response.responseJSON, function (index, val) {
                                Notiflix.Notify.Failure(val);
                            })
                        }
                    })
                },
                function(){ // No button callback
                    // alert('If you say so...');
                } );

        })
    </script>

@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
