<?php

namespace App\Http\Requests\Admin\Project;

use App\Classes\Reply;
use App\Http\Requests\AdminCoreRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Project;

class UpdateRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $project = Project::find($this->route('project'));
        return admin() && $project;
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     $response = Reply::failedToastr($validator);
    //     throw new HttpResponseException(response()->json($response, 200));
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'name' => 'nullable',
            'description'=>'nullable',
            'start' => 'nullable',
            'end' => 'nullable',
            'status' => 'nullable',
            // 'employee_id' => 'required',
        ];
    }
}
