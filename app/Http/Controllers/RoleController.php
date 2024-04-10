<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\PermissionRepositoryInterface;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private RoleRepositoryInterface $roleRepository;
    private PermissionRepositoryInterface $permissionRepository;

    public function __construct(RoleRepositoryInterface $roleRepository,PermissionRepositoryInterface $permissionRepository)
    {
      
       $this->roleRepository= $roleRepository;
       $this->permissionRepository=$permissionRepository;
    }
    public function index()
    {
      $roles =$this->roleRepository->all();
      return view('Admin.role',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions=$this->permissionRepository->all();
        return view('Admin.addrole',compact('permissions'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name' => ['required','string','max:255' ],
        'permissions'=>['required'],
        ]);

        $this->roleRepository->store($data);
        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role=$this->roleRepository->getRoleById($id);
        return view('Admin.viewrole',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role=$this->roleRepository->getRoleById($id);
        $permissions=$this->permissionRepository->all();
     return view('Admin.editrole',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=$request->validate([
            'name' => ['required','string','max:255' ],
        'permissions'=>['required'],
        ]);
      
        $this->roleRepository->update($id,$data);
        $role=$this->roleRepository->getRoleById($id);
        return redirect()->route('role.show',compact('role'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role=$this->roleRepository->getRoleById($id);
        $this->roleRepository->delete($role);

        return redirect()->route('role.index');

    }
}
