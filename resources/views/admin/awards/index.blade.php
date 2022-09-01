@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <!-- {!! HTML::style('assets/global/plugins/select2/css/select2.css') !!}
        {!! HTML::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
        {!! HTML::style('assets/global/plugins/datatables/plugins/responsive/responsive.bootstrap.css') !!} -->
    <!-- END PAGE LEVEL STYLES -->

@stop


@section('content')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title">
            <h1>
                <i class="fal fa-trophy"></i>
                {{ trans('pages.awards.indexTitle') }}
            </h1>
        </div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <!-- <li>
                    <a onclick="loadView('{{ route('admin.dashboard.index') }}')">{{ trans('core.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">{{ trans('pages.awards.indexTitle') }}</span>
                </li> -->

        </ul>

    </div> <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->

    <div class="col-md-12">

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    <i class="fal fa-trophy"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Awards<span class="fw-300"><i></i></span>
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                        data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10"
                        data-original-title="Fullscreen"></button>
                    {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                </div>
            </div>
            <div class="panel-container show">
            <div class="col-md-12 form-group text-right">
                <span id="load_notification" class="hidden-xs"></span>
                <input type="checkbox" onchange="ToggleEmailNotification('award_notification');return false;"
                    class="make-switch" name="award_notification" @if ($loggedAdmin->company->award_notification == 1)checked
                @endif data-on-color="success"
                data-on-text="<i class='fa fa-bell-o'></i>"
                data-off-text="<i class='fa fa-bell-slash-o'></i>"
                data-off-color="danger">
                <span class="hidden-xs"><strong>{{ trans('core.emailNotification') }}</strong></span>
            </div>
                <button type="button" class="btn btn-primary float-right m-3" data-toggle="modal" data-target=".add_award">Add Award</button>
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" id="awards">
                        <thead class="bg-primary-600">
                            <tr>
                                {{-- <th class="never">Sr No.</th> --}}
                                <th class="min-tablet"> {{ trans('core.employeeID') }} </th>
                                <th class="all"> {{ trans('Awarde Name') }} </th>
                                <th class="min-desktop"> {{ trans('core.award') }} </th>
                                <th class="min-desktop"> {{ trans('core.gift') }} </th>
                                {{-- <th class="never">Hidden Month</th> --}}
                                <th class="never">Created At</th>
                                <th class="all"> {{ trans('core.month') }}</th>
                                <th class="min-tablet"> {{ trans('core.actions') }} </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>

                <!-- END EXAMPLE TABLE PORTLET-->


            </div> 
            <!-- END PAGE CONTENT-->.
            <!-- add model -->
            <div class="modal fade add_award" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="data-model1">
                <div class="modal-dialog">
                    <div class="modal-content" id="add-award-content">
                    <div class="page-head">
                        <div class="page-title">
                            <h4 class="mx-2 my-2">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
                                <i class="fal fa-trophy"></i>
                                {{ trans('pages.awards.createTitle') }}
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-12 form-group text-right">
                        <span id="load_notification" class="hidden-xs"></span>
                        <input type="checkbox" onchange="ToggleEmailNotification('award_notification');return false;"
                            class="make-switch" name="award_notification" @if ($loggedAdmin->company->award_notification == 1) checked @endif
                            data-on-color="success" data-on-text="<i class='fa fa-bell-o'></i>"
                            data-off-text="<i class='fa fa-bell-slash-o'></i>" data-off-color="danger">
                        <span class="hidden-xs"><strong>{{ trans('core.emailNotification') }}</strong></span>
                    </div>
                    <div class="panel-container show">
                    <div class="panel-content">
                        <!-- BEGIN FORM-->
                        {!! Form::open(['url' => 'admin/awards', 'class' => 'ajax_form form-horizontal', 'method' => 'POST']) !!}
                        <div class="form-body">
                            <form id="profileForm">
                                <div class="form-group">
                                    <label class="form-label mx-3">{{ trans('core.award_name') }} {!! help_text('award_name') !!}
                                        <span class="required">
                                            * </span>
                                    </label>

                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="award_name" name="award_name"
                                            placeholder="{{ trans('core.award_name') }}" value="{{ old('award_name') }}">
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label mx-3">{{ trans('core.gift') }} {!! help_text('awardGift') !!} <span
                                            class="required">
                                            * </span>
                                    </label>

                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="gift" id="gift"
                                            placeholder="{{ trans('core.gift') }}" value="{{ old('gift') }}">
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label mx-3">{{ trans('core.cash_price') }}
                                        ({{ $loggedAdmin->company->currency_symbol }})</label>

                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="cash_price"
                                            placeholder="{{ trans('core.cash_price') }}"
                                            value="{{ old('cash_price') }}">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="form-label mx-3">{{ trans('core.employee') }}
                                        {{ trans('core.name') }}:</label>

                                    <div class="col-md-12">
                                        <select class="form-control select2me" name="employee_id">
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->full_name }}
                                                    (@lang('core.empId'): {{ $employee->employeeID }})</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label mx-3">@lang("core.month"):</label>

                                    <div class="col-md-12">
                                        <select class="form-control  select2me" name="month">
                                            <option value="" selected="selected">{{ trans('core.month') }}</option>
                                            <option value="january"
                                                @if (strtolower(date('F')) == 'january') selected='selected' @endif>
                                                {{ trans('core.jan') }}</option>
                                            <option value="february"
                                                @if (strtolower(date('F')) == 'february') selected='selected' @endif>
                                                {{ trans('core.feb') }}</option>
                                            <option value="march"
                                                @if (strtolower(date('F')) == 'march') selected='selected' @endif>
                                                {{ trans('core.mar') }}</option>
                                            <option value="april"
                                                @if (strtolower(date('F')) == 'april') selected='selected' @endif>
                                                {{ trans('core.apr') }}</option>
                                            <option value="may"
                                                @if (strtolower(date('F')) == 'may') selected='selected' @endif>
                                                {{ trans('core.May') }}</option>
                                            <option value="june"
                                                @if (strtolower(date('F')) == 'june') selected='selected' @endif>
                                                {{ trans('core.jun') }}</option>
                                            <option value="july"
                                                @if (strtolower(date('F')) == 'july') selected='selected' @endif>
                                                {{ trans('core.jul') }}</option>
                                            <option value="august"
                                                @if (strtolower(date('F')) == 'august') selected='selected' @endif>
                                                {{ trans('core.aug') }}</option>
                                            <option value="september"
                                                @if (strtolower(date('F')) == 'september') selected='selected' @endif>
                                                {{ trans('core.sept') }}</option>
                                            <option value="october"
                                                @if (strtolower(date('F')) == 'october') selected='selected' @endif>
                                                {{ trans('core.oct') }}</option>
                                            <option value="november"
                                                @if (strtolower(date('F')) == 'november') selected='selected' @endif>
                                                {{ trans('core.nov') }}</option>
                                            <option value="december"
                                                @if (strtolower(date('F')) == 'december') selected='selected' @endif>
                                                {{ trans('core.dec') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label mx-3">{{ trans('core.year') }}:</label>

                                    <div class="col-md-12">
                                        {!! Form::selectYear('year', 2017, date('Y') + 1, date('Y'), ['class' => 'form-control select2me']) !!}

                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                        <div class="form-actions">

                            <div class="form-group text-center">
                                <button type="button" class="btn btn-primary " id="awardSubmit"
                                    onclick="ajaxCreateAward()"><i class="fa fa-check"></i>
                                    {{ trans('core.btnSubmit') }}</button>
                            </div>

                        </div>
                        {!! Form::close() !!}
                        <!-- END FORM-->
                    </div>
                </div>
                    </div>
                </div>
            </div>

            <!-- edit modal -->
            <div class="modal fade edit_award" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="data-model">
                <div class="modal-dialog">
                    <div class="modal-content" id="edit-award-content">
                    </div>
                </div>
            </div>

            {{-- MODAL CALLING --}}
            @include('admin.common.delete')
            {{-- MODAL CALLING END --}}
        @stop



        @section('page_js')


            <!-- BEGIN PAGE LEVEL PLUGINS -->
            <!-- {!! HTML::script('assets/global/plugins/select2/js/select2.min.js') !!}
        {!! HTML::script('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
        {!! HTML::script('assets/global/plugins/datatables/datatables.min.js') !!}
        {!! HTML::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
        {!! HTML::script('assets/global/plugins/datatables/plugins/responsive/dataTables.responsive.js') !!}
        {!! HTML::script('assets/global/plugins/datatables/plugins/responsive/responsive.bootstrap.js') !!} -->

            <!-- END PAGE LEVEL PLUGINS -->

            <script type="text/javascript">
                var table = $('#awards').dataTable({
                    {!! $datatabble_lang !!}
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    "ajax": "{{ route('admin.ajax_awards') }}",
                    stateSave: true,
                    columns: [
                        {
                            data: 'employee_id',
                            name: 'employee_id'
                        },
                        {
                            data: 'full_name',
                            name: 'full_name'
                        },
                        {
                            data: 'award_name',
                            name: 'award_name'
                        },
                        {
                            data: 'gift',
                            name: 'gift'
                        },
                        // {
                        //     data: 'month',
                        //     name: 'month'
                        // },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'For Month',
                            name: 'For Month',
                            orderable: false
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

                function ajaxCreateAward() {
                    $.easyAjax({
                        url: "{!! route('admin.awards.store') !!}",
                        type: "POST",
                        data: $(".ajax_form").serialize(),
                        container: ".ajax_form",
                        success: function(response) {
                            if (response.status === "success") {
                                $('#data-model1').modal('hide');
                                $('#awards').DataTable().ajax.reload();
                                $(".ajax_form").trigger('reset');
                            }
                        }
                    });
                }

                function showedit(id) {
                    var get_url = "{{ route('admin.awards.edit', ':id') }}";
                    get_url = get_url.replace(':id', id);
                    $('#data-model').modal('show', get_url);
                    // $.ajaxModal('#showModal', get_url);

                    $.ajax({
                        type: 'GET',
                        url: get_url,

                        data: {},
                        success: function(response) {
                            $('#edit-award-content').html(response);
                        },

                        error: function(xhr, textStatus, thrownError) {
                            $('#edit-award-content').html(
                                '<div class="alert alert-danger">Error Fetching data</div>');
                        }
                    });
                }
                
                function ajaxUpdateAward(id) {
                    var url = "{{ route('admin.awards.update',':id') }}";
                    url = url.replace(':id', id);
                    $.easyAjax({
                        url: url,
                        type: "POST",
                        data: $(".ajax_form").serialize(),
                        container: ".ajax_form",
                        success: function(response) {
                            if (response.status === "success") {
                                $('#data-model').modal('hide');
                                $('#awards').DataTable().ajax.reload();
                                table.fnDraw();
                            }
                        }

                    });
                }


                // Show Delete Modal
                function del(id, award) {

                    $('#deleteModal').modal('show');

                    $("#deleteModal").find('#info').html('Are you sure ! You want to delete <strong>' + award + '?');

                    $('#deleteModal').find("#delete").off().click(function() {

                        var url = "{{ route('admin.awards.destroy', ':id') }}";
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
                                    toastr['success']('Award deleted successfully!');
                                    table.fnDraw();
                                }
                            }
                        });

                    });
                }
            </script>
        @stop
