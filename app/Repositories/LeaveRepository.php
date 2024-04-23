<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;

use App\Models\LeaveRequest;
use App\Models\Employee;
use App\Models\Emp_type;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class LeaveRepository extends BaseRepository
{
    public function __construct( ){
        parent::__construct(new LeaveRequest());
    }

public function store(array $data)
{
    DB::beginTransaction();
    try
    {
        if(isset($data['start_date'])&&($data['end_date']))
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
        }
      }
            $record=LeaveRequest::create($data);
            DB::commit();
   }
catch(Exception)
    {
        DB::rollBack();
        return redirect()->back()->with('error', 'Error creating user: ');
    }

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

public function getLeaveByEmpId()
{
    $user=auth()->user();
    if($user->emp_types->isNotEmpty())
    {
        $userid=$user->id;
        $empid=Employee::where('user_id',$userid)->first()->id;
        $leaves= LeaveRequest::where('emp_id',$empid)->paginate(5);
    }
    else{
        $leaves= LeaveRequest::paginate(5);
       // dd($leaves);
    }
  return $leaves;
    
   
}
public function getUserByEmpId()
{
$empidsonleave = LeaveRequest::pluck('emp_id')->toArray(); // Get all emp_ids from LeaveRequest
$users = User::whereHas('emp_types', function ($query) use ($empidsonleave) {
    $query->whereIn('employees.id', $empidsonleave); 
})->get();


return $users;
}
}