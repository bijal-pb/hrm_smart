@extends('admin.adminlayouts.adminlayout')

@section('head')

@stop


@section('content')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title">
            <h1>
                <i class="fal  fa-cog"></i>
                {{ $pageTitle }}
            </h1>
        </div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <!-- <li>
                    <a onclick="loadView('{{ route('admin.dashboard.index') }}')">{{ trans('core.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">@lang("core.settings")</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">@lang("core.profileSettings")</span>
                </li> -->
        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-lg-12">
            <div id="load">
                {{-- INLCUDE ERROR MESSAGE BOX --}}

                {{-- END ERROR MESSAGE BOX --}}
            </div>
        </div>
        <div class="col-md-6">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->


            <div id="panel-5" class="panel">
                <div class="panel-hdr">
                    <h2><i
                            class="fal fa-lock font-dark"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('core.loginDetails') }}
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                            data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                            data-offset="0,10" data-original-title="Fullscreen"></button>
                        {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                    </div>
                </div>


                <div class="panel-container show">

                    <!------------------------ BEGIN FORM---------------------->
                    {!! Form::open(['class' => 'form-horizontal ajax-form-login']) !!}

                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-4 form-label">{{ trans('core.name') }}: <span
                                    class="text-danger">*</span>
                            </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="name" placeholder="@lang(" core.name")"
                                    value="{{ $admin->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 form-label">{{ trans('core.loginEmail') }}: <span
                                    class="text-danger">*</span>
                            </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="email" placeholder="@lang("
                                    core.loginEmail")" value="{{ $admin->email }}">
                            </div>
                        </div>
                        <input type="hidden" name="type" value="login">
                        <!------------------------- END FORM ----------------------->

                    </div>
                    <div class="form-actions">
                        <p class="text-center">
                            <button type="button" onclick="updateLogin();return false;" class="btn btn-primary"><i
                                    class="fa fa-check"></i> {{ trans('core.btnUpdate') }}</button>
                        </p>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>
        </div>
        <div class="col-md-6">
            <div id="panel-5" class="panel">
                <div class="panel-hdr">
                    <h2><i class="fa fa-key font-dark"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('core.change') }}
                        {{ trans('core.password') }}</h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                            data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                            data-offset="0,10" data-original-title="Fullscreen"></button>
                        {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                    </div>
                </div>

                <div class="panel-container show">

                    <!------------------------ BEGIN FORM Change Password---------------------->
                    {!!  Form::open(['class'=>'form-horizontal ajax-form-password'])  !!}

                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-4 form-label">Current Password: <span
                                    class="text-danger">*</span>
                            </label>
                            <div class="col-md-12">
                                <input type="password" class="form-control" id="current" name="current"
                                    placeholder="current password">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 form-label">{{ trans('core.password') }}: <span
                                    class="text-danger">*</span>
                            </label>
                            <div class="col-md-12">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="{{ trans('core.password') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 form-label">{{ trans('core.confirmPassword') }}: <span
                                    class="text-danger">*</span>
                            </label>
                            <div class="col-md-12">
                                <input type="password" class="form-control" id="confirm" name="confirm"
                                    placeholder="{{ trans('core.confirmPassword') }}">
                            </div>
                        </div>
                        <!------------------------- END FORM Change Password ----------------------->
                    <input type="hidden" name="type" value="password">
<div class="form-actions">
    <p class="text-center">
            <button type="button" onclick="updatePassword();return false;" class="btn btn-primary"><i
                        class="fa fa-check"></i> {{trans('core.btnUpdate')}}</button>
    </p>
</div>
{!!  Form::close()  !!}
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->



@stop

@section('page_js')



    <script>
       function updateLogin() {
            $.easyAjax({
                type: 'POST',
                url: "{{ route(admin()->type.'.profile_settings.update_login') }}",
                data: $(".ajax-form-login").serialize(),
                container: ".ajax-form-login",
                success: function() {
                    location.reload();
                 }
            });
           
        }
        function updatePassword() {
            var password = $('#password').val();
            var confirm = $('#confirm').val();
            if(password === confirm){
                var formData = {
                    current: $('#current').val(),
                    password: $('#password').val(),
                };
                var ajaxurl = "{{ route(admin()->type.'.profile_settings.update') }}";
                $.easyAjax({
                    type: "POST",
                    url: ajaxurl,
                    data: formData,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    success: function (data) {
                        if(data.status == 'success')
                        {
                            $('#profileForm').trigger('reset');
                            toastr['success']('Password is changed successfully!!');
                        }
                        if(data.status == 'error')
                        {
                            toastr['error'](data.message);
                        }
                    },
                    error: function (data) {
                        toastr['error']('Something went wrong, Please try again!');
                        console.log('Error:', data);
                    }
                });
            }else{
                toastr['error']('Password and confirm password does not match.');
            }
            // $.easyAjax({
            //     type: 'POST',
            //     url: "{{ route(admin()->type.'.profile_settings.update') }}",
            //     data: $(".ajax-form-password").serialize(),
            //     container: ".ajax-form-password",
            // });
           // location.reload();
        }
    </script>
    <!-- END PAGE LEVEL PLUGINS -->
@stop
