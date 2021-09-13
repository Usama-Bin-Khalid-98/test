@section('pageTitle', 'Research Summary')


@if(Auth::user())

    @include("../includes.head")
    <!-- Select2 -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />
    <style>
        .vertical{
            direction: rtl;
            transform: rotate(270deg);
        }
    </style>
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


        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title" style="width: 92%;">Provide a summary of 5.1  Provide a summary of research output<sup>6</sup> of business school in last three academic years in Table.5.1. Attach a complete list of items mentioned in the table using APA end-text referencing along with clearly mentioning type of each item as impact factor or HEC category, as Appendix-5A.</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                                </button>

                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="javascript:void(0)" id="form" method="POST">
                            <div class="col-md-12">
                                <div class="form-group col-md-3">
                                    <label for="name">Year</label>
                                    <select name="year" id="year" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select Year</option>
                                        <option value="{{$years['yeart']}}">{{ $years['yeart']}}</option>
                                        <option value="{{$years['year_t_1']}}">{{ $years['year_t_1']}}</option>
                                        <option value="{{$years['year_t_2']}}">{{ $years['year_t_2']}}</option>
                                    </select>
                                </div>
                            </div>

                                <table id="datatable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
{{--                                        <th class="vertical">Publication category</th>--}}
                                        <th>Publication type</th>
                                        <th>Total number of items</th>
                                        <th>Number of contributing core faculty members</th>
                                        <th>Number of items jointly produced in collaboration with other institutions</th>
                                        <th>Number of items jointly produced by faculty of same university</th>
                                        <th>Number of items jointly produced by more than 3 authors</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
{{--                                        <td class="vertical">Academic research articles</td>--}}
                                        @foreach($publications as $publication)
                                            <tr>
                                                <td>
                                                    {{@$publication->name}}
                                                    <input type="hidden" name="publication_type_id[]" value="{{@$publication->id}}">
                                                </td>
                                                <td><input type="text" name="total_items[]" id="total_items" value="" placeholder="Total Items" class="form-control"></td>
                                                <td><input type="text" name="contributing_core_faculty[]" id="contributing_core_faculty" value="" placeholder="Contributing Core Faculty" class="form-control"></td>
                                                <td><input type="text" name="jointly_produced_other[]"
                                                           id="jointly_produced_other" value="" placeholder="Jointly Produced Other" class="form-control"></td>
                                                <td><input type="text" name="jointly_produced_same[]"
                                                           id="jointly_produced_same" value="" placeholder="Jointly Produced Same " class="form-control"></td>
                                                <td><input type="text" name="jointly_produced_multiple[]"
                                                           id="jointly_produced_multiple" value="" placeholder="Jointly Produced Multiple" class="form-control"></td>
                                            </tr>
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>

{{--                             <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="name">Publication Category</label>--}}
{{--                                    <select name="publication_category_id" id="publication_category_id" class="form-control select2" style="width: 100%;">--}}
{{--                                        <option selected disabled>Select Publication Category</option>--}}
{{--                                        @foreach($publication_categories as $category)--}}
{{--                                         <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                        </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                                <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="name">Publication type</label>--}}
{{--                                    <select name="publication_type_id" id="publication_type_id" class="form-control select2" style="width: 100%;">--}}
{{--                                        <option selected disabled>Select Publication Type</option>--}}
{{--                                        @foreach($publications as $publication)--}}
{{--                                         <option value="{{$publication->id}}">{{$publication->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                        </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}




{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="name">Total number of items</label>--}}
{{--                                    <input type="text" name="total_items" id="total_items" value="" placeholder="Total Items" class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="name">Number of contributing core faculty members</label>--}}
{{--                                    <input type="text" name="contributing_core_faculty" id="contributing_core_faculty" value="" placeholder="Contributing Core Faculty" class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="name">Number of items jointly produced in collaboration with other institutionsr</label>--}}
{{--                                    <input type="text" name="jointly_produced_other"--}}
{{--                                    id="jointly_produced_other" value="" placeholder="Jointly Produced Other" class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="name">Number of items jointly produced by faculty of same university</label>--}}
{{--                                    <input type="text" name="jointly_produced_same"--}}
{{--                                    id="jointly_produced_same" value="" placeholder="Jointly Produced Same " class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="name">Number of items jointly produced by more than 3 authors</label>--}}
{{--                                    <input type="text" name="jointly_produced_multiple"--}}
{{--                                    id="jointly_produced_multiple" value="" placeholder="Jointly Produced Multiple" class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}


                            <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
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
                        <!-- /.box -->
                    </div>
                    <!-- .box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Table 5.1. Summary of research output</h3>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-stripped">
                                <thead>
                                <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Year</th>
                                    <th>Publication Type</th>
                                    <th>Total number of items</th>
                                    <th>Number of contributing core faculty members</th>
                                    <th>Number of items jointly produced in collaboration with other institutionsr</th>
                                    <th>Number of items jointly produced by faculty of same university</th>
                                    <th>Number of items jointly produced by more than 3 authors</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($summaries as $summary)
                                <tr>
                                    <td>{{$summary->campus->business_school->name}}</td>
                                    <td>{{$summary->campus->location}}</td>
                                    <td>{{$summary->year}}</td>
                                    <td>{{$summary->publication_type->name}}</td>
                                    <td>{{$summary->total_items}}</td>
                                    <td>{{$summary->contributing_core_faculty}}</td>
                                    <td>{{$summary->jointly_produced_other}}</td>
                                    <td>{{$summary->jointly_produced_same}}</td>
                                    <td>{{$summary->jointly_produced_multiple}}</td>
                                    <td><i class="badge {{$summary->status == 'active'?'bg-green':'bg-red'}}">{{$summary->status == 'active'?'Active':'Inactive'}}</i></td>
                                    <td><i class="fa fa-trash text-info delete" data-id="{{$summary->id}}"></i> | <i data-row='{"id":{{$summary->id}},"publication_type_id":{{$summary->publication_type_id}},"total_items":"{{$summary->total_items}}","year":"{{$summary->year}}","contributing_core_faculty":"{{$summary->contributing_core_faculty}}","jointly_produced_other":"{{$summary->jointly_produced_other}}","jointly_produced_same":"{{$summary->jointly_produced_same}}","jointly_produced_multiple":{{$summary->jointly_produced_multiple}}, "status":"{{$summary->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i> </td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Year</th>
                                    <th>Publication Type</th>
                                    <th>Total number of items</th>
                                    <th>Number of contributing core faculty members</th>
                                    <th>Number of items jointly produced in collaboration with other institutionsr</th>
                                    <th>Number of items jointly produced by faculty of same university</th>
                                    <th>Number of items jointly produced by more than 3 authors</th>
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
                                <label for="name">Publication Type</label>
                                <select name="publication_type_id" id="edit_publication_type_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Publication Type</option>
                                    @foreach($publications as $publication)
                                        <option value="{{$publication->id}}">{{$publication->name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="edit_id">
                            </div>
                        </div>




                        <div class="col-md-6">
                            <div class="form-group">
                                    <label for="name">Total Items</label>
                                    <input type="text" name="total_items" id="edit_total_items" value="{{old('total_items')}}" class="form-control">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Contributing Core Faculty</label>
                                    <input type="text" name="contributing_core_faculty" id="edit_contributing_core_faculty" value="{{old('contributing_core_faculty')}}"  class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Jointly Produced Other</label>
                                    <input type="text" name="jointly_produced_other"
                                    id="edit_jointly_produced_other" value="{{old('jointly_produced_other')}}"  class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Jointly Produced Same</label>
                                    <input type="text" name="jointly_produced_same"
                                    id="edit_jointly_produced_same" value="{{old('jointly_produced_same')}}" class="form-control">
                            </div>
                        </div>

                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Jointly Produced Multiple</label>
                                    <input type="text" name="jointly_produced_multiple"
                                    id="edit_jointly_produced_multiple" value="{{old('jointly_produced_multiple')}}"  class="form-control">
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

        {{--$('#publication_category_id').on('change', function () {--}}
        {{--    let publication_category_id = $(this).val();--}}
        {{--    //console.log('id here', publication_category_id);--}}
        {{--    //return;--}}
        {{--    $.ajax({--}}
        {{--        url:'{{url("get_publication_category")}}/'+publication_category_id,--}}
        {{--        type:'GET',--}}
        {{--        data: {publication_category_id:publication_category_id},--}}
        {{--        beforeSend: function(){--}}
        {{--            Notiflix.Loading.Pulse('Processing...');--}}
        {{--        },--}}
        {{--        // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');--}}
        {{--        success: function (response) {--}}
        {{--            Notiflix.Loading.Remove();--}}
        {{--            console.log('response here', response);--}}
        {{--           // return;--}}
        {{--            //if(response.success){--}}
        {{--                var data =[];--}}
        {{--                //$('#city').val(null);--}}
        {{--                $("#publication_type_id").empty();--}}
        {{--                Object.keys(response).forEach(function (index) {--}}
        {{--                    data.push({id:response[index].id, text:response[index].name});--}}
        {{--                })--}}

        {{--                console.log('data herer', data);--}}
        {{--                $('#publication_type_id').select2({--}}
        {{--                    data--}}
        {{--                });--}}
        {{--                Notiflix.Notify.Success(response.success);--}}
        {{--           // }--}}

        {{--            console.log('response', response);--}}
        {{--           // location.reload();--}}
        {{--        },--}}
        {{--        error:function(response, exception){--}}
        {{--            Notiflix.Loading.Remove();--}}
        {{--            $.each(response.responseJSON, function (index, val) {--}}
        {{--                Notiflix.Notify.Failure(val);--}}
        {{--            })--}}
        {{--        }--}}
        {{--    })--}}

        {{--})--}}
            let check = false;

        $('#form').submit(function (e) {
            let publication_type_id = $('input[name*="publication_type_id"]').val();
            let total_items = $('input[name*="total_items"]').val();
            let contributing_core_faculty = $('input[name*="contributing_core_faculty"]').val();
            let jointly_produced_other = $('input[name*="jointly_produced_other"]').val();
            let jointly_produced_same = $('input[name*="jointly_produced_same"]').val();
            let jointly_produced_multiple = $('input[name*="jointly_produced_multiple"]').val();
            let year = $('#year').val();

            !publication_type_id?addClass('publication_type_id'):removeClass('publication_type_id');
            !year?addClass('year'):removeClass('year');
            !total_items?addClass('total_items'):removeClass('total_items');
            !contributing_core_faculty?addClass('contributing_core_faculty'):removeClass('contributing_core_faculty');
            !jointly_produced_other?addClass('jointly_produced_other'):removeClass('jointly_produced_other');
            !jointly_produced_same?addClass('jointly_produced_same'):removeClass('jointly_produced_same');
            !jointly_produced_multiple?addClass('jointly_produced_multiple'):removeClass('jointly_produced_multiple');

            if(!year)
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
                    check = true;
                    setTimeout(()=>{
                    location.reload()},2000 )
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
             $('#edit_publication_type_id').select2().val(data.publication_type_id).trigger('change');
             $('#edit_year').select2().val(data.year).trigger('change');
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
            let publication_type_id = $('#edit_publication_type_id').val();
            let total_items = $('#edit_total_items').val();
            let contributing_core_faculty = $('#edit_contributing_core_faculty').val();
            let jointly_produced_other = $('#edit_jointly_produced_other').val();
            let jointly_produced_same = $('#edit_jointly_produced_same').val();
            let jointly_produced_multiple = $('#edit_jointly_produced_multiple').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !publication_type_id?addClass('edit_publication_type_id'):removeClass('edit_publication_type_id');
            !total_items?addClass('edit_total_items'):removeClass('edit_total_items');
            !contributing_core_faculty?addClass('edit_contributing_core_faculty'):removeClass('edit_contributing_core_faculty');
            !jointly_produced_other?addClass('edit_jointly_produced_other'):removeClass('edit_jointly_produced_other');
            !jointly_produced_same?addClass('edit_jointly_produced_same'):removeClass('edit_jointly_produced_same');
            !jointly_produced_multiple?addClass('edit_jointly_produced_multiple'):removeClass('edit_jointly_produced_multiple');

            if(!publication_type_id  || !total_items || !contributing_core_faculty || !jointly_produced_other || !jointly_produced_same || !jointly_produced_multiple)
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

        $('.next').on('click', function (){
            setTimeout(()=>{
                if(check){
                    window.location = '/financial-info';
                }
            }, 1000)
        });


    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
