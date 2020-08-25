 @section('pageTitle', 'Faculty Detailed Info')


@if(Auth::user())

    @include("../includes.head")
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
                Faculty Detailed Info
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Faculty Detailed Info </li>
            </ol>
        </section>
        <section class="content-header">
            <div class="col-md-12 new-button">
                <div class="pull-right">
                    <button class="btn gradient-bg-color"
{{--                           data-toggle="modal" data-target="#add-modal"--}}
                           style="color: white;"
                           value="Add New"
                            name="add" id="add">PDF <i class="fa fa-file-pdf-o"></i></button>
                </div>
            </div>
        </section>

        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">4.1b information on individual faculty members in Table 4.1(b)</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-file-pdf-o"></i></button>
                                </div>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">

                           <form action="javascript:void(0)" id="form" method="POST">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Cnic</label>
                                    <input type="text" name="cnic" id="cnic" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Designation</label>
                                   <select name="designation_id" id="designation_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Designation</option>
                                        @foreach($designations as $business)
                                         <option value="{{$business->id}}">{{$business->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Faculty type</label>
                                   <select name="lookup_faculty_type_id" id="lookup_faculty_type_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select faculty type</option>
                                        @foreach($faculty_types as $type)
                                         <option value="{{$type->id}}">{{$type->faculty_type}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Academic degree</label>
                                   <select name="degree_id" id="degree_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Degree</option>
                                        @foreach($degrees as $degree)
                                         <option value="{{$degree->id}}">{{$degree->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Specialization</label>
                                    <input type="text" name="specialization" id="specialization" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Degree awarding institution</label>
                                    <input type="text" name="awarding_institute" id="awarding_institute" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Country</label>
                                    <input type="text" name="country" id="country" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Teaching course type</label>
                                   <select name="course_type_id" id="course_type_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Course type</option>
                                        @foreach($courses as $course)
                                         <option value="{{$course->id}}">{{$course->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Experience in higher education</label>
                                    <input type="text" name="hec_experience" id="hec_experience" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Industry</label>
                                    <input type="text" name="industry" id="industry" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Current job duration(year)</label>
                                    <input type="text" name="current_job_duration" id="current_job_duration" class="form-control">
                                </div>
                            </div>


                             <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" id="add" value="Add" class="btn btn-info">
                                </div>
                            </div>
                        </form>

                        </div>
                        <!-- /.box-body -->
                        <!-- /.box -->
                    </div>
                    <!-- .box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Table 4.1(b).Detailed information of business schools’ faculty</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name / CNIC</th>
                                    <th>Designation / Faculty type</th>
                                    <th>Academic Degree / Specialization</th>
                                    <th>Degree awarding institution / Country</th>
                                    <th>Teaching course type</th>
                                    <th>Experience in higher education / industry</th>
                                    <th>Current job duration (years)</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($workloads as $req)
                                <tr>
                                    <td>{{$req->name}} / {{$req->cnic}}</td>
                                    <td>{{$req->designation->name}} / {{$req->lookup_faculty_type->faculty_type}}</td>
                                    <td>{{$req->degree->name}} / {{$req->degree->specialization}}</td>
                                    <td>{{$req->awarding_institute}} / {{$req->country}}</td>
                                    <td>{{$req->course_type->name}}</td>
                                    <td>{{$req->hec_experience}} / {{$req->industry}}</td>
                                    <td>{{$req->current_job_duration}}</td>
                                    <td><i class="badge {{$req->status == 'active'?'bg-green':'bg-red'}}">{{$req->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$req->id}}"></i> | <i class="fa fa-pencil text-blue edit" data-row='{"id":"{{$req->id}}","status":"{{$req->status}}"}' data-toggle="modal" data-target="#edit-modal"></i></td>

                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name / CNIC</th>
                                    <th>Designation / Faculty type</th>
                                    <th>Academic Degree / Specialization</th>
                                    <th>Degree awarding institution / Country</th>
                                    <th>Teaching course type</th>
                                    <th>Experience in higher education / industry</th>
                                    <th>Current job duration (years)</th>
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
        </section>

    </div>

    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Faculty Detailed Info. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Faculty Name</label>
                                    <input type="text" name="faculty_name" id="edit_faculty_name" value="{{old('edit_total_enrollments')}}" class="form-control">
                                </div>
                                <input type="hidden" id="edit_id">
                              </div>

                            <div class="col-md-6">
                                <div class="form-group" style="margin-bottom: 21px;">
                                    <label for="name">Designation</label>
                                   <select name="designation_id" id="edit_designation_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Designation</option>
                                        @foreach($designations as $business)
                                         <option value="{{$business->id}}">{{$business->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Total Courses</label>
                                    <input type="number" name="total_courses" id="edit_total_courses" value="{{old('edit_total_courses')}}" class="form-control">
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Phd</label>
                                    <input type="number" name="phd" id="edit_phd" value="{{old('edit_phd')}}" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Masters</label>
                                    <input type="number" name="masters" id="edit_masters" value="{{old('edit_masters')}}" class="form-control">
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Bachelors</label>
                                    <input type="number" name="bachleors" id="edit_bachleors" value="{{old('edit_bachleors')}}" class="form-control">
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Admin Responsibilities</label>
                                    <input type="text" name="admin_responsibilities" id="edit_admin_responsibilities" value="{{old('edit_admin_responsibilities')}}" class="form-control">
                                </div>
                              </div>

                          


                        <div class="col-md-6">
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
            $('#datatable').DataTable()
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
            let name = $('#name').val();
            let cnic = $('#cnic').val();
            let designation_id = $('#designation_id').val();
            let lookup_faculty_type_id = $('#lookup_faculty_type_id').val();
            let degree_id = $('#degree_id').val();
            let awarding_institute = $('#awarding_institute').val();
            let course_type_id = $('#course_type_id').val();
            let hec_experience = $('#hec_experience').val();
            let current_job_duration = $('#current_job_duration').val();
            let country = $('#country').val();
            let specialization = $('#specialization').val();
            let industry = $('#industry').val();

            !name?addClass('name'):removeClass('name');
            !cnic?addClass('cnic'):removeClass('cnic');
            !designation_id?addClass('designation_id'):removeClass('designation_id');
            !lookup_faculty_type_id?addClass('lookup_faculty_type_id'):removeClass('lookup_faculty_type_id');
            !degree_id?addClass('degree_id'):removeClass('degree_id');
            !awarding_institute?addClass('awarding_institute'):removeClass('awarding_institute');
            !course_type_id?addClass('course_type_id'):removeClass('course_type_id');
            !hec_experience?addClass('hec_experience'):removeClass('hec_experience');
            !current_job_duration?addClass('current_job_duration'):removeClass('current_job_duration');
            !country?addClass('country'):removeClass('country');
            !specialization?addClass('specialization'):removeClass('specialization');
            !industry?addClass('industry'):removeClass('industry');

            if(!name || !cnic || !designation_id || !lookup_faculty_type_id || !degree_id || !awarding_institute || !course_type_id || !hec_experience || !current_job_duration || !country || !specialization || !industry)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("faculty-detailed-info")}}',
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
            $('#edit_faculty_name').val(data.faculty_name);
            $('#edit_designation_id').select2().val(data.designation_id).trigger('change');
            $('#edit_total_courses').val(data.total_courses);
            $('#edit_phd').val(data.phd);
            $('#edit_masters').val(data.masters);
            $('#edit_bachleors').val(data.bachleors);
            $('#edit_admin_responsibilities').val(data.admin_responsibilities);
            $('#edit_semester').select2().val(data.semester_id).trigger('change');
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let faculty_name = $('#edit_faculty_name').val();
            let designation_id = $('#edit_designation_id').val();
            let total_courses = $('#edit_total_courses').val();
            let phd = $('#edit_phd').val();
            let masters = $('#edit_masters').val();
            let bachleors = $('#edit_bachleors').val();
            let admin_responsibilities = $('#edit_admin_responsibilities').val();
            let semester_id = $('#edit_semester').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !faculty_name?addClass('edit_faculty_name'):removeClass('edit_faculty_name');
            !designation_id?addClass('edit_designation_id'):removeClass('edit_designation_id');
            !total_courses?addClass('edit_total_courses'):removeClass('edit_total_courses');
            !phd?addClass('edit_phd'):removeClass('edit_phd');
            !masters?addClass('edit_masters'):removeClass('edit_masters');
            !bachleors?addClass('edit_bachleors'):removeClass('edit_bachleors');
            !admin_responsibilities?addClass('edit_admin_responsibilities'):removeClass('edit_admin_responsibilities');
            !semester_id?addClass('edit_semester'):removeClass('edit_semester');

            if(!faculty_name || !designation_id || !total_courses || !phd || !masters || !bachleors || !admin_responsibilities || !semester_id )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("faculty-detailed-info")}}/'+id,
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
                        url:'{{url("faculty-detailed-info")}}/'+id,
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
