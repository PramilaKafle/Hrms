<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;


use App\Models\Role;

class RoleRepository extends BaseRepository{
    public function __construct()
    {
        parent::__construct(new Role());
    }

}