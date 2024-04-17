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


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private UserRepository $userRepository;
   
     public function __construct(UserRepository $userRepository)
     {
        $this->userRepository= $userRepository;
        $this->middleware('CheckPermission:create')->except('index','show');
         $this->middleware('CheckPermission:view')->only(['index','show']);
         $this->middleware('CheckPermission:delete')->only('destroy');
        
     }

    public function index()
    {

        $employees=$this->userRepository->getEmployeeOnly();
        $empid =Employee::all();
        $project=Project::all();
        return view('Admin.view',compact('employees','empid','project'));
       
    }

    /**
     * Show the form for creating a new resource.
     */

   
    public function create()

    {
        $employeetypes =Emp_type::all();
        $projects=Project::all();
        return view('Admin.employee',compact('employeetypes','projects'));
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
       $userid = $this->userRepository->store($data);
        return   redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $user=$this->userRepository->getById($id);
        $employee=$this->userRepository->findByUserId($id);
        return view('Admin.show',compact('user','employee'));
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=$this->userRepository->getById($id);
        $employeetypes =Emp_type::all();
        $projects =Project::all();
        $employees=Employee::all();
        return view('Admin.edit',compact('user','employeetypes','projects','employees'));


       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $user=$this->userRepository->getById($id);
       // $employee=$this->employeeRepository->findByUserId($id);

        $data= $request->validate([
            'name' => ['required','string','max:255' ],
            'email' => ['required','email',
            Rule::unique('users')->ignore($user->id)],
            'password' => ['required','min:8'],
            'emp_type_id' => ['required'],
            
        ]);
       
        $this->userRepository->update($id,$data);
        return   redirect()->route('employee.index');
    }

    public function projectassign()
    {
     $employees=$this->userRepository->getEmployeeOnly();
     //dd($employees);
     $projects =Project::all();
     return view('Employee.project',compact('employees','projects'));
    }

    public function projectstore(Request $request)
    {
       $request->validate([
        'user_id'=>['required'],
        'project_id'=>['required'],
       ]);
     $employee=Employee::where('user_id',$request->user_id)->first();
     $employee->projects()->sync($request->project_id);
     return redirect()->route('employee.index')->with('success', 'Project assigned to employee successfully.');

    }
    public function destroy(string $id)
    {
        //$user=$this->baseRepository->getById(User::class,$id);
       
        $this->userRepository->delete($id);
        return redirect()->route('employee.index');
    }
}