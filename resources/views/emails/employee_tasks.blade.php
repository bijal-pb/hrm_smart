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
    
    @foreach ($data as $taskData)
    <br /><br /> 
    <strong>{{$taskData['employee_name']}}</strong> Tasks
    <br /><br/>

    <table style="width:100%;border-collapse:collapse;border-spacing:0;border-color:#aaa;margin:0px auto">
            <tr>
                <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#FCFBE3">Project</td>
                <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#FCFBE3">Title</td>
                <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#FCFBE3">Description</td>
                <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#FCFBE3">Hour</td>
                <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#FCFBE3">Status</td>
                <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#FCFBE3">Date</td>
            </tr>

            @foreach ($taskData['tasks'] as $task)
                <tr>
                    <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff">{{$task['project']['name']}}</td>
                    <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;">{{$task['title']}}</td>
                    <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;">{{$task['description']}}</td>
                    <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;">{{$task['hour']}}</td>
                    <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;">{{$task['status']}}</td>
                    <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;">{{$task['date']}}</td>
                </tr>
            @endforeach
    </table>
    @endforeach
    <br /><br />    
@stop




