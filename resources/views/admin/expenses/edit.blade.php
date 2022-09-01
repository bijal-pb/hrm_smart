<div class="modal fade edit_expenses" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="data-model">
    <div class="modal-dialog">
        <div class="modal-content" id="edit-expenses-content">
        </div>
    </div>
</div>
<!-- BEGIN PAGE HEADER-->
<div class="page-head">
    <div class="page-title">
        <h4 class="mx-2 my-2">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
            <i class="fal fa-database"></i>
            {{trans('pages.expenses.editTitle')}}
        </h4>
    </div>
</div>
<div class="modal-body">
        <!-- BEGIN FORM-->
        {!! Form::open(['class'=>'form-horizontal ajax_form','method'=>'PATCH','files'=>true])!!}
        <div class="form-body">

            <div class="form-group">
                <label class="col-md-2 form-label">{{trans('core.item')}} <span class="required">
                        * </span></label>

                <div class="col-md-12">
                    <input type="text" class="form-control" name="item_name" id="item_name" placeholder="{{trans('core.item')}}" value="{{ $expense->item_name }}">
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 form-label">{{trans('core.purchase_from')}} : </label>

                <div class="col-md-12">
                    <input type="text" class="form-control" name="purchase_from" placeholder="{{trans('core.purchase_from')}}" value="{{ $expense->purchase_from }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 form-label">{{trans('core.date')}}:</label>

                <div class="col-md-12">
                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                        <input type="text" class="form-control" name="purchase_date" readonly value="{!! date('d-m-Y',strtotime($expense->purchase_date)) !!}">
                        {{-- <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                </span> --}}
                    </div>
                </div>
            </div>

            {{-- <div class="form-group">
                                    <!-- <label class="form-label">{{trans('core.date')}}:</label> -->

            <div class="col-md-12">
                <label class="form-label" for="example-date">{{trans('core.date')}}:</label>
                <input class="form-control" id="purchase_date" type="date" name="purchase_date" value="$expense->purchase_date">
            </div>
        </div> --}}

        <div class="form-group">
            <label class="col-md-4 form-label">{{trans('core.price')}}:<span class="required">
                    * </span> {{$loggedAdmin->company->currency_symbol}}</label>

            <div class="col-md-12">
                <input type="text" class="form-control" name="price" id="price" placeholder="Price of Item" value="{{ $expense->price }}">
                <span class="help-block"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 form-label">{{trans('core.paidBy')}}:<span class="required"> * </span></label>

            <div class="col-md-12">
                <select class="form-control select2me" name="employee_id">
                    @foreach($employees as $employee)
                    <option value="{{$employee->id}}" @if($employee->id==$expense->employee_id)selected='selected'@endif >{{$employee->full_name}} (@lang('core.empId'): {{ $employee->employeeID }})</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 form-label mx-3">@lang("core.attachBill"):</label>
            <input type="hidden" name="billhidden" value="{{$expense->bill}}">

            <div class="col-md-12">
                <div class="fileinput fileinput-new col-lg-12" data-provides="fileinput">
                    <div class="input-group input-large">
                        <div class="form-control uneditable-input " data-trigger="fileinput">
                            <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                            </span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                            <span class="fileinput-new">
                                {{trans('core.selectFile')}} </span>
                            <span class="fileinput-exists">
                                {{trans('core.change')}} </span>
                            <input type="file" name="bill">
                        </span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#" class="input-group-addon btn btn-danger fileinput-exists" data-dismiss="fileinput">
                            {{trans('core.remove')}} </a>
                    </div>

                </div>
            </div>
            <div class="col-md-12 mx-3">    
                @if($expense->bill!='')
                <a href="{{$expense->bill_url}}" target="_blank" class="btn btn-info">@lang("core.viewBill")</a>
                @endif
            </div>

        </div>
        <div class="form-group">
            <label class="col-md-2 form-label">{{trans('core.status')}}:<span class="required">
                    * </span></label>

            <div class="col-md-12">
                <div class="radio-list">
                    <label class="radio-inline"><input type="radio" name="status" @if($expense->status=='approved') checked
                        @endif class="icheck"
                        value="approved"> {{trans('core.approved')}}
                    </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="radio-inline"><input type="radio" name="status" @if($expense->status=='pending') checked
                        @endif class="icheck"
                        value="pending"> {{trans('core.pending')}}
                    </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="radio-inline"><input type="radio" name="status" @if($expense->status=='rejected') checked
                        @endif class="icheck"
                        value="rejected"> {{trans('core.rejected')}}
                    </label>
                </div>
            </div>
        </div>


        <!-- END FORM-->

    </div>


    <div class="form-group text-center my-2">
        <button type="button" data-loading-text=" {{trans('core.btnUpdating')}}..." class=" btn btn-primary" id="expenseUpdate" onclick="ajaxUpdateExpense({{$expense->id}})"><i class="fal fa-edit"></i> {{trans('core.btnUpdate')}} </button>

    </div>


    {!! Form::close() !!}
</div>

<script>
    jQuery(document).ready(function() {
        ComponentsPickers.init();
            $.fn.select2.defaults.set("theme", "bootstrap");
            $('.select2').select2({
                placeholder: "Select",
                width: '100%',
                allowClear: false
            });

    });
    function ajaxUpdateExpense(id) {
            var url = "{{ route('admin.expenses.update',':id') }}";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '.ajax_form',
                file: true,
                
            });
            $('#data-model').modal('hide');
            $('#expenses').DataTable().ajax.reload();
        }
</script>