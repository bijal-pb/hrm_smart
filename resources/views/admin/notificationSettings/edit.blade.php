@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    <!-- BEGIN THEME STYLES -->
@stop


@section('content')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
        <i class="fal fa-bell"></i>
                {{trans('core.emailNotificationSettings')}}
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
                <span class="active">{{trans('core.emailNotificationSettings')}}</span>
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
                        <h2> <i class="fal fa-bell"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@lang('Notification settings')</h2>
                            <div class="panel-toolbar">
                                <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                            </div>
                        </div>
             <div class="panel-container show">
               <div class="panel-content" >
                    <!------------------------ BEGIN FORM ---------------------->
                    {!!  Form::open(['class'=>'form-horizontal ajax-form'])  !!}
                    <div class="form-body">
                        <ul>
                        <div class="form-group">
                          <li>  <label class="col-md-2 form-label">{{trans('core.awards')}} : </label>
                            <div class="col-md-6">
                                <input type="checkbox" value="1" class="make-switch" name="award_notification"
                                       @if($loggedAdmin->company->award_notification==1)checked @endif data-on-color="success"
                                       data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}"
                                       data-off-color="danger">
                            </div>
                        </div>

                        <div class="form-group">
                            <li><label class="col-md-2 form-label">{{trans('core.attendance')}}:</label>
                            <div class="col-md-6">
                                <input type="checkbox" value="1" class="make-switch" name="attendance_notification"
                                       @if($loggedAdmin->company->attendance_notification==1)checked
                                       @endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}"
                                       data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
                            </div>
                        </div>
                        <div class="form-group">
                            <li><label class="col-md-2 form-label">{{trans('core.noticeBoard')}}:</label>
                            <div class="col-md-6">
                                <input type="checkbox" value="1" class="make-switch" name="notice_notification"
                                       @if($loggedAdmin->company->notice_notification == 1)checked
                                       @endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}"
                                       data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
                            </div>
                        </div>
                   
                   
                        <div class="form-group">
                            <li><label class="col-md-2 form-label">@lang("core.payroll"):</label>
                            <div class="col-md-6">
                                <input type="checkbox" value="1" class="make-switch" name="payroll_notification"
                                       @if($loggedAdmin->company->payroll_notification == 1)checked
                                       @endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}"
                                       data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
                            </div>
                        </div>


                        <div class="form-group">
                           <li> <label class="col-md-2 form-label">{{trans('core.leaveApplication')}}:</label>
                            <div class="col-md-6">
                                <input type="checkbox" value="1" class="make-switch" name="leave_notification"
                                       @if($loggedAdmin->company->leave_notification == 1)checked @endif data-on-color="success"
                                       data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}"
                                       data-off-color="danger">
                            </div>
                        </div>
                        <div class="form-group">
                           <li> <label class="col-md-2 form-label">{{trans('core.employeeAdd')}}:</label>
                            <div class="col-md-6">
                                <input type="checkbox" value="1" class="make-switch" name="employee_add"
                                       @if($loggedAdmin->company->employee_add == 1)checked @endif data-on-color="success"
                                       data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}"
                                       data-off-color="danger">
                            </div>
                        </div>
                        <div class="form-group">
                            <li><label class="col-md-2 form-label">{{trans('core.expenseClaim')}}:</label>
                            <div class="col-md-6">
                                <input type="checkbox" value="1" class="make-switch" name="expense_notification"
                                       @if($loggedAdmin->company->expense_notification == 1)checked
                                       @endif data-on-color="success" data-on-text="{{trans('core.btnYes')}}"
                                       data-off-text="{{trans('core.btnNo')}}" data-off-color="danger">
                            </div>
                        </div>

                        <!------------------------- END FORM ----------------------->
                        </ul>
                    </div>
                    <div class="form-actions">
                             <p class="text-center">
                                <button type="submit" onclick="updateSetting();return false;"
                                class="btn btn-primary">{{trans('core.btnUpdate')}}</button>
                            </p>
                    </div>
                    {!!  Form::close()  !!}
                </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>

        </div>
    </div>
    <!-- END PAGE CONTENT-->



@stop

@section('page_js')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js") !!}
    {!! HTML::script('assets/admin/pages/scripts/components-dropdowns.js')  !!}



    <script>
        jQuery(document).ready(function () {
            // ComponentsDropdowns.init();
        });

        function updateSetting() {
            var url = "{{ route('admin.notification.update') }}";
            $.easyAjax({
                type: 'POST',
                url: url,
                data: $(".ajax-form").serialize(),
                container: ".ajax-form",
                success: function (response) {
                    if (response.status === "success") {
                        $('#showModal').modal('hide');
                        toastr['success']('Updated successfully!');
                        window.location.reload();
                    }

                }
            });
            
        }
    </script>
    <!-- END PAGE LEVEL PLUGINS -->
@stop
