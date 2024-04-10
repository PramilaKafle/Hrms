<?php
namespace App\Repositories;

use App\Interfaces\LeaveRepositoryInterface;
use App\Models\LeaveRequest;
use App\Models\Employee;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class LeaveRepository implements LeaveRepositoryInterface
{

    public function all()
    {
        return LeaveRequest::all();
    }

    public function getleaveById( string $id)
    {
        return LeaveRequest::findOrFail($id);
    
    }
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

    public function store($data)
    {

        $userid=auth()->user()->id;
       $empid=Employee::where('user_id',$userid)->first()->id;

      $data['emp_id']=$empid;
        $leave=LeaveRequest::create($data);
    }
    public function getUserByEmpId()
{
    $empidsonleave=LeaveRequest::all()->pluck('emp_id');
    $employees = Employee::whereIn('id', $empidsonleave)->get();
   $userIds = $employees->pluck('user_id')->toArray();
   $users = User::whereIn('id', $userIds)->get();
   //dd($users);
    return $users;

}

    public function delete($id)
    {
       $leave= LeaveRequest::findOrFail($id);
       $leave->delete();
    }
}