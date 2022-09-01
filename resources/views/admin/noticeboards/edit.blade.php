@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->

    {!! HTML::style('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
    {!! HTML::style('assets/global/plugins/select2/css/select2.css') !!}
    {!! HTML::style('assets/global/plugins/jquery-multi-select/css/multi-select.css') !!}
    <link rel="stylesheet" media="screen, print" href="css/formplugins/summernote/summernote.css">

    <!-- BEGIN THEME STYLES -->

@stop


@section('content')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title">
            <h1>
                <i class="fal fa-quote-left"></i>
                @lang("pages.noticeBoard.editTitle")
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
                    <a onclick="loadView('{{ route('admin.noticeboards.index') }}')">@lang("pages.noticeBoard.indexTitle")</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">@lang("pages.noticeBoard.editTitle")</span>
                </li> -->
        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->


    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            {{-- INLCUDE ERROR MESSAGE BOX --}}

            {{-- END ERROR MESSAGE BOX --}}


            <div id="panel-5" class="panel">
                <div class="panel-hdr">
                    <h2>
                        <i class="fal fa-quote-left"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@lang("core.noticeDetails")
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                            data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                            data-offset="0,10" data-original-title="Fullscreen"></button>
                        {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                    </div>
                </div>
                <div class="col-md-12 form-group text-right">
                    <div class="actions">
                        <span id="load_notification"></span>
                        <input type="checkbox" onchange="ToggleEmailNotification('notice_notification');return false;"
                            class="make-switch" name="notice_notification" @if ($loggedAdmin->company->notice_notification == 1)checked @endif
                            data-on-color="success" data-on-text="{{ trans('core.btnYes') }}"
                            data-off-text="{{ trans('core.btnNo') }}" data-off-color="danger">
                        <strong>{{ trans('core.emailNotification') }}</strong>
                    </div>
                </div>


                <div class="panel-container show">
                    <div class="panel-content">

                        <!-- BEGIN FORM-->
                        {!! Form::open(['route' => ['admin.noticeboards.update', $notice->id], 'class' => 'form-horizontal ajax_form', 'method' => 'PATCH']) !!}


                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-2 form-label">{{ trans('core.title') }}: <span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="title"
                                        placeholder="{{ trans('core.title') }}" value="{{ $notice->title }}">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 form-label">{{ trans('core.description') }}: <span
                                        class="required">
                                        * </span>
                                </label>
                               
                                <div class="col-md-12">
                                    <textarea class="form-control" id="description" name="description"
                                        rows="3">{{ $notice->description }}</textarea>
                                    <span class="help-block"></span>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 form-label">{{ trans('core.status') }}: <span
                                        class="required">
                                        * </span>
                                </label>
                                <div class="col-md-12">
                                    <select class="form-control" name="status">
                                        <option value="active" @if ($notice->status == 'active')selected @endif>@lang("core.active")</option>
                                        <option value="inactive" @if ($notice->status == 'inactive')selected @endif>@lang("core.inactive")</option>
                                    </select>

                                </div>
                            </div>
                            <br>

                            <div class="form-group text-center">
                                <button type="button" class="btn btn-primary" id="noticeUpdate"
                                    onclick="ajaxUpdateNotice({{ $notice->id }})">
                                    <i class="fal fa-check"></i> @lang("core.btnUpdate")</button>


                            </div>

                            {!! Form::close() !!}
                            <!-- END FORM-->

                        </div>
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
    {!! HTML::script('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
    {!! HTML::script('assets/global/plugins/select2/js/select2.js') !!}
    {!! HTML::script('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') !!}
    <script src="js/formplugins/summernote/summernote.js"></script>
    {!! HTML::script('assets/js/ajaxform/jquery.form.min.js') !!}
    <script>
        $('#description').summernote({
            height: 300
        });

        function ajaxUpdateNotice(id) {

            var val = $('#description').val();

            var url = "{{ route('admin.noticeboards.update', ':id') }}";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '.ajax_form',
                data: $('.ajax_form').serialize(),
            });
            window.location.href = '{{route('admin.noticeboards.index')}}'

        }
    </script>
    <!-- END PAGE LEVEL PLUGINS -->
@stop
