<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Validation\Rule;
use App\Models\Role;
use App\Models\User;
use App\Models\Employee;

class UserController extends Controller
{   private BaseRepositoryInterface $userRepository;

    public function __construct( BaseRepositoryInterface $userRepository)
    {
      
       $this->userRepository= $userRepository;
       
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
        $roles=$this->userRepository->all(Role::class);
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
        $this->userRepository->store(User::class,$data);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
          $users=$this->userRepository->getById(User::class,$id);
          return view('Admin.viewuser',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=$this->userRepository->getById(User::class,$id);
         $roles=$this->userRepository->all(Role::class);
         return view('Admin.edituser',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $users=$this->userRepository->getById(User::class,$id);
         $data= $request->validate([
            'name' => ['required','string','max:255' ],
            'email' => ['required','email',
            Rule::unique('users')->ignore($users->id)],
            'password' => ['required','min:8'],
            'roles' => ['required'],
        ]);
         $this->userRepository->update(User::class,$id,$data);
         return redirect()->route('user.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->userRepository->delete(User::class,$id);
        return redirect()->route('user.index');
    }
}
