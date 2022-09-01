<table id="dt-basic-example" class="table table-striped custom-table m-b-0">
    <thead>
    <tr>
        <th style="text-align:center;">Employee</th>
        @for($i =1; $i <= $daysInMonth; $i++)
            <th style="text-align:center;">{{ $i }} <br> {{ date('D', strtotime($year.'-'.$month.'-'.$i)) }}</th>
        @endfor
    </tr>
    </thead>
    <tbody>
        {{-- {{ print_r($employeeAttendence)}}    --}}
        {{-- {{ print_r($employeeProject)}}  --}}
    @foreach($employeeProject as $key => $project)
        <tr>
            
            <td style="text-align:center;"> {{ substr($key, strripos($key,'#')+strlen('#')) }} </td>
            @foreach($project as $p)
                <td style="text-align:center;">{!! $p !!}</td>   
            @endforeach
          
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).ready(function()
            {
                $('#dt-basic-example').dataTable(
                {
                    bFilter: false,
                    scrollY: 400,
                    scrollX: true,
                    scrollCollapse: true,
                    paging: false,
                    "ordering": false,
                
                    fixedColumns:
                    {
                        leftColumns: 1
                    },
        
                });
            });

</script>
