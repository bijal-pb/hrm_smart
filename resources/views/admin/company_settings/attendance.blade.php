@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css") !!}
    <!-- BEGIN THEME STYLES -->
@stop


@section('content')
    <div class="page-head">
        <div class="page-title"><h1>
        <i class="fal fa-gears"></i>
                {{trans('core.attendanceSettings')}}
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <!-- <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">{{trans('core.dashboard')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">{{trans('core.settings')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">{{trans('core.attendanceSettings')}}</span>
            </li> -->
        </ul>

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
                        <h2><i class="fal fa-gears"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@lang('Attendance setting')</h2>
                            <div class="panel-toolbar">
                                <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                            </div>
                        </div>
                <div class="panel-container show">
                    <div class="panel-content" >
                    {!!  Form::open( ['class'=>'horizontal-form ajax-form'])  !!}
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-4 form-label">@lang('core.allowEmployeeToMarkAttendance') {!! help_text("allowMarkAttendance") !!}</label>

                            <div class="col-md-6 input-group">
                                <input type="checkbox" class="make-switch" id="mark_attendance" name="mark_attendance"
                                       @if($loggedAdmin->company->mark_attendance==1) checked @endif data-on-color="success"
                                       data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}"
                                       data-off-color="danger">
                            </div>
                        </div>
                        <div id="office_clock">
                            <div class="form-group">
                                <label class="col-md-4 form-label">{{trans('core.officeStartTime')}}: </label>

                                <div class="col-md-12 input-group">
                                <input type="text" id="start_time"
                                           class="form-control timepicker timepicker-no-seconds"
                                           value="{{$officeStartTime??'00:00 AM'}}">
                                    <span class="input-group-btn">

                                        <button class="btn btn-dark" type="button"><i class="fa fa-clock-o"></i></button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 form-label">{{trans('core.officeEndTime')}}: </label>

                                <div class="col-md-12 input-group">
                                    <input type="text" id="end_time"
                                           class="form-control timepicker timepicker-no-seconds"
                                           value="{{$officeEndTime ?? '00:00 AM'}}">
                                    <span class="input-group-btn">
                                        <button class="btn btn-dark" type="button"><i class="fa fa-clock-o"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="col-md-4 form-label">@lang('core.markLateAfter')  [@lang('core.inMinutes')]: {!! help_text("markLateAfter") !!}</label>

                            <div class="col-md-12 input-group">
                                <input class="form-control input-inline input-medium" type="text" name="late_mark"
                                       id="late_mark" placeholder="" value="{{$loggedAdmin->company->late_mark_after}}">
                                {{-- <span class="help-inline"> @lang('core.inMinutes') </span> --}}
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="form-actions">
                        <p class="text-center">
                                <button type="button" id="update_settings" onclick="updateSetting();return false;"
                                class="btn btn-primary">{{trans('core.btnUpdate')}}</button>
                        </p>
                    </div>

                    {!!  Form::close()  !!}

                </div>
                </div>

            </div>
        </div>
    </div>

@stop

@section('page_js')
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js") !!}
    {!! HTML::script('assets/admin/pages/scripts/components-dropdowns.js')  !!}
    {!! HTML::script('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js')  !!}
    {!! HTML::script('assets/admin/pages/scripts/components-pickers.js')  !!}
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script>
        function save_settings() {
            var start_time = $("#start_time").val();
            var end_time = $("#end_time").val();
            var late_mark = $("#late_mark").val();
            var mark_attendance;

            if ($('#mark_attendance').is(':checked')) {
                mark_attendance = 1;
            } else {
                mark_attendance = 0;
            }

            $.ajax({
                type: "POST",
                url: "{!! route('admin.attendance_settings.update') !!}",
                data: {
                    "start_time": start_time,
                    "end_time": end_time,
                    'mark_attendance': mark_attendance,
                    "late_mark": late_mark
                },
                beforeSend: function () {
                    loadingButton("#update_settings");
                },
                success: function (response) {
                    unloadingButton("#update_settings");
                    showResponseMessage(response, 'error');
                },
                error: function (xhr, textStatus, thrownError) {
                    showToastrMessage("@lang("messages.generalError")", "@lang("core.error")", "error");
                    unloadingButton("#update_settings");
                }
            });
        }

        $('.timepicker').timepicker({
            autoclose: true,
            minuteStep: 5,
            disableMousewheel: true,
            disableFocus: true
        });

        var bindDatePicker = function (element) {
            $(element).timepicker({
                autoclose: true,
                minuteStep: 5,
                disableMousewheel: true,
                disableFocus: true
            });
        };


        jQuery(document).ready(function () {
            ComponentsPickers.init();
        })
        function updateSetting() {
            $('#update_settings').html('<span class="caption-subject font-red-sunglo bold uppercase" role="status" aria-hidden="true"></span>Loading...').attr('disabled', true);

            var start_time = $("#start_time").val();
            var end_time = $("#end_time").val();
            var late_mark = $("#late_mark").val();
            var mark_attendance;

            if ($('#mark_attendance').is(':checked')) {
                mark_attendance = 1;
            } else {
                mark_attendance = 0;
            }
            $.easyAjax({
                type: 'POST',
                url: "{!! route('admin.attendance_settings.update') !!}",
                data: {
                    "start_time": start_time,
                    "end_time": end_time,
                    'mark_attendance': mark_attendance,
                    "late_mark": late_mark
                },
                container: ".ajax-form",
            });
            $('#update_settings').html('Update').attr('disabled', false);

        }


    </script>
    <!-- END PAGE LEVEL PLUGINS -->
@stop
