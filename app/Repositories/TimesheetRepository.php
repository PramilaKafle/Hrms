<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Timesheet;
use App\Models\TimesheetStatus;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;
use DateInterval;
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
                            ->orderBy('Date','asc')
                            ->get();
    
        return $timesheets;

    }

   public function  generateTimesheetData($data)
   {
    
    $startDate=$data['start_date'];
    $endDate=$data['end_date'];

     $employee = DB::select('select id from employees where user_id = ?', [$data['employee_id']]);
     $employeeid = $employee[0]->id;
     $timesheet = DB::select('select * from timesheets where project_id = ? AND employee_id = ? AND Date BETWEEN ? AND ?', 
                      [$data['project_id'],$employeeid,  $startDate, $endDate]);

   
     return $timesheet;
   }

public function getreportdata($data) 
   {
    
     $startDate = $data['start_date'];
     $endDate = $data['end_date'];
 

     $sql = "
     WITH RECURSIVE MonthsBetween AS (
         SELECT CAST(:start_date AS DATE) AS MonthDate
         UNION ALL
         SELECT DATE_ADD(MonthDate, INTERVAL 1 MONTH)
         FROM MonthsBetween
         WHERE DATE_ADD(MonthDate, INTERVAL 1 MONTH)  < LAST_DAY(:end_date)
     )
     SELECT 
      u.name,DATE_FORMAT(MonthDate, '%M %Y') AS MonthName, 
     t.employee_id, 
    SUM(CASE 
       WHEN t.Date BETWEEN :startdate AND :enddate 
       THEN t.working_hour 
       ELSE 0 
       END)
     AS total_hours
     FROM MonthsBetween
     LEFT JOIN timesheets t 
       ON MONTH(MonthDate) = MONTH(t.Date)
       AND YEAR(MonthDate) = YEAR(t.Date) 
      LEFT JOIN employees e ON t.employee_id =e.id
      LEFT JOIN users u ON e.user_id = u.id
     GROUP BY u.name,MonthDate,t.employee_id
     ";

    

$monthlyData = DB::select($sql, [
        'start_date' => $startDate,
        'end_date' => $endDate,
        'startdate'=>$startDate,
        'enddate'=>$endDate,
    
    ]);

    return $monthlyData;



}


public function getmonthlytimesheetdata()
{
  $user=Auth()->user();
  $timesheets = DB::table('timesheet_statuses')
                    ->join('monthly_timesheets', 'timesheet_statuses.monthlytimesheet_id', '=', 'monthly_timesheets.id')
                    ->where('timesheet_statuses.user_id', $user->id)
                    ->select('timesheet_statuses.*', 'monthly_timesheets.month_id', 'monthly_timesheets.employee_id')
                   ->get();
 
 
                   return $timesheets;
}




   
}