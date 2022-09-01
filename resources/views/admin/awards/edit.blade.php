<div class="modal fade edit_award" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="data-model">
    <div class="modal-dialog">
        <div class="modal-content" id="edit-award-content">
        </div>
    </div>
</div>
<div class="page-head">
    <div class="page-title">
        <h3 class="mx-2 my-2">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
            <i class="fal fa-trophy"></i>
            {{trans('core.editAward')}}
        </h3>
    </div>
</div>
<div class="panel-container show">
    <div class="panel-content">
        <!------------------------ BEGIN FORM---------------------->
        {!! Form::model($award, ['method' => 'PATCH', 'class'=>'form-horizontal ajax_form']) !!}

           
        <div class="form-group">
            <label class="form-label mx-3">{{trans('core.award_name')}} {!! help_text("award_name") !!}
                <span class="required">
                    * </span>
            </label>

            <div class="col-md-12">
                <input type="text" class="form-control" name="award_name" id="award_name" placeholder="{{ trans('core.award_name') }}" value="{{ $award->award_name }}">
                <span class="help-block"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label mx-3 mx-3">{{ trans('core.gift') }} {!! help_text("awardGift") !!}
                <span class="required">
                    * </span>
            </label>

            <div class="col-md-12">
                <input type="text" class="form-control" name="gift" id="gift" placeholder="{{trans('core.gift')}}" value="{{ $award->gift }}">
                <span class="help-block"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label mx-3">{{trans('core.cash_price')}}
                ({{$loggedAdmin->company->currency_symbol}})</label>

            <div class="col-md-12">
                <input type="text" class="form-control" name="cash_price" placeholder="{{trans('core.cash_price')}}" value="{{ $award->cash_price }}">
            </div>
        </div>


        <div class="form-group">
            <label class="form-label mx-3">{{trans('core.employee')}} {{trans('core.name')}}</label>

            <div class="col-md-12">
                <select class="form-control select2me" name="employee_id">
                    @foreach($employees as $employee)
                    <option value="{{$employee->id}}" @if($employee->id==$award->employee_id)selected='selected'@endif >{{$employee->full_name}} (@lang('core.empId'): {{ $employee->employeeID }})</option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="form-group">
            <label class="form-label mx-3">{{trans('core.month')}}</label>

            <div class="col-md-12">
                <select class="form-control select2me" name="month">
                    <option value="" selected="selected">{{trans('core.month')}}</option>
                    <option value="january" @if($award->month=='january')selected='selected'@endif >{{trans('core.jan')}}</option>
                    <option value="february" @if($award->month=='february')selected='selected'@endif>{{trans('core.feb')}}</option>
                    <option value="march" @if($award->month=='march')selected='selected'@endif>{{trans('core.mar')}}</option>
                    <option value="april" @if($award->month=='april')selected='selected'@endif>{{trans('core.apr')}}</option>
                    <option value="may" @if($award->month=='may')selected='selected'@endif>{{trans('core.may')}}</option>
                    <option value="june" @if($award->month=='june')selected='selected'@endif>{{trans('core.june')}}</option>
                    <option value="july" @if($award->month=='july')selected='selected'@endif>{{trans('core.july')}}</option>
                    <option value="august" @if($award->month=='august')selected='selected'@endif>{{trans('core.aug')}}</option>
                    <option value="september" @if($award->month=='september')selected='selected'@endif>{{trans('core.sept')}}</option>
                    <option value="october" @if($award->month=='october')selected='selected'@endif>{{trans('core.oct')}}</option>
                    <option value="november" @if($award->month=='november')selected='selected'@endif>{{trans('core.nov')}}</option>
                    <option value="december" @if($award->month=='december')selected='selected'@endif>{{trans('core.dec')}}</option>
                </select>

            </div>
        </div>
        <div class="form-group">

            <label class="form-label mx-3">{{trans('core.year')}}</label>

            <div class="col-md-12">
                {!! Form::selectYear('year', 2017, date('Y')+1,$award->year,['class'=>'form-control select2me']) !!}
            </div>
        </div>


        <br>
        <div class="form-group text-center">
            <button type="button" id="updateAward" class=" btn btn-primary" onclick="ajaxUpdateAward({{$award->id}});return false;"><i class="fal fa-check"></i> {{trans('core.btnUpdate')}}</button>
        </div>

        <!------------------------- END FORM ----------------- mx-3------>
    </div>

</div>
{!! Form::close() !!}
</div>