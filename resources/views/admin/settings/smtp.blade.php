@extends('admin.adminlayouts.adminlayout')

@section('head')

@stop


@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="page-head">
    <div class="page-title">
        <h1>
            {{$pageTitle}}
        </h1>
    </div>
</div>
<!-- <div class="page-bar">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a onclick="loadView('{{route('admin.dashboard.index')}}')">{{trans('core.home')}}</a>
            <i class="fa fa-circle"></i>
        </li>

        <li>
            <span class="active"> {{trans('core.settings')}}</span>
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
                    <i class="fal fa-cog"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                <!------------------------ BEGIN FORM---------------------->
                {!! Form::model($setting, ['method' => 'POST','class'=>'form-horizontal', 'id' => 'updateSettings']) !!}

                <!-- <div id="alert">
                    @if($setting->mail_driver =='smtp')
                    @if($setting->verified)
                    <div class="alert alert-success">{{__('messages.smtpSuccess')}}</div>
                    @else
                    <div class="alert alert-danger">{{__('messages.smtpError')}}</div>
                    @endif
                    @endif
                </div> -->

                <input type="hidden" name="type" value="smtpSetting">
                <div class="form-body">

                    <div class="form-group">
                        <label class="col-md-2 control-label">MAIL DRIVER:
                        </label>
                        <div class="col-md-6">
                            <label class="radio-inline"><input type="radio" class="checkbox"
                                    onchange="getDriverValue(this);" value="mail" @if($setting->mail_driver == 'mail')
                                checked
                                @endif name="mail_driver">Mail</label>
                            <label class="radio-inline m-l-10"><input type="radio" onchange="getDriverValue(this);"
                                    value="smtp" @if($setting->mail_driver == 'smtp') checked
                                @endif name="mail_driver">SMTP</label>
                        </div>


                    </div>
                    <div id="smtp_div">
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{ trans('core.mailHost') }}:
                            </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="mail_host" placeholder=""
                                    value="{{ $setting->mail_host }}">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.mailPort')}}:</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="mail_port"
                                    value="{{ $setting->mail_port }}" placeholder="">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.mailUsername')}}:</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="mail_username"
                                    value="{{ $setting->mail_username}}" placeholder="">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.mailPassword')}}:</label>
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="mail_password"
                                    value="{{ $setting->mail_password}}" placeholder="">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">{{ trans('core.mailEncryption') }}:</label>
                            <div class="col-md-12">
                                {!! Form::select('mail_encryption', ['' => 'None', 'tls' => 'TLS', 'ssl' => 'SSL'],
                                \old('mail_encryption'),['class'=>'form-control']) !!}
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <!------------------------- END FORM ----------------------->

                    </div>
                </div>
                <div class="form-actions">
                    <div class="form-group">
                        <label class="col-md-2 control-label">From Name:</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="mail_from_name"
                                value="{{ $setting->mail_from_name}}" placeholder="">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">From Email:</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="mail_from_email"
                                value="{{ $setting->mail_from_email}}" placeholder="">
                            <span class="help-block"></span>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-offset-2 col-md-1">
                            <button type="submit" onclick="smtpSetting();return false;"
                                class="btn btn-primary">{{trans('core.btnUpdate')}}</button>

                        </div>
                        <div class="col-md-4">
                            <button type="submit" onclick="showModal();return false;"
                                class="btn btn-info">{{trans('core.btnSendTestMail')}}</button>

                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->

<div id="showModal" class="modal fade" tabindex="-1" data-backdrop="static_approve" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
                <div class="d-block position-absolute pos-top pos-left p-2 ">
                <h4 class="modal-title">Send test email to below email address</h4>
                </div>
            </div>
            <div class="modal-body">
                <!------------------------ BEGIN FORM---------------------->
                {!! Form::open(['method' => 'POST','class'=>'form-horizontal', 'id' => 'testEmail']) !!}
                <div class="form-body">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Email:
                        </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="test_email" value="{{ $setting->email }}">
                            <span class="help-block"></span>
                        </div>
                    </div>


                </div>


            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default btn-outline">@lang('core.btnCancel')</button>
                <button type="button" name="application_status" id="confirm" class="btn btn-primary">Submit</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@stop

@section('page_js')

<script>
    function smtpSetting() {

            var url = '{{route('admin.email-settings.updateMailConfig')}}';

            $.ajax({
                url: url,
                type: "POST",
                container: '#updateSettings',
                messagePosition: "inline",
                data: $('#updateSettings').serialize(),
                success: function (response) {
                    if (response.status == 'error') {
                        $('#alert').prepend('<div class="alert alert-danger">{{__('messages.smtpError')}}</div>')
                    } else {
                        $('#alert').show();
                    }
                }
            })

        }


        function showModal() {
            $('#showModal').modal('show');
            $('#showModal').find("#confirm").off().click(function () {

                var url = "{{ route('admin.smtp_settings.send-test-email') }}";
                $.ajax({
                    type: 'POST',
                    url: url,
                    container: '#testEmail',
                    messagePosition: 'inline',
                    data: $('#testEmail').serialize(),
                    success: function(response) {
                    toastr['success']('Email sent Successfully!');
                    $('#showModal').modal('hide');
               
            }
                   
                });

            });
        }

        function getDriverValue(sel) {
            if (sel.value == 'mail') {
                $('#smtp_div').hide();
                $('#alert').hide();
            } else {
                $('#smtp_div').show();
                $('#alert').show();
            }
        }

        @if ($setting->mail_driver == 'mail')
        $('#smtp_div').hide();
        $('#alert').hide();
        @endif
</script>
<!-- END PAGE LEVEL PLUGINS -->
@stop