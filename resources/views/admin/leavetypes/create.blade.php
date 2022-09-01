<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
        <div class="d-block position-absolute pos-top pos-left p-2 ">
            <h4 class="modal-title"><strong><i class="lal la-plus"></i> @lang('core.addLeaveType')</strong></h4>
        </div>
    </div>
    <div class="modal-body">
        <div class="panel-body form">
            {!! Form::open(['class' => 'horizontal-form ajax_form', '', 'id' => 'add_form']) !!}
            <div class="modal-body">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-4 form-label">{{ trans('core.typeOfLeave') }}<span
                                    class="required">
                                    * </span>
                            </label>

                            <div class="col-md-12">
                                <input type="text" class="form-control input-medium date-picker" id="leaveType"
                                    name="leaveType" placeholder="{{ trans('core.typeOfLeave') }}">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 form-label">{{ trans('core.noOfDays') }}
                                <span class="required">
                                    * </span>
                                </span>
                            </label>

                            <div class="col-md-12">
                                <input type="text" class="form-control only-num input-medium date-picker"
                                    name="num_of_leave" id="num_of_leave" placeholder="{{ trans('core.noOfDays') }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <!-- END FORM-->
                </div>
            </div>
            <div class="form-group text-center">
                <button type="button" id="submitbutton_add" class="btn btn-primary"
                    onclick="addSubmit();return false;">
                    {{ trans('core.btnSubmit') }}</button>

            </div>

            {!! Form::close() !!}

        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
