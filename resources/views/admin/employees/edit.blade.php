@extends('admin.adminlayouts.adminlayout')

@section('head')

<!-- BEGIN PAGE LEVEL STYLES -->

<!-- END PAGE LEVEL STYLES -->
@stop


@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="page-head">
    <div class="page-title">
        <h1>
            <i class="fal fa-user"></i>
            {{ trans('pages.employees.editTitle') }}
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
                            <a onclick="loadView('{{ route('admin.employees.index') }}')">{{ trans('pages.employees.indexTitle') }}</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">{{ trans('pages.employees.editTitle') }}</span>
                        </li> -->
    </ul>
</div> <!-- END PAGE HEADER-->
<div class="row ">
    <div class="col-md-12 col-sm-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    <i class="fal fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('core.personalDetails') }}
                </h2>

                <div class="actions">

                    <button type="button" onclick="UpdateDetails('{!! $employee->id !!}','personal')" class="btn btn-sm btn-success ">
                        <i class="fal fa-save"></i>
                        Save </button>
                </div>

            </div>
            <div class="panel-container show">
                <div class="panel-content">

                    {{-- ------------------Personal Info Form------------------------------------------ --}}

                    {!! Form::open(['method' => 'PUT', 'class' => 'form-horizontal ajax_form', 'id' => 'personal_details_form', 'files' => true]) !!}

                    <input type="hidden" name="updateType" class="form-control" value="personalInfo">


                    @if (Session::get('errorPersonal'))

                    <div class="alert alert-danger alert-dismissable ">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        @foreach (Session::get('errorPersonal') as $error)
                        <p><strong><i class="fa fa-warning"></i></strong> {!! $error !!}</p>
                        @endforeach
                    </div>
                    @endif


                    <div class="form-body">
                        <div class="form-group ">
                            <label class="control-label col-md-3">{{ trans('core.image') }}
                                {!! help_text('employeeImageSize') !!}
                            </label>

                            <div class="col-md-12">

                                <!-- Modal -->
                                <div class="modal fade" id="cropModal" aria-labelledby="modalLabel" role="dialog" tabindex="-1" data-backdrop="static">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="modalLabel">Crop Image</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div>
                                                            <img id="cropImage" src="" alt="" style="max-height: 500px">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="cropButton" class="btn btn-primary" data-dismiss="modal">Crop Selected
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                        {!! HTML::image($employee->profile_image_url, 'ProfileImage', ['height' => '80px', 'id' => 'imagePath']) !!}
                                        <input type="hidden" name="hiddenImage" value="{{ $employee->profile_image }}">
                                    </div>

                                    {{-- <input type="file" value="" name="cropData" id="cropData" style="display:none" /> --}}

                                    <div class="fileinput-preview fileinput-exists thumbnail" id="result" style="max-width: 200px; max-height: 200px; object-fit: cover"></div>
                                    <div>
                                        <span class="btn btn-primary btn-file">
                                            <span class="fileinput-new">
                                                {{ trans('core.selectImage') }} </span>
                                            <span class="fileinput-exists">
                                                {{ trans('core.change') }} </span>
                                            <input type="file" id="picImage" name="profile_image">
                                        </span>
                                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                            {{ trans('core.remove') }} </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
                                    {{-- {!! trans('messages.imageSizeLimit', ["size" => '872x724 pixels']) !!} --}}
                                </div>
                            </div>
                        </div>
                        <div class="form-row col-12">
                            <div class="col-md-6 mb-2">
                                <label class="form-label">{{ trans('core.name') }} <span class="required">*
                                    </span></label>
                                <div class="form-group">
                                    <input type="text" name="full_name" class="form-control" value="{{ $employee->full_name }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">{{ trans('core.father_name') }} <span class="required">* </span></label>

                                <div class="form-group">
                                    <input type="text" name="father_name" class="form-control" value="{{ $employee->father_name }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-row col-12">
                            <div class="col-md-4 mb-2">
                                <label class="form-label">{{ trans('core.dob') }}</label>
                                <div class="form-group">
                                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="fal fa-calendar"></i></button>
                                        </span>
                                        <input type="text" class="form-control" name="date_of_birth" readonly value="@if (empty($employee->date_of_birth))@else{{ date('d-m-Y', strtotime($employee->date_of_birth)) }}@endif">
                                        {{-- <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i
                                                    class="fal fa-calendar"></i></button>
                                        </span> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label">{{ trans('core.gender') }}</label>
                                <div class="form-group ">
                                    <select class="form-control" name="gender">
                                        <option value="male" @if ($employee->gender == 'male') selected @endif>{{ __('core.male') }}</option>
                                        <option value="female" @if ($employee->gender == 'female') selected @endif>{{ __('core.female') }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label">{{ trans('core.phone') }}</label>
                                <div class="form-group">
                                    <input type="text" name="mobile_number" class="form-control" value="{{ $employee->mobile_number }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-row col-12">
                            <div class="col-md-6 mb-2">
                                <label class="form-label">{{ trans('core.local_address') }}</label>
                                <div class="form-group">
                                    <textarea name="local_address" class="form-control" rows="3">{{ $employee->local_address }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">{{ trans('core.permanent_address') }}</label>
                                <div class="form-group">
                                    <textarea name="permanent_address" class="form-control" rows="3">{{ $employee->permanent_address }}</textarea>
                                </div>
                            </div>
                        </div>
                        <h4 class="block">{{ trans('core.accountLogin') }}</h4>
                        <div class="form-row col-12">
                            <div class="col-md-6">
                                <label class="form-label">{{ trans('core.email') }}<span class="required">*
                                    </span></label>
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" value="{{ $employee->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ trans('core.password') }}</label>
                                <div class="form-group">
                                    <input type="hidden" name="oldpassword" value="{{ $employee->password }}">
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    <i class="fal fa-industry"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('core.companyDetails') }}
                </h2>

                <div class="actions">
                    <button type="button" onclick="UpdateDetails('{{ $employee->id }}','company');return false" class="btn btn-sm btn-success ">
                        <i class="fal fa-save"></i>
                       Save </button>
                </div>
            </div>

            <div class="panel-container show">
                <div class="panel-content">
                    {{-- ------------------Company Form------------------------------------------ --}}
                    {!! Form::open(['method' => 'PUT', 'class' => 'form-horizontal ajax_form', 'id' => 'company_details_form']) !!}

                    <input type="hidden" name="updateType" class="form-control" value="company">

                    <div id="alert_company">
                        {{-- INLCUDE ERROR MESSAGE BOX --}}

                        {{-- END ERROR MESSAGE BOX --}}
                    </div>
                    <div class="form-row col-12">
                        <div class="col-md-4 mb-2">
                            <label class="form-label">{{ trans('core.employeeID') }}<span class="required">* </span></label>
                            <input type="text" name="employeeID" class="form-control" value="{{ $employee->employeeID }}">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">{{ trans('core.department') }}<span class="required">* </span></label>
                            {!! Form::select('department', $department, $designation->department_id, ['class' => 'form-control select2me', 'id' => 'department', 'onchange' => 'dept();return false;']) !!}
                        </div>
                        <div class="col-md-4 mb-4">
                            <label class="form-label">{{ trans('core.designation') }}<span class="required">* </span></label>
                            <select class="select2me form-control" name="designation" id="designation"></select>
                        </div>
                    </div>
                    <div class="form-row col-12">
                        <div class="col-md-4 mb-2">
                            <label class="form-label">{{ trans('core.annualOrCredit') }}
                                {!! help_text('creditLeaves') !!}</label>
                            <input type="text" name="annual_leave" class="form-control" value="{{ $employee->annual_leave }}">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">{{trans('core.dateOfJoining')}}</label>
                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                                <input type="text" class="form-control" name="joining_date" readonly value="@if(empty($employee->joining_date)) @else {{date('d-m-Y',strtotime($employee->joining_date))}} @endif">
                                {{-- <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span> --}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{trans('core.exitDate')}} {!! help_text("exitDate") !!}</label>
                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                                <input type="text" class="form-control" name="exit_date" value="@if(empty($employee->exit_date)) @else {{date('d-m-Y',strtotime($employee->exit_date))}} @endif">
                                {{-- <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span> --}}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4><strong>{{ trans('core.salary') }}
                            ({{ $loggedAdmin->company->currency_symbol }})</strong></h4>
                    <div id="salaryData col-12">
                        @foreach ($employee->salaries as $salary)
                        <div id="salary{{ $salary->id }}">
                            <div class="form-group">
                                <div class="col-md-12 mb-3">
                                    @if ($salary->type == 'basic' || $salary->type == 'hourly_rate')
                                    <input type="hidden" class="form-control" name="type[{{ $salary->id }}]" value="{{ $salary->type }}">
                                    <label class="control-label">@lang('core.'.$salary->type)</label>
                                    @else
                                    <input type="text" class="form-control" name="type[{{ $salary->id }}]" value="{{ $salary->type }}">
                                    @endif
                                </div>

                                <div class="col-md-12 mb-3">
                                    <input type="text" class="form-control" name="salary[{{ $salary->id }}]" value="{{ $salary->salary }}">
                                </div>

                                <div class="col-md-12">
                                    <button class="btn btn-outline-danger btn-icon waves-effect waves-themed" onclick="del('{{ $salary->id }}','{{ $salary->type }}')"><i class="fal fa-trash"></i> </button>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <br>
                    <button class="btn btn-primary" href="javascript:;" onclick="showSalary({{ $employee->id }})">
                        {{ trans('core.addSalary') }}
                        <i class="fal fa-plus"></i>
                                </button>
                    {!! Form::close() !!}


                    {{-- --------------Company Form end ----------- --}}

                </div>
            </div>
        </div>

        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    <i class="fal fa-money"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp{{ trans('core.bankDetails') }}
                </h2>


                <br>
                <div class="actions">
                    <button type="button" onclick="UpdateDetails('{{ $employee->id }}','bank');return false" class="btn btn-sm btn-success ">
                        <i class="fa fa-save"></i> {{ trans('core.btnSave') }} </button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    {{-- ------------------Bank Account Form------------------------------------------ --}}
                    {!! Form::open(['method' => 'PUT', 'class' => 'form-horizontal ajax_form', 'id' => 'bank_details_form']) !!}

                    <input type="hidden" name="updateType" class="form-control" value="bank">

                    <div id="alert_bank"></div>
                    <div class="form-row col-12">
                        <div class="col-md-4 mb-2">
                            <label class="form-label">{{ trans('core.accountHolder') }}</label>
                            <input type="text" name="account_name" class="form-control" value="{{ isset($employee->bank_details->account_name) ? $employee->bank_details->account_name : '' }}">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class=" form-label">{{ trans('core.account_number') }}</label>
                            <input type="text" name="account_number" class="form-control" value="{{ isset($employee->bank_details->account_number) ? $employee->bank_details->account_number : '' }}">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">{{ trans('core.bank') }}</label>
                            <input type="text" name="bank" class="form-control" value="{{ isset($employee->bank_details->bank) ? $employee->bank_details->bank : '' }}">
                        </div>
                    </div>
                    <div class="form-row col-12">
                        <div class="col-md-4 mb-2">
                            <label class="form-label">{{ trans('core.bin') }}
                                {!! help_text('bankIdentificationCode') !!}</label>
                            <input type="text" name="bin" class="form-control" value="{{ isset($employee->bank_details->bin) ? $employee->bank_details->bin : '' }}">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">{{ trans('core.branch') }}</label>
                            <input type="text" name="branch" class="form-control" value="{{ isset($employee->bank_details->branch) ? $employee->bank_details->branch : '' }}">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">{{ trans('core.tax_payer_id') }}
                                {!! help_text('taxPayerID') !!}</label>
                            <input type="text" name="tax_payer_id" class="form-control" value="{{ isset($employee->bank_details->tax_payer_id) ? $employee->bank_details->tax_payer_id : '' }}">
                        </div>
                    </div>
                    {!! Form::close() !!}
                    {{-- -----------------Bank Account Form end--------------------------------------- --}}

                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix">
    <div class="row ">
        <div class="col-md-12 col-sm-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        <i class="fal fa-file"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('core.documents') }}
                    </h2>

                    <div class="actions">
                        <button onclick="UpdateDetails('{!! $employee->id !!}','documents')" type="button" class="btn btn-sm btn-success ">
                            <i class="fal fa-save"></i>Save </button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="portlet-body">
                            {{-- ------------------Documents Info Form------------------------------------------ --}}

                            {!! Form::open(['method' => 'PUT', 'route' => ['admin.employees.update', $employee->employeeID], 'class' => 'form-horizontal ajax_form', 'id' => 'documents_details_form', 'files' => true]) !!}

                            <input type="hidden" name="updateType" class="form-control" value="documents">


                            <div class="form-body">
                                <div class="form-group">
                                    <label class="form-label col-md-2">{{ trans('core.resume') }}</label>

                                    <div class="col-md-12">
                                        <div class="fileinput fileinput-new col-lg-12" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                    </span>
                                                </div>
                                                <span class="input-group-append btn btn-default btn-file">
                                                    <span class="fileinput-new">
                                                        {{ trans('core.selectFile') }} </span>
                                                    <span class="fileinput-exists">
                                                        {{ trans('core.change') }} </span>
                                                    <input type="file" name="resume">
                                                </span>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#" class="input-group-append btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                                    {{ trans('core.remove') }} </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        @if (isset($documents['resume']))
                                        <a href="https://docs.google.com/viewer?url={{ $documents['resume'] }}" target="_blank" class="btn btn-sm btn-info">@lang("core.viewResume")</a>
                                        @endif

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label col-md-2">@lang("core.offerLetter")</label>

                                    <div class="col-md-12">
                                        <div class="fileinput fileinput-new col-lg-12" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                    </span>
                                                </div>
                                                <span class="input-group-append btn btn-default btn-file">
                                                    <span class="fileinput-new">
                                                        {{ trans('core.selectFile') }} </span>
                                                    <span class="fileinput-exists">
                                                        {{ trans('core.change') }} </span>
                                                    <input type="file" name="offerLetter">
                                                </span>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#" class="input-group-append btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                                    {{ trans('core.remove') }} </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        @if (isset($documents['offerLetter']))
                                        <a href="https://docs.google.com/viewer?url={{ $documents['offerLetter'] }} " target="_blank" class="btn btn-sm btn-info">@lang("core.viewOfferLetter")</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label col-md-2">@lang("core.joiningLetter")</label>

                                    <div class="col-md-12">
                                        <div class="fileinput fileinput-new col-lg-12" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                    </span>
                                                </div>
                                                <span class="input-group-append btn btn-default btn-file">
                                                    <span class="fileinput-new">
                                                        {{ trans('core.selectFile') }} </span>
                                                    <span class="fileinput-exists">
                                                        {{ trans('core.change') }} </span>
                                                    <input type="file" name="joiningLetter">
                                                </span>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#" class="input-group-append btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                                    {{ trans('core.remove') }} </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        @if (isset($documents['joiningLetter']))
                                        <a href="https://docs.google.com/viewer?url={{ $documents['joiningLetter'] }}" target="_blank" class="btn btn-sm btn-info">@lang("core.viewJoiningLetter")</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label col-md-2">@lang("core.contractOrAgreement")</label>

                                    <div class="col-md-12">
                                        <div class="fileinput fileinput-new col-lg-12" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                    </span>
                                                </div>
                                                <span class="input-group-append btn btn-default btn-file">
                                                    <span class="fileinput-new">
                                                        {{ trans('core.selectFile') }} </span>
                                                    <span class="fileinput-exists">
                                                        {{ trans('core.change') }} </span>
                                                    <input type="file" name="contract">
                                                </span>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#" class="input-group-append btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                                    {{ trans('core.remove') }} </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        @if (isset($documents['contract']))
                                        <a href="https://docs.google.com/viewer?url={{ $documents['contract'] }}" target="_blank" class="btn btn-sm btn-info">@lang("core.viewContractOrAgreement")</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label col-md-2">@lang("core.idProof")</label>

                                    <div class="col-md-12">
                                        <div class="fileinput fileinput-new col-lg-12" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                    </span>
                                                </div>
                                                <span class="input-group-append btn btn-default btn-file">
                                                    <span class="fileinput-new">
                                                        {{ trans('core.selectFile') }} </span>
                                                    <span class="fileinput-exists">
                                                        {{ trans('core.change') }} </span>
                                                    <input type="file" name="IDProof">
                                                </span>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#" class="input-group-append btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                                    {{ trans('core.remove') }} </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        @if (isset($documents['IDProof']))
                                        <a href="https://docs.google.com/viewer?url={{ $documents['IDProof'] }}" target="_blank" class="btn btn-sm btn-info">@lang("core.viewIDProof")</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    {{-- -----------DELETE MODAL CALLING---------- --}}
    @include('admin.common.delete')


    {{-- -------------DELETE MODAL CALLING END------ --}}


</div>

<div class="modal fade save_salary" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModal">
    <div class="modal-dialog">
        <div class="modal-content" id="show-salary-content">
        </div>
    </div>
</div>

{{-- ----------------------------------END NEW SALARY ADD MODALS------------------------------------ --}}

@stop



@section('page_js')


<!-- BEGIN PAGE LEVEL PLUGINS -->


<!-- END PAGE LEVEL PLUGINS -->




<script>
    var controls = {
        leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
        rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
    }
    var runDatePicker = function() {

        // minimum setup
        $('#datepicker-1').datepicker({
            orientation: "top left",
            todayHighlight: true,
            templates: controls
        });
    }

    jQuery(document).ready(function() {
        runDatePicker();
        ComponentsPickers.init();
        dept();
    });

    // $(document).ready(function() {
    //     runDatePicker();
    // });



    function dept() {

        $.getJSON("{{ route('admin.departments.ajax_designation') }}", {
                department_id: $('#department').val()
            },
            function(data) {
                var model = $('#designation');
                model.empty();
                var selected = '';
                var match = '{{ $employee->designation }}';
                $.each(data, function(index, element) {
                    if (element.id == match) selected = 'selected';
                    else selected = '';
                    model.append("<option value='" + element.id + "' " + selected + ">" + element
                        .designation + "</option>");
                });

            });


    }


    // Add New Salary
    function saveSalary(id) {
        var url = "{{ route('admin.salary.store') }}";
        url = url.replace(':id', id);
        $.easyAjax({
            type: 'POST',
            url: url,
            container: '#save_salary',
            data: $('#save_salary').serialize(),
            success: function(response) {
                if (response.status == "success") {
                    $('#showModal').modal('hide');
                    $('#salaryData').append(response.viewData);
                }
            }
        });
    }

    // Show Salary Modal

    function showSalary(id) {
        var url = "{{ route('admin.add-salary-modal', [':id']) }}";
        url = url.replace(':id', id);
        $('#showModal').modal('show', url);

        $.ajax({
            type: 'GET',
            url: url,

            data: {},
            success: function(response) {
                $('#show-salary-content').html(response);
            },

            error: function(xhr, textStatus, thrownError) {
                $('#show-salary-conten').html(
                    '<div class="alert alert-danger">Error Fetching data</div>');
            }
        });

    }
    // function showSalary(id) {
    //     $('#showModal .modal-dialog').removeClass("modal-md").addClass("modal-lg");
    //     var url = "{{ route('admin.add-salary-modal', [':id']) }}";
    //     url = url.replace(':id', id);
    //     $.ajaxModal('#showModal', url);
    //     $('#showModal_div').removeClass("modal-dialog modal-lg").addClass("modal-dialog modal-md");
    // }
    // Show Delete Modal and delete salary
    function del(id, type) {

        $('#deleteModal').modal('show');

        $("#deleteModal").find('#info').html('Are you sure ! You want to delete <strong>' + type +
            '</strong> Salary?.');

        $('#deleteModal').find("#delete").off().click(function() {

            var url = "{{ route('admin.salary.destroy', ':id') }}";
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
                        $('#salary' + id).remove();
                        toastr['success']('Deleted successfully!');
                        window.location.reload();
                    }
                }
            });

        });
    }


    function remove_exit() {
        if ($("input[name=status]:checked").val() == "active") {
            $("input[name=exit_date]").val("");
        }
    }


    $("input[name=exit_date]").change(function() {
        $("input[name=status]").bootstrapSwitch('state', false);

    });
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
            // $("#cropData").val(JSON.stringify(cropBoxData));
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

    // Javascript function to update the company info and Bank Info
    function UpdateDetails(id, type) {
        var cropPhoto = '';
        if(type == 'personal'){
            cropPhoto = croppedImage;
        }
        var form_id = '#' + type + '_details_form';
        var alert_div = '#' + type + '_alert';

        var url = "{{ route('admin.employees.update', ':id') }}";
        url = url.replace(':id', id);
        $.easyAjax({
            type: 'POST',
            url: url,
            data: {cropImage: cropPhoto},
            container: form_id,
            file: true,
            alertDiv: alert_div
        });
    }
</script>


@stop