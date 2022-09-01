<div class="modal-content">
    <div class="modal-header">
        <div class="d-block position-absolute pos-top pos-left p-2 ">

            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title"><strong><i class="fal fa-edit"></i> {{ trans('core.editAdmin') }}</strong></h4>
        </div>
    </div>
    {!! Form::open(['class' => 'form-horizontal', 'method' => 'POST', 'id' => 'edit_form']) !!}
    <div class="modal-body" id="edit-modal-body">
        <div class="portlet-body form">

            <div id="error_edit"></div>
            <div class="form-body">

                <div class="form-group">
                    <label class="col-md-4 form-label">{{ trans('core.name') }}: <span class="required">
                            * </span>
                    </label>

                    <div class="col-md-12">
                        <input type="text" class="form-control" name="name" placeholder="{{ trans('core.name') }}"
                            value="{{ $admin->name }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 form-label">{{ trans('core.email') }}: <span class="required">
                            * </span>
                    </label>

                    <div class="col-md-12">
                        <input type="text" class="form-control" name="email" placeholder="{{ trans('core.email') }}"
                            value="{{ $admin->email }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 form-label">{{ trans('core.password') }}:
                    </label>

                    <div class="col-md-12">
                        <input type="password" class="form-control" name="password"
                            placeholder="{{ trans('core.password') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 form-label">{{ trans('core.confirmPassword') }}:
                    </label>

                    <div class="col-md-12">
                        <input type="password" class="form-control" name="password_confirmation"
                            placeholder="{{ trans('core.confirmPassword') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Type: <span class="required">
                            * </span>
                    </label>

                    <div class="col-md-12">
                        <select name="type" id="type" class="form-control">
                            <option value="hr" {{ $admin->type == 'hr' ? 'selected' : '' }}> HR </option>
                            <option value="admin" {{ $admin->type == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>


            </div>


        </div>
    </div>
    <br>
    <div class="form-group text-center">
        <button type="button" id="submitbutton_edit" onclick="updateAdminSubmit({{ $admin->id }});return false;"
            class=" btn btn-primary"><i class="fa fa-edit"></i> {{ trans('core.btnSubmit') }}</button>

    </div>
    <br>
    {!! Form::close() !!}
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
