<?php

namespace App\Http\Requests\Admin\ProjectEmployee;

use App\Http\Requests\AdminCoreRequest;
use App\Models\ProjectEmployee;

class EditRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $project_employee = ProjectEmployee::find($this->route('project_employee'));
        return admin() && $project_employee;
    }


    public function rules()
    {
        return [
        ];
    }
}
