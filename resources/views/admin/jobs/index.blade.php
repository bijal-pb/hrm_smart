@extends('admin.adminlayouts.adminlayout')

@section('head')


    <!-- BEGIN PAGE LEVEL STYLES -->
    <!-- {!! HTML::style("assets/global/plugins/select2/css/select2.css")!!}
    {!! HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css")!!} -->
    <!-- END PAGE LEVEL STYLES -->

@stop


@section('content')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
        <i class="fal fa-phone-laptop"></i>
                @lang("pages.jobs.indexTitle")
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <!-- <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">{{trans('core.dashboard')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">@lang("pages.jobs.indexTitle")</span>
            </li> -->
        </ul>
    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">


            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="load">

                {{--INLCUDE ERROR MESSAGE BOX--}}

                {{--END ERROR MESSAGE BOX--}}

            </div>
         
                <div id="panel-5" class="panel">
                   
                      <div class="panel-hdr">
                        <h2> <i class="fal fa-phone-laptop"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@lang('Job Openings')</h2>
                            <div class="panel-toolbar">
                                <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                            </div>
                        </div>
                           
                             <div class="col-md-12 form-group text-right">
                                <span id="load_notification"></span>
                                <input type="checkbox"
                                       onchange="ToggleEmailNotification('job_notification');return false;"
                                       class="make-switch" name="job_notification"
                                       @if($loggedAdmin->company->job_notification==1)checked @endif data-on-color="success"
                                       data-on-text="{{trans('core.btnYes')}}" data-off-text="{{trans('core.btnNo')}}"
                                       data-off-color="danger">
                                <strong>{{trans('core.emailNotification')}}</strong><br>
                            </div> 
                 

                <div class="panel-container show">
                    <!-- href="{{ route('admin.jobs.create') }}" -->
                    <a style="color:#fff;" class="btn btn-primary float-right m-3" onclick="showAdd();">
                                {{__('core.btnAddJob')}}    
                    </a>
                <div class="panel-content" >
                    <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" id="jobs">
                    <thead class="bg-primary-600">
                        <tr>
                            <th> @lang("core.serialNo") </th>
                            <th> {{trans('core.position')}} </th>

                            <th> {{trans('core.postedDate')}}  </th>
                            <th> {{trans('core.lastDateToApply')}}  </th>
                            <th> {{trans('core.closeDate')}}  </th>
                            <th> {{trans('core.status')}}  </th>
                            <th> {{trans('core.action')}}  </th>
                        </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>
    <!-- add model -->
    <div class="modal fade add_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
            id="showModal">
        <div class="modal-dialog">
            <div class="modal-content" id="job-type-content">
            </div>
        </div>
    </div>

    <!-- edit Modal -->
    <div class="modal fade edit_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
            id="editModal">
        <div class="modal-dialog">
            <div class="modal-content" id="job-edit-content">
            </div>
        </div>
    </div>

    <!-- END PAGE CONTENT-->

    {{--MODAL CALLING--}}
    @include('admin.common.delete')
    {{--MODAL CALLING END--}}
@stop



@section('page_js')


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- {!!  HTML::script("assets/global/plugins/select2/js/select2.min.js")!!}
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
    {!!  HTML::script("assets/global/plugins/datatables/datatables.min.js")!!}
    {!!  HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")!!} -->

    <!-- END PAGE LEVEL PLUGINS -->

    <script>


        var table = $('#jobs').dataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            stateSave: true,
            {!! $datatabble_lang !!}
            "ajax": "{{ URL::route("admin.ajax_jobs") }}",
          
            columns: [
                {data: 'id', name: 'id'},
                {data: 'position', name: 'position'},
                {data: 'posted_date', name: 'posted_date'},
                {data: 'last_date', name: 'last_date'},
                {data: 'close_date', name: 'close_date'},
                {data: 'status', name: 'status'},
                {data: 'edit', name: 'edit',orderable: false},
            ],
            order: [0, 'desc'],
            lengthChange: true,
                dom: '<"float-left"B><"float-right"f>rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>',
                        // "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                        // "<'row'<'col-sm-12'tr>>" +
                        // "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
              buttons: [
                {
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

        function showAdd() {
            var url = "{{ route('admin.jobs.create') }}";
            $('#showModal').modal('show', url);

            $.ajax({
                type: 'GET',
                url: url,

                data: {},
                success: function(response) {
                    $('#job-type-content').html(response);
                },

                error: function(xhr, textStatus, thrownError) {
                    $('#job-type-content').html(
                        '<div class="alert alert-danger">Error Fetching data</div>');
                }
            });
        }
        
        function ajaxCreateJob() {
            $.easyAjax({
                url: "{!! route('admin.jobs.store') !!}",
                type: "POST",
                data: $(".ajax_form").serialize(),
                container: ".ajax_form",
                success: function (response) {
                    if (response.status === "success") {
                        $('#showModal').modal('hide');
                        toastr['success'];
                        $('#jobs').DataTable().ajax.reload();
                        // table.fnDraw();
                    }
                }

            });
        }
        function showedit(id) {
            var get_url = "{{ route('admin.jobs.edit', ':id') }}";
            get_url = get_url.replace(':id', id);
            $('#editModal').modal('show', get_url);

            $.ajax({
                type: 'GET',
                url: get_url,

                data: {},
                success: function(response) {
                    $('#job-edit-content').html(response);
                },

                error: function(xhr, textStatus, thrownError) {
                    $('#job-edit-content').html(
                        '<div class="alert alert-danger">Error Fetching data</div>');
                }
            });
        }

        function ajaxUpdateJob(id) {
            var url = "{{ route('admin.jobs.update',':id') }}";
            url = url.replace(':id', id);
            $.easyAjax({
                url: url,
                type: "PUT",
                data: $(".ajax_form").serialize(),
                container: ".ajax_form",
                success: function (response) {
                    if (response.status === "success") {
                        $('#editModal').modal('hide');
                        toastr['success'];
                        $('#jobs').DataTable().ajax.reload();
                        // table.fnDraw();
                    }
                }
            });
        }


        // Show Delete Modal
        function del(id,) {

            $('#deleteModal').modal('show');

            $("#deleteModal").find('#info').html('@lang("messages.jobDeleteConfirm")');

            $('#deleteModal').find("#delete").off().click(function () {

                var url = "{{ route('admin.jobs.destroy',':id') }}";
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
                            toastr['success']('Jobbs deleted successfully!');
                            $('#jobs').DataTable().ajax.reload();
                           // table.fnDraw();
                        }
                    }
                });

            });
        }
    </script>
@stop
