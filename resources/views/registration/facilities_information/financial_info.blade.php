@section('pageTitle', 'Financial Info')


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
                Financial Information of the Business School
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active">Financial Info</li>
            </ol>
        </section>


        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">6.1   Provide complete financial information of the business school in Table.6.1 (Rupees in million). </h3>
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
                                    <label for="name">Particulars</label>
                                    <select name="income_source_id" id="income_source_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Particulars</option>
                                        @foreach($income as $source)
                                         <option value="{{$source->id}}">{{$source->particular}} ({{$source->type}})</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Year t-3</label>
                                    <input type="text" name="year_three" id="year_three" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Year t-2</label>
                                    <input type="text" name="year_two" id="year_two" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Year t-1</label>
                                    <input type="text" name="year_one" id="year_one" class="form-control">
                                </div>
                              </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Year t</label>
                                    <input type="text" name="year_t" id="year_t" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Year t+1</label>
                                    <input type="text" name="year_t_plus_one" id="year_t_plus_one" class="form-control">
                                </div>
                              </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Year t+2</label>
                                    <input type="text" name="year_t_plus_two" id="year_t_plus_two" class="form-control">
                                </div>
                              </div>

                             <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" id="add" value="Add" class="btn btn-info">
                                </div>

                                 <div class="form-group pull-right" style="margin-top: 40px">
                                    <label for="sector">&nbsp;&nbsp;</label>
                                    <input type="submit" name="add" id="add" value="Add & Next" class="btn btn-success next">
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
                            <h3 class="box-title">Table 6.1. Financial information of the business school</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
{{--                                    <th>Business School</th>--}}
{{--                                    <th>Campus</th>--}}
                                    <th>Income Source</th>
                                    <th>Year t-3</th>
                                    <th>Year t-2</th>
                                    <th>Year t-1</th>
                                    <th>Year t</th>
                                    <th>Year t+1</th>
                                    <th>Year t+2</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $year3 = $year2 =  $year1 = $year_t = $year_t_plus = $year_t_plus_two = 0 ;
                                    @endphp
                                    @foreach($infos as $summary)
                                        @php
                                            $year3 += $summary->year_three;
                                            $year2 += $summary->year_two;
                                            $year1 += $summary->year_one;
                                            $year_t += $summary->year_t;
                                            $year_t_plus += $summary->year_t_plus_one;
                                            $year_t_plus_two += $summary->year_t_plus_two;
                                        @endphp
                                <tr>
{{--                                    <td>{{$summary->campus->business_school->name}}</td>--}}
{{--                                    <td>{{$summary->campus->location}}</td>--}}
                                    <td>{{@$summary->income_source->particular}}</td>
                                    <td>{{$summary->year_three}}</td>
                                    <td>{{$summary->year_two}}</td>
                                    <td>{{$summary->year_one}}</td>
                                    <td>{{$summary->year_t}}</td>
                                    <td>{{$summary->year_t_plus_one}}</td>
                                    <td>{{$summary->year_t_plus_two}}</td>
                                    <td><i class="badge {{$summary->status == 'active'?'bg-green':'bg-red'}}">{{$summary->status == 'active'?'Active':'Inactive'}}</i></td>
                                    <td><i class="fa fa-trash text-info delete" data-id="{{$summary->id}}"></i> | <i data-row='{"id":{{$summary->id}},"income_source_id":"{{$summary->income_source_id}}","year_three":"{{$summary->year_three}}","year_two":"{{$summary->year_two}}","year_one":"{{$summary->year_one}}","year_t":"{{$summary->year_t}}","year_t_plus_one":"{{$summary->year_t_plus_one}}","year_t_plus_two":"{{$summary->year_t_plus_two}}","status":"{{$summary->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>
                                </tr>
                                @endforeach

                                <tr style="background-color: #8B98AB">
                                    <th >TOTAL REVENUE (A)</th>
                                    <th>{{$year3}}</th>
                                    <th>{{$year2}}</th>
                                    <th>{{$year1}}</th>
                                    <th>{{$year_t}}</th>
                                    <th>{{$year_t_plus}}</th>
                                    <th>{{$year_t_plus_two}}</th>
                                    <th colspan="2"></th>
                                </tr>

                                    @php
                                        $exp_year3 = $exp_year2 =  $exp_year1 = $exp_year_t = $exp_year_t_plus = $exp_year_t_plus_two = 0 ;
                                    @endphp
                                    @foreach($infos_expense as $summary_expense)
                                        @php
                                            $exp_year3 += $summary_expense->year_three;
                                            $exp_year2 += $summary_expense->year_two;
                                            $exp_year1 += $summary_expense->year_one;
                                            $exp_year_t += $summary_expense->year_t;
                                            $exp_year_t_plus += $summary_expense->year_t_plus_one;
                                            $exp_year_t_plus_two += $summary_expense->year_t_plus_two;
                                        @endphp
                                <tr>
{{--                                    <td>{{$summary_expense->campus->business_school->name}}</td>--}}
{{--                                    <td>{{$summary_expense->campus->location}}</td>--}}
                                    <td>{{@$summary_expense->income_source->particular}}</td>
                                    <td>{{$summary_expense->year_three}}</td>
                                    <td>{{$summary_expense->year_two}}</td>
                                    <td>{{$summary_expense->year_one}}</td>
                                    <td>{{$summary_expense->year_t}}</td>
                                    <td>{{$summary_expense->year_t_plus_one}}</td>
                                    <td>{{$summary_expense->year_t_plus_two}}</td>
                                    <td><i class="badge {{$summary_expense->status == 'active'?'bg-green':'bg-red'}}">{{$summary_expense->status == 'active'?'Active':'Inactive'}}</i></td>
                                    <td><i class="fa fa-trash text-info delete" data-id="{{$summary_expense->id}}"></i> | <i data-row='{"id":{{$summary_expense->id}},"income_source_id":"{{$summary_expense->income_source_id}}","year_three":"{{$summary_expense->year_three}}","year_two":"{{$summary_expense->year_two}}","year_one":"{{$summary_expense->year_one}}","year_t":"{{$summary_expense->year_t}}","year_t_plus_one":"{{$summary_expense->year_t_plus_one}}","year_t_plus_two":"{{$summary_expense->year_t_plus_two}}","status":"{{$summary_expense->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>
                                </tr>
                                @endforeach

                                <tr style="background-color: #8B98AB">
                                    <th>TOTAL EXPENSES (B)</th>
                                    <th>{{$exp_year3}}</th>
                                    <th>{{$exp_year2}}</th>
                                    <th>{{$exp_year1}}</th>
                                    <th>{{$exp_year_t}}</th>
                                    <th>{{$exp_year_t_plus}}</th>
                                    <th>{{$exp_year_t_plus_two}}</th>
                                    <th colspan="2"></th>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
{{--                                    <th>Business School</th>--}}
{{--                                    <th>Campus</th>--}}
                                    <th>Income Source</th>
                                    <th>Year t-3</th>
                                    <th>Year t-2</th>
                                    <th>Year t-1</th>
                                    <th>Year t</th>
                                    <th>Year t+1</th>
                                    <th>Year t+2</th>
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
                    <h4 class="modal-title">Edit Financial Info. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Income Source</label>
                                    <select name="income_source_id" id="edit_income_source_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Income Source</option>
                                        @foreach($income as $source)
                                         <option value="{{$source->id}}">{{$source->particular}}</option>
                                        @endforeach
                                        </select>
                                </div>
                                <input type="hidden" id="edit_id">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Year t-3</label>
                                    <input type="text" name="year_three" id="edit_year_three" value="{{old('edit_year_three')}}" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Year t-2</label>
                                    <input type="text" name="year_two" id="edit_year_two" value="{{old('edit_year_two')}}" class="form-control">
                                </div>
                              </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Year t-1</label>
                                    <input type="text" name="year_one" id="edit_year_one" value="{{old('edit_year_one')}}" class="form-control">
                                </div>
                              </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Year t</label>
                                    <input type="text" name="year_t" id="edit_year_t" value="{{old('edit_year_t')}}" class="form-control">
                                </div>
                              </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Year t+1</label>
                                    <input type="text" name="year_t_plus_one" id="edit_year_t_plus_one" value="{{old('edit_year_t_plus_one')}}" class="form-control">
                                </div>
                              </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Year t+2</label>
                                    <input type="text" name="year_t_plus_two" id="edit_year_t_plus_two" value="{{old('edit_year_t_plus_two')}}" class="form-control">
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
        let check = false;

         $('#form').submit(function (e) {
            let income_source_id = $('#income_source_id').val();
            let year_three = $('#year_three').val();
            let year_two = $('#year_two').val();
            let year_one = $('#year_one').val();
            let year_t = $('#year_t').val();
            let year_t_plus_one = $('#year_t_plus_one').val();
            let year_t_plus_two = $('#year_t_plus_two').val();

            !income_source_id?addClass('income_source_id'):removeClass('income_source_id');
            !year_three?addClass('year_three'):removeClass('year_three');
            !year_two?addClass('year_two'):removeClass('year_two');
            !year_one?addClass('year_one'):removeClass('year_one');
            !year_t?addClass('year_t'):removeClass('year_t');
            !year_t_plus_one?addClass('year_t_plus_one'):removeClass('year_t_plus_one');
            !year_t_plus_two?addClass('year_t_plus_two'):removeClass('year_t_plus_two');

            if(!income_source_id || !year_three || !year_two || !year_one || !year_t || !year_t_plus_one || !year_t_plus_two)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("financial-info")}}',
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


         $('.edit').on('click', function () {
            // let data = JSON.parse(JSON.stringify($(this).data('row')));
             let data = JSON.parse(JSON.stringify($(this).data('row')));
            $('#edit_income_source_id').select2().val(data.income_source_id).trigger('change');
            $('#edit_year_three').val(data.year_three);
            $('#edit_year_two').val(data.year_two);
            $('#edit_year_one').val(data.year_one);
            $('#edit_year_t').val(data.year_t);
            $('#edit_year_t_plus_one').val(data.year_t_plus_one);
            $('#edit_year_t_plus_two').val(data.year_t_plus_two);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let income_source_id = $('#edit_income_source_id').val();
            let year_three = $('#edit_year_three').val();
            let year_two = $('#edit_year_two').val();
            let year_one = $('#edit_year_one').val();
            let year_t = $('#edit_year_t').val();
            let year_t_plus_one = $('#edit_year_t_plus_one').val();
            let year_t_plus_two = $('#edit_year_t_plus_two').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !income_source_id?addClass('edit_income_source_id'):removeClass('edit_income_source_id');
            !year_three?addClass('edit_year_three'):removeClass('edit_year_three');
            !year_two?addClass('edit_year_two'):removeClass('edit_year_two');
            !year_one?addClass('edit_year_one'):removeClass('edit_year_one');
            !year_t?addClass('edit_year_t'):removeClass('edit_year_t');
            !year_t_plus_one?addClass('edit_year_t_plus_one'):removeClass('edit_year_t_plus_one');
            !year_t_plus_two?addClass('edit_year_t_plus_two'):removeClass('edit_year_t_plus_two');

            if(!income_source_id || !year_three || !year_two || !year_one || !year_t || !year_t_plus_one || !year_t_plus_two )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("financial-info")}}/'+id,
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
                        url:'{{url("financial-info")}}/'+id,
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
                    window.location = '/business-school-facility';
                }
            }, 1000)
        });

    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
