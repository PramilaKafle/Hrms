<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Employee;
use App\Repositories\ProjectRepository;

class HomeController extends Controller
{
    private ProjectRepository $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository=$projectRepository;
    }
 
    public function redirect()
{

       $allusers=User::all();
   
      $employees =Employee::all();
    
        return view('Home.dashboard',compact('employees','allusers',));
    }


// }
 }
