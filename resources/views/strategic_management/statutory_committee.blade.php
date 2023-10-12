@section('pageTitle', 'Statutory Committee')


@if(Auth::user())

    @include("../includes.head")
    <link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/iCheck/all.css')}}">
    <style>
        .fontsize{
            font-size: 12px !important;
        }
    </style>
    @include("../includes.header")
    @include("../includes.nav")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Statutory Committee
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                <li class="active"> Statutory Committee</li>
            </ol>
        </section>
        <!-- <section class="content-header">
            <div class="col-md-12 new-button">
                <div class="pull-right">
                    <button class="btn gradient-bg-color"
                           data-toggle="modal" data-target="#add-modal"
                           style="color: white;">PDF <i class="fa fa-file-pdf-o"></i></button>
                </div>
            </div>
        </section> -->

        {{--Dean section --}}
        <section class="content">
            <div class=" form row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">1.4 Provide information about the various statutory bodies in the Table 1.4. Also attach documentary information about the composition, name of members, role and functions of each statutory body as Appendix-1B. </h3>
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
                        <div class="box-body" style="padding: 0px;">
                             <form action="javascript:void(0)" method="post" id="add" enctype="multipart/form-data">
                                 <table class="table table-bordered table-striped" style="font-size: 5px;" >
                                     <thead>
                                     <th width="10" class="fontsize">Body Name</th>
                                     <th class="fontsize">Name and designation of Chairperson</th>
                                      <th class="fontsize">Meeting 1</th>
                                      <th class="fontsize">Meeting 2</th>
                                      <th class="fontsize">Meeting 3</th>
                                      <th class="fontsize">Meeting 4</th>

                                     <th class="fontsize">File</th>
                                     </thead>
                                     <tbody>

                                         @foreach($bodies as $body)
                                     <tr>
                                            <td class="fontsize">
                                                {{@$body->name}}
                                                <input type="hidden" name="statutory_body_id[]" id="statutory_body_id_{{@$body->id}}" value="{{@$body->id}}">
                                            </td>

                                         <td class="fontsize">
                                             <input type="text" name="name[]" placeholder="name" id="name_{{@$body->id}}" class="form-control" style="margin-bottom: 5px !important;">
                                             <select name="designation_id[]" id="designation_id_{{@$body->id}}" class="form-control select2 designations" style="width: 100%;">
                                                <option value="">Select Designation</option>
                                                @foreach($designations as $designation)
                                                <option value="{{$designation->id}}">{{$designation->name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" name="other_designation[]" id="other_designation_id_{{@$body->id}}" placeholder="Enter Designation Name" class="form-control hide" style = " margin-top: 5px;">
                                         </td>
                                         <td>
                                            <div class="input-group">
                                            <div class="input-group-addon">

                  </div>
                                            <input type="date" id="date_first_meeting_{{@$body->id}}" name="date_first_meeting[]" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                            </div>
                                        </td>
                                         <td>
                                            <div class="input-group">
                                            <div class="input-group-addon">

                  </div>
                                            <input type="date" id="date_second_meeting_{{@$body->id}}" name="date_second_meeting[]" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                            </div>
                                        </td>
                                         <td>
                                            <div class="input-group">
                                            <div class="input-group-addon">

                  </div>
                                            <input type="date" id="date_third_meeting_{{@$body->id}}" name="date_third_meeting[]" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                            </div>
                                        </td>
                                         <td>
                                            <div class="input-group">
                                            <div class="input-group-addon">

                  </div>
                                            <input type="date" id="date_fourth_meeting_{{@$body->id}}" name="date_fourth_meeting[]" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                            </div>
                                        </td>
                                         <td style="font-size: 8px"><input type="file" name="file{{$loop->iteration}}"></td>
                                     </tr>
                                         @endforeach
                                         <tr id="add-more-row">
                                             <td>
                                                 <button title="Add More Rows" class="btn btn-success btn-add-more-rows"><i class="fa fa-plus"></i></button>
                                             </td>
                                         </tr>
                                     </tbody>
                                 </table>
                            <div class="col-md-12">
                                <div class="form-group pull-right" style="margin-top: 20px;">
                                    <label for="name"></label>
                                    <input type="submit" name="add" value="Submit" class="btn btn-info">
                                </div>

                                <div class="form-group pull-right" style="margin-top: 20px;">
                                    <label for="name"></label>
                                    <input type="submit" name="add" value="Submit & Next" class="btn btn-success next">
                                </div>
                            </div>
                        <!-- /.box-body -->
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- Main content -->
            </div>

            <div class="form row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Table 1.4 Business school’s statutory committees</h3>
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

                    {{--  Content here --}}
                    <!-- /.box -->

                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="statutoryTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Body Name</th>
                                    <th>Name</th>
                                    <th>Designation </th>
                                    <th>First Meeting</th>
                                    <th>Second Meeting</th>
                                    <th>Third Meeting</th>
                                    <th>Fourth Meeting</th>
                                    <th>File</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($statutory_committees as $committee)
                                <tr>
                                    <td>{{$committee->statutory_body->name}}</td>
                                    <td>{{$committee->name}} </td>
                                    <td>{{@$committee->designation->name}}</td>
                                    <td>{{$committee->date_first_meeting}}</td>
                                    <td>{{$committee->date_second_meeting}}</td>
                                    <td>{{$committee->date_third_meeting}}</td>
                                    <td>{{$committee->date_fourth_meeting}}</td>

                                    <td>@if(!empty($committee->file) && $committee->file !=='/')<a href="{{url($committee->file)}}"><i class="fa fa-file-word-o"></i></a> @endif</td>
                                    <td><div class="badge {{$committee->status=='active'?'bg-green':'bg-red'}}">{{$committee->status=='active'?'Active':'Inactive'}}</div></td>
                                    <td><i class="fa fa-trash text-info delete" data-id="{{$committee->id}}"></i> |
                                        <i class="fa fa-pencil text-blue edit" data-toggle="modal" data-target="#edit-modal"
                                           data-row='{"id":{{$committee->id}},
                                         "statutory_body_id":{{$committee->statutory_body->id}},
                                         "name":"{{$committee->name}}", 
                                         "designation_name":"{{@$committee->designation->name}}",
                                         "designation_default":{{@$committee->designation->is_default}},
                                         "designation_id":{{@$committee->designation->id}},
                                         "date_first_meeting":"{{$committee->date_first_meeting}}",
                                         "date_second_meeting":"{{$committee->date_second_meeting}}",
                                         "date_third_meeting":"{{$committee->date_third_meeting}}",
                                         "date_fourth_meeting":"{{$committee->date_fourth_meeting}}",
                                         "file":"{{$committee->file}}",
                                         "status":"{{$committee->status}}"
                                         }'></i> </td>
                                </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Body Name</th>
                                    <th>Name</th>
                                    <th>Designation </th>
                                    <th>First Meeting</th>
                                    <th>Second Meeting</th>
                                    <th>Third Meeting</th>
                                    <th>Fourth Meeting</th>
                                    <th>File</th>
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
                    <h4 class="modal-title">Edit Business School Statutory Committee</h4>
                </div>
                <form method="post" id="update" enctype="multipart/form-data">

                <div class="modal-body">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Body Name</label>
                                                <select name="statutory_body_id" id="edit_statutory_body_id" class="form-control select2" style="width: 100%;">
                                                    <option value="">Select Body Name</option>
                                                    @foreach($bodies as $body)
                                                        <option value="{{$body->id}}">{{$body->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" id="edit_name" class="form-control">
                                                <input type="hidden" name="edit_id" id="edit_id">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Designation</label>
                                                <select name="designation_id" id="edit_designation_id" class="form-control select2" style="width: 100%;">
                                                    <option value="">Select Designation</option>
                                                    @foreach($designations as $designation)
                                                        <option value="{{$designation->id}}">{{$designation->name }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="text" name="other_designation" id="edit_designation" placeholder="Designation" class="form-control hide">
                                                
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Date of First Meeting</label>
                                                <input type="date" name="date_first_meeting" id="edit_date_first_meeting" value="" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Date of Second Meeting</label>
                                                <input type="date" name="date_second_meeting" id="edit_date_second_meeting" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Date of Third Meeting</label>
                                                <input type="date" name="date_third_meeting" id="edit_date_third_meeting" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Date of Fourth Meeting</label>
                                                <input type="date" name="date_fourth_meeting" id="edit_date_fourth_meeting" value="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Attach File (Appendix-1B)</label>
                                                <input type="file" name="file" value="" id="edit_file" >
                                                <span class="text-blue" id="file_name"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="type">{{ __('Status') }} : </label>
                                                <p><input type="radio" name="status" class="flat-red" value="active" > <span>Active</span></p>
                                                <p><input type="radio" name="status" class="flat-red" value="inactive" ><span>InActive</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- Main content -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="update" class="btn btn-info" value="Update">
                </div>
    </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="designation_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add New Designation</h4>
                </div>
                    <form method="post">
                <div class="modal-body">
                    <input type="hidden" id="designation_index">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name"> Name</label>
                                <input type="name" id="name" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="button" class="btn btn-info" value="Add" id="add_designation">
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
    <script src="{{URL::asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{URL::asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script>
        $(function () {
            $('#statutoryTable').DataTable({
                dom : "lBfrtip",
            })
        })
    </script>
    <script type="text/javascript">
        var designations = '<?php echo $designations; ?>'
        designations = JSON.parse(designations);
        var row_count = '<?php echo $bodies->count(); ?>'
        $(document).on('change', ".designations", function (e) {
            if(this.options[this.selectedIndex].text == 'Other'){
                $("#other_" + this.id).removeClass('hide');
            }else{
                $("#other_" + this.id).addClass('hide');
            }
        })
        window.onload = function () {
            for(let i = 1; i <= row_count; i++){
                if($('#designation_id_' + i + ' option:selected').text() == 'Other')
                    $("#other_designation_id_" + i).removeClass('hide');
            }
        }

        $("#edit_designation_id").on('change', function(e){
            if(this.options[this.selectedIndex].text == 'Other'){
                $("#edit_designation").removeClass('hide');
            }else{
                $("#edit_designation").addClass('hide');
            }
        })
        //Initialize Select2 Elements
        $('.select2').select2();
    //     $('#date_first_meeting').datepicker({
    //   autoclose:true
    // });
    //     $('#date_second_meeting').datepicker({
    //   autoclose:true
    // });
    //     $('#date_third_meeting').datepicker({
    //   autoclose:true
    // });
    //     $('#date_fourth_meeting').datepicker({
    //   autoclose:true
    // });
    var next_id = '<?php echo $bodies->last()->id; ?>'
    $(".btn-add-more-rows").on('click', function (e) {
        e.preventDefault();
        next_id++;
        row_count++;
        var designation_raw_options = '';
        for (var i = 0; i < designations.length; i++){
            designation_raw_options += `<option value="` + designations[i].id + `">` + designations[i].name + `</option>`
        }
        
        var data = `
        <tr>
            <td class="fontsize">
                Any Other
                <input type="hidden" name="statutory_body_id[]" id="statutory_body_id_`+next_id+`" value="7">
            </td>

            <td class="fontsize">
                <input type="text" name="name[]" placeholder="name" id="name_` + next_id + `" class="form-control" style="margin-bottom: 5px !important;">
                <select name="designation_id[]" id="designation_id_` + next_id + `" class="form-control select2 designations" style="width: 100%;">
                                                <option value="">Select Designation</option>` + designation_raw_options + `
                                            </select>
                <input type="text" name="other_designation[]" id="other_designation_id_` + next_id + `" placeholder="Designation" class="form-control hide">
            </td>
            <td>
                <div class="input-group">
                    <div class="input-group-addon">

                    </div>
                    <input type="date" id="date_first_meeting_` + next_id + `" name="date_first_meeting[]" value="<?php echo date('m/d/Y'); ?>" class="form-control">
                </div>
            </td>
            <td>
                <div class="input-group">
                    <div class="input-group-addon">

                    </div>
                    <input type="date" id="date_second_meeting_` + next_id + `" name="date_second_meeting[]" value="<?php echo date('m/d/Y'); ?>" class="form-control">
                </div>
            </td>
            <td>
                <div class="input-group">
                    <div class="input-group-addon">

                    </div>
                    <input type="date" id="date_third_meeting_` + next_id + `" name="date_third_meeting[]" value="<?php echo date('m/d/Y'); ?>" class="form-control">
                </div>
            </td>
            <td>
                <div class="input-group">
                    <div class="input-group-addon">

                    </div>
                    <input type="date" id="date_fourth_meeting_` + next_id + `" name="date_fourth_meeting[]" value="<?php echo date('m/d/Y'); ?>" class="form-control">
                </div>
            </td>
            <td style="font-size: 8px"><input type="file" name="file`+row_count+`"></td>
        </tr>
        `
        $(data).insertBefore("#add-more-row");
    })
    // $('.designations').on('change', function () {

    //     if($(this).val() == 8){
    //         $('#designation_modal').modal('show');
    //         console.log('designation', $(this).attr('id'))
    //         $('#designation_index').val($(this).attr('id'))

    //     }
    // })

        //Flat red color scheme for iCheck
        $('input[type="radio"].flat-red').iCheck({
            radioClass   : 'iradio_flat-green'
        });

        //// add Statutory record

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#add_designation').on('click', function (e) {

            console.log($(this).attr('id'))
            let designation_index = $('#designation_index').val();
            console.log('yes attr here....',designation_index)

            let name = $('#name').val();
            !name?addClass('name'):removeClass('name');
            if(!name){
                Notiflix.Notify.Failure("Designation name field is required.");
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{{url('add-designation')}}",
                data: {name:name},
                // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
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

                    let insert_id = response.insert_id;
                    if(insert_id){

                        let options = $('<option selected></option>').val(insert_id).text(name);
                        $('#'+designation_index).append(options).trigger('change');
                    }
                    $('#designation_modal').modal('hide');
                    console.log('response here', response);
                },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })

                }
            });

        });
        let check = false;
        /*Add Scope*/
        $('#add').submit(function (e) {
            let hasEmptyField = false;
            let isEmptyForm = true;
            let meetingsInOrder = true;
            let fields = ['designation_id', 'date_first_meeting', 'date_second_meeting', 'date_third_meeting', 'date_fourth_meeting'];
            $('.designations').map(function(index, element){
                let statutory_body_id = element.id.split('_').pop();
                let name = $('#name_'+statutory_body_id).val();
                if (name){
                    isEmptyForm = false;
                    let meetingDates = [];
                    fields.forEach(function(value, index){
                        let field_id = value + '_' + statutory_body_id;
                        if ($('#' + field_id).val()){
                            if(field_id.includes("meeting")){
                                meetingDates.push(Date.parse($('#' + field_id).val()));
                            }
                            removeClass(field_id);
                        }else{
                            addClass(field_id);
                            hasEmptyField = true;
                        }
                    })
                    meetingsInOrder = meetingsInOrder && meetingDates.every(function(value, index){
                        return index === 0 || value < meetingDates[index - 1];
                    })
                }else{
                    fields.forEach(function(value, index){
                        let field_id = value + '-' + statutory_body_id;
                        removeClass(field_id);
                    })
                }

            })
            if(hasEmptyField)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            if(!meetingsInOrder){
                Notiflix.Notify.Warning("All meeting dates should be in descending order");
                return;
            }
            if(isEmptyForm){
                Notiflix.Notify.Warning("Please fill data of at least 1 statutory body");
                return
            }

            // let statutory_body_id = $('#statutory_body_id').val();
            // let name = $('#name').val();
            // let designation_id = $('#designation_id').val();
            // let date_first_meeting = $('#date_first_meeting').val();
            // let date_second_meeting = $('#date_second_meeting').val();
            // let date_third_meeting = $('#date_third_meeting').val();
            // let date_fourth_meeting = $('#date_fourth_meeting').val();
            // let file = $('#file').val();
            //
            // !name?addClass('name'):removeClass('name');
            // !statutory_body_id?addClass('statutory_body_id'):removeClass('statutory_body_id');
            // !designation_id?addClass('designation_id'):removeClass('designation_id');
            // !date_first_meeting?addClass('date_first_meeting'):removeClass('date_first_meeting');
            // !date_second_meeting?addClass('date_second_meeting'):removeClass('date_second_meeting');
            // !date_third_meeting?addClass('date_third_meeting'):removeClass('date_third_meeting');
            // !date_fourth_meeting?addClass('date_fourth_meeting'):removeClass('date_fourth_meeting');
            // !file?addClass('file'):removeClass('file');
            //
            // if(!name || !statutory_body_id || !designation_id|| !date_first_meeting || !date_second_meeting || !date_third_meeting || !date_fourth_meeting || !file)
            // {
            //     Notiflix.Notify.Warning("Fill all the required Fields.");
            //     return;
            // }
            // Yes button callback
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url:'{{url("strategic/statutory-committees")}}',
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
                    if(response.error)
                        Notiflix.Notify.Failure(response.error);
                    {

                    }
                    console.log('response', response);
                    check = true;
                    setTimeout(() => {location.reload();}, 2000);
                    },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })
                }
            })
        });
        ///// edit record
        $('.edit').on('click', function () {
            let data = JSON.parse(JSON.stringify($(this).data('row')));
           // console.log(data);
            // Initialize Select2
            $('#edit_statutory_body_id').select2().val(data.statutory_body_id).trigger('change');
            if(data.designation_default){
                $('#edit_designation_id').val(data.designation_id).trigger('change');
                $('#edit_designation').addClass('hide');
            }else{
                $("#edit_designation_id option:contains('Other')").prop("selected", true).trigger('change');
                $('#edit_designation').val(data.designation_name);
                $('#edit_designation').removeClass('hide');
            }
            
            $('#edit_name').val(data.name);
            $('#edit_date_first_meeting').val(data.date_first_meeting);
            $('#edit_date_second_meeting').val(data.date_second_meeting);
            $('#edit_date_third_meeting').val(data.date_third_meeting);
            $('#edit_date_fourth_meeting').val(data.date_fourth_meeting);
            $('#edit_id').val(data.id);
            $('#file_name').text(data.file);
            $('input[value='+data.status+']').iCheck('check');
        });

        $('#update').submit(function (e) {
            let name = $('#edit_name').val();
            let statutory_body_id = $('#edit_statutory_body_id').val();
            let designation_id = $('#edit_designation_id').val();
            let date_first_meeting = $('#edit_date_first_meeting').val();
            let date_second_meeting = $('#edit_date_second_meeting').val();
            let date_third_meeting = $('#edit_date_third_meeting').val();
            let date_fourth_meeting = $('#edit_date_fourth_meeting').val();
            let id = $('#edit_id').val();
            let status = $('input[name=status]:checked').val();

            !name?addClass('edit_name'):removeClass('edit_name');
            !statutory_body_id?addClass('edit_statutory_body_id'):removeClass('edit_statutory_body_id');
            !date_first_meeting?addClass('edit_date_first_meeting'):removeClass('edit_date_first_meeting');
            !date_second_meeting?addClass('edit_date_second_meeting'):removeClass('edit_date_second_meeting');
            !date_third_meeting?addClass('edit_date_third_meeting'):removeClass('edit_date_third_meeting');
            !date_fourth_meeting?addClass('edit_date_fourth_meeting'):removeClass('edit_date_fourth_meeting');
            !designation_id?addClass('edit_designation'):removeClass('edit_designation');

            if(!name || !statutory_body_id || !designation_id || !date_first_meeting || !date_second_meeting || !date_third_meeting|| !date_fourth_meeting)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return false;
            }
            let meetingDates = [
                Date.parse(date_first_meeting),
                Date.parse(date_second_meeting),
                Date.parse(date_third_meeting),
                Date.parse(date_fourth_meeting),
            ];
            let meetingsInOrder = meetingDates.every(function(value, index){
                        return index === 0|| value < meetingDates[index - 1];
            })
            if(!meetingsInOrder){
                Notiflix.Notify.Warning("All meeting dates should be in descending order");
                return false;
            }
            e.preventDefault();
            var formData = new FormData(this);
            //var formData = $("#updateForm").serialize()
            formData.append('_method', 'PUT');
            $.ajax({
                url:'{{url("strategic/statutory-committees")}}/'+id,
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
                    if(response.error){
                        Notiflix.Notify.Failure(response.error);
                    }
                    //console.log('response', response);
                    setTimeout(() => {location.reload();}, 2000);
                },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })
                }
            })
        })

        /// Delete Row
        $('.delete').on('click', function (e) {
            let id =  $(this).data('id');
            Notiflix.Confirm.Show( 'Confirm', 'Are you sure you want to delete?', 'Yes', 'No',
                function(){
                    // Yes button callback
                    $.ajax({
                        url:'{{url("strategic/statutory-committees")}}/'+id,
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
                    window.location = '/strategic/affiliations';
                }
            }, 1000)
        });

    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
