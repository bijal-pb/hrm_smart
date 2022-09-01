<?php

namespace App\Http\Controllers\Front;

use App\Classes\Reply;
use App\Http\Controllers\FrontBaseController;
use App\Http\Requests\Front\EmployeeTask\DeleteRequest;
use App\Http\Requests\Front\EmployeeTask\EditRequest;
use App\Http\Requests\Front\EmployeeTask\StoreRequest;
use App\Http\Requests\Front\EmployeeTask\UpdateRequest;
use App\Models\Employee;
use App\Models\EmployeeTask;
use App\Models\Project;
use App\Models\ProjectEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use DB;


use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class EmployeeTaskFrontController extends FrontBaseController
{
    public function __construct()
    {

        parent::__construct();
        // $this->pageTitle = Lang::get('core.jobTitle');
        $this->taskActive = 'active';
    }

    public function index()
    {
        $this->projects = ProjectEmployee::select('project_employees.id','projects.name as project_name','projects.id as project_id','projects.status as project_status')
        ->leftJoin('projects','project_employees.project_id','projects.id')
        ->where("project_employees.employee_id", $this->employee->id)
        ->where("projects.status" , "in progress")
        ->orWhere("projects.status" , "hold") 
        ->get();

        $this->all_projects = Project::select('projects.id','projects.name as project_name')
        ->get();
        // $this->employee_tasks = EmployeeTask::where('employee_tasks.employee_id', employee()->id)->get();
        return View::make('front.employee_tasks.index', $this->data);
    }

    // Datatable ajax request
    public function ajax_employee_tasks(Request $request)
    {
        $result = EmployeeTask::select('employee_tasks.id', 'projects.name as project_name','title','employee_tasks.status as status','date', 'hour')
            ->leftJoin('projects', 'employee_tasks.project_id', 'projects.id')
            ->where("employee_tasks.employee_id", $this->employee->id)
            ->orderBy('employee_tasks.id', 'desc');

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
                if (date('Y-m-d',strtotime('now')) == date('Y-m-d',strtotime($row->date))){
                return '<div class="d-flex">
                <a  class="btn btn-outline-warning btn-icon editBtn waves-effect waves-themed mx-1"  href="javascript:;" onclick="showedit(' . $row->id . ');return false;"><i class="fal fa-edit"></i> <span class="hidden-sm hidden-xs"></span></a>
                <a  class="btn btn-outline-success btn-icon waves-effect waves-themed mx-1"  href="javascript:;" onclick="showView(' . $row->id . ');return false;" ><i class="fa fa-eye"></i></a></div>';
                }else {
                    return '<div class="d-flex">
                    <a  class="btn btn-outline-success btn-icon waves-effect waves-themed mx-1"  href="javascript:;" onclick="showView(' . $row->id . ');return false;" ><i class="fa fa-eye"></i></a></div>';
                }
            })
            ->rawColumns(['edit', 'status'])
            ->escapeColumns(['edit'])
            ->make();
    }
    // <a href="javascript:;" onclick="del(' . $row->id . ',\'' . $row->project . '\')" class="btn btn-outline-danger btn-icon waves-effect waves-themed mx-1"><i class="fal fa-trash"></i></a>
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'project.*.*.title' => 'required',
            'project.*.*.description' => 'required',
		],[
            'project.*.*.title.required' => "Title is required!",
            'project.*.*.description.required' => "Description is required!",
        ]);

		if($validator->fails())
		{
            return response()->json(['status'=>'error','message' => $validator->errors()->first()]);
        }
       
        DB::beginTransaction();
        try{
            foreach($request->project as $tasks)
            {
                foreach($tasks as $task)
                {
                    $employee_tasks = new EmployeeTask;
                    $employee_tasks->type = $task['type'];
                    $employee_tasks->project_id = $task['project_id'];
                    $employee_tasks->date = $task['date'];
                    $employee_tasks->hour = $task['hour'];
                    if($request->hour == '0:00'){
                        return response()->json(['status'=>'error', 'message' => 'Enter valid time!']);
                    }
                    $employee_tasks->description = $task['description'];
                    $employee_tasks->title = $task['title'];
                    $employee_tasks->status = $task['status'];
                    $employee_tasks->employee_id = $this->employeeID;
                    $employee_tasks->save();
                    $project =  Project::find($task['project_id']);
                    $actual_hour = (isset($project->actual_hour) && $project->actual_hour != 0) ? $project->actual_hour : "00:00"; 
                    $project->actual_hour = $this->calculate_total_time($actual_hour,$task['hour']);
                    $project->save();
                }
            }
            DB::commit();
            return response()->json(['status'=>'success', 'message' => 'Tasks Added Successfully']);
        }catch(Exception $e){
            return response()->json(['status'=>'error', 'message' => 'Something went wrong please try again!']);
        }
        

        
    }

    public function show(Request $request, $id)
    {

        $this->employee_task = EmployeeTask::find($id);
        // $this->color = ['selected' => 'success', 'rejected' => 'danger', 'pending' => 'warning'];

        return View::make('front.employee_tasks.show', $this->data);
    }

     private function calculate_total_time($actualTime,$newTime) {
            $arr = [
              $actualTime,
                $newTime,
            ];
             
            $total = 0;
             
            // Loop the data items
            foreach( $arr as $element):
                 
                // Explode by separator :
                $temp = explode(":", $element);
                 
                // Convert the hours into seconds
                // and add to total
                // $total+= (int) $temp[0] * 3600;
                 
                // Convert the minutes to seconds
                // and add to total
                $total+= (int) $temp[0] * 60;
                 
                // Add the seconds to total
                 $total+= (int) $temp[1];
            endforeach;
             
            // Format the seconds back into HH:MM
            $formatted = sprintf('%02d:%02d',
                            ($total / 60 % 60),
                            $total % 60);
                            

            return $formatted;
             
        }

        private function calculate_delete_time($actualTime,$newTime) {
            
            $actualTotal = 0;
            $actual = explode(":", $actualTime);
            $actualTotal = ((int) $actual[0] * 60) + $actual[1];

            $newTotal = 0;
            $new = explode(":", $newTime);
            $newTotal = ((int) $new[0] * 60) + $new[1];

            $total = $actualTotal - $newTotal;

            // Format the seconds back into HH:MM
            $formatted = sprintf('%02d:%02d',
                            ($total / 60 % 60),
                            $total % 60);
                            

            return $formatted;
             
        }



    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(EditRequest $request, $id)
    {
        $check = EmployeeTask::find($id);
        if (date('Y-m-d',strtotime($check->date)) ==  date('Y-m-d',strtotime('now')) ){

            $this->projects = ProjectEmployee::select('project_employees.id','projects.name as project_name','projects.id as project_id','projects.status as project_status')
        ->leftJoin('projects','project_employees.project_id','projects.id')
        ->where("project_employees.employee_id", $this->employee->id)
        ->where("projects.status" , "in progress")
        ->orWhere("projects.status" , "hold") 
        ->get();

        $this->all_projects = Project::select('projects.id','projects.name as project_name')
        ->get();


        $this->employee_tasks = EmployeeTask::find($id);
        return View::make('front.employee_tasks.edit', $this->data);

        }else{
            
            // return view('front.employee_tasks.index');
             return redirect('/panel/employee_tasks');
        }
        
        
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {

        // $this->projects = Project::get();
        $this->projects = ProjectEmployee::select('project_employees.id','projects.name as project_name','projects.id as project_id','projects.status as project_status')
        ->leftJoin('projects','project_employees.project_id','projects.id')
        ->where("project_employees.employee_id", $this->employee->id)
        ->where("projects.status" , "in progress")
        ->orWhere("projects.status" , "hold") 
        ->get();

        // $this->all_projects = Project::select('projects.id','projects.name as project_name')->where('projects.company_id', admin()->company_id)
        // ->get();

        $this->all_projects = Project::select('projects.id','projects.name as project_name')->where('projects.company_id', admin()->company_id)
        ->get();

        return View::make('front.employee_tasks.create', $this->data);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    { 
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
		]);
		if($validator->fails())
		{
            return response()->json(['status'=>'error','message' => $validator->errors()->first()]);
        }
        
        if (date('Y-m-d',strtotime($request->date)) ==  date('Y-m-d',strtotime('now')) ){
        $employee_tasks = EmployeeTask::findOrFail($id);  
        $employee_tasks->type = $request->type;
        if($request->type == 1){
            $employee_tasks->project_id = $request->project_scope;
        }else{
            $employee_tasks->project_id = $request->project_support;
        }
        $employee_tasks->date = $request->date;
        $employee_tasks->hour = $request->hour;
        $employee_tasks->status = $request->status;
        $employee_tasks->title = $request->title;
        $employee_tasks->description = $request->description;
        $employee_tasks->save();
        }else{
        return response()->json(['status'=>'error', 'message' => 'Only Today Task Updated']);
        }
        return response()->json(['status'=>'success']);
    }

    /**
     * @param DeleteRequest $request
     * @param $id
     * @return array
     */
    public function destroy(DeleteRequest $request, $id)
    {
      
        $employee_tasks = EmployeeTask::find($id);
        $project =  Project::find($employee_tasks->project_id);
        $actual_hour = (isset($project->actual_hour) && $project->actual_hour != 0) ? $project->actual_hour : "00:00"; 
        $task_hour = substr($employee_tasks->hour,0,-3);
        $project->actual_hour = $this->calculate_delete_time($actual_hour,$task_hour);
        $project->save();
        $employee_tasks->delete();

        return Reply::success('messages.taskDeleteMessage');

    }

}
