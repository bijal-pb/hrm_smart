@extends('admin.adminlayouts.adminlayout')

@section('head')
    {!! HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css") !!}
@stop

@section('content')

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title">
            <h1> {{$pageTitle}}</h1>
        </div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">{{trans('core.dashboard')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">{{trans('core.settings')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">@lang("core.language")</span>

            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">


            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="load">


            </div>
            <div class="portlet light bordered">


                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row ">
                            <div class="col-md-6">
                                <a class="btn green" onclick="showAdd();">
                                    {{trans('core.btnAddLanguage')}}
                                    <i class="fa fa-plus"></i> </a>
                            </div>

                        </div>
                    </div>


                    <table class="table table-striped table-bordered table-hover" id="admins">
                        <thead>
                        <tr>
                            <th> @lang("core.serialNo") </th>
                            <th> Locale </th>
                            <th> Language </th>
                            <th> {{__('core.status')}} </th>
                            <th class="text-center"> {{trans('core.actions')}} </th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>

    {{--EDIT  MODALS--}}

    <div id="static_edit" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" id="edit-form-body">
            <div class="modal-content">

                <div class="modal-body" id="edit-modal-body">
                </div>
            </div>

        </div>
    </div>


    @include('admin.common.delete')
    @include('admin.common.show-modal')

@stop



@section('page_js')


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!!  HTML::script("assets/global/plugins/datatables/datatables.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js") !!}
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}

    <!-- END PAGE LEVEL PLUGINS -->

    <script>

        var table = $('#admins').dataTable({
            {!! $datatabble_lang !!}
            processing: true,
            serverSide: true,
            "ajax": "{{ URL::route("admin.ajax_languages") }}",
            "aaSorting": [[0, "desc"]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'locale', name: 'locale'},
                {data: 'language', name: 'language'},
                {data: 'active', name: 'active'},
                {data: 'edit', name: 'edit'}
            ],

            "sPaginationType": "full_numbers",
        });


        // Show Delete Modal
        function del(id, name) {

            $('#deleteModal').modal('show');

            $("#deleteModal").find('#info').html('Are you sure ! You want to delete?');

            $('#deleteModal').find("#delete").off().click(function () {

                var url = "{{ route('admin.language.destroy',':id') }}";
                url = url.replace(':id', id);

                var token = "{{ csrf_token() }}";

                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {'_token': token},
                    container: "#deleteModal",
                    success: function (response) {
                        if (response.status === "success") {
                            $('#deleteModal').modal('hide');
                            table.fnDraw();
                        }
                    }
                });

            });
        }

        function showEdit(id) {
            var url = "{{ route('admin.language.edit',':id') }}";
            url = url.replace(':id', id);
            $.ajaxModal('#showModal', url);

        }

        function showAdd() {
            var url = "{{ route('admin.language.create') }}";
            $.ajaxModal('#showModal', url);

        }

        function addAdminSubmit() {

            url = "{{route('admin.language.store')}}";
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '.ajax_form',
                data: $('.ajax_form').serialize(),
                success: function (response) {
                    if (response.status === "success") {
                        $('#showModal').modal('hide');
                        table.fnDraw();
                    }

                }
            });
        }

        function updateSubmit(id) {
            var url = "{{ route('admin.language.update',':id') }}";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'PUT',
                url: url,
                container: '.ajax_form',
                data: $('.ajax_form').serialize(),
                success: function (response) {
                    if (response.status === "success") {
                        $('#showModal').modal('hide');
                        table.fnDraw();
                    }
                }
            });
        }

    </script>
@stop
