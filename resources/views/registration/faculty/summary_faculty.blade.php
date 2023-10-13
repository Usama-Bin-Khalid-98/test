@section('pageTitle', 'Summary BSF')
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
                Summary BSF
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Summary BSF </li>
            </ol>
        </section>


        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">@if($isActiveSAR) 4.1 Provide information about core business school faculty [Core business faculty: Faculty with terminal degree in business, management and related areas and teaching core business courses.] as follows: present aggregate numbers in Table 4.1(a) and information on individual faculty members in Table 4.1(b). Note that the data in grey font is given only for illustrative purposes; please replace it with actual data. @else 4.1 Provide information about core business school faculty : present aggregate numbers in Table 4.1 @endif</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Minimize"></i>
                                </button>
                                <!-- <div class="btn-group">
                                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-file-pdf-o"></i></button>
                                </div> -->
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" data-toggle="tooltip" data-placement="left" title="close"></i></button>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="javascript:void(0)" id="form" method="POST">
                                <table id="formTable" class="table table-bordered table-striped" >
                                    <thead>
                                    <th>Qualification</th>
                                    @foreach($discipline as $program)
                                    <th>{{@$program->name}}
                                    <input type="hidden" name="discipline_id[]" value="{{@$program->id}}">
                                    </th>
                                    @endforeach
                                    <th>Total</th>
                                    </thead>
                                    <tbody id="tbody">
                                    @foreach($qualification as $degree)
                                    <tr>
                                        <td>{{$degree->name}}
                                        <input type="hidden" name="faculty_qualification_id[]" value="{{@$degree->id}}">
                                        </td>
                                        @foreach($discipline as $program)
                                            <td><input type="number" min="0" name="number_faculty[{{@$program->id}}][]" placeholder="no of Faculty" class="form-control"></td>
                                        @endforeach
                                        <td><input type="number" readonly name="total[]" value="" class="form-control"></td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                             <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px">
                                    <input type="submit" name="add" id="add" value="Add" class="btn btn-info">
                                </div>

                                 <div class="form-group pull-right" style="margin-top: 40px; margin-right: 10px">
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
                            <h3 class="box-title">@if($isActiveSAR) Table 4.1(a). Business School Faculty @else Table 4.1 Summary of the business schools’ faculty @endif</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Faculty Qualification</th>
                                    <th>Discipline</th>
                                    <th>Number of Faculty</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                 @foreach($summaries as $portfolio)
                                <tr>
                                    <td>{{$portfolio->campus->business_school->name}}</td>
                                    <td>{{$portfolio->campus->location}}</td>
                                    <td>{{$portfolio->faculty_qualification->name}}</td>
                                    <td>{{$portfolio->discipline->name}}</td>
                                    <td>{{$portfolio->number_faculty}}</td>
                                    <td><i class="badge {{$portfolio->status == 'active'?'bg-green':'bg-red'}}">{{$portfolio->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$portfolio->id}}"></i> | <i data-row='{"id":{{$portfolio->id}},"faculty_qualification_id":"{{$portfolio->faculty_qualification_id}}","discipline_id":"{{$portfolio->discipline_id}}","number_faculty":"{{$portfolio->number_faculty}}","status":"{{$portfolio->status}}"}' data-toggle="modal" data-target="#edit-modal" class="fa fa-pencil text-blue edit"></i></td>

                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Faculty Qualification</th>
                                    <th>Discipline</th>
                                    <th>Total : {{@$number/2}}</th>
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
                    <h4 class="modal-title">Edit Summary BSF. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Faculty Qualification</label>
                                    <select name="faculty_qualification_id" id="edit_faculty_qualification_id" class="form-control select2">
                                        <option value="">Select Qualification</option>
                                        @foreach($qualification as $degree)
                                        <option value="{{$degree->id}}">{{$degree->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <input type="hidden" id="edit_id">
                            </div>

                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Discipline</label>
                                    <select name="discipline_id" id="edit_discipline_id" class="form-control">
                                        <option value="">Select Discipline</option>
                                        @foreach($discipline as $program)
                                            <option value="{{$program->id}}">{{$program->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label for="name">Number of Faculty</label>
                                    <input type="number" name="number_faculty" id="edit_number_faculty" value="{{old('edit_number_faculty')}}"class="form-control">
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
            $('#datatable').DataTable({
                dom : "lBfrtip",
            })
        })
    </script>
    <script type="text/javascript">

        $('.select2').select2()

        $(document).ready(function () {
            let total = 0;
            $('input[name*="number_faculty"]').keyup(function () {
                let columns = $(this).closest('tr').find('td');
                    // columns.addClass('row-highlight');
                var total = 0;
                var value = 0;

                let col = columns.find('input[name*="total"]').val('');
                console.log('colums data here ....',columns);
                jQuery.each(columns, function(key) {
                if(key!=0) {
                    console.log('key here', key);

                    value = $('input:eq(0)', this).val();

                    console.log('value here....', value);
                    value ? total += parseInt(value) || 0 : 0;
                }
                });
                console.log('total here', total);
                columns.find('input[name*="total"]').val(total);

            });
        })


         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let check = false;

             $('#form').submit(function (e) {
            let faculty_qualification_id = $('input[name*="faculty_qualification_id"]').val();
            let discipline_id = $('input[name*="discipline_id"]').val();
            let number_faculty = $('input[name*="number_faculty"]').val();

            !faculty_qualification_id?addClass('faculty_qualification_id'):removeClass('faculty_qualification_id');
            !discipline_id?addClass('discipline_id'):removeClass('discipline_id');
            !number_faculty?addClass('number_faculty'):removeClass('number_faculty');

            if(!faculty_qualification_id || !discipline_id || !number_faculty )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("faculty-summary")}}',
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
            let data = JSON.parse(JSON.stringify($(this).data('row')));

            $('#edit_faculty_qualification_id').select2().val(data.faculty_qualification_id).trigger('change');
            $('#edit_discipline_id').select2().val(data.discipline_id).trigger('change');
            $('#edit_number_faculty').val(data.number_faculty);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let faculty_qualification_id = $('#edit_faculty_qualification_id').val();
            let discipline_id = $('#edit_discipline_id').val();
            let number_faculty = $('#edit_number_faculty').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !faculty_qualification_id?addClass('edit_faculty_qualification_id'):removeClass('edit_faculty_qualification_id');
            !discipline_id?addClass('edit_discipline_id'):removeClass('edit_discipline_id');
            !number_faculty?addClass('edit_number_faculty'):removeClass('edit_number_faculty');

            if(!faculty_qualification_id || !discipline_id || !number_faculty)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("faculty-summary")}}/'+id,
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
                        url:'{{url("faculty-summary")}}/'+id,
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
                        window.location = '/faculty-detailed-info';
                    @else
                        window.location = '/work-load';
                    @endif
                }
            }, 1000)
        });


    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
