<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;

use App\Models\LeaveRequest;
class LeaveRepository extends BaseRepository
{
    public function __construct( ){
        parent::__construct(new LeaveRequest());
    }
}