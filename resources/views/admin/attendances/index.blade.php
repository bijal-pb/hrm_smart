@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->
    {{-- {!! HTML::style('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') !!}
    {!! HTML::style('assets/global/plugins/select2/css/select2.css') !!}
    {!! HTML::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!} --}}
    <!-- END PAGE LEVEL STYLES -->
    <style>
        .btn.active {
            opacity: 2 !important;
        }

    </style>
@stop


@section('content')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <!-- <div class="page-title"><h1>
                        @lang("pages.attendances.indexTitle")
                    </h1></div> -->
        <div class="page-toolbar">
            <!-- BEGIN THEME PANEL -->
            <!-- <div class="btn-theme-panel">
                        <a onclick="loadView('{{ route('admin.attendances.index') }}')" class="btn {{ isset($viewAttendanceActive) ? $viewAttendanceActive : '' }}">
                            <i class="fa fa-th"></i>
                        </a>
                        <a onclick="loadView('{{ route('admin.attendance.employee') }}')" class="btn {{ isset($viewAttendanceEmployeeActive) ? $viewAttendanceEmployeeActive : '' }}">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div> -->
            <!-- END THEME PANEL -->
        </div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <!-- <li>
                        <a onclick="loadView('{{ route('admin.dashboard.index') }}')">{{ trans('core.dashboard') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span class="active">@lang("pages.attendances.indexTitle")</span>
                    </li> -->

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->

    <div class="page-head">
        <div class="page-title">
            <h1>
                <i class="fal fa-user-check"></i>
               Attendance
            </h1>
        </div>
        <div class="page-toolbar">
            <!-- BEGIN THEME PANEL -->
            <!-- <div class="btn-theme-panel">
                        <a onclick="loadView('{{ route('admin.attendances.index') }}')" class="btn {{ isset($viewAttendanceActive) ? $viewAttendanceActive : '' }}">
                            <i class="fa fa-th"></i>
                        </a>
                        <a onclick="loadView('{{ route('admin.attendance.employee') }}')" class="btn {{ isset($viewAttendanceEmployeeActive) ? $viewAttendanceEmployeeActive : '' }}">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div> -->
            <!-- END THEME PANEL -->
        </div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <!-- <li>
                        <a onclick="loadView('{{ route('admin.dashboard.index') }}')">{{ trans('core.dashboard') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span class="active">@lang("pages.attendances.indexTitle")</span>
                    </li> -->

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="load">

                @if (Session::get('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

            </div>

            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        <i class="fal fa-user-check"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Attendance<span class="fw-300"><i></i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                            data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                            data-offset="0,10" data-original-title="Fullscreen"></button>
                        {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                    </div>
                </div><br>
                <div class="btn-theme-panel">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="{{ route('admin.attendances.index') }}"
                        class="btn {{ isset($viewAttendanceActive) ? $viewAttendanceActive : '' }}">
                        <i class="fal fa-th"></i>
                    </a>
                    <a href="{{ route('admin.attendance.employee') }}"
                        class="btn {{ isset($viewAttendanceEmployeeActive) ? $viewAttendanceEmployeeActive : '' }}">
                        <i class="fal fa-bars"></i>
                    </a>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="table-toolbar margin-top-15">
                            <div class="row">
                                <div class="col-md-4">
                                    {!! Form::open(['route'=>["admin.attendances.create"], 'method'=>'GET', 'class' => "form-inline"]) !!}
                                    <div class="btn-group">
                                        <div class="input-group input-medium date date-picker"
                                             data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                            <input type="text" class="form-control" name="date"
                                                   placeholder="@lang("core.selectDate")"
                                                   readonly>
                                            <span class="input-group-btn">
                                                                   <button class="btn btn-default" type="button"><i
                                                                               class="fa fa-calendar"></i></button>
                                                                   </span>
                                        </div>
                                    </div><br>
                                   <br><button class="btn btn-default" type="submit">{{trans('core.btnSubmit')}}</button>
                                    {!! Form::close() !!}
                                </div>
                                <div class="col-md-4">

                                </div>
                                <div class="col-md-4">
                                    <div class="btn-group pull-right">
                                        <a href="{{ route('admin.attendances.create') }}" data-loading-text="@lang("
                                            core.redirecting")..." class="btn btn-primary">
                                            {{ trans('core.markToday') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div><br><br>
                        <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline"
                            id="sample_1">
                            <thead class="bg-primary-600">
                                <tr>
                                    <th> @lang("core.employeeID") </th>
                                    <th class="text-center"> {{ trans('core.image') }} </th>
                                    <th> {{ trans('core.name') }} </th>
                                    <th> {{ trans('core.lastAbsent') }} </th>
                                    <th> {{ trans('core.leaves') }} </th>
                                    <th> {{ trans('core.annualOrCredit') }} </th>
                                    <th> {{ trans('core.status') }}</th>
                                    <th> {{ trans('core.action') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>
    <!-- END PAGE CONTENT-->

    {{-- MODAL CALLING --}}
    @include('admin.common.delete')
    {{-- MODAL CALLING END --}}

@stop


@section('page_js')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {{-- {!! HTML::script('assets/global/plugins/select2/js/select2.min.js') !!}
    {!! HTML::script('assets/global/plugins/datatables/datatables.min.js') !!}
    {!! HTML::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
    {!! HTML::script('assets/admin/pages/scripts/table-managed.js') !!}
    {!! HTML::script('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
    {!! HTML::script('assets/admin/pages/scripts/components-pickers.js') !!} --}}

    <!-- END PAGE LEVEL PLUGINS -->

    <script>
        $(document).ready(function() {
             ComponentsPickers.init();
            // begin first table
            var table = $('#sample_1').dataTable({
                {!! $datatabble_lang !!}
                responsive: true,
                processing: true,
                serverSide: true,
                stateSave: true,
                "aaSorting": [
                    [2, "asc"]
                ],
                "ajax": "{{ route('admin.attendance.ajax_employees') }}",
                "columns": [{
                        data: 'employeeID',
                        name: 'employees.employeeID',
                        searchable: true
                    },
                    {
                        data: 'profile_image',
                        name: 'employees.profile_image',
                        searchable: false
                    },
                    {
                        data: 'full_name',
                        name: 'employees.full_name'
                    },
                    {
                        data: 'last_absent',
                        name: 'last_absent',
                        searchable: false
                    },
                    {
                        data: 'leave_types',
                        name: 'leaves',
                        searchable: false
                    },
                    {
                        data: 'annual_leave',
                        name: 'annual_leave'
                    },
                    {
                        data: 'status',
                        name: 'employees.status'
                    },
                    {
                        data: 'edit',
                        name: 'edit',
                        orderable: false
                    }
                ],
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

        });

        $(document).ready(function(){

        $('#date_change').datepicker({
            format: "dd-mm-yyyy",
            todayHighlight: true,
            toggleActive: true,
            autoclose: true
        }).on('changeDate', function(e) {
            var url = "{{ route('admin.attendances.edit', '#id') }}";
            var date = moment($('#attendence_date').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
            url = url.replace("#id", date);
            $('#attendence_date').load(url)
            loadView(url);
        });
    });
    </script>

@stop
