<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Timesheet;
use App\Models\Employee;
class TimesheetRepository extends BaseRepository
{
    public function __construct( ){
        parent::__construct(new Timesheet());
    }

    public function gettimesheetdata($projects,$employees)
    {
        $timesheets = Timesheet::where('project_id', $projects->id)
                            ->where('employee_id', $employees->id)
                            ->get();
    
    return $timesheets;

    }
   
}