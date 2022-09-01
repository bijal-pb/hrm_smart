<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
        <div class="d-block position-absolute pos-top pos-left p-3 ">
            <h4 class="modal-title"><strong><i class="fal fa-database"></i>
            @lang("pages.expenses.indexTitle")</strong></h4>
        </div>
    </div>
    <div class="modal-body">
        {!! Form::open(array('route'=>"admin.expenses.store",'class'=>'form-horizontal ajax_form','method'=>'POST','files'=>true))!!}

        <!-- BEGIN FORM-->


        <div class="form-body">

            <div class="form-group">
                <label class="col-md-4 control-label">{{trans('core.item')}} {{trans('core.name')}}: <span class="required">
                        * </span>
                </label>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="item_name" id="item_name" placeholder="{{trans('core.item')}} {{trans('core.name')}}" value="{{ old('item_name') }}">
                </div>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">{{trans('core.purchase_from')}}
                </label>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="purchase_from" placeholder="{{trans('core.purchase_from')}}" value="{{ old('purchase_from') }}">
                </div>
            </div>

            <div class="form-group">
            <div class="col-md-12">
            <label class="form-label" for="example-date">{{trans('core.date')}}:</label>
                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fal fa-calendar"></i>
                            </button>
                        </span>
                        <input class="form-control" id="purchase_date"  name="purchase_date">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">{{trans('core.price')}}:<span class="required"> * </span> {{$loggedAdmin->company->currency_symbol}}</label>

                <div class="col-md-12">
                    <input type="text" class="form-control" name="price" id='price' placeholder="{{trans('core.price')}}" value="{{ old('price') }}">
                </div>
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">{{trans('core.paidBy')}}:<span class="required"> * </span></label>

                <div class="col-md-12">
                    <select class="form-control select2me" name="employee_id">
                        @foreach($employees as $employee)
                        <option value="{{$employee->id}}">{{$employee->full_name}} (@lang('core.empId'): {{ $employee->employeeID }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Attach Bill:</label>

                <div class="col-md-12">
                    <div class="fileinput fileinput-new col-lg-12" data-provides="fileinput">
                        <div class="input-group input-large">
                            <div class="form-control uneditable-input" data-trigger="fileinput">
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
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="input-group-addon btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                {{trans('core.remove')}} </a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">{{trans('core.status')}}:<span class="required"> * </span></label>

                <div class="col-md-12">
                    <div class="radio-list">
                        <label class="radio-inline">
                            <input type="radio" name="status" class="icheck" value="approved" checked="checked"> {{trans('core.approved')}} </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="radio-inline"><input type="radio" name="status" class="icheck" value="pending"> {{trans('core.pending')}}
                        </label>
                    </div>
                </div>
            </div>


            <!-- END FORM-->

        </div>


        <div class="form-group text-center">
            <button type="button" id="expenseCreate" class="btn btn-primary" onclick="ajaxCreateExpense()"><i class="fal fa-check"></i> {{trans('core.add')}}
            </button>

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

    function ajaxCreateExpense() {
            var url = "{{ route('admin.expenses.store') }}";
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '.ajax_form',
                file: true,
            });
           location.reload();
        }

    </script>