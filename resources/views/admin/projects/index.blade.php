@extends('admin.adminlayouts.adminlayout')
@section('content')
<div class="subheader">
    <h1 class="subheader-title">
        <i class=" subheader-icon fal fa-list-alt"></i>Projects<span class='fw-300'></span> <sup class='badge badge-primary fw-500'></sup>
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
                    <i class="fal fa-list-alt"></i>&nbsp;&nbsp;&nbsp; Projects <span class="fw-300"><i></i></span>
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                </div>
            </div>
            <div class="panel-container show">
                <a class="btn btn-primary float-right m-3" id="btn-add" href=" {{ route('admin.projects.create') }} ">
                    Add Project
                </a>
                <div class="panel-content">

                    <table id="project-table" class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline">
                        <thead class="bg-primary-600">
                            <tr>
                                <th>Id </th>
                                <th>Name </th>
                                {{-- <th>Description </th> --}}
                                <th>Start </th>
                                <th>End </th>
                                <th>Created Date </th>
                                <th>Status </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade edit_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="data-model">
    <div class="modal-dialog">
        <div class="modal-content" id="project-edit-content">
        </div>
    </div>
</div>
@include('admin.common.delete')
@endsection

@section('page_js')
<script type="text/javascript">
    $(document).ready(function() {
        var date = new Date();
        $('.datepicker-1').daterangepicker({
            opens: 'left',
            minDate: date,
        }, function(start_date, end_date, label) {
            console.log("A new date selection was made: " + start_date.format('YYYY-MM-DD') + ' to ' + end_date.format(
                'YYYY-MM-DD'));
        });

        var table = $('#project-table').DataTable({
            responsive: true,
            serverSide: true,
            "ajax": "{{ route('admin.ajax_projects') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                // {
                //     data: 'description',
                //     name: 'description',
                //     orderable: false
                // },
                {
                    data: 'start',
                    name: 'start'
                },
                {
                    data: 'end',
                    name: 'end'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'edit',
                    name: 'edit',
                    orderable: false
                },
            ],
            order: [0, 'desc'],
            lengthChange: true,
            dom: '<"float-left"B><"float-right"f>rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>',
            // "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
            // "<'row'<'col-sm-12'tr>>" +
            // "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [{
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    titleAttr: 'Generate PDF',
                    className: 'btn-outline-primary btn-sm mr-1'
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    titleAttr: 'Generate Excel',
                    className: 'btn-outline-primary btn-sm mr-1'
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    titleAttr: 'Generate CSV',
                    className: 'btn-outline-primary btn-sm mr-1'
                },
                {
                    extend: 'copyHtml5',
                    text: 'Copy',
                    titleAttr: 'Copy to clipboard',
                    className: 'btn-outline-primary btn-sm mr-1'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    titleAttr: 'Print Table',
                    className: 'btn-outline-primary btn-sm'
                }
            ]
        });

    });

    function showEdit(id) {
        var url = "{{ route('admin.projects.edit', ':id') }}";
        url = url.replace(':id', id);
        $('#data-model').modal('show', url);

        // $("#edit_leaveType").val(leaveType);
        // $("#edit_num_of_leave").val(num);

        $.ajax({
            type: 'GET',
            url: url,

            data: {},
            success: function(response) {
                $('#project-edit-content').html(response);
                var date = new Date();
                $('#project-edit-content').find("#datepicker-1").daterangepicker({
                    opens: 'left',
                    minDate: date,
                    locale: {
                        format: 'YYYY-MM-DD',
                        
                    }
                });
            },

            error: function(xhr, textStatus, thrownError) {
                $('#project-edit-content').html(
                    '<div class="alert alert-danger">Error Fetching data</div>');
            }
        });
        // 
    }

    function projectUpdate(id){
        $('#updateProject').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Loading...').attr('disabled', true);
         let project_name = ('#edit_name');
         let start_end_date = ('#datepicker-1');
         let estimated_hour = ('#estimated_hour');
         let edit_status = ('#edit_status');
         let edit_description = ('#edit_description');
         var project_edit = {
            id: id,
            name: $(project_name).val(),
            date: $(start_end_date).val(),
            estimatedhour: $(estimated_hour).val(),
            status: $(edit_status).val(),
            description:$(edit_description).val(),
        }
        var url = "{!! route('admin.projects_update') !!}"

        $.easyAjax({
            type: 'POST',
            url: url,
            data: project_edit,
            success: function(response) {
                toastr['success']('project Updated Successfully!');
                $('#data-model').modal('hide');
                $('#project-table').DataTable().ajax.reload();
            }
        });   
        $('#updateProject').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Loading...').attr('disabled', false);
    }
</script>
@endsection