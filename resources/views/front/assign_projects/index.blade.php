@extends('front.layouts.frontlayout')
@section('content')

<div class="subheader">
    <h1 class="subheader-title">
        <i class=" subheader-icon fal fa-calendar-check"></i>Assigned Project<span class='fw-300'></span> <sup
            class='badge badge-primary fw-500'></sup>
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
                    <i class="fal fa-calendar-check"></i>&nbsp;&nbsp;&nbsp;&nbsp;Assigned Project<span
                        class="fw-300"><i></i></span>
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
                {{-- <a class="btn btn-primary float-right m-3" id="btn-add" href=" {{ route('admin.projects.create') }} ">
                        Add Project
                    </a> --}}
                <div class="panel-content">

                    <table id="assign-project-table"
                        class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline">
                        <thead class="bg-primary-600">
                            <tr>
                                <th>Id </th>
                                <th>Project Name </th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Partial</th>
                                <th>Fulltime</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@include('front.common.delete')

@endsection

@section('page_js')

<script type="text/javascript">

            var table = $('#assign-project-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax": "{{ route('front.ajax_assign_projects') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'project_name',
                        name: 'project_name'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
                    {
                        data: 'partial',
                        name: 'partial'
                    },
                    {
                        data: 'fulltime',
                        name: 'fulltime'
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

    </script>
@endsection