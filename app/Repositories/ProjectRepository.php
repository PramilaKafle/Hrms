<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;

use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Employee;

class ProjectRepository extends BaseRepository{
    public function __construct()
    {
        parent::__construct(new Project());
    }

    public function getProjectByEmp()
    {
        $user=auth()->user();
    if($user->emp_types->isNotEmpty())
    {
        $userid=$user->id;
        $employee =Employee::where('user_id',$user->id)->first();
        $projects=$employee->projects;
    }
    else{
        $projects= Project::all();
      
    }
       
       
         return $projects;
    }
  
}