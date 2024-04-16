<?php
namespace App\Interfaces;

Interface LeaveRepositoryInterface
{

    public function getUserByEmpId();
    public function getLeaveByEmpId();
    public function calculateRemainingLeaves();
    public function store($data);
}