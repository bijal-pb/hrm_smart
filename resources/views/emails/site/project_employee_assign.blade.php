@extends('front.layouts.email_layout')

@section('email_content')
    <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;border-color:#aaa;margin:0px auto;}
        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;}
        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#f38630;}
        .tg .tg-0ord{text-align:right}
        .tg .tg-s6z2{text-align:center}
        .tg .tg-z2zr{background-color:#FCFBE3}
        .tg .tg-gyqc{background-color:#FCFBE3;text-align:right}
    </style>
    <strong>Hello {{ $employee->full_name }}</strong> 

    <br /><br/>

    <table style="width:100%;border-collapse:collapse;border-spacing:0;border-color:#aaa;margin:0px auto">
        <tr>
            <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#6da6b4;text-align:center" colspan="6">Project</th>
            <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#6da6b4;text-align:center" colspan="6">Start Date</th>
            <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#6da6b4;text-align:center" colspan="6">End Date</th>
            <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#6da6b4;text-align:center" colspan="6">Start Time</th>
            <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#6da6b4;text-align:center" colspan="6">End Time</th>

        </tr>

        <tr>
            <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#e998ca;text-align:center" colspan="6"> {{ $project->name }} </td>
            <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#e998ca;text-align:center" colspan="6"> {{ $start_date }} </td>
            <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#e998ca;text-align:center" colspan="6"> {{ $end_date }} </td>
            <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#e998ca;text-align:center" colspan="6"> {{ $start_time }} </td>
            <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#e998ca;text-align:center" colspan="6"> {{ $end_time }} </td>
        </tr>

    </table>



    <br /><br />


@stop




