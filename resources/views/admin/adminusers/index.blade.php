@extends('admin.adminlayouts.adminlayout')

@section('head')


    <!-- BEGIN PAGE LEVEL STYLES -->

    <!-- {!! HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css") !!} -->
    <!-- END PAGE LEVEL STYLES -->

@stop


@section('content')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
        <i class="fal fa-user"></i>
                {{$pageTitle}}
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <!-- <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">{{trans('core.dashboard')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">{{trans('core.settings')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">@lang("core.admins")</span>

            </li> -->

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">


            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="load">


            </div>
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                        <h2><i class="fal fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Admins<span class="fw-300"><i></i></span>
                        </h2>
                        <div class="panel-toolbar">
                                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                   <!-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}} -->
                                </div>
                 </div>
                 <div class="panel-container show">
                            <div class="col-md-12 form-group text-right">
                                <span id="load_notification"></span>
                                <input type="checkbox" onchange="ToggleEmailNotification('admin_add');return false;"
                                       class="make-switch" name="admin_add" @if($loggedAdmin->company->admin_add==1)checked
                                       @endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}"
                                       data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
                                <strong>{{trans('core.emailNotification')}}</strong><br>
                            </div>

               
                <button class="btn btn-primary float-right m-3" onclick="showAdd();"  data-toggle="modal" data-target="#default-example-modal">
                                    {{trans('core.btnAddAdmin')}}
                                    </button>
                    <div class="panel-content" >       
                       <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" id="admins">
                        <thead class="bg-primary-600">
                        <tr>
                            <th> @lang("core.serialNo") </th>
                            <th> {{trans('core.name')}} </th>
                            <th> {{trans('core.email')}} </th>
                            <th> type </th>
                            <th> {{trans('core.createdOn')}} </th>
                            <th class="text-center"> {{trans('core.actions')}} </th>
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

    {{--EDIT  MODALS--}}

    <!-- <div id="static_edit" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" id="edit-form-body">
            <div class="modal-content">

                <div class="modal-body" id="edit-modal-body">
                </div>
            </div>

        </div>
    </div> -->

    <div class="modal fade static_edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" id="showModal">
        <div class="modal-dialog">
            <div class="modal-content" id="edit-modal-body">
            </div>
        </div>
    </div>



    @include('admin.common.delete')

    @include('admin.adminusers.create')

@stop



@section('page_js')


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- {!!  HTML::script("assets/global/plugins/datatables/datatables.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js") !!}
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!} -->

    <!-- END PAGE LEVEL PLUGINS -->

    <script>


        var table = $('#admins').dataTable({
            {!! $datatabble_lang !!}
            responsive: true,
            processing: true,
            serverSide: true,
            stateSave: true,
            "ajax": "{{ URL::route("admin.ajax_admin_users") }}",
            "aaSorting": [[3, "desc"]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'type', name: 'type'},
                {data: 'created_at', name: 'created_at'},
                {data: 'edit', name: 'edit',orderable: false}
            ],
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            "sPaginationType": "full_numbers",
            "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                var oSettings = this.fnSettings();
                $("td:first", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);
                return nRow;
            },
            lengthChange: true,
                    dom: '<"float-left"B><"float-right"f>rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>',
                        // "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                        // "<'row'<'col-sm-12'tr>>" +
                        // "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    buttons: [
                        {
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

            $("#deleteModal").find('#info').html('Are you sure ! You want to delete?');

            $('#deleteModal').find("#delete").off().click(function () {

                var url = "{{ route('admin.admin_users.destroy',':id') }}";
                url = url.replace(':id', id);

                var token = "{{ csrf_token() }}";

                $.ajax({
                    type: 'DELETE',
                    url: url,
                    data: {'_token': token},
                    container: "#deleteModal",
                    success: function (response) {
                        if (response.status === "success") {
                            $('#deleteModal').modal('hide');
                            toastr['success']('Deleted successfully!');
                            window.location.reload();
                            // table.fnDraw();
                        }
                    }
                });

            });
        }

        function showEdit(id) {
            var url = "{{ route('admin.admin_users.edit',':id') }}";
            url = url.replace(':id', id);
            $('#showModal').modal('show',url);
            // $.ajaxModal('#showModal', url);

            $.ajax({
            type: 'GET',
            url: url,

            data: {},
            success: function(response) {
                $('#edit-modal-body').html(response);
            },

            error: function(xhr, textStatus, thrownError) {
                $('#edit-modal-body').html(
                    '<div class="alert alert-danger">Error Fetching data</div>');
            }
        });

        }

        function showAdd() {
            var url = "{{ route('admin.admin_users.create') }}";
            $('#showModal').modal('show',url);
            // $.ajaxModal('#showModal', url);

        }

        function addAdminSubmit() {
            $('#submitbutton_add').html('<span class="caption-subject font-red-sunglo bold uppercase" role="status" aria-hidden="true"></span>Loading...').attr('disabled', true);
            url = "{{route('admin.admin_users.store')}}";
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '#add_form',
                data: $('#add_form').serialize(),
            });
            $('#submitbutton_add').html('Submit').attr('disabled', false);

        }

        function updateAdminSubmit(id) {
            $('#submitbutton_edit').html('<span class="caption-subject font-red-sunglo bold uppercase" role="status" aria-hidden="true"></span>Loading...').attr('disabled', true);
            var url = "{{ route('admin.admin_users.update',':id') }}";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'PUT',
                url: url,
                container: '#edit_form',
                data: $('#edit_form').serialize(),
            });
            $('#submitbutton_edit').html('Submit').attr('disabled', false);
        }

    </script>
@stop
