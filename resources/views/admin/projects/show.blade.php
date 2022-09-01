@extends('admin.adminlayouts.adminlayout')



@section('content')
    {{-- <div class="page-head">
    <div class="page-title">
        <h1>
            <i class="fal fa-list-alt"></i>
            {{ $data->name }}
        </h1>
    </div>
    
</div> --}}
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-list-alt'></i> {{ $data->name }}
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <div class="d-inline-flex flex-column justify-content-center mr-3">
                <span class="fw-300 fs-xl d-block opacity-50">
                    <small>Start Date</small>
                </span>
                <span class="fw-500 fs-xxl d-block color-primary-500">
                    {{ date('Y-M-d', strtotime($data->start)) }}
                    {{-- {{ $data->start }} --}}
                </span>
            </div>
            <span class="sparklines hidden-lg-down" sparkType="bar" sparkBarColor="#886ab5" sparkHeight="32px"
                sparkBarWidth="5px" values="3,4,3,6,7,3,3,6,2,6,4"></span>
        </div>
        <div
            class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 ml-3 pl-3">
            <div class="d-inline-flex flex-column justify-content-center mr-3">
                <span class="fw-300 fs-xl d-block opacity-50">
                    <small>End Date</small>
                </span>
                <span class="fw-500 fs-xxl d-block color-danger-500">
                    {{ date('Y-M-d', strtotime($data->end)) }}
                    {{-- {{ $data->end }} --}}
                </span>
            </div>
            <span class="sparklines hidden-lg-down" sparkType="bar" sparkBarColor="#fe6bb0" sparkHeight="32px"
                sparkBarWidth="5px" values="1,4,3,6,5,3,9,6,5,9,7"></span>
        </div>
    </div>
    {{-- {!! Form::open(['url' => 'admin/projects', 'class' => 'ajax_form form-horizontal', 'method' => 'POST']) !!} --}}
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        <i class="fal fa-list-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Project Statistics
                        {{-- {{$data->id}} --}}
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                            data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                            data-offset="0,10" data-original-title="Fullscreen"></button>
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
                        <div class="row">
                            @if ($loggedAdmin->type == 'superadmin' || $loggedAdmin->company->award_feature == 1)
                                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                                    <div class="p-3 bg-info-300 rounded overflow-hidden position-relative text-white mb-g">
                                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                            <div class="number count">
                                                {{ $data->estimated_hour }}
                                            </div>
                                            <small class="m-0 l-h-n">
                                                {{ trans('Estimated hours') }}
                                            </small>
                                        </h3>
                                        <i class="fal fa-clock position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                                            style="font-size:6rem"></i>
                                        <!-- <a class="more" onclick="loadView('{{ route('admin.awards.index') }}')">
                                            {{ trans('core.viewMore') }} <i class="m-icon-swapright m-icon-white"></i>
                                        </a> -->
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                                    <div
                                        class="p-3 bg-danger-300 rounded overflow-hidden position-relative text-white mb-g">
                                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                            <div class="number count">
                                                {{ $data->actual_hour == null ? 0 : $data->actual_hour }}
                                            </div>
                                            <small class="m-0 l-h-n">
                                                {{ trans('Actual hours') }}
                                            </small>
                                        </h3>
                                        <i class="fal fa-hourglass-end position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                                            style="font-size:6rem"></i>
                                        <!-- <a class="more" onclick="loadView('{{ route('admin.departments.index') }}')">
                                        {{ trans('core.viewMore') }} <i class="m-icon-swapright m-icon-white"></i>
                                    </a> -->
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                                    <div
                                        class="p-3 bg-success-300 rounded overflow-hidden position-relative text-white mb-g">
                                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                            <div class="number count">
                                                {{ $result }}
                                            </div>
                                            <small class="m-0 l-h-n">
                                                {{ trans('Total Employees') }}
                                            </small>
                                        </h3>
                                        <i class="fal fa-users position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                                            style="font-size:6rem"></i>
                                        <!-- <a class="more" onclick="loadView('{{ route('admin.employees.index') }}')">
                                        {{ trans('core.viewMore') }} <i class="m-icon-swapright m-icon-white"></i>
                                    </a> -->
                                    </div>
                                </div>
                            @endif
                            <!-- @foreach ($detail as $d)
    -->

                            <!--
    @endforeach -->
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                                <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g">
                                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                        <div class="number count">
                                            {{ $hour[0]->total_hour == null ? 0 : $hour[0]->total_hour }}
                                            {{-- {{ $hour[0]->total_hour }} --}}
                                        </div>
                                        <small class="m-0 l-h-n">
                                            Scope Hours
                                        </small>
                                    </h3>
                                    <i class="fal fa-clock position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                                        style="font-size:6rem"></i>
                                    <!-- <a class="more" onclick="loadView('{{ route('admin.employees.index') }}')">
                                        {{ trans('core.viewMore') }} <i class="m-icon-swapright m-icon-white"></i>
                                    </a> -->
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                                <div class="p-3 bg-fusion-200 rounded overflow-hidden position-relative text-white mb-g">
                                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                        <div class="number count">
                                            {{ $support[0]->total_support == null ? 0 : $support[0]->total_support }}
                                            {{-- {{ $support[0]->total_support }} --}}
                                        </div>
                                        <small class="m-0 l-h-n">
                                            Support Hours
                                        </small>
                                    </h3>
                                    <i class="fal fa-clock position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                                        style="font-size:6rem"></i>
                                    <!-- <a class="more" onclick="loadView('{{ route('admin.employees.index') }}')">
                                        {{ trans('core.viewMore') }} <i class="m-icon-swapright m-icon-white"></i>
                                    </a> -->
                                </div>
                            </div>
                        </div>
                        <p id="p1" style="display:none;">{{ $data->id }}</p>

                        {{-- {!! Form::close() !!} --}}
                        <!-- END FORM-->
                    </div>
                </div>

                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
            <!-- END PAGE CONTENT-->
        </div>
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        <i class="fal fa-list-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Project Description
                        <input type="hidden" name="project_id" class="form-control" id="project_id"
                            value="{{ $data->id }}">
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
                    <div class="panel-content">
                        {{ $data->description }}
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
        </div>

            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            <i class="fal fa-users-medical"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Project Allocation
                            <input type="hidden" name="project_id" class="form-control" id="project_id"
                                value="{{ $data->id }}">
                        </h2>
                        <div>
                            <button class="btn btn-primary float-right m-3" onclick="showAdd();">
                                Add employee
                            </button>
                        </div>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Fullscreen"></button>
                            {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                        </div>
                    </div>


                    <div class="panel-container show">
                        <div class="panel-content">

                            <div id="emp">

                            </div>
                            <!-- END FORM-->
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div id="panel-1" class="panel">
                        <div class="panel-hdr">
                            <h2>
                                <i class="fal fa-user-check"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Project Status
                                <input type="hidden" name="project_id" class="form-control" id="project_id"
                                    value="{{ $data->id }}">
                            </h2>
                            <div class="panel-toolbar">
                                <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                    data-offset="0,10" data-original-title="Collapse"></button>
                                <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                    data-offset="0,10" data-original-title="Fullscreen"></button>
                                {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                            </div>
                        </div>
                        <div class="panel-container show">
                            <div class="panel-content">
                                <div class="row col-md-12 text-center">
                                    <div class="col-md-1"></div>
                                    <button type="button" id="inprogress"
                                        class="project_status btn btn-lg btn-outline-info col-md-2 ml-2 mr-2">In
                                        Progress</button>
                                    <button type="button" id="hold"
                                        class="project_status btn btn-lg btn-outline-warning col-md-2 ml-2 mr-2">Hold</button>
                                    <button type="button" id="completed"
                                        class="project_status btn btn-lg btn-outline-success col-md-2 ml-2 mr-2">Close</button>
                                        <button class="btn btn-lg btn-outline-danger col-md-2 ml-2 mr-2"
                                           onclick="delProject({{$data->id}})">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            
            <div class="modal fade add_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true" id="showModal" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content" id="employee-content">
                    </div>
                </div>
            </div>

            @include('admin.common.delete')
        @stop

        @section('page_js')

            <script>
                // $(document).ready(function($id) {
                //     //alert($id);

                //     var url = "{{ route('admin.projects.status_check', ':id') }}";
                //     url = url.replace(':id');

                //     $.ajax({
                //         type: 'POST',
                //         url: url,
                //         data: {
                //             project_id: $('#project_id').val(),
                //         },
                //         success: function(response) {

                //         }
                //     });
                // });
                function delProject(id, dept) {

                $('#deleteModal').modal('show');
                $("#deleteModal").find('#info').html('Are you sure ! You want to delete project?');

                $('#deleteModal').find("#delete").off().click(function () {
                    var url = "{{ route('admin.projects.destroy',':id') }}";
                    url = url.replace(':id', id);
                    var token = "{{ csrf_token() }}";

                    $.ajax({
                        type: 'DELETE',
                        url: url,
                        data: {'_token': token},
                        container: "#deleteModal",
                        success: function (response) {
                            if (response.status === "success") {
                                $('#deleteModal').modal('hide');
                                toastr['success']('Project deleted successfully!');
                                window.location.href = '{{route('admin.projects.index')}}'
                                // table.fnDraw();
                            }
                        }
                    });
                })

                }

                $('.project_status').on('click', function(e) {
                    var current_project_status = $(this).attr('id');
                    // console.log(parent_id);

                    $('.project_status').removeClass('active');
                    $(this).addClass('active');
                    var data = {
                        id: $("#p1").text(),
                        status: current_project_status,
                    }
                    var url = "{{ route('admin.projects.project_status', ':id') }}";
                    url = url.replace(':id', $("#p1").text());
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: data,
                        success: function(response) {
                            if (response == 'inprogress') {
                                toastr['success']('Project in Progress!');
                            }
                            if (response == 'hold') {
                                toastr['success']('Project is on Hold!');
                            }
                            if (response == 'completed') {
                                toastr['success']('Project is Completed!');
                            }
                        }
                    });
                });




                function showAdd() {
                    var url = "{{ route('admin.project_employees.create') }}";
                    $('#showModal').modal('show', url);

                    $.ajax({
                        type: 'GET',
                        url: url,
                        data: {
                            project_id: $('#project_id').val(),
                        },
                        success: function(response) {

                            $('#employee-content').html(response);
                            fetchedetail($("#p1").text());
                            $('#timepicker').timepicker({
                                // format: 'LT',
                                showMeridian: false,
                                timeFormat: 'H:i:m',
                                showInputs: false,
                            });

                            $('#timepicker-2').timepicker({
                                // format: 'LT',
                                showMeridian: false,
                                timeFormat: 'H:i:m',
                                showInputs: false,
                            });
                        },

                        error: function(xhr, textStatus, thrownError) {
                            $('#employee-content').html(
                                '<div class="alert alert-danger">Error Fetching data</div>');
                        }
                    });

                }

                function addSubmit() {
                    $('#submitbutton_add').html('<span class="caption-subject font-red-sunglo bold uppercase" role="status" aria-hidden="true"></span>Loading...').attr('disabled', true);
                    $.easyAjax({
                        type: 'POST',
                        url: "{{ route('admin.project_employees.store') }}",
                        container: '.ajax_form',
                        data: $('.ajax_form').serialize() + "&project_id=" + $('#project_id').val(),
                        success: function(response) {
                            if (response.status == "success") {
                                fetchedetail($("#p1").text());
                                $('#showModal').modal('hide');
                                $('.modal-backdrop').remove();
                                $('#submitbutton_add').html('Submit').attr('disabled', false);
                            } else {
                                toastr['error'](response.message);
                                $('#submitbutton_add').html('Submit').attr('disabled', false);
                            }  

                        }
                    });
                    // $('#submitbutton_add').html('Submit').attr('disabled', false);
                }

                $(document).ready(function() {
                    var employees = [];
                    fetchedetail($("#p1").text());
                    var date = new Date();
                    $('.datepicker-1').daterangepicker({
                        opens: 'left',
                        minDate: date,
                    }, function(start, end, label) {
                        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                            .format(
                                'YYYY-MM-DD'));
                    });

                });

                function ajaxCreateProject() {
                    $.ajax({
                        url: "{!! route('admin.projects.store') !!}",
                        type: "POST",
                        data: $(".ajax_form").serialize(),
                        container: ".ajax_form",
                        success: function(response) {
                            if (response.status == "success") {
                                toastr['success']('Project added successfully!');
                                table.ajax.reload(null, false);
                            }
                            if(response.status == "error") {
                                toastr['error'](response.message);
                            }
                        }
                    });
                }

                function fetchedetail(id) {
                    urls = "{!! route('admin.projects.employee', ':id') !!}".replace(':id', id)
                    $.ajax({
                        type: "GET",
                        url: urls,
                        dataType: "json",
                        success: function(response) {
                            $('#emp').html("");
                            employees = response.employees;
                            // console.log(response.project);
                            // console.log(response.employees);
                            for (i = 0; i < response.employees.length; i++) {
                                $('#emp').append(' <div class="col-xl-12">\
                                                        <div id="c_6" class="card border shadow-0 mb-g shadow-sm-hover" data-filter-tags="sarah mcbrook">\
                                                            <div class="card-body border-faded border-top-0 border-left-0 border-right-0 rounded-top">\
                                                                <div class="d-flex flex-row align-items-center">\
                                                                    <span class=" status-success mr-3">\
                                                                    <img class="rounded-circle profile-image d-block"  src=" ' +
                                    response
                                    .employees[i].profile_image + '" alt="no image">\
                                                                    </span>\
                                                                    <div class="info-card-text flex-1">\
                                                                        <a href="javascript:void(0);" class="fs-xl text-truncate text-truncate-lg text-info" data-toggle="dropdown" aria-expanded="false">\
                                                                        ' + response.employees[i].employee_name + '\
                                                                        </a>\
                                                                        <span class="text-truncate text-truncate-xl">' + response
                                    .employees[i]
                                    .designation + '</span>\
                                                                    </div>\
                                                                    <button class="js-expand-btn btn btn-sm btn-default d-none" data-toggle="collapse" data-target="#c_6 > .card-body + .card-body" aria-expanded="false">\
                                                                        <span class="collapsed-hidden">+</span>\
                                                                        <span class="collapsed-reveal">-</span>\
                                                                    </button>\
                                                                </div>\
                                                            </div>\
                                                            <div class="card-body id=date p-0 collapse show">\
                                                                <div class="d-flex col-md-12 my-4 flex-row">\
                                                                <input type="text" id="date_' + response.employees[i].id +
                                    '"  class="form-control col-md-3 datepicker-1" placeholder="Select date" name="datep" value="' +
                                    response.employees[i].start_date + ' - ' + response.employees[i].end_date + '">\
                                                                <div  class="col-md-3 input-group date">\
                                                                    <input type="text" id="start_time_' + response.employees[i]
                                    .id +
                                    '" class="form-control timepicker" name="start_time" value="' + response
                                    .employees[i].start_time + '"/>\
                                                                    <span class="input-group-addon">\
                                                                    <span class="glyphicon glyphicon-time"></span>\
                                                                    </span>\
                                                                    </div>\
                                                                    <div  class="col-md-3 input-group date">\
                                                                    <input type="text" id="end_time_' + response.employees[i].id +
                                    '" class="form-control timepicker" name="end_time" value="' + response
                                    .employees[i].end_time +
                                    '"/>\
                                                                    <span class="input-group-addon">\
                                                                    <span class="glyphicon glyphicon-time"></span>\
                                                                    </span>\
                                                                    </div>\
                                                                    <div class="d-flex">\
                                                                    <button  class="btn btn-outline-warning btn-icon waves-effect waves-themed mx-1" onclick="showEdit(' +
                                    response.employees[i].id +
                                    ')" ><i class="fa fa-edit"></i></button>\
                                                                       <button class="btn btn-outline-danger btn-icon waves-effect waves-themed mx-1"  onclick="del(' +
                                    response
                                    .employees[i].id + ')"><i class="fal fa-trash"></i></button>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                    </div>');

                                var date = new Date();
                                $('#emp').find(".datepicker-1").daterangepicker({
                                    minDate: date,
                                    locale: {
                                        format: 'YYYY-MM-DD'
                                    }
                                });
                                // $("#emp").setAttribute("readonly", true);
                                $('#emp').find(".timepicker").timepicker({
                                    showMeridian: false,
                                    timeFormat: "H:i:m",
                                    showInputs: false,
                                });
                                response.project.status == "in progress" ? $("#inprogress").addClass('active') :
                                    response.project.status == "hold" ? $("#hold").addClass('active') : $("#completed")
                                    .addClass('active');

                            }

                        },
                        error: function(xhr, textStatus, thrownError) {
                            alert("error call")
                        }
                    });
                }

                function showEdit(id) {
                    let date_range_val = '#date_' + id;
                    let time_start_range_val = '#start_time_' + id;
                    let time_end_range_val = '#end_time_' + id;
                    var emp_edit = {
                        id: id,
                        date: $(date_range_val).val(),
                        start_time: $(time_start_range_val).val(),
                        end_time: $(time_end_range_val).val(),
                    }
                    var url = "{!! route('admin.project_employees.update') !!}"

                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        data: emp_edit,
                        success: function(response) {
                            if (response.status == "success") {
                                toastr['success'](response.message);
                            } else {
                                toastr['error'](response.message);
                            }
                        }
                    });
                }

                function del(id) {
                    let emp = employees.find(o => o.id === id);
                    $('#deleteModal').modal('show');
                    $("#deleteModal").find('#info').html('Are you sure ! You want to delete <strong>' + emp.employee_name +
                        '</strong> ?');
                    $('#deleteModal').find("#delete").off().click(function() {
                        var url = "{{ route('admin.project_employees.destroy', ':id') }}";
                        url = url.replace(':id', id);
                        var token = "{{ csrf_token() }}";

                        $.ajax({
                            type: 'DELETE',
                            url: url,
                            data: {
                                '_token': token
                            },
                            container: "#deleteModal",
                            success: function(response) {
                                if (response.status === "success") {
                                    $('#deleteModal').modal('hide');
                                    toastr['success']('Employee deleted successfully!');
                                    fetchedetail($("#p1").text());
                                }

                            }
                        });
                    })
                }
                $(document).ready(function() {
                    var date = new Date();
                    $('.datepicker-1').daterangepicker({
                        opens: 'left',
                        minDate: date,
                    }, function(start_date, end_date, label) {
                        console.log("A new date selection was made: " + start_date.format('YYYY-MM-DD') + ' to ' +
                            end_date.format(
                                'YYYY-MM-DD'));
                    });
                });
            </script>
        @stop
