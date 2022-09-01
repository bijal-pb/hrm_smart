<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests;
use App\Models\Project;
use App\Models\Company;
use App\Models\ProjectEmployee;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Classes\Reply;
use Yajra\DataTables\Facades\DataTables;

class ProjectAllocationController extends AdminBaseController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->projectAllocation = 'active';
        $this->pageTitle = 'Project Allocation';
    }

    public function index()
    {
        $this->viewProjectAllocationActive = 'active';

        /*$this->date = Carbon::now()->format('Y-m-d');

        return View::make('admin.attendances.index', $this->data);*/

        $this->projects = Project::all();
        $this->viewProjectAllocationActive = 'active';

        $this->date = date('Y-m-d');
        $this->daysInMonth = Carbon::now()->daysInMonth;

        $this->employees = Employee::manager()
            ->select('full_name', 'employees.id','employeeID')
            ->where('status', '=', 'active')->get();


        return View::make('admin.project_allocation.employee-sheet', $this->data);
    }

    public function filterEmployee(Request $request)
    {
        // $employees = ProjectEmployee::with(['project'])->select('project_employees.id','projects.name as project_name', 'employees.full_name as employee_name','project_employees.employee_id as employee_id', 'start_date', 'end_date')
        // ->leftJoin('employees','project_employees.employee_id','employees.id')
        // ->leftJoin('projects','project_employees.project_id','projects.id');

        // return $employees;

        $startDate = $request->year.'-'.$request->month.'-01';
        $lastDate = Carbon::parse($request->year.'-'.$request->month.'-01')->endOfMonth()->toDateString();

        $employees = Employee::with(['project_emp' => function($query) use($startDate, $lastDate) {
            // $query->whereRaw('MONTH(start_date) = ?', [$request->month])->whereRaw('YEAR(start_date) = ?', [$request->year]);
            $query->where('end_date', '>=', $startDate)->where('start_date', '<=', $lastDate);
        }]); 

        
        if($request->employee_id == 'all') {
            $employees = $employees->get();
        } else {
            $employees = $employees->where('id', $request->employee_id)->get();
        }
        // return response()->json($employees);
       
         $final = [];
       
        $this->daysInMonth = cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);
        
        foreach($employees as $employee) {
            $final[$employee->id.'#'.$employee->full_name] = array_fill(1, $this->daysInMonth, '-');
            foreach($employee->project_emp as $projectEmp) {
                $currentDate = Carbon::parse($projectEmp->start_date);
                $endDate = Carbon::parse($projectEmp->end_date);
                $startDate = Carbon::parse($startDate);
                $lastDate = Carbon::parse($lastDate);
                if($currentDate < $startDate){
                    $currentDate = $startDate;
                }
                if($endDate > $lastDate){
                    $endDate = $lastDate;
                }
                while($currentDate <= $endDate){
                    $final[$employee->id.'#'.$employee->full_name][Carbon::parse($currentDate)->day] = $final[$employee->id.'#'.$employee->full_name][Carbon::parse($currentDate)->day]." ".$projectEmp->project->name."[".$projectEmp->start_time." - ".$projectEmp->end_time."]";
                    $currentDate = Carbon::parse($currentDate)->addDays(1);
                }
            }
        }

        $this->employeeProject = $final;
         $this->data["year"] = $request->year;
        $this->data["month"] = $request->month;
    
        $firstDay = $request->year . '-' . $request->month . '-01';
    
        $view = View::make('admin.project_allocation.load', $this->data)->render();

        return Reply::successWithDataNew($view);
    }
}
