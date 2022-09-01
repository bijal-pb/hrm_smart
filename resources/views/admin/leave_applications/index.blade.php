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
        <i class="fa fa-rocket"></i>
                @lang('pages.leaveApplications.indexTitle')
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <!-- <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">@lang('core.dashboard')</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">@lang('pages.leaveApplications.indexTitle')</span>
            </li> -->
        </ul>
    </div>            <!-- END PAGE HEADER-->            <!-- BEGIN PAGE CONTENT-->


    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="load">
            </div>
            <div id="panel-5" class="panel">

                     <div class="panel-hdr">
                            <h2> <i class="fa fa-rocket"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@lang('Leave Applications')</h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                            {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                        </div>
                        </div>
                        <div class="panel-container show">
                            <div class="col-md-12 form-group text-right">
                                <span id="load_notification"></span>
                                <input type="checkbox"
                                       onchange="ToggleEmailNotification('leave_notification');return false;"
                                       class="make-switch" name="leave_notification"
                                       @if($loggedAdmin->company->leave_notification==1)checked @endif data-on-color="success"
                                       data-on-text="@lang('core.btnYes')" data-off-text="@lang('core.btnNo')"
                                       data-off-color="danger">
                                <strong>@lang('core.emailNotification')</strong><br>
                            </div>
                        
               
                <div class="panel-content" >
                    <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" id="applications">
                       <thead class="bg-primary-600">
                        <tr>
                            <th>@lang('core.id')</th>
                            <th>@lang('core.name')</th>
                            <th>@lang('core.dates')</th>
                            <th>@lang('core.days')</th>
                            <th>@lang('core.leaveTypes')</th>

                            <th>@lang('core.reason')</th>
                            <th>@lang('core.appliedOn')</th>
                            <th>@lang('core.status')</th>
                            <th>@lang('core.actions')</th>

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
    <div class="modal fade show_notice" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" id="modal-data">
        <div class="modal-dialog">
            <div class="modal-content" id="leave-app-content">
            </div>
        </div>
    </div>         <!-- END PAGE CONTENT-->
    {{--Approve--}}
{!! Form::open(['url'=>'','id'=>'show_approve','method'=>'PATCH']) !!}
<div id="static_approve" class="modal fade" tabindex="-1" data-backdrop="static_approve" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <div class="d-block position-absolute pos-top pos-left p-2 ">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">@lang('core.confirmation')</h4>
            </div>
            </div>
            <div class="modal-body">
                <input type="hidden" name="application_status" value="@lang('core.btnApprove')">
                <p>
                    @lang('messages.approveLeave')
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal"
                        class="btn btn-dark">@lang('core.btnCancel')</button>
                <button type="submit" data-loading-text="@lang("core.updating")..."
                        class="btn btn-primary">@lang('core.btnApprove')</button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
{{--APPROVE--}}

{{--Reject--}}
{!! Form::open(['url'=>'','id'=>'show_reject','method'=>'PATCH']) !!}
<div id="static_reject" class="modal fade" tabindex="-1" data-backdrop="static_reject" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <div class="d-block position-absolute pos-top pos-left p-2 ">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">@lang('core.rejection')</h4>
            </div>
            </div>
            <div class="modal-body">
                <input type="hidden" name="application_status" value="@lang('core.btnReject')">
                <p>
                    @lang('messages.rejectLeave')
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal"
                        class="btn btn-dark">@lang('core.btnCancel')</button>
                <button type="submit" data-loading-text="@lang("core.updating")..."
                        class="btn btn-danger">@lang('core.btnReject')</button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}



    {{--Reject--}}

    {{--MODAL CALLING--}}
    @include('admin.common.delete')
    @include('admin.common.show-modal')
    {{--MODAL CALLING END--}}

@stop



@section('page_js')


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/datatables.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")!!}
    {!! HTML::script("assets/admin/pages/scripts/table-managed.js")!!} -->
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- END PAGE LEVEL PLUGINS -->


    <script>
        var table = $('#applications').dataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            stateSave: true,
            {!! $datatabble_lang !!}
            "ajax": "{{ URL::route('admin.leave_applications') }}",
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'full_name', name: 'full_name'},
                {data: 'start_date', name: 'start_date'},
                {data: 'days', name: 'days'},
                {data: 'leaveType', name: 'leaveType'},
                {data: 'reason', name: 'reason',orderable: false},
                {data: 'applied_on', name: 'applied_on'},
                {data: 'application_status', name: 'application_status'},
                {data: 'edit', name: 'edit',orderable: false},
            ],
            order: [0, 'desc'],
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


        function del(id) {

            $('#deleteModal').modal('show');

            $("#deleteModal").find('#info').html("@lang("messages.leaveApplicationDeleteConfirm")");
            $('#deleteModal').find("#delete").off().click(function () {
                var url = "{{ route('admin.leave_applications.destroy',':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: "DELETE",
                    url: url,
                    dataType: 'json',
                    data: {"id": id}
                }).done(function (response) {
                    if (response.success == "deleted") {

                        $('#deleteModal').modal('hide');
                        $('#row' + id).fadeOut(500);
                        toastr['success']('Leave application deleted successfully!');
                        $('#applications').DataTable().ajax.reload();
                        // table._fnDraw();
                        // showToastrMessage("@lang("messages.leaveApplicationDeleteMessage")", '{{__('core.success')}}', 'success');
                    }
                });
            })
        }

        function show_application(id) {
            var url = "{{  route('admin.leave_applications.show',':id')  }}";
            url = url.replace(':id', id);
            $('#modal-data').modal('show',url);

            $.ajax({
            type: 'GET',
            url: url,

            data: {},
            success: function(response) {
                $('#leave-app-content').html(response);
            },

            error: function(xhr, textStatus, thrownError) {
                $('#leave-app-content').html(
                    '<div class="alert alert-danger">Error Fetching data</div>');
            }
        });
        }

 function show_approve(id) {
        $('#showModal').modal('hide');
        $('#show_approve').attr('action', "{{ URL::to('admin/leave_applications/') }}/" + id);
    }

    function show_reject(id) {
        $('#showModal').modal('hide');
        $('#show_reject').attr('action', "{{ URL::to('admin/leave_applications/') }}/" + id);
    }

    </script>

@stop
