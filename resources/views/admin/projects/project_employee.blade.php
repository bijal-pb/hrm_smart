<div class="subheader">
    <h1 class="subheader-title">
        <i class=" subheader-icon fal fa-user-plus"></i>Project Employee<span class='fw-300'></span> <sup
            class='badge badge-primary fw-500'></sup>
        {{-- <small>
            Insert page description or punch line
        </small> --}}
    </h1>
</div>
<!-- Your main content goes below here: -->
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    <i class="fal fa-user-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp; Project Employee <span
                        class="fw-300"><i></i></span>
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                        data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                        data-offset="0,10" data-original-title="Fullscreen"></button>
                    {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                </div>
            </div>
            <div class="panel-container show">
                {{-- <a class="btn btn-primary float-right m-3" id="btn-add" href=" {{ route('admin.projects.create') }} ">
                        Add Project
                    </a> --}}
                <div class="panel-content">

                    <table id="project-employee-table"
                        class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline">
                        <thead class="bg-primary-600">
                            <tr>
                                <th>Id </th>
                                <th>Project Name </th>
                                <th>Employee</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Partial</th>
                                <th>Fulltime</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.common.delete')
<script type="text/javascript">
    function del(id, name) {

        $('#deleteModal').modal('show');

        $("#deleteModal").find('#info').html('Are you sure ! You want to delete <strong>' + name +
            '</strong> ?');

        $('#deleteModal').find("#delete").off().click(function() {

            var url = "{{ route('admin.project_employees.destroy', ':id') }}";
            url = url.replace(':id', id);

            var token = "{{ csrf_token() }}";

            $.ajax({
                type: 'DELETE',
                url: url,
                data: {
                    '_token': token
                },
                container: "#deleteModal",
                success: function(response) {
                    if (response.status == "success") {
                        $('#deleteModal').modal('hide');
                        toastr['success']('Deleted successfully!');
                        window.location.reload();
                        // table.fnDraw();
                    }
                }
            });

        });
    }
</script>
