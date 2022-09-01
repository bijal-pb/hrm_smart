@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    <!-- {!! HTML::style("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css") !!}
    {!! HTML::style("assets/global/plugins/select2/css/select2.css")!!}
    {!! HTML::style("assets/global/plugins/select2/css/select2-bootstrap.min.css")!!}
    {!! HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css") !!} -->

    <!-- BEGIN THEME STYLES -->
@stop


@section('content')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
                Add New Company
            </h1></div>
    </div>
    <!-- <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{ route('admin.dashboard.index') }}')">{{ trans('core.home') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a onclick="loadView('{{ route('admin.companies.index') }}')">Companies</a>
                <i class="fa fa-circle"></i>
            </li>

            <li>
                <span class="active">Add New Company</span>
            </li>
        </ul>

    </div> -->
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
                        <i class="fa fa-th-large"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @lang("core.generalSettings")
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                            data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                            data-offset="0,10" data-original-title="Fullscreen"></button>
                        {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                    </div>
                </div>
              
                <div class="panel-container show">
                    <div class="panel-content">

                    <!------------------------ BEGIN FORM---------------------->
                    {!!  Form::open(['method' => 'POST','files' => true,'class'=>'form-horizontal ajax_form'])  !!}

                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-2">{{trans('core.companyLogo')}}</label>
                            <div class="col-md-6">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">

                                        {!! HTML::image($setting->logo_image_url) !!}

                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px;">
                                    </div>
                                    <div>
                                                       <span class="btn btn-primary btn-file">
                                                       <span class="fileinput-new">
                                                       {{trans('core.changeImage')}} </span>
                                                       <span class="fileinput-exists">
                                                       {{trans('core.change')}} </span>
                                                       <input type="file" name="logo">
                                                       </span>
                                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                            {{trans('core.remove')}} </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
                                                        <span class="label label-danger">
                                                        NOTE!</span> Image Size must be height 40px

                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.companyName')}}: <span class="required">
                                        * </span>
                            </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="company_name" placeholder="Website Title"
                                       value="{{old('company_name')}}">
                            </div>
                        </div>
                        @if(module_enabled('Subdomain'))

                            <div class="form-group">
                                <label for="company_name" class="col-md-2 control-label">Sub Domain</label>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="subdomain"
                                               name="sub_domain" id="sub_domain">
                                        <span class="input-group-addon">.{{ get_domain() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.companyAddress')}}:
                            </label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="address"
                                          placeholder="Company Address">{{old('address')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Country</label>
                            <div class="col-md-12">
                                <select class="select2me form-control" data-show-subtext="true" name="country">
                                    @foreach($countrieslist as $country)
                                        <option value="{{$country->name}}">{{$country->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.phone')}}:
                            </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="contact"
                                       value="{{old('contact')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Name: <span class="required">  * </span></label>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="name" placeholder="Name"
                                       value="{{old('name')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.email')}}: <span class="required">
                                            * </span>
                            </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="email" value="{{old('email')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.password')}}: <span class="required">
                                            * </span>
                            </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="password">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-2">Currency</label>
                            <div class="col-md-12">
                                <select class="select2 form-control w-100" data-show-subtext="true" name="currency">
                                    @foreach($countries as $country)
                                        <option value="{{$country->currency_symbol ?? $country->currency_code}}:{{$country->currency_code}}">{{$country->currency_code}} {{$country->currency_symbol ?? $country->currency_code}} </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>


                        <!------------------------- END FORM ----------------------->

                    </div><br>
                    <div class="form-actions">
                        <p class="text-center">
                                <button type="button" onclick="companyCreate();return false;"

                                        class="btn btn-primary">{{trans('core.btnSubmit')}}</button>

                        </p>
                        
                    </div>
                    {!!  Form::close()  !!}
                </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>
        </div>
        <!-- END PAGE CONTENT-->


    @stop

    @section('page_js')

        <!-- BEGIN PAGE LEVEL PLUGINS -->
            <!-- {!! HTML::script("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js")  !!}
            {!! HTML::script('assets/global/plugins/bootstrap-select/bootstrap-select.min.js')  !!}

            {!! HTML::script('assets/global/plugins/select2/js/select2.min.js')  !!}
            {!! HTML::script('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js')  !!}
            {!! HTML::script('assets/admin/pages/scripts/components-dropdowns.js')  !!} -->



            <script>
                // jQuery(document).ready(function () {
                //     $.fn.select2.defaults.set("theme", "bootstrap");
                //     $('.select2').select2({
                //         placeholder: "Select",
                //         width: '100%',
                //         allowClear: false
                //     });
                //     ComponentsDropdowns.init();
                // });

                function companyCreate() {
                    var url = "{{ route('admin.companies.store') }}";
                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        container: '.ajax_form',
                        file: true,
                    });
                }
            </script>
            <!-- END PAGE LEVEL PLUGINS -->
@stop
