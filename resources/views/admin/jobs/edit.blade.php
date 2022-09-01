<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
        <div class="d-block position-absolute pos-top pos-left p-3 ">
            <h4 class="modal-title"><strong> <i class="fal fa-phone-laptop"></i> {{ $pageTitle }}</strong></h4>
        </div>
    </div>
    <div class="modal-body">
        <div class="panel-body show">
        {!! Form::open(['class'=>'form-horizontal ajax_form']) !!}
            <div class="form-body">

                <div class="form-group">
                    <label class="col-md-4 form-label">{{trans('core.position')}}: <span class="required">
                            * </span>
                    </label>

                    <div class="col-md-12">
                        <input type="text" class="form-control" id="typeahead_example_1" name="position" placeholder="{{trans('core.position')}}" value="{{ $job->position }}">
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 form-label">{{trans('core.description')}}: <span class="required">
                            * </span>
                    </label>

                    <div class="col-md-12">
                        <textarea class="form-control" id="description" name="description">{{ $job->description }}</textarea>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label mx-3" for="example-date">{{ trans('core.postedDate') }}:</label>
                    <div class="col-md-12">
                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fal fa-calendar"></i>
                                </button>
                            </span>
                            <input type="text" class="form-control" name="posted_date" id="posted_date" data-date-format="dd-mm-yyyy" data-date-viewmode="years" readonly     value="{{ $job->posted_date }}">

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label mx-3" for="example-date">{{trans('core.lastDateToApply')}}:</label>
                    <div class="col-md-12">
                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fal fa-calendar"></i>
                                </button>
                            </span>
                            <input type="text" class="form-control" name="last_date" id="last_date" data-date-format="dd-mm-yyyy" data-date-viewmode="years" readonly value="{{ $job->last_date }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label mx-3" for="example-date">{{ trans('core.closeDate') }}:</label>
                    <div class="col-md-12">
                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fal fa-calendar"></i>
                                </button>
                            </span>
                            <input type="text" class="form-control" name="close_date" data-date-format="dd-mm-yyyy" data-date-viewmode="years" id="close_date" readonly value="{{ $job->close_date }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 form-label">{{trans('core.status')}}</label>

                    <div class="col-md-12">

                        <label class="radio-inline">
                            <input type="radio" name="status" value="active" @if($job->status=='active') checked="checked" @endif>@lang("core.active")
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="radio-inline">
                            <input type="radio" name="status" value="inactive" @if($job->status=='inactive') checked="checked" @endif>@lang("core.inactive")
                        </label>


                    </div>
                </div>


                <!-- END FORM-->

            </div>
            <br>
            <div class="form-group text-center">

                <button class="btn btn-primary" onclick="ajaxUpdateJob({{$job->id}});return false;">
                    <i class="fal fa-edit"></i> {{trans('core.btnSubmit')}} </button>

            </div>

            {!! Form::close() !!}

        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
    <script>
        $('.date-picker').datepicker({
            dateFormat: 'dd-mm-yyyy'
        });

    </script>