<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Interfaces\LeaveRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     private LeaveRepositoryInterface $leaveRepository;
     private EmployeeRepositoryInterface $employeeRepository;

     public function __construct( LeaveRepositoryInterface $leaveRepository,EmployeeRepositoryInterface $employeeRepository)
     {
      $this->leaveRepository=$leaveRepository;
      $this->employeeRepository=$employeeRepository;
     }
    public function index()
    {
       $users=  $this->leaveRepository->getUserByEmpId();
       $leaves=$this->leaveRepository->getLeaveByEmpId();
       $employee=$this->employeeRepository->all();

      $remainingleavedays= $this->leaveRepository->calculateRemainingLeaves();
 
        return view('Employee.leave',compact('leaves','users','employee','remainingleavedays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('Employee.leaverequest');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data= $request->validate([
            'start_date'=>['required'],
            'end_date'=>['required'],
            'description'=>['required']

        ]);
        $this->leaveRepository->store($data);
        return redirect()->route('leave.index');
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
        $this->leaveRepository->delete($id);
        return redirect()->route('leave.index');
    }
}
