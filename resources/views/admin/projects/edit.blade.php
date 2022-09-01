<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
        <div class="d-block position-absolute pos-top pos-left p-2 ">
            <h4 class="modal-title"><strong>
                    <i class="la la-edit"></i>Project Edit</strong></h4>
        </div>
    </div>
    <div class="modal-body">
        <div class="panel-body form">

            <!-- BEGIN FORM-->

            {!! Form::open(['method' => 'PATCH', 'url' => '', 'class' => 'horizontal-form ajax_form', 'id' => 'edit_form']) !!}

            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-12">Name<span class="required">
                            * </span>
                    </label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="edit_name" name="name" value="{{ $project->name }}" placeholder="name">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-12">Selected date:</label>
                    <div class="col-md-12">
                        <div class="input-group input-medium date date-picker" data-date-viewmode="years">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fal fa-calendar"></i>
                                </button>
                            </span>
                            <input type="text" id="datepicker-1" class="form-control datepicker-1" name="start" value="{{ $project->start }} - {{ $project->end }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-12">Estimated Hour<span class="required">
                            * </span>
                    </label>

                    <div class="col-md-12">
                        <input type="text" class="form-control" id="estimated_hour" name="estimated_hour" value="{{ $project->estimated_hour }}" placeholder="estimated hour">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-12">Status: <span class="required">
                            * </span>
                    </label>

                    <div class="col-md-12">
                        <select name="status" id="edit_status" class="form-control">
                            <option value="not start" {{ $project->status == 'not start' ? 'selected' : '' }}>
                                Not started </option>
                            <option value="in progress" {{ $project->status == 'in progress' ? 'selected' : '' }}>In progress</option>
                            <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>
                                Completed</option>
                            <option value="hold" {{ $project->status == 'hold' ? 'selected' : '' }}>Hold</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-12">{{ trans('core.description') }}: <span class="required">
                            * </span>
                    </label>

                    <div class="col-md-12">
                        <textarea class="form-control" id="edit_description" name="description" rows="3">{{ $project->description }}</textarea>
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>


            <br>

            <div class="form-group text-center">
                <button type="button" id="updateProject" class=" btn btn-primary" onclick="projectUpdate({{$project->id}})"><i class="fal fa-check"></i> {{trans('core.btnUpdate')}}</button>
            </div>

            {!! Form::close() !!}
            <!-- END FORM-->
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>