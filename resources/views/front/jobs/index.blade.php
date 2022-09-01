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
        <div class="profile-body">
            <div class="panel">
                <div class="panel-hdr">
                    <h2> <i class="fal fa-mail-bulk "></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('core.jobVacancy') }}
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                            data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                            data-offset="0,10" data-original-title="Fullscreen"></button>
                        {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                    </div>
                </div>
                <hr>
                <div class="panel-container show">
                    <div class="panel-content">
                        @if (Session::get('success'))
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-success">
                                        <span class="fal fa-check">{{ Session::get('success') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (count($jobs) == 0)
                            <div class="col-md-12">
                                <div class="panel-tag">
                                    <h2 class="subheader-title"> <i
                                            class="subheader-icon fal fa-thumbs-down"></i>{{ trans('messages.noJob') }}</h2>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            @foreach ($jobs as $job)
                                <div class="col-sm-6 col-xl-3">
                                    <div
                                        class="p-3 bg-success-300 rounded overflow-hidden position-relative text-white mb-g">
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
                                <!-- <div class="col-md-4 col-sm-3">
                            <a href="{{ route('jobs.show', $job->id) }}">
                                <div class="service-block  service-block-{{ $job_block_color[$job->id % count($job_block_color)] }}">
                                    <i class="icon-2x color-light fal fa-{{ $job_block_icon[$job->id % count($job_block_icon)] }}"></i>
                                    <h2 class="heading-md">&nbsp;&nbsp;&nbsp;{{ $job->position }}</h2>

                                </div>
                            </a>
                        </div> -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('page_js')

@stop
