<table id="dt-basic-example" class="table table-striped custom-table m-b-0">
    <thead>
    <tr>
        <th style="text-align:center;">Employee</th>
        @for($i =1; $i <= $daysInMonth; $i++)
            @if(date('D', strtotime($year.'-'.$month.'-'.$i)) == 'Sun' || date('D', strtotime($year.'-'.$month.'-'.$i)) == 'Sat')
            <th style="color: red; text-align:center;">{{ $i }} <br>{{ date('D', strtotime($year.'-'.$month.'-'.$i)) }}</th>
            <th></th>
            <th></th>
            @else
            <th style="text-align:center;">{{ $i }} <br> {{ date('D', strtotime($year.'-'.$month.'-'.$i)) }}</th>
            <th> IN </th>
            <th> OUT </th>
            @endif
        @endfor
        <th style="text-align:center;"> Total Working Day</th>
        <th style="text-align:center;"> Total Present Day</th>
    </tr>
    </thead>
    <tbody>
        {{-- {{ print_r($employeeAttendence)}}    --}}
    @foreach($employeeAttendence as $key => $attendance)
        <tr>
            <td style="text-align:center;"> {{ substr($key, strripos($key,'#')+strlen('#')) }} </td>
            @foreach($attendance as $day)
                <td style="text-align:center;">{!! $day !!}</td>
                <td>{{ $in[$key][$loop->iteration] }} </td>
                <td>{{ $out[$key][$loop->iteration] }}</td>
            @endforeach
            <td style="text-align: center">{{$workingDays }}</td>
            <td style="text-align: center">{{ $presentCounts[$loop->index] }}
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
