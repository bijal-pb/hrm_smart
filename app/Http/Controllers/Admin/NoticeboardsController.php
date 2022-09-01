<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\Noticeboard\EditRequest;
use App\Http\Requests\Admin\Noticeboard\StoreRequest;
use App\Http\Requests\Admin\Noticeboard\UpdateRequest;
use App\Models\Noticeboard;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class NoticeboardsController
 * @package App\Http\Controllers\Admin
 */
class NoticeboardsController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Notice Board';
        $this->noticeBoardOpen = 'active open';
        $this->noticeBoardActive = 'active';
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->noticeboards = Noticeboard::orderBy('created_at', 'DESC')->get();
        return View::make('admin.noticeboards.index', $this->data);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return View::make('admin.noticeboards.create', $this->data);
    }

    /**
     * @param CreateRequest $request
     * @return array
     */
    public function store(StoreRequest $request)
    {

        Noticeboard::create($request->toArray());

        return Reply::redirect(route('admin.noticeboards.index'));

    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function ajax_notices()
    {
        $result = Noticeboard::select('id', 'title', 'description', 'status', 'created_at');

        return DataTables::of($result)
            ->editColumn('created_at', function ($row) {
                return date('Y-m-d', strtotime($row->created_at));
            })
            ->editColumn('status', function ($row) {
           
                if ($row->status == 'active') {
                    return "<span class='badge badge-danger'>Active</span>";
                }if ($row->status == 'inactive') {
                    return "<span class='badge badge-success'>Inactive</span>";
                }
            })->addColumn('edit', function ($row) {
                return '<div class="d-flex"><a  class="btn btn-outline-warning btn-icon waves-effect waves-themed mx-1"  href=" ' . route("admin.noticeboards.edit", $row->id) . '"><i class="fa fa-edit"></i> <span class="hidden-sm hidden-xs">' . '</span></a><a href="javascript:;" onclick="del(\'' . $row->id . '\');return false;" class="btn btn-outline-danger btn-icon waves-effect waves-themed mx-1"><i class="fal fa-trash"></i> <span class="hidden-sm hidden-xs">' . '</span></a></div>';
            })
            ->escapeColumns(['edit', 'status'])
            ->rawColumns(['status', 'edit'])
            ->make(true);
    }

    /**
     * @param EditRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(EditRequest $request,$id)
    {
        $this->notice = Noticeboard::find($id);

        return View::make('admin.noticeboards.edit', $this->data);
    }


    public function update(UpdateRequest $request, $id)
    {
        $noticeBoard = Noticeboard::findOrFail($id);
        $noticeBoard->update($request->toArray());

        return Reply::success('Updated successfully');
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        Noticeboard::destroy($id);
        return Reply::success('Deleted successfully');
    }

}
