<?php
namespace App\Interfaces;

Interface UserRepositoryInterface{

    public function all();

    public function store( array $data);

    public function getUserById( string $id);
    public function update(string $id, array $data);

    public function getUserOnly();
    public function getEmployeeOnly();
    public function getuserswithRoles();
    public function delete($userid);

   
}