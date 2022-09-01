@extends('front.layouts.frontlayout')


@section('content')
    <div class="page-head">
        <div class="page-title">
            <h1>
                <i class="fal fa-calendar-check"></i>
                {{ trans('core.myLeaveApp') }}
            </h1>
        </div>
    </div>
    <div class="col-md-12">
        <!--Profile Body-->
        <div class="profile-body">
            <div class="row">
                <!--Profile Post-->
                <div class="col-sm-12 margin-bottom-20">
                    <div class="panel">
                        <div class="panel-hdr">
                            <h2 class="panel-title"><i
                                    class="fal fa-calendar-check"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{ trans('core.myLeaveApp') }} </h2>
                            <div class="panel-toolbar">
                                <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                    data-offset="0,10" data-original-title="Collapse"></button>
                                <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                    data-offset="0,10" data-original-title="Fullscreen"></button>
                                <!-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> -->
                            </div>

                        </div>
                        <div class="panel-container show">
                            <div class="panel-content">
                                {{-- ----------------Error Messages-------- --}}
                                <div id="alert_message">
                                    @if (Session::get('success_leave'))
                                        <div class="alert alert-success"><i class="fal fa-check"></i>
                                            {!! Session::get('success_leave') !!}</div>
                                    @endif

                                    @if (Session::get('error_leave'))
                                        <div class="alert alert-danger alert-dismissable ">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true"></button>
                                            @foreach (Session::get('error_leave') as $error)
                                                <p><strong><i class="fa fa-warning"></i></strong> {!! $error !!}
                                                </p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                {{-- ----------------Error Messages-------- --}}
                                <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline"
                                    id="applications">
                                    <thead class="bg-primary-600">
                                        <tr>
                                            <th>{{ trans('core.id') }}</th>
                                            <th>{{ trans('core.date') }}</th>
                                            <th class="text-center">{{ trans('core.days') }}</th>
                                            <th>{{ trans('core.type') }}</th>

                                            <th>{{ trans('core.reason') }}</th>
                                            <th>{{ trans('core.appliedOn') }}</th>
                                            <th>{{ trans('core.status') }}</th>
                                            <th>{{ trans('core.action') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> {{-- ID from Contoller ajaxload---- --}} </td>
                                            <td class="text-center"> {{-- Date from Contoller ajaxload-- --}} </td>
                                            <td> {{-- Days from Contoller ajaxload-- --}} </td>
                                            <td> {{-- Leavetype from Contoller ajaxload --}} </td>
                                            <td> {{-- Reason from Contoller ajaxload-- --}} </td>
                                            <td> {{-- Applied on from Contoller ajaxload- --}} </td>
                                            <td> {{-- Status from Contoller ajaxload-- --}} </td>
                                            <td> {{-- Action from Contoller ajaxload-- --}} </td>
                                        </tr>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>


                    <!--End Profile Post-->


                    <!--/end row-->


                    <div class="col-sm-12 ">
                        <div class="panel">
                            <div class="panel-hdr">
                                <h2 class="panel-title">@lang('core.leavesLeft')</h2>
                                <div class="panel-toolbar">
                                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                        data-offset="0,10" data-original-title="Collapse"></button>
                                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                        data-offset="0,10" data-original-title="Fullscreen"></button>
                                    <!-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> -->
                                </div>
                            </div>
                            <div class="panel-container show">
                                <div class="panel-content">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tbody>
                                            @foreach ($leaveTypesData as $leaveType)
                                                <tr>
                                                    <td><span
                                                            class="primary-link">{{ ucfirst($leaveType->leaveType) }}</span>
                                                    </td>
                                                    @if (strtolower($leaveType->leaveType) == 'annual')
                                                        <td>{{ $employee->annual_leave }}</td>
                                                    @elseif (($key = array_search($leaveType->leaveType, $takenLeaveTypes)) !== false)
                                                        <td>{{ $leaveType->num_of_leave - $takenLeaves[$key] }}</td>
                                                    @else
                                                        <td>{{ $leaveType->num_of_leave }}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Profile Body-->
                </div>

            </div>
        </div>
    </div>
    


            {{-- ------------------------Show Notice MODALS--------------- --}}


            <div class="modal fade show_notice" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true" id="modal-data">
                <div class="modal-dialog">
                    <div class="modal-content" id="leave-modal-content">
                    </div>
                </div>
            </div>


             {{-- ----------------------END Notice MODALS------------------- --}}
                @endsection

                @section('page_js')
                    {{-- {!!  HTML::script("assets/global/plugins/datatables/datatables.min.js") !!} --}}
                    {{-- {!!  HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")!!} --}}

            <script>
                var table = $('#applications').dataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    "ajax": "{{ URL::route('front.leave_applications') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'start_date',
                            name: 'start_date'
                        },
                        {
                            data: 'days',
                            name: 'days'
                        },
                        {
                            data: 'leaveType',
                            name: 'leaveType'
                        },
                        {
                            data: 'reason',
                            name: 'reason'
                        },
                        {
                            data: 'applied_on',
                            name: 'applied_on'
                        },
                        {
                            data: 'application_status',
                            name: 'application_status'
                        },
                        {
                            data: 'edit',
                            name: 'edit',
                            "bSortable": false
                        }
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


                function show_application(id) {
                    var url = "{{ route('leaves.show', ':id') }}";
                    url = url.replace(':id', id);
                    // $('#modal-data').modal('show',url);
                    $.ajaxModal('#modal-data', url);

                    $.ajax({
                        type: 'GET',
                        url: url,

                        data: {},
                        success: function(response) {
                            $('#leave-modal-content').html(response);
                        },

                        error: function(xhr, textStatus, thrownError) {
                            $('#leave-modal-content').html(
                                '<div class="alert alert-danger">Error Fetching data</div>');
                        }
                    });
                }

                @if (Session::get('error_leave'))
                    $("html, body").animate({scrollTop: $('#applications').height() + 600}, 2000);
                @endif
            </script>
        @endsection
