@section('pageTitle',  'Faculty Exchange Program')


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
                Faculty Exchange Program
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Faculty Exchange Program </li>
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
                            <h3 class="box-title">8.4.b  Provide data of Faculty exchange programs for last three years in Table 8.4b respectively. Attach the relevant policy as Appendix-8B. </h3>
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
                                    <label for="name">Year</label>
                                    <select name="year" id="year" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Year</option>
                                        <option value="{{ now()->year}}">{{ now()->year}}</option>
                                        <option value="{{ now()->year-1}}">{{ now()->year - 1}}</option>
                                        <option value="{{ now()->year -2}}">{{ now()->year -2 }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Destination country</label>
                                    <input type="text" name="destination_country" id="destination_country" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Name of Faculty</label>
                                    <input type="text"  name="faculty_name" id="faculty_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Source country</label>
                                    <input type="text"  name="source_country" id="source_country" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Name of Faculty</label>
                                    <input type="text"  name="name_faculty" id="name_faculty" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Attach Doc</label>
                                    <input type="file" name="file" id="file" >
                                    <span class="text-red">Max upload file size 2mb.</span>
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
                            <h3 class="box-title">Table 8.4b Faculty Exchange Program</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>Destination country</th>
                                    <th>Faculty name</th>
                                    <th>Source country</th>
                                    <th>Faculty name</th>
                                    <th>Document</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td colspan="2" style="background-color: grey; color: white; text-align: center;">Faculty outflow</td>
                                        <td colspan="2" style="background-color: grey; color: white; text-align: center;">Faculty inflow</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                               @foreach($genders as $enrolement)
                                <tr>
                                    <td>{{$enrolement->year}}</td>
                                    <td>{{$enrolement->destination_country}}</td>
                                    <td>{{$enrolement->faculty_name}}</td>
                                    <td>{{$enrolement->source_country}}</td>
                                    <td>{{$enrolement->name_faculty}}</td>
                                    <td><a href="{{url($enrolement->file)}}"><i class="fa fa-file-word-o"></i></a> </td>
                                    <td><i class="badge {{$enrolement->status == 'active'?'bg-green':'bg-red'}}">{{$enrolement->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$enrolement->id}}"></i> | <i data-row='{"id":"{{$enrolement->id}}","year":"{{$enrolement->year}}","destination_country":"{{$enrolement->destination_country}}","faculty_name":"{{$enrolement->faculty_name}}","source_country":"{{$enrolement->source_country}}","name_faculty":"{{$enrolement->name_faculty}}","file":"{{$enrolement->file}}","status":"{{$enrolement->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>

                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Year</th>
                                    <th>Destination country</th>
                                    <th>Faculty name</th>
                                    <th>Source country</th>
                                    <th>Faculty name</th>
                                    <th>Document</th>
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
                    <h4 class="modal-title">Student Exchange Program </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                       <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Year</label>
                                    <select name="year" id="edit_year" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Year</option>
                                        <option value="{{ now()->year}}">{{ now()->year}}</option>
                                        <option value="{{ now()->year-1}}">{{ now()->year - 1}}</option>
                                        <option value="{{ now()->year -2}}">{{ now()->year -2 }}</option>
                                    </select>
                                </div>
                            </div>
                       

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Destination country</label>
                                    <input type="text" name="destination_country"
                                    id="edit_destination_country" value="{{old('edit_destination_country')}}" class="form-control">
                            </div>
                             <input type="hidden" name="id" id="edit_id">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Faculty name</label>
                                    <input type="text" name="faculty_name"
                                    id="edit_faculty_name" value="{{old('edit_faculty_name')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Source country</label>
                                    <input type="text" name="source_country"
                                    id="edit_source_country" value="{{old('edit_source_country')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Faculty name</label>
                                    <input type="text" name="name_faculty"
                                    id="edit_name_faculty" value="{{old('edit_name_faculty')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Attach Doc (Appendix-1C)</label>
                                <input type="file" name="file" id="edit_file" >
                                <input type="hidden" name="old_file" id="old_file" >
                                <span class="text-blue" id="file-name"></span>
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
    $("#datatable").DataTable({
      dom : "lBfrtip",
    })
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
            // let uni_id = $('#uni_id').val();
            let year = $('#year').val();
            let destination_country = $('#destination_country').val();
            let faculty_name = $('#faculty_name').val();
            let source_country = $('#source_country').val();
            let name_faculty = $('#name_faculty').val();
            let file = $('#file').val();

            !year?addClass('year'):removeClass('year');
            !destination_country?addClass('destination_country'):removeClass('destination_country');
            !faculty_name?addClass('faculty_name'):removeClass('faculty_name');
            !source_country?addClass('source_country'):removeClass('source_country');
            !name_faculty?addClass('name_faculty'):removeClass('name_faculty');
            !file?addClass('file'):removeClass('file');

            if(!year || !destination_country || !faculty_name || !source_country || !name_faculty || !file )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("faculty-exchange")}}',
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
            $('#edit_year').select2().val(data.year).trigger('change');
            $('#edit_destination_country').val(data.destination_country);
            $('#edit_faculty_name').val(data.faculty_name);
            $('#edit_source_country').val(data.source_country);
            $('#edit_name_faculty').val(data.name_faculty);
            $('#file-name').text(data.file);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#updateForm').submit(function (e) {
            let year = $('#edit_year').val();
            let destination_country = $('#edit_destination_country').val();
            let faculty_name = $('#edit_faculty_name').val();
            let source_country = $('#edit_source_country').val();
            let name_faculty = $('#edit_name_faculty').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !year?addClass('year'):removeClass('year');
            !destination_country?addClass('destination_country'):removeClass('destination_country');
            !faculty_name?addClass('faculty_name'):removeClass('faculty_name');
            !source_country?addClass('source_country'):removeClass('source_country');
            !name_faculty?addClass('name_faculty'):removeClass('name_faculty');

            if(!year || !destination_country || !faculty_name || !source_country || !name_faculty )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("faculty-exchange")}}/'+id,
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
                        url:'{{url("faculty-exchange")}}/'+id,
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