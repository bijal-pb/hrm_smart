<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\Award\DeleteRequest;
use App\Http\Requests\Admin\Award\EditRequest;
use App\Http\Requests\Admin\Award\StoreRequest;
use App\Http\Requests\Admin\Award\UpdateRequest;
use App\Models\Award;

use App\Models\Employee;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class AwardsController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->awardsOpen = 'active';
        $this->awardsActive = 'active';
        $this->hrMenuActive = 'active';
        $this->addAwardsActive = 'active';
        $this->pageTitle = trans('pages.awards.indexTitle');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {

        $this->awardsActive = 'active';
        $this->pageTitle = trans('pages.awards.createTitle');
        $this->addAwardsActive = 'active';
        $this->employees = Employee::manager()
            ->select('full_name', 'employees.id','employeeID')
            ->where('status', '=', 'active')->get();
        return View::make('admin.awards.index', $this->data);
    }


    /**
     * @return mixed
     * @throws \Exception
     */
    public function ajax_awards()
    {
        $result = Award::select('awards.id', 'awards.employee_id', 'full_name', 'award_name', 'gift', 'month', 'awards.year', 'awards.created_at')
            ->join('employees', 'awards.employee_id', '=', 'employees.id')
            ->get();

        return DataTables::of($result)->addColumn('For Month', function ($row) {
            return ucfirst($row->month) . ' ' . $row->year;
        })->addColumn('edit', function ($row) {
            return '<div class="d-flex"><a  class="btn btn-outline-warning btn-icon waves-effect waves-themed mx-1" onclick="showedit(' . $row->id . ');return false;"><i class="fal fa-edit"></i> <span class="hidden-sm hidden-xs">' . '</span></a>
                         <a href="javascript:;" onclick="del(\'' . $row->id . '\',\'' . $row->award_name . '\');return false;" class="btn btn-outline-danger btn-icon waves-effect waves-themed mx-1">
                        <i class="fal fa-trash"></i> <span class="hidden-sm hidden-xs">' .  '</span></a>';
        })->editColumn('full_name', function ($row) {
            $employee = Employee::find($row->employee_id);
            return $employee->decryptToCollection()->full_name;
        })->removeColumn('year')
            ->removeColumn('eid')
            ->rawColumns(['For Month', 'edit'])
            ->make();
    }

    public function create()
    {
        $this->pageTitle = trans('pages.awards.createTitle');
        $this->addAwardsActive = 'active';
        $this->employees = Employee::manager()
            ->select('full_name', 'employees.id','employeeID')
            ->where('status', '=', 'active')->get();

        return View::make('admin.awards.index', $this->data);
    }

    /**
     * @param StoreRequest $request
     * @return mixed
     */
    public function store(StoreRequest $request)
    {

        Award::create($request->toArray());
        return response()->json(['status'=>'success', 'message' => 'Award <strong>:award</strong> added successfully']);
        // return Reply::redirect(route('admin.awards.index'), "messages.awardAddMessage");
    }


    /**
     * @param EditRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(EditRequest $request, $id)
    {
        $this->pageTitle = trans('pages.awards.editTitle');

        $this->award = Award::find($id);

        $this->employees = Employee::manager()
            ->select('full_name', 'employees.id','employeeID')
            ->where('status', '=', 'active')->get();


        return View::make('admin.awards.edit', $this->data);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array|\Illuminate\Contracts\View\View
     */
    public function update(UpdateRequest $request, $id)
    {
        $award = Award::findOrFail($id);
        $award->update($request->toArray());

        return Reply::success("messages.updateSuccess");
    }

    /**
     * @param DeleteRequest $request
     * @param $id
     * @return array
     */
    public function destroy(DeleteRequest $request, $id)
    {
        Award::destroy($id);
        return Reply::success("messages.awardDeleteMessage");
    }

}
