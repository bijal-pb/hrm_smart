<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
        <div class="d-block position-absolute pos-top pos-left p-2 ">
            <h4 class="modal-title"><strong>
                    <i class="la la-edit"></i> @lang('core.editLeaveType')</strong></h4>
        </div>
    </div>
    <div class="modal-body">
        <div class="panel-body form">

            <!-- BEGIN FORM-->

            {!! Form::open(['method' => 'PATCH', 'url' => '', 'class' => 'horizontal-form ajax_form', 'id' => 'edit_form']) !!}

            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-4 form-label">{{ trans('core.typeOfLeave') }}<span class="required">
                            * </span>
                    </label>

                    <div class="col-md-12">
                        <input type="text" class="form-control input-medium date-picker" id="leaveType" name="leaveType"
                            value="{{ $leavetype->leaveType }}" placeholder="{{ trans('core.typeOfLeave') }}">
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
                        <input type="text" class="form-control only-num input-medium date-picker" name="num_of_leave"
                            id="num_of_leave" value="{{ $leavetype->num_of_leave }}"
                            placeholder="{{ trans('core.noOfDays') }}">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>


            <br>

            <div class="form-group text-center">
                <button type="button" id="edit_submit" onclick="updateSubmit({{ $leavetype->id }});return false;"
                    class="btn btn-primary"> {{ trans('core.btnUpdate') }}</button>
                {{-- <button type="button" onclick="addUpdateLeaveType({{$leavetype->id}})"
                                class="btn btn-primary"> @if (isset($leavetype))<i class="la la-edit"></i>  @lang('core.btnUpdate') @else
                                <i class="fal fa-check"></i>   @lang('core.btnSubmit') @endif</button> --}}

            </div>

            {!! Form::close() !!}
            <!-- END FORM-->
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
