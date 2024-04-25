<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Employee;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use App\Repositories\LeaveRepository;

class HomeController extends Controller
{
    private ProjectRepository $projectRepository;
    private LeaveRepository $leaveRepository;

    public function __construct(ProjectRepository $projectRepository,LeaveRepository $leaveRepository)
    {
        $this->projectRepository=$projectRepository;
        $this->leaveRepository=$leaveRepository;
    }
 
    public function redirect()
{

       $allusers=User::all();
   
      $employees =Employee::all();
      $projects=$this->projectRepository->getProjectByEmp();
      $leaves=$this->leaveRepository->getLeaveByEmpId();
        return view('Home.dashboard',compact('employees','allusers','projects','leaves'));
    }


// }
 }
