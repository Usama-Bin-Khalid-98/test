@section('pageTitle', 'Affiliations')


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
                    <button class="btn gradient-bg-color"
                           data-toggle="modal" data-target="#add-modal"
                           style="color: white;"
                           value="Add New"
                            name="add" id="add">PDF <i class="fa fa-file-pdf-o"></i></button>
                </div>
            </div>
        </section>

        {{--Dean section --}}
        <section class="content">
            <div class=" form row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Provide details of affiliations of all external (academic and corporate), national or international members in each of the statutory bodies mentioned above Table 1.5.</h3>
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
                                       <label for="name">Name of Statutory Body</label>
                                       <select name="statutory_bodies_id" id="statutory_bodies_id" class="form-control select2" style="width: 100%;">
                                           <option selected disabled >Select Body Name</option>
                                           @foreach($bodies as $designation)
                                               <option value="{{$designation->id}}">{{$designation->name }}</option>
                                           @endforeach
                                       </select>
                                   </div>
                               </div>

                               <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Name of Member</label>
                                    <select name="statutory_committees_id" id="statutory_committees_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled >Select Member</option>
                                        @foreach($statutory_committee as $committee)
                                        <option value="{{$committee->id}}">{{$committee->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Designation</label>
                                    <select name="designation_id" id="designation_id" class="form-control select2" style="width: 100%;">
                                        <option selected  disabled >Select Designation</option>
                                        @foreach($designations as $designation)
                                            <option value="{{$designation->id}}">{{$designation->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Affiliation</label>
                                    <input type="text" name="affiliation" id="affiliation" class="form-control">
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

                    </div>
                    <!-- /.box -->
                </div>
                <!-- Main content -->
            </div>

            <div class="form row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Affiliations</h3>
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

                    {{--  Content here --}}
                    <!-- /.box -->

                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name of Statutory Body</th>
                                    <th>Name of Member</th>
                                    <th>Designation</th>
                                    <th>Affiliation</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($affiliations as $affiliation)
                                <tr>

                                    <td>{{$affiliation->statutory_bodies->name}}</td>
                                    <td>{{$affiliation->statutory_committees->name}}</td>
                                    <td>{{$affiliation->designation->name}}</td>
                                    <td>{{$affiliation->affiliation}}</td>
                                    <td><i class="badge {{$affiliation->status == 'active'?'bg-green':'bg-red'}}">{{$affiliation->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$affiliation->id}}"></i> | <i class="fa fa-pencil text-blue edit" data-row='{"id":"{{$affiliation->id}}","statutory_committees_id":"{{$affiliation->statutory_committees_id}}","designation_id":"{{$affiliation->designation_id}}","affiliation":"{{$affiliation->affiliation}}","statutory_bodies_id":"{{$affiliation->statutory_bodies_id}}","status":"{{$affiliation->status}}"}' data-toggle="modal" data-target="#edit-modal"></i></td>

                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name of Statutory Body</th>
                                    <th>Name of Member</th>
                                    <th>Designation</th>
                                    <th>Affiliation</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->

                        <!-- /.box -->


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
                <form role="form" id="updateForm" >
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
                                    <select name="statutory_committees_id" id="edit_statutory_committees_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled >Select Member</option>
                                        @foreach($statutory_committee as $committee)
                                        <option value="{{$committee->id}}">{{$committee->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                                <input type="hidden" id="edit_id">
                            </div>

                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Designation</label>
                                    <select name="designation_id" id="edit_designation_id" class="form-control select2" style="width: 100%;">
                                        <option selected  disabled >Select Designation</option>
                                        @foreach($designations as $designation)
                                            <option value="{{$designation->id}}">{{$designation->name }}</option>
                                        @endforeach
                                    </select>
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
            let statutory_committees_id = $('#statutory_committees_id').val();
            let designation_id = $('#designation_id').val();
            let affiliation = $('#affiliation').val();
            let statutory_bodies_id = $('#statutory_bodies_id').val();

            !statutory_committees_id?addClass('statutory_committees_id'):removeClass('statutory_committees_id');
            !designation_id?addClass('designation_id'):removeClass('designation_id');
            !affiliation?addClass('affiliation'):removeClass('affiliation');
            !statutory_bodies_id?addClass('statutory_bodies_id'):removeClass('statutory_bodies_id');

            if(!statutory_committees_id || !designation_id || !affiliation || !statutory_bodies_id)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("strategic/affiliations")}}',
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
            $('#edit_statutory_committees_id').select2().val(data.statutory_committees_id).trigger('change');
            $('#edit_designation_id').select2().val(data.designation_id).trigger('change');
            $('#edit_affiliation').val(data.affiliation);
            $('#edit_statutory_bodies_id').select2().val(data.statutory_bodies_id).trigger('change');
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let statutory_committees_id = $('#edit_statutory_committees_id').val();
            let designation_id = $('#edit_designation_id').val();
            let affiliation = $('#edit_affiliation').val();
            let statutory_bodies_id = $('#edit_statutory_bodies_id').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !statutory_committees_id?addClass('edit_statutory_committees_id'):removeClass('edit_statutory_committees_id');
            !designation_id?addClass('edit_designation_id'):removeClass('edit_designation_id');
            !affiliation?addClass('edit_affiliation'):removeClass('edit_affiliation');
            !statutory_bodies_id?addClass('edit_statutory_bodies_id'):removeClass('edit_statutory_bodies_id');

            if(!statutory_committees_id || !designation_id || !affiliation || !statutory_bodies_id)
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




    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
