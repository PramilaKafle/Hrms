<?php

namespace App\Repositories;
use App\Interfaces\EmployeeRepositoryInterface;

use App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface{
public function all()
{
 return Employee::all();
}

public function store(array $employeedata)
{
    return Employee::create($employeedata);
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