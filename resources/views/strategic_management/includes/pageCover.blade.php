                    <style>
                        .centerme{ text-align: center;}
                    </style>
                    <div style="text-align: center; font-size: 14px;">
                        <p style="text-align: justify; margin-left: 10%;">
                            Name of University: <span style="font-size: 12px;">{{$docHeaderData->campus->business_school->name??''}}</span>
                        <br>Name of Business School: <span style="font-size: 12px;">{{$docHeaderData->department->name??''}}</span>
                        <br>Program(s) for Review: <span style="font-size: 12px;"> @foreach($app_Received as $program) {{$program->programName}}, @endforeach</span>
                        <br>Submission date:  <span style="font-size: 12px;">{{$docHeaderData->registration_date??''}}</span>
                        </p>
                    </div>
                        <br /><br /><br /><br /><br /><br /><br /><br />
                    <div class="center"><h1 style="text-align: center"><b>Registration</b></h1></div>
                    <div class="center"><h1 style="text-align: center"><b>Application</b></h1></div>
                    <h5 style="text-align: center;height: 200px;"><b>NBEAC</b></h5><br><hr>
                    <p class="center">The registration application is to be completed by the business school seeking for accreditation under </p><p class="center">National Business Education Accreditation Council (NBEAC) of the Higher Education Commission, Pakistan</p>
                    <br>
                    <div class="row center" style="page-break-after: always;position: relative;width: 100%;">
                        <div style="position: absolute;left: 35%;top:20px">
                            <img src="{{asset('/images/nbeacLogo.jpg')}}" width="100px">
                        </div>
                        <div style="position: absolute;left:50%;">
                            <img src="{{asset('/images/HECLogo.jpg')}}" width="100px">
                        </div>

                    </div><br><br><br><br>
