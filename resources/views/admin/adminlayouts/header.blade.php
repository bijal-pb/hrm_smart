<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        {{ config('app.name') }}
    </title>

    <meta name="description" content="Page Title">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">

    {!! HTML::style('front_assets/plugins/font-awesome/css/font-awesome.min.css') !!}
    {!! HTML::style('front_assets/plugins/sky-forms/version-2.0.1/css/custom-sky-forms.css') !!}

    {{-- {!! HTML::style('front_assets/plugins/scrollbar/src/perfect-scrollbar.css') !!} --}}

    <!-- CSS Page Style -->
    {!! HTML::style('front_assets/css/pages/profile.css') !!}
    <!-- {!! HTML::style("assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css") !!} -->
    {!! HTML::style("assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css") !!}

    {!! HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")!!}

    {!! HTML::style('front_assets/plugins/scrollbar/src/perfect-scrollbar.css') !!}
    
    {!! HTML::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')!!}
    {!!  HTML::style("assets/global/plugins/cropper/cropper.min.css")!!}


    <!-- CSS Theme -->
    {!! HTML::style("front_assets/css/theme-colors/$setting->front_theme.css") !!}
    {!! HTML::style('assets/global/plugins/uniform/css/uniform.default.min.css') !!}
    
    <!-- CSS Customization -->
    <link rel="icon" href="{{ $setting->favicon_image_url }}" class="profile-image rounded-circle">

    {{-- {!! HTML::style('front_assets/css/custom.css') !!} --}}
    {!! HTML::style('assets/global/plugins/froiden-helper/helper.css?v=2', array("name" => "core")) !!}    

    <!-- base css -->
    <link id="vendorsbundle" rel="stylesheet" media="screen, print"
        href="{{ URL::asset('smart_assets/css/vendors.bundle.css') }}">
    <link id="appbundle" rel="stylesheet" media="screen, print"
        href="{{ URL::asset('smart_assets/css/app.bundle.css') }}">
    <link id="mytheme" rel="stylesheet" media="screen, print" href="#">
    <link id="myskin" rel="stylesheet" media="screen, print"
        href="{{ URL::asset('smart_assets/css/skins/skin-master.css') }}">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ URL::asset('smart_assets/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('smart_assets/img/favicon/favicon.png') }}">
    <link rel="mask-icon" href="{{ URL::asset('smart_assets/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="stylesheet" media="screen, print"
        href="{{ URL::asset('smart_assets/css/formplugins/select2/select2.bundle.css') }}">
    <link rel="stylesheet" media="screen, print"
        href="{{ URL::asset('smart_assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
    <link rel="stylesheet" media="screen, print"
        href="{{ URL::asset('smart_assets/css/notifications/toastr/toastr.css') }}">
    <link rel="stylesheet" media="screen, print"
        href="{{ URL::asset('smart_assets/css/datagrid/datatables/datatables.bundle.css') }}">
        <link rel="stylesheet" media="screen, print" href="{{ URL::asset('smart_assets/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css')}}">
        <link rel="stylesheet" media="screen, print" href="{{ URL::asset('smart_assets/css/formplugins/summernote/summernote.css')}}">
        <link rel="stylesheet" media="screen, print" href="{{ URL::asset('smart_assets/css/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.css')}}">
        <link rel="stylesheet" media="screen, print" href="{{ URL::asset('smart_assets/css/miscellaneous/fullcalendar/fullcalendar.bundle.css')}}">

    <!-- You can add your own stylesheet here to override any styles that comes before it
        <link rel="stylesheet" media="screen, print" href="css/your_styles.css"> -->

    <!-- =============================================== -->

        <style>
            .pg nav {
                display: inline-flex;
            }

            div#ms-holidays_list {
                display: flex;
            }
            .ms-selectable {
                width: 48%;
            }

            .ms-selection {
                width: 48%;
                margin-left: 10px;
            }

            li.ms-optgroup-label {
                color: black;
                list-style: none;
                margin-top: 10px;
            }

            li.ms-optgroup-container {
                list-style: none;
            }

            /* .select2-container {
                z-index: 99999;
            }
            .overlay{
                display: none;
                text-align: center;
                position: fixed;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                z-index: 99999;
                background: rgba(255, 255, 255, 0.839);
            } */

        </style>

</head>
