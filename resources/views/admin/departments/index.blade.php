@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->
    
    <!-- END PAGE LEVEL STYLES -->

@stop


@section('content')
    <div class="page-head">
        <!-- BEGIN PAGE HEADER-->
        <div class="page-head">
            <div class="page-title"><h1>
            <i class="fal fa-sitemap"></i>
                    {{ trans('pages.departments.indexTitle')}}
                </h1></div>

        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <!-- <a onclick="loadView('{{ route('admin.dashboard.index') }}')">{{ trans('core.dashboard') }}</a>
                <i class="fa fa-circle"></i> -->
            </li>

            <!-- <li>
                <span class="active">{{trans('core.departments')}}</span>
            </li> -->

        </ul>

        <!-- END PAGE HEADER-->

        <div id="load">
            {{--INLCUDE ERROR MESSAGE BOX--}}

            {{--END ERROR MESSAGE BOX--}}
        </div>

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                        <i class="fal fa-sitemap"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Departments<span class="fw-300"><i></i></span>
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                            {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                        </div>
                    </div>
                 <div class="panel-container show">
                        @if($loggedAdmin->manager!=1)
                        <button class="btn btn-primary float-right m-3" onclick="showAdd();">
                                                {{ trans('core.btnAddDepartment') }}
                                                </button>

                                @endif
                   <div class="panel-content" >
                         <table class="table table-bordered table-responsive-sm table-hover table-striped w-100 dataTable dtr-inline">
                            <thead class="bg-primary-600">
                                <tr>
                                    <th>
                                        @lang('core.serialNo')
                                    </th>
                                    <th>
                                        {{trans('core.departmentName')}}
                                    </th>
                                    <th>
                                        {{trans('core.designations')}}
                                    </th>
                                    @if($loggedAdmin->manager!=1)
                                        <th>
                                            {{trans('core.actions')}}
                                        </th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                {{--@if(count($departments)>0)--}}
                                @forelse ($departments as $index=>$department)
                                    <tr id="row{{ $department->id }}">
                                        <td>
                                            {{ $index+1 }}
                                        </td>
                                        <td>
                                            {{ $department->name }}

                                        </td>

                                        <td>
                                            <ol>
                                                @foreach($department->designations as $desig)
                                                    <li>   {{ $desig->designation }}</li>

                                                @endforeach
                                            </ol>
                                        </td>
                                        @if($loggedAdmin->manager!=1)
                                            <td class=" ">
                                                <div class="d-flex">
                                                <button class="btn btn-outline-warning btn-icon waves-effect waves-themed mx-1" 
                                                   onclick="showEdit({{$department->id}},'{{ addslashes($department->name) }}')"><i
                                                            class="fal fa-edit"></i></button>

                                                <a class="btn btn-outline-danger btn-icon waves-effect waves-themed mx-1"
                                                   href="javascript:;"
                                                   onclick="del({{$department->id}},'{{ $department->name }}')"><i
                                                            class="fal fa-trash"></i></a></div>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center"> @lang('messages.noDeptTable')</td>
                                    </tr>
                                @endforelse
                                {{--@endif--}}

                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>
        </div>
        <!-- END PAGE CONTENT-->


        {{--------------------------EDIT MODALS-----------------}}

    </div>

    {{------------------------END EDIT MODALS---------------------}}
    <div class="modal fade add_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" id="showModal">
        <div class="modal-dialog">
            <div class="modal-content" id="department-content">
            </div>
        </div>
    </div>

    <div class="modal fade edit_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" id="data-model">
        <div class="modal-dialog">
            <div class="modal-content" id="department-edit-content">
            </div>
        </div>
    </div>



    {{--MODAL CALLING--}}
    @include('admin.common.delete')
   
   
    {{--MODAL CALLING END--}}
@stop



@section('page_js')

    <script>


        function addMore() {
            var $insertBefore = $('#insertBefore');
            var $i = $('.designation').length;
            $('<div class="form-group"><div><input class="form-control input-medium designation"  name="designation[' + $i + ']" type="text"  placeholder="{{trans('core.designation')}} #' + ($i + 1) + '"/></div></div>').insertBefore($insertBefore);
        }
        //-----EDIT Modal
        function addMoreEdit() {
            var $insertBefore_edit = $('#insertBefore_edit');
            var $j = $('.designation').length;
            $(' <div class="form-group" id="edit_field"><input class="form-control designation form-control-inline input-medium"  name="designation[' + $j + ']" type="text"  placeholder="{{trans('core.designation')}} #' + ($j + 1) + '"/></div>').insertBefore($insertBefore_edit);
        };

        function del(id, dept) {

            $('#deleteModal').modal('show');
            $("#deleteModal").find('#info').html('{!!  __('messages.departmentDeleteConfirm') !!} <strong>' + dept + '</strong>?<br>' +
                '<br><div class="note note-warning">' +
                '{!! __('messages.deleteNoteDepartment')!!}' +
                '</div>');

            $('#deleteModal').find("#delete").off().click(function () {
                var url = "{{ route('admin.departments.destroy',':id') }}";
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
                            toastr['success']('Deparment deleted successfully!');
                            window.location.reload();
                            // table.fnDraw();
                        }
                    }
                });
            })

        }

        {{--function showEdit(id, name) {--}}

            {{--$('div[id^="edit_field"]').remove();--}}
            {{--var url = "{{ route('admin.departments.update',':id') }}";--}}
            {{--url = url.replace(':id', id);--}}
            {{--$('#edit_form').attr('action', url);--}}

            {{--var get_url = "{{ route('admin.departments.edit',':id') }}";--}}
            {{--get_url = get_url.replace(':id', id);--}}

            {{--$("#edit_name").val(name);--}}
            {{--$("#deptresponse").html('<div class="text-center">{!!  HTML::image('assets/loader.gif') !!}</div>');--}}

            {{--$.ajax({--}}

                {{--type: "GET",--}}
                {{--url: get_url,--}}

                {{--data: {"id": id}--}}

            {{--}).done(function (response) {--}}
                {{--$("#deptresponse").html(response);--}}
                {{--$j = $('input#designation').length - 1;--}}
            {{--});--}}

            {{--$('#edit_submit').click(function () {--}}
                {{--$("#error_edit").html('<div class="alert alert-info">{{trans('messages.submitting')}}..</div>');--}}
                {{--$("#edit_submit").prop('disabled', true);--}}

                {{--$.ajax({--}}
                    {{--type: 'POST',--}}
                    {{--url: url,--}}
                    {{--dataType: "JSON",--}}
                    {{--data: $('#edit_form').serialize(),--}}
                    {{--success: function (response) {--}}
                        {{--if (response.status == "error") {--}}
                            {{--showToastrMessage('{!!  __('messages.errorTitle')  !!}', '{!! __('messages.error') !!}', 'error');--}}
                            {{--$('#error_edit').html('');--}}
                            {{--var arr = response.msg;--}}
                            {{--var alert = '';--}}
                            {{--$.each(arr, function (index, value) {--}}
                                {{--if (value.length != 0) {--}}
                                    {{--alert += '<p><span class="fa fa-close"></span> ' + value + '</p>';--}}
                                {{--}--}}
                            {{--});--}}

                            {{--$('#error_edit').html('<div class="alert alert-danger alert-dismissable"><button class="close" data-close="alert"></button> ' + alert + '</div>');--}}
                            {{--$("#edit_submit").prop('disabled', false);--}}
                        {{--} else {--}}
                            {{--$('#edit_static').modal('hide');--}}
                            {{--loadView(response.url);--}}
                        {{--}--}}

                    {{--},--}}
                    {{--error: function (xhr, textStatus, thrownError) {--}}

                    {{--}--}}
                {{--})--}}
            {{--})--}}
        {{--}--}}

        function showEdit(id,name) {
            var url = "{{ route('admin.departments.edit',':id') }}";
            url = url.replace(':id', id);
            $.ajaxModal('#data-model', url);
            // $('#showModal').modal('show',url);

                $.ajax({
            type: 'GET',
            url: url,

            data: {},
            success: function(response) {
                $('#department-edit-content').html(response);
            },

            error: function(xhr, textStatus, thrownError) {
                $('#department-edit-content').html(
                    '<div class="alert alert-danger">Error Fetching data</div>');
            }
        });

        }

        function showAdd() {
            var url = "{{ route('admin.departments.create') }}";
            $('#showModal').modal('show',url);
            var $insertBefore = $('#insertBefore');
            var $i = 0;

            $.ajax({
            type: 'GET',
            url: url,

            data: {},
            success: function(response) {
                $('#department-content').html(response);
            },

            error: function(xhr, textStatus, thrownError) {
                $('#department-content').html(
                    '<div class="alert alert-danger">Error Fetching data</div>');
            }
        });

        }

        function addSubmit() {
            $('#submitbutton_add').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Loading...').attr('disabled', true);
                $.easyAjax({
                type: 'POST',
                url: "{{route('admin.departments.store')}}",
                container: '.ajax_form',
                data: $('.ajax_form').serialize(),
        
            });
            $('#submitbutton_add').html('submit').attr('disabled', false);

        }

        function updateSubmit(id) {
            $('#edit_submit').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Loading...').attr('disabled', true);
            var url = "{{ route('admin.departments.update',':id') }}";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'PUT',
                url: url,
                container: '.ajax_form',
                data: $('.ajax_form').serialize(),
                success: function (response) {
                    if (response.status === "success") {
                        $('#data-model').modal('hide');
                        toastr['success']('Updated successfully!');
                        window.location.reload();
                    }

                }
            });
            $('#edit_submit').html('update').attr('disabled', false);
        }
    </script>
@stop
