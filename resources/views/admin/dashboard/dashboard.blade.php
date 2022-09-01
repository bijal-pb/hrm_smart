@extends('admin.adminlayouts.adminlayout')

@section('head')
@stop

@section('content')

    <div class="page-head">
        <div class="page-title">
            <h1>
                <i class='subheader-icon fal fa-tachometer'></i> <b style="font-weight: 400">
                    @if ($loggedAdmin->type == 'superadmin')
                        {{ $loggedAdmin->company->company_name }}
                    @endif
                </b> {{ trans('core.dashboard') }}
            </h1>
        </div>
    </div>
    <div class="page-bar">
        <!-- <ul class="page-breadcrumb breadcrumb">
                                                <li>
                                                    <span class="active">{{ trans('core.dashboard') }}</span>
                                                </li>
                                            </ul> -->

    </div>
    @if ($loggedAdmin->company->license_expired == 1)
        <div class="row">
            <div class="col-md-12">
                <div class="note note-danger"><i class="fa fa-close"></i> You have unpaid invoices past due date. Please
                    pay them by going to Settings > Billing to restore access to your account.
                </div>
            </div>
        </div>
    @endif

    @if ($loggedAdmin->company->license_expired == 0)
        @if (($displaySetup == true and $nextStepNumber > 3) || $displaySetup == false)
            {{-- @if (!$loggedAdmin->checkEmailVerified())
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-tag">
                            <div class="note note-danger">
                                <i class="fa fa-close"></i> {!! trans('messages.verifyEmail', ['link' => URL::to('admin/resend_verify_email')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif --}}

            <!-- @if ($loggedAdmin->company->billing_address == '')
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-tag">
                            <div class="note note-danger"><i class="fa fa-close"></i> Please update your billing address
                                and
                                timezone by going to <a href="{{ route('admin.general_setting.edit') }}">company
                                    settings</a>.
                            </div>
                        </div>
                    </div>
                </div>
            @endif -->
        @endif
    @endif
    <br>
    @if ($loggedAdmin->company->license_expired == 0)
        <div class="row">
            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                <div class="p-3 bg-success-300 rounded overflow-hidden position-relative text-white mb-g">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <div class="number count">
                            {{ $employee_count }}
                        </div>
                        <small class="m-0 l-h-n">
                            {{ trans('core.totalEmployees') }}
                        </small>
                    </h3>
                    <i class="fal fa-users position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                        style="font-size:6rem"></i>
                    <a href="{{ route('admin.employees.index') }}" style="color: white">
                        {{ trans('core.viewMore') }}
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                <div class="p-3 bg-danger-300 rounded overflow-hidden position-relative text-white mb-g">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <div class="number count">
                            {{ $department_count }}
                        </div>
                        <small class="m-0 l-h-n">
                            {{ trans('core.totalDepartments') }}
                        </small>
                    </h3>
                    <i class="fal fa-sitemap position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                        style="font-size:6rem"></i>
                    <a href="{{ route('admin.departments.index') }}" style="color: white">
                        {{ trans('core.viewMore') }}
                    </a>
                </div>
            </div>


            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                <div class="p-3 bg-info-300 rounded overflow-hidden position-relative text-white mb-g">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <div class="number count">
                            {{ $project_count }}
                        </div>
                        <small class="m-0 l-h-n">
                            Total Projects
                        </small>
                    </h3>
                    <i class="fal fa-list-alt position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                        style="font-size:6rem"></i>
                    <a class="more" href="{{ route('admin.projects.index') }}" style="color: white">
                        {{ trans('core.viewMore') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <div class="number count">
                            {{ $inprogress_project_count }}
                        </div>
                        <small class="m-0 l-h-n">
                            Total In Progress Projects
                        </small>
                    </h3>
                    <i class="fal fa-clock position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                        style="font-size:6rem"></i>
                    <a class="more" href="{{ route('admin.projects.index') }}" style="color: white">
                        {{ trans('core.viewMore') }}
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <div class="number count">
                            {{ $hold_project_count }}

                        </div>
                        <small class="m-0 l-h-n">
                            Total Hold Projects

                        </small>
                    </h3>
                    <i class="fal fa-pause position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                        style="font-size:6rem"></i>
                    <a class="more" href="{{ route('admin.projects.index') }}" style="color: white">
                        {{ trans('core.viewMore') }}
                    </a>
                </div>
            </div>


            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                <div class="p-3 bg-fusion-200 rounded overflow-hidden position-relative text-white mb-g">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <div class="number count">
                            {{ $completed_project_count }}
                        </div>
                        <small class="m-0 l-h-n">
                            Total Completed Projects
                        </small>
                    </h3>
                    <i class="fal fa-ballot-check position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                        style="font-size:6rem"></i>
                    <a class="more" href="{{ route('admin.projects.index') }}" style="color: white">
                        {{ trans('core.viewMore') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            @if ($loggedAdmin->type == 'superadmin' || $loggedAdmin->company->attendance_feature == 1)
                <div class="col-md-12">
                    <div id="panel-3" class="panel">
                        <div class="panel-hdr">
                            <h2> {{ trans('core.attendance') }}</h2>
                            <div class="panel-toolbar">
                                <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                    data-offset="0,10" data-original-title="Collapse"></button>
                                <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                    data-offset="0,10" data-original-title="Fullscreen"></button>
                                {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                            </div>
                        </div>
                        <div class="panel-container show">
                            <div class="panel-content">
                                <div class="row justify-content-center align-items-center">
                                    <div class="ml-1 mb-2 col-md-4">
                                        <select class="form-control select2" name="employee_id" id="changeEmployee">
                                            <option value="">All</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                <div>
                                <div id="calendar" class="has-toolbar"></div> 
                                <div id='loading' class="spinner-border text-primary"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($loggedAdmin->type == 'superadmin' || $loggedAdmin->company->expense_feature == 1)
                {{-- <div class="col-md-6">
                    <div id="panel-3" class="panel">
                        <div class="panel-hdr">
                            <h2>{{ $loggedAdmin->company->currency_symbol }}
                                {{ trans('core.expenseReport') }}</h2>
                            <div class="panel-toolbar">
                                <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                    data-offset="0,10" data-original-title="Collapse"></button>
                                <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                    data-offset="0,10" data-original-title="Fullscreen"></button>
                            </div>
                        </div>
                        <div class="panel-container show">
                            <div class="panel-content">
                                <div id="expenseChart" style="width: 100%; height: 400px; margin: 0 auto"></div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            @endif
        </div>

        <div class="row ">
            <div class="col-md-6 col-sm-6">
                <div id="panel-2" class="panel">
                    <div class="panel-hdr">
                        <h2><i class="fa fa-users font-dark"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Employee Allocation
                            Detail
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
                        <div class="panel-content">
                            <div data-spy="scroll" data-target="#spyscroll-1" data-offset="0" class="overflow-auto"
                                style="height:250px">
                                @forelse($project_employees as $pm)
                                    <div class="d-flex flex-row w-100 p-1 p-sm-1 p-md-0 p-lg-1 p-xl-1">
                                        <div class="d-inline-block align-middle mr-3">
                                            @if($pm->profile_image != null)<img src="{{ $pm->profile_image }}" class="profile-image rounded-circle">@else  <img src="{{ $employee->profile_image_url }}" class="profile-image rounded-circle">@endif
                                        </div>
                                        <div class="mb-0 flex-1 text-dark">
                                            <div class="d-flex">
                                                <span class="text-primary">
                                                    {{ $pm->employee_name }}
                                                </span>
                                            </div>
                                            <p class="mb-0">
                                                will be release from  <span class="text-danger"> {{ $pm->project_name }}
                                                </span> by <span class="text-danger">{{ date('Y-M-d', strtotime($pm->end_date)) }} </span>
                                            </p>
                                            <hr>
                                        </div>

                                    </div>

                                @empty
                                    <p class="text-center" style="padding: 4px; margin-top: 26%;">
                                        No Allocation</p>
                                @endforelse

                            </div>

                            <div class="scroller-footer">
                                <div class="btn-arrow-link pull-right">
                                    <a
                                        href="{{ route('admin.project_allocation.index') }}">{{ trans('core.seeAll') }}</a>
                                    <i class="icon-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div id="panel-2" class="panel">
                    <div class="panel-hdr">
                        <h2><i class="fa fa-list-alt font-dark"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Project Due Date
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
                        <div class="panel-content">
                            <div data-spy="scroll" data-target="#spyscroll-1" data-offset="0" class="overflow-auto"
                                style="height:250px">
                                @forelse($projects as $p)
                                <div class="d-flex flex-row w-100 p-1 p-sm-1 p-md-0 p-lg-1 p-xl-1">
                                    <div class="d-inline-block align-middle mr-3">
                                        <img src="{{ URL::asset('admin_assets/img/clock.jpg') }}" class="profile-image rounded-circle">
                                    </div>
                                    <div class="mb-0 flex-1 text-dark">
                                        <div class="d-flex">
                                            <span class="text-primary">
                                                {{ $p->name }}
                                            </span>
                                        </div>
                                        <p class="mb-0">
                                            has completion date <span class="text-danger">  {{ date('Y-M-d', strtotime($p->end)) }}
                                            </span>
                                        </p>
                                        <hr>
                                    </div>

                                </div>
                                @empty
                                    <p class="text-center" style="padding: 4px; margin-top: 26%;">
                                        No Allocation</p>
                                @endforelse
                            </div>
                            <div class="scroller-footer">
                                <div class="btn-arrow-link pull-right">
                                    <a href="{{ route('admin.projects.index') }}">{{ trans('core.seeAll') }}</a>
                                    <i class="icon-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row ">
            <div class="col-md-6 col-sm-6">
                <div id="panel-2" class="panel">
                    <div class="panel-hdr">
                        <h2><i
                                class="fa fa-birthday-cake font-dark"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('core.' . date('F')) }}
                            {{ trans('core.birthdays') }} </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Fullscreen"></button>
                            {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div data-spy="scroll" data-target="#spyscroll-1" data-offset="0" class="overflow-auto"
                                style="height:250px">
                                @forelse($current_month_birthdays as $birthday)
                                    <div class="d-flex flex-row w-100 p-1 p-sm-1 p-md-0 p-lg-1 p-xl-1">
                                        <div class="d-inline-block align-middle mr-3">
                                            <img src="{{ $birthday->profile_image_url }}"
                                                class="profile-image rounded-circle" alt="Dr. Codex Lantern">
                                        </div>
                                        <div class="mb-0 flex-1 text-dark">
                                            <div class="d-flex">
                                                <span class="text-primary">
                                                    {{ $birthday->full_name }}
                                                </span>
                                            </div>
                                            <p class="mb-0">
                                                has birthday on <span
                                                    class="text-danger">{{ date('d F ', strtotime($birthday->date_of_birth)) }}</span>
                                            </p>
                                            <hr>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center" style="padding: 4px; margin-top: 26%;">
                                        {{ trans('messages.noBirthdays') }}</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($loggedAdmin->type == 'superadmin' || $loggedAdmin->company->award_feature == 1)
                <div class="col-md-6 col-sm-6">
                    <div id="panel-2" class="panel">
                        <div class="panel-hdr">
                            <h2><i
                                    class="fa fa-trophy font-dark"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('core.awards') }}
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
                            <div class="panel-content">
                                <div data-spy="scroll" data-target="#spyscroll-1" data-offset="0" class="overflow-auto"
                                    style="height:250px">
                                    @forelse($awards as $award)
                                        <div class="d-flex flex-row w-100 p-1 p-sm-1 p-md-0 p-lg-1 p-xl-1">
                                            <div class="d-inline-block align-middle  mr-3">
                                                <img src="{{ $award->employee->profile_image_url }}"
                                                    class="profile-image rounded-circle">
                                            </div>
                                            <div class="mb-0 flex-1 text-dark">
                                                <div class="d-flex">
                                                    <span class="text-primary">
                                                        {{ \Illuminate\Support\Str::words($award->employee->full_name, 1, '') }}
                                                    </span>
                                                </div>
                                                <p class="mb-0">
                                                    {{ $award->award_name }}
                                                    <span class="text-danger">
                                                        {{ date('Y-M-d', strtotime($award->created_at)) }}
                                                        {{-- {{ ucfirst($award->month) }}
                                                        {{ $award->year }} --}}
                                                    </span>
                                                </p>
                                                <hr>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-center" style="padding: 4px; margin-top: 26%;">
                                            {{ trans('messages.noAwards') }}</p>
                                    @endforelse
                                </div>

                                <div class="scroller-footer">
                                    <div class="btn-arrow-link pull-right">
                                        <a href="{{ route('admin.awards.index') }}">{{ trans('core.seeAll') }}</a>
                                        <i class="icon-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-md-12">
                <div id="panel-3" class="panel">
                    <div class="panel-hdr">
                        <h2>{{ $loggedAdmin->company->currency_symbol }}
                            {{ trans('core.expenseReport') }}</h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Fullscreen"></button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div id="expenseChart" style="width: 100%; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    @endif
    <!-- END DASHBOARD STATS -->
    <style>
    #loading {
		display: none;
		position: absolute;
		top: 10px;
		right: 10px;
	}    
    </style>
@stop


@section('page_js')
    @if ($loggedAdmin->company->license_expired == 0)
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {!! HTML::script('assets/global/plugins/highcharts/js/highcharts.js') !!}
        {!! HTML::script('assets/global/plugins/highcharts/js/modules/exporting.js') !!}

        <!-- Calander  -->
        <script>
            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var TODAY = todayDate.format('YYYY-MM-DD');
            var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');
            $empId = $('#changeEmployee').val();
            $url = '';
            if($empId == ''){
                $url = '{{ route('admin.attendance.ajax_load_calender') }}';
            }else{
                $url = '{{ route('admin.attendance.ajax_load_employee') }}';
            }

            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: ['dayGrid', 'list', 'timeGrid', 'interaction', 'bootstrap'],
                    themeSystem: 'bootstrap',
                    displayEventTime: false,
                    timeZone: 'local',
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
                    editable: true,
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
                            url: $url,
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                start: moment(info.start).format('YYYY-MM-DD'),
                                end: moment(info.end).format('YYYY-MM-DD'),
                                employee_id: $empId,
                            },
                            success: function(doc) {
                                const removeEvents = calendar.getEvents();
                                removeEvents.forEach(event => {
                                    event.remove();
                                }); 
                                var events = [];
                                if (!!doc) {
                                    $.map(doc, function(r) {
                                        if($empId != ''){
                                            if (r.a_status == "absent") {
                                                icon = 'no';
                                                type = 'attendance';
                                                bgcolor = '#ff9999';
                                                etitle = r.title + "-" + r.leaveType;
                                                eClassName = 'bg-danger border-danger text-white';
                                                allDay = false;
                                            } else if (r.a_status == "present") {
                                                icon = 'no';
                                                type = 'attendance';
                                                bgcolor = '';
                                                etitle = r.a_status;
                                                eClassName = 'bg-success border-success text-white';
                                                allDay = false;
                                            } else if (r.type == 'project') {
                                                icon = 'no';
                                                type = 'project';
                                                etitle = r.title + '[' + r.start_time +
                                                    ' - ' + r.end_time + ']';
                                                eClassName = 'project bg-info border-info text-white';
                                                if(r.start_date == r.end_date){
                                                    allDay = false;
                                                }else{
                                                    allDay = true;
                                                }
                                            } else if (r.type == 'birthday') {
                                                type = r.type;
                                                etitle = 'Birthday: '+r.title;
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
                                        }else{
                                            if (r.type == "attendance") {
                                                type = r.type;
                                                if (r.title == "all present") {
                                                    icon = 'fa-check';
                                                    etitle = r.title;
                                                    eClassName = 'bg-success border-success text-white';
                                                    allDay = true;
                                                } else {
                                                    icon = 'no';
                                                    etitle = r.title;
                                                    eClassName = 'bg-danger border-danger text-white';
                                                    allDay = true;
                                                }
                                            } else if (r.type == 'birthday') {
                                                type = r.type;
                                                etitle = r.title;
                                                bgcolor = '';
                                                allDay = false;
                                                eClassName = 'bg-warning border-warning text-white';
                                            } else {
                                                icon = 'no';
                                                type = 'holiday';
                                                etitle = r.title;
                                                bgcolor = '#ffa600';
                                                eClassName = 'bg-primary border-primary text-white';
                                                allDay = false;
                                            }
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
                    loading: function(bool) {
                        $('#loading').toggle(bool);
                    },
                    eventRender: function(info) {
                        $(info.el).tooltip({title: info.event.title});
                    },
                    eventDrop: function (info) {
                        $url = '{{ route('admin.project.update_employee_assign') }}';
                        let start = moment(info.event.start).format('YYYY-MM-DD');
                        let end = moment(info.event.end).subtract(1, 'days').format('YYYY-MM-DD');
                        if(info.event.classNames[0] == 'project'){
                            Swal.fire(
                            {
                                title: info.event.title + " Start Date : "+ start +" End Date : "+ end,
                                text: "You won't be able to revert this!",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonText: "Yes, update it!"
                            }).then(function(result)
                            {
                                if (result.value)
                                {
                                    $.ajax({
                                        url: $url,
                                        type: 'POST',
                                        dataType: 'json',
                                        data: {
                                            start: start,
                                            end: end,
                                            id: info.event.id,
                                        },
                                        success: function(res) {
                                            if(res.status == 'success'){
                                                toastr['success']('Updated successfully!');
                                            }
                                            if(res.status == 'error'){
                                                toastr['error'](res.message);
                                                info.revert();
                                            }
                                        },
                                        error: function(error) {
                                            console.log(error);
                                            info.revert();
                                        }
                                    });
                                }else{
                                    info.revert();
                                }
                            });
                        }else{
                            info.revert();
                        }
                    },
                    eventResize: function (info) {
                        $url = '{{ route('admin.project.update_employee_assign') }}';
                        let start = moment(info.event.start).format('YYYY-MM-DD');
                        let end = moment(info.event.end).subtract(1, 'days').format('YYYY-MM-DD');
                        if(info.event.classNames[0] == 'project'){
                            Swal.fire(
                            {
                                title: info.event.title + " Start Date = "+ start +" End Date = "+ end,
                                text: "You won't be able to revert this!",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonText: "Yes, update it!"
                            }).then(function(result)
                            {
                                if (result.value)
                                {
                                    $.ajax({
                                        url: $url,
                                        type: 'POST',
                                        dataType: 'json',
                                        data: {
                                            start: start,
                                            end: end,
                                            id: info.event.id,
                                        },
                                        success: function(res) {
                                            if(res.status == 'success'){
                                                toastr['success']('Updated successfully!');
                                            }
                                            if(res.status == 'error'){
                                                toastr['error'](res.message);
                                                info.revert();
                                            }
                                        },
                                        error: function(error) {
                                            console.log(error);
                                            info.revert();
                                        }
                                    });
                                }else{
                                    info.revert();
                                }
                            });
                        }else{
                            info.revert();
                        }
                    },

                });
                
                calendar.render();


                $(changeEmployee).on("change", function () {
                    
                    $('#loading').show();
                    // Remove all events
                    const removeEvents = calendar.getEvents();
                    removeEvents.forEach(event => {
                        event.remove();
                    }); 

                    var events = [];
                    $empId = $('#changeEmployee').val();
                    $url = '';
                    if($empId == ''){
                        $url = '{{ route('admin.attendance.ajax_load_calender') }}';
                    }else{
                        $url = '{{ route('admin.attendance.ajax_load_employee') }}';
                    }
                    $.ajax({
                            url: $url,
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                start: moment(calendar.view.activeStart).format('YYYY-MM-DD'),
                                end: moment(calendar.view.activeEnd).format('YYYY-MM-DD'),
                                employee_id: $empId,
                            },
                            success: function(doc) {
                                $('#loading').hide();
                                if (!!doc) {
                                    $.map(doc, function(r) {
                                        if($empId != ''){
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
                                                eClassName = 'project bg-info border-info text-white';
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
                                        }else{
                                            if (r.type == "attendance") {
                                                type = r.type;
                                                if (r.title == "all present") {
                                                    icon = 'fa-check';
                                                    etitle = r.title;
                                                    eClassName = 'bg-success border-success text-white';
                                                    allDay = true;
                                                } else {
                                                    icon = 'no';
                                                    etitle = r.title;
                                                    eClassName = 'bg-danger border-danger text-white';
                                                    allDay = true;
                                                }
                                            } else if (r.type == 'birthday') {
                                                type = r.type;
                                                etitle = r.title;
                                                bgcolor = '';
                                                allDay = false;
                                                eClassName = 'bg-warining border-warning text-white';
                                            } else {
                                                icon = 'no';
                                                type = 'holiday';
                                                etitle = r.title;
                                                bgcolor = '#ffa600';
                                                eClassName = 'bg-primary border-primary text-white';
                                                allDay = false;
                                            }
                                        }

                                        calendar.addEvent({
                                            className: eClassName,
                                            id: r.id,
                                            title: etitle,
                                            start: r.date,
                                            end: r.end,
                                            allDay: allDay
                                        });
                                    });
                                }
                            },    

                    });
                   
                    calendar.render();
                   
                });
                
                
            });

            
        </script>

        <script>
            $(function() {

                $('#expenseChart').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: '{{ trans('core.monthlyExpenseReport') }} ' + new Date().getFullYear()
                    },
                    xAxis: {
                        categories: [
                            '{{ trans('core.jan') }}',
                            '{{ trans('core.feb') }}',
                            '{{ trans('core.mar') }}',
                            '{{ trans('core.apr') }}',
                            '{{ trans('core.may') }}',
                            '{{ trans('core.june') }}',
                            '{{ trans('core.july') }}',
                            '{{ trans('core.aug') }}',
                            '{{ trans('core.sept') }}',
                            '{{ trans('core.oct') }}',
                            '{{ trans('core.nov') }}',
                            '{{ trans('core.dec') }}'
                        ],
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            useHTML: true,
                            text: '{{ trans('core.expense') }} ({!! $loggedAdmin->company->currency_symbol !!})'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:.1f} {{ $loggedAdmin->company->currency_symbol }}</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: '{{ trans('core.expense') }}',
                        data: [{!! $expense !!}]

                    }]
                });
            });
        </script>
        <script>
            $('.count').each(function() {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function(now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });
        </script>
    @endif
@stop
