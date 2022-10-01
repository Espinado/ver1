<?php

namespace App\Repositories;

use App\Interfaces\AdminRepositoryInterface;
use App\Models\Admins\Admin;

class AdminRepository implements AdminRepositoryInterface
{

    public function getAllAdmins()
    {
        return Admin::all();
    }
    public function getAdminById($adminId)
    {
    }
    public function deleteAdmin($adminId)
    {
    }
    public function createAdmin(array $adminDetails)
    {
    }
    public function updateAdmin($adminId, array $newDetails)
    {
    }
}
