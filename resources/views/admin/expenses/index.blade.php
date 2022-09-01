@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    <!-- {!! HTML::style("assets/global/plugins/select2/css/select2.css")!!}
    {!! HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css")!!} -->
    <!-- END PAGE LEVEL STYLES -->

@stop


@section('content')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
        <i class="fal fa-rupee-sign"></i>
                @lang("pages.expenses.indexTitle")
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <!-- <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">{{trans('core.dashboard')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">@lang("pages.expenses.indexTitle")</span>
            </li> -->

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">

        <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                        <i class="fal fa-rupee-sign"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Expense<span class="fw-300"><i></i></span>
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                            {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                        </div>
                    </div>
                    <div class="col-md-12 form-group text-right">
                                    <span id="load_notification"></span>
                                    <input type="checkbox"
                                           onchange="ToggleEmailNotification('expense_notification');return false;"
                                           class="make-switch" name="expense_notification"
                                           @if($loggedAdmin->company->expense_notification==1)checked
                                           @endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}"
                                           data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
                                    <strong>{{trans('core.emailNotification')}}</strong>
                                </div> 
                         <div class="panel-container show">
                             <!-- href="{{ route('admin.expenses.create')}}" -->
                            <a onclick="showadd();" class="btn btn-primary float-right m-3" style="color:#fff;">
                                            {{trans('core.btnAddExpense')}} {{trans('core.item')}} </a>
                            <div class="panel-content" >
                    <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" id="expenses">
                    <thead class="bg-primary-600">
                        <tr>
                            <th> Sr No.</th>
                            <th> {{trans('core.item')}} </th>
                            <th> {{trans('core.purchase_from')}} </th>
                            <th> {{trans('core.date')}} </th>
                            <th> {{trans('core.employee')}} </th>
                            <th> {{trans('core.price')}} ({{$loggedAdmin->company->currency_symbol}})</th>
                            <th> {{trans('core.status')}} </th>
                            {{-- <th>Hidden ID</th> --}}
                            <th> {{trans('core.action')}} </th>
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
    <!-- END PAGE CONTENT-->
    <!-- add model -->

    <div class="modal fade add_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="data-model1">
        <div class="modal-dialog">
            <div class="modal-content" id="add-expenses-content">
            </div>
        </div>
    </div>
    <!-- edit modal -->
    <div class="modal fade edit_expenses" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="data-model">
        <div class="modal-dialog">
            <div class="modal-content" id="edit-expenses-content">
            </div>
        </div>
    </div>

    {{--MODAL CALLING--}}
    @include('admin.common.delete')
    {{--MODAL CALLING END--}}
@stop



@section('page_js')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- {!! HTML::script("assets/global/plugins/select2/js/select2.min.js")!!}
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/datatables.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")!!}
    {{--    	{!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/jquery.dataTables.columnFilter.js")!!}--}} -->

    <!-- END PAGE LEVEL PLUGINS -->

    <script>

        jQuery(document).ready(function () {

                ComponentsPickers.init();
                $.fn.select2.defaults.set("theme", "bootstrap");
                $('.select2').select2({
                placeholder: "Select",
                width: '100%',
                allowClear: false
            });
        });

       


        var table = $('#expenses').dataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            stateSave: true,
            {!! $datatabble_lang !!}
            "ajax": "{!!  route('admin.ajax_expenses')  !!}",
            columns: [
                {data: 's_id', name: 's_id'},
                {data: 'item_name', name: 'item_name'},
                {data: 'purchase_from', name: 'purchase_from'},
                {data: 'purchase_date', name: 'purchase_date'},
                {data: 'full_name', name: 'full_name'},
                {data: 'price', name: 'price'},
                {data: 'status', name: 'status'},
                // {data: 'id', name: 'id'},
                {data: 'edit', name: 'edit',orderable: false}
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

        function showadd() {
            var get_url = "{{ route('admin.expenses.create')}}";
            $('#data-model1').modal('show', get_url);

            $.ajax({
                type: 'GET',
                url: get_url,

                data: {},
                success: function(response) {
                    $('#add-expenses-content').html(response);
                },

                error: function(xhr, textStatus, thrownError) {
                    $('#add-expenses-content').html(
                        '<div class="alert alert-danger">Error Fetching data</div>');
                }
            });
        }

        function showedit(id) {
            var get_url = "{{ route('admin.expenses.edit', ':id') }}";
            get_url = get_url.replace(':id', id);
            $('#data-model').modal('show', get_url);

            $.ajax({
                type: 'GET',
                url: get_url,

                data: {},
                success: function(response) {
                    $('#edit-expenses-content').html(response);
                },

                error: function(xhr, textStatus, thrownError) {
                    $('#edit-expenses-content').html(
                        '<div class="alert alert-danger">Error Fetching data</div>');
                }
            });
        }

        // Show Delete Modal
        function del(id, name) {

            $('#deleteModal').modal('show');

            $("#deleteModal").find('#info').html('Are you sure ! You want to delete <strong>' + name + '?');

            $('#deleteModal').find("#delete").off().click(function () {

                var url = "{{ route('admin.expenses.destroy',':id') }}";
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
                            $('#expenses').DataTable().ajax.reload();
                            // table.fnDraw();
                        }
                    }
                });

            });
        }


        function changeStatus(id, status) {

            var url = "{{ route('admin.expense.change_status',':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                type: 'POST',
                url: url,
                data: {status: status},
                container: "#deleteModal",
                success: function (response) {
                    if (response.status === "success") {
                        toastr['success']('Status chnaged successfully!');
                        table.fnDraw();
                    }
                }
            });

        }

    </script>
@stop
