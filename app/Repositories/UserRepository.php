<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;

use App\Models\User;
class UserRepository extends BaseRepository
{
    public function __construct( ){
        parent::__construct(new User());
    }
}