<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
        <div class="d-block position-absolute pos-top pos-left p-3 ">
            <h4 class="modal-title"><strong><i class="fal fa-database"></i>
                    @lang("pages.expenses.indexTitle")</strong></h4>
        </div>
    </div>
    <div class="modal-body">
        {!! Form::open(['class' => ' ajax_form', 'id' => 'expenses_form', 'files' => true]) !!}

        <div class="form-group">
            <label class="col-md-4 control-label">Name of item</label>
            <div class="col-md-12">
                <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Item">
            </div>
            <!-- <div class="col col-8">
                            <label class="input">
                                <input type="text" name="item_name" placeholder="Item" class="form-control">
                            </label>
                        </div> -->
            <span class="help-block"></span>
        </div>



        <div class="form-group">

            <label class="col-md-4 control-label">Location of purchase</label>
            <div class="col-md-12">
                <input type="text" class="form-control" name="purchase_from" id="purchase_from" placeholder="Purchased From">
            </div>
            <!-- <div class="col col-8">
                            <label class="input">
                                <input type="text" name="purchase_from" class="form-control"
                                       placeholder="Purchased From">
                            </label>
                        </div> -->
            <span class="help-block"></span>
        </div>



        <div class="form-group">

            <label class="col-md-4 control-label">Price</label>
            <div class="col-md-12">
                <input type="text" class="form-control" name="price" id="price" placeholder="Price">
            </div>
            <!-- <div class="col col-8">
                            <label class="input">
                                <input type="text" name="price" placeholder="Price"
                                       value="{{ old('price') }}">
                            </label>
                        </div> -->
            <span class="help-block"></span>
        </div>



        <div class="form-group">
            <label class="col-md-4 control-label">Date of purchase</label>
            <div class="col-md-12">
                
                    <input type="text" name="purchase_date" placeholder="Date of purchase" class="form-control" id="purchase_date" value="{{ old('purchase_date') }}">

            </div>
            <span class="help-block"></span>
        </div>


        <div class="form-group">

            <label class="col-md-4 control-label">Bill</label>
            <div class="col-md-12">
                <input type="file" name="bill" class="form-control">
            </div>
            <span class="help-block"></span>
        </div>
        <footer>
            <div class="form-group text-center">
                <button type="button" onclick="ajaxCreateExpense();return false;" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </footer>
        {!! Form::close() !!}
        <!-- End Reg-Form -->
    </div>

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
    $('#purchase_date').datepicker({
            prevText: '<i class="fa fa-angle-left"></i>',
            nextText: '<i class="fa fa-angle-right"></i>',
        });
</script>