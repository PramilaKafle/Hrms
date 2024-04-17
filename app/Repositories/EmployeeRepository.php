<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;


use App\Models\Employee;

class EmployeeRepository extends BaseRepository{
    public function __construct()
    {
        parent::__construct(new Employee());
    }

}
