<?php

namespace App\Http\Requests\Admin\Project;

use App\Http\Requests\AdminCoreRequest;
use App\Models\Project;

class DeleteRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;

        // $project = Project::find($this->route('project'));
        // return admin() && $project;
    }


    public function rules()
    {
        return [
        ];
    }
}
