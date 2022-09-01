@extends('admin.adminlayouts.adminlayout')

@section('head')


@stop

@section('content')
<div class="subheader">
    <h1 class="subheader-title">
        <i class=" subheader-icon fal fa-user-clock"></i>Employee Tasks<span class='fw-300'></span> <sup class='badge badge-primary fw-500'></sup>
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
                    <i class="fal fa-user-clock"></i>&nbsp;&nbsp;&nbsp;Employee Tasks <span class="fw-300"><i></i></span>
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                </div>
            </div>
            <div class="panel-container show">
                {{-- <a class="btn btn-primary float-right m-3" id="btn-add"
                        href=" {{ route('front.employee_tasks.create') }} ">
                Add Task
                </a> --}}
                <div class="panel-content" id="myform">
                    <div class="row filter-row">
                        <div class="col-sm-3 col-xs-6 my-2">
                            <div class="form-group form-focus">
                                <label class="control-label">@lang('core.employeeName')</label>
                                <select class="select2 form-control w-100" name="employee_id" id="employee_id">
                                    <option value="all">All</option>
                                    @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->full_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6 my-2">
                            <div class="form-group form-focus">
                                <label class="control-label">Project Name</label>
                                <select class="select2 form-control w-100" name="project_id" id="project_id">
                                    <option value="all">All</option>
                                    @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6 my-2">
                            <div class="form-group form-focus">
                                <label class="control-label">Select Date</label>
                                <input type="text" class="form-control datepicker-1" name="date" placeholder="Select date" value="">
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-6 my-2" >
                            <div class="form-group form-focus">
                                <label class="control-label">&nbsp;</label>
                                <button type="button" id="submit" class="btn btn-success" return false;">
                                    Search
                                </button>
                            </div>
                        </div>
                        <div class="col-sm-6 my-5">
                            <div class="form-group form-focus">
                                <label class="control-label">&nbsp;</label>
                                <button type="button" class="btn btn-danger clear-search">
                                    Clear
                                </button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel-container show">
                                <div class="panel-content">
                                    <table id="employee-task-table" class="table table-bordered table-hover table-striped w-100">
                                        <thead class="bg-primary-600">
                                            <tr>
                                                <th>Id </th>
                                                <th>Employee Name</th>
                                                <th>Project Name </th>
                                                <th>Title</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Hour</th>
                                                {{-- <th>Description</th> --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <input type="text" id="start-date" value="" hidden>
    <input type="text" id="end-date" value="" hidden>

    <div class="modal fade show_task" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal-data">
        <div class="modal-dialog">
            <div class="modal-content" id="task-content">
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_js')


<script type="text/javascript">
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
            var table = $('#employee-task-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.ajax_employee_tasks') }}",
                    data: {
                        employee_id: function() {
                            return $('#employee_id').val()
                        },
                        project_id: function() {
                            return $('#project_id').val()
                        },
                        startDate: function() {
                            return $('#start-date').val()
                        },
                        endDate: function() {
                            return $('#end-date').val()
                        },
                    },
                },
              
                columns: [{
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'employee_name',
                    name: 'employee_name',
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
                // {
                // data: 'description',
                // name: 'description',
                // orderable: false
                // },
                {
                    data: 'edit',
                    name: 'edit',
                    orderable: false
                },
            ],
            order: [[3,'desc'],[2,'asc']],
            rowGroup: {
                dataSrc: ['project_name','date']
            },
            lengthChange: true,

        });


        $('#submit').click(function() {
            table.ajax.reload(null, false);
        });

        $('.clear-search').click(function() {
            $("#employee_id").val('all').change();
            $("#project_id").val('all').change();
            $('#start-date').val(moment(firstDay).format('YYYY-MM-DD'));
            $('#end-date').val(moment(lastDay).format('YYYY-MM-DD'));
            $('input[name="datepicker-1"]').on('clear-search.daterangepicker', function(ev, picker) {
                $(this).val('')
                picker.setStartDate({})
                picker.setEndDate({})
            });
            // $('.datepicker-1').daterangepicker({
            //     opens: 'left',
            //     locale: {
            //         format: 'DD-MM-YYYY'
            //     },
            //     startDate: firstDay,
            //     endDate: lastDay,
            // });
            table.ajax.reload(null, false);
        });

    });



    function showView(id) {
        var get_url = "{{ route('admin.employee_tasks.show', ':id') }}";
        get_url = get_url.replace(':id', id);
        // $('#modal-data').modal('show', get_url);
        $.ajaxModal('#modal-data', get_url);

        $.ajax({
            type: 'GET',
            url: get_url,
            // data: {},
            success: function(response) {
                $('#task-content').html(response);
            },

            error: function(xhr, textStatus, thrownError) {
                $('#task-content').html(
                    '<div class="alert alert-danger">Error Fetching data</div>');
            }
        });
    }
</script>
@endsection