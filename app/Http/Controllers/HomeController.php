<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Employee;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;

class HomeController extends Controller
{
    private UserRepositoryInterface $userRepository;
    private EmployeeRepositoryInterface $employeeRepository;

    public function __construct(UserRepositoryInterface $userRepository, EmployeeRepositoryInterface $employeeRepository)
    {
   $this->userRepository=$userRepository;
   $this->employeeRepository=$employeeRepository;
    }
 
    public function redirect()
{
    // $users=Auth::user();
    // if($users->emptypes()->exists())
    // {
    //     return view('Employee.home');
    // }
    // else{
        // $user=Auth::user();

       $allusers=$this->userRepository->all();
   
      $employees = $this->employeeRepository->all();
    
        
        return view('Admin.dashboard',compact('employees','allusers'));
    }


// }
 }
