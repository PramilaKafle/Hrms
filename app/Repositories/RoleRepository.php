<?php
namespace App\Repositories;
use App\Interfaces\RoleRepositoryInterface;

use App\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function all()
    {
        return Role::all();
        
    }

    public function store($data)
    {


        $roledata=[
            'name'=>$data['name'],
        ];
         $role= Role::create($roledata);

         $permissions= $data['permissions'];
       
         $role->permissions()->sync($permissions);

    }
   public function getRoleById(string $id)
   {
    return Role::findOrFail($id);
   }

     Public function update(string $id, $data)
   {
        $roledata=[ 'name'=>$data['name'],];


    $role=Role::findOrFail($id);
    $role->update($roledata);
    if (isset($data['permissions'])) {
        $selectedPermissions = $data['permissions'];
        $role->permissions()->sync( $selectedPermissions);
    }
  
    }
      

    public function delete($role)
    {
       return  $role->delete();
    }
}