@include('admin.adminlayouts.header', ['some' => 'data'])

<body class="mod-bg-1 ">
    <script>
        /**
         *	This script should be placed right after the body tag for fast execution 
         *	Note: the script is written in pure javascript and does not depend on thirdparty library
         **/
        'use strict';

        var classHolder = document.getElementsByTagName("BODY")[0],
            /** 
             * Load from localstorage
             **/
            themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
            {},
            themeURL = themeSettings.themeURL || '',
            themeOptions = themeSettings.themeOptions || '';

        // if(themeURL == ''){
        //     var themeSet = {};
        //     themeSet.themeURL = '{{ config('app.url') }}'+'/smart_assets/css/themes/cust-theme-13.css';
        //     themeSet.themeOptions = 'mod-bg-1 mod-skin-light';
        //     localStorage.setItem('themeSettings', JSON.stringify(themeSet));

        //     themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
        //     {},
        //     themeURL = themeSettings.themeURL || '',
        //     themeOptions = themeSettings.themeOptions || '';
        // }

        /** 
         * Load theme options
         **/
        if (themeSettings.themeOptions) {
            classHolder.className = themeSettings.themeOptions;
            console.log("%c✔ Theme settings loaded", "color: #148f32");
        } else {
            console.log("%c✔ Heads up! Theme settings is empty or does not exist, loading default settings...",
                "color: #ed1c24");
        }
        if (themeSettings.themeURL && !document.getElementById('mytheme')) {
            var cssfile = document.createElement('link');
            cssfile.id = 'mytheme';
            cssfile.rel = 'stylesheet';
            cssfile.href = themeURL;
            document.getElementsByTagName('head')[0].appendChild(cssfile);

        } else if (themeSettings.themeURL && document.getElementById('mytheme')) {
            document.getElementById('mytheme').href = themeSettings.themeURL;
        }
        /** 
         * Save to localstorage 
         **/
        var saveSettings = function() {
            themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item) {
                return /^(nav|header|footer|mod|display)-/i.test(item);
            }).join(' ');
            if (document.getElementById('mytheme')) {
                themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
            };
            localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
        }
        /** 
         * Reset settings
         **/
        var resetSettings = function() {
            localStorage.setItem("themeSettings", "");
        }
    </script>
    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">

            @include('admin.adminlayouts.sidebar')
            <div class="page-content-wrapper">
                <!-- BEGIN Page Header -->
                <header class="page-header" role="banner">
                    <!-- we need this logo when user switches to nav-function-top -->
                    <div class="page-logo">
                    <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                        <img src="{{ URL::asset('admin_assets/img/logo.png') }}" aria-roledescription="logo">
                        <span class="page-logo-text mr-1">{{ config('app.name') }}</span>
                        <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                        {{-- <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i> --}}
                    </a>
                </div>
                    <!-- DOC: nav menu layout change shortcut -->
                    <div class="hidden-md-down dropdown-icon-menu position-relative">
                        <a href="#" class="header-btn btn js-waves-off" data-action="toggle"
                            data-class="nav-function-hidden" title="Hide Navigation">
                            <i class="ni ni-menu"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="#" class="btn js-waves-off" data-action="toggle"
                                    data-class="nav-function-minify" title="Minify Navigation">
                                    <i class="ni ni-minify-nav"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn js-waves-off" data-action="toggle"
                                    data-class="nav-function-fixed" title="Lock Navigation">
                                    <i class="ni ni-lock-nav"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- DOC: mobile button appears during mobile width -->
                    <div class="hidden-lg-up">
                        <a href="#" class="header-btn btn press-scale-down" data-action="toggle"
                            data-class="mobile-nav-on">
                            <i class="ni ni-menu"></i>
                        </a>
                    </div>

                    <div class="ml-auto d-flex">
                        <!-- activate app search icon (mobile) -->
                        <div class="hidden-sm-up">
                            <a href="#" class="header-icon" data-action="toggle" data-class="mobile-search-on"
                                data-focus="search-field" title="Search">
                                <i class="fal fa-search"></i>
                            </a>
                        </div>
                        {{-- notification --}}
                        <div>
                            @if ($loggedAdmin->company && $loggedAdmin->company->license_expired != 1)
                                @if (isset($pending_applications))

                                    <a href="javascript:;" class="header-icon" data-toggle="dropdown"
                                        id="header_notification_bar">

                                        <i class="fal fa-bell"></i>
                                        @if (count($pending_applications))
                                            <span class="badge badge-icon">
                                                {{ count($pending_applications) }}
                                            </span>
                                        @endif

                                    </a>

                                    <ul class="dropdown-menu">
                                        <li class="external">
                                            <h3><div class="panel-tag"><span class="bold">{{ count($pending_applications) }}
                                                    pending</span>
                                                notifications</div>
                                            </h3>

                                        </li>
                                        @if (count($pending_applications))
                                            <li>
                                                <div data-spy="scroll" data-target="#spyscroll-1" data-offset="0"
                                                    class="p-4 overflow-auto" style="height:250px">
                                                    <ul class="dropdown-menu-list scroller" style="height: 250px;"
                                                        data-handle-color="#637283">
                                                        @forelse($pending_applications as $pending)
                                                            <li>
                                                                <div data-toggle="modal" href="#static_leave_requests"
                                                                    onclick="show_application_notification({{ $pending->id }});return false;">
                                                                    <span
                                                                        class="time">{{ date('d-M-Y', strtotime($pending->created_at)) }}</span>
                                                                    <span class="details">
                                                                        <span
                                                                            class="label label-sm label-icon label-success">
                                                                            <i class="fa fa-bell-o"></i>
                                                                        </span>
                                                                        <strong>{{ $pending->employee->full_name }}
                                                                        </strong> has applied for leave for @if (!isset($pending->end_date))
                                                                            {{ date('d-M-Y', strtotime($pending->start_date)) }}
                                                                        @else
                                                                            {{ date('d-M-Y', strtotime($pending->start_date)) }}
                                                                            to
                                                                            {{ date('d-M-Y', strtotime($pending->end_date)) }}
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                            </li>
                                                        @empty
                                                            <li>
                                                            </li>
                                                        @endforelse


                                                    </ul>
                                                </div>
                                            </li>
                                        @endif
                                    </ul>

                                @endif
                            @endif
                        </div>
                        <!-- app settings -->
                        <div class="hidden-md-down">
                            <a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-settings">
                                <i class="fal fa-cog"></i>
                            </a>
                        </div>

                        <div>
                            <a href="#" data-toggle="dropdown"
                                class="header-icon d-flex align-items-center justify-content-center ml-2">
                                @if (admin()->type == 'admin')
                                    <img src="{{ $loggedAdmin->company->logo_image_url }}"
                                        class="profile-image rounded-circle" alt="admin">
                                @else
                                    <img src="{{ $setting->logo_image_url }}" height="50px">
                                @endif
                                <!-- you can also add username next to the avatar with the codes below:
                                    <span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down">Me</span>
                                    <i class="ni ni-chevron-down hidden-xs-down"></i> -->
                            </a>
                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                                <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                        <span class="mr-2">
                                            @if (admin()->type == 'admin')
                                                <img src="{{ $loggedAdmin->company->logo_image_url }}"
                                                    class="rounded-circle profile-image" alt="admin">
                                            @else
                                                <img src="{{ $setting->logo_image_url }}" height="50px">
                                            @endif
                                        </span>
                                        <div class="info-card-text">
                                            <div class="fs-lg text-truncate text-truncate-lg">
                                                {{ $loggedAdmin->name }}</div>
                                            <span class="text-truncate text-truncate-md opacity-80">
                                                {{ $loggedAdmin->email }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider m-0"></div>
                                @if ($loggedAdmin->type != 'superadmin')
                                    <li class="{{ isset($profileSettingActive) ? $profileSettingActive : '' }}">
                                        <a href="{{ route('admin.profile_settings.edit', 'profile') }}"
                                            class="dropdown-item">

                                            Change Password</a>
                                    </li>
                                @endif
                                <!-- <a href="#" class="dropdown-item" data-toggle="modal"
                                    data-target=".change_password_modal" id="change_password_link">
                                    <span data-i18n="drpdwn.reset_layout">Change Password</span>
                                </a> -->

                                <div class="dropdown-divider m-0"></div>
                                @if (auth()->guard('admin')->check())
                                    <a class="dropdown-item fw-500 pt-3 pb-3" href="{{ route('admin.logout') }}">
                                        <span data-i18n="drpdwn.page-logout">Logout</span>
                                    </a>
                                @endif
                            </div>
                        </div>

                </header>
                <!-- END Page Header -->

                <main role="main" class="page-content">
                    @yield('content')
                </main>
                {!! HTML::script('front_assets/plugins/jquery/jquery.min.js') !!}
                @include('admin.adminlayouts.modal')

                @include('admin.adminlayouts.footer')


                @yield('page_js')
                <script>
                    function show_application_notification(id) {
                        $("#load-data").html('<div class="text-center">{!! HTML::image('assets/loader.gif') !!}</div>');
                        $('#edit_form_leave').attr('action', "{!! URL::to('admin/leave_applications/"+id+"') !!}");
                        $.ajax({
                            type: "GET",
                            url: "{!! URL::to('admin/leave_applications/"+id+"') !!}"

                        }).done(function(response) {
                            $('#modal-data-leave').html(response);
                            //
                        });
                    }
                    (function() {
                        'use strict';
                        window.addEventListener('load', function() {
                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                            var forms = document.getElementsByClassName('needs-validation');
                            // Loop over them and prevent submission
                            var validation = Array.prototype.filter.call(forms, function(form) {
                                form.addEventListener('submit', function(event) {
                                    if (form.checkValidity() === false) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }
                                    form.classList.add('was-validated');
                                }, false);
                            });
                        }, false);
                    })();
                    $(document).ready(function() {
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": true,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": true,
                            "onclick": null,
                            "showDuration": 300,
                            "hideDuration": 100,
                            "timeOut": 5000,
                            "extendedTimeOut": 1000,
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        $(function() {
                            $('.select2').select2();


                            $(".js-hide-search").select2({
                                minimumResultsForSearch: 1 / 0
                            });

                            function formatRepo(repo) {
                                if (repo.loading) {
                                    return repo.text;
                                }

                                var markup = "<div class='select2-result-repository clearfix d-flex'>" +
                                    "<div class='select2-result-repository__avatar mr-2'><img src='" + repo.owner
                                    .avatar_url + "' class='width-2 height-2 mt-1 rounded' /></div>" +
                                    "<div class='select2-result-repository__meta'>" +
                                    "<div class='select2-result-repository__title fs-lg fw-500'>" + repo.full_name +
                                    "</div>";

                                if (repo.description) {
                                    markup +=
                                        "<div class='select2-result-repository__description fs-xs opacity-80 mb-1'>" +
                                        repo.description + "</div>";
                                }

                                markup += "<div class='select2-result-repository__statistics d-flex fs-sm'>" +
                                    "<div class='select2-result-repository__forks mr-2'><i class='fal fa-lightbulb'></i> " +
                                    repo.forks_count + " Forks</div>" +
                                    "<div class='select2-result-repository__stargazers mr-2'><i class='fal fa-star'></i> " +
                                    repo.stargazers_count + " Stars</div>" +
                                    "<div class='select2-result-repository__watchers mr-2'><i class='fal fa-eye'></i> " +
                                    repo.watchers_count + " Watchers</div>" +
                                    "</div>" +
                                    "</div></div>";

                                return markup;
                            }

                            function formatRepoSelection(repo) {
                                return repo.full_name || repo.text;
                            }
                        });
                    });

                    function leaveModal() {
                        $.ajaxModal('#applyLeave', '{{ route('leaves.create') }}');
                    }
                </script>

                <script>
                    $('input[type=checkbox]').uniform();


                    // Show change password modal body
                    $('#change_password_link').click(function() {
                        $('#change_password_modal_body').css("padding", "100px");
                        $('#change_password_modal_body').html('{!! HTML::image('front_assets/img/loader.gif') !!}');
                        $('#change_password_modal_body').attr('class', 'text-center');

                        $.ajax({
                            type: 'POST',
                            url: "{{ route('front.change_password_modal') }}",

                            data: {},
                            success: function(response) {

                                $('#change_password_modal_body').css("padding", "0px");
                                $('#change_password_modal_body').removeClass('text-center');
                                $('#change_password_modal_body').html(response);
                            },

                            error: function(xhr, textStatus, thrownError) {
                                $('#change_password_modal_body').html(
                                    '<div class="alert alert-danger">Error Fetching data</div>');
                            }
                        });

                    });

                    function change_password() {
                        $.easyAjax({
                            type: 'POST',
                            url: "{{ route('front.change_password') }}",
                            data: $('#change_password_form').serialize(),
                            container: "#change_password_form",
                            success: function(response) {
                                if (response.status === "success") {
                                    $('.change_password_modal').modal('hide');
                                }
                            }
                        });
                        return false;
                    }


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                </script>
