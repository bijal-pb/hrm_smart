@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css") !!}
    {!! HTML::style("assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css") !!}
    {!! HTML::style("assets/global/plugins/select2/css/select2.css") !!}
    {!! HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css") !!}
    {!! HTML::style("assets/global/plugins/icheck/skins/all.css") !!}

    <!-- BEGIN THEME STYLES -->
@stop


@section('content')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
                @lang("core.themeSettings")
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <!-- <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">@lang("core.dashboard")</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">{{trans('core.settings')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">@lang("core.themeSettings")</span>
            </li> -->
        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <div id="load">

                {{--INLCUDE ERROR MESSAGE BOX--}}

                {{--END ERROR MESSAGE BOX--}}


            </div>
        </div>
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->


            <div id="panel-1" class="panel">
               <div class="panel-hdr">
                    <h2>
                        @lang("core.frontEndTheme")
                    </h2>
                    <div class="panel-toolbar">
                         <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                         <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                         {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                    </div>
                </div>

                <div class="panel-container show">
                  <div class="panel-content" >

                    <!------------------------ BEGIN FORM---------------------->
                    {!!  Form::open( ['class'=>'horizontal-form ajax-form'])  !!}


                    <div class="form-group" style="padding-top: 15px;">
                        <h2>Select Theme</h2>
                        <div class="row">
                            <div class="col-md-4">

                                <div class="icheck-list">
                                    <li>
                                    <label>
                                        <input type="radio" name="front_theme"
                                               @if($loggedAdmin->company->front_theme=='aqua') checked @endif class="icheck"
                                               value="aqua"> Aqua <span class="btn blue"></span></label>
                                   <li> <label><input type="radio" name="front_theme"
                                                  @if($loggedAdmin->company->front_theme=='dark-blue') checked
                                                  @endif class="icheck" value="dark-blue"> Dark-blue <span
                                                class="btn blue-steel"></span> </label>
                                   <li> <label><input type="radio" name="front_theme"
                                                  @if($loggedAdmin->company->front_theme=='default') checked
                                                  @endif class="icheck" value="default"> Default <span
                                                class="btn grey-cascade"></span> </label>
                                   <li> <label><input type="radio" name="front_theme"
                                                  @if($loggedAdmin->company->front_theme=='brown') checked
                                                  @endif class="icheck" value="brown"> Brown <span class="btn"
                                                                                                   style="background-color: saddlebrown;"></span></label>
                                    <li><label><input type="radio" name="front_theme"
                                                  @if($loggedAdmin->company->front_theme=='dark-red') checked
                                                  @endif class="icheck" value="dark-red"> Dark-red <span class="btn"
                                                                                                         style="background-color: darkred;"></span></label>
                                    <li><label><input type="radio" name="front_theme"
                                                  @if($loggedAdmin->company->front_theme=='light-green') checked
                                                  @endif class="icheck" value="light-green"> Light-green <span
                                                class="btn" style="background-color: lightgreen;"></span></label>
                                 
                                </div>

                            </div>
                            <div class="col-md-4">

                                <div class="icheck-list">
                                   <li> <label>
                                        <input type="radio" name="front_theme"
                                               @if($loggedAdmin->company->front_theme=='light') checked @endif class="icheck"
                                               value="light"> Light <span class="btn"
                                                                          style="background-color: #95a5a6"></span></label>
                                   <li> <label><input type="radio" name="front_theme"
                                                  @if($loggedAdmin->company->front_theme=='orange') checked
                                                  @endif class="icheck" value="orange"> Orange <span class="btn"
                                                                                                     style="background-color: orangered"></span>
                                    </label>
                                    <li><label><input type="radio" name="front_theme"
                                                  @if($loggedAdmin->company->front_theme=='purple') checked
                                                  @endif class="icheck" value="purple"> Purple <span class="btn"
                                                                                                     style="background-color: #800080;"></span>
                                    </label>

                                    <li><label><input type="radio" name="front_theme"
                                                  @if($loggedAdmin->company->front_theme=='red') checked @endif class="icheck"
                                                  value="red"> Red <span class="btn"
                                                                         style="background-color: red;"></span></label>
                                    <li><label><input type="radio" name="front_theme"
                                                  @if($loggedAdmin->company->front_theme=='teal') checked
                                                  @endif class="icheck" value="teal"> Teal <span class="btn"
                                                                                                 style="background-color: teal;"></span></label>

                                </div>

                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <p class="text-center">
                                <button type="button" onclick="updateSetting();return false;"
                                   class="btn-default"> <span class="fal fa-check mr-1"></span>
                                   Submit
                                </button>
                            </p>
                        </div>

                        <!------------------------- END FORM ----------------------->

                    </div>
                    {!!  Form::close()  !!}
                    <div id="front_image"
                         style="padding: 10px;text-align: center">{{ucfirst($loggedAdmin->company->front_theme)}}
                        {!! HTML::image("assets/theme_images/front/".$loggedAdmin->company->front_theme.".png",'Logo',array('class'=>'logo-default img-responsive','height'=>'300px')) !!}
                    </div>
                </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>

        </div>

    </div>

@stop

@section('page_js')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! HTML::script("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js")  !!}
    {!! HTML::script('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js')  !!}

    {!! HTML::script('assets/global/plugins/select2/js/select2.min.js')  !!}
    {!! HTML::script('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js')  !!}
    {!! HTML::script('assets/admin/pages/scripts/components-dropdowns.js')  !!}
    {!! HTML::script('assets/global/plugins/icheck/icheck.min.js')  !!}




    <script>
        jQuery(document).ready(function () {

            ComponentsDropdowns.init();

        });


        $('input[name=front_theme]').on('ifChecked', function (event) {
            $('#front_image').html('<span class="fa fa-refresh fa-spin"></span>');

            var image = this.value + ".png";
            var image_url = '{!! HTML::image("assets/theme_images/front/:image",'Logo',
            array('class'=>'logo-default img-responsive','height'=>'300px')) !!}';
            image_url = image_url.replace(':image', image);
            $('#front_image').html(capitalizeFirstLetter(this.value) + " " + image_url);

        });

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function updateSetting() {
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.company_setting.theme_update') }}",
                data: $(".ajax-form").serialize(),
                container: ".ajax-form",
                success: function (response) {
                    if (response.status == "success") {
                        $('#showModal').modal('hide');
                        $('#salaryData').append(response.viewData);
                        toastr['success']('Updated successfully!');
                        window.location.reload();
                    }
                }
            });
        }

    </script>
    <!-- END PAGE LEVEL PLUGINS -->
@stop
