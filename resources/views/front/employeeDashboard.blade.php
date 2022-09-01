@extends('front.layouts.frontlayout')

@section('content')


    <div class="col-md-12">
        @if ($active_company->license_expired == 1)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger"><i class="fa fa-close"></i> Your companies account has been
                        disabled. Please contact your manager for further details.
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            <i class="fal fa-calendar-check"></i>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @lang('core.todays') {{ trans('core.attendance') }}
                            <span class="fw-300"></span>
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Fullscreen"></button>
                            {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                        </div>
                    </div>
                    <div class="panel-container show">
                        <!-- <button type="button" id="btn-add" class="btn btn-primary float-right m-3" data-toggle="modal" data-target="#default-example-modal">Add Wholeseller</button> -->
                        <div class="panel-content">
                            <p id="alert"></p>
                            @if ($set_attendance == 3)
                                <div class="row">
                                    <h4 class="text-center">@lang('core.absentToday')</h4>
                                </div>
                            @elseif ($set_attendance == 2)
                                <div class="row">
                                    <h4 class="text-center">@lang('core.OfficeTimePassed')</h4>
                                </div>
                            @else
                                <form class="sky-form">
                                    <div id="alert_box"></div>
                                    <fieldset>
                                        <div class="row">
                                            <section class=" col-md-4">
                                                <label class="form-label">@lang('core.currentTime')</label>
                                                <div class="input">
                                                    <i class="icon-prepend fa fa-clock-o"></i>
                                                    <input class="form-control" type="text" disabled id="current_time">
                                                </div>
                                            </section>
                                            <section class=" col-md-4">
                                                <label class="form-label">@lang('core.IPAddress')</label>
                                                <div class="input">
                                                    <i class="icon-prepend fa fa-desktop"></i>
                                                    <input class="form-control" type="text" disabled
                                                        value="{{ $ip_address }}">
                                                </div>
                                            </section>
                                            <section class="col-md-4">
                                                <label class="form-label">@lang('core.workingFrom')</label>
                                                <div class="input">
                                                    <input class="form-control" placeholder="Office, Home, etc."
                                                        id="work_form" name="work_from" value="{{ $working_from }}">
                                                </div>
                                            </section>
                                        </div>
                                    </fieldset>
                                    <fieldset>

                                        <label class="form-label">@lang('core.notes')</label>
                                        <textarea rows="3" placeholder="Note to your manager" name="notes" class="form-control"
                                            id="notes">{{ $notes }}</textarea>

                                    </fieldset>
                                    <fieldset class="no-padding-fieldset">
                                        <div id=" clocks">
                                            @if ($set_attendance == 1)
                                                <section class="col col-6">
                                                    <div class="pull-right my-2" id="clock_set_div">
                                                        @if ($clock_set == 1)
                                                            <span class="clock-time">
                                                                <strong>@lang('core.clockIn')</strong>:
                                                                {{ $clock_in_time->timezone($timezones[$setting->timezone])->format('h:i A') }}<br></span>
                                                            <p class="text-center">
                                                                <small
                                                                    id="setClockInWords">{{ $clock_in_time->timezone($timezones[$setting->timezone])->diffForHumans() }}</small>
                                                            </p>
                                                        @else
                                                            <button type="button" class="btn btn-primary" id="clock_in"
                                                                onclick="setClock()">@lang('core.clockIn')
                                                            </button>
                                                        @endif
                                                    </div>
                                                </section>
                                                <section class="col col-6">
                                                    <div class="pull-left my-2" id="clock_unset_div">
                                                        <button type="button" class="btn btn-primary" id="clock_out"
                                                            onclick="unsetClock()">@lang('core.clockOut')
                                                        </button>
                                                    </div>
                                                </section>
                                            @endif
                                            @if ($set_attendance == 0)
                                                <section class="col col-6">
                                                    <div class="pull-right">
                                                        <span class="clock-time">
                                                            <strong>@lang('core.clockIn')</strong>:
                                                            {{ $clock_in_time->timezone($timezones[$setting->timezone])->format('h:i A') }}<br></span>
                                                        <p class="text-center">
                                                            <small id="setClockInWords"></small>
                                                        </p>
                                                    </div>
                                                </section>
                                                <section class="col col-6">
                                                    <div class="pull-left">
                                                        <span class="clock-time">
                                                            <strong>@lang('core.clockOut')</strong>:
                                                            {{ $clock_out_time->timezone($timezones[$setting->timezone])->format('h:i A') }}<br></span>
                                                        <p class="text-center">
                                                            <small id="unSetClockInWords"></small>
                                                        </p>
                                                    </div>
                                                </section>
                                            @endif
                                        </div>
                                    </fieldset>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            {{ __('core.attendance') }} <span class="fw-300"></span>
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Fullscreen"></button>
                            {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Close"></button> --}}
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            {{-- <div class="alert-blocks alert-blocks-info">
                                <div class="overflow-h">
                                    <strong class="color-dark">{{ __('core.lastAbsent') }}
                                        <small class="pull-right"><em>{!! $employee->lastAbsent('date') !!}</em></small>
                                    </strong>
                                    <small class="award-name">{!! $employee->lastAbsent() !!}</small>
                                </div>
                            </div> --}}
                            <div id="calendar"></div>
                            <!-- Modal : TODO -->
                            <!-- Modal end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($active_company->license_expired != 1)
            <!--Profile Body-->
            <!--End Profile Post-->

            <!--Notice Board -->

            <div class="row justify-content-start">
                <div class="col-md-6">
                    @if ($setting->notice_feature == 1)
                        <div id="panel-6" class="panel">
                            <div class="panel-hdr">
                                <h2><i class="fal fa-bullhorn"></i>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('core.noticeBoard') }}</h2>
                                <div class="panel-toolbar">
                                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                        data-offset="0,10" data-original-title="Collapse"></button>
                                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                        data-offset="0,10" data-original-title="Fullscreen"></button>
                                    <!-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> -->
                                </div>
                            </div>
                            <div class="panel-container show">
                                <div data-spy="scroll" data-target="#spyscroll-1" data-offset="0" class="p-4 overflow-auto"
                                    style="height:250px">
                                    <div class="p-3 text-red mb-g">
                                        @forelse($noticeboards as $notice)
                                            <hr>
                                            <thead class="thead-themed">
                                                <div class="">
                                                    <div
                                                        class="rounded bg-fusion-100 width-10 height-10 d-inline-block bg-red mb-10">

                                                        <span>
                                                            <h1>&nbsp;&nbsp;&nbsp;{!! date('d', strtotime($notice->created_at)) !!}</h1>
                                                        </span>
                                                        <span>&nbsp;&nbsp;&nbsp;{!! date('m, Y', strtotime($notice->created_at)) !!}</span>
                                                    </div><br>
                                                    <div class="row mx-md-n5">
                                                        <div class="col px-md-5">
                                                            <div class="p-2">
                                                                <h5><a href="" data-toggle="modal"
                                                                        data-target=".show_notice"
                                                                        onclick="show_notice({{ $notice->id }});return false;">{{ $notice->title }}</a>
                                                                </h5>
                                                                @if (strpos($notice->description, 'src') == 0)
                                                                    <h5>
                                                                        <p>{!! \Illuminate\Support\Str::limit(strip_tags($notice->description), 100) !!}
                                                                        </p>
                                                                    </h5>
                                                                @else
                                                                    <p>&nbsp;</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @empty
                                                <p class="text-center" style="padding: 4px; margin-top: 26%;">No
                                                    Notice</p>
                                            </thead>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    @if ($setting->holidays_feature == 1)
                        <div id="panel-6" class="panel bg-white-500">
                            <div class="panel-hdr">
                                <h2><i class="fal fa-mountains"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{ __('core.upcomingHolidays') }}</h2>
                                <div class="panel-toolbar">
                                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                        data-offset="0,10" data-original-title="Collapse"></button>
                                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                        data-offset="0,10" data-original-title="Fullscreen"></button>
                                    <!-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> -->
                                </div>
                            </div>
                            <div class="panel-container show">
                                <div data-spy="scroll" data-target="#spyscroll-1" data-offset="0" class="p-4 overflow-auto"
                                    style="height:250px">
                                    @forelse($holidays as $holiday)
                                        {{-- Check for upcoming Holidays --}}
                                        @if (strtotime($holiday->date) > time() && $holiday->occassion != 'Sunday' && $holiday->occassion != 'Saturday')
                                            <div
                                                class="alert-blocks alert-blocks-{{ $holiday_color[$holiday->id % count($holiday_color)] }}">
                                                <div class="overflow-h">
                                                    <strong
                                                        class="color-{{ $holiday_font_color[$holiday->id % count($holiday_font_color)] }}">{{ $holiday->occassion }}
                                                        <small class="pull-right">
                                                            <em>{!! date('d M Y', strtotime($holiday->date)) !!}</em>
                                                        </small>
                                                    </strong>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                        <p class="text-center" style="padding: 4px; margin-top: 26%;">No
                                            Holiday
                                        </p>
                                    @endforelse

                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
            <!--End Profile Event-->

            <!--/end row-->

            <hr>



            <!--End Profile Blog-->

    </div>
    <!--End Profile Body-->
    </div>


    {{-- ------------------------Show Notice MODALS--------------- --}}
    <div class="modal fade show_notice in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <div class="d-block position-absolute pos-center pos-left p-2 ">
                        <h4 id="myLargeModalLabel" class="form-controll modal-title show-notice-title">
                            {{-- Notice Title using Javascript --}}
                        </h4>
                    </div>
                </div>
                <div class="modal-body" id="show-notice-body">
                    {{-- Notice full Description using Javascript --}}
                </div>
            </div>
        </div>
    </div>
    {{-- ----------------------END Notice MODALS------------------- --}}
    @endif

@endsection


@section('page_js')
    @if ($active_company->license_expired != 1)
        <script>
            $('#clock_out').prop('disabled', true);
            @if (isset($clock_in_time))
                var clock_in_word =
                    moment('{{ $clock_in_time->timezone($timezones[$setting->timezone])->format('Y-m-d H:i:s') }}');
            @else
                var clock_in_word = null;
            @endif

            @if (isset($clock_out_time))
                var clock_out_word =
                    moment('{{ $clock_out_time->timezone($timezones[$setting->timezone])->format('Y-m-d H:i:s') }}');
            @else
                var clock_out_word = null;
            @endif
            var url = "{{ URL::route('front.attendance.ajax_attendance') }}";
            var clock_flag = '{{ $clock_set ?? '' }}';

            var momentTime = moment();




            {{-- var today = moment().tz('{{$timezones[$setting->timezone]}}'); --}}

            function startTime() {
                $('#current_time').val(moment().tz('{{ $timezones[$setting->timezone] }}').format('hh:mm:ss A'));
                if (clock_flag == '1') {
                    $('#clock_out').prop('disabled', false);
                }
                setTimeout(startTime, 1000);
            }

            function checkTime(i) {
                if (i < 10) {
                    i = "0", +i
                }
                // add zero in front of numbers < 10
                return i;
            }

            $("#work_form").blur(function() {
                var work_from = $(this).val();

                $.ajax({
                    type: "POST",
                    url: "{!! route('front.attendance.work_from') !!}",
                    data: {
                        'work_from': work_from
                    }
                }).done(function(response) {
                    return true;
                });
            });

            $("#notes").blur(function() {
                var notes = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{!! route('front.attendance.notes') !!}",
                    data: {
                        'notes': notes
                    }
                }).done(function(response) {
                    return true;
                });
            });

            $('#from_date').on('change', function() {
                date_change();
            });
            $('#to_date').on('change', function() {
                date_change();
            });

            function setClock() {
                $.easyAjax({
                    type: "POST",
                    url: "{!! route('front.attendance.clockIn') !!}",
                    data: $('.sky-form').serialize(),
                    messagePosition: 'inline',
                    container: "#clock_panel",
                    success: function(response) {

                        if (response.status === "success") {
                            clock_flag = 1;
                            clock_in_word = moment(response.time_date);
                            window.location.reload();

                            $('#clock_set_div').html(
                                '<span class="clock-time"><strong>{{ __('core.clockIn') }}</strong>: ' +
                                response.time +
                                '<br></span><p class="text-center"><small id="setClockInWords">' + response
                                .timeDiff + '</small></p>');
                            // $('#clock_set_div').prop('disabled', true);
                            setTimeout(function() {
                                $('#alert').html('');
                            }, 5000);
                        }
                    }
                });
                return false;
            }

            function unsetClock() {
                $.easyAjax({
                    type: "POST",
                    url: "{!! route('front.attendance.clockOut') !!}",
                    messagePosition: 'inline',
                    container: "#clock_panel",
                    success: function(response) {

                        if (response.status == 'success') {
                            toastr['success'](response.message);
                            window.location.reload();
                            clock_out_word = moment(response.unset_time);

                            $('#clock_unset_div').html(
                                '<span class="clock-time"><strong>{{ __('core.clockOut') }}</strong>: ' +
                                response.unset_time +
                                '<br></span><p class="text-center"><small id="unSetClockInWords">' + response
                                .unset_time_diff + '</small></p>');
                            setTimeout(function() {
                                $('#alert').html('');
                            }, 5000);
                        } else {
                            toastr['error'](response.message);
                            setTimeout(function() {
                                $('#alert').html('');
                            }, 5000);
                        }
                    }
                });
                return false;
            }

            function timeInWords(clock_in, clock_out) {
                if (clock_in != null) {
                    $('#setClockInWords').html(clock_in.fromNow());
                } else {
                    $('#setClockInWords').html('');
                }

                if (clock_out != null) {
                    $('#unSetClockInWords').html(clock_out.fromNow());
                } else {
                    $('#unSetClockInWords').html('');
                }
                setTimeout(timeInWords, 1000, clock_in_word, clock_out_word);
            }

            jQuery(document).ready(function() {
                startTime();
                timeInWords(clock_in_word, clock_out_word);
                // table.fnDraw();
                $('#from_date').datepicker({
                    dateFormat: 'dd-mm-yy',
                    prevText: '<i class="fa fa-angle-left"></i>',
                    nextText: '<i class="fa fa-angle-right"></i>'
                });
                $('#to_date').datepicker({
                    dateFormat: 'dd-mm-yy',
                    prevText: '<i class="fa fa-angle-left"></i>',
                    nextText: '<i class="fa fa-angle-right"></i>'
                });
            });


         
                function show_notice(id) {
                    var url = "{{ route('front.notice_ajax', ':id') }}";
                    url = url.replace(':id', id);
                    $.easyAjax({
                        url: url,
                        type: "GET",
                        data: $(".ajax_form").serialize(),
                        container: ".ajax_form",
                        success: function(response) {

                            $('.show-notice-title').html(response.title);
                            $('#show-notice-body').html(response.description);

                        },
                    });
                }
            
        </script>
        <script>
            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var TODAY = todayDate.format('YYYY-MM-DD');
            var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: ['dayGrid', 'list', 'timeGrid', 'interaction', 'bootstrap'],
                    themeSystem: 'bootstrap',
                    displayEventTime: false,
                    timeZone: 'UTC',
                    //dateAlignment: "month", //week, month
                    buttonText: {
                        today: 'today',
                        month: 'month',
                        week: 'week',
                        day: 'day',
                        list: 'list'
                    },
                    eventTimeFormat: {
                        hour: 'numeric',
                        minute: '2-digit',
                        meridiem: 'short'
                    },
                    navLinks: true,
                    header: {
                        left: 'prev,next today addEventButton',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    footer: {
                        left: '',
                        center: '',
                        right: ''
                    },
                    //height: 700,
                    editable: false,
                    eventLimit: true, // allow "more" link when too many events
                    views: {
                        sevenDays: {
                            type: 'agenda',
                            buttonText: '7 Days',
                            visibleRange: function(currentDate) {
                                return {
                                    start: currentDate.clone().subtract(2, 'days'),
                                    end: currentDate.clone().add(5, 'days'),
                                };
                            },
                            duration: {
                                days: 7
                            },
                            dateIncrement: {
                                days: 1
                            },
                        },
                    },
                    events: function(info, successCallback, failureCallback) {
                        $.ajax({
                            url: '{{ route('front.attendance.ajax_load_calender') }}',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                start: moment(info.start).format('YYYY-MM-DD'),
                                end: moment(info.end).format('YYYY-MM-DD'),
                            },
                            success: function(doc) {
                                var events = [];
                                if (!!doc) {
                                    $.map(doc, function(r) {
                                        if (r.a_status == "absent") {
                                            icon = 'no';
                                            type = 'attendance';
                                            bgcolor = '#ff9999';
                                            etitle = r.title;
                                            eClassName = 'bg-danger border-danger text-white';
                                            allDay = false;
                                        } else if (r.a_status == "present") {
                                            icon = 'no';
                                            type = 'attendance';
                                            bgcolor = '';
                                            etitle = r.a_status;
                                            eClassName = 'bg-success border-success text-white';
                                            allDay = false;
                                        } 
                                        else if (r.type == 'project') {
                                            icon = 'no';
                                            type = 'project';
                                            etitle = r.title + '[' + r.start_time +
                                                ' - ' + r.end_time + ']';
                                            eClassName = 'bg-info border-info text-white';
                                            if(r.start_date == r.end_date){
                                                allDay = false;
                                            }else{
                                                allDay = true;
                                            }
                                        } else if (r.type == 'birthday') {
                                            type = r.type;
                                            etitle = r.title;
                                            bgcolor = '';
                                            eClassName = 'bg-warning border-warning text-white';
                                            allDay = false;
                                        } else {
                                            icon = 'no';
                                            type = 'holiday';
                                            etitle = r.title;
                                            bgcolor = '';
                                            eClassName = 'bg-primary border-primary text-white';
                                            allDay = false;
                                        }
                                        events.push({
                                            className: eClassName,
                                            id: r.id,
                                            title: etitle,
                                            start: r.date,
                                            end: r.end,
                                            allDay: allDay
                                        });
                                    });
                                }
                                successCallback(events);
                            }
                        });
                    },
                    eventRender: function(info) {
                        $(info.el).tooltip({title: info.event.title});
                    }
                });

                calendar.render();
            });
        </script>
    @endif
@endsection
