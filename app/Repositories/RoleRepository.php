<?php
namespace App\Repositories;
use App\Interfaces\RoleRepositoryInterface;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleRepository implements RoleRepositoryInterface
{
    public function all()
    {
        return Role::all();
        
    }
    public function getPermissions()
    {
        return Permission::all();
    }
    public function store($data)
    {
      DB::beingTransaction();
      try{
        $roledata=[
            'name'=>$data['name'],
        ];
         $role= Role::create($roledata);

         $permissions= $data['permissions'];
       
         $role->permissions()->sync($permissions);
        DB::commit();
        return redirect()->back()->with('success', 'Role created successfully');
      }catch(Exception $e)
      {
DB::rollBack();

return redirect()->back()->with('error', 'Erroe creating Role');
      }

       
    }
   public function getRoleById(string $id)
   {
    return Role::findOrFail($id);
   }

     Public function update(string $id, $data)
   {
    DB::beginTransaction();
    try{
        $roledata=[ 'name'=>$data['name'],];


        $role=Role::findOrFail($id);
        $role->update($roledata);
        if (isset($data['permissions'])) {
            $selectedPermissions = $data['permissions'];
            $role->permissions()->sync( $selectedPermissions);
        }
        DB::commit();
        return redirect()->back()->with('success', 'Role updated successfully');
      
    }catch(Exception $e)
    {
DB::rollBack();
return redirect()->back()->with('error', 'Error updating role');
    }
   
    }
      

    public function delete($role)
    {
       return  $role->delete();
    }
}