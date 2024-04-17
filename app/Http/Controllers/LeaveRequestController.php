<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\BaseRepositoryInterface;
use App\Repositories\LeaveRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\LeaveRequest;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  private BaseRepositoryInterface $baseRepository;
    
    private LeaveRepository $leaveRepository;

     public function __construct(LeaveRepository $leaveRepository)
     {
       
        $this->leaveRepository= $leaveRepository;
    
     }
    public function index()
    {
       $users= $this->leaveRepository->getUserByEmpId();
       $leaves=$this->leaveRepository->getLeaveByEmpId();
      
       $employee=Employee::all();

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

   public function approve($id)
   {
    $leave=$this->leaveRepository->getById($id);
    $leave->status='Approved';
    $leave->save();
    return redirect()->route('leave.index');

   }
   public function decline($id)
   {
    $leave=$this->leaveRepository->getById($id);
    $leave->status='declined';
    $leave->save();
    return redirect()->route('leave.index');

   }
    public function destroy(string $id)
    {
        $this->leaveRepository->delete($id);
        return redirect()->route('leave.index');
    }
}