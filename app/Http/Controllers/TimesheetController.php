<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\Project;
use App\Models\Timesheet;
use App\Models\User;
use App\Repositories\TimesheetRepository;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Validator;
use Carbon\carbon;

class TimesheetController extends Controller
{
    private TimesheetRepository  $timesheetRepository;
    private EmployeeRepository  $employeeRepository;
    public function __construct(TimesheetRepository  $timesheetRepository,EmployeeRepository  $employeeRepository)
    {
       $this->timesheetRepository=$timesheetRepository;
       $this->employeeRepository=$employeeRepository;
    }
    public function index()
     {
    
      $timesheetdataes= $this->timesheetRepository->all();
      $projects=Project::all();
      $users=User::all();
      $employee=$this->employeeRepository->all();
       
       return view('Timesheet.User.index',compact('timesheetdataes','projects','users','employee'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $user=auth()->user();
        $employees=$this->employeeRepository->findByUserId($user->id);
        $projects=Project::find($id);
       // $timesheet=$this->timesheetRepository->gettimesheetdata($projects,$employees);
        //dd($timesheet);
        return view('Timesheet.index',compact('projects','id','employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data using specified rules
        $data = $request->validate([
            '*.id'=>[],
            '*.Date' => ['required', 'date'],
            '*.working_hour' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'not_in:0'],
            '*.project_id' => [],
            '*.employee_id' => [],
        ]);
        $this->timesheetRepository->store($data);
           if ($request->ajax()) {
            return response()->json(['message' => 'Timesheet Data stored successfully', 'data' => $data]);
           
            }

    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee=$this->employeeRepository->getUserByEmpid($id);
        dd($employee);
       return view('Timesheet.User.viewtimesheet');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
         
    //     $data =$request->validate([
    //         'Date'=>['required','date'],
    //         'working_hour'=>['required','numeric','regex:/^\d+(\.\d{1,2})?$/','gt:0'],
    //         'project_id'=>[],
    //         'employee_id'=>[],
    //     ]);
    //      $this->timesheetRepository->update($id,$data);
       
    //     if ($request->ajax()) {
    //         return response()->json(['message' => 'Timesheet Data edited successfully','data' => $data ]);
           
    //         }
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function deletedata(Request $request ,string $id)
    {
        
       $this->timesheetRepository->delete($id);
        if ($request->ajax()) {
          
            return response()->json(['message' => 'Timesheet Data deleted successfully' ]);
        }
           
    }
    public function gettimesheetdata(Request $request ,string $id)
    {
        
        $user=auth()->user();
        $employees=$this->employeeRepository->findByUserId($user->id);
        $projects=Project::find($id);
        $timesheet=$this->timesheetRepository->gettimesheetdata($projects,$employees);
        
        return response()->json(['message' => 'Data taken successfully', 'data' => $timesheet]);
           
       
    }
   

}
