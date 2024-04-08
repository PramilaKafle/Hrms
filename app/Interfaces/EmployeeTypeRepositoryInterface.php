<?php
namespace App\Interfaces;

Interface EmployeeTypeRepositoryInterface{

    public function all();
    public function findEmptypeById(string $id);

}
