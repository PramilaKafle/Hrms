<?php
namespace App\Repositories;
use App\Interfaces\PermissionRepositoryInterface;

use App\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
 public function all()
 {
    return Permission::all();
 }
}