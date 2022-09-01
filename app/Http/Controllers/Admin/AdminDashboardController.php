<?php

namespace App\Http\Controllers\Admin;

//Admin Dashboard controller

use App\Http\Controllers\AdminBaseController;
use App\Models\Admin;
use App\Models\Attendance;
use App\Models\Award;
use App\Models\Department;
use App\Models\EmailTemplate;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Holiday;
use App\Models\Project;
use App\Models\ProjectEmployee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\AssignEmployee;

class AdminDashboardController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->dashboardActive = 'active';
        $this->pageTitle = trans("pages.dashboard.title");
    }

    // Dashboard view page   controller
    public function index()
    {
        if (\admin()->type == 'superadmin') {
            return Redirect::route('superadmin.dashboard.index');
        }
        //Expense Calculation
        $expense = DB::select(DB::raw("SELECT sum(price) as sum, m.months,u.status,employees.company_id
                    FROM `expenses` u JOIN employees on employees.id=u.employee_id
                    AND employees.company_id = '{$this->company_id}'
                    RIGHT JOIN (
                            SELECT 1 AS `months`
                            UNION SELECT 2 AS `months`
                            UNION SELECT 3 AS `months`
                            UNION SELECT 4 AS `months`
                            UNION SELECT 5 AS `months`
                            UNION SELECT 6 AS `months`
                            UNION SELECT 7 AS `months`
                            UNION SELECT 8 AS `months`
                            UNION SELECT 9 AS `months`
                            UNION SELECT 10 AS `months`
                            UNION SELECT 11 AS `months`
                            UNION SELECT 12 AS `months`
                            ) AS m
                    ON m.months = MONTH(u.purchase_date)
                    WHERE u.status = 'approved' OR u.status is null
                    GROUP BY m.months
                    ORDER BY m.months;"));

        foreach ($expense as $ex) {
            $expensevalue[$ex->months] = isset($ex->sum) ? $ex->sum : "''";
        }
        ksort($expensevalue);

        $this->expense = implode(',', $expensevalue);

        $this->employee_count = Employee::manager()
            ->count();

        $this->awards_count = Award::count();
        $this->project_count = Project::count();
        $this->inprogress_project_count = Project::where('status', '=', 'in progress')->count();
        $this->completed_project_count = Project::where('status', '=', 'completed')->count();
        $this->hold_project_count = Project::where('status', '=', 'hold')->orWhere('status', '=', 'not start')->count();

        $this->project_employees = ProjectEmployee::select('project_employees.id', 'employees.full_name as employee_name', 'projects.name as project_name', 'start_date', 'project_employees.end_date','employees.profile_image as profile_image')
            ->leftJoin('employees', 'project_employees.employee_id', 'employees.id')
            ->leftJoin('projects', 'project_employees.project_id', 'projects.id')
            ->whereBetween('project_employees.end_date',[Carbon::now()->format('Y-m-d'),Carbon::now()->addDays(7)->format('Y-m-d')])
            ->orderBy('project_employees.id', 'desc')
            ->where('employees.status', '=', 'active')
            ->get();

            foreach($this->project_employees as $d){
                $d->profile_image = URL::asset("/uploads/profile_images/".$d->profile_image);
            }
        
        $this->employees = Employee::manager()
            ->select('full_name', 'employees.id', 'employeeID')
            ->where('status', '=', 'active')->get();

        $this->projects = Project::orderBy('end', 'asc')->get();

        $this->department_count = Department::company($this->company_id)
            ->manager(admin()->id)
            ->count();

        $this->current_month_birthdays = Employee::currentMonthBirthday($this->company_id);

        $this->getSetupProgress();

        $this->awards = Award::with('employee')->orderBy('awards.id', 'desc')->get();
        //        print_r($this->awards);die;
        $this->awards_color = ['0' => 'success', '1' => 'danger', '2' => 'warning', '3' => 'info'];

        return View::make('admin/dashboard/dashboard', $this->data);
    }

    public function ajax_load_calender()
    {

        $attendance = Attendance::company($this->company_id)->select('*', 'attendance.status as a_status')
            ->where('date', '>=', request()->get('start'))->where('date', '<', request()->get('end'))
            ->where(function ($query) {
                $query->where('application_status', '=', 'approved')
                    ->orwhere('application_status', '=', null)
                    ->orwhere('attendance.status', '=', 'present');
            })->get();

        $at = [];
        $final = [];
        foreach ($attendance as $attend) {
            $date = $attend->date->format("Y-m-d");
            $at[$date]['status'][] = $attend->a_status;
            $at[$date]['employee'][] = $attend->employee->full_name;
        }
        $i = 0;
        foreach ($at as $index => $att) {

            if (in_array('absent', $att['status'])) {
                foreach ($att['employee'] as $index_emp => $employee) {
                    if ($att['status'][$index_emp] == 'absent') {
                        $final[$i]['id'] = $i;
                        $final[$i]['type'] = 'attendance';
                        $final[$i]['date'] = $index;
                        $final[$i]['title'] = $employee;
                        $i++;
                    }
                }
            } else {
                $final[$i]['id'] = $i;
                $final[$i]['type'] = 'attendance';
                $final[$i]['date'] = $index;
                $final[$i]['title'] = 'all present';
                $i++;
            }
        }
        $holidays = Holiday::select('holidays.id', 'holidays.occassion as title', 'holidays.date')
            ->where('date', '>=', request()->get('start'))->where('date', '<', request()->get('end'))->get()
            ->toArray();

        $month = strtotime(request()->get('start'));
        $start_month = date('m', $month);
        $month_end = strtotime(request()->get('end'));
        $end_month = date('m', $month_end);
        if ($start_month == 12) {
            $employees = Employee::select('employees.id', 'employees.full_name as title', 'employees.date_of_birth as date', DB::raw('\'birthday\' as type'))
                ->where(DB::raw('month(date_of_birth)'), '<=', $start_month)
                ->where(DB::raw('month(date_of_birth)'), '<', $end_month)->get()->toArray();
        } elseif ($start_month == 11) {
            $employees = Employee::select('employees.id', 'employees.full_name as title', 'employees.date_of_birth as date', DB::raw('\'birthday\' as type'))
                ->where(DB::raw('month(date_of_birth)'), '>=', $start_month)
                ->where(DB::raw('month(date_of_birth)'), '>', $end_month)->get()->toArray();
        } else {
            $employees = Employee::select('employees.id', 'employees.full_name as title', 'employees.date_of_birth as date', DB::raw('\'birthday\' as type'))
                ->where(DB::raw('month(date_of_birth)'), '>=', $start_month)
                ->where(DB::raw('month(date_of_birth)'), '<', $end_month)->get()->toArray();
        }
        if ($employees) {
            foreach ($employees as $key => $emp_bday) {
                $temp_date = strtotime($emp_bday['date']);
                $formate_1 = date('m-d', $temp_date);
                $y = Carbon::now();
                $year = $y->year;
                $new_date = $year . '-' . $formate_1;
                $employees[$key]['date'] = $new_date;
            }
        }

        $calender = array_merge($final, $holidays, $employees);
        return json_encode($calender);
    }

    public function ajax_load_employee()
    {
        $empId = request()->get('employee_id');
        $employee = Employee::find($empId);
        $project_allocation = ProjectEmployee::select('project_employees.id','projects.name as title', 'project_employees.start_date', 'project_employees.end_date', 'project_employees.start_time','project_employees.end_time')
            ->leftJoin('projects','project_employees.project_id','projects.id')
            ->where("project_employees.employee_id", $empId)
            ->where('start_date', '<=', request()->get('end'))
            ->where('end_date', '>=', request()->get('start'))
            ->get();

        foreach( $project_allocation as $prj){
            $prj->type = "project";
            $prj->date = Carbon::parse($prj->start_date.'T'.$prj->start_time);
            $prj->end = Carbon::parse($prj->end_date.'T'.$prj->end_time);
        }
        $project_allocation = $project_allocation->toArray();

        $attendance = Attendance::join('employees', 'attendance.employee_id', '=', 'employees.id')
            ->where('attendance.employee_id', '=', $employee->id)
            ->select('*', 'attendance.reason as title', 'attendance.status as a_status')
            ->where('date', '>=', request()->get('start'))
            ->where('date', '<', request()->get('end'))
            ->where(function ($query) {
                $query->where('application_status', '=', 'approved')
                    ->orwhere('application_status', '=', null)
                    ->orwhere('attendance.status', '=', 'present');
            })
            ->where('employees.company_id', '=', $employee->company_id)
            ->get()
            ->toArray();
        $attendance2 = Attendance::join('employees', 'attendance.employee_id', '=', 'employees.id')
            ->where('attendance.employee_id', '<>', $employee->id)
            ->where("attendance.employee_id", $employee->id)
            ->select('*', DB::raw('substring_index(full_name, " ", 1) as title'), 'attendance.status as a_status', DB::raw('\'absent_other\' as type'))
            ->where('date', '>=', request()->get('start'))
            ->where('date', '<', request()->get('end'))
            ->where('date', '>=', new \DateTime('today'))
            ->where('attendance.status', '=', 'absent')
            ->where(function ($query) {
                $query->where('application_status', '=', 'approved')
                    ->orwhere('application_status', '=', null);
            })
            ->where('employees.company_id', '=', $employee->company_id)
            ->get()
            ->toArray();

        $holidays = Holiday::select('holidays.id', 'holidays.occassion as title', 'holidays.date')
            ->where('date', '>=', request()->get('start'))
            ->where('date', '<', request()->get('end'))
            ->get()
            ->toArray();

        $month = strtotime(request()->get('start'));
        $start_month = date('m', $month);
        $month_end = strtotime(request()->get('end'));
        $end_month = date('m', $month_end);
        if ($start_month == 12) {
            $employees = Employee::select('employees.id', 'employees.full_name as title', 'employees.date_of_birth as date', DB::raw('\'birthday\' as type'))
                ->where('company_id', $employee->company_id)
                ->where(DB::raw('month(date_of_birth)'), '<=', $start_month)
                ->where(DB::raw('month(date_of_birth)'), '<', $end_month)->get()->toArray();
        } elseif ($start_month == 11) {
            $employees = Employee::select('employees.id', 'employees.full_name as title', 'employees.date_of_birth as date', DB::raw('\'birthday\' as type'))
                ->where('company_id', $employee->company_id)
                ->where(DB::raw('month(date_of_birth)'), '>=', $start_month)
                ->where(DB::raw('month(date_of_birth)'), '>', $end_month)->get()->toArray();
        } else {
            $employees = Employee::select('employees.id', 'employees.full_name as title', 'employees.date_of_birth as date', DB::raw('\'birthday\' as type'))
                ->where('company_id', $employee->company_id)
                ->where(DB::raw('month(date_of_birth)'), '>=', $start_month)
                ->where(DB::raw('month(date_of_birth)'), '<', $end_month)->get()->toArray();

        }
        if ($employees) {
            foreach ($employees as $key => $emp_bday) {
                $temp_date = strtotime($emp_bday['date']);
                $formate_1 = date('m-d', $temp_date);
                $y = Carbon::now();
                $year = $y->year;
                $new_date = $year . '-' . $formate_1;
                $employees[$key]['date'] = $new_date;
            }
        }

        $calender = array_merge($attendance, $holidays, $employees, $attendance2, $project_allocation);

        return json_encode($calender);
    }

    public function update_employee_assign()
    {
        $id = request()->get('id');
        $start = request()->get('start');
        $end =  request()->get('end');

        $projectEmployee = ProjectEmployee::find($id);
        
        //selelct date between project range
        $checkProject = Project::find($projectEmployee->project_id);
        $prjStart = $checkProject->start;
        $prjEnd = $checkProject->end;
        if($start < $prjStart || $end > $prjEnd){
            return response()->json(['status'=>'error', 'message' => 'Select date between'.$prjStart. '  to  '  .$prjEnd]);
        }

        $projectEmployee->start_date = $start;
        $projectEmployee->end_date = $end;
        $projectEmployee->save();

        $employee = Employee::find($projectEmployee->employee_id);
        $projectData = Project::find($projectEmployee->project_id);
        $inputs = [];
        $inputs['start_date'] = $projectEmployee->start_date;
        $inputs['end_date'] =  $projectEmployee->end_date;
        $inputs['start_time'] = $projectEmployee->start_time;
        $inputs['end_time'] =  $projectEmployee->end_time;
        $inputs['employee'] = $employee;
        $inputs['project'] = $projectData;
        Mail::to($employee->email)->queue(new AssignEmployee($inputs));
        return response()->json(['status'=>'success']);

    }

    /*    Screen lock controller.When screen lock button from menu is cliked this controller is called.
     *     lock variable is set to 1 when screen is locked.SET to 0  if you dont want screen variable
     */
    public function screenlock()
    {
        $cookie = \Cookie::forever('lock', '1');

        return \Response::view("admin/screen_lock", $this->data)->withCookie($cookie);
    }

    public function resend_verify_email()
    {
        $input = Admin::where('email', admin()->email)->first();
        if ($input) {
            $code = Str::random(60);
            $input->email_token = $code;
            $input->save();

            Session::flash('success', trans("messages.passwordReset"));
            //---- RESET EMAIL SENDING-----

            $emailInfo = ['from_email' => $this->setting->email,
                'from_name' => $this->setting->name,
                'to' => $input['email'],
                'active_company' => admin()->company];
            $fieldValues = ['NAME' => $input->name, 'VERIFY_LINK' => \HTML::link('admin/verify_email/' . $code)];

            EmailTemplate::prepareAndSendEmail('NEW_ADMIN_EMAIL_VERIFICATION', $emailInfo, $fieldValues);
        } else {
            Session::flash('error', trans("messages.emailNotFound"));
        }

        return Redirect::route('admin.dashboard.index');
    }

    public function support()
    {
        $this->pageTitle = trans("core.support");
        return view("admin.support", $this->data);
    }

    public function screenlockModal()
    {
        $cookie = \Cookie::forever('lock', '1');
        \Session::put('back_url_' . admin()->type, \Request::server('HTTP_REFERER'));
        return \Response::json([
            'status' => 'success',
            'back' => \Session::get('back_url'),
        ])->withCookie($cookie);
    }
}
