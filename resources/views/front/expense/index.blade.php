@extends('front.layouts.frontlayout')

@section('head')
    <!-- {{-- {!! HTML::style("assets/global/css/components.css")!!} --}}
    {!! HTML::style('assets/global/css/plugins.css') !!}
    {!! HTML::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!} -->
@stop

@section('content')
   <div class="page-head">
        <div class="page-title"><h1>
        {{ $setting->currency_symbol }} 
       @lang('core.myExpenses')
            </h1></div>
    </div>

    <div class="col-md-12">
        <!--Profile Body-->
        <div class="profile-body">
            <div class="row margin-bottom-20">
                <!--Profile Post-->
                <div class="col-sm-12">


                    {{-- ----------------Error Messages-------- --}}
                    <div id="alert_message">
                        @if (Session::get('success'))
                            <div class="alert alert-success"><i class="fa fa-check"></i> {{ Session::get('success') }}
                            </div>
                        @endif
                    </div>
                    {{-- ----------------Error Messages-------- --}}

                    <!-- <a href="{{ route('front.expenses.create') }}" class="btn-u field"><i class="fa fa-plus"></i>
                        {{ __('menu.addExpenseFront') }}</a> -->
                    <hr>
                    <div id="panel-5" class="panel">
                         <div class="panel-hdr">
                            <h2>{{ $setting->currency_symbol }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@lang('core.myExpenses')</h2>
                            <div class="panel-toolbar">
                                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                    {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                            </div>
                        </div>
                      <div class="panel-container show">
                      <a class="btn btn-primary float-right m-3" 
                       id="btn-add" style="color: #fff;" onclick="showadd();" >
                       {{ __('menu.addExpenseFront') }}
                            </a>
                          <div class="panel-content" >
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" id="expenses">
                                    <thead class="bg-primary-600">
                                        <tr>
                                            <th> {{ trans('core.id') }}</th>
                                            <th> {{ trans('core.item') }}</th>
                                            <th> {{ trans('core.purchase_from') }} </th>
                                            <th> {{ trans('core.date') }}</th>
                                            <th>{{ trans('core.price') }} ( {{ $setting->currency_symbol }} )</th>
                                            <th>Bill</th>
                                            <th>{{ trans('core.status') }}</th>


                                        </tr>
                                    </thead>
                                    <tbody>


                                        <tr>
                                            <td>{{-- ID --}}</td>
                                            <td>{{-- Item Name --}}</td>
                                            <td>{{-- Purchase Date --}}</td>
                                            <td>{{-- Purchase Date --}}</td>
                                            <td>{{-- Purchase Date --}}</td>
                                            <td>{{-- Status --}}</td>
                                            <td></td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>


                    <!--End Profile Post-->


                </div>
                <!--/end row-->

                <hr>


            </div>
            <!--End Profile Body-->
        </div>

    </div>
    <div class="modal fade add_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="data-model1">
        <div class="modal-dialog">
            <div class="modal-content" id="add-expenses-content">
            </div>
        </div>
    </div>


    {{-- ------------------------Show Notice MODALS--------------- --}}


    <div class="modal fade show_notice" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myLargeModalLabel" class="modal-title">
                        Leave Application
                    </h4>
                </div>
                <div class="modal-body" id="modal-data">
                    {{-- Notice full Description using Javascript --}}
                </div>
            </div>
        </div>
    </div>


    {{-- ----------------------END Notice MODALS------------------- --}}

@endsection

@section('page_js')
    <!-- {!! HTML::script('assets/global/plugins/datatables/datatables.min.js') !!}
    {!! HTML::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!} -->

    <script>
        var table = $('#expenses').dataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            stateSave: true,
            "ajax": "{!! URL::route('front.ajax_expenses') !!}",

            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'item_name',
                    name: 'item_name'
                },
                {
                    data: 'purchase_from',
                    name: 'purchase_from'
                },
                {
                    data: 'purchase_date',
                    name: 'purchase_date'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'bill',
                    name: 'bill',
                    "bSortable": false
                },
                {
                    data: 'status',
                    name: 'status'
                },

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

        function showadd() {
            var get_url = "{{route('front.expenses.create')}}";
            $('#data-model1').modal('show', get_url);

            $.ajax({
                type: 'GET',
                url: get_url,

                data: {},
                success: function(response) {
                    $('#add-expenses-content').html(response);
                },

                error: function(xhr, textStatus, thrownError) {
                    $('#add-expenses-content').html(
                        '<div class="alert alert-danger">Error Fetching data</div>');
                }
            });
        }
        function ajaxCreateExpense() {
            var url = "{{ route('front.expenses.store') }}";
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '.ajax_form',
                file: true,
                success: function (response) {
                    if (response.status === "success") {
                        $('#data-model1').modal('hide');
                        toastr['success'];
                        $('#expenses').DataTable().ajax.reload();
                    }
                }
            });
        }


        function show_salary_slip(id) {
            $('#modal-data').html('<div class="text-center">{!! HTML::image('front_assets/img/loader.gif') !!}</div>');
            $.ajax({
                type: "GET",
                url: "{{ URL::to('salary_slip/"+id+"') }}"

            }).done(function(response) {
                $('#modal-data').html(response);
                //
            });
        }
    </script>


@endsection
