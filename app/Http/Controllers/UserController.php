<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use Illuminate\Validation\Rule;

class UserController extends Controller
{   private UserRepositoryInterface $userRepository;
    private RoleRepositoryInterface $roleRepository;
    
 
    public function __construct( UserRepositoryInterface $userRepository,RoleRepositoryInterface $roleRepository)
    {
      
       $this->userRepository= $userRepository;
       $this->roleRepository= $roleRepository;
       $this->middleware('CheckPermission:create')->except('index','show');
       $this->middleware('CheckPermission:view')->only(['index','show']);
       $this->middleware('CheckPermission:delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=$this->userRepository-> getUserOnly();
     return view('Admin.user',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles=$this->roleRepository->all();
        return view('Admin.adduser',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= $request->validate([
            'name'=>['required','string','max:25'],
            'email'=>['required','email','unique:users'],
            'password'=>['required','min:8'],
            'roles'=>[],
            'image'=>[],
        ]);
        $this->userRepository->store($data);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
          $users=$this->userRepository->getUserById($id);
          return view('Admin.viewuser',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=$this->userRepository->getUserById($id);
         $roles=$this->roleRepository->all();
         return view('Admin.edituser',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $users=$this->userRepository->getUserById($id);
         $data= $request->validate([
            'name' => ['required','string','max:255' ],
            'email' => ['required','email',
            Rule::unique('users')->ignore($users->id)],
            'password' => ['required','min:8'],
            'roles' => ['required'],
        ]);
         $this->userRepository->update($id,$data);
         return redirect()->route('user.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=$this->userRepository->getUserById($id);
       
        $this->userRepository->delete($user);
        return redirect()->route('user.index');
    }
}
