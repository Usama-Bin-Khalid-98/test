@include("../includes.head")

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
                <div class="card-header lead">{{ __('Focal person for this campus already exists!') }}</div>
                <div class="card-body lead">
                    {{ __('Only one user is allowed per campus. Please contact NBEAC Administration if you want to change the existing focal person.') }}
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .main-footer{
        margin-left: 92px !important;
    }
</style>
<div class="footer" style="margin-top: 350px !important;">
    @include("../includes.footer")
</div>

</body>
