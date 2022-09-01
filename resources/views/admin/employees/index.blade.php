@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <!-- {!! HTML::style('assets/global/plugins/select2/css/select2.css') !!}
        {!! HTML::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
        {!! HTML::style('assets/global/plugins/datatables/plugins/responsive/responsive.bootstrap.css') !!} -->
    <!-- END PAGE LEVEL STYLES -->

@stop


@section('content')


    <div class="page-head">
        <div class="page-title">
            <h1>
                <i class="fal fa-user-circle"></i>
                {{ trans('pages.employees.indexTitle') }}
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
                    <span class="active">{{ trans('pages.employees.indexTitle') }}</span>

                </li> -->

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        <i class="fal fa-user-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Employees<span class="fw-300"><i></i></span>
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
                    {{-- @if ($canCreateEmployee) --}}
                    <a href="{{ route('admin.employees.create') }} " class="btn btn-primary float-right m-3">
                        <span class="hidden-xs"> {{ trans('core.btnAddEmployee') }} </span>
                    </a>
                    {{-- @endif --}}

                    <div class="panel-content">



                        <!-- <a href="{{ route('admin.employees.export') }}" class="btn red">
                                            <i class="fa fa-file-excel-o"></i> <span
                                                    class="hidden-xs">{{ trans('core.export') }}</span>
                                        </a> -->
                        <!-- <button href="javascript:;" onclick="loadView('{{ route('admin.employees.import') }}')" class="btn btn-primary float-right m-3">
                                            <i class="fa fa-upload"></i> <span class="hidden-xs">{{ trans('core.importEmployees') }}</span></button> -->

                        <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline"
                            id="sample_employees">
                            <thead class="bg-primary-600">
                                <tr>
                                    <th class="text-center all">
                                        {{ trans('core.employeeID') }}
                                    </th>
                                    <th class="text-center min-tablet">
                                        {{ trans('core.image') }}
                                    </th>
                                    <th style="text-align: center" class="all">
                                        {{ trans('core.name') }}
                                    </th>
                                    <th class="text-center min-desktop">
                                        {{ trans('core.department') }}
                                    </th>
                                    <th class="text-center min-desktop">
                                        {{ trans('core.designation') }}
                                    </th>
                                    <th class="text-center min-desktop">
                                        {{ trans('core.atWork') }}
                                    </th>

                                    <th class="text-center min-desktop">
                                        {{ trans('core.status') }}
                                    </th>
                                    <th class="never">Created AT</th>
                                    <th class="text-center min-tablet">
                                        {{ trans('core.actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->

                </div>
                <!-- END PAGE CONTENT-->

                {{-- MODAL CALLING --}}
                @include('admin.common.delete')
                {{-- MODAL CALLING END --}}

                <div id="empAddWarningModal" class="modal fade" tabindex="-1" data-backdrop="static"
                    data-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true"></button>
                                <h4 class="modal-title">{{ trans('core.confirmation') }}</h4>
                            </div>
                            <div class="modal-body" id="addEmployeeInfo">
                                <p>
                                    {{ trans('messages.addNewEmployeeWarning') }}
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal"
                                    class="btn dark btn-outline">{{ trans('core.btnCancel') }}</button>
                                <a href="javascript: ;" onclick="confirmAddEmployee()" class="btn green">
                                    <span class="hidden-xs"> {{ trans('core.btnConfirm') }} </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @stop


            @section('page_js')


                <!-- BEGIN PAGE LEVEL PLUGINS -->
                <!-- {!! HTML::script('assets/global/plugins/select2/js/select2.min.js') !!}
        {!! HTML::script('assets/global/plugins/datatables/datatables.min.js') !!}
        {!! HTML::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
        {!! HTML::script('assets/global/plugins/datatables/plugins/responsive/dataTables.responsive.js') !!}
        {!! HTML::script('assets/global/plugins/datatables/plugins/responsive/responsive.bootstrap.js') !!} -->

                <!-- END PAGE LEVEL PLUGINS -->
                <script>
                    var total = "{{ $total }}";
                    // begin first table
                    var table = $('#sample_employees').dataTable({
                        {!! $datatabble_lang !!}
                        responsive: true,
                        processing: true,
                        serverSide: true,
                        // stateSave: true,
                        "ajax": "{{ route('admin.ajax_employees') }}",
                        columns: [{
                                data: 'employeeID',
                                name: 'employeeID',
                                "bSortable": true,
                                width: "80px"
                            },
                            {
                                data: 'profile_image',
                                name: 'profile_image',
                                "bSortable": false,
                                "searchable": false
                            },
                            {
                                data: 'full_name',
                                name: 'full_name',
                                "bSortable": true
                            },
                            {
                                data: 'name',
                                name: 'name',
                                "bSortable": true
                            },
                            {
                                data: 'designation',
                                name: 'designation',
                                "bSortable": true
                            },
                            {
                                data: 'work',
                                name: 'work',
                                "bSortable": false
                            },
                            {
                                data: 'status',
                                name: 'status',
                                "bSortable": true
                            },
                            {
                                data: 'created_at',
                                name: 'created_at',
                                "bSortable": false,
                                width: "150px"
                            },
                            {
                                data: 'edit',
                                name: 'edit',
                                "bSortable": false
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


                    function del(id, name) {

                        $('#deleteModal').modal('show');

                        var confirmMsg = '{!! trans('messages.deleteConfirm', ['name' => ':name']) !!}';
                        confirmMsg = confirmMsg.replace(":name", name);

                        $("#deleteModal").find('#info').html(confirmMsg);

                        $('#deleteModal').find("#delete").off().click(function() {

                            var url = "{{ route('admin.employees.destroy', ':id') }}";
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
                                        toastr['success']('Employee deleted successfully!');
                                        $('#sample_employees').DataTable().ajax.reload();
                                    }
                                }
                            });

                        });
                    }


                    function addEmployee() {
                        var planUser = '{{ admin()->company->subscriptionPlan->end_user_count }}';
                        if (parseInt(planUser) >= parseInt(total)) {
                            loadView('{{ route('admin.employees.create') }}')

                        } else {
                            $('#empAddWarningModal').modal('show');
                        }
                    }

                    function confirmAddEmployee() {
                        $('#empAddWarningModal').modal('hide');
                        loadView('{{ route('admin.billing.change_plan') }}');
                    }
                </script>
            @stop
