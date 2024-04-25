<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Timesheet;
use App\Models\Employee;
class TimesheetRepository extends BaseRepository
{
    public function __construct( ){
        parent::__construct(new Timesheet());
    }
   
}