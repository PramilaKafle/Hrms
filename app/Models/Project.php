<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Project extends Model
{
    use HasFactory;

    Protected $fillable=[
        'name',
    ];

    public function employees()
    {
            return $this->belongsToMany(Employee::class, 'project_employee');
    }
}
