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
    <link rel="stylesheet" href="{{url('bower_components/bootstrap-datepicker/dist/css/bootstrap=datepicker.css')}}">
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
                @hasrole('Mentor|ESScheduler|BusinessSchool')
                @if(@$userDates)
                    @foreach(@$userDates as $index => $reviewerDates)
                    <div class="col-md-3">
                            <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">@if($reviewerDates['user_type'] == 'BusinessSchool') Business School Admin @else Mentor @endif</h3>
                                <h3  class="box-title">Name: {{@$reviewerDates['user_name']}}</h3>
                            </div>
                            <div class="box-body">
                                <!-- the events -->
                                <div id='external-events'>

                                            <span>Available on.</span>
                                            @foreach($reviewerDates['dates'] as $dates)
                                        <div class="external-event  @if($maxSelectedDate==$dates) bg-green @else bg-red @endif fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event">
                                            <p>{{@$dates}}</p>
                                        </div>
                                            @endforeach

    {{--                                <div class="checkbox">--}}
    {{--                                    <label for="drop-remove">--}}
    {{--                                        <input type="checkbox" id="drop-remove">--}}
    {{--                                        remove after drop--}}
    {{--                                    </label>--}}
    {{--                                </div>--}}
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    @endforeach
                @endif
                <div class="col-md-3">
                    <div class="box box-solid">
                    <div class="box-header with-border">
                        <h5>Mentors Most Selected/Availability Date.</h5>
                    </div>
                    <div class="box-body">
                        <!-- the events -->
                        <div id='external-events'>
                            <div class="external-event bg-green fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event">
                                @hasrole('ESScheduler')
                                    <input type="checkbox" value="{{@$maxSelectedDate}}"
                                       @foreach($MentorsDates as $checkDate)
                                           @foreach($checkDate as $availableDate)
                                        @if($availableDate->availability_dates == $maxSelectedDate && $availableDate->is_confirm =='yes' ) checked @endif
                                       @endforeach
                                       @endforeach
                                    id="confirmDate" data-id="{{@request()->route('id')}}"
                                    >
                                @endhasrole Date: {{@$maxSelectedDate}}
                                : @php $confirm = 'Not Confirmed yet'; @endphp @foreach($MentorsDates as $checkDate) @foreach($checkDate as $availableDate) @if($availableDate->availability_dates == $maxSelectedDate && $availableDate->is_confirm =='yes' ) @php $confirm = 'confirmed'; @endphp @break @endif @endforeach @endforeach @php echo $confirm @endphp
                            </div>

{{--                            @foreach(@$availability as $available)--}}
{{--                                @if($available->availability_dates !== $availability[$index - 1]->availability_dates)--}}

{{--                                    <div class="external-event @if($maxSelectedDate == $available->availability_dates)bg-blue @else bg-red @endif fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event">--}}
{{--                                        <input type="checkbox" id="drop-remove"> Date: {{@$available->availability_dates}}--}}
{{--                                </div>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}

                        </div>
                    </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                @endhasrole

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
    @hasrole('ESScheduler')
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
                            <label>Mentors:</label>
                            <select class="form-control select2" name="user_id" id="user_id" multiple="multiple" data-placeholder="Select a registration" style="width: 100%;">
                                @foreach(@$mentors as $mentor)
                                    <option value="{{@$mentor->id}}">{{@$mentor->name}}</option>
                                @endforeach
                            </select>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <label>Select dates on which you are available.</label>
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
                        <button type="button" name="schedule" id="schedule" class="btn btn-info">Schedule Mentoring Meeting</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endhasrole
    <div class="modal fade" id="peerReviewer-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Set Mentors Meeting availability Date. </h4>
                </div>
                <form role="form" id="updateForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Select dates on which you are available.</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="multiDatesPicker">
                                <input type="hidden" class="form-control pull-right" id="mentorsmeeting_id">
                            </div>
                            <!-- /.input group -->
                        </div>
                        </div>
                        @hasrole('BusinessSchool')
                        <div class="col-md-12">
                        <div class="form-group">
                                <label>Select Mentors</label>
                            <div class="input-group col-md-12">
                                <select class="form-control select2" name="mentors" id="mentors" multiple="multiple" data-placeholder="Select a Mentor" style="width: 100%;">
                                    @foreach(@$mentors as $mentor)
                                        <option value="{{@$mentor->id}}" @foreach($MeetingMentors as $select)  {{$select->user_id == $mentor->id ? 'selected':''}} @endforeach >{{@$mentor->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        </div>
                        @endhasrole
                        <!-- /.form group -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" name="schedule" id="add_availability" class="btn btn-info">submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

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
    <script src="{{url('bower_components/bootstrap-datepicker/dist/js/bootstrap=datepicker.js')}}"></script>

@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif
<script>
    $('.my-colorpicker1').colorpicker()
    var myCalendar;
</script>
@hasrole('Mentor')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    document.addEventListener('DOMContentLoaded', function() {
        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;

        var containerEl = document.getElementById('external-events');
        var calendarEl = document.getElementById('calendar');
        var checkbox = document.getElementById('drop-remove');

        // initialize the external events
        // -----------------------------------------------------------------
        new Draggable(containerEl, {
            itemSelector: '.fc-event',
            eventData: function(eventEl) {
                return {
                    title: eventEl.innerText
                };
            }
        });

        // initialize the calendar
        // -----------------------------------------------------------------

        var calendarEl = document.getElementById('calendar');
        myCalendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },selectable  : false,
            select : function(info) {
                $('#add-modal').modal('show');
                // console.log('select area end', info.endStr+" 12:00");
                $('#esScheduleDateTime').daterangepicker({
                    timePicker: true, timePickerIncrement: 30, locale: {format: 'YYYY/MM/DD hh:mm A'},
                    "startDate": info.startStr,
                    "endDate": info.endStr
                })
            },
            eventClick: function(info) {
                $('#peerReviewer-modal').modal('show');
                console.log('Event: complete details' + info.event.id);
                $('#mentorsmeeting_id').val(info.event.id);
                console.log('Event: complete campus_id' + info.event.campus_id);
                console.log('Event: complete title' + info.event.title);
                console.log('Event: complete start' + info.event.start);
                // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                // alert('View: ' + info.view.type);

                // change the border color just for fun
                info.el.style.borderColor = 'red';
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function(info) {
                // is the "remove after drop" checkbox checked?
                if (checkbox.checked) {
                    // if so, remove the element from the "Draggable Events" list
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            }
        });

        $.ajax({
            url:"{{url('getMentoringAllEvents')}}",
            type:"get",
            data: {events:'events'},
            beforeSend: function(){
                Notiflix.Loading.Pulse('Processing...');
            },
            // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
            success: function (response) {
                Notiflix.Loading.Remove();
                let data = JSON.parse(JSON.stringify(response));
                console.log('response data here...', data);
                //return false;
                let eventsList = [];

                $.each(data, function (index, val) {
                    console.log('index value in loop...', val.mentoring_meeting);
                    //return
                    eventsList[index] ={}
                    eventsList[index]['id'] = val.mentoring_meeting.id
                    eventsList[index]['campus_id'] = val.mentoring_meeting.campus_id
                    eventsList[index]['department_id'] = val.mentoring_meeting.department_id
                    eventsList[index]['title'] = val.mentoring_meeting.title
                    eventsList[index]['start'] = new Date(val.mentoring_meeting.start)
                    eventsList[index]['end'] = new Date(val.mentoring_meeting.end)
                    eventsList[index]['backgroundColor'] = val.mentoring_meeting.backgroundColor
                    eventsList[index]['borderColor'] = val.mentoring_meeting.borderColor
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
        myCalendar.render();
    });

    $('#add_availability').on('click', function () {

        let dates = $('#multiDatesPicker').val();
        let mentorsmeeting_id = $('#mentorsmeeting_id').val();
        console.log('working on datepicker.....', dates);
        $.ajax({
            url:"{{url('mentorsAvailability')}}",
            type:"POST",
            data: {dates:dates, mentorsmeeting_id:mentorsmeeting_id},
            beforeSend: function(){
                Notiflix.Loading.Pulse('Processing...');
            },
            // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
            success: function (response) {
                Notiflix.Loading.Remove();
                let data = JSON.parse(JSON.stringify(response));
                console.log('response data here...', data);
                //return false;
                $('#peerReviewer-modal').modal('hide');
                location.reload();

            },
            error:function(response, exception){
                Notiflix.Loading.Remove();
                $.each(response.responseJSON, function (index, val) {
                    Notiflix.Notify.Failure(val);
                })

            }
        });

    })

</script>
@endhasrole

@hasrole('ESScheduler|BusinessSchool')
<!-- Page specific script -->

<script>
    $('#add_availability').on('click', function () {

        let dates = $('#multiDatesPicker').val();
        let mentors = $('#mentors').val();
        let mentorsmeeting_id = $('#mentorsmeeting_id').val();
        console.log('working on datepicker.....', dates);

        !dates?addClass('multiDatesPicker'):removeClass('multiDatesPicker');
        !mentors?addClass('mentors'):removeClass('mentors');

        if(!mentors || !mentorsmeeting_id || !dates){
            Notiflix.Notify.Failure('Select all required fields.');
            return false;
        }
        $.ajax({
            url:"{{url('mentorsAvailability')}}",
            type:"POST",
            data: {dates:dates, mentorsmeeting_id:mentorsmeeting_id, mentors:mentors},
            beforeSend: function(){
                Notiflix.Loading.Pulse('Processing...');
            },
            // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
            success: function (response) {
                Notiflix.Loading.Remove();
                let data = JSON.parse(JSON.stringify(response));
                console.log('response data here...', data);
                //return false;
                $('#peerReviewer-modal').modal('hide');
                // window.reload();

            },
            error:function(response, exception){
                Notiflix.Loading.Remove();
                $.each(response.responseJSON, function (index, val) {
                    Notiflix.Notify.Failure(val);
                })

            }
        });

    })

    //Date range picker with time picker
    $('#esScheduleDateTime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    $(function () {
        $('.select2').select2();
        // calendar
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

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
        @hasrole('BusinessSchool') eventClick: function(info) {
                 $('#peerReviewer-modal').modal('show');
                 console.log('Event: complete details' + info.event.id);
                 $('#mentorsmeeting_id').val(info.event.id);
                 console.log('Event: complete campus_id' + info.event.campus_id);
                 console.log('Event: complete title' + info.event.title);
                 console.log('Event: complete start' + info.event.start);
                 // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                 // alert('View: ' + info.view.type);

                 // change the border color just for fun
                 info.el.style.borderColor = 'red';
             },
             editable: true,@endhasrole
             droppable: true, // this allows things to be dropped onto the calendar
             eventTimeFormat: { // like '14:30:00'
                hour: '2-digit',
                minute: '2-digit',
                meridiem: true
             },


              customButtons: {
                addEventButton: {
                    @hasrole('ESScheduler')
                    text: 'Add Meeting...',
                    @endhasrole

                    click: function() {
                        $('#add-modal').modal('show');
                       // var dateStr = prompt('Enter a date in YYYY-MM-DD format');
                       // var date = new Date(dateStr + 'T00:00:00'); // will be in local time

                        // if (!isNaN(date.valueOf())) { // valid?
                        //     calendar.addEvent({
                        //         title: 'dynamic event',
                        //         start: date,
                        //         allDay: true
                        //     });
                        //     alert('Great. Now, update your database...');
                        // } else {
                        //     alert('Invalid date.');
                        // }
                    },

                }
            }
        });

        myCalendar.render();

        //color picker with addon
        /* initialize the external events
         -----------------------------------------------------------------*/
        // function init_events(ele) {
        //     ele.each(function () {
        //
        //         // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        //         // it doesn't need to have a start or end
        //         var eventObject = {
        //             title: $.trim($(this).text()) // use the element's text as the event title
        //         }
        //
        //         // store the Event Object in the DOM element so we can get to it later
        //         $(this).data('eventObject', eventObject)
        //
        //         // make the event draggable using jQuery UI
        //         $(this).draggable({
        //             zIndex        : 1070,
        //             revert        : true, // will cause the event to go back to its
        //             revertDuration: 0  //  original position after the drag
        //         })
        //
        //     })
        // }
        //
        // init_events($('#external-events div.external-event'))

        /* initialize the calendar
         -----------------------------------------------------------------*/

        $.ajax({
            url:"{{url('MentoringScheduler')}}/"+{{@request()->route('id')}},
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

                let eventsList = [];

                $.each(data, function (index, val) {
                    console.log('index...', index);
                    eventsList[index] ={}
                    eventsList[index]['id'] = val.id
                    eventsList[index]['campus_id'] = val.campus_id
                    eventsList[index]['department_id'] = val.department_id
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

        $('#confirmDate').on('change', function () {
            let confirmCheck = $(this).is(':checked');
            let slip_id = $(this).data('id');
            let confirm = confirmCheck?'yes':'';
            let dateVal = $(this).val();
            //console.log('checked....', confirmCheck);
            $.ajax({
                url:"{{url('changeMentorConfirmStatus')}}",
                type:"post",
                data: {confirm:confirm,slip_id:slip_id,dateVal:dateVal},
                beforeSend: function(){
                    Notiflix.Loading.Pulse('Processing...');
                },
                // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
                success: function (response) {
                     Notiflix.Loading.Remove();
                    if(response.success){
                        Notiflix.Notify.Success(response.success);
                    }
                    //let data = JSON.parse(JSON.stringify(response));
                    console.log('response data...', response);

                },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })

                }
            });
        });
        /* ADDING EVENTS */
        // var currColor = '#3c8dbc' //Red by default
        // //Color chooser button
        // var colorChooser = $('#color-chooser-btn')
        // $('#color-chooser > li > a').click(function (e) {
        //     e.preventDefault()
        //     //Save color
        //     currColor = $(this).css('color')
        //     //Add color effect to button
        //     $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
        // })
        // $('#add-new-event').click(function (e) {
        //     e.preventDefault()
        //     //Get value and make sure it is not null
        //     var val = $('#new-event').val()
        //     if (val.length == 0) {
        //         return
        //     }
        //
        //     //Create events
        //     var event = $('<div />')
        //     event.css({
        //         'background-color': currColor,
        //         'border-color'    : currColor,
        //         'color'           : '#fff'
        //     }).addClass('external-event')
        //     event.html(val)
        //     $('#external-events').prepend(event)
        //
        //     //Add draggable funtionality
        //     init_events(event)
        //
        //     //Remove event from text input
        //     $('#new-event').val('')
        // })
    });

    $('#schedule').on('click', function () {
        let registrations = $('#registrations').val();
        let title = $('#registrations option:selected').text();
        let user_id = $('#user_id').val();
        let esScheduleDateTime = $('#esScheduleDateTime').val();
        let color = $('#color').val();

        !registrations?addClass('registrations'):removeClass('registrations');
        !user_id?addClass('user_id'):removeClass('user_id');
        !esScheduleDateTime?addClass('esScheduleDateTime'):removeClass('esScheduleDateTime');
        !color?addClass('color'):removeClass('color');
        if(!registrations || !user_id || !esScheduleDateTime)
        {
            Notiflix.notify.error('Fill all the required Fields');
            return false;
        }
        $.ajax({
            url:"{{url('MentoringScheduler')}}",
            type:"POST",
            data: {registrations:registrations, user_id:user_id, esScheduleDateTime:esScheduleDateTime, color:color, title:title},
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
                $('#add-modal').modal('hide');
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

<script>
    $(document).ready(function(){

    // .datepicker({
    //         todayBtn: "linked",
    //         multidate: true
    //     });
        $('#multiDatesPicker').datepicker({
            multidate: true
        });
    });
</script>
