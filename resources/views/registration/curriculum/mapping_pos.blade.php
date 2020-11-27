@section('pageTitle', 'Learning Outcomes')


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
                Mapping POs/PLOs
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Mapping POs/PLOs</li>
            </ol>
        </section>
{{--        <section class="content-header">--}}
{{--            <div class="col-md-12 new-button">--}}
{{--                <div class="pull-right">--}}
{{--                    <button class="btn gradient-bg-color"--}}
{{--                           data-toggle="modal" data-target="#add-modal"--}}
{{--                           style="color: white;"--}}
{{--                           value="Add New"--}}
{{--                            name="add" id="add">PDF <i class="fa fa-file-pdf-o"></i></button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

        {{--Dean section --}}
        {{--Dean section --}}
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">2.6 Provide the alignment of POs and PLOs for each program under review in Table 2.6.</h3>
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
                                @foreach(@$programs as $program)
                                <div class="row">
                                    <div class="container">
                                    <h2>{{@$program->program->name}}</h2>
                                    </div>

                                    <table class="table table-bordered table-responsive">
                                        <tr>
                                            <th></th>
                                            <th>PLO1</th>
                                            <th>PLO2</th>
                                            <th>PLO3</th>
                                            <th>PLO4</th>
                                            <th>PLO5</th>
                                        </tr>

                                        <tr>
                                            <th>PO1</th>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][0][0]" {{(@$mappings[0]->program_id == $program->program->id && @$mappings[0]->learning_outcome_id == 0 && @$mappings[0]->program_objective_id == 0 && @$mappings[0]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][0][1]" {{(@$mappings[1]->program_id == $program->program->id && @$mappings[1]->learning_outcome_id == 0 && @$mappings[1]->program_objective_id == 0 && @$mappings[1]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][0][2]" {{(@$mappings[2]->program_id == $program->program->id && @$mappings[2]->learning_outcome_id == 0 && @$mappings[2]->program_objective_id == 0 && @$mappings[2]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][0][3]" {{(@$mappings[3]->program_id == $program->program->id && @$mappings[3]->learning_outcome_id == 0 && @$mappings[3]->program_objective_id == 0 && @$mappings[3]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][0][4]" {{(@$mappings[4]->program_id == $program->program->id && @$mappings[4]->learning_outcome_id == 0 && @$mappings[4]->program_objective_id == 0 && @$mappings[4]->isChecked == 'on')?'checked':''}}></td>
                                        </tr>

                                        <tr>
                                            <th>PO2</th>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][1][0]" {{(@$mappings[5]->program_id == $program->program->id && @$mappings[5]->learning_outcome_id == 0 && @$mappings[5]->program_objective_id == 0 && @$mappings[5]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][1][1]" {{(@$mappings[6]->program_id == $program->program->id && @$mappings[6]->learning_outcome_id == 0 && @$mappings[6]->program_objective_id == 0 && @$mappings[6]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][1][2]" {{(@$mappings[7]->program_id == $program->program->id && @$mappings[7]->learning_outcome_id == 0 && @$mappings[7]->program_objective_id == 0 && @$mappings[7]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][1][3]" {{(@$mappings[8]->program_id == $program->program->id && @$mappings[8]->learning_outcome_id == 0 && @$mappings[8]->program_objective_id == 0 && @$mappings[8]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][1][4]" {{(@$mappings[9]->program_id == $program->program->id && @$mappings[9]->learning_outcome_id == 0 && @$mappings[9]->program_objective_id == 0 && @$mappings[9]->isChecked == 'on')?'checked':''}}></td>
                                        </tr>
                                        <tr>
                                            <th>PO3</th>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][2][0]" {{(@$mappings[10]->program_id == $program->program->id && @$mappings[10]->learning_outcome_id == 0 && @$mappings[10]->program_objective_id == 0 && @$mappings[10]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][2][1]" {{(@$mappings1[11]->program_id == $program->program->id && @$mappings[11]->learning_outcome_id == 0 && @$mappings[11]->program_objective_id == 0 && @$mappings[11]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][2][2]" {{(@$mappings[12]->program_id == $program->program->id && @$mappings[12]->learning_outcome_id == 0 && @$mappings[12]->program_objective_id == 0 && @$mappings[12]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][2][3]" {{(@$mappings[13]->program_id == $program->program->id && @$mappings[13]->learning_outcome_id == 0 && @$mappings[13]->program_objective_id == 0 && @$mappings[13]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][2][4]" {{(@$mappings[14]->program_id == $program->program->id && @$mappings[14]->learning_outcome_id == 0 && @$mappings[14]->program_objective_id == 0 && @$mappings[14]->isChecked == 'on')?'checked':''}}></td>
                                        </tr>
                                        <tr>
                                            <th>PO4</th>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][3][0]" {{(@$mappings[15]->program_id == $program->program->id && @$mappings[15]->learning_outcome_id == 0 && @$mappings[15]->program_objective_id == 0 && @$mappings[15]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][3][1]" {{(@$mappings[16]->program_id == $program->program->id && @$mappings[16]->learning_outcome_id == 0 && @$mappings[16]->program_objective_id == 0 && @$mappings[16]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][3][2]" {{(@$mappings[17]->program_id == $program->program->id && @$mappings[17]->learning_outcome_id == 0 && @$mappings[17]->program_objective_id == 0 && @$mappings[17]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][3][3]" {{(@$mappings[18]->program_id == $program->program->id && @$mappings[18]->learning_outcome_id == 0 && @$mappings[18]->program_objective_id == 0 && @$mappings[18]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][3][4]" {{(@$mappings[19]->program_id == $program->program->id && @$mappings[19]->learning_outcome_id == 0 && @$mappings[19]->program_objective_id == 0 && @$mappings[19]->isChecked == 'on')?'checked':''}}></td>
                                        </tr>
                                        <tr>
                                            <th>PO5
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][4][0]" {{(@$mappings[0]->program_id == $program->program->id && @$mappings[0]->learning_outcome_id == 0 && @$mappings[0]->program_objective_id == 0 && @$mappings[0]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][4][1]" {{(@$mappings[1]->program_id == $program->program->id && @$mappings[1]->learning_outcome_id == 0 && @$mappings[1]->program_objective_id == 0 && @$mappings[1]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][4][2]" {{(@$mappings[2]->program_id == $program->program->id && @$mappings[2]->learning_outcome_id == 0 && @$mappings[2]->program_objective_id == 0 && @$mappings[2]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][4][3]" {{(@$mappings[3]->program_id == $program->program->id && @$mappings[3]->learning_outcome_id == 0 && @$mappings[3]->program_objective_id == 0 && @$mappings[3]->isChecked == 'on')?'checked':''}}></td>
                                            <td><input type="checkbox" name="plo_po[{{$program->program->id}}][4][4]" {{(@$mappings[4]->program_id == $program->program->id && @$mappings[4]->learning_outcome_id == 0 && @$mappings[4]->program_objective_id == 0 && @$mappings[4]->isChecked == 'on')?'checked':''}}></td>
                                        </tr>

                                    </table>
                                </div>
                                @endforeach

                             <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 40px;">
                                    <input type="submit" name="add" id="add" value="Submit" class="btn btn-info">
                                </div>
                            </div>
                        </form>

                        </div>
                        <!-- /.box-body -->
                        <!-- /.box -->
                    </div>
                </div>
                <!-- Main content -->
            </div>
        </section>
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
            let plo_po = $('input[name="plo_po"]').val();
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url:'{{url("mapping-pos")}}',
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
                    // location.reload();
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

            $('#edit_program_id').select2().val(data.program_id).trigger('change');
            $('#edit_plo').val(data.plo);
            $('#edit_id').val(data.id);
            $('input[value='+data.status+']').iCheck('check');
        });

$('#updateForm').submit(function (e) {
            let program_id = $('#edit_program_id').val();
            let plo = $('#edit_plo').val();
            let id = $('#edit_id').val();

            let status = $('input[name=edit_status]:checked').val();
            !program_id?addClass('program_id'):removeClass('program_id');
            !plo?addClass('plo'):removeClass('plo');

            if(!program_id || !plo)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            e.preventDefault();
             var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("learning-outcome")}}/'+id,
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
                        url:'{{url("learning-outcome")}}/'+id,
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
