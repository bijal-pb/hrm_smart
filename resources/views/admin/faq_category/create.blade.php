{!! Form::open(array('url'=>"",'class'=>'form-horizontal add_form','id'=>'add_edit_form')) !!}
<div class="form-body">

    <div class="form-group">
        <label class="col-md-3 control-label">{{trans('core.name')}}: <span class="required">
                        * </span>
        </label>
        <div class="col-md-12">
            <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('core.name')}}"
                   value="{{$faqCategory->name}}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">Status: <span class="required">
                    * </span>
        </label>
        <div class="col-md-12">
            {!!  Form::radio('status','active',($faqCategory->status=='active'))  !!} Active<br>
            {!!  Form::radio('status', 'inactive',($faqCategory->status=='inactive'))  !!} Inactive
        </div>
    </div>
</div>

<div class="modal-footer">
    <div class="form-actions">
             <p class="text-center">
                <button type="submit" id="submitbutton_add" onclick="addData();return false;"class=" btn btn-primary"><i class="fa fa-edit"></i> {{trans('core.btnSubmit')}}</button>
                <button type="button" data-dismiss="modal"
                        class="btn btn-default btn-outline">{{trans('core.btnCancel')}}</button>
            </p>
    </div>
</div>
{!!  Form::close()  !!}