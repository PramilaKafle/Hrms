<?php
namespace App\Interfaces;

Interface BaseRepositoryInterface{

    public function all();

    public function store(array $data);

    public function getById(string $id);
    public function update(string $id, array $data);
     public function delete($id);
     
    
  
   
   
  
}