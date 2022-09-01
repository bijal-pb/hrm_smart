<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class EmployeeTask extends BaseModel
{
     protected $fillable = ['project_id','date', 'description','hour','created_at'];

    //  protected static function boot()
    //  {
    //      parent::boot();
 
 
    //      static::addGlobalScope('company', function (Builder $builder) {
    //          if (admin()) {
    //              $builder->where('employee_tasks.company_id', admin()->company_id);
    //          }
    //          if (employee()) {
    //              $builder->where('employee_tasks.company_id', employee()->company_id);
    //          }
    //      });
 
 
    //  }
     public function scopeCompany($query, $id)
    {
        return $query->where('employee_tasks.company_id', '=', $id);
    }
  
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = date('Y-m-d', strtotime($value));
    }

    public function project()
    {
        return $this->hasOne('App\Models\Project','id','project_id');
    }

    // public function getHourAttribute($value)
    // {
    //     return (new Carbon($value))->format('H:i:s');
    // }

}