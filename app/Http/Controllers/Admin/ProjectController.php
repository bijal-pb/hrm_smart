<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\Project\DeleteRequest;
use App\Http\Requests\Admin\Project\StoreRequest;
use App\Http\Requests\Admin\Project\UpdateRequest;
use App\Http\Requests\Admin\Project\EditRequest;
use App\Mail\AssignEmployee;
use Illuminate\Support\Facades\Mail;
use App\Models\Employee;
use App\Models\EmployeeTask;
use App\Models\Project;
use App\Models\ProjectEmployee;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use DB;
use Exception;

class ProjectController extends AdminBaseController
{    
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Projects';
        $this->attendanceOpen = 'active';
        $this->projectActive = 'active';
        $this->pageTitle = trans('pages.awards.indexTitle');

    }
    public function update_project_detail(Request $request) {
        $project = Project::find($request->id);
        $project->name = $request->name;
        $date = explode(" - ", $request->date);
        $startDate = date("Y-m-d", strtotime($date[0]));
        $endDate = date("Y-m-d", strtotime($date[1]));
        $project->start = $startDate;
        $project->end =  $endDate;
        $project->estimated_hour = $request->estimatedhour;
        $project->status = $request->status;
        $project->description = $request->description;
        $project->save();
        return response()->json($project);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->projects = Project::all();
        return View::make('admin.projects.index', $this->data);
    }

    public function data(){
        $result = Project::select('id','name','description','created_at');
        return DataTables::of($result)
            ->addColumn('edit', function ($row) {
                return '
                <br><a  class="btn btn-primary margin-bottom-10"  href=" ' . route("admin.projects.show", $row->id , ) . '"><i class="fal fa-edit"></i></a><br>
                <br><a class="btn btn-success margin-bottom-10" id="btn-add" href=" ' . route("admin.project_employees.create", ['project_id'=>$row->id]) . '">
                        <i class="fal fa-user-plus"></i>
                    </a><br>
                        <br><a href="javascript:;" onclick="del(' . $row->id . ',\'' . $row->project . '\')" class="btn btn-primary margin-bottom-10">
                        <i class="fal fa-list"></i></a>';
                
            })
            ->rawColumns(['edit', 'status'])
            ->escapeColumns(['edit'])
            ->make();

    }
    /**
     * @return mixed
     * @throws \Exception
     */
    public function ajax_projects()
    {
        $result = Project::select('id', 'name','start', 'end','created_at','status')
        ->where('projects.company_id', admin()->company_id)->get();
        
        return DataTables::of($result)->editColumn('status', function ($row) {
           
            if ($row->status == 'completed') {
                return "<span class='badge badge-danger'>Completed</span>";
            }if ($row->status == 'hold') {
                return "<span class='badge badge-success'>Hold</span>";
            }if ($row->status == 'in progress') {
                return "<span class='badge badge-primary'>In progress</span>";
            }if ($row->status == 'not start') {
                return "<span class='badge badge-warning'>Not started</span>";
            }
        })->editColumn('created_at', function ($row) {
            return $row->created_at->format('Y-m-d');
        })
        ->addColumn('edit', function ($row) {
                return '<div class="d-flex"><a class="btn btn-outline-success btn-icon waves-effect waves-themed mx-1 margin-top-10 " href=" ' . route("admin.projects.show", $row->id) . '" ><i class="fa fa-eye"></i></a>
                <button  class="btn btn-outline-warning btn-icon waves-effect waves-themed mx-1 margin-top-10"  onclick="showEdit(' . $row->id . ')"><i class="fal fa-edit"></i></button></div>';

            })
            ->rawColumns(['edit', 'status'])
            ->escapeColumns(['edit'])
            ->make();
    }
    /**
     * @param CreateRequest $request
     * @return array
     */
    public function show(Request $request, $id)
    {
        // $hour = DB::select("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `hour` ) ) ) AS total_hour FROM employee_tasks WHERE project_id = ?", [$id]);
      //  $support = DB::select("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `hour` ) ) ) AS total_support FROM employee_tasks WHERE project_id = ?", [$id]);
        $hour = EmployeeTask::select(DB::raw("SEC_TO_TIME(SUM(TIME_TO_SEC(employee_tasks.hour))) as  total_hour"))->where('project_id',$id)->where('type',1)->get();
        $support = EmployeeTask::select(DB::raw("SEC_TO_TIME(SUM(TIME_TO_SEC(employee_tasks.hour))) as  total_support"))->where('project_id',$id)->where('type',2)->get();
        $result = ProjectEmployee::where('project_id',$id)->count();
        $data = Project::find($id);
        $detail = ProjectEmployee::select('project_employees.id','project_employees.project_id','employees.full_name as employee_name','employees.profile_image as profile_image' ,'start_date', 'end_date', 'start_time','end_time')
        ->leftJoin('employees','project_employees.employee_id','employees.id')
        ->where('project_id',$id)
        ->get();
        return View::make('admin.projects.show', $this->data, compact(['result','data','detail','hour','support']));
    }

    
    public function get_employee_data($id){
        
        $employees = ProjectEmployee::select('project_employees.id','project_employees.project_id','employees.id as emp_id','employees.full_name as employee_name','employees.profile_image as profile_image','designation.designation as designation','start_date', 'end_date', 'start_time','end_time')
                ->leftJoin('employees','project_employees.employee_id','employees.id')
                ->leftJoin('designation','employees.designation','designation.id')
                ->where('project_id',$id)
                ->where('employees.status', '=', 'active')
                ->get();
        $project = Project::find($id);
       
        foreach($employees as $d){
            $d->profile_image = URL::asset("/uploads/profile_images/".$d->profile_image);
        }
        $data = [ "project" => $project, "employees" => $employees];
         return response()->json($data);
        
       
    }
    // public function status_check($id, Request $request ){
    //     $detail = Project::find($id);
    //     $detail->get();
    //     return $detail;
    // }

    
    public function store(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description'=>'required',
            'status' => 'required',
            'estimated_hour' => 'required',
            'addmore.*.employee_id' => 'required',
            'addmore.*.start_date' => 'required',
            'addmore.*.start_time' => 'required',
            'addmore.*.end_time' => 'required',
            // 'project.*.*.title' => 'required',
            // 'project.*.*.description' => 'required',
		],[
            'addmore.*.employee_id.required' => "employee is required!",
            'addmore.*.start_date.required' => "Date is required!",
        ]);

		if($validator->fails())
		{
            return response()->json(['status'=>'error','message' => $validator->errors()->first()]);
        }
    

        DB::beginTransaction();
        try{
            // check assign in another project
            
            foreach($request->addmore as $key => $value) {
                $date = explode("-", $value['start_date']);
                $startDate = date("Y-m-d", strtotime($date[0]));
                $endDate = date("Y-m-d", strtotime($date[1]));

                $date = explode("-", $request->start);
                $prjStart = date("Y-m-d", strtotime($date[0]));
                $prjEnd = date("Y-m-d", strtotime($date[1]));
                if($startDate < $prjStart || $endDate > $prjEnd){
                    return response()->json(['status'=>'error', 'message' => 'Select date between'.$prjStart. '  to  '  .$prjEnd]);        
                }

             
                // check assign another project 
                $assignProjects = ProjectEmployee::where('start_date','<=',$endDate)
                            ->where('end_date','>=',$startDate)
                            ->where('employee_id',$value['employee_id'])
                            ->get();

                foreach($assignProjects as $assign){
                    $assignStartTime = explode(':',$assign->start_time);
                    $assignStartTimeMinute = ($assignStartTime[0] * 60) + $assignStartTime[1];
                    $assignEndTime = explode(':',$assign->end_time);
                    $assignEndTimeMinute = ($assignEndTime[0] * 60) + $assignEndTime[1];
                    $requestStartTime = explode(':',$value['start_time']);
                    $requestStartTimeMinute = ($requestStartTime[0] * 60) + $requestStartTime[1];
                    $requestEndTime = explode(':',$value['end_time']);
                    $requestEndTimeMinute = ($requestEndTime[0] * 60) + $requestEndTime[1];
                    if(($assignStartTimeMinute < $requestEndTimeMinute) && ($assignEndTimeMinute > $requestStartTimeMinute)){
                        $emp = Employee::find($value['employee_id']);
                        return response()->json(['status'=>'error', 'message' => $emp->full_name.' is Already assign in another project!']);
                    }
                }
            }
            
            $company = \admin()->company;

            $project = new Project;
            $project->name = $request->name;
            $project->description = $request->description;
            $date = explode("-", $request->start);
            $startDate = date("Y-m-d", strtotime($date[0]));
            $endDate = date("Y-m-d", strtotime($date[1]));
            $project->start = $startDate;
            $project->end =  $endDate;
            $project->estimated_hour = $request->estimated_hour;
            $project->status = $request->status;
            $project->company_id =  $company->id;
            $project->save();

            foreach ($request->addmore as $key => $value) {
                // ProjectEmployee::create($value);
                $projectEmp = new ProjectEmployee;
                $projectEmp->project_id = $project->id;
                $projectEmp->company_id =  $company->id;
                $projectEmp->employee_id = $value['employee_id'];
                $date = explode("-", $value['start_date']);
                $startDate = date("Y-m-d", strtotime($date[0]));
                $endDate = date("Y-m-d", strtotime($date[1]));
                $projectEmp->start_date = $startDate;
                $projectEmp->end_date =  $endDate;
                $projectEmp->start_time = $value['start_time'];
                $projectEmp->end_time = $value['end_time'];
                $startTime = explode(":",$value['start_time']);
                $endTime = explode(":",$value['end_time']);
                $startTimeMinute = ($startTime[0] * 60) + $startTime[1];
                $endTimeMinute = ($endTime[0] * 60) + $endTime[1];
        
                if($startTimeMinute >= $endTimeMinute){
                    return response()->json(['status'=>'error', 'message' => 'End Time should be greater than Start Time']);
                }
                $projectEmp->save();
            }

            $empProject = ProjectEmployee::where('project_id',$project->id)->with('employee')->get();
            
            foreach ($empProject as $data) {
                $employee = Employee::find($data->employee_id);
                $projectData = Project::find($data->project_id);
                $inputs = [];
                $inputs['start_date'] = $data->start_date;
                $inputs['end_date'] =  $data->end_date;
                $inputs['start_time'] = $data->start_time;
                $inputs['end_time'] =  $data->end_time;
                $inputs['employee'] = $employee;
                $inputs['project'] = $projectData;
                Mail::to($employee->email)->queue(new AssignEmployee($inputs));
            }

            DB::commit();
            return Reply::redirect(route('admin.projects.index'));
        }catch(Exception $e){
            DB::rollback();
            return Reply::error('Something Went wrong please try again!');
        }
        
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(EditRequest $request, $id)
    {
        $this->project = Project::find($id);
        // $this->start = date('Y-m-d', strtotime($project->from_time));
        // $this->end = date('Y-m-d', strtotime($project->to_time));

        $this->employees = Employee::manager()
            ->select('full_name', 'employees.id','employeeID')
            ->where('status', '=', 'active')->get();


        return View::make('admin.projects.edit', $this->data);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        // $this->projectActive = 'active';
        // $this->projects = Project::select('name')->get();
        $this->employees = Employee::manager()
            ->select('full_name', 'employees.id', 'employeeID')
            ->where('status', '=', 'active')->get();

         
        //         // UPLOAD THE DOCUMENTS  ----------------
           
        return View::make('admin.projects.create', $this->data);
    }
    public function project_status($id,Request $request){
        $project = Project::find($id);
        if($request->status == "inprogress"){
            $project->status = "in progress";
        }else{
            $project->status = $request->status;
        }
        
        $project->save();
          return $request->status;
        // return Reply::success("Project status updated Successfully");
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->toArray());
        return Reply::success("messages.updateSuccess");
    }

    /**
     * @param DeleteRequest $request
     * @param $id
     * @return array
     */
    public function destroy(DeleteRequest $request, $id)
    {
        Project::destroy($id);

        return Reply::success('messages.projectDeleteMessage');

    }
}
