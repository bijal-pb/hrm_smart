@extends('admin.adminlayouts.adminlayout')

@section('head')


    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
    {!! HTML::style('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') !!}
    {!! HTML::style('assets/global/plugins/jquery-multi-select/css/multi-select.css') !!}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" /> --}}
    <!-- END PAGE LEVEL STYLES -->
@stop


@section('content')

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title">
            <h1>
                <i class="fal fa-send"></i>
                {{ trans('pages.holidays.indexTitle') }} - {{ $current_year }}
            </h1>
        </div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <!-- <li>
                    <a onclick="loadView('{{ route('admin.dashboard.index') }}')">{{ trans('core.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>

                <li>
                    <span class="active">{{ trans('pages.holidays.indexTitle') }}</span>
                </li> -->
        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->

    <div id="load">
        {{-- INLCUDE ERROR MESSAGE BOX --}}

        {{-- END ERROR MESSAGE BOX --}}
    </div>

    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
                <i class="fal fa-send"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Holidays<span class="fw-300"><i></i></span>
            </h2>
            <div class="panel-toolbar">
                <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                    data-original-title="Collapse"></button>
                <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10"
                    data-original-title="Fullscreen"></button>
            </div>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="mb-4 mt-10 btn btn-primary" data-toggle="modal" href="#default-example-modal-lg">
                                {{ trans('core.btnAddHoliday') }}
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Add Holidays MODALS --}}

    <div id="default-example-modal-lg" class="modal fade" tabindex="-1" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
                    <div class="d-block position-absolute pos-top pos-left p-2 ">

                        <h4 class="modal-title"><strong>{{ trans('core.addHolidays') }}</strong></h4>
                    </div>
                </div>
                {!! Form::open(['route' => 'admin.holidays.store', 'class' => 'form-horizontal ajax_form', 'method' => 'POST']) !!}
                <div class="modal-body">
                    <!-- BEGIN FORM-->
                    <ul class="nav nav-pills" role="tablist">
                        <li class="active">
                            <a href="#tab_1" class="nav-link active" data-toggle="pill">@lang('core.commonHolidays')</a>
                        </li>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <li>
                            <a href="#tab_2" class="nav-link" data-toggle="pill">@lang('core.customHoliday')</a>
                        </li>
                    </ul>
                    <br>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab_1" role="tabpanel">
                            <div class="form-body">
                                <input type="hidden" name="holidayType" id="holidayType" value="common">
                                <div class="form-group last">
                                    <div class="col-md-12">
                                        <select multiple="multiple" class="multi-select" id="holidays_list"
                                            name="holidays_list[]">
                                            <optgroup label="@lang('core.occasionsCaps')">
                                                @foreach ($holidays_list as $holiday_item)
                                                    <option value="{{ $holiday_item->date }}|{{ $holiday_item->name }}"
                                                        @if ($holidays->contains('date', $holiday_item->date)) selected
                                                            rel="previouslySelected" @endif>
                                                        {{ \Carbon\Carbon::parse($holiday_item->date)->format('M j, Y') }}
                                                        - {{ $holiday_item->name }}</option>
                                                @endforeach
                                            </optgroup>
                                            {{-- <optgroup label="@lang("core.customCaps")"> --}}
                                            {{-- @foreach ($holidays as $holiday) --}}
                                            {{-- <option value="{{ $holiday->date }}|{{ $holiday->occassion }}" selected rel="previouslySelected">{{ \Carbon\Carbon::parse($holiday->date)->format("M j") }} - {{ $holiday->occassion }}</option> --}}
                                            {{-- @endforeach --}}
                                            {{-- </optgroup> --}}
                                            <optgroup label="@lang('core.sundaysCaps')">
                                                @foreach ($all_sundays as $sunday)
                                                    @if (!$holidays_list->contains('date', $sunday))
                                                        <option value="{{ $sunday }}|Sunday"
                                                            @if ($holidays->contains('date', $sunday)) selected
                                                                rel="previouslySelected" @endif>
                                                            {{ \Carbon\Carbon::parse($sunday)->format('M j, Y') }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="@lang('core.saturdaysCaps')">
                                                @foreach ($all_saturdays as $saturday)
                                                    @if (!$holidays_list->contains('date', $saturday))
                                                        <option value="{{ $saturday }}|Saturday"
                                                            @if ($holidays->contains('date', $saturday)) selected
                                                                rel="previouslySelected" @endif>
                                                            {{ \Carbon\Carbon::parse($saturday)->format('M j, Y') }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                            {{-- <optgroup label="@lang("core.fridaysCaps")">
                                                @foreach ($all_fridays as $friday)
                                                    @if (!$holidays_list->contains('date', $friday))
                                                        <option value="{{ $friday }}|@lang("core.officeOff")"
                                                                @if ($holidays->contains('date', $friday)) selected
                                                                rel="previouslySelected" @endif>{{ \Carbon\Carbon::parse($friday)->format("M j, Y") }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup> --}}
                                        </select>
                                        <input type="hidden" name="removedHolidays" id="removedHolidays">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="tab-pane fade" id="tab_2" role="tabpanel">
                            <div class="form-body">
                                <input type="hidden" name="holidayType" id="holidayType" value="custom">
                                <div class="row mx-md-n5">
                                    <div class="col px-md-5">
                                        <div class="form-group">
                                            <div>
                                                <input class="form-control form-control-inline input-medium date-picker"
                                                    data-date-format="dd-mm-yyyy" name="date[0]" type="text" value=""
                                                    placeholder="{{ trans('core.date') }}" />
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col px-md-5">
                                        <div class="form-group">
                                            <div>
                                                <input class="form-control form-control-inline" type="text"
                                                    name="occasion[0]" placeholder="{{ trans('core.occasion') }}" />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <br>

                                <div id="insertBefore"></div>
                                 <div class="form-group">
                                    <button type="button" id="plusButton" 
                                        class="btn btn-primary btn-sm  form-control-inline">
                                        {{ trans('core.add') }} {{ trans('core.more') }} <i class="fal fa-plus"></i>
                                    </button>
                                </div>
                                {{-- <div id="insertBefore"></div>
                                <input type="hidden" name="removedHolidays" id="removedHolidays">
                                <button type="button" id="plusButton" class="btn btn-primary btn-sm  form-control-inline">
                                    {{trans('core.add')}} {{trans('core.more')}} <i class="fal fa-plus"></i>
                                </button> --}}

                            </div>
                        </div>
                    </div>


                    <!-- END FORM-->
                </div>
                <br>
                <div class="form-group text-center">
                    <button type="button" data-loading-text="{{ trans('core.btnSubmitting') }}..." class="btn btn-primary"
                        onclick="ajaxUpdateHolidays()" id="updateHolidays">{{ trans('core.btnSubmit') }}</button>

                </div>
                <br>

                {!! Form::close() !!}
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>

        </div>
    </div>

    {{-- Add Holidays MODALS --}}

    {{-- MODAL CALLING --}}
    @include('admin.common.delete')
    {{-- MODAL CALLING END --}}

@endsection

@section('page_js')

    {{-- Page Level JS --}}
    {{-- {!! HTML::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js") !!} --}}
    {!! HTML::script('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') !!}
    {{-- {!! HTML::script('front_assets/plugins/fullcalendar/fullcalendar.min.js') !!} --}}
    {!! HTML::script('assets/global/plugins/jquery.quicksearch.js') !!}

    {{-- Page Level js end --}}
    <script>
        var calendar;
        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid', 'list', 'timeGrid', 'interaction', 'bootstrap'],
                themeSystem: 'bootstrap',
                displayEventTime: false,
                timeZone: 'UTC',
                //dateAlignment: "month", //week, month
                buttonText: {
                    today: 'today',
                    month: 'month',
                },
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    meridiem: 'short'
                },
                navLinks: true,
                header: {
                    left: 'prevYear,prev,next,nextYear today addEventButton',
                    center: 'title',
                    right: 'dayGridMonth',
                },
                footer: {
                    left: '',
                    center: '',
                    right: ''
                },
                //height: 700,
                // editable: true,
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
                eventRender: function(info) {
                    $(info.el).tooltip({title: info.event.title});
                },
                events: function(event, element, view) {

                    var i = document.createElement('i');
                    i.className = 'fal';
                    i.classList.add("fa-trash");
                    i.classList.add("btn");
                    i.classList.add("grey-mint");
                    i.classList.add("btn-xs");
                    i.addEventListener("click", function() {
                        del(event.id, event.start);
                    });
                    element.find('div.fc-content').prepend(i);
                    $(element).tooltip({
                        title: event.title,
                        container: "body"
                    });
                },
                events: [
                    @foreach ($holidays as $holiday)
                        {
                            "title": "{!! $holiday->occassion !!}",
                            "start": "{{ $holiday->date }}",
                            "id": {{ $holiday->id }}
                        },
                    @endforeach
                ],
                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // don't let the browser navigate

                    if (info.event.id) {
                        var event = calendar.getEventById(info.event.id);
                        del(event.id);
                    }
                }
            });

            calendar.render();
        });
        function ajaxUpdateHolidays() {


            // Prepare list of removed holidays
            var list = "";
            $("#holidays_list").find("option[rel='previouslySelected']:not(:selected)").each(function() {
                list += $(this).val() + "~";
            });

            $("#removedHolidays").val(list);

            $.ajax({
                url: "{!! route('admin.holidays.store') !!}",
                type: "POST",
                data: $(".ajax_form").serialize(),
                container: ".ajax_form",
                success: function(response) {
                            if (response.status == "success") {
                                toastr['success']('Holiday added successfully!');
                                table.ajax.reload(null, false);
                            }
                            if(response.status == "error") {
                                toastr['error'](response.message);
                            }
                        }
            });

        }
        $(document).ready(function() {

            $('#holidays_list').multiSelect({
                selectableOptgroup: true,
                selectableHeader: "<label><strong>@lang('core.holidaysList')</strong></label><input type='text' class='form-control' autocomplete='off' placeholder='@lang('core.searchList')'>",
                selectionHeader: "<label><strong>@lang('core.selectedHolidays')</strong></label><input type='text' class='form-control' autocomplete='off' placeholder='@lang('core.searchList')'>",
                afterInit: function(ms) {
                    var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#' + that.$container.attr('id') +
                        ' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#' + that.$container.attr('id') +
                        ' .ms-elem-selection.ms-selected';

                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                        .on('keydown', function(e) {
                            if (e.which === 40) {
                                that.$selectableUl.focus();
                                return false;
                            }
                        });

                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                        .on('keydown', function(e) {
                            if (e.which == 40) {
                                that.$selectionUl.focus();
                                return false;
                            }
                        });
                },
                afterSelect: function() {
                    this.qs1.cache();
                    this.qs2.cache();
                },
                afterDeselect: function() {
                    this.qs1.cache();
                    this.qs2.cache();
                }
            });
        });


        var $insertBefore = $('#insertBefore');
    var $i = 0;
    $('#plusButton').click(function() {

        $i = $i + 1;
            $('<div id="row' + $i + '"> ' +
                '<div class="row mx-md-n5">' +
                ' <div class="col px-md-5"> ' +
                '<div class="form-group"><div><input class="form-control form-control-inline input-medium date-picker' +
                $i + '" name="date[' + $i +
                ']" type="text" value="" placeholder="{{ trans('core.date') }}"/></div><br>' + 
                '<button class="mb-4  btn btn-sm btn-danger btn_remove" type="button" name="remove" id="'+$i+'">X</button>'+
                '</div></div>' +
                '<br><div class="col px-md-5"><div class="form-group"><div><input class="form-control form-control-inline" name="occasion[' +
                $i + ']" type="text" value="" placeholder="{{ trans('core.occasion') }}"/></div></div><div>' +
                '</div>' +
                '</div>'+
                '</div>').insertBefore($insertBefore);
            $.fn.datepicker.defaults.format = "yyyy-mm-d";
            $('.date-picker' + $i).datepicker();
        });

        $(document).on('click', '.btn_remove', function(){    
           var button_id = $(this).attr("id");     
           $('#row'+button_id+'').remove();    
      });  

        $('.date-picker').datepicker({
            defaultDate: 'now',
            format: 'yyyy-mm-dd',
            todayHighlight: true,
        });

        // var $insertBefore = $('#insertBefore');
        // var $i = 0;

        // $('#plusButton').click(function () {
        //     $i = $i + 1;
        //     $(' <div class="col-md-6"> ' +
        //         '<div class="form-group"><div><input class="form-control form-control-inline input-medium date-picker' + $i + '" name="date[' + $i + ']" type="text" value="" placeholder="{{ trans('core.date') }}"/></div></div></div>' +
        //         '<div class="col-md-6"><div class="form-group"><div><input class="form-control form-control-inline" name="occasion[' + $i + ']" type="text" value="" placeholder="{{ trans('core.occasion') }}"/></div></div><div>' +
        //         '</div>').insertBefore($insertBefore);
        //     $.fn.datepicker.defaults.format = "dd-mm-yyyy";
        //     $('.date-picker' + $i).datepicker();
        // });

        function del(id, date) {

            $('#deleteModal').modal("show");
            $("#deleteModal").find('#info').html('Are you sure ! You want to delete?');
            $('#deleteModal').find("#delete").off().click(function() {
                var url = "{{ route('admin.holidays.destroy', ':id') }}";
                url = url.replace(':id', id);
                var token = "{{ csrf_token() }}";
                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {
                        '_token': token,
                        "id": id
                    },
                    container: "#deleteModal",
                    success: function(response) {
                        var event = calendar.getEventById(id);
                        event.remove();
                        $('#deleteModal').modal('hide');
                    }
                });


            });

        }
    </script>
@endsection
