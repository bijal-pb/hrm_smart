@extends('admin.adminlayouts.adminlayout')

@section('head')


    <!-- BEGIN PAGE LEVEL STYLES -->

    <!-- {!! HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css")!!}
    {!! HTML::style("assets/global/plugins/bootstrap-summernote/summernote.css")!!} -->
    <!-- END PAGE LEVEL STYLES -->

@stop


@section('content')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
                {{$pageTitle}}
            </h1></div>
    </div>
    <!-- <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{ route('admin.dashboard.index') }}')">{{ trans('core.home') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Email Templates</span>

            </li>

        </ul>

    </div> -->
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
                    <i class="fa fa-envelope"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{$pageTitle}}<span class="fw-300"><i></i></span>
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
                    <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" id="emails">
                        <thead class="bg-primary-600">
                        <tr>

                            <th> EmailID</th>
                            <th> Subject</th>
                            <th> TEXT</th>
                            <th> Created At</th>
                            <th class="text-center"> {{trans('core.action')}} </th>
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

    {{--EDIT  MODALS--}}

    <div id="static_edit" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
                    <div class="d-block position-absolute pos-top pos-left p-2 ">
                    <h4 class="modal-title"><strong><i class="fa fa-edit"></i> {{trans('core.edit')}} Email
                            Template</strong></h4>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="portlet-body form" id="edit-form-body">
                        {{--Ajax Data--}}
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>

        </div>
    </div>


    {{--EDIT MODALS--}}
@stop



@section('page_js')


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- {!! HTML::script("assets/global/plugins/select2/js/select2.min.js")!!}
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/datatables.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")!!}
    {!! HTML::script("assets/global/plugins/bootstrap-summernote/summernote.min.js") !!} -->
    <script>
        $('#body').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen'/*, 'codeview' */]],   // remove codeview button
                ['help', ['help']]
            ],
        });
    </script>
    <!-- END PAGE LEVEL PLUGINS -->

    <script>


        var table = $('#emails').dataTable({
            {!! $datatabble_lang !!}
            processing: true,
            serverSide: true,
            responsive: true,
            "ajax": "{{ URL::route("admin.ajax_email_templates") }}",
            columns: [
                {data: 'email_id', name: 'email_id'},
                {data: 'subject', name: 'subject'},
                {data: 'body', name: 'body'},
                {data: 'created_at', name: 'created_at', "visible": false},
                {data: 'edit', name: 'edit', "bSortable": false}
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


        function showEdit(id) {
            $('#static_edit').modal('show');
            $("body").addClass("modal-open");
            var get_url = "{{ route('admin.email_templates.edit',':id') }}";
            get_url = get_url.replace(':id', id);

            $("#edit-form-body").html('<div class="text-center">{!!  HTML::image('assets/loader.gif') !!}</div>');

            $.ajax({
                type: "GET",
                url: get_url,
                data: {}
            }).done(function (response) {
                $("#edit-form-body").html(response);
                $('#body').summernote({height: 300,toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                        ['fontname', ['fontname']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'hr']],
                        ['view', ['fullscreen'/*, 'codeview' */]],   // remove codeview button
                        ['help', ['help']]
                    ],});
            });
        }

        function updateData(id) {
            var get_url = "{{ route('admin.email_templates.update',':id') }}";
            get_url = get_url.replace(':id', id);
            $("#error_edit").html('<div class="alert alert-info">{{trans('messages.submitting')}}..</div>');
            $("#submitbutton_edit").prop('disabled', true);

            $.ajax({
                type: 'PUT',
                url: get_url,
                dataType: "JSON",
                data: {'subject': $('#subject').val(), 'body': $('#body').val(), 'id': id},
                success: function (response) {
                    if (response.status == "error") {
                        showToastrMessage('{{ __('messages.errorTitle') }}', '{{__('messages.error')}}', 'error');
                        $('#error').html('');
                        var arr = response.msg;
                        var alert = '';
                        $.each(arr, function (index, value) {
                            if (value.length != 0) {
                                alert += '<p><span class="fa fa-close"></span> ' + value + '</p>';
                            }
                        });
                        $('#error_edit').html('<div class="alert alert-danger alert-dismissable"><button class="close" data-close="alert"></button> ' + alert + '</div>');
                        $("#submitbutton_edit").prop('disabled', false);
                    } else {
                        $('#static_edit').modal('hide');
                        $('#error').html('');
                        $("#submitbutton_edit").prop('disabled', false);
                        table._fnDraw();
                        showToastrMessage(response.msg, response.status, 'success');
                    }

                },
                error: function (xhr, textStatus, thrownError) {

                }
            });
        }
    </script>
@stop
