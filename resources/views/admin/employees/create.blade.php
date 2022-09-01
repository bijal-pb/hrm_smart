@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    <!-- {!! HTML::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
                                            {!! HTML::style('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') !!}
                                            {!! HTML::style('assets/global/plugins/cropper/cropper.min.css') !!} -->
    <!-- END PAGE LEVEL STYLES -->

@stop


@section('content')

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title">
            <h1>
                <i class="fal fa-user-circle"></i>
                {{ trans('pages.employees.createTitle') }}
            </h1>
        </div>
    </div>
    <ul class="page-breadcrumb breadcrumb">
        <!-- <li>
                                                    <a onclick="loadView('{{ route('admin.dashboard.index') }}')">{{ trans('core.dashboard') }}</a>
                                                    <i class="fa fa-circle"></i>
                                                </li>
                                                <li>
                                                    <a onclick="loadView('{{ route('admin.employees.index') }}')">{{ trans('pages.employees.indexTitle') }}</a>
                                                    <i class="fa fa-circle"></i>
                                                </li>
                                                <li>
                                                    <span class="active">{{ trans('pages.employees.createTitle') }}</span>
                                                </li> -->
    </ul> <!-- END PAGE HEADER-->

    @if (count($department) == 0)
        <div class="note note-warning">
            {!! trans('messages.noDepartment') !!}
        </div>
    @else
        @if ($canCreateEmployee)
            {!! Form::open(['class' => 'form-horizontal ajax_form', 'method' => 'POST', 'files' => true, 'autocomplete' => 'off']) !!}
            <div class="row ">
                <div class="col-md-12 col-sm-12">
                    <div id="panel-1" class="panel">
                        <div class="panel-hdr">
                            <h2>
                                <i class="fal fa-user-clock"></i>&nbsp;&nbsp;&nbsp;Employee Details<span
                                    class="fw-300"><i></i></span>
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
                                <div class="portlet light bordered">
                                    <div class="col-md-12 form-group text-right">
                                        <div class="portlet-title">

                                            <div class="actions">
                                                <div class="btn-group">
                                                    <span id="load_notification"></span>
                                                    <input type="checkbox"
                                                        onchange="ToggleEmailNotification('employee_add');return false;"
                                                        class="make-switch" name="employee_add"
                                                        @if ($loggedAdmin->company->employee_add == 1) checked @endif
                                                        data-on-color="success" data-on-text="{{ trans('core.btnYes') }}"
                                                        data-off-text="{{ trans('core.btnNo') }}"
                                                        data-off-color="danger" />
                                                    <strong>{{ trans('core.emailNotification') }}</strong>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="portlet-body">

                                        <div class="form-body">
                                            <div class="form-group ">
                                                <label class="control-label col-md-3">{{ trans('core.image') }}
                                                    {!! help_text('employeeImageSize') !!}</label>

                                                <div class="col-md-9">

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="cropModal" aria-labelledby="modalLabel"
                                                        role="dialog" tabindex="-1" data-backdrop="static">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="modalLabel">Crop Image
                                                                    </h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div>
                                                                                <img id="cropImage" src="" alt=""
                                                                                    style="max-height: 500px">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" id="cropButton"
                                                                        class="btn btn-primary" data-dismiss="modal">Crop
                                                                        Selected
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail"
                                                            style="width: 200px; height: 200px;">
                                                            <img id="imagePath"
                                                                src="https://as1.ftcdn.net/v2/jpg/03/53/11/00/1000_F_353110097_nbpmfn9iHlxef4EDIhXB1tdTD0lcWhG9.jpg"
                                                                alt="" />

                                                        </div>

                                                        <input type="hidden" value="" name="cropData" id="cropData" />

                                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                                            style="max-width: 200px; max-height: 200px;" id="result"></div>
                                                        <div>
                                                            <span class="btn btn-primary btn-file">
                                                                <span class="fileinput-new">
                                                                    {{ trans('core.selectImage') }} </span>
                                                                <span class="fileinput-exists">
                                                                    {{ trans('core.change') }} </span>
                                                                <input type="file" id="picImage" name="profile_image">
                                                            </span>
                                                            <a href="#" class="btn btn-danger fileinput-exists"
                                                                data-dismiss="fileinput">
                                                                {{ trans('core.remove') }} </a>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix margin-top-10">
                                                        {{-- {!! trans('messages.imageSizeLimit', ["size" => '872x724 pixels']) !!} --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mx-md-n5">
                                                <div class="col px-md-5">
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">{{ trans('core.name') }}
                                                            <span class="required">* </span></label>

                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" name="full_name"
                                                                placeholder="{{ trans('core.name') }}"
                                                                value="{{ old('full_name') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col px-md-5">
                                                    <div class="form-group">
                                                        <label
                                                            class="col-md-6 control-label">{{ trans('core.father_name') }}
                                                            <span class="required">* </span></label>

                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" name="father_name"
                                                                placeholder="{{ trans('core.father_name') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col px-md-5">
                                                    <div class="form-group">
                                                        <label
                                                            class="control-label col-md-6">{{ trans('core.dob') }}</label>

                                                        <div class="col-md-12">
                                                            <div class="input-group input-medium date date-picker"
                                                                data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-default" type="button"><i
                                                                            class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                                                <input type="text" class="form-control"
                                                                    name="date_of_birth" readonly
                                                                    value="{{ old('date_of_birth') }}">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="row mx-md-n5">
                                                <div class="col px-md-5">
                                                    <div class="form-group">
                                                        <label
                                                            class="col-md-3 control-label">{{ trans('core.gender') }}</label>

                                                        <div class="col-md-12">
                                                            {!! Form::select('gender', ['male' => __('core.male'), 'female' => __('core.female')], old('gender'), ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col px-md-5">
                                                    <div class="form-group">
                                                        <label
                                                            class="col-md-3 control-label">{{ trans('core.phone') }}</label>

                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" name="mobile_number"
                                                                placeholder="{{ trans('core.phone') }}"
                                                                value="{{ old('mobile_number') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="row mx-md-n5">
                                                <div class="col px-md-5">
                                                    <div class="form-group">
                                                        <label
                                                            class="col-md-12 control-label">{{ trans('core.local_address') }}</label>

                                                        <div class="col-md-12">
                                                            <textarea class="form-control" name="local_address" rows="3">{{ old('local_address') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col px-md-5">
                                                    <div class="form-group">
                                                        <label
                                                            class="col-md-12 control-label">{{ trans('core.permanent_address') }}</label>

                                                        <div class="col-md-12">
                                                            <textarea class="form-control" name="permanent_address" rows="3">{{ old('permanent_address') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br>

                                            <h4 class="block">{{ trans('core.accountLogin') }}</h4>
                                            <div class="row mx-md-n5">
                                                <div class="col px-md-5">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">{{ trans('core.email') }}<span
                                                        class="required">* </span></label>

                                                <div class="col-md-12">
                                                    <input type="text" name="email" class="form-control"
                                                        value="{{ old('email') }}">
                                                </div>
                                            </div>
                                                </div>
                                                <div class="col px-md-5">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">{{ trans('core.password') }}<span
                                                        class="required">* </span></label>

                                                <div class="col-md-12">
                                                    <input type="hidden" name="oldpassword">
                                                    <input type="password" name="password" class="form-control"
                                                        value="{{ old('password') }}">
                                                </div>
                                            </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-hdr">
                            <h2>
                                <i class="fal fa-industry"></i>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('core.companyDetails') }}
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
                                <div class="form-body">
                                    <!-- <div class="form-group">
                                                <label class="col-md-3 form-label">{{ trans('core.employeeID') }}<span class="required">* </span></label>

                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" name="employeeID" placeholder="{{ trans('core.employeeID') }}" value="{{ old('employeeID') }}">
                                                </div>
                                            </div> -->
                                    <div class="form-group">
                                        <label class="col-md-3 form-label">{{ trans('core.department') }}</label>

                                        <div class="col-md-12">
                                            {!! Form::select('department', $department, null, ['class' => 'form-control select2me', 'id' => 'department', 'onchange' => 'dept();return false;']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 form-label">{{ trans('core.designation') }}</label>

                                        <div class="col-md-12">

                                            <select class="select2me form-control" name="designation" id="designation">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 form-label"> {{ trans('core.annualOrCredit') }}
                                            {!! help_text('creditLeaves') !!}</label>

                                        <div class="col-md-12">
                                            <input type="text" name="annual_leave" class="form-control" id="annual_leave"
                                                value="0">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">{{ trans('core.dateOfJoining') }}</label>

                                        <div class="col-md-12">
                                            <div class="input-group input-medium date date-picker"
                                                data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button"><i
                                                            class="fal fa-calendar"></i>
                                                    </button>
                                                </span>
                                                <input type="text" class="form-control" name="joining_date" readonly
                                                    value="@if (null !== old('joining_date')) {{ old('joining_date') }} @else {{ date('d-m-Y') }} @endif">
                                                {{-- <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button"><i
                                                            class="fa fa-calendar"></i>
                                                    </button>
                                                </span> --}}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-3 form-label">{{ trans('core.basicSalary') }}
                                            ({{ $loggedAdmin->company->currency_symbol }})</label>

                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="basicSalary"
                                                placeholder="{{ trans('core.basicSalary') }}" value="0">
                                            <span class="help-block">{{ trans('messages.basicSalaryInfo') }} </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 form-label">{{ trans('core.hourlyRate') }}
                                            ({{ $loggedAdmin->company->currency_symbol }})</label>

                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="hourlyRate"
                                                placeholder="{{ trans('core.hourlyRate') }}" value="0">
                                            <span
                                                class="help-block">{{ trans('messages.hourlyRateMessage', ['symbol' => $loggedAdmin->company->currency_symbol]) }}</span>
                                            <span class="help-block">{{ trans('messages.basicSalaryInfo') }} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-hdr">
                            <h2>
                                <i
                                    class="fal fa-money"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('core.bankDetails') }}
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
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 form-label">{{ trans('core.accountHolder') }}</label>

                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="account_name"
                                                placeholder="{{ trans('core.accountHolder') }}"
                                                value="{{ old('account_name') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 form-label">{{ trans('core.account_number') }}</label>

                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="account_number"
                                                placeholder="{{ trans('core.account_number') }}"
                                                value="{{ old('account_number') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 form-label">{{ trans('core.bank') }}</label>

                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="bank"
                                                placeholder="{{ trans('core.bank') }}" value="{{ old('bank') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 form-label">{{ trans('core.bin') }}
                                            {!! help_text('bankIdentificationCode') !!}</label>

                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="bin"
                                                placeholder="{{ trans('core.bin') }}" value="{{ old('bin') }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 form-label">{{ trans('core.branch') }}</label>

                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="branch"
                                                placeholder="{{ trans('core.branch') }}" value="{{ old('branch') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 form-label">{{ trans('core.tax_payer_id') }}
                                            {!! help_text('taxPayerID') !!}</label>

                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="tax_payer_id"
                                                placeholder="{{ trans('core.tax_payer_id') }}"
                                                value="{{ old('tax_payer_id') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix">
                {{-- -------------Documents---------------- --}}
                <div class="row ">
                    <div class="col-md-12 col-sm-12">
                        <div id="panel-1" class="panel">
                            <div class="panel-hdr">
                                <h2>
                                    <i
                                        class="fal fa-file"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('core.documents') }}
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
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="form-label col-md-2">{{ trans('core.resume') }}</label>

                                            <div class="col-md-12">
                                                <div class="fileinput fileinput-new col-lg-12" data-provides="fileinput">
                                                    <div class="input-group">
                                                        <div class="form-control uneditable-input"
                                                            data-trigger="fileinput">
                                                            <i class="fal fa-file fileinput-exists"></i>&nbsp; <span
                                                                class="fileinput-filename">
                                                            </span>
                                                        </div>
                                                        <span class="input-group-append btn btn-default btn-file">
                                                            <span class="fileinput-new">
                                                                {{ trans('core.selectFile') }} </span>
                                                            <span class="fileinput-exists">
                                                                {{ trans('core.change') }} </span>
                                                            <input type="file" name="resume">
                                                        </span>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#"
                                                            class="input-group-append btn btn-danger fileinput-exists"
                                                            data-dismiss="fileinput">
                                                            {{ trans('core.remove') }} </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label class="form-label col-md-2">{{ trans('core.offerLetter') }}</label>

                                            <div class="col-md-12">
                                                <div class="fileinput fileinput-new col-lg-12" data-provides="fileinput">
                                                    <div class="input-group input-large">
                                                        <div class="form-control uneditable-input"
                                                            data-trigger="fileinput">
                                                            <i class="fal fa-file fileinput-exists"></i>&nbsp; <span
                                                                class="fileinput-filename">
                                                            </span>
                                                        </div>
                                                        <span class="input-group-append btn btn-default btn-file">
                                                            <span class="fileinput-new">
                                                                {{ trans('core.selectFile') }} </span>
                                                            <span class="fileinput-exists">
                                                                {{ trans('core.change') }} </span>
                                                            <input type="file" name="offerLetter">
                                                        </span>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#"
                                                            class="input-group-append btn btn-danger fileinput-exists"
                                                            data-dismiss="fileinput">
                                                            {{ trans('core.remove') }} </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label class="form-label col-md-2">{{ trans('core.joiningLetter') }}</label>

                                            <div class="col-md-12">
                                                <div class="fileinput fileinput-new col-lg-12" data-provides="fileinput">
                                                    <div class="input-group input-large">
                                                        <div class="form-control uneditable-input"
                                                            data-trigger="fileinput">
                                                            <i class="fal fa-file fileinput-exists"></i>&nbsp; <span
                                                                class="fileinput-filename">
                                                            </span>
                                                        </div>
                                                        <span class="input-group-append btn btn-default btn-file">
                                                            <span class="fileinput-new">
                                                                {{ trans('core.selectFile') }} </span>
                                                            <span class="fileinput-exists">
                                                                Change </span>
                                                            <input type="file" name="joiningLetter">
                                                        </span>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#"
                                                            class="input-group-append btn btn-danger fileinput-exists"
                                                            data-dismiss="fileinput">
                                                            {{ trans('core.remove') }} </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="form-label col-md-2">{{ trans('core.contractOrAgreement') }}</label>

                                            <div class="col-md-12">
                                                <div class="fileinput fileinput-new col-lg-12" data-provides="fileinput">
                                                    <div class="input-group input-large">
                                                        <div class="form-control uneditable-input"
                                                            data-trigger="fileinput">
                                                            <i class="fal fa-file fileinput-exists"></i>&nbsp; <span
                                                                class="fileinput-filename">
                                                            </span>
                                                        </div>
                                                        <span class="input-group-append btn btn-default btn-file">
                                                            <span class="fileinput-new">
                                                                {{ trans('core.selectFile') }} </span>
                                                            <span class="fileinput-exists">
                                                                Change </span>
                                                            <input type="file" name="contract">
                                                        </span>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#"
                                                            class="input-group-append btn btn-danger fileinput-exists"
                                                            data-dismiss="fileinput">
                                                            @lang("core.remove") </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label class="form-label col-md-2">{{ trans('core.idProof') }}</label>

                                            <div class="col-md-12">
                                                <div class="fileinput fileinput-new col-lg-12" data-provides="fileinput">
                                                    <div class="input-group input-large">
                                                        <div class="form-control uneditable-input"
                                                            data-trigger="fileinput">
                                                            <i class="fal fa-file fileinput-exists"></i>&nbsp; <span
                                                                class="fileinput-filename">
                                                            </span>
                                                        </div>
                                                        <span class="input-group-append btn btn-default btn-file">
                                                            <span class="fileinput-new">
                                                                {{ trans('core.selectFile') }} </span>
                                                            <span class="fileinput-exists">
                                                                @lang("core.change") </span>
                                                            <input type="file" name="IDProof">
                                                        </span>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#"
                                                            class="input-group-append btn btn-danger fileinput-exists"
                                                            data-dismiss="fileinput">
                                                            @lang("core.remove")
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group text-center">

                                        <button type="button" id="emp_submit" onclick="addEmployee();return false;"
                                            class=" btn btn-primary">
                                            {{ trans('core.btnSubmit') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>


                </div>
                {!! Form::close() !!}
            @else
                <div class="note note-warning">
                    {!! trans('messages.upgradeYourPlan') !!}
                </div>
        @endif
    @endif

@stop

@section('page_js')


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- {!! HTML::script('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
                                            {!! HTML::script('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
                                            {!! HTML::script('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
                                            {!! HTML::script('assets/admin/pages/scripts/components-pickers.js') !!}
                                            {!! HTML::script('assets/global/plugins/cropper/cropper.min.js') !!} -->
    <!-- END PAGE LEVEL PLUGINS -->




    <script>
        var controls = {
            leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
            rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
        }
        var runDatePicker = function() {

            // minimum setup
            $('#datepicker-1').datepicker({
                todayHighlight: true,
                orientation: "top left",
                templates: controls
            });
        }
        jQuery(document).ready(function() {
            runDatePicker();

            ComponentsPickers.init();
            dept();


        });

        function dept() {

            $.getJSON("{{ URL::to('admin/departments/ajax_designation/') }}", {
                    department_id: $('#department').val()
                },
                function(data) {
                    var model = $('#designation');
                    model.empty();
                    $.each(data, function(index, element) {
                        model.append("<option value='" + element.id + "'>" + element.designation + "</option>");
                    });

                });

        }
    </script>
    <script>
        var croppedImage;
        $(function() {

            var $previews = $('.preview');

            $('#cropModal').on('shown.bs.modal', function() {
                var $image = $('#cropImage');
                var $button = $('#cropButton');
                var $result = $('#result');
                var croppable = false;

                $image.cropper({
                    aspectRatio: 1,
                    viewMode: 2,
                    guides: false,
                    zoomable: false,
                    zoomOnTouch: false,
                    zoomOnWheel: false,
                    rotatable: false,
                    build: function() {
                        croppable = true;
                    }
                });

                $button.on('click', function() {
                    var croppedCanvas;
                    var roundedCanvas;

                    if (!croppable) {
                        return;
                    }

                    // Crop
                    croppedCanvas = $image.cropper('getCroppedCanvas');

                    // Show
                    $result.html('<img width="100" height="100" src="' + croppedCanvas.toDataURL() + '">');

                    // set binary data
                    croppedCanvas.toBlob(function(blob) {
                        url = URL.createObjectURL(blob);
                        croppedImage = blob;
                        console.log(croppedImage);
                        var reader = new FileReader();
                        reader.readAsDataURL(blob);
                        reader.onloadend = function() {
                            var data=(reader.result).split(',')[1];
                            var croppedImage = atob(data);
                        }
                    });
                });

            }).on('hidden.bs.modal', function() {
                var $image = $('#cropImage');
                cropBoxData = $image.cropper('getData');
                canvasData = $image.cropper('getCanvasData');
                $image.cropper('destroy');
                $("#cropData").val(JSON.stringify(cropBoxData));
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#cropModal').modal('show');
                    $('#cropImage').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#picImage").change(function() {
            readURL(this);
        });

        function addEmployee() {
            $('#emp_submit').html('<span class="caption-subject font-red-sunglo bold uppercase" role="status" aria-hidden="true"></span>Loading...').attr('disabled', true);
            var cropPhoto = croppedImage;
            var url = "{{ route('admin.employees.store') }}";
            $.easyAjax({
                type: 'POST',
                url: url,
                data: {cropImage: cropPhoto},
                container: '.ajax_form',
                file: true,
            });
            $('#emp_submit').html('submit').attr('disabled', false);
        }
    </script>
@stop
