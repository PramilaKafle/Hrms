<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\Project;
use App\Models\Timesheet;
use App\Repositories\TimesheetRepository;
use App\Repositories\EmployeeRepository;
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
    public function index(string $id)
  
       {
       
        $user=auth()->user();
        $employees=$this->employeeRepository->findByUserId($user->id);
        $projects=Project::find($id);
       // $timesheet=$this->timesheetRepository->gettimesheetdata($projects,$employees);
        //dd($timesheet);
        return view('Timesheet.index',compact('projects','id','employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('Employee.addtimesheet');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $data=$request->all();
        $this->timesheetRepository->store($data);
        if ($request->ajax()) {
        return response()->json(['message' => 'Timesheet Data stored successfully', 'data' => $data]);
       
        }
        //return redirect()->route('timesheet.store')->with('success', 'Timesheet data added successfully');
        //return view('Project.projectdash');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
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
    public function update(Request $request, string $id)
    {
         
         $data=$request->all();
         $this->timesheetRepository->update($id,$data);
       
        if ($request->ajax()) {
            return response()->json(['message' => 'Timesheet Data edited successfully','data' => $data ]);
           
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
