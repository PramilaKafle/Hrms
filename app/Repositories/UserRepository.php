<?php

namespace App\Repositories;
use App\Interfaces\UserRepositoryInterface;

use App\Models\User;

class UserRepository implements UserRepositoryInterface{
public function all()
{
 return User::all();
}

public function store( array $userdata)
{
    $user= User::create($userdata);

    return $user->id;
}
public function getUserById(string $id)
{
   return User::findOrFail($id);
}
public function update( string  $id,array $userdata)
{
return User::whereId($id)->update($userdata);
}

public function delete($user)
{
    return $user->delete();
}

}