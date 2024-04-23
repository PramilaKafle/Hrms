<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;


use App\Models\Role;

class RoleRepository extends BaseRepository{
    public function __construct()
    {
        parent::__construct(new Role());
    }

    public function store(array $data)
    {
        $role=Role::create($data);
        $permissions= $data['permissions'];  
        $role->permissions()->sync($permissions);
     
       return redirect()->back()->with('success', 'Role created successfully');
    }

    public function update(string $id, array $data)
    {
        $role=Role::findOrFail($id);
        $role->update($data);
        $permissions= $data['permissions'];
        $role->permissions()->sync($permissions);
      
        return redirect()->back()->with('success', 'Role Updated successfully');
    }

}