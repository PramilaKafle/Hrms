<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoleRepository;

use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    private RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
      
      
       $this->roleRepository= $roleRepository;
       $this->middleware('CheckPermission:create_role')->except('index','show','edit','update');
       $this->middleware('CheckPermission:edit_role')->only('edit','update');
    //    $this->middleware('CheckPermission:view_role')->only('show');
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
        $permissions=Permission::all();
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
        $role=$this->roleRepository->getById($id);
        return view('Admin.viewrole',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role=$this->roleRepository->getById($id);
        $permissions=Permission::all();
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
        $role=$this->roleRepository->getById($id);
        return redirect()->route('role.show',compact('role'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->roleRepository->delete($id);

        return redirect()->route('role.index');

    }
}
