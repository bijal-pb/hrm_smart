<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeTask;
use App\Models\Project;
use App\Models\ProjectEmployee;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class EmployeeTasksController extends AdminBaseController
{
    public function __construct()
    {

        parent::__construct();
        // $this->pageTitle = Lang::get('core.jobTitle');
        $this->employeetaskActive = 'active';
    }

    public function index()
    {
        $this->projects = Project::get();
        $this->employees = Employee::manager()
        ->select('full_name', 'employees.id','employeeID')
        ->where('status', '=', 'active')->get();
        // $this->employee_tasks = EmployeeTask::where('employee_tasks.employee_id', employee()->id)->get();
        return View::make('admin.employee_tasks.index', $this->data);
    }

    // Datatable ajax request
    public function ajax_employee_tasks(Request $request)
    {
        $result = EmployeeTask::select('employee_tasks.id','employee_tasks.date as date','employee_tasks.employee_id as employee_id','employee_tasks.project_id as project_id','projects.name as project_name', 'employees.full_name as employee_name','title','employee_tasks.status as status','date', 'hour', 'employee_tasks.description')
            ->leftJoin('projects', 'employee_tasks.project_id', 'projects.id')
            ->leftJoin('employees', 'employee_tasks.employee_id', 'employees.id')
            ->orderBy('employee_tasks.id', 'desc');
            
            if($request->employee_id != 'all' ){
                $result = $result->where('employee_id',$request->employee_id);
            }

            if($request->project_id != 'all'){
                $result = $result->where('project_id',$request->project_id);
            }

            if($request->startDate != null && $request->endDate != null){
                $result = $result->whereBetween('date',[$request->startDate,$request->endDate]);
            }
           
            $result = $result->get();


        return DataTables::of($result)->editColumn('status', function ($row) {
            if ($row->status == 'inprogress') {
                return "<span class='badge badge-warning'>Inprogress</span>";
            }if ($row->status == 'completed') {
                return "<span class='badge badge-success'>Completed</span>";
            }

        })->addColumn('edit', function ($row) {
                return '<a  class="btn btn-outline-success btn-icon waves-effect waves-themed"  href="javascript:;" onclick="showView(' . $row->id . ');return false;" ><i class="fa fa-eye"></i></a>';
            })
            ->rawColumns(['edit', 'status'])
            ->escapeColumns(['edit'])
            ->make();
    }

    public function show(Request $request, $id)
    {

        $this->employee_task = EmployeeTask::find($id);
        // $this->color = ['selected' => 'success', 'rejected' => 'danger', 'pending' => 'warning'];

        return View::make('admin.employee_tasks.show', $this->data);
    }
}
