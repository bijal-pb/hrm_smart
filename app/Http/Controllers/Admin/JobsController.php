<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;

use App\Http\Requests\Admin\Job\DeleteRequest;
use App\Http\Requests\Admin\Job\EditRequest;
use App\Http\Requests\Admin\Job\StoreRequest;
use App\Http\Requests\Admin\Job\UpdateRequest;
use App\Models\Job;
use App\Models\Designation;
use App\Models\JobApplication;
use Illuminate\Support\Facades\View;

use Yajra\DataTables\Facades\DataTables;

class JobsController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = trans('pages.jobs.indexTitle');
        $this->jobsOpen = 'active';
        $this->jobsPostedActive = 'active';
        $this->designation = Designation::select('designation')->get()->toJson();
        $this->designation = str_replace('"designation"', "designation", $this->designation);
    }

    public function index()
    {
        return View::make('admin.jobs.index', $this->data);
    }

    // Datatable ajax request
    public function ajax_jobs()
    {
        $result = Job::select('id', 'position', 'posted_date', 'last_date', 'close_date', 'status', 'created_at')
            ->get();

        return DataTables::of($result)
        ->editColumn('status', function ($row) {
            if ($row->status == 'active') {
                return "<span class='badge badge-danger'>Active</span>";
            }if ($row->status == 'inactive') {
                return "<span class='badge badge-success'>In active</span>";
            }
            })->addColumn('edit', function ($row) {
                return '<div class="d-flex">
                  <a  class="btn btn-outline-warning btn-icon waves-effect waves-themed mx-1"  onclick="showedit(' . $row->id . ');return false;"><i class="fa fa-edit"></i> ' . ' </a>
	              <a  href="javascript:;" onclick="del(\'' . $row->id . '\');return false;" class="btn btn-outline-danger btn-icon waves-effect waves-themed mx-1">
                  <i class="fal fa-trash"></i> '  . ' </a></div>';
            })
            ->rawColumns(['status', 'edit'])
            ->make();
    }


    public function create()
    {
        $this->pageTitle = trans('pages.jobs.createTitle');
        return View::make('admin.jobs.create', $this->data);
    }


    public function store(StoreRequest $request)
    {


        Job::create($request->toArray());
        return response()->json(['status'=>'success', 'message' => 'Jobs added successfully']);
        // return Reply::redirect(route('admin.jobs.index'),'messages.addSuccess');
    }


    public function show($id)
    {
        $this->pageTitle = trans('pages.jobs.showTitle');
        //Check employee Company
        $check = Job::company($this->company_id)->find($id);

        if ($check == null) {
            return View::make('admin.errors.noaccess', $this->data);
        }

        $job = Job::findOrFail($id);

        return View::make('admin.jobs.show', compact('job'));
    }


    public function edit(EditRequest $request,$id)
    {
        $this->pageTitle = trans('pages.jobs.editTitle');

        $this->job = Job::find($id);

        return View::make('admin.jobs.edit', $this->data);
    }

    public function update(UpdateRequest $request, $id)
    {

        $job = Job::findOrFail($id);
        $job->update($request->toArray());
        return Reply::success('messages.updateSuccess');
    }


    public function destroy(DeleteRequest $request, $id)
    {

        Job::destroy($id);

        return Reply::success('messages.jobDeleteMessage');
    }

}
