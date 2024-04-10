<?php
namespace App\Interfaces;

Interface LeaveRepositoryInterface
{
    public function all();
    public function getleaveById( string $id);
    public function getUserByEmpId();
    public function getLeaveByEmpId();
    public function store($data);
}