<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\LeaveRequest;

class Employee extends Model
{
    use HasFactory;
    protected $fillable=['user_id','emp_type_id'];

    public function leaves()
    {
        return $this->hasMany(LeaveRequest::class);
    }
}
