<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
        <div class="d-block position-absolute pos-top pos-left p-3 ">
            <h4 class="modal-title"><strong> <i class="fal fa-phone-laptop"></i> {{ $pageTitle }}</strong></h4>
        </div>
    </div>
    <div class="modal-body">
        <div class="panel-body form">
            {!! Form::open(['class' => 'form-horizontal ajax_form', 'method' => 'POST', 'id' => 'add_form']) !!}
            <!-- {!! Form::open(['class' => 'horizontal-form ajax_form', '', 'id' => 'add_form']) !!} -->
            <div class="form-body">

                <div class="form-group">
                    <label class="col-md-4 form-label">{{ trans('core.position') }} : <span class="required">
                            * </span>
                    </label>

                    <div class="col-md-12">
                        <input type="text" class="form-control" id="position" name="position" placeholder="{{ trans('core.position') }} ">
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 form-label">{{ trans('core.description') }} : <span class="required">
                            * </span>
                    </label>

                    <div class="col-md-12">
                        <textarea class="form-control" id="description" name="description"></textarea>
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4">{{ trans('core.postedDate') }} :</label>

                    <div class="col-md-12">
                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fal fa-calendar"></i>
                                </button>
                            </span>
                            <input type="text" class="form-control" name="posted_date" id="posted_date" readonly value="{{ date('d-m-Y') }}">

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4">{{ trans('core.lastDateToApply') }} :</label>
                    <div class="col-md-12">
                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fal fa-calendar"></i>
                                </button>
                            </span>
                            <input type="text" class="form-control" name="last_date" id="last_date" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4">{{ trans('core.closeDate') }} :</label>
                    <div class="col-md-12">
                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fal fa-calendar"></i>
                                </button>
                            </span>
                            <input type="text" class="form-control" name="close_date" id="close_date" readonly>
                        </div>
                    </div>
                </div>
                <!-- END FORM-->

            </div>

            <br>
            <div class="form-group text-center">
                <button type="button" id="jobCreate" class="btn btn-primary" onclick="ajaxCreateJob()">
                    {{ trans('core.btnSubmit') }} </button>
            </div>


            {!! Form::close() !!}

        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
<script>
    $('.date-picker').datepicker({
            dateFormat: 'dd-mm-yyyy'
        });
        
</script>