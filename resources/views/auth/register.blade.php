<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V2</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{URL::asset('login_form/icons/favicon.ico')}}"/>
    <!--===============================================================================================-->
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('login_form/fonts/iconic/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('bower_components/font-awesome/css/font-awesome.min.css')}}">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('login_form/css/main.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{URL::asset('plugins/iCheck/all.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::asset('dist/css/AdminLTE.min.css')}}">

</head>
<body>
<div class="jumbotron jumbotron-fluid" style="padding-bottom: 0;">
    <div class="container">
        <img src="{{URL::asset('dist/img/logo.jpg')}}" style="width: 100px">
        <span class="lead" style="font-size: 20px;"><strong>NBEAC</strong> (National Business Educaton Accreditatoin Council).</span>
    </div>
</div>

<div class="limiter">
    <div class="container" style="margin-bottom: 40px;">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <section>
            <form class=" validate-form" action="{{ route('register') }}" method="post">
                @csrf
                <div class="wrap-register100">
                <span class="login100-form-title p-b-26">NBEAC Registration</span>
               <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="name">{{ __('Business School Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="name">{{ __('Contact Person') }}</label>
                        <input type="text" class="form-control @error('contact_person') is-invalid @enderror" name="contact_person" value="{{ old('contact_person') }}" required autocomplete="contact_person" autofocus>
                    @error('contact_person')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="name">{{ __('Year of Establishment') }}</label>
                        <input type="date" class="form-control @error('year_estb') is-invalid @enderror" name="year_estb" value="{{ old('year_estb') }}" required autocomplete="year_estb" autofocus>
                    @error('year_estb')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
               </div>
                    {{--charter row--}}
              <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="date">{{ __('Charter Granted Date') }}</label>
                        <input type="date" class="form-control @error('date_charter_granted') is-invalid @enderror" name="date_charter_granted" value="{{ old('date_charter_granted') }}" required autocomplete="date_charter_granted">
                        @error('date_charter_granted')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="number">{{ __('Charter Number') }}</label>
                        <input type="text" class="form-control @error('charter_number') is-invalid @enderror" name="charter_number" value="{{ old('charter_number') }}" required autocomplete="charter_number">
                        @error('charter_number')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="type">{{ __('Charter Type') }}</label>
                       <select name="charter_type_id" class="form-control">
                           <option value="1">Select Charter Type</option>
                           <option value="2">Azad Jammu Kashmir</option>
                           <option value="3">Balochistan</option>
                           <option value="4">Federal</option>
                           <option value="5">Gilgit Baltistan</option>
                           <option value="6">International</option>
                           <option value="7">Khyber Pakhthunkhwa</option>
                           <option value="8">Panjab</option>
                           <option value="9">Sindh</option>
                       </select>
                </div>
              </div>
                    {{--web url row--}}
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="weburl">{{ __('Web Url') }}</label>
                  <input type="text" class="form-control @error('web_url') is-invalid @enderror" name="web_url" value="{{ old('web_url') }}" required autocomplete="web_url">
                  @error('web_url')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-group col-md-4">
                      <label for="type">{{ __('Institute Type') }}</label>
                      <select name="institute_type_id" class="form-control">
                          <option value="1"> Select Institute Type</option>
                          <option value="2">University</option>
                          <option value="3">Degree Awarding Institute</option>
                      </select>
                  </div>
                <div class="form-group col-md-4">
                    <label for="address">{{ __('Address') }}</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address">{{old('address')}}</textarea>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>

              </div>


              <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                </div>

                  <div class="form-group col-md-4">
                      <label for="password-confirm">{{ __('Confirm Password') }}</label>
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  </div>

               </div>

              <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="type">{{ __('Profit Status') }} : </label>
                            <label><input type="radio" name="profit_status" class="flat-red" value="None Profit"> None Profit</label>
                            <label><input type="radio" name="profit_status" class="flat-red" value="For Profit"> For Profit</label>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="type">{{ __('Hierarchical Context') }} : </label>
                            <label><input type="radio" name="hierarchical_context" class="flat-red" value="Affiliated">Affiliated</label>
                            <label><input type="radio" name="hierarchical_context" class="flat-red" value="Constituent Part">Constituent Part</label>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="sector">{{ __('Sector') }} : </label>
                            <label><input type="radio" name="sector" class="flat-red" value="Public">Public</label>
                            <label><input type="radio" name="sector" class="flat-red" value="Private">Private</label>

                        </div>
                    </div>

              <div class="form-group">
                <div class="form-group row">
                    <div class="col-md-6 " style="margin-left: 20px">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
               </div>
                </div>
            </form>
        </section>
    </div>
</div>

<div class="container-fluid" >
    <footer class="main-footer" style="margin-left: 0px;">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.18
        </div>
        <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
        reserved.
    </footer>
</div>



<!--===============================================================================================-->
<!-- jQuery 3 -->
<script src="{{URL::asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!--===============================================================================================-->
<!-- Bootstrap 3.3.7 -->
<script src="{{URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{URL::asset('login_form/js/main.js')}}"></script>
<script src="{{URL::asset('notiflix/notiflix-2.3.2.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{URL::asset('plugins/iCheck/icheck.min.js')}}"></script>
@error('email')
@if(@$message)
    <script>
        Notiflix.Notify.Failure('{{ $message }}');
    </script>
@endif
@enderror

<script>
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
    })
</script>
</body>
</html>
