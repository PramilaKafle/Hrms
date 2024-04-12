<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employees;
class LeaveRequest extends Model
{
    use HasFactory;

    protected $fillable=[
        'emp_id',
'start_date',
'end_date',
'description',
'applied_for',
    ];

    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }
}
