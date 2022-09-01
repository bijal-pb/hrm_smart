<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\EmployeeTask;
use Carbon\Carbon;
use App\Mail\EmployeeTaskMail;
use App\Models\Admin;
use Illuminate\Support\Facades\Mail;
use Exception;
use Log;

class TaskMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All Employee task mail to admin';

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
            $tasks = EmployeeTask::with('project')->whereDate('date',$today)->get()->groupBy('employee_id')->toArray();
            $data = [];
            $i = 0;
            foreach($tasks as $employeeId => $employeeTasks)
            {
                $employee = Employee::with(['company'])->find($employeeId);
                $data[$i]['employee_name'] = $employee->full_name;
                $data[$i]['tasks'] = $employeeTasks;
                $i++;
            }
            
            if(count($data) > 0){
                $admin = Admin::where('company_id',$employee->company_id)->first();
                $email = $admin->email;
                $testMail = "hr.ingeniousmindslab@gmail.com";
                Mail::to($email)->queue(new EmployeeTaskMail(["data" => $data,"employee" => $employee]));
                Mail::to($testMail)->queue(new EmployeeTaskMail(["data" => $data,"employee" => $employee]));
            }
           // Log::info($data);
        } catch(Exception $e){
            Log::error("Employee Task mail crone issue: ".$e);
        }
    }
}
