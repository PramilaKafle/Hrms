<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;

use App\Models\Timesheet;
class TimesheetRepository extends BaseRepository
{
    public function __construct( ){
        parent::__construct(new Timesheet());
    }
}