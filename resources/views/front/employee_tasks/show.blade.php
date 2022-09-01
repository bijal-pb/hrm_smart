<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <div class="d-block position-absolute pos-top pos-left p-2 ">
        <h4 class="modal-title"><strong>Description</strong></h4>
    </div>
</div>
<div class="modal-body" id="show_task">
    <div class="frame-wrap">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tbody>
                   {!! $employee_task->description !!}
            </tbody>
        </table>
    </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-dark">{{ trans('core.btnClose') }}</button>
</div>
