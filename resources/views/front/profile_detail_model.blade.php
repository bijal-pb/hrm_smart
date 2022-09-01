<!------------------------------ BEGIN FORM ----------------------------------------->

<div class="modal-body">
    <!--Profile Body-->
    <div class="profile-body">
        <!--Profile Post-->
        <div id="panel-5" class="panel">
            <div class="panel-hdr">
                <h2>
                    <i class="fal fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ __('core.personalDetails') }}
                </h2>
                <!-- <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Fullscreen"></button>
                            {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Close"></button> --}}
                        </div> -->
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="frame-wrap">
                        <table class="table table-bordered table-hover m-0">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="primary-link">{{ __('core.name') }}</span>
                                    </td>
                                    <td>
                                        {{ $employee->full_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">{{ __('core.father_name') }}</span>
                                    </td>
                                    <td>
                                        {{ $employee->father_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">{{ __('core.dob') }}</span>
                                    </td>
                                    <td>
                                        @if ($employee->date_of_birth == null)
                                        --
                                        @else
                                        {!! date('d-M-Y', strtotime($employee->date_of_birth)) !!}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">{{ __('core.gender') }}</span>
                                    </td>
                                    <td>
                                        {{ ucfirst($employee->gender) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">{{ __('core.email') }}</span>
                                    </td>
                                    <td>
                                        {{ $employee->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">{{ __('core.phone') }}</span>
                                    </td>
                                    <td>
                                        {{ $employee->mobile_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">{{ __('core.local_address') }}</span>
                                    </td>
                                    <td>
                                        {{ $employee->local_address }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="primary-link">{{ __('core.permanent_address') }}</span>
                                    </td>
                                    <td>
                                        {{ $employee->permanent_address }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--End Profile Post-->
    </div>