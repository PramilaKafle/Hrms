<?php
namespace App\Repositories;

use App\Interfaces\LeaveRepositoryInterface;
use App\Models\LeaveRequest;
use App\Models\Employee;
use App\Models\User;
use App\Models\Emp_type;
use Carbon\Carbon;


use Illuminate\Support\Facades\Auth;

class LeaveRepository implements LeaveRepositoryInterface
{

    public function getLeaveByEmpId()
    {
        $user=auth()->user();
        if($user->emp_types->isNotEmpty())
        {
            $userid=$user->id;
            $empid=Employee::where('user_id',$userid)->first()->id;
            return LeaveRequest::where('emp_id',$empid)->get();
        }
        return LeaveRequest::all();
       
    }

    public function getUserByEmpId()
{
    $empidsonleave = LeaveRequest::pluck('emp_id')->toArray(); // Get all emp_ids from LeaveRequest
    $users = User::whereHas('emp_types', function ($query) use ($empidsonleave) {
        $query->whereIn('employees.id', $empidsonleave); 
    })->get();
  
   
    return $users;
}

    public function calculateRemainingLeaves()
    {

      
        $userid=auth()->user()->id;
       $emp=Employee::where('user_id',$userid)->first();
       if($emp)
       {
        $leaveallowed=Emp_type::where('id',$emp->emp_type_id)->first()->Leave_allowed;

        $totalleavetaken=LeaveRequest::where('emp_id', $emp->id)->sum('applied_for');
        $remainingleaves=   $leaveallowed-$totalleavetaken;
        return  $remainingleaves;
       }
    
      
  


    }
    public function store($data)
    {
    
            $remainingleaves=$this->calculateRemainingLeaves();

            $userid=auth()->user()->id;
           $empid=Employee::where('user_id',$userid)->first()->id;

          
    
           $start = Carbon::Parse($data['start_date']);
           
           $end = Carbon::Parse($data['end_date']);
           $leaveDays = $end->diffInDays($start) + 1;
    
            if ($leaveDays >  $remainingleaves) {
                return redirect()->back()->with('error', 'Insufficient LeaveDays. You have ' . $remainingleaves . ' days remaining.');
            }
            else{
                $data['emp_id']=$empid;
                $data['applied_for']= $leaveDays;
                  $leave=LeaveRequest::create($data);
            }
       
       

 
    }



}