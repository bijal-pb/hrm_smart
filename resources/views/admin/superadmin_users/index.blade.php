@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- {!! HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css") !!} -->
@stop


@section('content')

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
                {{$pageTitle}}
            </h1></div>
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
                <h2>
                    <i class="fal fa-list-alt"></i>&nbsp;&nbsp;&nbsp; Super Admin User<span class="fw-300"><i></i></span>
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                </div>
            </div>


            <div class="panel-container show">
                    
                                <a class="btn btn-primary float-right m-3" style="color:#fff;" onclick="showAdd();">
                                    {{trans('core.btnAddAdmin')}}
                                    <i class="fa fa-plus"></i> </a>
                     
                    <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" id="admins">
                        <thead class="bg-primary-600">
                        <tr>
                            <th> @lang("core.serialNo") </th>
                            <th> {{trans('core.name')}} </th>
                            <th> {{trans('core.email')}} </th>
                            <th> {{trans('core.createdOn')}} </th>
                            <th class="text-center"> {{trans('core.actions')}} </th>
                        </tr>
                        </thead>
        
                    </table>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>

    {{--EDIT  MODALS--}}

    <div id="static_edit" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" id="edit-form-body">
            <div class="modal-content">

                <div class="modal-body" id="edit-modal-body">
                </div>
            </div>

        </div>
    </div>


    @include('admin.common.delete')


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
            processing: true,
            serverSide: true,
            "ajax": "{{ URL::route("admin.ajax_superadmin_users") }}",
            "aaSorting": [[3, "desc"]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created_at'},
                {data: 'edit', name: 'edit'}
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

            $("#deleteModal").find('#info').html('Are you sure ! You want to delete?');

            $('#deleteModal').find("#delete").off().click(function () {

                var url = "{{ route('admin.superadmin_users.destroy',':id') }}";
                url = url.replace(':id', id);

                var token = "{{ csrf_token() }}";

                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {'_token': token},
                    container: "#deleteModal",
                    success: function (response) {
                        if (response.status === "success") {
                            $('#deleteModal').modal('hide');
                            table.fnDraw();
                        }
                    }
                });

            });
        }

        function showEdit(id) {
            var url = "{{ route('admin.superadmin_users.edit',':id') }}";
            url = url.replace(':id', id);
            $.ajaxModal('#showModal', url);

        }

        function showAdd() {
            var url = "{{ route('admin.superadmin_users.create') }}";
            $.ajaxModal('#showModal', url);

        }

        function addAdminSubmit() {

            url = "{{route('admin.superadmin_users.store')}}";
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '.ajax_form',
                data: $('.ajax_form').serialize(),
                success: function (response) {
                    if (response.status === "success") {
                        $('#showModal').modal('hide');
                        table.fnDraw();
                    }

                }
            });
        }

        function updateAdminSubmit(id) {
            var url = "{{ route('admin.superadmin_users.update',':id') }}";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'PUT',
                url: url,
                container: '.ajax_form',
                data: $('.ajax_form').serialize(),
                success: function (response) {
                    if (response.status === "success") {
                        $('#showModal').modal('hide');
                        table.fnDraw();
                    }

                }
            });
        }

    </script>
@stop
