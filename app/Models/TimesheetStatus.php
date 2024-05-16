<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimesheetStatus extends Model
{
    use HasFactory;

    protected $fillable=['monthlytimesheet_id','status_id','user_id'];
}
