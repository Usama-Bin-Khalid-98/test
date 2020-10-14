@section('pageTitle', 'Configuration')

@if(Auth::user())


@include("includes.head")
<!-- Morris chart -->
<link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />
@include("includes.header")
@include("includes.nav")
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        NBEAC System Settings
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">System Settings</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Configuration</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <a href="{{url('config/charter_types')}}" class="text-purple"><b>Charter Types</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['CharterType']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/institute_types')}}" class="text-purple"><b>Institute Types</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['InstituteType']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/course_types')}}" class="text-purple"><b>Course Types</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['CourseType']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/departments')}}" class="text-purple"><b>Departments</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['Department']}}</span>
                    </span>
                    </li>

                    <li class="list-group-item">
                        <a href="{{url('config/programs')}}" class="text-purple"><b>Programs</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['Program']}}</span>
                    </span>
                    </li>

                    <li class="list-group-item">
                        <a href="{{url('config/semesters')}}" class="text-purple"><b>Semesters</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['Semester']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/degrees')}}" class="text-purple"><b>Degrees</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['Degree']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/business_school')}}" class="text-purple"><b>Business Schools</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['BusinessSchool']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/designations')}}" class="text-purple"><b>Designations</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['Designation']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/disciplines')}}" class="text-purple"><b>Disciplines</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['Discipline']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/eligibility_criterias')}}" class="text-purple"><b>Eligibility Criterias</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['EligibilityCriteria']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/faculty_qualifications')}}" class="text-purple"><b>Faculty Qualifications</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['FacultyQualification']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/facility_types')}}" class="text-purple"><b>Facility Types</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['FacilityType']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/facilities')}}" class="text-purple"><b>Facilities</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['Facility']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/fee_types')}}" class="text-purple"><b>Fee Types</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['FeeType']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/fyp_requirements')}}" class="text-purple"><b>Fyp Requirements</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['FypRequirement']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/funding_sources')}}" class="text-purple"><b>Funding Sources</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['FundingSources']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/levels')}}" class="text-purple"><b>Levels</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['Level']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/payment_methods')}}" class="text-purple"><b>Payment Methods</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['PaymentMethod']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/publication_categories')}}" class="text-purple"><b>Publication Categories</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['PublicationCategory']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/publication_types')}}" class="text-purple"><b>Publication Types</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['PublicationType']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/regions')}}" class="text-purple"><b>Regions</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['Region']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/teaching_methods')}}" class="text-purple"><b>Teaching Methods</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['TeachingMethod']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/evaluation_items')}}" class="text-purple"><b>Evaluation Items</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['EvaluationItem']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/reviewer_roles')}}" class="text-purple"><b>Reviewer Roles</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['ReviewerRole']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/sectors')}}" class="text-purple"><b>Sectors</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['Sector']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/statutory_bodies')}}" class="text-purple"><b>Statutory Bodies</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['StatutoryBody']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/welfare_programs')}}" class="text-purple"><b>Welfare Programs</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['WelfareProgram']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/staff_categories')}}" class="text-purple"><b>Staff Categories</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['StaffCategory']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/qec_types')}}" class="text-purple"><b>Qec Types</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['QecType']}}</span>
                    </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('config/activity_engagements')}}" class="text-purple"><b>Activity Engagements</b> </a>
                        <span class="pull-right-container">
                        <span class="label label-success pull-right">{{$counter['ActivityEngagement']}}</span>
                    </span>
                    </li>
                </ul>

              <hr>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">

            <div class="tab-content">
              <div class="active tab-pane" id="course_type">

                  <div class="user-block">
                    <div class="col-md-12">
                        <div class="form-group pull-right" style="margin-top: 20px">
                            <label for="sector">&nbsp;&nbsp;</label>
                            <input  data-toggle="modal" data-target="#course-modal" value="Add New" class="btn btn-info">
                        </div>
                    </div>
                  </div>

                <div class="box box-primary">
                        <div class="box-header ">
                            <h3 class="box-title">{{$TableName}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable1" class="table table-bordered table-striped">
                                 <thead>
                                <tr>
                                    @if(request()->is('config/programs'))
                                    <th>Department</th>
                                    @endif
                                    @if(request()->is('config/publication_types'))
                                    <th>Publication Category</th>
                                    @endif
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($TableRows as $row)
                                <tr>
                                    @if(request()->is('config/programs'))
                                        <td>{{$row->department->name}}</td>
                                    @endif

                                    @if(request()->is('config/publication_types'))
                                    <td>{{$row->publication_category->name}}</td>
                                    @endif
                                    <td>{{$row->name}}</td>
                                    <td><i class="badge {{$row->status == 'active'?'bg-green':'bg-red'}}">{{$row->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$row->id}}"></i> | <i class="fa fa-pencil text-blue edit" data-row='{"id":"{{$row->id}}","name":"{{$row->name}}","status":"{{$row->status}}","department_id":"{{@$row->department_id}}","publication_category_id":"{{@$row->publication_category_id}}"}' data-toggle="modal" data-target="#edit-modal"></i></td>

                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    @if(request()->is('config/programs'))
                                        <th>Department</th>
                                    @endif
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="modal fade" id="course-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{$TableName}} </h4>
                </div>
                <form action="javascript:void(0)" id="form" method="POST">
                    <div class="modal-body">
                        @if(request()->is('config/programs'))
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select id="department_id" name="department_id" class="form-control select2" style="width: 100%;">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}" {{$department->id==old('program_id')?'selected':''}}>{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                            @if(request()->is('config/publication_types'))
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="publication_category_id" id="publication_category_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Publication Category</option>
                                        @foreach($publication_categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" placeholder="Enter {{$TableName}}"  class="form-control">
                                </div>
                              </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" name="add" id="add" value="Add" class="btn btn-info">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

     <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit {{$TableName}} </h4>
                </div>
                <form role="form" method="post" >
                    <div class="modal-body">
                        @if(request()->is('config/programs'))
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="program">Apply for Department</label>
                                    <select id="edit_department_id" name="department_id" class="form-control select2" style="width: 100%;">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}" {{$department->id==old('program_id')?'selected':''}}>{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        @if(request()->is('config/publication_types'))
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="program">Publication Category</label>
                                <select id="edit_publication_category_id" name="publication_category_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Category</option>
                                    @foreach($publication_categories as $category)
                                        <option value="{{$category->id}}" {{$category->id==old('publication_category_id')?'selected':''}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="edit_name" value="{{old('edit_name')}}" class="form-control">
                                </div>
                                <input type="hidden" id="edit_id">
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
                        <input type="button" name="update" id="update" value="update" class="btn btn-info">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
              </div>

              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
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
            $('#datatable1').DataTable()
        })
        $(function () {
            $('#datatable2').DataTable()
        })
    </script>
    <script type="text/javascript">

        $('.select2').select2()

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

         $('#add').on('click',function (e) {
            let name = $('#name').val();

            !name?addClass('name'):removeClass('name');

            if(!name )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
//request()->is('config/programs')
            $.ajax({
                url:'{{request()->route()->parameters['table']}}',
                type:'POST',
                data:{name:name, @if(request()->is('config/programs'))department_id: $('#department_id').val()  @endif @if(request()->is('config/publication_types')) publication_category_id: $('#publication_category_id').val()  @endif },
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
             $('#edit_department_id').select2().val(data.department_id).trigger('change');
             $('#edit_publication_category_id').select2().val(data.publication_category_id).trigger('change');
             $('#edit_name').val(data.name);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#update').on('click',function (e) {
            let name = $('#edit_name').val();
            let id = $('#edit_id').val();

            let status = $('input[name=status]:checked').val();

            !name?addClass('edit_name'):removeClass('edit_name');

            if(!name )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            $.ajax({
                url:'{{request()->route()->parameters['table']}}/'+id,
                type:'PUT',
                data: {name:name, status:status, @if(request()->is('config/programs'))department_id: $('#edit_department_id').val()  @endif @if(request()->is('config/publication_types'))publication_category_id: $('#edit_publication_category_id').val()  @endif},
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
                        url:'{{request()->route()->parameters['table']}}/'+id,
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
