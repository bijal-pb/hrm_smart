<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\User\DeleteRequest;
use App\Http\Requests\Admin\User\EditRequest;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

use Yajra\DataTables\Facades\DataTables;

class AdminUsersController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = trans("core.admins");
        $this->csettingOpen = 'active';
        $this->adminUserActive = 'active';
    }

    public function index()
    {
        return View::make('admin.adminusers.index', $this->data);
    }

    public function ajax_admin_users()
    {
        $result = Admin::select('id', 'name', 'email', 'type','created_at')
            ->where('admins.company_id', admin()->company_id)
            ->where('manager', 0)
            ->get();

        return DataTables::of($result)->editColumn('created_at', function ($row) {
            return $row->created_at->format('Y-m-d');
        })->addColumn('edit', function ($row) {
            if ($row->id == admin()->id) {
                $string = '<div class="d-flex"><a class="btn btn-outline-warning btn-icon waves-effect waves-themed mx-1"  href="javascript:;" onclick="showEdit(' . $row->id . ');return false;" >
										          <i class="fal fa-edit"></i> '  . '</a>';
            } else {
                $string = '<a class="btn btn-outline-warning btn-icon waves-effect waves-themed mx-1"  href="javascript:;" onclick="showEdit(' . $row->id . ');return false;" ><i class="fal fa-edit"></i> ' . '</a>
			                                         <a  href="javascript:;" onclick="del(' . $row->id . ');return false;" class="btn btn-outline-danger btn-icon waves-effect waves-themed mx-1">
			                                         <i class="fal fa-trash"></i> '  . '</a></div>';
            }

            return $string;
        })->editColumn('name', function ($row) {

            return $row->decryptToCollection()->name;
        })->editColumn('email', function ($row) {

            return $row->decryptToCollection()->email;
        })
            ->rawColumns(['edit'])
            ->make();
    }

    public function create()
    {
        return View::make('admin.adminusers/create');
    }

    /**
     * @param StoreRequest $request
     * @return array
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $company = \admin()->company;

        $data['password'] = Hash::make($data['password']);
        $data['company_id'] = $company->company_id;

        Admin::create($data);

        return Reply::success('messages.adminAddMessage');
    }


    public function edit(EditRequest $request, $id)
    {
        $admin = Admin::find($id);
        return View::make('admin.adminusers.edit', compact('admin'));
    }


    public function update(UpdateRequest $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $data = $request->all();

        if ($data['password'] != '') {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $admin->update($data);
        return Reply::success('messages.adminUpdateMessage');


    }


    public function destroy(DeleteRequest $request, $id)
    {

        Admin::destroy($id);

        return Reply::success('messages.adminDeleteMessage');
    }

}
