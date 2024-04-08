<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emp_type;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Interfaces\EmployeeTypeRepositoryInterface;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private UserRepositoryInterface $userRepository;
    private EmployeeRepositoryInterface $employeeRepository;
    private EmployeeTypeRepositoryInterface $employeetypeRepository;
   

     public function __construct( UserRepositoryInterface $userRepository,EmployeeRepositoryInterface $employeeRepository,EmployeeTypeRepositoryInterface $employeetypeRepository)
     {
        $this->employeeRepository =$employeeRepository;
        $this->userRepository= $userRepository;
        $this->employeetypeRepository=$employeetypeRepository;


        $this->middleware('CheckPermission:create')->except('index','show');
         $this->middleware('CheckPermission:view')->only(['index','show']);
         $this->middleware('CheckPermission:delete')->only('destroy');
     }

    public function index()
    {
        // $allusers=User::all();
        $allusers=$this->userRepository->all();
   
      $employees =$this->employeeRepository->all();
    
        
        return view('Admin.view',compact('allusers','employees'));
       
    }

    /**
     * Show the form for creating a new resource.
     */

   
    public function create()

    {

         
        $employeetypes =$this->employeetypeRepository->all();
        
        return view('Admin.employee',compact('employeetypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required','string','max:255' ],
            'email' => ['required','email','unique:users'],
            'password' => ['required','min:8'],
            'emp_type_id' => ['required']
        ]);

        $userdata=[
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
        ];
       
       $userid = $this->userRepository->store($userdata);
$employeedata=[
    'user_id'=>$userid,
    'emp_type_id'=>$request->emp_type_id,
];
$this->employeeRepository->store($employeedata);
        return   redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $user=$this->userRepository->getUserById($id);
        $employee=$this->employeeRepository->findByUserId($id);
        if( $employee)
        {
            $emptype =$this->employeetypeRepository-> findEmptypeById($employee->emp_type_id);
        }
        else{
            $emptype=null;  
        }
      
       
        return view('Admin.show',compact('user','employee','emptype'));
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=$this->userRepository->getUserById($id);
        $employeetypes =$this->employeetypeRepository->all();
         $emp = $user->emp_types->isNotEmpty();
       
       
        return view('Admin.edit',compact('user','employeetypes','emp'));


       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $user=$this->userRepository->getUserById($id);
        $employee=$this->employeeRepository->findByUserId($id);

        $request->validate([
            'name' => ['required','string','max:255' ],
            'email' => ['required','email',
            Rule::unique('users')->ignore($employee->id)],
            'password' => ['required','min:8'],
            'emp_type_id' => ['required']
        ]);
       

        $userdata=[
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        $employeedata=[
            'emp_type_id'=>$request->emp_type_id,
        ];
        $this->userRepository->update($id,$userdata);
        $this->employeeRepository->update($id,$employeedata);


        return   redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=$this->userRepository->getUserById($id);;
       
        $this->userRepository->delete($user);
        return redirect()->route('employee.index');
    }
}
