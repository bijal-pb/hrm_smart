<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
        <div class="d-block position-absolute pos-top pos-left p-2 ">
            <h4 class="modal-title"><strong><i class="fal fa-edit"></i> {{ trans('core.editDepartment') }}</strong>
            </h4>
        </div>
    </div>

    <div class="modal-body">
        {!! Form::open(['method' => 'PATCH', 'url' => '', 'class' => 'horizontal-form ajax_form', 'id' => 'edit_form']) !!}

        <div id="error_edit"></div>
        <div class="form-body">
            <div class="form-group">
                <label class="form-label">{{ trans('core.department') }}</label>
                <input class="form-control" name="name" id="edit_name" type="text" value="{{ $department->name }}"
                    placeholder="{{ trans('core.department') }}" />

            </div>

            <div id="deptresponse"></div>
            @foreach ($department->designations as $index => $designation)
                <div class="form-group" id="edit_field">
                    <div>
                        <input class="form-control designation form-control-inline input-medium"
                            name="designation[{{ $index }}]" value="{{ $designation->designation }}" type="text"
                            placeholder="{{ trans('core.designation') }}" />
                        <input type="hidden" name="designationID[{{ $index }}]" value="{{ $designation->id }}">
                    </div>
                </div>
            @endforeach
            <div id="insertBefore_edit"></div>
            <button type="button" onclick="addMoreEdit();" class="btn btn-primary form-control-inline">
                {{ trans('core.addMoreDesignation') }} <i class="fa fa-plus"></i>
            </button><br><br>
            <p class="note note-warning margin-top-15">
                <strong>{!! trans('core.note') !!}</strong> {!! __('messages.deleteNoteDesignation') !!}
            </p>
        </div>
        <!-- END FORM-->
    </div>
    <div class="modal-footer">
        <div class="form-actions">
            <button type="button" class="btn btn-outline-dark"
                data-dismiss="modal">{{ trans('core.btnCancel') }}</button>
            <button type="button" id="edit_submit" onclick="updateSubmit({{ $department->id }});return false;"
                class="btn btn-primary"> {{ trans('core.btnUpdate') }}</button>
        </div>

    </div>
    {!! Form::close() !!}
</div>
