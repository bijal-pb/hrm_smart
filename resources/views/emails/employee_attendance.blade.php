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
    <br /><br /> 
    <strong>Employee Attendance</strong>
    <br /><br/>
    <table style="width:100%;border-collapse:collapse;border-spacing:0;border-color:#aaa;margin:0px auto">
            <tr>
                <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:bolder; padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#FCFBE3">Employee name</td>
                <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:bolder; padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#FCFBE3">Total Days</td>
                <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:bolder; padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#FCFBE3">Absent Days</td>
                <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:bolder; padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#FCFBE3">Present Days</td>
            </tr>
            @foreach ($data as $empatt)
            <tr>
                <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff">{{$empatt['emp_name']}}</td>
                <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;">{{$empatt['total_day']}}</td>
                <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;">{{$empatt['absent_days']}}</td>
                <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;">{{$empatt['present']}}</td>
            </tr>
            @endforeach
    </table>
@stop





