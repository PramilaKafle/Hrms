<?php

namespace App\Repositories;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;

use App\Models\User;
use App\Models\Employee;
use App\Models\LeaveRepository;

class UserRepository implements UserRepositoryInterface{

    private EmployeeRepositoryInterface $employeeRepository;
    private RoleRepositoryInterface $roleRepository;
    public function __construct( EmployeeRepositoryInterface $employeeRepository,RoleRepositoryInterface $roleRepository)
    {
 $this->employeeRepository =$employeeRepository;
 $this->roleRepository =$roleRepository;
    }
public function all()
{
 return User::all();
}

public function store( array $data)
{
   $userdata=[
    'name'=>$data['name'],
    'email'=>$data['email'],
    'password'=>$data['password'],
   ];
   $user= User::create($userdata);
   $roledata=$data['roles'];
   $user->roles()->sync($roledata);
 
}
public function getUserById(string $id)
{
   return User::findOrFail($id);
}
public function update( string  $id,array $data)
{

    $userdata=[
        'name'=>$data['name'],
        'email'=>$data['email'],
        'password'=>$data['password'],
    ];
    $user =User::findOrFail($id);
    $user->update($userdata);
    
if (isset($data['emp_type_id']))
{
    
$employeedata=$data['emp_type_id'];
$user->emp_types()->sync($employeedata);
   
}

if (isset($data['roles']))
{
    $roledata=$data['roles'];
   $user->roles()->sync($roledata);
   
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


public function delete($user)
{
    return $user->delete();
}

}