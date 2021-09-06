@section('pageTitle', 'Research Funding')


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
                Research Funding
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Research Funding </li>
            </ol>
        </section>

        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">5.4   Provide data on research funding by source over the last three years in Table 5.3. </h3>
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
                        <form action="javascript:void(0)" id="form" method="POST">

                        <div class="box-body">
                            <div class="col-md-4">
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

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">University’s R&D budget allocation
(A)
</label>
                                    <input type="number" name="uni_budget" id="uni_budget" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Business school’s R&D budget allocation
(B)
</label>
                                    <input type="number" name="bs_budget" id="bs_budget" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Government grants
(C)
</label>
                                    <input type="number" name="gov_grant" id="gov_grant" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Corporate grants
(D)
</label>
                                    <input type="number" name="corp_grant" id="corp_grant" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">International grants
(E)
</label>
                                    <input type="number" name="int_grant" id="int_grant" class="form-control">
                                </div>
                            </div>


                             <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" id="add" value="Add" class="btn btn-info">
                                </div>
                            </div>
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
                            <h3 class="box-title">Table 5.3. Details of research funding (in PKR)</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th colspan="3" style="text-align: center; background-color: #D3D3D3">Funds secured by faculty</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                <tr>
                                    <th>Time</th>
                                    <th>University’s R&D budget allocation(A)</th>
                                    <th>Business school’s R&D budget allocation(B)</th>
                                    <th style="background-color: #D3D3D3">Government grants(C)</th>
                                    <th style="background-color: #D3D3D3">Corporate grants(D)</th>
                                    <th style="background-color: #D3D3D3">International grants(E)</th>
                                    <th>Total R&D funds available to business school=B+C+D+E</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($enrolments as $enrolement)
                                <tr>
                                    <td>{{$enrolement->year}}</td>
                                    <td>{{$enrolement->uni_budget}}</td>
                                    <td>{{$enrolement->bs_budget}}</td>
                                    <td>{{$enrolement->gov_grant}}</td>
                                    <td>{{$enrolement->corp_grant}}</td>
                                    <td>{{$enrolement->int_grant}}</td>
                                    <td>{{$enrolement->total}}</td>
                                    <td><i class="badge {{$enrolement->status == 'active'?'bg-green':'bg-red'}}">{{$enrolement->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$enrolement->id}}"></i> | <i data-row='{"id":"{{$enrolement->id}}","year":{{$enrolement->year}},"uni_budget":"{{$enrolement->uni_budget}}","bs_budget":"{{$enrolement->bs_budget}}","gov_grant":"{{$enrolement->gov_grant}}","corp_grant":"{{$enrolement->corp_grant}}","int_grant":"{{$enrolement->int_grant}}","status":"{{$enrolement->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>

                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Time</th>
                                    <th>University’s R&D budget allocation(A)</th>
                                    <th>Business school’s R&D budget allocation(B)</th>
                                    <th style="background-color: #D3D3D3">Government grants(C)</th>
                                    <th style="background-color: #D3D3D3">Corporate grants(D)</th>
                                    <th style="background-color: #D3D3D3">International grants(E)</th>
                                    <th>Total R&D funds available to business school=B+C+D+E</th>
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
                    <h4 class="modal-title">Edit Research Funding. </h4>
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
                                <input type="hidden" name="id" id="edit_id">
                            </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                    <label for="name">University’s R&D budget allocation(A)</label>
                                    <input type="number" name="uni_budget" id="edit_uni_budget" value="{{old('uni_budget')}}" class="form-control">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                    <label for="name">Business school’s R&D budget allocation(B)</label>
                                    <input type="number" name="bs_budget" id="edit_bs_budget" value="{{old('bs_budget')}}" class="form-control">

                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                    <label for="name">Government grants(C)</label>
                                    <input type="number" name="gov_grant" id="edit_gov_grant" value="{{old('gov_grant')}}" class="form-control">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Corporate grants(D)</label>
                                    <input type="number"  name="corp_grant"
                                    id="edit_corp_grant" value="{{old('corp_grant')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">International grants(E)</label>
                                    <input type="number" name="int_grant"
                                    id="edit_int_grant" value="{{old('int_grant')}}" class="form-control">
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
            // let uni_id = $('#uni_id').val();
            let year = $('#year').val();
            let uni_budget = $('#uni_budget').val();
            let bs_budget = $('#bs_budget').val();
            let gov_grant = $('#gov_grant').val();
            let corp_grant = $('#corp_grant').val();
            let int_grant = $('#int_grant').val();

            !year?addClass('year'):removeClass('year');
            !uni_budget?addClass('uni_budget'):removeClass('uni_budget');
            !bs_budget?addClass('bs_budget'):removeClass('bs_budget');
            !gov_grant?addClass('gov_grant'):removeClass('gov_grant');
            !corp_grant?addClass('corp_grant'):removeClass('corp_grant');
            !int_grant?addClass('int_grant'):removeClass('int_grant');

            if(!year || !uni_budget || !bs_budget || !gov_grant || !corp_grant || !int_grant)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("research-funding")}}',
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
            $('#edit_year').select2().val(data.year).trigger('change');
            $('#edit_uni_budget').val(data.uni_budget);
            $('#edit_bs_budget').val(data.bs_budget);
            $('#edit_gov_grant').val(data.gov_grant);
            $('#edit_corp_grant').val(data.corp_grant);
            $('#edit_int_grant').val(data.int_grant);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#updateForm').submit(function (e) {
            let year = $('#edit_year').val();
            let uni_budget = $('#edit_uni_budget').val();
            let bs_budget = $('#edit_bs_budget').val();
            let gov_grant = $('#edit_gov_grant').val();
            let corp_grant = $('#edit_corp_grant').val();
            let int_grant = $('#edit_int_grant').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !year?addClass('edit_year'):removeClass('edit_year');
            !uni_budget?addClass('edit_uni_budget'):removeClass('edit_uni_budget');
            !bs_budget?addClass('edit_bs_budget'):removeClass('edit_bs_budget');
            !gov_grant?addClass('edit_gov_grant'):removeClass('edit_gov_grant');
            !corp_grant?addClass('edit_corp_grant'):removeClass('edit_corp_grant');
            !int_grant?addClass('edit_int_grant'):removeClass('edit_int_grant');

            if(!year || !uni_budget || !bs_budget || !gov_grant || !corp_grant || !int_grant)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("research-funding")}}/'+id,
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
                        url:'{{url("research-funding")}}/'+id,
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
