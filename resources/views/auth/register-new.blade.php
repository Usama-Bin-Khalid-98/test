@include("../includes.head")

<link rel="stylesheet" href="{{URL::asset('plugins/iCheck/all.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />

<style>
    td {
        padding: 5px;
    }
</style>


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
            <h1>Membership Form</h1>
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
                            <i class="fa fa-info-circle" style="color:#ffffff;background: #00a65a;"></i>

                            <div class="timeline-item">
                                <div class="box box-success"></div>
                                <span class="time"><i class="fa fa-info"></i></span>

                                <h3 class="timeline-header"><a href="#" class="text-success">Instructions for the application preparation</a></h3>
                                <div class="timeline-body">
                                    <p>1.	Before starting the registration application, please go through the guidelines given in the <a href="https://nbeac.org.pk/files/Accreditation%20Process%20Manual%202020%20Updated%2026May2021.pdf" target="_blank"> NBEAC Accreditation Process Manual</a> and <a href="https://nbeac.org.pk/files/NBEAC%20Registration%20Application2020.pdf" target="_blank">Registration Application</a></p>
                                </div>
                            </div>
                        </li>
                            <li>
                            <i class="fa fa-user bg-green"></i>

                            <div class="timeline-item">
                                <div class="box box-primary"></div>
                                <span class="time"><i class="fa fa-user"></i></span>

                                <h3 class="timeline-header"><a href="#" class="text-blue">Personal Info</a></h3>

                                <div class="timeline-body">
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="col-md-12">
                                                <div class="form-group @error('account_type') has-error @enderror">
                                                    <label for="name">Account Type</label>
                                                    <p><input type="radio" name="account_type" id="BusinessSchool"  class="flat-red" value="BusinessSchool" {{ old('account_type') == 'BusinessSchool' ? 'checked' : '' }}><span class="status">Business School</span></p>
                                                    <p><input type="radio" name="account_type" id="PeerReviewer" class="flat-red" value="PeerReviewer" {{ old('account_type') == 'PeerReviewer' ? 'checked' : '' }}><span class="status">Peer Reviewer</span></p>

                                                </div>
                                            </div>
{{--                                            <div class="col-md-12" id="questionnaire-dev" style="display: none;">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="Desk Review">Desk Review Questionnaire</label>--}}
{{--                                                    <input type="hidden" id="questionnaire" name="questionnaire">--}}
{{--                                                    <span class="input-group-btn">--}}
{{--                                                          <button type="button"  class="btn btn-info btn-flat">--}}
{{--                                                              click to fill the questionnaire--}}
{{--                                                          </button>--}}
{{--                                                        </span>--}}
{{--                                                    <span class="text-red">Fill the questionnaire before submission.</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="col-md-4">
                                                <div class="form-group @error('name') has-error @enderror">
                                                    <label for="name">Contact Person Name</label>
                                                    <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group @error('designation_id') has-error @enderror">
                                                    <label for="name">Designation</label>
                                                    <select name="designation_id" id="designation_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Designation</option>
                                                        @foreach($designations as $designation)
                                                            <option value="{{$designation->id}}" {{old('designation_id')==$designation->id?'selected':''}}>{{$designation->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group @error('cnic') has-error @enderror">
                                                    <label for="email">CNIC</label>
                                                    <input type="text" data-inputmask="'mask': '99999-9999999-9'" name="cnic" id="cnic" value="{{old('cnic')}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group @error('contact_no') has-error @enderror">
                                                    <label for="name">Contact No</label>
                                                    <input type="text" data-inputmask="'mask': '0399-99999999'" name="contact_no" id="contact_no" value="{{old('contact_no')}}" class="form-control" maxlength="12">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group @error('email') has-error @enderror">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group @error('password') has-error @enderror">
                                                    <label for="email">Password</label>
                                                    <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group @error('password_confirmation') has-error @enderror" style="margin-bottom: 0px;">
                                                    <label for="email">Confirm Password</label>
                                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group @error('country') has-error @enderror">
                                                    <label for="name">Country</label>
                                                    <input type="text" name="country" id="country" value="Pakistan" class="form-control">
                                                    <!-- <select name="country" id="country"  class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Country</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{$country->admin??$country->name->common}}" {{old('country')===$country->name->common?'selected':'' }}>{{$country->admin??$country->name->common}}</option>
                                                        @endforeach
                                                    </select> -->
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group @error('city') has-error @enderror" style="margin-bottom: 21px;">
                                                    <label for="name">City</label>
                                                    <select name="city" id="city" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select City</option>
                                                        <option selected value="Islamabad">Islamabad</option>
                                                        <option value="Karachi">Karachi</option>
                                                        <option value="Lahore">Lahore</option>
                                                        <option value="Rawalpindi">Rawalpindi</option>
                                                        <option value="Abbottabad">Abbottabad</option>
                                                        <option value="Abdul Hakim">Abdul Hakim</option>
                                                        <option value="Ahmedpur East">Ahmedpur East</option>
                                                        <option value="Alipur">Alipur</option>
                                                        <option value="Arifwala">Arifwala</option>
                                                        <option value="Astore">Astore</option>
                                                        <option value="Attock">Attock</option>
                                                        <option value="Awaran">Awaran</option>
                                                        <option value="Badin">Badin</option>
                                                        <option value="Bagh">Bagh</option>
                                                        <option value="Bahawalnagar">Bahawalnagar</option>
                                                        <option value="Bahawalpur">Bahawalpur</option>
                                                        <option value="Balakot">Balakot</option>
                                                        <option value="Bannu">Bannu</option>
                                                        <option value="Barnala">Barnala</option>
                                                        <option value="Batkhela">Batkhela</option>
                                                        <option value="Bhakkar">Bhakkar</option>
                                                        <option value="Bhalwal">Bhalwal</option>
                                                        <option value="Bhimber">Bhimber</option>
                                                        <option value="Buner">Buner</option>
                                                        <option value="Burewala">Burewala</option>
                                                        <option value="Chaghi">Chaghi</option>
                                                        <option value="Chakwal">Chakwal</option>
                                                        <option value="Charsadda">Charsadda</option>
                                                        <option value="Chichawatni">Chichawatni</option>
                                                        <option value="Chiniot">Chiniot</option>
                                                        <option value="Chishtian Sharif">Chishtian Sharif</option>
                                                        <option value="Chitral">Chitral</option>
                                                        <option value="Choa Saidan Shah">Choa Saidan Shah</option>
                                                        <option value="Chunian">Chunian</option>
                                                        <option value="Dadu">Dadu</option>
                                                        <option value="Daharki">Daharki</option>
                                                        <option value="Daska">Daska</option>
                                                        <option value="Daur">Daur</option>
                                                        <option value="Depalpur">Depalpur</option>
                                                        <option value="Dera Ghazi Khan">Dera Ghazi Khan</option>
                                                        <option value="Dera Ismail Khan">Dera Ismail Khan</option>
                                                        <option value="Dijkot">Dijkot</option>
                                                        <option value="Dina">Dina</option>
                                                        <option value="Dobian">Dobian</option>
                                                        <option value="Duniya Pur">Duniya Pur</option>
                                                        <option value="FATA">FATA</option>
                                                        <option value="Faisalabad">Faisalabad</option>
                                                        <option value="Fateh Jang">Fateh Jang</option>
                                                        <option value="Gaarho">Gaarho</option>
                                                        <option value="Gadoon">Gadoon</option>
                                                        <option value="Galyat">Galyat</option>
                                                        <option value="Ghakhar">Ghakhar</option>
                                                        <option value="Gharo">Gharo</option>
                                                        <option value="Ghotki">Ghotki</option>
                                                        <option value="Gilgit">Gilgit</option>
                                                        <option value="Gojra">Gojra</option>
                                                        <option value="Gujar Khan">Gujar Khan</option>
                                                        <option value="Gujranwala">Gujranwala</option>
                                                        <option value="Gujrat">Gujrat</option>
                                                        <option value="Gwadar">Gwadar</option>
                                                        <option value="Hafizabad">Hafizabad</option>
                                                        <option value="Hala">Hala</option>
                                                        <option value="Hangu">Hangu</option>
                                                        <option value="Harappa">Harappa</option>
                                                        <option value="Haripur">Haripur</option>
                                                        <option value="Haroonabad">Haroonabad</option>
                                                        <option value="Hasilpur">Hasilpur</option>
                                                        <option value="Hassan Abdal">Hassan Abdal</option>
                                                        <option value="Haveli Lakha">Haveli Lakha</option>
                                                        <option value="Hazro">Hazro</option>
                                                        <option value="Hub Chowki">Hub Chowki</option>
                                                        <option value="Hujra Shah Muqeem">Hujra Shah Muqeem</option>
                                                        <option value="Hunza">Hunza</option>
                                                        <option value="Hyderabad">Hyderabad</option>
                                                        <option value="Islamabad">Islamabad</option>
                                                        <option value="Jacobabad">Jacobabad</option>
                                                        <option value="Jahanian">Jahanian</option>
                                                        <option value="Jalalpur Jattan">Jalalpur Jattan</option>
                                                        <option value="Jampur">Jampur</option>
                                                        <option value="Jamshoro">Jamshoro</option>
                                                        <option value="Jatoi">Jatoi</option>
                                                        <option value="Jauharabad">Jauharabad</option>
                                                        <option value="Jhang">Jhang</option>
                                                        <option value="Jhelum">Jhelum</option>
                                                        <option value="Kaghan">Kaghan</option>
                                                        <option value="Kahror Pakka">Kahror Pakka</option>
                                                        <option value="Kalat">Kalat</option>
                                                        <option value="Kamalia">Kamalia</option>
                                                        <option value="Kamoki">Kamoki</option>
                                                        <option value="Kandiaro">Kandiaro</option>
                                                        <option value="Karachi">Karachi</option>
                                                        <option value="Karak">Karak</option>
                                                        <option value="Kasur">Kasur</option>
                                                        <option value="Khairpur">Khairpur</option>
                                                        <option value="Khanewal">Khanewal</option>
                                                        <option value="Khanpur">Khanpur</option>
                                                        <option value="Kharian">Kharian</option>
                                                        <option value="Khipro">Khipro</option>
                                                        <option value="Khushab">Khushab</option>
                                                        <option value="Khuzdar">Khuzdar</option>
                                                        <option value="Kohat">Kohat</option>
                                                        <option value="Kot Addu">Kot Addu</option>
                                                        <option value="Kotli">Kotli</option>
                                                        <option value="Kotri">Kotri</option>
                                                        <option value="Lahore">Lahore</option>
                                                        <option value="Lakki Marwat">Lakki Marwat</option>
                                                        <option value="Lalamusa">Lalamusa</option>
                                                        <option value="Larkana">Larkana</option>
                                                        <option value="Lasbela">Lasbela</option>
                                                        <option value="Layyah">Layyah</option>
                                                        <option value="Liaquatpur">Liaquatpur</option>
                                                        <option value="Lodhran">Lodhran</option>
                                                        <option value="Loralai">Loralai</option>
                                                        <option value="Lower Dir">Lower Dir</option>
                                                        <option value="Mailsi">Mailsi</option>
                                                        <option value="Makran">Makran</option>
                                                        <option value="Malakand">Malakand</option>
                                                        <option value="Mandi Bahauddin">Mandi Bahauddin</option>
                                                        <option value="Mangla">Mangla</option>
                                                        <option value="Mansehra">Mansehra</option>
                                                        <option value="Mardan">Mardan</option>
                                                        <option value="Matiari">Matiari</option>
                                                        <option value="Matli">Matli</option>
                                                        <option value="Mian Channu">Mian Channu</option>
                                                        <option value="Mianwali">Mianwali</option>
                                                        <option value="Mingora">Mingora</option>
                                                        <option value="Mirpur">Mirpur</option>
                                                        <option value="Mirpur Khas">Mirpur Khas</option>
                                                        <option value="Mirpur Sakro">Mirpur Sakro</option>
                                                        <option value="Mitha Tiwana">Mitha Tiwana</option>
                                                        <option value="Moro">Moro</option>
                                                        <option value="Multan">Multan</option>
                                                        <option value="Muridke">Muridke</option>
                                                        <option value="Murree">Murree</option>
                                                        <option value="Muzaffarabad">Muzaffarabad</option>
                                                        <option value="Muzaffargarh">Muzaffargarh</option>
                                                        <option value="Nankana Sahib">Nankana Sahib</option>
                                                        <option value="Naran">Naran</option>
                                                        <option value="Narowal">Narowal</option>
                                                        <option value="Nasar Ullah Khan Town">Nasar Ullah Khan Town</option>
                                                        <option value="Nasirabad">Nasirabad</option>
                                                        <option value="Naushahro Feroze">Naushahro Feroze</option>
                                                        <option value="Nawabshah">Nawabshah</option>
                                                        <option value="Neelum">Neelum</option>
                                                        <option value="New Mirpur City">New Mirpur City</option>
                                                        <option value="Nowshera">Nowshera</option>
                                                        <option value="Okara">Okara</option>
                                                        <option value="Others">Others</option>
                                                        <option value="Others Azad Kashmir">Others Azad Kashmir</option>
                                                        <option value="Others Balochistan">Others Balochistan</option>
                                                        <option value="Others Gilgit Baltistan">Others Gilgit Baltistan</option>
                                                        <option value="Others Khyber Pakhtunkhwa">Others Khyber Pakhtunkhwa</option>
                                                        <option value="Others Punjab">Others Punjab</option>
                                                        <option value="Others Sindh">Others Sindh</option>
                                                        <option value="Pakpattan">Pakpattan</option>
                                                        <option value="Pasrur">Pasrur</option>
                                                        <option value="Peshawar">Peshawar</option>
                                                        <option value="Pind Dadan Khan">Pind Dadan Khan</option>
                                                        <option value="Pindi Bhattian">Pindi Bhattian</option>
                                                        <option value="Pir Mahal">Pir Mahal</option>
                                                        <option value="Qazi Ahmed">Qazi Ahmed</option>
                                                        <option value="Quetta">Quetta</option>
                                                        <option value="Rahim Yar Khan">Rahim Yar Khan</option>
                                                        <option value="Rajana">Rajana</option>
                                                        <option value="Rajanpur">Rajanpur</option>
                                                        <option value="Ratwal">Ratwal</option>
                                                        <option value="Rawalkot">Rawalkot</option>
                                                        <option value="Rawalpindi">Rawalpindi</option>
                                                        <option value="Rohri">Rohri</option>
                                                        <option value="Sadiqabad">Sadiqabad</option>
                                                        <option value="Sahiwal">Sahiwal</option>
                                                        <option value="Sakrand">Sakrand</option>
                                                        <option value="Samundri">Samundri</option>
                                                        <option value="Sanghar">Sanghar</option>
                                                        <option value="Sangla Hill">Sangla Hill</option>
                                                        <option value="Sarai Alamgir">Sarai Alamgir</option>
                                                        <option value="Sargodha">Sargodha</option>
                                                        <option value="Sehwan">Sehwan</option>
                                                        <option value="Shabqadar">Shabqadar</option>
                                                        <option value="Shahdadpur">Shahdadpur</option>
                                                        <option value="Shahkot">Shahkot</option>
                                                        <option value="Shahpur Chakar">Shahpur Chakar</option>
                                                        <option value="Shakargarh">Shakargarh</option>
                                                        <option value="Shehr Sultan">Shehr Sultan</option>
                                                        <option value="Sheikhupura">Sheikhupura</option>
                                                        <option value="Sher Garh">Sher Garh</option>
                                                        <option value="Shikarpur">Shikarpur</option>
                                                        <option value="Shorkot">Shorkot</option>
                                                        <option value="Sialkot">Sialkot</option>
                                                        <option value="Sibi">Sibi</option>
                                                        <option value="Skardu">Skardu</option>
                                                        <option value="Sudhnoti">Sudhnoti</option>
                                                        <option value="Sujawal">Sujawal</option>
                                                        <option value="Sukkur">Sukkur</option>
                                                        <option value="Swabi">Swabi</option>
                                                        <option value="Swat">Swat</option>
                                                        <option value="Talagang">Talagang</option>
                                                        <option value="Tando Adam">Tando Adam</option>
                                                        <option value="Tando Allahyar">Tando Allahyar</option>
                                                        <option value="Tando Bago">Tando Bago</option>
                                                        <option value="Tando Muhammad Khan">Tando Muhammad Khan</option>
                                                        <option value="Taxila">Taxila</option>
                                                        <option value="Tharparkar">Tharparkar</option>
                                                        <option value="Thatta">Thatta</option>
                                                        <option value="Toba Tek Singh">Toba Tek Singh</option>
                                                        <option value="Turbat">Turbat</option>
                                                        <option value="Vehari">Vehari</option>
                                                        <option value="Wah">Wah</option>
                                                        <option value="Wazirabad">Wazirabad</option>
                                                        <option value="Waziristan">Waziristan</option>
                                                        <option value="Yazman">Yazman</option>
                                                        <option value="Zhob">Zhob</option>
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group @error('address') has-error @enderror">
                                                    <label for="name">Address</label>
                                                    <textarea name="address" id="address" class="form-control">{{old('address')}}</textarea>

                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.box-body -->
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li id="business-school-tab" style="display: {{old('account_type')==='BusinessSchool'?'block':'none'}};">
                            <i class="fa fa-university bg-aqua"></i>

                            <div class="timeline-item">
                                <div class="box box-primary"></div>
                                <span class="time"><i class="fa fa-institution"></i> </span>
                                <h3 class="timeline-header no-border"><a href="#">Business School</a></h3>
                                <div class="timeline-body">
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="form-row col-md-12">
                                                <div class="form-group col-md-8" style="margin-bottom: 10px">
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

                                                <div class="col-md-4">
                                                    <div class="form-group @error('campus_id') has-error @enderror" style="margin-bottom: 20px">
                                                        <label for="campus">Campus</label>
                                                        <select name="campus_id" id="campus_id" class="form-control select2">
                                                            <option value="">Select Campus</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group @error('designation_id') has-error @enderror">
                                                    <label for="name">Designation of Chief Administrative Officer</label>
                                                    <select name="chief_designation_id" id="chief_designation_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Designation</option>
                                                        @foreach($designations as $designation)
                                                            <option value="{{$designation->id}}" {{old('chief_designation_id')==$designation->id?'selected':''}}>{{$designation->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    <div class="form-group @error('cao_name') has-error @enderror" style="margin-bottom: 0px">
                                                        <label for="name">Name of Chief Administrative Office</label>
                                                        <input type="text" name="cao_name" id="cao_name" value="{{old('cao_name')}}" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group @error('discipline_id') has-error @enderror">
                                                        <label for="name">Discipline</label>
                                                        <select name="discipline_id" id="discipline_id" class="form-control select2" style="width: 100%;">
                                                            <option value="">Select Discipline</option>
                                                            @foreach($disciplines as $discipline)
                                                                <option value="{{$discipline->id}}" {{old('discipline_id')==$discipline->id?'selected':''}}>{{$discipline->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group @error('department_id') has-error @enderror">
                                                        <label for="name">Department Name</label>
                                                        <select name="department_id" id="department_id" class="form-control select2" style="width: 100%;">
                                                            <option value="">Select Department</option>
                                                            @foreach($departments as $program)
                                                                <option value="{{$program->id}}" {{old('department_id')==$program->id?'selected':''}}>{{$program->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group @error('undertaking') has-error @enderror">
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
                        <li id="peer-review-tab" style="display: {{old('account_type')==='PeerReviewer'?'block':'none'}};"  >
                            <i class="fa fa-search bg-yellow"></i>

                            <div class="timeline-item">
                                <div class="box box-primary"></div>
                                <span class="time"><i class="fa fa-search"></i></span>
                                <h3 class="timeline-header"><a href="#">Peer Reviewer</a></h3>
                                <div class="timeline-body">
                                        <!-- /.box-header -->
                                        <div class="box-body">

                                            <div class="col-md-4">
                                                <div class="form-group @error('reviewer_role_id') has-error @enderror">
                                                    <label for="name">Role</label>
                                                    <select name="reviewer_role_id" id="reviewer_role_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Role</option>
                                                        @foreach($reviewerRoles as $role)
                                                            <option value="{{$role->id}}" {{old('reviewer_role_id')==$role->id?'selected':''}}>{{$role->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group @error('region_id') has-error @enderror">
                                                    <label for="name">Region</label>
                                                    <select name="region_id" id="region_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Region</option>
                                                        @foreach($regions as $region)
                                                            <option value="{{$region->id}}" {{old('region_id')==$region->id?'selected':''}}>{{$region->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-bottom: 10px;">
                                                <div class="form-group @error('sector_id') has-error @enderror">
                                                    <label for="name">Sector</label>
                                                    <select name="sector_id" id="sector_id" class="form-control select2" style="width: 100%;">
                                                        <option selected disabled>Select Sector</option>
                                                        @foreach($sectors as $sector)
                                                            <option value="{{$sector->id}}" {{old('sector_id')==$sector->id?'selected':''}}>{{$sector->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group @error('qualification') has-error @enderror" style="margin-bottom: 0px">
                                                    <label for="email">Highest Qualification</label>
                                                    <select name="qualification" id="qualification" class="form-control select2" style="width: 100%;">
                                                        <option disabled selected >Select Qualification</option>
                                                        <option value="Doctoral" {{old('qualification')=='Doctoral'?'selected':''}}>Doctoral</option>
                                                        <option value="Masters" {{old('qualification')=='Masters'?'selected':''}}>Masters</option>
                                                        <option value="MBA" {{old('qualification')=='MBA'?'selected':''}}>MBA</option>
                                                        <option value="Post Doctoral" {{old('qualification')=='Post Doctor'?'selected':''}}>Post Doctoral</option>
                                                    </select>
                                                    {{--<input type="text" name="qualification" id="qualification" value="{{old('qualification')}}" class="form-control">--}}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group @error('degree_title') has-error @enderror" style="margin-bottom: 0px">
                                                    <label for="name">Degree Title</label>
                                                    <input type="text" name="degree_title" id="degree_title" value="{{old('degree_title')}}" class="form-control">
                                                    {{--<select name="degree_title" id="degree_title" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Degree</option>
                                                        @foreach($degrees as $degree)
                                                            <option value="{{$degree->id}}" {{old('degree_title')==$degree->id?'selected':''}}>{{$degree->name}}</option>
                                                        @endforeach
                                                    </select>--}}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group @error('specialization') has-error @enderror">
                                                    <label for="email">Specialization</label>
                                                    <select name="specialization" id="specialization" class="form-control select2">
                                                        <option selected disabled>Select Specialization</option>
                                                        @foreach($specializations as $specialization)
                                                            <option value="{{$specialization->id}}" {{old('specialization')==$specialization->id?'selected':''}}>{{$specialization->name}}</option>
                                                        @endforeach
                                                    </select>
                                                   {{-- <input type="text" name="specialization" id="specialization" value="{{old('specialization')}}" class="form-control">--}}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group @error('year_completion') has-error @enderror">
                                                    <label for="name">Year of Degree Completion</label>
                                                    <select name="year_completion" id="year_completion" class="form-control select2" style="width: 100%;">
                                                        <option selected disabled>Select Year</option>
                                                        <?php
                                                        $currently_selected = date('Y');
                                                        $earliest_year = 1960;
                                                        $latest_year = date('Y');
                                                        foreach( range( $latest_year, $earliest_year ) as $i){
                                                        print '<option value="'.$i.'"'.($i === $currently_selected || old('year_completion') == $i ? ' selected="selected"' : '').'>'.$i.'</option>';
                                                        } ?>
                                                    </select>
                                                   {{-- <input type="date" name="year_completion" class="form-control" value="{{old('year_completion')}}">--}}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group @error('institute') has-error @enderror">
                                                    <label for="name">Qualified from Institution</label>
{{--                                                    <input type="text" name="institute" id="institute" class="form-control" value="{{old('institute')}}">--}}
                                                    <!-- <input type="radio" name="rb_institute" class="flat-red rb_institute" value="National"><span>&nbsp;National</span><input type="radio" name="rb_institute" class="flat-red rb_institute" value="International"><span>International</span> -->
                                                    <div class="national">
                                                        <select name="institute" id="institute" class="form-control select2" style="width: 100%;">
                                                            <option value="">Select Business/Institute</option>
                                                            @foreach($business_school as $school)
                                                                <option value="{{$school->id}}" {{old('institute')==$school->id?'selected':''}}>{{$school->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="international hide">
                                                        <input type="text" name="institute" id="institue" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group @error('employed') has-error @enderror">
                                                    <label for="name">Institution Employed at:</label>
                                                    <input type="text" name="employed" id="employed" class="form-control" value="{{old('employed')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group @error('service') has-error @enderror" style="margin-bottom: 0px;">
                                                    <label for="name">Length of Service</label>
{{--                                                    <input type="text" name="service" id="service" class="form-control" value="{{old('service')}}">--}}
                                                    <select name="service" id="service" class="form-control select2">
                                                        <option value="">Select Length of Service</option>
                                                        @for($i = 1; $i<=40; $i++)
                                                            <option value="{{$i}}" {{old('service')== $i?'selected':''}} >{{$i}}</option>
                                                        @endfor
                                                        <option value="more than 40" {{old('service')==='more than 40'?'selected':''}}>More than 40</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group @error('industry_exp') has-error @enderror" style="margin-bottom: 0px;">
                                                    <label for="name">Industry Experience</label>
{{--                                                    <input type="text" name="industry_exp" id="industry_exp" class="form-control" value="{{old('industry_exp')}}">--}}
                                                    <select name="industry_exp" id="industry_exp" class="form-control select2">
                                                        <option value="">Select Industry Experience</option>
                                                        @for($i = 1; $i<=40; $i++)
                                                            <option value="{{$i}}"{{$i==old('industry_exp')?'selected':''}} >{{$i}}</option>
                                                        @endfor
                                                        <option value="more than 40" {{old('industry_exp')==='more than 40'?'selected':''}}>More than 40</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group @error('academic_exp') has-error @enderror">
                                                    <label for="name">Academic Experience</label>
{{--                                                    <input type="text" name="academic_exp" id="academic_exp" class="form-control" value="{{old('academic_exp')}}">--}}
                                                    <select name="academic_exp" id="academic_exp" class="form-control select2">
                                                        <option value="">Select Academic Experience</option>
                                                        @for($i = 1; $i<=40; $i++)
                                                            <option value="{{$i}}" {{$i==old('academic_exp')?'selected':''}} >{{$i}}</option>
                                                        @endfor
                                                        <option value="more than 40" {{old('academic_exp')==='more than 40'?'selected':''}}>More than 40</option>
                                                    </select>
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
                                            {{--<div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Rationale to recommend</label>
                                                    <input type="text" name="rational_recommend" id="rational_recommend" class="form-control" value="{{old('ratoinal_recommend')}}">
                                                    @error('rational_recommend')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>--}}

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
            <!-- /.modal -->
            <div class="modal fade" id="question-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Eligibility Screening Criteria.</h4>
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

            <div class="modal fade" id="discipline_modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Add New Discipline</h4>
                        </div>
                            <div class="modal-body">
                                <form method="post">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="discipline_name">Discipline Name</label>
                                            <input type="discipline_name" id="discipline_name" class="form-control">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <input type="button" class="btn btn-info" value="Add" id="add_discipline">
                                    </div>
                            </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="department_modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Add New Department</h4>
                        </div>
                        <form method="post">
                            <div class="modal-body">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="discipline_name">Department Name</label>
                                            <input type="department_name" id="department_name" class="form-control">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <input type="button" class="btn btn-info" value="Add" id="add_department">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>
    <script src="{{URL::asset('plugins/iCheck/icheck.min.js')}}"></script>
    <!-- Select2 -->
    <script>
        $(":input").inputmask();

    </script>
    <script src="{{URL::asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2').select2();

        $('#reviewer_role_id').on('change', function () {
            let role = $(this).val();
            if (role === '1')
            {
                $('#sector_id').select2().val(3).trigger('change');
            }else{
                $('#sector_id').select2({
                    placeholder:'select sector',
                    allowClear: true
                });
                $('#sector_id').val('').trigger('change');
            }
        });
        $('#business_school_id').select2({
            sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
        });
        $('#institute').select2({
            sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
        });

        // $('#country').select2({
        //     sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
        // }).val('Pakistan').trigger('change');
        //Flat red color scheme for iCheck

        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#discipline_id').on('change', function () {
            let val = $(this).val();
            if(val === '5')
            {
                $('#discipline_modal').modal('show');
            }
        });

        $('#BusinessSchool').on('click', function () {
            console.log('clicked on business sschool', $(this).val());
            $('#question-modal').modal('show');
        });

        $('#department_id').on('change', function () {
            let val = $(this).val();
            if(val === '5')
            {
                $('#department_modal').modal('show');
            }
        });

        $('#add_discipline').on('click', function () {
            let discipline_name = $('#discipline_name').val();
            !discipline_name?addClass('discipline_name'):removeClass('discipline_name');
            if(!discipline_name){
                Notiflix.Notify.Failure("Discipline name field is required.");
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{{url('add-discipline')}}",
                data: {name:discipline_name},
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
                    let insert_id = response.insert_id;
                    if(insert_id){

                        let options = $('<option selected></option>').val(insert_id).text(discipline_name);
                        $('#discipline_id').append(options).trigger('change');
                    }
                    $('#discipline_modal').modal('hide');
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

        $('#add_department').on('click', function () {
            let department_name = $('#department_name').val();
            !department_name?addClass('department_name'):removeClass('department_name');
            if(!department_name){
                Notiflix.Notify.Failure("Department name is required.");
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{{url('add-department')}}",
                data: {name:department_name},
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
                    let insert_id = response.insert_id;
                    if(insert_id){

                        let options = $('<option selected></option>').val(insert_id).text(department_name);
                        $('#department_id').append(options).trigger('change');
                    }
                    $('#department_modal').modal('hide');
                    console.log('response here', response);
                },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })

                }
            });

        })
        $('input[name=account_type]').on('ifChecked', function(e){
            console.log(' account type ', $(this).val());
            if($(this).val() !== 'BusinessSchool') {
                $('button[name=submit]').removeAttr('disabled');
            }


            console.log('change school type', $(this).val());
            let toggle = $(this).val();

            (toggle==='BusinessSchool')?$('#question-modal').modal('show'):$('#question-modal').modal('hide');
            (toggle==='BusinessSchool')?$('#business-school-tab').toggle('slow'):$('#business-school-tab').fadeOut('slow');
            (toggle==='BusinessSchool')?$('#questionnaire-dev').toggle('show'):'';
            (toggle==='PeerReviewer')?$('#peer-review-tab').toggle('slow'):$('#peer-review-tab').fadeOut('slow');
            (toggle==='PeerReviewer')?$('#questionnaire-dev').toggle('hide'):'';

        });

        
        // $('input[name=rb_institute]').on('ifChecked' ,function (){
        //     if(this.checked){
        //         if(this.value == "National"){
        //             $('.national').removeClass('hide');
        //             $('.international').addClass('hide');
        //         }else{
        //             $('.international').removeClass('hide');
        //             $('.national').addClass('hide');
        //         }
        //     }
        // })

        $("#submit").on('click', function () {

            let business_school_id = $('#business_school_id').val();
            let department_id = $('#department_id').val();
            let campus_id = $('#campus_id').val();
            // !business_school_id?addClass('business_school_id'):removeClass('business_school_id');
            // if(!business_school_id){
            //     Notiflix.Notify.Failure("Please select business school.");
            //     return false;
            // }
            // if(!department_id){
            //     Notiflix.Notify.Failure("Please select Department.");
            //     return false;
            // }
            //
            // if(!campus_id){
            //     Notiflix.Notify.Failure("Please select Campus.");
            //     return false;
            // }
            let radioVal = $('input:radio:checked').map(function(i, el){return {"id":$(el).data('id'),"value":$(el).val()};}).get();

            let data = {business_school_id:business_school_id, department_id:department_id, campus_id:campus_id};
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
        })
        function matchStart(params, data) {
            // If there are no search terms, return all of the data
            if ($.trim(params.term) === '') {
                return data;
            }

            // Skip if there is no 'children' property
            if (typeof data.text === 'undefined') {
                return null;
            }

            // `data` contains the actual options that we are matching against
            if(data.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0){
                var modifiedData = $.extend({}, data, true);
                // You can return modified objects from here
                // This includes matching the `children` how you want in nested data sets
                return modifiedData;
            }


            // Return `null` if the term should not be displayed
            return null;
        }
        // $('#country').on('change', function () {
        //     let country= $(this).val();
        //     $.ajax({
        //         type: 'GET',
        //         url: "{{url('get-cities')}}",
        //         data: {
        //             country: country
        //         },
        //         // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
        //         success: function (response) {
        //             console.log('response here', response);
        //             var data =[];
        //             //$('#city').val(null);
        //             $("#city").empty();
        //             Object.keys(response).forEach(function (index) {
        //                 data.push({id:response[index].name, text:response[index].name});
        //             })
        //             $('#city').select2({
        //                 data,
        //                 matcher: matchStart
        //             });
        //         },
        //         error:function(response, exception){
        //             Notiflix.Loading.Remove();
        //             $.each(response.responseJSON, function (index, val) {
        //                 Notiflix.Notify.Failure(val);
        //             })

        //         }
        //     });
        // })

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
    </script>

    

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <script>Notiflix.Notify.Failure('{{$error}}')</script>
        @endforeach
        <script>
            Notiflix.Notify.Info("Do not forget to refill the password.");
        </script>
    @endif
