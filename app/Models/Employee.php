<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\LeaveRequest;
use App\Models\Project;

class Employee extends Model
{
    use HasFactory;
    protected $fillable=['user_id','emp_type_id','project_id'];

    public function leaves()
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function projects()
    {
            return $this->belongsToMany(Project::class, 'project_employee');
    
    }
}
