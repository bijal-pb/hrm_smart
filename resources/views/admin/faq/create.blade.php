{!! Form::open(array('url'=>"",'class'=>'form-horizontal add_form','id'=>'add_edit_form')) !!}
<div class="form-body">

    <div class="form-group">
        <label class="col-md-3 control-label">{{trans('core.faqCategory')}}: <span class="required">
                        * </span>
        </label>
        <div class="col-md-12">
            <select class="form-control select2" name="faq_category_id">
                <option value="" selected="selected">{{trans('core.selectFaqCategory')}}</option>
                @foreach($faqCategories as $faqCategory)
                    <option value="{{ $faqCategory->id }}">{{ $faqCategory->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{{trans('core.title')}}: <span class="required">
                        * </span>
        </label>
        <div class="col-md-12">
            <input type="text" class="form-control" id="title" name="title" placeholder="{{trans('core.title')}}"
                   value="{{$faq->title}}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{{trans('core.faqContent')}}: <span class="required">
                        * </span>
        </label>
        <div class="col-md-12">
            <textarea class="form-control" id="content_text" style="height: 150px;"
                      name="content_text">{{ $faq->content_text }}</textarea>
        </div>
    </div>

</div>

<div class="modal-footer">
    <div class="form-actions">
            <p class="text-center">
                <button type="submit" id="submitbutton_add" onclick="addData();return false;"
                        class=" btn btn-primary"><i class="fa fa-edit"></i> {{trans('core.btnSubmit')}}</button>
                <button type="button" data-dismiss="modal"
                        class="btn btn-default btn-outline">{{trans('core.btnCancel')}}</button>
            </p>
    </div>
</div>
{!!  Form::close()  !!}

<script type="text/javascript">
    $('.select2me').select2({
        placeholder: "Select",
        width: '100%',
        allowClear: false
    });
</script>