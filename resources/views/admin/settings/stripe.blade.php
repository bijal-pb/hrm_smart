@extends('admin.adminlayouts.adminlayout')

@section('content')

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
                {{$pageTitle}}
            </h1></div>
    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div id="load">

                {{--INLCUDE ERROR MESSAGE BOX--}}

                {{--END ERROR MESSAGE BOX--}}


            </div>
            <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    <i class="fal fa-cog"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Payment Settings<span class="fw-300"><i></i></span>
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                        data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10"
                        data-original-title="Fullscreen"></button>
                    {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                </div>
            </div>

            <div class="panel-container show">
                <div class="panel-content">

                    <h3>Add stripe details</h3>
                    <hr>
                    <!------------------------ BEGIN FORM---------------------->
                    {!!  Form::model($setting, ['method' => 'PUT','class'=>'form-horizontal', 'id' => 'stripeSettings'])  !!}
                    <input type="hidden" name="type" value="stripeSetting">
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-md-2 control-label">{{ trans('core.stripeKey') }}: <span class="required">
                                        * {!! help_text("stripeKey") !!} </span>(<a
                                        href="https://dashboard.stripe.com/account/apikeys" target="_blank">Generate</a>)
                            </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="stripe_key" placeholder="Stripe Key"
                                       value="{{ $setting->stripe_key }}">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.stripeSecret')}}:
                                <span class="required">
                                        * {!! help_text("stripeSecretKey") !!} </span>(<a
                                        href="https://dashboard.stripe.com/account/apikeys" target="_blank">Generate</a>)
                            </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="stripe_secret"
                                       value="{{ $setting->stripe_secret }}" placeholder="Stripe Secret">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.stripeWebhookSecret')}}: <span
                                        class="required">
                                        * {!! help_text("stripeWebhookKey") !!} </span>


                            </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control margin-bottom-15" name="stripe_webhook_secret"
                                       value="{{ $setting->stripe_webhook_secret}}" placeholder="Stripe webhook secret">
                                <ul>
                                <li class="bmd-help"> Visit <a
                                            href="https://dashboard.stripe.com/account/webhooks"
                                            target="_blank">Generate</a> Add end point as <b> {{ route('admin.stripe.save_webhook')}}</b> and enter the webhook key generated</li>
                                    <li> Select event <b>invoice.payment_failed</b> and <b>invoice.payment_succeeded</b> while creating webhook.</li>
                                </ul>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">@lang('core.stripeStatus') {!! help_text("stripeStatus") !!} : </label>
                            <div class="btn-group col-md-12">
                                <span id="load_notification"></span>
                                <input type="checkbox"
                                       class="make-switch" name="stripe_status"
                                       @if($setting->stripe_status == 1)checked
                                       @endif data-on-color="success" data-on-text="{{ trans('core.btnYes')}}"
                                       data-off-text="{{ trans('core.btnNo')}}" data-off-color="danger" value="on"/>
                            </div>
                        </div>
                        <!------------------------- END FORM ----------------------->

                        <h3>Add paypal details</h3>
                        <hr>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{ trans('core.paypalClientId') }}: <span class="required">
                                        * {!! help_text("paypalKey") !!} </span>
                            </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="paypal_client_id" placeholder="Paypal Key"
                                       value="{{ $setting->paypal_client_id }}">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.paypalSecretKey')}}:
                                <span class="required">
                                        * {!! help_text("paypalSecretKey") !!} </span>
                            </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="paypal_secret"
                                       value="{{ $setting->paypal_secret }}" placeholder="Paypal Secret">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.selectEnvironment')}}:
                                <span class="required">
                                        * {!! help_text("selectEnvironment") !!} </span>
                            </label>
                            <div class="col-md-12">
                                <select class="form-control" name="paypal_mode" id="paypal_mode">
                                    <option value="sandbox" @if($setting->paypal_mode == 'sandbox') selected @endif>Sandbox</option>
                                    <option value="live" @if($setting->paypal_mode == 'live') selected @endif>Live</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.webhookUrl')}}:</label>
                            <div class="col-md-12">
                                <span class="help-block">{{ route('verify-billing-ipn') }}</span>
                                <span
                                    class="required">Add this webhook url on your paypal app settings.</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">@lang('core.paypalStatus') {!! help_text("paypalStatus") !!} : </label>
                            <div class="btn-group col-md-12">
                                <span id="load_notification"></span>
                                <input type="checkbox"
                                       class="make-switch" name="paypal_status"
                                       @if($setting->paypal_status == 1)checked
                                       @endif data-on-color="success" data-on-text="{{ trans('core.btnYes')}}"
                                       data-off-text="{{ trans('core.btnNo')}}" data-off-color="danger" value="on"/>
                            </div>
                        </div>

                    </div>
                    <div class="form-actions">
                    <p class="text-center">
                                <button type="submit" onclick="stripeSetting();return false;"

                                        class="btn btn-primary">{{trans('core.btnUpdate')}}</button>

                     
                        </p>
                    </div>
                    {!! Form::close()  !!}
                </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
@stop

@section('page_js')
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
    <script>
        function stripeSetting() {
            var url = "{{ route('admin.settings.update', $setting->id) }}";
            $.ajax({
                type: 'POST',
                url: url,
                container: '#stripeSettings',
                data: $('#stripeSettings').serialize(),
                success: function(response) {
                            if (response.status == "success") {
                                toastr['success']('Updated successfully!'); 
                            }
                            if(response.status == "error") {
                                toastr['error'](response.message);
                                $('#projectSubmit').html('Submit').attr('disabled', false);
                            }
                            
                        }
            });
        }
    </script>
    <!-- END PAGE LEVEL PLUGINS -->
@stop
