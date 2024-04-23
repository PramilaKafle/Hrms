<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employee;
use App\Repositories\TimesheetRepository;
use App\Repositories\EmployeeRepository;
use Carbon\carbon;

class TimesheetController extends Controller
{
    private EmployeeRepository  $employeeRepository;
    public function __construct(EmployeeRepository  $employeeRepository)
    {
       $this->employeeRepository=$employeeRepository;
    }
    public function index()
    // {  $date= Carbon::now();
       {
       
        $user=auth()->user();
        $employees=$this->employeeRepository->findByUserId($user->id);
        
        //dd($timesheet);
        return view('Timesheet.index',compact('employees'));
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


}
