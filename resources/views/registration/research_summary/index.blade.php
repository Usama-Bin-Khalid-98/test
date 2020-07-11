@section('pageTitle', 'Research Summary')


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
                Research Summary
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active">Research Summary</li>
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
                    <div class="box box-primary" style="border: 1px solid; padding: 10px; box-shadow: 5px 10px 18px #716bde;">
                        <div class="box-header">
                            <h3 class="box-title" style="width: 92%;">Provide a summary of research output of business school in last three academic years.
                                Attach a complete list of items mentioned in the table using APA end-text referencing along with clearly
                                mentioning type of each item as impact factor or HEC category.</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                                </button>
                                
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="javascript:void(0)" id="form" method="POST">
                            <!-- <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Publication Type</label>
                                    <select name="program" class="form-control">
                                        <option value="">Select Type</option>
                                        <option value="">Impact factor journals</option>
                                        <option value="">HEC category W</option>
                                        <option value="">HEC category X</option>
                                        <option value="">HEC category Y</option>
                                        <option value="">ABS or ABDC listing</option>
                                    </select>
                                </div>
                            </div> -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Total Items*</label>
                                    <input type="text" name="total_items" id="total_items" value="" placeholder="Total Items" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Contributing Core Faculty*</label>
                                    <input type="text" name="contributing_core_faculty" id="contributing_core_faculty" value="" placeholder="Contributing Core Faculty" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Jointly Produced Other*</label>
                                    <input type="text" name="jointly_produced_other" 
                                    id="jointly_produced_other" value="" placeholder="Jointly Produced Other" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Jointly Produced Same*</label>
                                    <input type="text" name="jointly_produced_same" 
                                    id="jointly_produced_same" value="" placeholder="Jointly Produced Same " class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Jointly Produced Multiple*</label>
                                    <input type="text" name="jointly_produced_multiple" 
                                    id="jointly_produced_multiple" value="" placeholder="Jointly Produced Multiple" class="form-control">
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
                    <div class="box box-primary" style="border: 1px solid; padding: 10px; box-shadow: 5px 10px 18px #716bde;">
                        <div class="box-header">
                            <h3 class="box-title">Research Summary List</h3>
                             <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                                </button>
                                
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-hover">
                                <thead style="background-color: #DCDCDC;">
                                <tr>
                                    <th>Total Items</th>
                                    <th>Contributing Core Faculty</th>
                                    <th>Jointly Produced Other</th>
                                    <th>Jointly Produced Same</th>
                                    <th>Jointly Produced Multiple</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($summaries as $summary)
                                <tr>
                                    <td>{{$summary->total_items}}</td>
                                    <td>{{$summary->contributing_core_faculty}}</td>
                                    <td>{{$summary->jointly_produced_other}}</td>
                                    <td>{{$summary->jointly_produced_same}}</td>
                                    <td>{{$summary->jointly_produced_multiple}}</td>
                                    <td><i class="badge {{$summary->status == 'active'?'bg-green':'bg-red'}}">{{$summary->status == 'active'?'Active':'Inactive'}}</i></td>
                                    <td><i class="fa fa-trash text-info delete" data-id="{{$summary->id}}"></i> | <i data-row='{"id":{{$summary->id}},"total_items":"{{$summary->total_items}}","contributing_core_faculty":"{{$summary->contributing_core_faculty}}","jointly_produced_other":"{{$summary->jointly_produced_other}}","jointly_produced_same":"{{$summary->jointly_produced_same}}","jointly_produced_multiple":{{$summary->jointly_produced_multiple}}, "status":"{{$summary->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot style="background-color: #DCDCDC;">
                                <tr>
                                    <th>Total Items</th>
                                    <th>Contributing Core Faculty</th>
                                    <th>Jointly Produced Other</th>
                                    <th>Jointly Produced Same</th>
                                    <th>Jointly Produced Multiple</th>
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
                    <h4 class="modal-title">Edit Research Summary. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                    <label for="name">Total Items*</label>
                                    <input type="text" name="total_items" id="edit_total_items" value="{{old('total_items')}}" class="form-control">
                                <input type="hidden" id="edit_id">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Contributing Core Faculty*</label>
                                    <input type="text" name="contributing_core_faculty" id="edit_contributing_core_faculty" value="{{old('contributing_core_faculty')}}"  class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Jointly Produced Other*</label>
                                    <input type="text" name="jointly_produced_other" 
                                    id="edit_jointly_produced_other" value="{{old('jointly_produced_other')}}"  class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Jointly Produced Same*</label>
                                    <input type="text" name="jointly_produced_same" 
                                    id="edit_jointly_produced_same" value="{{old('jointly_produced_same')}}" class="form-control">
                            </div>
                        </div>

                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Jointly Produced Multiple*</label>
                                    <input type="text" name="jointly_produced_multiple" 
                                    id="edit_jointly_produced_multiple" value="{{old('jointly_produced_multiple')}}"  class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">{{ __('Status*') }} : </label>
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
            let total_items = $('#total_items').val();
            let contributing_core_faculty = $('#contributing_core_faculty').val();
            let jointly_produced_other = $('#jointly_produced_other').val();
            let jointly_produced_same = $('#jointly_produced_same').val();
            let jointly_produced_multiple = $('#jointly_produced_multiple').val();

            !total_items?addClass('total_items'):removeClass('total_items');
            !contributing_core_faculty?addClass('contributing_core_faculty'):removeClass('contributing_core_faculty');
            !jointly_produced_other?addClass('jointly_produced_other'):removeClass('jointly_produced_other');
            !jointly_produced_same?addClass('jointly_produced_same'):removeClass('jointly_produced_same');
            !jointly_produced_multiple?addClass('jointly_produced_multiple'):removeClass('jointly_produced_multiple');

            if(!total_items || !contributing_core_faculty || !jointly_produced_other|| !jointly_produced_same || !jointly_produced_multiple)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("research-summary")}}',
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
            let data = JSON.parse(JSON.stringify($(this).data('row')));
            // Initialize Select2
            $('#edit_total_items').val(data.total_items);
            $('#edit_contributing_core_faculty').val(data.contributing_core_faculty);
            $('#edit_jointly_produced_other').val(data.jointly_produced_other);
            $('#edit_jointly_produced_same').val(data.jointly_produced_same);
            $('#edit_jointly_produced_multiple').val(data.jointly_produced_multiple);
            $('#edit_id').val(data.id);
            // console.log('check', data.status);
            // $('#update-form').attr('action', 'contact-info/'+data.id);
            $('input[value='+data.status+']').iCheck('check');
        });


    $('#updateForm').submit(function (e) {
            let total_items = $('#edit_total_items').val();
            let contributing_core_faculty = $('#edit_contributing_core_faculty').val();
            let jointly_produced_other = $('#edit_jointly_produced_other').val();
            let jointly_produced_same = $('#edit_jointly_produced_same').val();
            let jointly_produced_multiple = $('#edit_jointly_produced_multiple').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !total_items?addClass('edit_total_items'):removeClass('edit_total_items');
            !contributing_core_faculty?addClass('edit_contributing_core_faculty'):removeClass('edit_contributing_core_faculty');
            !jointly_produced_other?addClass('edit_jointly_produced_other'):removeClass('edit_jointly_produced_other');
            !jointly_produced_same?addClass('edit_jointly_produced_same'):removeClass('edit_jointly_produced_same');
            !jointly_produced_multiple?addClass('edit_jointly_produced_multiple'):removeClass('edit_jointly_produced_multiple');

            if(!total_items || !contributing_core_faculty || !jointly_produced_other || !jointly_produced_same || !jointly_produced_multiple)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("research-summary")}}/'+id,
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
                        url:'{{url("research-summary")}}/'+id,
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
