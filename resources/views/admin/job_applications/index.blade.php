@extends('admin.adminlayouts.adminlayout')

@section('head')


    <!-- BEGIN PAGE LEVEL STYLES -->
    <!-- {!! HTML::style('assets/global/plugins/select2/css/select2.css') !!}
            {!! HTML::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
            {!! HTML::style('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!} -->
    <!-- END PAGE LEVEL STYLES -->

@stop


@section('content')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title">
            <h1>
                <i class="fal fa-clipboard-check"></i>
                @lang("pages.jobApplications.indexTitle")
            </h1>
        </div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <!-- <li>
                        <a onclick="loadView('{{ route('admin.dashboard.index') }}')">{{ __('core.dashboard') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span class="active">@lang("pages.jobApplications.indexTitle")</span>
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
            <div id="panel-5" class="panel">
                <div class="panel-hdr">
                    <h2> <i class="fal fa-clipboard-check"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@lang('Job Applications')
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                            data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                            data-offset="0,10" data-original-title="Fullscreen"></button>
                        {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10"
                            data-original-title="Close"></button> --}}
                    </div>
                </div>


                <div class="panel-container show">
                    <div class="panel-content">
                        <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" id="jobs">
                            <thead class="bg-primary-600">
                                <tr>
                                    <th> @lang("core.serialNo")</th>
                                    <th> {{ trans('core.position') }} </th>

                                    <th> {{ trans('core.name') }} </th>
                                    <th> {{ trans('core.email') }} </th>
                                    <th> {{ trans('core.phone') }} </th>
                                    <th> {{ trans('core.appliedOn') }} </th>
                                    <th> {{ trans('core.submittedBy') }} </th>
                                    <th> {{ trans('core.status') }} </th>
                                    <th> {{ trans('core.action') }} </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>

    <div class="modal fade show_notice" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
        id="modal-data">
        <div class="modal-dialog">
            <div class="modal-content" id="leave-application-content">
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
    @include('admin.common.delete')
    @include('admin.common.show-modal')
@stop



@section('page_js')


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- {!! HTML::script('assets/global/plugins/select2/js/select2.min.js') !!}
            {!! HTML::script('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
            {!! HTML::script('assets/global/plugins/datatables/datatables.min.js') !!}
            {!! HTML::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
            {!! HTML::script('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!} -->


    <!-- END PAGE LEVEL PLUGINS -->

    <script>
        var table = $('#jobs').dataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: "{{ URL::route('admin.ajax_jobs_applications') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'position',
                    name: 'position'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone',
                    orderable: false
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'full_name',
                    name: 'full_name'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'edit',
                    name: 'edit',
                    orderable: false
                },
            ],

            // "language": {},
            // "fnInitComplete": function (oSettings, json) {
            //     App.init();
            // },
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



        function del(id) {

            $('#deleteModal').modal('show');
            $("#deleteModal").find('#info').html('@lang("messages.jobApplicationsDeleteConfirm")');

            $('#deleteModal').find("#delete").off().click(function() {

                var url = "{{ route('admin.job_applications.destroy', ':id') }}";
                url = url.replace(':id', id);

                var token = "{{ csrf_token() }}";

                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {
                        '_token': token
                    },
                    container: "#deleteModal",
                    success: function(response) {
                        if (response.status === "success") {
                            $('#deleteModal').modal('hide');
                            table.fnDraw();
                        }
                    }
                });

            });

        }

        function changeStatus(id, status) {


            $.easyAjax({
                type: 'POST',
                url: "{{ route('admin.job_applications.change_status') }}",
                container: '.page-content',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    if (response.status === "success") {
                        table.fnDraw();
                    }
                }
            });
        }

        function showView(id) {
            var get_url = "{{ route('admin.job_applications.show', ':id') }}";
            get_url = get_url.replace(':id', id);
            $('#modal-data').modal('show', get_url);
            // $.ajaxModal('#showModal', get_url);

            $.ajax({
                type: 'GET',
                url: get_url,

                data: {},
                success: function(response) {
                    $('#leave-application-content').html(response);
                },

                error: function(xhr, textStatus, thrownError) {
                    $('#leave-application-content').html(
                        '<div class="alert alert-danger">Error Fetching data</div>');
                }
            });
        }

           function addUpdateLeaveType(id) {

            if (typeof id != 'undefined') {
                var url = "{{ route('admin.leavetypes.update',':id') }}";
                url = url.replace(':id', id);
            } else {
                url = "{{route('admin.leavetypes.store')}}";
            }
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '#leave_type_update_form',
                data: $('#leave_type_update_form').serialize(),
                success: function (response) {
                    if (response.status == "success") {
                        $('#showModal').modal('hide');
                        table.fnDraw();
                    }

                }
            });
        }
    </script>
@stop
