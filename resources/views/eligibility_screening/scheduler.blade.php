@section('pageTitle', 'ES-Scheduler')

@if(Auth::user())


    @include("includes.head")
    <!-- Morris chart -->
{{--    <link rel="stylesheet" href="bower_components/morris.js/morris.css">--}}
    <!-- jvectormap -->
{{--    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">--}}
    <link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />
    <!-- fullCalendar -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.0/main.min.css">
{{--    <link rel="stylesheet" href="{{url('bower_components/fullcalendar/dist/fullcalendar.print.min.css')}}" media="print">--}}
    <link rel="stylesheet" href="{{url('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{url('bower_components/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">

    @include("includes.header")
    @include("includes.nav")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Calendar
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Calendar</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
{{--                <div class="col-md-2">--}}
{{--                    <div class="box box-solid">--}}
{{--                        <div class="box-header with-border">--}}
{{--                            <h4 class="box-title">Draggable Events</h4>--}}
{{--                        </div>--}}
{{--                        <div class="box-body">--}}
{{--                            <!-- the events -->--}}
{{--                            <div id="external-events">--}}

{{--                                @foreach(@$registrations as $reg)--}}
{{--                                <div class="external-event bg-green">{{@$reg->school}}--{{@$reg->department}}</div>--}}
{{--                                @endforeach--}}
{{--                                    --}}{{--                                <div class="external-event bg-yellow">Go home</div>--}}
{{--                                <div class="external-event bg-aqua">Do homework</div>--}}
{{--                                <div class="external-event bg-light-blue">Work on UI design</div>--}}
{{--                                <div class="external-event bg-red">Sleep tight</div>--}}

{{--                                <div class="checkbox">--}}
{{--                                    <label for="drop-remove">--}}
{{--                                        <input type="checkbox" id="drop-remove">--}}
{{--                                        remove after drop--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- /.box-body -->--}}
{{--                    </div><div class="box box-solid">--}}
{{--                        <div class="box-header with-border">--}}
{{--                            <h4 class="box-title">Draggable Peer Reviewers</h4>--}}
{{--                        </div>--}}
{{--                        <div class="box-body">--}}
{{--                            <!-- the events -->--}}
{{--                            <div id="external-events">--}}

{{--                                @foreach(@$reviewers as $reviewer)--}}
{{--                                <div class="external-event bg-primary">{{@$reviewer->name}}</div>--}}
{{--                                @endforeach--}}
{{--                                    --}}{{--                                <div class="external-event bg-yellow">Go home</div>--}}
{{--                                <div class="external-event bg-aqua">Do homework</div>--}}
{{--                                <div class="external-event bg-light-blue">Work on UI design</div>--}}
{{--                                <div class="external-event bg-red">Sleep tight</div>--}}

{{--                                <div class="checkbox">--}}
{{--                                    <label for="drop-remove">--}}
{{--                                        <input type="checkbox" id="drop-remove">--}}
{{--                                        remove after drop--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- /.box-body -->--}}
{{--                    </div>--}}
{{--                </div>--}}
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body no-padding">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="add-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Schedule Meeting. </h4>
                </div>
                <form role="form" id="updateForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Registrations:</label>
                            <div class="input-group">
                                <select name="registrations" id="registrations" class="form-control select2">
                                    @foreach(@$registrations as $reg)
                                        <option value="{{@$reg->id}}">{{@$reg->school}}-{{@$reg->department}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Reviewers:</label>
                            <select class="form-control select2" name="reviewers" id="reviewers" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                @foreach(@$reviewers as $reviewer)
                                    <option value="{{@$reviewer->id}}">{{@$reviewer->name}}</option>
                                @endforeach
                            </select>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <label>Date and time range:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="esScheduleDateTime">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="type">{{ __('Event Color') }} : </label>
                                <input type="text" name="color" id="color" class="form-control my-colorpicker1">
                            </div>
                        </div>

{{--                        <div class="col-md-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="type">{{ __('Status') }} : </label>--}}
{{--                                <p><input type="radio" name="status" class="flat-red" value="active" > Active--}}
{{--                                    <input type="radio" name="status" class="flat-red" value="inactive">InActive</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" name="schedule" id="notifyAll" class="btn btn-info">Notify All</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-user bg-yellow"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                <p>New phone +1(800)555-1234</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-warning pull-right">50%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Other sets of options are available
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <h3 class="control-sidebar-heading">Chat Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right">
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

    <script src="{{URL::asset('notiflix/notiflix-2.3.2.min.js')}}"></script>

    @include("includes.footer")

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.0/main.min.js"></script>
    <!-- date-range-picker -->
    <script src="{{url('bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{url('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- Select2 -->
    <script src="{{url('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{url('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>

@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
@hasrole('ESScheduler|PeerReviewer')
<!-- Page specific script -->
<script>
    //Date range picker with time picker
    //$('#esScheduleDateTime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})

    var myCalendar;
    $(function () {
        $('.select2').select2();
        // calendar
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        var date = new Date()
        var d    = date.getDate(),
            m    = date.getMonth(),
            y    = date.getFullYear()
        var calendarEl = document.getElementById('calendar');

         myCalendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                center: 'addEventButton'
            },
            selectable  : true,
            select : function(info) {
                $('#add-modal').modal('show');
                console.log('select area end', info.startStr+" 12:00");
                console.log('select area end', info.endStr+" 12:00");
                $('#esScheduleDateTime').daterangepicker({
                    timePicker: true, timePickerIncrement: 30, locale: {format: 'YYYY/MM/DD hh:mm A'},
                    "startDate": info.startStr,
                    "endDate": info.endStr
                })
            },
             eventTimeFormat: { // like '14:30:00'
                hour: '2-digit',
                minute: '2-digit',
                meridiem: true
        }
            // customButtons: {
            //     addEventButton: {
            //         text: 'add event...',
            //         click: function() {
            //             var dateStr = prompt('Enter a date in YYYY-MM-DD format');
            //             var date = new Date(dateStr + 'T00:00:00'); // will be in local time
            //
            //             if (!isNaN(date.valueOf())) { // valid?
            //                 calendar.addEvent({
            //                     title: 'dynamic event',
            //                     start: date,
            //                     allDay: true
            //                 });
            //                 alert('Great. Now, update your database...');
            //             } else {
            //                 alert('Invalid date.');
            //             }
            //         }
            //     }
            // }
        });
        myCalendar.render();
        //Colorpicker
        $('.my-colorpicker1').colorpicker();
        let eventsList = [];
        let list = [];
        //color picker with addon
        /* initialize the external events
         -----------------------------------------------------------------*/
        function init_events(ele) {
            ele.each(function () {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                }

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject)

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex        : 1070,
                    revert        : true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                })

            })
        }

        init_events($('#external-events div.external-event'))

        /* initialize the calendar
         -----------------------------------------------------------------*/

        $.ajax({
            url:"{{url('getAllEvents')}}",
            type:"get",
            data: {events:'events'},
            beforeSend: function(){
                Notiflix.Loading.Pulse('Processing...');
            },
            // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
            success: function (response) {
                 Notiflix.Loading.Remove();
                let data = JSON.parse(JSON.stringify(response));
                console.log('response data...', data);


                $.each(data, function (index, val) {
                    console.log('index...', index);
                    eventsList[index] ={}
                    eventsList[index]['id'] = val.id
                    eventsList[index]['title'] = val.title
                    eventsList[index]['start'] = new Date(val.start)
                    eventsList[index]['end'] = new Date(val.end)
                    eventsList[index]['backgroundColor'] = val.backgroundColor
                    eventsList[index]['borderColor'] = val.borderColor
                    const ev = myCalendar.addEvent(eventsList[index]);
                    //ev.setDates(new Date(val.start), new Date(val.end), false);
                    console.log('EV::::', ev);
                    //return;
                });
                console.log(' events values', eventsList);
            },
            error:function(response, exception){
                Notiflix.Loading.Remove();
                $.each(response.responseJSON, function (index, val) {
                    Notiflix.Notify.Failure(val);
                })

            }
        });

        /* ADDING EVENTS */
        var currColor = '#3c8dbc' //Red by default
        //Color chooser button
        var colorChooser = $('#color-chooser-btn')
        $('#color-chooser > li > a').click(function (e) {
            e.preventDefault()
            //Save color
            currColor = $(this).css('color')
            //Add color effect to button
            $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
        })
        $('#add-new-event').click(function (e) {
            e.preventDefault()
            //Get value and make sure it is not null
            var val = $('#new-event').val()
            if (val.length == 0) {
                return
            }

            //Create events
            var event = $('<div />')
            event.css({
                'background-color': currColor,
                'border-color'    : currColor,
                'color'           : '#fff'
            }).addClass('external-event')
            event.html(val)
            $('#external-events').prepend(event)

            //Add draggable funtionality
            init_events(event)

            //Remove event from text input
            $('#new-event').val('')
        })
    });

    $('#notifyAll').on('click', function () {
        let registrations = $('#registrations').val();
        let title = $('#registrations option:selected').text();
        let reviewers = $('#reviewers').val();
        let esScheduleDateTime = $('#esScheduleDateTime').val();
        let color = $('#color').val();

        !registrations?addClass('registrations'):removeClass('registrations');
        !reviewers?addClass('reviewers'):removeClass('reviewers');
        !esScheduleDateTime?addClass('esScheduleDateTime'):removeClass('esScheduleDateTime');
        !color?addClass('color'):removeClass('color');
        if(!registrations || !reviewers || !esScheduleDateTime)
        {
            Notiflix.notify.error('Fill all the required Fields');
            return false;
        }
        $.ajax({
            url:"{{url('esNotifyAll')}}",
            type:"POST",
            data: {registrations:registrations, reviewers:reviewers, esScheduleDateTime:esScheduleDateTime, color:color, title:title},
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
                let dateTime = esScheduleDateTime.split('-');
                console.log('start date ...', dateTime[0] );
                let DateSplit = dateTime[0].split(' ');
                let DateSplitEnd = dateTime[1].split(' ');
                let timeSplitStart = DateSplit[1];
                let timeSplitEnd = DateSplitEnd[1];
                //return;
                let start = new Date(DateSplit[0]);
                let end = new Date(DateSplitEnd[1]);
                console.log('start date is ....', start);
                console.log('end date is ....', end);
                myCalendar.addEvent({
                    title: title,
                    start: start,
                    end: end,
                    allDay: false,
                    backgroundColor: color,
                    borderColor: color,
                });
                myCalendar.render();
                //location.reload();
                console.log('response here', response);
            },
            error:function(response, exception){
                Notiflix.Loading.Remove();
                $.each(response.responseJSON, function (index, val) {
                    Notiflix.Notify.Failure(val);
                })

            }
        })
    })
</script>
@endhasrole
