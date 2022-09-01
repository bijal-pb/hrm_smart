<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
// use App\Http\Requests\Admin\ProjectEmployee\DeleteRequest;
// use App\Http\Requests\Admin\ProjectEmployee\StoreRequest;
// use App\Http\Requests\Admin\ProjectEmployee\UpdateRequest;
// use App\Http\Requests\Admin\ProjectEmployee\EditRequest;
use App\Models\Employee;
use App\Models\Project;
use App\Models\ProjectEmployee;
use Dotenv\Result\Success;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AssignEmployee;
use Validator;

class ProjectEmployeeController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Project Employee';
        $this->attendanceOpen = 'active';
        $this->projectEmployeeActive = 'active';
        $this->pageTitle = trans('pages.awards.indexTitle');

    }

   
    public function index()
    {
        $this->projectEmployeeActive = 'active';
        // $this->project_employees = ProjectEmployee::all();
        return View::make('admin.project_employees.index', $this->data);
    }
   
    public function ajax_project_employees()
    {
        $result = ProjectEmployee::select('project_employees.id','projects.name as project_name', 'employees.full_name as employee_name', 'start_date', 'end_date', 'start_time','end_time')
        ->leftJoin('employees','project_employees.employee_id','employees.id')
        ->leftJoin('projects','project_employees.project_id','projects.id')
        ->get();

        return DataTables::of($result)
            ->addColumn('edit', function ($row) {
                return '<a  class="btn btn-primary margin-bottom-10"  href=" ' . route("admin.project_employees.edit", $row->id) . '"><i class="fal fa-edit"></i></a><br>
                        <br><a href="javascript:;" onclick="del(' . $row->id . ',\'' . $row->project_employees . '\')" class="btn btn-danger margin-bottom-10">
                        <i class="fal fa-trash"></i></a>';
            })
            ->rawColumns(['edit', 'status'])
            ->escapeColumns(['edit'])
            ->make();
    }
    public function update_emp_detail(Request $request){

       

        $project = ProjectEmployee::find($request->id);
        $date = explode(" - ", $request->date);
        $startDate = date("Y-m-d", strtotime($date[0]));
        $endDate = date("Y-m-d", strtotime($date[1]));

        $checkProject = Project::find($project->project_id);
        $prjStart = $checkProject->start;
        $prjEnd = $checkProject->end;
        if($startDate < $prjStart || $endDate > $prjEnd){
            return response()->json(['status'=>'error', 'message' => 'Select date between'.$prjStart. '  to  '  .$prjEnd]);

        }
        
        $assignProjects = ProjectEmployee::where('start_date','<=',$endDate)
                                            ->where('end_date','>=',$startDate)
                                            ->where('employee_id',$project->employee_id)
                                            ->where('project_id','!=',$project->project_id)
                                            ->get();

        foreach($assignProjects as $assign){
            $assignStartTime = explode(':',$assign->start_time);
            $assignStartTimeMinute = ($assignStartTime[0] * 60) + $assignStartTime[1];
            $assignEndTime = explode(':',$assign->end_time);
            $assignEndTimeMinute = ($assignEndTime[0] * 60) + $assignEndTime[1];
            $requestStartTime = explode(':',$request->start_time);
            $requestStartTimeMinute = ($requestStartTime[0] * 60) + $requestStartTime[1];
            $requestEndTime = explode(':',$request->end_time);
            $requestEndTimeMinute = ($requestEndTime[0] * 60) + $requestEndTime[1];
            if(($assignStartTimeMinute < $requestEndTimeMinute) && ($assignEndTimeMinute > $requestStartTimeMinute)){
                return response()->json(['status'=>'error', 'message' => 'Already assign in another project!']);
            }
        }
        $project->start_date =  $startDate;
        $project->end_date = $endDate;
        $project->start_time = $request->start_time;
        $project->end_time =  $request->end_time;
       

        $startTime = explode(":",$request->start_time);
        $endTime = explode(":",$request->end_time);
        $startTimeMinute = ($startTime[0] * 60) + $startTime[1];
        $endTimeMinute = ($endTime[0] * 60) + $endTime[1];

        if($startTimeMinute >= $endTimeMinute){
            return response()->json(['status'=>'error', 'message' => 'End Time should be greater than Start Time']);
        }

        $project->save();

        $employee = Employee::find($project->employee_id);
        $projectData = Project::find($project->project_id);
        $inputs = [];
        $inputs['start_date'] = $project->start_date;
        $inputs['end_date'] =  $project->end_date;
        $inputs['start_time'] = $project->start_time;
        $inputs['end_time'] =  $project->end_time;
        $inputs['employee'] = $employee;
        $inputs['project'] = $projectData;
        Mail::to($employee->email)->queue(new AssignEmployee($inputs));
        
        return response()->json(['status'=>'success', 'message' => 'Updated Successfully!']);
        
    }

   
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'project_id' => 'required|exists:projects,id',
            'employee_id' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|',
        ],[
            'employee_id.required' => "employee is required!",
        ]);
        if($validator->fails())
		{
            return response()->json(['status'=>'error','message' => $validator->errors()->first()]);
        }

        $checkAssign = ProjectEmployee::where('project_id',$request->project_id)->where('employee_id',$request->employee_id)->get();
        if($checkAssign && count($checkAssign) > 0){
            return response()->json(['status'=>'error', 'message' => 'Already assign in this project!']);
        }


        // find start date and end date from daterange
        $date = explode("-", $request->start_date);
        $startDate = date("Y-m-d", strtotime($date[0]));
        $endDate = date("Y-m-d", strtotime($date[1]));

        //selelct date between project range
        $checkProject = Project::find($request->project_id);
        $prjStart = $checkProject->start;
        $prjEnd = $checkProject->end;
        if($startDate < $prjStart || $endDate > $prjEnd){
            return response()->json(['status'=>'error', 'message' => 'Select date between'.$prjStart. '  to  '  .$prjEnd]);

        }

        // check assign another project 
        $assignProjects = ProjectEmployee::where('start_date','<=',$endDate)
                                            ->where('end_date','>=',$startDate)
                                            ->where('employee_id',$request->employee_id)
                                            ->get();

        foreach($assignProjects as $assign){
            $assignStartTime = explode(':',$assign->start_time);
            $assignStartTimeMinute = ($assignStartTime[0] * 60) + $assignStartTime[1];
            $assignEndTime = explode(':',$assign->end_time);
            $assignEndTimeMinute = ($assignEndTime[0] * 60) + $assignEndTime[1];
            $requestStartTime = explode(':',$request->start_time);
            $requestStartTimeMinute = ($requestStartTime[0] * 60) + $requestStartTime[1];
            $requestEndTime = explode(':',$request->end_time);
            $requestEndTimeMinute = ($requestEndTime[0] * 60) + $requestEndTime[1];
            if(($assignStartTimeMinute < $requestEndTimeMinute) && ($assignEndTimeMinute > $requestStartTimeMinute)){
                return response()->json(['status'=>'error', 'message' => 'Already assign in another project!']);
            }
        }


        // save in db
        $projectEmp = new ProjectEmployee;
        $projectEmp->project_id = $request->project_id;
        $projectEmp->employee_id = $request->employee_id;
        
        $projectEmp->start_date =  $startDate;
        $projectEmp->end_date = $endDate;
        $projectEmp->start_time = $request->start_time;
        $projectEmp->end_time = $request->end_time;
        $st_time    =   $request->start_time;
        $et_time    =   $request->end_time;

        $startTime = explode(":",$request->start_time);
        $endTime = explode(":",$request->end_time);
        $startTimeMinute = ($startTime[0] * 60) + $startTime[1];
        $endTimeMinute = ($endTime[0] * 60) + $endTime[1];

        if($startTimeMinute >= $endTimeMinute){
            return response()->json(['status'=>'error', 'message' => 'End Time should be greater than Start Time']);
        }
        $projectEmp->save();

        $employee = Employee::find($projectEmp->employee_id);
        $projectData = Project::find($projectEmp->project_id);
        $inputs = [];
        $inputs['start_date'] = $projectEmp->start_date;
        $inputs['end_date'] =  $projectEmp->end_date;
        $inputs['start_time'] = $projectEmp->start_time;
        $inputs['end_time'] =  $projectEmp->end_time;
        $inputs['employee'] = $employee;
        $inputs['project'] = $projectData;
        Mail::to($employee->email)->queue(new AssignEmployee($inputs));
        return response()->json(['status'=>'success', 'message' => 'Employee Added Successfully']);
    }
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Request $request, $id)
    {
        $this->project_employees = ProjectEmployee::find($id);
        $this->project = Project::find($id);
        $this->employees = Employee::manager()
            ->select('full_name', 'employees.id','employeeID')
            ->where('status', '=', 'active')->get();


        return View::make('admin.project_employees.edit', $this->data);
    }

    public function create(Request $request)
    {
        $this->project = Project::find($request->project_id);
        $employeeIds = ProjectEmployee::where('project_id',$request->project_id)->pluck('employee_id')->toArray();
        $this->employees = Employee::whereNotIn('id',$employeeIds)->where('status', '=', 'active')->get();
           
        return View::make('admin.project_employees.create', $this->data);
    }
    
    public function update(Request $request, $id)
    {
        $project_employees = ProjectEmployee::find($id);
        $project_employees->project_id = $request->input('project_id');
        $project_employees->employee_id = $request->input('employee_id');
        $project_employees->start_date = $request->input('start_date');
        $project_employees->end_date = $request->input('end_date');
        $project_employees->fulltime = $request->input('fulltime');
        $project_employees->partial = $request->input('partial');
        $project_employees->save();

        return Reply::redirect(route('admin.project_employees.edit'), "messages.updateSuccess");
        // return Reply::success("messages.updateSuccess");
    }

    
    public function destroy(Request $request, $id)
    {
        Projectemployee::destroy($id);

        return Reply::success('messages.projectDeleteMessage');

    }
}
