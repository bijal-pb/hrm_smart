@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->
   
    <!-- END PAGE LEVEL STYLES -->
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

                {{--INLCUDE ERROR MESSAGE BOX--}}

                {{--END ERROR MESSAGE BOX--}}

            </div>
            <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                        <i class="fal fa-briefcase"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Feature<span class="fw-300"><i></i></span>
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                            {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                        </div>
                    </div>

                 <div class="panel-container show">

                    @if($loggedAdmin->manager!=1)
                      
                                        <a class="btn btn-primary float-right m-3" style="color:#fff;" data-toggle="modal" onclick="showAdd()">
                                            {{ trans('core.btnAddFeature') }}
                                            <i class="fa fa-plus"></i> </a>
                                
                    @endif
                    <div class="panel-content" >
                    <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" id="table">
                        <thead class="bg-primary-600">
                        <tr>
                            <th> Sr No.</th>
                            <th> Title</th>
                            <th> Description</th>
                            <th> Image</th>
                            <th class="text-center"> {{trans('core.action')}} </th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                </div>

            </div>

        </div>
    </div>
    <!-- END PAGE CONTENT-->

    <div id="add_edit_form" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <div class="d-block position-absolute pos-top pos-left p-3 ">
                    <h4 class="modal-title">{{$pageTitle}}</h4>
                    </div>
                </div>
                <div class="modal-body" id="add_edit_body">
                    {{--Ajax replace content--}}
                </div>
            </div>
        </div>
    </div>

    {{--MODAL CALLING--}}
    @include('admin.common.delete')
    {{--MODAL CALLING END--}}

@stop



@section('page_js')
   

    <!-- END PAGE LEVEL PLUGINS -->

    <script>


        var table1 = $('#table').dataTable({
            {!! $datatabble_lang !!}
            processing: true,
            serverSide: true,
            responsive: true,
            "ajax": "{{ URL::route("admin.features") }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },
                { data: 'image', name: 'image' },
                { data: 'edit', name: 'edit', "bSortable": false  }
            ],
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

        function showAdd() {
            $('#add_edit_form').modal('show');
            $("body").addClass("modal-open");

            var get_url = "{{ route('admin.features.create') }}";

            $("#add_edit_body").html('<div class="text-center">{!!  HTML::image('assets/loader.gif') !!}</div>');

            $.ajax({
                type: "GET",
                url: get_url,
                data: {}
            }).done(function (response) {
                $("#add_edit_body").html(response);
            });
        }


        function showEdit(id) {
            $('#add_edit_form').modal('show');
            $("body").addClass("modal-open");

            var get_url = "{{ route('admin.features.edit',':id') }}";


            get_url = get_url.replace(':id', id);

            $("#add_edit_body").html('<div class="text-center">{!!  HTML::image('assets/loader.gif') !!}</div>');

            $.ajax({
                type: "GET",
                url: get_url,
                data: {}
            }).done(function (response) {
                $("#add_edit_body").html(response);
            });
        }

        function addData() {
            var get_url = "{{ route('admin.features.store') }}";

            $.easyAjax({
                url: get_url,
                type: "POST",
                data: $(".add_form").serialize(),
                container: ".add_form",
                file: true,
                success: function (response) {

                    if (response.status == 'success')
                    {
                        $('#add_edit_form').modal('hide');
                        table1._fnDraw();
                    }
                }
            });
        }

        function updateData(id) {
            var get_url = "{{ route('admin.features.update',':id') }}";
            get_url = get_url.replace(':id', id);
            $.easyAjax({
                url: get_url,
                type: "POST",
                data: $(".edit_form_feature").serialize(),
                container: ".edit_form_feature",
                file: true,
                success: function (response) {
                    if (response.status === 'success')
                    {
                        $('#add_edit_form').modal('hide');
                        table1._fnDraw();
                    }
                }
            });
        }

        function del(id,faq)
        {

            $('#deleteModal').modal('show');
            $("#deleteModal").find('#info').html('{!!  __('messages.faqDeleteConfirm') !!}');

            $('#deleteModal').find("#delete").off().click(function()
            {
                var url = "{{ route('admin.features.destroy',':id') }}";
                url = url.replace(':id',id);
                $.ajax({

                    type: "DELETE",
                    url : url,
                    dataType: 'json',
                    data: {"id":id}

                }).done(function(response)
                {
                    if(response.success == "deleted")
                    {
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $('#deleteModal').modal('hide');

                        var msg = prepareMessage("{!! trans("messages.faqDeleteMessage") !!}", ":faq", faq);
                        showToastrMessage(msg, '{{__('core.success')}}', 'success');
                        table1._fnDraw();
                    }
                });
            })

        }
    </script>
@stop
