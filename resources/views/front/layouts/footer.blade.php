
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
<script src="{{ URL::asset('smart_assets/js/formplugins/summernote/summernote.js')}}"></script>
<script src="{{ URL::asset('smart_assets/js/dependency/moment/moment.js')}}"></script>
<script src="{{URL::asset('smart_assets/js/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.js')}}"></script>
<script src="{{URL::asset('smart_assets/js/dependency/moment/moment.js')}}"></script>
<script src="{{ URL::asset('smart_assets/js/miscellaneous/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="https://cdn.ravenjs.com/2.1.0/raven.min.js" rel="core"></script>

{!! HTML::script('front_assets/plugins/lib/moment.min.js') !!}
{!! HTML::script('assets/global/plugins/uniform/jquery.uniform.min.js') !!}
{!! HTML::script('assets/global/plugins/froiden-helper/helper.js')!!}
<!-- Scrollbar -->
{!! HTML::script('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js')  !!}
{!! HTML::script('front_assets/plugins/scrollbar/src/jquery.mousewheel.js') !!}
{!! HTML::script('front_assets/plugins/scrollbar/src/perfect-scrollbar.js') !!}
<!-- Scrollbar -->

{!! HTML::script('assets/js/moment-timezone.js') !!}
{!! HTML::script('front_assets/plugins/html5shiv.js') !!}

<script src="{{ URL::asset('smart_assets/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>

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

    // function leaveModal() {
    //     alert();
    //     $.ajax('#applyLeave', '{{ route('leaves.create') }}');
    // }
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