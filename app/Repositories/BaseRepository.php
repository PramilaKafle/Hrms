<?php

namespace App\Repositories;
use App\Interfaces\BaseRepositoryInterface;

use App\Models\User;
use App\Models\Employee;
use App\Models\Emp_type;
use App\Models\LeaveRequest;


use Illuminate\Support\Facades\DB;
use File;
use Carbon\Carbon;

class BaseRepository implements BaseRepositoryInterface{


public function all($model)
{
 return $model::all();
}
public function getById( $model ,string $id)
{
   return $model::findOrFail($id);
}

public function store($model ,array $data)
{
    DB::beginTransaction();
    try{
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
            $record= $model::create($data);
   
       if(isset($data['roles']))
       {
         $roledata=$data['roles'];
              $record->roles()->sync($roledata);
           DB::commit();
           return redirect()->back()->with('success', 'User created successfully');
       }
      
       if (isset($data['emp_type_id'])) {
        $employeedata = $data['emp_type_id'];
        $record->emp_types()->sync($employeedata);
        DB::commit();
        return redirect()->back()->with('success', 'Employee created successfully');
    }
    
    if(isset($data['permissions']))
    {
        $permissions= $data['permissions'];  
        $record->permissions()->sync($permissions);
       DB::commit();
       return redirect()->back()->with('success', 'Role created successfully');
    }


    DB::commit();
  
       
    }catch(Exception)
    {
        DB::rollBack();
        return redirect()->back()->with('error', 'Error creating user: ');
    }
  
}

public function update( $model ,string $id, array $data)
{
    DB::beginTransaction();

    try {
       

        $user = $model::findOrFail($id);
        $user->update($data);
        DB::commit();
        
        if (isset($data['emp_type_id'])) {
            $employeedata = $data['emp_type_id'];
            $user->emp_types()->sync($employeedata);
            DB::commit();
            return redirect()->back()->with('success', 'Employee updated successfully');
        }

        if (isset($data['roles'])) {
            $roledata = $data['roles'];
            $user->roles()->sync($roledata);
            DB::commit();
            return redirect()->back()->with('success', 'User updated successfully');
        }
        if(isset($data['permissions']))
        {
            $permissions= $data['permissions'];
            $user->permissions()->sync($permissions);
           DB::commit();
           return redirect()->back()->with('success', 'Role Updated successfully');
        }

       

    } catch (Exception $e) {
        DB::rollBack();
         return redirect()->back()->with('error', 'Error updating user: ');
    
    }
}


public function getUserOnly()
{
$employeeids =Employee::pluck('user_id')->toArray();
$users =User::whereNotIn('id',$employeeids)->get();

return $users;
}

public function getEmployeeOnly()
{
$employeeids =Employee::pluck('user_id')->toArray();
$users =User::whereIn('id',$employeeids)->get();
return $users;
}

public function getuserswithRoles(){
    $userwithrole=User::with('roles')->get();
    
}

public function findByUserId(string $id)
{
    return Employee::where('user_id',$id)->first();
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

public function delete($model,$id)
{
     $record = $model::find($id);
     if(isset($record->status))
     {
        if($record->status === 'approved'|| $record->status == 'declined')
        {
            return redirect()->route('leave.index')->with('error','Cannot cancel the Request. Already '. $record->status);
        }
     }
    
     return $record->delete();
    
    
}

}