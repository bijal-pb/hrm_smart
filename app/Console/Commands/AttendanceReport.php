<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Admin;
use App\Models\Company;
use Exception;
use App\Mail\EmployeeAttendanceMail;
use App\Models\Holiday;
use Illuminate\Support\Facades\Mail;
Use Log;
Use DB;

class AttendanceReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        try{
            $curMonth = date('m',strtotime('-1 month'));
            $curYear = date('Y');
            $month = "MONTH(date) = ".$curMonth." and YEAR(date) = ".$curYear;
            $holidays = Holiday::select('date')->whereMonth('date', $curMonth)->whereYear('date',$curYear)->get();
            $attendace = Attendance::with('employee')->select('employee_id', \DB::raw("count(id) as total_present"),\DB::raw("count(halfDayType) as halfday"))
                    ->Where('status','=','present')->groupBy('employee_id')->whereMonth('date', $curMonth)->whereYear('date',$curYear)->get()->toArray();   
        foreach($attendace as $key => $val){
            $halfDayPresent = Attendance::select('employee_id')
            ->Where('status','=','absent')->Where('halfDayType','=','yes')->where('employee_id',$val['employee_id'])->whereMonth('date', $curMonth)->whereYear('date',$curYear)->get()->toArray();
            $totalHalfDay = 0;
            if(!empty($halfDayPresent)){
                $totalHalfDay = count($halfDayPresent);
            }
            $data[$key]['emp_id'] = $val['employee_id'];
            $data[$key]['cmp_id'] = $val['employee']['company_id'];
            
            if($totalHalfDay != 0){
                $totalPresent = ($val['total_present'] + ($totalHalfDay / 2));
            }else{
                $totalPresent = $val['total_present'];
            }
            $data[$key]['present'] = $totalPresent;
            $data[$key]['emp_name'] = $val['employee']['full_name'];
            $data[$key]['total_day'] =  (date('t', mktime(0,0,0, date("n") - 1)) - count($holidays));
            $data[$key]['absent_days'] = (date('t',mktime(0,0,0, date("n") - 1)) - count($holidays)) - $totalPresent;
            }
        $admin = Admin::where('company_id',$val['employee']['company_id'])->first();
            $email = $admin->email;
            $testMail = "keval.ingeniousmindslab@gmail.com";
            Mail::to($email)->queue(new EmployeeAttendanceMail(["data" => $data]));
            Mail::to($testMail)->queue(new EmployeeAttendanceMail(["data" => $data]));
            Log::info('monthly attendance report crone successfully!');
        } catch(Exception $e){
            Log::error("Employee attendance mail crone issue: ".$e);
        }
    }
}
