<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Validation\Rule;
use App\Models\Role;
use App\Models\User;
use App\Models\Employee;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Repositories\BaseRepository;

class UserController extends Controller
{   private UserRepository $userRepository;
    private RoleRepository $roleRepository;

    public function __construct(UserRepository $userRepository,RoleRepository $roleRepository)
    {
      
       $this->userRepository= $userRepository;
       $this->roleRepository=  $roleRepository;
       
    //    $this->middleware('CheckPermission:create')->except('index','show');
    //    $this->middleware('CheckPermission:view')->only(['index','show']);
    //    $this->middleware('CheckPermission:delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=$this->userRepository-> getUserOnly();
     return view('User.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles=$this->roleRepository->all();
        return view('User.model',compact('roles'));
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
          $users=$this->userRepository->getById($id);
          return view('User.view',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=$this->userRepository->getById($id);
         $roles=$this->roleRepository->all();
         return view('User.model',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $users=$this->userRepository->getById($id);
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
        $this->userRepository->delete($id);
        return redirect()->route('user.index');
    }

    public function profile()
    {
        $user=auth()->user();
        $userid=$user->id;
        $users=$this->userRepository->getById($userid);
        $employee=Employee::where('user_id',$userid)->first();
        return view('Employee.profile',compact('users','employee'));
    }

    public function storeImage(Request $request,string $id)
    {
       //$user=$this->userRepository->getById($id);
       $data=$request->validate([
        'image'=>['required','image']
       ]);
       $this->userRepository->uploadImage($data,$id);
      
       return redirect()->back();
    }
}