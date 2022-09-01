@extends('front.layouts.frontlayout')

@section('head')

    <style>
        a:hover {
            text-decoration: none !important;
        }

    </style>
@stop

@section('content')
    <div class="page-head">
        <div class="page-title">
            <h1>
                <i class="fal fa-mail-bulk "></i>
                {{ trans('core.jobVacancy') }}
            </h1>
        </div>
    </div>
    <div class="col-md-12">

        <!--Profile Body-->
        <div class="panel">
            <div class="panel-hdr">
                <h2><i class="fal fa-mail-bulk "></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('core.jobVacancy') }}</h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                        data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10"
                        data-original-title="Fullscreen"></button>
                    {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10"
                        data-original-title="Close"></button> --}}
                </div>
            </div>
            <hr>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row">

                        @foreach ($jobs as $job)
                            <div class="col-sm-6 col-xl-3">
                                <div class="p-3 bg-success-300 rounded overflow-hidden position-relative text-white mb-g">
                                    <div class="">
                                        <a href="{{ route('jobs.show', $job->id) }}">
                                            <div
                                                class="service-block  service-block-{{ $job_block_color[$job->id % count($job_block_color)] }}">
                                                <h2 class="heading-md">&nbsp;&nbsp;&nbsp;{{ $job->position }}</h2>
                                            </div>
                                        </a>
                                    </div>
                                    <i class="fal fa-hat-chef position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                                        style="font-size:6rem"></i>
                                </div>
                            </div>
                            <!-- <div class="col-md-4 col-sm-6">
                            <a href="{{ route('jobs.show', $job->id) }}">
                                <div class="service-block  service-block-{{ $job_block_color[$job->id % count($job_block_color)] }}">
                                    <i class="icon-2x color-light fal fa-{{ $job_block_icon[$job->id % count($job_block_icon)] }}"></i>
                                    <h2 class="heading-md">&nbsp;&nbsp;&nbsp;{{ $job->position }}</h2>

                                </div>
                            </a>
                        </div> -->
                        @endforeach

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="headline">
                                <h2>{{ $job_detail->position }}</h2>
                            </div>
                        </div>

                        <div class="col-md-6">
                            {!! $job_detail->description !!}
                            <hr>
                            {{-- <p><strong>Last Date to Apply:</strong> {{date('d M Y',strtotime($job_detail->last_date))}}</p> --}}
                        </div>

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary field btn-block" id="apply_button"
                                onclick="ShowApplyForm();return false;">{{ trans('core.applyNow') }}</button>
                            <!-- Reg-Form -->


                            {!! Form::open(['class' => 'sky-form ajax_form', 'id' => 'apply_job_form', 'style' => 'display: none', 'files' => true]) !!}

                            <input type="hidden" name="job_id" value="{{ $job_detail->id }}">
                            <header>{{ trans('core.applicationForm') }}</header>

                            <fieldset>
                                <div class="form-group">

                                    <label class="label col col-4">Name</label>
                                    <div class="col col-8">
                                        <label class="input">

                                            <input type="text" name="name" placeholder="{{ trans('core.name') }}">
                                        </label>
                                    </div>
                                </div>


                                <div class="form-group">

                                    <label class="label col col-4">Email</label>
                                    <div class="col col-8">
                                        <label class="input">

                                            <input type="email" name="email" placeholder="{{ trans('core.email') }}">
                                        </label>
                                    </div>
                                </div>


                                <section>
                                    <div class="form-group">

                                        <label class="label col col-4">Contact</label>
                                        <div class="col col-8">
                                            <label class="input">

                                                <input type="text" name="phone" placeholder="{{ trans('core.phone') }}" id="phone">
                                            </label>
                                        </div>
                                    </div>


                                </section>

                                <section>
                                    <div class="form-group">

                                        <label class="label col col-4">Cover</label>
                                        <div class="col col-8">
                                            <label class="input">

                                                <textarea rows="3" name="cover_letter" class="form-control" laceholder="{{ trans('core.coverLetter') }}"></textarea>
                                            </label>
                                        </div>
                                    </div>


                                </section>

                                <section>
                                    <div class="form-group">

                                        <label class="label col col-4">{{ trans('core.resume') }}</label>
                                        <div class="col col-8">
                                            <label for="file" class="input input-file">
                                                <input type="file" name="resume"
                                                    onchange="this.parentNode.nextSibling.value = this.value">

                                            </label>
                                        </div>
                                    </div>

                                </section>
                            </fieldset>


                            <footer>
                                <button type="button" onclick="submitForm();return false;"
                                    class="btn btn-primary">{{ trans('core.btnSubmit') }}</button>
                            </footer>
                            {!! Form::close() !!}
                            <!-- End Reg-Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@stop

@section('page_js')

    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <!-- END PAGE LEVEL PLUGINS -->
    <script>
        function ShowApplyForm() {
            $('#apply_button').hide();
            $('#apply_job_form').fadeIn();
        }

        @if (Session::get('success') || count($errors) > 0)
            ShowApplyForm();
        
        @endif

        function submitForm() {
            var url = "{{ route('jobs.store') }}";
            $.easyAjax({
                type: 'POST',
                url: url,
                data: $(".ajax_form").serialize(),
                container: ".ajax_form",
                file: true,
                success: function(response) {
                    if (response.status === "success") {
                        $('#showModal').modal('hide');
                        // toastr['success']('Added successfully!');
                        window.location.reload();
                    }

                }
            });
        }
    </script>

@stop
