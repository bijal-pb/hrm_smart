<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
        <div class="d-block position-absolute pos-top pos-left p-2 ">
            <h4 class="modal-title"><strong><i class="lal la-plus"></i> Add Employee</strong></h4>
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
                            <label class="col-md-4 form-label">select employee
                            </label>

                            <div class="col-md-12">
                                <select class="select2 form-control w-100" name="employee_id">
                                    <option value="">select employee</option>
                                    @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->full_name }}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 form-label">Select Date
                            </label>


                            <div class="col-md-12">
                                <input type="text" class="form-control" id="datepicker-1" name="start_date" placeholder="Select date">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 form-label">Select Start Time
                            </label>

                            <div class="col-md-12">
                                <div class='input-group date'>
                                    <input type='text' class="form-control" id="timepicker" name="start_time"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 form-label">Selelct End Time
                            </label>

                            <div class="col-md-12">
                            <div class='input-group date'>
                                <input type='text' class="form-control" id="timepicker-2" name="end_time"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- END FORM-->
                </div>
            </div>

            <div class="form-group my-4 text-center">
                <button type="button" id="submitbutton_add" class="btn btn-primary" onclick="addSubmit();return false;"><i class="fal fa-check"></i>
                    {{ trans('core.btnSubmit') }}</button>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>