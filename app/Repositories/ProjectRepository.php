<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;


use App\Models\Project;

class ProjectRepository extends BaseRepository{
    public function __construct()
    {
        parent::__construct(new Project());
    }

}