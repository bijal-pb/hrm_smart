<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Holiday;
use App\Models\LeaveApplication;
use Carbon\Carbon;
use Exception;
use Log;

class AttendanceCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:attendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check employee attendance';

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
            $today = Carbon::now()->format('Y-m-d');

            // check today leave application which status are pending.
            $leaves = LeaveApplication::whereDate('start_date',$today)->where('application_status','pending')->get();
            
            foreach($leaves as &$leave_application)
            {
                $start = Carbon::createFromFormat("Y-m-d", $leave_application->start_date);
     
                if ($leave_application->end_date == null) {
                    $end = clone $start;
                } else {
                    $end = Carbon::createFromFormat("Y-m-d", $leave_application->end_date);
                }


                $diffDays = $end->diffInDays($start);
                $startDate = $start;
                
                for ($i = 0; $i <= $diffDays; $i++) {
                    $date = $startDate;
                    $attendance = Attendance::firstOrCreate(['date' => $date->format("Y-m-d"),
                        'employee_id' => $leave_application->employee_id]);

                    $attendance->leaveType = $leave_application->leaveType;
                    $attendance->halfDayType = $leave_application->halfDayType;
                    $attendance->reason = $leave_application->reason;
                    $attendance->status = 'absent';
                    $attendance->applied_on = $leave_application->applied_on;
                    $attendance->application_status = 'approved';
                    $attendance->save();
                    $startDate->addDays(1);
                }
                $leave_application->application_status = 'approved';
                $leave_application->save();
            }
            
            
            $employeeIds = Attendance::whereDate('date',$today)->pluck('employee_id')->toArray();
            
            $activeIds = Employee::where('status','active')->pluck('id')->toArray();
            $absentEmployees = array_diff($activeIds,$employeeIds);

            // find which entry clockout remaining, set half day!!
            $clockOutRemainings = Attendance::whereDate('date',$today)->whereNull('halfDayType')->whereNull('clock_out')->get();
            foreach($clockOutRemainings as $clockout)
            {
                $clockout->status = 'absent';
                $clockout->halfDayType = 'yes';
                $clockout->reason = 'Half Day (System Approval)';
                $clockout->save();
            }

            // if not apply leaves and not clock in and clockout that time entry as absent.
            $checkHoliday = Holiday::whereDate('date',$today)->first();
            if(!isset($checkHoliday)){
                foreach($absentEmployees as $empId){
                    $attendance = new Attendance;
                    $attendance->employee_id = $empId;
                    $attendance->date = $today;
                    $attendance->status = 'absent';
                    $attendance->reason = 'Absent - System Approval';
                    $attendance->save();
                }
                
            }

            
            // find which entry whose clock in and clock out and present.
            $presentEmployees = Attendance::whereDate('date',$today)->whereNotNull('clock_in')->whereNotNull('clock_out')->get();

            foreach($presentEmployees as $presentEmp)
            {
                // find hour difference
                $totalHours = ($presentEmp->clock_out)->diffInHours($presentEmp->clock_in);

                // if total hour is < 3 set fullday absent
                if($totalHours < 3)
                {
                    $presentEmp->status = 'absent';
                    $presentEmp->halfDayType = 'no';
                    $presentEmp->reason = 'Absent - System Approval';
                    $presentEmp->save();
                }
               
                // if total hour is between 3 to 6 set halfday absent
                if($totalHours >= 3 && $totalHours < 6)
                {
                    $presentEmp->status = 'absent';
                    $presentEmp->halfDayType = 'yes';
                    $presentEmp->reason = 'Half Day (System Approval)';
                    $presentEmp->save();
                }
            }
            Log::info("Attendance check crone run successfully!");

        } catch(Exception $e){
            Log::error("Attendance Check crone issue: ".$e);
        }

    }
}
