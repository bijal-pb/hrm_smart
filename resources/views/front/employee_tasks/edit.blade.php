<style>
    .show {
        display: inline-block;
    }

    .hide {
        display: none;
    }
</style>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <div class="d-block position-absolute pos-top pos-left p-3 ">
        <h4 class="modal-title"><strong>Edit Task</strong></h4>
    </div>
</div>
<div class="modal-body" id="edit_task">
    <div class="frame-wrap">
        <div class="panel-container show">
            <div class="panel-content">
                <!-- BEGIN FORM-->
                {!! Form::open(['class'=>'form-horizontal ajax_form','method'=>'PATCH'])!!}
                {{-- <input type="hidden" name="project_id" class="form-control" id="project_id" value="{{ $project->id }}"> --}}

                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-12">Select Task Type: </label>
                                <div class="col-md-12 input-group" id="project-type1">
                                    <select id="type" name="type" class="form-control">
                                        <option value="1" {{ ($employee_tasks->type == 1) ? 'selected' : '' }}>Scope</option>
                                        <option value="2" {{ ($employee_tasks->type == 2) ? 'selected' : '' }}>Support</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-12 1 box1 scopeSelect {{ ($employee_tasks->type == 1) ? 'show' : 'hide' }}">
                            <div class="form-group">
                                <label class="control-label col-md-12">Project Name:</label>
                                <div class="col-md-12">
                                    <select class="select2 form-control w-100" name="project_scope" id="project_scope">
                                        @foreach ($projects as $project)
                                        <option value="{{ $project->project_id }}" {{($employee_tasks->project_id == $project->project_id) ? 'selected' : '' }}>
                                            {{ $project->project_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-12 2 box1 supportSelect {{ ($employee_tasks->type == 2) ? 'show' : 'hide' }}">
                            <div class="form-group">
                                <label class="control-label col-md-12">Project Name:</label>
                                <div class="col-md-12">
                                    <select class="select2 form-control w-100" name="project_support" id="project_support">
                                        <option value="">Select Project
                                        </option>
                                        @foreach ($all_projects as $all_project)
                                        <option value="{{ $all_project->id }}" {{($employee_tasks->project_id == $all_project->id) ? 'selected' : '' }}>
                                            {{ $all_project->project_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col col-md-12">
                            <div class="form-group">

                                <label class="control-label col-md-3">Date:</label>
                                <div class="col-md-12">
                                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy">
                                        <input class=" form-control w-100" type="text" id="date" name="date" value="{!! date('d-m-Y',strtotime($employee_tasks->date)) !!}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-3">Hour: </label>
                                <div class="col-md-12 input-group date">
                                    <input type='text' class="form-control timepicker1" name="hour" value="{{date('h:i',strtotime($employee_tasks->hour))}}" />
                                    <span class=" input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label">Title</label>
                                    <input class="form-control col-md-12" name="title" type="text" placeholder="title" value="{{$employee_tasks->title}}"></input>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label">{{ trans('core.description') }}:</label>
                                    <textarea class="form-control col-md-12" id="description" name="description">{{$employee_tasks->description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label">Status</label>
                                    <select id="type" name="status" class="form-control">
                                        <option value="inprogress" {{ ($employee_tasks->status == 'inprogress') ? 'selected' : '' }}>In Progress</option>
                                        <option value="completed" {{ ($employee_tasks->status == 'completed') ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <div class="form-group text-center my-4">
                <button type="button" data-loading-text=" {{trans('core.btnUpdating')}}..." class=" btn btn-primary" id="taskUpdate" onclick="ajaxUpdateTask({{$employee_tasks->id}})"><i class="fal fa-edit"></i> {{trans('core.btnUpdate')}} </button>
            </div>
        </div>
        {!! Form::close() !!}
        <!-- END FORM-->
    </div>
</div>