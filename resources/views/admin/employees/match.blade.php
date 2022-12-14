@extends('admin.adminlayouts.adminlayout')

@section('head')
    {!! HTML::style('assets/global/plugins/uniform/css/uniform.default.min.css')!!}
    {!! HTML::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')!!}
    {!! HTML::style('assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css')!!}
    {!! HTML::style('assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css')!!}
@stop


@section('content')

        <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
                {{ trans('pages.employees.importTitle')}}
            </h1></div>
    </div>
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a onclick="loadView('{{route('admin.dashboard.index')}}')">{{trans('core.dashboard')}}</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a onclick="loadView('{{route('admin.employees.index')}}')">{{ trans("pages.employees.indexTitle") }}</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">{{ trans('pages.employees.importTitle')}}</span>
        </li>
    </ul>
    <!-- END PAGE HEADER-->

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet light bordered" id="beforeSubmitting">
                <div class="portlet-title">
                    <div class="caption red-sunglo">
                        <i class="fa fa-bars font-red-sunglo"></i> @lang('pages.employees.matchColumns')
                    </div>
                </div>

                <div class="portlet-body form">
                    <form class="form-horizontal">
                        <div class="form-body">
                            <p>@lang("messages.matchColumnMessage")</p>
                            <div class="alert alert-success" id="getUnMatchedSuccess" style="display: none;">
                                @lang("messages.columnMatchSuccess")
                            </div>
                            <div class="alert alert-danger" id="requiredColumnsUnmatched" style="display: none;">
                                @lang("messages.requiredColumnsUnmatched")
                            </div>
                                <div class="col-md-6">
                                    <b>@lang("messages.unmatchedColumns", ["unmatchCount" => $unmatchCount])</b> ?? <a href="javascript:void(0);" onclick="skipall()">@lang("core.skipAll")</a>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="pull-right">
                                            <label>
                                                <input type="checkbox" id="showSkipped" checked="checked">
                                                @lang("core.showSkippedColumns")
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            <div class="row">
                                <div class="col-sm-12" style="overflow-x: scroll;">
                                    <table>
                                        <tbody>
                                            <tr>
                                                @if(sizeof($csvHeadingFields) > 0)
                                                    @foreach($csvHeadingFields as $key1 => $value1)
                                                        <td>
                                                            <div class="row leadBox {{ ($matchedColumnsDetail[$key1] == -1) ? "unmatched" : "matched"  }}" id="box_{{ $key1 }}">
                                                                <div class="leadOptions">
                                                                    <div class="selectColumnNameBox" id="selectColumnNameBox_{{ $key1 }}" style="display:none;">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label class="control-label">Column Name</label>
                                                                                <div id="selectOptionList_{{ $key1 }}">
                                                                                    @if($matchedColumns[$key1] == TRUE)
                                                                                        <select id="columnName_{{ $key1 }}" class="form-control input-sm mb15">
                                                                                            <option value="{{ $matchedColumnsDetail[$key1] }}">{{ $formColumnDetailsByID[$matchedColumnsDetail[$key1]] }}</option>
                                                                                        </select>
                                                                                    @else
                                                                                        <select id="columnName_{{ $key1 }}" class="form-control input-sm mb15">
                                                                                            <option value="-1">@lang("core.selectAColumn")</option>
                                                                                        </select>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div><!-- col-sm-12 -->

                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <button onclick="goBack({{ $key1 }})" class="btn btn-info btn-sm" type="button">@lang("core.btnBack")</button>
                                                                                <button onclick="saveColumnBox({{ $key1 }})" class="btn btn-white btn-sm" type="button">@lang("core.btnSave")</button>
                                                                                <a href="javascript:void(0);" onclick="skipColumnBox({{ $key1 }})">@lang("core.skip")</a>
                                                                            </div>
                                                                        </div><!-- col-sm-12 -->
                                                                    </div>

                                                                    <div class="row columnDescriptionBox" id="columnDescriptionBox_{{ $key1 }}">
                                                                        <div class="col-sm-12">
                                                                            <h4 id="columnDescriptionBoxColumnName_{{ $key1 }}">{{ $value1 }}</h4>
                                                                            <p id="columnDescriptionBoxText_{{ $key1 }}">
                                                                                @if($matchedColumns[$key1] == TRUE)
                                                                                    {{ $formColumnDetailsByID[$matchedColumnsDetail[$key1]] }}
                                                                                @else
                                                                                    <span class="unmatchedWarning" id="unmatchedWarning_{{$key1}}">(unmatched column)</span>
                                                                                @endif
                                                                            </p>
                                                                            <p class="alert alert-warning notimported" id="columnSkipBox_{{ $key1 }}" style="display:none;">@lang("core.willNotBeImported")</p>
                                                                        </div><!-- col-sm-12 -->
                                                                    </div>

                                                                    <div class="row editAndSkipBox" id="editAndSkipBox_{{ $key1 }}">
                                                                        <div class="col-sm-12">
                                                                            <a href="javascript:void(0);" onclick="showColumnBox({{ $key1 }})">@lang("core.edit")</a>&nbsp;
                                                                            <a href="javascript:void(0);" onclick="skipColumnBox({{ $key1 }})" id="skipButton_{{ $key1 }}">@lang("core.skip")</a>
                                                                        </div><!-- col-sm-12 -->
                                                                    </div>
                                                                </div>

                                                                <div class="leadSamples">
                                                                    <p class="sampleHeading">{{ $value1 }}</p>
                                                                    @if(sizeof($csvFields[$key1]) > 0)
                                                                        @foreach($csvFields[$key1] as $key2 => $value2)
                                                                            <p class="sample">{{ $value2 }}</p>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary" type="button" disabled onclick="submitMatch()" id="submit">@lang("core.btnSubmit")</button>&nbsp;
                                    <button type="button" class="btn btn-default" onclick="cancelImportData()">@lang("core.btnCancel")</button>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>

        <div class="portlet light bordered" id="afterSubmitting" style="display:none">
            <div class="portlet-title">
                <div class="caption">Processing</div>
            </div><!-- panel-heading-->
            <div class="portlet-body">
                <div id="progressError" style="display: none"></div>
                <p>Import in progress... <strong id="progressAmount">Please wait...</strong></p>
                <div class="progress progress-striped active">
                    <div id="processingBarStatus" class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" >
                        <span class="sr-only">40% Complete (success)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section("page_js")
    {!! HTML::script('assets/global/plugins/uniform/jquery.uniform.min.js')!!}
    <script type="text/javascript">

        // Current column being edited
        var columnID = 0;

        //    var matchedColumnsDetailArray = [];

        // Fields associated with this lead
        var jsColumnArray = $.parseJSON('{!! addslashes(json_encode($leadFields)) !!}');
        var currentLeadColumnID = jsColumnArray[0].id; // By default column 0 is selected

        // Array to store matched columns. ith element tells that Column i of the CSV matches with which field
        // of the lead. Initially each columns is matched serially with columns in the CSV
        var jsMatchedColumnArray = $.parseJSON('{!! addslashes(json_encode($matchedColumnsDetail)) !!}');

        // Array to indicate which of the leads columns have been matched
        var leadsMatchedColumns = $.parseJSON('{!! addslashes(json_encode($leadMatchedColumns)) !!}');

        $(document).ready(function() {
            // Show first column box for editing
            var unmatched = getUnMatched();
            $("#unmatchedCount").html(unmatched);

            if(getUnMatched() == 0) {
                $("#getUnMatchedSuccess").show();
                $("#submit").removeAttr("disabled");
            }
            else {
                showColumnBox(columnID);
            }
        });

        // Generate the select control for this column box
        function generateSelectList(columnID)
        {
//        var selectedColumnID = $('#columnName_'+columnID+' option:selected').val();

            // So that we can select column if user edits it
            var selectedColumnID = jsMatchedColumnArray[columnID];

            var text = '<select id="columnName_'+columnID+'" class="form-control input-sm mb15">' +
                    '<option value="-1">@lang("core.selectAColumn")</option>';

            for(var i=0; i < jsColumnArray.length; i++)
            {
                var id = jsColumnArray[i]['id'];
                var name = jsColumnArray[i]['name'];


                if(leadsMatchedColumns[id] != undefined && leadsMatchedColumns[id] != -1 && selectedColumnID != id ) {
                    // This means this column is matched. We should not show this column
                    continue;
                }

                if(selectedColumnID == id)
                {
                    text += '<option value="'+id+'" selected>'+name+'</option>';
                }else{
                    text += '<option value="'+id+'">'+name+'</option>';
                }

            }

            text += "</select>";

            return text;
        }

    </script>

    <script type="text/javascript">

        function showColumnBox(columnID) {
            // Hide all other edit boxes
            $(".selectColumnNameBox").hide();
            $(".editAndSkipBox").show();
            $(".columnDescriptionBox").show();

            // Show hide for this column
            $('#skipButton_' + columnID).show();
            $('#columnSkipBox_' + columnID).hide();
            $('#editAndSkipBox_' + columnID).hide();
            $('#columnDescriptionBox_' + columnID).hide();
            $('#selectColumnNameBox_' + columnID).show();

            // Hide back button for first column
            if (columnID == 0) {
                $("#selectColumnNameBox_" + columnID + " .btn-info").hide();
            }

            var selectedOption = $('#columnName_' + columnID + ' option:selected');
            var selectedColumnID = selectedOption.val();
            currentLeadColumnID = selectedColumnID;
            var columnName = selectedOption.text();

            var selectListText = generateSelectList(columnID);

            $('#selectOptionList_' + columnID).html(selectListText);
        }

        function hideColumnBox(columnID) {
            // Show hide for this column
            $('#skipButton_' + columnID).show();
            $('#columnSkipBox_' + columnID).hide();
            $('#editAndSkipBox_' + columnID).hide();
            $('#columnDescriptionBox_' + columnID).hide();
            $('#selectColumnNameBox_' + columnID).show();

            if (jsMatchedColumnArray[columnID] == -2) {
                $('#columnSkipBox_' + columnID).show();
            }

        }

        function goBack(columnID) {
            $('#skipButton_' + columnID).show();
            $('#columnSkipBox_' + columnID).hide();
            $('#selectColumnNameBox_' + columnID).hide();
            $('#editAndSkipBox_' + columnID).show();
            $('#columnDescriptionBox_' + columnID).show();

            if (jsMatchedColumnArray[columnID] == -2) {
                $('#columnSkipBox_' + columnID).show();
            }

            while (jsMatchedColumnArray[--columnID] == -2);

            showColumnBox(columnID);
        }

        function saveColumnBox(columnID) {
            var selectedOption = $('#columnName_' + columnID + ' option:selected');
            var selectedColumnID = selectedOption.val();

            if (selectedColumnID == "-1") {
                showToastrMessage("@lang("messages.pleaseSelectAColumn")", "@lang("core.error")", "error");
            }
            else {
                var columnName = selectedOption.text();

                // Now this column is matched. So we can save it in leadsMatchedColumns array
                leadsMatchedColumns[selectedColumnID] = 1;
                jsMatchedColumnArray[columnID] = selectedColumnID;

                $('#skipButton_' + columnID).show();

                $('#columnSkipBox_' + columnID).hide();
                $('#columnDescriptionBoxText_' + columnID).html(columnName);
                $('#selectColumnNameBox_' + columnID).hide();
                $('#columnDescriptionBox_' + columnID).show();
                $('#columnDescriptionBoxText_' + columnID).show();
                $('#editAndSkipBox_' + columnID).show();
                $('#unmatchedWarning_' + columnID).hide();

                $('#box_' + columnID).removeClass('unchanged unmatched').addClass('matched');

                // Skip skipped columns
                while (jsMatchedColumnArray[++columnID] == -2);
                var unmatched = getUnMatched();
                $("#unmatchedCount").html(unmatched);

                if (unmatched == 0) {
                    var requiredMatched = checkRequiredMatch();
                    if (requiredMatched.length == 0) {
                        $("#getUnMatchedSuccess").show();
                        $("#requiredColumnsUnmatched").hide();
                        $("#submit").removeAttr("disabled");
                    }
                    else {
                        var str = lodash.join(lodash.map(requiredMatched, 'name'), ', ');
                        var msg = "@lang("messages.requiredColumnsUnmatched")";
                        msg = msg.replace(":columns", str);
                        $("#getUnMatchedSuccess").hide();
                        $("#requiredColumnsUnmatched").html(msg).show();
                    }
                }
                else {
                    showColumnBox(columnID);
                }
            }

        }

        function skipColumnBox(columnID) {
            var selectedOption = $('#columnName_' + columnID + ' option:selected');
            var selectedColumnID = selectedOption.val();
            var columnName = selectedOption.text();

            if (currentLeadColumnID == -1) {
                if (jsMatchedColumnArray[columnID] != -1)
                    leadsMatchedColumns[jsMatchedColumnArray[columnID]] = -1;
                else {
                    jsMatchedColumnArray[columnID] = -2;
                }
            } else {
                leadsMatchedColumns[currentLeadColumnID] = -1;
                jsMatchedColumnArray[columnID] = -2;
            }

            $('#selectOptionList_' + columnID).html("");

            $('#columnDescriptionBox_' + columnID).show();
            $('#selectColumnNameBox_' + columnID).hide();
            $('#columnDescriptionBoxText_' + columnID).hide();
            $('#skipButton_' + columnID).hide();

            $('#columnSkipBox_' + columnID).show();
            $('#editAndSkipBox_' + columnID).show();
            $('#unmatchedWarning_' + columnID).hide();


            $('#box_' + columnID).removeClass('matched unchanged').addClass('unmatched');

            // Skip skipped columns
            while (jsMatchedColumnArray[++columnID] == -2);
            var unmatched = getUnMatched();
            $("#unmatchedCount").html(unmatched);

            if (unmatched == 0) {
                var requiredMatched = checkRequiredMatch();
                if (requiredMatched.length == 0) {
                    $("#getUnMatchedSuccess").show();
                    $("#requiredColumnsUnmatched").hide();
                    $("#submit").removeAttr("disabled");
                }
                else {
                    var str = lodash.join(lodash.map(requiredMatched, 'name'), ', ');
                    var msg = "@lang("messages.requiredColumnsUnmatched")";
                    msg = msg.replace(":columns", str);
                    $("#getUnMatchedSuccess").hide();
                    $("#requiredColumnsUnmatched").html(msg).show();
                }
            }
            else {
                showColumnBox(columnID);
            }

        }

        $("#showSkipped").click(function (e) {
            if (this.checked) {
                $(".unmatched").show();
            }
            else {
                $(".unmatched").hide();
            }
        });

        function contains(array, value) {
            for (var i = 0; i < array.length; i++) {
                if (array[i] == value) {
                    return true;
                }
            }
            return false;
        }

        function checkRequiredMatch() {

            var requiredNotMatched = [];

            // Check if all required columns are matched
            for (var i = 0; i < jsColumnArray.length; i++) {
                if (jsColumnArray[i]["required"] == "Yes") {
                    if (!contains(jsMatchedColumnArray, jsColumnArray[i]["id"])) {
                        requiredNotMatched.push(jsColumnArray[i]);
                    }
                }
            }

            return requiredNotMatched;
        }

        function submitMatch() {

            var newData = JSON.stringify(jsMatchedColumnArray);

            $('#beforeSubmitting').hide();
            $('#afterSubmitting').show();
            $('#processingBarStatus').width('1%');
            $("body").animate({scrollTop: 0}, 200);

            var pingTimer = 0;

            $.ajax({
                type: "POST",
                url: "{{ URL::route('admin.employees.importProcess') }}",
                data: {"sorting": newData}
            }).done(
                function (response) {
                    clearInterval(pingTimer);
                    var obj = jQuery.parseJSON(response);

                    if (obj.status == "success") {
                        $('#processingBarStatus').width('100%');
                        loadView("{{ URL::route('admin.employees.failed_records') }}");
                    }
            }).fail(function (response) {
                $("#progressError").html("{!! addslashes(trans("messages.importFail")) !!}").show();
                clearInterval(pingTimer);
            });


            pingTimer = setInterval(function () {
                $.ajax({
                    type: "POST",
                    url: "{{ URL::route('admin.employees.checkImportProgress') }}",
                    data: {}
                }).done(
                        function (response) {
                            $('#processingBarStatus').width(response + '%');
                            $("#progressAmount").html(Math.ceil(response) + "% Completed");
                        });
            }, 5000);


        }

        function getUnMatched() {
            var matched = 0;
            for (var i = 0; i < jsMatchedColumnArray.length; i++) {
                if (jsMatchedColumnArray[i] == -1) {
                    matched++;
                }
            }
            return matched;
        }

        function skipall() {
            for (var i = 0; i < jsMatchedColumnArray.length; i++) {
                if (jsMatchedColumnArray[i] == -1) {
                    skipColumnBox(i);
                }
            }
        }

        function cancelImportData() {
            $.ajax({
                type: "POST",
                url: "{{ URL::route('admin.employees.cancelImport') }}",
                data: {}
            }).done(
                function (response) {
                    loadView("{{ URL::route('admin.employees.index') }}");
            });
        }
    </script>
@endsection