<?php

namespace App\Http\Requests\Front\EmployeeTask;

use App\Http\Requests\FrontCoreRequest;
use App\Models\EmployeeTask;

class EditRequest extends FrontCoreRequest
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


    public function rules()
    {
        return [
        ];
    }
}
