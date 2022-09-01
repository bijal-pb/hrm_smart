@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    <!-- {!! HTML::style("assets/global/plugins/select2/css/select2.css")!!}
    {!! HTML::style("assets/global/plugins/fullcalendar/fullcalendar.min.css")!!} -->
    <!-- BEGIN THEME STYLES -->

@stop

@section('content')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
                {{ trans('pages.superAdminDashboard.title') }}
            </h1></div>
    </div>
   
    <!-- END PAGE HEADER-->


    {!!   $setting->set_smtp_message !!}

    <!-- @if($setting->system_update == 1)
        @php($updateVersionInfo = \Froiden\Envato\Functions\EnvatoUpdate::updateVersionInfo())
        @if(isset($updateVersionInfo['lastVersion']))
            <div class="note note-info row">
                <div class="col-md-10"><i class="fa fa-gift"></i> @lang('core.newUpdate') <label
                            class="label label-success">{{ $updateVersionInfo['lastVersion'] }}</label></div>
                <div class="col-md-2">
                    <a href="javascript:;" onclick="loadView('{{route('admin.updateVersion.index')}}')"
                       class="btn btn-success btn-small">@lang('core.updateNow')
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        @endif
    @endif -->
    <div class="row">
    <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                <div class="p-3 bg-danger-300 rounded overflow-hidden position-relative text-white mb-g">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <div class="number count">
                        {{ $company_lists->count() }}
                        </div>
                        <small class="m-0 l-h-n">
                        {{ trans('core.totalCompany') }}
                        </small>
                    </h3>
                    <i class="fa fa-th-large position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                        style="font-size:6rem"></i>
                    <a href="{{ route('admin.companies.index') }}" style="color: white">
                        {{ trans('core.viewMore') }}
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                <div class="p-3 bg-info-300 rounded overflow-hidden position-relative text-white mb-g">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <div class="number count">
                        {{ $company_lists->count() }}  
                    </div>
                        <small class="m-0 l-h-n">
                        {{ trans('core.weeklyActiveCompany') }}
                        </small>
                    </h3>
                    <i class="fa fa-th-large position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                        style="font-size:6rem"></i>
                    <a href="{{ route('admin.companies.index') }}" style="color: white">
                        {{ trans('core.viewMore') }}
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                <div class="p-3 bg-success-300 rounded overflow-hidden position-relative text-white mb-g">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <div class="number count">
                        {{ $total_earning }}
                    </div>
                        <small class="m-0 l-h-n">
                        Total Income
                        </small>
                    </h3>
                    <i class="fal fa-rupee-sign position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                        style="font-size:6rem"></i>
                    <a href="{{ route('admin.invoices.index') }}" style="color: white">
                        {{ trans('core.viewMore') }}
                    </a>
                </div>
            </div>
    </div>


    <div class="row">
        <div class="col-md-6 col-sm-6">
                <div id="panel-2" class="panel">
                    <div class="panel-hdr">
                        <h2><i class="fa fa-th-large font-dark"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @lang("core.weeklyActiveCompany")
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Fullscreen"></button>
                            {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                        </div>
                    </div>
                <div class="panel-container show">
                        <div class="panel-content">
                    <div data-spy="scroll" data-target="#spyscroll-1" data-offset="0" class="overflow-auto"
                                style="height:250px">
                            @foreach($company_lists as $company_data)
                               
                                    <div class="col1">
                                        {!!  HTML::image($company_data->logo_image_url,'Logo',['class'=>'logo-default','height'=>'40px']) !!}
                                        <div class="cont-col2">
                                            <div class="desc"><a
                                                        onclick="loadView('{{route('admin.companies.edit', [$company_data->id])}}')">{{$company_data->company_name}}</a>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col2">
                                        <div class="date">{{$company_data->last_in_words}}</div>
                                    </div>
                               
                            @endforeach
                       
                    </div>
                    <div class="scroller-footer">
                        <div class="btn-arrow-link pull-right">
                            <a onclick="loadView('{{route('admin.companies.index')}}')">See All Records</a>
                            <i class="icon-arrow-right"></i>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-md-12 col-sm-12">
             <div id="panel-3" class="panel">
             <div class="panel-hdr">
                        <h2>{{ trans('core.companyRegister') }}</h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Fullscreen"></button>
                        </div>
                    </div>
            
                <div class="panel-container show">
                        <div class="panel-content">
                    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <div class="row">
        <div class="col-md-12 col-sm-12" id="earningReport">
        <div id="panel-3" class="panel">
        <div class="panel-hdr">
                        <h2>{{ $currency_symbol }}{{ trans('core.earningReport') }}</h2>
                      
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Fullscreen"></button>
                        </div>
                        
                    </div>
            
            
                <div class="panel-container show">
                        <div class="panel-content">
                        <div class="btn-group pull-right">
                        <span class="form-label"><strong>Filter By @lang('core.year'):</strong></span>
                        {!!  Form::select('employee_id', $earningYearFilter ,'all',['class' => 'form-control input-sm input-small input-inline ','id'=>'filterYear','data-placeholder'=> trans("core.selectAnEmployee").'...'])  !!}
                    </div>
                    <div id="earningChart" style="width: 100%; margin: 0 auto">
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </div> -->
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModal"
         aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel">Rating HRM-SAAS on Codecanyon</h4>
                </div>
                <div class="modal-body">
                    <div class="note note-info">
                        Thank you for your recent purchase and using our application
                        <hr>
                        We hope you love it. If you do, would you mind taking 10 seconds to leave me a short review an review on codecanyon?
                        <br>
                        This helps us to continue providing great products, and helps potential buyers to make confident decisions.
                        <hr>
                        Thank you in advance for your review and for being a preferred customer.

                        <hr>
{{--                        <a href="{{\Froiden\Envato\Functions\EnvatoUpdate::reviewUrl()}}"> https://codecanyon.net/downloads</a>  Select 5 stars beside the product you purchased--}}
{{--                        <hr>--}}
                        <a href="{{\Froiden\Envato\Functions\EnvatoUpdate::reviewUrl()}}"> <img src="https://envato.froid.works/review/review-hrm-saas.png" alt=""></a>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="hideReviewModal('closed_permanently_button_pressed')">Hide Pop up permanently</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="hideReviewModal('already_reviewed_button_pressed')">Already Reviewed</button>
                    <a href="{{\Froiden\Envato\Functions\EnvatoUpdate::reviewUrl()}}" target="_blank" type="button" class="btn btn-success">Give Review</a>
                </div>
            </div>
        </div>
    </div>
@stop


@section('page_js')

    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <!-- {!! HTML::script("assets/global/plugins/select2/js/select2.min.js")!!}
    {!! HTML::script("assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js")!!}
    {!! HTML::script("assets/pages/scripts/dashboard.min.js")!!}
    {!! HTML::script("assets/admin/pages/scripts/components-dropdowns.js")!!} -->
    <!-- {!! HTML::script("assets/global/plugins/moment.min.js")!!} -->
    <!-- {!! HTML::script("assets/global/plugins/fullcalendar/fullcalendar.min.js")!!}
    {!! HTML::script("assets/global/plugins/fullcalendar/lang-all.js")!!} -->
    <!-- {!! HTML::script("assets/global/plugins/highcharts/js/highcharts.js")!!}
    {!! HTML::script("assets/global/plugins/highcharts/js/modules/exporting.js")!!} -->





    <script>
        $('.count').each(function () {
            $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
            }, {
                duration: 2000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    </script>
    <script>
        $(function () {
            $('#container').highcharts({
                title: {
                    text: 'Companies Registered ({{ trans('core.'.$monthName) }})',
                    x: -20 //center
                },
                xAxis: {
                    categories: [
                        '{{ trans('core.'.$monthName) }}'
                    ]
                },
                yAxis: {
                    title: {
                        text: 'Companies'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: ''
                },
                legend: {
                    layout: 'vertical',
                    align: 'center',
                    verticalAlign: 'bottom',
                    borderWidth: 0
                },
                series: [{
                    name: 'No. of Companies',
                    data: {!! json_encode($graph_data)!!}
                }]
            });
        });
    </script>
    <!-- END PAGE LEVEL PLUGINS -->

    <script>
        $(document).ready(
            initChart([{!! $earning !!} ], new Date().getFullYear())
        );

        function initChart(earning, year) {

            $('#earningChart').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: '{{ trans('core.yearlyEarningReport') }} ' + year
                },
                xAxis: {
                    categories: [
                        '{{ trans('core.jan') }}',
                        '{{ trans('core.feb') }}',
                        '{{ trans('core.mar') }}',
                        '{{ trans('core.apr') }}',
                        '{{ trans('core.may') }}',
                        '{{ trans('core.june') }}',
                        '{{ trans('core.july') }}',
                        '{{ trans('core.aug') }}',
                        '{{ trans('core.sept') }}',
                        '{{ trans('core.oct') }}',
                        '{{ trans('core.nov') }}',
                        '{{ trans('core.dec') }}'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        useHTML: true,
                        text: '{{ trans('core.earning') }} ({{ $currency_symbol }})'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} {{ $currency_symbol }}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            formatter: function () {
                                return Highcharts.numberFormat(this.y, 2);
                            }
                        },
                    }

                },
                series: [{
                    name: '{{ $currency_symbol }} {{  trans('core.earning') }}',
                    data: earning

                }]
            });
        }

        $('#filterYear').select().on("select:select", function (e) {

            var year = $('#filterYear').val();
            var url = "{{ route('admin.earning.report',':year') }}";
            url = url.replace(':year', year);
            $.ajax({
                type: "get",
                url: url,
                dataType: 'json',
                data: {"year": $('#filterYear').val()},

                beforeSend: function () {
                    $("#earningChart").html('<div style="margin-left:48%">{!!  HTML::image('assets/loader.gif') !!}</div>');
                },
                success: function (response) {
                    if (response.success == "success") {
                        $("#earningChart").html('');

                        var array = response.earningReport.split(',');
                        array.forEach(function (item, i) {
                            if (item == "''") {
                                array[i] = '';
                            } else {
                                array[i] = parseFloat(item)
                            }
                        });
                        console.log(array);
                        initChart(array, year);
                    }
                }

            });
        });
        @if(\Froiden\Envato\Functions\EnvatoUpdate::showReview())
            $('#reviewModal').modal('show');

            function hideReviewModal(type){
                var url = "{{ route('hide-review-modal',':type') }}";
                url = url.replace(':type', type);

                $.easyAjax({
                    url: url,
                    type: "GET",
                    container: "#reviewModal",
                });
            }
        @endif
    </script>


@stop
