<div class="modal fade" id="default-example-modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
    <div class="d-block position-absolute pos-top pos-left p-2 ">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">{{trans('core.addNewAdmin')}}</h4>
        </div>
    </div>
    <div class="modal-body">
        <div class="form">

            <!-- BEGIN FORM-->
            {!! Form::open(array('class'=>'form-horizontal','id'=>'add_form')) !!}

            <div id="error"></div>
            <div class="form-body">

                <div class="form-group">
                    <label class="col-md-4 form-label">{{trans('core.name')}}: <span class="required">
                                    * </span>
                    </label>

                    <div class="col-md-12">
                        <input type="text" class="form-control" name="name" id="name"
                               placeholder="{{trans('core.name')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 form-label">{{trans('core.email')}}: <span class="required">
                                    * </span>
                    </label>

                    <div class="col-md-12">
                        <input type="text" class="form-control" name="email" id="email"
                               placeholder="{{trans('core.email')}}">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 form-label">{{trans('core.password')}}: <span
                                class="required">
                                    * </span>
                    </label>

                    <div class="col-md-12">
                        <input type="password" class="form-control" name="password" id="password"
                               placeholder="{{trans('core.password')}}">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 form-label">{{trans('core.confirmPassword')}}: <span
                                class="required">
                                    * </span>
                    </label>

                    <div class="col-md-12">
                        <input type="password" class="form-control" name="password_confirmation"
                               id="password_confirmation"
                               placeholder="{{trans('core.confirmPassword')}}">
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Type: <span
                                class="required">
                                    * </span>
                    </label>

                    <div class="col-md-12">
                        <select name="type" id="type" class="form-control">
                            <option value="hr"> HR </option>
                            <option value="admin">Admin</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>


            <!-- END FORM-->
        </div>
    </div>
        <br>
               <div class="form-group text-center">
                    <button type="submit" id="submitbutton_add" onclick="addAdminSubmit();return false;"
                            class=" btn btn-primary">{{trans('core.btnSubmit')}}
                    </button>

                </div>
            <br>
        {!!  Form::close()  !!}
    
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
</div>
</div>