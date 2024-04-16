<?php
namespace App\Interfaces;

Interface BaseRepositoryInterface{

    public function all($model);

    public function store($model,array $data);

    public function getById($model,string $id);
    public function update($model ,string $id, array $data);
     public function delete($model,$id);
     
    public function getUserOnly();
    public function getEmployeeOnly(); 
    public function getuserswithRoles();
    public function getUserByEmpId();
    public function getLeaveByEmpId();
    public function calculateRemainingLeaves();
}