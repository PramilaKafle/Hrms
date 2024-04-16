<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Employee;
use App\Interfaces\BaseRepositoryInterface;

class HomeController extends Controller
{
    private BaseRepositoryInterface $baseRepository;

    public function __construct(BaseRepositoryInterface $baseRepository)
    {
   $this->baseRepository=$baseRepository;
   
    }
 
    public function redirect()
{

       $allusers=$this->baseRepository->all(User::class);
   
      $employees = $this->baseRepository->all(Employee::class);
    
        
        return view('Admin.dashboard',compact('employees','allusers'));
    }


// }
 }
