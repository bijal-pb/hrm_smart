<div class="modal-header">
    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
    <div class="d-block position-absolute pos-top pos-left p-2 ">
        <h4 id="myLargeModalLabel" class="modal-title">
            {{ __('menu.applyLeave') }}
        </h4>
    </div>
</div>
<div class="modal-body">
    <div class="portlet-body form">

        <div class="tab-v1 margin-bottom-40">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item"><a href="#button-1" class="nav-link active" data-toggle="pill">
                        {{ __('core.singleDateLeave') }}</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <li class="nav-item"><a href="#button-2" class="nav-link" data-toggle="pill">
                        {{ __('core.multipleDateleave') }}</a></li>
            </ul><br>
            <div class="tab-content py-2">
                <div class="tab-pane fade show active" id="button-1" role="tabpanel">
                    <div class="clearfix margin-bottom-10"></div>
                    {{-- <div id="alert"></div> --}}
                    <!------------------------------ BEGIN FORM ----------------------------------------->
                    {!! Form::open(array('class'=>'sky-form','id'=>'single_leaves_form','method'=>'POST')) !!}
                    <input type="hidden" name="days_single" id="days_single" value="1">
                    <input type="hidden" name="leaveformType" id="leaveformType" value="single_leaves">
                    {{-- <table class="table table-bordered" id="dynamicTable">
                        <tr>
                            <th>Select Date</th>
                            <th>Leave Type</th>
                            <th>Half Day</th>
                            <th>Reason</th>
                            <th>Action</th>
                        </tr>
                        <td>  <label class="input">
                            <i class="icon-append fa fa-calendar"></i>
                            <input type="text" class="form-control " readonly placeholder="Select date"
                            name="date[0]" id="leave" data-date-format="dd/mm/yyyy">
                        </label>

                        </td>
                        <td>
                              <div>
                            {!!  Form::select('leaveType[0]', $leaveTypes,null,['class' => ' form-control leaveType margin-bottom-10','id'=>'leaveType[0]','onchange'=>'halfDayToggle(0,this.value)'] )  !!}
                        </div>

                        </td>
                        <td>
                            {!!  Form::checkbox('halfleaveType[0]', 'yes',null,['class' => 'custom-control custom-checkbox'] )  !!}
                        </td>
                        <td>
                            <textarea class="form-control"   name="reason[0]"></textarea>
                           
                        </td>
                        <td><button type="button" name="add" id="add" class="btn btn-success btn-sm waves-effect waves-themed"><i class="fal fa-plus"></i></button></td>
                        </tr>
                    </table> --}}

                    <div class="row">
                        <div class="col-md-3 form-group">
                            <div>
                                <label class="input">
                                    <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" class="form-control " readonly placeholder="Select date"
                                    name="date[0]" id="leave" data-date-format="dd/mm/yyyy">
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 form-group">
                            <div>
                                {!!  Form::select('leaveType[0]', $leaveTypes,null,['class' => ' form-control leaveType margin-bottom-10','id'=>'leaveType[0]','onchange'=>'halfDayToggle(0,this.value)'] )  !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            {!!  Form::checkbox('halfleaveType[0]', 'yes',null,['class' => 'form-control margin-bottom-10 margin-bottom-10'] )  !!}
                            Half Day
                        </div>
                        <div class="col-md-5 form-group">
                            <label for="inputPassword1"
                                   class="col-lg-2 control-label">{{trans('core.reason')}}</label>
                            <div class="col-lg-10">
                                <textarea class="form-control"   name="reason[0]"></textarea>
                            </div>
                        </div>
    
                        {{-- <div class="col-md-5">
                            <input class="form-control form-control-inline margin-bottom-10" type="text"
                                   name="reason[0]" placeholder="{{trans('core.reason')}}"/>
                        </div> --}}
                    </div><br>
                   <br><div id="insertBefore"></div>

                    <button type="button" id="plusButton" class="btn btn-primary margin-bottom-10">
                        {{trans('core.addMore')}} <i class="fa fa-plus"></i>
                    </button><br>
                    <br><div class="row">
                        <div class="col-md-offset-4 col-md-8">
                            <button type="submit" class="btn btn-primary"
                                    onclick="submitLeaves('single_leaves');return false;"><i
                                        class="fa fa-check"></i> {{trans('core.btnSubmit')}}</button>

                        </div>

                    </div>
                {!!  Form::close()  !!}
                    <!------------------------ END FORM ------------------------------------------>

                </div>
                <div class="tab-pane fade" id="button-2" role="tabpanel">
                    <div class="clearfix margin-bottom-10"></div>

                    <div id="error_date_range"></div>
                    <!------------------------------ Mutiple BEGIN FORM ----------------------------------------->
                    {!! Form::open(array('class'=>'form-horizontal sky-form','id'=>'date_range_form','method'=>'POST')) !!}

                    <input type="hidden" name="days" id="days" value="0">
                    <input type="hidden" name="leaveformType" id="leaveformType" value="date_range">


                    <label for="inputEmail1"
                               class="col-lg-2 control-label">{{trans('core.dateRange')}}</label>
                    <div class="row">
                        <div class="col-lg-4 form-group">
                            <div class="">
                                <label class="input">
                                    <i class="icon-append fa fa-calendar"></i>
                                    <input class="form-control" type="text" name="start_date" id="start_date"
                                           placeholder="{{trans('core.startDate')}}" data-date-format="dd/mm/yyyy">
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4 form-group">
                            <div class="">
                                <label class="input">
                                    <i class="icon-append fa fa-calendar"></i>
                                    <input class="form-control" type="text" name="end_date" id="end_date"
                                           placeholder="{{trans('core.endDate')}}" data-date-format="dd/mm/yyyy">
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="inputEmail1"
                               class="col-lg-2 control-label">{{trans('core.selectedDays')}} </label>
                        <div class="col-lg-2" style="margin-top: 6px;">
                            <span id="daysSelected" class="badge badge-danger">0</span>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1"
                               class="col-lg-2 control-label">{{trans('core.leaveTypes')}}</label>
                        <div class="col-lg-6">
                            {!!  Form::select('leaveType', $leaveTypes,null,['class' => 'form-control','id'=>'date_range_leaveType'] )  !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword1"
                               class="col-lg-2 control-label">{{trans('core.reason')}}</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" name="reason"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-primary" id="submitbutton_date_range"
                                    onclick="submitLeaves('date_range');return false;">{{trans('core.btnSubmit')}}</button>
                        </div>
                    </div>
                {!! Form::close() !!}

                    <!------------------------ END FORM ------------------------------------------>
                </div>
            </div>
        </div>


    </div>
    <div class="alert alert-info">
        <strong>{{ trans('messages.note') }}!</strong> {{ trans('messages.dateRangeNote') }}
    </div>
</div>
<script>
    $(document).ready(function() {
        "use strict";
        $('.contentHolder').perfectScrollbar();

        $('#start_date').datepicker({
                dateFormat: 'dd/mm/yy',
                prevText: '<i class="fa fa-angle-left"></i>',
                nextText: '<i class="fa fa-angle-right"></i>',
                startDate: new Date(),
            })
            .on('changeDate', function(e) {
                var diff = ($("#end_date").datepicker("getDate") -
                        $("#start_date").datepicker("getDate")) /
                    1000 / 60 / 60 / 24 + 1; // days
                if ($("#end_date").datepicker("getDate") != null) {
                    $('#daysSelected').html(diff);
                    $('#days').val(diff);
                }
                $('#end_date').datepicker('setStartDate', e.date);
            });
        $('#end_date').datepicker({
                dateFormat: 'dd/mm/yy',
                prevText: '<i class="fa fa-angle-left"></i>',
                nextText: '<i class="fa fa-angle-right"></i>',
            })
            .on('changeDate', function(e) {
                $('#start_date').datepicker('option', 'maxDate', e.date);
                var diff = ($("#end_date").datepicker("getDate") -
                        $("#start_date").datepicker("getDate")) /
                    1000 / 60 / 60 / 24 + 1; // days
                if ($("#start_date").datepicker("getDate") != null) {
                    $('#daysSelected').html(diff);
                    $('#days').val(diff);
                }
            });

    });

    $('input[type=checkbox]').uniform();
    $('#leave').datepicker({
        prevText: '<i class="fal fa-angle-left"></i>',
        nextText: '<i class="fal fa-angle-right"></i>',
        dateFormat: 'dd/mm/yy',
        startDate: new Date()

    });
    // $('.halfLeaveType').hide();
    // var $insertBefore = $('#insertBefore');
    // var $i = 0;
    // var i = 0;
    // $(document).on('click', '.btn-success', function() {

    //             ++i;
    //             $(this).parent().find('.btn-success').removeClass('btn-success').addClass('btn-danger');
    //             $('.btn-danger').find('i').removeClass('fal fa-plus').addClass('fal fa-minus');

    //                 $("#dynamicTable").append('<tr><td><label class="input"> <i class="icon-append fa fa-calendar"></i><input type="text" class="margin-bottom-10 form-control datepicker-1" name="date[' +
    //                     $i + ']" id="leave' + $i +
    //                     '" readonly placeholder="Leave Date" data-date-format="dd/mm/yyyy"></label></td><td>{!! Form::select("leaveType[]", $leaveTypes, null, ["class" => "form-control margin-bottom-10 margin-bottom-10 leaveType", "id" => "leaveType", "onchange" => "halfDayToggle(0,this.value)"]) !!}</td><td>{!! Form::checkbox("halfleaveType[]", "yes", null, ["class" => "custom-control custom-checkbox", "id" => "halfLeaveType"]) !!} <td><textarea class="form-control"    name="reason[' + $i + ']"></textarea><td><button type="button" class="btn btn-success btn-sm waves-effect waves-themed" id="add" name="add"><i class="fal fa-plus"></i></button></td></tr>');

                
                  
    //                 $('#dynamicTable').find(".datepicker-1").datepicker({
    //                     startDate: new Date(),
    //                 });
    //                 $(document).on('click', '.btn-danger', function() {
    //                     $(this).parents('tr').remove();
    //                 });

    //             });
    $('.halfLeaveType').hide();
    var $insertBefore = $('#insertBefore');
    var $i = 0;
    $('#plusButton').click(function() {

        $i = $i + 1;

        $(' <div class="row" id="row' + $i + '"> ' +
            '<div class="col-md-3 form-group"><div><label class="input"><i class="icon-append fa fa-calendar"></i><input type="text" class="margin-bottom-10 form-control" name="date[' +
            $i + ']" id="leave' + $i +
            '" readonly placeholder="Select Date" data-date-format="dd/mm/yyyy"></label></div></div>' +
            '<div class="col-md-2">{!! Form::select('leaveType[]', $leaveTypes, null, ['class' => 'form-control margin-bottom-10 leaveType', 'id' => 'leaveType', 'onchange' => 'halfDayToggle(0,this.value)']) !!}</div>' +
            '<div class="col-md-2">{!! Form::checkbox('halfleaveType[]', 'yes', null, ['class' => 'form-control margin-bottom-10', 'id' => 'halfLeaveType']) !!} Half Day</div>' +
            '<div class="col-md-5 form-group">' + 
            '<div class="col-lg-10">' + '<textarea class="form-control" placeholder="Reason" name="reason[' + $i + ']"></textarea></div></div><button class="ml-3 mb-4 mt-10 btn btn-sm btn-danger btn_remove" type="button" name="remove" id="'+$i+'">X</button><br><br>').insertBefore($insertBefore);

        $("#row" + $i + " .leaveType").attr('id', 'leaveType' + $i);
        $("#row" + $i + " .halfLeaveType").hide();
        $("#row" + $i + " .halfLeaveType").attr('id', 'halfLeaveType' + $i);
        $("#row" + $i + " .leaveType").attr('onchange', 'halfDayToggle(' + $i + ',this.value)');
        $('input[type=checkbox]').uniform();
        $('#leave' + $i).datepicker({
            prevText: '<i class="fal fa-angle-left"></i>',
            nextText: '<i class="fal fa-angle-right"></i>',
            dateFormat: 'mm/dd/yy',
            startDate: new Date(),
        });
    });

    $(document).on('click', '.btn_remove', function(){    
           var button_id = $(this).attr("id");     
           $('#row'+button_id+'').remove();    
      });    

    function halfDayToggle(id, value) {
        if (value == 'half day') {
            $('#halfLeaveType' + id).show(100);
        } else {
            $('#halfLeaveType' + id).hide(100);
        }
    }

    function submitLeaves(type) {

        var container = $('#' + type + '_form');
        console.log(container, 'submit leave');
        $.easyAjax({
            type: 'POST',
            url: '{{ route('leaves.store') }}',
            data: container.serialize(),
            container: container,
            success: function(response) {
                if (response.status === "success") {
                    $('#applyLeave').modal('hide');
                    window.location.reload();
                }
            },
            error : function(e)
            {
                toastr['error'](response.message);
            }
        });
    }
</script>
