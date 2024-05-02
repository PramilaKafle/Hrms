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


public function store(array $entries)
{
    foreach ($entries as $entry) {
        $timesheetId = $entry['id'];

        if ($timesheetId !== null ) {
            // Update the existing timesheet
            $timesheet = Timesheet::find($timesheetId);

            if ($timesheet ) {
                $timesheet->update([
                    'Date' => $entry['Date'],
                    'working_hour' => $entry['working_hour'],
                    'project_id' => $entry['project_id'],
                    'employee_id' => $entry['employee_id'],
                ]);
            }
        } else {
            // Create a new timesheet
            Timesheet::create([
                'Date' => $entry['Date'],
                'working_hour' => $entry['working_hour'],
                'project_id' => $entry['project_id'],
                'employee_id' => $entry['employee_id'],
            ]);
        }
    }
}


    public function gettimesheetdata($projects,$employees)
    {
        $timesheets = Timesheet::where('project_id', $projects->id)
                            ->where('employee_id', $employees->id)
                            ->get();
    
    return $timesheets;

    }
   
}