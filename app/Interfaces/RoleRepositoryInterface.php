<?php

namespace App\Interfaces;
 Interface RoleRepositoryInterface
 {
    public function all();
    public function store($data);
    public function getRoleById(string $id);
    Public function update(string $id, $data);
   //  public function getRoleswithPermission(string $id);

   //public function findRoleByUserId(string $id);
    public function delete($role);
 }