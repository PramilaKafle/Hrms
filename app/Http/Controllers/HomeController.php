<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Employee;
use App\Interfaces\BaseRepositoryInterface;

class HomeController extends Controller
{
//     private BaseRepositoryInterface $baseRepository;

//     public function __construct(BaseRepositoryInterface $baseRepository)
//     {
//    $this->baseRepository=$baseRepository;
   
//     }
 
    public function redirect()
{

       $allusers=User::all();
   
      $employees =Employee::all();
    
        
        return view('Home.dashboard',compact('employees','allusers'));
    }


// }
 }
