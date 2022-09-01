
<!-- END Page Settings -->
<!-- base vendor bundle: 
DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations 
    + pace.js (recommended)
    + jquery.js (core)
    + jquery-ui-cust.js (core)
    + popper.js (core)
    + bootstrap.js (core)
    + slimscroll.js (extension)
    + app.navigation.js (core)
    + ba-throttle-debounce.js (core)
    + waves.js (extension)
    + smartpanels.js (extension)
    + src/../jquery-snippets.js (core) -->
{{-- {!! HTML::script('front_assets/plugins/jquery/jquery-migrate.min.js') !!}  --}}
<script src="{{ URL::asset('smart_assets/js/vendors.bundle.js') }}"></script>
<script src="{{ URL::asset('smart_assets/js/app.bundle.js') }}"></script>
<script src="{{ URL::asset('smart_assets/js/formplugins/select2/select2.bundle.js') }}"></script>
<script src="{{ URL::asset('smart_assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script src="{{ URL::asset('smart_assets/js/datagrid/datatables/datatables.export.js') }}"></script>
<script src="{{ URL::asset('smart_assets/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
<script src="{{ URL::asset('smart_assets/js/notifications/toastr/toastr.js') }}"></script>
<script src="{{ URL::asset('smart_assets/js/statistics/peity/peity.bundle.js') }}"></script>
<script src="{{ URL::asset('smart_assets/js/statistics/flot/flot.bundle.js') }}"></script>
<script src="{{ URL::asset('smart_assets/js/statistics/easypiechart/easypiechart.bundle.js') }}"></script>
<script src="{{ URL::asset('smart_assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script src="{{ URL::asset('smart_assets/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{ URL::asset('smart_assets/js/formplugins/summernote/summernote.js')}}"></script>
<script src="{{ URL::asset('smart_assets/js/dependency/moment/moment.js')}}"></script>
<script src="{{ URL::asset('smart_assets/js/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.js')}}"></script>
<script src="{{URL::asset('smart_assets/js/dependency/moment/moment.js')}}"></script>
<script src="{{ URL::asset('smart_assets/js/miscellaneous/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="https://cdn.ravenjs.com/2.1.0/raven.min.js" rel="core"></script>

{!! HTML::script('assets/global/plugins/uniform/jquery.uniform.min.js') !!}
{!! HTML::script('assets/global/plugins/froiden-helper/helper.js')!!}
{!! HTML::script('front_assets/plugins/lib/moment.min.js') !!}
{!! HTML::script("assets/global/plugins/bootstrap-sessiontimeout/bootstrap-session-timeout.js", array("rel" => "core")) !!}
{!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js") !!}

{!! HTML::script('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js')  !!}
{!! HTML::script('assets/admin/pages/scripts/components-pickers.js')  !!}

 {!! HTML::script('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')!!}
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
    {!! HTML::script('assets/admin/pages/scripts/components-pickers.js')!!}
    {!! HTML::script("assets/global/plugins/cropper/cropper.min.js")!!}
{!! HTML::script('front_assets/plugins/html5shiv.js') !!}


{!! HTML::script('assets/global/plugins/uniform/jquery.uniform.min.js')!!}
{!! HTML::script('assets/global/plugins/froiden-helper/helper.js?v=1', array("rel"  => "core"))!!}
{!! HTML::script("assets/admin/layout/scripts/app.js", array("rel"  => "core"))!!}
{!! HTML::script("assets/admin/layout/scripts/layout.js?v=1", array("rel"  => "core"))!!}
{!! HTML::script('assets/js/commonjs.js?v=3', array("rel"  => "core")) !!}
{!! HTML::script("assets/global/plugins/lodash.core.min.js", array("rel" => "core")) !!}


<script>
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

<script rel="core" type="text/javascript">
    var SessionTimeout = function () {
        var e = function () {
            $.sessionTimeout({
                title: "Session Timeout Notification",
                message: "Your session is about to expire.",
                keepAlive: false,
                redirUrl: false,
                logoutUrl: "{{ URL::route('admin.logout') }}",
                warnAfter: 900000,
                redirAfter: 1080000,
                logoutButton: "@Lang('core.logout')",
                countdownMessage: "Your screen will lock in {timer} seconds.",
                countdownBar: !0,
                anyActionHidesModal: false,
                countdownSmart: true,
                onRedir: function () {
                    $('#session-timeout-dialog').modal('hide');
                    lockScreenModal();
                }
            })
        };
        return {
            init: function () {
                e()
            }
        }
    }();
    SessionTimeout.init();

    var startToggle;
    var title = document.title;

    $('#session-timeout-dialog').on('shown.bs.modal', function () {

        function titleToggle() {
            if (document.title == "Attention!") {
                document.title = title;
            } else {
                document.title = "Attention!";
            }
        }

        startToggle = setInterval(titleToggle, 2000);
    });

    $('#session-timeout-dialog').on('hidden.bs.modal', function () {
        clearInterval(startToggle);
        document.title = title;
    });

     var lodash = _.noConflict();

    var popped = false;

    window.onpopstate = function (event) {
        if (event.state != null) {
            popped = true;
            loadView(event.state.path);
        }
    };


    function loginCheck() {
        $.easyAjax({
            type: "POST",
            url: "{{ URL::to('/admin/login') }}",
            data: $('#static_screen_lock').find("form").serialize(),
            container: "#static_screen_lock",
            messagePosition: "inline",
            redirect: false,
            success: function (response) {
                if (response.status == "success") {
                    $('#static_screen_lock').modal("hide").find("#password").val("");
                }
            }
        });
    }

    function ToggleEmailNotification(type) {
        if ($('[name=' + type + ']').is(':checked')) {
            var value = 1;
        } else {
            var value = 0;
        }

        $('#load_notification').html('{!!  HTML::image('assets/loader.gif') !!}');


        $.ajax({
            type: 'POST',
            url: "{{route('admin.ajax_update_notification')}}",
            dataType: "JSON",
            data: {
                'value': value, 'id': '{{ $loggedAdmin->company->id??''}}', 'type': type
            },
            success: function (response) {
                if (response.success == 'success') {
                    $('#load_notification').html('<span style="color:dodgerblue" class="fa fa-check"></span>');
                }
            },
            error: function (xhr, textStatus, thrownError) {
                alert('Data Fetching error');
            }
        });

    }


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function onlyNum(cl) {
        $("." + cl).keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

    }

    var resp;
    var rawResponse;
    var ajaxScripts = 0;
    var evalScripts = [];
    var fileScripts = [];
    var Init = function () {
        return {
            init: function () {
            }
        };
    }();


    function executeScripts() {

        for (i = 0; i < fileScripts.length; i++) {
            try {
                $.globalEval(fileScripts[i]);
            } catch (e) {
                console.log("error");
                console.log(e);
            }
        }

        App.init();
//    App.unblockUI({target: ".page-content"});

        try {
            var completeScript = "";

            for (i = 0; i < evalScripts.length; i++) {
                try {
                    completeScript += $(evalScripts[i]).html();
                } catch (e) {
                    console.log("error");
                    console.log(e);
                }
            }

            $.globalEval(completeScript);
        } catch (e) {
            console.log("error");
            console.log(e);
        }

        try {
            $.globalEval($("script[rel='common']").html());
        } catch (e) {
            console.log(e);
        }

        $(document).trigger("ready");
        $(document).trigger("ajaxPageLoad");

        $(".popover").remove();
        jQuery('body').animate({scrollTop: 0}, 200);
    }

    function loadView(url) {

        $.ajax({
            url: url,
            dataType: "html",
            success: function (response) {
                // Check if we have been logged out

                var matches = response.match(/\<\!\-\-\ Login\ Page\ \-\-\>/g);
                var matches2 = response.match(/\<\!\-\-\ Screenlock\ \-\-\>/g);
                if ((matches != null && matches.length > 0) || (matches2 != null && matches2.length > 0)) {
                    window.location.href = "{{ route("admin.getlogin") }}";
                    return;
                }

                // Reset eval scripts array
                // We need to preserve the order of execution of scripts, so we do not execute them directly.
                // We save them in arrays first, then execute them in order
                evalScripts = [];
                fileScripts = [];

                rawResponse = response;
                resp = $(response);
                var html = resp.find(".page-content").html();
                var menu = resp.find(".hor-menu").html();
                var pageActions = resp.find(".page-actions").html();


                document.title = resp.filter("title").html();

                // Manage browse history
                if (!popped) {
                    history.pushState({path: url}, document.title, url);
                }
                popped = false;


                resp.filter("link").each(function () {
                    var that = $(this);

                    if (that.attr("rel") == "stylesheet") {
                        // Stylesheets with name=core are loaded on initial page load
                        // and always loaded. So, we need to ignore them.
                        if (that.attr("name") != "core") {
                            // This check is to prevent duplicate stylesheets from loading
                            if ($("link[href='" + (that.attr("href")) + "']").length == 0) {
                                $("#css_before_this").before(this);
                            }
                        }
                    }
                });

                // This is used to run evaluateScripts if no extra script was found on the page
                var scriptsFound = 0;

                resp.filter("script").each(function () {
                    var that = $(this);

                    if (that.attr("rel") != "core") {
                        // Prevent appending of same scripts again
                        if ($("script[href='" + (that.attr("src")) + "']").length == 0 && that.attr("src") != undefined) {
                            ajaxScripts++;
                            scriptsFound++;

                            fileScripts.push(that.attr("src"));
                            $.ajax({
                                url: that.attr("src"),
                                dataType: 'text',
                                success: function (response) {
                                    for (i = 0; i < fileScripts.length; i++) {
                                        if (fileScripts[i] == that.attr("src")) {
                                            fileScripts[i] = response;
                                        }
                                    }

                                    ajaxScripts--;


                                    if (ajaxScripts == 0) {
                                        // All pending ajax requests have completed. So, execute scripts now
                                        executeScripts();
                                    }
                                },
                                error: function (xhr, textStatus, thrownError) {
                                    ajaxScripts--;
                                }
                            });

                            // This is just to prevent duplicate script loading. Does nothing, as attribute is
                            // href not src
                            $("<script/>", {
                                type: "text/javascript",
                                href: that.attr("src")
                            }).append("body");
                        }

                        if (that.attr("src") == "" || that.attr("src") == undefined) {
                            evalScripts.push(this);
                        }
                    }
                });

                $(".page-content").html(html);
                $(".hor-menu").html(menu);
                $(".page-actions").html(pageActions);

                Layout.initMainMenu();


                if (scriptsFound == 0) {
                    console.log("executing scripts");
                    executeScripts();
                }

            },
            error: function (xhr, textStatus, thrownError) {
                window.location.href = url;
            }
        });
    }

    function lockScreenModal() {
        $.ajax({
            type: "POST",
            url: "{!! route('admin.screenlock.modal') !!}"
        }).done(function (response) {
            $('#static_screen_lock').modal({
                backdrop: 'static',
                keyboard: false
            }).show();
        });
    }
</script>
