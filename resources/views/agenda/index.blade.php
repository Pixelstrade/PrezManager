@extends('blank')


@section('css')

    <link class="" href="{{ URL::asset('pages/css/themes/calendar.css')}}" rel="stylesheet" type="text/css"/>

    @endsection

@section('content')


    <div class="calendar">

        <div class="calendar-header">
            <div class="drager">
                <div class="years" id="years"></div>
            </div>
        </div>
        <div class="options">
            <div class="months-drager drager">
                <div class="months" id="months"></div>
            </div>
            <h4 class="semi-bold date" id="currentDate">&amp;</h4>
            <div class="drager week-dragger">
                <div class="weeks-wrapper" id="weeks-wrapper">
                </div>
            </div>
        </div>

        <div id="calendar" class="calendar-container">
        </div>

    </div>

@endsection

@section('js')

    <script src="{{ URL::asset('assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{ URL::asset('assets/plugins/moment/moment-with-locales.min.js')}}"></script>
    <script src="{{ URL::asset('assets/plugins/hammer.min.js')}}"></script>


    <script src="{{ URL::asset('pages/js/pages.calendar.min.js')}}"></script>

    <script>
        (function($) {
            'use strict';
            $(document).ready(function() {
                var selectedEvent;
                $('body').pagescalendar({
                    events: [{
                        title: 'Call Dave',
                        class: 'bg-success-lighter',
                        start: '2014-10-07T06:00:00',
                        end: '2014-10-07T08:00:24',
                        other: {}
                    }, {
                        title: 'Meeting Roundup',
                        class: 'bg-success-lighter',
                        start: '2014-11-07T06:00:00'
                    }, {
                        title: 'Double click Any where',
                        class: 'bg-complete-lighter',
                        start: moment().startOf('week').add(1, 'days').add(2, 'hours').format(),
                        end: moment().startOf('week').add(1, 'days').add(6, 'hours').format(),
                        other: {
                            note: 'test'
                        }
                    }, {
                        title: 'Drag Me',
                        class: 'bg-success-lighter',
                        start: moment().startOf('week').add(2, 'days').add(2, 'hours').format(),
                        end: moment().startOf('week').add(2, 'days').add(3, 'hours').format(),
                        other: {
                            note: 'test'
                        }
                    }, {
                        title: 'Click me',
                        class: 'bg-danger-lighter',
                        start: moment().startOf('week').add(2, 'days').add(5, 'hours').format(),
                        end: moment().startOf('week').add(2, 'days').add(6, 'hours').format(),
                        other: {
                            note: 'test'
                        }
                    }, ],
                    onViewRenderComplete: function() {},
                    onEventClick: function(event) {
                        if (!$('#calendar-event').hasClass('open'))
                            $('#calendar-event').addClass('open');
                        selectedEvent = event;
                        setEventDetailsToForm(selectedEvent);
                    },
                    onEventDragComplete: function(event) {
                        selectedEvent = event;
                        setEventDetailsToForm(selectedEvent);
                    },
                    onEventResizeComplete: function(event) {
                        selectedEvent = event;
                        setEventDetailsToForm(selectedEvent);
                    },
                    onTimeSlotDblClick: function(timeSlot) {
                        var newEvent = {
                            title: 'my new event',
                            class: 'bg-success-lighter',
                            start: timeSlot.date,
                            end: moment(timeSlot.date).add(1, 'hour').format(),
                            allDay: false,
                            other: {
                                note: 'test'
                            }
                        };
                        selectedEvent = newEvent;
                        $('body').pagescalendar('addEvent', newEvent);
                        if (!$('#calendar-event').hasClass('open'))
                            $('#calendar-event').addClass('open');
                        setEventDetailsToForm(selectedEvent);
                    }
                });
                $('body').pagescalendar('render');

                function setEventDetailsToForm(event) {
                    $('#eventIndex').val();
                    $('#txtEventName').val();
                    $('#txtEventCode').val();
                    $('#txtEventLocation').val();
                    $('#event-date').html(moment(event.start).format('MMM, D dddd'));
                    $('#lblfromTime').html(moment(event.start).format('h:mm A'));
                    $('#lbltoTime').html(moment(event.end).format('H:mm A'));
                    $('#eventIndex').val(event.index);
                    $('#txtEventName').val(event.title);
                    $('#txtEventCode').val(event.other.code);
                    $('#txtEventLocation').val(event.other.location);
                }
                $('#eventSave').on('click', function() {
                    selectedEvent.title = $('#txtEventName').val();
                    selectedEvent.other.code = $('#txtEventCode').val();
                    selectedEvent.other.location = $('#txtEventLocation').val();
                    $('body').pagescalendar('updateEvent', $('#eventIndex').val(), selectedEvent);
                    $('#calendar-event').removeClass('open');
                });
                $('#eventDelete').on('click', function() {
                    $('body').pagescalendar('removeEvent', $('#eventIndex').val());
                    selectedEvent.other.code = $('#txtEventCode').val();
                    selectedEvent.other.location = $('#txtEventLocation').val();
                    $('#element').pagescalendar('updateEvent', $('#eventIndex').val(), selectedEvent);
                    $('#calendar-event').removeClass('open');
                });
                $('#eventDelete').on('click', function() {
                    $('#element').pagescalendar('removeEvent', $('#eventIndex').val());
                    $('#calendar-event').removeClass('open');
                });
            });
        })(window.jQuery);

    </script>
@endsection