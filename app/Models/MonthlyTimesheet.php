<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyTimesheet extends Model
{
    use HasFactory;

    protected $fillable=[
        'startDate',
        'endDate',
        'employee_id',
        'project_id',
        'month_id',
    ];

  
}
