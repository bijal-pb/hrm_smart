@extends('front.layouts.frontlayout')

@section('head')
<!-- BEGIN PAGE LEVEL STYLES -->
{{-- {!! HTML::style("assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css") !!} --}}
<!-- BEGIN THEME STYLES -->

@stop
@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    <i class="fal fa-user-clock"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Project Task
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                </div>
            </div>
            {{-- <div class="col-md-12 form-group text-right">
                <span id="load_notification" class="hidden-xs"></span>
                <input type="checkbox" onchange="ToggleEmailNotification('award_notification');return false;"
                    class="make-switch" name="award_notification" @if ($loggedAdmin->company->award_notification == 1) checked @endif
                    data-on-color="success" data-on-text="<i class='fa fa-bell-o'></i>"
                    data-off-text="<i class='fa fa-bell-slash-o'></i>" data-off-color="danger">
                <span class="hidden-xs"><strong>{{ trans('core.emailNotification') }}</strong></span>
        </div> --}}

        <div class="panel-container show">
            <div class="panel-content">
                <!-- BEGIN FORM-->
                {!! Form::open(['route' => 'front.employee_tasks.store', 'class' => 'form-horizontal ajax_form', 'method' => 'POST']) !!}
                {{-- <input type="hidden" name="project_id" class="form-control" id="project_id" value="{{ $project->id }}"> --}}

                <div class="form-body">
                    <div class="row mx-md-n5">
                        <div class="col px-md-5">
                            <div class="form-group">
                                <label class="control-label col-md-12">Select Task Type: </label>
                                <div class="col-md-12 input-group" id="project-type">
                                    <select id="type" name="type" class="form-control">
                                        <option value="1">Scope</option>
                                        <option value="2">Support</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col px-md-5 1 box">
                            <div class="form-group">
                                <label class="control-label col-md-12">Project Name:</label>
                                <div class="col-md-12">
                                    <select class="select2 form-control w-100" name="project_scope" id="project_scope">
                                        <option value="">Select Project
                                        </option>
                                        @foreach ($projects as $project)
                                        <option value="{{ $project->project_id }}">
                                            {{ $project->project_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col px-md-5 2 box">
                            <div class="form-group">
                                <label class="control-label col-md-12">Project Name:</label>
                                <div class="col-md-12">
                                    <select class="select2 form-control w-100" name="project_support" id="project_support">
                                        <option value="">Select Project
                                        </option>
                                        @foreach ($all_projects as $all_project)
                                        <option value="{{ $all_project->id }}">
                                            {{ $all_project->project_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col px-md-5">
                            <div class="form-group">

                                <label class="control-label col-md-3">Date:</label>
                                <div class="col-md-12">
                                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="fal fa-calendar"></i>
                                            </button>
                                        </span>
                                        <input type="text" placeholder="select date" class="form-control" name="date" value="{{ date('Y-m-d', time()) }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col px-md-5">
                            <div class="form-group">
                                <div class="col-md-12 input-group my-4">
                                    <button type="button" name="add" id="add" class="btn btn-success waves-effect waves-themed"><i class="fal fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="dynamicForm">
                    <div class=" row col-md-12 form-group">
                        <div class="col-md-4">
                            <label class="col-md-2 form-label">Hour:</label>
                            <input type='text' class="form-control timepicker" name="addmore[0][hour]" value="01:00" />
                        </div>
                        <div class="col-md-4">
                            <label class="col-md-2 form-label">Title</label>
                            <input class="form-control" name="addmore[0][title]" type="text" placeholder="title"></input>
                        </div>
                        <div class="col-md-4">
                            <label class="col-md-2 form-label">Status</label>
                            <input class="form-control" name="addmore[0][status]" type="text" placeholder="status"></input>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 form-label">{{ trans('core.description') }}: <span class="required">
                                * </span>
                        </label>
                        <div class="col-md-12">
                            <textarea class="form-control" id="description" name="addmore[0][description]"></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
            <br>
            <div class="form-actions">
                <div class="form-group text-center">
                    <button type="button" class="btn btn-primary " id="taskSubmit" onclick="ajaxCreateEmployeeTask()">
                        {{ trans('core.btnSubmit') }}</button>
                </div>
            </div><br>
            {!! Form::close() !!}
            <!-- END FORM-->
        </div>
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
</div>
<!-- END PAGE CONTENT-->
</div>

@stop

@section('page_js')

<!-- BEGIN PAGE LEVEL PLUGINS -->

{{-- {!! HTML::script('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js')  !!} --}}
<script>
    $(document).ready(function() {

        $("#project-type").change(function() {
            $(this).find("option:selected").each(function() {
                var optionValue = $(this).attr("value");
                if (optionValue) {
                    $(".box").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else {
                    $(".box").hide();
                }
            });
        }).change();

        $("." + 1).show();


        $('#description').summernote({
            height: 100,
        });

        var i = 0;
        $(document).on('click', '.btn-success', function() {

            ++i;
            $(this).parent().find('.btn-success').removeClass('btn-success').addClass('btn-success');
            // $('.btn-success').find('i').removeClass('fal fa-plus').addClass('fal fa-minus');

            $(".dynamicForm").append(`
                    <div class=" row col-md-12 form-group">
                        <div class="col-md-3">
                            <label class="col-md-2 form-label">Hour:</label>
                            <input type='text' class="form-control timepicker" name="addmore[' + i + '][hour]" value="01:00" />
                        </div>
                        <div class="col-md-3">
                            <label class="col-md-2 form-label">Title</label>
                            <input class="form-control" name="addmore[' + i + '][title]" type="text" placeholder="title"></input>
                        </div>
                        <div class="col-md-3">
                            <label class="col-md-2 form-label">Status</label>
                            <input class="form-control" name="addmore[' + i + '][status]" type="text" placeholder="status"></input>
                        </div>
                        <div class="col-md-3 input-group my-4">
                            <button type="button" name="remove" id="remove" class="btn btn-danger waves-effect waves-themed"><i class="fal fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 form-label">{{ trans('core.description') }}: <span class="required">
                                * </span>
                        </label>
                        <div class="col-md-12">
                            <textarea class="form-control" id="description" name="addmore[' + i + '][description]"></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div><hr>`);

            $('.dynamicForm').find(".timepicker").timepicker({
                formatTime: "H:i:m",
                showMeridian: false,
                showInputs: false,

            });
            var date = new Date();
            $('.dynamicForm').find(".datepicker-1").daterangepicker({
                minDate: date,
            });
            $(document).on('click', '.btn-danger', function() {
                $('.dynamicForm').remove();
            });

        });

    });


    $('.date-picker').datepicker({
        defaultDate: 'now',
        format: 'yyyy-mm-dd',
        startDate: '-1D',
        endDate: '+0D',
        todayHighlight: true,
        // startDate: new Date(),
    });

    // $('.timepicker').timepicker({
    //     showMeridian: true,
    //     minTime: {
    //     hour: 1,
    //     minute: 15
    //     },
    //     hourStep: 8,
    //     minuteStep: 15,
    //     showInputs: true,

    //  }); 

    $(function() {
        $('.timepicker').timepicker({
            showMeridian: false,
            timeFormat: 'H:mm',
            showInputs: false
        });
    });



    // $('.timepicker').timepicker({
    //     autoclose: true,
    //     minuteStep: 5,
    //     disableMousewheel: true,
    //     disableFocus: true
    // });


    function ajaxCreateEmployeeTask() {
        $('#taskSubmit').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Loading...').attr('disabled', true);
        $.easyAjax({
            url: "{!! route('front.employee_tasks.store') !!}",
            type: "POST",
            data: $(".ajax_form").serialize(),
            container: ".ajax_form",
        });
        $('#taskSubmit').html('Submit').attr('disabled', false);

    }
</script>
@stop