@section('pageTitle', 'Affiliations')
@php
$isActiveSAR = getFirst('App\Models\MentoringInvoice' ,['regStatus'=>'SAR','campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id]);
@endphp

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
                Affiliations of any national or international members
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Affiliations</li>
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
                </div>
            </div>
        </section>

        {{--Dean section --}}
        <section class="content">
            <div class=" form row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">1.5 Provide details in Table 1.5 about the names, designations and affiliations of all external (academic and corporate), national or international members in each of the statutory bodies mentioned above in Table 1.4.</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                                </button>
                                <!--<div class="btn-group">-->
                                <!--    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">-->
                                <!--        <i class="fa fa-file-pdf-o"></i></button>-->
                                <!--     </div>-->
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                           <form action="javascript:void(0)" id="form" method="POST" enctype="multipart/form-data">
                            <div class="row">
                               <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Name of member</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
{{--                                    <select name="statutory_committees_id" id="statutory_committees_id" class="form-control select2" style="width: 100%;">--}}
{{--                                        <option selected disabled >Select Member</option>--}}
{{--                                        @foreach($statutory_committee as $committee)--}}
{{--                                        <option value="{{$committee->id}}">{{$committee->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                        </select>--}}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <select name="designation" id="designation" class="form-control select2" style="width: 100%;">
                                        <option value="" selected disabled>Select Designation</option>
                                        @foreach($designations as $designation)
                                            <option value="{{$designation->id}}">{{$designation->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="other_designation" id="other_designation" placeholder="Enter designation name" class="form-control hide" style="margin-top:5px;">
                                </div>
                            </div>
                              
                           <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Affiliation</label>
                                <input type="text" name="affiliation" id="affiliation" class="form-control">
                            </div>
                           </div>
                               <div class="col-md-3">
                                   <div class="form-group">
                                       <label for="name">Name of statutory body </label>
                                       <select name="statutory_bodies_id" id="statutory_bodies_id" class="form-control select2" style="width: 100%;">
                                           <option selected disabled >Select Body Name</option>
                                           @foreach($bodies as $designation)
                                               <option value="{{$designation->id}}">{{$designation->name }}</option>
                                           @endforeach
                                       </select>
                                   </div>
                               </div>
                               </div>
                               <div class="row">
                               <div class="col-md-6 jumbotron" style="margin-left : 20px;">
                                   <div class="col-md-6">
                                       <div class="form-group pull-left">
                                           <label for="sector">Sample File</label>
                                           <div style="margin-top: 20px">
                                               <a href="{{url('samples/affiliation-sample.csv')}}" class="btn btn-danger">Click to Download</a>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                    <div class="form-group pull-left" style="margin-top: 40px">
                                        <label for="sector">&nbsp;Import CSV</label>
                                        <input type="file" name="file" id="file" />
                                    <div style="margin-top: 20px">
                                        <input type="submit" name="add" id="add" value="Import" class="btn btn-info">
                                    </div>
                                    </div>
                                   </div>
                               </div>
                               </div>
                               <div class="row">
                                        <div class="form-group pull-right" style="margin-top: 40px;margin-right: 40px">
                                            <label for="sector">&nbsp;&nbsp;</label>
                                            <input type="submit" name="add" id="add" value="Add" class="btn btn-info">
                                        </div>

                                   <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" value="Add & Next" class="btn btn-success next">
                            </div>
                               </div>
                         </form>
                        </div>
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->
                </div>
                <!-- Main content -->
            </div>

            <div class="form row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Table 1.5 Affiliations of any external (academic and corporate), national or international members</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                                </button>
                                <!--<div class="btn-group">-->
                                <!--    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">-->
                                <!--        <i class="fa fa-file-pdf-o"></i></button>-->
                                <!--</div>-->
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                            </div>
                        </div>

                    {{--  Content here --}}
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Name of Member</th>
                                    <th>Designation</th>
                                    <th>Affiliation</th>
                                    <th>Statutory Body Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($affiliations as $affiliation)
                                <tr>
                                    <td>{{$affiliation->campus->business_school->name}}</td>
                                    <td>{{$affiliation->campus->location}}</td>
                                    <td>{{$affiliation->name}}</td>
                                    <td>{{$affiliation->designation->name}}</td>
                                    <td>{{$affiliation->affiliation}}</td>
                                    <td>{{@$affiliation->statutory_bodies->name}}</td>
                                    <td><i class="badge {{$affiliation->status == 'active'?'bg-green':'bg-red'}}">{{$affiliation->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$affiliation->id}}"></i> | <i class="fa fa-pencil text-blue edit" 
                               data-row='{"id":"{{$affiliation->id}}",
                               "name":"{{$affiliation->name}}",
                               "designation":"{{$affiliation->designation->id}}",
                               "designation_default":{{$affiliation->designation->is_default}},
                               "designation_name":"{{$affiliation->designation->name}}",
                               "affiliation":"{{$affiliation->affiliation}}","statutory_bodies_id":"{{$affiliation->statutory_bodies_id}}","status":"{{$affiliation->status}}"}' data-toggle="modal" data-target="#edit-modal"></i></td>

                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Name of Member</th>
                                    <th>Designation</th>
                                    <th>Affiliation</th>
                                    <th>Statutory Body Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Affiliations. </h4>
                </div>
                <form role="form" id="updateForm" enctype="multipart/form-data" >
                    <div class="modal-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name of Statutory Body</label>
                                <select name="statutory_bodies_id" id="edit_statutory_bodies_id" class="form-control select2" style="width: 100%;">
                                    <option selected disabled >Select Body Name</option>
                                    @foreach($bodies as $designation)
                                        <option value="{{$designation->id}}">{{$designation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name of Member</label>
                                    <input type="text" name="name" id="edit_name" class="form-control" value="{{old('name')}}">
                                </div>
                                <input type="hidden" id="edit_id">
                            </div>

                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Designation</label>
                                    <select name="designation" id="edit_designation_id" class="form-control select2" style="width: 100%;">
                                        <option value="" selected disabled>Select Designation</option>
                                        @foreach($designations as $designation)
                                            <option value="{{$designation->id}}">{{$designation->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="other_designation" id="edit_designation" placeholder="Designation" class="form-control hide">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Affiliation</label>
                                    <input type="text" name="affiliation" id="edit_affiliation" value="{{old('edit_affiliation')}}"  class="form-control">
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


    <div class="modal fade" id="add-other-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Name of Statutory Body. </h4>
                </div>
                <form role="form"method="post" >
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Name of Statutory Body</label>
                                <input type="text" name="new_name_body" id="new_name_body" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" name="body_name" id="body_name" class="btn btn-info">add</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="designation_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add New Designation</h4>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="discipline_name">Designation Name</label>
                                <input type="designation_name" id="designation_name" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="button" class="btn btn-info" value="Add" id="add_designation">
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
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script>
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        });
        $(function () {
            $('#datatable').DataTable({
                dom : "lBfrtip",
            })
        })
    </script>
    <script type="text/javascript">

        $('#designation').on('change', function (e) {
            if(this.options[this.selectedIndex].text == 'Other'){
                $('#other_designation').removeClass('hide');
            }else{
                $('#other_designation').addClass('hide');
            }
        });
        window.onload = function () {
            if($('#designation option:selected').text() == 'Other'){
                $('#other_designation').removeClass('hide');
            }
        }
        $("#edit_designation_id").on('change', function(e){
            if(this.options[this.selectedIndex].text == 'Other'){
                $("#edit_designation").removeClass('hide');
            }else{
                $("#edit_designation").addClass('hide');
            }
        })
        $('#statutory_bodies_id').on('change', function () {
            let val = $(this).val();
            console.log('dropdoen val', val);
            if(val == 7){
                $('#add-other-modal').modal('show');
            }

        });
        $('.select2').select2()

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#add_designation').on('click', function () {
            let designation_name = $('#designation_name').val();
            !designation_name?addClass('designation_name'):removeClass('designation_name');
            if(!designation_name){
                Notiflix.Notify.Failure("Designation name field is required.");
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{{url('add-designation')}}",
                data: {name:designation_name},
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
                    let insert_id = response.insert_id;
                    // if(insert_id){
                    //
                    //     let options = $('<option selected></option>').val(insert_id).text(designation_name);
                    //     $('#designation_id').append(options).trigger('change');
                    // }
                    // $('#designation_modal').modal('hide');
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


        var check = false;
        $('#form').submit(function (e) {
            //  let clickMe = $(this).val();
            // let designation_id = $('#designation_id').val();
            // let affiliation = $('#affiliation').val();
            // let name = $('#name').val();
            // let statutory_bodies_id = $('#statutory_bodies_id').val();

            // !name?addClass('name'):removeClass('name');
            // !designation_id?addClass('designation_id'):removeClass('designation_id');
            // !affiliation?addClass('affiliation'):removeClass('affiliation');
            // // !statutory_bodies_id?addClass('statutory_bodies_id'):removeClass('statutory_bodies_id');
            //
            // if(!designation_id || !affiliation || !name)
            // {
            //     Notiflix.Notify.Warning("Fill all the required Fields.");
            //     return;
            // }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({

                url:'{{url("strategic/affiliations")}}',
                type:'POST',
                data:formData,
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

                    if(response.error){
                        Notiflix.Notify.Failure(response.error);
                    }
                    console.log('response', response);

                    check = true;
                    setTimeout(()=> {
                        location.reload();}, 2000);
                },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })
                }
            })
        });


         $('#body_name').on('click',function () {
            let name = $('#new_name_body').val();
            !name?addClass('new_name_body'):removeClass('new_name_body');

            if(!name)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            $.ajax({
                url:'{{url("strategic/add-body-name")}}',
                type:'POST',
                data: {name: name},
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
                    // let last_insert_id = response.last_insert_id
                    // if(last_insert_id)
                    // {
                    //     console.log('name id', last_insert_id, 'name ', name);
                    //     var $option = $("<option selected></option>").val(last_insert_id).text(name);
                    //
                    //     $('#statutory_bodies_id').append($option).trigger('change');
                    // }

                    $('#add-other-modal').modal('hide');
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
            if(data.designation_default){
                $('#edit_designation_id').val(data.designation).trigger('change');
                $('#edit_designation').addClass('hide');
            }else{
                $("#edit_designation_id option:contains('Other')").prop("selected", true).trigger('change');
                $('#edit_designation').val(data.designation_name);
                $('#edit_designation').removeClass('hide');
            }
            $('#edit_name').val(data.name);
            $('#edit_affiliation').val(data.affiliation);
            $('#edit_statutory_bodies_id').select2().val(data.statutory_bodies_id).trigger('change');
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#updateForm').submit(function (e) {
            let name = $('#edit_name').val();
            let designation = $('#edit_designation_id').val();
            let affiliation = $('#edit_affiliation').val();
            let statutory_bodies_id = $('#edit_statutory_bodies_id').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !name?addClass('edit_name'):removeClass('edit_name');
            !designation?addClass('edit_designation'):removeClass('edit_designation');
            !affiliation?addClass('edit_affiliation'):removeClass('edit_affiliation');
            !statutory_bodies_id?addClass('edit_statutory_bodies_id'):removeClass('edit_statutory_bodies_id');

            if(!name || !designation || !affiliation || !statutory_bodies_id)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("strategic/affiliations")}}/'+id,
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
                        location.reload();
                    }
                    if(response.error){
                        Notiflix.Notify.Failure(response.error);
                    }
                    //console.log('response', response);
                    
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
                        url:'{{url("strategic/affiliations")}}/'+id,
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

        $('.next').on('click', function (){
            setTimeout(()=>{
                if(check){
                    @if($isActiveSAR)
                        window.location = '/strategic/summarize-policy';
                    @else
                        window.location = '/strategic/budgetary-info';
                    @endif
                }
            }, 1000)
        });



    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
