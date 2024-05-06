<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoleRepository;
use App\Repositories\BaseRepository;
// use App\Repositories\PermissionRepository;


use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    private RoleRepository $roleRepository;
    private $baseRepository;
   

    public function __construct(RoleRepository $roleRepository)
    {
      
      
       $this->roleRepository= $roleRepository;
       $this->baseRepository = new BaseRepository(new Permission());
       
       $this->middleware('CheckPermission:create_role')->except('index','show','edit','update');
       $this->middleware('CheckPermission:edit_role')->only('edit','update');
    //    $this->middleware('CheckPermission:view_role')->only('show');
    }
    public function index(Request $request)


    {
        //dd(session()->all());
        $page = $request->input('page', 1);
      $roles =$this->roleRepository->all($page);
      return view('Role.role',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions=$this->baseRepository->all();
        return view('Role.formmodel',compact('permissions'));
        
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
        return view('Role.view',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role=$this->roleRepository->getById($id);
        $permissions=$this->baseRepository->all();
     return view('Role.formmodel',compact('role','permissions'));
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
