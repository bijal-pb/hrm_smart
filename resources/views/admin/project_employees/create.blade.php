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
                <button type="button" id="submitbutton_add" class="btn btn-primary" onclick="addSubmit();return false;">
                    {{ trans('core.btnSubmit') }}</button>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
<style>
    .bootstrap-timepicker-widget.dropdown-menu.open {
    display: inline-block;
    z-index: 99999 !important;
}
</style>
<script>
    $(document).ready(function(){
        var date = new Date();
        $('#datepicker-1').daterangepicker(
        {
            opens: 'left',
            minDate: date,
        }, function(start, end, label)
        {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
        $('#timepicker').timepicker({
            // format: 'LT',
            showMeridian: false,
            timeFormat: 'H:i:m',
            template: 'modal',
            showInputs: false
        });

        $('#timepicker-2').timepicker({
            // format: 'LT',
            showMeridian: false,
            timeFormat: 'H:i:m',
            template: 'modal',
            showInputs: false,
        });
    })
</script>

@section('page_js')

{!! HTML::script('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js')  !!}

<script type="text/javascript">
    

    // $(function() {
    //     $('#timepicker').timepicker({
    //         // format: 'LT',
    //         showMeridian: false,
    //         timeFormat: 'H:i:m'
    //     });
    // });


    $(document).ready(function() {
        var date = new Date();
        $('#datepicker-1').daterangepicker({
            opens: 'left',
            minDate: date,
        }, function(start_date, end_date, label) {
            console.log("A new date selection was made: " + start_date.format('YYYY-MM-DD') + ' to ' + end_date.format(
                'YYYY-MM-DD'));
        });
    });

    // function ajaxCreateProjectEmployee() {
    //     $.easyAjax({
    //         url: "{!! route('admin.project_employees.store') !!}",
    //         type: "POST",
    //         data: $(".ajax_form").serialize(),
    //         container: ".ajax_form",
    //     });
    //     // window.location.reload();
    // }

    var i = 0;

    $("#add").click(function() {

        ++i;

        $("#dynamicTable").append('<tr><td><select class="select2 form-control w-100" name="addmore[' + i + '][employee_id]" id="employee_id"><option value="">select employee</option>@foreach ($employees as $employee)<option value="{{ $employee->id }}">{{ $employee->full_name }}</option>@endforeach</select></td><td><input type="text" class="form-control datepicker-1" name="addmore[' + i + '][start_date]" value="" placeholder="Select date"/></td><td><input type="text" name="addmore[' + i + '][start_time]" id="start_time" class="form-control timepicker"/><td> <input type="text" name="addmore[' + i + '][end_time]" id="end_time" class="form-control timepicker"/><td><button type="button" class="btn btn-danger remove-tr"><i class="fal fa-times"></i></button></td></tr>');

        $('#dynamicTable').find(".timepicker").timepicker({
            formatTime: "H:i:m",
            showMeridian: false,
            showInputs: false

        });
        var date = new Date();
        $('#dynamicTable').find(".datepicker-1").daterangepicker({
            minDate: date,
        });
    });

    $(document).on('click', '.remove-tr', function() {
        $(this).parents('tr').remove();
    });
</script>
@stop