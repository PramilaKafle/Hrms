<?php

namespace App\Repositories;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;


use App\Models\User;
use App\Models\Employee;
use App\Models\LeaveRepository;
use Illuminate\Support\Facades\DB;
use File;

class UserRepository implements UserRepositoryInterface{

    private EmployeeRepositoryInterface $employeeRepository;
    private RoleRepositoryInterface $roleRepository;
    public function __construct( EmployeeRepositoryInterface $employeeRepository,RoleRepositoryInterface $roleRepository)
    {
 $this->employeeRepository =$employeeRepository;
 $this->roleRepository =$roleRepository;
    }
public function all()
{
 return User::all();
}

public function store( array $data)
{
    DB::beginTransaction();
    try{
        $userdata=[
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>$data['password'],
           ];
           if(isset($data['image']))
           {
            $imagename=time().'_'.$data['image']->getClientOriginalName();
            
           $image=$data['image']->storeAs('images',$imagename);
           //dd($image);
           $userdata['image']=$image;
           }
          
           $user= User::create($userdata);
          $roledata=$data['roles'];
           $user->roles()->sync($roledata);
           DB::commit();
           return redirect()->back()->with('success', 'User created successfully');
         
    }catch(Exception)
    {
        DB::rollBack();
        return redirect()->back()->with('error', 'Error creating user: ');
    }
  
}
public function getUserById(string $id)
{
   return User::findOrFail($id);
}
public function update(string $id, array $data)
{
    DB::beginTransaction();

    try {
        $userdata = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        $user = User::findOrFail($id);
        $user->update($userdata);
        
        if (isset($data['emp_type_id'])) {
            $employeedata = $data['emp_type_id'];
            $user->emp_types()->sync($employeedata);
            DB::commit();
            return redirect()->back()->with('success', 'Employee updated successfully');
        }

        if (isset($data['roles'])) {
            $roledata = $data['roles'];
            $user->roles()->sync($roledata);
        }

        DB::commit();
         return redirect()->back()->with('success', 'User updated successfully');

    } catch (Exception $e) {
        DB::rollBack();
         return redirect()->back()->with('error', 'Error updating user: ');
    
    }
}


public function getUserOnly()
{
$employeeids =Employee::pluck('user_id')->toArray();
$users =User::whereNotIn('id',$employeeids)->get();

return $users;
}
public function getEmployeeOnly()
{
$employeeids =Employee::pluck('user_id')->toArray();
$users =User::whereIn('id',$employeeids)->get();
return $users;
}

public function getuserswithRoles(){
    $userwithrole=User::with('roles')->get();
    
}


public function delete($user)
{
    return $user->delete();
    return redirect()->back()->with('success', 'User deleted successfully');

}

}