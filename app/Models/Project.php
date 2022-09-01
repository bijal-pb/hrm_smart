<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;


class Project extends Model
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();


        static::addGlobalScope('company', function (Builder $builder) {
            if (admin()) {
                $builder->where('projects.company_id', admin()->company_id);
            }
            if (employee()) {
                $builder->where('projects.company_id', employee()->company_id);
            }
        });


    }


    protected $fillable = ['name','description','start','end','actual_hour','estimated_hour','status','company_id'];
  
    public function scopeCompany($query, $id)
    {
        return $query->where('projects.company_id', '=', $id);
    }

    public function setStartAttribute($value)
    {
        $this->attributes['start'] = date('Y-m-d', strtotime($value));
    }
    public function setEndAttribute($value)
    {
        $this->attributes['end'] = date('Y-m-d', strtotime($value));
    }

    public function emp_task()
    {
        return $this->hasMany('App\Models\EmployeeTask', 'project_id', 'id');
    }
}
