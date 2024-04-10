<?php

namespace App\Repositories;
use App\Interfaces\EmployeeRepositoryInterface;

use App\Models\Employee;
use App\Models\User;

class EmployeeRepository implements EmployeeRepositoryInterface{
public function all()
{
 return Employee::all();
}

public function store(array $data)
{

    $userdata=[
        'name'=>$data['name'],
        'email'=>$data['email'],
        'password'=>$data['password'],
    ];
    $user= User::create($userdata);
    $userid= $user->id;
    // dd($userid);
    $employeedata=$data['emp_type_id'];
     $user->emp_types()->sync($employeedata);


}

public function findByUserId(string $id)
{
    return Employee::where('user_id',$id)->first();
}
public function update( string  $id,array $employeedata)
{
return Employee::whereId($id)->update($employeedata);
}
}