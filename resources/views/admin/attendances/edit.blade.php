@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->
    {{-- {!! HTML::style('assets/global/plugins/uniform/css/uniform.default.min.css')!!}
    {!! HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")!!}
    {!! HTML::style("assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css")!!}
    <!-- {!! HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css")!!} -->
    {!! HTML::style("assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css")!!} --}}
    <!-- {!! HTML::style("assets/global/plugins/bootstrap-form-editable/bootstrap3-editable/css/bootstrap-editable.css")!!} -->
    <!-- BEGIN THEME STYLES -->
@stop


@section('content')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
            <i class="fal fa-user"></i>
               Attendance
            </h1></div>
    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <div id="panel-1" class="panel">
             <div class="panel-hdr">
                        <h2><i class="fal fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Attendance<span class="fw-300"><i></i></span>
                        </h2>
                        <div class="panel-toolbar">
                                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                   <!-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}} -->
                                </div>
                 </div>
               <div class="panel-container show">
                  <div class="panel-content" >  
                    @if (count($leaveTypes) == 0)
                        <div class="note note-warning">
                            <h4 class="block">{{ trans("core.leaveTypesMissing") }}</h4>
                            <p>
                                {!! trans("messages.addLeaveTypes") !!}
                            </p>
                        </div>
                    @elseif($loggedAdmin->company->attendance_setting_set == 0)
                        <div class="note note-warning">
                            <h4 class="block">{{ trans("core.setAttendanceSettings") }}</h4>
                            <p>
                                {!! trans("messages.attendanceSettings") !!}
                            </p>
                        </div>
                    @else
                        <div class="table-toolbar margin-top-15">
                            <div class="row">
                                <div class="col-md-4">
                                    {!! Form::open(['route'=>["admin.attendances.create"], 'method' => 'GET', 'class' => "form-inline", 'id' => "new_date"]) !!}
                                    <div class="btn-group">
                                        <div class="input-group input-medium date date-picker "
                                             data-date-viewmode="years" id="date_change">
                                            <input type="text" class="form-control " name="date"
                                                   placeholder="@lang("core.selectDate")"
                                                   readonly id="attendence_date" value="{{ $date->format('d-m-Y') }}">
                                            <span class="input-group-btn">
															   <button class="btn btn-default" type="button"><i
                                                                           class="fa fa-calendar"></i></button>
															   </span>
                                        </div>
                                    </div>
                                    {{--<button class="btn blue" type="submit">{{trans('core.btnSubmit')}}</button>--}}
                                    {!! Form::close() !!}
                                </div>
                                <div class="col-md-4 text-center">
                                    {{-- @if(!$date->isToday())
                                        <a 
                                           href="{{ route('admin.attendances.create') }}"
                                           data-loading-text="@lang("core.redirecting")..." class="btn btn primary">
                                            {{trans('core.markToday')}} <i class="fal fa-plus"></i>
                                        </a>
                                    @endif --}}
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="btn-group pull-right">
                                        @if ($employees_count > \App\Http\Controllers\Admin\EmployeesController::$MAX_EMPLOYEES)
                                            {!! help_text('emailNotificationDisabled', 'left') !!}
                                        @else
                                            <span id="load_notification"></span>
                                            <input type="checkbox"
                                                   onchange="ToggleEmailNotification('attendance_notification');return false;"
                                                   class="make-switch" name="attendance_notification"
                                                   @if($loggedAdmin->company->attendance_notification==1)checked
                                                   @endif data-on-color="success"
                                                   data-on-text="{{trans('core.btnYes')}}"
                                                   data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
                                            <strong>{{trans('core.emailNotification')}}</strong>
                                        @endif

                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        @if(isset($todays_holidays->date))
                            <div class="note note-warning">
                                <h3>{!! \Carbon\Carbon::parse($todays_holidays->date)->timezone($timeZoneLocal)->format("l, jS M Y") !!}</h3>
                                <h4>{!! trans("messages.todayIsHoliday", ["date" => $todays_holidays->occassion]) !!}</h4>
                            </div>
                        @endif

                        @if(count($attendance)==0)
                            <div class="note note-warning">
                                <h4 class="block">{{ trans("core.employeesMissing") }}</h4>
                                <p>{{ trans("core.addSomeEmployees") }}</p>
                            </div>
                        @else
                            {!! Form::open(['route' => ["admin.attendances.update", $date->format("Y-m-d")], 'class'=>'form-horizontal ajax_form', 'method'=>'PATCH']) !!}
                            <div id="alert_box"></div>
                            <h4 class="form-section text-center"
                                style="font-weight: bold;">@lang("core.date"): <span
                                        id="date_heading">{{ $date->format("d-M-Y") }} @if($date->isToday())
                                        (Today)@endif</span></h4>

                                        <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" id="attendanceTable">
                                   <thead class="bg-primary-600">
                                <tr>
                                    {{--												   <th>@lang("core.employeeID")</th>--}}
                                    <th>@lang("core.name")</th>
                                    {{-- <th>@lang("core.status")</th> --}}
                                    <th>@lang("core.attendance")</th>
                                    <th>Clock-In/Out Time</th>
                                    {{-- <th>Save</th> --}}
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                               
                            </table>
                            {!!   Form::close()  !!}
                        @endif
                    @endif
                </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>

@stop

@section('page_js')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {{-- {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
    {!! HTML::script('assets/global/plugins/uniform/jquery.uniform.min.js')!!}
    {!! HTML::script("assets/global/plugins/moment.min.js") !!}
    {!! HTML::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js")!!}
    {!! HTML::script("assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js")!!}
    <!-- {!! HTML::script("assets/global/plugins/datatables/datatables.min.js")!!} -->
    <!-- {!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")!!} -->
    {!! HTML::script("assets/global/plugins/datatables/plugins/responsive/dataTables.responsive.min.js")!!}
    {!! HTML::script("assets/admin/pages/scripts/components-pickers.js")!!}
    {!! HTML::script('assets/js/ajaxform/jquery.form.min.js')!!}
    {!! HTML::script('assets/js/commonjs.js')!!} --}}
    {!! HTML::script('assets/global/plugins/bootstrap-form-editable/bootstrap3-editable/js/bootstrap-editable.min.js')!!}



    <!-- END PAGE LEVEL PLUGINS -->

    <script>
        var attendanceData = {};
        var employeeIDs = [];

      

    </script>

    <script>
        

        $('.timepicker').timepicker({
            autoclose: true,
            minuteStep: 5,
            disableMousewheel: true,
            disableFocus: true
        });
   

      
        $(document).ready(function() {
        var table = $('#attendanceTable').dataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "{{ URL::route("admin.attendance.ajax_attendance") }}",
                    "data": function (d) {
                        d.date = $('#attendence_date').val();
                    }
                },
                columns: [
                    {data: 'eID', name: 'eID', sWidth: "20%"},
                    // {data: 'status', name: 'status', sWidth: "30%"},
                    {data: 'date', name: 'date', sWidth: "20%",orderable: false},
                    {data: 'clock_in', name: 'clock_in', sWidth: "25%",  orderable: false},
                    // {data: 'action', name: 'action', sWidth: "5%" ,orderable: false},
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
        });

    

        function showHide(id) {
            if ($('#checkbox' + id + ':checked').val() == 'on') {
                $('#leaveForm' + id).addClass("hidden");
            } else {
                $('#leaveForm' + id).removeClass("hidden");

                var leaveType = $('#leaveType' + id).val();
                if (leaveType == 'half day') {
                    $('#halfLeaveType' + id).show();
                }
            }
        }

        function halfDayToggle(id, value) {

            if (value == 'half day') {
//			 $('#halfDayLabel').show(100);
                $('#halfLeaveType' + id).show(100);
            } else {
                $('#halfLeaveType' + id).hide(100);
            }

        }
        $(document).ready(function(){

        $('#date_change').datepicker({
            format: "dd-mm-yyyy",
            todayHighlight: true,
            toggleActive: true,
            autoclose: true
        }).on('changeDate', function (e) {
            var url = "{{ route("admin.attendances.edit", "#id") }}";
            var date = moment($('#attendence_date').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
            url = url.replace("#id", date);
            $('#attendence_date').load(url)
            loadView(url);
        });
    });
        function ajaxUpdateAttendance() {

            var data = JSON.stringify(attendanceData);

            var date = $('#attendence_date').val();
            var url = "{{ route("admin.attendances.update", "#id") }}";
            url = url.replace("#id", date);

            $.ajax({
                url: url,
                dataType: 'json',
                data: {data: data, _method: "PATCH", _token: "{{ csrf_token() }}"},
                method: 'POST',
                beforeSend: function () {
                    $('#update_attendence').attr("disabled", true);
                },
                success: function (response) {
                    $('#update_attendence').attr("disabled", false);
                    showResponseMessage(response, 'error');
                    var route = "{{ route("admin.attendances.edit", "#id") }}";
                    var date = moment(response.date);

                    var url = route.replace("#id", date.format("YYYY-MM-DD"));
                    $('#update_attendence').load(url)
                    loadView(url);
                },
                error: function (xhr, textStatus, thrownError) {
                    resposeArray = {
                        "status": "fail",
                        "errorCode": "unkonwn",
                        "message": "Problem logging in, please try again!"
                    };
                    showResponseMessage(resposeArray, "error");
                }
            });
            return false;
        }

        function attendanceRow(id) {

            loadingButton("#update_row" + id);
            var status = null;
            var leave_type = null;
            var half_day = null;
            var reason = null;
            var clock_in_ip = $('#clock_in_ip' + id).html();
            var clock_out_ip = $('#clock_out_ip' + id).html();
            var work = $('#work' + id).html();
            var notes = $('#notes' + id).html();
            var attendance_date = $('#attendence_date').val();
            var is_late = $("#late" + id).is(":checked");

            if ($('#checkbox' + id).is(":checked") == true) {
                status = "present";
            } else {
                status = "absent";
                leave_type = $('#leaveType' + id).val();
                half_day = $('#halfDay' + id).is(':checked');
                reason = $('#reason' + id).val();
            }

            var clock_in = $('#clock_in' + id).val();
            var clock_out = $('#clock_out' + id).val();

            $.ajax({
                type: "POST",
                url: "{!! route('admin.attendance.update.row') !!}",
                data: {
                    "id": id,
                    "status": status,
                    "leave_type": leave_type,
                    "half_day": half_day,
                    "reason": reason,
                    "clock_in": clock_in,
                    "clock_out": clock_out,
                    "date": attendance_date,
                    "clock_in_ip": clock_in_ip,
                    "clock_out_ip": clock_out_ip,
                    "work": work,
                    "notes": notes,
                    "is_late": is_late
                }
            }).done(function (response) {
                unloadingButton("#update_row" + id);
                showResponseMessage(response, 'error');
                var late_badge = '';
                if (response.checkbox == "1") {
                    $("#uniform-late" + id + " span").addClass("checked");
                    late_badge = '<span class="label label-danger">Late</span>';
                } else {
                    $("#uniform-late" + id + " span").removeClass("checked");
                }

                $("#updateCell" + id).parent("td").html(response.divHTML);

                $('.form-edit').editable({
                    url: ''
                });

            }).fail(function (response) {
                unloadingButton("#update_row" + id);
                showToastrMessage("@lang("messages.generalError")", "@lang("core.error")", "error");
            });
        }
    </script>
@stop
