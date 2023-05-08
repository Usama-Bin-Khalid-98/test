@section('pageTitle', 'User Record')


@if(Auth::user())

    @include("../includes.head")
    <!-- Select2 -->
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
                Users
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Users</li>
            </ol>
        </section>

    <!-- Main content -->
        <section class="content">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
{{--                        <div class="box-header">--}}
{{--                            <h3 class="box-title">Users</h3>--}}
{{--                            <div class="box-tools pull-right">--}}
{{--                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>--}}
{{--                                </button>--}}

{{--                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- The time line -->
                        <ul class="timeline">
                            <li>
                                <i class="fa fa-user bg-green"></i>

                                <div class="timeline-item">
                                    <div class="box box-primary"></div>
                                    <span class="time"><i class="fa fa-user"></i></span>

                                    <h3 class="timeline-header"><a href="#" class="text-blue">User Personal Info</a></h3>

                                    <div class="timeline-body">
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control">
                                                    @error('name')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Designation</label>
                                                    <select name="designation_id" id="designation_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">Select Designation</option>
                                                        @foreach($designations as $designation)
                                                            <option value="{{$designation->id}}" {{old('designation_id')==$designation->id?'selected':''}}>{{$designation->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('designation_id')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">CNIC</label>
                                                    <input type="text" data-inputmask="'mask': '99999-9999999-9'" maxlength="16" name="cnic" id="cnic" value="{{old('cnic')}}" class="form-control">
                                                    @error('cnic')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Contact No</label>
                                                    <input type="text" data-inputmask="'mask': '0399-99999999'" name="contact_no" id="contact_no" value="{{old('contact_no')}}" class="form-control" maxlength="12">
                                                    @error('contact_no')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control">
                                                    @error('email')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Password</label>
                                                    <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control">
                                                    @error('password')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" style="margin-bottom: 0px;">
                                                    <label for="email">Confirm Password</label>
                                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                                    @error('password_confirmation')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="name">Role</label>
                                                <select name="role_id" id="role_id" class="form-control select2" style="width: 100%;">
                                                    <option value="">Select Role</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{$role->id}}" {{old('role_id')==$role->id?'selected':''}}>{{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('role_id')
                                                <span class="text-red" role="alert"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Address</label>
                                                    <textarea name="address" id="address" class="form-control">{{old('address')}}</textarea>
                                                    @error('address')
                                                    <span class="text-red" role="alert"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->

                            <li>
                                <i class="fa fa-save bg-green"></i>
                                <div class="timeline-item">
                                    <div class="timeline-body">
                                        <input type="button" class="btn btn-info" name="submit" id="add" value="{{ __('Add User') }}" >
                                    </div>
                                </div>
                            </li>


                            <!-- /.row -->
                        </ul>
                    </form>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- .box -->
                    <div class="box box-primary" >
                        <div class="box-header">
                            <h3 class="box-title">Users</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                                </button>

                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-stripped">
                                <thead >
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Role</th>
                                    <th>Business School</th>
{{--                                    <th>Office Contact</th>--}}
{{--                                    <th>CV</th>--}}
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($users as $user)
                                    <tr>
                                        <td>{{@$user->name}}</td>
                                        <td>{{@$user->email}}</td>
                                        <td>{{@$user->contact_no}}</td>
                                        <td>{{@$user->roles[0]->name}}</td>
                                        <td>{{@$user->business_school->name}}</td>
{{--                                        <td>{{$contact->school_contact}}</td>--}}
{{--                                        <td><a href="{{url($contact->cv)}}"><i class="fa fa-file-word-o"></i></a> </td>--}}
                                        <td>
                                            <i data-id="{{@$user->id}}" class="badge status {{$user->status == 'active'?'bg-green':'bg-red'}}">{{$user->status == 'active'?'Active':'Inactive'}}</i>
                                        </td>
                                        <td>
                                            <!-- <i class="fa fa-check-square permissions" data-toggle="modal" data-target="#permissions-modal" data-row='{"id":{{@$user->id}},"role_id":"{{@$user->roles}}","permissions":"{{@$user->permissions}}"}'> </i> | -->
                                            <i data-row='{"id":"{{$user->id}}","name":"{{$user->name}}","designation_id":"{{$user->designation_id}}","cnic":"{{$user->cnic}}","email":"{{$user->email}}","contact_no":"{{$user->contact_no}}","address":"{{$user->address}}","role_id":"{{@$user->roles[0]->id}}","status":"{{$user->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-edit text-blue edit"></i>
                                             | <i class="fa fa-trash text-info delete" data-id="{{@$user->id}}"></i> | <i data-row='{"Passid":"{{$user->id}}"}' class="fa fa-lock text-info changePassword" data-toggle="modal" data-target="#change-password" data-id="{{@$user->id}}"></i>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot >
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Role</th>
{{--                                    <th>Office Contact</th>--}}
                                    <th>Business School</th>
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
            <!-- /.row -->
            <!-- /.row -->
            <!-- /.content -->
        </section>

    </div>

    <!-- /.modal -->
    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit User Data. </h4>
                </div>
                <form role="form" id="updateForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">User Name</label>
                                <input type="text" name="name" id="edit_name" value="{{old('name')}}" class="form-control">
                                <input type="hidden" id="edit_id">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Cnic</label>
                                <input type="text" name="cnic" id="edit_cnic" value="{{old('cnic')}}"  data-inputmask="'mask': '99999-9999999-9'" maxlength="16" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="edit_email" value="{{old('contact_no')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Contact No</label>
                                <input type="text" name="contact_no" id="edit_contact_no" value="{{old('contact_no')}}" class="form-control" data-inputmask="'mask': '0399-99999999'" maxlength="12">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Designation</label>
                                <select name="designation_id" id="edit_designation_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Designation</option>
                                    @foreach($designations as $designation)
                                        <option value="{{$designation->id}}">{{$designation->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Address</label>
                                                    <textarea name="address" id="edit_address" class="form-control">{{old('edit_address')}}</textarea>
                                                </div>
                                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Role</label>
                                <select name="role_id" class="form-control select2" id="edit_role_id">
                                    <option disabled selected >Select Role</option>
                                    @foreach($edit_roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>


                        <div class="col-md-12">
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

    <div class="modal fade" id="change-password">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Change Password. </h4>
                </div>
                <form role="form" id="updatePassword" >
                    <div class="modal-body">
                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Current Password</label>
                                                    <input type="password" name="current_password" id="current_password" class="form-control">
                                                </div>
                                                <input type="hidden" id="pass_id">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">New Password</label>
                                                    <input type="password" name="new_password" id="new_password" class="form-control">
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Confirm New Password</label>
                                                    <input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control">
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

    <!-- <div class="modal fade" id="permissions-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Change user role.</h4>
                </div>
                <form action="" method="PUT">
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="col-lg-12 form-group">
                                <select name="role_id" class="form-control select2" id="role_id">
                                    <option value="">Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->role_id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @foreach($permissions as $permission)
                            <div class="col-lg-1">
                                <input type="checkbox" id="{{@$permission->id}}" value="{{@$permission->id}}" class="flat-red" />
                            </div>
                            <div class="col-lg-5"><label>{{@$permission->name}}</label></div>
                        @endforeach


                    </div>

                    <div class="modal-footer" style="margin-top: 50% !important;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="button" class="btn btn-primary" id="update" value="Update">
                    </div>
                </form>
            </div>

            /.modal-content
        </div>
         /.modal-dialog
    </div> -->
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
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    <script>
        $(":input").inputmask();
    </script>
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
        $('.status').on('click', function (e) {
            var id = $(this).data('id');

            Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to activate?', 'Yes', 'No',
                function(){
                    // Yes button callback
                    $.ajax({
                        url:'{{url("admin")}}/'+id,
                        type:'PATCH',
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

                            console.log('response here', response);
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
        });
        //Initialize Select2 Elements
        $('.select2').select2()

        $('.permissions').on('click', function () {
            let data = JSON.parse(JSON.stringify($(this).data('row')));
            $('#role_id').select2().val(data.role_id).trigger('change');
            $('#id').val(data.id);
            console.log('e values',typeof data);
            let checks ="";
            for(const [key, val] of Object.entries(data.permissions)) {
                $('input[id='+val.id+']').iCheck('check');
                console.log(' object key', key, ' value', val);
                // checks += '<div class="col-lg-1">\n' +
                //    '<input type="checkbox" value="'+val.id+'" checked class="flat-red" />\n' +
                //    '</div>\n' +
                //    '<div class="col-lg-5"><label>'+val.name+'</label></div>';
            }
        });
        $('#updatePermission').submit(function (e) {
            let name = $('#edit_name').val();

            let status = $('input[name=edit_status]:checked').val();
            !name?addClass('edit_name'):removeClass('edit_name');
            if(!name)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
            var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("users-roles")}}/'+id,
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

        //User Registration
        $('input[name=account_type]').on('ifChecked', function(e){
            console.log(' account type ', $(this).val());
            if($(this).val() !== 'business_school') {
                $('button[name=submit]').removeAttr('disabled');
            }

            console.log('change school type', $(this).val());
            let toggle = $(this).val();

            (toggle==='business_school')?$('#business-school-tab').toggle('slow'):$('#business-school-tab').fadeOut('slow');
            (toggle==='peer_review')?$('#peer-review-tab').toggle('slow'):$('#peer-review-tab').fadeOut('slow');

        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#submit").on('click', function () {

            let business_school_id = $('#business_school_id').val();
            !business_school_id?addClass('business_school_id'):removeClass('business_school_id');
            if(!business_school_id){
                Notiflix.Notify.Failure("Please select business school.");
                return false;
            }
            let radioVal = $('input:radio:checked').map(function(i, el){return {"id":$(el).data('id'),"value":$(el).val()};}).get();

            let data = {business_school_id:business_school_id};
            radioVal.forEach(function (index) {
                if(index.value === 'no')
                {
                    console.log('index here', index.valu);
                    Notiflix.Notify.Failure("Sorry, Your business school is not eligible for the accreditation.");
                    throw new Error('This is not an error. This is just to abort javascript execution');
                }
                else if(index.value === 'yes'){
                    data[index.id] = index;
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{url('survey')}}",
                data: data,
                // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
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
                    $('button[name=submit]').removeAttr('disabled');
                    $('#question-modal').modal('hide');
                    console.log('response here', response);
                },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })

                }
            });
        });

    </script>

    <script>
        $('#add').on('click', function () {

            let name = $('#name').val();
            let designation_id = $('#designation_id').val();
            let cnic = $('#cnic').val();
            let contact_no = $('#contact_no').val();
            let email = $('#email').val();
            let password = $('#password').val();
            let password_confirmation = $('#password_confirmation').val();
            let role_id = $('#role_id').val();
            let address = $('#address').val();

            !name?addClass('name'):removeClass('name');
            !designation_id?addClass('designation_id'):removeClass('designation_id');
            !cnic?addClass('cnic'):removeClass('cnic');
            !contact_no?addClass('contact_no'):removeClass('contact_no');
            !email?addClass('email'):removeClass('email');
            !password?addClass('password'):removeClass('password');
            !password_confirmation?addClass('password_confirmation'):removeClass('password_confirmation');
            !role_id?addClass('role_id'):removeClass('role_id');
            !address?addClass('address'):removeClass('address');
            if(!name || !designation_id || !cnic || !contact_no || !email || !password || !password_confirmation || !role_id){
                Notiflix.Notify.Failure("fill all the required fields.");
                return;
            }

            if(password !== password_confirmation)
            {
                Notiflix.Notify.Failure("Password & Confirm password didn't matched.");
                return;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{url('users')}}',
                type: 'POST',
                data: {
                    name:name,
                    contact_no:contact_no,
                    designation_id:designation_id,
                    cnic:cnic,
                    email:email,
                    password:password,
                    role_id:role_id,
                    address:address
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
                   location.reload();
                    console.log('response here', response);
                },
                error:function(response, exception) {
                    Notiflix.Loading.Remove();
                    console.log("email message",response.responseJSON.errors.email[0]);
                    if(response.responseJSON.errors.email[0]) {
                        Notiflix.Notify.Failure(response.responseJSON.errors.email[0]);
                        response.responseJSON.errors.email[0]?addClass('email'):removeClass('email');
                    }
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })
                }
            })


        });


        $('.edit').on('click', function () {
            let data = JSON.parse(JSON.stringify($(this).data('row')));
            $('#edit_name').val(data.name);
            $('#edit_cnic').val(data.cnic);
            $('#edit_contact_no').val(data.contact_no);
            $('#edit_email').val(data.email);
            $('#edit_designation_id').select2().val(data.designation_id).trigger('change');
            $('#edit_address').val(data.address);
            $('#edit_role_id').select2().val(data.role_id).trigger('change');
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });




        $('#updateForm').submit(function (e) {
            let name = $('#edit_name').val();
            let cnic = $('#edit_cnic').val();
            let contact_no = $('#edit_contact_no').val();
            let email = $('#edit_email').val();
            let designation_id = $('#edit_designation_id').val();
            let address = $('#edit_address').val();
            let role_id = $('#edit_role_id').val();
            let id = $('#edit_id').val();
            let status = $('input[name=edit_status]:checked').val();

            !name?addClass('edit_name'):removeClass('edit_name');
            !cnic?addClass('edit_cnic'):removeClass('edit_cnic');
            !contact_no?addClass('edit_contact_no'):removeClass('edit_contact_no');
            !email?addClass('edit_email'):removeClass('edit_email');
            !designation_id?addClass('edit_designation_id'):removeClass('edit_designation_id');
            !address?addClass('edit_address'):removeClass('edit_address');
            !role_id?addClass('edit_role_id'):removeClass('edit_role_id');

            if(!name || !designation_id || !cnic || !contact_no || !email || !address || !role_id  )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
            var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("users")}}/'+id,
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
        })




        $('.changePassword').on('click', function () {
            let data = JSON.parse(JSON.stringify($(this).data('row')));
            $('#pass_id').val(data.Passid);
        });


        $('#updatePassword').submit(function (e) {
            let id = $('#pass_id').val();
            let new_password = $('#new_password').val();

            e.preventDefault();
            var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'POST');
            $.ajax({
                url:'{{ route("change-password") }}',
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
                    //location.reload();
                },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })
                }
            })
        })

        /// Delete Row
        $('.delete').on('click', function (e) {
            let id =  $(this).data('id');
            Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to delete?', 'Yes', 'No',
                function(){
                    // Yes button callback
                    $.ajax({
                        url:'{{url("users")}}/'+id,
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
