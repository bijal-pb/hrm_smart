@extends('front.layouts.frontlayout')


@section('content')
    <div class="page-head">
        <div class="page-title">
            <h1>
                <i class="fal fa-calendar-check "></i>
                {{ trans('core.attendance') }}
            </h1>
        </div>
    </div>

    <!-- <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                        <i class="fal fa-calendar-check"></i>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @lang('core.todays') {{ trans('core.attendance') }}
                            <span class="fw-300"></span>
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                                data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Fullscreen"></button>
                            {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                        </div>
                    </div>
                    <div class="panel-container show">
                        <button type="button" id="btn-add" class="btn btn-primary float-right m-3" data-toggle="modal" data-target="#default-example-modal">Add Wholeseller</button>
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
                                            <section class=" col col-4">
                                                <label class="form-label">@lang('core.currentTime')</label>
                                                <div class="input">
                                                    <i class="icon-prepend fa fa-clock-o"></i>
                                                    <input class="form-control" type="text" disabled id="current_time">
                                                </div>
                                            </section>
                                            <section class=" col col-4">
                                                <label class="form-label">@lang('core.IPAddress')</label>
                                                <div class="input">
                                                    <i class="icon-prepend fa fa-desktop"></i>
                                                    <input class="form-control" type="text" disabled
                                                        value="{{ $ip_address }}">
                                                </div>
                                            </section>
                                            <section class="col col-4">
                                                <label class="form-label">@lang('core.workingFrom')</label>
                                                <div class="input">
                                                    <input class="form-control" placeholder="Office, Home, etc."
                                                        id="work_form" name="work_from" value="{{ $working_from }}">
                                                </div>
                                            </section>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <section>
                                            <label class="form-label mt-3">@lang('core.notes')</label>
                                            <textarea rows="3" placeholder="Note to your manager" name="notes" class="form-control"
                                                id="notes">{{ $notes }}</textarea>
                                        </section>
                                    </fieldset>
                                    <fieldset class="no-padding-fieldset">
                                        <div id="clocks">
                                            @if ($set_attendance == 1)
                                                <section class="col col-6">
                                                    <div class="pull-right" id="clock_set_div">
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
                                                    <div class="pull-left" id="clock_unset_div">
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
        </div>  -->

    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        <i class="fal fa-calendar-alt"></i>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('core.attendance') }} @lang('core.summary')
                        <span class="fw-300"></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                            data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                            data-offset="0,10" data-original-title="Fullscreen"></button>
                        {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        {{-- <div class="row">
                            <form class="sky-form mb-5 ml-5 mr-5 w-100">
                                    <div class="row">
                                        <section class="col">
                                            <label class="form-label">@lang('core.from')</label>
                                            <div class="input">
                                                <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="from_date" id="from_date" class="form-control"
                                                    placeholder="{{ trans('core.startDate') }}">
                                            </div>
                                        </section>

                                        <section class="col">
                                            <label class="form-label">@lang('core.to')</label>
                                            <div class="input">
                                                <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="to_date" id="to_date" class="form-control"
                                                    placeholder="{{ trans('core.endDate') }}">
                                            </div>
                                        </section>
                                    </div>
                            </form>
                        </div> --}}
                        <div class="row filter-row">
                            <div class="col-sm-4 col-xs-6">
                                <div class="form-group form-focus">
                                    <label class="form-label">Select a Date</label>
                                    <input type="text" class="form-control datepicker-1" name="date"
                                        placeholder="Select date" value="">
                                </div>
                            </div>
                        </div><br>
                        <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline"
                            id="attendance_table">
                            <thead class="bg-primary-600">
                                <tr>
                                    <th> {{ trans('core.serialNo') }} </th>

                                    <th class="all"> {{ trans('core.date') }} </th>
                                    <th class="all"> {{ trans('core.status') }} </th>
                                    <th class="min-tablet-l"> {{ trans('core.progress') }} </th>
                                    <th> @lang('core.hours')</th>

                                </tr>
                            </thead>
                            <tbody>


                                <tr>
                                    <td>{{-- Serial Number --}}</td>
                                    <td>{{-- Month --}}</td>
                                    <td>{{-- Year --}}</td>
                                    <td>{{-- created On --}}</td>
                                    <td>{{-- created On --}}</td>

                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <input type="text" id="start-date" value="" hidden>
        <input type="text" id="end-date" value="" hidden>
    </div>

    
@stop

@section('page_js')
    {!! HTML::script('assets/js/moment-timezone.js') !!}

    <script type="text/javascript">
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

        // function setClock() {
        //     $.ajax({
        //         type: "POST",
        //         url: "{!! route('front.attendance.clockIn') !!}",
        //         data: $('.sky-form').serialize(),
        //         messagePosition: 'inline',
        //         container: "#clock_panel",
        //         success: function(response) {

        //             if (response.status === "success") {
        //                 clock_flag = 1;
        //                 clock_in_word = moment(response.time_date);
        //                 table.fnDraw();

        //                 $('#clock_set_div').html(
        //                     '<span class="clock-time"><strong>{{ __('core.clockIn') }}</strong>: ' +
        //                     response.time +
        //                     '<br></span><p class="text-center"><small id="setClockInWords">' + response
        //                     .timeDiff + '</small></p>');
        //                 // $('#clock_set_div').prop('disabled', true);
        //                 setTimeout(function() {
        //                     $('#alert').html('');
        //                 }, 5000);
        //             }
        //         }
        //     });
        //     return false;
        // }
        var date = new Date();
    var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
    var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    $('#start-date').val(moment(firstDay).format('YYYY-MM-DD'));
    $('#end-date').val(moment(lastDay).format('YYYY-MM-DD'));

            $(document).ready(function() {

                        $('.datepicker-1').daterangepicker({
                        opens: 'left',
                        locale: {
                            format: 'DD-MM-YYYY'
                        },
                        startDate: firstDay,
                        endDate: lastDay,
                    }, function(startDate, endDate, label) {
                        $('#start-date').val(startDate.format('YYYY-MM-DD'));
                        $('#end-date').val(endDate.format('YYYY-MM-DD'));
                        table.fnDraw();
                    });

                    var table = $('#attendance_table').dataTable({
                        responsive: true,
                        processing: true,
                        serverSide: true,
                        // stateSave: true,
                        ajax: {
                            url: "{{ route('front.attendance.ajax_attendance') }}",
                                data: {
                                startDate: function() {
                                    return $('#start-date').val()
                                },
                                endDate: function() {
                                    return $('#end-date').val()
                                },
                            },
                        },
                       // "ajax": url,
                        columns: [{
                                data: 's_id',
                                name: 's_id'
                            },
                            {
                                data: 'date',
                                name: 'date'
                            },
                            {
                                data: 'status',
                                name: 'status'
                            },

                            {
                                data: 'clock_out',
                                name: 'clock_out',
                                "bSortable": false
                            },

                            {
                                data: 'Hours',
                                name: 'Hours'
                            },
                        ],
                        order: [0, 'desc'],
                        lengthChange: true,
                        dom: '<"float-left"B><"float-right"f>rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>',
                        // "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                        // "<'row'<'col-sm-12'tr>>" +
                        // "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        buttons: [{
                                extend: 'pdfHtml5',
                                text: 'PDF',
                                titleAttr: 'Generate PDF',
                                className: 'btn-outline-primary btn-sm mr-1'
                            },
                            {
                                extend: 'excelHtml5',
                                text: 'Excel',
                                titleAttr: 'Generate Excel',
                                className: 'btn-outline-primary btn-sm mr-1'
                            },
                            {
                                extend: 'csvHtml5',
                                text: 'CSV',
                                titleAttr: 'Generate CSV',
                                className: 'btn-outline-primary btn-sm mr-1'
                            },
                            {
                                extend: 'copyHtml5',
                                text: 'Copy',
                                titleAttr: 'Copy to clipboard',
                                className: 'btn-outline-primary btn-sm mr-1'
                            },
                            {
                                extend: 'print',
                                text: 'Print',
                                titleAttr: 'Print Table',
                                className: 'btn-outline-primary btn-sm'
                            }
                        ]
                    });
               



                    // function unsetClock() {
                    //     $.ajax({
                    //         type: "POST",
                    //         url: "{!! route('front.attendance.clockOut') !!}",
                    //         messagePosition: 'inline',
                    //         container: "#clock_panel",
                    //         success: function(response) {

                    //             if (response.status == 'success') {
                    //                 table.fnDraw();
                    //                 clock_out_word = moment(response.unset_time);

                    //                 $('#clock_unset_div').html(
                    //                     '<span class="clock-time"><strong>{{ __('core.clockOut') }}</strong>: ' +
                    //                     response.unset_time +
                    //                     '<br></span><p class="text-center"><small id="unSetClockInWords">' + response
                    //                     .unset_time_diff + '</small></p>');
                    //                 setTimeout(function() {
                    //                     $('#alert').html('');
                    //                 }, 5000);
                    //             } else {
                    //                 setTimeout(function() {
                    //                     $('#alert').html('');
                    //                 }, 5000);
                    //             }
                    //         }
                    //     });
                    //     return false;
                    // }

                    function date_change() {

                        var from_date = $('#from_date').val();
                        var to_date = $('#to_date').val();
                        url = "{{ URL::route('front.attendance.ajax_attendance') }}?from_date=" + from_date +
                            "&to_date=" + to_date;
                        table.fnDraw();
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

                  
                        startTime();
                        timeInWords(clock_in_word, clock_out_word);
                        table.fnDraw();
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
    </script>
@endsection
