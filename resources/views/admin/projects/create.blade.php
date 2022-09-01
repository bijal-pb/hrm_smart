@extends('admin.adminlayouts.adminlayout')



@section('content')
<div class="page-head">
    <div class="page-title">
        <h1>
            <i class="fal fa-list-alt"></i>
            Add Project
        </h1>
    </div>
</div>
{!! Form::open(['url' => 'admin/projects', 'class' => 'ajax_form form-horizontal', 'method' => 'POST']) !!}
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    <i class="fal fa-list-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Project
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

                <div class="form-body">
                    <div class="row mx-md-n5">
                        <div class="col px-md-5">
                            <div class="form-group">
                                <label class="col-md-4 form-label">Name<span class="required">
                                        * </span>
                                </label>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="name">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col px-md-5">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select date:<span class="required">
                                    * </span></label>
                                <div class="col-md-12">
                                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="fal fa-calendar"></i>
                                            </button>
                                        </span>
                                        <input type="text" class="form-control datepicker-1" name="start" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                                <label class="control-label col-md-3">End date:</label>
                                <div class="col-md-12">
                                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy"
                                        data-date-viewmode="years">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="fal fa-calendar"></i>
                                            </button>
                                        </span>
                                        <input type="text" class="form-control" name="end" id="end" readonly>
                                    </div>
                                </div>
                            </div> --}}<br>
                    <div class="row mx-md-n5">
                        <div class="col px-md-5">
                            <div class="form-group">
                                <label class="col-md-4 form-label">Estimated Hour<span class="required">
                                        * </span>
                                </label>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="estimated_hour" name="estimated_hour" placeholder="Estimated hour">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col px-md-5">
                            <div class="form-group">
                                <label class="col-md-4 form-label">Status<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-12">
                                    <select name="status" id="status" class="form-control">
                                        {{-- <option value="">select status</option> --}}
                                        <option value="not start"> Not started </option>
                                        <option value="in progress">In progress</option>
                                        <option value="completed">Completed</option>
                                        <option value="hold">Hold</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>

                            </div>
                        </div>
                    </div><br>
                    <div class="form-group">
                        <label class="col-md-4 form-label">Description
                            <span class="required">
                                * </span>
                            </span>
                        </label>
                        <div class="col-md-12">
                            <textarea class="form-control" name="description" id="description" placeholder="description"></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <br>
                    <div class="panel-hdr">
                        <h2>
                            <i class="fal fa-users-medical"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Project Allocation
                        </h2>
                    </div>
                    <table class="table table-bordered" id="dynamicTable">
                        <tr>
                            <th>Employee Name</th>
                            <th>Select Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Action</th>
                        </tr>
                        <td> <select class="select2 form-control w-100" name="addmore[0][employee_id]">
                                <option value="">select employee</option>
                                @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->full_name }}
                                </option>
                                @endforeach
                            </select>

                        </td>
                        <td> <input type="text" class="form-control datepicker-1" name="addmore[0][start_date]" placeholder="Select date" value="">

                        </td>
                        <td>
                            <div class="form-group">
                                <div class='input-group date'>
                                    <input type='text' class="form-control timepicker" name="addmore[0][start_time]" value="" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class='input-group date'>
                                    <input type='text' class="form-control timepicker" name="addmore[0][end_time]" value="" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td><button type="button" name="add" id="add" class="btn btn-success waves-effect waves-themed"><i class="fal fa-plus"></i></button></td>
                        </tr>
                    </table>
                    <div class="form-actions">

                        <div class="form-group text-center">
                            <button type="button" class="btn btn-primary " id="projectSubmit" onclick="ajaxCreateProject()">
                                {{ trans('core.btnSubmit') }}</button>
                        </div>

                    </div>
                    {{-- {!! Form::close() !!} --}}
                    <!-- END FORM-->
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->

    </div>
    <!-- END PAGE CONTENT-->
</div>
{!! Form::close() !!}

@stop

@section('page_js')
{!! HTML::script('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js') !!}

<script>
    $(function() {
        $('.timepicker').timepicker({
            // format: 'LT',
            showMeridian: false,
            timeFormat: 'H:i:m',
            showInputs: false,
        });
    });

    var i = 0;
    $(document).on('click', '.btn-success', function() {

                ++i;
                $(this).parent().find('.btn-success').removeClass('btn-success').addClass('btn-danger');
                $('.btn-danger').find('i').removeClass('fal fa-plus').addClass('fal fa-minus');

                    $("#dynamicTable").append('<tr><td><select class="select2 form-control w-100" name="addmore[' + i + '][employee_id]" id="employee_id"><option value="">select employee</option>@foreach ($employees as $employee)<option value="{{ $employee->id }}">{{ $employee->full_name }}</option>@endforeach</select></td><td><input type="text" class="form-control datepicker-1" name="addmore[' + i + '][start_date]" value="" placeholder="Select date"/></td><td><input type="text" name="addmore[' + i + '][start_time]" id="start_time" class="form-control timepicker"/><td> <input type="text" name="addmore[' + i + '][end_time]" id="end_time" class="form-control timepicker"/><td><button type="button" class="btn btn-success waves-effect waves-themed" id="add" name="add"><i class="fal fa-plus"></i></button></td></tr>');

                    $('#dynamicTable').find(".timepicker").timepicker({
                        formatTime: "H:i:m",
                        showMeridian: false,
                        showInputs: false,

                    });
                    var date = new Date();
                    $('#dynamicTable').find(".datepicker-1").daterangepicker({
                        minDate: date,
                    });
                    $(document).on('click', '.btn-danger', function() {
                        $(this).parents('tr').remove();
                    });

                });

            // $(document).on('click', '.remove-tr', function() {
            //     $(this).parents('tr').remove();
            // });
            // $('.date-picker').datepicker({
            //     dateFormat: 'dd-mm-yyyy',
            //     startDate: new Date(),
            // });

            $(document).ready(function() {
                var date = new Date();
                $('.datepicker-1').daterangepicker({
                    opens: 'left',
                    minDate: date,
                }, function(start, end, label) {
                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format(
                        'YYYY-MM-DD'));
                });
            });

            
             function ajaxCreateProject() {
                $('#projectSubmit').html('<span class="caption-subject font-red-sunglo bold uppercase" role="status" aria-hidden="true"></span>Loading...').attr('disabled', true);
                    $.easyAjax({
                        url: "{!! route('admin.projects.store') !!}",
                        type: "POST",
                        data: $(".ajax_form").serialize(),
                        container: ".ajax_form",
                        success: function(response) {
                            if (response.status == "success") {
                                toastr['success']('Project added successfully!');
                                window.location.href = '{{route('admin.projects.index')}}';
                                $('#projectSubmit').html('Submit').attr('disabled', false);
                               
                            }
                            if(response.status == "error") {
                                toastr['error'](response.message);
                                $('#projectSubmit').html('Submit').attr('disabled', false);
                            }
                            
                        }
                    });
                //    $('#projectSubmit').html('Submit').attr('disabled', false);
                }
</script>
@stop