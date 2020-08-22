@section('pageTitle', 'Contact Info')


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
                Contact Information
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Contact Information</li>
            </ol>
        </section>
        <section class="content-header">
            <div class="col-md-12 new-button">
                <div class="pull-right">
                    <button class="btn gradient-bg-color"
                           data-toggle="modal" data-target="#add-modal"
                           style="color: white;"
                           value="Add New">PDF <i class="fa fa-file-pdf-o"></i></button>
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
                            <h3 class="box-title">1.3 Provide contact information in the Table 1.3. Furthermore, attach CVs of the dean, head of the business school, and focal person as Appendix-1A.</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                                </button>

                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                            </div>
                        </div>
                         <div class="box-body">
                             <form action="javascript:void(0)" id="form" method="POST" enctype="multipart/form-data">
                                 <div class="col-md-12">
                                <table  class="table table-bordered table-stripped">
                                    <tr>
                                        <th></th>
                                        <th>Dean of school</th>
                                        <th>Head of school (if applicable)</th>
                                        <th>NBEAC focal person (if different) </th>
                                    </tr>
                                    <tr>
                                        <td><strong>Name:</strong></td>
                                        <td><input type="text" name="ds_name" id="ds_name" value="{{@$ds_contacts->name}}" class="form-control"></td>
                                        <td><input type="text" name="hs_name" id="hs_name" value="{{@$hs_contacts->name}}" class="form-control"></td>
                                        <td><input type="text" name="fp_name" id="fp_name" value="{{@$fp_contacts->name}}" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td><strong>Job title:</strong></td>
                                        <td>
                                            <input type="text" name="ds_job_title" id="ds_job_title"  value="{{@$ds_contacts->job_title}}" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="hs_job_title" id="hs_job_title"  value="{{@$hs_contacts->job_title}}" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="fp_job_title" id="fp_job_title"  value="{{@$fp_contacts->job_title}}" class="form-control">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><strong>Tel (off): </strong></td>
                                        <td>
                                            <input type="text" name="ds_tell_off" id="ds_tell_off" value="{{@$ds_contacts->contact_no}}" class="form-control" data-inputmask="'mask': '+99-99-99999999'" maxlength="15">
                                        </td>
                                        <td>
                                            <input type="text" name="hs_tell_off" id="hs_tell_off" value="{{@$hs_contacts->contact_no}}" class="form-control" data-inputmask="'mask': '+99-99-99999999'" maxlength="15">
                                        </td>
                                        <td>
                                            <input type="text" name="fp_tell_off" id="fp_tell_off" value="{{@$fp_contacts->contact_no}}" class="form-control" data-inputmask="'mask': '+99-99-99999999'" maxlength="15">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><strong>Tel (cell): </strong></td>
                                        <td>
                                            <input type="text" name="ds_tell_cell" id="ds_tell_cell" value="{{@$ds_contacts->school_contact}}" class="form-control" data-inputmask="'mask': '+99-99-99999999'" maxlength="15">
                                        </td>
                                        <td>
                                            <input type="text" name="hs_tell_cell" id="hs_tell_cell" value="{{@$hs_contacts->school_contact}}" class="form-control" data-inputmask="'mask': '+99-99-99999999'" maxlength="15">
                                        </td>
                                        <td>
                                            <input type="text" name="fp_tell_cell" id="fp_tell_cell" value="{{@$fp_contacts->school_contact}}" class="form-control" data-inputmask="'mask': '+99-99-99999999'" maxlength="15">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email </strong></td>
                                        <td>
                                            <input type="text" name="ds_email" id="ds_email" value="{{@$ds_contacts->email}}" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="hs_email" id="hs_email" value="{{@$hs_contacts->email}}" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="fp_email" id="fp_email" value="{{@$fp_contacts->email}}" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>CV </strong></td>
                                        <td>
                                            <input type="file" name="ds_cv" id="ds_cv" class="form-control">
                                        </td>
                                        <td>
                                            <input type="file" name="hs_cv" id="hs_cv" class="form-control">
                                        </td>
                                        <td>
                                            <input type="file" name="fp_cv" id="fp_cv" class="form-control">
                                            <span class="text-green">{{$fp_contacts->file}}</span>
                                        </td>
                                    </tr>

                                </table>

                                 </div>
                            <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" id="add" value="Submit" class="btn btn-info">
                                </div>
                            </div>
                           </form>
                        </div>
                        <!-- /.box-body -->
                        <!-- /.box -->
                    </div>
                    <!-- .box -->
{{--                    <div class="box " >--}}
{{--                        <div class="box-header">--}}
{{--                            <h3 class="box-title">Table 1.3 Contact Information</h3>--}}
{{--                        </div>--}}
{{--                        <!-- /.box-header -->--}}
{{--                        <div class="box-body">--}}
{{--                            <table  class="table table-bordered table-stripped">--}}
{{--                                <thead>--}}

{{--                                    <th></th>--}}
{{--                                    <th>Dean of school</th>--}}
{{--                                    <th>Head of school (if applicable)</th>--}}
{{--                                    <th>NBEAC focal person (if different) </th>--}}
{{--                                </thead>--}}
{{--                                <tr>--}}
{{--                                    <td><strong>Name:</strong></td>--}}
{{--                                    --}}
{{--                                    <td><input type="text" name="ds_name" id="ds_name" class="form-control"></td>--}}
{{--                                </tr>--}}

{{--                                <tr>--}}
{{--                                    <td><strong>Job title:</strong></td>--}}
{{--                                    <td>--}}
{{--                                        <input type="text" name="ds_job_title" id="ds_job_title" class="form-control">--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <input type="text" name="hs_job_title" id="hs_job_title" class="form-control">--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <input type="text" name="fp_job_title" id="fp_job_title" class="form-control">--}}
{{--                                    </td>--}}
{{--                                </tr>--}}

{{--                                <tr>--}}
{{--                                    <td><strong>Tel (off): </strong></td>--}}
{{--                                    <td>--}}
{{--                                        <input type="text" name="ds_tell_off" id="ds_tell_off" class="form-control" data-inputmask="'mask': '+99-99-99999999'" maxlength="15">--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <input type="text" name="hs_tell_off" id="hs_tell_off" class="form-control" data-inputmask="'mask': '+99-99-99999999'" maxlength="15">--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <input type="text" name="fp_tell_off" id="fp_tell_off" class="form-control" data-inputmask="'mask': '+99-99-99999999'" maxlength="15">--}}
{{--                                    </td>--}}
{{--                                </tr>--}}

{{--                                <tr>--}}
{{--                                    <td><strong>Tel (cell): </strong></td>--}}
{{--                                    <td>--}}
{{--                                        <input type="text" name="ds_tell_cell" id="ds_tell_cell" class="form-control" data-inputmask="'mask': '+99-99-99999999'" maxlength="15">--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <input type="text" name="hs_tell_cell" id="hs_tell_cell" class="form-control" data-inputmask="'mask': '+99-99-99999999'" maxlength="15">--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <input type="text" name="fp_tell_cell" id="fp_tell_cell" class="form-control" data-inputmask="'mask': '+99-99-99999999'" maxlength="15">--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td><strong>Email </strong></td>--}}
{{--                                    <td>--}}
{{--                                        <input type="text" name="ds_email" id="ds_email" class="form-control">--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <input type="text" name="hs_email" id="hs_email" class="form-control">--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <input type="text" name="fp_email" id="fp_email" class="form-control">--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td><strong>CV </strong></td>--}}
{{--                                    <td>--}}
{{--                                        <input type="file" name="ds_cv" id="ds_cv" class="form-control">--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <input type="file" name="hs_cv" id="hs_cv" class="form-control">--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <input type="file" name="fp_cv" id="fp_cv" class="form-control">--}}
{{--                                    </td>--}}
{{--                                </tr>--}}

{{--                            </table>--}}

{{--                            <table id="datatable" class="table table-bordered table-stripped">--}}
{{--                                <thead >--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}

{{--                                @foreach($contacts as $contact)--}}
{{--                                <tr>--}}
{{--                                    <td>{{$contact->name}}</td>--}}
{{--                                    <td>{{$contact->email}}</td>--}}
{{--                                    <td>{{$contact->contact_no}}</td>--}}
{{--                                    <td>{{$contact->designation->name}}</td>--}}
{{--                                    <td>{{$contact->school_contact}}</td>--}}
{{--                                    <td><a href="{{url($contact->cv)}}"><i class="fa fa-file-word-o"></i></a> </td>--}}
{{--                                    <td><i class="badge {{$contact->status == 'active'?'bg-green':'bg-red'}}">{{$contact->status == 'active'?'Active':'Inactive'}}</i></td>--}}
{{--                                    <td><i class="fa fa-trash text-info delete" data-id="{{$contact->id}}"></i> | <i data-row='{"id":{{$contact->id}},"name":"{{$contact->name}}","email":"{{$contact->email}}","contact_no":"{{$contact->contact_no}}","school_contact":"{{$contact->school_contact}}","designation_id":{{$contact->designation_id}},"cv":"{{$contact->cv}}","focal_person":"{{$contact->focal_person}}", "status":"{{$contact->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>--}}
{{--                                </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                                <tfoot >--}}
{{--                                <tr>--}}
{{--                                    <th>Name</th>--}}
{{--                                    <th>Email</th>--}}
{{--                                    <th>Contact</th>--}}
{{--                                    <th>Job Title</th>--}}
{{--                                    <th>Office Contact</th>--}}
{{--                                    <th>CV</th>--}}
{{--                                    <th>Status</th>--}}
{{--                                    <th>Action</th>--}}
{{--                                </tr>--}}
{{--                                </tfoot>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                        <!-- /.box-body -->--}}
{{--                    </div>--}}
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
                    <h4 class="modal-title">Edit Contact Information. </h4>
                </div>
                <form role="form" id="updateForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Contact Person Name</label>
                                <input type="text" name="name" id="edit_name" value="{{old('name')}}" class="form-control">
                                <input type="hidden" id="edit_id">
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
                                <input type="text" name="contact_no" id="edit_contact_no" value="{{old('contact_no')}}" class="form-control" data-inputmask="'mask': '+92-55-99999999'" maxlength="15">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Business School Contact</label>
                                <input type="text" name="school_contact" id="edit_school_contact" value="{{old('school_contact')}}" class="form-control">
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
                                <label for="name">NBEAC focal person (if different) </label>
                                <input type="text" name="focal_person" id="edit_focal_person" value="{{old('edit_focal_person')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Attach CV (Appendix-1A.)</label>
                                <input type="file" name="cv" id="edit_cv" >
                                <input type="hidden" name="old_cv" id="old_cv" >
                                <span class="text-blue" id="cv-name"></span>
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
        //Initialize Select2 Elements
        $('.select2').select2()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        /*Add Scope*/
        $('#form').submit(function (e) {
            let name = $('#ds_name').val();
            let email = $('#ds_email').val();
            let ds_tell_off = $('#ds_tell_off').val();
            let ds_tell_cell = $('#ds_tell_cell').val();
            let ds_cv = $('#ds_cv').val();

            !name?addClass('ds_name'):removeClass('ds_name');
            !email?addClass('email'):removeClass('email');
            !ds_tell_off?addClass('ds_tell_off'):removeClass('ds_tell_off');
            !ds_tell_cell?addClass('ds_tell_cell'):removeClass('ds_tell_cell');
            !ds_cv?addClass('ds_cv'):removeClass('ds_cv');

            if(!name || !ds_tell_off|| !ds_tell_cell || !email || !ds_cv)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("strategic/contact-info")}}',
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
                    //location.reload();
                },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })
                }
            })
        });
        ///// edit record
        $('.edit').on('click', function () {
            let data = JSON.parse(JSON.stringify($(this).data('row')));
            // Initialize Select2
            $('#edit_designation_id').select2().val(data.designation_id).trigger('change');
            $('#edit_name').val(data.name);
            $('#edit_email').val(data.email);
            $('#edit_contact_no').val(data.contact_no);
            $('#edit_school_contact').val(data.school_contact);
            $('#cv-name').text(data.cv);
            $('#edit_id').val(data.id);
            $('#old_cv').val(data.cv);
            $('#edit_focal_person').val(data.focal_person);
            // console.log('check', data.status);
            // $('#update-form').attr('action', 'contact-info/'+data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#updateForm').submit(function (e) {
            let name = $('#edit_name').val();
            let email = $('#edit_email').val();
            let contact_no = $('#edit_contact_no').val();
            let school_contact = $('#edit_school_contact').val();
            let designation_id = $('#edit_designation_id').val();
            let id = $('#edit_id').val();
            let edit_focal_person = $('#edit_focal_person').val();

            let status = $('input[name=edit_status]:checked').val();
            !name?addClass('edit_name'):removeClass('edit_name');
            !email?addClass('edit_email'):removeClass('edit_email');
            !contact_no?addClass('edit_contact_no'):removeClass('edit_contact_no');
            !school_contact?addClass('edit_school_contact'):removeClass('edit_school_contact');
            !designation_id?addClass('edit_designation_id'):removeClass('edit_designation_id');

            if(!name || !email || !contact_no || !school_contact || !designation_id)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("strategic/contact-info")}}/'+id,
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
                        url:'{{url("strategic/contact-info")}}/'+id,
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
