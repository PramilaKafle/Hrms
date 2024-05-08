<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

use App\Models\Employee;
use App\Models\User;

class EmployeeRepository extends BaseRepository{
    public function __construct()
    {
        parent::__construct(new Employee());
    }
  public function store(array $data)
  {
    $user=User::create($data);
    $employeedata = $data['emp_type_id'];
    $user->emp_types()->sync($employeedata);    
    return redirect()->back()->with('success', 'Employee created successfully');
  }

  public function update(string $id, array $data)
  {
      $user = User::findOrFail($id);
      $user->update($data);
      $employeedata = $data['emp_type_id'];
      $user->emp_types()->sync($employeedata);

      $employee = Employee::where('user_id', $user->id)->first();
  
      if (isset($data['project'])) {
          $projectdata = $data['project'];
          $employee->projects()->sync($projectdata);
  
      }
      return redirect()->back()->with('success', 'Employee updated successfully');
  }
  


    
   public function getEmployeeOnly($page=null)
   {
    if ($page) {
      $employeeids =Employee::pluck('user_id')->toArray();
    $users =User::whereIn('id',$employeeids)->paginate(5, ['*'], 'page', intval($page));
    }
  else{
    $employeeids =Employee::pluck('user_id')->toArray();
    $users =User::whereIn('id',$employeeids)->get();
  }
 
   return $users;
  }




   public function findByUserId(string $id)
  {
    return Employee::where('user_id',$id)->first();
  }

  public function projectstore(array $data)
  {
    $employee=Employee::where('user_id',$data['user_id'])->first();
    $employee->projects()->sync($data['project_id']);
    return redirect()->route('employee.index')->with('success', 'Project assigned to employee successfully.');
  }


}
