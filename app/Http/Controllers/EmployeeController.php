<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emp_type;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Interfaces\BaseRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\ProjectRepository;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private UserRepository $userRepository;
    private EmployeeRepository $employeeRepository;
    private ProjectRepository $projectRepository;
   
     public function __construct(UserRepository $userRepository,EmployeeRepository $employeeRepository,ProjectRepository $projectRepository)
     {
        $this->userRepository= $userRepository;
        $this->employeeRepository= $employeeRepository;
        $this->projectRepository= $projectRepository;
        $this->middleware('CheckPermission:create')->except('index','show');
         $this->middleware('CheckPermission:view')->only(['index','show']);
         $this->middleware('CheckPermission:delete')->only('destroy');
        
     }

    public function index()
    {

        $employees=$this->employeeRepository->getEmployeeOnly();
        $empid =$this->employeeRepository->all();
        $project=$this->projectRepository->all();
        return view('Employee.index',compact('employees','empid','project'));
       
    }

    /**
     * Show the form for creating a new resource.
     */

   
    public function create()

    {
        $employeetypes =Emp_type::all();
        $projects=$this->projectRepository->all();
        return view('Employee.model',compact('employeetypes','projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

      $data = $request->validate([
            'name' => ['required','string','max:255' ],
            'email' => ['required','email','unique:users'],
            'password' => ['required','min:8'],
            'emp_type_id' => ['required'],
        ]); 
       //dd($data);
       $userid = $this->employeeRepository->store($data);
        return   redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $user=$this->userRepository->getById($id);
        $employee=$this->employeeRepository->findByUserId($id);
        return view('Employee.view',compact('user','employee'));
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=$this->userRepository->getById($id);
        $employeetypes =Emp_type::all();
        $projects =$this->projectRepository->all();
        $employee=$this->employeeRepository->findByUserId($id);
        return view('Employee.model',compact('user','employeetypes','projects','employee'));


       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $user=$this->userRepository->getById($id);
        $data= $request->validate([
            'name' => ['required','string','max:255' ],
            'email' => ['required','email',
            Rule::unique('users')->ignore($user->id)],
            'password' => ['required','min:8'],
            'emp_type_id' => ['required'],
            'project'=>[],
            
        ]);
       
        $this->employeeRepository->update($id,$data);
        return   redirect()->route('employee.index');
    }

    public function projectassign()
    {
     $employees=$this->employeeRepository->getEmployeeOnly();
    
     $projects =$this->projectRepository->all();
     return view('Project.assign',compact('employees','projects'));
    }

    public function projectstore(Request $request)
    {
    $data= $request->validate([
        'user_id'=>['required'],
        'project_id'=>['required'],
       ]);
    $this->employeeRepository->projectstore($data);
     return redirect()->route('employee.index');


    }
    public function destroy(string $id)
    {
        //$user=$this->baseRepository->getById(User::class,$id);
       
        $this->employeeRepository->delete($id);
        return redirect()->route('employee.index');
    }
}