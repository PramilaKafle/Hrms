<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Employee;

class HomeController extends Controller
{


 
    public function redirect()
{
    // $users=Auth::user();
    // if($users->emptypes()->exists())
    // {
    //     return view('Employee.home');
    // }
    // else{
        // $user=Auth::user();

       $allusers=User::all();
   
      $empids = Employee::all();
    
        
        return view('Admin.dashboard',compact('empids','allusers'));
    }


// }
 }
