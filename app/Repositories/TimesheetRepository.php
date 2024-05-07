<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Timesheet;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
        //dd($employees);
        $timesheets = Timesheet::where('project_id', $projects->id)
                            ->where('employee_id', $employees->id)
                            ->get();
    
        return $timesheets;

    }

   public function  generateTimesheetData($data)
   {
    
    $carbonStartDate = Carbon::createFromFormat('m/d/Y', $data['start_date']);
    $carbonEndDate= Carbon::createFromFormat('m/d/Y',$data['end_date']);
    $startDate = $carbonStartDate->format('Y-m-d');
    $endDate = $carbonEndDate->format('Y-m-d');

     $employee = DB::select('select id from employees where user_id = ?', [$data['employee_id']]);
     $employeeid = $employee[0]->id;
     $timesheet = DB::select('select * from timesheets where project_id = ? AND employee_id = ? AND Date BETWEEN ? AND ?', 
                      [$data['project_id'],$employeeid,  $startDate, $endDate]);

   
     return $timesheet;
   }

   public function getreportdata($data)
   {
    //    $timesheet=DB::select('select *
    //    from timesheets where Date BETWEEN ? AND  ?',
    //     [$data['start_date'],$data['end_date']]);
    
    $startDate = $data['start_date'];
    $endDate = $data['end_date'];

    $timesheet = DB::select('
        SELECT u.name, t.*
        FROM timesheets t
        JOIN employees e ON t.employee_id = e.id
        JOIN users u ON e.user_id = u.id
        WHERE t.Date BETWEEN ? AND ?
    ', [$startDate, $endDate]);

    return $timesheet;

   }


   
}