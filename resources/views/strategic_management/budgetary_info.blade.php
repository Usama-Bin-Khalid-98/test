@section('pageTitle', 'Budgetary Information')


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
               Budgetary Info
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Budgetary Info </li>
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

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Provide Budgetary information of the business school in table 1.6</h3>
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
                                    <label for="name">University Budget</label>
                                    <input type="text" name="uni_budget" id="uni_budget" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Budget proposed by Business School</label>
                                    <input type="text" name="uni_proposed_budget" id="uni_proposed_budget" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Budget received by Business School</label>
                                    <input type="text" name="budget_receive" id="budget_receive" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Budget Type</label>
                                    <select name="budget_type" id="budget_type" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Budget Type</option>
                                        <option value="Implicit">Implicit</option>
                                        <option value="Explicit">Explicit</option>
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
                    </div>
                    <!-- /.box -->
                </div>

                <!-- Main content -->
            </div>

            <div class="form row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Budgetary information of the business school.</h3>
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
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>University Budget</th>
                                    <th>University proposed Budget</th>
                                    <th>Budget received by University</th>
                                    <th>Budget Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($budgets as $budget)
                                <tr>
                                    <td>{{$budget->year}}</td>
                                    <td>{{$budget->uni_budget}}</td>
                                    <td>{{$budget->uni_proposed_budget}}</td>
                                    <td>{{$budget->budget_receive}}</td>
                                    <td>{{$budget->budget_type}}</td>
                                    <td><i class="badge {{$budget->status == 'active'?'bg-green':'bg-red'}}">{{$budget->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$budget->id}}"></i> | <i class="fa fa-pencil text-blue edit" data-row='{"id":"{{$budget->id}}","year":"{{$budget->year}}","uni_budget":"{{$budget->uni_budget}}","uni_proposed_budget":"{{$budget->uni_proposed_budget}}","budget_receive":"{{$budget->budget_receive}}","budget_type":"{{$budget->budget_type}}", "status":"{{$budget->status}}"}' data-toggle="modal" data-target="#edit-modal"></i></td>

                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Year</th>
                                    <th>University Budget</th>
                                    <th>University proposed Budget</th>
                                    <th>Budget received by University</th>
                                    <th>Budget Type</th>
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
                    <h4 class="modal-title">Edit Budgetary Info. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Year</label>
                                    <select name="year" id="edit_year" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Year</option>
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
                                <input type="hidden" id="edit_id">
                            </div>

                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">University Budget</label>
                                    <input type="text" name="uni_budget" id="edit_uni_budget" value="{{old('edit_uni_budget')}}" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Budget proposed by Business School</label>
                                    <input type="text" name="uni_proposed_budget" id="edit_uni_proposed_budget" value="{{old('edit_uni_proposed_budget')}}" class="form-control">
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Budget received by Business School</label>
                                    <input type="text" name="budget_receive" id="edit_budget_receive" value="{{old('edit_budget_receive')}}" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Budget Type</label>
                                    <select name="budget_type" id="edit_budget_type" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Budget Type</option>
                                        <option value="Implicit">Implicit</option>
                                        <option value="Explicit">Explicit</option>
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
            let year = $('#year').val();
            let uni_budget = $('#uni_budget').val();
            let uni_proposed_budget = $('#uni_proposed_budget').val();
            let budget_receive = $('#budget_receive').val();
            let budget_type = $('#budget_type').val();

            !year?addClass('year'):removeClass('year');
            !uni_budget?addClass('uni_budget'):removeClass('uni_budget');
            !uni_proposed_budget?addClass('uni_proposed_budget'):removeClass('uni_proposed_budget');
            !budget_receive?addClass('budget_receive'):removeClass('budget_receive');
            !budget_type?addClass('budget_type'):removeClass('budget_type');

            if(!year || !uni_budget || !uni_proposed_budget || !budget_receive || !budget_type)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("strategic/budgetary-info")}}',
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
            $('#edit_year').select2().val(data.year).trigger('change');
            $('#edit_uni_budget').val(data.uni_budget);
            $('#edit_uni_proposed_budget').val(data.uni_proposed_budget);
            $('#edit_budget_receive').val(data.budget_receive);
            $('#edit_budget_type').select2().val(data.budget_type).trigger('change');
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let year = $('#edit_year').val();
            let uni_budget = $('#edit_uni_budget').val();
            let uni_proposed_budget = $('#edit_uni_proposed_budget').val();
            let budget_receive = $('#edit_budget_receive').val();
            let budget_type = $('#edit_budget_type').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !year?addClass('edit_year'):removeClass('edit_year');
            !uni_budget?addClass('edit_uni_budget'):removeClass('edit_uni_budget');
            !uni_proposed_budget?addClass('edit_uni_proposed_budget'):removeClass('edit_uni_proposed_budget');
            !budget_receive?addClass('edit_budget_receive'):removeClass('edit_budget_receive');
            !budget_type?addClass('edit_budget_type'):removeClass('edit_budget_type');

            if(!year || !uni_budget || !uni_proposed_budget || !budget_receive || !budget_type)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("strategic/budgetary-info")}}/'+id,
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
                        url:'{{url("strategic/budgetary-info")}}/'+id,
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
