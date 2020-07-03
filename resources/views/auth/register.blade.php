<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration Form</title>
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
    <meta name="csrf-token" content="{{csrf_token()}}">

</head>
<body>
<div class="jumbotron jumbotron-fluid" style="padding-bottom: 0;">
    <div class="container">
        <img src="{{URL::asset('dist/img/logo.png')}}" style="width: 100px">
        <span class="lead" style="font-size: 20px;"><strong>NBEAC</strong> (National Business Educaton Accreditatoin Council).</span>
    </div>
</div>

<div class="limiter">
    <div class="container" style="margin-bottom: 40px;">

{{--        @if ($errors->any())--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <p class="text-red">{{ $error }}</p>--}}
{{--                    @endforeach--}}
{{--        @endif--}}
        <section>
            <form class=" validate-form" action="{{ route('register') }}" method="post">
                @csrf
                <div class="wrap-register100">
                <span class="login100-form-title p-b-26">NBEAC Registration</span>
               <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="school_name">{{ __('Business School Name') }}</label>
                    <div class="input-group">
                    <select name="school_name" class="form-control">
                        <option value="">Select Business School</option>
                        @foreach($business_school as $school)
                        <option value="{{$school->id}}">{{$school->name}}</option>
                        @endforeach
                    </select>
                        <span class="input-group-btn">
                      <button type="button" data-toggle="modal" data-target="#add-modal"  class="btn btn-info btn-flat"><i class="fa fa-plus"></i></button>
                    </span>
                    </div>

                        @error('name')
                        <p class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                </div>
                <div class="form-group col-md-4 ">
                    <label for="name">{{ __('Contact Person') }}</label>
                        <input type="text" class="form-control @error('contact_person') is-invalid @enderror" name="contact_person" value="{{ old('contact_person') }}" required autocomplete="contact_person" autofocus>
                    @error('contact_person')
                        <p class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="name">{{ __('Year of Establishment') }}</label>
                        <input type="date" class="form-control @error('year_estb') is-invalid @enderror" name="year_estb" value="{{ old('year_estb') }}" required autocomplete="year_estb" autofocus>
                    @error('year_estb')
                        <p class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                </div>
               </div>
                    {{--charter row--}}
              <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="date">{{ __('Charter Granted Date') }}</label>
                        <input type="date" class="form-control @error('date_charter_granted') is-invalid @enderror" name="date_charter_granted" value="{{ old('date_charter_granted') }}" required autocomplete="date_charter_granted">
                        @error('date_charter_granted')
                        <p class="text-red" role="alert">
                          <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="number">{{ __('Charter Number') }}</label>
                        <input type="text" class="form-control @error('charter_number') is-invalid @enderror" name="charter_number" value="{{ old('charter_number') }}" required autocomplete="charter_number">
                        @error('charter_number')
                        <p class="text-red" role="alert">
                          <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="type">{{ __('Charter Type') }}</label>
                       <select name="charter_type_id" class="form-control">
                           <option value="1">Select Charter Type</option>
                            @foreach($chart_types as $charter)
                             <option value="{{$charter->id}}">{{$charter->name}}</option>
                            @endforeach
                       </select>
                </div>
              </div>
                    {{--web url row--}}
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="weburl">{{ __('Web Url') }}</label>
                  <input type="text" class="form-control @error('web_url') is-invalid @enderror" name="web_url" value="{{ old('web_url') }}" required autocomplete="web_url">
                  @error('web_url')
                  <p class="text-red" role="alert">
                      <strong>{{ $message }}</strong>
                    </p>
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
                        <textarea class="form-control @error('address') @enderror" name="address" required autocomplete="address">{{old('address')}}</textarea>
                        @error('address')
                        <p class="text-red" role="alert">
                          <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                </div>

              </div>


              <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <p class="text-red" role="alert">
                          <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <p class="text-red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
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
                            <p><input type="radio" name="profit_status" class="flat-red" value="None Profit" {{ old('profit_status') == 'None Profit' ? 'checked' : '' }}> None Profit</p>
                            <p><input type="radio" name="profit_status" class="flat-red" value="For Profit" {{ old('profit_status') == 'For Profit' ? 'checked' : '' }}> For Profit</p>
                            @error('profit_status')
                            <p class="text-red" role="alert">
                          <strong>{{ $message }}</strong>
                        </p>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="type">{{ __('Hierarchical Context') }} : </label>
                            <p><input type="radio" name="hierarchical_context" class="flat-red" value="Affiliated" {{ old('hierarchical_context') == 'Affiliated' ? 'checked' : '' }}> Affiliated</p>
                            <p><input type="radio" name="hierarchical_context" class="flat-red" value="Constituent Part" {{ old('hierarchical_context') == 'Constituent Part' ? 'checked' : '' }}> Constituent Part</p>
                            @error('hierarchical_context')
                            <p class="text-red" role="alert">
                          <strong>{{ $message }}</strong>
                        </p>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="sector">{{ __('Sector') }} : </label>
                            <p><input type="radio" name="sector" class="flat-red" value="Public" {{ old('sector') == 'Public' ? 'checked' : '' }}> Public</p>
                            <p><input type="radio" name="sector" class="flat-red" value="Private" {{ old('sector') == 'Private' ? 'checked' : '' }}> Private</p>
                            @error('sector')
                            <p class="text-red" role="alert">
                          <strong>{{ $message }}</strong>
                        </p>
                            @enderror
                        </div>
                    </div>

              <div class="form-group">
                <div class="form-group row">
                    <div class="col-md-4 " style="margin-left: 20px">
                        <button type="submit" class="btn btn-info">
                            {{ __('Register') }}
                        </button>
                    </div>

                    <div class="col-md-3 " style="margin-left: 20px">
                        <a href="/login" type="submit" class="badge-info text-blue">
                            {{ __('Already have Account') }}
                        </a>
                    </div>
                </div>
               </div>
                </div>
            </form>
        </section>
    </div>
</div>

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
                            <input type="text" class="form-control" id="name" placeholder=" Business School Name" name="name">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="contact_no">Contact Number</label>
                            <input type="text" class="form-control" id="contact_no" placeholder="Contact Number" name="contact_no">
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

<div class="container-fluid" >
    <footer class="main-footer" style="margin-left: 0px;">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.18
        </div>
        <strong>Copyright &copy; {{date('Y')}} <a href="#">NBEAC</a>.</strong> All rights
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
    });
    //// add, remove error class
    let addClass = (e) => {
        $('#'+e).parent().addClass('has-error');
    }
    let removeClass = (e) => {
        $('#'+e).parent().removeClass('has-error')
    }

</script>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            Notiflix.Notify.Failure('{{ $error }}');
        </script>
    @endforeach

@endif

</body>
</html>
