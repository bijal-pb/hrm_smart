<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class ProjectEmployee extends BaseModel
{
    protected $guarded = ['id'];

    // protected $casts = [
    //     'employee_id' => 'array'
    // ];

    protected $fillable = ['start_date','end_date','start_time','end_time'];

    protected static function boot()
    {
        parent::boot();


        static::addGlobalScope('company', function (Builder $builder) {
            if (admin()) {
                $builder->where('project_employees.company_id', admin()->company_id);
            }
            if (employee()) {
                $builder->where('project_employees.company_id', employee()->company_id);
            }
        });


    }
  
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = date('Y-m-d', strtotime($value));
    }
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = date('Y-m-d', strtotime($value));
    }
    public function employee()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employee_id');
    }
    public function project()
    {
        return $this->hasOne('App\Models\Project', 'id', 'project_id');
    }
    // public function setStartTimeAttribute($data) {

    //     $this->attributes['start_time'] = Carbon::parse($data)->format('g:i A');
    // }
    // public function setEndTimeAttribute($data) {

    //     $this->attributes['end_time'] = Carbon::parse($data)->format('g:i A');
    // }
    // public function setEmployeeIdAttribute($value)
    // {
    //     $this->attributes['employee_id'] = json_encode($value);
    // }
    // public function getEmployeeIdAttribute($value)
    // {
    //     return $this->attributes['employee_id'] = json_decode($value);
    // }

    // protected function project_employee()
    // {
    //     return $this->belongsTo('App\Models\Project', 'employee_id', 'id');
    // }

   
}