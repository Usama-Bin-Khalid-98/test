@section('pageTitle', 'Print All')


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
        }
    </style>
    @include("../includes.nav")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Print
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Print </li>
            </ol>
        </section>


        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">


                    <!-- .box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Print</h3>
                        </div>
                    <br><br><br><br>
                    <p class="left_25">Name of University: ________________________________________________________</p>
                    <p class="left_25">Name of Business School: ___________________________________________________</p>
                    <p class="left_25">Program(s) for Review:  ______________________________________________________</p>
                    <p class="left_25">Submission dates:  __________________________________________________________</p>
                    <br /><br />
                    <span class="center"><h1>Self</h1></spans>
                    <div class="center"><h1>Assessment</h1></div>
                    <span class="center"><h1>Report</h1></spans>
                        <div class="center"><h1>(SAR)</h1></div>
                    <h5 style="text-align: center;">NBEAC</h5><br><hr>
                    <p>The SAR is to be completed by the business school seeking accreditation from the
National Business Education Accreditation Council (NBEAC) of the Higher Education Commission, Pakistan
</p>
                    <br>
                    <div class="row">
                        <div class="col  col-md-3 col-lg-3"></div>
                        <div class="col col-sm-12 col-md-3 col-lg-3"><img src="{{asset('/images/nbeacLogo.jpg')}}"></div>
                        <div class="col col-sm-12 col-md-3 col-lg-3"><img src="{{asset('/images/HECLogo.jpg')}}"></div>
                        <div class="col  col-md-3 col-lg-3"></div>


                    </div>



                    <div >
                        <div class="center">
                            <h2><b>Contents</b></h2>
                        </div><br>
                        <div class="left left_20" >
                        <ul style="list-style-type: none">
                            <li>Preface---------------------------------------------------------------------------------------------------------------------------2</li>
                            <li>Preparation Instructions----------------------------------------------------------------------------------------------------3</li>
                            <li>Undertaking--------------------------------------------------------------------------------------------------------------------4</li>
                            <li>1. Strategic Management----------------------------------------------------------------------------------------------------5</li>
                            <li>2: Curriculum-------------------------------------------------------------------------------------------------------------------5</li>
                            <li>3. Students---------------------------------------------------------------------------------------------------------------------11</li>
                            <li>4. Faculty-----------------------------------------------------------------------------------------------------------------------14</li>
                            <li>5. Research and Development--------------------------------------------------------------------------------------------18</li>
                            <li>6. Social Responsibility-----------------------------------------------------------------------------------------------------21</li>
                            <li>7. Resources-------------------------------------------------------------------------------------------------------------------23</li>
                            <li>8. External Linkages---------------------------------------------------------------------------------------------------------27</li>
                            <li>9. Admission and Examination Policy----------------------------------------------------------------------------------29</li>
                        </ul>
                        </div>
                    </div><br><br><br><br><br>
                    <div class="row">
                        <div class="col  col-md-3 col-lg-3"><img src="{{asset('/images/nbeacLogo.jpg')}}"></div>
                        <div class="col col-sm-12 col-md-3 col-lg-3"></div>
                        <div class="col col-sm-12 col-md-3 col-lg-3"></div>
                        <div class="col  col-md-3 col-lg-3"><img src="{{asset('/images/HECLogo.jpg')}}"></div>


                    </div>


                    <br><br><br>

                    <h1>Perface</h1><br>
                    <div class="row">
                        <div class="col  col-md-1 col-lg-1"></div>

                        <div class="col col-sm-12 col-md-10 col-lg-10">
                            <p class="justify">This document guides accreditation applicants in the provision of information based on which NBEAC may make an accreditation decision. Information is sought for nine standards listed below together with their weights in the total accreditation score in parentheses.  The more complete the data provided, the more accurate the assessment.</p>
                            <ol>
                                <li class="left">1. Strategic Management (15%)</li>
                                <li class="left">2. Curriculum (15%)</li>
                                <li class="left">3. Students (15%)</li>
                                <li class="left">4. Faculty (20%)</li>
                                <li class="left">5. Research and Development (10%)</li>
                                <li class="left">6. Social Responsibility (5%)</li>
                                <li class="left">7. Resources (10%)</li>
                                <li class="left">8. Students Placement and External Linkages (5%)</li>
                                <li class="left">9. Admission & Examination Policy (5%)</li>
                            </ol>
                            <p class="justify">Senior Program Manager - Accreditation</p>
                            <p class="justify">National Business Education Accreditation Council
                            Islamabad
                            </p>
                        </div>
                        <div class="col  col-md-1 col-lg-1"></div>


                    </div><br><br><br><br><br><br>


                    <div>
                        <div class="center">
                            <h1>Preparation Instructions</h1>
                        </div><br><br>
                        <div class="row">
                        <div class="col  col-md-1 col-lg-1"></div>

                        <div class="col col-sm-12 col-md-10 col-lg-10">
                            <p class="left">1.  To ensure that the SAR is prepared in accordance with the relevant guidelines, please consult  Section IV of the NBEAC Accreditation Process Manual<a style="color: blue" href="https://nbeac.org.pk/index.php/accreditation-2/policies-and-procedures"> https://nbeac.org.pk/index.php/accreditation-2/policies-and-procedures</a> before starting.</p>
                            <p class="left">2.  Please do not change the original text and structure of the SAR. However, where some illustrative data is shown in colored font, you are expected to replace it with actual data.</p>
                            <p class="left">3.  Information may be asked for in the form of a table, an appendix, or descriptive text paragraphs. Please provide the information in exactly the form in which it is requested.  Where information is not available, please indicate this by writing “Not Available” in the relevant space.</p>
                            <p class="left">4.  Please submit the completed copy of the SAR to the NBEAC Secretariat for desk review. Once you receive the initial comments from the desk review, please revise accordingly.   </p>
                            <p class="left">5.  Please submit six copies of the SAR to the NBEAC Office after receiving a final positive review. </p>
                            <p class="left">6.  In case of a re-visit, an updated SAR should be sent to the NBEAC office along with the Progress Report (PR) at least four weeks before the start of peer review visit.</p>
                            <p class="left">7.  In case of re-accreditations, an updated SAR should be sent to the NBEAC office along with the Continuous Improvement Report (CIR) at least four weeks before the start of peer review visit.</p>
                            <p class="left">9.  Please address all correspondence to the following address:</p>
                             <p class="left">8.  The NBEAC Secretariat is available to respond to questions pertaining to the SAR.</p>
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
                        <div class="row">
                        <div class="col  col-md-1 col-lg-1"></div>

                        <div class="col col-sm-12 col-md-10 col-lg-10"><p class="left">I, the undersigned, fully understand and agree with the terms and conditions of the NBEAC given below. </p>
                            <p class="left">1.  I confirm the accuracy of the information provided in the Self-Assessment Report (SAR). </p>
                            <p class="left">2.  I confirm that my institution will pay the NBEAC an accreditation fee as defined in the NBEAC Fee Schedule <a style="color: blue" href="https://www.nbeac.org.pk/index.php/accreditation-2/accreditation-fee-2"> https://www.nbeac.org.pk/index.php/accreditation-2/accreditation-fee-2</a> together with this application form. </p>
                            <p class="left">3.  I confirm that my institutions will provide all relevant documents and data requested by the NBEAC Peer Review Team before, during or after the accreditation assessment visit.</p>
                            <p class="left">4.  I confirm that my institution will not hold the NBEAC, its directors, employees and consultants, liable for any direct or indirect, foreseeable or unforeseeable damages resulting from the accreditation process or the final decision of the NBEAC about accreditation.</p>
                            <p class="left">5.  I confirm that my institution will provide the following arrangements for the PRT team: room and board at a local hotel or guest house and all local transport. </p>
                            <p class="left">6.  In confirm that, in case we need to interrupt the accreditation process, we will submit a cancellation request in writing to the NBEAC Secretariat at least 4 weeks before the PRT visit.</p>
                            <br><br>
                            <p>
                            Signature: _______________________________________ Stamp of the organization: ________________________</p>
                            <p>Name of the signatory: _____________________________ Date __________________________________________</p>
                            <p>Position of the signatory __________________________________________________________________________</p>
                            <p>Name of University/Institute: ______________________________________________________________________</p>
                            <p>Department/Business School under review: ___________________________________________________________</p>
                            <p>Postal address: __________________________________________________________________________________</p>
                            <p>City and country: ________________________________________________________________________________</p>
                            <p>Telephone: ______________________________________ Fax: __________________________________________</p>


                        </div>
                        <div class="col  col-md-1 col-lg-1"></div>


                    </div>
                    </div><br><br><br><br><br>
                        <!-- /.box-header -->
                    @include('strategic_management.includes.1')
                    @include('strategic_management.includes.2')
                    @include('strategic_management.includes.3')
                    @include('strategic_management.includes.4')
                    @include('strategic_management.includes.5')
                    @include('strategic_management.includes.6')
                    @include('strategic_management.includes.7')
                    @include('strategic_management.includes.8')
                    @include('strategic_management.includes.9')


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


    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
