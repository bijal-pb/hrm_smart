@extends('front.layouts.frontlayout')



@section('content')
    <div class="page-head">
        <div class="page-title"><h1>
        <i class="fal fa-ballot"></i>
             {{trans('core.mySalarySlip')}}
            </h1></div>
    </div>

    <div class="col-md-12">
        <!--Profile Body-->
        <div class="profile-body">
                <!--Profile Post-->
                <div class="col-sm-12">
                    <div class="panel ">
                      <div class="panel-hdr">
                            <h2 class="panel-title"><i class="fal fa-ballot"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{trans('core.mySalarySlip')}}</h2>
                            <div class="panel-toolbar">
                                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                    <!-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> -->
                                 </div>
                        </div>
                        <div class="panel-container show">
                        <div class="panel-content" >
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" id="payroll">
                                    <thead class="bg-primary-600">
                                    <tr>
                                        <th> {{trans('core.id')}} </th>

                                        <th> {{trans('core.month')}} </th>
                                        <th> {{trans('core.year')}} </th>
                                        <th> {{trans('core.netSalary')}} {{$setting->currency_symbol}} </th>
                                        <th> {{trans('core.createdOn')}} </th>
                                        <th class="text-center"> {{trans('core.action')}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    <tr>
                                        <td>{{-- ID --}}</td>
                                        <td>{{-- Month --}}</td>
                                        <td>{{-- Year --}}</td>
                                        <td>{{-- Net --}}</td>
                                        <td>{{-- created On --}}</td>
                                        <td>{{-- Action --}} </td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>


                    <!--End Profile Post-->


                </div><!--/end row-->

                <hr>


           
            <!--End Profile Body-->
        </div>

    </div>


    {{--------------------------Show Notice MODALS-----------------}}


    <div class="modal fade show_notice" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <div class="d-block position-absolute pos-top pos-left p-2 ">
                    <h4 id="myLargeModalLabel" class="modal-title">
                        Salary Slip
                    </h4>
                </div>
                </div>
                <div class="modal-body" id="modal-data">
                    {{--Notice full Description using Javascript--}}
                </div>
            </div>
        </div>
    </div>


    {{------------------------END Notice MODALS---------------------}}

@endsection

@section('page_js')

   

    <script>

        var table = $('#payroll').dataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            stateSave: true,
            {!! $datatabble_lang !!}
            "ajax": "{{ URL::route('front.ajax_payrolls') }}",
            "columns": [
                {data: 'id', name: 'id',searchable: true},
                {data: 'month', name: 'month', searchable: true},
                {data: 'year', name: 'year',searchable: true},
                {data: 'net_salary', name: 'net_salary',searchable: true},
                {data: 'created_at', name: 'created_at',searchable: true},
                {data: 'actions', name: 'actions',orderable: false}
            ],
            order: [0, 'desc'],
            lengthChange: true,
            dom: '<"float-left"B><"float-right"f>rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>',
                        // "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                        // "<'row'<'col-sm-12'tr>>" +
                        // "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    titleAttr: 'Generate PDF',
                    className: 'btn-outline-primary btn-sm mr-1'
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    titleAttr: 'Generate Excel',
                    className: 'btn-outline-primary btn-sm mr-1'
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    titleAttr: 'Generate CSV',
                    className: 'btn-outline-primary btn-sm mr-1'
                },
                {
                    extend: 'copyHtml5',
                    text: 'Copy',
                    titleAttr: 'Copy to clipboard',
                    className: 'btn-outline-primary btn-sm mr-1'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    titleAttr: 'Print Table',
                    className: 'btn-outline-primary btn-sm'
                }
            ]

        });


        function show_salary_slip(id) {
            $('#modal-data').html('<div class="text-center">{!! HTML::image('front_assets/img/loader.gif') !!}</div>');
            $.ajax({
                type: "GET",
                url: "{!!  URL::to('panel/salary_slip/"+id+"')  !!}"

            }).done(function (response) {
                $('#modal-data').html(response);
//
            });
        }


    </script>


@endsection