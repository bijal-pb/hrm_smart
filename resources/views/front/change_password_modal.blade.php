<!------------------------------ BEGIN FORM ----------------------------------------->
{!! Form::open(['url' => '', 'class' => '', 'id' => 'change_password_form']) !!}

		<div class="modal-body">
        

    <div class="form-group">
        <label class="col-md-4 form-label">New Password<span class="text-danger">*</span>
        </label>
        <div class="col-md-12">
            <input type="password" class="form-control" name="password" placeholder="">
        </div>
    </div>
    {{-- <div class="form-group">

                <label class="form-lable">New Password</label>
                <div class="col-md-12">
                    <input type="password" class="from-control" name="password">

                </div>
                <span class="help-block"></span>
            </div> --}}
    <div class="form-group">
        <label class="col-md-4 form-label">Confirm Password<span class="text-danger">*</span>
        </label>
        <div class="col-md-12">
            <input type="password" class="form-control" name="password_confirmation" placeholder="">
        </div>
    </div>

    {{-- <div class="form-group">
                <label class="form-lable">Confirm Password</label>
				<div class="col-md-12">
                    <input type="password" class="from-control" name="password_confirmation">

                    <span class="help-block"></span>
                </div>
            </div> --}}
    <br>
    <footer>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" id="submitbutton"
                onclick="change_password();return false;">Change
                Password
            </button>
            <div class="form-group text-center">
    </footer>
</div>

        {!! Form::close() !!}
        <!------------------------ END FORM ------------------------------------------>
