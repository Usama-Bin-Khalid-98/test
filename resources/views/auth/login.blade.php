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


</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" action="{{ route('login') }}" method="post">
                @csrf
					<span class="login100-form-title p-b-26">
						NBEAC Login
					</span>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
                    <input class="input100" type="email" id="email" name="email" required @error('email')  is-invalid @enderror" value="{{ old('email') }}">
                    <span class="focus-input100" data-placeholder="Email"></span>

                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                    <input class="input100" type="password" id="password" name="password" required id="password" @error('password') is-invalid @enderror">
                    <span class="focus-input100" data-placeholder="Password"></span>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">
                            {{ __('Login') }}
                        </button>
                    </div>
                </div>
                <div class="text-center-login100 remember" style="margin-left: 26px;">
                    <div class="checkbox icheck">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} >
                        {{ __('Remember Me') }}
                    </div>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}" style="color:#fff">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>

                <div class="text-center p-t-115">
						<span class="txt1">
							Don’t have an account?
						</span>

                    <a class="txt2" href="/register">
                        Sign Up
                    </a>
                </div>
            </form>
        </div>
    </div>
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

@error('email')
@if(@$message)
<script>
    Notiflix.Notify.Failure('{{ $message }}');
</script>
@endif
@enderror
</body>
</html>
