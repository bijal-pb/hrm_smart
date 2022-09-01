<div class="modal-content">
    <div class="modal-header">
        <div class="d-block position-absolute pos-top pos-left p-2 ">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title"><strong>New Salary</strong></h4>
        </div>
    </div>
    <div class="modal-body">
        <div class="portlet-body form">

            <!-------------- BEGIN FORM------------>
            {!! Form::open(['route' => 'admin.salary.store', 'class' => 'form-horizontal ajax_form ', 'id' => 'save_salary', 'method' => 'POST']) !!}
            <input type="hidden" name="employee_id" value="{{ $employee_id }}" />

            <div class="form-body">

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <input class="form-control form-control-inline" name="type" type="text" value=""
                            placeholder="Type" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <input class="form-control form-control-inline" type="text" name="salary"
                            placeholder="Salary" />
                        <input type="hidden" name="remarks" value="Added Salary" />
                    </div>
                </div>
            </div>
            <br>
            <div class="form-actions">
                <div class="form-group text-center">
                    <button type="button" onclick="saveSalary({{ $employee_id }});return false;"
                        class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>

                </div>
            </div>
            {!! Form::close() !!}
            <!-- -----------END FORM-------->
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
