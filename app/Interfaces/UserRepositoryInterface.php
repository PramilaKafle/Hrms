<?php
namespace App\Interfaces;

Interface UserRepositoryInterface{

    public function all();

    public function store( array $userdata);

    public function getUserById(string $id);
    public function update(string $id, array $userdata);

    public function delete($userid);
}