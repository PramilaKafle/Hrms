<?php

namespace App\Repositories;
use App\Interfaces\EmployeeTypeRepositoryInterface;

use App\Models\Emp_type;

class EmployeeTypeRepository implements EmployeeTypeRepositoryInterface{
public function all()
{
 return Emp_type::all();
}
public function findEmptypeById($empid)
{
    return Emp_type::find($empid);
}

}