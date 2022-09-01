<div class="col-md-12">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->

    {{-- INLCUDE ERROR MESSAGE BOX --}}
    <div id="error"></div>
    {{-- END ERROR MESSAGE BOX --}}

    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
                <i class="fal fa-rupee-sign"></i> @lang("core.editSalaryInfo")
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
                                placeholder="@lang(" core.hoursClocked")" value="{{ $payrolls->overtime_hours }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col">@lang("core.totalHoursPayment")
                            ({{ $loggedAdmin->company->currency_symbol }})</label>

                        <div class="col">
                            <input type="text" class="form-control only-num" id="overtime_pay" name="overtime_pay"
                                placeholder="overtime_pay" value="{{ $payrolls->overtime_pay }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col">@lang("core.basicSalary")
                            ({{ $loggedAdmin->company->currency_symbol }})</label>

                        <div class="col">
                            <input type="text" class="form-control" id="basic" name="basic" placeholder="@lang("
                                core.basicSalary")" value="{{ $payrolls->basic }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col">@lang("core.expenseClaim")
                            ({{ $loggedAdmin->company->currency_symbol }})</label>

                        <div class="col">
                            <input type="text" class="form-control only-num" id="expense_claim" name="expense"
                                placeholder="@lang(" core.expenseClaim")" value="{{ $payrolls->expense }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col">@lang("core.status") </label>

                        <div class="col">
                            <select class="form-control select2me" name="status">
                                <option value="paid" @if ($payrolls->status == 'paid') selected @endif>Paid</option>
                                <option value="unpaid" @if ($payrolls->status == 'unpaid') selected @endif>Unpaid</option>
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
                @lang("core.editAllowances")
            </h2>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <?php $i = 0; ?>
                @foreach (json_decode($payrolls->allowances) as $index => $value)
                    <div class="form-group" id="allowance{{ $i }}">
                        <div class="row mx-md-n5">
                            <div class="col px-md-5">
                                    <input type="text" class="form-control" name="allowanceTitle[]"
                                        placeholder="@lang(" core.allowance") {{ $i + 1 }}"
                                        value="{{ $index }}">
                                </div>
                                <div class="col px-md-5">
                                    <input type="text" class="allowance form-control" placeholder="@lang(" core.value")"
                                        name="allowance[]" value="{{ $value }}">
                                </div>
                        </div>
                        
                                <label class="form-label col-md-1">{{ $loggedAdmin->company->currency }}</label>
                                @if ($i > 0)
                                    <div class="col-md-2">
                                        <button type="button" onclick="$('#allowance{{ $i }}').remove();"
                                            class="btn btn-danger btn-sm delete">
                                            <i class="fal fa-close"></i>
                                        </button>
                                    </div>
                                @endif
                                <?php $i++; ?>
                            </div>
                @endforeach
                <br><div id="insertBeforeA"></div>
                <div class="form-group">
                    <div class="col-md-12  margin-bottom-10 text-center">
                        <button type="button" id="plusButtonA" class="btn btn-primary btn-sm  form-control-inline">
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
                @lang("core.editDeductions")
            </h2>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <?php $i = 0; ?>
                @foreach (json_decode($payrolls->deductions) as $index => $value)
                    <div class="form-group" id="deduction{{ $i }}">
                        <label class="control-label col-md-2"></label>

                        <div class="col-md-7 margin-bottom-10">
                            <input type="text" class="form-control" name="deductionTitle[]"
                                value="{{ $index }}" placeholder="@lang(" core.deduction")
                                {{ $i + 1 }}">
                        </div>
                        <div class="col-md-7 margin-bottom-10">
                            <input type="text" class="deduction form-control" name="deduction[]"
                                value="{{ $value }}" placeholder="@lang(" core.value")">
                        </div>
                        <label class="form-label col-md-1">{{ $loggedAdmin->company->currency }}</label>
                        @if ($i > 0)
                            <div class="col-md-2">
                                <button type="button" onclick="$('#deduction{{ $i }}').remove();"
                                    class="btn btn-danger btn-sm delete">
                                    <i class="fal fa-close"></i>
                                </button>
                            </div>
                        @endif
                        <?php $i++; ?>
                    </div>
                @endforeach


                <div id="insertBeforeD"></div>
                <div class="form-group">
                    <div class="col-md-12  margin-bottom-10 text-center">
                        <button type="button" id="plusButtonD" class="btn btn-primary btn-sm form-control-inline">
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
        <div class="portlet-body">
            <div class="form-group">
                <label class="form-label col-md-2">@lang("core.totalAllowances")
                    ({{ $loggedAdmin->company->currency_symbol }})</label>

                <div class="col-md-12 margin-bottom-10">
                    <input type="text" class="form-control" id="total_allowance" name="total_allowance"
                        placeholder="@lang(" core.total")" value="{{ $payrolls->total_allowance }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label col-md-2">@lang("core.totalDeductions")
                    ({{ $loggedAdmin->company->currency_symbol }})</label>

                <div class="col-md-12 margin-bottom-10">
                    <input type="text" class="form-control" id="total_deduction" name="total_deduction"
                        placeholder="@lang(" core.total")" value="{{ $payrolls->total_deduction }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label col-md-2">@lang("core.netSalary")
                    ({{ $loggedAdmin->company->currency_symbol }})</label>

                <div class="col-md-12 margin-bottom-10">
                    <input type="text" class="form-control" id="net_salary" name="net_salary" placeholder="@lang("
                        core.total")" value="{{ $payrolls->net_salary }}" readonly>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
</div>
{{-- Gross End --}}
<div class="col-md-12 text-center margin-bottom-30">
    <div class="portlet light bordered">
        <div class="portlet-body">
            <button type="button" class="btn btn-primary"
               id="update_submit" onclick="submitData();return false;">@lang("core.btnSubmit")</button>

        </div>
    </div>
</div>
