<?php

namespace App\Interfaces;

interface AdminRepositoryInterface
{
    public function getAllAdmins();
    public function getAdminById($adminId);
    public function deleteAdmin($adminId);
    public function createAdmin(array $adminDetails);
    public function updateAdmin($adminId, array $newDetails);

}
