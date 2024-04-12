<?php
namespace App\Interfaces;

Interface EmployeeRepositoryInterface{

    public function all();

     public function store( array $data);

    public function findByUserId(string $id);
    // public function update( string $id,array  $employeedata);
}
