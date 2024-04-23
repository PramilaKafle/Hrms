<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;

use App\Models\User;
use App\Models\Employee;
class UserRepository extends BaseRepository
{
    public function __construct( ){
        parent::__construct(new User());
    }

    public function store(array $data)
    {
        $user=User::create($data);
        $roledata=$data['roles'];
        $user->roles()->sync($roledata);

           return redirect()->back()->with('success', 'User created successfully');
    }
    
    public function update(string $id, array $data)
    {
        $user=User::findOrFail($id);
        $user->update($data);
        $roledata = $data['roles'];
        $user->roles()->sync($roledata);   
        return redirect()->back()->with('success', 'User updated successfully');
    }
    public function getuserswithRoles(){
        $userwithrole=User::with('roles')->get();
        
    }
    
public function getUserOnly()
{
$employeeids =Employee::pluck('user_id')->toArray();
$users =User::whereNotIn('id',$employeeids)->paginate(5);
return $users;
}

}