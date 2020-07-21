@section('pageTitle', 'Faculty Workload')


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
                Faculty Work Load
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Faculty Work Load </li>
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
                            <h3 class="box-title">Provide information of faculty workload over the last two semesters. Attach faculty workload policy in table 4.2</h3>
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
                                    <label for="name">Business School</label>
                                   <select name="business_school_id" id="business_school_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Business School</option>
                                        @foreach($businesses as $business)
                                         <option value="{{$business->id}}">{{$business->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Faculty Name</label>
                                    <input type="text" name="faculty_name" id="faculty_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Designation</label>
                                   <select name="lookup_faculty_designation_id" id="lookup_faculty_designation_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Designation</option>
                                        @foreach($designations as $business)
                                         <option value="{{$business->id}}">{{$business->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Total Courses</label>
                                    <input type="number" name="total_courses" id="total_courses" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Phd</label>
                                    <input type="number" name="phd" id="phd" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Masters</label>
                                    <input type="number" name="masters" id="masters" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Bachelors</label>
                                    <input type="number" name="bachelors" id="bachelors" class="form-control">
                                </div>
                            </div>

                             <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Admin Resposibilities</label>
                                    <input type="text" name="admin_responsibilities" id="admin_responsibilities" class="form-control">
                                </div>
                            </div>
                           <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Year</label>
                                    <select name="year" id="year"  class="form-control select2">
                                        <option value="">Select Year</option>
                                        <option value="2000">2000</option>
                                        <option value="2001">2001</option>
                                        <option value="2002">2002</option>
                                        <option value="2003">2003</option>
                                        <option value="2004">2004</option>
                                        <option value="2005">2005</option>
                                        <option value="2006">2006</option>
                                        <option value="2007">2007</option>
                                        <option value="2008">2008</option>
                                        <option value="2009">2009</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                    </select>

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
                            <h3 class="box-title">Information of faculty workload over the last two semesters</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Business School</th>
                                    <th>Faculty Name</th>
                                    <th>Designation</th>
                                    <th>Total Courses</th>
                                    <th>PHD</th>
                                    <th>Masters</th>
                                    <th>Bachelors</th>
                                    <th>Administrative Responsibility</th>
                                    <th>Year</th>
                                    <th>Status</th>
                                    <th>isComplete</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($workloads as $req)
                                <tr>
                                    <td>{{$req->business_school->name}}</td>
                                    <td>{{$req->faculty_name}}</td>
                                    <td>{{$req->designation->name}}</td>
                                    <td>{{$req->total_courses}}</td>
                                    <td>{{$req->phd}}</td>
                                    <td>{{$req->masters}}</td>
                                    <td>{{$req->bachelors}}</td>
                                    <td>{{$req->admin_responsibilities}}</td>
                                    <td>{{$req->year}}</td>
                                    <td><i class="badge {{$req->status == 'active'?'bg-green':'bg-red'}}">{{$req->status == 'active'?'Active':'Inactive'}}</i></td>
                                    <td><i class="badge {{$req->isComplete == 'yes'?'bg-green':'bg-red'}}">{{$req->isComplete == 'yes'?'Yes':'No'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$req->id}}"></i> | <i class="fa fa-pencil text-blue edit" data-row='{"id":"{{$req->id}}","business_school_id":"{{$req->business_school_id}}","faculty_name":"{{$req->faculty_name}}","lookup_faculty_designation_id":"{{$req->lookup_faculty_designation_id}}","total_courses":"{{$req->total_courses}}","phd":"{{$req->phd}}","masters":"{{$req->masters}}","bachelors":"{{$req->bachelors}}","admin_responsibilities":"{{$req->admin_responsibilities}}","year":"{{$req->year}}","total_enrollments":"{{$req->total_enrollments}}","status":"{{$req->status}}","isComplete":"{{$req->isComplete}}"}' data-toggle="modal" data-target="#edit-modal"></i></td>

                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Business School</th>
                                    <th>Faculty Name</th>
                                    <th>Designation</th>
                                    <th>Total Courses</th>
                                    <th>PHD</th>
                                    <th>Masters</th>
                                    <th>Bachelors</th>
                                    <th>Administrative Responsibility</th>
                                    <th>Year</th>
                                    <th>Status</th>
                                    <th>isComplete</th>
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
                    <h4 class="modal-title">Edit Faculty Student Ratio. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Business School</label>
                                   <select name="business_school_id" id="edit_business_school_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Business School</option>
                                        @foreach($businesses as $business)
                                         <option value="{{$business->id}}">{{$business->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                                <input type="hidden" id="edit_id">
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Faculty Name</label>
                                    <input type="text" name="faculty_name" id="edit_faculty_name" value="{{old('edit_total_enrollments')}}" class="form-control">
                                </div>
                              </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Designation</label>
                                   <select name="lookup_faculty_designation_id" id="edit_lookup_faculty_designation_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Designation</option>
                                        @foreach($designations as $business)
                                         <option value="{{$business->id}}">{{$business->faculty_designation}}</option>
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
                                    <input type="number" name="bachelors" id="edit_bachelors" value="{{old('edit_bachelors')}}" class="form-control">
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
                                    <label for="name">Year</label>
                                    <select name="year" id="edit_year"  class="form-control select2">
                                        <option value="">Select Year</option>
                                        <option value="2000">2000</option>
                                        <option value="2001">2001</option>
                                        <option value="2002">2002</option>
                                        <option value="2003">2003</option>
                                        <option value="2004">2004</option>
                                        <option value="2005">2005</option>
                                        <option value="2006">2006</option>
                                        <option value="2007">2007</option>
                                        <option value="2008">2008</option>
                                        <option value="2009">2009</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                    </select>

                            </div>
                            </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">{{ __('Status') }} : </label>
                                <p><input type="radio" name="status" class="flat-red" value="active" > Active
                                    <input type="radio" name="status" class="flat-red" value="inactive">InActive</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">{{ __('isComplete') }} : </label>
                                <p><input type="radio" name="isComplete" class="flat-red" value="yes" >Yes
                                    <input type="radio" name="isComplete" class="flat-red" value="no">No</p>
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
            let business_school_id = $('#business_school_id').val();
            let faculty_name = $('#faculty_name').val();
            let lookup_faculty_designation_id = $('#lookup_faculty_designation_id').val();
            let total_courses = $('#total_courses').val();
            let phd = $('#phd').val();
            let masters = $('#masters').val();
            let bachelors = $('#bachelors').val();
            let admin_responsibilities = $('#admin_responsibilities').val();
            let year = $('#year').val();

            !business_school_id?addClass('business_school_id'):removeClass('business_school_id');
            !faculty_name?addClass('faculty_name'):removeClass('faculty_name');
            !lookup_faculty_designation_id?addClass('lookup_faculty_designation_id'):removeClass('lookup_faculty_designation_id');
            !total_courses?addClass('total_courses'):removeClass('total_courses');
            !phd?addClass('phd'):removeClass('phd');
            !masters?addClass('masters'):removeClass('masters');
            !bachelors?addClass('bachelors'):removeClass('bachelors');
            !admin_responsibilities?addClass('admin_responsibilities'):removeClass('admin_responsibilities');
            !year?addClass('year'):removeClass('year');

            if(!business_school_id || !faculty_name || !lookup_faculty_designation_id || !total_courses || !phd || !masters || !bachelors || !admin_responsibilities || !year)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("work-load")}}',
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
            $('#edit_business_school_id').select2().val(data.business_school_id).trigger('change');
            $('#edit_faculty_name').val(data.faculty_name);
            $('#edit_lookup_faculty_designation_id').select2().val(data.lookup_faculty_designation_id).trigger('change');
            $('#edit_total_courses').val(data.total_courses);
            $('#edit_phd').val(data.phd);
            $('#edit_masters').val(data.masters);
            $('#edit_bachelors').val(data.bachelors);
            $('#edit_admin_responsibilities').val(data.admin_responsibilities);
            $('#edit_year').select2().val(data.year).trigger('change');
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
            $('input[value='+data.isComplete+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let business_school_id = $('#edit_business_school_id').val();
            let faculty_name = $('#edit_faculty_name').val();
            let lookup_faculty_designation_id = $('#edit_lookup_faculty_designation_id').val();
            let total_courses = $('#edit_total_courses').val();
            let phd = $('#edit_phd').val();
            let masters = $('#edit_masters').val();
            let bachelors = $('#edit_bachelors').val();
            let admin_responsibilities = $('#edit_admin_responsibilities').val();
            let year = $('#edit_year').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            let isComplete = $('input[name=edit_isComplete]:checked').val();
            !business_school_id?addClass('edit_business_school_id'):removeClass('edit_business_school_id');
            !faculty_name?addClass('edit_faculty_name'):removeClass('edit_faculty_name');
            !lookup_faculty_designation_id?addClass('edit_lookup_faculty_designation_id'):removeClass('edit_lookup_faculty_designation_id');
            !total_courses?addClass('edit_total_courses'):removeClass('edit_total_courses');
            !phd?addClass('edit_phd'):removeClass('edit_phd');
            !masters?addClass('edit_masters'):removeClass('edit_masters');
            !bachelors?addClass('edit_bachelors'):removeClass('edit_bachelors');
            !admin_responsibilities?addClass('edit_admin_responsibilities'):removeClass('edit_admin_responsibilities');
            !year?addClass('edit_year'):removeClass('edit_year');

            if(!business_school_id || !faculty_name || !lookup_faculty_designation_id || !total_courses || !phd || !masters || !bachelors || !admin_responsibilities || !year )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("work-load")}}/'+id,
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
                        url:'{{url("work-load")}}/'+id,
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
