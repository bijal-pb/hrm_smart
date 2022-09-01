
@extends('front.layouts.frontlayout')

@section('head')
<!-- {{-- {!! HTML::style("assets/global/css/components.css")!!} --}}
                {!! HTML::style('assets/global/css/plugins.css') !!}
                {!! HTML::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!} -->  
@stop


@section('content')
<div class="subheader">
    <h1 class="subheader-title">
        <i class=" subheader-icon fal fa-user-clock"></i>Tasks<span class='fw-300'></span> <sup class='badge badge-primary fw-500'></sup>
        {{-- <small>
            Insert page description or punch line
        </small> --}}
    </h1>
</div>
<!-- Your main content goes below here: -->
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    <i class="fal fa-user-clock"></i>&nbsp;&nbsp;&nbsp;Tasks <span class="fw-300"><i></i></span>
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                </div>
            </div>
            <div class="panel-container show">
                <button type="button" class="btn btn-primary float-right m-3" data-toggle="modal" data-target=".default-example-modal-right-lg">Add Task</button>
                <div class="panel-content">
                    <div class="row filter-row">
                        <div class="col-sm-4 col-xs-6">
                            <div class="form-group form-focus">
                                <label class="form-label">Select a Date</label>
                                <input type="text" class="form-control datepicker-1" name="date" placeholder="Select date" value="">
                            </div>
                        </div>
                    </div>
                    <br>
                    <table id="task-table" class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline">
                        <thead class="bg-primary-600">
                            <tr>
                                <th>Id </th>
                                <th>Project Name </th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Hour</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal Right Large -->
    <div class="modal fade default-example-modal-right-lg" id="taskModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-right modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">Add Task</h5>
                    <hr />
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                {!! Form::open(['route' => 'front.employee_tasks.store', 'class' => 'form-horizontal ajax_form', 'method' => 'POST']) !!}
                <div class="modal-body">
                    <div class="card mb-3">
                        <div class="card-body p-1 mb-2">
                            <div class="row">
                                <div class="col-md-3" style="padding-right: 1px !important; padding-left: 1px !important;">
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
                                <div class="col-md-4 1 box">
                                    <div class="form-group">
                                        <label class="control-label col-md-12" style="padding-right: 1px !important; padding-left: 1px !important;">Project Name:</label>
                                        <div class="col-md-12" style="padding-right: 1px !important; padding-left: 1px !important;">
                                            <select class="select2 form-control w-100" name="project_scope" id="project_scope">
                                                <option value="">Select Project</option>
                                                @foreach ($projects as $project)
                                                <option value="{{ $project->project_id }}">{{ $project->project_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 2 box">
                                    <div class="form-group">
                                        <label class="control-label col-md-12" style="padding-right: 1px !important; padding-left: 1px !important;">Project Name:</label>
                                        <div class="col-md-12" style="padding-right: 1px !important; padding-left: 1px !important;">
                                            <select class="select2 form-control w-100" name="project_support" id="project_support">
                                                <option value="">Select Project</option>
                                                @foreach ($all_projects as $all_project)
                                                <option value="{{ $all_project->id }}">{{ $all_project->project_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">

                                        <label class="control-label">Date:</label>
                                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button"><i class="fal fa-calendar"></i>
                                                </button>
                                            </span>
                                            <input type="text" placeholder="select date" class="form-control" name="date" id="date" value="{{ date('Y-m-d', time()) }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-4" style="padding-right: 1px !important; padding-left: 1px !important;">
                                    <div class="form-group">
                                        <div class="col-md-12 input-group">
                                            <button type="button" name="add-project" id="add-project" class="btn btn-success waves-effect waves-themed add-project"><span><i class="fal fa-plus"></i></span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="projects" class="projects">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary " id="taskSubmit" onclick="ajaxCreateEmployeeTask()">
                        {{ trans('core.btnSubmit') }}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <input type="text" id="start-date" value="" hidden>
    <input type="text" id="end-date" value="" hidden>
</div>
<div class="modal fade show_task" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal-data">
    <div class="modal-dialog">
        <div class="modal-content" id="task-content">
        </div>
    </div>
</div>
<div class="modal fade edit_task" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="data-model">
    <div class="modal-dialog">
        <div class="modal-content" id="edit-task-content">
        </div>
    </div>
</div>
@include('front.common.delete')
<style>
    .bootstrap-timepicker-widget.dropdown-menu.open {
        display: inline-block;
        z-index: 99999 !important;
    }
</style>
@endsection

@section('page_js')

{!! HTML::script('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js') !!}

<script type="text/javascript">
    var table;
    var projects = [];

    var date = new Date();
    var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
    var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    $('#start-date').val(moment(firstDay).format('YYYY-MM-DD'));
    $('#end-date').val(moment(lastDay).format('YYYY-MM-DD'));

    $(document).ready(function() {

        $('.datepicker-1').daterangepicker({
            opens: 'left',
             locale: {
                 format: 'DD-MM-YYYY'
            },
         startDate: firstDay,
         endDate: lastDay,
        }, function(startDate, endDate, label) {
            $('#start-date').val(startDate.format('YYYY-MM-DD'));
            $('#end-date').val(endDate.format('YYYY-MM-DD'));
             table.ajax.reload(null, false);
        });

        table = $('#task-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('front.ajax_employee_tasks') }}",
                data: {
                    startDate: function() {
                        return $('#start-date').val()
                    },
                    endDate: function() {
                        return $('#end-date').val()
                    },
                },
            },
            // "ajax": "{{ route('front.ajax_employee_tasks') }}",
            columns: [{
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'project_name',
                    name: 'project_name',
                },
                {
                    data: 'title',
                    name: 'title',
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'hour',
                    name: 'hour'
                },
                {
                    data: 'edit',
                    name: 'edit',
                    orderable: false
                },
            ],
            order: [0, 'desc'],
            lengthChange: true,


        });
        $(document).on('click','.timepicker1',function(){
                console.log($(this).attr('class'))
                $(this).timepicker({
                    showMeridian: false,
                    timeFormat: 'H:mm',
                    showInputs: false
                });
            })
        $('.date-picker').datepicker({
            defaultDate: 'now',
            format: 'yyyy-mm-dd',
            startDate: '-1D',
            endDate: '+0D',
            todayHighlight: true,
            // startDate: new Date(),
        });

        $(document).on('change','#project-type1',function(){
            $(this).find("option:selected").each(function() {
                var optionValue = $(this).val()
                
                if (optionValue == 1) {
                    $(document).find(".scopeSelect").show();
                    $(document).find(".supportSelect").hide();
                } else {
                    $(document).find(".scopeSelect").hide();
                    $(document).find(".supportSelect").show();
                }
            });
        })
        
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


        $('.add-project').click(function() {
            var typeval = $('#type').val()
            var type = $('#type').val() == 1 ? 'scope' : 'support';
            var pId = "#project_" + type;
            var projectId = $(pId).val();
            var plabel = pId + " option:selected"
            var projectName = $(plabel).text();
            var ProjectDate = $('#date').val();
            if (projects.includes(projectId)) {
                toastr['warning']('Already project added!');
                return false;
            }
            projects.push(projectId);
            if (projectId == '') {
                toastr['warning']('Please select project!');
                return false;
            }
            $('.projects:first').prepend(`<div class="project" id="project_` + projectId + `" name="project[][` + projectId + `]">
                <div class="card mb-1"> 
                    <div class="card-body p-1">
                        <div class="row col-md-12">
                            <div class="col-md-10"><h4 class="ml-2"> ` + projectName + `</h4></div>
                            <div class="col-md-1 text-right"><h5><span class="btn badge badge-success add-project-task" data-id="` + projectId + `"><i class="fal fa-plus"></i> Task</span></h5></div>
                            <div class="col-md-1"><h5><span class="btn badge badge-danger remove-project" data-id="project_` + projectId + `"><i class="fal fa-close"></i> Project</span></h5></div>
                        </div>
                        <hr />
                        <div class="tasks col-md-12" id="task_` + projectId + `">
                            <div class="form-group" data-id="0">
                                <div class="row">
                                    <input type="hidden" id="type_` + projectId + `" name="project[` + projectId + `][0][type]" value="` + typeval + `">
                                    <input type="hidden" name="project[` + projectId + `][0][project_id]" value="` + projectId + `"> 
                                    <input type="hidden" id="date_` + projectId + `" name="project[` + projectId + `][0][date]" value="` + ProjectDate + `"> 
                                    <div class="col-md-6">
                                        <label class="form-label">Title</label>
                                        <input class="form-control col-md-12" name="project[` + projectId + `][0][title]" type="text" placeholder="title"></input>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Hour:</label>
                                        <input type='text' class="form-control timepicker" name="project[` + projectId + `][0][hour]" value="01:00" />
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label class="form-label">Status</label>
                                        <select id="type" name="project[` + projectId + `][0][status]" class="form-control">
                                            <option value="inprogress">In Progress</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">Description </label>
                                        <textarea class="form-control" id="description" rows="1" name="project[` + projectId + `][0][description]"></textarea>
                                    </div>
                                </div>
                                <div class="row float-right mt-1 mb-3">
                                    <span class="badge badge-danger float-right mr-3 btn btn-sm remove-task"><i class="fal fa-close"></i> Task</span>
                                </div>
                                <hr class="mt-5">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>`);
            $('#projects').find(".timepicker").timepicker({
                showMeridian: false,
                timeFormat: 'H:mm',
                showInputs: false
            });

            var pId = "#project_" + type;
            $(pId).val('').change();
        });

        $(document).on('click', '.remove-project', function() {
            var prId = $(this).data('id');
            let index = projects.indexOf(prId);
            projects.splice(index, 1);
            $('#' + prId).remove();
        });

        $(document).on('click', '.add-project-task', function() {
            var pId = $(this).data('id');
            let tId = $("#task_" + pId).children('div').data('id');
            tId = parseInt(tId) + 1;
            let taskDate = $("#date_" + pId).val();
            let typeVal = $("#type_" + pId).val();
            $('#task_' + pId).prepend(`
                <div class="form-group" data-id="` + tId + `">
                    <input type="hidden" name="project[` + pId + `][` + tId + `][type]" value="` + typeVal + `">
                    <input type="hidden" name="project[` + pId + `][` + tId + `][project_id]" value="` + pId + `"> 
                    <input type="hidden" name="project[` + pId + `][` + tId + `][date]" value="` + taskDate + `"> 
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Title</label>
                            <input class="form-control col-md-12" name="project[` + pId + `][` + tId + `][title]" type="text" placeholder="title"></input>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Hour:</label>
                            <input type='text' class="form-control timepicker" name="project[` + pId + `][` + tId + `][hour]" value="01:00" />
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select id="type" name="project[` + pId + `][` + tId + `][status]" class="form-control">
                                <option value="inprogress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Description </label>
                            <textarea class="form-control" id="description" rows="1" name="project[` + pId + `][` + tId + `][description]"></textarea>
                        </div>
                    </div>
                    <div class="row float-right mt-1 mb-3">
                        <span class="badge badge-danger float-right mr-3 btn btn-sm remove-task"><i class="fal fa-close"></i> Task</span>
                    </div>
                    <hr class="mt-5" />
                </div>
                
            `);
            $('#projects').find(".timepicker").timepicker({
                showMeridian: false,
                timeFormat: 'H:mm',
                showInputs: false
            });
        });

        $(document).on('click', '.remove-task', function() {
            $(this).parent('div').parent('div').remove();
        });


    }); 
    

    function showedit(id) {
        var get_url = "{{ route('front.employee_tasks.edit', ':id') }}";
        get_url = get_url.replace(':id', id);
        $('#data-model').modal('show', get_url);
        // $.ajaxModal('#showModal', get_url);

        $.ajax({
            type: 'GET',
            url: get_url,

            data: {},
            success: function(response) {
                $('#edit-task-content').html(response);
            },

            error: function(xhr, textStatus, thrownError) {
                $('#edit-task-content').html(
                    '<div class="alert alert-danger">Error Fetching data</div>');
            }
        });
    }

    function ajaxUpdateTask(id) {
        $('#taskUpdate').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Loading...').attr('disabled', true);
        var url = "{{ route('front.employee_tasks.update',':id') }}";
        url = url.replace(':id', id);
        $.easyAjax({
            url: url,
            type: "POST",
            data: $(".ajax_form").serialize(),
            container: ".ajax_form",
            success: function(response) {
                if (response.status == "success") {
                    toastr['success']('Tasks Updated Successfully');
                    $('.edit_task').modal('hide');
                    table.ajax.reload(null, false);
                    $('#taskUpdate').html('Submit').attr('disabled', false);

                }
                if (response.status == "error") {
                    toastr['error'](response.message);
                    $('#taskUpdate').html('Submit').attr('disabled', false);
                }
            }
        });
    }

    function showView(id) {
        var get_url = "{{ route('front.employee_tasks.show', ':id') }}";
        get_url = get_url.replace(':id', id);
        $('#modal-data').modal('show', get_url);
        // $.ajaxModal('#showModal', get_url);

        $.ajax({
            type: 'GET',
            url: get_url,

            data: {},
            success: function(response) {
                $('#task-content').html(response);
            },

            error: function(xhr, textStatus, thrownError) {
                $('#task-content').html(
                    '<div class="alert alert-danger">Error Fetching data</div>');
            }
        });
    }

    // Clicking the save button on the open modal for both CREATE and UPDATE
    function del(id, name) {

        $('#deleteModal').modal('show');

        $("#deleteModal").find('#info').html('Are you sure ! You want to delete <strong>' + name + '</strong> ?');

        $('#deleteModal').find("#delete").off().click(function() {

            var url = "{{ route('front.employee_tasks.destroy', ':id') }}";
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
                    if (response.status == "success") {
                        $('#deleteModal').modal('hide');
                        toastr['success']('Deleted successfully!');
                        window.location.reload();
                        // table.fnDraw();
                    }
                }
            });

        });
    }

    function ajaxCreateEmployeeTask() {
        $('#taskSubmit').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Loading...').attr('disabled', true);
        $.ajax({
            type: 'POST',
            url: "{!! route('front.employee_tasks.store') !!}",
            data: $(".ajax_form").serialize(),
            success: function(response) {
                if (response.status == "success") {
                    $('#taskModal').modal('hide');
                    toastr['success'](response.message);
                    table.ajax.reload(null, false);
                    projects = [];
                     $('#projects').html('');
                     $('#taskSubmit').html('Submit').attr('disabled', false);
                }
                if (response.status == "error") {
                    toastr['error'](response.message);
                    $('#taskSubmit').html('Submit').attr('disabled', false);
                }
            }
          
        });
        // $('#taskSubmit').html('Submit').attr('disabled', false);
    }
</script>
@endsection