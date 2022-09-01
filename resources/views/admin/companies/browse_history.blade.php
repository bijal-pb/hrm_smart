@extends('admin.adminlayouts.adminlayout')

@section('head')

        <!-- BEGIN PAGE LEVEL STYLES -->
<!-- {!!  HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css") !!} -->
        <!-- END PAGE LEVEL STYLES -->

@stop

@section('content')


        <!-- BEGIN PAGE HEADER-->
<div class="page-head"><div class="page-title"><h1>
            @lang("core.browse_history") - {{ $selected_company->company_name }}
        </h1></div></div>

<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->

<div class="row">
    <div class="col-md-12">


        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div id="load">

            {{--INLCUDE ERROR MESSAGE BOX--}}

            {{--END ERROR MESSAGE BOX--}}

        </div>
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    <i class="fal fa-trophy"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @lang("core.browse_history")<span class="fw-300"><i></i></span>
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                        data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10"
                        data-original-title="Fullscreen"></button>
                    {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                </div>
            </div>
        <div class="panel-container show">
        <div class="panel-content">
                <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" id="company">
                    <thead class="bg-primary-600">
                        <tr>
                            <th> @lang("core.serialNo") </th>
                            <th> @lang("core.admin") </th>
                            <th> IP </th>
                            <th> URL </th>
                            <th> @lang("core.timeSpent") </th>
                            <th> @lang('core.createdOn') </th>
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
@stop




@section('page_js')


        <!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
{!! HTML::script("assets/global/plugins/datatables/datatables.min.js")!!}
{!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")!!} -->

        <!-- END PAGE LEVEL PLUGINS -->

<script>


    var table = $('#company').dataTable( {
        {!! $datatabble_lang !!}
        "bProcessing": true,

        "bServerSide": true,
        "ajax": "{{ URL::route("admin.companies.ajax_browse_history", ["id" => $selected_company->id]) }}",
        "aoColumns": [
            { 'data': 'id',name: 'id', "bSortable": true  },
            { 'data': 'admin', name: 'admin', "bSortable": false },
            { 'data': 'ip',name: 'ip', "bSortable": true },
            { 'data': 'url',name: 'url', "bSortable": true },
            { 'data': 'time_spent',name: 'time_spent', "bSortable": true },
            { 'data': 'created_at',name: 'companies.created_at', "bSortable": true }
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

</script>
@stop
