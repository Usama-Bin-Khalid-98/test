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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{URL::asset('notiflix/notiflix-2.3.2.min.js')}}"></script>
<style>
    .main-footer{
        margin-left: 92px !important;
    }
</style>
<div class="footer" style="margin-top: 350px !important;">
    <form class="pull-right" method="POST" action="{{ route('reRegister') }}">
        @csrf
        <span style="font-size:medium; margin-right:12px">Not receiving email? <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Signup Again</button></span>
    </form>
@include("../includes.footer")
</div>
