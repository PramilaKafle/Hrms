<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\Project;
use App\Repositories\TimesheetRepository;
use App\Repositories\EmployeeRepository;
use Carbon\carbon;

class TimesheetController extends Controller
{
    private TimesheetRepository  $timesheetRepository;
    public function __construct(TimesheetRepository  $timesheetRepository)
    {
       $this->timesheetRepository=$timesheetRepository;
    }
    public function index(string $id)
    // {  $date= Carbon::now();
       {
       
        //$user=auth()->user();
        //$employees=$this->employeeRepository->findByUserId($user->id);
        $projects=Project::find($id);
        return view('Timesheet.index',compact('projects'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getProjects()
    {
      
     $projects= $this->timesheetRepository->getProjectByEmp();
      return view('Timesheet.project',compact('projects'));
    }

}
