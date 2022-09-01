@extends('admin.adminlayouts.adminlayout')

@section('head')


    <!-- BEGIN PAGE LEVEL STYLES -->
    <!-- {!! HTML::style('assets/global/plugins/select2/css/select2.css') !!}
        {!! HTML::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!} -->
    <!-- END PAGE LEVEL STYLES -->

@stop


@section('content')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title">
            <h1>
                <i class="fal fa-quote-left"></i>
                @lang("pages.noticeBoard.indexTitle")
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
                    <span class="active">@lang("pages.noticeBoard.indexTitle")</span>
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
                        <i class="fal fa-quote-left"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Noticeboard

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
                <div class="col-md-12 form-group text-right">

                    <span id="load_notification"></span>
                    <input type="checkbox" onchange="ToggleEmailNotification('notice_notification');return false;"
                        class="make-switch" name="notice_notification" @if ($loggedAdmin->company->notice_notification == 1)checked
                    @endif data-on-color="success" data-on-text="{{ trans('core.btnYes') }}"
                    data-off-text="{{ trans('core.btnNo') }}" data-off-color="danger">
                    <strong>{{ trans('core.emailNotification') }}</strong>
                </div>


                
                    <a class="btn btn-primary float-right m-3" href="{{ route('admin.noticeboards.create') }} ">
                        {{ trans('core.btnAddNotice') }}
                    </a>
                    <div class="panel-content">

                        <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" id="notices">
                            <thead class="bg-primary-600">
                                <tr>
                                    <th> @lang("core.serialNo") </th>
                                    <th> {{ trans('core.title') }} </th>
                                    <th> {{ trans('core.description') }} </th>
                                    <th> {{ trans('core.status') }} </th>
                                    <th> {{ trans('core.createdOn') }} </th>
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
    <!-- END PAGE CONTENT-->

    {{-- MODAL CALLING --}}
    @include('admin.common.delete')
    {{-- MODAL CALLING END --}}
@endsection



@section('page_js')


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- {!! HTML::script('assets/global/plugins/select2/js/select2.min.js') !!}
        {!! HTML::script('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
        {!! HTML::script('assets/global/plugins/datatables/datatables.min.js') !!}
        {!! HTML::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!} -->

    <!-- END PAGE LEVEL PLUGINS -->

    <script>
        var table = $('#notices').dataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            stateSave: true,
            {!! $datatabble_lang !!} 
            "ajax": "{{ URL::route('admin.ajax_notices') }}",

            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'description',
                    name: 'description',
                    orderable: false
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'edit',
                    name: 'edit',
                    orderable: false
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


        function del(id) {

            $('#deleteModal').modal('show');

            $("#deleteModal").find('#info').html('Are you sure ! You want to delete ?');

            $('#deleteModal').find("#delete").off().click(function() {

                var url = "{{ route('admin.noticeboards.destroy', ':id') }}";
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
                        $('#deleteModal').modal('hide');
                        toastr['success']('Notice deleted successfully!');
                        $('#notices').DataTable().ajax.reload();
                    }
                });

            });
        }
    </script>
@endsection
