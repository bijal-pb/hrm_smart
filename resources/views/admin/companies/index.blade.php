@extends('admin.adminlayouts.adminlayout')

@section('head')


    <!-- BEGIN PAGE LEVEL STYLES -->
    <!-- {!!  HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css") !!} -->
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

            <span class="active">Companies</span>

            </li>

        </ul>

    </div> -->
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
                    <i class="fa fa-th-large"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Companies<span class="fw-300"><i></i></span>
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
                    <a class="btn btn-primary float-right m-3" href="{{route('admin.companies.create')}}">
                                    {{trans('core.btnAddCompany')}}
                    <i class="fa fa-plus"></i> </a>
                    <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" id="company">
                        <thead class="bg-primary-600">
                        <tr>
                            <th> {{trans('core.id')}} </th>
                            <th> Logo</th>
                            <th> Company</th>
                            @if(module_enabled('Subdomain'))
                                <th>  Subdomains</th>

                            @else
                                <th> Login</th>
                            @endif
                            <!-- <th> Package</th> -->
                            <th> {{trans('core.createdOn')}} </th>
                            <th> {{trans('core.status')}}</th>

                            <th class="text-center"> {{trans('core.action')}} </th>
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

    {{--MODAL CALLING--}}
    @include('admin.common.delete')
    {{--MODAL CALLING END--}}


    {{--BloCK Model--}}
    <div id="blockModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="panel-hdr">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">{{trans('core.confirmation')}}</h4>
            </div>
                <div class="modal-body" id="blockinfo">
                    <p>
                        {{--Confirm Message Here from Javascript--}}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal"
                            class="btn btn-default btn-outline">{{trans('core.btnCancel')}}</button>
                    <button type="button" data-dismiss="modal" class="btn btn-danger"
                            id="success"> {{trans('core.btnSubmit')}}</button>
                </div>
            </div>
        </div>
    </div>

    {{--END BLock MODAL--}}

    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="packageUpdateModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <form class="ajax-form" id="update-company-form">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading">Change Package</span>
                    </div>
                    <div class="modal-body">
                        Loading...
                    </div>
                    <div class="modal-footer">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"><i
                                        class="fa fa-check"></i>Update</button>

                            <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- .row -->
@stop



@section('page_js')


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/datatables.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")!!} -->

    <!-- END PAGE LEVEL PLUGINS -->

    <script type="text/javascript">

        onlyNum('numOnly');
        var modal = $('#packageUpdateModal');

        var table = $('#company').dataTable({
            {!! $datatabble_lang !!}
            processing: true,
            serverSide: true,
            responsive: true,
            "ajax": {
                "url": "{{ route('admin.ajax_admin_company') }}",
                "data": function (d) {
                    d.days = $('input[name=days]').val();
                }
            },
            "columns": [
                {'data': 'id', name: 'companies.id', "bSortable": true, "width": "5%"},
                {'data': 'logo', name: 'logo', "bSortable": false, "width": "10%"},
                {'data': 'company_name', name: 'company_name', "bSortable": true, "width": "15%"},
                {'data': 'number_of_logins', name: 'number_of_logins', "bSortable": true},
                // {'data': 'plan_name', name: 'subscription_plans.plan_name', "bSortable": true, "width": "15%"},
                {'data': 'created_at', name: 'companies.created_at', "bSortable": true},
                {'data': 'status', name: 'companies.status', "bSortable": true},

                {'data': 'edit', name: 'edit', "bSortable": false}

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
            $("#deleteModal").find('#info').html('{{__('messages.deleteConfirmCompany')}} ?');
            $('#deleteModal').find("#delete").off().click(function () {
                var url = "{{ route('admin.companies.destroy',':id') }}";
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
            })

        }

        function blockUnblock(id, status, company) {
            var msg;
            if (status == "active") {
                msg = 'Are you sure you want to <span class="label label-danger">Disable</span> the <b>' + company + '</b>';
            } else {
                msg = 'Are you sure you want to <span class="label label-success">Enable</span> the <b>' + company + '</b>';
            }
            $('#blockModal').appendTo("body").modal('show');
            $('#blockinfo').html(msg);
            $('#blockModal').find("#success").off().click(function () {
                var url = "{{ route('admin.companies.change_status',':id') }}";
                url = url.replace(':id', id);

                $.easyAjax({
                    type: 'POST',
                    url: url,
                    data: {"id": id, 'status': status},
                    container: "#blockModal",
                    success: function (response) {
                        if (response.status === "success") {
                            $('#deleteModal').modal('hide');
                            table.fnDraw();
                        }
                    }
                });

            })

        }

        $('body').on('click', '.package-update-button', function () {
            const url = '{{ route('admin.companies.edit-package.get', ':companyId') }}' . replace(':companyId', $(this).data(
                'company-id'
            ));
            $.easyAjax({
                type: 'GET',
                url: url,
                blockUI: false,
                messagePosition: "inline",
                success: function (response) {
                    if (response.status === "success" && response.data) {
                        modal.find('.modal-body').html(response.data).closest('#packageUpdateModal').modal('show');

                    } else {
                        modal.find('.modal-body').html('Loading...').closest('#packageUpdateModal').modal('show');
                    }
                }
            });
        });

        modal.on('bs-modal-hide', function () {
            modal.find('.modal-body').html('Loading...');
        });

        @if(module_enabled('Subdomain'))
        $('body').on('click', '.domain-params', function(){

            var company_id = $(this).data('company-id');
            var company_url = $(this).data('company-url');

            var msg = `You want to notify company admins about company Login URL <br> Company URL: <a href="//${company_url}"><b>${company_url}</b></a>`;

            $('#blockModal').appendTo("body").modal('show');
            $('#blockinfo').html(msg);

            $('#blockModal').find("#success").off().click(function () {
                var token = "{{ csrf_token() }}";

                $.easyAjax({
                    type: 'POST',
                    url: "{{route('notify.domain')}}",
                    data: {'_token': token, 'company_id': company_id},
                    success: function (response) {
                        if (response.status === "success") {
                            $.unblockUI();
                            table._fnDraw();
                        }
                    }
                });

            })
        });
        @endif
    </script>
@stop
