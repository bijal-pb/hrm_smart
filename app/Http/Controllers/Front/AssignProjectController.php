<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontBaseController;
use App\Http\Requests\Front\Expense\ExpenseStore;

use App\Models\EmployeeTask;
use App\Models\Project;
use App\Models\ProjectEmployee;
use App\Classes\Reply;
use App\Http\Requests\Front\AssignProject\DeleteRequest;
use App\Http\Requests\Front\AssignProject\EditRequest;
use App\Http\Requests\Front\AssignProject\StoreRequest;
use App\Http\Requests\Front\AssignProject\UpdateRequest;
use Carbon\Carbon;
use App\Models\Employee;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class AssignProjectController extends FrontBaseController
{
    public function __construct()
    {

        parent::__construct();
        // $this->pageTitle = Lang::get('core.jobTitle');
        $this->assignprojectActive = 'active';
    }

    public function index()
    {
        // $this->employee_tasks = EmployeeTask::where('employee_tasks.employee_id', employee()->id)->get();
        return View::make('front.assign_projects.index', $this->data);
    }

    // Datatable ajax request
    public function ajax_assign_projects()
    {
        $result = ProjectEmployee::select('project_employees.id','projects.name as project_name', 'start_date', 'end_date', 'fulltime','partial')
        ->leftJoin('projects','project_employees.project_id','projects.id')
        ->where("project_employees.employee_id", $this->employee->id)
        ->get();

        return DataTables::of($result)
            ->addColumn('edit', function ($row) {
                // return '<a  class="btn btn-primary margin-bottom-10" href=" ' . route("front.assign_projects.edit", $row->id) . '"><i class="fal fa-edit"></i> <span class="hidden-sm hidden-xs">' . trans("core.btnViewEdit") . '</span></a><br>
                //         <br><a href="javascript:;" onclick="del(' . $row->id . ',\'' . $row->assign_projects . '\')" class="btn btn-danger margin-bottom-10">
                //         <i class="fal fa-trash"></i> <span class="hidden-sm hidden-xs">' . trans("core.btnDelete") . '</span></a>';
            })
            ->rawColumns(['edit', 'status'])
            ->escapeColumns(['edit'])
            ->make();
    }

    
    public function store(StoreRequest $request)
    {
        // $input = $request->all();

        // $employee_tasks = EmployeeTask::create($request->toArray());

        // $employee_tasks = new EmployeeTask();

        // $employee_tasks->project_id = $request->project_id;
        // $employee_tasks->date = $request->date;
        // $employee_tasks->hour = $request->hour;
        // $employee_tasks->description = $request->description;
        // $employee_tasks->employee_id =   $this->employeeID;
        // $employee_tasks->save();        
        return Reply::redirect(route('front.assign_projects.index'), "messages.taskAddMessage");
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(EditRequest $request, $id)
    {
        $this->projects = Project::get();

        $this->employee_tasks = EmployeeTask::find($id);

        return View::make('front.assign_projects.edit', $this->data);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
       
        $this->projects = Project::get();
           
        return View::make('front.assign_projects.create', $this->data);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $employee_tasks = EmployeeTask::findOrFail($id);
        $employee_tasks->update($request->toArray());
        return Reply::success("messages.updateSuccess");
    }

    /**
     * @param DeleteRequest $request
     * @param $id
     * @return array
     */
    public function destroy(DeleteRequest $request, $id)
    {
        EmployeeTask::destroy($id);

        return Reply::success('messages.taskDeleteMessage');

    }
}
