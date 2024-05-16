<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;

use App\Models\MonthlyTimesheet;
use App\Models\Timesheet;
use App\Models\TimesheetStatus;

class MonthlyTimesheetRepository extends BaseRepository
{
    public function __construct( ){
        parent::__construct(new MonthlyTimesheet());
    }

    public function store(array $datas)
    {
        foreach ($datas as $data) {
            $monthlyTimesheet = MonthlyTimesheet::create([
                'month_id' => $data['month_id'],
                'project_id' => $data['project_id'],
                'employee_id' => $data['employee_id'],
                'startDate' => $data['startDate'], 
                'endDate' => $data['endDate'],
            ]);
    
          
            $monthlyTimesheetId = $monthlyTimesheet->id;
           
    
            $statusdatas = $data['status'];
    
         
            foreach ($statusdatas as $statusdata) {
                TimesheetStatus::create([
                    'monthlytimesheet_id' => $monthlyTimesheetId, 
                    'status_id' => $statusdata['statusid'],
                    'user_id' => $statusdata['userid']
                ]);
            }

        
        Timesheet::where('employee_id', $data['employee_id'])
        ->where('project_id', $data['project_id'])
        ->whereBetween('date', [$data['startDate'], $data['endDate']])
        ->update([
            'monthlytimesheet_id' => $monthlyTimesheetId,
          
        ]);
        }
    }

}