@section('pageTitle', 'Faculty Stability')
@php
$isActiveSAR = getFirst('App\Models\Sar\SarInvoice' ,['regStatus'=>'SAR','campus_id' => Auth::user()->campus_id,'department_id' => Auth::user()->department_id]);
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
                Faculty Stability
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Faculty Stability </li>
            </ol>
        </section>


        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">@if($isActiveSAR) 4.3 Provide data on faculty turnover in Table 4.3. @else 4.5 Provide data on faculty stability in Table 4.5. @endif</h3>
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

                        <!-- /.box-header -->
                        <div class="box-body">

                        <form action="javascript:void(0)" id="form" method="POST">

                            @foreach($years as $year)
                                <div class="form-row col-md-12">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="name">Year</label>
                                            <input type="text" readonly name="year[]"  id="year-{{@$year}}" class="form-control year-field" value="{{@$year}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="name">Total faculty</label>
                                            <input type="number" name="total_faculty[]" id="total_faculty-{{@$year}}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="name">Resigned</label>
                                            <input type="number" name="resigned[]" id="resigned-{{@$year}}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="name">Retired</label>
                                            <input type="number" name="retired[]" id="retired-{{@$year}}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="name">Terminated</label>
                                            <input type="number" name="terminated[]" id="terminated-{{@$year}}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="name">New induction</label>
                                            <input type="number" name="new_induction[]" id="new_induction-{{@$year}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                <div class="col-md-12">
                                    <div class="form-group pull-right" style="margin-top: 40px">
                                        <label for="sector">&nbsp;&nbsp;</label>
                                        <input type="submit" name="add" id="add" value="Add" class="btn btn-info">
                                    </div>

                                    <div class="form-group pull-right" style="margin-top: 40px">
                                        <label for="sector">&nbsp;&nbsp;</label>
                                        <input type="submit" name="add" id="add" value="Add & Next" class="btn btn-success  next">
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
                            <h3 class="box-title">@if($isActiveSAR) Table 4.3. Faculty Turnover @else Table 4.5.Faculty Stability @endif</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Year</th>
                                    <th>Total Faculty</th>
                                    <th>Resigned</th>
                                    <th>Retired</th>
                                    <th>Terminated</th>
                                    <th>New Induction</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                             @foreach($stabilities as $req)
                                <tr>
                                    <td>{{$req->campus->business_school->name}}</td>
                                    <td>{{$req->campus->location}}</td>
                                    <td>{{$req->year}}</td>
                                    <td>{{$req->total_faculty}}</td>
                                    <td>{{$req->resigned}}</td>
                                    <td>{{$req->retired}}</td>
                                    <td>{{$req->terminated}}</td>
                                    <td>{{$req->new_induction}}</td>
                                    <td><i class="badge {{$req->status == 'active'?'bg-green':'bg-red'}}">{{$req->status == 'active'?'Active':'Inactive'}}</i></td>
                               <td><i class="fa fa-trash text-info delete" data-id="{{$req->id}}"></i> | <i class="fa fa-pencil text-blue edit" data-row='{"id":"{{$req->id}}","total_faculty":"{{$req->total_faculty}}","year":"{{$req->year}}","resigned":"{{$req->resigned}}","retired":"{{$req->retired}}","terminated":"{{$req->terminated}}","new_induction":"{{$req->new_induction}}","status":"{{$req->status}}","isCompleted":"{{$req->isCompleted}}"}' data-toggle="modal" data-target="#edit-modal"></i></td>

                                </tr>
                                @endforeach



                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Business School</th>
                                    <th>Campus</th>
                                    <th>Year</th>
                                    <th>Total Faculty</th>
                                    <th>Retired</th>
                                    <th>Resigned</th>
                                    <th>Terminated</th>
                                    <th>New Induction</th>
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
                    <h4 class="modal-title">Edit Faculty Stability. </h4>
                </div>
                <form role="form" id="updateForm" >
                    <div class="modal-body">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Total Faculty</label>
                                    <input type="number" name="total_faculty" id="edit_total_faculty" value="{{old('edit_total_faculty')}}" class="form-control">
                                </div>
                                <input type="hidden" id="edit_id">
                            </div>

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
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                        <option value="2032">2032</option>
                                        <option value="2033">2033</option>
                                        <option value="2034">2034</option>
                                        <option value="2035">2035</option>
                                        <option value="2036">2036</option>
                                        <option value="2037">2037</option>
                                        <option value="2038">2038</option>
                                        <option value="2039">2039</option>
                                        <option value="2040">2040</option>
                                    </select>
                                </div>
                            </div>


                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Resigned</label>
                                    <input type="number" name="resigned" id="edit_resigned" value="{{old('edit_resigned')}}" class="form-control">
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Retired</label>
                                    <input type="number" name="retired" id="edit_retired" value="{{old('edit_retired')}}" class="form-control">
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Terminated</label>
                                    <input type="number" name="terminated" id="edit_terminated" value="{{old('edit_terminated')}}" class="form-control">
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">New Induction</label>
                                    <input type="number" name="new_induction" id="edit_new_induction" value="{{old('edit_new_induction')}}" class="form-control">
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

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let check = false;
         $('#form').submit(function (e) {
            let fields = ['resigned','retired','terminated','new_induction'];
            let hasEmptyField = false;
            let isEmptyForm = true;

            $('.year-field').map(function(){
                let year = this.id.split('-')[1];
                if ($('#total_faculty-' + year).val()){
                    isEmptyForm = false;
                    fields.forEach(function(value, index){
                        let field_id = value + '-' + year;
                        if($('#' + field_id).val()){
                            removeClass(field_id);
                        }else{
                            addClass(field_id);
                            hasEmptyField = true;
                        }
                    })
                }else{
                    fields.forEach(function(value, index){
                        let field_id = value + '-' + year;
                        removeClass(field_id);
                    })
                }
            })

            if(hasEmptyField)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            if(isEmptyForm){
                Notiflix.Notify.Warning("Please fill data of at least 1 year");
                return
            }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("faculty-stability")}}',
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
            $('#edit_total_faculty').val(data.total_faculty);
            $('#edit_year').select2().val(data.year).trigger('change');
            $('#edit_resigned').val(data.resigned);
            $('#edit_retired').val(data.retired);
            $('#edit_terminated').val(data.terminated);
            $('#edit_new_induction').val(data.new_induction);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
            $('input[value='+data.isCompleted+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let total_faculty = $('#edit_total_faculty').val();
            let year = $('#edit_year').val();
            let resigned = $('#edit_resigned').val();
            let retired = $('#edit_retired').val();
            let terminated = $('#edit_terminated').val();
            let new_induction = $('#edit_new_induction').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            let isCompleted = $('input[name=edit_isCompleted]:checked').val();
            !total_faculty?addClass('edit_total_faculty'):removeClass('edit_total_faculty');
            !year?addClass('edit_year'):removeClass('edit_year');
            !resigned?addClass('edit_resigned'):removeClass('edit_resigned');
            !retired?addClass('edit_retired'):removeClass('edit_retired');
            !terminated?addClass('edit_terminated'):removeClass('edit_terminated');
            !new_induction?addClass('edit_new_induction'):removeClass('edit_new_induction');

            if(!total_faculty || !year || !resigned || !retired || !terminated || !new_induction )
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("faculty-stability")}}/'+id,
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
                        url:'{{url("faculty-stability")}}/'+id,
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
                    window.location = '/faculty-gender';
                }
            }, 1000)
        });


    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
