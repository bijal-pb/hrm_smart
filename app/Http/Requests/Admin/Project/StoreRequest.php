<?php

namespace App\Http\Requests\Admin\Project;

use App\Http\Requests\AdminCoreRequest;

class StoreRequest extends AdminCoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
    
            'name' => 'required',
            'description'=>'required',
            'status' => 'required',
            'estimated_hour' => 'required',
            'start' => 'required',
            'addmore.*.employee_id' => 'required',
            'addmore.*.start_date' => 'required',
            'addmore.*.start_time' => 'required',
            'addmore.*.end_time' => 'required',
            // 'employee_id' => 'required',
        ];
    }

}
