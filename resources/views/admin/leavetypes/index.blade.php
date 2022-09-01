@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    <!-- {!! HTML::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
            {!! HTML::style('assets/global/plugins/datatables/plugins/responsive/responsive.bootstrap.css') !!} -->
@stop

@section('content')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title">
            <h1>
                <i class="fa fa-sitemap"></i>
                {{ trans('core.leaveTypes') }}
            </h1>
        </div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <!-- <li>
                        <a onclick="loadView('{{ route('admin.dashboard.index') }}')">@lang('core.dashboard')</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span class="active">{{ trans('pages.leaveTypes.indexTitle') }}</span> -->

            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->

    <div id="load">
        {{-- INLCUDE ERROR MESSAGE BOX --}}

        {{-- END ERROR MESSAGE BOX --}}
    </div>
    <!-- BEGIN PAGE CONTENT-->

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="panel-5" class="panel">
                <div class="panel-hdr">
                    <h2><i class="fa fa-sitemap"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@lang('Leave Types')</h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                            data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                            data-offset="0,10" data-original-title="Fullscreen"></button>
                        {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                    </div>
                </div>

                <div class="panel-container show">
                    <!-- <button class="btn btn-primary float-right m-3"  type="button" id="btn-add" data-toggle="modal" data-target="#default-example-modal" onclick="showAdd()">  @lang('core.leaveTypes')<i class="fa fa-plus"></i> </button> -->
                    {{-- <button type="button" id="btn-add" class="btn btn-primary float-right m-3" data-toggle="modal" data-target="#default-example-modal" onclick="showAdd()">Add Leave Types</button> --}}
                    <button class="btn btn-primary float-right m-3" onclick="showAdd();">
                        Add Leave Types
                    </button>
                    <div class="panel-content">
                        <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" r"
                            id="leaveType">
                            <thead class="bg-primary-600">
                                <tr>
                                    <th> @lang('core.leave') </th>
                                    <th> @lang('core.leaveNumber') </th>
                                    <th> @lang('core.action') </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>
        </div>

        <div class="modal fade add_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
            id="showModal">
            <div class="modal-dialog">
                <div class="modal-content" id="leave-type-content">
                </div>
            </div>
        </div>

        <div class="modal fade edit_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
            id="data-model">
            <div class="modal-dialog">
                <div class="modal-content" id="leave-type-edit-content">
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT-->

        {{-- MODAL CALLING --}}
        @include('admin.common.delete')

        {{-- MODAL CALLING END --}}

    @stop


    @section('page_js')

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- {!! HTML::script('assets/global/plugins/datatables/datatables.min.js') !!}
            {!! HTML::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
            {!! HTML::script('assets/global/plugins/datatables/plugins/responsive/dataTables.responsive.js') !!}
            {!! HTML::script('assets/global/plugins/datatables/plugins/responsive/responsive.bootstrap.js') !!} -->

        <!-- END PAGE LEVEL PLUGINS -->

        <script>
            var table = $('#leaveType').dataTable({
                responsive: true,
                stateSave: true,
                "cache": true,
                "bProcessing": true,
                "bServerSide": true,
                "bDestroy": true,
                "order": [
                    [1, "asc"]
                ],
                "ajax": "{{ URL::route('admin.leavetypes.ajax_list') }}",
                "aoColumns": [{
                        data: 'leaveType',
                        name: 'leaveType'
                    },
                    {
                        data: 'num_of_leave',
                        name: 'num_of_leave'
                    },
                    {
                        data: 'edit',
                        name: 'edit',
                        orderable: false
                    },
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

            // Show Delete Modal
            function del(id, name) {

                $('#deleteModal').modal('show');

                $("#deleteModal").find('#info').html('Are you sure ! You want to delete <strong>' + name + '</strong> ?');

                $('#deleteModal').find("#delete").off().click(function() {

                    var url = "{{ route('admin.leavetypes.destroy', ':id') }}";
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
                            if (response.status == "success") {
                                toastr['success']('Deleted successfully!');
                                $('#deleteModal').modal('hide');
                                $('#leaveType').DataTable().ajax.reload();
                            }
                        }
                    });

                });
            }

            function showEdit(id, leaveType, num) {
                var url = "{{ route('admin.leavetypes.edit', ':id') }}";
                url = url.replace(':id', id);
                $('#data-model').modal('show', url);

                $("#edit_leaveType").val(leaveType);
                $("#edit_num_of_leave").val(num);

                $.ajax({
                    type: 'GET',
                    url: url,

                    data: {},
                    success: function(response) {
                        $('#leave-type-edit-content').html(response);
                    },

                    error: function(xhr, textStatus, thrownError) {
                        $('#leave-type-edit-content').html(
                            '<div class="alert alert-danger">Error Fetching data</div>');
                    }
                });
            }

            function showAdd() {
                var url = "{{ route('admin.leavetypes.create') }}";
                $('#showModal').modal('show', url);

                $.ajax({
                    type: 'GET',
                    url: url,

                    data: {},
                    success: function(response) {
                        $('#leave-type-content').html(response);
                    },

                    error: function(xhr, textStatus, thrownError) {
                        $('#leave-type-content').html(
                            '<div class="alert alert-danger">Error Fetching data</div>');
                    }
                });


            }

            function addSubmit() {
                $('#submitbutton_add').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Loading...').attr('disabled', true);
                $.easyAjax({
                    type: 'POST',
                    url: "{{ route('admin.leavetypes.store') }}",
                    container: '.ajax_form',
                    data: $('.ajax_form').serialize(),
        
                });
                $('#submitbutton_add').html('Submit').attr('disabled', false);
            }

            function updateSubmit(id) {
                $('#edit_submit').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Loading...').attr('disabled', true);
                var url = "{{ route('admin.leavetypes.update', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: 'PUT',
                    url: url,
                    container: '.ajax_form',
                    data: $('.ajax_form').serialize(),
                });
                $('#edit_submit').html('Submit').attr('disabled', false);
            }

            // function addUpdateLeaveType(id) {

            //     if (typeof id != 'undefined') {
            //         var url = "{{ route('admin.leavetypes.update', ':id') }}";
            //         url = url.replace(':id', id);
            //     } else {
            //         url = "{{ route('admin.leavetypes.store') }}";
            //     }
            //     $.easyAjax({
            //         type: 'POST',
            //         url: url,
            //         container: '#leave_type_update_form',
            //         data: $('#leave_type_update_form').serialize(),
            //         success: function (response) {
            //             if (response.status == "success") {
            //                 $('#showModal').modal('hide');
            //                 table.fnDraw();
            //             }

            //         }
            //     });
            // }
        </script>
    @stop
