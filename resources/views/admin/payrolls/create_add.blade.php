<div class="col-md-12">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->

    {{-- INLCUDE ERROR MESSAGE BOX --}}
    <div id="error"></div>
    {{-- END ERROR MESSAGE BOX --}}

    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
                @lang("core.salaryInfo")

            </h2>
            
        </div>

        <div class="panel-container show">
            <div class="panel-content">
                <div class="row">

                    <div class="form-group">
                        <label class="col">@lang("core.hourlyRate")</label>

                        <div class="col">
                            <input type="text" class="form-control only-num" id="hourly_rate" name="hourly_rate"
                                placeholder="@lang(" core.hourlyRate")" value="{{ $hourly_rate }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col">@lang("core.hoursClocked")</label>

                        <div class="col">
                            <input type="text" class="form-control only-num" id="overtime_hours" name="overtime_hours"
                                placeholder="@lang(" core.hoursClocked")" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col">@lang("core.totalHoursPayment")
                            ({{ $loggedAdmin->company->currency_symbol }})
                        </label>

                        <div class="col">
                            <input type="text" class="form-control only-num" id="overtime_pay" name="overtime_pay"
                                placeholder="overtime_pay" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col">@lang("core.basicSalary")
                            ({{ $loggedAdmin->company->currency_symbol }}) </label>

                        <div class="col">
                            <input type="text" class="form-control only-num" id="basic" name="basic"
                                placeholder="@lang(" core.basicSalary") "
                           value=" {{ $basicSalary }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col">@lang("core.expenseClaim")
                            ({{ $loggedAdmin->company->currency_symbol }}) </label>

                        <div class="col">
                            <input type="text" class="form-control only-num" id="expense_claim" name="expense"
                                placeholder="@lang(" core.expenseClaim")" value="{{ $expense }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col">@lang("core.status")</label>

                        <div class="col">
                            <select class="form-control select2me" name="status">
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                            </select>
                        </div>
                    </div>
                    <!--/span-->
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Allowances --}}
<div class="col-md-12">
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
                @lang("core.allowances")
            </h2>
           
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <div class="portlet-body">
                    <div class="form-group">
                        <div class="row mx-md-n5">
                            <div class="col px-md-5">
                                <input type="text" class="form-control" name="allowanceTitle[]" placeholder="@lang("core.allowance") 1" value="Bonus">
                            </div>
                            <div class="col px-md-5">
                                <input type="text" class="allowance form-control" placeholder="@lang(" core.value")"
                                    name="allowance[]" value="{{ $awardBonus }}">
                            </div>
                        </div>
                        {{-- <label class="form-label col-md-1">{{ $loggedAdmin->company->currency }}</label> --}}
                    </div>
                    {{-- <div class="form-group" id="allowance1">
                        <label class="form-label col-md-2"></label>
                        <div class="row mx-md-n5">
                            <div class="col px-md-5">
                                <input type="text" class="form-control" name="allowanceTitle[]" placeholder="@lang("core.allowance") 2">
                            </div>
                            <div class="col px-md-5">
                                <input type="text" class="allowance form-control" placeholder="value" name="allowance[]">
                            </div>
                            <label class="form-label col-md-1">{{ $loggedAdmin->company->currency }}</label>

                            <div class="col-md-2">
                                <button type="button" onclick="$('#allowance1').remove();"
                                    class="btn btn-danger btn-sm delete">
                                    <i class="fal fa-close"></i>
                                </button>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="form-group" id="allowance2">
                        <label class="form-label col-md-2"></label>
                        <div class="row mx-md-n5">
                            <div class="col px-md-5">
                                <input type="text" class="form-control" name="allowanceTitle[]" placeholder="@lang("core.allowance") 3">
                            </div>
                            <div class="col px-md-5">
                                <input type="text" class="allowance form-control" placeholder="value"
                                    name="allowance[]">
                            </div>
                            <label class="form-label col-md-1">{{ $loggedAdmin->company->currency }}</label>
                            <div class="col-md-2">
                                <button type="button" onclick="$('#allowance2').remove();"
                                    class="btn btn-danger btn-sm delete">
                                    <i class="fal fa-close"></i>
                                </button>
                            </div>
                        </div>
                    </div> --}}
                </div><br>
                <div id="insertBeforeA"></div>
                <div class="form-group">
                    <div class="col-md-12  margin-bottom-10 text-center">
                        <button type="button" id="plusButtonA"
                            class="btn btn-primary btn-sm  form-control-inline">
                            <i class="fal fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Allowances End --}}
{{-- Deductions --}}
<div class="col-md-12">
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
                @lang("core.deductions")
            </h2>
           
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <div class="form-group">
                    <label class="control-label col-md-2"></label>
                    <div class="row mx-md-n5">
                        <div class="col px-md-5">
                            <input type="text" class="form-control" placeholder="deduction 1" name="deductionTitle[]">
                        </div>
                        <div class="col px-md-5">
                            <input type="text" class="deduction form-control" placeholder="value" name="deduction[]">
                        </div>
                    </div>
                    {{-- <label class="control-label col-md-1">{{ $loggedAdmin->company->currency }}</label> --}}
                </div>
                {{-- <div class="form-group" id="deduction1">
                    <label class="control-label col-md-2"></label>
                    <div class="row mx-md-n5">
                        <div class="col px-md-5">
                            <input type="text" class="form-control" placeholder="deduction 2" name="deductionTitle[]">
                        </div>
                        <div class="col px-md-5">
                            <input type="text" class="deduction form-control" placeholder="value" name="deduction[]">
                        </div>
                        <label class="control-label col-md-1">{{ $loggedAdmin->company->currency }}</label>

                        <div class="col-md-2">
                            <button type="button" onclick="$('#deduction1').remove();"
                                class="btn btn-danger btn-sm delete">
                                <i class="fal fa-close"></i>
                            </button>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="form-group" id="deduction2">
                    <label class="control-label col-md-2"></label>
                    <div class="row mx-md-n5">
                        <div class="col px-md-5">
                            <input type="text" class="form-control" placeholder="deduction 3"
                                name="deductionTitle[]">
                        </div>
                        <div class="col px-md-5">
                            <input type="text" class="deduction form-control" placeholder="value"
                                name="deduction[]">
                        </div>
                        <label class="control-label col-md-1">{{ $loggedAdmin->company->currency }}</label>

                        <div class="col-md-2">
                            <button type="button" onclick="$('#deduction2').remove();"
                                class="btn btn-danger btn-sm delete">
                                <i class="fal fa-close"></i>
                            </button>
                        </div>
                    </div>
                </div> --}}
                <div id="insertBeforeD"></div>
                <div class="form-group">
                    <div class="col-md-12  margin-bottom-10 text-center">
                        <button type="button" id="plusButtonD" class="btn btn-primary btn-sm  form-control-inline">
                            <i class="fal fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
{{-- Deductions End --}}
{{-- Gross --}}
<div class="col-md-12">
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
                @lang("core.grossSalary")
            </h2>
           
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <div class="form-group">
                    <label class="form-label col-md-3">@lang("core.totalAllowances")
                        ({{ $loggedAdmin->company->currency_symbol }})</label>

                    <div class="col-md-12 margin-bottom-10">
                        <input type="text" class="form-control" id="total_allowance" name="total_allowance"
                            placeholder="@lang(" core.total")" value="0" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label col-md-3">@lang("core.totalDeductions")
                        ({{ $loggedAdmin->company->currency_symbol }})</label>

                    <div class="col-md-12 margin-bottom-10">
                        <input type="text" class="form-control" id="total_deduction" name="total_deduction"
                            placeholder="@lang(" core.total")" value="0" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label col-md-3">@lang("core.netSalary")
                        ({{ $loggedAdmin->company->currency_symbol }})</label>

                    <div class="col-md-12 margin-bottom-10">
                        <input type="text" class="form-control" id="net_salary" name="net_salary"
                            placeholder="@lang(" core.total")" value="0" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Gross End --}}
<div class="col-md-12 text-center">
    <div class="portlet light bordered">
        <div class="portlet-body">
            <button type="button" class="btn btn-primary"
               id="add_submit" onclick="submitData();return false;">@lang("core.btnSubmit")</button>
        </div>

    </div>
</div>
