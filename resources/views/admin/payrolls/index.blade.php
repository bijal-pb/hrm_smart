@extends('admin.adminlayouts.adminlayout')

@section('head')


    <!-- BEGIN PAGE LEVEL STYLES -->
    <!-- {!! HTML::style('assets/global/plugins/select2/css/select2.css') !!}
        {!! HTML::style('assets/global/plugins/select2/css/select2-bootstrap.min.css') !!}
        {!! HTML::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!} -->
    <!-- END PAGE LEVEL STYLES -->

@stop


@section('content')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title">
            <h1>
                <i class="fal fa-rupee-sign"></i>
                @lang("pages.payroll.indexTitle")
            </h1>
        </div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <!-- <li>
                    <a onclick="{{ route('admin.dashboard.index') }}">{{ trans('core.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">@lang("pages.payroll.indexTitle")</span>
                </li> -->

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->

    <div class="row">
        <div class="col-md-12">


            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="load">

                {{-- INLCUDE ERROR MESSAGE BOX --}}

                {{-- END ERROR MESSAGE BOX --}}

            </div>
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        <i class="fal fa-rupee-sign"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Payroll

                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                            data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                            data-offset="0,10" data-original-title="Fullscreen"></button>
                        {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                    </div>
                </div><br>
                <div class="col-md-3">
                    <select class="form-control select2" name="employee_id" id="employeeID">
                        <option value="all">@lang('core.selectEmployee')</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->full_name }} (@lang('core.empId'):
                                {{ $employee->employeeID }})</option>
                        @endforeach
                    </select>
                </div><br>
                <div class="panel-container show">
                    <div class="col-md-12 form-group text-right">
                        <div class="col-md-3">
                            <a href="" class="btn btn-success"
                                onclick="showReportModal();return false;">@lang("core.monthlyExcelReport") <i
                                    class="fa fa-download"></i> </a>
                        </div>

                        <span id="load_notification"></span>
                        <input type="checkbox" onchange="ToggleEmailNotification('payroll_notification');return false;"
                            class="make-switch" name="payroll_notification"
                            @if ($loggedAdmin->company->payroll_notification == 1) checked @endif data-on-color="success"
                            data-on-text="{{ trans('core.btnYes') }}" data-off-text="{{ trans('core.btnNo') }}"
                            data-off-color="danger">
                        <strong>{{ trans('core.emailNotification') }}</strong><br>
                    </div>




                    <a class="btn btn-primary float-right m-3" href="{{ route('admin.payrolls.create') }}">
                        {{ trans('core.btnAddPayroll') }}
                    </a>
                    <div class="panel-content">
                        <table class="table table-striped table-responsive-sm table-bordered table-hover" id="payroll">
                            <thead class="bg-primary-600">
                                <tr>
                                    <th> @lang("core.serialNo")</th>
                                    <th> {{ trans('core.employeeID') }} </th>
                                    <th> {{ trans('core.name') }} </th>
                                    <th> {{ trans('core.month') }} - {{ trans('core.year') }} </th>
                                    <th> @lang("core.netSalary") ({{ $loggedAdmin->company->currency_symbol }})</th>
                                    <th> {{ trans('core.createdOn') }} </th>
                                    <th> {{ trans('core.status') }} </th>
                                    <th class="text-center" width="36%"> {{ trans('core.action') }} </th>
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

    {{-- Select Year and month modal --}}

    <div id="reportModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <div class="d-block position-absolute pos-top pos-left p-2 ">
                        <h4 class="modal-title">@lang("core.selectMonthAndYear")</h4>
                    </div>
                </div>
                {!! Form::open(['route' => 'admin.payroll_report', 'class' => 'form-horizontal', 'method' => 'POST', 'id' => 'salary-form']) !!}
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-9">
                                    <select class="form-control" name="month" id="month">
                                        <option value="1" @if (1 == date('n')) selected="selected" @endif>
                                            {{ trans('core.January') }}</option>
                                        <option value="2" @if (2 == date('n')) selected="selected" @endif>
                                            {{ trans('core.February') }}</option>
                                        <option value="3" @if (3 == date('n')) selected="selected" @endif>
                                            {{ trans('core.March') }}</option>
                                        <option value="4" @if (4 == date('n')) selected="selected" @endif>
                                            {{ trans('core.April') }}</option>
                                        <option value="5" @if (5 == date('n')) selected="selected" @endif>
                                            {{ trans('core.May') }}</option>
                                        <option value="6" @if (6 == date('n')) selected="selected" @endif>
                                            {{ trans('core.june') }}</option>
                                        <option value="7" @if (7 == date('n')) selected="selected" @endif>
                                            {{ trans('core.July') }}</option>
                                        <option value="8" @if (8 == date('n')) selected="selected" @endif>
                                            {{ trans('core.August') }}</option>
                                        <option value="9" @if (9 == date('n')) selected="selected" @endif>
                                            {{ trans('core.September') }}</option>
                                        <option value="10" @if (10 == date('n')) selected="selected" @endif>
                                            {{ trans('core.October') }}</option>
                                        <option value="11" @if (11 == date('n')) selected="selected" @endif>
                                            {{ trans('core.November') }}</option>
                                        <option value="12" @if (12 == date('n')) selected="selected" @endif>
                                            {{ trans('core.December') }}</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-9">
                                    {!! Form::selectYear('year', 2013, date('Y') + 1, date('Y'), ['class' => 'form-control', 'id' => 'year']) !!}
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal"
                        class="btn btn-dark btn-outline">{{ trans('core.btnCancel') }}</button>
                    <button type="submit" class="btn btn-primary" id="report"><i class="fa fa-download"></i>
                        @lang("core.download")</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


    {{-- Select Year and month modal --}}
@stop



@section('page_js')


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- {!! HTML::script('assets/global/plugins/select2/js/select2.min.js') !!}
        {!! HTML::script('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
        {!! HTML::script('assets/global/plugins/datatables/datatables.min.js') !!}
        {!! HTML::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
        {{-- {!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/jquery.dataTables.columnFilter.js")!!} --}} -->

    <!-- END PAGE LEVEL PLUGINS -->

    <script>
        $(function(e) {
            loadTable();

            $('#employeeID').on('change', function() {
                loadTable();
            })

        });

        // $.fn.select2.defaults.set("theme", "bootstrap");
        $('.select2me').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: false
        });



        function loadTable() {
            var employee_id = $('#employeeID').val();

            var table = $('#payroll').dataTable({
                {!! $datatabble_lang !!}
                processing: true,
                responsive:true,
                serverSide: true,
                destroy: true,
                stateSave: true,
                "ajax": "{!! route('admin.ajax_payrolls') !!}?employee_id=" + employee_id,
               
                "columns": [{
                        data: 's_id',
                        name: 's_id',
                       
                    },
                    {
                        data: 'employeeID',
                        name: 'employees.employeeID',
                        searchable: false
                    },
                    {
                        data: 'full_name',
                        name: 'full_name',
                        searchable: true
                    },
                    {
                        data: 'year',
                        name: 'year',
                        searchable: true,
                        sortable: false,
                    },
                    {
                        data: 'net_salary',
                        name: 'net_salary',
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        searchable: false
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        sortable: false,
                        searchable: false
                    }
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
        }

        function showReportModal() {
            $('#reportModal').appendTo("body").modal('show');
        }


        function del(id, title) {

            $('#deleteModal').modal('show');
            $("#deleteModal").find('#info').html('@lang("messages.payrollDeleteConfirm")');

            $('#deleteModal').find("#delete").off().click(function() {

                var url = "{{ route('admin.payrolls.destroy', ':id') }}";
                url = url.replace(':id', id);

                var token = "{{ csrf_token() }}";

                $.ajax({
                    type: 'DELETE',
                    url: url,
                    data: {
                        '_token': token
                    },
                    container: "#deleteModal",
                    success: function(response) {
                        if (response.status === "success") {
                            $('#deleteModal').modal('hide');
                            toastr['success']('Jobbs deleted successfully!');
                            $('#payroll').DataTable().ajax.reload();
                            
                        }
                    }
                });

            });


        }
    </script>
@stop
