@section('pageTitle', 'Print Registration')


@if(Auth::user())

    @include("../includes.head")
     <!-- Select2 -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />
    @include("../includes.header")
    <style type="text/css">
        table, th, td, thead{
            border: 0.5px solid black !important;
            border-collapse: collapse !important;
            width: 20%;
        }
    </style>
    @include("../includes.nav")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Print Registration
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Print Registration </li>
            </ol>

        </section>
        <section class="content-header">
            <div class="col-md-12 new-button">
                <div class="pull-right">
{{--                    <button class="btn gradient-bg-color"--}}
{{--                           data-toggle="modal" data-target="#add-modal"--}}
{{--                           style="color: white;"--}}
{{--                           value="Add New"--}}
{{--                            name="add" id="add">PDF <i class="fa fa-file-pdf-o"></i></button>--}}
                            <button class="btn gradient-bg-color" style="color: white;" onclick="Export2Doc('printIDABC');">Export as .doc <i class="fa fa-file-word-o"></i></button>
                            <button class="btn btn-primary" id="printDev">Print</button>
                </div>
            </div>
        </section>

        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content" id="printIDABC">
            <div class="row">
                <div class="col-md-12">


                    <!-- .box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"></h3>
                        </div><br>
                        <br><br><br><br><br>
                    @include('strategic_management.includes.pageCover')
                    @include('strategic_management.includes.contents')

                     <br><br><br><br><br>

                    <h1 class="center">Preface</h1><br>
                    <div class="row" style="page-break-after: always;">
                        <div class="col  col-md-1 col-lg-1"></div>

                        <div class="col col-sm-12 col-md-10 col-lg-10">
                            <p class="justify">This document is intended to provide succinct factual information about the School that allows it to be assessed against the eligibility criteria of National Business Education Accreditation Council (NBEAC). A business school seeking for accreditation is expected to understand that the precision and completeness of data provided in the registration application is important for an effective accreditation process as it help NBEAC Committee accurately analyze actual situation of the program(s) under review. NBEAC will trust the data provided at this stage since it will be checked at a later stage, if applicable. Please make sure that this document contains page numbers. </p>
                            <p class="justify">For schools applying to NBEAC for the first time, it should be noted that no additional information provided by the School besides that contained in the application will be conveyed to the NBEAC Committee.
                            For schools applying to NBEAC for re-accreditation/re-visit, this application should be completed when starting the reaccreditation cycle; an updated application should be submitted together with the supporting documents.
                            </p>
                            <p class="justify">Senior Program Manager - Accreditation</p>
                            <p class="justify">National Business Education Accreditation Council
                            Islamabad
                            </p>
                        </div>
                        <div class="col  col-md-1 col-lg-1"></div>


                    </div><br><br><br><br><br><br>


                    <div>
                        <div class="center">
                            <h1>Instructions for the application preparation</h1>
                        </div><br><br>
                        <div class="row" style="page-break-after: always;">
                        <div class="col  col-md-1 col-lg-1"></div>

                        <div class="col col-sm-12 col-md-10 col-lg-10">
                            <p class="left">1.   Before starting the registration application, please go through the guidelines given in Section III of the NBEAC Accreditation Process Manual<a href="https://www.nbeac.org.pk/images/Accreditation/accreditation-process-manual-2019.pdf"> <span style="color: blue"> https://www.nbeac.org.pk/images/Accreditation/accreditation-process-manual-2019.pdf</span></a> in order to ensure that the application is prepared in accordance with these guidelines.</p>
                            <p class="left">2.   Note that no change in the original text and structure of the application is permitted at all. However, the data in colored font is given only for demonstrative purpose; please replace it with actual data.</p>
                            <p class="left">3.   A question in the registration application may require certain information in the form of a table, an appendix, or descriptive text paragraphs. Please make sure that response to each of the questions is exactly the way it is asked for. </p>
                            <p class="left">4.   Include only relevant information described in a clear, concise and meaningful way based on factual data rather than opinions.</p>
                            <p class="left">5.   After the application is prepared, submit a copy to the NBEAC Secretariat for desk review. Follow remarks of the NBEAC Secretariat to make up for any deficiencies pointed out during the desk review. To avoid any unnecessary delay during desk review, please make sure that all required documents are included, and are properly filled in. </p>
                            <p class="left">6.   The NBEAC Secretariat is always there to help clarifying any ambiguity regarding filling in data in the application. However, it is recommendable to carefully read through footnotes and other auxiliary texts before contacting the secretariat in this regard.</p>
                            <p class="left">7.   Please address all correspondence to the following address:</p>
                            <p class="left">National Business Education Accreditation Council</p>
                            <p class="left">201, 2nd Floor, HRD Division, Higher Education Commission</p>
                           <p class="left"> H-8 Islamabad, Pakistan</p>
                            <p class="left">Phone: +92 51 9080 0206, Fax: +92 51 9080 0208
                            </p>
                        </div>
                        <div class="col  col-md-1 col-lg-1"></div>


                    </div>
                    </div><br><br><br><br><br>



                    <div>
                        <div class="center">
                            <h1>Undertaking</h1>
                        </div><br><br>
                        <div class="row" >
                        <div class="col  col-md-1 col-lg-1"></div>

                        <div class="col col-sm-12 col-md-10 col-lg-10"><p class="left">I, the undersigned, fully understand and agree with the terms and conditions of the NBEAC given below. </p>
                            <p class="left">1.  I confirm the accuracy of the information provided in the registration application, and as the authorized representative commit the business school to go through the NBEAC accreditation process. </p>
                            <p class="left">2.  I agree that the business school under review will pay the NBEAC accreditation fee as defined in the NBEAC Fee Schedule <a style="color:blue" href="https://www.nbeac.org.pk/index.php/accreditation-2/accreditation-fee-2"> https://www.nbeac.org.pk/index.php/accreditation-2/accreditation-fee-2</a>, which is effective at the date of the submission of this application form.</p>
                            <p class="left">3.  I confirm that we shall provide any relevant documents to the NBEAC committee in case they ask for during the screening process, and will accept the decisions of NBEAC with respect to the registration process. The NBEAC, its directors, employees and consultants shall not be liable for any direct or indirect, foreseeable or unforeseeable damages resulting from the conception and implementation of the standards, the accreditation process, or the final decision of the NBEAC about registration.</p>
                            <p class="left">4.  In case the business school unilaterally decides to stop the process, a cancellation request must be submitted to the NBEAC Secretariat.</p><br><br>
                            <p>
                            Signature: _______________________________________ Stamp of the organization: ________________________</p>
                            <p>Name of the signatory: _____________________________ Date __________________________________________</p>
                            <p>Position of the signatory __________________________________________________________________________</p>
                            <p>Name of University/Institute: <strong>{{$docHeaderData->campus->business_school->name??''}}</strong></p>
                            <p>Department/Business School under review: <strong>{{$docHeaderData->department->name??''}}</strong></p>
                            <p>Postal address: <strong>{{$docHeaderData->campus->user->address??''}}</strong></p>
                            <p>City and country: <strong>{{$docHeaderData->campus->user->city??''}}, {{$docHeaderData->campus->user->country??''}}</strong></p>
                            <p>Telephone: <strong>{{$docHeaderData->campus->user->contact_no??''}}</strong></p>


                        </div>
                        <div style="page-break-after: always;" class="col  col-md-1 col-lg-1"></div>


                    </div>
                    </div><br><br><br><br><br>







                        <!-- /.box-header -->
                    <h5 class="left" style="color:red">Section 1. Strategic Management</h5>
                    <p class="left">1.1. Provide basic information about the business school  in Table 1.1.</p>
                    @include('strategic_management.includes.registration1')

                    <h5 class="left" style="color:red">Section 2. Curriculum</h5>
                    @include('strategic_management.includes.registration2')
                    <h5 class="left" style="color:red">Section 3. Students</h5>
                    @include('strategic_management.includes.registration3')
                    <h5 class="left" style="color:red">Section 4. Faculty</h5>
                    @include('strategic_management.includes.registration4')
                    <h5 class="left" style="color:red">Section 5. Research and Development</h5>
                    @include('strategic_management.includes.registration5')

                    <h5 class="left" style="color:red">Section 6. Resources</h5>
                    @include('strategic_management.includes.registration6')

                    <hr>
                    <p class="left">1  The term “school” is used in the NBEAC process to designate the entity that is applying for NBEAC accreditation, whether it is a free standing business school or a faculty, school or department within a university.</p>
                    <p class="left">2  Replace the text with actual semester names. In case admission are taken biennially, mark “N/A” for the semester no admission is offered.</p>
                    <p class="left">3   Enrollment means total number of students enrolled from first semester to last semester of a program. 16 years study programs include BBA/B.Com; 18 years programs include MS/MPhil/MBA/MPA/M.Com et cetera. </p>
                    <p class="left">4   Year t, Year t-1, and Year t-2 correspond to last three years i.e. Year t means current year, Year t-1 is the last year, and Year t-2 is the year before last year. As annual data is required, therefore each year includes both fall & spring sessions. Please replace row headers with actual years.</p>
                    <p class="left">5   This column shows the total annual enrollment of the school/department as a whole, not just the program(s) under accreditation.</p>
                    <p class="left">6   Core business faculty: Faculty with terminal degree in business, management and related areas and teaching core business courses.</p>
                    <p class="left">7   Maximum teaching courses allowed as per course load policy</p>
                    <p class="left">8   Report data on research and publication for the core faculty, defined as members of the faculty for whom the school is the principal employer. The report should not include publications of part-time staff from other schools or departments, adjunct faculty, visiting professors, or business practitioners.</p>
                    <p class="left">9   Only include faculty members from within the school at the time of production</p>
                    <p class="left">10  Articles, conference papers, journal articles, and other research work published in HEC recognized journals / ISI index journals, conference proceedings, and other reputable abstracting indexing service i.e. EMERALD, JSTOR, Science Direct, etc.</p>
                    <p class="left">11  Income generated through various trainings and workshops conducted by the business school.</p>
                    <br><br><br><br>
                    <h1 class="center">Checklist of mandatory appendices with registration application</h1>
                    @include('strategic_management.includes.registrationCheckList')

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

    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Strategic Plan. </h4>
                </div>

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
    <script>
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        });
        $(function () {
            $('#printTable').DataTable()
        })


        $('#printDev').on('click', function (){
            var mywindow = window.open('', 'PRINT', 'height=400,width=600');

            mywindow.document.write('<html><head><title>' + document.title  + '</title>');
            mywindow.document.write('</head><body >');
            mywindow.document.write('<h1>' + document.title  + '</h1>');
            mywindow.document.write(document.getElementById('printIDABC').innerHTML);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            mywindow.print();
            mywindow.close();

            return true;
        });
    </script>
    <script type="text/javascript">

        $('.select2').select2()

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

         $('#form').submit(function (e) {
            let plan_period = $('#plan_period').val();
            let aproval_date = $('#aproval_date').val();
            let aproving_authority = $('#aproving_authority').val();

            !plan_period?addClass('plan_period'):removeClass('plan_period');
            !aproval_date?addClass('aproval_date'):removeClass('aproval_date');
            !aproving_authority?addClass('aproving_authority'):removeClass('aproving_authority');

            if(!plan_period || !aproval_date || !aproving_authority)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("strategic/strategic-plan")}}',
                type:'POST',
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
                    console.log('response', response);
                    location.reload();
                },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })
                }
            })
        });


         $('.edit').on('click', function () {
            // let data = JSON.parse(JSON.stringify($(this).data('row')));
             let data = JSON.parse(JSON.stringify($(this).data('row')));
            $('#edit_plan_period').val(data.plan_period);
            $('#edit_aproval_date').val(data.aproval_date);
            $('#edit_aproving_authority').val(data.aproving_authority);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let plan_period = $('#edit_plan_period').val();
            let aproval_date = $('#edit_aproval_date').val();
            let aproving_authority = $('#edit_aproving_authority').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !plan_period?addClass('edit_plan_period'):removeClass('edit_plan_period');
            !aproval_date?addClass('edit_aproval_date'):removeClass('edit_aproval_date');
            !aproving_authority?addClass('edit_aproving_authority'):removeClass('edit_aproving_authority');

            if(!plan_period || !aproval_date || !aproving_authority)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("strategic/strategic-plan")}}/'+id,
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
                    location.reload();
                },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })
                }
            })
        });


         $('.delete').on('click', function (e) {
            let id =  $(this).data('id');
            Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to delete?', 'Yes', 'No',
                function(){
                    // Yes button callback
                    $.ajax({
                        url:'{{url("strategic/strategic-plan")}}/'+id,
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




         function Export2Doc(element, filename = ''){
            var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head>  <meta charset='utf-8'>  <meta http-equiv='X-UA-Compatible' content='IE=edge'>  <title>@yield('pageTitle')</title>  <!-- Tell the browser to be responsive to screen width -->  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>  <!-- Bootstrap 3.3.7 -->  <link rel='stylesheet' href=\"{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}\">  <!-- Font Awesome -->  <link rel='stylesheet' href=\"{{ asset('bower_components/font-awesome/css/font-awesome.min.css')}}\">  <!-- Ionicons -->  <link rel=\"stylesheet\" href=\"{{ asset('bower_components/Ionicons/css/ionicons.min.css')}}\">  <!-- Theme style -->  <link rel=\"stylesheet\" href=\"{{ asset('dist/css/AdminLTE.min.css')}}\">  <!-- AdminLTE Skins. Choose a skin from the css/skins       folder instead of downloading all of them to reduce the load. -->  <link rel=\"stylesheet\" href=\"{{ asset('dist/css/skins/_all-skins.min.css')}}\">  <!-- Date Picker -->  <link rel=\"stylesheet\" href=\"{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}\">  <!-- Daterange picker -->  <link rel=\"stylesheet\" href=\"{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}\">  <!-- bootstrap wysihtml5 - text editor -->  <link rel=\"stylesheet\" href=\"{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}\">  <link rel=\"stylesheet\" href=\"{{ asset('css/custom.css')}}\">  <!-- Google Font --><meta name=\"csrf-token\" content=\"{{csrf_token()}}\"><link rel=\"stylesheet\" href=\"{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}\">    <!-- DataTables -->    <link rel=\"stylesheet\" href=\"{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}\">    <link rel=\"stylesheet\" href=\"{{URL::asset('plugins/iCheck/all.css')}}\">    <link rel=\"stylesheet\" href=\"{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}\" />        <style type=\"text/css\">        table, th, td, thead{            border: 0.5px solid black !important;             border-collapse: collapse !important;        }    </style></head><body>";
            var postHtml = "</body></html>";
            var html = preHtml+document.getElementById(element).innerHTML+postHtml;

            var blob = new Blob(['\ufeff', html], {
                type: 'application/msword'
            });

            // Specify link url
            var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);

            // Specify file name
            filename = filename?filename+'.doc':'document.doc';

            // Create download link element
            var downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if(navigator.msSaveOrOpenBlob ){
                navigator.msSaveOrOpenBlob(blob, filename);
            }else{
                // Create a link to the file
                downloadLink.href = url;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }

            document.body.removeChild(downloadLink);
        }

        $('#printDev').on('click', function () {
            var divToPrint=document.getElementById('printIDABC');

            var newWin=window.open('','Print-Window');

            newWin.document.open();

            newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

            newWin.document.close();

            setTimeout(function(){newWin.close();},10);
        });

    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
